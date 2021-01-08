<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css" rel="stylesheet"> 
<?php echo Modules::run('sidebar/sidebar/merchant')  ?>

<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('store'); ?>">Store</a></li>
				<li class="active"><a href="">Edit Store</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2>Edit Store</h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					
						<div class="panel-body ">
							<form name="addstore" id="addstore" class="form-horizontal" action="<?php echo site_url('store/updatestore') ?>" method="post" enctype="multipart/form-data">
								
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
									<li class=""><a href="#tab-orders" data-toggle="tab">Orders</a></li>
									<li class=""><a href="#tab-menu" data-toggle="tab">Menu</a></li>
									<li class=""><a href="#tab-seo" data-toggle="tab">SEO</a></li>
									<li class=""><a href="#tab-notice" data-toggle="tab">Notice</a></li>
									<li class=""><a href="#tab-delivery" data-toggle="tab">Delivery</a></li>
									<li class=""><a href="#tab-ads" data-toggle="tab">Ads</a></li>
								</ul>
								<div class="pb"></div>
								

								<div class="tab-content">
									<div class="tab-pane active" id="tab-general">
										<div class="row">
											<div class="col-sm-2">
												 <ul class="nav nav-pills nav-stacked" id="address">
													<li class="active"><a href="#tab-store" data-toggle="tab" aria-expanded="true">General</a></li>
													<li class=""><a href="#tab-address" data-toggle="tab" aria-expanded="true">Address</a></li>
													 
												</ul>
											</div>
											<div class="col-md-10">
												<input type="hidden" value="<?= $store->store_info->store_id ?>" name="store_id" >
												<div class="tab-content">
													<div class="tab-pane active" id="tab-store">
														<div class="form-group ">
															<label class="col-sm-3 control-label">Store Name <span class="required">*</span></label>
															<div class="col-sm-8">
																<input type="text" name="store_name" value="<?= $store->store_info->store_name ?>" class="form-control" required>
															</div>
														</div>	
													
                                                                                                                <div class="form-group ">
															<label class="col-sm-3 control-label">Store Type  <span class="required">*</span></label>
															<div class="col-sm-8">
																<select name="store_type" id="store_type"  class="form-control" required> 
																	<option value="">None</option>
																	<?php foreach ($merchant_type as $m ): ?>
																		<option value="<?= $m->mt_id; ?>" <?= $m->mt_id == $store->store_info->store_type ? 'selected' :'' ?>><?= $m->type; ?></option>
																	<?php endforeach ?>
																</select>
															</div>
														</div>
														<?php if($store->store_info->store_type=='1'){ ?>
															<div id="restaurantdiv">
																<div class="form-group">
																	<label for="fieldurl" class="col-md-3 control-label">Select Cusine</label>
																	<div class="col-md-6">
																	<?php 
																	$stack = array();
																	foreach ($store->store_cuisine_data as $k) {
																		 $stack[] = $k->cuisine_id; 
																	} 
																	?>	

																		<select  name="multicusine[]" class="" id="multicusine" multiple>
																			<?php foreach ($cusine_data as $c ): ?>
																			<option value="<?= $c->cu_id; ?>" <?php if(in_array($c->cu_id,$stack )){ echo 'selected';} ?>><?= $c->cusine_type; ?>
																			</option>
																		<?php endforeach ?>
																		</select>
																	</div>
																</div>
															</div>
														
														<?php }else{ ?>
														<div id="restorentdiv" style="display:none">
															<div class="form-group">
																<label for="fieldurl" class="col-md-3 control-label">Select Cusine</label>
																<div class="col-md-6">	
																	<select  name="multicusine[]" class="" id="multicusine" multiple>
																		<?php foreach ($cusine_data as $c ): ?>
																		<option value="<?= $c->cu_id; ?>"><?= $c->cusine_type; ?></option>
																	<?php endforeach ?>
																	</select>
																</div>
															</div>
														</div>
														<?php } ?>
														<div class="form-group">
															<label class="col-md-3 control-label">Phone</label>
															<div class="col-sm-8">
																<input type="number" value="<?= $store->store_info->phone ?>" name="phone" class="form-control">
															</div>
														</div>
														<div class="form-group">
															<label class="col-md-3 control-label">Logo Upload </label>
															<div class="col-md-6">
																<input type="file" name="fileinput" class="form-contorl">
															</div>
														</div>

														<div class="form-group">
															<label class="col-md-3 control-label">Banner Upload</label>
															<div class="col-md-6">
																<input type="file" name="fileinput2" class="form-contorl">
															</div>
														</div>	
													</div>
													<div class="tab-pane" id="tab-address">
														<div class="form-group ">
															<label class="col-sm-3 control-label">Store Street</label>
															<div class="col-sm-8">
																<textarea type="text" name="store_street" class="form-control" required><?= trim($store->store_info->store_street) ?></textarea>
															</div>
														</div>

														<div class="form-group ">
															<label class="col-sm-3 control-label">Store City</label>
															<div class="col-sm-8">
																
																<select  name="store_city" id="storecity" class="" required >
																	<?php foreach ($city as $ct ): ?>
																	<option value="<?= $ct->city_id; ?>"  <?= $ct->city_id == $store->store_info->store_city ? 'selected' :'' ?> ><?= $ct->city_name.' '.$ct->state; ?></option>
																<?php endforeach ?>
																</select>

															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-3 control-label">Store Zipcode</label>
															<div class="col-sm-8">
																<input type="text" name="store_zip" value="<?= $store->store_info->store_zip ?>" required class="form-control">
															</div>
														</div>
														
	
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane"  id="tab-orders">
										<table class="table table-striped" >
											<thead>
												
												<th>Order Date</th>
												<th>Order No:</th>
												<th>Order Amount</th>
												<th>Order Status</th>
												<th>Order Comment</th>
												<th>Action</th>
											</thead>
											<tbody>
											<?php if (!$orders): ?>
											<tr>
												<td>No orders are placed</td>
											</tr>
											<?php else: ?>	
											
											<?php foreach ($orders as $order): ?>
												<tr>
													
													<td><?= date('d-m-Y',strtotime($order->created_on))  ?></td>
													<td><a href="<?= site_url('orders/view/'.$order->o_id.'') ?>"><?= $order->o_id ?></a></td>
													<td><?= $order->total;  ?></td>
													<td><?= $order->name ?></td>
													<td><?= $order->comment ?></td>
													<td>
														<a href="<?= site_url('orders/edit/'.$order->o_id.'') ?>" class="btn btn-primary">Edit</a>
													</td>
												</tr>
											<?php endforeach ?>
											<?php endif ?>	
											</tbody>
										</table>
									</div>
									<div class="tab-pane " id="tab-menu">
										
										<?php if ($store->store_info->store_type =='1' || $store->store_info->store_type =='4'): ?>
										<div id="categorywisepro">
											<div class="row column" data-widget-group="group-demo">
												<?php foreach ($category as $c): ?>
													
												<div class="pb"></div>
												<div class="col-md-12">
													<div class="pb"></div>
													<div class="panel panel-default"  data-widget='{"id" : "<?= $c->cat_id ?>"}'>
														<div class="panel-heading">
															<div class="pb"></div>
															<div class="panel-ctrls button-icon">
																<a href="#" class="pull-right ml mb-xs  btn btn-danger" onclick="deleteCategory('<?= $c->cat_id ?>','<?= $store->store_info->store_id; ?>')" ><i class="fa fa-trash"></i></a>
																<a href="#" class="pull-right ml mb-xs  btn btn-primary" onclick="editCategory('<?= $c->cat_id ?>')" ><i class="fa fa-edit"></i></a>
															</div>
															<h2><?= $c->category ?></h2>
																
														</div>

														
														<div class="panel-body" ondrop="drop(event)" ondragover="allowDrop(event)" >
															<?php 
																$products = $this->store->getProducts($c->cat_id);
															?>
															<ul class="list-group sortable-list"  id="list-<?= $c->cat_id?>" data-id ="<?= $c->cat_id?>" >
																<?php foreach ($products as $p): ?>
																<li class="list-group-item sortable-item"  draggable="true" ondragstart="drag(event)" id="<?= $p->product_id ?>"><?= $p->product_name; ?>
																	<a href="#" class="pull-right ml mb-xs  btn btn-danger" onclick="deleteProduct('<?= $p->product_id ?>','<?= $store->store_info->store_id; ?>')" ><i class="fa fa-trash"></i></a>
																	<a href="<?= site_url('store/editproduct/'.$p->product_id.'') ?>"  target="new" class="pull-right  ml mb-xs btn btn-primary"  ><i class="fa fa-edit"></i></a>
																	<br/>
																</li>	
																<?php endforeach ?>
															</ul>
															<a href="#" class="btn btn-primary pull-right" onclick="addproduct('<?= $c->cat_id ?>')">Add Product</a>
														</div>

													</div>
													
												</div>
												<?php endforeach ?>	
											</div>
											<button type="button" data-toggle="modal" href="#catgorymodal" class="btn btn-primary pull-right">Add Category</button>
										</div>	
										<?php else: ?>
										<div id="categorywisepro">
											<div class="row column pb" data-widget-group="group-demo">
												<?php foreach ($category as $c): ?> 
												<div class="col-md-12 pb ">
													<div class="panel panel-default"  data-widget='{"id" : "<?= $c->cat_id ?>"}'>
														<div class="panel-heading">
															<div class="pb"></div>
															<div class="panel-ctrls button-icon">
																<a href="#" class="pull-right ml mb-xs  btn btn-danger" onclick="deleteCategory('<?= $c->cat_id ?>','<?= $store->store_info->store_id; ?>')" ><i class="fa fa-trash"></i></a>
																<a href="#" class="pull-right ml mb-xs  btn btn-primary" onclick="editCategory('<?= $c->cat_id ?>')" ><i class="fa fa-edit"></i></a>
															</div>
															<h2><?= $c->category ?></h2>
														</div>
														
														<?php  $subcat = $this->store->getSubCategory($c->cat_id); ?>
														<div class="panel-body">
															<div class="row column pb" data-widget-group="group-demo">

																<?php foreach ($subcat as $sc): ?>
																<div class="col-md-12 pb">
																	<div class="panel panel-default">
																		<div class="panel-heading">
																			<div class="pb"></div>
																			<div class="panel-ctrls button-icon">
																				<a href="#" class="pull-right ml mb-xs  btn btn-danger" onclick="deleteCategory('<?= $sc->cat_id ?>','<?= $store->store_info->store_id; ?>')" ><i class="fa fa-trash"></i></a>
																				<a href="#" class="pull-right ml mb-xs  btn btn-primary" onclick="editCategory('<?= $sc->cat_id ?>')" ><i class="fa fa-edit"></i></a>
																			</div>
																			<h2><?= $sc->category ?></h2>
																		</div>
																		<div class="panel-body">

																			<?php 
																				$prod = $this->store->getProducts($sc->cat_id);
																			?>
																			<ul class="list-group sortable-list"  id="list-<?= $sc->cat_id?>" data-id ="<?= $sc->cat_id?>" >
																				<?php foreach ($prod as $p): ?>
																				<li class="list-group-item sortable-item"  draggable="true" ondragstart="drag(event)" id="<?= $p->product_id ?>"><?= $p->product_name; ?>
																					<a href="#" class="pull-right ml mb-xs  btn btn-danger" onclick="deleteProduct('<?= $p->product_id ?>','<?= $store->store_info->store_id; ?>')" ><i class="fa fa-trash"></i></a>
																					<a href="<?= site_url('store/editproduct/'.$p->product_id.'') ?>"  target="new" class="pull-right  ml mb-xs btn btn-primary"  ><i class="fa fa-edit"></i></a>
																					<br/>
																				</li>	
																				<?php endforeach ?>
																			</ul>
																			<a href="#" class="btn btn-primary pull-right" onclick="addproduct('<?= $sc->cat_id ?>')">Add Product</a>
																		
																		</div>
																	</div>
																</div>
																<?php endforeach; ?>
																
															</div>
														</div>
														<button type="button"  onclick="addsubcategory('<?= $c->cat_id ?>')" class="btn btn-primary pull-right">Add Sub-Category</button>
													</div>	

												</div>

												<?php endforeach ?>	
											</div>

											<button type="button" data-toggle="modal" href="#catgorymodal" class="btn btn-primary pull-right">Add Category</button>
											<br>
											<br>
										</div>
										<?php endif; ?>
									</div>
									<div class="tab-pane" id="tab-seo">
										<div class="form-group ">
											<label class="col-sm-3 control-label">Meta Title</label>
											<div class="col-sm-8">
												<input type="text" name="meta_title" value="<?= $store->store_info->meta_title ?>" class="form-control">
											</div>
										</div>
										<div class="form-group ">
											<label class="col-sm-3 control-label">Meta Keywords</label>
											<div class="col-sm-8">
												<textarea type="text" name="meta_keyword" class="form-control"><?= $store->store_info->meta_keyword ?></textarea>

											</div>
										</div>
										
										<div class="form-group ">
											<label class="col-sm-3 control-label">Meta Description</label>
											<div class="col-sm-8">
												<textarea type="text" name="meta_description" class="form-control"><?= $store->store_info->meta_description ?></textarea>
											</div>
										</div>

									</div>	
									<div class="tab-pane" id="tab-notice">
										<table class="table browsers m-n">
											<thead>
												
												<th>Notice</th>
												<th>Start Date</th>
												<th>End Date</th>
											 </thead>
											<tbody>
												
												<tr>
													
													<td><input type="text" value="<?= $store->store_info->notice ?>"  class="form-control" name="notice"></td>

													<td><input class="form-control date" name="notice_start_date"  value="<?= $store->store_info->notice_start_date =='1970-01-01' ? '' :date('d-m-Y',strtotime( $store->store_info->notice_start_date)) ?>"  ></td>
													<td><input class="form-control date" name="notice_end_date"  value="<?= $store->store_info->notice_end_date =='1970-01-01' ? '' :date('d-m-Y',strtotime( $store->store_info->notice_end_date)) ?>"></td>
													
												</tr>
												
												
											</tbody>
										</table>
									</div>
									
									<div class="tab-pane" id="tab-delivery">
										<div class="form-group ">
											<label class="col-sm-3 control-label">Delivery Zip Codes</label>
											<div class="col-sm-8">
												
												<?php $zip = $store->zipcode ?>
												<select id="deliveryzips" name="deliveryzips[]" multiple required>
													<?php foreach ($zipcode as $z ): ?>
														<option value="<?= $z->cz_id ?>" <?= in_array($z->cz_id,$zip) ? 'selected':'' ?>><?= $z->zipcode ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<div class="form-group ">
											<label class="col-sm-3 control-label">Delivery Type</label>
											<div class="col-sm-8">
												<select class="form-control" name="deliveryoption" id="pickupordelivery" required>
													<option value="">None</option>
													<option value="Delivery & Pickup" <?php echo $store->store_info->deliveryoption == 'Delivery & Pickup' ? 'selected' : ''  ?>>Delivery &amp; Pickup</option>
													<option value="Delivery only" <?php echo $store->store_info->deliveryoption == 'Delivery only' ? 'selected' : ''  ?>>Delivery only</option>
													<option value="Pick Up Only" <?php echo $store->store_info->deliveryoption == 'Pick Up Only' ? 'selected' : ''  ?>>Pick Up Only</option>
													
												</select>
											</div>
										</div>

										<div class="form-group ">
											<label class="col-sm-3 control-label">Free Delivery Minimum Order </label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="minorder" value="<?= $store->store_info->minorder ?>" >
											</div>
										</div>
										<!-- <div class="form-group ">
											<label class="col-sm-3 control-label">Delivery Fee</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="delivery_fee" value="<?= $store->store_info->delivery_fee ?>">
											</div>
										</div> -->
										<table id="businesshours" class="table table-bordered m" cellspacing="0">
											<thead>
												<tr>
													<th colspan="7">Select day(s):</th>
													<th colspan="2">Select times:</th>
												</tr>
												<tr>
													<th>S</th>
													<th>M</th>
													<th>T</th>
													<th>W</th>
													<th>T</th>
													<th>F</th>
													<th>S</th>
													<th>From</th>
													<th>To</th>
													
												</tr>
											</thead>
												<tr>
													<td><input type='checkbox' value="1"   name="sunday"  <?= $store->store_info->sunday  ? 'checked' : '' ?>></td>
													<td><input type='checkbox' value="1"  name="monday"  <?= $store->store_info->monday  ? 'checked' : '' ?>></td>
													<td><input type='checkbox' value="1" name="tuesday"  <?= $store->store_info->tuesday  ? 'checked' : '' ?>></td>
													<td><input type='checkbox' value="1" name="wednesday"  <?= $store->store_info->wednesday  ? 'checked' : '' ?>></td>
													<td><input type='checkbox' value="1" name="thursday"  <?= $store->store_info->thursday  ? 'checked' : '' ?>></td>
													<td><input type='checkbox' value="1" name="friday"  <?= $store->store_info->friday  ? 'checked' : '' ?>></td>
													<td><input type='checkbox' value="1" name="saturday"  <?= $store->store_info->saturday  ? 'checked' : '' ?>></td>
													<td><input type="text" class="form-control timepicker" required value="<?= date('g:i A',strtotime($store->store_info->time_from)); ?>" name="time_from" value=""></td>
													<td><input type="text" class="form-control timepicker" required value="<?= date('g:i A',strtotime($store->store_info->time_to)); ?>" name="time_to" value=""></td>
													
												</tr>
											</tbody>
										</table>

									</div>
									<div class="tab-pane" id="tab-ads">
										<div class="form-group ">
											<label class="col-sm-3 control-label">Select Package</label>
											<div class="col-sm-8">
												<select class="form-control" name="addpackge" id="addpackge">
													<option value="0">None</option>
													<?php foreach ($adspackage as $ad): ?>
														<option value="<?= $ad->asp_id ?>"><?= $ad->package_name.'-'.$ad->package_periods.' Months'.'( $'.$ad->package_price.')' ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<div class="form-group ">
											<label class="col-sm-3 control-label"></label>
											<div class="col-sm-8">
												<a href="" id="payment" class="btn btn-primary">Pay</a>
											</div>
										</div>

									</div>	
								</div>
								<div class="modal-footer">
									<a href="<?= site_url('store') ?>" class="btn btn-default" >Close</a>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
					</div>	
			</div>
			</div>
		</div>
		<!-- #page-content -->
	</div>
