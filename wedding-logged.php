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
    <title>Wedding | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/wedding.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="wedding-body">
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
                    <li><a href="wedding-logged.php" class="active" style="font-size: .7em">Wedding</a></li>
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

    <!--wedding section top design-->
    <section class="wedding-banner" id="wedding-banner">
        <div class="wedding-banner-container">
            <h2>WEDDING</h2>
            <p>ONCE IN A LIFETIME EVENT</p>
            <div class="start-button">
                <a href="weddingbook.php"><button class="get-started">GET STARTED</button></a>
            </div>
        </div>
    </section>

    <!--wedding introduction section-->
    <section class="wedding-intro" id="wedding-intro">
        <div class="wedding-content1">
            <p>- Providing everything you need -</p>
        </div>
        <div class="wedding-row">
            <div class="wedding-column">
                <h2>WE HELP YOU TO GET
                <br>THE <span>PERFECT WEDDING</span>
                <br>IN YOUR LIFE</h2>
            </div>
            <div class="wedding-column">
                <p>At our core, we believe that every wedding should be a 
                    reflection of the couple's unique style and personality. 
                    That's why we take the time to get to know our clients, 
                    understand their vision, and work closely with them to bring 
                    it to life. We pride ourselves on our attention to detail, 
                    creative approach, and commitment to making every moment memorable.</p>
            </div>
        </div>
    </section>

    <!--wedding display pic section-->
    <section class="wedding-display-pic" id="wedding-display-pic">
        <div class="wedding-displaypic">
            <img src="CSS/Pictures/wedding/wedding-display-pic.png" alt="Display Photo" style="width: 100%;">
        </div>
    </section>

    <!--wedding services section-->
    <section class="wedding-services" id="wedding-services">
        <div class="wedding-row2">
            <div class="wedding-column2 wedding-left">
                <h2>FROM 'YES' TO 'I DO': LET <br> US PLAN YOUR <span>DREAM WEDDING!</span><br> <br> </h2>
                <div class="weddingdisplaypic2">
                    <img src="CSS/Pictures/wedding/wed-displaypic2.png" alt="Display Photo" style="width: 80%;">
                </div>
                <div class="startplanning-button">
                    <a href="weddingbook.php"><button class="start-planning">START PLANNING NOW</button></a>
                </div>
            </div>
            <div class="wedding-column2 wedding-right">
                <h2>SERVICES</h2>
                <div class="wedding-venue">
                    <h3>Venue</h3>
                    <p>Our venues offer a stunning setting for 
                        your special day. Our beautifully 
                        landscaped grounds feature beach, 
                        garden, and churches. </p>
                </div>
                <div class="wedding-food-bev">
                    <h3>Cuisine</h3>
                    <p>Menu options include a variety of appetizers, 
                        entrees, and desserts that can be customized 
                        to suit your tastes and preferences. From 
                        normal to deluxe to royal cuisine options,
                         we have something to satisfy every palate. </p>
                </div>
                <div class="wedding-style-create">
                    <h3>Style & Creation</h3>
                    <ul class="wedding-style">
                        <li>Venue Styling</li>
                        <li>Wedding Themes</li>
                    </ul>
                </div>
                <div class="wedding-extra-service">
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

    <!--wedding venues-->
    <section class="weddingvenuesec" id="weddingvenuesec">
        <h4>- WEDDING VENUES -</h4>
        <button class="pre-btn"><i class="ri-arrow-right-s-line"></i></button>
        <button class="nxt-btn"><i class="ri-arrow-right-s-line"></i></button>
        <div class="venue-container">

        <?php
            $sql = "SELECT * FROM venues WHERE venuetype = 'Wedding' AND venuename <> 'None'";
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

    <!--wedding service details-->
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
                        <img src="CSS/Pictures/wedding/basic-wedding.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/wedding/sleek-wedding.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/wedding/polished-wedding.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/wedding/beach-wedding.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Beach</h5>
                    <p>A beach wedding reception features decor inspired by the
                    ocean, such as seashells, driftwood, and blue and green hues.
                    This theme is perfect for couples who love the beach and want
                    a casual, relaxed atmosphere.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/wedding/vintage-wedding.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Vintage</h5>
                    <p>A vintage wedding reception features antique or vintage-inspired
                    decor, such as lace tablecloths, old-fashioned glassware, and mismatched
                    furniture. This theme is perfect for couples who love all things retro.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/wedding/garden-wedding.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Garden</h5>
                    <p>A garden wedding reception features florals, greenery, and
                    natural elements like wooden tables and chairs. This theme is
                    perfect for outdoor weddings and creates a romantic, whimsical
                    atmosphere.</p>
                </div>
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/wedding/rustic-wedding.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Rustic</h5>
                    <p>A rustic wedding reception features natural elements like wood,
                    burlap, and wildflowers. This theme is perfect for outdoor or barn
                    weddings and creates a cozy, relaxed atmosphere.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/wedding/modern-wedding.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Modern</h5>
                    <p>A modern wedding reception features clean lines, minimalistic
                    decor, and a focus on geometric shapes and metallic accents.
                    This theme is perfect for couples who prefer a sleek, sophisticated
                    look.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/wedding/fairytale-wedding.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Fairytale</h5>
                    <p>A fairy tale theme is perfect for a wedding with a magical,
                    romantic feel. This includes soft colors like blush and lavender,
                    and fairy lights and flowers throughout the decor.</p>
                </div>
            </div>
        </div>
    </section>

    <!--wedding ending banner-->
    <section class="wedding-ending-banner" id="wedding-ending-banner">
        <div class="logo-story">
            <img src="CSS/Pictures/glamour-logo-white.png" alt="Logo" style="width:55px;">
        </div>
        <h2>CREATING MEMORIES <br>THAT LAST A LIFETIME</h2>
        <div class="start-button1">
            <a href="weddingbook.php"><button class="get-started1">- GET STARTED -</button></a>
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
                    <li><a href="#">Wedding</a></li>
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
    <script src="script.js"></script>
</body>
</html>