<?php

if (isset($_POST['submit'])) {
    include 'dbconnect.php';
    $email = $_POST['email'];
    $pass = sha1($_POST['password']);
    $sqllogin = "SELECT * FROM tbl_customers WHERE customer_email = '$email' AND customer_password = '$pass'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->rowCount();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();

	if ($number_of_rows  > 0) {
	    foreach($rows as $user) {
    	    $name = $user['customer_name'];
    	    $phone = $user['customer_phone'];
    	}
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email ;
        $_SESSION["name"] = $name ;
        $_SESSION["phone"] = $phone ;
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script> window.location.replace('login.php')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href = "../css/style.css">
    <script src="../js/login.js" defer></script>
</head>

<body onload="loadCookies()" style="max-width:1200px;margin:0 auto;">
    <header class="w3-header w3-yellow w3-center w3-padding-32">
        <h3>SlumShop</h3>
        <p>Your One stop Grocery Shopping</p>
    </header>
        <div style="height:20px"></div>
        <div class="w3-row w3-padding">
            <div class="w3-half w3-container w3-hide-small" style="background-image:url('../../assets/images/online.jpg');background-size: cover;height:480px;background-repeat: no-repeat;"></div>
            <div class="w3-half w3-container" style="margin: auto;">
                <form name="loginForm" action="login.php" method="post">
                    <h3>Login Form</h3>
                    <p>
                        <label><b>Email</b></label>
                        <input class="w3-input w3-round w3-border" type="email" name="email" id="idemail" placeholder="Your email" required>
                    </p>
                    <p>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-round w3-border" type="password" name="password" id="idpass" placeholder="Your password" required>
                    </p>
                    <p>
                        <input class="w3-check" name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
                        <label>Remember Me</label>
                    </p>
                    <p>
                        <input class="w3-button w3-round w3-border w3-yellow" type="submit" name="submit" id="idsumit" value="Login">
                    </p>
                    <p><a href="registration.php">Register new account</a></p>
                </form>
            </div>
        </div>
        
       
    
    <div id="cookieNotice" class="w3-right w3-block" style="display: none;">
        <div class="w3-red">
            <h4>Cookie Consent</h4>
            <p>This website uses cookies or similar technologies, to enhance your
                browsing experience and provide personalized recommendations.
                By continuing to use our website, you agree to our
                <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a>
            </p>
            <div class="w3-button">
                <button onclick="acceptCookieConsent();">Accept</button>
            </div>
        </div>
    </div>
    
<div class="w3-center w3-bottom w3-yellow" style="margin:0 auto;">SlumShop&copy;</div>
</body>
<script>
    let cookie_consent = getCookie("user_cookie_consent");
    if (cookie_consent != "") {
        document.getElementById("cookieNotice").style.display = "none";
    } else {
        document.getElementById("cookieNotice").style.display = "block";
    }
</script>

</html>