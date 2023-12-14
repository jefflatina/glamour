<?php
session_start();

include("config.php");
include("function.php");


if(isset($_POST['password_reset_link']))
{
    $email = mysqli_real_escape_string($connection, $_POST['forgotemail']);

    $check_email = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $check_email_run = mysql_query($connection, $check_email);

    if(mysqli_num_rows($check_email_run) > 0)
    {
        $row = mslqi_fetch_array($check_email_run);

        //$reset_token = bin2hex(random_bytes(16));
        $reset_token = random_bytes(16);
        data_default_timezone_set('Asia/Philippines');
        $date = date("Y-m-d");
        $query = "UPDATE users SET reset_token = '$reset_token', token_expired = '$date' WHERE email = '$email' ";
        $update_query = mysqli_query($connection, $query);

        if($update_query)
        {
            echo"<script>
            alert("Successfully added.");
            </script>";
        } else {
            echo"<script>
            alert("Something went wrong.");
            </script>";
            header("Location: forgotpassword.php");
            exit(0);
        }

    } else {
        echo"<script>
            alert("No email found.");
            </script>";
        header("Location: forgotpassword.php");
        exit(0);
    }
}








/*
if(isset($_POST['password_reset_link']))
{
    $email = mysqli_real_escape_string($connection, $_POST['forgotmail']);
    $check_email = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($connection, $check_email);

    if($result)
    {
        if(mysqli_num_rows($result) > 0)
        {
            //email found
            $reset_token = bin2hex(random_bytes(16));
            data_default_timezone_set('Asia/Philippines');
            $date = date("Y-m-d");
            $query = "UPDATE users SET reset_token = '$reset_token', token_expired = '$date' WHERE email = '$email' ";

            if(mysqli_query($connection, $query))
            {
                echo "password reset link sent to mail";
            } else {
                echo "
                <script>
                alert('server down try again later!');
                window.location.href='home.php';
                </script>
                ";
            }
        } else {
            echo "
                <script>
                alert('email not found!');
                window.location.href='home.php';
                </script>
                ";
        }
    } else {
        echo "
        <script>
        alert('cannot run query');
        window.location.href='home.php';
        </script>
        ";
    }
}
*/
?>

/*
        $forgotmail = $_POST['forgotmail'];
        $query = "SELECT * FROM users WHERE email = '$forgotmail' LIMIT 1 ";
        $result = mysqli_query($connection, $query);

        if($result)
        {
            ?><script type="text/javascript">
            alert('email found');
            </script>
            <?php
        } else {
            ?><script type="text/javascript">
            alert('Cannot run query');
            </script>
            <?php
            header("location:forgotpassword.php");
        }
        */




        if(mysqli_query($connection,$query) && sendMail($forgotmail,$reset_token))
                    {
                        ?><script type="text/javascript">
                        alert('Password reset link sent to email');
                        </script>
                        <?php
                    } else {
                        ?><script type="text/javascript">
                        alert('Server down.');
                        </script>
                        <?php
                    }


