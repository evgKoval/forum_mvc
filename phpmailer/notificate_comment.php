<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();


$msg = "ok";
$mail->isSMTP();   
$mail->CharSet = "UTF-8";                                          
$mail->SMTPAuth   = true;
// Настройки вашей почты
$mail->Host       = 'smtp.gmail.com';
$mail->Username   = 'ekovalwork';
$mail->Password   = 'lovkacok123PRO';
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;
$mail->setFrom('ekovalwork@gmail.com', 'Евгений Коваль');

$mail->addAddress($authorEmail);


$mail->isHTML(true);

$mail->Subject = 'There is a comment in your post!';
$mail->Body    = "
    Someone has written a comment in your post. Check this comment below<br>
    http://forum_mvc.loc:8080/post/$postId
";

var_dump($mail->send());