<?php

include_once("dbconnect.php");
$email = $_GET['email'];
$amount = $_GET['amount'];

$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'] ,
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];
if ($paidstatus=="true"){
    $paidstatus = "Success";
}else{
    $paidstatus = "Failed";
}
$receiptid = $_GET['billplz']['id'];
$signing = '';
foreach ($data as $key => $value) {
    $signing.= 'billplz'.$key . $value;
    if ($key === 'paid') {
        break;
    } else {
        $signing .= '|';
    }
}
 
 
$signed= hash_hmac('sha256', $signing, 'S-wzNn8FTL0endIB4wgi728w');
if ($signed === $data['x_signature']) {
    if ($paidstatus == "Success"){ //payment success
        $sqlinsertpayment = "INSERT INTO `tbl_payments`( `customer_email`,`payment_bill`, `payment_paid`) VALUES ('$email','$receiptid','$amount')";
        $sqpupdatecart = "UPDATE `tbl_carts` SET `cart_status`='paid',`payment_id`='$receiptid' WHERE customer_email='$email' AND cart_status IS NULL";
        $conn->query($sqlinsertpayment);
        $conn->query($sqpupdatecart);
        echo"
        <html>
        <head>
            <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
        </head>
        <h4>Thank you for your payment</h4>
        <p>The following is your receipt</p>
        <table class='w3-table'>
        <tr><th>Receipt ID</th>$receiptid<td><tr>
        <tr><th>Paid By</th>$receiptid<td><tr>
        <tr><th>Receipt ID</th>$receiptid<td><tr>
        <tr><th>Receipt ID</th>$receiptid<td><tr>
        </table>
        </body></html> 
        ";
    }
    else 
    {
        
    }
}

?>