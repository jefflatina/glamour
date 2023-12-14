<?php
    include("config.php");

    $id = $_GET['deleteid'];
    $booking = $_GET['booking'];
    $query = "SELECT * FROM booking WHERE booking_id = '$booking'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if($result){
        if($row > 0){
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
        $mail->Subject = 'Glamour: Cancellation of Your Event Booking with Glamour';
        $mail->Body    = "
        <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>
            
        <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>

        <p style='color: #fff;'>
        <em>Dear Mr./Ms. $lastname,<em>
        </p>

        <p style='color: #fff;'>
            We regret to inform you that your booking for the 
            <span style='color: #FED586;'>$event</span> Event has been 
            cancelled by our event management system, Glamour. We 
            understand that this may be disappointing news and we 
            sincerely apologize for any inconvenience this may have caused.
        </p>

        <p style='color: #fff;'>
            As per your request, your data from our system has been deleted. 
            This includes any personal information that you may have provided 
            during the booking process. Please take note that we will no longer 
            be able to retrieve your data. If you have any questions or concerns 
            about the deletion of your data, please do not hesitate to contact us.
        </p>
        
        <p style='color: #fff;'>
            Once again, we apologize for any inconvenience caused and we hope to have the opportunity to work with you in the future.
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



    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $booking = $_GET['booking'];
       
        $sql = "DELETE FROM booking WHERE id = '$id' ";
        $sqlresult = mysqli_query($connection, $sql);


        //delete continuation
        if($sqlresult)
        {
            $sqlbirthday = "DELETE FROM birthday WHERE booking_id = '$booking' ";
            $sqlwedding = "DELETE FROM wedding WHERE booking_id = '$booking' ";
            $sqlcorporate = "DELETE FROM corporate WHERE booking_id = '$booking' ";
            $sqlanniversary = "DELETE FROM anniversary WHERE booking_id = '$booking' ";
            $sqlchristening = "DELETE FROM christening WHERE booking_id = '$booking' ";
            $sqlresult2 = mysqli_query($connection, $sqlbirthday);
            $sqlresult3 = mysqli_query($connection, $sqlwedding);
            $sqlresult4 = mysqli_query($connection, $sqlanniversary);
            $sqlresult5 = mysqli_query($connection, $sqlcorporate);
            $sqlresult6 = mysqli_query($connection, $sqlchristening);

            if(sendMail($emailadd, $lastname, $event))
            {
                ?><script type="text/javascript">
            alert('Successfully deleted');
            window.location.href='admin-bookinglist.php';
            </script>
            
            <?php
            }

        } else {
            ?><script type="text/javascript">
            alert('Something went wrong');
            window.location.href='admin-bookinglist.php';
            </script>
            <?php
        }
    }
?>
