<?php
session_start();
require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
 
 if (isset($_POST['sales_id']) && isset($_POST['shop_id']) && isset($_POST['product_id']) && isset($_POST['qty'])  && isset($_POST['price']) && isset($_POST['total'])  && isset($_POST['order_date']))
 { 
$sales_id=$_POST['sales_id'];
$shop_id=$_POST['shop_id'];
$product_id=$_POST['product_id'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$total=$_POST['total'];
$replecement=$_POST['replecement'];
$order_date=$_POST['order_date'];

$sql = "insert into db_order(sales_id,shop_id,producttype_id,qty,price,total,replacement,order_date)
values('$sales_id','$shop_id','$product_id','$qty','$price','$total','$replecement','$order_date')";	

$res = mysql_query($sql);

if($res == "Order success")
  {
    
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