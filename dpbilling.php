<?php
session_start();

    require_once ("configbilling.php");
    include("config.php");
    include("function.php");

    $currentDate = date('Y-m-d');
    $amount; 


    if(isset($_GET['booking_id']))
    {
        $query = "SELECT * FROM booking WHERE booking_id = '$_GET[booking_id]' ";
        $result = mysqli_query($connection, $query);

        if($result)
        {
            $rows = mysqli_fetch_assoc($result);
            $booking_id = $rows['booking_id'];
            $user_id = $rows['user_id'];
        }
    }


    if(isset($_POST['submit1']))
    {
        $cash = 'Cash';
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $downdate = $_POST['downdate'];
        $dppayment = $_POST['dppayment'];
        $amount = $_POST['amount'];

        $firstname = ucwords($firstname);
        $lastname = ucwords($lastname);
        $address = ucwords($address);

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

        //Proof of Payment
        $proofFile = $_FILES['proof']['tmp_name'];
        $proofFileName = $_FILES['proof']['name'];
        $proofFilePath = $uploads_dir . uniqid() . '_' . $proofFileName;

        if (move_uploaded_file($proofFile, $proofFilePath)) {
            // Image file moved successfully
            $proofData = $proofFilePath;
        } else {
            // Error moving image file
            $proofData = '';
        }

       // $insert = "INSERT INTO billing (firstname, lastname, address, email, phone, valid_id, proof, amount, dppayment, date, mop, payment_type, dpstatus) 
       // VALUES ('$firstname', '$lastname', '$address', '$email', '$contact', '$validIDData', '$proofData', '$amount', '$dppayment', '$downdate', '$cash', 'Downpayment','Pending' ) ";
        $update = "UPDATE billing SET firstname='$firstname', lastname='$lastname', address='$address',  email='$email', phone='$contact', 
        valid_id='$validIDData', proof='$proofData', dppayment='$dppayment', date='$downdate', mop='$cash', 
        payment_type='Downpayment', dpstatus='Pending' WHERE booking_id='$booking_id' ";
        
        $sqlupdate = mysqli_query($connection, $update);

       // $slqinsert = mysqli_query($connection, $insert);

        if($sqlupdate)
                {
                    ?><script type="text/javascript">
                    window.location.href='payment-successful.php';
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

    if(isset($_POST['submit2']))
    {
        $bank = 'Bank';
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $radioType = $_POST['radioType'];
        $downdate = $_POST['downdate'];
        $dppayment = $_POST['dppayment'];
        $amount = $_POST['amount'];
        $ref = $_POST['ref'];

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

        //Proof of Payment
        $proofFile = $_FILES['proof']['tmp_name'];
        $proofFileName = $_FILES['proof']['name'];
        $proofFilePath = $uploads_dir . uniqid() . '_' . $proofFileName;

        if (move_uploaded_file($proofFile, $proofFilePath)) {
            // Image file moved successfully
            $proofData = $proofFilePath;
        } else {
            // Error moving image file
            $proofData = '';
        }

        //$insert = "INSERT INTO billing (firstname, lastname, address, email, phone, valid_id, proof, amount, dppayment, date, mop, payment_type, dpstatus) 
      //  VALUES ('$firstname', '$lastname', '$address', '$email', '$contact', '$validIDData', '$proofData', '$amount', '$dppayment', '$downdate', '$bank', 'Downpayment','Pending' ) ";
        //$slqinsert = mysqli_query($connection, $insert);

        $update = "UPDATE billing SET firstname='$firstname', lastname='$lastname', address='$address',  email='$email', phone='$contact', ref_num='$ref', valid_id='$validIDData', proof='$proofData', dppayment='$dppayment', date='$downdate', mop='$bank', payment_type='Downpayment', dpstatus='Pending' WHERE booking_id='$booking_id' ";
        $sqlupdate = mysqli_query($connection, $update);

        if($sqlupdate)
                {
                    ?><script type="text/javascript">
                    window.location.href='payment-successful.php';
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
    $booking_id = 'booking_id'; // Replace with the actual booking ID

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
        // Database update successful, proceed to PayPal
        ?>
        <script type="text/javascript">
            document.getElementById('form3').submit();
        </script>
        <?php
    } else {
        // Database update failed
        ?>
        <script type="text/javascript">
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
    <section class="billing" id="billing">
        <h2>DOWNPAYMENT BILLING</h2>
        <h3>TOTAL PAYMENT: PHP <?php echo number_format($rows['amount'] / 2, 2, '.', ','); ?></h3>
            <div class="paymentmethod">
                <div class="option-box">
                    <input type="radio" id="option1" name="radioType" value="option1" onchange="toggleForm('form1')">
                    <label for="option1"><span style="font-size: 50px; margin-bottom:"><i class="ri-cash-line"></i></span>Cash Deposit</label>
                    <input type="radio" id="option2" name="radioType" value="option1" onchange="toggleForm('form2')">
                    <label for="option2"><span style="font-size: 50px;"><i class="ri-bank-line"></i></span>Bank Transfer</label>
                    <input type="radio" id="option3" name="radioType" value="option1" onchange="toggleForm('form3')">
                    <label for="option3"><span style="font-size: 50px;"><i class="ri-paypal-line"></i></span>Paypal</label>
                </div>
            </div>

        <h3 style="color: #D2D2D2; margin-top: 60px"><em>Please select your mode of payment</em></h3>

            <!------------------------------------ CASH PAYMENT ------------------------------------>
            <form style="display: none;" class="form-horizontal" role="form" id="form1" method="post" action="" enctype="multipart/form-data">
            
            <div class="banner">
            <h4>Account Details</h4>
                <h5>Sender's Information</h5>
                    <div class="grid">
                        <div class="grid-item grid-item-2">
                            <input type="text" id="firstname" name="firstname" required placeholder="Enter your Firstname" autocomplete="none">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="grid-item grid-item-2">
                            <input type="text" id="lastname" name="lastname" required placeholder="Enter your Lastname" autocomplete="none">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="grid-item grid-item-1">
                            <input type="text" id="address" name="address" required placeholder="Enter your Complete Address" autocomplete="none">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="grid-item grid-item-2">
                            <input type="email" id="email" name="email" required placeholder="Enter your Email Address" autocomplete="none">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="grid-item grid-item-2">
                            <input type="tel" id="contact" name="contact" required placeholder="Enter your Contact Number" autocomplete="none">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <h5>Valid ID of the depositor/representative</h5>
                    <div class="grid">
                        <div class="grid-item grid-item-1">
                            <input type="file" id="validID" name="validID" required>
                        </div>
                    </div>

                    <div style="margin-bottom: 30px;"></div>

                    <h4>Payment Information</h4>
                    <h5>Cash Deposit Bank Details and Process</h5>
                        <div class="bank">
                            <input type="radio" id="dep1" name="radioType" value="option1" onchange="opencModal('cmodal1')">
                            <label for="dep1">Landbank</label>

                            <input type="radio" id="dep2" name="radioType" value="option2" onchange="opencModal('cmodal2')">
                            <label for="dep2">BPI</label>

                            <input type="radio" id="dep3" name="radioType" value="option3" onchange="opencModal('cmodal3')">
                            <label for="dep3">Unionbank</label>
                        </div>

                    <!----- Cash Bank Details ---->
                    <div id="cmodal1" class="cmodal">
                        <div class="cmodal-content">
                            <h1 style="font-size: 35px; text-align: center; color: #FED586; margin-bottom: 10px;">LANDBANK</h1>
                            <h7 style="background: #FED586; color: black; font-family: Poppins; font-size: 11px; border-radius: 10px; font-weight: bolder; padding: 2px 5px; text-align: center;">ACCOUNT NAME</h7>
                            <h7 style="font-family: Poppins; font-size: 12px; margin-bottom: 10px;">Jeffrey Latina</h7>
                            <h7 style="background: #FED586; color: black; font-family: Poppins; font-size: 11px; border-radius: 10px; font-weight: bolder; padding: 2px 5px; text-align: center;">ACCOUNT NUMBER</h7>
                            <h7 style="font-family: Poppins; font-size: 12px; margin-bottom: 10px;">#2317-1270-7</h7><br>
                            
                            <span class="details">
                            <p style="font-family: Poppins; font-size: 11px;"> Proceed to any branch of Landbank of the Philippines, secure a deposit slip and fill-out the details above.<br><br>
                                If this step is inconvenient from you, you may consider changing your payment method.<br><br>
                                If you encounter more problems for your payment transaction or for other payment concers, please don't hesitate to contact us.<br>
                            </p>

                            <div class="button-container">
                            <button class="closebtn" onclick="closecModal('cmodal1')">DONE</button>
                            </div>
                            </span>

                        </div>
                    </div>

                    <div id="cmodal2" class="cmodal">
                        <div class="cmodal-content">
                            <h1 style="font-size: 35px; text-align: center; color: #FED586; margin-bottom: 10px;">BPI</h1>
                            <h7 style="background: #FED586; color: black; font-family: Poppins; font-size: 11px; border-radius: 10px; font-weight: bolder; padding: 2px 5px; text-align: center;">ACCOUNT NAME</h7>
                            <h7 style="font-family: Poppins; font-size: 12px; margin-bottom: 10px;">Jeffrey Latina</h7>
                            <h7 style="background: #FED586; color: black; font-family: Poppins; font-size: 11px; border-radius: 10px; font-weight: bolder; padding: 2px 5px; text-align: center;">ACCOUNT NUMBER</h7>
                            <h7 style="font-family: Poppins; font-size: 12px; margin-bottom: 10px;">#4979-1766-067</h7><br>
                            
                            <span class="details">
                            <p style="font-family: Poppins; font-size: 11px;"> Proceed to any branch of Bank of the Philippine Islands, secure a deposit slip and fill-out the details above.<br><br>
                                If this step is inconvenient from you, you may consider changing your payment method.<br><br>
                                If you encounter more problems for your payment transaction or for other payment concers, please don't hesitate to contact us.<br>
                            </p>

                            <div class="button-container">
                            <button class="closebtn" onclick="closecModal('cmodal2')">DONE</button>
                            </div>
                            </span>

                        </div>
                    </div>


                    <div id="cmodal3" class="cmodal">
                        <div class="cmodal-content">
                            <h1 style="font-size: 35px; text-align: center; color: #FED586; margin-bottom: 10px;">UNIONBANK</h1>
                            <h7 style="background: #FED586; color: black; font-family: Poppins; font-size: 11px; border-radius: 10px; font-weight: bolder; padding: 2px 5px; text-align: center;">ACCOUNT NAME</h7>
                            <h7 style="font-family: Poppins; font-size: 12px; margin-bottom: 10px;">Jeffrey Latina</h7>
                            <h7 style="background: #FED586; color: black; font-family: Poppins; font-size: 11px; border-radius: 10px; font-weight: bolder; padding: 2px 5px; text-align: center;">ACCOUNT NUMBER</h7>
                            <h7 style="font-family: Poppins; font-size: 12px; margin-bottom: 10px;">#3920-3578-7660</h7><br>
                            
                            <span class="details">
                            <p style="font-family: Poppins; font-size: 11px;"> Proceed to any branch of Unionbank, secure a deposit slip and fill-out the details above.<br><br>
                                If this step is inconvenient from you, you may consider changing your payment method.<br><br>
                                If you encounter more problems for your payment transaction or for other payment concers, please don't hesitate to contact us.<br>
                            </p>

                            <div class="button-container">
                            <button class="closebtn" onclick="closecModal('cmodal3')">DONE</button>
                            </div>
                            </span>

                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <h5>Date of Payment</h5>
                        </div>
                        <div class="column">
                            <h5>&nbsp;&nbsp;Payment Amount</h5>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="grid-item grid-item-2">
                            <input type="date" id="downdate" name="downdate" value="<?php echo $currentDate; ?>">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <div class="grid-item grid-item-2">
                            <input type="text" id="dppayment" name="dppayment" required placeholder="Enter the Payment Amount" value="<?php echo $rows['amount']/2; ?>">
                            <input type="hidden" id="amount" name="amount" value="<?php echo $rows['amount']; ?>">
                            <i class="ri-wallet-3-fill"></i>
                        </div>
                    </div>
                    <h5>Copy of Deposit Slip <em>(duly validated by the bank)</em></h5>
                    <div class="grid">
                        <div class="grid-item grid-item-1">
                            <input type="file" id="proof" name="proof" required>
                        </div>
                    </div>
                
                    <div class="button-container" style="text-align: right;">
                        <input class="submitbtn" type="submit" name="submit1" value="SUBMIT" onclick="return confirm('Please review your information carefully before submitting the form. Are you sure you want to proceed?')">
                    </div>
                </div>
            </form>

             <!------------------------------------ BANK TRANSFER PAYMENT ------------------------------------>
             <form style="display: none;" class="form-horizontal" role="form" id="form2" method="post" action="" enctype="multipart/form-data">
             <div class="banner">
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
                    <h5>Bank Details</h5>
                        <div class="bank">
                            <input type="radio" id="landbank" name="radioType" value="option1" onclick="openModal('modal1')">
                            <label for="landbank">Landbank</label>

                            <input type="radio" id="bpi" name="radioType" value="option2" onclick="openModal('modal2')">
                            <label for="bpi">BPI</label>

                            <input type="radio" id="unionbank" name="radioType" value="option3" onclick="openModal('modal3')">
                            <label for="unionbank">Unionbank</label>
                        </div>
                        <input type="hidden" id="downdate" name="downdate" value="<?php echo $currentDate; ?>">

                    <!----- Bank Details ---->

                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <div class="image-container">
                            <img src="CSS/Pictures/landbank.jpg" alt="Image" height="300px" style="border-radius: 10px;">
                            </div>
                            <h7 style="font-weight: lighter; margin-top: 5px;">Scan QR Code to pay</h7>
                            <div class="button-container">
                            <button class="closebtn" onclick="closeModal('modal1')">DONE</button>
                            </div>
                        </div>
                    </div>


                    <div id="modal2" class="modal">
                        <div class="modal-content">
                            <div class="image-container">
                            <img src="CSS/Pictures/bpi.webp" alt="Image" height="300px" style="border-radius: 10px;">
                            </div>
                            <h7 style="font-weight: lighter; margin-top: 5px;">Scan QR Code to pay</h7>
                            <div class="button-container">
                            <button class="closebtn" onclick="closeModal('modal2')">DONE</button>
                            </div>
                        </div>
                    </div>


                    <div id="modal3" class="modal">
                        <div class="modal-content">
                            <div class="image-container">
                            <img src="CSS/Pictures/unionbank.jpeg" alt="Image" height="300px" style="border-radius: 10px;">
                            </div>
                            <h7 style="font-weight: lighter; margin-top: 5px;">Scan QR Code to pay</h7>
                            <div class="button-container">
                            <button class="closebtn" onclick="closeModal('modal3')">DONE</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <h5>Reference Number</h5>
                        </div>
                        <div class="column">
                            <h5>&nbsp;&nbsp;Payment Amount</h5>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="grid-item grid-item-2">
                            <input type="text" id="ref" name="ref"  required placeholder="Enter the Reference Number">
                            <i class="ri-hashtag"></i>
                        </div>
                        <div class="grid-item grid-item-2">
                            <input type="text" id="dppayment" name="dppayment"  required placeholder="Enter the Payment Amount" value="<?php echo $rows['amount']/2; ?>">
                            <input type="hidden" id="amount" name="amount" value="<?php echo $rows['amount']; ?>">
                            <i class="ri-wallet-3-fill"></i>
                        </div>
                    </div>
                    
                    <h5>Proof of Payment</h5>
                    <div class="grid">
                        <div class="grid-item grid-item-1">
                            <input type="file" id="proof" name="proof" required>
                        </div>
                    </div>

                    <div class="button-container" style="text-align: right;">
                        <input class="submitbtn" type="submit" name="submit2" value="SUBMIT" onclick="return confirm('Please review your information carefully before submitting the form. Are you sure you want to proceed?')">
                    </div>
                </div>
            </form>
            

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
                            <input type="hidden" id="amount" name="amount" value="<?php echo ($rows['amount']/2)*0.018; ?>">
                            <i class="ri-wallet-3-fill"></i>
                        </div>
                    </div>
                
                    <div class="button-container" style="text-align: right;">
                        <input class="submitbtn" type="submit" name="submit3" value="SUBMIT" onclick="return confirm('Please review your information carefully before submitting the form. Are you sure you want to proceed?')">
                    </div>
                </div>
            </form>



    </section>

    <script>
        function toggleForm(formId) {
            var forms = document.getElementsByTagName("form");

            // Hide all forms
            for (var i = 0; i < forms.length; i++) {
            forms[i].style.display = "none";
            }

            // Show the selected form
            var selectedForm = document.getElementById(formId);
            if (selectedForm) {
            selectedForm.style.display = "block";
            }
        }
    </script>

    <script type="text/javascript"> 
        function submitForm() {
            if (confirm('Please review your information carefully before submitting the form. Are you sure you want to proceed?')) {
                document.getElementById('form3').submit();
            }
        }
    </script>

    <!--for cash modal -->
    <script>
        function opencModal(cmodalId) {
        var cmodal = document.getElementById(cmodalId);
        cmodal.style.display = "block";
        }

        function closecModal(cmodalId) {
        var cmodal = document.getElementById(cmodalId);
        cmodal.style.display = "none";
        }
    </script>

    <!--for bank transfer modal -->
    <script>
        function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "block";
        }

        function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "none";
        }
    </script>

</body>
</html>