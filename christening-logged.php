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
    <title>Christening | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS\christening.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="christening-body">
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
                    <li><a href="birthday-logged.php" style="font-size: .7em">Birthday</a></li>
                    <li><a href="christening-logged.php" class="active" style="font-size: .7em">Christening</a></li>
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
    <section class="christening-banner" id="christening-banner">
        <div class="christening-banner-container">
            <h2>CHRISTENING</h2>
            <p>CELEBRATING NEW BEGINNINGS</p>
            <div class="start-button">
                <a href="christeningbook.php"><button class="get-started">GET STARTED</button></a>
            </div>
        </div>
    </section>

    <!--christening introduction section-->
    <section class="christening-intro" id="christening-intro">
        <div class="christening-content1">
            <p>- Providing everything you need -</p>
        </div>
        <div class="christening-row">
            <div class="christening-column">
                <h2>FROM INVITATIONS
                <br>TO <span>FAVORS</span>, WE'VE
                <br>GOT YOU COVERED
                
            </div>
            <div class="christening-column">
                <p>We understand that your child's christening is a
                     once-in-a-lifetime event that deserves to be
                      celebrated in a meaningful and memorable way. 
                      That's why we specialize in creating personalized 
                      and unique christening parties that perfectly 
                      capture the spirit of this special occasion.</p>
            </div>
        </div>
    </section>

    <!--christening display pic section-->
    <section class="christening-display-pic" id="christening-display-pic">
        <div class="christening-displaypic">
            <img src="CSS/Pictures/christening/christening-display-pic.png" alt="Display Photo" style="width: 100%;">
        </div>
    </section>

    <!--christening services section-->
    <section class="christening-services" id="christening-services">
        <div class="christening-row2">
            <div class="christening-column2 christening-left">
                <h2>FROM BAPTISM TO CELEBRATION, <br>LET US PLAN YOUR<span> CHRISTENING</span> <br> <br> </h2>
                <div class="christeningdisplaypic2">
                    <img src="CSS/Pictures/christening/christening-displaypic2.png" alt="Display Photo" style="width: 80%;">
                </div>
                <div class="startplanning-button">
                    <a href="christeningbook.php"><button class="start-planning">START PLANNING NOW</button></a>
                </div>
            </div>
            <div class="christening-column2 christening-right">
                <h2>SERVICES</h2>
                <div class="christening-venue">
                    <h3>Venue</h3>
                    <p>Celebrate your baby's christening in a serene and 
                        elegant venue that provides a perfect setting for 
                        a memorable event.</p>
                </div>
                <div class="christening-food-bev">
                    <h3>Cuisine</h3>
                    <p>Enjoy a delightful culinary experience with our 
                        specialized christening catering service that 
                        offers a variety of delicious dishes and drinks 
                        to cater to your guests' needs.</p>
                </div>
                <div class="christening-style-create">
                    <h3>Style & Creation</h3>
                    <ul class="christening-style">
                        <li>Venue Styling</li>
                        <li>Theme and Design</li>
                    </ul>
                </div>
                <div class="christening-extra-service">
                    <h3>Extra Services</h3>
                    <ul class="extraservice">
                        <li>Emcee</li>
                        <li>Photographer</li>
                        <li>Videographer</li>
                        <li>Invitation Cards</li>
                      </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- venues-->
    <section class="venuesec" id="venuesec">
        <h4>- CHRISTENING VENUES -</h4>
        <button class="pre-btn"><i class="ri-arrow-right-s-line"></i></button>
        <button class="nxt-btn"><i class="ri-arrow-right-s-line"></i></button>
        <div class="venue-container">
        <?php
            $sql = "SELECT * FROM venues WHERE venuetype = 'Christening' AND venuename <> 'None'";
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
                        <img src="CSS/Pictures/christening/basic-christening.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/christening/sleek-christening.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/christening/polished-christening.png" alt="Display Photo" width="320">
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
                        <img src="CSS/Pictures/christening/garden-christening.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Garden Party</h5>
                    <p>A garden party theme could be a great way to celebrate a 
                        christening, especially if the event is taking place during 
                        the spring or summer. The decorations could include floral 
                        arrangements, hanging lanterns, and rustic wooden accents. 
                        A garden party could also include outdoor games and activities, 
                        such as croquet or bocce ball.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/christening/beach-christening.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Beach Party</h5>
                    <p>For a coastal or tropical christening, a beach party theme could 
                        be a great option. Decorations could include seashells, sand, 
                        and ocean-inspired decor such as sailboats or starfish. Guests 
                        could enjoy beachy snacks like seafood or fruit skewers, and games 
                        like beach volleyball or frisbee.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/christening/vintage-christening.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Vintage Tea Party</h5>
                    <p>A vintage tea party theme could be a great way to celebrate a 
                        christening with a touch of nostalgia. Decorations could include 
                        lace doilies, vintage teapots and cups, and pastel floral arrangements. 
                        Guests could enjoy finger sandwiches, scones, and petit fours, and play 
                        games like croquet or lawn bowling.</p>
                </div>
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/christening/rustic-christening.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Rustic Barn Party</h5>
                    <p>A rustic barn party theme could be a great way to celebrate a christening 
                        in a charming and laid-back way. Decorations could include burlap accents, 
                        wooden signs, and mason jars filled with wildflowers. Guests could enjoy 
                        BBQ or farm-to-table style fare.</p>
                </div>
            </div>
            <div class="service-column">
                <div class="light-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/christening/fairytale-christening.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Fairytale Party</h5>
                    <p>For a more whimsical christening celebration, a fairytale theme could be a 
                        great option. Decorations could include a castle or enchanted forest backdrop, 
                        whimsical lighting, and magic wand favors. Guests could enjoy sweet treats like 
                        cupcakes or candy apples, and play games like pin the horn on the unicorn or a 
                        fairy treasure hunt.</p>
                </div>
                <div class="dark-wrapper">
                    <div class="service-img">
                        <img src="CSS/Pictures/christening/disney-christening.png" alt="Display Photo" width="320">
                    </div>
                    <h5>Disney Theme</h5>
                    <p>A Disney theme could be a fun way to celebrate a christening. Decorations could 
                        include iconic Disney character cutouts, colorful balloons, and classic Disney 
                        music playing in the background. Guests could enjoy Disney-themed snacks like 
                        Mickey Mouse-shaped pretzels or Dole Whip, and play games like a Disney trivia 
                        or sing-a-long contest.</p>
                </div>
            </div>
        </div>
    </section>

    <!--christening ending banner-->
    <section class="ending-banner" id="ending-banner">
        <div class="logo-story">
            <img src="CSS/Pictures/glamour-logo-white.png" alt="Logo" style="width:55px;">
        </div>
        <h2>CREATING CHERISHED MEMORIES<br>ON YOUR CHILD'S SPECIAL DAY</h2>
        <div class="start-button1">
            <a href="christeningbook.php"><button class="get-started1">- GET STARTED -</button></a>
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
                    <li><a href="#">Christening</a></li>
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