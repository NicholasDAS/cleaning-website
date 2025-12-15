<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// load PHPMailer classes
require __DIR__ . "/PHPMailer/src/PHPMailer.php";
require __DIR__ . "/PHPMailer/src/SMTP.php";
require __DIR__ . "/PHPMailer/src/Exception.php";


function sendEmail($to, $subject, $message) {

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        //  my email to receive the notifications for bookings, contacts etc
        // the google password. 
        // if you want to test this codes you must change this to your own password and email and note, this password is not your usual password. text me on how to do this....
        $mail->Username = "putyouremailhere@gmail.com";  
        $mail->Password = "this is where my email password is";       

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // sender email
        $mail->setFrom("edakinicholas9@gmail.com", "Fabulous Cleaning");

        // recipient
        $mail->addAddress($to);

        // content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true;

    } catch (Exception $e) {
        return "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>