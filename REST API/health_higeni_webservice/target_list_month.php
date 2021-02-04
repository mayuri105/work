<?php

// include db connect class
 require('db_connect.php');

    // connecting to db
 $db = new DB_CONNECT();
if (isset($_POST['sales_id'])){

	$sales_id=$_POST['sales_id'];
	$date = date('Y-m-d');
	$month = date('m');
	$year = date('Y');
    $day = date('d');

	
			
			/*========== code for monthly data ==========*/

								
	$sql_m = "select * from db_order where sales_id = '".$sales_id."'";
	$sql_res = mysql_query($sql_m);
	while($sql_data = mysql_fetch_array($sql_res)){
			
			$m = substr($sql_data['order_date'],5,2);

			
	 $sql_month="select  db_target_my.qty as monthly_alocated, db_target_my.incentive as monthly_incentive,SUM(db_order.qty ) as monthly_achive,db_order.order_date
			from db_target_my,db_order
			where db_target_my.sales_id ='".$sales_id."' 
			and db_order.sales_id = db_target_my.sales_id
			and '".$m."' = '".$month."'
			
			and db_target_my.target_type ='monthly'
			 ";
			
			


			$sql_result_month = mysql_query($sql_month);
			$result_month=array();
			
			if(mysql_num_rows($sql_result_month) > 0)
			{
				
				while($data_month = mysql_fetch_assoc($sql_result_month))
				{      
	
					$result_month['monthly_total_incentive']=$data_month['monthly_achive'] * $data_month['monthly_incentive'];
					$result_month['monthly_alocated']=$data_month['monthly_alocated'];
					$result_month['monthly_incentive']=$data_month['monthly_incentive'];
					$result_month['monthly_achive']=$data_month['monthly_achive'];
			
					
				}
			}}
				
			if($sql_result_month)
			{	
				$response["success"] = 1;
				$response["message"] = $result_month;
				echo(json_encode($response));
 			}
			else{
			$response["success"] = 0;
			$response["message"] = "No record found. Please try again.";
			echo(json_encode($response));
			}
			
			/*========== end ==========*/

			
}else{
			$response["success"] = 0;
			$response["message"] = "Require Missing Field...";
			die(json_encode($response));
			}
						
			
?>