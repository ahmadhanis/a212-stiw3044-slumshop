<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");
$email = $_POST['customer_email'];

$sqlloadorder = "SELECT * FROM tbl_orders WHERE customer_email = '$email' ORDER BY order_date DESC";

$result = $conn->query($sqlloadorder);
$number_of_result = $result->num_rows;
if ($result->num_rows > 0) {
    $orders["orders"] = array();
    while ($rows = $result->fetch_assoc()) {
        $ordlist = array();
        $ordlist['order_id'] = $rows['order_id'];
        $ordlist['receipt_id'] = $rows['receipt_id'];
        $ordlist['order_status'] = $rows['order_status'];
        $ordlist['order_date'] = $rows['order_date'];
        $ordlist['order_paid'] = number_format((float)$rows['order_paid'], 2, '.', '');
        array_push($orders["orders"],$ordlist);
    }
    $response = array('status' => 'success', 'data' => $orders);
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