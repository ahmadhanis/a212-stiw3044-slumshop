<?php
if (isset($_POST['submit'])) {
    include_once("dbconnect.php");
    $custname = addslashes($_POST['name']);
    $custemail = addslashes($_POST['email']);
    $custphone = $_POST['phone'];
    $state = addslashes($_POST['state']);
    $address = $_POST['address'];
    $credit = 5;
    $otp = rand(10000,99999);
    $pass = $_POST['passworda'];
    $password = sha1($_POST['passworda']);
    
    $sqlregister = "INSERT INTO `tbl_customers`( `customer_name`, `customer_email`, `customer_phone`, 
    `customer_state`, `customer_address`, `customer_password`, `customer_otp`, `customer_credit`) 
    VALUES ('$custname','$custemail','$custphone','$state','$address','$password','$otp',$credit)";
    try {
        $conn->exec($sqlregister);
        sendMail($custemail,$otp,$pass);
        echo "<script>alert('Success')</script>";
        echo "<script>window.location.replace('login.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script>window.location.replace('registration.php')</script>";
    }
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
    <p>U</p><br><br>
        <a href='https://slumberjer.com/slumhop/user/php/verify.php?email=$email&otp=$otp'>Click here to verify your account</a><br><br>
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
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/menu.js"></script>
    <script src="../js/script.js"></script>
    <title>Welcome to SlumShop</title>
  </head>
  <body style="max-width:1200px;margin:0 auto;">
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
      <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
      <a href="index.php" class="w3-bar-item w3-button">Products</a>
      <a href="products.php" class="w3-bar-item w3-button">My Cart</a>
      <a href="#" class="w3-bar-item w3-button">My Orders</a>
      <a href="#" class="w3-bar-item w3-button">My Profile</a>
      <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>
    <div class="w3-yellow">
      <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
      <div class="w3-container">
        <h3>New Customer Account Registration</h3>
      </div>
    </div>
    <div class="w3-bar w3-yellow">
      <a href="index.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div class="w3-content w3-padding-32">
      <form class="w3-card w3-padding" action="registration.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
        <div class="w3-container w3-yellow">
          <h3>New Account</h3>
        </div>
        <div class="w3-row">
          <div class="w3-half" style="padding-right:4px">
            <p>
              <label>
                <b>Name</b>
              </label>
              <input class="w3-input w3-border w3-round" name="name" type="text" required>
            </p>
          </div>
          <div class="w3-half" style="padding-right:4px">
            <p>
              <label>
                <b>Email</b>
              </label>
              <input class="w3-input w3-border w3-round" name="email" type="email" required>
            </p>
          </div>
        </div>
        <div class="w3-row">
          <div class="w3-half" style="padding-right:4px">
            <p>
              <label>
                <b>Phone</b>
              </label>
              <input class="w3-input w3-border w3-round" name="phone" type="phone" required>
            </p>
          </div>
          <div class="w3-half" style="padding-right:4px">
            <p>
              <label>
                <b>States</b>
              </label>
              <select class="w3-select w3-border w3-round" name="state">
                <option value="Kedah">Kedah</option>
                <option value="Perlis">Perlis</option>
                <option value="Pulau Pinang">Pulau Pinang</option>
                <option value="Perak">Perak</option>
                <option value="Pahang">Pahang</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Johor">Johor</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
              </select>
            </p>
          </div>
          <div class="w3-row">
          <div class="w3-half" style="padding-right:4px">
            <p>
              <label>
                <b>Password</b>
              </label>
              <input class="w3-input w3-border w3-round" name="passworda" type="password" required>
            </p>
          </div>
          <div class="w3-half" style="padding-right:4px">
            <p>
              <label>
                <b>Re-enter Password</b>
              </label>
              <input class="w3-input w3-border w3-round" name="passwordb" type="password" required>
            </p>
          </div>
        </div>
         
          <p>
            <label>
              <b>Address</b>
            </label>
            <textarea class="w3-input w3-border w3-round" rows="4" width="100%" name="address" required></textarea>
          </p>
          <div class="w3-row">
            <div class="w3-half" style="padding-right:4px">
                <input class="w3-check" type="checkbox" name="agreebox" value="Agree">
                <label for="agreebox">Agree with our term</label><br>
            </div>
            <div class="w3-half" style="padding-right:4px">
                <p>
                    <input class="w3-button w3-yellow w3-round w3-block w3-border" type="submit" name="submit" value="Submit">
                </p>
            </div>
         </div>
         <div><a href="login.php">Already have an account? Login</a></div><br>
      </form>
    </div>
    </div>
    <div class="w3-center w3-bottom w3-yellow" style="max-width:1200px;margin:0 auto;">Slumshop</div>
  </body>
</html>