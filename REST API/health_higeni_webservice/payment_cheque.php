<?php
require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
	 
 if (isset($_POST['order_id']) && isset($_POST['shop_id']) && isset($_POST['total'])  && isset($_POST['ammount']) && isset($_POST['cheque_img'])&& isset($_POST['date']))
 {
 $cheque_img = $_POST['cheque_img'];
$imsrc = base64_decode($_POST['base64']);
$fp = fopen("upload/".$cheque_img, 'w');
fwrite($fp, $imsrc);
$order_id=$_POST['order_id'];
$sales_id=$_POST['sales_id'];
$shop_id=$_POST['shop_id'];
$total=$_POST['total'];
$ammount=$_POST['ammount'];
$date=$_POST['date'];

 $sql = "insert into db_payment_cheque(order_id,sales_id,shop_id,total,ammount,cheque_img,date)
values('$order_id','$sales_id','$shop_id','$total','$ammount','$cheque_img','$date')";	

$res = mysql_query($sql);
if($res){
$trial=$order_id;

 $allorder = explode(",",$trial);
for($i = 0; $i < count($allorder); $i++){

	$sql_update="UPDATE db_order set status='done' WHERE id='".$allorder[$i]."' and shop_id='".$shop_id."' and sales_id= '".$sales_id."'";
	$result = mysql_query($sql_update);
	$response["success"] = 1;
    $response["message"] = "order history update ";
   echo json_encode($response);
}
}
if($res == "transaction success"){
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