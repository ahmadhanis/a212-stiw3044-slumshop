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
$sqlcart = "SELECT tbl_carts.cart_id, tbl_carts.product_id, tbl_carts.cart_qty, tbl_products.product_name, tbl_products.product_price, tbl_products.product_qty FROM tbl_carts 
INNER JOIN tbl_products ON tbl_carts.product_id = tbl_products.product_id WHERE tbl_carts.customer_email = '$user_email'";
$stmt = $conn -> prepare($sqlcart);
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
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="index.php" class="w3-bar-item w3-button">Products</a>
        <a href="mycart.php" class="w3-bar-item w3-button">My Cart</a>
        <a href="#" class="w3-bar-item w3-button">My Orders</a>
        <a href="#" class="w3-bar-item w3-button">My Profile</a>
        <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>

    <div class="w3-yellow">
        <button class="w3-button w3-yellow w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-container">
            <h3>My Cart</h3>
            Welcome <label id="iduser"><?php echo $user_email ?></label>
            <div id="idname" style="display: none;"><?php echo $user_name ?></div>
            <div id="idphone" style="display: none;"><?php echo $user_phone ?></div>
        </div>
    </div>
    <div class="w3-bar w3-yellow">
        <a href="logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="index.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
    <div class="w3-container"> <h4>Your current item/s in cart</h4></div>
    <hr>
        <div class="w3-grid-template">
         <?php
         $total_payable = 0.00;
         //cart_id	product_id	cart_qty	product_name	product_price	product_qty	
         if ($number_of_result>0){
            foreach ($rows as $items){
             $price = 0;
             $cartid = $items['cart_id'];
             $prname = $items['product_name'];
             $prprice = $items['product_price'];
             $prqty = $items['product_qty'];
             $prpricesingle = number_format((float)$prprice, 2, '.', '');
             $cartqty = $items['cart_qty'];
             $prid = $items['product_id'];
             $price = $cartqty * $prprice;
             $total_payable = $total_payable + $price;
             $price = number_format((float)$price, 2, '.', '');
             echo "<div class='w3-card-4 w3-round' style='margin:4px' id='card_$cartid'>
            <header class='w3-container w3-blue'><h5><b>$prname</b></h5></header>";
            echo "<a href='productdetails.php?prid=$prid' style='text-decoration: none;'> <img class='w3-image' src=../../assets/products/$prid.jpg" .
                " onerror=this.onerror=null;this.src='../../admin/res/newproduct.jpg'"
                . " style='width:100%;height:250px'></a><hr>";
                 echo "<div class='w3-container'><p>Price: RM $prpricesingle<br>Quantity: $cartqty/$prqty available<br><label id='totalid_$cartid'> Total Price: RM $price</label><br>
                   <div class='w3-center'><input type='button' class='w3-button w3-red' id='button_id' value='-' onClick='updateCart($cartid,\"remove\");'>
                    <label id='qtyid_$cartid'>$cartqty</label>
                    <input type='button' class='w3-button w3-green' id='button_id' value='+' onClick='updateCart($cartid,\"insert\");'>
                    <div class='w3-button w3-right'><i class='fa fa-trash ' onClick='updateCart($cartid,\"delete\");'></i></div>
                    </div></p></div>
            </div>";
             }    
             $total_payable = number_format((float)$total_payable, 2, '.', '');
             $name = $user_name;
             echo "</div><hr><div class='w3-container w3-padding w3-block'>Amount Payable: RM <label id='payableid'>$total_payable</label></div><br>";
             echo "</div><div class='w3-container w3-padding'><div class='w3-button w3-round w3-yellow w3-border' onClick='checkVal();'>Pay Now</div></div><br>";
         }else{
             echo "<div class='w3-container w3-padding'>Your cart is empty</div>";
         }
         
         ?>
    </div>
    
     <div class="w3-center w3-bottom w3-yellow" style="max-width:1200px;margin:0 auto;">Slumshop</div>

</body>
<script>
 function updateCart(cartid,op,qty) {
  if (confirm("Are your sure?")) {
    jQuery.ajax({
		type: "GET",
		url: "updatecart.php",
		data: {
			cartid: cartid,
			submit: op,
		},
		cache: false,
		dataType: "json",
		success: function(response) {
		    var res = JSON.parse(JSON.stringify(response));
		    console.log(op);
			console.log(res.status);
			if (res.status == "success") {
			    console.log(res.data.item_qty);
			    document.getElementById("qtyid_" + cartid).innerHTML = res.data.item_qty;
			    document.getElementById("payableid").innerHTML = res.data.payable.toFixed(2);
			    document.getElementById("totalid_"+ cartid).innerHTML = "Total Price: RM "+res.data.item_price.toFixed(2);
				//alert("Success");
			}
			if (res.status == "deleted") {
			    var element = document.getElementById("card_"+cartid);
			    element.parentNode.removeChild(element);
			    document.getElementById("payableid").innerHTML = res.data.payable.toFixed(2);
				//alert("Success");
			}
			
			if (res.status == "failed") {
			    //alert("Failed");
			    //window.location.replace('index.php');
			}
		}
	});
  }
}

function checkVal(){
     if (confirm("Are your sure?")) {
        var val = document.getElementById("payableid").innerHTML;
        var user = document.getElementById("iduser").innerHTML;
        window.location.replace('payment.php?email='+user+'&payment='+val);
     }
    
    
}
</script>
</html>