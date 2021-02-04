<?php
$SITE_PATH="http://mdollarideas.com/swastik_webservices/";
require('db_connect.php');

$db = new DB_CONNECT();

$currdate = date('Y-m-d');
 $currdate = $currdate." 00:00:00";
//echo $currdate."<br/>";
//echo "2015-05-20 11:30:00";
//die();
if (isset($_POST['sales_id'])){ 
$sales_id=$_POST['sales_id'];
	$date = date('Y-m-d');
	$month = date('m');
	$year = date('Y');
    $day = date('d');

  
	$target=array();
	$daily_info=array();
	$weekly_info=array();
	$monthly_info=array();
	$yearly_info=array();
	
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
			 and db_order.status ='done'
			 ";
			
			


			$sql_result_month = mysql_query($sql_month);
			$result_month=array();
			
			if(mysql_num_rows($sql_result_month) > 0)
			{
				$i=0; 
				while($data_month = mysql_fetch_assoc($sql_result_month))
				{     
					$monthly_info=array();
					$monthly_info[$i]['monthly_total_incentive']=$data_month['monthly_achive'] * $data_month['monthly_incentive'];
					$monthly_info[$i]['monthly_alocated']=$data_month['monthly_alocated'];
					$monthly_info[$i]['monthly_incentive']=$data_month['monthly_incentive'];
					$monthly_info[$i]['monthly_achive']=$data_month['monthly_achive'];
			$i++;
					
				}
			}
	}
				

 $sql="select db_target.qty as daily_alocated, db_target.incentive as daily_incentive,SUM(db_order.qty )as daily_achive
			from db_target,db_order
			where db_target.sales_id ='".$sales_id."' 
			and db_order.sales_id = db_target.sales_id
			and db_target.target_type ='daily'
			and db_order.order_date = '".$date."' 
			and db_order.status = 'done' ";

			$sql_result = mysql_query($sql);
			$sql=array();
			
			if(mysql_num_rows($sql_result) > 0)
			{
				$i=0;
				while($data = mysql_fetch_assoc($sql_result))
				{     
				
					$daily_info[$i]['daily_total_incentive']=$data['daily_achive'] * $data['daily_incentive'];
					$daily_info[$i]['daily_alocated']=$data['daily_alocated'];
					$daily_info[$i]['daily_incentive']=$data['daily_incentive'];
					$daily_info[$i]['daily_achive']=$data['daily_achive'];
			
			$i++;
					
				}
			}
       	
		   $sql_w = "select * from db_target where sales_id = '".$sales_id."'";
			$sql_res_w = mysql_query($sql_w);
			while($sql_data_r = mysql_fetch_array($sql_res_w)){
					
					 $ed=$sql_data_r['end_date'];
					 $end_date=date_create("$ed");
					  $curr_date=date_create("$date");
					 $diff=date_diff($end_date,$curr_date);
					  $diff->format("%R%a days");
					if($diff->format("%R%a days")<0)
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
				
					$weekly_info[$i]['Weekly_total_incentive']=$data_Weekly['Weekly_achive'] * $data_Weekly['Weekly_incentive'];
					$weekly_info[$i]['Weekly_alocated']=$data_Weekly['Weekly_alocated'];
					$weekly_info[$i]['Weekly_incentive']=$data_Weekly['Weekly_incentive'];
					$weekly_info[$i]['Weekly_achive']=$data_Weekly['Weekly_achive'];
			
			$i++;
					
				}
			}
			}
			}
			//}
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
					$yearly_info[$i]['yearly_total_incentive']=$data_yearly['yearly_achive'] * $data_yearly['yearly_incentive'];
					$yearly_info[$i]['yearly_alocated']=$data_yearly['yearly_alocated'];
					$yearly_info[$i]['yearly_incentive']=$data_yearly['yearly_incentive'];
					$yearly_info[$i]['yearly_achive']=$data_yearly['yearly_achive'];
			
			$i++;
					
				}
			}
				}
         
		$target['target_daily_info']=$daily_info;
		
		$target['target_monthly_info']=$monthly_info;
		$target['target_yearly_info']=$yearly_info;
		$target['target_weekly_info']=$weekly_info;
		
		$response["success"] = 1;
		$response["message"] = $target;
		echo json_encode($response);

	
	



}
else
{
	$response["success"] = 0;
	$response["message"] = "no data.";
	die(json_encode($response));

}

?>