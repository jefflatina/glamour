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
            $mail->Subject = 'Glamour: Event Confirmation and Full Details';
            $mail->Body    = "
            <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>
            
            <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>

            <p style='color: #fff;'>
                <em>Dear Mr./Ms. $lastname,<em>
            </p>

            <p style='color: #fff;'>

            I hope this email finds you well. I am pleased to inform you that we have received your full 
            payment for <span style='color: #FED586;'>$event</span>. Thank you for completing the transaction on time and confirming your 
            participation. We are delighted to have you as one of our valued guests.
            </p>

            <p style='color: #fff;'>
            With the full payment received, we are excited to confirm that the event is now completely confirmed. 
            We have made all the necessary arrangements to ensure a memorable experience for all attendees.<br><br>

            Please take note that your booking is now final, and there will be no cancellations allowed, unless 
            there is an unexpected disaster or tragedy beyond our control, such as heavy rainfall, earthquake, or 
            any situation that poses a threat to the safety of everyone involved. The safety and well-being of our 
            guests are our top priority, and we will take appropriate measures to ensure everyone's security in 
            such circumstances.<br><br>

            We appreciate your understanding and cooperation regarding this policy. If you have any questions or 
            concerns, please feel free to reach out to us. We are here to assist you and address any queries you 
            may have.<br><br>

            Once again, we would like to express our gratitude for choosing our event management system. We look 
            forward to an incredible event filled with enjoyment and unforgettable moments.<br><br>
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

    if(isset($_GET['fullid']) && isset($_GET['booking'])){
        $id = $_GET['fullid'];
        $booking = $_GET['booking'];
        $select = "SELECT * FROM booking WHERE id = '$id' ";
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