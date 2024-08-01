<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'email/src/Exception.php';
require 'email/src/PHPMailer.php';
require 'email/src/SMTP.php';


class EmailSender extends Model
{
    private $mail;

    public function __construct()
    {
        parent::__construct();
        $this->mail = new PHPMailer(true);
        $this->setupSMTP();
    }
    
    private function setupSMTP()
    {
        try {
                $this->mail->SMTPDebug = 0;
                $this->mail->isSMTP();
                $this->mail->Host       = 'smtp.gmail.com';
                $this->mail->SMTPAuth   = true;
                $this->mail->Username   = EMAIL;
                $this->mail->Password   = EMAIL_PASS;
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $this->mail->Port       = 587;


        } catch (Exception $e) {
            error_log("SMTP setup failed: {$e->getMessage()}");
            exit();
        }
    }

    public function sendEmail($fromEmail, $fromName, $toEmail, $subject, $htmlContent)
    {
        try {
            $this->mail->setFrom($fromEmail, $fromName);
            $this->mail->addAddress($toEmail);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $htmlContent;
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
            return false;
        }
    }
}
