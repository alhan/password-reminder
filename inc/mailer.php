<?
	require_once '../../../vendor/autoload.php';
	$transport = (new Swift_SmtpTransport('mail.serverhostname.com', 587))
		->setUsername('info@domain.com')
		->setPassword('QQlJUT');
	$mailer = new Swift_Mailer($transport);
?>