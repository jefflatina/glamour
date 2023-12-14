
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
            $mail->Subject = 'Glamour: Event Booking and Fullpayment Billing Confirmation!';
            $mail->Body    = "
            <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>
            
            <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>

            <p style='color: #fff;'>
                <em>Dear Mr./Ms. $lastname,<em>
            </p>

            <p style='color: #fff;'>
            We are delighted to inform you that your event booking has been confirmed! 
            Your upcoming event is now on process, and 
            we are excited to be make your day a special day.<br><br>
            </p>

            <p style='color: #fff;'>
            Please find the attached receipt for your fullpayment in this <a href='localhost/Glamour/fpreceipt.php?booking_id=$booking_id'><span style='color: #FED586;'>fullpayment receipt link</span></a>. It serves as confirmation of your payment and 
            can be kept for your records. If you have any concerns or questions regarding the receipt or billing, 
            please feel free to reach out to us.<br><br>
            </p>
            
            <p style='color: #fff;'>
            We look forward to making your event a memorable and successful one. Thank you for choosing us as your event partner.<br><br>
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

    if(isset($_GET['fpapproveid']) && isset($_GET['billing']) ){
        $id = $_GET['fpapproveid'];
        $billing = $_GET['billing'];
        $select = "UPDATE billing SET fpstatus = 'Paid' WHERE id = '$id' ";
        $billingresult = mysqli_query($connection, $select);
     
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
                            alert('Billing confirmation email has succesfully sent');
                            </script>
                            <?php 
                            echo "<script>document.location='admin-billing.php';</script>";
            }
            
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
    }

?>