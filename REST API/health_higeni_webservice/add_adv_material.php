<?php
require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
	 
 if (isset($_POST['shop_id']) && isset($_POST['sales_id']) && isset($_POST['materialtype'])  && isset($_POST['qty']))
 {

$shop_id=$_POST['shop_id'];
$sales_id=$_POST['sales_id'];
$materialtype=$_POST['materialtype'];
$qty=$_POST['qty'];


 $sql = "insert into db_addadv_material(shop_id,sales_id,materialtype,qty)
values('$shop_id','$sales_id','$materialtype','$qty')";	

$res = mysql_query($sql);

if($res == "Add Material success"){
    $response["success"] = 1;
    $response["message"] = $res;
    die(json_encode($response));
	}
}
else{
    $response["success"] = 0;
    $response["message"] = "Something went wrong. Please try again.";
    die(json_encode($response));
}
?>