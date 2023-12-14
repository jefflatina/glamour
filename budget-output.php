<?php
session_start();

    include("config.php");
    include("function.php");
    $user_data = check_login($connection);

    $goBackUrl = "budget.php";    
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
    <title>Budget Plan | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/budget.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <!--javascript-->
    <script src="budgetscript.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
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
                    <li><a href="christening-logged.php" style="font-size: .7em">Christening</a></li>
                    <li><a href="anniversary-logged.php" style="font-size: .7em">Anniversary</a></li>
                    <li><a href="corporate-logged.php" style="font-size: .7em">Corporate</a></li>
                </ul>
            </li>
            <li><a href="contact-logged.php" style="font-size: .8em">CONTACT</a></li>
            <li><a href="budget.php" class="active" style="font-size: .8em">BUDGET</a></li>
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

    <!----------- Multi Step Form ------>

    <div class="multistepform" style="z-index: 4000;">

        <div class="form">
            <div class="logo-banner" style="text-align: center;">
                <img src="CSS/Pictures/glamour-logo.png" alt="Logo" style="width:70px;">
            </div>

            <br><h3 class="price" style="text-align: center;">
            <?php
                if (isset($_SESSION["prediction"])) {
                $prediction = $_SESSION["prediction"];
                // Use $inputValue as needed
                echo "PHP " . number_format((float)$prediction);
                } else {
                echo "No input value found.";
                }
            ?>
            </h3>
            <h5 style="text-align: center; font-family: Judson">EVENT ESTIMATED PRICE</h5>
        
            <div class="input-group" style="text-align: center;">
                <p><em>Predicted price may vary based on your choices and selections, 
                        ensuring accuracy for the final cost.</em></p>
                </div>
            
            <div class="button-container">
                <a href="<?php echo $goBackUrl; ?>" class="bookbtn" style="display: flex; justify-content: center;">RETRY</a>
            </div>

        </div>
    </div>
        
        
    <!--Loader-->
    <div id="loader-container">        
        <div class="loader"><span class="loader-inner"></span></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="loadingscrn.js"></script>

</body>
</html>
