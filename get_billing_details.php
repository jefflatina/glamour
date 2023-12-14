<?php
include("config.php");
include("function.php");

// Retrieve the billing ID from the AJAX request
$billingId = $_POST['billingId'];

// Query the database to fetch billing details based on the billing ID
$sql = "SELECT * FROM billing WHERE billing_id = $billingId";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

// Prepare the response data
$response = array(
    'title' => $row['title'],
    'description' => $row['description']
);

// Return the response as JSON-encoded data
header('Content-Type: application/json');
echo json_encode($response);
?>