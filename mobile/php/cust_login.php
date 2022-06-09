<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$email = $_POST['email'];
$password = sha1($_POST['password']);
$otp = '1';
$sqllogin = "SELECT * FROM tbl_customers WHERE customer_email = '$email' AND customer_password = '$password' AND customer_otp='$otp'";
$result = $conn->query($sqllogin);
$numrow = $result->num_rows;

if ($numrow > 0) {
    while ($row = $result->fetch_assoc()) {
        $customer['id'] = $row['customer_id'];
        $customer['name'] = $row['customer_name'];
        $customer['email'] = $row['customer_email'];
        $customer['phone'] = $row['customer_phone'];
        $customer['state'] = $row['customer_state'];
        $customer['address'] = $row['customer_address'];
        $customer['phone'] = $row['customer_phone'];
        $customer['credit'] = $row['customer_credit'];
        $customer['otp'] = $row['customer_otp'];
        $customer['datereg'] = $row['customer_datereg'];
    }
    $sqlgetqty = "SELECT * FROM tbl_carts WHERE customer_email = '$email' AND cart_status IS NULL";
    $result = $conn->query($sqlgetqty);
    $number_of_result = $result->num_rows;
    $carttotal = 0;
    while($row = $result->fetch_assoc()) {
        $carttotal = $row['cart_qty'] + $carttotal;
    }
    $mycart = array();
    $customer['cart'] =$carttotal;

    $response = array('status' => 'success', 'data' => $customer);
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