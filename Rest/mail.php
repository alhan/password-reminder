<?php

require_once '../inc/mailer.php';

$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['info@pixel-ware.com' => 'Pixel Ware'])
  ->setTo(['alhanozdemir@gmail.com' => 'A name'])
  ->setBody('Here is <b>the</b> message itself');
$result = $mailer->send($message);

?>
