<?php
session_start();

include("config.php");
include("function.php");

$user_data = check_login($connection);

$user_id = $_SESSION['user_id'];

$id = $_SESSION["user_id"];
$userresult = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
$userrow = mysqli_fetch_assoc($userresult);

$viewid = $_GET['viewid'];
$booking = $_GET['booking'];

    $bookresult = "SELECT * FROM booking WHERE id = '$viewid' ";
    $bookquery = mysqli_query($connection, $bookresult);

    if($bookquery)
    {
        $bookrow = mysqli_fetch_assoc($bookquery);

        $id = $bookrow['id'];
        $booking_id = $bookrow['booking_id'];
        
        $showbirthday = "SELECT * FROM birthday WHERE booking_id = '$booking_id' ";
        $birthresult = mysqli_query($connection, $showbirthday);
        if(mysqli_num_rows($birthresult)>0){
            $row = mysqli_fetch_assoc($birthresult);
            $checkbox = $row['extra_services'];
            $services = explode(",", $checkbox);
        }

        $showwedding = "SELECT * FROM wedding WHERE booking_id = '$booking_id' ";
        $weddingresult = mysqli_query($connection, $showwedding);
        if(mysqli_num_rows($weddingresult)>0){
            $row = mysqli_fetch_assoc($weddingresult);
            $checkbox = $row['extra_services'];
            $services = explode(",", $checkbox);
        }

        $showanniversary = "SELECT * FROM anniversary WHERE booking_id = '$booking_id' ";
        $anniversaryresult = mysqli_query($connection, $showanniversary);
        if(mysqli_num_rows($anniversaryresult)>0){
            $row = mysqli_fetch_assoc($anniversaryresult);
            $checkbox = $row['extra_services'];
            $services = explode(",", $checkbox);
        }

        $showchristening = "SELECT * FROM christening WHERE booking_id = '$booking_id' ";
        $christeningresult = mysqli_query($connection, $showchristening);
        if(mysqli_num_rows($christeningresult)>0){
            $row = mysqli_fetch_assoc($christeningresult);
            $checkbox = $row['extra_services'];
            $services = explode(",", $checkbox);
        }

        $showcorporate = "SELECT * FROM corporate WHERE booking_id = '$booking_id' ";
        $corporateresult = mysqli_query($connection, $showcorporate);
            if(mysqli_num_rows($corporateresult)>0){
                $row = mysqli_fetch_assoc($corporateresult);
                $checkbox = $row['extra_services'];
                $services = explode(",", $checkbox);
            }


        
    }

     //get page number
     if (isset($_GET['page_no']) && $_GET['page_no'] !=="") {
        $page_no = $_GET['page_no'];
    } else {
          $page_no = 1;  
    }
    
    //total rows or records to display
    $total_records_per_page = 3;
    //get the page offset for the LIMIT query
    $offset = ($page_no - 1) * $total_records_per_page;

    //get prev page
    $prev_page = $page_no - 1;
    //get next page
    $next_page = $page_no + 1;
    //get total count of records
    $result_count = mysqli_query($connection, "SELECT COUNT(*) as total_records FROM booking WHERE user_id = '$user_id' ");
    //total records
    $records = mysqli_fetch_array($result_count);
    //store total_records to a variable
    $total_records = $records['total_records'];
    //get total pages
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/user-booking-history.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="https://kit.fontawesome.com/a79ec82bd5.js" crossorigin="anonymous"></script>
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="contact-body">
    <!--header design-->
    <header>
        <a href="home-logged.php" class="logo"><img src="CSS/Pictures/glamour-logo-white.png"></a>

        <div class="navbar">
        <ul>
            <li><a href="home-logged.php" style="font-size: .8em">HOME</a></li>
            <li><a href="about-logged.php" style="font-size: .8em">ABOUT</a></li>
            <li>
                <a href="events-logged.php" style="font-size: .8em">EVENTS ▾</a>
                <ul class="dropdown">
                    <li><a href="wedding-logged.php" style="font-size: .7em">Wedding</a></li>
                    <li><a href="birthday-logged.php" style="font-size: .7em">Birthday</a></li>
                    <li><a href="christening-logged.php" style="font-size: .7em">Christening</a></li>
                    <li><a href="anniversary-logged.php" style="font-size: .7em">Anniversary</a></li>
                    <li><a href="corporate-logged.php" style="font-size: .7em">Corporate</a></li>
                </ul>
            </li>
            <li><a href="contact-logged.php" style="font-size: .8em">CONTACT</a></li>
            <li><a href="budget.php" style="font-size: .8em">BUDGET</a></li>
        </ul>
        </div>

        <div class="account-logged">
            <a href="user-profile.php? editid='.$id.' " class="fullname">
                <?php echo $userrow["firstname"] . ' ' . $userrow["lastname"]; ?>
            </a>
            <a href="user-profile.php? editid='.$id.' " class="pic">
                <img src="CSS/Pictures/uploads/adminpfp.png" alt="Profile Picture">
            </a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
        
    </header>

    <div class="grid-container">
        <div class="small-column">
            <h5>PROFILE ACCOUNT</h5>
            <!-- Left Nav Bar -->
            <li class="sidebar"><a href="user-profile.php">Personal Information</a></li>
            <li class="sidebar"><a href="user-booking-history.php" class="active">Booking History</a></li>
            <?php
                echo '<li class="sidebar"><a href="user-profile-settings.php? editid='.$user_id.' ">Account Settings</a></li>'
            ?>
            <li class="sidebar"><a href="logout.php" style="color: #999;">Logout Account</a></li>
        </div>
        
        <div class="large-column" style="height: auto;">
            <h4>BOOKING HISTORY</h4>

            <?php
            $sql = "SELECT * FROM booking WHERE user_id = '$user_id' LIMIT $offset , $total_records_per_page";
            $res = mysqli_query($connection, $sql);

        
            if (mysqli_num_rows($res) > 0){
                while ($rows = mysqli_fetch_array($res)) { ?>

            <div class="history" style="margin-bottom: 20px;" id="details">
            
            <?php
                if ($rows['event'] == 'Wedding') {
                    echo '<i class="fa-solid fa-dove"></i>';
                } elseif ($rows['event'] == 'Birthday') {
                    echo '<i class="fa-solid fa-cake-candles"></i>';
                } elseif ($rows['event'] == 'Christening') {
                    echo '<i class="fa-solid fa-baby"></i>';
                } elseif ($rows['event'] == 'Anniversary') {
                    echo '<i class="fa-solid fa-hand-holding-heart"></i>';
                } else {
                    echo '<i class="fa-solid fa-building-user"></i>';
                }
            ?>
            
                <h3 style="text-transform: uppercase;">&nbsp;<?=$rows['event']?><br><span>&nbsp;<?=$rows['booking_id']?> | <?=$rows['bookdate']?></span></h3>
                <p style="text-transform: uppercase;" class="half-underline"><?=$rows['status']?></p>
            </div>


            <!------modal for booking details ------->
            <div id="myModal" class="modal">
                            <div class="modal-content" style="background: #383838; width: 50%;  border-radius: 20px;">
                                <h1 style="font-family: Judson; color: var(--main-color); font-size: 3em;">BOOKING DETAILS</h1>
                                <h2 style=" font-family: Poppins; color: var(--text-color); font-size: 1em; font-weight: 500; margin-top: 10px; margin-bottom: 20px;">ACCOUNT INFORMATION</h2>
                                <div class="grid-container2">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">First Name</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $bookrow['firstname']; ?></p>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Last Name</h3>
                                        <p style="height:30px; font-size: 13px; padding: 5px 15px;"><?php echo $bookrow['lastname']; ?></p>
                                    </div>
                                </div>
                                <div class="column-container">
                                    <div class="column-item">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Address</h3>
                                        <p style="height:30px; font-size: 13px; padding: 5px 15px; margin-bottom: 10px;"><?php echo $bookrow['address']; ?></p>
                                    </div>
                                </div>
                                <div class="grid-container2">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Email Address</h3>
                                        <p style="height:30px; font-size: 13px; padding: 5px 15px;"><?php echo $bookrow['emailadd']; ?></p>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Contact Number</h3>
                                        <p style="height:30px; font-size: 13px; padding: 5px 15px;"><?php echo $bookrow['phone']; ?></p>
                                    </div>
                                </div>

                                <h2 style=" font-family: Poppins; color: var(--text-color); font-size: 1em; font-weight: 500; margin-top: 20px; margin-bottom: 20px;">EVENT BOOKING INFORMATION</h2>
                                <div class="grid-container2">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Event Type</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $bookrow['event']; ?></p>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Booking ID</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $bookrow['booking_id']; ?></p>
                                    </div>
                                </div>
                                <div class="grid-container2">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Date</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $bookrow['bookdate']; ?></p>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Venue</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $row['venue']; ?></p>
                                    </div>
                                </div>
                                <div class="grid-container2">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Celebrant's Age</h3>
                                        <?php if($row['upcoming_age'] != 0) { ?>
                                            <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $row['upcoming_age']; ?></p>
                                                <?php } else { ?>
                                                    <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo ""; ?></p>
                                                <?php } ?>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Celebrant's Gender</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $row['celeb_gender']; ?></p>
                                    </div>
                                </div>
                                <div class="grid-container2">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Cuisine</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $row['cuisine']; ?></p>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Estimated Guest Number</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $row['guest_number']; ?></p>
                                    </div>
                                </div>
                                <div class="grid-container2">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Venue Styling</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $row['style']; ?></p>
                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Theme and Design</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;"><?php echo $row['theme_design']; ?></p>
                                    </div>
                                </div>

                                <div class="column-container">
                                    <div class="column-item">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Extra Services</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px; margin-bottom: 10px;"><?php echo $row['extra_services']; ?></p>
                                    </div>
                                </div>
                                <div class="column-container">
                                    <div class="column-item">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Other Preferences</h3>
                                        <p style="height: 100px; font-size: 13px; padding: 5px 15px;"><?php echo $row['other_preferences']; ?></p>
                                    </div>
                                </div>

                                <h2 style=" font-family: Poppins; color: var(--text-color); font-size: 1em; font-weight: 500; margin-top: 10px; margin-bottom: 20px;">PAYMENT INFORMATION</h2>
                                <div class="grid-container2">
                                    <div class="column1">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Total Event Cost</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;">Php <?php echo number_format($bookrow['amount'], 2, '.', ','); ?></p>

                                    </div>
                                    <div class="column2">
                                        <h3 style="font-family: Poppins; color: var(--text-color);">Downpayment Cost</h3>
                                        <p style="height: 30px; font-size: 13px; padding: 5px 15px;">Php <?php echo number_format($bookrow['amount']/2, 2, '.', ','); ?></p>

                                    </div>
                                </div>

                                <div class="button-container">
                                
                                    <div class="button-group">
                                        <button class="back-button" onclick="goBack()">BACK</button>
                                        <button class="approve-button" style="width: 100%;" onclick="window.location.href='contact-logged.php'">CONTACT ADMIN</button>
                                    </div>
                                </div>
                            </div>
                        </div>

            <?php  }
            }
        ?>
        <div class="pendingpagecontainer">

            <div class="pendingpagenum">
                <br><h4>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?></h4>
            </div>

            <nav class="pendingpagination">
                <ul class="pagination">

                    <li class="prevnext"><a class="prevnext <?= ($page_no <= 1) ?
                    'disabled' : ''; ?>" <?= ($page_no > 1) ? 'href=?page_no=' .
                    $prev_page : ''; ?>>PREV</a></li>
                    
                    <?php for($counter = 1; $counter <= $total_no_of_pages; $counter++) { ?>
                        <?php if ($page_no !== $counter) { ?>
                            <li class="page-item"><a class="page-item-notactive" href="?page_no=<?=
                            $counter; ?>"><?= $counter; ?></a></li>
                        <?php } else { ?>
                            <li class="page-item-active"><a class="page-item-active"><?=
                            $counter; ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    

                    <li class="prevnext"><a class="prevnext <?= ($page_no >= $total_no_of_pages) ?
                    'disabled' : ''; ?>" <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' .
                    $next_page : ''; ?>>NEXT</a></li>

                </ul>
            </nav>

            </div>
        </div>
    </div>
                        
    <!--footer section-->
    <footer>
        <div class="container">
            <div class="sec aboutus">
                <h2>About Us</h2>
                <p> We believe that a successful event is 
                    a result of careful planning, attention 
                    to detail, and seamless execution. We 
                    are committed to providing exceptional 
                    service, and making the planning process 
                    enjoyable and stress-free for our clients. 
                    Let us take your event to the next level and 
                    create a truly unforgettable experience for you 
                    and your guests.</p>
                    <ul class="sci">
                    <li><a href="https://www.facebook.com/profile.php?id=100095125500013" target="_blank"><i class="ri-facebook-circle-fill"></i></a></li>
                        <li><a href="https://www.instagram.com/glam_events2023/?igshid=MzNlNGNkZWQ4Mg%3D%3D" target="_blank"><i class="ri-instagram-fill"></i></a></li>
                        <li><a href="https://twitter.com/glam_events2023?t=KZThjURK6V11GqgPpu7sEQ&s=07" target="_blank"><i class="ri-twitter-fill"></i></a></li>
                    </ul>
            </div>
            <div class="sec quicklinks">
                <h2>Event Links</h2>
                <ul>
                    <li><a href="wedding-logged.php">Wedding</a></li>
                    <li><a href="birthday-logged.php">Birthday</a></li>
                    <li><a href="christening-logged.php">Christening</a></li>
                    <li><a href="anniversary-logged.php">Anniversary</a></li>
                    <li><a href="corporate-logged.php">Corporate</a></li>
                </ul>
            </div>
            <div class="sec contact">
                <h2>Contact Info</h2>
                <ul class="info">
                    <li>
                        <span><i class="ri-map-pin-fill"></i></span>
                        <span>Intramuros Manila,<br>Philippines</span>
                    </li>
                    <li>
                        <span><i class="ri-phone-fill"></i></span>
                        <p><a href="tel:09651626236">0965 162 6236</a><br></p>
                    </li>
                    <li>
                        <span><i class="ri-mail-open-fill"></i></span>
                        <p><a href="mailto:glamourevents2023@gmail.com">glamourevents2023@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div> 
    </footer>
    <div class="copyright">
        <p>&copy; 2023 Glamour Events. All Rights Reserved.</p>
    </div>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>