<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");
    $custname = addslashes($_POST['name']);
    $custemail = addslashes($_POST['email']);
    $custphone = $_POST['phone'];
    $state = addslashes($_POST['state']);
    $address = $_POST['address'];
    $credit = 5;
    $otp = rand(10000,99999);
    $pass = $_POST['password'];
    $password = sha1($pass);
    
$sqlregister = "INSERT INTO `tbl_customers`( `customer_name`, `customer_email`, `customer_phone`, 
    `customer_state`, `customer_address`, `customer_password`, `customer_otp`, `customer_credit`) 
    VALUES ('$custname','$custemail','$custphone','$state','$address','$password','$otp',$credit)";
    
if ($conn->query($sqlregister) === TRUE) {
    $response = array('status' => 'success', 'data' => null);
    sendMail($custemail,$otp,$pass);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

function sendMail($email,$otp,$pass){
    $to = $email;
    $subject = "SlumShop";
    $message = "
    <html>
    <head>
    <title></title>
    </head>
    <body>
    <h3>Thank you for your registration - DO NOT REPLY TO THIS EMAIL</h3>
    <p></p><br><br>
        <a href='https://slumberjer.com/slumshop/mobile/php/verify.php?email=$email&otp=$otp'>Click here to verify your account</a><br><br>
    </p>
    <table>
    <tr>
    <th>Your Email</th>
    <th>Key/Password</th>
    </tr>
    <tr>
    <td>$email</td>
    <td>$pass</td>
    </tr>
    </table>
    <br>
    <p>TERMS AND CONDITION <br>Single license for the person who made the purchase. The publication and it resources are protected by Copyright law. No part of this publication may be reproduced, 
        shared, distributed, or transmitted in any form or by any means, including, photocopying, recording, or other electronic or mechanical methods with 
        the prior written permission of the author. By downloading this copy you are agreeing to the terms and conditions and can be subjected to law if violated and permanent ban from accessing the resource</p>
    </body>
    </html>
    ";
    
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: <slumshop@slumberjer.com>' . "\r\n";
    
    mail($to,$subject,$message,$headers);
}
?>