<?php
session_start();


    include("config.php");
    include("function.php");


    $user_data = check_login($connection);


    //sa pagdisplay ng username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);


    //display bookings
    $sql = "SELECT * FROM booking WHERE status = 'pending' ORDER BY id DESC";
    $bookingresult = mysqli_query($connection, $sql);
            

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Book List | Admin</title>
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
            <li class="sidebar"><a href="admin-bookinglist.php" class="active" style="text-decoration: none;"><i class="ri-file-list-line"></i> Event Book List</a></li>
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
    <main style="color: #fff; font-size: .8em;">
        <div class="top-content">
            <h2 style="color: #fff;">Event Book List</h2>
            <a href="admin-bookinglist.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container-adminlist" style="color: #fff;">
            <h3 style="font-size: 1.25em; font-weight: bolder;">Pending Clients</h3>
            <table class="table-records" style="color: #fff;">
                <thead style="font-size: .8em; ">
                    <tr>
                        <th style="text-align: center;">Booking ID</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Contact</th>
                        <th style="text-align: center;">Address</th>
                        <th style="text-align: center;">Email Address</th>
                        <th style="text-align: center;">Date</th>
                        <th style="text-align: center;">Event Type</th>
                        <th style="text-align: center;">Details</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($bookingresult)
                        {
                            while($getrows = mysqli_fetch_assoc($bookingresult))
                            {
                                $id = $getrows['id'];
                                $booking_id = $getrows['booking_id'];
                                $firstname = $getrows['firstname'];
                                $lastname = $getrows['lastname'];
                                $phone = $getrows['phone'];
                                $address = $getrows['address'];
                                $emailadd = $getrows['emailadd'];
                                $bookdate = $getrows['bookdate'];
                                $event = $getrows['event'];
                                $amount = $getrows['amount'];
                               
                                echo '
                                <tr>
                                    <td style="text-align: center;"> <span style="display: none;">'.$id.'</span>'.$booking_id.' </td>
                                    <td style="text-align: center;"> '.$firstname.' '.$lastname.'</td>
                                    <td style="text-align: center;"> '.$phone.' </td>
                                    <td style="text-align: center;"> '.$address.' </td>
                                    <td style="text-align: center;"> '.$emailadd.' </td>
                                    <td style="text-align: center;"> '.$bookdate.' </td>
                                    <td style="text-align: center;"> '.$event.' </td>
                                    <td style="text-align: center;"><a href="admin-booking-details.php? viewid='.$id.' & booking='.$booking_id.' "><button class="view">View</button></a></td>
                                    <td style="text-align: center;">';
                                        if($getrows['coordinator_1'] == 'Pending' || $getrows['coordinator_2'] == 'Pending' || $getrows['coordinator_3'] == 'Pending' || $getrows['coordinator_4'] == 'Pending' )
                                        {
                                            echo '<button class="disable-btn" name="reset_link" id="reset_link" disabled><i class="ri-check-line"></i></button>';
                                        } else if($getrows['coordinator_1'] == 'Declined' || $getrows['coordinator_2'] == 'Declined' || $getrows['coordinator_3'] == 'Declined' || $getrows['coordinator_4'] == 'Declined' ) {
                                            echo '<button class="disable-btn" name="reset_link" id="reset_link" disabled><i class="ri-check-line"></i></button>';

                                        } else {
                                            echo'<a href="approve.php? approveid='.$id.' & booking='.$booking_id.' & amount='.$amount.' "><button class="confirm-btn" onclick="return confirm(\'Are you sure you want to approve this booking?\')" name="reset_link" id="reset_link"><i class="ri-check-line"></i></button></a>';
                                        }
                                        echo'
                                        
                                        
                                        <a href="admin-booking-edit.php? editid='.$id.' & booking='.$booking_id.' "><button class="edit-btn"><i class="ri-pencil-line"></i></button></a>
                                        <a href="delete.php? deleteid='.$id.' & booking='.$booking_id.' "><button class="delete-btn" onclick="return confirm(\'Are you sure you want to delete?\')"><i class="ri-delete-bin-line"></i></button></a>
                                    </td>
                                </tr>
                                    ';


                            }
                        }
                    ?>
                </tbody>
            </table>

            <h3 style="font-size: 1.25em; font-weight: bolder; margin-top: 30px;">Approved Clients</h3>
            <table class="table-records" style="color: #fff;" id="approvedtable">
                <thead style="font-size: .8em; ">
                    <tr>
                        <th style="text-align: center;">Booking ID</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Contact</th>
                        <th style="text-align: center;">Address</th>
                        <th style="text-align: center;">Email Address</th>
                        <th style="text-align: center;">Date</th>
                        <th style="text-align: center;">Event Type</th>
                        <th style="text-align: center;">Details</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>

                <?php
                $query = "SELECT * FROM booking WHERE status = 'approved' ORDER BY bookdate ASC";
                $bookingresult = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($bookingresult)) 
                {
                    $id = $row['id'];
                    $booking_id = $row['booking_id'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $emailadd = $row['emailadd'];
                    $bookdate = $row['bookdate'];
                    $event = $row['event'];

                    echo '
                                <tr>
                                    <td style="text-align: center;"> <span style="display: none;">'.$id.'</span>'.$booking_id.' </td>
                                    <td style="text-align: center;"> '.$firstname.' '.$lastname.' </td>
                                    <td style="text-align: center;">'.$phone.' </td>
                                    <td style="text-align: center;">' .$address.' </td>
                                    <td style="text-align: center;"> '.$emailadd.' </td>
                                    <td style="text-align: center;"> '.$bookdate.' </td>
                                    <td style="text-align: center;"> '.$event.' </td>
                                    <td style="text-align: center;"><a href="admin-booking-details.php? viewid='.$id.' & booking='.$booking_id.' "><button class="view">View</button></a></td>
                                    <td style="text-align: center;">
                                        <a href="admin-booking-edit.php? editid='.$id.' & booking='.$booking_id.' "><button class="edit-btn"><i class="ri-pencil-line"></i></button></a>
                                        <a href="admindelete.php? deleteid='.$id.' & booking='.$booking_id.' "><button class="delete-btn" onclick="return confirm(\'Are you sure you want to delete?\')"><i class="ri-delete-bin-line"></i></button></a>
                                    </td>
                                </tr>
                                    ';
                
                }

                ?>

            </table>

            <h3 style="font-size: 1.25em; font-weight: bolder; margin-top: 30px;">Confirmed Clients</h3>
            <table class="table-records" style="color: #fff;" id="confirmedtable">
                <thead style="font-size: .8em; ">
                    <tr>
                        <th style="text-align: center;">Booking ID</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Contact</th>
                        <th style="text-align: center;">Address</th>
                        <th style="text-align: center;">Email Address</th>
                        <th style="text-align: center;">Date</th>
                        <th style="text-align: center;">Event Type</th>
                        <th style="text-align: center;">Details</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>

                <?php
                $query = "SELECT * FROM booking WHERE status = 'confirmed' ORDER BY bookdate ASC";
                $bookingresult = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($bookingresult)) 
                {
                    $id = $row['id'];
                    $booking_id = $row['booking_id'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $emailadd = $row['emailadd'];
                    $bookdate = $row['bookdate'];
                    $event = $row['event'];

                    echo '
                                <tr>
                                    <td style="text-align: center;"> <span style="display: none;">'.$id.'</span>'.$booking_id.' </td>
                                    <td style="text-align: center;"> '.$firstname.' '.$lastname.' </td>
                                    <td style="text-align: center;">'.$phone.' </td>
                                    <td style="text-align: center;">' .$address.' </td>
                                    <td style="text-align: center;"> '.$emailadd.' </td>
                                    <td style="text-align: center;"> '.$bookdate.' </td>
                                    <td style="text-align: center;"> '.$event.' </td>
                                    <td style="text-align: center;"><a href="admin-booking-details.php? viewid='.$id.' & booking='.$booking_id.' "><button class="view">View</button></a></td>
                                    <td style="text-align: center;">
                                       
                                        <a href="admindelete.php? deleteid='.$id.' & booking='.$booking_id.' "><button class="delete-btn" onclick="return confirm(\'Are you sure you want to delete?\')"><i class="ri-delete-bin-line"></i></button></a>
                                    </td>
                                </tr>
                                    ';
                
                }

                ?>

            </table>
           
        </div>
    </main>
    
    <script type="text/javascript">
        $(document).ready(function() {
        $('table').DataTable({
            "searching": true, // Enable searching/filtering
            "paging": true, // Enable pagination
            "order": [[0, "desc" ]], // Set the default sorting order (you can modify this as needed)
            "ordering": true, // Enable column sorting
            "columnDefs": [
            {
                "targets": [0, 7, 8], // Disable sorting for specific columns
                "orderable": false
            }
            ]
        });
        });

    </script>

</body>
</html>



