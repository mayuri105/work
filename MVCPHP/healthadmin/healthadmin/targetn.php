<?php
require_once('inc/connection.php');
require_once('inc/function.php');
require_once('inc/admincls.php');
if(!isset($_SESSION['u_name']))
{
	header('location:index.php');
}


 echo 'Target add';

?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
		<title>Admin | Target</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
         <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/fonts/style.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/main-responsive.css">
		<link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
		<link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css" />
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="assets/css/smoothness/jquery-ui.css">
				
		
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		<!-- start: HEADER -->
		<?php include_once('inc/header.php'); ?>	
		<!-- end: HEADER -->
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<?php include_once('inc/left-menu.php'); ?>
			<!-- start: PAGE -->
			<div class="main-content">
			
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
						<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								
								<li class="active">
									 <a href="assign_Product.php"> Target </a>
								</li>
								
								<?php if($_GET['process']==base64_encode('addTarget')) { 
									?>			
									<li>
										Target
									</li>
									<?php } if($_GET['process']==base64_encode('editTarget')) { 
									?>			
									<li>
										Edit Target
									</li>
									<?php } ?> 
								
								<li class="search-box">
									<form class="sidebar-search">
										<div class="form-group">
											<input type="text" placeholder="Start Searching...">
											<button class="submit">
												<i class="clip-search-3"></i>
											</button>
										</div>
									</form>
								</li>
							</ol>
							<div class="page-header">
								<h1> Target</h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									 Target
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
									
										<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
										<a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
										
									</div>
								</div>
								<div class="panel-body">
						
									<div class="table-responsive">
						
										
										<?php 
										$url=base64_decode($_GET['process']);
										switch($url)
										{ 
										case 'addTarget': ?>
										<div style="width:2000;">
											<form name="addTarget" action="inc/process-library.php" method="post" enctype="multipart/form-data" autocomplete="off" onSubmit="return htarget();">
												<input type="hidden" name="process" value="saveaddTarget" />
												<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI'];?>" />
											
											
												<div  class="col-sm-3">
                                                <br>
												<select  name="sales_name" class="form-control" id="sales_name">
													
														<option value="select">-- Select Sales Person --</option>
													<?php 
													
													$adminclass=new adminClass();
													$allsalesper=$adminclass->salesdetail();
												
													foreach($allsalesper as $allsales)
													{	?>
													<option value="<?php echo $allsales['id'];?>"><?php echo $allsales['fname'];?>&nbsp;<?php echo $allsales['lname'];?>/<?php echo $allsales['role'];?></option>
													<?php 
													}
													?>
													</select><span  style="color:#FF6699;" id="sales_err"></span>
                                                    <br>
													
                                                    <div id="address"></div>
													<br>
													
													<label>Daily:</label><input type="text"  id="date" placeholder="Daily Target Date" name="assign_date" size="10">&nbsp;&nbsp;<input type="text"  id="d_qty" placeholder="qty" name="d_qty" size="5">&nbsp;&nbsp; <input type="text" id="d_incentive" placeholder="incentive" name="d_incentive" size="7"> <span  style="color:#FF6699;" id="tqty_err"></span>
													<br>
                                                    <br>
                                                   <label>Weekly:</label> <input type="text"  id="sdate" placeholder="Start Week" name="sweek" size="10"><span  style="color:#FF6699;" id="tdate_err"></span>&nbsp;&nbsp;<input type="text"  id="edate" placeholder="End Week" name="eweek" size="10" value="" readonly>&nbsp;&nbsp;<input type="text"  id="w_qty" placeholder="qty" name="w_qty" size="5">&nbsp;&nbsp; <input type="text" id="w_incentive" placeholder="incentive" name="w_incentive" size="7"><span  style="color:#FF6699;" id="tdate_err"></span>
                                                    <br>
                                                   <br>
                                                    <label>Monthly:</label><input type="text"  id="msdate" placeholder="Start Month" name="smonth" size="10">&nbsp;&nbsp;<input type="text" id="date" placeholder="End Month" name="emonth" size="10">&nbsp;&nbsp;<input type="text"  id="m_qty" placeholder="qty" name="m_qty" size="5">&nbsp;&nbsp; <input type="text" id="m_incentive" placeholder="incentive" name="m_incentive" size="7"><span  style="color:#FF6699;" id="tdate_err"></span>
                                                    <br>
                                                    <br>
                                                  <label>Yearly:</label><input type="text"  id="date" placeholder="Start year" name="syear" size="10">&nbsp;&nbsp;<input type="text" id="date" placeholder="End year" name="eyear" size="10">&nbsp;&nbsp;<input type="text"  id="y_qty" placeholder="qty" name="y_qty" size="5">&nbsp;&nbsp; <input type="text" id="y_incentive" placeholder="incentive" name="y_incentive" size="7"><span  style="color:#FF6699;" id="tdate_err"></span>
	 <br>
	<br>
													<div class="col-sm-3">
														<input type="submit" name="saveaddTarget" value="Add Target" class="btn btn-teal" style="font-family:Verdana, Arial, Helvetica, sans-serif;" />
													</div>
												
												</form>
                                                </div>
										<?php break;
										 case 'editTarget': ?>
	
											<form name="editTarget" action="inc/process-library.php" method="post" enctype="multipart/form-data">
											<input type="hidden" name="process" value="editTarget" />
											<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI'];?>" />
									
									 <div class="col-sm-3">
												
												<?php 
												
													$adminclass=new adminClass();
													$edittarget=$adminclass->TargetdetailById($_GET['taId']);
												?>
                                                
                                                	<input type="hidden" name="taId" value="<?php echo $edittarget['id'];?>" />
                                                    
                                                    <select class="form-control" name="sales_name">
													
														<option>-- Select sales Person --</option>
													<?php 
													
													
													$adminclass=new adminClass();
													$allsalesper=$adminclass->salesdetail();
												
													foreach($allsalesper as $allsalesper)
													{	
														if($allsalesper['id']==$edittarget['sales_id'])
														
														{
														
														   ?>
														<option value="<?php echo $allsalesper['id'];?>" selected="selected"><?php echo $allsalesper['fname'];?></option>
														<?php 
														}
														else
														{?>
																<option value="<?php echo $allsalesper['id'];?>"><?php echo $allsalesper['fname'];?></option>
														<?php 
														}
													}
													?>
													</select>
													<br>
													
                                                    
													<?php /*?><select class="form-control" name="product_name">
													
														<option>-- Select Product --</option>
													<?php 
													
													
													
													$adminclass=new adminClass();
													$allproduct=$adminclass->productdetail();
													
													foreach($allproduct as $allproduct)
													{	
														if($allproduct['id']==$edittarget['producttype_id'])
														{?>
													<option value="<?php echo $allproduct['id'];?>" selected="selected"><?php echo $allproduct['pname'];?> </option>
													
													<?php
														}
														else
														{?>
														<option value="<?php echo $allproduct['id'];?>" ><?php echo $allproduct['pname'];?> </option>
														
													<?php 	}	 
													}
													?>
													</select>
													<br>
													
													
                                                    
                                                    <input type="text" class="form-control" id="qty" placeholder="qty" name="qty" value="<?php echo $edittarget['qty'];?>"> <span  style="color:#FF6699;" id="asprmo_err"></span>
													<br>
													
													
													<input type="text" class="form-control" id="date" placeholder="Date" name="assign_date" value="<?php echo $edittarget['date'];?>"><span  style="color:#FF6699;" id="asprdate_err"></span>
	
	<br><?php */?>
    
    <label>Daily:</label><input type="text"  id="date" placeholder="Daily Target Date" name="assign_date" size="10" value="<?php echo $edittarget['start_date'];?>">&nbsp;&nbsp;<input type="text"  id="d_qty" placeholder="qty" name="d_qty" size="5" value="<?php echo $edittarget['qty'];?>">&nbsp;&nbsp; <input type="text" id="d_incentive" placeholder="incentive" name="d_incentive" size="7" value="<?php echo $edittarget['incentive'];?>"> <span  style="color:#FF6699;" id="tqty_err"></span>
													<br>
                                                    <br>
                                                   <label>Weekly:</label> <input type="text"  id="sdate" placeholder="Start Week" name="sweek" size="10" value="<?php echo $edittarget['start_date'];?>"><span  style="color:#FF6699;" id="tdate_err"></span>&nbsp;&nbsp;<input type="text"  id="edate" placeholder="End Week" name="eweek" size="10" value="<?php echo $edittarget['end_date'];?>" readonly >&nbsp;&nbsp;<input type="text"  id="w_qty" placeholder="qty" name="w_qty" size="5" value="<?php echo $edittarget['qty'];?>">&nbsp;&nbsp; <input type="text" id="w_incentive" placeholder="incentive" name="w_incentive" size="7" value="<?php echo $edittarget['qty'];?>"><span  style="color:#FF6699;" id="tdate_err"></span>
                                                    <br>
                                                    <?php 
												
													$adminclass=new adminClass();
													$edittargetmy=$adminclass->TargetdetailmyById($_GET['taId']);
												?>
                                                   <br>
                                                    <label>Monthly:</label><input type="text"  id="msdate" placeholder="Start Month" name="smonth" size="10" value="<?php echo $edittargetmy['month'];?>">&nbsp;&nbsp;<input type="text" id="date" placeholder="End Month" name="emonth" size="10" value="<?php echo $edittargetmy['yaer'];?>">&nbsp;&nbsp;<input type="text"  id="m_qty" placeholder="qty" name="m_qty" size="5" value="<?php echo $edittargetmy['qty'];?>">&nbsp;&nbsp; <input type="text" id="m_incentive" placeholder="incentive" name="m_incentive" size="7" value="<?php echo $edittargetmy['incentive'];?>"><span  style="color:#FF6699;" id="tdate_err"></span>
                                                    <br>
                                                    <br>
                                                  <label>Yearly:</label><input type="text"  id="date" placeholder="Start year" name="syear" size="10" value="<?php echo $edittargetmy['month'];?>">&nbsp;&nbsp;<input type="text" id="date" placeholder="End year" name="eyear" size="10" value="<?php echo $edittargetmy['year'];?>">&nbsp;&nbsp;<input type="text"  id="y_qty" placeholder="qty" name="y_qty" size="5" value="<?php echo $edittargetmy['qty'];?>">&nbsp;&nbsp; <input type="text" id="y_incentive" placeholder="incentive" name="y_incentive" size="7" value="<?php echo $edittargetmy['incentive'];?>"><span  style="color:#FF6699;" id="tdate_err"></span>
	 <br>
	<br>
											<div class="col-sm-4">
												<input type="submit" name="editTarget" value="Update Target" class="btn btn-teal" style="font-family:Verdana, Arial, Helvetica, sans-serif;"/>
											</div>
										</div>
													
											</form>
											
											<?php break;
										case 'viewreport':?>
										    <table class="table table-striped table-bordered table-hover" id="sample-table-2">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Product Name</th>
													<th>Sales Person</th>
													<th>Quntity</th>
													<th>Date</th>
													<th>Actions</th>
												
												</tr>
											</thead>
											<tbody>
												<?php

													$adminclass=new adminClass();
													$targetlist=$adminclass->targetdetail();
													$s=1;
													
													
													foreach($targetlist as $alltarget)
													{	
													
													 
													 
												 ?>
												<tr>
													<td><?=$s;?></td>
													<td><?=$alltarget['pname'];?></td>
													<td><?=$alltarget['fname'];?></td>
													<td><?=$alltarget['qty'];?></td>
													
													<td><?=$alltarget['date'];?></td>
                                                   
													
													<td><a data-original-title="Edit" data-placement="top" class="btn btn-xs btn-teal tooltips" href="assign_product.php?process=<?=base64_encode('editTarget');?>&taId=<?=$alltarget['id'];?>"><i class="fa fa-edit"></i></a>
													<a data-original-title="Remove" data-placement="top" class="btn btn-xs btn-bricky tooltips"  href="delete.php?taId=<?=$alltarget['id'];?>" ><i class="fa fa-times fa fa-white"></i></a>
													</td>									
													
												</tr>
												<?php $s++; } ?>
																								
											</tbody>
										</table>
									<?php 		 
										break;
										  default:  ?>	
												<div style="width:1000">
											<div class="btn-group pull-right">

								
											

												<ul class="dropdown-menu dropdown-light pull-right">
													<li>
														<a href="#" class="export-pdf" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Save as PDF </a>
													</li>
													<li>
														<a href="#" class="export-png" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Save as PNG </a>
													</li>
													<li>
														<a href="#" class="export-csv" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Save as CSV </a>
													</li>
													<li>
														<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Save as TXT </a>
													</li>
													<li>
														<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Save as XML </a>
													</li>
													<li>
														<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Save as SQL </a>
													</li>
													<li>
														<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Save as JSON </a>
													</li>
													<li>
														<a href="#" class="export-excel" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Export to Excel </a>
													</li>
													<li>
														<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Export to Word </a>
													</li>
													<li>
														<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4"> Export to PowerPoint </a>
													</li>
												</ul>	
											</div>
                                         
										
										<table class="table table-striped table-bordered table-hover" id="sample-table-2" width="1000">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Target Type</th>
													<th>Sales Person</th>
													<th>Quntity</th>
                                                    <th>Incentive/Box</th>
                                                    <th>Target Date</th>
                                                    <th>dailyachive</th>
                                                    <th>Total Incentive</th>
													
												
												</tr> 
											</thead>
											<tbody>
												<?php

													$adminclass=new adminClass();
													$targetlist=$adminclass->targetdetail();
													$s=1;
													
													
													foreach($targetlist as $alltarget)
													{	
													
													
													  
												 ?>
												<tr>
													<td><?=$s;?></td>
													<td><?=$alltarget['target_type'];?></td>
													<td><?=$alltarget['fname'];?></td>
													<td><?=$alltarget['qty'];?></td>
                                                    <td><?=$alltarget['incentive'];?></td>
													<td><?=$date = $alltarget['start_date'];?></td>
                                                    <?php 
														 $sql="SELECT db_order.*,SUM(db_order.qty ) as daily_achive from db_order where   db_order.order_date = '".$date."' and db_order.status= 'done'";
														$res=mysql_query($sql);
														while($row=mysql_fetch_array($res)){
												
													?>
                                                   <td><?=$row['daily_achive'];?></td>
                                                 <?php  $daily_total_incentive=$row['daily_achive'] * $alltarget['incentive'];?>
                                                  <td><?=$daily_total_incentive;?></td>
													
													<?php 
													} ?>
																						
													
												</tr>
												<?php $s++; } ?>
																								
											</tbody>
										</table>
											
                                            </div>
									
                                    </div>
								</div>
                                
							</div>

						</div>
					</div>
<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Weekly Target
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
									
										<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
										<a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
										
									</div>
								</div>
								<div class="panel-body">
						
									<div class="table-responsive">
						
										
										
										
											
											
										    <table class="table table-striped table-bordered table-hover" id="sample-table-2">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Target Type</th>
													<th>Sales Person</th>
													<th>Quntity</th>
                                                    <th>Incentive</th>
													 
                                                    <th> Start Date</th>
                                                    <th> End Date</th>
                                                    <th>Weekly Achive</th>
                                                     <th>Total Incentive</th>
													
												
												</tr>
											</thead>
											<tbody>
												<?php

													$adminclass=new adminClass();
													$targetlist=$adminclass->targetwdetail();
													$s=1;
													
													
													foreach($targetlist as $alltarget)
													{	
													
													  $daily_total_incentive=$alltarget['Weekly_achive'] * $alltarget['incentive'];
													 
												 ?>
												<tr>
													<td><?=$s;?></td>
													<td><?=$alltarget['target_type'];?></td>
													<td><?=$alltarget['fname'];?></td>
													<td><?=$alltarget['qty'];?></td>
                                                    <td><?=$alltarget['incentive'];?></td>
                                                    
													<td><?=$sdate=$alltarget['start_date'];?></td>
													<td><?=$edate=$alltarget['end_date'];?></td>
                                                     <?php 
														  $sql="SELECT db_order.*,SUM(db_order.qty ) as weeekly_achive from db_order where   db_order.order_date between '".$sdate."' and '".$edate."' and db_order.status= 'done'";
														$res=mysql_query($sql);
														while($row=mysql_fetch_array($res)){
												
													?>
                                                   <td><?=$row['weeekly_achive'];?></td>
                                                 <?php  $weekly_total_incentive=$row['weeekly_achive'] * $alltarget['incentive'];?>
                                                  <td><?=$weekly_total_incentive;?></td>
													
													<?php 
													} ?>
                                                   
													
																						
													
												</tr>
												<?php $s++; } ?>
																								
											</tbody>
										</table>
										
												
									</div>
								</div>
                                
							</div>

						</div>
                        </div>
                        <div class="row">

                        <div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Monthly Target
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
									
										<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
										<a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
										
									</div>
								</div>
								<div class="panel-body">
                               
						<input type="button" id="jan" name="jan" value="January" class="btn btn-teal" onClick="jan()">&nbsp;&nbsp;&nbsp;<input type="button" id="feb" name="feb" value="February" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button" id="march" name="march" value="March" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button" id="april" name="april" value="April" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button" name="may" value="May" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button"  id="june" name="june" value="June" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button" id="july" name="july" value="July" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button" name="aug" id="aug" value="August" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button" id="sep" name="sep" value="September" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button" id="oct" name="oct" value="October" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button" id="nov" name="nov" value="November" class="btn btn-teal">&nbsp;&nbsp;&nbsp;<input type="button" id="dece" name="dece" value="December" class="btn btn-teal">
                        <br><br>
									<div class="table-responsive">
										    <table class="table table-striped table-bordered table-hover" id="sample-table-2">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Target type</th>
													<th>Sales Person</th>
													<th>Quntity</th>
													<th>Incentive</th>
                                                    
                                                    <th>Start month</th>
                                                    
                                                    <th>End Month</th>
                                                    <th>Monthly Achive</th>
                                                    <th>Total Incentive</th>
													
												 
												</tr>
											</thead>
											<tbody>
												<?php

													$adminclass=new adminClass();
													$targetlist=$adminclass->targetmdetail();
													$s=1;
													
													
													foreach($targetlist as $alltarget)
													{	
													
													$daily_total_incentive=$alltarget['monthly_achive'] * $alltarget['incentive']; 
													 
												 ?>
												<tr>
													<td><?=$s;?></td>
													<td><?=$alltarget['target_type'];?></td>
													<td><?=$alltarget['fname'];?>&nbsp;<?=$allassign_Productlist['lname'];?></td>
													<td><?=$alltarget['qty'];?></td>
                                                    <td><?=$alltarget['incentive'];?></td>
																																						                                                    <td><?=$smdate=$alltarget['month'];?></td>
                                                    <td><?=$emdate=$alltarget['year'];?></td>
                                                    <?php 
														  $sql="SELECT db_order.*,SUM(db_order.qty ) as monthly_achive from db_order where  EXTRACT( YEAR_MONTH FROM `order_date` )  = '".$smdate."'   and db_order.status= 'done'";
														$res=mysql_query($sql);
														while($row=mysql_fetch_array($res)){
												
													?>
                                                   <td><?=$row['monthly_achive'];?></td>
                                                 <?php  $monthly_total_incentive=$row['monthly_achive'] * $alltarget['incentive'];?>
                                                  <td><?=$monthly_total_incentive;?></td>
													
													<?php 
													} ?>
                                                   
																					
													
												</tr>
												<?php $s++; } ?>
																								
											</tbody>
										</table>
										
												
									</div>
								</div>
                                
							</div>

						</div>
                        </div>
                        <div class="row">

                        <div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Yearly Target
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
									
										<a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a>
										<a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a>
										
									</div>
								</div>
								<div class="panel-body">
						
									<div class="table-responsive">
						
										
										
										
											
											
										    <table class="table table-striped table-bordered table-hover" id="sample-table-2">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Target Type</th>
													<th>Sales Person</th>
													<th>Quntity</th>
                                                    <th>Incentive</th>
                                                     <th>Start Year</th>
                                                     <th>End Year</th>
                                                   	<th>Yearly Achive</th>
                                                    <th>Total Incentive</th>
													
												
												</tr>
											</thead>
											<tbody>
												<?php

													$adminclass=new adminClass();
													$targetlist=$adminclass->targetydetail();
													$s=1;
													
													
													foreach($targetlist as $alltarget)
													{	
													
													 $daily_total_incentive=$alltarget['yearly_achive'] * $alltarget['incentive']; 
													 
												 ?>
												<tr>
													<td><?=$s;?></td>
													<td><?=$alltarget['target_type'];?></td>
													<td><?=$alltarget['fname'];?></td>
													<td><?=$alltarget['qty'];?></td>
													<td><?=$alltarget['incentive'];?></td>
                                                    
													<td><?=$syear=$alltarget['month'];?></td>
                                                    <td><?=$eyear=$alltarget['year'];?></td>
                                                    <?php 
														 $sql="SELECT db_order.*,SUM(db_order.qty ) as yearly_achive from db_order where  EXTRACT( YEAR FROM `order_date`)  between '".$syear."' and '".$eyear."'  and db_order.status= 'done'";
														$res=mysql_query($sql);
														while($row=mysql_fetch_array($res)){
												
													?>
                                                   <td><?=$row['yearly_achive'];?></td>
                                                 <?php  $monthly_total_incentive=$row['yearly_achive'] * $alltarget['incentive'];?>
                                                  <td><?=$monthly_total_incentive;?></td>
													
													<?php 
													} ?>
                                                   
																				
													
												</tr>
												<?php $s++; } ?>
																								
											</tbody>
										</table>
										
												
									</div>
								</div>
                                
							</div>

						</div>
                        <?php break; }	?>
					</div>
                    </div>
                        
                      <!-- end: PAGE CONTENT-->
				</div>
                
			</div>
			<!-- end: PAGE -->
		
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<?php include_once('inc/footer.php'); ?>	
		<!--[if gte IE 9]><!-->
		<script src="assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
		<!--<![endif]-->
		<script src="assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

		<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
		
		<script src="assets/plugins/bootbox/bootbox.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
		<script type="text/javascript" src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>

		<script src="assets/plugins/tableExport/tableExport.js"></script>
		<script src="assets/plugins/tableExport/jquery.base64.js"></script>
		<script src="assets/plugins/tableExport/html2canvas.js"></script>
		<script src="assets/plugins/tableExport/jquery.base64.js"></script>
		<script src="assets/plugins/tableExport/jspdf/libs/sprintf.js"></script>
		<script src="assets/plugins/tableExport/jspdf/jspdf.js"></script>
		<script src="assets/plugins/tableExport/jspdf/libs/base64.js"></script>
		<script src="assets/js/table-export.js"></script>
		<script src="assets/js/jquery-ui.js"></script>
        <script src="assets/js/jquery-ui.min.js"></script>
        <script src="js/validation.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				TableExport.init();
			});
		</script>
        <script type="text/javascript">
		$(document).ready(function(){
	
	$('#sales_name').on("change",function () {
    	var sales_id = $(this).find('option:selected').val();
        //alert(countryId);
		$.ajax({
            url: "displayadd.php",
            type: "POST",
            data: "sales_id="+sales_id,
            success: function (response) {
                console.log(response);
                $("#address").html(response);
            },
        });
    }); 
}); 
	
		</script>
         <script type="text/javascript">
		$(document).ready(function(){
	
	$('#sdate').on("click",function () {
    	var sweek=document.getElementById("jan").value;
        //alert(countryId);
		$.ajax({
            url: "get_month.php",
            type: "POST",
            success: function (response) {
			alert(response);
                console.log(response);
                $("#edate").html(response);
            },
        });
    }); 
}); 
	
		</script>
        <script>
  $(function() {
    $( "#sdate" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+35",
     dateFormat:"yy-mm-dd"
  });
  });
  </script>
  
  <script>
  $(function() {
    $( "#date" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+35",
     dateFormat:"yy-mm-dd"
  });
  });
  </script>
  <script>
  $(function() {
    $( "#msdate" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+35",
     dateFormat:"yy-mm"
  });
  });
  </script>
  <script>
  $(function() {
    $( "#medate" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+35",
     dateFormat:"yy-mm"
  });
  });
  </script>
	</body>
	<!-- end: BODY -->


</html>