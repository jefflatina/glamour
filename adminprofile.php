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
    <title>Admin Profile | Glamour</title>
    <link rel="stylesheet" href="CSS/adminprofile.css">
</head>

<body id="login-body" style="background-image: url(CSS/Pictures/profileandsettings/light-bg.png);">
    <div class="return-home">
        <p>
            <a href="logout.php">
                <span><ion-icon name="chevron-back-outline"></ion-icon></span>Back
            </a>
        </p>
    </div>
    <div class="wrapper-profile">
        <div class="profile-main-content">
            <h2>PROFILE & SETTINGS></h2>    
            <form action="#" method="POST">
                <div class="profile">
                    <h1>PROFILE</h1>
                    <div class="picture-section">
                        <img src="CSS/Pictures/profileandsettings/default-pfp.png" alt="Profile Picture" style="width: 125px;">
                        <a href="#">
                            <button class="add-photo">
                                <img src="CSS/Pictures/profileandsettings/add-pfp.png" alt="Add Photo" style="width: 30px;">
                            </button></a>
                        <p>idunnohow<br><span>admin</span></p>
                        <!-- DI KO ALAM PANO WAHAHA -->
                    </div>
                </div>
            </form>
            <div class="wrapper-profile2">
                <form action="" method="POST">
                    <div class="profile2">
                        <h1>GENERAL SETTINGS</h1>
                        <div class="input-box">
                            <div class="column-left">
                                <span class="icon">
                                    <img src="CSS/Pictures/profileandsettings/person.png" style="width: 17px;">
                                </span>
                                <input type="text" name="profile-first" id="profile-first" required placeholder="Enter your first name">
                                <label>FIRST NAME</label>
                            </div>
                            <div class="column-right">
                                <span class="icon">
                                    <img src="CSS/Pictures/profileandsettings/person.png" style="width: 17px;">
                                </span>
                                <input type="text" name="profile-last" id="profile-last" required placeholder="Enter your last name">
                                <label>LAST NAME</label>
                            </div>
                        </div>
                        <div class="input-box2">
                            <span class="icon">
                                <img src="CSS/Pictures/profileandsettings/email.png" style="width: 17px;">
                            </span>
                            <input type="email" name="profile-mail" id="profile-mail" required placeholder="Enter your email">
                            <label>EMAIL</label>
                        </div>
                        <div class="input-box3">
                            <div class="column-left3">
                                <span class="icon">
                                    <img src="CSS/Pictures/profileandsettings/password.png" style="width: 17px;">
                                </span>
                                <input type="password" name="profile-pass" id="profile-pass" required placeholder="Enter your password">
                                <label>PASSWORD</label>
                            </div>
                            <div class="column-right3">
                                <span class="icon">
                                    <img src="CSS/Pictures/profileandsettings/password.png" style="width: 17px;">
                                </span>
                                <input type="password" name="profile-con" id="profile-con" required placeholder="Re-enter your password">
                                <label>CONFIRM PASSWORD</label>
                            </div>
                        </div>
                        <div class="input-box4">
                            <span class="icon">
                                <img src="CSS/Pictures/profileandsettings/person.png" style="width: 17px;">
                            </span>
                            <input type="text" name="profile-user" id="profile-user" required placeholder="Enter your username">
                            <label>USERNAME</label>
                        </div>
                        <button type="submit" class="btn">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="logo">
        <img src="CSS/Pictures/glamour-logo.png" alt="Logo" style="width:100px;height:60px;">
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>