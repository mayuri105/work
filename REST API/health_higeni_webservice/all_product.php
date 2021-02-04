<?php
require('db_connect.php');

function getCategories(){
   $db = new DB_CONNECT();
    // array for json response
    $response = array();
    $response["allproduct"] = array();
    
    // Mysql select query
    $result = mysql_query("SELECT * FROM db_product_type");
    
    while($row = mysql_fetch_array($result)){
        // temporary array to create single category
        $tmp = array();
        $tmp["id"] = $row["id"];
        $tmp["pname"] = $row["pname"];
        
        // push category to final json array
        array_push($response["allproduct"], $tmp);
    }
    
    // keeping response header to json
    //header('Content-Type: application/json');
    
    // echoing json result
    echo json_encode($response);
}

getCategories();
?>