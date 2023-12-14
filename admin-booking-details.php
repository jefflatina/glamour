<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    //show admin name sa side
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);

    //show coordinator name sa php sa taas
    $coord1 = mysqli_query($connection, "SELECT username FROM users WHERE user_status = 'Venue Coordinator'");
    $coordrow1 = mysqli_fetch_assoc($coord1);

    $coord2 = mysqli_query($connection, "SELECT username FROM users WHERE user_status = 'Catering Coordinator'");
    $coordrow2 = mysqli_fetch_assoc($coord2);

    $coord3 = mysqli_query($connection, "SELECT username FROM users WHERE user_status = 'Style Coordinator'");
    $coordrow3 = mysqli_fetch_assoc($coord3);

    $coord4 = mysqli_query($connection, "SELECT username FROM users WHERE user_status = 'Extra Services Coordinator'");
    $coordrow4 = mysqli_fetch_assoc($coord4);


    $viewid = $_GET['viewid'];
    $booking = $_GET['booking'];
    
    $bookresult = "SELECT * FROM booking WHERE id = '$viewid' ";
    $bookquery = mysqli_query($connection, $bookresult);

    if($bookquery)
    {
        $bookrow = mysqli_fetch_assoc($bookquery);

        $id = $bookrow['id'];
        $booking_id = $bookrow['booking_id'];
        
        $showbirthday = "SELECT * FROM birthday WHERE booking_id = '$booking' ";
        $birthresult = mysqli_query($connection, $showbirthday);
        if(mysqli_num_rows($birthresult)>0){
            $rows = mysqli_fetch_assoc($birthresult);
            $checkbox = $rows['extra_services'];
            $services = explode(",", $checkbox);
        }

        $showwedding = "SELECT * FROM wedding WHERE booking_id = '$booking' ";
        $weddingresult = mysqli_query($connection, $showwedding);
        if(mysqli_num_rows($weddingresult)>0){
            $rows = mysqli_fetch_assoc($weddingresult);
            $checkbox = $rows['extra_services'];
            $services = explode(",", $checkbox);
        }

        $showanniversary = "SELECT * FROM anniversary WHERE booking_id = '$booking' ";
        $anniversaryresult = mysqli_query($connection, $showanniversary);
        if(mysqli_num_rows($anniversaryresult)>0){
            $rows = mysqli_fetch_assoc($anniversaryresult);
            $checkbox = $rows['extra_services'];
            $services = explode(",", $checkbox);
        }

        $showchristening = "SELECT * FROM christening WHERE booking_id = '$booking' ";
        $christeningresult = mysqli_query($connection, $showchristening);
        if(mysqli_num_rows($christeningresult)>0){
            $rows = mysqli_fetch_assoc($christeningresult);
            $checkbox = $rows['extra_services'];
            $services = explode(",", $checkbox);
        }

        $showcorporate = "SELECT * FROM corporate WHERE booking_id = '$booking' ";
        $corporateresult = mysqli_query($connection, $showcorporate);
            if(mysqli_num_rows($corporateresult)>0){
                $rows = mysqli_fetch_assoc($corporateresult);
                $checkbox = $rows['extra_services'];
                $services = explode(",", $checkbox);
            }


        
    }


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
</head>

