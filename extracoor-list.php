<?php
session_start();


    include("config.php");
    include("function.php");


    $user_data = check_login($connection);


    //sa pagdisplay ng username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);


    //show pending
    $sql = "SELECT * FROM booking WHERE coordinator_4 = 'Pending' ORDER BY id DESC ";
    $bookingresult = mysqli_query($connection, $sql);

    //show approved
    $sql1 = "SELECT * FROM booking WHERE coordinator_4 = 'Approved' ";
    $bookingresult1 = mysqli_query($connection, $sql1);

    //show disapproved
    $sql2 = "SELECT * FROM booking WHERE coordinator_4 = 'Declined' ";
    $bookingresult2 = mysqli_query($connection, $sql2);



?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Book List | Coordinator</title>
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
                <img src="CSS/Pictures/uploads/extrapfp.png" alt="Profile Picture">
                <h4 style="color: #fff; font-weight: bolder; margin-bottom: 0px;"><?php echo $row["username"]; ?></h4>
                <p style="color: #fff;">Services Coordinator</p>
            </li>
            <!-- Left Nav Bar -->
            <li class="sidebar"><a href="extracoor-list.php" style="text-decoration: none;" class="active"><i class="ri-file-list-line"></i> Services Book List</a></li>
            <li class="sidebar"><a href="extracoor-calendar.php" style="text-decoration: none;"><i class="ri-calendar-line"></i> Calendar</a></li>
            <!-- Logout Button -->
		    <li class="logout-button">
			    <a href="logout.php" style="text-decoration: none;"><i class="ri-logout-box-line"></i> Logout</a>
		    </li>
        </ul>
    </header>

    <main style="color: #fff; font-size: .8em;">
        <div class="top-content">
            <h2>Services Book List</h2>
            <a href="extracoor-list.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container-adminlist" style="color: #fff;">
            <h3 style="font-size: 1.25em; font-weight: bolder;">Pending Services Bookings</h3>
            <table class="table-records" style="color: #fff;">
                <thead style="font-size: 1em; ">
                    <tr>
                        <th style="text-align: center;">Booking ID</th>
                        <th style="text-align: center;">Event</th>
                        <th style="text-align: center;">Services</th>
                        <th style="text-align: center;">Guests</th>
                        <th style="text-align: center;">Date/Time</th>
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
            $bookdate = $getrows['bookdate'];
            $event = $getrows['event'];

        $showbirthday = "SELECT * FROM birthday WHERE booking_id = '$booking_id' ";
        $birthresult = mysqli_query($connection, $showbirthday);
        if(mysqli_num_rows($birthresult)>0){
            $rows = mysqli_fetch_assoc($birthresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];

            if ($extra_services === "None") {
                continue;
            }
        }

        $showwedding = "SELECT * FROM wedding WHERE booking_id = '$booking_id' ";
        $weddingresult = mysqli_query($connection, $showwedding);
        if(mysqli_num_rows($weddingresult)>0){
            $rows = mysqli_fetch_assoc($weddingresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];

            if ($extra_services === "None") {
                continue;
            }
        }

        $showanniversary = "SELECT * FROM anniversary WHERE booking_id = '$booking_id' ";
        $anniversaryresult = mysqli_query($connection, $showanniversary);
        if(mysqli_num_rows($anniversaryresult)>0){
            $rows = mysqli_fetch_assoc($anniversaryresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];

            if ($extra_services === "None") {
                continue;
            }
        }

        $showchristening = "SELECT * FROM christening WHERE booking_id = '$booking_id' ";
        $christeningresult = mysqli_query($connection, $showchristening);
        if(mysqli_num_rows($christeningresult)>0){
            $rows = mysqli_fetch_assoc($christeningresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];

            if ($extra_services === "None") {
                continue;
            }
        }

        $showcorporate = "SELECT * FROM corporate WHERE booking_id = '$booking_id' ";
        $corporateresult = mysqli_query($connection, $showcorporate);
            if(mysqli_num_rows($corporateresult)>0){
                $rows = mysqli_fetch_assoc($corporateresult);
                $extra_services = $rows['extra_services'];
                $guest_number = $rows['guest_number'];

                if ($extra_services === "None") {
                    continue;
                }
            }
            
                       
                                echo '
                                <tr>
                                    <td style="text-align: center;"> <span style="display: none;">'.$id.'</span>'.$booking_id.' </td>
                                    <td style="text-align: center;"> '.$event.' </td>
                                    <td style="text-align: center;"> '.$extra_services.' </td>
                                    <td style="text-align: center;"> '.$guest_number.' </td>
                                    <td style="text-align: center;"> '.$bookdate.' </td>
                                    <td style="text-align: center;">
                                        <a href="extraapprove.php? approveid='.$id.' & booking='.$booking_id.' "><button class="confirm-btn" name="reset_link" id="reset_link" onclick="return confirm(\'Are you sure you want to perform this action? This cannot be undone.\')"><i class="ri-check-line"></i></button></a>
                                        <a href="extradisapprove.php? disapproveid='.$id.' & booking='.$booking_id.' "><button class="delete-btn" name="reset_link" id="reset_link" onclick="return confirm(\'Are you sure you want to perform this action? This cannot be undone.\')"><i class="ri-close-line"></i></button></a>
                                    </td>
                                </tr>
                                    ';
                            }
                        }
                    ?>

                </tbody>
          
            </table>

            <h3 style="font-size: 1.25em; font-weight: bolder; margin-top: 30px;">Accepted Services Bookings</h3>
            <table class="table-records" style="color: #fff;">
                <thead style="font-size: 1em; ">
                    <tr>
                        <th style="text-align: center;">Booking ID</th>
                        <th style="text-align: center;">Event</th>
                        <th style="text-align: center;">Services</th>
                        <th style="text-align: center;">Guests</th>
                        <th style="text-align: center;">Date/Time</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
        if($bookingresult1)
        {
            while($getrows = mysqli_fetch_assoc($bookingresult1))
        {
            $id = $getrows['id'];
            $booking_id = $getrows['booking_id'];
            $bookdate = $getrows['bookdate'];
            $event = $getrows['event'];

        $showbirthday = "SELECT * FROM birthday WHERE booking_id = '$booking_id' ";
        $birthresult = mysqli_query($connection, $showbirthday);
        if(mysqli_num_rows($birthresult)>0){
            $rows = mysqli_fetch_assoc($birthresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];
        }

        $showwedding = "SELECT * FROM wedding WHERE booking_id = '$booking_id' ";
        $weddingresult = mysqli_query($connection, $showwedding);
        if(mysqli_num_rows($weddingresult)>0){
            $rows = mysqli_fetch_assoc($weddingresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];
        }

        $showanniversary = "SELECT * FROM anniversary WHERE booking_id = '$booking_id' ";
        $anniversaryresult = mysqli_query($connection, $showanniversary);
        if(mysqli_num_rows($anniversaryresult)>0){
            $rows = mysqli_fetch_assoc($anniversaryresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];
        }

        $showchristening = "SELECT * FROM christening WHERE booking_id = '$booking_id' ";
        $christeningresult = mysqli_query($connection, $showchristening);
        if(mysqli_num_rows($christeningresult)>0){
            $rows = mysqli_fetch_assoc($christeningresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];
        }

        $showcorporate = "SELECT * FROM corporate WHERE booking_id = '$booking_id' ";
        $corporateresult = mysqli_query($connection, $showcorporate);
            if(mysqli_num_rows($corporateresult)>0){
                $rows = mysqli_fetch_assoc($corporateresult);
                $extra_services = $rows['extra_services'];
                $guest_number = $rows['guest_number'];
            }
            
                       
                                echo '
                                <tr>
                                    <td style="text-align: center;"> <span style="display: none;">'.$id.'</span>'.$booking_id.' </td>
                                    <td style="text-align: center;"> '.$event.' </td>
                                    <td style="text-align: center;"> '.$extra_services.' </td>
                                    <td style="text-align: center;"> '.$guest_number.' </td>
                                    <td style="text-align: center;"> '.$bookdate.' </td>
                                    <td style="text-align: center;">
                                        <a href="extradelete.php? deleteid='.$id.' & booking='.$booking_id.' "><button class="delete-btn" name="reset_link" id="reset_link" onclick="return confirm(\'Are you sure you want to delete?\')"><i class="ri-delete-bin-line"></i></button></a>
                                    </td>
                                </tr>
                                    ';
                            }
                        }
                    ?>

                </tbody>
          
            </table>

            <h3 style="font-size: 1.25em; font-weight: bolder; margin-top: 30px;">Declined  Services Bookings</h3>
            <table class="table-records" style="color: #fff;">
                <thead style="font-size: 1em; ">
                    <tr>
                        <th style="text-align: center;">Booking ID</th>
                        <th style="text-align: center;">Event</th>
                        <th style="text-align: center;">Services</th>
                        <th style="text-align: center;">Guests</th>
                        <th style="text-align: center;">Date/Time</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
        if($bookingresult2)
        {
            while($getrows = mysqli_fetch_assoc($bookingresult2))
        {
            $id = $getrows['id'];
            $booking_id = $getrows['booking_id'];
            $bookdate = $getrows['bookdate'];
            $event = $getrows['event'];

        $showbirthday = "SELECT * FROM birthday WHERE booking_id = '$booking_id' AND extra_services <> 'None' ";
        $birthresult = mysqli_query($connection, $showbirthday);
        if(mysqli_num_rows($birthresult)>0){
            $rows = mysqli_fetch_assoc($birthresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];
        }

        $showwedding = "SELECT * FROM wedding WHERE booking_id = '$booking_id' AND extra_services <> 'None' ";
        $weddingresult = mysqli_query($connection, $showwedding);
        if(mysqli_num_rows($weddingresult)>0){
            $rows = mysqli_fetch_assoc($weddingresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];
        }

        $showanniversary = "SELECT * FROM anniversary WHERE booking_id = '$booking_id' AND extra_services <> 'None' ";
        $anniversaryresult = mysqli_query($connection, $showanniversary);
        if(mysqli_num_rows($anniversaryresult)>0){
            $rows = mysqli_fetch_assoc($anniversaryresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];
        }

        $showchristening = "SELECT * FROM christening WHERE booking_id = '$booking_id' AND extra_services <> 'None' ";
        $christeningresult = mysqli_query($connection, $showchristening);
        if(mysqli_num_rows($christeningresult)>0){
            $rows = mysqli_fetch_assoc($christeningresult);
            $extra_services = $rows['extra_services'];
            $guest_number = $rows['guest_number'];
        }

        $showcorporate = "SELECT * FROM corporate WHERE booking_id = '$booking_id' AND extra_services <> 'None' ";
        $corporateresult = mysqli_query($connection, $showcorporate);
            if(mysqli_num_rows($corporateresult)>0){
                $rows = mysqli_fetch_assoc($corporateresult);
                $extra_services = $rows['extra_services'];
                $guest_number = $rows['guest_number'];
            }
            
                       
                                echo '
                                <tr>
                                    <td style="text-align: center;"> <span style="display: none;">'.$id.'</span>'.$booking_id.' </td>
                                    <td style="text-align: center;"> '.$event.' </td>
                                    <td style="text-align: center;"> '.$extra_services.' </td>
                                    <td style="text-align: center;"> '.$guest_number.' </td>
                                    <td style="text-align: center;"> '.$bookdate.' </td>
                                    <td style="text-align: center;">
                                        <a href="extradelete.php? deleteid='.$id.' & booking='.$booking_id.' "><button class="delete-btn" name="reset_link" id="reset_link" onclick="return confirm(\'Are you sure you want to delete?\')"><i class="ri-delete-bin-line"></i></button></a>
                                    </td>
                                </tr>
                                    ';
                            }
                        }
                    ?>

                </tbody>
          
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
                "targets": [0, 1, 2, 5],
                "orderable": false
                }]
            });
        });
    </script>
</body>
</html>



