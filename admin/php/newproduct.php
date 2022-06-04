<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
if (isset($_POST['submit'])) {
    include_once("dbconnect.php");
    $productName = addslashes($_POST['productname']);
    $prouctDesc = addslashes($_POST['description']);
    $productQty = $_POST['productqty'];
    $prodcutPrice = $_POST['productprice'];
    $productBarcode = $_POST['productbarcode'];
    $productType = $_POST['producttype'];
    $status = "available";
    $sqlinsertproduct = "INSERT INTO `tbl_products`(`product_name`, `product_type`,`product_desc`, 
    `product_qty`, `product_price`, `product_barcode`, `product_status`) VALUES 
    ('$productName','$productType','$prouctDesc',$productQty,$prodcutPrice,'$productBarcode','$status')";
    try {
        $conn->exec($sqlinsertproduct);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('products.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script>window.location.replace('newproduct.php')</script>";
    }
}

function uploadImage($filename)
{
    $target_dir = "../../assets/products/";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
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
    <script src="../js/menu.js"></script>
    <script src="../js/script.js"></script>

    <title>Welcome to SlumShop</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="#" class="w3-bar-item w3-button">My Products</a>
        <a href="#" class="w3-bar-item w3-button">Customer</a>
        <a href="#" class="w3-bar-item w3-button">Orders</a>
        <a href="#" class="w3-bar-item w3-button">Reports</a>
        <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>New Product</h3>

        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="products.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div class="w3-content w3-padding-32">
        <form class="w3-card w3-padding" action="newproduct.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
            <div class="w3-container w3-yellow">
                <h3>New Product</h3>
            </div>
            <div class="w3-container w3-center">
                <img class="w3-image w3-margin" src="../res/newproduct.png" style="height:100%;width:400px"><br>
                <input type="file" name="fileToUpload" onchange="previewFile()">
            </div>
            <hr>

            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>Product Name</b></label>
                        <input class="w3-input w3-border w3-round" name="productname" type="text" required>
                    </p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>Product Type</b></label>
                        <select class="w3-select w3-border w3-round" name="producttype">
                            <option value="Baby">Baby</option>
                            <option value="Bread">Bread</option>
                            <option value="Beverage">Beverage</option>
                            <option value="Breakfast">Breakfast</option>
                            <option value="Condiment">Condiment</option>
                            <option value="Care Product">Care Product</option>
                            <option value="Canned Food">Canned Food</option>
                            <option value="Dairy">Dairy</option>
                            <option value="Dried Food">Dried Food</option>
                            <option value="Grain">Grain</option>
                            <option value="Frozen">Frozen</option>
                            <option value="Health">Health</option>
                            <option value="Meat">Meat</option>
                            <option value="Miscellanaeous">Miscellanaeous</option>
                            <option value="Snack">Snack</option>
                            <option value="Pet">Pet</option>
                            <option value="Produce">Produce</option>
                            <option value="Household">Household</option>
                            <option value="Beverage">Vegetables</option>
                        </select>
                    </p>
                </div>
            </div>
            <p>
                <label><b>Description</b></label>
                <textarea class="w3-input w3-border w3-round" rows="4" width="100%" name="description" required></textarea>
            </p>
            <div class="w3-row">
                <div class="w3-third" style="padding-right:4px">
                    <p>
                        <label><b>Product Quantity</b></label>
                        <input class="w3-input w3-border w3-round" name="productqty" type="number" required>
                    </p>
                </div>
                <div class="w3-third" style="padding-right:4px">
                    <p>
                        <label><b>Product Price</b></label>
                        <input class="w3-input w3-border w3-round" name="productprice" type="number" step="any" required>
                    </p>
                </div>
                <div class="w3-third">
                    <p>
                        <label><b>Product Barcode</b></label>
                        <input class="w3-input w3-border w3-round" name="productbarcode" type="text" maxlength="12" required>
                    </p>
                </div>
                <p>
                    <input class="w3-button w3-yellow w3-round w3-block w3-border" type="submit" name="submit" value="Insert">
                </p>
            </div>
        </form>
    </div>

    <footer class="w3-footer w3-center w3-bottom w3-yellow">Slumshop</footer>

</body>

</html>