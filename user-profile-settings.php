<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    $user_id = $_SESSION['user_id'];
    
    $id = $_SESSION["user_id"];
    $userresult = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $userrow = mysqli_fetch_assoc($userresult);

    $eid = $_GET['editid'];

    if(isset($_GET['editid']))
    {
        $user_id = $_SESSION['user_id'];
        $eid = $_GET['editid'];

        $show = "SELECT * FROM users WHERE user_id = '$eid' ";
        $showres = mysqli_query($connection, $show);
        if($showres)
        {
            while($showrows = mysqli_fetch_assoc($showres))
            {
                $firstname = $showrows['firstname'];
                $lastname = $showrows['lastname'];
                $email = $showrows['email'];
                $username = $showrows['username'];
                $address = $showrows['address'];
                $phone = $showrows['phone'];
            }
        }
    }

    

    //update
    if(isset($_POST['update'])){
        $eid = $_GET['editid'];

        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $conpass = $_POST['conpass'];
        $email = $_POST['email'];
        

        $firstname = ucwords($firstname);
        $lastname = ucwords($lastname);
        $address = ucwords($address);
                
        if($password == $conpass){
            $passhash = $password;
            $hashed_password = password_hash($passhash, PASSWORD_DEFAULT);
            $sql = mysqli_query($connection, "UPDATE users SET username='$username', firstname='$firstname', 
            lastname='$lastname', email='$email', address='$address', phone='$phone', password='$hashed_password' WHERE user_id ='$eid' ");
                if($sql){
                    echo "<script>alert('You have successfully updated your profile information.');</script>";
                    echo "<script>document.location='user-profile.php';</script>";
                }    
        } else {
            echo "<script>alert('Passwords do not match.');</script>";
            echo "<script>window.history.back();</script>";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/user-profile.css">
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
            <li class="sidebar"><a href="user-booking-history.php">Booking History</a></li>
            <li class="sidebar"><a href="user-profile-settings.php" class="active">Account Settings</a></li>
            <li class="sidebar"><a href="logout.php" style="color: #999;">Logout Account</a></li>
        </div>
        <div class="large-column">
            <h4>ACCOUNT SETTINGS</h4>
            <form action="" method="POST">
                <div class="grid">
                    <div class="grid-item grid-item-2">
                        <h6>FIRST NAME</h6>
                        <p><i class="ri-user-fill"></i>&nbsp;&nbsp;
                        <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required placeholder="Enter your first name"></p>
                    </div>
                    <div class="grid-item grid-item-2">
                        <h6>LAST NAME</h6>
                        <p><i class="ri-user-line"></i>&nbsp;&nbsp;
                        <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>" required placeholder="Enter your last name"></p>
                    </div>
                    <div class="grid-item grid-item-2">
                        <h6>USERNAME</h6>
                        <p><i class="ri-user-heart-fill"></i>&nbsp;&nbsp;
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required placeholder="Enter your username"></p>
                    </div>
                    <div class="grid-item grid-item-2">
                        <h6>EMAIL ADDRESS</h6>
                        <p><i class="ri-mail-fill"></i>&nbsp;&nbsp;
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required placeholder="Enter your email address"></p>
                    </div>
                    <div class="grid-item grid-item-2">
                        <h6>ADDRESS</h6>
                        <p><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;
                        <input type="text" id="address" name="address" value="<?php echo $address; ?>" required placeholder="Enter your address"></p>
                    </div>
                    <div class="grid-item grid-item-2">
                        <h6>CONTACT NUMBER</h6>
                        <p><i class="fa-solid fa-address-card"></i>&nbsp;&nbsp;
                        <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" required placeholder="Enter your contact number"></p>
                    </div>
                    <div class="grid-item grid-item-2">
                        <h6>PASSWORD</h6>
                        <p><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;
                        <input type="password" name="password" id="password" required placeholder="Enter your password"></p>
                    </div>
                    <div class="grid-item grid-item-2">
                        <h6>CONFIRM PASSWORD</h6>
                        <p><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;
                        <input type="password" name="conpass" id="conpass" required placeholder="Re-enter your password"></p>
                    </div>
                </div>
                <div class="button-container">
                    <a href="user-profile.php"><h5 class="back-btn">BACK</h5></a>
                    <button type="submit" class="save-btn" name="update">SAVE</button>
                </div>
            </form>
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

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>