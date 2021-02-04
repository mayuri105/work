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

	

			/*========== code for daily data ==========*/
			
	 		 $sql="select db_target.qty as daily_alocated, db_target.incentive as daily_incentive,SUM(db_order.qty )as daily_achive
			from db_target,db_order
			where db_target.sales_id ='".$sales_id."' 
			and db_order.sales_id = db_target.sales_id
			and db_target.target_type ='daily'
			and db_order.order_date = '".$date."' 
			 ";

			$sql_result = mysql_query($sql);
			$result=array();
			
			if(mysql_num_rows($sql_result) > 0)
			{
				$i=0;
				while($data = mysql_fetch_assoc($sql_result))
				{     
				
					$result[$i]['daily_total_incentive']=$data['daily_achive'] * $data['daily_incentive'];
					$result[$i]['daily_alocated']=$data['daily_alocated'];
					$result[$i]['daily_incentive']=$data['daily_incentive'];
					$result[$i]['daily_achive']=$data['daily_achive'];
			
			$i++;
					
				}
			}
				
			if($sql_result)
			{	
				$response["success"] = 1;
				$response["message"] = $result;
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