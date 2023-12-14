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
    <title>Birthday | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/birthday.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="birthday-body">
    <!--header design-->
    <header>
        <a href="home-logged.php" class="logo"><img src="CSS/Pictures/glamour-logo-white.png"></a>

        <div class="navbar">
        <ul>
            <li><a href="home-logged.php"  style="font-size: .8em">HOME</a></li>
            <li><a href="about-logged.php" style="font-size: .8em">ABOUT</a></li>
            <li>
                <a href="events-logged.php" style="font-size: .8em">EVENTS ▾</a>
                <ul class="dropdown">
                    <li><a href="wedding-logged.php" style="font-size: .7em">Wedding</a></li>
                    <li><a href="birthday-logged.php" class="active" style="font-size: .7em">Birthday</a></li>
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

    <!--section top design-->
    <section class="birthday-banner" id="birthday-banner">
        <div class="birthday-banner-container">
            <h2>BIRTHDAY</h2>
            <p>CELEBRATE YOUR SPECIAL DAY</p>
            <div class="start-button">
                <a href="birthdaybook.php"><button class="get-started">GET STARTED</button></a>
            </div>
        </div>
    </section>

    <!--birthday introduction section-->
    <section class="birthday-intro" id="birthday-intro">
        <div class="birthday-content1">
            <p>- Providing everything you need -</p>
        </div>
        <div class="birthday-row">
            <div class="birthday-column">
                <h2>WE HELP YOU TO GET
                <br>THE <span>PERFECT GIFT</span>
                <br>IN YOUR SPECIAL DAY</h2>
            </div>
            <div class="birthday-column">
                <p>Whether you're planning a small and intimate gathering 
                    or a large and lavish party, we are dedicated to bringing
                     your vision to life and exceeding your expectations. 
                     With our creativity, attention to detail, and commitment
                      to excellence, you can sit back, relax, and enjoy your 
                      special day while we take care of the rest.</p>
            </div>
        </div>
    </section>

    <!--birthday display pic section-->
    <section class="birthday-display-pic" id="birthday-display-pic">
        <div class="birthday-displaypic">
            <img src="CSS/Pictures/birthday/birthday-display-pic.png" alt="Display Photo" style="width: 100%;">
        </div>
    </section>

    <!--birthday services section-->
    <section class="birthday-services" id="birthday-services">
        <div class="birthday-row2">
            <div class="birthday-column2 birthday-left">
                <h2>MAKING YOUR BIRTHDAY<br>WISHES <span>COME TRUE</span><br> <br> </h2>
                <div class="birthdaydisplaypic2">
                    <img src="CSS/Pictures/birthday/birthday-displaypic2.png" alt="Display Photo" style="width: 80%;">
                </div>
                <div class="startplanning-button">
                    <a href="birthdaybook.php"><button class="start-planning">START PLANNING NOW</button></a>
                </div>
            </div>
            <div class="birthday-column2 birthday-right">
                <h2>SERVICES</h2>
                <div class="birthday-venue">
                    <h3>Venue</h3>
                    <p>Celebrate your special day in style at our versatile 
                        birthday venue, offering customizable packages and 
                        exceptional customer service to create an unforgettable 
                        experience for you and your guests.</p>
                </div>
                <div class="birthday-food-bev">
                    <h3>Cuisine</h3>
                    <p>Indulge in our mouth-watering and creative food and 
                        beverage offerings that cater to all tastes and 
                        preferences, making your birthday celebration an 
                        unforgettable experience.</p>
                </div>
                <div class="birthday-style-create">
                    <h3>Style & Creation</h3>
                    <ul class="birthday-style">
                        <li>Venue Styling</li>
                        <li>Theme and Design</li>
                    </ul>
                </div>
                <div class="birthday-extra-service">
                    <h3>Extra Services</h3>
                    <ul class="extraservice">
                        <li>DJ Services</li>
                        <li>Emcee</li>
                        <li>Photographer</li>
                        <li>Videographer</li>
                        <li>Makeup Artist</li>
                        <li>Bar Area</li>
                        <li>Invitation Cards</li>
                      </ul>
                </div>
            </div>
        </div>
    </section>

    <!--bday venues-->
    <section class="venuesec" id="venuesec">
        <h4>- BIRTHDAY VENUES -</h4>
        <button class="pre-btn"><i class="ri-arrow-right-s-line"></i></button>
        <button class="nxt-btn"><i class="ri-arrow-right-s-line"></i></button>
        <div class="venue-container">
        <?php
            $sql = "SELECT * FROM venues WHERE venuetype = 'Birthday' AND venuename <> 'None'";
            $res = mysqli_query($connection, $sql);
        
            if (mysqli_num_rows($res) > 0){
                while ($pic = mysqli_fetch_array($res)) { ?>
        
            <div class="venue-card">
                <div class="venue-image">
                    <a href="<?=$pic['venuepano']?>" target="_blank">
                        <img src="CSS/Pictures/venues/<?=$pic['venueimg']?>" class="venue-thumb">
                    </a>
                </div>
                <div class="venue-info">
                    <h2 class="venue-brand"><?=$pic['venuename']?></h2>
                    <p class="venue-short-description"><?=$pic['venueaddress']?></p>
                </div>
            </div>
            <?php  }
            }
        ?>
        </div>
    </section>

    <!--service details-->
    <section class="service-detail" id="service-detail">
        <h2>SERVICES OPTIONS</h2>
        <h3>Cuisine</h3>
        <div class="service-row">
        <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/normal.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Normal</h5>
                    <p>Normal cuisine offers a classic selection of dishes 
                        that cater to a variety of tastes. The bundle typically 
                        includes one choice of pasta, beef or pork, chicken, 
                        fish, starch, dessert, and beverage. This allows for 
                        flexibility in choosing your meal, while still providing 
                        a familiar and comforting experience.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/deluxe.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Deluxe</h5>
                    <p>The Deluxe bundle is the ultimate in luxury dining, 
                        featuring one choice of appetizer, soup, salad or 
                        vegetable, pasta, beef or pork, chicken, fish, starch, 
                        dessert, and beverage, all prepared to perfection for 
                        an unforgettable dining experience.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/royal.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Royal</h5>
                    <p>The Royal bundle offers a truly regal dining experience 
                        with an extensive selection of dishes to choose from. 
                        Enjoy a tantalizing appetizer, comforting soup, fresh 
                        salad, and vegetable of your choice. For the main course, 
                        indulge in pasta, beef, pork, chicken, and fish, all 
                        cooked to perfection and served with delicious starch. 
                        Satisfy your sweet tooth with three dessert options and 
                        choose from two beverages to complete your meal.</p>
                </div>
            </div>
        </div>

        <h3>Style & Creation</h3>
        
        <h4>Venue Styling</h4>
        <div class="service-row">
            <div class="service-column">
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/birthday/basic-birthday.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Basic</h5>
                    <p>For a basic venue styling, keep things simple with 
                        neutral colors, minimal decorations, and clean lines. 
                        Choose basic furniture and lighting to create a clean 
                        and modern look that is perfect for a casual or 
                        semi-formal celebration.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/birthday/sleek-birthday.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Sleek</h5>
                    <p>Create a sleek and modern atmosphere with bold colors, 
                        clean lines, and unique lighting fixtures. Incorporate 
                        modern furniture and minimal decorations to create an 
                        upscale, contemporary vibe that is perfect for a stylish 
                        and sophisticated celebration.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/birthday/polished-birthday.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Polished</h5>
                    <p>A polished venue styling exudes sophistication and elegance, 
                        incorporating rich fabrics like velvet and silk in bold 
                        colors such as gold and deep reds. Focus on elegant 
                        lighting, such as chandeliers, to add a touch of glamour 
                        to the space. Use luxurious decor and upscale furniture 
                        to create a high-end ambiance for a truly memorable 
                        celebration.</p>
                </div>
            </div>
        </div>

        <h4>Theme and Designs</h4>
        <div class="service-row">
            <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/birthday/bohemian-birthday.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Bohemian</h5>
                    <p>A bohemian party is typically characterized by a free-spirited, eclectic 
                        atmosphere that celebrates creativity, individuality, and non-conformity. 
                        The attire for a bohemian party is often inspired by the bohemian 
                        lifestyle, which emphasizes a relaxed, natural aesthetic and often 
                        incorporates elements of vintage, folk, and ethnic styles.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/birthday/tropical-birthday.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Tropical Party</h5>
                    <p>A tropical party is typically characterized by a bright, colorful, 
                        and fun atmosphere that celebrates the tropical vibe of a warm, sunny 
                        destination. The attire for a tropical party is often inspired by the 
                        island lifestyle, which emphasizes a relaxed, casual, and breezy 
                        aesthetic that is perfect for the beach or a poolside gathering.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/birthday/fairytale-birthday.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Fairytale</h5>
                    <p>A fairytale party is typically characterized by a magical, whimsical 
                        atmosphere that celebrates the enchantment of fairytales and fantasy 
                        worlds. The attire for a fairytale party is often inspired by the 
                        charming, romantic aesthetic of fairytales and may include elements 
                        of princess dresses, medieval costumes, and other fantasy-inspired 
                        fashion.</p>
                </div>
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/birthday/retro-birthday.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Retro</h5>
                    <p>A retro party is typically characterized by a fun, nostalgic atmosphere 
                        that celebrates the fashion and culture of a specific era from the past, 
                        such as the 1950s, 60s, 70s, or 80s. The attire for a retro party is often 
                        inspired by the iconic styles and trends of the chosen era and may include 
                        vintage clothing or modern reproductions that capture the essence of the 
                        time period.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/birthday/modern-birthday.png" alt="Display Photo" width="320">
                    </div>  
                    <h5>Modern</h5>
                    <p>A modern birthday party tends to prioritize the guest experience by creating a fun and engaging atmosphere that encourages socializing and creates a sense of community, often achieved through creative use of decor, lighting, and music, as well as providing unique food and drink options that reflect the guest of honor's personality and preferences.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/birthday/costume-birthday.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Costume</h5>
                    <p>A costume party for birthdays typically incorporates a fun and playful decoration theme, featuring bold and colorful decor elements such as balloons, streamers, and themed props that reflect the chosen costume theme, while creating a festive and interactive atmosphere that encourages guests to participate in the fun and festivities.</p>
                </div>
            </div>
        </div>
    </section>

    <!--birthday ending banner-->
    <section class="birthday-ending-banner" id="birthday-ending-banner">
        <div class="logo-story">
            <img src="CSS/Pictures/glamour-logo-white.png" alt="Logo" style="width:55px;">
        </div>
        <h2>LEAVE THE PLANNING TO US,<br>JUST ENJOY YOUR DAY</h2>
        <div class="start-button1">
            <a href="birthdaybook.php"><button class="get-started1">- GET STARTED -</button></a>
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
                    <li><a href="#">Birthday</a></li>
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
    <script src="script.js"></script>
</body>
</html>