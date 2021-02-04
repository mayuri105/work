<?php
require('db_connect.php');

function getOrder(){
   $db = new DB_CONNECT();
    // array for json response
    $response = array();
    $response["allorder"] = array();
    
    // Mysql select query
	$cdate=date('Y-m-d');	
    $result = mysql_query("select db_order.*,db_product_type.pname as product_name,db_sales_register.fname as sales_name,db_shop_register.shop_name from db_order,db_product_type,db_sales_register,db_shop_register  where db_order.producttype_id = db_product_type.id and db_order.sales_id= db_sales_register.id  and db_order.shop_id= db_shop_register.id and MONTH(order_date) = MONTH(NOW()) and YEAR(order_date) = YEAR(NOW()) order by db_order.qty desc");
    
    while($row = mysql_fetch_array($result)){
        // temporary array to create single category
		$tmp = array();
		$tmp["id"] = $row["id"];
		$tmp["sales_name"] = $row["sales_name"];
		$tmp["shop_name"] = $row["shop_name"];
		$tmp["product_name"] = $row["product_name"];
		$tmp["qty"] = $row["qty"];
		$tmp["price"] = $row["price"];
		$tmp["replacement"] = $row["replacement"];
		$tmp["order_date"] = $row["order_date"];
        
        // push category to final json array
        array_push($response["allorder"], $tmp);
    }
    
    // keeping response header to json
    header('Content-Type: application/json');
    
    // echoing json result
    echo json_encode($response);
}

getOrder();
?>