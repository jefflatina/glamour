<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

        //display profile infos
        $id = $_SESSION["user_id"];
        $result = mysqli_query($connection, "SELECT * FROM booking WHERE user_id = $id");
        $row = mysqli_fetch_assoc($result);
    
        $userresult = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
        $userrow = mysqli_fetch_assoc($userresult);

    $query = "SELECT venuename FROM venues WHERE venuetype = 'Birthday' ";
    $queryres = mysqli_query($connection, $query);

    $query2 = "SELECT theme_name FROM theme WHERE theme_type = 'Birthday' ";
    $themeres = mysqli_query($connection, $query2);
   
    //unique id
    $checkid = "SELECT id FROM birthday ORDER BY id DESC LIMIT 1"; // select only id column
    $checkresult = mysqli_query($connection, $checkid);

    if(mysqli_num_rows($checkresult) > 0)
        {

        $row = mysqli_fetch_assoc($checkresult);
        $uid = $row['id'];
        $get_numbers = str_replace("BDAY-", "", $uid);
        $id_increase = $get_numbers+1;
        $get_string = str_pad($id_increase, 4, 0, STR_PAD_LEFT);
        $newid = "BDAY-".$get_string; 

        } else {
            $newid = "BDAY-0001";
        }

        //unique id para sa invoice
        $inv_id = "SELECT id FROM invoice ORDER BY id DESC LIMIT 1";
        $newresult = mysqli_query($connection, $inv_id);

            if(mysqli_num_rows($newresult) > 0){
                $invoicerow = mysqli_fetch_assoc($newresult);
                $invoiceid = $invoicerow['id'];
                $invoice_number = str_replace("Invoice-", "", $invoiceid);
                $invoiceid_increase = $invoice_number+1;
                $invoiceget_string = str_pad($invoiceid_increase, 4, 0, STR_PAD_LEFT);
                $invoice_id = "Invoice-".$invoiceget_string;
            } else {
                $invoice_id = "Invoice-0001";
            }

        //unique id para sa billing
        $bill_id = "SELECT id FROM billing ORDER BY id DESC LIMIT 1";
        $newbill = mysqli_query($connection, $bill_id);

            if(mysqli_num_rows($newbill) > 0){
                $billrow = mysqli_fetch_assoc($newbill);
                $billid = $billrow['id'];
                $bill_number = str_replace("Bill-", "", $billid);
                $bill_increase = $bill_number+1;
                $bill_string = str_pad($bill_increase, 4, 0, STR_PAD_LEFT);
                $bill_id = "Bill-".$bill_string;
            } else {
                $bill_id = "Bill-0001";
            }

        //unique id para sa receipt
        $receipt_id = "SELECT id FROM billing ORDER BY id DESC LIMIT 1";
        $newreceipt = mysqli_query($connection, $receipt_id);

            if(mysqli_num_rows($newreceipt) > 0){
                $receiptrow = mysqli_fetch_assoc($newreceipt);
                $receiptid = $receiptrow['id'];
                $receipt_number = str_replace("Receipt-", "", $receiptid);
                $receipt_increase = $receipt_number+1;
                $receipt_string = str_pad($receipt_increase, 4, 0, STR_PAD_LEFT);
                $receipt_id = "Receipt-".$receipt_string;
            } else {
                $receipt_id = "Receipt-0001";
            }

            
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

        $dayOfWeek = date('N', strtotime($bookdate));

        if ($dayOfWeek == 6 || $dayOfWeek == 7) {
            $weektype = 'weekend';
        } else {
            $weektype = 'weekday';
        }
        
        //if date is not at least one month from today
        $current_date = date('Y-m-d'); // Get the current date in YYYY-MM-DD format
        $one_month_from_now = strtotime('+1 month', strtotime($current_date));
        $user_date = strtotime($bookdate);

        //if date is already booked
        $query3 = "SELECT * FROM booking WHERE bookdate='$bookdate' AND status = 'confirmed' ";
        $dateres = mysqli_query($connection, $query3);

        if(strtotime($bookdate) < time()) {
            echo "<script>alert('The date you submitted is already in the past. Please choose a new date or edit the existing date.');</script>";
            echo "<script>window.history.back();</script>";
        } elseif(mysqli_num_rows($dateres) > 0) {
            echo "<script>alert('Your preferred target date is already booked. Please choose other dates. Thank you');</script>";
            echo "<script>window.history.back();</script>";
        } elseif($user_date < $one_month_from_now) {
            echo "<script>alert('Please choose a date that is at least one month from today.');</script>";
            echo "<script>window.history.back();</script>";
        } else {
            //

                if(empty($_POST['age']) || empty($_POST['guests']) || empty( $_POST['gender']) || empty($_POST['venue'])  || empty( $_POST['cuisine'])  || empty( $_POST['style'])  || empty( $_POST['theme'])  || empty( $_POST['checkbox']))
                {
                    ?><script type="text/javascript">
                    alert('Fill in all fields before submitting. Restart filling in the forms again');
                    </script>
                    <?php
                } else {
                        $age = $_POST['age'];
                        $gender = $_POST['gender'];
                        $venue = $_POST['venue'];
                        $guests = $_POST['guests'];
                        $cuisine = $_POST['cuisine'];
                        $style = $_POST['style'];
                        $theme = $_POST['theme'];
                        $message = $_POST['message'];
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


                        // Retrieve the price based on the venue
                        // Determine the column to retrieve the price based on the selected weekday or weekend
                        $priceColumn = $weektype;

                        //139, 147, 154 access array offset on value type of null
                        // Retrieve the price based on the selected venue and weekday/weekend
                        $venueQuery = "SELECT $priceColumn FROM venues WHERE venuename = '$venue' AND venuetype = 'Birthday' ";
                        $venueResult = mysqli_query($connection, $venueQuery);
                        $venueRow = mysqli_fetch_assoc($venueResult);
                        $venuePrice = $venueRow[$priceColumn];
                        //echo " Venue Price: $venuePrice";


                        // Retrieve the price based on the cuisine options
                        $cuisineQuery = "SELECT price FROM prices WHERE price_name = '$cuisine' AND price_guestnum = '$guests' ";
                        $cuisineResult = mysqli_query($connection, $cuisineQuery);
                        $cuisineRow = mysqli_fetch_assoc($cuisineResult);
                        $cuisinePrice = $cuisineRow['price'];
                        //echo " Cuisine Price: $cuisinePrice";

                        // Retrieve the price based on the style options
                        $styleQuery = "SELECT price FROM prices WHERE price_name = '$style' AND price_guestnum = '$guests' AND price_event = 'Birthday' ";
                        $styleResult = mysqli_query($connection, $styleQuery);
                        $styleRow = mysqli_fetch_assoc($styleResult);
                        $stylePrice = $styleRow['price'];
                        //echo " Style Price: $stylePrice";

                        // Create variables for each service and set their value to 1 if they were selected, or 0 otherwise
                        $dj = in_array('DJ Services', $checkbox) ? 1 : 0;
                        $emcee = in_array('Emcee', $checkbox) ? 1 : 0;
                        $photo = in_array('Photographer', $checkbox) ? 1 : 0;
                        $video = in_array('Videographer', $checkbox) ? 1 : 0;
                        $makeup = in_array('Makeup Artist', $checkbox) ? 1 : 0;
                        $bar = in_array('Bar Area', $checkbox) ? 1 : 0;
                        $invitation = in_array('Invitation Cards', $checkbox) ? 1 : 0;
                        $none = in_array('None', $checkbox) ? 1 : 0;

                        // Retrieve the price based on the services options
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

                        // Output the total price
                        $finalPrice = $venuePrice + $cuisinePrice + $stylePrice + $totalPrice;
                        $downPayment = $finalPrice / 2;


                        $sql_booking = "INSERT INTO booking (user_id, booking_id, firstname, lastname, phone, address, emailadd, bookdate, weektype, event, amount, downpayment, venueprice, cuisineprice, styleprice, serviceprice, status, coordinator_1, coordinator_2, coordinator_3, coordinator_4) VALUES ('$id', '$newid', '$firstname', '$lastname', '$phone', '$address', '$emailadd', '$bookdate', '$weektype', 'Birthday', '$finalPrice', '$downPayment', '$venuePrice', '$cuisinePrice', '$stylePrice', '$totalPrice', 'pending', '$coordinator1', '$coordinator2', '$coordinator3', '$coordinator4' )";
                            $result = mysqli_query($connection, $sql_booking);
                
                        $sql_booking2 = "INSERT INTO birthday (user_id, booking_id, upcoming_age, celeb_gender, venue, guest_number, cuisine, style, theme_design, extra_services, other_preferences) VALUES ('$id','$newid', '$age', '$gender', '$venue', '$guests', '$cuisine', '$style', '$theme', '$services', '$message')";
                        $result2 = mysqli_query($connection, $sql_booking2);

                        if($result && $result2)
                                    {
                                        $sql_billing = "INSERT INTO billing (invoice_id, receipt_id, billing_id, booking_id, user_id, amount) VALUES ('$invoice_id', '$receipt_id', '$bill_id', '$newid', '$id', '$finalPrice') ";
                                        $result3 = mysqli_query($connection, $sql_billing);

                                        $sql_invoice = "INSERT INTO invoice (invoice_id, user_id, booking_id) VALUES ('$invoice_id', '$id', '$newid' ) ";
                                        $invoice_result = mysqli_query($connection, $sql_invoice);

                                        $sql_receipt = "INSERT INTO receipt (receipt_id, user_id, booking_id) VALUES ('$receipt_id', '$id', '$newid' ) ";
                                        $receipt_result = mysqli_query($connection, $sql_receipt);

                                        ?><script type="text/javascript">
                                        alert('Booked successfully.');
                                        window.location.href='birthdaybook.php';
                                        </script>
                                        <?php
                                    } else {
                                        
                                        //die(mysqli_error($connection));
                                        ?><script type="text/javascript">
                                        alert('There is a problem with the server. Try again later');
                                        </script>
                                        <?php
                            }
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
    <title>Book a Birthday | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/bookings.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
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
                    <li><a href="birthday-logged.php" class="active" style="font-size: .7em">Birthday</a></li>
                    <li><a href="christening-logged.php" style="font-size: .7em">Christening</a></li>
                    <li><a href="anniversary-logged.php" style="font-size: .7em">Anniversary</a></li>
                    <li><a href="corporate-logged.php" style="font-size: .7em">Corporate</a></li>
                </ul>
            </li>
            <li><a href="contact-logged.php" style="font-size: .8em">CONTACT</a></li>
            <li><a href="budget.php" style="font-size: .8em">BUDGET</a></li>
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

    <!--booking section top design-->
    <section class="booking-banner" id="banner">
        <div class="booking-banner-container">
            <h2>IT STARTS <br>WITH US.</h2>
            <p>BIRTHDAY FORM</p>
        </div>

        <div class="booking-form-container" id="booking-form-container">
            <div class="answer-form">
                <h2>BIRTHDAY PLANNING</h2>
                <p>START BY FILLING UP THE FORM</p>
            </div>

            <form class="form-grid" action="#" method="POST">
                <div class="form-row">
                    <label for="firstname">FIRST NAME</label>
                    <input type="text" id="firstname" name="firstname" required placeholder="Enter your first name" value="<?php echo $userrow["firstname"]; ?>">
                </div>
                <div class="form-row">
                    <label for="lastname">LAST NAME</label>
                    <input type="text" id="lastname" name="lastname" required placeholder="Enter your last name" value="<?php echo $userrow["lastname"]; ?>">
                  </div>
                <div class="form-row">
                    <label for="phone">CONTACT NUMBER</label>
                    <input type="tel" id="phone" name="phone" required placeholder="Enter your contact number" value="<?php echo $userrow["phone"]; ?>">
                </div>
                <div class="form-row">
                    <label for="address">ADDRESS</label>
                    <input type="text" id="address" name="address" required placeholder="Enter your address" value="<?php echo $userrow["address"]; ?>">
                </div>
                <div class="form-row">
                    <label for="email">EMAIL ADDRESS</label>
                    <input type="email" id="emailadd" name="emailadd" required placeholder="Enter your email address" value="<?php echo $userrow["email"]; ?>">
                </div>
                <div class="form-row">
                    <label for="bookdate">TARGET DATE</label>
                    <input type="date" id="bookdate" name="bookdate" required placeholder="Select your preferred date">
                </div>

                <div class="form-row form-row--full">
                    <a href="#booking-form"><h5 type="menu" class="proceed-btn">PROCEED</h5></a>
                </div>

            
        </div>

        <script>
                const dateInput = document.getElementById('bookdate');
                const today = new Date();
                const minDate = new Date(today.getFullYear(), today.getMonth() + 2, 1).toISOString().split('T')[0];
                dateInput.setAttribute('min', minDate);
            </script>
    

<!--booking form section-->
    <div class="booking-form" id="booking-form">
        <div class="col1">
            <h2>PLEASE PROVIDE US WITH THE<br>NECESSARY INFORMATION</h2>
            <div class="bookpic">
                <img src="CSS/Pictures/birthday/birthdaybookdisplay.png" style="width: 100%;">
            </div>
        </div>
        <div class="col2">
            <h2>Celebrant's Upcoming Age</h2>
            <input type="number" id="age" name="age"
             min="1" max="300" step="1" placeholder="Enter Celebrant's Upcoming Age">

             <h2>Celebrant's Gender</h2>
             <select id="gender" name="gender">
                 <option value="" disabled selected >Select Celebrant's Gender</option>
                 <option value="Male">Male</option>
                 <option value="Female">Female</option>
             </select>

            <h2>Venue</h2>
            <select id="venue" name="venue">
            <option value="" disabled selected >Select your preferred venue</option>
            <?php
                while ($queryrow = mysqli_fetch_array($queryres)) {
                    $venuename = $queryrow['venuename'];
                    if ($venuename == "None") {
                        echo '<option value="' . $venuename . '" style="color: #999;">' . $venuename . '</option>';
                    } else {
                        echo '<option value="' . $venuename . '">' . $venuename . '</option>';
                    }
                }
                ?>
            </select>

            
            <h2>Estimated Number of Guests</h2>
            <select id="guests" name="guests">
                <option value="" disabled selected>Enter your estimated guest number</option>
                <option value="1-50">1-50</option>
                <option value="51-100">51-100</option>
                <option value="101-200">101-200</option>
                <option value="201-300">201-300</option>
            </select>
            
            <h2>Cuisine</h2>
            <select id="cuisine" name="cuisine">
                <option value="" disabled selected>Select your preferred cuisine type</option>
                <option value="Normal">Normal</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Royal">Royal</option>
                <option style = "color: #999;" value="None">None</option>
            </select>
            
            <h2>Style & Creation</h2>

            <p>Venue Styling</p>
            <select id="style" name="style">
                <option value="" disabled selected>Select the type of venue styling</option>
                <option value="Basic">Basic</option>
                <option value="Sleek">Sleek</option>
                <option value="Polished">Polished</option>
                <option style = "color: #999;" value="None">None</option>
            </select>
            
            <p>Theme & Design</p>
            <select id="theme" name="theme">
                <option value="" disabled selected>Select your preferred theme and design</option>
                <?php
                while($themerow = mysqli_fetch_array($themeres))
                {
                    ?>
                
                
                <option ><?php echo $themerow['theme_name']; ?></option>
                <?php
                }
                ?>
                <option style = "color: #999;" value="None">None</option>
            </select>
            
            <h2>Extra Services</h2>
            <div class="checkbox-group">
                <label><input type="checkbox" name="checkbox[]" value="DJ Services">DJ Services</label>
                <label><input type="checkbox" name="checkbox[]" value="Emcee">Emcee</label>
                <label><input type="checkbox" name="checkbox[]" value="Photographer">Photographer</label>
                <label><input type="checkbox" name="checkbox[]" value="Videographer">Videographer</label>
                <label><input type="checkbox" name="checkbox[]" value="Makeup Artist">Makeup Artist</label>
                <label><input type="checkbox" name="checkbox[]" value="Bar Area">Bar Area</label>
                <label><input type="checkbox" name="checkbox[]" value="Invitation Cards">Invitation Cards</label>
                <label style = "color: #999;"><input type="checkbox" name="checkbox[]" value="None" onclick="disableCheckboxes(this)">None</label>
            </div>
            
            <h2>Other Preferences</h2>
            <textarea id="message" name="message" rows="4" cols="80"></textarea>

            <button type="submit" class="book-btn" name="submit" onclick="return confirm('Please review your information carefully before submitting the form. Are you sure you want to proceed?')">BOOK NOW</button>
        </div>
    </form>
        
    </div>
</section>
    <!--footer section-->
    <footer style="margin-top: 1200px;">
        <div class="container">
            <div class="sec aboutus">
                <h2>About Us</h2>
                <p> We believe that a successful event is 
                    a result of careful planning, attention 
                    to detail, and seamless execution. We 
                    are committed to providing exceptional 
                    service, and making the planning process 
                    enjoyable and stress-free for our clients. 
                    Let us take your event to the next level and 
                    create a truly unforgettable experience for you 
                    and your guests.</p>
                    <ul class="sci">
                    <li><a href="https://www.facebook.com/profile.php?id=100095125500013" target="_blank"><i class="ri-facebook-circle-fill"></i></a></li>
                        <li><a href="https://www.instagram.com/glam_events2023/?igshid=MzNlNGNkZWQ4Mg%3D%3D" target="_blank"><i class="ri-instagram-fill"></i></a></li>
                        <li><a href="https://twitter.com/glam_events2023?t=KZThjURK6V11GqgPpu7sEQ&s=07" target="_blank"><i class="ri-twitter-fill"></i></a></li>
                    </ul>
            </div>
            <div class="sec quicklinks">
                <h2>Event Links</h2>
                <ul>
                    <li><a href="wedding-logged.php">Wedding</a></li>
                    <li><a href="#">Birthday</a></li>
                    <li><a href="christening-logged.php">Christening</a></li>
                    <li><a href="anniversary-logged.php">Anniversary</a></li>
                    <li><a href="corporate-logged.php">Corporate</a></li>
                </ul>
            </div>
            <div class="sec contact">
                <h2>Contact Info</h2>
                <ul class="info">
                    <li>
                        <span><i class="ri-map-pin-fill"></i></span>
                        <span>Intramuros Manila,<br>Philippines</span>
                    </li>
                    <li>
                        <span><i class="ri-phone-fill"></i></span>
                        <p><a href="tel:09651626236">0965 162 6236</a><br></p>
                    </li>
                    <li>
                        <span><i class="ri-mail-open-fill"></i></span>
                        <p><a href="mailto:glamourevents2023@gmail.com">glamourevents2023@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </footer>
    <div class="copyright">
        <p>&copy; 2023 Glamour Events. All Rights Reserved.</p>
    </div> 


    <!--Linked-->
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!---js link--->
    <script type="text/javascript" src="script.js"></script>
</body>
</html>





