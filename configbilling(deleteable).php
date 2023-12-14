<?php

require_once "vendor/autoload.php";

use Omnipay\Omnipay;

define('CLIENT_ID', 'PAYPAL_CLIENT_ID_HERE');
define('CLIENT_SECRET', 'PAYPAL_CLIENT_SECRET_HERE');

define('PAYPAL_RETURN_URL', 'http://localhost/Glamour/billingsuccess.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/Glamour/billingcancel.php');
define('PAYPAL_CURRENCY', 'PHP');

// Connect with the database
$db = new mysqli('localhost', 'root', '', 'glamour');
if ($db->connect_errno) {
    die("Connection failed: ". $db->connect_error);
}

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true);

