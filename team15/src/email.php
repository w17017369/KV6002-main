<?php

/**
 * A function that provides ways of sending email using PHPMailer
 * through a secure contact form
 *
 * @author MARTINA PANI w19020174
 */

use PHPMailer\PHPMailer\PHPMailer;

function email($input)
{
    include 'functions.php';
    include 'config/config.php';
    //Loading PHPMailer
    require 'vendor/autoload.php';

    try {
            //Create a new PHPMailer instance and set it to use sendemail transport
            $mail = new PHPMailer();
            $mail->isSendmail();
            //Check if the user entered all required fields and validate the email address used
            checkContact($input);
            //Set who the message is to be sent from
            $mail->setFrom($input['email'], $input['fullname']);
            //Set a reply-to header with the submitter's email address
            $mail->addReplyTo($input['email'], $input['fullname']);
            //Set who the message is to be sent to
            $mail->addAddress(SUPPORT_EMAIL);
            //Set the subject line and email's body content
            $mail->Subject = $input['subject'];
            $mail->Body = $input['message'];

            //send the message, check for errors
        if (!$mail->send()) {
            throw new Exception('Mailer Error: ' . $mail->ErrorInfo);
        }
    } catch (Exception $e) {
        return "<p>" . $e->getMessage() . "</p>";
    }
        return "Thank you for contacting us. We will reply as soon as possible";
}
