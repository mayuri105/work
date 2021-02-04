<?php
// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
if (isset($_POST['oldshop'])){
// check for required fields
$oldshop=$_POST['oldshop'];


 $sql="select * from db_shop_register where id='".$oldshop."'";
$sql_result = mysql_query($sql);
$result=array();


if(mysql_num_rows($sql_result) > 0)
{
	$j=0;
	while($get_shop_detail = mysql_fetch_assoc($sql_result))
	{
	
	$result_shop[$j]['id']=$get_shop_detail['id'];
	$result_shop[$j]['shop_name']=$get_shop_detail['shop_name'];
	$result_shop[$j]['client_name']=$get_shop_detail['client_name'];
	$result_shop[$j]['contactno']=$get_shop_detail['contactno'];
    $result_shop[$j]['street']=$get_shop_detail['street'];
	$result_shop[$j]['area']=$get_shop_detail['area'];
	$result_shop[$j]['country']=$get_shop_detail['country'];
	$result_shop[$j]['state']=$get_shop_detail['state'];
	$result_shop[$j]['city']=$get_shop_detail['city'];
    $result_shop[$j]['pincode']=$get_shop_detail['pincode'];
	$result_shop[$j]['comment']=$get_shop_detail['comment'];
	$result_shop[$j]['suggestion']=$get_shop_detail['suggestion'];
	$result_shop[$j]['shop_image']=$get_shop_detail['shop_image'];
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