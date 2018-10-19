<?
	if( !isset($_POST["email"]) ) die("error");
	else $email = $_POST["email"];
	if( !isset($_POST["pass"]) ) die("error");
	else $pass = $_POST["pass"];
	if($pass != $_POST["pass2"]) die("error");
	
	include("../inc/global.php");
	
	$path = "../db/".getMD5($email.ENCRYPTION_SALT.$pass);
	
	if( file_exists($path) ) die("exist");
	
	file_put_contents($path, "unregistered");
	
	die("Aktivasyon kodu için Email adresinizi kontrol edin!");
	
?>