<?php

session_start();
if (isset($_SESSION['sessionid']))
{
    echo $useremail = $_SESSION['email'];
    echo  $user_name = $_SESSION['name'];
    echo $user_phone = $_SESSION['phone'];
}else{
    echo "<script>alert('Please login or register')</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

$email = $_GET['email']; //email
$amount = $_GET['payment']; 

$api_key = 'b47704d6-dd30-4143-a4b1-27eb88e8f906';
$collection_id = 'tnp8gfev';
 
$host = 'https://www.billplz-sandbox.com/api/v3/bills';

$data = array(
          'collection_id' => $collection_id,
          'email' => $useremail,
          'mobile' => $user_phone,
          'name' => $user_name,
          'amount' => ($amount + 1) * 100, // RM20
		  'description' => 'Payment for order by '.$email,
          'callback_url' => "https://slumberjer.com/slumshop/user/php/return_url",
          'redirect_url' => "https://slumberjer.com/slumshop/user/php/payment_update.php?email=$email&mobile=$mobile&amount=$amount&name=$user_name" 
);

$process = curl_init($host );
curl_setopt($process, CURLOPT_HEADER, 0);
curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($process, CURLOPT_CAINFO,  getcwd().'/rootca.crt.pem');
curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data) ); 

$return = curl_exec($process);
curl_close($process);

$bill = json_decode($return, true);
header("Location: {$bill['url']}");
?>