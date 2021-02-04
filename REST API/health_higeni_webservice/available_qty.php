<?php

// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
if (isset($_POST['product_id']) && isset($_POST['sales_id'])){
$product_id=$_POST['product_id'];
$sales_id=$_POST['sales_id'];
$sql = "select * from db_assignto_salesdept where sales_id= '".$sales_id."' and product_typeid = '".$product_id."'"; 
$sql_result = mysql_query($sql);
$result=array();

if(mysql_num_rows($sql_result) > 0)
{
	$i=0;
	while($data = mysql_fetch_assoc($sql_result))
	{
	       
		
		
		$result[$i]['qty']=$data['qty'];
		
		$result[$i]['price']=$data['sale_price'];
		
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