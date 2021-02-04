<?php
  // include db connect class
    require('db_connect.php');

    // connecting to db
    $db = new DB_CONNECT();

$cdate=date('Y-m-d');
 $sql="select db_order.*,db_product_type.pname as product_name,db_sales_register.fname as sales_name,db_shop_register.shop_name,sum(db_order.total) as grandtot from db_order,db_product_type,db_sales_register,db_shop_register  where db_order.producttype_id = db_product_type.id and db_order.sales_id= db_sales_register.id  and db_order.shop_id= db_shop_register.id and db_order.order_date = '".$cdate."' group by db_order.sales_id desc";

$sql_result = mysql_query($sql);
$result=array();

if(mysql_num_rows($sql_result) > 0)
{

	$i=0;
	while($data = mysql_fetch_assoc($sql_result))
	
	{      
		
		
		$result[$i]["id"] = $data["id"];
		$result[$i]["sales_name"] = $data["sales_name"];
		$result[$i]["shop_name"] = $data["shop_name"];
		$result[$i]["product_name"] = $data["product_name"];
		$result[$i]["qty"] = $data["qty"];
		$result[$i]["price"] = $data["grandtot"];
		$result[$i]["total"] = $data["grandtot"];
		
		$result[$i]["replacement"] = $data["replacement"];
		$result[$i]["order_date"] = $data["order_date"];
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