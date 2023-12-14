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
            $invoicefile = 'Glamour/dpinvoice.php';
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Glamour: Event Booking and Downpayment Billing Confirmation!';
            $mail->Body    = "
            <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>
            
            <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>

            <p style='color: #fff;'>
                <em>Dear Mr./Ms. $lastname,<em>
            </p>

            <p style='color: #fff;'>
            We are delighted to inform you that your event booking slot has been successfully secured! 
            Your upcoming event is now confirmed, and 
            we are excited to be a part of your special occasion.<br><br>
            </p>

            <p style='color: #fff;'>
            Your downpayment billing has been processed and we have received the payment. Thank you for 
            making the initial downpayment to reserve your event slot. This downpayment amount will be 
            deducted from the total event cost. To proceed with the full payment for your event, please 
            follow the link below to access the full payment billing form: <br><br>
            </p>

            <center>
            <a href='localhost/Glamour/fpbilling.php?booking_id=$booking_id'
            style='background: #FED586; padding: 10px; color: black; font-weight: bolder; 
            font-family: Judson; text-decoration: none; border-radius: 5px;'>FULLPAYMENT BILLING LINK</a><br><br>
            </center> 

            <p style='color: #fff;'>
            Please find the attached receipt for your <a href='localhost/Glamour/dpreceipt.php?booking_id=$booking_id'><span style='color: #FED586;'>downpayment receipt link </span></a>here. It serves as confirmation of your payment and 
            can be kept for your records. If you have any concerns or questions regarding the receipt or billing, 
            please feel free to reach out to us.<br><br>
            
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

    if(isset($_GET['dpapproveid']) && isset($_GET['billing']) ){
        $id = $_GET['dpapproveid'];
        $billing = $_GET['billing'];
        $select = "UPDATE billing SET dpstatus = 'Paid' WHERE id = '$id' ";
        $billingresult = mysqli_query($connection,$select);

        // Update the booking table
        $updateBooking = "UPDATE booking SET status = 'confirmed' WHERE booking_id = (SELECT booking_id FROM billing WHERE id = '$id')";
        $bookingResult = mysqli_query($connection, $updateBooking);

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