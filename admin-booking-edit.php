<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    $editid = $_GET['editid']; 
    $booking = $_GET['booking']; 
    $id = $_SESSION["user_id"];
    $userresult = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($userresult);
    
    $newquery = "SELECT * FROM booking WHERE booking_id = '$booking' ";
    $newres = mysqli_query($connection, $newquery);
    while($newrow = mysqli_fetch_assoc($newres)){
        $getevent = $newrow['event'];
        $weektype = $newrow['weektype'];
    }

    $query = "SELECT venuename FROM venues WHERE venuetype = '$getevent' ";
    $queryres = mysqli_query($connection, $query);

    $query2 = "SELECT theme_name FROM theme WHERE theme_type = '$getevent' ";
    $themeres = mysqli_query($connection, $query2);


    //sa pagsubmit
    if(isset($_POST['submit']))
    {
        $id = $_SESSION['user_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $address =  $_POST['address'];
        $emailadd = $_POST['emailadd'];
        $bookdate = $_POST['bookdate'];

        $firstname = ucwords($firstname);
        $lastname = ucwords($lastname);
        $address = ucwords($address);

        $sql_booking = "SELECT * FROM booking WHERE id = '$editid' ";
        $result = mysqli_query($connection, $sql_booking);
        
        if($result) {
            $editid = $_GET['editid'];
            $booking = $_GET['booking'];

            if($getevent == 'Wedding'){
                $sql_check = "SELECT * FROM wedding WHERE booking_id = '$booking' " ; 
                $res_check = mysqli_query($connection, $sql_check);
              } else if ($getevent == 'Corporate'){
                $sql_check = "SELECT * FROM corporate WHERE booking_id = '$booking' " ; 
                $res_check = mysqli_query($connection, $sql_check);
              } else if ($getevent == 'Anniversary'){
                $sql_check = "SELECT * FROM anniversary WHERE booking_id = '$booking' " ; 
                $res_check = mysqli_query($connection, $sql_check);
              } else if ($getevent == 'Birthday'){
                $sql_check = "SELECT * FROM birthday WHERE booking_id = '$booking' " ; 
                $res_check = mysqli_query($connection, $sql_check);
              } else if ($getevent == 'Christening'){
                $sql_check = "SELECT * FROM christening WHERE booking_id = '$booking' " ; 
                $res_check = mysqli_query($connection, $sql_check);
              } else {
                ?><script type="text/javascript">
                  alert('Booking ID not found');
                  window.location.href='admin-bookinglist.php';
                  </script>
                <?php 
              }

            
            if(mysqli_num_rows($res_check)>0){

                if(empty($_POST['guests']) ||  empty($_POST['venue'])  || empty( $_POST['cuisine'])  || empty( $_POST['style']) || 
                empty( $_POST['theme'])  || empty( $_POST['checkbox'])) {
                    ?><script type="text/javascript">
                    alert('Some fields are missing data. Please try again');
                    window.history.back();
                    </script>
                    <?php
                } else {
                    $venue = $_POST['venue'];
                    $venue = mysqli_real_escape_string($connection, $venue);
                    $guests = $_POST['guests'];
                    $cuisine = $_POST['cuisine'];
                    $style = $_POST['style'];
                    $theme = $_POST['theme'];
                    $theme = mysqli_real_escape_string($connection, $theme);
                    $message = $_POST['message'];
                    $age = isset($_POST['age']) ? $_POST['age'] : '';
                    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
                    $checkbox = $_POST['checkbox'];
                    $services = implode(",", $checkbox);

                    

                    //para sa pag count kung ilan ung services
                    $noneCount = 0;

                    //check kung none ung venue
                    if($venue == 'None'){
                        $coordinator1 = 'Approved';
                        $noneCount++ ;
                    } else {
                        $coordinator1 = 'Pending';
                    }
                    
                    //check kung none ung cuisine
                    if($cuisine == 'None'){
                        $coordinator2 = 'Approved';
                        $noneCount++ ;
                    } else {
                        $coordinator2 = 'Pending';
                    }

                    //check kung none ung style
                    if($style == 'None'){
                        $coordinator3 = 'Approved';
                        $noneCount++ ;
                    } else {
                        $coordinator3 = 'Pending';
                    }

                    //check kung none ung extra
                    if($services == 'None'){
                        $coordinator4 = 'Approved';
                        $noneCount++ ;
                    } else {
                        $coordinator4 = 'Pending';
                    }


                    //pag less than 2 ung services then di pede
                    if($noneCount >= 2){
                        ?><script type="text/javascript">
                        alert('Please select at least 2 of our services. Thank you');
                        window.history.back();
                        </script>
                        <?php
                    }

                    //check kung none ung venue
                    if($venue == 'None'){
                        $coordinator1 = 'Approved';
                    } else {
                        $coordinator1 = 'Pending';
                    }
                    
                    //check kung none ung cuisine
                    if($cuisine == 'None'){
                        $coordinator2 = 'Approved';
                    } else {
                        $coordinator2 = 'Pending';
                    }

                    //check kung none ung style
                    if($style == 'None'){
                        $coordinator3 = 'Approved';
                    } else {
                        $coordinator3 = 'Pending';
                    }

                    //check kung none ung extra
                    if($services == 'None'){
                        $coordinator4 = 'Approved';
                    } else {
                        $coordinator4 = 'Pending';
                    }


                    // Determine the column to retrieve the price based on the selected weekday or weekend
                    $priceColumn = $weektype;

                    // Retrieve the price based on the selected venue and weekday/weekend
                    $venueQuery = "SELECT $priceColumn FROM venues WHERE venuename = '$venue' AND venuetype = '$getevent' ";
                    $venueResult = mysqli_query($connection, $venueQuery);
                    $venueRow = mysqli_fetch_assoc($venueResult);
                    $venuePrice = $venueRow[$priceColumn];


                    // Retrieve the price based on the cuisine options
                    $cuisineQuery = "SELECT price FROM prices WHERE price_name = '$cuisine' AND price_guestnum = '$guests' ";
                    $cuisineResult = mysqli_query($connection, $cuisineQuery);
                    $cuisineRow = mysqli_fetch_assoc($cuisineResult);
                    $cuisinePrice = $cuisineRow['price'];

                    // Retrieve the price based on the style options
                    $styleQuery = "SELECT price FROM prices WHERE price_name = '$style' AND price_guestnum = '$guests' AND price_event = '$getevent' ";
                    $styleResult = mysqli_query($connection, $styleQuery);
                    $styleRow = mysqli_fetch_assoc($styleResult);
                    $stylePrice = $styleRow['price'];


                    // Create variables for each service and set their value to 1 if they were selected, or 0 otherwise
                    $dj = in_array('DJ Services', $checkbox) ? 1 : 0;
                    $emcee = in_array('Emcee', $checkbox) ? 1 : 0;
                    $photo = in_array('Photographer', $checkbox) ? 1 : 0;
                    $video = in_array('Videographer', $checkbox) ? 1 : 0;
                    $makeup = in_array('Makeup Artist', $checkbox) ? 1 : 0;
                    $bar = in_array('Bar Area', $checkbox) ? 1 : 0;
                    $invitation = in_array('Invitation Cards', $checkbox) ? 1 : 0;
                    $none = in_array('None', $checkbox) ? 1 : 0;

                    // Retrieve the prices of the selected services
                    $servicePrices = array();
                    $totalPrice = 0;

                    foreach ($checkbox as $service) {
                        $serviceQuery = "SELECT price FROM prices WHERE price_name = '$service' ";
                        $serviceResult = mysqli_query($connection, $serviceQuery);
                        $serviceRow = mysqli_fetch_assoc($serviceResult);

                        if ($serviceRow && isset($serviceRow['price'])) {
                            $servicePrice = $serviceRow['price'];
                    
                            // Store the service price in the array with the service name as the key
                            $servicePrices[$service] = $servicePrice;
                    
                            // Add the service price to the total price
                            $totalPrice += $servicePrice;
                        }
                    }

                    $finalPrice = $venuePrice + $cuisinePrice + $stylePrice + $totalPrice;
                    $downPayment = $finalPrice / 2;

                    //check event type bago mag update
                    if($getevent == 'Wedding'){
                        $sql_update = "UPDATE wedding SET venue = '$venue', guest_number = '$guests', cuisine = '$cuisine', style = '$style', theme_design = '$theme', extra_services = '$services', other_preferences = '$message' WHERE booking_id = '$booking' ";
                        $result_update = mysqli_query($connection, $sql_update);

                        $sql_update2 = "UPDATE booking SET firstname = '$firstname', lastname = '$lastname', address = '$address', phone = '$phone', emailadd = '$emailadd', bookdate = '$bookdate', amount = '$finalPrice', downpayment = '$downPayment', venueprice = '$venuePrice', cuisineprice = '$cuisinePrice', styleprice = '$stylePrice', serviceprice = '$totalPrice', coordinator_1 = '$coordinator1', coordinator_2 = '$coordinator2', coordinator_3 = '$coordinator3', coordinator_4 = '$coordinator4'  WHERE id = '$editid' ";
                        $result_update2 = mysqli_query($connection, $sql_update2);

                      } else if ($getevent == 'Corporate'){
                        $sql_update = "UPDATE corporate SET venue = '$venue', guest_number = '$guests', cuisine = '$cuisine', style = '$style', theme_design = '$theme', extra_services = '$services', other_preferences = '$message' WHERE booking_id = '$booking' ";
                        $result_update = mysqli_query($connection, $sql_update);

                        $sql_update2 = "UPDATE booking SET firstname = '$firstname', lastname = '$lastname', address = '$address', phone = '$phone', emailadd = '$emailadd', bookdate = '$bookdate', amount = '$finalPrice', downpayment = '$downPayment', venueprice = '$venuePrice', cuisineprice = '$cuisinePrice', styleprice = '$stylePrice', serviceprice = '$totalPrice', coordinator_1 = '$coordinator1', coordinator_2 = '$coordinator2', coordinator_3 = '$coordinator3', coordinator_4 = '$coordinator4'  WHERE id = '$editid' ";
                        $result_update2 = mysqli_query($connection, $sql_update2);

                      } else if ($getevent == 'Anniversary'){
                        $sql_update = "UPDATE anniversary SET venue = '$venue', guest_number = '$guests', cuisine = '$cuisine', style = '$style', theme_design = '$theme', extra_services = '$services', other_preferences = '$message' WHERE booking_id = '$booking' ";
                        $result_update = mysqli_query($connection, $sql_update);

                        $sql_update2 = "UPDATE booking SET firstname = '$firstname', lastname = '$lastname', address = '$address', phone = '$phone', emailadd = '$emailadd', bookdate = '$bookdate', amount = '$finalPrice', downpayment = '$downPayment', venueprice = '$venuePrice', cuisineprice = '$cuisinePrice', styleprice = '$stylePrice', serviceprice = '$totalPrice', coordinator_1 = '$coordinator1', coordinator_2 = '$coordinator2', coordinator_3 = '$coordinator3', coordinator_4 = '$coordinator4'  WHERE id = '$editid' ";
                        $result_update2 = mysqli_query($connection, $sql_update2);

                      } else if ($getevent == 'Birthday'){
                        $sql_update = "UPDATE birthday SET upcoming_age = '$age', celeb_gender = '$gender', venue = '$venue', guest_number = '$guests', cuisine = '$cuisine', style = '$style', theme_design = '$theme', extra_services = '$services', other_preferences = '$message' WHERE booking_id = '$booking' ";
                        $result_update = mysqli_query($connection, $sql_update);

                        $sql_update2 = "UPDATE booking SET firstname = '$firstname', lastname = '$lastname', address = '$address', phone = '$phone', emailadd = '$emailadd', bookdate = '$bookdate', amount = '$finalPrice', downpayment = '$downPayment', venueprice = '$venuePrice', cuisineprice = '$cuisinePrice', styleprice = '$stylePrice', serviceprice = '$totalPrice', coordinator_1 = '$coordinator1', coordinator_2 = '$coordinator2', coordinator_3 = '$coordinator3', coordinator_4 = '$coordinator4'  WHERE id = '$editid' ";
                        $result_update2 = mysqli_query($connection, $sql_update2);

                      } else if ($getevent == 'Christening'){
                        $sql_update = "UPDATE christening SET celeb_gender = '$gender', venue = '$venue', guest_number = '$guests', cuisine = '$cuisine', style = '$style', theme_design = '$theme', extra_services = '$services', other_preferences = '$message' WHERE booking_id = '$booking' ";
                        $result_update = mysqli_query($connection, $sql_update);

                        $sql_update2 = "UPDATE booking SET firstname = '$firstname', lastname = '$lastname', address = '$address', phone = '$phone', emailadd = '$emailadd', bookdate = '$bookdate', amount = '$finalPrice', downpayment = '$downPayment', venueprice = '$venuePrice', cuisineprice = '$cuisinePrice', styleprice = '$stylePrice', serviceprice = '$totalPrice', coordinator_1 = '$coordinator1', coordinator_2 = '$coordinator2', coordinator_3 = '$coordinator3', coordinator_4 = '$coordinator4'  WHERE id = '$editid' ";
                        $result_update2 = mysqli_query($connection, $sql_update2);

                      } else {
                        ?><script type="text/javascript">
                          alert('A problem has occured');
                          window.location.href='admin-bookinglist.php';
                          </script>
                        <?php 
                      }

                    
                    if($result_update){
                        ?><script type="text/javascript">
                        alert('Updated Succesfully');
                        window.location.href='admin-bookinglist.php';
                        </script> 
                        <?php
                    }


            }

        } else {
            //die(mysqli_error($connection));
            ?><script type="text/javascript">
            alert('A problem occured');
            </script>
            <?php
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
    <title>Event Book List | Admin</title>
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
                <h4>Jerbax</h4>
                <p>Administrator</p>
            </li>
            <!-- Left Nav Bar -->
            <li class="sidebar"><a href="admin-dashboard.php" style="text-decoration: none;"><i class="ri-dashboard-line"></i> Dashboard</a></li>
            <li class="sidebar"><a href="admin-bookinglist.php" class="active" style="text-decoration: none;"><i class="ri-file-list-line"></i> Event Book List</a></li>
            <li class="sidebar"><a href="admin-calendar.php" style="text-decoration: none;"><i class="ri-calendar-line"></i> Event Calendar</a></li>
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
            <h2>Event Book List</h2>
            <a href="admin-bookinglist.php"><img src="CSS/Pictures/glamour-logo.png" alt="Logo"></a>
        </div>
        <div class="container">
            <h3>Edit Event Booking Details</h3>


    <?php
    
    //sa pagdisplay
    if(isset($_GET['editid']) && isset($_GET['booking'])){
        
        //to display the booking form
        $id2 = $_GET['editid'];
        $showbook = "SELECT * FROM booking WHERE id = '$id2'";
        $showresult = mysqli_query($connection, $showbook);
        

        if(($showresult))
        {
            while($getrows = mysqli_fetch_assoc($showresult))
            {
                $booking = $getrows['booking_id'];
                $firstname = $getrows['firstname'];
                $lastname = $getrows['lastname'];
                $phone = $getrows['phone'];
                $address = $getrows['address'];
                $emailadd = $getrows['emailadd'];
                $bookdate = $getrows['bookdate'];
                $event = $getrows['event'];
            }

            $booking = $_GET['booking'];

            //show ung event pag nagtugma
            $query = "SELECT venuename FROM venues WHERE venuetype = '$event' ";
            $queryres = mysqli_query($connection, $query);

            $showbirthday = ("SELECT * FROM birthday WHERE booking_id = '$booking' ");
            $birthdayresult = mysqli_query($connection, $showbirthday);
            if(mysqli_num_rows($birthdayresult) > 0){
                $rows = mysqli_fetch_assoc($birthdayresult);
                $checkbox = $rows['extra_services'];
                $services = explode(",", $checkbox);
            }

            $showwedding = "SELECT * FROM wedding WHERE booking_id = '$booking' ";
            $weddingresult = mysqli_query($connection, $showwedding);
            if(mysqli_num_rows($weddingresult) > 0){
                $rows = mysqli_fetch_assoc($weddingresult);
                $checkbox = $rows['extra_services'];
                $services = explode(",", $checkbox);
            }

            $showanniversary = "SELECT * FROM anniversary WHERE booking_id = '$booking' ";
            $anniversaryresult = mysqli_query($connection, $showanniversary);
            if(mysqli_num_rows($anniversaryresult) > 0){
                $rows = mysqli_fetch_assoc($anniversaryresult);
                $checkbox = $rows['extra_services'];
                $services = explode(",", $checkbox);
            }

            $showchristening = "SELECT * FROM christening WHERE booking_id = '$booking' ";
            $christeningresult = mysqli_query($connection, $showchristening);
            if(mysqli_num_rows($christeningresult) > 0){
                $rows = mysqli_fetch_assoc($christeningresult);
                $checkbox = $rows['extra_services'];
                $services = explode(",", $checkbox);
            }

            $showcorporate = "SELECT * FROM corporate WHERE booking_id = '$booking' ";
            $corporateresult = mysqli_query($connection, $showcorporate);
            if(mysqli_num_rows($corporateresult) > 0){
                $rows = mysqli_fetch_assoc($corporateresult);
                $checkbox = $rows['extra_services'];
                $services = explode(",", $checkbox);
            }


            ?>
            
            <form class="form-grid" action="" method="POST">
                    <div class="editbookingdetails-row1">
                        <div class="editbookingdetails-4column">
                            <h5>First Name</h5>
                            <input type="text" id="firstname" name="firstname" required placeholder="" value=<?php echo "'$firstname'"; ?>>
                        </div>
        
                        <div class="editbookingdetails-4column">
                            <h5>Last Name</h5>
                            <input type="text" id="lastname" name="lastname" required placeholder="" value=<?php echo $lastname; ?>>
                        </div>
        
                        <div class="editbookingdetails-4column">
                            <h5>Contact Number</h5>
                            <input type="tel" id="phone" name="phone" required placeholder="" value=<?php echo $phone; ?>>
                        </div>
        
                        <div class="editbookingdetails-4column">
                            <h5>Address</h5>
                            <input type="text" id="address" name="address" required placeholder="" value=<?php echo "'$address'"; ?>>
                        </div>
                    </div>
        
                    <div class="editbookingdetails-row2">
                        <div class="editbookingdetails-4column">
                            <h5>Email Address</h5>
                            <input type="email" id="emailadd" name="emailadd" required placeholder="" value=<?php echo $emailadd; ?>>
                        </div>
        
                        <div class="editbookingdetails-4column">
                            <h5>Target Date</h5>
                            <input type="date" id="bookdate" name="bookdate" required placeholder="" value=<?php echo $bookdate; ?>>
                        </div>

                        <div class="editbookingdetails-4column">
                            <h5>Event Type</h5>
                            <select id="eventtype" name="eventtype" <?php  echo "disabled"; ?>>
                                <option value="" disabled selected>Select event type</option>
                                <option value="Wedding"
                                <?php
                                if($event == 'Wedding'){
                                    echo "selected";
                                }
                                ?> 
                                >Wedding</option>
                                

                                <option value="Birthday"
                                <?php
                                if($event == 'Birthday'){
                                    echo "selected";
                                }
                                ?> 
                                >Birthday</option>
                                

                                <option value="Christening"
                                <?php
                                if($event == 'Christening'){
                                    echo "selected";
                                }
                                ?> 
                                >Christening</option>
                                

                                <option value="Anniversary"
                                <?php
                                if($event == 'Anniversary'){
                                    echo "selected";
                                }
                                ?> 
                                >Anniversary</option>
                                

                                <option value="Corporate"
                                <?php
                                if($event == 'Corporate'){
                                    echo "selected";
                                }
                                ?> 
                                >Corporate</option>
                            </select>
                        </div>

                        <div class="editbookingdetails-4column">
                            <h5>Celebrant's Age</h5>
                            <?php if($rows['upcoming_age'] != 0) { ?>
                            <input type="number" name="age" id="age" min="0" step="1" value="<?php echo $rows['upcoming_age']; ?>">
                            <?php } else { ?>
                            <input type="number" name="age" id="age" disabled>
                            <?php } ?>
                        </div>
        
                    </div>
                            
                    <div class="editbookingdetails-row3">                                                
                        
                        <div class="editbookingdetails-4column">
                            <h5>Celebrant's Gender</h5>
                            <select id="gender" name="gender" <?php if($rows['celeb_gender']==''){ echo "disabled"; } ?>>
                                <option></option>
                                <option value="Male"
                                <?php
                                if($rows['celeb_gender'] == "Male"){
                                    echo "selected";
                                } 
                                ?> 
                                >Male</option>

                                <option value="Female"
                                <?php
                                if($rows['celeb_gender'] == "Female"){
                                    echo "selected";
                                }
                                ?>
                                >Female</option>
                            </select>
                        </div>

                        <div class="editbookingdetails-4column">
                            <h5>Venue</h5>
                            <select id="venue" name="venue">
                                <option ><?php echo $rows['venue']; ?></option>
                                <?php
                                    while($queryrow = mysqli_fetch_array($queryres))
                                    {
                                        ?>
                                    
                                    
                                    <option ><?php echo $queryrow['venuename']; ?></option>
                                    <?php
                                    }
                                    ?>
                                
                                <option value="None"
                                <?php
                                if($rows['venue'] == 'None'){
                                    echo "selected";
                                }
                                ?> 
                                >None</option>

                            </select>
                        </div>

                        <div class="editbookingdetails-4column">
                            <h5>Cuisine</h5>
                            <select id="cuisine" name="cuisine">
                                <option value="Normal"
                                <?php
                                if($rows['cuisine'] == 'Normal'){
                                    echo "selected";
                                }
                                ?> 
                                >Normal</option>
                                

                                <option value="Deluxe"
                                <?php
                                if($rows['cuisine'] == 'Deluxe'){
                                    echo "selected";
                                }
                                ?> 
                                >Deluxe</option>
                                

                                <option value="Royal"
                                <?php
                                if($rows['cuisine'] == 'Royal'){
                                    echo "selected";
                                }
                                ?> 
                                >Royal</option>

                                <option value="None"
                                <?php
                                if($rows['cuisine'] == 'None'){
                                    echo "selected";
                                }
                                ?> 
                                >None</option>

                            </select>
                        </div>
                        
                        <div class="editbookingdetails-4column">
                            <h5>Guests</h5>
                            <select id="guests" name="guests">
                                <option value="1-50"
                                <?php
                                if($rows['guest_number'] == '1-50'){
                                    echo "selected";
                                } 
                                ?> 
                                >1-50</option>

                                <option value="51-100"
                                <?php
                                if($rows['guest_number'] == '51-100'){
                                    echo "selected";
                                }
                                ?>
                                >51-100</option>

                                <option value="101-200"
                                <?php
                                if($rows['guest_number'] == '101-200'){
                                    echo "selected";
                                }
                                ?>
                                >101-200</option>

                                <option value="201-300"
                                <?php
                                if($rows['guest_number'] == '201-300'){
                                    echo "selected";
                                }
                                ?>
                                >201-300</option>

                            </select>
                        </div>

                    </div>
        
                    <div class="editbookingdetails-row4">

                        <div class="editbookingdetails-4column">
                            <h5>Style</h5>
                            <select id="style" name="style">
                                <option value="Basic"
                                <?php
                                if($rows['style'] == 'Basic'){
                                    echo "selected";
                                }
                                ?> 
                                >Basic</option>
                                

                                <option value="Sleek"
                                <?php
                                if($rows['style'] == 'Sleek'){
                                    echo "selected";
                                }
                                ?> 
                                >Sleek</option>
                                

                                <option value="Polished"
                                <?php
                                if($rows['style'] == 'Polished'){
                                    echo "selected";
                                }
                                ?> 
                                >Polished</option>

                                <option value="None"
                                <?php
                                if($rows['style'] == 'None'){
                                    echo "selected";
                                }
                                ?> 
                                >None</option>

                            </select>
                        </div>
                        <div class="editbookingdetails-4column">
                            <h5>Theme and Design</h5>
                            <select id="theme" name="theme" >
                            <option><?php echo $rows['theme_design']; ?></option>
                                <?php
                                while($themerow = mysqli_fetch_array($themeres))
                                {
                                    ?>
                                
                                
                                <option ><?php echo $themerow['theme_name']; ?></option>
                                <?php
                                }
                                ?>

                                <option value="None"
                                <?php
                                if($rows['theme_design'] == 'None'){
                                    echo "selected";
                                }
                                ?> 
                                >None</option>

                            </select>
                        </div>
                    </div>
        
                    <div class="editbookingdetails-row5">
                    <h5>Extra Services</h5>
                            <div class="checkbox-group"
                            >
                                <label><input type="checkbox" name="checkbox[]" value="DJ Services"
                                <?php
                                    if(in_array("DJ Services", $services)){
                                        echo "checked";
                                    }
                                ?>
                                >DJ Services</label>
                                <label><input type="checkbox" name="checkbox[]" value="Emcee"
                                <?php
                                    if(in_array("Emcee", $services)){
                                        echo "checked";
                                    }
                                ?>
                                >Emcee</label>
                                
                                <label><input type="checkbox" name="checkbox[]" value="Photographer"
                                <?php
                                    if(in_array("Photographer", $services)){
                                        echo "checked";
                                    }
                                ?>
                                >Photographer</label>
                                <label><input type="checkbox" name="checkbox[]" value="Videographer"
                                <?php
                                    if(in_array("Videographer", $services)){
                                        echo "checked";
                                    }
                                ?>
                                >Videographer</label>
                                <label><input type="checkbox" name="checkbox[]" value="Makeup Artist"
                                <?php
                                    if(in_array("Makeup Artist", $services)){
                                        echo "checked";
                                    }
                                ?>
                                >Makeup Artist</label>
                                <label><input type="checkbox" name="checkbox[]" value="Bar Area"
                                <?php
                                    if(in_array("Bar Area", $services)){
                                        echo "checked";
                                    }
                                ?>
                                >Bar Area</label>
                                
                                <label><input type="checkbox" name="checkbox[]" value="Invitation Cards"
                                <?php
                                    if(in_array("Invitation Cards", $services)){
                                        echo "checked";
                                    }
                                ?>
                                >Invitation Cards</label>
                                <label><input type="checkbox" name="checkbox[]" value="None" onclick="disableCheckboxes(this)"
                                <?php
                                    if(in_array("None", $services)){
                                        echo "checked";
                                    }
                                ?>
                                >None</label>
                        </div>
                    </div>
        
                    
                    <div class="editbookingdetails-row7">
                        <h5>Other Preferences</h5>
                        <textarea id="message" name="message" rows="4" cols="80"><?php echo $rows['other_preferences']; ?></textarea>
                    </div>
                    
                    <div class="buttonsbot">
                        <button type="submit" class="save-btn" name="submit">SAVE</button> 
                        <a href="admin-bookinglist.php"><h5 class="back-btn1" style="border-radius: 4px; margin-right: 5px; margin-top: 5px;">BACK</h5></a>
                    </div>
                    
                    <div class="clear"></div>
        
                </div>
            </form>

            <?php
        } else {
            echo"something's wrong";
        }
    }
    
        
    ?>

    
    </main>

    <script>
        function disableCheckboxes(checkbox) {
            var checkboxes = document.getElementsByName('checkbox[]');

            if (checkbox.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].value !== 'None') {
                        checkboxes[i].disabled = true;
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].disabled = false;
                }
            }
        }
    </script>
</body>
</html>