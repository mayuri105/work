<?php
require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
	 
 if (isset($_POST['shop_id']) && isset($_POST['sales_id']) && isset($_POST['producttype_id'])  && isset($_POST['qty'])&& isset($_POST['date']))
 {
 
$shop_id=$_POST['shop_id'];
$sales_id=$_POST['sales_id'];
$producttype_id=$_POST['producttype_id'];
$qty=$_POST['qty'];
$date=$_POST['date'];

 $sql = "insert into db_neworder_status(shop_id,sales_id,producttype_id,qty,date)
values('$shop_id','$sales_id','$producttype_id','$qty','$date')";	

$res = mysql_query($sql);

if($res == "success"){
    $response["success"] = 1;
    $response["message"] = $res;
    die(json_encode($response));
	}
}
else{
    $response["success"] = 0;
    $response["message"] = "Something went wrong. Please try again.";
    die(json_encode($response));
}
?>