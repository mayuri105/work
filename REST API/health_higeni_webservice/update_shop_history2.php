<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();
require('db_connect.php');
$db = new DB_CONNECT();
// check for required fields
if (isset($_POST['shop_id']) &&isset($_POST['outtime']) && isset($_POST['statusout'])&& isset($_POST['diff_let_log'])&& isset($_POST['shop_diff_time'])&& isset($_POST['shop_distance'])) {
    $sales_id = $_POST['sales_id'];
	$date=date('Y-m-d');
	echo $sqls="SELECT max(id) as maxid,db_shop_history.* from `db_shop_history`  WHERE `sales_id` LIKE '".$sales_id."' AND `history_date`  LIKE '".$date."'";
	$res=mysql_query($sqls);
	if($res)
	{
		
		 
				 
			$get_shop_detail=mysql_fetch_array($res);
			$maxid=$get_shop_detail['maxid'];
	        

    // connecting to db
    $shop_id = $_POST['shop_id'];
    $outtime = $_POST['outtime'];
    $statusout = $_POST['statusout'];
	$diff_let_log = $_POST['diff_let_log'];
	$shop_diff_time = $_POST['shop_diff_time'];
	$shop_distance = $_POST['shop_distance'];
	

    // mysql inserting a new row
	echo $sql_update="UPDATE db_shop_history set shop_id='".$shop_id."',out_time='".$outtime."',statusout='".$statusout."',diff_let_log='".$diff_let_log."',shop_diff_time='".$shop_diff_time."',shop_distance='".$shop_distance."' WHERE sales_id='".$sales_id."' and shop_id='".$shop_id."' and id='".$maxid."' ";
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
			 
		   }
		   else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 }
            // success
           
   // $sales_id = $_POST['sales_id'];
	
	
	
	
	
    // include db connect class
    
?>