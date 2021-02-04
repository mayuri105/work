<?php
$SITE_PATH="http://mdollarideas.com/health_higeni_webservice/";
// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
 if (isset($_POST['shop_name']) && isset($_POST['street'])){
// check for required fields
$shop_name=$_POST['shop_name'];
$shop_street=$_POST['street'];
$sql="select * from db_shop_register where shop_name='".$shop_name."' and street='".$shop_street."'";
$sql_result = mysql_query($sql);
$result=array();

if(mysql_num_rows($sql_result) > 0)
{
	$i=0;
	while($data = mysql_fetch_assoc($sql_result))
	{      
		$result[$i]['id']=$data['id'];
		$result[$i]['shop_name']=$data['shop_name'];
		$result[$i]['shop_name_area']=$data['shop_name'].','.$data['street'];
		$result[$i]['client_name']=$data['client_name'];
		$result[$i]['contactno']=$data['contactno'];
		$result[$i]['street']=$data['street'];
		$result[$i]['area']=$data['area'];
		$result[$i]['country']=$data['country'];
		$result[$i]['state']=$data['state'];
		$result[$i]['city']=$data['city'];
		$result[$i]['pincode']=$data['pincode'];
		$result[$i]['comment']=$data['comment'];
		$result[$i]['suggestion']=$data['suggestion'];
		$result[$i]['shop_image']=$SITE_PATH.'upload/'.$data['shop_image'];
		$result[$i]['added_date']=$data['added_date'];
                $result[$i]['address']=$data['address'];
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