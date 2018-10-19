<?	
	if( !isset($_POST["email"]) ) die("error");
	else $email = $_POST["email"];
	if( !isset($_POST["pass"]) ) die("error");
	else $pass = $_POST["pass"];
	if( !isset($_POST["expire"]) ) $expire = 3600;
	else $expire = intval($_POST["expire"]);
	
	include("../inc/global.php");
	
	$userInfo = $email.ENCRYPTION_SALT.$pass;
	
	$path = "../db/".getMD5($userInfo);
	
	if( !file_exists($path) ) die("error");
	
	$encrypted = openssl_encrypt($userInfo, 'BF-ECB', ENCRYPTION_KEY); 
	
	$c = setcookie("Token", $encrypted, time()+$expire,"/pssrmndr/");
	
	die($encrypted);
	
?>