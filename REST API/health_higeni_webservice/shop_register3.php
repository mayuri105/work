<?php

$response = array();

// check for required fields
if (isset($_POST['shop_name']) && isset($_POST['client_name']) && isset($_POST['contactno']) && isset($_POST['street']) && isset($_POST['area'])&& isset($_POST['country']) && isset($_POST['state'])&& isset($_POST['city'])&& isset($_POST['pincode'])&& isset($_POST['comment'])&& isset($_POST['suggestion'])&& isset($_FILES['shop_image'])&& isset($_FILES['shop_audio']) && isset($_POST['status'])) {
    
	
    $shop_name = $_POST['shop_name'];
    $client_name = $_POST['client_name'];
    $contactno = $_POST['contactno'];
	$street = $_POST['street'];
	$area = $_POST['area'];
	$country = $_POST['country'];
	$state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
	$comment = $_POST['comment'];
	$suggestion = $_POST['suggestion'];
	
	$img_file=$_FILES['shop_image']['name'];
	$filemove=$_FILES['shop_image']['tmp_name'];
	$path="upload/".$img_file;
	move_uploaded_file($filemove, $path);
	$audio_file=$_FILES['shop_audio']['name'];
	$audiomove=$_FILES['shop_audio']['tmp_name'];
	$apath="upload/".$audio_file;
	move_uploaded_file($audiomove, $apath);
	$status=$_POST['status'];
	
    // include db connect class
    require('db_connect.php');

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysql_query("INSERT INTO db_shop_register(shop_name,client_name,contactno,street,area,country,state,city,pincode,comment,suggestion,shop_image,shop_audio,status) VALUES('$shop_name','$client_name','$contactno','$street','$area','$country','$state','$city','$pincode','$comment','$suggestion','$img_file','$audio_file','$status')");

    // check if row inserted or not
   if (!empty($result)) {
        // successfully inserted into database
        
		
	$sql1="SELECT * FROM db_shop_register WHERE id=(SELECT MAX(id) FROM db_shop_register)";
		
		$sql_result = mysql_query($sql1);
		
		if(mysql_num_rows($sql_result) > 0)
		{
			$get_shop_detail=mysql_fetch_array($sql_result);
			$results = array();
			$results['shopinfo']['id']=$get_shop_detail['id'];
			$results['shopinfo']['client_name']=$get_shop_detail['client_name'];
			$results['shopinfo']['contactno']=$get_shop_detail['contactno'];
			$results['shopinfo']['street']=$get_shop_detail['street'];	
			 
		   
            // success
            $response["success"] = 1;
			$response["message"]="Register successfully ";

            // user node
            $response["results"] = array();

            array_push($response["results"], $results);
			 echo json_encode($response);
		}
}
		
		      else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
		
        
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>