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

	
			/*========== code for yearly data ==========*/
			
			
	$sql_y = "select * from db_order where sales_id = '".$sales_id."'";
	$sql_res_y = mysql_query($sql_y);
	while($sql_data_y = mysql_fetch_array($sql_res_y)){
			
			$y = substr($sql_data_y['order_date'],5,2);

	
			
	  $sql_yearly="select db_target_my.qty as yearly_alocated, db_target_my.incentive as yearly_incentive,SUM(db_order.qty )as yearly_achive
			from db_target_my,db_order
			where db_target_my.sales_id ='".$sales_id."' 
			and db_order.sales_id = db_target_my.sales_id
			and db_target_my.target_type ='yearly'
			and '".$y."' = '".$month."'
			group by db_target_my.sales_id ";

			$sql_result_yearly = mysql_query($sql_yearly);
			$result_yearly=array();
			
			if(mysql_num_rows($sql_result_yearly) > 0)
			{
				$i=0;
				while($data_yearly = mysql_fetch_assoc($sql_result_yearly))
				{      
					$result_yearly[$i]['yearly_total_incentive']=$data_yearly['yearly_achive'] * $data_yearly['yearly_incentive'];
					$result_yearly[$i]['yearly_alocated']=$data_yearly['yearly_alocated'];
					$result_yearly[$i]['yearly_incentive']=$data_yearly['yearly_incentive'];
					$result_yearly[$i]['yearly_achive']=$data_yearly['yearly_achive'];
			
			$i++;
					
				}
			}
				}
			if($sql_result_yearly)
			{	
				$response["success"] = 1;
				$response["message"] = $result_yearly;
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