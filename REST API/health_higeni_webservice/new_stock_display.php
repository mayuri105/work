<?php
// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
 
 if (isset($_POST['sales_id']))
	{
		// check for required fields
		$sales_id =$_POST['sales_id'];

	    $sql="SELECT db_book_new_stock.*,db_product_type.pname 
			 from db_book_new_stock,db_product_type
		 	 where db_book_new_stock.product_type_id = db_product_type.id
			 		and db_book_new_stock.sales_id = '".$sales_id."' order by db_book_new_stock.id desc";
		$sql_result = mysql_query($sql);
		
		if(mysql_num_rows($sql_result) >0)
		{
			$result_mycart=array();
			$j=0;
			
			while($get_detail = mysql_fetch_assoc($sql_result))
			{

				$result_mycart[$j]['pname']=$get_detail['pname'];
				$result_mycart[$j]['qty']=$get_detail['qty'];
				$result_mycart[$j]['status']=$get_detail['status'];
				$result_mycart[$j]['date']=$get_detail['date'];
	
				$j++;
			}
				$response["success"] = 1;
				$response["message"] = $result_mycart;
				die(json_encode($response));
		}else{
			
				$response["success"] = 0;
				$response["message"] = "Sorry No Data Available...";
				die(json_encode($response));
		}
	} else {
			
				$response["success"] = 0;
				$response["message"] = "Require Missing Fields";
				die(json_encode($response));
		}	
?>