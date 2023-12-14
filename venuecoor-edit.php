<?php
session_start();

    include("config.php");
    include("function.php");

    //display username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);

    $user_data = check_login($connection);

    $uploads_dir = 'CSS/Pictures/venues/';
    
    if(isset($_POST['update'])){
        $eid = $_GET['editid'];

        $venuename = $_POST['venuename'];
        $venuetype = $_POST['venuetype'];
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

        
        $sql = mysqli_query($connection, "UPDATE venues SET venuename='$venuename', venuetype='$venuetype', 
        venueaddress='$venueaddress', venueimg='$venueimg' WHERE id='$eid' ");

        if($sql){
            echo "<script>alert('You have successfully updated the details of the venue.');</script>";
            echo "<script>document.location='venuecoor-venues.php';</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }


    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Venue | Coordinator</title>
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
            <h3>Edit Venue</h3>
            <form class="editform" action="#" method="POST" enctype="multipart/form-data">
                <?php
                    $eid = $_GET['editid'];
                    $sql = mysqli_query($connection, "SELECT * FROM venues WHERE id='$eid' ");
                    while($row=mysqli_fetch_array($sql)){
                ?>
                <h4>Venue Name</h4>
                <input type="text" id="venuename" name="venuename" value="<?php echo $row['venuename'];?>">

                <h4>Event</h4>
                <select id="venuetype" name="venuetype">
                    <option value="" disabled selected>Select its event type</option>
                    <option value="Wedding"
                    <?php
                    if($row['venuetype'] == "Wedding"){
                        echo "selected";
                    }
                    ?>
                    >Wedding</option>
                    <option value="Birthday"
                    <?php
                    if($row['venuetype'] == "Birthday"){
                        echo "selected";
                    }
                    ?>
                    >Birthday</option>
                    <option value="Christening"
                    <?php
                    if($row['venuetype'] == "Christening"){
                        echo "selected";
                    }
                    ?>
                    >Christening</option>
                    <option value="Anniversary"
                    <?php
                    if($row['venuetype'] == "Anniversary"){
                        echo "selected";
                    }
                    ?>
                    >Anniversary</option>
                    <option value="Corporate"
                    <?php
                    if($row['venuetype'] == "Corporate"){
                        echo "selected";
                    }
                    ?>
                    >Corporate</option>
                </select>

                <h4>Address</h4>
                <input type="text" id="venueaddress" name="venueaddress" value="<?php echo $row['venueaddress'];?>">

                <h4>Image</h4>
                <input type="file" id="venueimg" name="venueimg" value="<?php echo $row['venueimg'];?>">

                <?php }
                ?>
                <button type="submit" name="update" class="save-btn">SAVE</button>
                <div class="clear"></div>
            </form>

        </div>
    </main>
</body>
</html>