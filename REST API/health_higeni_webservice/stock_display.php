<?php
  // include db connect class
    require('db_connect.php');

    // connecting to db
    $db = new DB_CONNECT();


 $sql="select db_stock.*,db_product_type.pname as product_name from db_stock,db_product_type where db_stock.product_type = db_product_type.id";

$sql_result = mysql_query($sql);
$result=array();

if(mysql_num_rows($sql_result) > 0)
{
	$i=0;
	while($data = mysql_fetch_assoc($sql_result))
	{      
		$result[$i]['id']=$data['id'];
		$result[$i]['product_name']=$data['product_name'];
		$result[$i]['qty']=$data['qty'];
		$result[$i]['added_date']=$data['added_date'];
                
$i++;
		
		
		//echo "<pre>";print_r($data);echo"</pre>";
	}
	$response["success"] = 1;
	$response["message"] = $result;
	die(json_encode($response));
}
$response["success"] = 0;
$response["message"] = "Something went wrong. Please try again.";
die(json_encode($response));

?>