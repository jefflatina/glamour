

<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    //userprofile button
    $id = $_SESSION["user_id"];
    $userresult = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $userrow = mysqli_fetch_assoc($userresult);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/contact.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="contact-body">

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
            <li><a href="contact-logged.php" class="active" style="font-size: .8em">CONTACT</a></li>
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

    <section class="contactus">

    <!--contact section top design-->
    <div class="contact-banner" id="contact-banner">
        <p>We'd love to hear from you</p>
        <h2>GET IN TOUCH<br>WITH US</h2>
    </div>

    <!--form-->
    <div class="contact-form" id="contact-form">
        <form class="form-grid" action="mail.php" method="POST" style="font-family: Poppins" enctype="multipart/form-data">

                <div class="form-row">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-row">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" required>
                  </div>
                <div class="form-row form-row--full">
                    <label for="inquiry">Inquiry Category</label>
                    <select id="inquiry" name="inquiry" required>
                        <option value="" disabled selected></option>
                        <option value="Booking Follow Up">Booking Follow Up</option>
                        <option value="Change Booking Details">Change Booking Details</option>
                        <option value="Cancel Event Booking">Cancel Event Booking</option>
                        <option value="Payment Inquiries">Payment Inquiries</option>
                        <option value="Accessibility or Special Assistance">Accessibility or Special Assistance</option>
                        <option value="Technical Support">Technical Support</option>
                        <option value="Feedback or Suggestions">Feedback or Suggestions</option>
                        <option value="Other">Other</option>
                    </select>
                    <p>Please choose the category that best describes your inquiry. If not on the list, you can click Other and specify it.</p>
                </div>
                <div class="form-row form-row--full" id="otherRow" style="display: none;  height: 40px; margin-bottom: 30px;">
                    <label for="other">Other</label>
                    <input type="text" id="other" name="other" style="margin-top: 10px;">
                </div>
                <div class="form-row" id="eventRow" style="display: none;  height: 40px; margin-bottom: 30px;">
                    <label for="event">Event</label>
                    <select id="event" name="event" style="margin-top: 10px;">
                        <option value="" disabled selected>-</option>
                        <option value="Wedding">Wedding</option>
                        <option value="Birthday">Birthday</option>
                        <option value="Christening">Christening</option>
                        <option value="Anniversary">Anniversary</option>
                        <option value="Corporate">Corporate</option>
                    </select>
                </div>
                <div class="form-row" id="idnumRow" style="display: none;  height: 40px; margin-bottom: 30px;">
                    <label for="idnum">Booking/Payment ID</label>
                    <input type="text" id="idnum" name="idnum" style="margin-top: 10px;">
                </div>
                <div class="form-row form-row--full">
                    <label for="message">Additional Details</label>
                    <textarea id="message" name="message" rows="4" cols="80"></textarea>
                    <p>Kindly provide all the information that will help us assist with your inquiry.</p>
                </div>
                <div class="form-row form-row--full">
                    <label for="attach">Attachment</label>
                    <input type="file" id="attach" name="attach">
                    <p>You may attach screenshots or files related to your inquiry.</p>
                </div>
                
                <div class="form-row form-row--full">
                    <button type="submit" class="btn" name="submit">SUBMIT</button>
                </div>
            
        </form>
    </div>

    <script>
    var inquirySelect = document.getElementById('inquiry');
    var idnumRow = document.getElementById('otherRow');
    var eventRow = document.getElementById('eventRow');
    var idnumRow = document.getElementById('idnumRow');

    inquirySelect.addEventListener('change', function() {
        var selectedOption = inquirySelect.value;

        // Show/hide the eventRow based on the selected option
        if (selectedOption === 'Other') {
            otherRow.style.display = 'block';
        } else {
            otherRow.style.display = 'none';
        }

        // Show/hide the eventRow based on the selected option
        if (selectedOption === 'Booking Follow Up' || selectedOption === 'Change Booking Details' || selectedOption === 'Payment Inquiries' || selectedOption === 'Cancel Event Booking') {
            eventRow.style.display = 'block';
            idnumRow.style.display = 'block';
        } else {
            eventRow.style.display = 'none';
            idnumRow.style.display = 'none';
        }

    });
</script>

</section>

    <!--footer section-->
    <footer>
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
                    <li><a href="birthday-logged.php">Birthday</a></li>
                    <li><a href="christenin-logged.php">Christening</a></li>
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
                        <p><a href="tel:09453391986">0945 339 1986</a><br></p>
                    </li>
                    <li>
                        <span><i class="ri-mail-open-fill"></i></span>
                        <p><a href="mailto:glamourevents@gmail.com">glamourevents@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </footer>
    <div class="copyright">
        <p>&copy; 2023 Glamour Events. All Rights Reserved.</p>
    </div> 

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>