
<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css" rel="stylesheet"> 

<?php echo $this->session->userdata('is_admin') ?  Modules::run('sidebar/sidebar/index') : Modules::run('sidebar/sidebar/merchant')  ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('index'); ?>">Home</a></li>
				<li><a href="<?php echo site_url('orders'); ?>">Order</a></li>
				<li class="active"><a href="">View Order</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2>View Order</h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-list"></i> Orders</h3>
						</div>
						<div class="panel-body">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-order" data-toggle="tab">Order Details</a></li>
								<li><a href="#tab-payment" data-toggle="tab">Payment Details</a></li>
								<li><a href="#tab-shipping" data-toggle="tab">Shipping Details</a></li>
								<li><a href="#tab-product" data-toggle="tab">Products</a></li>
								<li><a href="#tab-history" data-toggle="tab">History</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab-order">
									<table class="table table-bordered">
										
										<tbody>
											<tr>
												<td>Order ID:</td>
												<td>#<?= $orders->order->o_id; ?></td>
											</tr>
											<tr>
												<td>Invoice No.:</td>
												<td id="invoicegenerated">
													<?php if ($orders->order->invoice_no): 
														echo $orders->order->invoice_prefix.$orders->order->invoice_no;
													else: ?>
													<button id="button-invoice" class="btn btn-success btn-xs">
														<i class="fa fa-cog"></i> 
														Generate
													</button>
													<?php endif; ?>

												</td>
											</tr>
											
											<tr>
												<td>Customer:</td>
												<td><?= $orders->order->first_name.' '.$orders->order->last_name ?></td>
											</tr>
											
											<tr>
												<td>E-Mail:</td>
												<td><a href="mailto:<?= $orders->order->email ?>"><?= $orders->order->email ?></a></td>
											</tr>
											<tr>
												<td>Telephone:</td>
												<td><?= $orders->order->phone_no ?></td>
											</tr>
											<tr>
												<td>Total:</td>
												<td>$<?= $orders->order->total_amt ?> </td>
											</tr>
											<tr>
												<td>Order Status:</td>
												<td id="order-status"><?= $orders->order->name ? $orders->order->name : 'None'  ?></td>
											</tr>
											<tr>
												<td>Option:</td>
												<td id="order-status"><?= ucfirst($orders->order->delivery_option) ?></td>
											</tr>
											<tr>
												<td>Delivery Date &amp; time:</td>
												<td id="order-status"><?= date('d-m-y h:i a',strtotime($orders->order->delivery_or_pic_datetime)) ?></td>
											</tr>
											
											<tr>
												<td>Date Added:</td>
												<td><?= date('d-m-y g:i:a',strtotime($orders->order->created_on)) ?></td>
											</tr>
										   
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tab-payment">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>First Name:</td>
												<td><?= $orders->order->first_name ?></td>
											</tr>
											<tr>
												<td>Last Name:</td>
												<td><?= $orders->order->last_name ?></td>
											</tr>
											<tr>
												<td>Address 1:</td>
												<td><?= $orders->order->street_address.','.$orders->order->apt_name ?></td>
											</tr>
											<tr>
												<td>City:</td>
												<td><?= $orders->order->city ?></td>
											</tr>
											<tr>
												<td>Postcode:</td>
												<td><?= $orders->order->zip  ?></td>
											</tr>
											<tr>
												<td>Region / State:</td>
												<td><?= $orders->order->state  ?></td>
											</tr>
											
											<tr>
												<td>Country:</td>
												<td>USA</td>
											</tr>
											<tr>
												<td>Payment Method:</td>
												<td><?= str_replace('paying-','', $orders->order->payment_method) ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tab-shipping">
								   <table class="table table-bordered">
										<tbody>
											<tr>
												<td>First Name:</td>
												<td><?= $orders->order->first_name ?></td>
											</tr>
											<tr>
												<td>Last Name:</td>
												<td><?= $orders->order->last_name ?></td>
											</tr>
											<tr>
												<td>Address 1:</td>
												<td><?= $orders->order->street_address.','.$orders->order->apt_name ?></td>
											</tr>
											<tr>
												<td>City:</td>
												<td><?= $orders->order->city ?></td>
											</tr>
											<tr>
												<td>Postcode:</td>
												<td><?= $orders->order->zip  ?></td>
											</tr>
											<tr>
												<td>Region / State:</td>
												<td><?= $orders->order->state  ?></td>
											</tr>
											
											
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tab-product">
									<div class="store-product">
										<ul class="list-group">

											<?php $mainTotal = 0; foreach ($orders->order_store as $oskey ): ?>
											<li  class="list-group-item">
											<h4><?= ucfirst($oskey->store_name); ?></h4>
											<?php $order_item = $this->order->getOrderItemByStore($oskey->so_id) ?>
											<table class="table table-bordered">
												<thead>
													<tr>
														<td class="text-left">Product</td>
														<td class="text-right">Quantity</td>
														<td class="text-right">Unit Price</td>
														<td class="text-right">Total</td>
													</tr>
												</thead>

												<tbody>
													<?php $total=0; 
													foreach ($order_item as $item): ?>
														<tr>
															<td class="text-left"><a href=""><?= $item->product_name ?></a>
																<br> 
																<?php $getOptionValue = $this->order->getOptionval($item->oi_id) ?>
																<?php if ($getOptionValue): ?>
																	<table>
																	<?php
																		foreach($getOptionValue as $option): ?>
																				<tr>
																					<td><?= $option->option_name.'--'.$option->option_value ?></td>
																				</tr>
																			
																		<?php endforeach; 
																	 ?>
																	</table>
																<?php endif ?>
																
															</td>
															
															<td class="text-right"><?= $item->pro_quantity ?></td>
															<td class="text-right">
																$<?= $item->product_price ?>
																<br>
																
																	<?php $tot=0;
																		foreach($getOptionValue as $option): ?>
																				<table>
																				<tr>
																					<?= $option->price;
																					$tot += $option->price; ?>
																				</tr>
																				</table>
																		<?php endforeach; 
																	 ?>
																	
																<hr>
															   	Total Price: $<?= $totalUnitPrice = $tot + $item->product_price;    ?>
															</td>
															<td class="text-right">$<?= $price = $item->pro_quantity * $totalUnitPrice ?></td>
														</tr>

														<?php $total += $price  ?>
														<?php endforeach ?>
														<tr>
															<td colspan="3" class="text-right">Sub-Total:</td>
															<td class="text-right">$<?=$total; ?></td>
														</tr>
														<tr>
															<td colspan="3" class="text-right">Tip (in %):<?= $orders->order->tip_amount  ?></td>
															<td class="text-right">$<?= $tip = ($total * $orders->order->tip_amount )/100; ?></td>
														</tr>
														
														<tr>
															<td colspan="3" class="text-right">Total:</td>
																<?php $mainTotal = $mainTotal + ($tip+$total) ?>
																<td class="text-right">$<?=  $tip+$total; ?></td>
															
														</tr>

												</tbody>
											</table>

											</li>
											<?php endforeach ?>
											<li class="list-group-item">
												<table class="table table-bordered">
													<tbody>
													<tr>
														<td colspan="3" width="80%" class="text-right"> Total:</td>

														<td class="text-right" width="20%">$<?= $mainTotal; ?></td>
														
													</tr>
													
													<?php if ($orders->order_coupon): ?>
													<tr>
														<td colspan="3" class="text-right">Coupon:</td>
														<td class="text-right">-$<?= $orders->order_coupon->discount ?></td>
													</tr>
													<?php endif ?>
													
													<tr>
														<td colspan="3" class="text-right">Main Total:</td>
														<?php if ($orders->order_coupon): ?>
															<td class="text-right">$<?= $mainTotal-$orders->order_coupon->discount  ?></td>
														<?php else: ?>
															<td class="text-right">$<?= $mainTotal  ?></td>
														<?php endif; ?>
													</tr>	
													</tbody>
												</table>
											</li>

										</ul>
									</div>
								</div>
								<div class="tab-pane" id="tab-history">
									<div id="history">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Store Name </th>
													<th class="text-left">Date Added</th>
													<th class="text-left">Comment</th>
													<th class="text-left">Status</th>
													<th class="text-left">Customer Notified</th>
												</tr>
											</thead>

											<tbody>
												<?php foreach ($order_history as $oh ): ?>
													
												
												<tr>
												<td><?= $oh->store_name; ?></td>
												<td class="text-left"><?= date('d-m-Y',strtotime($oh->date_added)) ?></td>
												<td class="text-left"><?= $oh->comment; ?></td>
												<td class="text-left"><?= $oh->name; ?></td>
												<td class="text-left"><?= $oh->customer_notify ? 'Yes' : 'No' ?></td>
												</tr>
												<?php endforeach ?>
											</tbody>	
										</table>
										
									</div>
									<br>
									<fieldset>
										<legend>Add Order History</legend>
										<form class="form-horizontal" action="<?= site_url('orders/addorderhistroy') ?>" method="post">
											<div class="form-group">
												<input type="hidden" value="<?= $orders->order->o_id; ?>" name="order_id" id="order_id">
												<label class="col-sm-2 control-label" for="input-order-status">Order Status</label>
												<div class="col-sm-10">
													<select name="order_status_id" id="input-order-status" class="form-control">
														<?php foreach ($order_status as $os): ?>
															<option value="<?= $os->order_status_id ?>"><?= $os->name; ?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												
												<label class="col-sm-2 control-label" for="input-order-status">Store Name</label>
												<div class="col-sm-10">
													<select name="sub_order_id" id="input-order-status" class="form-control">
														<?php foreach ($orders->order_store as $os): ?>
															<option value="<?= $os->so_id ?>"><?= $os->store_name; ?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" for="input-notify">Notify Customer</label>
												<div class="col-sm-10">
													<input type="checkbox" name="notify" value="1" id="input-notify">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" for="input-comment">Comment</label>
												<div class="col-sm-10">
													<textarea name="comment" rows="8" id="input-comment" class="form-control"></textarea>
												</div>
											</div>
											<div class="text-right">
												<button id="button-history" type="submit" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add History</button>
											</div>
										</form>
										
									</fieldset>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- #page-content -->
	</div>
			   
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
	$('#button-invoice').click(function(){

		var data = {
			order_id : '<?= $orders->order->o_id; ?>'
		}
		$.ajax({
			url : "<?php echo site_url('orders/generate_invoice') ?>",
			type: "POST",
			dataType: 'json',
			data:data,
			success:function(data){
				$('#button-invoice').hide();
				$('#invoicegenerated').html(data.invoice_no);
			}
		});
	});
</script>
</body>
</html>