<?php echo Modules::run('footer/footer/index'); ?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Add Products</h2>
				</div>
				<form name="addprod" id="addprod" class="horizontal" action="<?php echo site_url('store/addproduct') ?>" method="post" >
					<div class="modal-body"	>
						<div class="pb"></div> 
						<div class="form-group">
							<input type="hidden" id="cat_id" name="category_id" value="">
							<input type="hidden" id="store_id" name="store_id" value="<?= $store->store_info->store_id; ?>">
							<input type="hidden" id="merchant_id" name="merchant_id" value="<?= $store->store_info->merchant_id; ?>">
							
							<label class="col-sm-4 control-label">Product Name <span class="required">*</span></label>
							<div class="col-sm-8">
								<input type="text" name="product_name" value="" class="form-control" required>
							</div>
						</div>
						<br>
			                         
						<div class="form-group ">
							<label class="col-sm-4 control-label">Small Product Description </label>
							<div class="col-sm-8">
								<input type="text" name="small_product_description" value="<?= set_value('product_description') ?>" class="form-control">
							</div>
						</div>
						<br>
						
						<div class="form-group ">
							<label class="col-sm-4 control-label">Product Price <span class="required">*</span></label>
							<div class="col-sm-8">
								<input type="text" name="price" value="<?= set_value('price') ?>" class="form-control" required>
							</div>
						</div>
						<div class="pb"></div> 
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" id="prosubmit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="catgorymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Add Category</h2>
				</div>
				<form name="addcategory" id="addcategory" class="horizontal" action="<?php echo site_url('store/addcategory') ?>" method="post" >
					<div class="modal-body"	>
						<div class="pb"></div> 
						<div class="form-group">
							<input type="hidden" id="store_id2" name="store_id" value="<?= $store->store_info->store_id; ?>">
							<input type="hidden" id="merchant_id" name="merchant_id" value="<?= $store->store_info->merchant_id; ?>">
							
							<label class="col-sm-4 control-label">Category Name <span class="required">*</span></label>
							<div class="col-sm-8">
								<input type="text" name="category_name" id="category_name" value="" class="form-control" required>
							</div>
						</div>
						<br>
						<div class="form-group ">
							<label class="col-sm-4 control-label">Category Status <span class="required">*</span></label>
							<div class="col-sm-8">
								<select name="category_status"  id="category_status" class="form-control" required> 
									<option value="">None</option>
									<option value="1">Enabled</option>
									<option value="0">Disabled</option>
								</select>
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" id="catsubmit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="editcatgorymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Edit Category</h2>
				</div>
				<form name="updatecategory" id="updatecategory" class="horizontal" action="<?php echo site_url('store/updatecategory') ?>" method="post" >
					<div class="modal-body"	>
						<div class="pb"></div> 
						<div class="form-group">
							<input type="hidden" id="store_id2" name="store_id" value="<?= $store->store_info->store_id; ?>">
							<input type="hidden" id="edit_category_id" name="edit_category_id" value="">
								
							<label class="col-sm-4 control-label">Category Name <span class="required">*</span></label>
							<div class="col-sm-8">
								<input type="text" name="edit_category_name" id="edit_category_name" class="form-control" required>
							</div>
						</div>
						<br>
						<div class="form-group ">
							<label class="col-sm-4 control-label">Category Status <span class="required">*</span></label>
							<div class="col-sm-8">
								<select name="edit_category_status"  id="edit_category_status" class="form-control" required> 
									<option value="">None</option>
									<option value="1">Enabled</option>
									<option value="0">Disabled</option>
								</select>
							</div>
						</div>
						<br>

						<div class="form-group">
							
							<label class="col-sm-4 control-label">Discount(in %)</label>
							<div class="col-sm-8">
								<input type="text" name="cat_discount" id="cat_discount" value="" class="form-control" >
							</div>
						</div>
						<br>
						<div class="form-group">
						<label class="col-sm-4 control-label">Discount Date</label>
						<div class="col-sm-8">
							<div class="input-daterange input-group" id="datepicker">
								<input type="text" class="form-control" value="" name="cat_dis_start_date" id="cat_dis_start_date">
								<span class="input-group-addon">to</span>
								<input type="text" class="form-control" value="" name="cat_dis_end_date" id="cat_dis_end_date">
							</div>
						</div>

						</div>
						<br>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" id="updatecatsubmit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-validation/jquery.validate.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.min.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script> 
