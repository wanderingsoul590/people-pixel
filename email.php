<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

function px_mail($to, $subject, $body) {
    $mail = new PHPMailer();

    // Set the mailer to use the PHP mail() function
    $mail->isMail();

    // Set the sender and recipient email addresses
    $mail->setFrom('people@pixelideas.site', 'People - Pixel Ideas');
    $mail->addAddress($to);

    // Set the email subject and body
    $mail->Subject = $subject;
    $mail->Body = $body;

    // Set the content type as HTML
    $mail->isHTML(true);

    // Send the email
    if ($mail->send()) {
        return true; // Email sent successfully
    } else {
        return false; // Email sending failed
    }
}