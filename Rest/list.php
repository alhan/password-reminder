<?	
	include("../inc/isLogin.php");
	
	$content = file_get_contents($Path);
	$contentArr = explode("\r\n", $content);
	
	//if( !isset($_POST["showcol"]) ) $showcol = 1;
	//else $showcol = intval($_POST["showcol"]);
	
	$result = "";
	for($i=1;$i<count($contentArr);$i++){
		$itemStr = decrypt($contentArr[$i]);
		$itemArr = explode("|", $itemStr);
		
		$cls = "";
		if( $i==1 ) $cls = "ui-first-child";
		else if($i==count($contentArr)-1) $cls = " ui-last-child";
		else if(count($contentArr)==2) $cls = "ui-first-child ui-last-child";
		
		$result .= addContent($itemArr[0],$cls,$i);
		
	}
	//$result .='<script>$( "#list-content" ).sortable( "refresh" );</script>';
	//$result .='<script>$( "#list-content" ).sortable({ revert: true  });$( "#list-content" ).disableSelection();</script>';
	die($result);
	function addContent($info, $cls,$id){
		$result = "";
		$result .='<li itemid="'.$id.'" class="list-item ui-li-static ui-body-inherit '.$cls.'"><div class="ui-nodisc-icon item-toolbar-holder">';
		$result .='<div class="list-item-content"><div class="list-item-name" listid="'.$id.'">'.$info.'</div>';
		$result .='<div class="list-item-username">'.'</div><div class="list-item-password"></div></div>';
		$result .='<a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-action ui-btn-icon-notext ui-btn-inline">Copy</a>';
		$result .='<a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-eye ui-btn-icon-notext ui-btn-inline">View</a>';
		$result .='<a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext ui-btn-inline">Edit</a>';
		$result .='<a href="#popupDialog" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-inline" data-rel="popup" data-position-to="window" data-transition="pop">Delete</a>';
		$result .='<div class="list-item-edit-holder"></div>';
		$result .='</div></li>';
		return $result;
	}
?>
