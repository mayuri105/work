<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	   <div class="static-content">
			 <div class="page-content">
				<ol class="breadcrumb">
					<li><a href="<?php site_url('index'); ?>">Home</a></li>
					<li class="active"><a href="">Sector Sale Report</a></li>
				</ol> 
				<div class="container-fluid">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-bar-chart"></i> Sector Sale List</h3>
						</div>
						<div class="panel-body">
							<div class="well">
								<div class="row">
									<form action="<?= site_url('reports/sector_sale') ?>" method="get" name="filter-form">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-date-start">Date Start</label>
											<div class="input-group date">
												<input type="text" name="start_date" value="<?php echo $start_date== '01-01-1970' ? '' : $start_date  ?>" placeholder="Date Start" id="input-date-added" class="date form-control">
												<span class="input-group-btn">
													<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-date-end">Date End</label>
											<div class="input-group date">
												<input type="text" name="end_date" value="<?php echo $start_date== '01-01-1970' ? '' : $end_date	  ?>" placeholder="Date End" id="input-date-end" class="date form-control">
												<span class="input-group-btn">
													<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
									</div>
									</form>

								</div>
							</div>

							<br>
							<div class="row ">
							
								<div class="col-md-4 col-md-offset-4">
									
									<div id="piechart"  style="width:400px;height:300px"></div>
								
								</div>
								<br>
							</div>
							<br>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Sector</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									
									<?php foreach ($sector_collection as $sector): ?>
										<tr>
											<td><?= ucfirst($sector->type) ?></td>
											<td><?= $sector->tot; ?></td>
										</tr>
									<?php endforeach ?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
	   </div>   
		  
	<?php echo Modules::run('footer/footer/index'); ?>
	<?php 
	$hex = array(
    	'0' =>'E45151',
    	'1' =>'61BB57', 
    	'2' =>'8642A0', 
    	'3' =>'086AC1' ,  
    ); ?>
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.min.js"></script> 
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.pie.min.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
     
	<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.symbol.js"></script>
		
    <script type="text/javascript">
    var dataSet = [
    <?php $i=0; 
    if ($sector_collection) {
    foreach ($sector_collection as $sector): 
    ?>
    {
    	label: "<?= ucfirst($sector->type) ?>", data:<?= $sector->tot ?>, 
    	color: "#<?= $hex[$i];?>" 
    },
    <?php $i++; endforeach; 
	}else{ ?>
		{"label":"No Data","data":0  }
	<?php }
   	?>
									
    ];
	var options1 = {
	    series: {
	        pie: {
	            show: true,
	        }
	    }
	};
$(document).ready(function () {
    $.plot($("#piechart"), dataSet, options1);
});
</script>
</body>
</html>