<body>
    <header>
        <ul class="left-nav">
            <!-- Profile Section -->
            <li class="profile-section">
                <img src="CSS/Pictures/uploads/adminpfp.png" alt="Profile Picture">
                <h4><?php echo $row["username"]; ?></h4>
                <p>Administrator</p>
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
			    <a href="logout.php"><i class="ri-logout-box-line"></i> Logout</a>
		    </li>
        </ul>
    </header>

    <main>
        <div class="top-content">
            <h2>Event Book List</h2>
            <a href="admin-bookinglist.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container">
            <h3>Event Details</h3>

            <div class="bookingdetails-row1">
                <div class="bookingdetails-2column">
                    <h5>Primary Contact Person</h5>
                    <p><?php echo $bookrow['firstname']." ".$bookrow['lastname']; ?></p>
                </div>

                <div class="bookingdetails-2column">
                    <h5>Generated Cost</h5>
                    <p>PHP <?php echo number_format($bookrow['amount'], 2, '.', ','); ?></p>
                </div>
            </div>
                    
            <div class="bookingdetails-row2">
                
                <div class="bookingdetails-4column">
                    <h5>Event Type</h5>
                    <p><?php echo $bookrow['event']; ?></p>
                </div>

                <div class="bookingdetails-4column">
                    <h5>Celebrant's Age</h5>
                    <?php if($rows['upcoming_age'] != 0) { ?>
                        <p><?php echo $rows['upcoming_age']; ?></p>
                            <?php } else { ?>
                                <p><?php echo ""; ?></p>
                            <?php } ?>
                </div>
                
                <div class="bookingdetails-4column">
                    <h5>Celebrant's Gender</h5>
                    <p><?php echo $rows['celeb_gender']; ?></p>
                </div>

                <div class="bookingdetails-4column">
                    <h5>Venue</h5>
                    <p><?php echo $rows['venue']; ?></p>
                </div>
                
            </div>

            <div class="bookingdetails-row3">

                <div class="bookingdetails-4column">
                    <h5>Cuisine</h5>
                    <p><?php echo $rows['cuisine']; ?></p>
                </div>

                <div class="bookingdetails-4column">
                    <h5>Guests</h5>
                    <p><?php echo $rows['guest_number']; ?></p>
                </div>

                <div class="bookingdetails-4column">
                    <h5>Venue Styling</h5>
                    <p><?php echo $rows['style']; ?></p>
                </div>

                <div class="bookingdetails-4column">
                    <h5>Theme and Design</h5>
                    <p><?php echo $rows['theme_design']; ?></p>
                </div>
            </div>

            <div class="bookingdetails-row4">             
                <div class="bookingdetails-2column">
                    <h5>Extra Services</h5>
                    <p><?php echo $rows['extra_services']; ?></p>
                </div>

                <div class="bookingdetails-2column">
                    <h5>Other Preferences</h5>
                    <p><?php echo $rows['other_preferences']; ?></p>
                </div>
            </div>
            

            <div class="titleandbutton1">
                <h3>Coordinator Approvance</h3>
                <?php
                echo '<a href="declined.php? declinedid='.$id.' & booking='.$booking_id.' "><button class="send-btn">Send Email&nbsp;&nbsp;<i class="ri-send-plane-fill"></i></button></a> ';
                ?>
            </div>

            <div class="bookingdetails-row6">
                <div class="bookingdetails-4column">
                    <div class = "coorapprovance">
                        <div class="venuetitle" style="background-color: #4CA377; width: 80px;"><i class="ri-map-pin-line"></i>&nbsp;Venue</div>
                        <p class="approve"><?php echo $bookrow['coordinator_1']; ?><p>
                        <p class="usernamecoor"><?php echo $coordrow1['username']; ?></p>
                    </div>
                </div>
                
                <div class="bookingdetails-4column">
                    <div class = "coorapprovance">
                        <div class="cuisinetitle" style="background-color: #6877CF; width: 90px;"><i class="ri-pie-chart-2-fill"></i>&nbsp;Cuisine</div>
                        <p class="approve"><?php echo $bookrow['coordinator_2']; ?><p>
                        <p class="usernamecoor"><?php echo $coordrow2['username']; ?></p>
                    </div>
                </div>
                    
                <div class="bookingdetails-4column">
                    <div class = "coorapprovance">
                        <div class="styletitle" style="background-color: #A25FAE; width: 150px;"><i class="ri-scissors-line"></i>&nbsp;Style & Creation</div>
                        <p class="approve"><?php echo $bookrow['coordinator_3']; ?><p>
                        <p class="usernamecoor"><?php echo $coordrow3['username']; ?></p>
                    </div>
                </div>
                
                <div class="bookingdetails-4column">
                    <div class = "coorapprovance" >
                        <div class="extratitle" style="background-color: #D45978; width: 130px;"><i class="ri-brush-fill"></i>&nbsp;Extra Services</div>
                        <p class="approve"><?php echo $bookrow['coordinator_4']; ?><p>
                        <p class="usernamecoor"><?php echo $coordrow4['username']; ?></p>
                    </div>
                </div>
            </div>
            

            <a href="admin-bookinglist.php"><button type="menu" class="back-btn">BACK</button></a>
            <div class="clear"></div>


        </div>
    </main>
</body>
</html>