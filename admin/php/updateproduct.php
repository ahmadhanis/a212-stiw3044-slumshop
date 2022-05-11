<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

include_once("dbconnect.php");

if (isset($_POST['submit'])) {
    $operation = $_POST['submit'];
    $prid = $_POST['prid'];
    $productName = addslashes($_POST['productname']);
    $productDesc = addslashes($_POST['description']);
    $productQty = $_POST['productqty'];
    $prodcutPrice = $_POST['productprice'];
    $productBarcode = $_POST['productbarcode'];
    $productType = $_POST['producttype'];
    $sqlupdate = "UPDATE `tbl_products` SET `product_name`='$productName',`product_desc`='$productDesc',
    `product_type`='$productType',`product_qty`=$productQty,`product_price`=$prodcutPrice,`product_barcode`='$productBarcode' 
    WHERE `product_id` = '$prid'";
    try {
        $conn->exec($sqlupdate);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            uploadImage($prid);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('products.php')</script>";
        } else {
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('products.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script>window.location.replace('updateproduct.php?submit=details&prid=$prid')</script>";
    }
}

function uploadImage($filename)
{
    $target_dir = "../res/products/";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'details') {
        $prid = $_GET['prid'];
        $sqlproduct = "SELECT * FROM tbl_products WHERE product_id = '$prid'";
        $stmt = $conn->prepare($sqlproduct);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $number_of_rows = $stmt->rowCount();
        if ($number_of_rows > 0) {
            foreach ($rows as $products) {
                $prid = $products['product_id'];
                $prname = $products['product_name'];
                $prdesc = $products['product_desc'];
                $prqty = $products['product_qty'];
                $prtype = $products['product_type'];
                $prprice = number_format((float)$products['product_price'], 2, '.', '');
                $prbc = $products['product_barcode'];
                $prdate = $products['product_date'];
                $prst = $products['product_status'];
            }
        }else{
            echo "<script>alert('No product found')</script>";
            echo "<script>window.location.replace('products.php')</script>";
        }
    }
}else{
    echo "<script>alert('Error')</script>";
    echo "<script>window.location.replace('products.php')</script>";
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
        <a href="index.php" class="w3-bar-item w3-button">My Dashboard</a>
        <a href="products.php" class="w3-bar-item w3-button">My Products</a>
        <a href="#" class="w3-bar-item w3-button">Customer</a>
        <a href="#" class="w3-bar-item w3-button">Orders</a>
        <a href="#" class="w3-bar-item w3-button">Reports</a>
        <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>Update Product</h3>

        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="products.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div class="w3-content w3-padding-32">
        <form class="w3-card w3-padding" action="updateproduct.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
            <div class="w3-container w3-yellow">
                <h3>Your Product</h3>
            </div>
            <div class="w3-container w3-center">
                <img class="w3-image w3-margin" src="../res/products/<?php echo $prid . '.png' ?>" style="height:100%;width:400px"><br>
                <input type="file" name="fileToUpload" onchange="previewFile()">
            </div>
            <hr>
            <input type="hidden" name="prid" value="<?php echo $prid ?>">
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>Product Name</b></label>
                        <input class="w3-input w3-border w3-round" name="productname" type="text" value="<?php echo $prname ?>" required>
                    </p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p>
                        <label><b>Product Type</b></label>
                        <select class="w3-select w3-border w3-round" name="producttype">
                            <option value="Bread" <?php if ($prtype == "Bread") echo ' selected="selected"'; ?>>Bread</option>
                            <option value="Beverage" <?php if ($prtype == "Beverage") echo ' selected="selected"'; ?>>Beverage</option>
                            <option value="Condiment" <?php if ($prtype == "Condiment") echo ' selected="selected"'; ?>>Condiment</option>
                            <option value="Canned Food" <?php if ($prtype == "Canned Food") echo ' selected="selected"'; ?>>Canned Food</option>
                            <option value="Care Product" <?php if ($prtype == "Care Product") echo ' selected="selected"'; ?>>Care Product</option>
                            <option value="Dairy" <?php if ($prtype == "Dairy") echo ' selected="selected"'; ?>>Dairy</option>
                            <option value="Dried Food" <?php if ($prtype == "Dried Food") echo ' selected="selected"'; ?>>Dried Food</option>
                            <option value="Household" <?php if ($prtype == "Household") echo ' selected="selected"'; ?>>Household</option>
                            <option value="Snack" <?php if ($prtype == "Snack") echo ' selected="selected"'; ?>>Snack</option>
                            <option value="Meat" <?php if ($prtype == "Meat") echo ' selected="selected"'; ?>>Meat</option>
                        </select>
                    </p>
                </div>
            </div>
            <p>
                <label><b>Description</b></label>
                <textarea class="w3-input w3-border w3-round" rows="4" width="100%" name="description" required><?php echo $prdesc ?></textarea>
            </p>
            <div class="w3-row">
                <div class="w3-third" style="padding-right:4px">
                    <p>
                        <label><b>Product Quantity</b></label>
                        <input class="w3-input w3-border w3-round" name="productqty" type="number" value="<?php echo $prqty ?>" required>
                    </p>
                </div>
                <div class="w3-third" style="padding-right:4px">
                    <p>
                        <label><b>Product Price</b></label>
                        <input class="w3-input w3-border w3-round" name="productprice" type="number" step="any" value="<?php echo $prprice ?>" required>
                    </p>
                </div>
                <div class="w3-third">
                    <p>
                        <label><b>Product Barcode</b></label>
                        <input class="w3-input w3-border w3-round" name="productbarcode" type="text" maxlength="12" value="<?php echo $prbc ?>" required>
                    </p>
                </div>
                <p>
                    <input class="w3-button w3-yellow w3-round w3-block w3-border" type="submit" name="submit" value="Update">
                </p>
            </div>
        </form>
    </div>

    <footer class="w3-footer w3-center w3-bottom w3-yellow">Slumshop</footer>

</body>

</html>