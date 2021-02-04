<?php
$response = array();
require('db_connect.php');

$db = new DB_CONNECT();

if (isset($_POST['product_type_id']))
{ 
	
	$product_type_id=$_POST['product_type_id'];
	$sales_id=$_POST['sales_id'];
	$qty=$_POST['qty'];
	$status=$_POST['status'];
	$date=$_POST['date'];

	
	
	echo $sql="insert into db_book_new_stock(product_type_id,
									   sales_id,
									   qty,
									   status,
									   date) 
				            values('$product_type_id',
							        '$sales_id',
									'$qty',
									'$status',
									'$date')";
				  
	$rs=mysql_query($sql);
	if ($rs)
	   {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "New Stock Added Successfully .";

        // echoing JSON response
     	   echo json_encode($response);
    	}
		 else
		  {
        // failed to insert row
			$response["success"] = 0;
			$response["message"] = "Oops! An error occurred.";
			// echoing JSON response
			echo json_encode($response);
    	  }
		 
} else
		  {
        // failed to insert row
			$response["success"] = 0;
			$response["message"] = "Require Messing Fields.";
			// echoing JSON response
			echo json_encode($response);
    	  }
		 
		 
?>