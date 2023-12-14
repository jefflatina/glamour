<?php
session_start();

    include("config.php");
    include("function.php");
 
    $errorMessage = "";
    $successMessage = "";


    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception;

    function sendmail_verify($signlast, $signmail, $verify_token)
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
            $mail->addAddress($signmail);     //Add a recipient
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
            $mail->Subject = 'Glamour: Verify your Glamour Account';
            $mail->Body    = "
            <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>

            <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>
            
            <p style='color: #fff;'>
            <em>Dear Mr./Ms. $signlast,<em>
            </p>
            
            <p style='color: #fff;'>
            Thank you for registering with Glamour! 
            To ensure that you have provided us with a valid email address, 
            we require you to verify it by clicking the link below: 
            </p><br>
            

            <center>
            <a href='localhost/Glamour/verify.php?email=$signmail&verify_token=$verify_token' 
            style='background: #FED586; padding: 10px; color: black; font-weight: bolder; 
            font-family: Judson; text-decoration: none; border-radius: 5px;'>VERIFY EMAIL ADDRESS</a><br><br>
            </center>

            <p style='color: #fff;'>
            Once you click the link, you will be redirected to a our login page confirming that your email address has been successfully verified. <br><br>
            If you have any questions or concerns, please do not hesitate to contact our with  this email. Thank you for your cooperation. Have a great day ahead! <br><br>
            
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



    
    //isset($signuser) || isset($signpass) || isset($signmail) || isset($signconpass)
    //$_SERVER['REQUEST_METHOD'] == "POST"
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $signuser = $_POST['signuser'];
        $signfirst = $_POST['signfirst'];
        $signlast = $_POST['signlast'];
        $signpass = $_POST['signpass'];
        $signmail = $_POST['signmail'];
        $signconpass = $_POST['signconpass'];

        $signfirst = ucwords($signfirst);
        $signlast = ucwords($signlast);

        $check_email = "SELECT email FROM users WHERE email = '$signmail' LIMIT 1";
        $check_email_query = mysqli_query($connection, $check_email);

        if(mysqli_num_rows($check_email_query) > 0)
        {
            //$_SESSION['status'] = "Email address already exists";
            $errorMessage = "Email address already exists";
            header("Location: signup.php");
        } else {
            if(!empty($signuser) && !empty($signfirst) && !empty($signlast) && !empty($signpass) && !empty($signmail) && !empty($signconpass) && !is_numeric($signuser))
            {
                //$isMatch = $signpass.equals($signconpass); 

                if($signpass == $signconpass)
                {
                        //save to database
                        $user_id = random_num(5);
                        //encrypt password
                        $passhash = $signpass;
                        $hashed_password = password_hash($passhash, PASSWORD_DEFAULT);
                        $verify_token = bin2hex(random_bytes(16));

                        $query = "INSERT INTO users (user_id, username, firstname, lastname, email, password, verify_token, user_status) VALUES ('$user_id', '$signuser', '$signfirst', '$signlast', '$signmail', '$hashed_password', '$verify_token', 'User') ";
                        $query_run = mysqli_query($connection, $query);

                        if($query_run)
                        {
                            sendmail_verify($signfirst, $signmail, $verify_token);
                            ?><script type="text/javascript">
                            alert('Registration successful! Please check your email to verify your account');
                            window.location.href='login.php';
                            </script>
                            <?php
                            die;
                        } else {
                            ?><script type="text/javascript">
                            alert('Registration Failed. Please try again');
                            window.location.href='signup.php';
                            </script>
                            <?php
                        }

                } else {
                    ?><script type="text/javascript">
                    alert('Passwords do not match');
                    window.history.back();
                    </script>
                    <?php
                }

            } else {
                ?><script type="text/javascript">
                    alert('Please fillout all the blank forms.');
                    window.history.back();
                    </script>
                    <?php
            }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/signupnow.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <section class="wrapper-signup" id="wrapper-signup">
        <div class="signup-main-content">
            <h2 style="font-family: Judson; font-weight: lighter; font-size: 85px;">SIGNUP</h2>    
            <form action="" method="POST">
                <div class="signup1">
                    <p>Already have an account?
                        <a href="login.php" class="login-link">Login</a>
                    </p>
                </div>
                <div class="input-box">
                    <input type="text" name="signuser" id="signuser" required placeholder="Enter your username" autocomplete="none">
                    <label><i class="ri-user-heart-fill"></i>&nbsp;Username</label>
                </div>
                <div class="input-box2">
                    <div class="column-left2">
                        <input type="text" name="signfirst" id="signfirst" required placeholder="Enter your first name" autocomplete="none">
                        <label><i class="ri-user-fill"></i>&nbsp;First Name</label>
                    </div>
                    <div class="column-right2">
                        <input type="text" name="signlast" id="signlast" required placeholder="Enter your last name" autocomplete="none">
                        <label><i class="ri-user-line"></i>&nbsp;Last Name</label>
                    </div>
                </div>
                <div class="input-box3">
                    <input type="email" name="signmail" id="signmail" required placeholder="Enter your email" autocomplete="none">
                    <label><span><i class="ri-mail-fill"></i>&nbsp;Email<span></label>
                </div>
                <div class="input-box4">
                    <div class="column-left4">
                        <input type="password" name="signpass" id="signpass" required placeholder="Enter your password">
                        <label><i class="ri-lock-fill"></i>&nbsp;Password</label>
                    </div>
                    <div class="column-right4">
                        <input type="password" name="signconpass" id="signconpass" required placeholder="Re-enter your password">
                        <label><i class="ri-lock-line"></i>&nbsp;Confirm Password</label>
                    </div>
                </div>
                
                <div class="remember-forgot">
                    <input type="checkbox" id="click"  onclick="enable()">
                    I Agree to
                    <label for="click" class="hyperlink">Terms and Conditions</label>
                </div>
                <div class="modal">
                    <div class="modal-content">
                        <h1 class="titleterms">TERMS AND CONDITIONS</h1>
                        <p class="paragraph">
                    

Welcome to Glamour! The following terms and conditions outline the rules and regulations for 
    the use of the Glamour website. By accessing or using our website, you agree 
    to be bound by these terms and conditions. Please read them carefully before using our website.<br><br><br>

<span style="color: black; font-weight: bolder; font-family: Poppins; background: #FED586; 
padding: 3px 10px 3px; border-radius: 15px;">USE OF THE SERVICE</span><br><br>

<em style="font-family: Poppins;">ELIGIBILITY</em><br>
You must be at least 18 years old to use the Service. By using the Service, you represent and 
warrant that you are at least 18 years old. <br><br>

<em style="font-family: Poppins;">REGISTRATION</em><br>
In order to use certain features of the Service, you may be required to register for an account. 
When you register, you must provide accurate and complete information. You are responsible for 
maintaining the confidentiality of your account and password, and for restricting access to your 
computer. You agree to accept responsibility for all activities that occur under your account or password. <br><br>

<em style="font-family: Poppins;">PROHIBITED ACTIVITIES</em><br>
You may not use the Service for any illegal or unauthorized purpose. You agree to comply with all 
applicable laws, rules, and regulations. You may not use the Service to harass, abuse, or harm any 
other person, or to upload, post, or transmit any content that is defamatory, obscene, pornographic, 
or otherwise objectionable. You may not use the Service to engage in any activity that interferes with 
or disrupts the Service (or the servers and networks which are connected to the Service). <br><br><br>

<span style="color: black; font-weight: bolder; font-family: Poppins; background: #FED586; 
padding: 3px 10px 3px; border-radius: 15px;">INTELLECTUAL PROPERTY</span><br><br>

You may not reproduce, distribute, modify, create derivative works of, publicly display, publicly perform, republish, download, store, or transmit any of the material on our Service, except as follows:<br>
•	Your computer may temporarily store copies of such materials in RAM incidental to your accessing and viewing those materials. <br>
•	You may store files that are automatically cached by your desktop Web browser for display enhancement purposes. <br>
•	You may print or download one copy of a reasonable number of pages of the Service for your own personal, non-commercial use and not for further reproduction, publication, or distribution. <br><br><br>

<span style="color: black; font-weight: bolder; font-family: Poppins; background: #FED586; 
padding: 3px 10px 3px; border-radius: 15px;">PRIVACY POLICY</span><br><br>
Glamour respects the privacy of its users. Any personal information you provide to us will be used only for the purposes of providing you with our event management services. We will never share your personal information with third parties unless required by law or necessary to provide you with the services you have requested. By using the Glamour event management system, you acknowledge and agree to our Privacy Policy. <br><br><br>

<span style="color: black; font-weight: bolder; font-family: Poppins; background: #FED586; 
padding: 3px 10px 3px; border-radius: 15px;">MINIMUM SERVICE SELECTION</span><br><br>
To be accommodated by us, you are required to select and engage at least two services when booking for an event. These services can be chosen based on your specific event needs and objectives. <br><br><br>

<span style="color: black; font-weight: bolder; font-family: Poppins; background: #FED586; 
padding: 3px 10px 3px; border-radius: 15px;">BOOKING APPROVAL</span><br><br>
•	After submitting a booking application, Glamour Event Management will review the details provided.<br>
•	The admin and coordinators have 5 working days to process and evaluate the booking application.<br>
•	Approval or decline of the application is based on factors like venue availability, resource constraints, and adherence to company policies.<br>
•	The customer will be informed of the application status within the 5-day period.<br>
•	If approved, further details and arrangements will be discussed.<br>
•	Additional time may be required for evaluation, in which case the customer will be notified.<br>
•	Approval is not guaranteed, and Glamour Event Management reserves the right to make decisions based on internal policies and availability constraints.
<br><br><br>

<span style="color: black; font-weight: bolder; font-family: Poppins; background: #FED586; 
padding: 3px 10px 3px; border-radius: 15px;">BOOKING PAYMENT</span><br><br>
To secure a booking, it is necessary to make arrangements at least two months in advance of the event. Please note that bookings cannot be accommodated for the upcoming week or month. The two-month time frame accounts for a 5-day period required for coordinators' approval, an additional two weeks for making the down payment, and a one-month period for settling the full payment.
<br><br><br>

<span style="color: black; font-weight: bolder; font-family: Poppins; background: #FED586; 
padding: 3px 10px 3px; border-radius: 15px;">WARRANTIES AND DISCLAIMERS</span><br><br>
Glamour provides the Service "as is" and does not make any warranties, express or implied, regarding the completeness, accuracy, reliability, suitability or availability of the Service. We do not guarantee the success of any event planned to use our system, nor do we accept any liability for any losses or damages incurred as a result of using our Service. By using the Service, you agree to indemnify, defend, and hold harmless Glamour from and against any claims or liabilities arising from your use of the Service. Glamour may make changes to these Terms at any time without prior notice. <br><br><br>

<span style="color: black; font-weight: bolder; font-family: Poppins; background: #FED586; 
padding: 3px 10px 3px; border-radius: 15px;">CANCELLATION OF BOOKING AND REFUNDS</span><br><br>
•	Refunds and change of details for events that have been fully paid for are not available, except in cases where there is a natural phenomenon that poses a risk to the safety of guests and could potentially affect the event. In such cases, a refund of 80% of the total payment will be considered upon the customer's explicit request.<br>
•	In the event of cancellation by the customer with sufficient notice before the scheduled event day, refunds will not be available for any down payment made.<br>
•	In the case of a disaster or unforeseen circumstance that necessitates cancellation by the customer, a refund of 80% of the total payment will be issued.<br>
•	Glamour Event Management reserves the right to offer an optional rescheduling of the event to a later date if the aforementioned natural phenomenon or disaster is identifiable in advance.<br>
•	Same-day cancellations are not allowed. Customers must provide sufficient notice before the scheduled event day to be eligible for cancellation.
<br><br><br>

<span style="color: black; font-weight: bolder; font-family: Poppins; background: #FED586; 
padding: 3px 10px 3px; border-radius: 15px;">LIMITATION OF LIABILITY</span><br><br>
In no event shall Glamour be liable for any direct, indirect, incidental, special, or consequential damages arising out of or in any way connected with the use of the Service, whether based on contract, tort, strict liability, or any other theory of liability, even if Glamour has been advised of the possibility of such damages. <br><br>
Glamour shall not be liable for any failure or delay in the performance of the Service, including without limitation any failure or delay caused by circumstances beyond our reasonable control. <br><br>
In no event shall Glamour's total liability to you for all damages, losses, and causes of action, whether in contract, tort (including negligence), or otherwise, exceed the amount paid by you, if any, for accessing the Service <br><br>
Some jurisdictions do not allow the exclusion or limitation of liability for incidental or consequential damages, so the above limitation may not apply to you. <br><br>
If you have any questions or concerns about this Limitation of Liability, please contact us at glamourevents@gmail.com.<br><br><br>

                        </p>
                        <div class="line"></div>
                        <div class="clear"></div>
                        <label class="close-btn">I AGREE TO TERMS AND CONDITIONS</label>
                    </div>
                    
                </div>
                <button type="submit" class="btn" id="btn" disabled="true">CREATE AN ACCOUNT</button>
            </form>
        </div> 
    </section>
    <script>
        function enable(){
        var check = document.getElementById("click");
        var btn = document.getElementById("btn");
            
        if(check.checked)
        {
            btn.removeAttribute("disabled");
        } else {
            btn.disabled = "true";
        }
    }
    </script>

    <script>
        // Disable autofill using JavaScript
        var inputField = document.getElementById('signlast');
        inputField.addEventListener('focus', function() {
            this.value = '';
        });
    </script>

    <div class="logo">
        <img src="CSS/Pictures/glamour-logo.png" alt="Logo" style="width:100px;height:60px;">
    </div>

    <!--Linked-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="modal.js"></script>
</body>