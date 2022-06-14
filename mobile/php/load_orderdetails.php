<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");
$email = $_POST['customer_email'];
$receiptid = $_POST['receipt_id'];

$sqlloadcart = "SELECT tbl_carts.cart_id, tbl_carts.product_id, tbl_carts.cart_qty, tbl_products.product_name, tbl_products.product_price, tbl_products.product_qty FROM tbl_carts INNER JOIN tbl_products ON tbl_carts.product_id = tbl_products.product_id WHERE tbl_carts.customer_email = '$email' AND tbl_carts.receipt_id = '$receiptid'";


$result = $conn->query($sqlloadcart);
$number_of_result = $result->num_rows;
if ($result->num_rows > 0) {
    //do something
    $total_payable = 0;
    $carts["cart"] = array();
    while ($rows = $result->fetch_assoc()) {
        
        $prlist = array();
        $prlist['cartid'] = $rows['cart_id'];
        $prlist['prname'] = $rows['product_name'];
        $prprice = $rows['product_price'];
        $prlist['prqty'] = $rows['product_qty'];
        $prlist['price'] = number_format((float)$prprice, 2, '.', '');
        $prlist['cartqty'] = $rows['cart_qty'];
        $prlist['prid'] = $rows['product_id'];
        $price = $rows['cart_qty'] * $prprice;
        $prlist['pricetotal'] = number_format((float)$price, 2, '.', ''); 
        array_push($carts["cart"],$prlist);
    }
    $response = array('status' => 'success', 'data' => $carts);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>