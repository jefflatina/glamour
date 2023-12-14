<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour - Home</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body id="home-body">
    <!--Navigation (Top)-->
    <header>
        <div class="home-bg">
            <img src="CSS/Pictures/home-banner-bg.png" alt="Home Background" style="width:100%;height:100%;">
        </div>
        <div class="logo-home">
            <a href="home.php"><img src="CSS/Pictures/glamour-logo-white.png" alt="Logo" style="width:60px;height:35px;"></a>
        </div>
        <div class="navigation">
            <nav>
                <a href="home.php">HOME</a>
                <a href="#">ABOUT</a>
                <a href="#">GUIDE</a>
            </nav>
        </div>
        <div class="navigation2">
            <nav>
                <a href="logout.php"><button class="login-button">Logout</button></a>
            </nav>
        </div>
    </header>
    
    <div class="home-banner">
        <div class="logo-banner">
            <img src="CSS/Pictures/glamour-logo.png" alt="Logo" style="width:160px;">
        </div>
        <h2>GLAMOUR</h2>
        <p>PLAN TO PERFECTION</p>
        <div class="book-button">
            <a href="#"><button class="book-event">BOOK AN EVENT</button></a>
        </div>
        <div class="down">
            <img src="CSS/Pictures/Down.png" style="width:30px;">
        </div>
        <div class="home-content">
            <p>At GLAMOUR, we pride ourselves on delivering</p>
            <p>exceptional events that leave a lasting impression. Let us take the</p>
            <p>stress out of planning and create a truly unforgettable experience for you and</p>
            <p>your guests as we bring your luxurious vision into life.</p>
        </div>
        <div class="bubble-design1">
            <img src="CSS/Pictures/Bubble.png" style="width: 500px;">
        </div>
        <div class="wedding-pic">
            <img src="CSS/Pictures/wedding.png" style="width: 500px;">
        </div>
        <div class="wedding-pic2">
            <img src="CSS/Pictures/wedding2.png" style="width: 500px;">
        </div>
        <div class="wedding">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>WEDDING</h2>
            <p>Start your journey to a perfect wedding</p>
            <p>you've always dreamed of</p>
            <div class="seemore-button">
                <a href="#"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>
        <div class="bubble-design2">
            <img src="CSS/Pictures/Bubble.png" style="width: 500px;">
        </div>
        <div class="birthday-pic">
            <img src="CSS/Pictures/birthday.png" style="width: 500px;">
        </div>
        <div class="birthday-pic2">
            <img src="CSS/Pictures/birthday2.png" style="width: 500px;">
        </div>
        <div class="birthday">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>BIRTHDAY</h2>
            <p>Creating magical memories,</p>
            <p>one birthday at a time</p>
            <div class="seemore-button">
                <a href="#"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>
        <div class="bubble-design3">
            <img src="CSS/Pictures/Bubble.png" style="width: 500px;">
        </div>
        <div class="christening-pic">
            <img src="CSS/Pictures/christening.png" style="width: 500px;">
        </div>
        <div class="christening-pic2">
            <img src="CSS/Pictures/christening2.png" style="width: 500px;">
        </div>
        <div class="christening">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>CHRISTENING</h2>
            <p>From ceremony to celebration, make it a</p>
            <p>day to remember</p>
            <div class="seemore-button">
                <a href="#"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>
        <div class="bubble-design4">
            <img src="CSS/Pictures/Bubble.png" style="width: 500px;">
        </div>
        <div class="anniversary-pic">
            <img src="CSS/Pictures/anniversary.png" style="width: 500px;">
        </div>
        <div class="anniversary-pic2">
            <img src="CSS/Pictures/anniversary2.png" style="width: 500px;">
        </div>
        <div class="anniversary">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>ANNIVERSARY</h2>
            <p>Celebrating a year of love and happiness</p>
            <p>&nbsp;</p>
            <div class="seemore-button">
                <a href="#"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>
        <div class="bubble-design5">
            <img src="CSS/Pictures/Bubble.png" style="width: 500px;">
        </div>
        <div class="holiday-pic">
            <img src="CSS/Pictures/holiday.png" style="width: 500px;">
        </div>
        <div class="holiday-pic2">
            <img src="CSS/Pictures/holiday2.png" style="width: 500px;">
        </div>
        <div class="holiday">
            <div class="white-logo">
                <img src="CSS/Pictures/glamour-logo-white.png" style="width:80px;">
            </div>    
            <h2>HOLIDAY</h2>
            <p>Experience unforgettable holiday</p>
            <p>memories in the magic of the season</p>
            <div class="seemore-button">
                <a href="#"><button class="see-more">SEE MORE</button></a>
            </div>
        </div>
        <div class="story">
            <div class="logo-story">
                <img src="CSS/Pictures/glamour-logo-white.png" alt="Logo" style="width:55px;">
            </div>
            <div class="story1">
                <img src="CSS/Pictures/fullstory-left.png" style="width:280px;">
            </div>
            <div class="story2">
                <img src="CSS/Pictures/fullstory-right.png" style="width:280px">
            </div>
            <h3>GLAMOUR</h3>
            <h1>WHERE CREATIVITY MEETS <br> FLAWLESS EXECUTION</h1>
            <p>At GLAMOUR, we understand that every event is unique and
            <br>deserves a personalized touch. Whether you're planning a
            <br>wedding, birthday celebration, or any other special occasion, we'll
            <br>work closely with you to ensure that every detail is tailored to
            <br>your specific needs and preferences.
            <br><br><br>WEDDING | BIRTHDAY | CHRISTENING | ANNIVERSARY | HOLIDAY</p>
            <div class="fullstory-button">
                <a href="#"><button class="full-story">FULL STORY</button></a>
            </div>
        </div>
    </div>
</div>
    
    <!--Linked-->
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>