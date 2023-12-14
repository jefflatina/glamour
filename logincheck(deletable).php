<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "event360";

$connection = new mysqli($servername, $username, $password, $database);

if(!$connection = mysqli_connect($servername, $username, $password, $database))
{
    die("Something went wrong. Please try again". mysqli_connect_error());
}




    $login_email = $_POST["logmail"];
    $login_pass_word = $_POST["logpass"];

    $login_email = stripslashes($login_email);
    $login_pass_word = stripslashes($login_pass_word);

    $query = "SELECT * FROM users WHERE email='$login_email' AND pass_word='$login_pass_word'";
    $result = mysql_query($query);
    $count = mysql_num_rows($result);

    if($count == 1){
        //setcookie para di sila makabalik sa dating page
        $seconds = 5 + time();
        setcookie(loggedin, date("F jS - g:i a"), $seconds);
        header("location: home.php");
    } else {
        echo 'Incorrect username or password';
    }

    
    if(!isset($_COOKIE['loggedin'])){
        header("Location: home.php");
    }


    $seconds = -10 + time();
    setcookie(loggedin, date("F jS - g:i a"), $seconds);
    header('location:home.php');



    /*
if(isset($_POST['signuser']) && isset($_POST['signpass']) && isset($_POST['signmail'])){
    $signuser = $_POST['signuser'];
    $signpass = $_POST['signpass'];
    $signmail = $_POST['signmail'];
    $signconpass = $_POST['signconpass'];

    $query = mysql_query("SELECT FROM users WHERE user_name = '".$signuser."' OR email = '".$email."' ");
    if(mysqli_num_rows($query) > 0){
        echo 'may ganyan ng usrname o email. pili ka iba';
    }else{
        mysql_query("INSERT INTO users VALUES ('', '$user_name', '', '$email', '$pass_word') ");
        header("location: home.php");
    }
}
*/


if(isset($_POST['signuser']) && isset($_POST['signpass'])){
    $signuser = $_POST['signuser'];
    $signpass = $_POST['signpass'];
    $signmail = $_POST['signmail'];
    $signconpass = $_POST['signconpass'];

    $query = mysql_query("SELECT FROM users WHERE user_name = '$signuser' OR email = '$email' ");
    if(mysqli_num_rows($query) > 0){
        echo 'may ganyan ng usrname o email. amaccana';
    }else if($signpass != $signconpass){
        echo 'di parehas ammaccana!';
    }else{
        mysql_query("INSERT INTO users (`user_id`, `user_name`, `email`, `status`, `pass_word`) VALUES ('', '$signuser', '$signmail', '', '$signpass')");
        header("location: home.php");
    }

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



if($user_data['user_status'] == 'admin')
                    {
                        header("Location: adminpage.php");
                        die;
                    }





                    //signup
                    <script>
                    function enable(){
                        var check = document.getElementById("checkbox");
                        var btn = document.getElementById("btn");
            
                        if(checkbox.checked)
                        {
                            btn.removeAttribute("disabled");
                        } else {
                            btn.disabled = "true"
                        }
                    }
                    </script>


                    //signup
                    <div class="remember-forgot">
                    <label><input type="checkbox" id="checkbox" onclick="enable()">I agree to the <a href="#">Terms and Conditions</a></label>
                </div>
                <button disabled="true" type="submit" class="btn" id="btn">Sign Up</button>
            </form>
        </div>
    </div>
    <div class="logo">
        <img src="CSS/Pictures/glamour-logo.png" alt="Logo" style="width:100px;height:60px;">
    </div>


                    //login page
    <div class="remember-forgot">
                    <label><input type="checkbox" id="checkbox" name="remember_me">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>




?>