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
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Events | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/events.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>
</head>

<body>
    <!--header design-->
    <header>
        <a href="home-logged.php" class="logo"><img src="CSS/Pictures/glamour-logo-white.png"></a>

        <div class="navbar">
        <ul>
            <li><a href="home-logged.php" style="font-size: .8em">HOME</a></li>
            <li><a href="about-logged.php" style="font-size: .8em">ABOUT</a></li>
            <li>
                <a href="events-logged.php"  class="active" style="font-size: .8em">EVENTS ▾</a>
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

    <section class="home">
      <video
        class="video-slide active"
        src="CSS/Pictures/events/wedding.mp4"
        autoplay
        muted
        loop
      ></video>
      <video class="video-slide" src="CSS/Pictures/events/bday.mp4" autoplay muted loop></video>
      <video class="video-slide" src="CSS/Pictures/events/christening.mp4" autoplay muted loop></video>
      <video class="video-slide" src="CSS/Pictures/events/anniv.mp4" autoplay muted loop></video>
      <video class="video-slide" src="CSS/Pictures/events/corporate.mp4" autoplay muted loop></video>

      <div class="content active">
        <h1>WEDDING</h1>
        <p>
            We understand that planning a wedding can be a daunting 
            task, which is why we're here to help make the process 
            stress-free and enjoyable. Our team of experienced wedding 
            planners is dedicated to bringing your vision to life. 
            Whether you're looking for a traditional wedding or 
            something more unique and personalized, we're committed 
            to making your special day unforgettable.
        </p>
        <div class="start-button">
            <a href="wedding-logged.php"><button class="get-started">SEE DETAILS</button></a>
        </div>
      </div>

      <div class="content">
        <h1>BIRTHDAY</h1>
        <p>
            Let us help you celebrate in style! Our Birthday 
            Planners take the stress out of party planning, So 
            you can focus on enjoying your special day. From 
            Theme Selection to Vendor Coordination and Entertainment, 
            we handle every detail to ensure a memorable experience 
            for you and your guests. Whether you're celebrating a 
            Milestone Birthday or just want to throw a Fun Party!
        </p>
        <div class="start-button">
            <a href="birthday-logged.php"><button class="get-started">SEE DETAILS</button></a>
        </div>
      </div>

      <div class="content">
        <h1>CHRISTENING</h1>
        <p>
            Making your Baby's Christening Celebration unforgettable
             - Our Expert Party Planners help you create a beautiful
              and meaningful event. From Venue Selection to Customized
               Decor and Delicious Catering, we take care of every detail.
                Let us handle the planning, so you can enjoy the special 
                moments with your loved ones. </p>
        <div class="start-button">
            <a href="christening-logged.php"><button class="get-started">SEE DETAILS</button></a>
        </div>
      </div>

      <div class="content">
        <h1>ANNIVERSARY</h1>
        <p>
            Make your anniversary celebration unforgettable with our 
            Expert Party Planning Services. Our experienced event 
            planners will work with you every step of the way to 
            create a unique and personalized Anniversary Party that 
            reflects your Love Story. From Venue Selection and Decor
             to Entertainment, we handle all the details
              to ensure a seamless and memorable experience. 
        </p>
        <div class="start-button">
            <a href="anniversary-logged.php"><button class="get-started">SEE DETAILS</button></a>
        </div>
      </div>

      <div class="content">
        <h1>CORPORATE</h1>
        <p>
            Our team of event planners will take care of everything, 
            from choosing the perfect venue to creating a seamless registration process. 
            We'll work closely with you to ensure your event reflects your brand and 
            exceeds your expectations. Our goal is to create a truly memorable experience 
            for your guests, leaving a lasting impression that will have them talking about 
            your event long after it's over.
        </p>
        <div class="start-button">
            <a href="corporate.php"><button class="get-started">SEE DETAILS</button></a>
        </div>
      </div>


      <div class="slider-navigation">
        <div class="nav-btn active"></div>
        <div class="nav-btn"></div>
        <div class="nav-btn"></div>
        <div class="nav-btn"></div>
        <div class="nav-btn"></div>
      </div>
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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="events.js"></script>

</body>
</html>