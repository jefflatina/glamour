<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email, $booking_id, $lastname)
    {
        require('PHPMailer/PHPMailer.php');
        require('PHPMailer/SMTP.php');
        require('PHPMailer/Exception.php');

        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'glamourovrthink@gmail.com';                     //SMTP username
            $mail->Password   = 'jvofvivishbsicdj';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
        
            //Recipients
            $mail->setFrom('glamourovrthink@gmail.com', 'Glamour');
            $mail->addAddress($email);     //Add a recipient
            //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
        
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Glamour: Payment Declined for Fullpayment | Request to Retry Billing';
            $mail->Body    = "
            <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>
            
            <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>

            <p style='color: #fff;'>
                <em>Dear Mr./Ms. $lastname,<em>
            </p>

            <p style='color: #fff;'>
            I hope this email finds you well. I am writing to inform you about a recent 
            development regarding the fullpayment for your upcoming event, and I kindly 
            request your attention to rectify the matter.<br><br>
            </p>

            <p style='color: #fff;'>
            Upon processing the payment for the fullpayment, we encountered an issue, 
            and the transaction was declined. This could be due to various reasons, such as 
            insufficient funds, an expired card, or an issue with the payment gateway.<br><br>
            </p>

            <p style='color: #fff;'>
            To ensure the smooth progress of the event planning and management process, I kindly 
            request you to retry the billing of the fullpayment. I have attached the same payment 
            form that you previously received for your convenience. Please review the form and 
            provide the necessary payment details.<br><br>
            </p>

            <p style='color: #fff;'>
            Please note that it is crucial to resolve this matter promptly so that we can proceed 
            with the planning and finalize the necessary arrangements. We highly value your partnership 
            and are committed to delivering a successful and memorable event.<br><br>
            </p>

            <p style='color: #fff;'>
            If you require any assistance or have any questions regarding the payment process or any 
            other aspect of the event, please feel free to reach out to me directly. I am here to assist
             you and provide any support you may need.<br><br>
            </p>

            <p style='color: #fff;'>
            Thank you for your understanding and cooperation. We look forward to receiving your updated payment 
            details at your earliest convenience.<br><br>
            </p>


            <p style='color: #fff;'>
                <em>
                Best regards, <br>
                Glamour Events
                </em> <br>
            </p>

            </body>
            ";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            //echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    if(isset($_GET['fpdeclineid']) && isset($_GET['billing']) ){
        $id = $_GET['fpdeclineid'];
        $billing = $_GET['billing'];
        $select = "UPDATE billing SET fpstatus = 'Declined' WHERE id = '$id' ";
        $billingresult = mysqli_query($connection,$select);

        $query = "SELECT * FROM billing WHERE billing_id = '$billing' ";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if($result){
            if($row > 0){
                $email = $row['email'];
                $booking_id = $row['booking_id'];
                $lastname =  $row['lastname'];
        
            }
        }

        if($select){
            if(sendMail($email, $booking_id, $lastname)){
                ?><script type="text/javascript">
                            alert('Billing declined email has succesfully sent');
                            </script>
                            <?php 
                            echo "<script>document.location='admin-billing.php';</script>";
            }
            
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
    }

?>