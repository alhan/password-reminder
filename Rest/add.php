<?
	include("../inc/isLogin.php");

	if( !isset($_POST["site"]) || !isset($_POST["user"]) || !isset($_POST["pass"]) || !isset($_POST["link"]) || !isset($_POST["info"]) ) die("error");
	$site = $_POST["site"];
	$user = $_POST["user"];
	$pass = $_POST["pass"];
	$link = $_POST["link"];
	$info = $_POST["info"];
	
	$contentStr = $site."|".$user."|".$pass."|".$link."|".$info;
	$contentResult = "\r\n".encrypt($contentStr);
	
	file_put_contents($Path, $contentResult, FILE_APPEND);
	
	die("ok");
	
?>