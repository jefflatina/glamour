<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    //sa pagdisplay ng username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);

    //get page number
    if (isset($_GET['page_no']) && $_GET['page_no'] !=="") {
        $page_no = $_GET['page_no'];
    } else {
          $page_no = 1;  
    }
    
    //total rows or records to display
    $total_records_per_page = 5;
    //get the page offset for the LIMIT query
    $offset = ($page_no - 1) * $total_records_per_page;

    //get prev page
    $prev_page = $page_no - 1;
    //get next page
    $next_page = $page_no + 1;
    //get total count of records
    $result_count = mysqli_query($connection, "SELECT COUNT(*) as total_records FROM venues");
    //total records
    $records = mysqli_fetch_array($result_count);
    //store total_records to a variable
    $total_records = $records['total_records'];
    //get total pages
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    
    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $select = "DELETE FROM venues WHERE id = '$id' ";
        $result = mysqli_query($connection,$select);
                    
        if($select){
            echo "<script>alert('Venue deleted.');</script>";
            echo "<script>document.location='venuecoor-venues.php';</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            }
        }
            
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venues | Coordinator</title>
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
            <div class="titleandbutton">
                <h3>List of Venues</h3>
                <a href="venuecoor-addnew.php"><button class="add-btn">ADD NEW</button></a>  
            </div>
            <table class="table-records">
                <thead>
                    <tr>
                        <th>Venue</th>
                        <th>Event</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <?php
                $sql = "SELECT * FROM venues WHERE venuename != 'None' ORDER BY id DESC LIMIT $offset , $total_records_per_page";
                $venueresult = mysqli_query($connection, $sql);
                while($row = mysqli_fetch_array($venueresult)) {
                ?>

                <tbody>
                    <tr>
                        <td><?= $row['venuename']; ?></td>
                        <td><?= $row['venuetype']; ?></td>
                        <td><?= $row['venueaddress']; ?></td>
                        <td><img src="CSS/Pictures/venues/<?=$row['venueimg']?>" class="venue-thumb"></td>
                        <td>
                            <div class="actions">
                                <a href="venuecoor-edit.php?editid=<?php echo htmlentities($row['id']);?>"><button class="edit-btn"><i class="ri-pencil-line"></i></button></a>
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>    
                                    <button class="delete-btn" name="delete" onclick="return confirm('Are you sure you want to delete?')"><i class="ri-delete-bin-line"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>

            <div class="pendingpagecontainer">

                <div class="pendingpagenum">
                    <h4>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?></h4>
                </div>

                <nav class="pendingpagination">
                    <ul class="pagination">

                        <li class="prevnext"><a class="prevnext <?= ($page_no <= 1) ?
                        'disabled' : ''; ?>" <?= ($page_no > 1) ? 'href=?page_no=' .
                        $prev_page : ''; ?>>PREV</a></li>
                        
                        <?php for($counter = 1; $counter <= $total_no_of_pages; $counter++) { ?>
                            <?php if ($page_no !== $counter) { ?>
                                <li class="page-item"><a class="page-item-notactive" href="?page_no=<?=
                                $counter; ?>"><?= $counter; ?></a></li>
                            <?php } else { ?>
                                <li class="page-item-active"><a class="page-item-active"><?=
                                $counter; ?></a></li>
                            <?php } ?>
                        <?php } ?>
                         

                        <li class="prevnext"><a class="prevnext <?= ($page_no >= $total_no_of_pages) ?
                        'disabled' : ''; ?>" <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' .
                        $next_page : ''; ?>>NEXT</a></li>

                    </ul>
                </nav>

            </div>

        </div>
    </main>
</body>
</html>