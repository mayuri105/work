<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['shop_id']) &&isset($_POST['outtime']) && isset($_POST['statusout'])&& isset($_POST['diff_let_log'])&& isset($_POST['shop_diff_time'])&& isset($_POST['shop_distance'])) {
    
	
    $sales_id = $_POST['sales_id'];
	$shop_id = $_POST['shop_id'];
    $outtime = $_POST['outtime'];
    $statusout = $_POST['statusout'];
	$diff_let_log = $_POST['diff_let_log'];
	$shop_diff_time = $_POST['shop_diff_time'];
	$shop_distance = $_POST['shop_distance'];
	
	
	
	
    // include db connect class
    require('db_connect.php');

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
	 $sql_update="UPDATE db_shop_history set shop_id='".$shop_id."',outtime='".$outtime."',statusout='".$statusout."',diff_let_log='".$diff_let_log."',shop_diff_time='".$shop_diff_time."',shop_distance='".$shop_distance."' WHERE sales_id='".$sales_id."' and shop_id='".$shop_id."' and outtime='' ";
   $result = mysql_query($sql_update);
	$response["success"] = 1;
    $response["message"] = "sales history update ";
   echo json_encode($response);
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>