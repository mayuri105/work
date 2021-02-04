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

	
			/*========== code for Weekly data ==========*/
			
		    $sql_w = "select * from db_target where sales_id = '".$sales_id."'";
			$sql_res_w = mysql_query($sql_w);
			while($sql_data_r = mysql_fetch_array($sql_res_w)){
					
					$e_m = substr($sql_data_r['end_date'],5,2);
					$e_d = substr($sql_data_r['end_date'],8,2);
					
				if($e_m == $month)
				{
					if($day <= $e_d)
					{
				
	  $sql_Weekly="select db_target.qty as Weekly_alocated, db_target.incentive as Weekly_incentive,SUM(db_order.qty )as Weekly_achive
			from db_target,db_order
			where db_target.sales_id ='".$sales_id."' 
			and db_order.sales_id = db_target.sales_id
			and db_target.target_type ='Weekly'
			and db_order.order_date = '".$date."' 
			 ";

			$sql_result_Weekly = mysql_query($sql_Weekly);
			$result_Weekly=array();
			
			if(mysql_num_rows($sql_result_Weekly) > 0)
			{
				$i=0;
				while($data_Weekly = mysql_fetch_assoc($sql_result_Weekly))
				{     
				
					$result_Weekly[$i]['Weekly_total_incentive']=$data_Weekly['Weekly_achive'] * $data_Weekly['Weekly_incentive'];
					$result_Weekly[$i]['Weekly_alocated']=$data_Weekly['Weekly_alocated'];
					$result_Weekly[$i]['Weekly_incentive']=$data_Weekly['Weekly_incentive'];
					$result_Weekly[$i]['Weekly_achive']=$data_Weekly['Weekly_achive'];
			
			$i++;
					
				}
			}
			}
			}
			}	
			if($sql_result_Weekly)
			{	
				$response["success"] = 1;
				$response["message"] = $result_Weekly;
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