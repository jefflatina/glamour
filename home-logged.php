<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    //userprofile button
    $id = $_SESSION["user_id"];
    $userresult = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $userrow = mysqli_fetch_assoc($userresult);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">

    <!--css link-->
    <link rel="stylesheet" href="CSS/homestyle.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <!--header design-->
    <header>
        <a href="home-logged.php" class="logo"><img src="CSS/Pictures/glamour-logo-white.png"></a>

        <div class="navbar">
        <ul>
            <li><a href="home-logged.php" class="active" style="font-size: .8em">HOME</a></li>
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

    <!--banner section design-->
    <section class="banner" id="banner">
        <div class="home-banner">

            <div class="logo-banner">
                <img src="CSS/Pictures/glamour-logo.png" alt="Logo" style="width:130px;">
            </div>
            <h2>GLAMOUR</h2>
            <p>PLAN TO PERFECTION</p>
            <div class="book-button">
                <a href="events-logged.php"><button class="book-event">BOOK AN EVENT</button></a>
            </div>
            <div class="down">
                <a href="#intro"><i class="ri-arrow-down-s-line"></i></i></a>
            </div>
        </div>
    </section>

    <!--introduction section design-->
    <section class="intro" id="intro">
        <div class="lightbubble" id="lightbubble">
            <img src="CSS/Pictures/lightbubble.png" alt="bubble" style="width:600px">
        </div>
        <div class="home-content">
            <p>At GLAMOUR, we pride ourselves on delivering exceptional events 
                that leave a lasting impression. Let us take the stress out of 
                planning and create a truly unforgettable experience for you 
                and your guests as we bring your luxurious vision into life.</p>
        </div>
        <div class="divider" id="divider">
            <img src="CSS/Pictures/lineaccent.png" class="lineaccent">
        </div>
    </section>

    <!--events section design-->

    <section class="eventssec" id="eventssec">

        <div class="lightbubble1" id="lightbubble1">
            <img src="CSS/Pictures/lightbubble.png" alt="bubble" style="width:600px">
        </div>
        
        <div class="wedding-pic">
            <img src="CSS/Pictures/home/wedding.png" style="width: 500px;">
        </div>
        <div class="wedding-pic2">
            <img src="CSS/Pictures/home/wedding2.png" style="width: 500px;">
        </div>
        <div class="wedding">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>WEDDING</h2>
            <p>Start your journey to a perfect wedding <br> you've always dreamed of</p>
            <div class="seemore-button">
                <a href="wedding-logged.php"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>

    <!--birthday section-->

        <div class="lightbubble2" id="lightbubble2">
            <img src="CSS/Pictures/lightbubble.png" alt="bubble" style="width:600px">
        </div>

        <div class="birthday-pic">
            <img src="CSS/Pictures/home/birthday.png" style="width: 500px;">
        </div>
        <div class="birthday-pic2">
            <img src="CSS/Pictures/home/birthday2.png" style="width: 500px;">
        </div>
        <div class="birthday">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>BIRTHDAY</h2>
            <p>Creating magical memories,<br>one birthday at a time</p>
            <div class="seemore-button">
                <a href="birthday-logged.php"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>

    <!--christening section-->
    <div class="lightbubble3" id="lightbubble3">
        <img src="CSS/Pictures/lightbubble.png" alt="bubble" style="width:600px">
    </div>

        <div class="christening-pic">
            <img src="CSS/Pictures/home/christening.png" style="width: 500px;">
        </div>
        <div class="christening-pic2">
            <img src="CSS/Pictures/home/christening2.png" style="width: 500px;">
        </div>
        <div class="christening">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>CHRISTENING</h2>
            <p>From ceremony to celebration,<br>make it a day to remember</p>
            <div class="seemore-button">
                <a href="christening-logged.php"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>

    <!--anniversary section-->
    <div class="lightbubble4" id="lightbubble4">
        <img src="CSS/Pictures/lightbubble.png" alt="bubble" style="width:600px">
    </div>

        <div class="anniversary-pic">
            <img src="CSS/Pictures/home/anniversary.png" style="width: 500px;">
        </div>
        <div class="anniversary-pic2">
            <img src="CSS/Pictures/home/anniversary2.png" style="width: 500px;">
        </div>
        <div class="anniversary">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>ANNIVERSARY</h2>
            <p>Celebrating a year of love and happiness</p>
            <p>&nbsp;</p>
            <div class="seemore-button">
                <a href="anniversary-logged.php"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>

    <!--corporate section-->
    <div class="lightbubble5" id="lightbubble5">
        <img src="CSS/Pictures/lightbubble.png" alt="bubble" style="width:600px">
    </div>
        <div class="corporate-pic">
            <img src="CSS/Pictures/home/corporate.png" style="width: 500px;">
        </div>
        <div class="corporate-pic2">
            <img src="CSS/Pictures/home/corporate2.png" style="width: 500px;">
        </div>
        <div class="corporate">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>CORPORATE</h2>
            <p>Experience seamless corporate </p>
            <p>events with us</p>
            <div class="seemore-button">
                <a href="corporate-logged.php"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>

    </section>

    <!--full story section-->
    <section class="storysec" id="storysec">
        <div class="logo-story">
            <img src="CSS/Pictures/glamour-logo-white.png" alt="Logo" style="width:55px;">
        </div>

        <h3>GLAMOUR</h3>
        <h1>WHERE CREATIVITY MEETS <br> FLAWLESS EXECUTION</h1>
        <p>At GLAMOUR, we understand that every event is unique and deserves a personalized touch. Whether you're planning a wedding, birthday celebration, or any other special occasion, we'll work closely with you to ensure that every detail is tailored to your specific needs and preferences.
        <br><br>WEDDING | BIRTHDAY | CHRISTENING | ANNIVERSARY | CORPORATE<br><br></p>
        <div class="fullstory-button">
            <a href="about-logged.php"><button class="full-story">FULL STORY</button></a>
        </div>
    </section>

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
    

    <!--Linked-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!---js link--->
    <script src="bgmusicscript.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>
</html>