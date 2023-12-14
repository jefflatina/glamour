<?php
session_start();

    include("config.php");
    include("function.php");

    //display username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);

    $user_data = check_login($connection);
    

    //update
    if(isset($_POST['update'])){
        $eid = $_GET['editid'];

        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $passhash = $password;
        $hashed_password = password_hash($passhash, PASSWORD_DEFAULT);
                
        $sql = mysqli_query($connection, "UPDATE users SET username='$username', firstname='$firstname', 
        lastname='$lastname', email='$email', user_status='$user_status', password='$hashed_password' WHERE id='$eid' ");

        if($sql){
            echo "<script>alert('You have successfully updated the details of the coordinator.');</script>";
            echo "<script>document.location='admin-coordinators.php';</script>";
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
    <title>Update Coordinator Details | Admin</title>
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
                <img src="CSS/Pictures/uploads/adminpfp.png" alt="Profile Picture">
                <h4><?php echo $row["username"]; ?></h4>
                <p>Administrator</p>
            </li>
            <!-- Left Nav Bar -->
            <li class="sidebar"><a href="admin-dashboard.php" style="text-decoration: none;"><i class="ri-dashboard-line"></i> Dashboard</a></li>
            <li class="sidebar"><a href="admin-bookinglist.php" style="text-decoration: none;"><i class="ri-file-list-line"></i> Event Book List</a></li>
            <li class="sidebar"><a href="admin-calendar.php" style="text-decoration: none;"><i class="ri-calendar-line"></i> Event Calendar</a></li>
            <li class="sidebar"><a href="admin-coordinators.php" class="active" style="text-decoration: none;"><i class="ri-file-user-line"></i> Coordinators</a></li>
            <li class="sidebar"><a href="admin-billing.php" style="text-decoration: none;"><i class="ri-wallet-2-line"></i> Billing Report</a></li>
            <li class="sidebar"><a href="admin-sales.php" style="text-decoration: none;"><i class="ri-folder-chart-line"></i> Sales Report</a></li>
            <!-- Logout Button -->
		    <li class="logout-button">
			    <a href="logout.php"><i class="ri-logout-box-line"></i> Logout</a>
		    </li>
        </ul>
    </header>
    <main>
        <div class="top-content">
            <h2>Coordinators</h2>
            <a href="venuecoor-list.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container">
            <h1>Update Coordinator Details</h1>
            <form class="addnewform-coor" action="#" method="POST">
                <?php
                    $eid = $_GET['editid'];
                    $sql = mysqli_query($connection, "SELECT * FROM users WHERE id='$eid' ");
                    while($row=mysqli_fetch_array($sql)){
                ?>    

                <div class="row">
                    <div class="column">
                        <div class="addcoor-details">
                            <h4>First Name</h4>
                            <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname'];?>">
                        </div>
                        <div class="addcoor-details">
                            <h4>Role</h4>
                            <select id="user_status" name="user_status">
                                    <option value="" disabled selected>Select their role</option>
                                    <option value="Venue Coordinator"
                                    <?php
                                    if($row['user_status'] == "Venue Coordinator"){
                                        echo "selected";
                                    }
                                    ?>
                                    >Venue Coordinator</option>
                                    <option value="Catering Coordinator"
                                    <?php
                                    if($row['user_status'] == "Catering Coordinator"){
                                        echo "selected";
                                    }
                                    ?>
                                    >Catering Coordinator</option>
                                    <option value="Style Coordinator"
                                    <?php
                                    if($row['user_status'] == "Style Coordinator"){
                                        echo "selected";
                                    }
                                    ?>
                                    >Style Coordinator</option>
                                    <option value="Extra Services Coordinator"
                                    <?php
                                    if($row['user_status'] == "Extra Services Coordinator"){
                                        echo "selected";
                                    }
                                    ?>
                                    >Extra Services Coordinator</option>
                                </select>
                        </div>
                        <div class="addcoor-details">
                            <h4>Email Address</h4>
                            <input type="email" id="email" name="email" value="<?php echo $row['email'];?>">
                        </div>
                    </div>
                    <div class="column">
                        <div class="addcoor-details">
                            <h4>Last Name</h4>
                            <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname'];?>">
                        </div>
                        <div class="addcoor-details">
                            <h4>Username</h4>
                            <input type="text" id="username" name="username" value="<?php echo $row['username'];?>">
                        </div>
                        <div class="addcoor-details">
                            <h4>Password</h4>
                            <input type="password" id="password" name="password" value="<?php echo $row['password'];?>">
                        </div>
                    </div>
                </div>
                <?php }
                ?>

                <div class="buttonsbot">
                    <button type="submit" class="save-btn-coor" name="update">SAVE</button>
                    <a href="admin-coordinators.php"><h5 class="back-btn1" style="border-radius: 4px; margin-right: 5px; margin-top: 35px;">BACK</h5></a>
                </div>
                <div class="clear"></div>
            </form>
        </div>
    </main>
</body>
</html>