<?php
session_start();

include("config.php");
include("function.php");

if(isset($_GET['email']) && isset($_GET['verify_token']))
{
    $verify_token = $_GET['verify_token'];
    $email = $_GET['email'];
    $verify_query = "SELECT verify_token,verify_status FROM users WHERE verify_token='$verify_token' LIMIT 1";
    $verify_query_run = mysqli_query($connection, $verify_query);

    if(mysqli_num_rows($verify_query_run) > 0)
    {   
        $row = mysqli_fetch_array($verify_query_run);
        if($row['verify_status'] == "0")
        {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE users SET verify_status='1' WHERE verify_token = '$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($connection, $update_query);
            if($update_query_run)
            {
                ?><script type="text/javascript">
                alert('Email verified successfully!');
                </script>
                <?php
                header("Location: login.php"); 
                exit(0);
            } else {
                ?><script type="text/javascript">
                alert('Verification Failed');
                </script>
                <?php
                header("Location: login.php"); 
                exit(0);
            }
        }
    } else {
        ?><script type="text/javascript">
        alert('Email already verified. Please login');
        </script>
        <?php
        header("Location: login.php"); 
    }
} else {
    ?><script type="text/javascript">
    alert('This token does not exist');
    </script>
    <?php
    header("Location: login.php");  
}
                      

?>