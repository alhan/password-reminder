<?	
	if(!isset($_COOKIE['Token'])) die("error");
	else $token = $_COOKIE['Token'];
	
	include_once("global.php");
	
	$UserKey = openssl_decrypt($token,'BF-ECB',ENCRYPTION_KEY);
	$Path = "../db/".getMD5($UserKey);
	
	if( !file_exists($Path) ) die("error");
?>