<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    
    //show admin name sa side
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);

    //calendar
    function build_calendar($month, $year){

        $mysqli = new mysqli('localhost','root','','glamour');
        $stmt = $mysqli->prepare('select * from booking where MONTH(bookdate) = ? AND YEAR(bookdate) = ? AND status="confirmed" ');
        $stmt->bind_param('ss',$month,$year);
        $booking = array();
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows > 0){
                while($row = $result -> fetch_assoc()){
                    $booking[] = $row['bookdate'];
                }
                $stmt->close();
            }
        }

        //Create an array containing names of all days in a week.
        $daysOfWeek = array('SUN', 'MON', 'TUE', 'WED',
        'THU', 'FRI', 'SAT');

        //First day of the month that is in the argument of this function.
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

        //Getting the number of days this month contains
        $numberDays = date('t', $firstDayOfMonth);

        //Getting some information about the first day of this month
        $dateComponents = getdate($firstDayOfMonth);

        //Getting the name of this month
        $monthName = $dateComponents['month'];

        //Getting the index value 0-6 of the first day of this month
        $dayOfWeek = $dateComponents['wday'];
        
        //Getting the current date
        $dateToday = date('Y-m-d');

        $prev_month = date('m', mktime(0,0,0,$month-1,1,$year));
        $prev_year = date('Y', mktime(0,0,0,$month-1,1,$year));
        $next_month = date('m', mktime(0,0,0,$month+1,1,$year));
        $next_year = date('Y', mktime(0,0,0,$month+1,1,$year));
        
        $calendar ="<center><h2 class='monthtitle'>$monthName $year</h2>";
        $calendar.="<a class='btnprevnext' href='?month=".$prev_month."&year=".$prev_year."'>Prev</a>";
        $calendar.="<a class='btncurrent' href='?month=".date('m')."&year=".date('Y')."'>Current</a>";
        $calendar.="<a class='btnprevnext' href='?month=".$next_month."&year=".$next_year."'>Next</a></center>";
        
        //Creating the calendar
        $calendar.= "<br><table class='calendar'>";
        $calendar.="<tr>";
        
        //Creating the calendar headers
        foreach($daysOfWeek as $day){
            $calendar.= "<th class='dayheader'>$day</th>";  
        }

        $calendar.= "</tr><tr>"; 
        $currentDay = 1; //Initiating the day counter
        //The variable $dayOfWeek will make sure that there must be only 7 columns on our table
        if($dayOfWeek > 0){
            for($k=0; $k < $dayOfWeek; $k++){
                $calendar.="<td class='empty'></td>";
            }
        }

        //Getting the month number
        $month = str_pad($month,2,"0",STR_PAD_LEFT);
        
        while($currentDay <= $numberDays){

            //if seventh column (saturday) reached, start a new row
            if($dayOfWeek == 7){
                $dayOfWeek = 0;
                $calendar.= "</tr><tr>";
            }
            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";
            $dayName = strtolower(date('l',strtotime($date)));
            $today = $date==date('Y-m-d')?'today':'';
            if(in_array($date, $booking)){
                $calendar.="<td class='$today'><h4>$currentDay</h4><br><a class='booked'>Booked</a></td>"; 
            }else{
                $calendar.="<td class='$today'><h4>$currentDay</h4><br><a class='avail'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>"; 
            }
            
            
            //Incrementing the counters
            $currentDay++;
            $dayOfWeek++;
        }

        //Completing the row of the last week in a month, if necessary
        if($dayOfWeek < 7){
            $remainingDays = 7-$dayOfWeek;
            for($i=0; $i<$remainingDays; $i++){
                $calendar.="<td class='empty'></td>";
            }
        }

        $calendar.= "</tr></table>";

        
        return $calendar;
  

    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar | Admin</title>
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
    <!--bootstrap-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
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
            <li class="sidebar"><a href="admin-calendar.php" class="active" style="text-decoration: none;"><i class="ri-calendar-line"></i> Event Calendar</a></li>
            <li class="sidebar"><a href="admin-coordinators.php" style="text-decoration: none;"><i class="ri-file-user-line"></i> Coordinators</a></li>
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
            <h2>Event Calendar</h2>
            <a href="admin-bookinglist.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container">
            <div class=calendar-container>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $dateComponents = getdate();
                        if(isset($_GET['month']) && isset($_GET['year'])){
                            $month = $_GET['month'];
                            $year = $_GET['year'];
                        }else{
                            $month = $dateComponents['mon'];
                            $year = $dateComponents['year'];
                        }
                        echo build_calendar($month, $year);
                        ?>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
</body>
</html>