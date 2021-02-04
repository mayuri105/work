<?php
require_once('inc/connection.php');
require_once('inc/function.php');
require_once('inc/industryTypeClass.php');
if(!isset($_SESSION['u_name']))
{
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
		<title>Admin | Industry Type</title>
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
		
				<script>
					function status(indid,indstatus)
						{
							
							var r=confirm('Are u Sure...Want to change status')
							if(r==true)		
							{
								
								window.location.href='change_status.php?indid='+indid+'&indstatus='+indstatus;
								
							}
							else
							{
								return false;
							}
						}
				</script>
		
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
								<li>
									<i class="clip-grid-6"></i>
									&nbsp;<a href="industry-type.php"> Industry Type </a>
								</li>
														
								<?php if($_GET['process']==base64_encode('addIndustryType')) { 
									?>			
									<li>
										Add Industry Type
									</li>
									<?php } if($_GET['process']==base64_encode('editIndustryType')) { 
									?>			
									<li>
										Edit Industry Type
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
								<h1>Industry Type </h1>
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
									Industry Type 
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
										case 'addIndustryType': ?>
										
											<form name="addIndustryType" action="inc/process-library.php" method="post" enctype="multipart/form-data">
												<input type="hidden" name="process" value="saveIndustryType" />
												<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI'];?>" />
											
											
													<div class="col-sm-3">
													<input type="text" class="form-control" id="form-field-10" placeholder="Industry Type Name" name="name">
													</div>
													<div class="col-sm-3">
														<input type="submit" name="saveIndustryType" value="Save Industry Type" class="btn btn-teal" />
													</div>
												
														
												</form>
										<?php break;
										 case 'editIndustryType': ?>
	
											<form name="editIndustryType" action="inc/process-library.php" method="post" enctype="multipart/form-data">
											<input type="hidden" name="process" value="editIndustryType" />
											<input type="hidden" name="returnUrl" value="<?=$_SERVER['REQUEST_URI'];?>" />
									
												<?php
													$industryTypeName=new industryTypeClass();
													$indName=$industryTypeName->fetchIndustryTypeById($_GET['indId']);
													 ?>
											
							
									 <div class="form-group">
											<label class="col-sm-2 control-label">
												Industry Type Name:
											</label>
											
											<div class="col-sm-3">
												<input type="hidden" name="indId" value="<?=$indName['id'];?>" />
												<input type="text" class="form-control" id="form-field-10"  name="name" value="<?=$indName['industry_type_name'];?>">
											</div>
											<div class="col-sm-4">
												<input type="submit" name="saveIndustryType" value="Update Industry Type" class="btn btn-teal" />
											</div>
										</div>
													
											</form>
											
											<?php break;
										
										  default:  ?>	
												
											<div class="btn-group pull-right">
											<button data-toggle="dropdown" class="btn btn-bricky dropdown-toggle" >
													Export <i class="fa fa-angle-down"></i>
												</button>
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
								
										<a href="<?=$_SERVER['PHP_SELF']?>?process=<?=base64_encode('addIndustryType')?>"  class="btn btn-teal"  style="float:right; margin-right:30em;">Add Industry Type</a>
										
										<table class="table table-striped table-bordered table-hover" id="sample-table-2">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Industry Type Name</th>
													<th>Status</th>
													<th>Created Date</th>
													<th>Modified Date</th>
													<th>Actions</th>
												
												</tr>
											</thead>
											<tbody>
												<?php
													$industryTypeClass=new industryTypeClass();
													$allIndustryType=$industryTypeClass->fetchIndustryTypeDetails();
													$s=1;
													foreach($allIndustryType as $ind)
													{	
												 ?>
												<tr>
													<td><?=$s;?></td>
													<td><?=$ind['industry_type_name'];?></td>
													<td><a href="javascript:void(0);"  onClick="javascript:status('<?php echo $ind['id']?>','<?php echo $ind['status']?>');"><?php if($ind['status']=='0'){ echo "Active"; } else { echo "Deactivate"; } ?></a></td>
													<td><?=$ind['added_date'];?></td>
													<td><?=$ind['modified_date'];?></td>
													<td><a data-original-title="Edit" data-placement="top" class="btn btn-xs btn-teal tooltips" href="<?=$_SERVER['PHP_SELF']?>?process=<?=base64_encode('editIndustryType');?>&indId=<?=$ind['id'];?>"><i class="fa fa-edit"></i></a>
													<a data-original-title="Remove" data-placement="top" class="btn btn-xs btn-bricky tooltips" href="delete.php?indId=<?=$ind['id'];?>"><i class="fa fa-times fa fa-white"></i></a>
													</td>									
													
												</tr>
												<?php $s++; } ?>
																								
											</tbody>
										</table>
											<?php break; }	?>
									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
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

		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				TableExport.init();
			});
		</script>
	</body>
	<!-- end: BODY -->


</html>