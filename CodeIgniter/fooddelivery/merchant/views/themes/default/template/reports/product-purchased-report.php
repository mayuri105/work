<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/merchant'); ?>
<div class="static-content-wrapper">
	   <div class="static-content">
			 <div class="page-content">
				<ol class="breadcrumb">
					<li><a href="<?php site_url('index'); ?>">Home</a></li>
					<li><a href="<?php site_url('reports'); ?>">Report</a></li>
					<li class="active"><a href="">Product Purchased Report</a></li>
				</ol> 
				<div class="container-fluid">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-bar-chart"></i>Product Purchased Report</h3>
						</div>
						<div class="panel-body">
							<div class="well">
								<div class="row">
								
									<form action="<?= site_url('reports/product_purchased_report') ?>" method="get" name="filter">
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label" for="input-date-end">Store</label>

												<select class="form-control" name="store">
													<option value="">None</option>
													<?php foreach ($store as $str): ?>
														<option value = <?= $str->store_id; ?> <?php echo $stores == $str->store_id ? 'selected' : '' ?>><?= ucfirst($str->store_name); ?></option>
													<?php endforeach ?>
												</select>	
											</div>
											<div class="form-group">
												<label class="control-label" for="input-date-end">Sector</label>
												<select class="form-control" name="sector">
													<option value="">None</option>
													<?php foreach ($store_type as $st): ?>
														<option value = <?= $st->mt_id; ?> <?php echo $sector == $st->mt_id ? 'selected' : '' ?> ><?= ucfirst($st->type); ?></option>
													<?php endforeach ?>
												</select>
											</div>
										
											
										</div>
										<div class="col-sm-4">
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
										<div class="col-sm-4">
											
											<div class="form-group">
												<label class="control-label" for="input-status">Order Status</label>
												<select name="order_status_id" id="input-status" class="form-control">
													<option value="">None</option>
													<?php foreach ($order_status as $os): ?>
														<option value = <?= $os->order_status_id; ?> <?php echo $order_status_id == $os->order_status_id ? 'selected' : '' ?>><?= ucfirst($os->name); ?></option>
													<?php endforeach ?>
												</select>
											</div>

											<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
										</div>
									</form>
								</div>
								
							</div>
								

							 <table class="table table-striped" id="aftersearch">
								<thead>
					              <tr>
					                <th class="text-left">Product Name</th>
					                <th class="text-left">Store Name</th>
					                <th class="text-right">Quantity</th>
					                <th class="text-right">Total</td>
					              </tr>
					            </thead>
					            <tbody>
					            	<?php if ($products): ?>
					            		<tr><td>No Product Data</td>	</tr>
					            	<?php else: ?>
					            	<?php foreach ($products as $pr): ?>
					            		<tr>
							                <td class="text-left"><?= $pr->product_name ?></td>
							                <td class="text-left"><?= $pr->store_name ?></td>
							                <td class="text-right"><?= $pr->qty ?></td>
							                <td class="text-right">$<?= $pr->total ?></td>
							            </tr>
					            	<?php endforeach ?>
					           	 <?php endif; ?>
					            </tbody>
					            <tfoot>
					            	<tr>
										<td colspan="3"></td>
										<td >
											<ul class="pagination">
												<?php echo $pagination_helper->create_links(); ?>
											</ul>
										</td>
									</tr>
					            </tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>	
	   </div>   
		  
	<?php echo Modules::run('footer/footer/index'); ?>
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
	
  
</body>
</html>