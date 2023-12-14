<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">

    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="https://kit.fontawesome.com/a79ec82bd5.js" crossorigin="anonymous"></script>

    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #171818;
            background-image: url('CSS/Pictures/bubbles.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container{
            background-color: #383838;
            position: absolute;
            text-align: center;
            width: 800px;
            height: 400px;
            margin: auto;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            border-radius: 20px;
        }
        .container i{
            color: #FED586;
            font-size: 2.8em;
            margin-top: 40px;
        }
        .container h1{
            font-family: 'Judson';
            font-weight: 500;
            font-size: 2.5em;
            color: #FED586;
        }
        .container p{
            font-family: 'Poppins';
            color: white;
            font-size: .8em;
            margin-bottom: 40px;
        }
        .sci{
            position: relative;
            top: -5px;
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sci li{
            list-style: none;
        }
        .sci li a{
            display: inline-block;
            padding: 8px 9px;
            background: #2C2B2B;
            margin-right: 10px;
            text-decoration: none;
            border-radius: 4px;
            color: #fff;
        }
        .sci li a:hover{
            background: #FED586;
        }
        .sci li a i{
            color: #fff;
            font-size: 20px;
            opacity: 50%;
        }
        .logo{
            position: absolute;
            bottom: 30px;
            right: 30px
        }
    </style>
</head>

<body>
    <div class="container">
        <i class="fa-solid fa-circle-check"></i>
        <h1>PAYMENT SUCCESSFUL</h1>
        <p>Thank you for your payment! Kindly wait for an email confirmation to reserve your spot. Once we 
            <br>receive your payment, we will send you an email confirmation along with a receipt for your records.</p>
        <p>If you have any questions, please don't hesitate to reach us out</p>
        <ul class="sci">
        <li><a href="https://www.facebook.com/profile.php?id=100095125500013" target="_blank"><i class="ri-facebook-circle-fill"></i></a></li>
                        <li><a href="https://www.instagram.com/glam_events2023/?igshid=MzNlNGNkZWQ4Mg%3D%3D" target="_blank"><i class="ri-instagram-fill"></i></a></li>
                        <li><a href="https://twitter.com/glam_events2023?t=KZThjURK6V11GqgPpu7sEQ&s=07" target="_blank"><i class="ri-twitter-fill"></i></a></li>
        </ul>
    </div>
    <div class="logo">
        <img src="CSS/Pictures/glamour-logo.png" alt="Glamour Logo" width="60px">
    </div>
</body>
</html>