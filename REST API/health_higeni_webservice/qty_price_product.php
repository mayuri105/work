<?php

// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
if (isset($_POST['product'])){
$product=$_POST['product'];
$sql = "select * from db_product_type where id= '".$product."'"; 
$sql_result = mysql_query($sql);
$result=array();

if(mysql_num_rows($sql_result) > 0)
{
	$i=0;
	while($data = mysql_fetch_assoc($sql_result))
	{
	       
		
		$result[$i]['id']=$data['id'];
		$result[$i]['qty']=$data['qty'];
		$result[$i]['pname']=$data['pname'];
		$result[$i]['price']=$data['price'];
		
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