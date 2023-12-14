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
    <title>Anniversary | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS\anniversary.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="anniv-body">
    <!--header design-->
    <header>
        <a href="home.php" class="logo"><img src="CSS/Pictures/glamour-logo-white.png"></a>

        <div class="navbar" >
        <ul>
            <li><a href="home.php"  style="font-size: .8em">HOME</a></li>
            <li><a href="about.php" style="font-size: .8em">ABOUT</a></li>
            <li>
                <a href="events.php" style="font-size: .8em">EVENTS ▾</a>
                <ul class="dropdown">
                    <li><a href="wedding.php" style="font-size: .7em">Wedding</a></li>
                    <li><a href="birthday.php" style="font-size: .7em">Birthday</a></li>
                    <li><a href="christening.php" style="font-size: .7em">Christening</a></li>
                    <li><a href="anniversary.php" class="active" style="font-size: .7em">Anniversary</a></li>
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

    <!--anniv section top design-->
    <section class="anniv-banner" id="anniv-banner">
        <div class="anniv-banner-container">
            <h2>ANNIVERSARY</h2>
            <p>CELEBRATING ENDLESS LOVE</p>
            <div class="start-button">
                <a href="login.php"><button class="get-started">GET STARTED</button></a>
            </div>
        </div>
    </section>

    <!--anniv introduction section-->
    <section class="anniv-intro" id="anniv-intro">
        <div class="anniv-content1">
            <p>- Providing everything you need -</p>
        </div>
        <div class="anniv-row">
            <div class="anniv-column">
                <h2>BECAUSE YOUR LOVE
                <br>DESERVES TO BE
                <span><br>CELEBRATED</h2></span>
            </div>
            <div class="anniv-column">
                <p>We understand that anniversaries are not just another day, 
                    but a celebration of the love and commitment that two 
                    people share. Let us help you plan an anniversary celebration 
                    that reflects your unique love story and creates memories 
                    that will last a lifetime.</p>
            </div>
        </div>
    </section>

    <!--anniv display pic section-->
    <section class="anniv-display-pic" id="anniv-display-pic">
        <div class="anniv-displaypic">
            <img src="CSS/Pictures/anniversary/anniv-display-pic.png" alt="Display Photo" style="width: 100%;">
        </div>
    </section>

    <!--anniv services section-->
    <section class="anniv-services" id="anniv-services">
        <div class="anniv-row2">
            <div class="anniv-column2 anniv-left">
                <h2>MAKING EVERY LOVE STORY <span><br>EXTRA SPECIAL</span><br> <br> </h2>
                <div class="annivdisplaypic2">
                    <img src="CSS/Pictures/anniversary/anniv-displaypic2.png" alt="Display Photo" style="width: 80%;">
                </div>
                <div class="startplanning-button">
                    <a href="login.php"><button class="start-planning">START PLANNING NOW</button></a>
                </div>
            </div>
            <div class="anniv-column2 anniv-right">
                <h2>SERVICES</h2>
                <div class="anniv-venue">
                    <h3>Venue</h3>
                    <p>Celebrate your love and commitment in our charming 
                        anniversary venue, providing a romantic and intimate 
                        atmosphere to create a lasting memory of your special day.</p>
                </div>
                <div class="anniv-food-bev">
                    <h3>Cuisine</h3>
                    <p>Savor the moment with our exquisite food and beverage 
                        offerings, featuring an array of delectable and elegant 
                        dishes and drinks to add a touch of sophistication to 
                        your celebration.</p>
                </div>
                <div class="anniv-style-create">
                    <h3>Style & Creation</h3>
                    <ul class="anniv-style">
                        <li>Venue Styling</li>
                        <li>Theme and Design</li>
                    </ul>
                </div>
                <div class="anniv-extra-service">
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

    <!--anniversary venues-->
    <section class="venuesec" id="venuesec">
        <h4>- ANNIVERSARY VENUES -</h4>
        <button class="pre-btn"><i class="ri-arrow-right-s-line"></i></button>
        <button class="nxt-btn"><i class="ri-arrow-right-s-line"></i></button>
        <div class="venue-container">
        <?php
            $sql = "SELECT * FROM venues WHERE venuetype = 'Anniversary' AND venuename <> 'None'";
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
                        <img src="CSS/Pictures/anniversary/basic-anniversary.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/anniversary/sleek-anniversary.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/anniversary/polished-anniversary.png" alt="Display Photo" width="320">
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

        <h4>Theme and Design</h4>
        <div class="service-row">
            <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/anniversary/vintage-anniv.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Vintage</h5>
                    <p>A vintage theme could be a great way to celebrate an anniversary 
                        with a touch of nostalgia. Decorations could include vintage photos 
                        of the couple, antique decor like old clocks or telephones, and 
                        vintage-inspired centerpieces made of old books or records. The 
                        menu could feature classic dishes like meatloaf or apple pie, and 
                        entertainment could include a live band that plays music from the 
                        couple's era.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/anniversary/travel-anniv.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Travel</h5>
                    <p>For a couple that loves to travel, a travel theme could be a great 
                        option. Decorations could include vintage suitcases or globes, maps 
                        or postcards from the couple's favorite destinations, and centerpieces 
                        made of travel souvenirs like seashells or wine corks. The menu could 
                        feature international cuisine from the couple's favorite destinations, 
                        and entertainment could include a slideshow of the couple's travel photos 
                        or a travel-themed trivia game.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/anniversary/garden-anniv.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Garden</h5>
                    <p>For an anniversary party in the spring or summer, a garden party theme could 
                        be a great option. Decorations could include floral arrangements, string 
                        lights or lanterns, and centerpieces made of fresh flowers or herbs. The 
                        menu could feature light, fresh dishes like salads or grilled vegetables, 
                        and entertainment could include lawn games like croquet or bocce ball.</p>
                </div>
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/anniversary/hollywood-anniv.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Hollywood Glamour</h5>
                    <p>For a couple that loves classic Hollywood glamour, a Hollywood glamour theme 
                        could be a great option. Decorations could include a red carpet, elegant 
                        draping or backdrops, and centerpieces made of faux diamonds or pearls. The 
                        menu could feature classic dishes like steak or lobster, and entertainment 
                        could include a photo booth or a dance floor that's reminiscent of a classic 
                        Hollywood ballroom.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/anniversary/masquerade-anniv.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Masquerade Ball</h5>
                    <p>For a more formal anniversary celebration, a masquerade ball theme could be 
                        a great option. Decorations could include elegant masks, candlelight or 
                        chandeliers, and centerpieces made of feathers or glittery accents. The menu 
                        could feature elegant dishes like beef wellington or lobster bisque, and 
                        entertainment could include a live band or DJ that plays ballroom music.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/anniversary/rustic-anniv.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Rustic Chic</h5>
                    <p>A rustic chic party theme features a blend of natural and refined decor elements such as reclaimed wood, metallic accents, and soft textiles, that create a cozy and sophisticated atmosphere with a touch of vintage charm, while incorporating personalized details such as monogrammed linens or handmade favors to celebrate the couple's unique love story and style.</p>
                </div>
            </div>
        </div>
    </section>

    <!--anniv ending banner-->
    <section class="ending-banner" id="ending-banner">
        <div class="logo-story">
            <img src="CSS/Pictures/glamour-logo-white.png" alt="Logo" style="width:55px;">
        </div>
        <h2>MAY YOUR LOVE CONTINUE TO GROW<br>EACH AND EVERY YEAR</h2>
        <div class="start-button1">
            <a href="login.php"><button class="get-started1">- GET STARTED -</button></a>
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
                    <li><a href="wedding.php">Wedding</a></li>
                    <li><a href="birthday.php">Birthday</a></li>
                    <li><a href="christening.php">Christening</a></li>
                    <li><a href="#">Anniversary</a></li>
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


    <!--Linked-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>