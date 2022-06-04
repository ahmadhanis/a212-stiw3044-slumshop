<?php
session_start();
if (isset($_SESSION['sessionid'])) {
    $user_email = $_SESSION['email'];
    $user_name = $_SESSION['name'];
    $user_phone = $_SESSION['phone'];
    $carttotal = 0;
}else{
    $user_email = "guest@slumberjer.com";
    $carttotal= 0;
}
include_once("dbconnect.php");
if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'delete') {
        $prid = $_GET['prid'];
        $sqldeletepr = "DELETE FROM `tbl_products` WHERE product_id = '$prid'";
        $conn->exec($sqldeletepr);
        echo "<script>alert('Product deleted')</script>";
    }
    if ($operation == 'search') {
        $search = $_GET['search'];
        $option = $_GET['option'];
        
        if ($option == "All") {
            $sqlproduct = "SELECT * FROM tbl_products WHERE product_name LIKE '%$search%'";
        }else{
            $sqlproduct = "SELECT * FROM tbl_products WHERE product_name LIKE '%$search%' AND product_type = '$option'";
        }
    }
} else {
    $sqlproduct = "SELECT * FROM tbl_products";
}

$results_per_page = 10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}

if ($user_email !="guest@slumberjer.com"){
    $stmtqty = $conn -> prepare("SELECT * FROM tbl_carts WHERE customer_email = '$user_email'");
	$stmtqty -> execute();
	$resultqty = $stmtqty -> setFetchMode(PDO::FETCH_ASSOC);
	$rowsqty = $stmtqty -> fetchAll();
	$carttotal = 0;
	foreach($rowsqty as $carts) {
	    $carttotal = $carts['cart_qty'] + $carttotal;
	}
}
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlproduct = $sqlproduct . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$conn= null;


function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <h3>Products</h3>
            <div>Welcome <?php echo $user_name ?></div>
        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="mycart.php" class="w3-bar-item w3-button w3-right" id = "carttotalidb">Cart (<?php echo $carttotal?>)</a>
    </div>
    <div class="w3-card w3-container w3-padding w3-margin w3-round">
        <h3>Product Search</h3>
        <form>
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p><input class="w3-input w3-block w3-round w3-border" type="search" name="search" placeholder="Enter search term" /></p>
                </div>
                <div class="w3-half" style="padding-right:4px">
                    <p> <select class="w3-input w3-block w3-round w3-border" name="option">
                        <option value="All">All</option>
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
            <button class="w3-button w3-yellow w3-round w3-right" type="submit" name="submit" value="search">search</button>
        </form>

    </div>
    <div class="w3-grid-template">
        <?php
        $i = 0;
        foreach ($rows as $products) {
            $i++;
            $prid = $products['product_id'];
            $prname = truncate($products['product_name'],15);
            $prtype = $products['product_type'];
            $prqty = $products['product_qty'];
            $prprice = number_format((float)$products['product_price'], 2, '.', ''); // $products['product_price'];
            $prst = $products['product_status'];
            echo "<div class='w3-card-4 w3-round' style='margin:4px'>
            <header class='w3-container w3-blue'><h5><b>$prname</b></h5></header>";
            echo "<a href='productdetails.php?prid=$prid' style='text-decoration: none;'> <img class='w3-image' src=../../assets/products/$prid.jpg" .
                " onerror=this.onerror=null;this.src='../../admin/res/newproduct.jpg'"
                . " style='width:100%;height:250px'></a><hr>";
            echo "<div class='w3-container'><p>Type: $prtype<br>Price: RM $prprice<br>Quantity: $prqty<br><div class='w3-button w3-yellow w3-round w3-block' onClick='addCart($prid)'>Add to Cart</div></p></div>
            </div>";
            
        }
        ?>
    </div>
    <br>
    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + 10;
    } else {
        $num = $pageno * 10 - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "index.php?pageno=' . $page . '" style=
            "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    <br>

    <div class="w3-center w3-bottom w3-yellow" style="max-width:1200px;margin:0 auto;">Slumshop</div>

</body>
<script>
 function addCart(productid) {
	jQuery.ajax({
		type: "GET",
		url: "updatecart.php",
		data: {
			productid: productid,
			submit: 'add',
		},
		cache: false,
		dataType: "json",
		success: function(response) {
		    var res = JSON.parse(JSON.stringify(response));
		    console.log("HELLO ");
			console.log(res.status);
			if (res.status == "success") {
			    console.log(res.data.carttotal);
				document.getElementById("carttotalidb").innerHTML = "Cart (" + res.data.carttotal + ")";
				alert("Success");
			}
			if (res.status == "failed") {
			    alert("Please login/register account");
			    window.location.replace('login.php');
			}
			

		}
	});
}
</script>
</html>