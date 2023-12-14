<?php
session_start();

    include("config.php");
    include("function.php");

    $user_data = check_login($connection);

    if(isset($_GET['approveid']) && isset($_GET['booking'])){
        $id = $_GET['approveid'];
        $booking = $_GET['booking'];
        $select = "UPDATE booking SET coordinator_3 = 'Approved' WHERE id = '$id' ";
        $bookingresult = mysqli_query($connection,$select);

        $query = "SELECT * FROM booking WHERE booking_id = '$booking'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if($result){
            if($row > 0){
                $emailadd =  $row['emailadd'];

                ?><script type="text/javascript">
            alert('Style & Creation Booking Approved');
            window.location.href='stylecoor-list.php';
            </script>
            
            <?php
            }
        }
    }

?>