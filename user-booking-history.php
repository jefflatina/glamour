<?php
session_start();

include("config.php");
include("function.php");

$user_data = check_login($connection);

$user_id = $_SESSION['user_id'];

$id = $_SESSION["user_id"];
$userresult = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
$userrow = mysqli_fetch_assoc($userresult);


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

            <a href="user-booking-history-details.php? viewid=<?= $rows['id'] ?> & booking=<? $rows['booking_id'] ?>">   
            <div class="history" style="margin-bottom: 20px;">
            
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
            
                <h3 style="text-transform: uppercase; color: #fff;">&nbsp;<?=$rows['event']?><br><span style="color: #fff;">&nbsp;<?=$rows['booking_id']?> | <?=$rows['bookdate']?></span></h3>
                <p style="text-transform: uppercase; color: #fff;" class="half-underline"><?=$rows['status']?></p>
            </div></a>


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
        // Get the modal element
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("details");

        // Get the close button element
        var closeButton = document.getElementsByClassName("back-button")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function () {
        modal.style.display = "block";
        };

        // When the user clicks on the close button, close the modal
        closeButton.onclick = function () {
        modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        };
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>