<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
include_once("dbconnect.php");

if (isset($_GET['submit'])){
    $operation = $_GET['submit'];
    if ($operation =='delete'){
        $prid = $_GET['prid'];
        $sqldeletepr = "DELETE FROM `tbl_products` WHERE product_id = '$prid'";
        $conn->exec($sqldeletepr);
        echo "<script>alert('Product deleted')</script>";
    }else{
        echo "<script>alert('Failed')</script>";
    }
}

$sqlproduct = "SELECT * FROM tbl_products";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
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
    <script src="../js/menu.js" defer></script>

    <title>Welcome to SlumShop</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="index.php" class="w3-bar-item w3-button">Dashboard</a>
        <a href="products.php" class="w3-bar-item w3-button">My Products</a>
        <a href="#" class="w3-bar-item w3-button">Customer</a>
        <a href="#" class="w3-bar-item w3-button">Orders</a>
        <a href="#" class="w3-bar-item w3-button">Reports</a>
        <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>My Products</h3>
        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="newproduct.php" class="w3-bar-item w3-button w3-right">New Product</a>
    </div>
    <div class="w3-margin w3-border" style="overflow-x:auto;">
        <?php
        $i = 0;
        echo "<table class='w3-table w3-striped w3-bordered' style='width:100%'>
         <tr><th style='width:5%'>No</th><th style='width:30%'>Product Name</th><th style='width:10%'>Type</th><th style='width:10%'>Quantity</th><th style='width:10%'>Price</th><th>Status</th><th>Operations</th></tr>";
        foreach ($rows as $products) {
            $i++;
            $prid = $products['product_id'];
            $prname = $products['product_name'];
            $prdesc = $products['product_desc'];
            $prtype = $products['product_type'];
            $prqty = $products['product_qty'];
            $prprice = number_format((float)$products['product_price'], 2, '.', '');// $products['product_price'];
            $prbc = $products['product_barcode'];
            $prdate = $products['product_date'];
            $prst = $products['product_status'];
            echo "<tr><td>$i</td><td>$prname</td><td>$prtype</td><td>$prqty</td><td>RM $prprice</td><td>$prst</td>
            <td><button class='btn'><a href='products.php?submit=delete&prid=$prid' class='fa fa-trash' onclick=\"return confirm('Are you sure?')\"></a></button>
            <button class='btn'><a href='updateproduct.php?submit=details&prid=$prid' class='fa fa-edit'></a></button></td></tr>";
        }
        echo "</table>";
        ?>
    </div>
    <br>

    <footer class="w3-footer w3-center w3-bottom w3-yellow">Slumshop</footer>

</body>

</html>