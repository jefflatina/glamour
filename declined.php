<?php
include("config.php");

    $id = $_GET['declinedid'];
    $booking = $_GET['booking'];

    $query = "SELECT * FROM booking WHERE booking_id = '$booking'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if($result)
    {
        if($row > 0)
        {
            $emailadd =  $row['emailadd'];
            $lastname =  $row['lastname'];
            $event =  $row['event'];
        }
    }


    
    //notification
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email, $lastname, $event)
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
        $mail->Subject = 'Glamour: Pending Booking for Your Event with Glamour';
        $mail->Body    = "
        <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>

        <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>
        
        <p style='color: #fff;'>
            <em>Dear Mr./Ms. $lastname,<em>
        </p>

        <p style='color: #fff;'>
            We hope this email finds you well. We are writing to inform you that your booking for the
            <span style='color: #FED586;'>$event</span> Event is currently pending due to some conflicts with 
            the services that you have requested and the date that you have chosen.
        </p>

        <p style='color: #fff;'>
            We are currently reviewing your booking and will contact you shortly to discuss the available 
            options and alternatives that we can offer to ensure that your event runs smoothly. We kindly 
            request that you contact us as soon as possible to discuss the changes that may need to be 
            made to your booking. This will help us to provide you with the best possible service and 
            ensure that your event is a success. <br><br> 

            We apologize for any inconvenience this may have caused and we appreciate your understanding 
            in this matter. Our team is committed to making your event a memorable one, and we will work 
            with you to find a suitable solution. Please do not hesitate to contact us if you have any 
            questions or concerns. We are always here to assist you.<br><br>

            Thank you for choosing Glamour as your event management partner. We look forward 
            to working with you to create a successful event. <br>
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

    if(isset($_GET['declinedid']))
    {
        $id = $_GET['declinedid'];
        $booking = $_GET['booking'];

        if(sendMail($emailadd, $lastname, $event))
        {
            ?><script type="text/javascript">
            alert('Email sent successfully');
            window.location.href='admin-bookinglist.php';
            </script>
            
            <?php
        } else {
            ?><script type="text/javascript">
            alert('Something went wrong');
            window.location.href='admin-bookinglist.php';
            </script>
            
            <?php
        }
    }
?>