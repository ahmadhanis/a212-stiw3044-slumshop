<?php
include_once("dbconnect.php");

if (isset($_SESSION['sessionid'])) {
    $cust_email = $_SESSION['email'];
}else{
    $cust_email = "guest@slumberjer.com";
}

if (isset($_POST['submit'])){
    $prid = $_POST['prid'];
    if ($cust_email == "guest@slumberjer.com"){
        echo "<script>alert('Please register an account first.');</script>";
        echo "<script> window.location.replace('registration.php')</script>";
    }else{
       echo "<script> window.location.replace('productdetails.php?prid=$prid')</script>";
        echo "<script>alert('OK.');</script>";
    }
}
if (isset($_GET['prid'])) {
    $prid = $_GET['prid'];
    $sqlproduct = "SELECT * FROM tbl_products WHERE product_id = '$prid'";
    $stmt = $conn->prepare($sqlproduct);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('Product not found.');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    }
} else {
    echo "<script>alert('Page Error.');</script>";
    echo "<script> window.location.replace('index.php')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/menu.js" defer></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Welcome to SlumShop</title>
</head>

<body style="max-width:1200px;margin:0 auto;">
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
            <h3>Product Details</h3>
        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="index.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div>
    <?php
        foreach ($rows as $products) {
            $prid = $products['product_id'];
            $prname = $products['product_name'];
            $prdesc = $products['product_desc'];
            $prtype = $products['product_type'];
            $prqty = $products['product_qty'];
            $prdate = $products['product_date'];
            $prbc = $products['product_barcode'];
            $prprice = number_format((float)$products['product_price'], 2, '.', ''); // $products['product_price'];
            $prst = $products['product_status'];
        }
        echo "<div class='w3-padding w3-center'><img class='w3-image resimg' src=../../assets/products/$prid.jpg" .
        " onerror=this.onerror=null;this.src='../../admin/res/newproduct.png'"
        . " ></div><hr>";
        echo "<div class='w3-container w3-padding-large'><h4><b>$prname</b></h4>";
        echo " <div><p><b>Description</b><br>$prdesc</p><p><b>Type:</b> $prtype</p><p><b>Price:</b>RM $prprice</p><p><b>Available:</b> $prqty</p>
        <form action='productdetails.php' method='post'> 
            <input type='hidden'  name='prid' value='$prid'>
            <input class='w3-button w3-yellow w3-round' type='submit' name='submit' value='BUY'>
        </form>
        </div></div>";


    ?>
    </div>
    <div class="w3-center w3-bottom w3-yellow" style="max-width:1200px;margin:0 auto;">Slumshop</div>
</body>

</html>