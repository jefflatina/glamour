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
    <title>Corporate Events | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS\corporate.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="corporate-body">
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
                    <li><a href="anniversary.php" style="font-size: .7em">Anniversary</a></li>
                    <li><a href="corporate.php" class="active" style="font-size: .7em">Corporate</a></li>
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

    <!--corporate section top design-->
    <section class="corporate-banner" id="corporate-banner">
        <div class="corporate-banner-container">
            <h2>CORPORATE</h2>
            <p style="font-size: 30px;">UNLOCKING POTENTIAL THROUGH TEAMWORK</p>
            <div class="start-button">
                <a href="login.php"><button class="get-started">GET STARTED</button></a>
            </div>
        </div>
    </section>

    <!--corporate introduction section-->
    <section class="corporate-intro" id="corporate-intro">
        <div class="corporate-content1">
            <p>- Providing everything you need -</p>
        </div>
        <div class="corporate-row">
            <div class="corporate-column">
                <h2>UNITING FOR A
                <br><span>COMMON PURPOSE</span></h2>  
            </div>
            <div class="corporate-column">
                <p>Create an unforgettable experience with our corporate 
                    event planning services. From concept to execution, 
                    we handle every detail to ensure a seamless and successful 
                    event. Elevate your brand and make meaningful connections 
                    with industry leaders, all while enjoying a fun-filled 
                    evening of entertainment and delicious cuisine. Let us 
                    help you make your vision a reality.</p>
            </div>
        </div>
    </section>

    <!--corporate display pic section-->
    <section class="corporate-display-pic" id="corporate-display-pic">
        <div class="corporate-displaypic">
            <img src="CSS/Pictures/corporate/corporate-display-pic.png" alt="Display Photo" style="width: 100%;">
        </div>
    </section>

    <!--corporate services section-->
    <section class="corporate-services" id="corporate-services">
        <div class="corporate-row2">
            <div class="corporate-column2 corporate-left">
                <h2>"BRINGING YOUR <span>VISION </span><br>TO LIFE"<br><br></h2>
                <div class="corporate-displaypic2">
                    <img src="CSS/Pictures/corporate/corporate-display-pic2.jpg" alt="Display Photo" style="width: 80%;">
                </div>
                <div class="startplanning-button">
                    <a href="login.php"><button class="start-planning">START PLANNING NOW</button></a>
                </div>
            </div>
            <div class="corporate-column2 corporate-right">
                <h2>SERVICES</h2>
                <div class="corporate-venue">
                    <h3>Venue</h3>
                    <p>It is an ideal setting for you and
                    your colleagues to enjoy a delightful event that will be remembered
                    for years to come.</p>
                </div>
                <div class="corporate-food-bev">
                    <h3>Cuisine</h3>
                    <p>Our catering service is designed to impress and
                    delight your attendees with exceptional cuisine that perfectly
                    complements your event's theme and style.</p>
                </div>
                <div class="corporate-style-create">
                    <h3>Style & Creation</h3>
                    <p>Encompasses all the visual elements that will create the
                    atmosphere of your corporate event. The design should
                    complement your event's objectives and create a cohesive look
                    and feel throughout the venue, leaving a lasting impression
                    on your team</p>
                </div>
                <div class="corporate-extra-service">
                    <h3>Extra Services</h3>
                    <ul class="extraservice">
                        <li>DJ Services</li>
                        <li>Emcee</li>
                        <li>Photographer</li>
                        <li>Videographer</li>
                        <li>Bar Area</li>
                        <li>Invitation Cards</li>
                      </ul>
                </div>
            </div>
        </div>
    </section>

    <!--corporate venues-->
    <section class="venuesec" id="venuesec">
        <h4>- CORPORATE EVENTS VENUES -</h4>
        <button class="pre-btn"><i class="ri-arrow-right-s-line"></i></button>
        <button class="nxt-btn"><i class="ri-arrow-right-s-line"></i></button>
        <div class="venue-container">

        <?php
            $sql = "SELECT * FROM venues WHERE venuetype = 'Corporate' AND venuename <> 'None'";
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
                        <img src="CSS/Pictures/corporate/basic-corporate.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/corporate/sleek-corporate.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/corporate/polished-corporate.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/corporate/hollywood-corp.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Hollywood Glamour</h5>
                    <p>Arrange an exquisite corporate event with a Hollywood Glamour theme, invoking  
                    the opulence and elegance of classic Hollywood. Adorn the venue with glittering
                    decorations, such as crystal chandeliers, red carpets, and plush velvet drapes.  
                    To bring the Hollywood Glamour theme to life, encourage guests to dress up in  
                    formal attire, reminiscent of the golden era of Hollywood. Welcome guests with
                    champagne and other elegant cocktails, to create a sophisticated and glamorous
                    atmosphere.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/corporate/bnw-corp.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Black and White Ball</h5>
                    <p>A black and white ball is an elegant and timeless event, featuring a classic and sophisticated dress code of black and white formal attire, along with monochromatic decor elements such as white flowers, black linens, and dramatic lighting, that create a glamorous and sophisticated atmosphere, perfect for a night of dancing and celebration.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/corporate/costume-corp.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Costume Party</h5>
                    <p>Design a unique and engaging corporate event with a costume party theme that encourages
                    guests to dress up in their favorite costumes. Decorate the venue with vibrant and colorful
                    decorations that match the theme of the event. To enhance the experience, consider incorporating
                    fun activities like a costume contest, photo booth, or other group games. Consider serving
                    themed food and drinks to complement the overall ambiance of the event.</p>
                </div>
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/corporate/vintage-corp.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Vintage Chic</h5>
                    <p>Organize a corporate event with a vintage chic theme that embraces classic elements from
                    the past with a modern twist. Incorporate antique or vintage-inspired decor such as floral
                    patterns, and old-fashioned lighting fixtures. Create a fresh and modern look by pairing
                    vintage decor with contemporary styling. To complement the vintage chic theme, serve upscale
                    appetizers and drinks that reflect classic elegance, such as champagne and gourmet hors
                    d'oeuvres.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/corporate/sport-corp.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Sports-themed Event</h5>
                    <p>Plan an engaging and spirited corporate event with a sports theme that celebrates the love
                    of athletics. Transform the venue with decorations that showcase the chosen sport, such as
                    team colors, logos, and athletic gear. Incorporate fun sports activities, such as mini-games,
                    trivia challenges, or interactive simulations, to keep guests engaged and entertained throughout
                    the event. Provide themed food and drinks that celebrate the chosen sport or team.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/corporate/masquerade-corp.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Masquerade Ball</h5>
                    <p>A masquerade ball theme is a popular choice for parties, featuring luxurious decor elements such as ornate masks, rich fabrics, and dramatic lighting, that create a mysterious and enchanting atmosphere, while adding a touch of glamour and sophistication to the event. Guests are encouraged to dress in formal attire and don masks, adding an air of intrigue and romance to the celebration.</p>
                </div>
            </div>
        </div>
    </section>

    <!--corporate ending banner-->
    <section class="ending-banner" id="ending-banner">
        <div class="logo-story">
            <img src="CSS/Pictures/glamour-logo-white.png" alt="Logo" style="width:55px;">
        </div>
        <h2>OPPORTUNITIES DON'T HAPPEN, <br>YOU CREATE THEM.</h2>
        <div class="start-button1">
            <a href="corporatebook.php"><button class="get-started1">- GET STARTED -</button></a>
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
                    <li><a href="#">Corporate</a></li>
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