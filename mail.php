<?php

include("config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception;


if(isset($_POST['submit']))
{

require('PHPMailer/PHPMailer.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/Exception.php');


    $fileTmpPath = $_FILES['attach']['tmp_name'];
    $fileName = $_FILES['attach']['name'];

$mail = new PHPMailer(true);

    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $inquiry = $_POST['inquiry'];
    $other = $_POST['other'];
    $event = $_POST['event'];
    $idnum = $_POST['idnum'];
    $message = $_POST['message'];
   

    $subject = "Contact Inquiry";

    try{
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'glamourovrthink@gmail.com';                     //SMTP username
        $mail->Password   = 'jvofvivishbsicdj';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

        $mail->setFrom($email);
        $mail->addAddress('glamourovrthink@gmail.com');     //Add a recipient

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Customer Inquiry from '.$fullname;
        $mail->Body    = "
        <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>
            
        <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>

        <p style='color: #fff;'>
            <span style='color: #FED586;'>Full Name: </span>$fullname <br> 
            <span style='color: #FED586; text-decoration: none;'>Email Address: </span>$email <br> 
            <span style='color: #FED586;'>Inquiry Category: </span>$inquiry <br>
            <span style='color: #FED586;'>Other: </span>$other <br>
            <span style='color: #FED586;'>Event: </span>$event <br>
            <span style='color: #FED586;'>Booking/Payment ID: </span>$idnum <br><br>
            <span style='color: #FED586;'>Message: </span><br> $message
        </p>
        <br><br>
        </body>
        ";
        $mail->addAttachment($fileTmpPath, $fileName);

        $mail->send();
        ?><script type="text/javascript">
                            alert('Message has been sent.');
                            window.location.href='contact-logged.php';
                            </script>
                            <?php 
                            
        

    } catch (exception $e) {
        
        ?><script type="text/javascript">
                            alert('Mail has not been sent due to some unknown reason.');
                            window.location.href='contact-logged.php';
                            </script>
                            <?php 
                            
    }
} 
 

?>