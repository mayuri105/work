<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	   <div class="static-content">
			 <div class="page-content">
				<ol class="breadcrumb">
					<li><a href="<?php site_url('index'); ?>">Home</a></li>
					<li><a href="<?php site_url('reports'); ?>">Reports</a></li>
					<li class="active"><a href=""> Customer Orders Reports</a></li>
				</ol> 
				<div class="container-fluid">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-bar-chart"></i> Customer Orders Reports</h3>
						</div>
						<div class="panel-body">
							<div class="well">
								<div class="row">
								
									<form action="<?= site_url('reports/customer_orders_report') ?>" method="get" name="filter">
										
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input-date-start">Date Start</label>
												<div class="input-group date">
													<input type="text" name="date_start" value="<?php echo $date_start== '01-01-1970' ? '' : $date_start  ?>"  placeholder="Date Start" id="input-date-start" class="form-control">
													<span class="input-group-btn">
															<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
														</span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label" for="input-date-end">Date End</label>
												<div class="input-group date">
													<input type="text" name="date_end" value="<?php echo $date_end== '01-01-1970' ? '' : $date_end  ?>"  placeholder="Date End" id="input-date-end" class="form-control">
													<span class="input-group-btn">
															<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
														</span>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											
											<div class="form-group">
												<label class="control-label" for="input-status">Order Status</label>
												<select name="order_status_id" id="input-status" class="form-control">
													<option value="">None</option>
													<?php foreach ($order_status as $os): ?>
														<option value = <?= $os->order_status_id; ?> <?php echo $os->order_status_id == $order_status_id ? 'selected' :'' ?>><?= ucfirst($os->name); ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
										</div>
									</form>
								</div>
								
							</div>

							
							<br>

							<table class="table table-striped" id="aftersearch">
								<thead>
					              <tr>
					                <th class="text-left">Customer Name</th>
					                <th class="text-left">E-Mail</th>
					                <th class="text-right">No. Orders</th>
					                <th class="text-right">No. Products</th>
					                <th class="text-right">Total</th>
					               
					              </tr>
					            </thead>
								<tbody id="tbody">
									<?php foreach ($customer_orders as $co): ?>
										
									<tr>
											<td class="text-left"><?= $co->cust; ?></td>
							                <td class="text-left"><?= $co->email; ?></td>
							                <td class="text-right"><?= $co->orders ?></td>
							                <td class="text-right"><?= $co->total_products ?></td>
							                <td class="text-right">$<?= $co->total; ?></td>
						                
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
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.min.js"></script> 
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.resize.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.categories.min.js"></script>
   
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.time.min.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript">	
    	 
    </script>
  
</body>
</html>