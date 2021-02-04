<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['outtime']) && isset($_POST['statusout'])) {
    
	
    $sales_id = $_POST['sales_id'];
    $outtime = $_POST['outtime'];
    $statusout = $_POST['statusout'];
	
	
	
	
    // include db connect class
    require('db_connect.php');

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
	 $sql_update="UPDATE db_sales_history set outtime='".$outtime."',statusout='".$statusout."' WHERE sales_id='".$sales_id."' and outtime='' ";
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