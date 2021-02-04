	<!DOCTYPE html>
	<html class="no-js" lang="en">
	<?php echo Modules::run('header/header/head'); ?>
		
	<body>
		
		<div id="page-wrapper">
			
			<div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
				
				
				
				<?php echo Modules::run('sidebar/sidebar/index'); ?>
				
				<div id="main-container">
					
					<?php echo Modules::run('header/header/index'); ?>
					

					
					<div id="page-content">
						
						
						<ul class="breadcrumb breadcrumb-top">
							<li>Home</li>
							<li>Store information</li>
							
						</ul>
						
						<div class="block">
							<?php echo Modules::run('messages/message/index'); ?>
							
							<div class="panel panel-inverse">
								
								<div class="panel-body ">
									<form name="addstore" id="addstore" class="form-horizontal" action="<?php echo site_url('store/updatestore') ?>" method="post" enctype="multipart/form-data">
										<input type="hidden" value="<?= $store->shop_id ?>" name="shop_id" >
										<ul class="nav nav-tabs">
											<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
											<li ><a href="#tab-shipping" data-toggle="tab">Shipping and delivery</a></li>
										</ul>
										<div class="pb"></div>
										

										<div class="tab-content">
											<div class="tab-pane active" id="tab-general">
												
												<input type="hidden" value="" name="" >
												
												
												<br>
												<div class="col-md-12">
													<div class="col-md-3">
														
														
														<label class="control-label"> Name <span class="required">*</span></label>
														
														<input type="text" name="shop_name" value="<?= $store->shop_name ?>" class="form-control" >
														
														
													</div>	
													
													<div class="col-md-3">                                                      
														
														<label class="control-label">Store Category  <span class="required">*</span></label>
														
														<select name="shop_type" id="shop_type"  class="form-control" required> 
																	<option value="">None</option>
																	<?php foreach ($shopcategory as $m ): ?>
																		<option value="<?= $m->cat_id; ?>" <?= $m->cat_id == $store->shop_category ? 'selected' :'' ?>><?= $m->category; ?></option>
																	<?php endforeach ?>
																</select>
														
														
													</div>
													<div class="col-md-3">                                                      
														
														<label class="control-label">Support Phone <span class="required">*</span></label>
														
														<input  name="shop_phone" value="<?= $store->shop_phone ?>" class="form-control">
														
														
													</div>
													
													
													<div class="col-md-3">
														<label class="control-label">Store Zipcode</label>
														
														<input type="text" name="shop_zip"  value="<?= $store->shop_zip ?>" required class="form-control">
													</div>
													<div class="col-md-12">
														<label class="control-label">Addrerss</label>
														
														<textarea type="text" rows="4" name="shop_street" class="form-control"><?= $store->shop_street ?></textarea>

													</div>
													<div class="col-md-12">
														<label class="control-label">About</label>
														
														<textarea type="text" rows="8" name="about_shop" class="form-control"><?= $store->about_shop ?></textarea>

													</div>	
													<div class="col-md-12">
														<label class="control-label">Tagline</label>
														
														<textarea type="text" rows="2" name="tagline" class="form-control"><?= $store->tagline ?></textarea>

													</div>
													<div class="col-md-6">
														<label class="control-label">Hedder Logo</label>
														
														<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
															<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
																
																<?php if ($store->shop_logo): ?>
														<img src="<?php echo getuploadpath().'shop/'.$store->shop_logo; ?>">
													<?php endif ?>
															</div>
															<div>
																<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
																<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
																<input type="file" name="fileinput"></span>
															</div>
														</div>
													</div>	
													<div class="col-md-6">
														<label class="control-label">Footer Logo</label>
														
														<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
															<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
																
																<?php if ($store->footer_logo): ?>
														<img src="<?php echo getuploadpath().'shop/'.$store->footer_logo; ?>">
													<?php endif ?>
															</div>
															<div>
																<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
																<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
																<input type="file" name="fileinput2"></span>
															</div>
														</div>
													</div>	
												</div>
											</div>
											

											<div class="tab-pane" id="tab-shipping">
												
												<br>
												<div class="col-md-8">
													<fieldset>
														
														
														<label class="control-label">City zipcodes Multiple</label>
														
														
														<select id="deliveryzips" name="deliveryzips[]" multiple required>
														
													<?php foreach ($zipcode as $z ): ?>
														<option value="<?= $z->cz_id ?>" <?= in_array($z->cz_id,$zip) ? 'selected':'' ?>><?= $z->zipcode ?></option>
													<?php endforeach ?>
												</select>
														
													</fieldset>
												</div>
												<br>
												<div class="col-md-10">
													<label class="control-label">Delivery Shedule for All Product</label>
													<br>
													<br>
													<div class="col-md-3">
														
														
													<input type="text" name="time_from"  value="<?= $store->time_from ?>" class="form-control">
													</div>
													<div class="col-md-1">														
														<span> To </span>
													</div>														
													<div class="col-md-3">
													
													<input type="text" name="time_to"  value="<?= $store->time_to ?>" class="form-control">
														</div>
												<div class="col-md-3">
													<select id="example-chosen" name="duration_from" class="select-chosen" data-placeholder="Choose " style="width: 250px;">
														<option></option>  
														<option value="Days" <?= $store->duration_from =='Days' ? 'selected' : '' ?>>Days</option>
                                        <option value="Weeks" <?= $store->duration_from =='Weeks' ? 'selected' : '' ?>>Weeks</option>
														<option value="Hours" <?= $store->duration_from =='Hours' ? 'selected' : '' ?>>Hours</option>
														
														
													</select>
												</div>
												
											</div>
										</div>
										
									</div>
								</div>
								<div class="modal-footer">
									<a href="<?= site_url('store') ?>" class="btn btn-default pull-left" >Close</a>
									<button type="submit" class="btn btn-primary pull-left">Save changes</button>
								</div>
							</form>
							
						</div>
						
					</div>
					
				</div>
				
			</div>          
			<?php echo Modules::run('footer/footer/index'); ?>
			
			
			
		</div>
		
	</div>
	
	

	
	<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
	<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/form-select2/select2.min.js"></script>
	<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
	<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function(){
		
			
			$('#shop_city,#deliveryzips').select2({});
		});

	</script>
</body>
</html>