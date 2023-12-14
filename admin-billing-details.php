<?php
session_start();


    include("config.php");
    include("function.php");



    //sa pagdisplay ng username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);


    //display bookings
    $sql = "SELECT * FROM booking WHERE status = 'pending' ORDER BY id DESC";
    $bookingresult = mysqli_query($connection, $sql);

    $viewid = $_GET['viewid'];
    $billing = $_GET['billing'];

    $billingresult = "SELECT * FROM billing WHERE id = '$viewid' ";
    $billingquery = mysqli_query($connection, $billingresult);
    $billrow = mysqli_fetch_assoc($billingquery);

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Report | Admin</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">


    <!--css link-->
    <link rel="stylesheet" href="CSS/adminstyle.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <!--bootstrap-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
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
            <li class="sidebar"><a href="admin-dashboard.php" style="text-decoration: none;"><i class="ri-dashboard-line"></i> Dashboard</a></li>
            <li class="sidebar"><a href="admin-bookinglist.php" style="text-decoration: none;"><i class="ri-file-list-line"></i> Event Book List</a></li>
            <li class="sidebar"><a href="admin-calendar.php" style="text-decoration: none;"><i class="ri-calendar-line"></i> Event Calendar</a></li>
            <li class="sidebar"><a href="admin-coordinators.php" style="text-decoration: none;"><i class="ri-file-user-line"></i> Coordinators</a></li>
            <li class="sidebar"><a href="admin-billing.php" class="active" style="text-decoration: none;"><i class="ri-wallet-2-line"></i> Billing Report</a></li>
            <li class="sidebar"><a href="admin-sales.php" style="text-decoration: none;"><i class="ri-folder-chart-line"></i> Sales Report</a></li>
            <!-- Logout Button -->
		    <li class="logout-button">
			    <a href="logout.php" style="text-decoration: none;"><i class="ri-logout-box-line"></i> Logout</a>
		    </li>
        </ul>
    </header>
    <main style="color: #fff; font-size: .8em;">
        <div class="top-content">
            <h2 style="color: #fff;">Billing Report</h2>
            <a href="admin-bookinglist.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container-adminlist" style="color: #fff;">

            <h3 style="font-size: 1.25em; font-weight: bolder;">Down Payment Client Transactions</h3>
            <table class="table-records" style="color: #fff;">
                <thead style="font-size: .8em; ">
                    <tr>
                        <th style="text-align: center;">Billing ID</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Event</th>
                        <th style="text-align: center;">Mode of Payment</th>
                        <th style="text-align: center;">Date</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>

                <?php
                $sql = "SELECT b.*, bk.event
                FROM billing b
                INNER JOIN booking bk ON b.booking_id = bk.booking_id
                ORDER BY b.billing_id DESC";
                $billingresult = mysqli_query($connection, $sql);
                while($row = mysqli_fetch_array($billingresult)) {
                ?>
                <!------modal for downpayment ------->
                <div id="myModals" class="modals" style="position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; backdrop-filter: blur(10px);">
                            <div class="modal-content" style="background: #383838; width: 50%;  border-radius: 20px;">
                                <h1 style="font-family: Judson; color: var(--main-color); font-size: 2em;">DOWN PAYMENT BILLING DETAILS</h1>
                                <h2 style=" font-family: Poppins; color: var(--text-color); font-size: 1em; font-weight: 500; margin-top: 10px; margin-bottom: 20px;">ACCOUNT INFORMATION</h2>
                                <div class="grid-container">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">First Name</h3>
                                        <p style="height: 30px; padding: 5px 15px;"><?= $billrow['firstname']; ?></p>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Last Name</h3>
                                        <p style="height:30px; padding: 5px 15px;"><?= $billrow['lastname']; ?></p>
                                    </div>
                                </div>
                                <div class="column-container">
                                    <div class="column-item">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Address</h3>
                                        <p style="height:30px; padding: 5px 15px;"><?= $billrow['address']; ?></p>
                                    </div>
                                </div>
                                <div class="grid-container">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Email Address</h3>
                                        <p style="height:30px; padding: 5px 15px;"><?= $billrow['email']; ?></p>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Contact Number</h3>
                                        <p style="height:30px; padding: 5px 15px;"><?= $billrow['phone']; ?></p>
                                    </div>
                                </div>
                                <div class="column-container">
                                    <div class="column-item">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Valid ID</h3>
                                        <p style="height: auto; padding: 20px;"><img src="<?= $billrow['valid_id']; ?>" width="100%"></p>
                                    </div>
                                </div>
                                <h2 style=" font-family: Poppins; color: var(--text-color); font-size: 1em; font-weight: 500; margin-top: 10px; margin-bottom: 20px;">PAYMENT INFORMATION</h2>
                                <div class="grid-container">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Reference #</h3>
                                        <p style="height: 30px; padding: 5px 15px;"><?= $billrow['ref_num']; ?></p>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Payment Amount</h3>
                                        <p style="height: 30px; padding: 5px 15px;">PHP <?= $billrow['dppayment']; ?></p>
                                    </div>
                                </div>
                                <div class="column-container">
                                    <div class="column-item">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Proof of Payment</h3>
                                        <p style="height: auto; padding: 20px;"><img src="<?= $billrow['proof']; ?>" width="100%"></p>
                                    </div>
                                </div>
                                <div class="button-container">
                                    <button class="back-button" onclick="window.location.href='admin-billing.php'">BACK</button>
                                    <div class="button-group">
                                    <a href="dpapprove.php?dpapproveid=<?= $billrow['id']; ?>&billing=<?= $billrow['billing_id']; ?>"><button class="approve-button">APPROVE</button></a>
                                    <a href="dpdecline.php?dpdeclineid=<?= $billrow['id']; ?>&billing=<?= $billrow['billing_id']; ?>&amount=<?= $billrow['amount']; ?>"><button class="decline-button">DECLINE</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                <tbody>
                    <tr>
                        <td style="text-align: center;"><?= $row['billing_id']; ?></td>
                        <td style="text-align: center;"><?= $row['firstname'] . ' ' . $row['lastname']; ?></td>
                        <td style="text-align: center;"><?= $row['event']; ?></td>
                        <td style="text-align: center;"><?= $row['mop']; ?></td>
                        <td style="text-align: center;"><?= $row['date']; ?></td>
                        <td style="text-align: center;"><?= $row['status']; ?></td>
                        <td style="text-align: center;">
                            <button class="view-btn" id="viewbtn"><i class="ri-eye-line"></i></button>
                            <a href=""><button class="delete-btn"><i class="ri-delete-bin-line"></i></button></a>
                        </td>
                    </tr>
                </tbody>
                   
                <?php } ?>
            </table>

            <h3 style="font-size: 1.25em; font-weight: bolder; margin-top: 30px;">Full Payment Client Transactions</h3>
            <table class="table-records" style="color: #fff;" id="fullpaymenttable">
                <thead style="font-size: .8em; ">
                    <tr>
                        <th style="text-align: center;">Billing ID</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Event</th>
                        <th style="text-align: center;">Mode of Payment</th>
                        <th style="text-align: center;">Date</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM billing WHERE payment_type = 'Fullpayment' ORDER BY billing_id DESC ";
                $billingresult = mysqli_query($connection, $sql);
                while($row = mysqli_fetch_array($billingresult)) {
                ?>

                <tbody>
                    <tr>
                        <td style="text-align: center;"><?= $row['billing_id']; ?></td>
                        <td style="text-align: center;"><?= $row['lastname']; ?></td>
                        <td style="text-align: center;">Wedding</td>
                        <td style="text-align: center;"><?= $row['mop']; ?></td>
                        <td style="text-align: center;"><?= $row['date']; ?></td>
                        <td style="text-align: center;"><?= $row['status']; ?></td>
                        <td style="text-align: center;">
                            <button class="view-btn" id="viewbtn"><i class="ri-eye-line"></i></button>
                            <a href=""><button class="delete-btn"><i class="ri-delete-bin-line"></i></button></a>
                        </td>
                    </tr>
                </tbody>
                    
                <?php } ?>
            </table>

           
        </div>
    </main>
    
      

    
    <script type="text/javascript">
        $(document).ready(function(){
            $('table').DataTable({
            "searching": true,
            "paging": true,
            "order": [[0, "desc" ]],
            "ordering": true,
                "columnDefs": [{
                "targets": [4, 5],
                "orderable": false
                }]
            });
        });
    </script>

</body>
</html>



