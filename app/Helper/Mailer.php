<?php

namespace App\Helper;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer {
    private static $mail;

    function __construct() {
        self::$mail = new PHPMailer(true);

        self::$mail->SMTPDebug = 0;
        self::$mail->isSMTP();
        self::$mail->Host = SMTP_SERVER;
        self::$mail->Port = SMTP_PORT;
        self::$mail->SMTPAuth = true;
        self::$mail->Username = SMTP_EMAIL;
        self::$mail->Password = SMTP_PASS;
        if (SMTP_SSL || SMTP_TLS) {
            self::$mail->SMTPSecure = SMTP_SSL ? 'ssl' : 'tls';
        } else {
            self::$mail->SMTPAutoTLS = false;
            self::$mail->SMTPSecure = '';
        }

        self::$mail->addReplyTo('no-reply@itssat.edu.mx', 'SYCPROF System Mailer');
        self::$mail->setFrom('info@itssat.edu.mx', 'SYCPROF System Mailer');
    }

    public function addAddress($email, $name = '') {
        if(!empty($name))
            self::$mail->addAddress($email, $name);
        else
            self::$mail->addAddress($email);
    }

    public function addCCAddress($email, $name = '') {
        if(!empty($name))
            self::$mail->addCC($email, $name);
        else
            self::$mail->addCC($email);
    }

    public function addBCCAddress($email, $name = '') {
        if(!empty($name))
            self::$mail->addBCC($email, $name);
        else
            self::$mail->addBCC($email);
    }

    public function addAttachment($file, $name = '') {
        if(!empty($name))
            self::$mail->addAttachment($file, $name);
        else
            self::$mail->addAttachment($file);
    }

    public function addSubject($subject) {
        self::$mail->Subject = $subject;
    }

    public function addBody($text) {
        self::$mail->Body = $text;
    }

    public function sendMail() {
        self::$mail->isHTML(true);

        try {
            self::$mail->send();
        } catch (\Exception $e) {
            throw new \Exception("El mensaje no se ha enviado. Error: " . $e->getMessage());
        }
    }

    public static function sendFastMail($address, $subject, $body, $attachments = []) {
        try {
            $mail = new Mailer();

            $mail->addAddress($address);
            $mail->addSubject($subject);
            $mail->addBody($body);
            if (count($attachments) > 0)
                foreach ($attachments as $name => $file)
                    $mail->addAttachment($file, $name);

            $mail->sendMail();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}