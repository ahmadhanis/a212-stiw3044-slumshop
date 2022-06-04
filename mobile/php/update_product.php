<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$name = addslashes($_POST['name']);
$desc = addslashes($_POST['desc']);
$prid = $_POST['prid'];
$price = $_POST['price'];
$qty = $_POST['qty'];
$barcode = $_POST['barcode'];
$type = $_POST['type'];
$base64image = $_POST['image'];
$status = "available";
$sqlupdate = "UPDATE `tbl_products` SET `product_name`='$name',`product_desc`='$desc',
`product_type`='$type',`product_qty`=$qty,`product_price`=$price,`product_barcode`='$barcode' WHERE product_id = '$prid'";

if ($conn->query($sqlupdate) === TRUE) {
    $response = array('status' => 'success', 'data' => null);
    if ($base64image !="na"){
        $decoded_string = base64_decode($base64image);
        $path = '../../assets/products/' . $filename . '.jpg';
        $is_written = file_put_contents($path, $decoded_string);
    }  
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