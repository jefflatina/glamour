<?php
session_start();

    include("config.php");
    include("function.php");
    $errorMessage = "";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email,$reset_token)
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
            $mail->Subject = 'Glamour: Password Reset Request';
            $mail->Body    = "
            <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>
            
            <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>

            <p style='color: #fff;'>
            <em>Good day!<em>
            </p>

            <p style='color: #fff;'>
                We have received a request to reset the password associated with your account. 
                If you did not initiate this request, please disregard this message. To reset your 
                password, please click on the link below:<br><br>
            </p>

            <center>
            <a href='localhost/Glamour/createnewpass.php?email=$email&reset_token=$reset_token' 
            style='background: #FED586; padding: 10px; color: black; font-weight: bolder; 
            font-family: Judson; text-decoration: none; border-radius: 5px;'>RESET PASSWORD</a><br><br>
            </center> 
            
            <p style='color: #fff;'>
                You will be taken to a page where you can enter a new password. Please make sure to 
                choose a strong, unique password that you have not used before. <br><br>

                If you have any questions or concerns, please do not hesitate to contact our with  
                this email. Thank you for your cooperation. Have a great day ahead! <br><br>
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


    //isset($_POST['send_reset_link'])
    if(isset($_POST['forgotmail']))
    {
        $forgotmail = $_POST['forgotmail'];
        $query = "SELECT email FROM users WHERE email = '$forgotmail'";
        $result = mysqli_query($connection, $query);

        if($result)
            {
                if(mysqli_num_rows($result) ==1)
                {
                    $reset_token = bin2hex(random_bytes(16));
                    date_default_timezone_set("Asia/Bangkok");
                    $date = date("y-m-d");
                    //$query =  "UPDATE users SET reset_token = '$reset_token', token_expired = '$date' WHERE email = '$forgotmail' ";
                    //$query = "UPDATE users SET reset_token`='$reset_token', token_expired`='$date' WHERE `email`='$forgotmail' ";
                    $query = "UPDATE `users` SET `reset_token`='$reset_token',`token_expired`='$date' WHERE `email`='$forgotmail' ";

                    if(mysqli_query($connection,$query))
                    {
                        if(sendMail($forgotmail, $reset_token))
                        {
                            ?><script type="text/javascript">
                            alert('Password reset link sent to email');
                            document.location='login.php';
                            </script>
                            <?php 
                        } else {
                            ?><script type="text/javascript">
                            alert('Email not recognized');
                            </script>
                            <?php
                        }
                    } else {
                        ?><script type="text/javascript">
                        alert('Server down.');
                        </script>
                        <?php
                    }

                } else {
                    ?><script type="text/javascript">
                    alert('Wrong email');
                    </script>
                    <?php
                }
            }
            else {
                ?><script type="text/javascript">
                    alert('Server down. try again later');
                    </script>
                    <?php
            }

    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/forgotpassword.css">
    
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="forgotpass-body">
    <div class="wrapper-forget">
        <h2>FORGOT PASSWORD</h2>
        <p>Enter the email address associated with your account and we'll 
        <br>send an email instruction to reset your password.</p>
        <form action="" method="POST">
            <div class="input-box">
                <input type="email" name="forgotmail" id="forgotmail" required placeholder="Enter your email address">
                <label><i class="ri-mail-fill"></i>&nbsp;EMAIL ADDRESS</label>
            </div>
            <button type="submit" class="btn" name="reset_link" id="reset_link">SEND INSTRUCTIONS</button>
        </form>
    </div>
    <div class="logo">
        <img src="CSS/Pictures//glamour-logo.png" alt="Logo" style="width:100px;height:60px;">
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>