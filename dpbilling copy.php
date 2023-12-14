<?php
session_start();

    require_once ("configbilling.php");
    include("config.php");
    include("function.php");

    $currentDate = date('Y-m-d');

    if(isset($_POST['submit3']))
    {
        $paypal = 'Paypal';
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $radioType = $_POST['radioType'];
        $downdate = $_POST['downdate'];
        $dppayment = $_POST['dppayment'];
        $amount = $_POST['amount'];

        // Image upload handling

        $uploads_dir = 'CSS/Pictures/billing/';

        // Valid ID
        $validIDFile = $_FILES['validID']['tmp_name'];
        $validIDFileName = $_FILES['validID']['name'];
        $validIDFilePath = $uploads_dir . uniqid() . '_' . $validIDFileName;

        if (move_uploaded_file($validIDFile, $validIDFilePath)) {
            // Image file moved successfully
            $validIDData = $validIDFilePath;
        } else {
            // Error moving image file
            $validIDData = '';
        }


        $update = "UPDATE billing SET firstname='$firstname', lastname='$lastname', address='$address',  email='$email', phone='$contact', valid_id='$validIDData', proof='$proofData', dppayment='$dppayment', date='$downdate', mop='$paypal', payment_type='Downpayment', dpstatus='Pending' WHERE booking_id='$booking_id' ";
        $sqlupdate = mysqli_query($connection, $update);

        if($sqlupdate)
                {
                    ?><script type="text/javascript">
                    window.location.href='http://localhost/Glamour/payment-successful.php';
                    </script>
                    <?php
                } else {
                    //die(mysqli_error($connection));
                    ?><script type="text/javascript">
                    alert('Something went wrong.');
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
    <title>Down Payment Billing Form | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/billing-form.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="https://kit.fontawesome.com/a79ec82bd5.js" crossorigin="anonymous"></script>
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id=billing-form>

             <!------------------------------------ PAYPAL/CREDIT CARD PAYMENT ------------------------------------>
            <form style="display: none;" class="form-horizontal" role="form" id="form3" method="post" enctype="multipart/form-data" action="<?php echo PAYPAL_URL; ?>">
            <div class="banner">
                <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="credits" value="510">
                <input type="hidden" name="userid" value="1">
                <input type="hidden" name="cpp_header_image" value="">
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="handling" value="0">
                <input type="hidden" name="description" value="Down Payment">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="currency" value="<?php echo CURRENCY; ?>">
                <input type="hidden" name="cancel_return" value="http://localhost/Glamour/dpbilling.php">
                <input type="hidden" name="return" value="http://localhost/Glamour/paypal-successful.php">        
            
                <h4>Account Details</h4>
                <h5>Sender's Information</h5>
                    <div class="grid">
                        <div class="grid-item grid-item-2">
                            <input type="text" id="firstname" name="firstname" required placeholder="Enter your Firstname">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="grid-item grid-item-2">
                            <input type="text" id="lastname" name="lastname" required placeholder="Enter your Lastname">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="grid-item grid-item-1">
                            <input type="text" id="address" name="address" required placeholder="Enter your Complete Address">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="grid-item grid-item-2">
                            <input type="email" id="email" name="email" required placeholder="Enter your Email Address">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="grid-item grid-item-2">
                            <input type="tel" id="contact" name="contact" required placeholder="Enter your Contact Number">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <h5>Valid ID of the sender</h5>
                    <div class="grid">
                        <div class="grid-item grid-item-1">
                            <input type="file" id="validID" name="validID" required>
                        </div>
                    </div>

                    <div style="margin-bottom: 30px;"></div>

                    <h4>Payment Information</h4>
                    <div class="row">
                        <div class="column">
                            <h5>Date of Payment</h5>
                        </div>
                        <div class="column">
                            <h5>&nbsp;&nbsp;Payment Amount (USD Currency)</h5>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="grid-item grid-item-2">
                            <input type="date" id="downdate" name="downdate" value="<?php echo $currentDate; ?>">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <div class="grid-item grid-item-2">
                            <input type="text" id="dppayment" name="dppayment"  required placeholder="Enter the Payment Amount" value="<?php echo ($rows['amount']/2)*0.018; ?>">
                            <input type="hidden" id="amount" name="amount" value="<?php echo $rows['amount']; ?>">
                            <i class="ri-wallet-3-fill"></i>
                        </div>
                    </div>
                
                    <div class="button-container" style="text-align: right;">
                        <input class="submitbtn" type="submit" name="submit3" value="SUBMIT" onclick="return confirm('Please review your information carefully before submitting the form. Are you sure you want to proceed?')">
                    </div>
                </div>
            </form>

</body>
</html>