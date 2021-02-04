<?php
require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
	 
 if (isset($_POST['register_id']))
 {

 $file_path = "upload_audio/";

   $reg_id = $_POST['register_id'];
   

   $file_path = $file_path.basename( $_FILES['uploaded_file']['name']);
   if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
       
    $file_name = $_FILES['uploaded_file']['name'];

    $sql = "update db_shop_register set audio ='".$file_name."' where id = '".$reg_id."'";
    $res = mysql_query($sql);
   

if($res == "Add  success"){
    $response["success"] = 1;
    $response["message"] = $res;
    die(json_encode($response));
	}
}
}
else{
    $response["success"] = 0;
    $response["message"] = "Something went wrong. Please try again.";
    die(json_encode($response));
}
?>