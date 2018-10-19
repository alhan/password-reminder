<?
	require_once '../../../vendor/autoload.php';
	$transport = (new Swift_SmtpTransport('services.pixel-ware.com', 587))
		->setUsername('info@pixel-ware.com')
		->setPassword('D}u8cXjWRQQlJU&T');
	$mailer = new Swift_Mailer($transport);
?>