<script type="text/javascript">
	$('#addstore').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		rules: {
			status: { required: true },
			merchant_id: { required: true },
			
		},
		ignore: ".ignore",
	    invalidHandler: function(e, validator){
	        if(validator.errorList.length)
	        $('.nav-tabs a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show');
	    }
	});

		     
	$(document).ready(function(){
		$('#multicusine').select2({ maximumSelectionLength: 2});
			
			$('#storecity,#deliveryzips').select2({});
		});

		$('#store_type').change(function(){
			if($(this).val()==1){
				$('#restorentdiv').show();

			}else{
				$('#restorentdiv').hide();
			}
		});
		$('.date,#datepicker').datepicker({});
		
		$('.timepicker').timepicker({
		});
</script>

<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/wijets/wijets.js"></script>
<script type="text/javascript">
$.wijets.make();
$('.date').datepicker({});
</script>
<!-- Script start for menu -->
<script type="text/javascript">
	function addproduct(cat_id){
		$('#myModal').modal('show');
		$('#cat_id').val(cat_id);
	}

	function editProduct(product_id){
		$('#myeditProduct').modal('show');
		$('#product_id').val(product_id);
	}
	function deleteProduct(product_id,store_id){

		var data = {
			store_id : store_id,
			product_id :product_id
		}
		alertify.confirm("Are you sure you want to Delete this products ?", function (result) {
		    if (result) {
				$.ajax({
					url :" <?= site_url('store/deleteproduct'); ?>",
					type: "post",
					data:data,
					success:function(data){
						$('#categorywisepro').html(data);
			            Utility.animateContent();
			           
					}
				});
   
		    } else {
		       //alert();
		    }
		});


	}
	function deleteCategory(category_id,store_id){

		var data = {
			store_id : store_id,
			category_id :category_id
		}
			alertify.confirm("Are you sure you want to Delete this Category and Products ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('store/deletecategory'); ?>",
						type: "post",
						data:data,
						success:function(data){
						 $('#categorywisepro').html(data);
				   			Utility.animateContent();
						}
					});
       
			    } else {
			       
			    }
			});


	}
	
	function editCategory(category_id){
		$('#editcatgorymodal').modal('show');
		data ={
			category_id : category_id
		}
		$.ajax({
	        type: "POST",
	        url: '<?= site_url("store/getcategorydata") ?>',
	        data: data,
	        cache: false,
	        dataType: "json",
	        success: function(data) {
	        	$('#edit_category_id').val(data.cat_id);
	            $('#edit_category_name').val(data.category);
	            $('#edit_category_status').val(data.status);
	            
	           if (data.discount !='0.00') {
	            	$('#cat_discount').val(data.discount);
	            };
	            if(data.start_time != '1970-01-01'){
	            	 $('#cat_dis_start_date').val(data.start_time);
	            };
	           	if (data.end_time != '1970-01-01') {
	           		 $('#cat_dis_end_date').val(data.end_time);
	           	};

	        }
	    })
	}
	$('#addprod').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		rules: {
			status: { required: true },
			merchant_id: { required: true },
			
		}
		
	});
	$('#addcategory').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		
	});
	$('#prosubmit').click(function(){
		var form = $('#addprod');
		validator = $( "#addprod" ).validate();
		var a = validator.form();
		if (a) {
			$.ajax({
		        type: "POST",
		        url: form.attr( 'action' ),
		        data: form.serialize(),
		        cache: false,
		        success: function(data) {
		            $('#categorywisepro').html(data);
		 			$('#myModal').modal('toggle');
		            Utility.animateContent();
		            document.getElementById('addprod').reset();
		        }
		    })
		}
	});

	$('#catsubmit').click(function(){

		validator = $( "#addcategory" ).validate();
		var a = validator.form();
		var form = $('#addcategory');
		if (a) {
		$.ajax({
	        type: "POST",
	        url: form.attr( 'action' ),
	        data: form.serialize(),
	        cache: false,
	        success: function(data) {
	            $('#categorywisepro').html(data);
	 			$('#catgorymodal').modal('toggle');
	            Utility.animateContent();
	            document.getElementById('addcategory').reset();
	        }
	    })
	    } else{};
	});
	
	$('#updatecatsubmit').click(function(){

		validator = $( "#updatecategory" ).validate();
		var a = validator.form();
		var form = $('#updatecategory');
		if (a) {
		$.ajax({
	        type: "POST",
	        url: form.attr( 'action' ),
	        data: form.serialize(),
	        cache: false,
	        success: function(data) {
	            $('#categorywisepro').html(data);
	 			$('#editcatgorymodal').modal('toggle');
	            Utility.animateContent();
	            document.getElementById('updatecategory').reset();
	        }
	    })
	    } else{};
	});
	$('#addoptiongroup').click(function(){
		$(this).hide();
		var id = $(this).data('id');

	});
</script>
<script type="text/javascript">
	$('#addpackge').change(function(){
		var data = {
			addpackge_id : $(this).val(),
			store_id:'<?= $store->store_info->store_id; ?>'
		}
		$.ajax({
	        type: "POST",
	        url: '<?= site_url("store/setAddPackageOrder"); ?>',
	        data:data,
	        cache: false,
	        dataType: 'json',
	        success: function(data) {
	        	
	        	if(data.addpackge_id){
	        		$('#payment').attr("href", "<?= site_url('adsorder') ?>");
	        	}else{
	        		$('#payment').attr("href", "#");
	        	}
	        }
	    })
	});

</script>
</body>
</html>
