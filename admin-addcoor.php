<?php
session_start();

    include("config.php");
    include("function.php");
 
    //show admin name sa side
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);

    $errorMessage = "";
    $successMessage = "";
    
    //isset($signuser) || isset($signpass) || isset($signmail) || isset($signconpass)
    //$_SERVER['REQUEST_METHOD'] == "POST"
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $emailadd = $_POST['emailadd'];
        $role = $_POST['role'];
    

        if(!empty($username) && !empty($firstname) && !empty($lastname) && !empty($password) && !empty($emailadd) && !empty($role) && !is_numeric($username))
        {
            $user_id = random_num(20);

            $passhash = $password;
            $hashed_password = password_hash($passhash, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (user_id, username, firstname, lastname, email, password, user_status) VALUES ('$user_id', '$username', '$firstname', '$lastname', '$emailadd', '$hashed_password', '$role')";
            mysqli_query($connection, $query);
          
            if($query){
                echo "<script>alert('You have successfully added a new coordinator.');</script>";
                echo "<script>document.location='admin-coordinators.php';</script>";
            } else {
                echo "<script>alert('Something went wrong');</script>";
            }

           }

        } else {
            $errorMessage = "Please fillout blank spaces.";
        }
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Coordinator | Admin</title>
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
            <h1>Add New Coordinator</h1>
            <form class="addnewform-coor" action="#" method="POST">
                <div class="row">
                    <div class="column">
                        <div class="addcoor-details">
                            <h4>First Name</h4>
                            <input type="text" id="firstname" name="firstname" required placeholder="Enter first name">
                        </div>
                        <div class="addcoor-details">
                            <h4>Role</h4>
                            <select id="role" name="role">
                                <option value="" disabled selected>Select their role</option>
                                <option value="Venue Coordinator">Venue Coordinator</option>
                                <option value="Catering Coordinator">Catering Coordinator</option>
                                <option value="Style Coordinator">Style Coordinator</option>
                                <option value="Extra Services Coordinator">Extra Services Coordinator</option>

                            </select>
                        </div>
                        <div class="addcoor-details">
                            <h4>Email Address</h4>
                            <input type="email" id="emailadd" name="emailadd" required placeholder="Enter email address">
                        </div>
                    </div>
                    <div class="column">
                        <div class="addcoor-details">
                            <h4>Last Name</h4>
                            <input type="text" id="lastname" name="lastname" required placeholder="Enter last name">
                        </div>
                        <div class="addcoor-details">
                            <h4>Username</h4>
                            <input type="text" id="username" name="username" required placeholder="Enter username">
                        </div>
                        <div class="addcoor-details">
                            <h4>Password</h4>
                            <input type="password" id="password" name="password" required placeholder="Enter a strong password">
                        </div>
                    </div>
                </div>

                <div class="buttonsbot">
                    <button type="submit" class="add-btn-coor" name="submit">ADD</button> 
                    <a href="admin-coordinators.php"><h5 class="back-btn1" style="border-radius: 4px; margin-right: 5px; margin-top: 35px;">BACK</h5></a>
                </div>

                <div class="clear"></div>
            </form>
        </div>
    </main>
</body>
</html>