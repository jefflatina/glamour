<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    if(isset($_GET['deleteid']) && isset($_GET['booking'])){
        $id = $_GET['deleteid'];
        $booking = $_GET['booking'];
        $select = "UPDATE booking SET coordinator_4 = 'Deleted' WHERE id = '$id' ";
        $bookingresult = mysqli_query($connection,$select);

        $query = "SELECT * FROM booking WHERE booking_id = '$booking'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if($result){
            if($row > 0){
                $emailadd =  $row['emailadd'];

                ?><script type="text/javascript">
            alert('Services Booking Deleted');
            window.location.href='extracoor-list.php';
            </script>
            
            <?php
            }
        }
    }

?>