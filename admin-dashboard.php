<?php
session_start();


    include("config.php");
    include("function.php");


    $user_data = check_login($connection);


    //sa pagdisplay ng username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);

    //display total number of customers
    $sql = "SELECT COUNT(*) AS total_customers FROM users WHERE user_status = 'User' ";
    $customerresult = mysqli_query($connection, $sql);
    $getrow = mysqli_fetch_assoc($customerresult);

    //display total number of confirmed bookings
    $sql1 = "SELECT COUNT(*) AS total_confirmed FROM booking WHERE status = 'confirmed' ";
    $confirmedresult = mysqli_query($connection, $sql1);
    $getrow1 = mysqli_fetch_assoc($confirmedresult);

    //display total number of transactions
    $sql2 = "SELECT COUNT(*) AS total_transaction FROM billing WHERE payment_type IN ('Downpayment', 'Fullpayment')";
    $transacresult = mysqli_query($connection, $sql2);
    $getrow2 = mysqli_fetch_assoc($transacresult);

    //display total income
    $sql3 = "SELECT SUM(amount) AS total_income FROM billing WHERE payment_type = 'Fullpayment'";
    $totalresult = mysqli_query($connection, $sql3);
    $getrow3 = mysqli_fetch_assoc($totalresult);

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">


    <!--css link-->
    <link rel="stylesheet" href="CSS/dashboard.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>


