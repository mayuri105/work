<?php
session_start();
require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
 
 if (isset($_POST['sales_id']) && isset($_POST['shop_id']) && isset($_POST['product_id']) && isset($_POST['qty'])  && isset($_POST['price']) && isset($_POST['total']) && isset($_POST['order_date']))
 { 
$sales_id=$_POST['sales_id'];
$shop_id=$_POST['shop_id'];
$product_id=$_POST['product_id'];
$qty=$_POST['qty'];
$address=$_POST['address'];
$lat=$_POST['latitude'];
$long=$_POST['longtitude'];
$price=$_POST['price'];
$total=$_POST['total'];
$replecement=$_POST['replecement'];
$order_date=$_POST['order_date'];

$sql = "insert into db_order(sales_id,shop_id,producttype_id,qty,price,total,replacement,order_date,latitude,longtitude,address)
values('$sales_id','$shop_id','$product_id','$qty','$price','$total','$replecement','$order_date','$long','$lat','$address')";	

$res = mysql_query($sql);

if($res){
$id= mysql_insert_id(); 
	$result_order=array();
	$result_orderas=array();
	 $sql_sel="select * from db_assignto_salesdept where product_typeid= '".$product_id."' and sales_id= '".$sales_id."'";
			$sql_result = mysql_query($sql_sel);
			
			//echo "<pre>";print_r($sql_result_child);echo"</pre>";
			if(mysql_num_rows($sql_result) > 0)
			{
				$i=0;
				while($data= mysql_fetch_assoc($sql_result))
				{
					$result_order[$i]=array();	
					$result_order[$i]['qty']=$data['qty'];
					$result_order[$i]['product_typeid']=$data['product_typeid'];
					$result_order[$i]['sales_id']=$data['sales_id'];
					
					$i++;
					//echo "<pre>";print_r($data);echo"</pre>";
				}
				
			}

		
		

	$sql_or="select * from db_order where id= '".$id."' and sales_id= '".$sales_id."' ";
	
			$result_or = mysql_query($sql_or);
			
			//echo "<pre>";print_r($sql_result_child);echo"</pre>";
			if(mysql_num_rows($result_or) > 0)
			{
				$i=0;
				while($rows= mysql_fetch_assoc($result_or))
				{
					$result_orderas[$i]=array();
					$result_orderas[$i]['id']=$rows['id'];	
					$result_orderas[$i]['qty']=$rows['qty'];
					$result_orderas[$i]['shop_id']=$rows['shop_id'];
					$result_orderas[$i]['producttype_id']=$rows['producttype_id'];
					$result_orderas[$i]['sales_id']=$rows['sales_id'];
					
					$i++;
					//echo "<pre>";print_r($data);echo"</pre>";
				}
				$response["success"] = 1;
		$response["message"] = $result_orderas;
				
			
	if($res)
	{
	
	
	
			 $sql_update="UPDATE db_assignto_salesdept set qty='".$result_order[0]['qty']."' - '".$result_orderas[0]['qty']."' WHERE product_typeid='".$result_order[0]['product_typeid']. "'";
			$sql_update_result = mysql_query($sql_update);
		
	
	if($sql_update_result){
	$result_ordera=array();	
	$sqlass="select * from db_assignto_salesdept where sales_id='".$sales_id."' and  product_typeid='".$product_id."'";
	$sql_assgn = mysql_query($sqlass);
			
			//echo "<pre>";print_r($sql_result_child);echo"</pre>";
			if(mysql_num_rows($sql_assgn) > 0)
			{
				$i=0;
				while($dataa= mysql_fetch_assoc($sql_assgn))
				{
					$result_ordera[$i]=array();	
					$result_ordera[$i]['qty']=$dataa['qty'];
					
					$result_ordera[$i]['sales_id']=$dataa['sales_id'];
					
					$i++;
					//echo "<pre>";print_r($data);echo"</pre>";
				}
		}		
				$response["success"] = 1;
		$response["message"] = $result_ordera;
		die(json_encode($response));
			}
			
	}
			
			}
				
		
		//die(json_encode($response));
		
		$response["success"] = 1;
		$response["message"] = $result_orderas;
		
		die(json_encode($response));
		
		}
						
if($res == "Order success")
  {
    
	$response["success"] = 1;
    $response["message"] = $res;
    die(json_encode($response));
	
	}
	else
		  {
        // failed to insert row
			$response["success"] = 0;
			$response["message"] = "Oops! An error occurred.";
			
			// echoing JSON response
			echo json_encode($response);
    		}

	
	
}
else{
    $response["success"] = 0;
    $response["message"] = "Something went wrong. Please try again.";
    die(json_encode($response));
}
?>