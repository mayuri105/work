<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
//$response = array();

// check for required fields
if (isset($_POST['sales_id'])&& isset($_POST['location']) && isset($_POST['in_time']) && isset($_POST['statusin'])) {
    
	
    $sales_id = $_POST['sales_id'];
    
    $location = $_POST['location'];
	$in_time = $_POST['in_time'];
	$statusin = $_POST['statusin'];
	$date=date('Y-m-d');
	
	
	
    // include db connect class
    require('db_connect.php');

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
	 $sql="INSERT INTO db_shop_history(sales_id,location,in_time,statusin,history_date) VALUES('$sales_id','$location','$in_time','$statusin','$date')";
   $result = mysql_query($sql);
	$response["success"] = 1;
    $response["message"] = "shop history insert ";
   echo json_encode($response);
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>