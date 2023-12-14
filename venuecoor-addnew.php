<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    //display username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);
    
    $pic_uploaded = 0;

    $uploads_dir = 'CSS/Pictures/venues/';

    //data to mysql
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $venuename = $_POST['venuename'];
        $eventtype = $_POST['eventtype'];
        $venueaddress = $_POST['venueaddress'];
        // Get the image file
        $venueimg = $_FILES['venueimg']['name'];
        if(move_uploaded_file($_FILES['venueimg']['tmp_name'], $uploads_dir.$venueimg))
        {
            $target_file = $uploads_dir.$venueimg;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png"){
                ?><script>
                    alert("Please upload photo having extension .jpg/.jpeg/.png");
                </script>
                <?php
            } else if($_FILES["venueimg"]["size"] > 200000000){
                ?><script>
                    alert("Your photo exceeds the size of 2 MB");
                </script>
                <?php
            } else {
                $pic_uploaded = 1;    
            }
        }
        
        if($pic_uploaded == 1){
            $sql_venue = "INSERT INTO venues (venuename, venuetype, venueaddress, venueimg) 
            VALUES ('$venuename', '$eventtype', '$venueaddress', '$venueimg')";
            $result = mysqli_query($connection, $sql_venue);
            
            if($sql_venue){
                echo "<script>alert('You have successfully added a new venue.');</script>";
                echo "<script>document.location='venuecoor-venues.php';</script>";
            } else {
                echo "<script>alert('Something went wrong');</script>";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Venue | Coordinator</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">

    <!--css link-->
    <link rel="stylesheet" href="CSS/adminstyle.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <ul class="left-nav">
            <!-- Profile Section -->
            <li class="profile-section">
                <img src="CSS/Pictures/uploads/venuepfp.png" alt="Profile Picture">
                <h4><?php echo $row["username"]; ?></h4>
                <p>Venue Coordinator</p>
            </li>
            <!-- Left Nav Bar -->
            <li class="sidebar"><a href="venuecoor-list.php"><i class="ri-file-list-line"></i> Venue Book List</a></li>
            <li class="sidebar"><a href="venuecoor-venues.php" class="active"><i class="ri-map-pin-line"></i> Venues</a></li>
            <li class="sidebar"><a href="venuecoor-calendar.php"><i class="ri-calendar-line"></i> Calendar</a></li>
            <!-- Logout Button -->
		    <li class="logout-button">
			    <a href="logout.php"><i class="ri-logout-box-line"></i> Logout</a>
		    </li>
        </ul>
    </header>
    <main>
        <div class="top-content">
            <h2>Venues</h2>
            <a href="venuecoor-list.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container">
            <h3>Add New</h3>
            <form class="addnewform" action="#" method="POST" enctype="multipart/form-data">
                <h4>Venue Name</h4>
                <input type="text" id="venuename" name="venuename">

                <h4>Event</h4>
                <select id="eventtype" name="eventtype">
                    <option value="" disabled selected>Select its event type</option>
                    <option value="Wedding">Wedding</option>
                    <option value="Birthday">Birthday</option>
                    <option value="Christening">Christening</option>
                    <option value="Anniversary">Anniversary</option>
                    <option value="Corporate">Corporate</option>
                </select>

                <h4>Address</h4>
                <input type="text" id="venueaddress" name="venueaddress">
                
                <h4>Image</h4>
                <input type="file" id="venueimg" name="venueimg">

                <button type="submit" class="add-btn" name="submit">ADD</button>
                <div class="clear"></div>

                
            </form>

        </div>
    </main>
</body>
</html>