<body style="background: var(--bg-color);">
<header>
        <ul class="left-nav">
            <!-- Profile Section -->
            <li class="profile-section">
                <img src="CSS/Pictures/uploads/adminpfp.png" alt="Profile Picture">
                <h4 style="color: #fff; font-weight: bolder; margin-bottom: 0px;"><?php echo $row["username"]; ?></h4>
                <p style="color: #fff;">Administrator</p>
            </li>
            <!-- Left Nav Bar -->
            <li class="sidebar"><a href="admin-dashboard.php" class="active" style="text-decoration: none;"><i class="ri-dashboard-line"></i> Dashboard</a></li>
            <li class="sidebar"><a href="admin-bookinglist.php" style="text-decoration: none;"><i class="ri-file-list-line"></i> Event Book List</a></li>
            <li class="sidebar"><a href="admin-calendar.php" style="text-decoration: none;"><i class="ri-calendar-line"></i> Event Calendar</a></li>
            <li class="sidebar"><a href="admin-coordinators.php" style="text-decoration: none;"><i class="ri-file-user-line"></i> Coordinators</a></li>
            <li class="sidebar"><a href="admin-billing.php" style="text-decoration: none;"><i class="ri-wallet-2-line"></i> Billing Report</a></li>
            <li class="sidebar"><a href="admin-sales.php" style="text-decoration: none;"><i class="ri-folder-chart-line"></i> Sales Report</a></li>
            <!-- Logout Button -->
		    <li class="logout-button">
			    <a href="logout.php" style="text-decoration: none;"><i class="ri-logout-box-line"></i> Logout</a>
		    </li>
        </ul>
    </header>
    <main>
        <div class="top-content">
            <h2>Dashboard</h2>
            <a href="admin-bookinglist.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="grid">
            <div class="grid-item grid-item-4">
                <p><?php echo $getrow["total_customers"]; ?></p>
                <h6>Number of Clients</h6>
            </div>
            <div class="grid-item grid-item-4">
               
                <p><?php echo $getrow1["total_confirmed"]; ?></p>
                <h6>Confirmed Booking</h6>
            </div>
            <div class="grid-item grid-item-4">
                <p><?php echo $getrow2["total_transaction"]; ?></p>
                <h6>Total Transactions</h6>
            </div>
            <div class="grid-item grid-item-4" id="box4">
                <p>P <?php echo number_format($getrow3["total_income"]); ?></p>
                <h6>Total Income</h6>
            </div>
        </div>
        <div class="grid2">
            <div class="grid-item2 grid-item-2">
                <h5>Pending Bookings</h5>
                <a href="admin-bookinglist.php">SEE MORE ></a>
                <table class="table-records" style="width: 100%;">
                    <thead style="font-size: .9em;">
                        <tr>
                            <th style="text-align: left;">Booking ID</th>
                            <th style="text-align: left;">Name</th>
                            <th style="text-align: left;">Event</th>
                            <th style="text-align: left;">Date</th>
                        </tr>
                    </thead>

                    <?php
                    $query = "SELECT * FROM booking WHERE status = 'pending' ORDER BY id DESC LIMIT 5";
                    $bookingresult = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($bookingresult)) 
                    {
                        $id = $row['id'];
                        $booking_id = $row['booking_id'];
                        $firstname = $row['firstname'];
                        $lastname = $row['lastname'];
                        $address = $row['address'];
                        $bookdate = $row['bookdate'];
                        $event = $row['event'];

                        echo '
                                    <tr>
                                        <td style="font-size: .7em;"> <span style="display: none;">'.$id.'</span>'.$booking_id.' </td>
                                        <td style="font-size: .7em;"> '.$lastname.' </td>
                                        <td style="font-size: .7em;"> '.$event.' </td>
                                        <td style="font-size: .7em;"> '.$bookdate.' </td>
                                    </tr>
                                        ';
                    
                    }

                    ?>
                </table>
            </div>
            <div class="grid-item2 grid-item-2">
                <h5>Confirmed Bookings</h5>
                <a href="admin-bookinglist.php#confirmedtable">SEE MORE ></a>
                <table class="table-records" style="width: 100%;">
                    <thead style="font-size: .9em;">
                        <tr>
                            <th style="text-align: left;">Booking ID</th>
                            <th style="text-align: left;">Name</th>
                            <th style="text-align: left;">Event</th>
                            <th style="text-align: left;">Date</th>
                        </tr>
                    </thead>
                    
                    <?php
                    $query = "SELECT * FROM booking WHERE status = 'confirmed' ORDER BY bookdate ASC LIMIT 5";
                    $bookingresult = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($bookingresult)) 
                    {
                        $id = $row['id'];
                        $booking_id = $row['booking_id'];
                        $lastname = $row['lastname'];
                        $address = $row['address'];
                        $bookdate = $row['bookdate'];
                        $event = $row['event'];

                        echo '
                                    <tr>
                                        <td style="font-size: .7em;"> <span style="display: none;">'.$id.'</span>'.$booking_id.' </td>
                                        <td style="font-size: .7em;"> '.$lastname.' </td>
                                        <td style="font-size: .7em;"> '.$event.' </td>
                                        <td style="font-size: .7em;"> '.$bookdate.' </td>
                                    </tr>
                                        ';
                    
                    }

                    ?>
                </table>
            </div>
            <div class="grid-item2 grid-item-2">
                <h5>Down Payment Transactions</h5>
                <a href="admin-billing.php">SEE MORE ></a>
                <table class="table-records">
                    <thead style="font-size: .9em;">
                        <tr>
                            <th>Billing ID</th>
                            <th>Name</th>
                            <th>Event</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <?php
                    $query = "SELECT b.*, bk.event
                    FROM billing b
                    INNER JOIN booking bk ON b.booking_id = bk.booking_id
                    WHERE b.payment_type = 'Downpayment'
                    ORDER BY b.date ASC
                    LIMIT 5";
                    $billingresult = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($billingresult)) 
                    {
                        $id = $row['id'];
                        $billing_id = $row['billing_id'];
                        $lastname = $row['lastname'];
                        $event = $row['event'];
                        $status = $row['dpstatus'];
                        $amount = $row['amount'];

                        echo '
                                    <tr>
                                        <td style="font-size: .7em;"> <span style="display: none;">'.$id.'</span>'.$billing_id.' </td>
                                        <td style="font-size: .7em;"> '.$lastname.' </td>
                                        <td style="font-size: .7em;"> '.$event.' </td>
                                        <td style="font-size: .7em;">PHP '.$amount.' </td>
                                        <td style="font-size: .7em;"> '.$status.' </td>
                                    </tr>
                                        ';
                    
                    }

                    ?>
                </table>
            </div>
            <div class="grid-item2 grid-item-2">
                <h5>Full Payment Transactions</h5>
                <a href="admin-billing.php#fullpaymenttable">SEE MORE ></a>
                <table class="table-records">
                    <thead style="font-size: .9em;">
                        <tr>
                            <th>Billing ID</th>
                            <th>Name</th>
                            <th>Event</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <?php
                        $query = "SELECT b.*, bk.event
                        FROM billing b
                        INNER JOIN booking bk ON b.booking_id = bk.booking_id
                        WHERE b.payment_type = 'Fullpayment'
                        ORDER BY b.date ASC
                        LIMIT 5";
                        $billingresult = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($billingresult)) 
                        {
                            $id = $row['id'];
                            $billing_id = $row['billing_id'];
                            $lastname = $row['lastname'];
                            $event = $row['event'];
                            $status = $row['dpstatus'];
                            $amount = $row['amount'];

                            echo '
                                        <tr>
                                            <td style="font-size: .7em;"> <span style="display: none;">'.$id.'</span>'.$billing_id.' </td>
                                            <td style="font-size: .7em;"> '.$lastname.' </td>
                                            <td style="font-size: .7em;"> '.$event.' </td>
                                            <td style="font-size: .7em;">PHP '.$amount.' </td>
                                            <td style="font-size: .7em;"> '.$status.' </td>
                                        </tr>
                                            ';
                        
                        }

                    ?>
                </table>
            </div>
        </div>
        <p><br>&nbsp;</p>
        <p><br>&nbsp;</p>
    </main>
<body>



