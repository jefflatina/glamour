<?php
session_start();

    include("config.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/about.css">
    
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="about-body" style="background-image: url(CSS/Pictures/about/about-bg.png);" style="width: 100%;">
    <!--header design-->
    <header>
        <a href="home.php" class="logo"><img src="CSS/Pictures/glamour-logo-white.png"></a>

        <div class="navbar" >
        <ul>
            <li><a href="home.php"  style="font-size: .8em">HOME</a></li>
            <li><a href="about.php" class="active" style="font-size: .8em">ABOUT</a></li>
            <li>
                <a href="events.php" style="font-size: .8em">EVENTS ▾</a>
                <ul class="dropdown">
                    <li><a href="wedding.php" style="font-size: .7em">Wedding</a></li>
                    <li><a href="birthday.php" style="font-size: .7em">Birthday</a></li>
                    <li><a href="christening.php" style="font-size: .7em">Christening</a></li>
                    <li><a href="anniversary.php" style="font-size: .7em">Anniversary</a></li>
                    <li><a href="corporate.php" style="font-size: .7em">Corporate</a></li>
                </ul>
            </li>
            <li><a href="contact.php" style="font-size: .8em">CONTACT</a></li>
            <li><a href="login.php" style="font-size: .8em">BUDGET</a></li>
        </ul>
        </div>

        <div class="account">
            <a href="signup.php" class="signup" style="font-size: .8em">Sign up</a>
            <a href="login.php" class="login" style="font-size: .8em">Login</a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
        
    </header>
    
    <section class="about-us" id="about-us">
        <h2>ABOUT US</h2>
        <p>Welcome! We are Pamantasan ng Lungsod ng Maynila (PLM) students with a Bachelor of Science 
            in Information Technology. We believe that a successful event is the result of thorough preparation, 
            careful attention to detail, and flawless execution. We are committed to providing exceptional 
            service and making the planning process enjoyable and stress-free for our clients. Let us take your 
            event to the next level and provide you and your visitors with an unforgettable experience.</p>
    </section>
    <section class="team" id="team">
        <h4>- THE TEAM -</h4>
            <div class="team-row">
                <div class="team-column">
                    <div class="wrapper1">
                        <img src="CSS/Pictures/about/cabalsi.jpg" width="80%">
                        <p>Cabalsi, Glaidelyn M.</p>
                    </div>
                    <div class="wrapper2">
                        <img src="CSS/Pictures/about/salazar.jpg" width="80%">
                        <p>Salazar, Ariz Ann C.</p>
                    </div>
                </div>
                <div class="team-column">
                    <div class="wrapper1">
                        <img src="CSS/Pictures/about/genova.jpg" width="80%">
                        <p>Genova, Cyreene Lyn A.</p>
                    </div>
                    <div class="wrapper2">
                        <img src="CSS/Pictures/about/sanchez.png" width="80%">
                        <p>Sanchez, Joervy R.</p>
                    </div>
                </div>
                <div class="team-column">
                    <div class="wrapper1">
                        <img src="CSS/Pictures/about/latina.png" width="80%">
                        <p>Latina, Jeffrey V.</p>
                    </div>
                    <div class="wrapper2">
                        <img src="CSS/Pictures/about/vallejo.png" width="80%">
                        <p>Vallejo, Elnard Don M.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="vms" id="vms">
        <h4>VISION</h4>
        <p>Our vision is to be a leading event management company that delivers exceptional 
            experiences and creates long-lasting memories for our clients and their guests. 
            We strive to be known for our creativity, attention to detail, and unparalleled 
            customer service.</p>
        <p><br>&nbsp;</p>
        <h4>MISSION</h4>
        <p>Our mission is to provide our clients with the highest level of event management 
            services. We aim to exceed our clients' expectations by offering innovative solutions 
            that cater to their unique needs and requirements. We commit to providing a seamless 
            and stress-free event planning process, from conception to execution. We value open 
            communication, collaboration, and professionalism in all aspects of our business, 
            and we prioritize building lasting relationships with our clients and partners.</p>
            <p><br>&nbsp;</p>
        <h4>SERVICE</h4>
        <p>Our event management service is dedicated to delivering exceptional event planning, 
            organization, and execution to our clients. Our team of prepared event managers is 
            committed to providing individualized care and superior customer service. We endeavor 
            to exceed clients' expectations and create lasting memories for them and their guests.</p>
            <p><br>&nbsp;</p>
    </section>

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
                    <li><a href="wedding.php">Wedding</a></li>
                    <li><a href="birthday.php">Birthday</a></li>
                    <li><a href="christening.php">Christening</a></li>
                    <li><a href="anniversary.php">Anniversary</a></li>
                    <li><a href="corporate.php">Corporate</a></li>
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