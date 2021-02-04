<?php
require_once('inc/connection.php');
require_once('inc/function.php');
require_once('inc/admincls.php');
if(!isset($_SESSION['u_name']))
{
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
		<title>Admin |Order</title>
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
		<link rel="stylesheet" href="../../time22/assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../time22/assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../time22/assets/fonts/style.css">
		<link rel="stylesheet" href="../../time22/assets/css/main.css">
		<link rel="stylesheet" href="../../time22/assets/css/main-responsive.css">
		<link rel="stylesheet" href="../../time22/assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="../../time22/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="../../time22/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="../../time22/assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="../../time22/assets/css/print.css" type="text/css" media="print"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" type="text/css" href="../../time22/assets/plugins/select2/select2.css" />
		<link rel="stylesheet" href="../../time22/assets/plugins/DataTables/media/css/DT_bootstrap.css" />
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="shortcut icon" href="../../time22/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../../time22/assets/css/smoothness/jquery-ui.css">
		
				<script>
				function status(id,status)
			{
				
				var r=confirm('Are u Sure...Want to change status')
				if(r==true)		
				{
					
					window.location.href='change_status.php?salesId='+id+'&status='+status;
					
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
						<ol class="breadcrumb">
								
								<li class="active">
									 <a href="../../time22/order_display.php"> Order </a>
								</li>
								
								
								
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
							
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-md-12">
                        <ol class="breadcrumb">
								
								<li class="active">
									 <a href="../../time22/Order_display.php">Order </a>
								</li>
							<div class="panel panel-default">
								
								<div class="panel-body">
						
									<div class="table-responsive">
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
								
										
										
										<table class="table table-striped table-bordered table-hover" id="sample-table-2">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Seller Name</th>
													<th>Shop Name</th>
													<th>Product Name</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
													<th>Replacement</th>
                                                    <th>Order Date</th>
                                                     
													<th>Actions</th>
												
												</tr>
											</thead>
											<tbody>
												<?php
													$adminClass=new adminClass();
													$allorder=$adminClass->orderdetail();
													$s=1;
													foreach($allorder as $allorder)
													{	
												 ?>
												<tr>
													<td><?=$s;?></td>
													<td><?=$allorder['sales_name'];?> </td>
													<td><?=$allorder['shop_name'];?></td>
													<td><?=$allorder['product_name'];?></td>
                                                    <td><?=$allorder['qty'];?></td>
                                                    <td><?=$allorder['price'];?></td>
                                                    <td><?=$allorder['replacement'];?></td>
                                                    <td><?=$allorder['order_date'];?></td>
                                                   
													
													<td>
													<a data-original-title="Remove" data-placement="top" class="btn btn-xs btn-bricky tooltips"  href="../../time22/delete.php?orderId=<?=$allorder['id'];?>" ><i class="fa fa-times fa fa-white"></i></a>
													</td>									
													
												</tr>
												<?php $s++; } ?>
																								
											</tbody>
										</table>
											
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
		<script src="../../time22/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="../../time22/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="../../time22/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="../../time22/assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="../../time22/assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="../../time22/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="../../time22/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="../../time22/assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="../../time22/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="../../time22/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="../../time22/assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

		<script type="text/javascript" src="../../time22/assets/plugins/select2/select2.min.js"></script>
		
		<script src="../../time22/assets/plugins/bootbox/bootbox.min.js"></script>
		<script type="text/javascript" src="../../time22/assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
		<script type="text/javascript" src="../../time22/assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="../../time22/assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>

		<script src="../../time22/assets/plugins/tableExport/tableExport.js"></script>
		<script src="../../time22/assets/plugins/tableExport/jquery.base64.js"></script>
		<script src="../../time22/assets/plugins/tableExport/html2canvas.js"></script>
		<script src="../../time22/assets/plugins/tableExport/jquery.base64.js"></script>
		<script src="../../time22/assets/plugins/tableExport/jspdf/libs/sprintf.js"></script>
		<script src="../../time22/assets/plugins/tableExport/jspdf/jspdf.js"></script>
		<script src="../../time22/assets/plugins/tableExport/jspdf/libs/base64.js"></script>
		<script src="../../time22/assets/js/table-export.js"></script>
        <script src="../../time22/assets/js/jquery-ui.js"></script>
        <script src="../../time22/assets/js/jquery-ui.min.js"></script>
		<script src="../../time22/js/validation.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				TableExport.init();
			});
		</script>
        
        <script>
  $(function() {
    $( "#bsdate" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+35",
     dateFormat:"yy-mm-dd"
  });
  });
  </script>
	</body>
	<!-- end: BODY -->


</html>