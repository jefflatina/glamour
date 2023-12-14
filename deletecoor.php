<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    //sa pagdisplay ng username
    $id = $_SESSION["user_id"];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);
    
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $select = "DELETE FROM users WHERE id = '$id' ";
        $result = mysqli_query($connection,$select);
                    
        if($select){
            echo "<script>alert('Coordinator succesfully deleted.');</script>";
            echo "<script>document.location='admin-coordinators.php';</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            }
        }
            
?>