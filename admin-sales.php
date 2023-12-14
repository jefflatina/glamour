<?php
session_start();

include("config.php");
include("function.php");

$user_data = check_login($connection);
$currentMonth = date('m');
$currentYear = date('Y');


$id = $_SESSION["user_id"];
$result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
$row1 = mysqli_fetch_assoc($result);

$sql3 = "SELECT SUM(amount) AS total_income FROM billing WHERE payment_type = 'Fullpayment'";
$totalresult = mysqli_query($connection, $sql3);
$getrow3 = mysqli_fetch_assoc($totalresult);

$sql4 = "SELECT SUM(amount) AS total_income_month FROM billing WHERE payment_type = 'Fullpayment' AND MONTH(date) = $currentMonth AND YEAR(date) = $currentYear";
$totalResult = mysqli_query($connection, $sql4);
$getrow4 = mysqli_fetch_assoc($totalResult);
$total_income_month = $getrow4['total_income_month'];

$query = "SELECT event, COUNT(*) as quantity FROM booking GROUP BY event";
$bookingresult = mysqli_query($connection, $query);
$chartData = array(['Event', 'Quantity']);

while ($row = mysqli_fetch_array($bookingresult)) {
    $event = $row['event'];
    $quantity = $row['quantity'];
    $chartData[] = array($event, intval($quantity));
}

$jsonData = json_encode($chartData);

