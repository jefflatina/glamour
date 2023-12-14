<?php
session_start();

    include("config.php");
    include("function.php");

    if(isset($_GET['deleteid']) && isset($_GET['bill'])){
        $id = $_GET['deleteid'];
        $billing = $_GET['bill'];
        $select = "DELETE FROM billing WHERE id = '$id' ";
        $billingresult = mysqli_query($connection, $select);

        ?><script type="text/javascript">
            alert('Billing Deleted');
            window.location.href='admin-billing.php';
        </script>
            
        <?php
    }
        
?>