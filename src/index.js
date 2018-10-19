$(document).ready(function(){
	//		Site Buttons
		$("#button-login").click(function(e){
			var email = $("#input-email").val();
			var pass = $("#input-pass").val();
			if( email == "" || pass=="" ) return false;
			
			/*    	expire table             
				1yıl = 	31104000
				6ay = 	15552000
				1ay = 	2592000
				1hafta= 604800
				1gün = 	86400
				1saat = 3600
			*/
			$.post( "./Rest/login.php", {
					email:email,
					pass:pass,
					expire: "86000"
				},
				function(data){
					//console.log(data);
					console.log(decodeURIComponent(data));
					if( decodeURIComponent(getCookie("Token")) == data ){
						console.log("logedin");
						location.href="#list";
					}else{
						alert("login error");
						console.log( getCookie("Token") );
						//console.log( decodeURIComponent(getCookie("Token") ));
					}
				},
				"text"
			);
			
			return false;	
		});
		$("#button-register").click(function(e){
			var email = $("#input-reg-email").val();
			var pass = $("#input-reg-pass").val();
			var pass2 = $("#input-reg-pass2").val();
			
			if( email == "" || pass=="" || pass2=="" || pass != pass2 ) return false;
			
			$.post( "./Rest/register.php", {
					email:email,
					pass:pass,
					pass2:pass2
				},
				function(data){
					alert(data);
				},
				"text"
			);
			
			return false;	
		});
		$("#list-add-button").click(function(e){
			Add();
			return false;	
		});
		$("#list-update").click(function(e){
			List();
			return false;	
		});
		$("#list-logout-button").click(function(e){
			$.post( "./Rest/logout.php", {},
				function(data){
					$("#list-content").html("");
					location.href="#login";
				},
				"text"
			);
			return false;	
		});
		
		$("#list-add-refresh").click(function(e){
			$("#list-add-password").val(randomize(16,"simple"));
			return false;	
		});
	//		Edit sembol functions
		var deleteduser = "";
		var deletedid = "";
		$(document).on("click",".item-toolbar-holder .ui-icon-delete" ,function(e){
			deleteduser = $(this).parent().find(".list-item-name").text();
			deletedid = $(this).parent().find(".list-item-name").attr("listid");
		});
		$("#list-item-delete-button").click(function(e){
			Delete(deleteduser,deletedid);
			deleteduser = "";
			deletedid = "";
		});
		
		$(document).on("click",".item-toolbar-holder .ui-icon-eye" ,function(e){
			var p = $(this).parent();
			var id = p.find(".list-item-name").attr("listid");
			var name = p.find(".list-item-name").text();
			$(".list-item-password").html("");
			Get(name,id,"both",p);
			return false;	
		});
		$(document).on("click",".item-toolbar-holder .ui-icon-action" ,function(e){
			var p = $(this).parent();
			var name = p.find(".list-item-name").text();
			var id = p.find(".list-item-name").attr("listid");
			
			$.post( "./Rest/get.php", {
					id:id,
					name:name,
					col:"password"
				},
				function(data){
					Get(name,id,"username",p);
					navigator.clipboard.writeText(data).then(function() {
						console.log('Async: Copying to clipboard was successful!');
						p.find(".list-item-password").html("Şifre kopyalandı.");
					}, function(err) {
						console.error('Async: Could not copy text: ', err);
					});
				},
				"text"
			);
			
			return false;	
		});
		$(document).on("click",".item-toolbar-holder .ui-icon-edit" ,function(e){
			var p = $(this).parent();
			var id = p.find(".list-item-name").attr("listid");
			var name = p.find(".list-item-name").text();
			var h = p.find(".list-item-edit-holder");
			if(h.html()!=""){
				h.html("");
				h.css("display","none");
				return false;
			}
			$(".list-item-edit-holder").html("");
			$(".list-item-edit-holder").css("display","none");
			Get(name,id,"all",h);
			return false;
				
		});
		$(document).on("click","#list-edit-refresh" ,function(e){
			var p = $(this).parent();
			p.find(".list-edit-password").val(randomize(16,"simple") );
			return false;	
		});
		$(document).on("click","#list-edit-button" ,function(e){
			var p = $(this).parent();
			Update(p);
			return false;	
		});
		
    $( "#list-content" ).sortable();
		/*
			$(document).on("sortable","#list-content" ,{
				revert: true
			});
			$(document).on("draggable",".list-item" ,{
				cursor: 'move',
				helper: 'clone'
			});
			$(document).on("draggable","#list-content" ,{
				drop: function(event, ui) {
					var itemid = $(event.originalEvent.toElement).attr("itemid");
					
					$('.list-item').each(function() {
						if ($(this).attr("itemid") === itemid) {
							$(this).appendTo("#list-content");
						}
					});
				
				}
			});
			$("#list-conten2").droppable({
				drop: function(event, ui) {
					var itemid = $(event.originalEvent.toElement).attr("itemid");
					$('.list-item').each(function() {
						if ($(this).attr("itemid") === itemid) {
							$(this).appendTo("#list-conten2");
						}
					});
				}
			});
			/*
			$( "#list-content2" ).disableSelection();	
	
			$( function() {
				$( "#list-content2" ).sortable({
						tolerance: "intersect",
						helper: 'clone',
						forceHelperSize: true,
						dropOnEmpty: false,
						opacity:0.9
				});
				$( "#list-content2" ).disableSelection();
			} );*/
			/*
			$( ".list-item" ).draggable({
				connectToSortable: "#list-content2",
				helper: "clone",
				revert: "invalid"
			});
			$( "ul, li" ).disableSelection();
			
			$('.list-item2').draggable({
					cursor: 'move',
					helper: "clone"
			});
		*/
	//		Page load Controller
		var pTimer = null;
		$(window).load(function(){
			controlPages();
		});
		window.addEventListener('hashchange', function() {
			controlPages();
		});
		function controlPages(){
			var url = location.href;
			var urlPart = url.split("/pssrmndr/");
			if(urlPart.length!=2){
				return false;
			}
			$("#list-add-password").val(randomize(16,"simple"));
			var page = urlPart[1];
			if(page=="#list"){
				List();
			}
			if(page=="#login"||page=="#register"||page==""){
				console.log(getCookie("Token"));
				if(getCookie("Token")){
					location.href = "#list";
				}
			}
				
		}
	//		DB functions
		function List(){
			console.log("list");
			clearTimeout(this.pTimer);
			this.pTimer = setTimeout(function() {
				$.post( "./Rest/list.php", {},
					function(data){
						console.log("listresult");
						$("#list-content").html(data);
					},
					"text"
				);
			}, 500);
		}
		function Add(){
			console.log("add");
			var site = $("#list-add-sitename").val();
			var user = $("#list-add-username").val();
			var pass = $("#list-add-password").val();
			var link = $("#list-add-link").val();
			var info = $("#list-add-info").val();
			if( site == "" ) return false;
			
			$.post( "./Rest/add.php", {
					site: site,
					user: user,
					pass: pass,
					link: link,
					info: info
				},
				function(data){
					console.log(data);
					$("#list-add-info").val("");
					$("#list-add-username").val("");
					$("#list-add-password").val(randomize(16,"simple"));
					List();
				},
				"text"
			);
			
		}
		function Update(p){
			console.log("add");
			var id = p.attr("listid");
			var oldsite = p.attr("oldsite");
			var site = p.find(".list-edit-sitename").val();
			var user = p.find(".list-edit-username").val();
			var pass = p.find(".list-edit-password").val();
			var link = p.find(".list-edit-link").val();
			var info = p.find(".list-edit-info").val();
			if( pass == "" || site == "" ) return false;
			
			console.log("id: "+id);
			console.log("site: "+site);
			console.log("user: "+user);
			console.log("pass: "+pass);
			console.log("link: "+link);
			console.log("info: "+info);
			
			$.post( "./Rest/update.php", {
					id: id,
					oldsite: oldsite,
					site: site,
					user: user,
					pass: pass,
					link: link,
					info: info
				},
				function(data){
					//p.html("");
					//p.css("display","none");
					console.log(data);
					if(data=="error") alert("hata");
					else if(data=="ok")	List();
				},
				"text"
			);
			
		}
		function Delete(name,id){
			$.post( "./Rest/delete.php", {
					name:name,
					id:id
				},
				function(data){
					console.log(data);
					List();
				},
				"text"
			);
		}
		function Pass(name,id,obj){
			$.post( "./Rest/get.php", {
					id:id,
					name:name,
					col:"password"
				},
				function(data){
					console.log(data);
					if(obj.is("input")){
						obj.val(data);
					} else {
						obj.html(data);
					}
					//console.log(jQuery.type( obj ));
				},
				"text"
			);
		}
		function Get(name,id,col,obj){
			$.post( "./Rest/get.php", {
					id:id,
					name:name,
					col:col
				},
				function(data){
					//console.log(data);
					switch(col){
						case "both":
							var pair = data.split("|");
							updateGetData(obj.find(".list-item-username"),pair[0]);
							updateGetData(obj.find(".list-item-password"),pair[1]);
							break;
						case "all":
							updateGetData(obj,data);
							obj.css("display","block");
							break;
						case "username":
							updateGetData(obj.find(".list-item-username"),data);
							break;
						case "password":
							updateGetData(obj.find(".list-item-password"),data);
							break;
						default:
							break;
					}
					
					//console.log(jQuery.type( obj ));
				},
				"text"
			);
		}
		function updateGetData(obj,data){
			if(obj.is("input"))	obj.val(data);
			else obj.html(data);
		}
	
	//    Cookies   
		function delCookie(cname){
			setCookie(cname, 0, 0);
		}
		function setCookie(cname, cvalue, exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			var expires = "expires="+d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}
		function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
							c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
							return c.substring(name.length, c.length);
					}
			}
			return false;
		}
		
		function randomize(size,options) {
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			
			if(options=="simple"){
				possible += "!?&()[]{}";
			} else if(options=="advanced"){
				possible += "!?&()[]{}<>é'#+-_$%*.,;:";
			} 
			
			for (var i = 0; i < size; i++)
				text += possible.charAt(Math.floor(Math.random() * possible.length));
			
			return text;
		}
});