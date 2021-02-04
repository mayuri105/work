<?php
// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
if (isset($_POST['string'])){
// check for required fields
$shop_name=$_POST['string'];
$array_of_parts = explode(',',$shop_name,2);
 $array_of_parts[0]; 
 $array_of_parts[1]; 




//$sql="select * from db_shop_register where shop_name='".$array_of_parts[0]."' and street='".$array_of_parts[1]."'";
$sql="SELECT * FROM db_shop_register WHERE shop_name LIKE '".$array_of_parts[0]."'  AND street LIKE '".$array_of_parts[1]."'";
$sql_result = mysql_query($sql);
$result=array();


if(mysql_num_rows($sql_result) > 0)
{
	$j=0;
	while($get_shop_detail = mysql_fetch_assoc($sql_result))
	{
	
	$result_shop[$j]['id']=$get_shop_detail['id'];
	$result_shop[$j]['shop_name']=$get_shop_detail['shop_name'];
	$result_shop[$j]['shop_name_area']=$get_shop_detail['shop_name'].",".$get_shop_detail['street'];
	$j++;
	}
	$result['shop_info']=$result_shop;
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