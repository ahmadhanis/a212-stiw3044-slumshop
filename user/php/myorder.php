<?php
session_start();
if (isset($_SESSION['email'])) {
    $user_email = $_SESSION['email'];
    if ($user_email =='guest@slumberjer.com'){
        echo "<script>alert('Please register/login')</script>";
        echo "<script>window.location.replace('login.php')</script>";
    }
    $user_name = $_SESSION['name'];
    $user_phone = $_SESSION['phone'];
}else{
    echo "<script>alert('Please register/login')</script>";
    echo "<script>window.location.replace('login.php')</script>";
}

include_once("dbconnect.php");
$sqlloadorder = "SELECT * FROM tbl_orders WHERE customer_email = '$user_email' ORDER BY order_date DESC";
$stmt = $conn -> prepare($sqlloadorder);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/menu.js" defer></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Welcome to SlumShop</title>
</head>

<body style="max-width:1200px;margin:0 auto;">
    <div class="w3-sidebar w3-bar-block w3-border" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <div class="w3-container w3-card w3-padding w3-margin w3-center" style="max-height:350px;max-width:350px">
            <img class='w3-image' src='../../assets/customers/<?php echo $user_email?>.jpg' onerror=this.onerror=null;this.src='../../assets/customers/profile.png' style="max-height:200px;max-width:200px">
           <p><?php echo $user_name?><br>
           <?php echo $user_email?></p>
        </div>
        <hr>

        <a href="index.php" class="w3-bar-item w3-button">Products</a>
        <a href="mycart.php" class="w3-bar-item w3-button">My Cart</a>
        <a href="myorder.php" class="w3-bar-item w3-button">My Orders</a>
        <a href="myprofile.php" class="w3-bar-item w3-button">My Profile</a>
        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>My Orders</h3>
            Welcome <label id="idname"><?php echo  $user_name?></label>
            <div id="iduser" style="display: none;"><?php echo $user_email ?></div>
            <div id="idphone" style="display: none;"><?php echo $user_phone ?></div>
        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="index.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div class="w3-container"> <h4>Your Orders</h4></div>
    <hr>
        <div class="w3-grid-template">
         <?php
        
         if ($number_of_result>0){
            foreach ($rows as $order){
                $order_id = $order['order_id'];
                $order_paid = $order['order_paid'];
                $order_status = $order['order_status'];
                $order_date = date_format(date_create($order['order_date']),"d/m/Y h:i A");
                $order_paid = $order['order_paid'];
                echo "<div class='w3-card-4 w3-round' style='margin:4px' id='card'>
                <header class='w3-container w3-blue'><h6><b>Order ID #$order_id</b></h6></header>";
                echo "<div class='w3-container'><p>Paid: RM $order_paid<br>Status: $order_status<br>Date: $order_date</label><br></div></div>";
            }
            
         }else{
             echo "<div class='w3-container w3-padding'>No order</div>";
         }
         
         ?>
    </div>
    
     <div class="w3-center w3-bottom w3-yellow" style="max-width:1200px;margin:0 auto;">Slumshop</div>

</body>

</html>