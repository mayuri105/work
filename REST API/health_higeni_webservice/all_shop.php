<?php
require('db_connect.php');

function getCategories(){
   $db = new DB_CONNECT();
    // array for json response
    $response = array();
    $response["allshop"] = array();
    
    // Mysql select query
    $result = mysql_query("SELECT * FROM db_shop_register");
    
    while($row = mysql_fetch_array($result)){
        // temporary array to create single category
        $tmp = array();
        $tmp["id"] = $row["id"];
        $tmp["shop_name"] = $row["shop_name"];
		$tmp["shop_name_area"] = $row["shop_name"].",".$row["street"];
        
        // push category to final json array
        array_push($response["allshop"], $tmp);
    }
    
    // keeping response header to json
    //header('Content-Type: application/json');
    
    // echoing json result
    echo json_encode($response);
}

getCategories();
?>