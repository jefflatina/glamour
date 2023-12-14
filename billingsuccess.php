<?php

require_once 'configbilling.php';

// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('ClientID', $_GET)) {
    $transaction = $gateway->completePurchase(array(
    'client_id' => $_GET['ClientID'],
    'transactionReference' => $_GET['paymentId'],
));

$response = $transaction->send();

if($response->isSuccessful()) {
    //the customer has successfully paid.
    $arr_body = $response->getData();

    $payment_id = $arr_body['id'];
    $client_id = $arr_body['client']['client_info']['email'];
    $amount = $arr_body['transactions'][0]['amount']['total'];
    $currency = PAYPAL_CURRENCY;
    $payment_status = $arr_body['state'];

    $db->query("INSERT INTO payments(payment_id, client_id, client_email, amount, currency, payment_status) VALUES('".
    $payment_id ."', '". $client_id . "', '" . $client_email . "', '" $amount ."','".$currency ."','".$payment_status . "')");

    echo "Payment is successful. Your transaction id is: ". $payment_id;
} else {
    echo $response->getMessage();
}
} else {
    echo 'Transaction is declined';
}