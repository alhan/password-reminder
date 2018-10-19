<?
	if( !isset($_POST["email"]) ) die("error");
	else $email = $_POST["email"];
	if( !isset($_POST["pass"]) ) die("error");
	else $pass = $_POST["pass"];
	if($pass != $_POST["pass2"]) die("error");
	
	include("../inc/global.php");
	
	$path = "../db/".getMD5($email.ENCRYPTION_SALT.$pass);
	
	if( file_exists($path) ) die("exist");
	$registerKey = generatekey(32);
	file_put_contents($path, "unregistered|".$registerKey);

	require_once '../inc/mailer.php';
	
	$messageContent = "Activation Link\n";
	$messageContent .= "https://www.pixel-ware.com/pssrmndr/?activation=".$registerKey."#activation";
	
	$message = (new Swift_Message('Password Reminder Activation'))
		->setFrom(['info@pixel-ware.com' => 'Pixel Ware'])
		->setTo([ $email ])
		->setBody($messageContent);
	$result = $mailer->send($message);

	
	die("Aktivasyon kodu için Email adresinizi kontrol edin!");
	
?>