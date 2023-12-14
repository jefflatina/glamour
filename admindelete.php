<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    if(isset($_GET['deleteid']) && isset($_GET['booking'])){
        $id = $_GET['deleteid'];
        $booking = $_GET['booking'];
        $select = "DELETE FROM booking WHERE id = '$id' ";
        $bookingresult = mysqli_query($connection,$select);

        ?><script type="text/javascript">
            alert('Booking Deleted');
            window.location.href='admin-bookinglist.php';
        </script>
            
        <?php
    }
        
    

?>