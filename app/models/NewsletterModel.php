<?php
require_once 'app/services/EmailService.php' ;
require_once 'app/core/Model.php';
require_once 'logs/logError.php';

class NewsletterModel extends EmailSender{
    
    public function sendNewsletter($toEmail,$htmlContent){ 
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_newsletter'])) {
            
        $fromEmail = EMAIL_NEWS;
        $fromName = FROM_NAME;
        $subject = 'Welcome to Mario\'s Blog';
        // Validate email
        if (filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
    
            // Check if the email already exists in the database
            $sql = "SELECT email FROM newsletter WHERE email = :email";
            if ($stmt = $this->connect->prepare($sql)) {
                $stmt->bindParam(':email', $toEmail);
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        return false; //emailul exista,nu mai e nevoie de inca o abonare
                    }
                } else {
                    logError("Failed to execute email check query.", __FILE__, __LINE__);
                    
                }
            } else {
                logError("Failed to prepare email check query.", __FILE__, __LINE__);
                
            }
    
            // If no errors, insert the email into the database
            if (empty($emailError)) {
                $sql = "INSERT INTO newsletter (email) VALUES (:email)";
                if ($stmt = $this->connect->prepare($sql)) {
                    $stmt->bindParam(':email', $toEmail);
                    if ($stmt->execute()) {
                        if ($this->sendEmail($fromEmail, $fromName, $toEmail, $subject, $htmlContent)) {
                           return true; 
                        } else {
                          return false;
                        }
                        
                    } else {
                        logError("Failed to execute email insert query.", __FILE__, __LINE__);  
                        return false;       
                    }
                } else {
                    logError("Failed to prepare email insert query.", __FILE__, __LINE__);
                    
                }
            }
        }
    }
}
}
