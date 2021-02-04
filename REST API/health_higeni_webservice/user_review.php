<?php
require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
	 
 if (isset($_POST['sales_id']) && isset($_POST['event_name'])  && isset($_POST['location']) && isset($_FILES['audio']))
 {
$file_path = "upload_audio/";
   $sales_id = $_POST['sales_id'];
    $event_name= $_POST['event_name'];
    $location= $_POST['location'];

   $file_path = $file_path.basename( $_FILES['audio']['name']);
  move_uploaded_file($_FILES['audio']['tmp_name'], $file_path);
  $file_name = $_FILES['audio']['name'];


 echo $sql = "insert into db_user_review(sales_id,event_name,location,audio)
values('$sales_id','$event_name','$location','$file_name')";	

$res = mysql_query($sql);

if($res == "review submit"){
    $response["success"] = 1;
    $response["message"] ="review submit";
    die(json_encode($response));
	}
}
else{
    $response["success"] = 0;
    $response["message"] = "Something went wrong. Please try again.";
    die(json_encode($response));
}
?>