$query2 = "SELECT DATE_FORMAT(date, '%b') AS month, SUM(amount) AS total_incometb
                FROM billing
                WHERE fpstatus = 'Paid'
                GROUP BY month
                ORDER BY FIELD(month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec')";
            $billingResult = mysqli_query($connection, $query2);
            $chartData2 = array(['Month', 'Income']);

while ($row = mysqli_fetch_array($billingResult)) {
    $month = $row['month'];
    $totalIncome = $row['total_incometb'];
    $chartData2[] = array($month, intval($totalIncome));
}

$jsonData2 = json_encode($chartData2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report | Admin</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">

    <!-- CSS link -->
    <link rel="stylesheet" href="CSS/adminstyle.css">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap"
        rel="stylesheet">

    <!-- Pie chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $jsonData; ?>);

            var options = {
                backgroundColor: 'transparent',
                colors: ['#D0A65B', '#0E0E0E', '#1C1C1C', '#282828', '#323232'],
                legend: 'none',
                pieSliceBorderColor: 'transparent',
                chartArea: {
                    width: '90%',
                    height: '90%'
                },
                width: 400,
                height: 300
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

    
</head>


<body>
<header>
        <ul class="left-nav">
            <!-- Profile Section -->
            <li class="profile-section">
                <img src="CSS/Pictures/uploads/adminpfp.png" alt="Profile Picture">
                <h4 style="color: #fff; font-weight: bolder; margin-bottom: 0px;"><?php echo $row1["username"]; ?></h4>
                <p>Administrator</p>
            </li>
            <!-- Left Nav Bar -->
            <li class="sidebar"><a href="admin-dashboard.php" style="text-decoration: none;"><i class="ri-dashboard-line"></i> Dashboard</a></li>
            <li class="sidebar"><a href="admin-bookinglist.php" style="text-decoration: none;"><i class="ri-file-list-line"></i> Event Book List</a></li>
            <li class="sidebar"><a href="admin-calendar.php" style="text-decoration: none;"><i class="ri-calendar-line"></i> Event Calendar</a></li>
            <li class="sidebar"><a href="admin-coordinators.php" style="text-decoration: none;"><i class="ri-file-user-line"></i> Coordinators</a></li>
            <li class="sidebar"><a href="admin-billing.php" style="text-decoration: none;"><i class="ri-wallet-2-line"></i> Billing Report</a></li>
            <li class="sidebar"><a href="admin-sales.php" class="active" style="text-decoration: none;"><i class="ri-folder-chart-line"></i> Sales Report</a></li>
            <!-- Logout Button -->
		    <li class="logout-button">
			    <a href="logout.php"><i class="ri-logout-box-line"></i> Logout</a>
		    </li>
        </ul>
    </header>
    <main>
        <div class="top-content">
            <h2>Sales Report</h2>
            <a href="admin-bookinglist.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container-sales">
          <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px;">
            <div class="titleincome">
                <h3 style="font-size: 2em; font-weight: bolder; font-family: Poppins;">TOTAL INCOME</h3>
                <h6 style="font-size: 0.7em; color: white; font-weight: lighter; font-family: Poppins;">This month's income: PHP <?php echo number_format($getrow4["total_income_month"]); ?></h3>
            </div>
            <h1 style="font-size: 2.3em; font-weight: bolder; font-family: Poppins;">PHP <?php echo number_format($getrow3["total_income"]); ?></h1>
          </div>
              <div id="chart_div"></div>
        </div>

        <div class="grid2">
          <div class="grid-item2 grid-item-2">
            <h5 style="font-size: 1.25em; font-weight: bolder; font-family: Poppins; margin-bottom: 15px;">TOP 5 SALES</h5>
            <table class="salestable">
                <tbody>

                <?php
                  $query = "SELECT billing.*, booking.event FROM billing
                            INNER JOIN booking ON billing.booking_id = booking.booking_id
                            WHERE billing.fpstatus = 'Paid'
                            ORDER BY billing.amount DESC
                            LIMIT 5";

                  $bookingresult = mysqli_query($connection, $query);

                  $counter = 1; // Initialize the counter variable

                  while($row2 = mysqli_fetch_array($bookingresult)) 
                  {
                      $id = $row2['id'];
                      $lastname = $row2['lastname'];
                      $address = $row2['event'];
                      $amount = $row2['amount'];
                      $event = $row2['event'];

                      $trStyle = ($counter == 1) ? 'background: #FED586; color: black; font-weight: bolder;' : 'background: #333333;'; // Conditional background color for rank 1

                      echo '
                      <tr style="'.$trStyle.'">
                          <td style="text-align: center;"> '.$counter.' </td>
                          <td style="text-align: center;"> '.$lastname.' </td>
                          <td style="text-align: center;"> '.$event.' </td>
                          <td style="text-align: center;"> '.$amount.' </td>
                      </tr>';

                      $counter++; // Increment the counter
                  }
                  ?>




                    <!--
                    <tr style="background: #FED586; margin-bottom: 10px; color: black; font-weight: bolder; border-radius: 200px; ">
                      <td style="text-align: center;">1</td>
                      <td style="text-align: center;">Ms. Grande</td>
                      <td style="text-align: center;">Wedding</td>
                      <td style="text-align: center;">PHP 2,500,000</td>
                    </tr>

                    <tr style="background: #333333;">
                      <td style="text-align: center;">2</td>
                      <td style="text-align: center;">Ms. Swift</td>
                      <td style="text-align: center;">Wedding</td>
                      <td style="text-align: center;">PHP 2,000,000</td>
                    </tr>

                      <tr style="background: #333333;">
                      <td style="text-align: center;">3</td>
                      <td style="text-align: center;">Mr. Pangilinan</td>
                      <td style="text-align: center;">Anniversary</td>
                      <td style="text-align: center;">PHP 1,500,000</td>
                    </tr>

                    <tr  style="background: #333333;">
                      <td style="text-align: center;">4</td>
                      <td style="text-align: center;">Ms. Cortesi</td>
                      <td style="text-align: center;">Wedding</td>
                      <td style="text-align: center;">PHP 1,250,000</td>
                    </tr>

                    <tr  style="background: #333333;">
                      <td style="text-align: center;">5</td>
                      <td style="text-align: center;">Ms. Hosk</td>
                      <td style="text-align: center;">Birthday</td>
                      <td style="text-align: center;">PHP 1,000,000</td>
                    </tr>
                    -->

                </tbody>
            </table>
          </div>

          <div class="grid-item2 grid-item-2">
            <h5 style="font-size: 1.25em; font-weight: bolder; font-family: Poppins;">EVENT BOOKINGS</h5>
            
            <div id="chart-container">
              <div id="piechart" style="width: 400px; height: 300px;"></div>
            </div>

          </div>
        </div>

        <div class="container-sales2">
            <h3 style="font-size: 1.25em; font-weight: bolder; font-family: Poppins;">EVENT RECORDS</h3>
            <table class="table-records" style="color: #fff;" id="confirmedtable">
                <thead style="font-size: 1em; ">
                    <tr>
                        <th style="text-align: center;">Booking ID</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Contact</th>
                        <th style="text-align: center;">Address</th>
                        <th style="text-align: center;">Email Address</th>
                        <th style="text-align: center;">Event</th>
                        <th style="text-align: center;">Date</th>
                        <th style="text-align: center;">Amount</th>

                    </tr>
                </thead>

                <?php
                $query = "SELECT * FROM booking WHERE status = 'confirmed' ORDER BY bookdate ASC";
                $bookingresult = mysqli_query($connection, $query);

                while($row3 = mysqli_fetch_array($bookingresult)) 
                {
                    $id = $row3['id'];
                    $booking_id = $row3['booking_id'];
                    $firstname = $row3['firstname'];
                    $lastname = $row3['lastname'];
                    $phone = $row3['phone'];
                    $address = $row3['address'];
                    $emailadd = $row3['emailadd'];
                    $bookdate = $row3['bookdate'];
                    $event = $row3['event'];
                    $amount = $row3['amount'];

                    echo '
                                <tr>
                                    <td style="text-align: center;"> <span style="display: none;">'.$id.'</span>'.$booking_id.' </td>
                                    <td style="text-align: center;"> '.$firstname.' '.$lastname.' </td>
                                    <td style="text-align: center;">'.$phone.' </td>
                                    <td style="text-align: center;">' .$address.' </td>
                                    <td style="text-align: center;"> '.$emailadd.' </td>
                                    <td style="text-align: center;"> '.$event.' </td>    
                                    <td style="text-align: center;"> '.$bookdate.' </td> 
                                    <td style="text-align: center;">PHP '.$amount.'</td>                             
                                </tr>
                                    ';
                }

                ?>

            </table>     
        </div>

    </main>
</body>
</html>



