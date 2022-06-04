<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");
$results_per_page = 20;
$pageno = (int)$_POST['pageno'];
$search = $_POST['search'];

$page_first_result = ($pageno - 1) * $results_per_page;

$sqlloadproduct = "SELECT * FROM tbl_products WHERE product_name LIKE '%$search%' ORDER BY product_id DESC";
$result = $conn->query($sqlloadproduct);
$number_of_result = $result->num_rows;
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlloadproduct = $sqlloadproduct . " LIMIT $page_first_result , $results_per_page";
$result = $conn->query($sqlloadproduct);
if ($result->num_rows > 0) {
    //do something
    $products["products"] = array();
    while ($row = $result->fetch_assoc()) {
        $prlist = array();
        $prlist['product_id'] = $row['product_id'];
        $prlist['product_name'] = $row['product_name'];
        $prlist['product_desc'] = $row['product_desc'];
        $prlist['product_qty'] = $row['product_qty'];
        $prlist['product_type'] = $row['product_type'];
        $prlist['product_price'] = $row['product_price'];
        $prlist['product_barcode'] = $row['product_barcode'];
        $prlist['product_status'] = $row['product_status'];
        $prlist['product_date'] = $row['product_date'];
        array_push($products["products"],$prlist);
    }
    $response = array('status' => 'success', 'pageno'=>"$pageno",'numofpage'=>"$number_of_page", 'data' => $products);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'pageno'=>"$pageno",'numofpage'=>"$number_of_page",'data' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>