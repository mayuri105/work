<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['sales_id']) && isset($_POST['logtime']) && isset($_POST['location']) && isset($_POST['statusin']) && isset($_POST['transport'])) {
    
	
    $sales_id = $_POST['sales_id'];
    $logtime = $_POST['logtime'];
    $location = $_POST['location'];
	$statusin = $_POST['statusin'];
	$transport = $_POST['transport'];
	$date=date('Y-m-d');
	
	
	
    // include db connect class
    require('db_connect.php');

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
   $result = mysql_query("INSERT INTO db_sales_history(sales_id,logtime,location,statusin,transport,added_date) VALUES('$sales_id','$logtime','$location','$statusin','$transport','$date')");

 $response["success"] = 1;
    $response["message"] = "sales history insert";
 	 echo json_encode($response);
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>