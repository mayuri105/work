<?php

// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
 if (isset($_POST['sales_id'])){
$sales_id=$_POST['sales_id'];
$sql="select  db_target.*,db_product_type.pname as product_name,db_sales_register.fname as sales_name from db_target,db_product_type,db_sales_register where  db_target.producttype_id = db_product_type.id and db_target.sales_id ='".$sales_id."' and  db_target.sales_id= db_sales_register.id";
$sql_result = mysql_query($sql);
$result=array();

if(mysql_num_rows($sql_result) > 0)
{
	$i=0;
	while($data = mysql_fetch_assoc($sql_result))
	{      
		$result[$i]['id']=$data['id'];
		$result[$i]['sales_id']=$data['sales_name'];
		$result[$i]['product_name']=$data['product_name'];
		$result[$i]['qty']=$data['qty'];
		$result[$i]['date']=$data['date'];
		$result[$i]['added_date']=$data['added_date'];

$i++;
		
	}
}
	
if($result){	
$response["success"] = 1;
	$response["message"] = $result;
}
}
else{
$response["success"] = 0;
$response["message"] = "No record found. Please try again.";
}
die(json_encode($response));
?>