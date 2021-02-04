<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['shop_name']) && isset($_POST['client_name']) && isset($_POST['contactno']) && isset($_POST['street']) && isset($_POST['area'])&& isset($_POST['country']) && isset($_POST['state'])&& isset($_POST['city'])&& isset($_POST['pincode'])&& isset($_POST['comment'])&& isset($_POST['suggestion']) && isset($_POST['shop_image'])) {
    
	
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
	//$img_file=$_FILES['shop_image']['name'];
	//$filemove=$_FILES['shop_image']['tmp_name'];
	//$path="upload/".$img_file;
	//move_uploaded_file($filemove, $path);
	$imgname = $_POST['shop_image'];
	$imsrc = base64_decode($_POST['base64']);
	$fp = fopen("upload/".$imgname, 'w');
	fwrite($fp, $imsrc);
	if(fclose($fp)){
	echo "Image uploaded";
	}else{
	echo "Error uploading image";
	}
	
	
    // include db connect class
    require('db_connect.php');

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysql_query("INSERT INTO db_shop_register(shop_name,client_name,contactno,street,area,country,state,city,pincode,comment,suggestion,shop_image) VALUES('$shop_name','$client_name','$contactno','$street','$area','$country','$state','$city','$pincode','$comment','$suggestion','$imgname')");

    // check if row inserted or not
   if (!empty($result)) {
        // successfully inserted into database
        
		
	 $response["success"] = 1;
        $response["message"] = "successfully Registered........";
           $result= mysql_query("SELECT max(id) FROM db_shop_register");
		     if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);           
            $response["id"] = $result["max(id)"];
         }

        }
		
        // echoing JSON response
        echo json_encode($response);
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