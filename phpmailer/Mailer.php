<?php

require ROOT . '/phpmailer/PHPMailer.php';
require ROOT . '/phpmailer/SMTP.php';
require ROOT . '/phpmailer/Exception.php';
//require ROOT . '/phpmailer/config.php';

class Mailer
{
    public static function sendConfirm($email, $hash)
    {
        require ROOT . '/phpmailer/config.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->isSMTP();   
        $mail->CharSet    = $__smtp['charset'];                                          
        $mail->SMTPAuth   = $__smtp['SMTPAuth'];

        $mail->Host       = $__smtp['host'];
        $mail->Username   = $__smtp['username'];
        $mail->Password   = $__smtp['password'];
        $mail->SMTPSecure = $__smtp['SMTPSecure'];
        $mail->Port       = $__smtp['port'];
        $mail->setFrom($__smtp['setFrom']['email'], $__smtp['setFrom']['name']);
        $mail->isHTML($__smtp['isHTML']);

        $mail->addAddress($email);

        $mail->Subject = 'Confirm the email';
        $mail->Body    = "
            For confirm your email check this link:<br>
            http://forum_mvc.loc:8080/confirm/$hash
        ";

        if ($mail->send()) {
            header("Location: /login");
        }
    }

    public static function sendNotificate($email, $postId)
    {
        require ROOT . '/phpmailer/config.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->isSMTP();   
        $mail->CharSet    = $__smtp['charset'];                                          
        $mail->SMTPAuth   = $__smtp['SMTPAuth'];

        $mail->Host       = $__smtp['host'];
        $mail->Username   = $__smtp['username'];
        $mail->Password   = $__smtp['password'];
        $mail->SMTPSecure = $__smtp['SMTPSecure'];
        $mail->Port       = $__smtp['port'];
        $mail->setFrom($__smtp['setFrom']['email'], $__smtp['setFrom']['name']);
        $mail->isHTML($__smtp['isHTML']);

        $mail->addAddress($email);

        $mail->Subject = 'There is a comment in your post!';
        $mail->Body    = "
            Someone has written a comment in your post. Check this comment below<br>
            http://forum_mvc.loc:8080/post/$postId
        ";

        $mail->send();
    }
}