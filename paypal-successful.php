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
            font-size: 3em;
            margin-top: 45px;
        }
        .container h1{
            font-family: 'Judson';
            font-weight: 500;
            font-size: 2.8em;
            color: #FED586;
        }
        .container p{
            font-family: 'Poppins';
            color: white;
            font-size: .9em;
            margin-bottom: 40px;
        }
        .button{
            display: inline-block;
            padding: 6px 25px;
            background-color: #FED586;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            font-size: .8em;
            font-family: 'Poppins';
            font-weight: 600;
        }
        .button:hover{
            background-color: white;
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
        <p>Thank you for your payment! We are delighted to confirm that your payment has 
            <br>been successfully processed for the event registration. Your spot is now reserved, and 
            <br>we look forward to welcoming you to our upcoming event.</p>
    
    </div>
    <div class="logo">
        <img src="CSS/Pictures/glamour-logo.png" alt="Glamour Logo" width="60px">
    </div>
</body>
</html>