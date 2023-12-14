<?php

session_start();

    include("config.php");
    include("function.php");
    $user_data = check_login($connection);


     //userprofile button
     $id = $_SESSION["user_id"];
     $userresult = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
     $userrow = mysqli_fetch_assoc($userresult);


    $prediction = '';

    if(isset($_POST['submit']))
    {
        //// API endpoint URL
        $api_url = 'http://127.0.0.1:5000/predict';

        $event = $_POST['event'];
        $venue = $_POST['venue'];
        $guests = $_POST['guest_number'];
        $cuisine = $_POST['cuisine'];
        $style = $_POST['style'];
        $weektype = $_POST['weektype'];

        $checkbox = $_POST['checkbox'];
        $services = implode(",", $checkbox);

            // Create variables for each service and set their value to 1 if they were selected, or 0 otherwise
            $dj = in_array('DJ Services', $checkbox) ? 1 : 0;
            $emcee = in_array('Emcee', $checkbox) ? 1 : 0;
            $photo = in_array('Photographer', $checkbox) ? 1 : 0;
            $video = in_array('Videographer', $checkbox) ? 1 : 0;
            $makeup = in_array('Makeup Artist', $checkbox) ? 1 : 0;
            $bar = in_array('Bar Area', $checkbox) ? 1 : 0;
            $invitation = in_array('Invitation Cards', $checkbox) ? 1 : 0;
            $none = in_array('None', $checkbox) ? 1 : 0;



            // Input data
            $input_data = array(
                'event' => $event,
                'venue' => $venue,
                'cuisine' => $cuisine,
                'style' => $style,
                'guest_number' => $guests,
                'weektype' => $weektype,
                'dj_services' => $dj,
                'emcee' => $emcee,
                'photog' => $photo,
                'videog' => $video,
                'm_artist' => $makeup,
                'bar_area' => $bar,
                'inv_cards' => $invitation
            );


        // Send POST request to the API
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Check if API request was successful
        if ($response === false) {
            die('Error occurred while calling the API.');
        }

        // Parse the API response
        $result = json_decode($response, true);

        // Check if prediction is available
        if (isset($result['prediction'])) {
            $prediction = round($result['prediction'], -3);
            $_SESSION["prediction"] = $prediction;
            header("Location: budget-output.php");
            exit;
 
        } else {
            echo 'Prediction not available.';
        }

        
    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Plan | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/budget.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <!--javascript-->
    <script src="budgetscript.js" defer></script>

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
                    <li><a href="birthday-logged.php" style="font-size: .7em">Birthday</a></li>
                    <li><a href="christening-logged.php" style="font-size: .7em">Christening</a></li>
                    <li><a href="anniversary-logged.php" style="font-size: .7em">Anniversary</a></li>
                    <li><a href="corporate-logged.php" style="font-size: .7em">Corporate</a></li>
                </ul>
            </li>
            <li><a href="contact-logged.php" style="font-size: .8em">CONTACT</a></li>
            <li><a href="budget.php" class="active" style="font-size: .8em">BUDGET</a></li>
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

    <!----------- Multi Step Form ------>

    <div class="multistepform">

        <form action="" class="form" method="post">
        <h1 style="text-align: center; color: #FED586; ">SMART FINANCES, SEAMLESS EVENTS</h1>
        <!-- Progress bar -->
        <div class="progressbar">
            <div class="progress" id="progress"></div>
            
            <div
            class="progress-step progress-step-active"
            data-title="Event"
            ></div>
            <div class="progress-step" data-title="Venue"></div>
            <div class="progress-step" data-title="Guests"></div>
            <div class="progress-step" data-title="Cuisine"></div>
            <div class="progress-step" data-title="Styling"></div>
            <div class="progress-step" data-title="Extras"></div>
        </div>

        <!-- Steps -->
        <div class="form-step form-step-active">
            <div class="input-group">
            <h6>What type of event you wish to book?</h6>
            
                <p>I'm planning for a/an &nbsp;
                <select id="event" name="event" onchange="updateVenues()">
                    <option style="color: #999" value="" disabled selected></option>
                    <option value="1">Wedding</option>
                    <option value="2">Birthday</option>
                    <option value="3">Christening</option>
                    <option value="4">Anniversary</option>
                    <option value="5">Corporate</option>
                </select>&nbsp;&nbsp;event experience.</p> 
            </div>
            <div class="" style="display: flex; justify-content: flex-end;">
                <a href="#" class="btn btn-next width-50 mr-auto" name="next" >NEXT</a>
            </div>
        </div>
        <div class="form-step">
            <div class="input-group">
            <h6>Do you have the venue and the date in mind?</h6>
                <p>I'm thinking about &nbsp;
                <select id="venue" name="venue">
                    <option value="" disabled selected></option>
                    <!-- Venues -->
                </select>&nbsp;&nbsp;&nbsp;on &nbsp;
                
                <input type="date" name="bookdate" id="bookdate" onchange="insertWeekType()" required/></p>  
                <input type="hidden" name="weektype" id="weektype" readonly/></p>  

            </div>
        
            <div class="btns-group">
            <a href="#" class="btn btn-prev">BACK</a>
            <a href="#" class="btn btn-next" name="next" >NEXT</a>
            </div>
        </div>

        <!-- To conditionally show respective venues based on the event type --->
        <script>
            function updateVenues() {
            var eventType = document.getElementById("event").value;
            var venueDropdown = document.getElementById("venue");

            // Reset venue dropdown to initial state
            venueDropdown.innerHTML = '<option value="" disabled selected></option>';

            // Populate venue options based on the event type
            if (eventType === "1") {
            venueDropdown.innerHTML += '<option value="1">The Emerald Events Place</option>';
            venueDropdown.innerHTML += '<option value="2">The Mango Farm Events Place</option>';
            venueDropdown.innerHTML += '<option value="3">Lihim ng Kubli</option>';
            venueDropdown.innerHTML += '<option value="4">Versailles Palace</option>';
            venueDropdown.innerHTML += '<option value="5">The Madisons Events Place</option>';
            venueDropdown.innerHTML += '<option value="0" style="color: #999;">*I\'ll provide my own*</option>';

            } else if (eventType === "2") {
            venueDropdown.innerHTML += '<option value="6">Paradisso Terrestre</option>';
            venueDropdown.innerHTML += '<option value="7">Glass Garden</option>';
            venueDropdown.innerHTML += '<option value="4">Versailles Palace</option>';
            venueDropdown.innerHTML += '<option value="8">Fernwood Gardens</option>';
            venueDropdown.innerHTML += '<option value="1">The Emerald Events Place</option>';
            venueDropdown.innerHTML += '<option value="0" style="color: #999;">*I\'ll provide my own*</option>';

            } else if (eventType === "3") {
            venueDropdown.innerHTML += '<option value="9">The Green Lounge</option>';
            venueDropdown.innerHTML += '<option value="10">Sitio Elena</option>';
            venueDropdown.innerHTML += '<option value="11">Patio de Manila</option>';
            venueDropdown.innerHTML += '<option value="12">Sedretos Royale</option>';
            venueDropdown.innerHTML += '<option value="13">The Forest Barn</option>';
            venueDropdown.innerHTML += '<option value="0" style="color: #999;">*I\'ll provide my own*</option>';

            }
            else if (eventType === "4") {
            venueDropdown.innerHTML += '<option value="3">Lihim ng Kubli</option>';
            venueDropdown.innerHTML += '<option value="9">The Green Lounge</option>';
            venueDropdown.innerHTML += '<option value="14">Nuevo Comienzo Resort</option>';
            venueDropdown.innerHTML += '<option value="15">The Silica Event Place</option>';
            venueDropdown.innerHTML += '<option value="8">Fernwood Gardens</option>';
            venueDropdown.innerHTML += '<option value="0" style="color: #999;">*I\'ll provide my own*</option>';
            }
            else if (eventType === "5") {
            venueDropdown.innerHTML += '<option value="16">The Circle Events Place</option>';
            venueDropdown.innerHTML += '<option value="3">Lihim ng Kubli</option>';
            venueDropdown.innerHTML += '<option value="17">One Grand Pavillion</option>';
            venueDropdown.innerHTML += '<option value="6">Paradisso Terrestre</option>';
            venueDropdown.innerHTML += '<option value="18">Josephine Events</option>';
            venueDropdown.innerHTML += '<option value="0" style="color: #999;">*I\'ll provide my own*</option>';
            }
        }
        </script>

        <!-- To disable past dates in the calendar --->
        <script>
            const dateInput = document.getElementById('bookdate');
            const today = new Date();
            const minDate = new Date(today.getFullYear(), today.getMonth() + 2, 1).toISOString().split('T')[0];
            dateInput.setAttribute('min', minDate);
        </script>

        <!-- To input weektype based on bookdate --->
        <script>
            function insertWeekType() {
            var dateInput = document.getElementById("bookdate");
            var weekTypeInput = document.getElementById("weektype");

            var dateValue = dateInput.value;

            // Parse the input date to extract week type
            var parsedDate = new Date(dateValue);
            var weekType = getWeekType(parsedDate);

            // Insert week type into the weekType input field
            weekTypeInput.value = weekType;
        }

        function getWeekType(date) {
            // Here you can implement your logic to determine the week type based on the date
            // Example logic: Assuming Monday to Friday are Week A and Saturday to Sunday are Week B
            var dayOfWeek = date.getDay();
            var weekType = (dayOfWeek >= 1 && dayOfWeek <= 5) ? "1" : "2";

            return weekType;
        }
        </script>
        
        <div class="form-step">
            <div class="input-group">
            <h6>Do you know your estimated guest count?</h6>
                <p>I'm estimating it with a range of &nbsp;
                <select id="guest_number" name="guest_number">
                    <option value="" disabled selected></option>
                    <option value="1">1-50</option>
                    <option value="2">51-100</option>
                    <option value="3">101-200</option>
                    <option value="4">201-300</option>
                </select>&nbsp;&nbsp;total of guests.</p> 
            </div>
 
            <div class="btns-group">
            <a href="#" class="btn btn-prev">BACK</a>
            <a href="#" class="btn btn-next" name="next" >NEXT</a>
            </div>
        </div>

        <div class="form-step">
            <div class="input-group">
                <h6>What type of cuisine you want to be served in your event?</h6>
                <p>I'm thinking for a &nbsp;
                <select id="cuisine" name="cuisine">
                    <option value="" disabled selected></option>
                    <option value="1">Normal</option>
                    <option value="2">Deluxe</option>
                    <option value="3">Royal</option>
                    <option value="0" style="color: #999;">*I'll provide my own*</option>
                </select>&nbsp;&nbsp;type of cuisine.</p> 
            </div>
 
            <div class="btns-group">
            <a href="#" class="btn btn-prev">BACK</a>
            <a href="#" class="btn btn-next" name="next" >NEXT</a>
            </div>
        </div>

        <div class="form-step">
            <div class="input-group">
                <h6>What type of venue styling you wish on the day of your event?</h6>
                <p>I'm planning for a &nbsp;
                <select id="style" name="style">
                    <option value="" disabled selected></option>
                    <option value="1">Basic</option>
                    <option value="2">Sleek</option>
                    <option value="3">Polished</option>
                    <option value="0" style="color: #999;">*I'll provide my own*</option>
                </select>&nbsp;&nbsp;type of venue styling.</p> 
            </div>
 
            <div class="btns-group">
            <a href="#" class="btn btn-prev">BACK</a>
            <a href="#" class="btn btn-next" name="next" >NEXT</a>
            </div>
        </div>

        <div class="form-step">
        <div class="input-group">
            <h6 style="margin-bottom: 10px;">What extra services you want to add on your event?</h6>
            <div class="checkbox-grid" id="checkboxOptions">
                <label style="font-size: 15px;"><input type="checkbox" name="checkbox[]" value="DJ Services">DJ Services</label>
                <label style="font-size: 15px;"><input type="checkbox" name="checkbox[]" value="Emcee">Emcee</label>
                <label style="font-size: 15px;"><input type="checkbox" name="checkbox[]" value="Photographer">Photographer</label>
                <label style="font-size: 15px;"><input type="checkbox" name="checkbox[]" value="Videographer">Videographer</label>
                <label style="font-size: 15px;"><input type="checkbox" name="checkbox[]" value="Makeup Artist">Makeup Artist</label>
                <label style="font-size: 15px;"><input type="checkbox" name="checkbox[]" value="Bar Area">Bar Area</label>
                <label style="font-size: 15px;"><input type="checkbox" name="checkbox[]" value="Invitation Cards">Invitation Cards</label>
                <label style="font-size: 15px; color: #999;"><input type="checkbox" name="checkbox[]" value="None" onclick="disableCheckboxes(this)">None</label>
        </div>
    
            <div class="btns-group">
                <a href="#" class="btn btn-prev">BACK</a>
                <input type="submit" value="SUBMIT" name="submit" class="submitbtn" />
            </div>
        </div>
        </div>
        </form>

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

</body>
</html>
