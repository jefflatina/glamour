<?php
session_start();

    include("config.php");
    include("function.php");
 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $logmail = $_POST['logmail'];
        $logpass = $_POST['logpass'];

        if(!empty($logmail) && !empty($logpass))
        {
           //read from database
           $query = "SELECT * FROM users WHERE email = '$logmail' limit 1";

           $result = mysqli_query($connection, $query);

           if($result)
           {
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);

                if($user_data['verify_status'] == "1")
                {
                    $passsql = "SELECT password FROM users WHERE email = '$logmail' ";
                    $sqlres = mysqli_query($connection, $passsql);
                    $sqlrow = mysqli_fetch_assoc($sqlres);
                    $stored_hashed_password = $sqlrow['password'];

                    if(password_verify($logpass, $stored_hashed_password)) {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        if($user_data['user_status'] == 'Admin')
                        {
                            header("Location: admin-dashboard.php");
                            die;
                        }

                        $_SESSION['user_id'] = $user_data['user_id'];
                        if($user_data['user_status'] == 'Venue Coordinator')
                        {
                            header("Location: venuecoor-list.php");
                            die;
                        }

                        $_SESSION['user_id'] = $user_data['user_id'];
                        if($user_data['user_status'] == 'Catering Coordinator')
                        {
                            header("Location: cuisinecoor-list.php");
                            die;
                        }

                        $_SESSION['user_id'] = $user_data['user_id'];
                        if($user_data['user_status'] == 'Style Coordinator')
                        {
                            header("Location: stylecoor-list.php");
                            die;
                        }

                        $_SESSION['user_id'] = $user_data['user_id'];
                        if($user_data['user_status'] == 'Extra Services Coordinator')
                        {
                            header("Location: extracoor-list.php");
                            die;
                        }
                        
                        //remember me
                        if(isset($_POST['remember_me']))
                        {
                            setcookie('logmail', $_POST['logmail'], time() + (60*60*24));
                            setcookie('logpass', $_POST['logpass'], time() + (60*60*24));
                        } else {
                        setcookie('logmail', '', time() - (60*60*24));
                        setcookie('logpass', '', time() - (60*60*24));
                        }
                        
                        header("Location: home-logged.php");
                        die;
                    } else {
                        ?><script type="text/javascript">
                        alert('Wrong password. Please try again');
                        window.history.back();
                        </script>
                        <?php 
                    } 

                } else {
                    ?><script type="text/javascript">
                    alert('Please verify your email address to login');
                    window.location.href='login.php';
                    </script>
                    <?php
                }

                
            } else {
                ?><script type="text/javascript">
                alert('Email not signed up.');
                </script>
                <?php 
            }
            } 
          

        } else {
            ?><script type="text/javascript">
            alert('Please fill out the blank form');
            </script>
            <?php 
        }
    }
 
    if(isset($_COOKIE['logmail']) && isset($_COOKIE['logpass']))
    {
        $mail=$_COOKIE['logmail'];
        $pass=$_COOKIE['logpass'];
    } else {
        $mail = "";
        $pass = "";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/login.css">
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="login-body">
    <section class="wrapper-login" id="wrapper-login">
        <div class="login-main-content">
            <h2 style="font-family: Judson; font-weight: lighter; font-size: 85px;">LOGIN</h2>    
            <form action="" method="POST">
                <div class="login1">
                    <p>Don't have an account?
                        <a href="signup.php" class="signup-link">Sign Up</a>
                    </p>
                </div>
                <div class="input-box">
                    <input type="email" name="logmail" id="logmail" required placeholder="Enter your email address" autocomplete="off">
                    <label><i class="ri-mail-fill"></i>&nbsp;Email Address</label>
                </div>
                <div class="input-box2">
                    <input type="password" name="logpass" id="logpass" required placeholder="Enter your password">
                    <label><i class="ri-lock-fill"></i>&nbsp;Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" id="checkbox" name="remember_me">Remember me</label>
                    <a href="forgotpassword.php" target="_blank">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">LOGIN ACCOUNT</button>
            </form>
        </div>
    </section>
    <div class="logo">
        <img src="CSS/Pictures/glamour-logo.png" alt="Logo" style="width:100px;height:60px;">
    </div>
</body>

<script>
// When the user clicks on <div>, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>

</html>