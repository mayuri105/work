<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['fname']) && isset($_POST['dob'])) {
    
	$fname = $_POST['fname'];
	$dob = $_POST['dob'];

    // include db connect class
    require('db_connect.php');

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysql_query("SELECT * FROM db_sales_register where fname='".$fname."' AND dob='".$dob."'");

    // check if row inserted or not
	 if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

           $product = array();
		   $product["id"]=$result["id"];
		   $product["uniqueid"]=$result["uniqueid"];
		   $product["fname"]=$result["fname"];
		   $product["contactno"]=$result["contactno"];
         
            // success
            $response["success"] = 1;
			$response["message"]="you have been successfully login";

            // user node
            $response["product"] = array();

            array_push($response["product"], $product);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No record found";

            // echo no users JSON
            echo json_encode($response);
        }
    }  else {
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