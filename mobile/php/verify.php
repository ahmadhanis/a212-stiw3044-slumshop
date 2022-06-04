<?php
if (isset($_GET['email']) && isset($_GET['otp'])){
    include_once("dbconnect.php");

        $custemail = $_GET['email'];
        $otp = $_GET['otp'];
        $newotp = '1';
        $sqlcust = "SELECT * FROM `tbl_customers` WHERE customer_email = '$custemail' AND customer_otp = '$otp'";
        
        $result = $conn->query($sqlcust);
        $number_of_result = $result->num_rows;
        if ($result->num_rows > 0) {
            $sqlverify = "UPDATE `tbl_customers` SET `customer_otp`='$newotp' WHERE customer_email= '$custemail'";
            if ($conn->query($sqlverify) === TRUE) {
                 echo "<script>alert('Verification Success. You can now login using the app');</script>";
            }else{
                 echo "<script>alert('Verification Failed');</script>";
            }
        }
}

?>