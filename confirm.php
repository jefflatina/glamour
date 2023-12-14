<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email, $booking_id, $lastname, $event, $bookdate)
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
            $mail->Subject = 'Glamour: Your Event Booking Has Been Confirmed!';
            $mail->Body    = "
            <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>
            
            <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>

            <p style='color: #fff;'>
                <em>Dear Mr./Ms. $lastname,<em>
            </p>

            <p style='color: #fff;'>
            I hope this email finds you well. I am writing to confirm that we have received your down 
            payment for <span style='color: #FED586;'>$event</span>. Thank you for settling it on time and securing your reservation. 
            We are excited to have you as one of our valued guests.
            </p>

            <p style='color: #fff;'>
            With only a month left before the event, we would like to remind you that the full payment 
            billing form is now available. We kindly ask that you complete the transaction as soon as 
            possible by clicking on the link attached to this email. Please note that the full payment 
            billing form will only be available until one month prior to the event date.<br><br>
            </p>

            <center>
            <a href='localhost/Glamour/fpbilling.php'
            style='background: #FED586; padding: 10px; color: black; font-weight: bolder; 
            font-family: Judson; text-decoration: none; border-radius: 5px;'>FULLPAYMENT BILLING LINK</a><br><br>
            </center> 

            <p style='color: #fff;'>
            Kindly take note that no cancellations and change of details will be allowed at this point. 
            We hope for your understanding on this matter as we need to finalize everything for the event.<br><br>

            In case you have any questions or concerns about the full payment or the transaction process, 
            please don't hesitate to reach out to us. We are always ready to assist you in any way we can.<br><br>
            
            Thank you for choosing Glamour. We look forward to seeing you at the event.<br><br>
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

    if(isset($_GET['confirmid']) && isset($_GET['booking'])){
        $id = $_GET['confirmid'];
        $booking = $_GET['booking'];
        $select = "UPDATE booking SET status = 'confirmed' WHERE id = '$id' ";
        $bookingresult = mysqli_query($connection,$select);

        $query = "SELECT * FROM booking WHERE booking_id = '$booking'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if($result){
            if($row > 0){
                $emailadd =  $row['emailadd'];
                $booking_id =  $row['booking_id'];
                $lastname =  $row['lastname'];
                $event =  $row['event'];
                $bookdate =  $row['bookdate'];

            }
        }

        if($select){
            if(sendMail($emailadd, $booking_id, $lastname, $event, $bookdate)){
                ?><script type="text/javascript">
                            alert('Email has succesfully sent');
                            </script>
                            <?php 
                            echo "<script>document.location='admin-bookinglist.php';</script>";
            }
            
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
    }

?>