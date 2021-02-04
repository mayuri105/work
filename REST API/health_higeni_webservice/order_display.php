<?php

// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
if (isset($_POST['sales_id']) && isset($_POST['shop_id'])){
$sales_id=$_POST['sales_id'];
$shop_id=$_POST['shop_id'];
 $sql="select db_order.*,db_product_type.pname as product_name,db_sales_register.fname as sales_name from db_order,db_product_type,db_sales_register where db_order.producttype_id = db_product_type.id and db_order.sales_id= db_sales_register.id and db_order.sales_id='".$sales_id."' and db_order.shop_id='".$shop_id."' and db_order.status=''";


$sql_result = mysql_query($sql);
$result=array();

if(mysql_num_rows($sql_result) > 0)
{
	$i=0;
	while($data = mysql_fetch_assoc($sql_result))
	{
		$result[$i]['id']=$data['id'];
		$result[$i]['product_name']=$data['product_name'];
		$result[$i]['sales_name']=$data['sales_name'];
		$result[$i]['qty']=$data['qty'];
		$result[$i]['price']=$data['price'];
		$result[$i]['order_date']=$data['order_date'];
		$result[$i]['total']=$data['total'];
		$i++;
		//echo "<pre>";print_r($data);echo"</pre>";
	}
$response["success"] = 1;
$response["message"] = $result;
die(json_encode($response));
}
}
$response["success"] = 0;
$response["message"] = "No record found. Please try again.";
die(json_encode($response));

?>