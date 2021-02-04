<?php
// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
if (isset($_POST['sales_id'])){
// check for required fields
$sales_id=$_POST['sales_id'];

$sql="select db_order.*,db_product_type.pname as product_name,db_sales_register.fname as sales_name,db_shop_register.shop_name as shop_name from db_order,db_product_type,db_sales_register,db_shop_register where db_order.producttype_id = db_product_type.id and db_order.sales_id= db_sales_register.id and db_order.shop_id= db_shop_register.id and db_order.sales_id='".$sales_id."'"; 

$sql_result = mysql_query($sql);
$result=array();


if(mysql_num_rows($sql_result) > 0)
{
	$j=0;
	while($get_status_detail = mysql_fetch_assoc($sql_result))
	{
	
	$result_order[$j]['id']=$get_status_detail['id'];
	$result_order[$j]['shop_name']=$get_status_detail['shop_name'];
	$result_order[$j]['sales_name']=$get_status_detail['sales_name'];
	$result_order[$j]['product_name']=$get_status_detail['product_name'];
    $result_order[$j]['qty']=$get_status_detail['qty'];
      $result_order[$j]['latitude']=$get_status_detail['latitude'];
      $result_order[$j]['longtitude']=$get_status_detail['longtitude'];
	$result_order[$j]['price']=$get_status_detail['price'];
	$result_order[$j]['total']=$get_status_detail['total'];
	$result_order[$j]['replacement']=$get_status_detail['replacement'];
	$result_order[$j]['order_date']=$get_status_detail['order_date'];
	$result_order[$j]['status']=$get_status_detail['status'];
	$result_order[$j]['added_date']=$get_status_detail['added_date'];
	
	$j++;
	}
	$result['order_info']=$result_order;
	$response["success"] = 1;
	$response["message"] = $result;
	die(json_encode($response));
}

} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "No Data Found";

    // echoing JSON response
    echo json_encode($response);
}
?>