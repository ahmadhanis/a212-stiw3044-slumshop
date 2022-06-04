<?php
include_once("dbconnect.php");
session_start();

if (isset($_SESSION['sessionid'])) {
	$useremail = $_SESSION['email'];
	if ($useremail == "guest@slumberjer.com"){
	    $response = array('status' => 'failed', 'data' => null);
	    sendJsonResponse($response);
	    return;
	}
} else {
	$response = array('status' => 'failed', 'data' => null);
	sendJsonResponse($response);
	return;
}

if ($_GET['submit'] == "add") {
		$prid = $_GET['productid'];
		$cartqty = "1";
		$carttotal = 0;
		$stmt = $conn -> prepare("SELECT * FROM tbl_carts WHERE customer_email = '$useremail' AND product_id = '$prid'");
		$stmt -> execute();
		$number_of_rows = $stmt -> rowCount();
		$result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
		$rows = $stmt -> fetchAll();
		if ($number_of_rows > 0) {
			foreach($rows as $carts) {
				$cartqty = $carts['cart_qty'];
			}
			$cartqty = $cartqty + 1;
			$updatecart = "UPDATE `tbl_carts` SET `cart_qty`= '$cartqty' WHERE customer_email = '$useremail' AND product_id = '$prid'";
			$conn -> exec($updatecart);

		} else {
			$addcart = "INSERT INTO `tbl_carts`(`customer_email`, `product_id`, `cart_qty`) VALUES ('$useremail','$prid','$cartqty')";
			try {
				$conn -> exec($addcart);

			} catch (PDOException $e) {
				$response = array('status' => 'failed', 'data' => null);
				sendJsonResponse($response);
				return;
			}
		}
		$stmtqty = $conn -> prepare("SELECT * FROM tbl_carts WHERE customer_email = '$useremail'");
		$stmtqty -> execute();
		$resultqty = $stmtqty -> setFetchMode(PDO::FETCH_ASSOC);
		$rowsqty = $stmtqty -> fetchAll();
		$carttotal = 0;
		foreach($rowsqty as $carts) {
			$carttotal = $carts['cart_qty'] + $carttotal;
		}
		$mycart = array();
		$mycart['carttotal'] =$carttotal;
		$response = array('status' => 'success', 'data' => $mycart);
		sendJsonResponse($response);
}


if ($_GET['submit'] == "insert") {
    $cartid = $_GET['cartid'];
    try {
        $sqladditem = "UPDATE tbl_carts set cart_qty = (cart_qty+1) WHERE cart_id = $cartid";
        $stm = $conn -> prepare($sqladditem);
        $stm -> execute();
        $sqlgetqty = "SELECT tbl_carts.cart_qty, tbl_products.product_price FROM tbl_carts INNER JOIN tbl_products ON tbl_carts.product_id = tbl_products.product_id WHERE tbl_carts.cart_id = '$cartid'";
       	$stmtqty = $conn -> prepare($sqlgetqty);
       	$stmtqty -> execute();
		$resultqty = $stmtqty -> setFetchMode(PDO::FETCH_ASSOC);
		$rows = $stmtqty -> fetchAll();
		$carttotal = 0;
		foreach($rows as $carts) {
			$qty = $carts['cart_qty'];
			$price = $carts['product_price'];
			$itemprice = $price * $qty;
		}
		
		$mycart = array();
		$mycart['item_qty'] =$qty;
		$mycart['item_price'] =$itemprice;
		
		$sqlcart = "SELECT tbl_carts.product_id, tbl_carts.cart_qty, tbl_products.product_price,tbl_products.product_id FROM tbl_carts INNER JOIN tbl_products ON tbl_carts.product_id = tbl_products.product_id WHERE tbl_carts.customer_email = '$useremail'";
		$stmt = $conn -> prepare($sqlcart);
       	$stmt -> execute();
		$resultqty = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
		$rowscart = $stmt -> fetchAll();
		$total_payable = 0;
		 foreach ($rowscart as $items){
                $cartqty = $items['cart_qty'];
                $prprice = $items['product_price'];
                $price = $cartqty * $prprice;
                $total_payable = $total_payable + $price;
         }
		 
		$mycart['payable'] =$total_payable;
		
        $response = array('status' => 'success', 'data' => $mycart);
    }catch (PDOException $e) {
            $response = array('status' => 'failed', 'data' => null);    
    }
	sendJsonResponse($response);
}

