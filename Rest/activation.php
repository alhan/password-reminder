<?	
	if( !isset($_POST["email"]) ) die("error");
	else $email = $_POST["email"];
	if( !isset($_POST["pass"]) ) die("error");
	else $pass = $_POST["pass"];
	if( !isset($_POST["token"]) ) die("error");
	else $activationToken = $_POST["token"];
	if( !isset($_POST["expire"]) ) $expire = 3600;
	else $expire = intval($_POST["expire"]);
	
	include("../inc/global.php");
	
	$userInfo = $email.ENCRYPTION_SALT.$pass;
	
	$path = "../db/".getMD5($userInfo);
	
	if( !file_exists($path) ) die("error");
	
	$content = file_get_contents($path);
	$contentArr = explode("\r\n", $content);
	$isRegisterArr = explode("|", $contentArr[0]);
	
	if($isRegisterArr[1]==$activationToken){
		file_put_contents($path, "");
		$encrypted = openssl_encrypt($userInfo, 'BF-ECB', ENCRYPTION_KEY); 
		
		$c = setcookie("Token", $encrypted, time()+$expire,"/pssrmndr/");
		
		die($encrypted);
		
	} else {
		die("Activation Error:".$isRegisterArr[1].":".$activationToken);
	}
?>