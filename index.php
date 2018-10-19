<?
	header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', FALSE);
	header('Pragma: no-cache');
  $srcBase = "/src";
  
	if( !isset($_REQUEST["activation"]) )  $activationToken = "";
	else $activationToken = $_REQUEST["activation"];
?>

<!doctype html>
<html>
<head>
	<title>Hatırla</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?=$srcBase?>/jquery-ui/jquery-ui.min.css" />
	<link rel="stylesheet" href="<?=$srcBase?>/jquery.mobile/themes/custom.min.css" />
	<link rel="stylesheet" href="<?=$srcBase?>/jquery.mobile/themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="<?=$srcBase?>/jquery.mobile/jquery.mobile.structure-1.4.5.min.css">
	<script src="<?=$srcBase?>/jquery-2.2.0.min.js"></script>
	<script src="<?=$srcBase?>/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
	<script src="<?=$srcBase?>/jquery-ui/jquery-ui.min.js"></script>
	<link href="./src/index.css?v=<?=rand(100,10000)?>" rel="stylesheet" />
	<script src="./src/index.js?v=<?=rand(100,10000)?>"></script>
</head>
<body>
	<div data-role="page" id="login" class="page">
			<header data-role="header">
					<h1>Şifre Hatırlatıcı</h1>
			</header><!-- /header -->
			<div role="main" class="ui-content">
				<form id="form-login">
					<div class="form-line">
						<label for="input-email">Email:</label>
						<input type="email" data-clear-btn="true" name="input-email" id="input-email" value="a@b.com" />
					</div>
					<div class="form-line">
						<label for="input-pass">Pass:</label>
						<input type="password" data-clear-btn="true" name="input-pass" id="input-pass" value="123" />
					</div>
					<button class="ui-btn" id="button-login">Login</button>
				</form>
			</div><!-- /content -->
			<footer data-role="footer">
					<a href="mailto:alhanozdemir@gmail.com" data-mini="true">contact me</a>
					<a href="#register" data-mini="true">Kayıt Olun</a>
			</footer><!-- /footer -->
	
	</div>
  
	<div data-role="page" id="activation" class="page">
			<header data-role="header">
					<h1>Yeni Kullanıcı Aktivasyonu</h1>
			</header><!-- /header -->
			<div role="main" class="ui-content">
				<form id="form-activation">
					<div class="form-line">
						<label for="input-act-email">Email:</label>
						<input type="email" data-clear-btn="true" name="input-act-email" id="input-act-email" value="a@b.com" />
					</div>
					<div class="form-line">
						<label for="input-act-pass">Pass:</label>
						<input type="password" data-clear-btn="true" name="input-act-pass" id="input-act-pass" value="123" />
					</div>
					<div class="form-line">
						<label for="input-act-token">Activate<br>Token:</label>
						<input type="text" data-clear-btn="true" name="input-act-token" id="input-act-token" value="<?=$activationToken?>" />
					</div>
					<button class="ui-btn" id="button-activation">Activate</button>
				</form>
			</div><!-- /content -->
			<footer data-role="footer">
					<a href="mailto:alhanozdemir@gmail.com" data-mini="true">contact me</a>
			</footer><!-- /footer -->
	
	</div>
	<div data-role="page" id="register" class="page">
			<header data-role="header">
					<h1>Kullanıcı Kayıt</h1>
			</header><!-- /header -->
			<div role="main" class="ui-content">
				<form id="form-register">
					<div class="form-line">
						<label for="input-reg-email">Email:</label>
						<input type="email" data-clear-btn="true" name="input-reg-email" id="input-reg-email" value="" />
					</div>
					<div class="form-line">
						<label for="input-reg-pass">Pass:</label>
						<input type="password" data-clear-btn="true" name="input-reg-pass" id="input-reg-pass" value="" />
					</div>
					<div class="form-line">
						<label for="input-reg-pass2">Pass:</label>
						<input type="password" data-clear-btn="true" name="input-reg-pass2" id="input-reg-pass2" value="" />
					</div>
					<button class="ui-btn" id="button-register">Register</button>
				</form>
			</div><!-- /content -->
			<footer data-role="footer">
					<a href="mailto:alhanozdemir@gmail.com" data-mini="true">contact me</a>
					<a href="#login" data-mini="true">Giriş Yapın</a>
			</footer><!-- /footer -->
	
	</div>
	
	<div data-role="page" id="list" class="page">
			<header data-role="header">
					<h1>Şifre Hatırlatıcı</h1>
					<a id="list-logout-button" href="#" class="ui-shadow-icon ui-btn ui-btn-right ui-icon-delete ui-btn-icon-right"></a>
			</header><!-- /header -->
			
			<div role="main" class="ui-content">
				<ul id="list-content" data-role="listview" data-filter="true" data-filter-placeholder="Ara.." data-inset="true">
				</ul>
				<div id="list-add-item-holder" data-role="collapsible">
					<h4>Ekle</h4>
					<div data-role="controlgroup" data-type="vertical" class="list-add-item-holder">
						<input type="text" data-clear-btn="true" name="list-add-sitename" id="list-add-sitename" data-wrapper-class="ui-btn controlgroup-textinput list-add-input" value="" placeholder="Site Name">

						<input type="text" data-clear-btn="true" name="list-add-username" id="list-add-username" data-wrapper-class="ui-btn controlgroup-textinput list-add-input" value="" placeholder="User Name">
						<input type="text" data-clear-btn="false" name="list-add-password" id="list-add-password"  data-wrapper-class="ui-btn ui-btn-inline controlgroup-textinput list-add-input" value="" placeholder="Password">
						<a href="#" id="list-add-refresh" class="ui-btn ui-btn-inline ui-shadow ui-corner-all ui-icon-refresh ui-btn-icon-notext ui-btn-inline">refresh</a>

						<input type="text" data-clear-btn="true" name="list-add-link" id="list-add-link" data-wrapper-class="ui-btn controlgroup-textinput list-add-input" value="" placeholder="Link">
						<textarea type="text" name="list-add-info" id="list-add-info" data-wrapper-class="ui-btn controlgroup-textarea list-add-input" value="" placeholder="Information"></textarea>
						<button id="list-add-button">Ekle</button>
					</div>
				</div>
				
			</div><!-- /content -->
			
			<footer data-role="footer">
					<a href="mailto:alhanozdemir@gmail.com" data-mini="true">contact me</a>
					<button id="list-update" style="display:none;">Güncelle</button>
			</footer><!-- /footer -->
			
			<div data-role="popup" id="popupDialog" data-overlay-theme="a" data-theme="a" data-dismissible="false" style="max-width:400px;">
				<div data-role="header" data-theme="a">
					<h1>Silme Onayı!</h1>
				</div>
				<div role="main" class="ui-content">
					<h3 class="ui-title">Girişi silmek istediğine emin misin?</h3>
					<p>Kesinlikle geri alınamayan işlem!</p>
					<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back">İptal</a>
					<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-rel="back" data-transition="flow" id="list-item-delete-button">Sil</a>
				</div>
			</div>
	</div>
</body>
</html>