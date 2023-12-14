<?php
session_start();


    include("config.php");
    include("function.php");


    $user_data = check_login($connection);


    //sa pagdisplay ng username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);

    //display bookings
    $sql = "SELECT * FROM users WHERE user_status <> 'User' AND user_status <> 'Admin' ";
    $bookingresult = mysqli_query($connection, $sql);

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinators | Admin</title>
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
            <h2>Coordinator Management</h2>
            <a href="admin-bookinglist.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container">
            <div class="titleandbutton">
                <h3>List of Coordinators</h3>
                <a href="admin-addcoor.php"><button class="add-btn">ADD NEW</button></a>  
            </div>
            <table class="table-records">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Contact Person</th>
                        <th>Email Address</th>
                        <th>Action</th>
                    </tr>
                    <tbody>

                    <?php
                        if($bookingresult)
                        {
                            while($getrows = mysqli_fetch_assoc($bookingresult))
                            {
                                $id = $getrows['id'];
                                $username = $getrows['username'];
                                $firstname = $getrows['firstname'];
                                $lastname = $getrows['lastname'];
                                $email = $getrows['email'];
                                $user_status = $getrows['user_status'];
                               
                                echo '
                                <tr>
                                    <td> '.$user_status.' </td>
                                    <td> '.$username.' </td>
                                    <td> '.$firstname.' '.$lastname.' </td>
                                    <td> '.$email.' </td>
                                    <td>
                                        <a href="editcoor.php? editid='.$id.' "><button class="edit-btn"><i class="ri-pencil-line"></i></button></a>
                                        <a href="deletecoor.php? deleteid='.$id.' "><button class="delete-btn" onclick="return confirm(\'Are you sure you want to delete?\')"><i class="ri-delete-bin-line"></i></button></a>
                                    </td>
                                </tr>
                                    ';
                            }
                        }
                    ?>
                </tbody>
            </table>




            
           
        </div>
    </main>
</body>
</html>