if ($_GET['submit'] == "remove") {
    $cartid = $_GET['cartid'];
    try {
        $sqlremoveitem = "UPDATE tbl_carts set cart_qty = if(cart_qty>1,(cart_qty-1),cart_qty) WHERE cart_id = $cartid";
        $stm = $conn -> prepare($sqlremoveitem);
        $stm -> execute();
       	$sqlgetqty = "SELECT tbl_carts.cart_qty, tbl_products.product_price FROM tbl_carts INNER JOIN tbl_products ON tbl_carts.product_id = tbl_products.product_id WHERE tbl_carts.cart_id = '$cartid'";
       	$stmtqty = $conn -> prepare($sqlgetqty);
       	$stmtqty -> execute();
		$resultqty = $stmtqty -> setFetchMode(PDO::FETCH_ASSOC);
		$rows = $stmtqty -> fetchAll();
		$carttotal = 0;
		foreach($rows as $carts) {
			$qty = $carts['cart_qty'];
			$price = $carts['product_price'];
			$itemprice = $price * $qty;
		}
		$mycart = array();
		$mycart['item_qty'] =$qty;
		$mycart['item_price'] =$itemprice;
		
		$sqlcart = "SELECT tbl_carts.product_id, tbl_carts.cart_qty, tbl_products.product_price,tbl_products.product_id FROM tbl_carts INNER JOIN tbl_products ON tbl_carts.product_id = tbl_products.product_id WHERE tbl_carts.customer_email = '$useremail'";
		$stmt = $conn -> prepare($sqlcart);
       	$stmt -> execute();
		$resultqty = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
		$rowscart = $stmt -> fetchAll();
		$total_payable = 0;
		 foreach ($rowscart as $items){
                $cartqty = $items['cart_qty'];
                $prprice = $items['product_price'];
                $price = $cartqty * $prprice;
                $total_payable = $total_payable + $price;
         }
		 
		$mycart['payable'] =$total_payable;
		$response = array('status' => 'success', 'data' => $mycart);
    }catch (PDOException $e) {
        $response = array('status' => 'failed', 'data' => null);    
    }
    
	sendJsonResponse($response);
}
if ($_GET['submit'] == "delete") {
    $cartid = $_GET['cartid'];
    try {
        $sqldelete = "DELETE FROM tbl_carts WHERE cart_id = $cartid";
        $stm = $conn -> prepare($sqldelete);
        $stm -> execute();
        $sqlcart = "SELECT tbl_carts.product_id, tbl_carts.cart_qty, tbl_products.product_price,tbl_products.product_id FROM tbl_carts INNER JOIN tbl_products ON tbl_carts.product_id = tbl_products.product_id WHERE tbl_carts.customer_email = '$useremail'";
		$stmt = $conn -> prepare($sqlcart);
       	$stmt -> execute();
		$resultqty = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
		$rowscart = $stmt -> fetchAll();
		$total_payable = 0;
		 foreach ($rowscart as $items){
                $cartqty = $items['cart_qty'];
                $prprice = $items['product_price'];
                $price = $cartqty * $prprice;
                $total_payable = $total_payable + $price;
         }
		$mycart = array();
		$mycart['payable'] =$total_payable;
        
		$response = array('status' => 'deleted', 'data' => $mycart);
    }catch (PDOException $e) {
        $response = array('status' => 'failed', 'data' => null);    
    }
    
	sendJsonResponse($response);
}
function sendJsonResponse($sentArray) {
	header('Content-Type: application/json');
	echo json_encode($sentArray);
}

?>
