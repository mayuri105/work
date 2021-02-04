<?php
// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
if (isset($_POST['sales_id'])){
// check for required fields
$sales_id=$_POST['sales_id'];


$cdate=date('Y-n-d');
$sql="select db_neworder_status.*,db_product_type.pname as product_name,db_sales_register.fname as sales_name,db_shop_register.shop_name from db_neworder_status,db_product_type,db_sales_register,db_shop_register where db_neworder_status.producttype_id = db_product_type.id and db_neworder_status.sales_id= db_sales_register.id and db_neworder_status.shop_id= db_shop_register.id and db_neworder_status.sales_id='".$sales_id."' and db_neworder_status.date >= '".$cdate."'";
$sql_result = mysql_query($sql);
$result=array();


if(mysql_num_rows($sql_result) > 0)
{
	$j=0;
	while($get_status_detail = mysql_fetch_assoc($sql_result))
	{
	
	$result_status[$j]['id']=$get_status_detail['id'];
	$result_status[$j]['shop_name']=$get_status_detail['shop_name'];
	$result_status[$j]['sales_name']=$get_status_detail['sales_name'];
	$result_status[$j]['product_name']=$get_status_detail['product_name'];
    $result_status[$j]['qty']=$get_status_detail['qty'];
	$result_status[$j]['date']=$get_status_detail['date'];
	$result_status[$j]['added_date']=$get_status_detail['added_date'];
	
	$j++;
	}
	$result['status_info']=$result_status;
	$response["success"] = 1;
	$response["message"] = $result;
	
}

} else {
    // required data is missing
    $response["success"] = 0;
    $response["message"] = "No Data Found";

    // echoing JSON response
   
    
}
 die(json_encode($response));
?>