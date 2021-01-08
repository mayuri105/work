
<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css" rel="stylesheet"> 

<?php echo  Modules::run('sidebar/sidebar/index')  ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php echo site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('orders') ?>">Order</a></li>
				<li class="active"><a href="">Edit Order</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2>Edit Order</h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				
				<div class="mt-xl"></div> 
				
				<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-list"></i> Orders</h3>
						</div>
						<div class="panel-body">
							
							<br>
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-order" data-toggle="tab">Order Details</a></li>
								<li><a href="#tab-payment" data-toggle="tab">Payment Details</a></li>
								<li><a href="#tab-shipping" data-toggle="tab">Delivery  Details</a></li>

								
								<li><a href="#tab-product"  data-toggle="tab">Products</a></li>

							</ul>
							<div class="tab-content">

								<div class="tab-pane active" id="tab-order">
									<form id="order" action="<?= site_url('orders/updateorderData') ?>" method="post" name="ordersave">
									<div class="pt"></div>

									<table class="table table-bordered">
										
										<tbody>
											
											<tr>
												<input type="hidden" value="<?= $orders->order->o_id; ?>" name="order_id">
												
											<td>Customer Firstname:</td>
											<td>	
												<select id="customer_id" name="customer_id">
					                            	<option></option>
					                            	<?php foreach ($customer as $c ): ?>
					                            		<option value="<?= $c->c_id ?>" <?= $orders->order->c_id == $c->c_id ? 'selected' :'' ?> ><?= $c->first_name . ' ' .$c->last_name; ?></option>
					                            	<?php endforeach ?>
					                            </select>
											</td>
											</tr>
											
											
										   	<tr>
												<td>Order Status:</td>
												<td>
													<select name="order_status" class="form-control">
														<?php foreach ($order_status as $k): ?>
															<option value="<?= $k->order_status_id; ?>" <?= $k->order_status_id ==$orders->order->order_status ? 'selected' :'' ?>><?= $k->name; ?></option>
														<?php endforeach ?>
													</select>
												</td>
											</tr>
											<tr>
												<td>Payment Method:</td>
												<td>
													<select name="payment_method" class="form-control">
														<option value="paying-cash" <?= 'paying-cash' ==$orders->order->payment_method ? 'selected' :'' ?>>Cash</option>
														<option value="credit-and-other" <?= 'credit-and-other' ==$orders->order->payment_method ? 'selected' :'' ?>>Credit &amp; Other</option>
														<option value="paying-paypal" <?= 'paying-paypal' ==$orders->order->payment_method ? 'selected' :'' ?>>Paypal</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>Delivery And Pick Up:</td>
												<td>
													<select name="delivery_option" class="form-control">
														<option value="delivery"  <?= 'delivery' ==$orders->order->delivery_option ? 'selected' :'' ?>>Delivery</option>
														<option value="pick-up"  <?= 'pick-up' ==$orders->order->delivery_option ? 'selected' :'' ?>>Pick Up</option>
													</select>
												</td>
											</tr>

											<tr>
												<td> Date and Time:</td>
												<td><input type="text" value="<?= $orders->order->delivery_or_pic_datetime ?>" name="delivery_or_pic_datetime" id="datetimepicker" class="form-control"></td>
											</tr>
											<tr>
												<td>Special Instruction:</td>
												<td><input type="text" value="<?= $orders->order->special_inst ?>" name="special_inst" class="form-control"></td>
											</tr>
										</tbody>
										<tfoot>
										<tr>
											<td></td>
											<td>
												<input type="submit" value="Save" class="btn btn-primary" >
											</td>
										</tr>
										</tfoot>
									</table>
									</form>
								</div>
								<div class="tab-pane" id="tab-payment">
									<form id="order" action="<?= site_url('orders/paymentupdateAddressData') ?>" method="post" name="ordersave">

									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>Select Address</td>
												<td>
													<select name="address_select" data-name='payment' id="pay_address_select"  class="address_select form-control">
														<option></option>

													</select>
												</td>
											</tr>
											<tr>
												<input type="hidden" value="<?= $orders->order->o_id; ?>" name="order_id">
												
												<td>Street Address :</td>
												<td>
													<input type="text" value="<?= $orders->order->payment_address ?>" name="payment_address" id="payment_address" class="form-control">
												</td>
											</tr>
											<tr>
												<td>Apt name</td>
												<td>
													
													<input type="text" value="<?= $orders->order->payment_apt_name ?>" name="payment_apt_name" id="payment_apt_name" class="form-control">
												</td>
											</tr>
											<tr>
												<td>City:</td>
												<td><input type="text" value="<?= $orders->order->payment_city ?>" name="payment_city" id="payment_city" class="form-control"></td>
											</tr>
											<tr>
												<td>Postcode:</td>
												<td><input type="text" value="<?= $orders->order->payment_zip ?>" name="payment_zip" id="payment_zip" class="form-control"></td>
											</tr>
											<tr>
												<td>Region / State:</td>
												<td>
													<select name="payment_state"  id="payment_state" class="form-control">
													<?php foreach ($state as $st): ?>
														<option value="<?= $st->code ?>" <?= $orders->order->payment_state ? 'selected' :'' ?>><?= $st->name ?></option>
													<?php endforeach ?>
													</select>
												</td>
											</tr>
											
										</tbody>
										<tfoot>
										<tr>
											<td></td>
											<td>
												<input type="submit" value="Save" class="btn btn-primary" >
											</td>
										</tr>
										</tfoot>
									</table>
									</form>
								</div>
								<div class="tab-pane" id="tab-shipping">
									<form id="order" action="<?= site_url('orders/shippingupdateAddressData') ?>" method="post" name="ordersave">

									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>Select Address</td>
												<td>
													<select name="address_select" data-name='shipping' id="shiping_address_select" class="address_select form-control">
														<option></option>

													</select>
												</td>
											</tr>
											<tr>
												<input type="hidden" value="<?= $orders->order->o_id; ?>" name="order_id">
												
												<td>Street Address 1:</td>
												<td>
													<input type="text" value="<?= $orders->order->shipping_address ?>" name="shipping_address" id="shipping_address" class="form-control">
												</td>
											</tr>
											<tr>
												<td>Apt name</td>
												<td>
													
													<input type="text" value="<?= $orders->order->shipping_apt_name ?>" name="shipping_apt_name" id="shipping_apt_name"  class="form-control">
												</td>
											</tr>
											<tr>
												<td>City:</td>
												<td><input type="text" value="<?= $orders->order->shipping_city ?>" name="shipping_city" id="shipping_city" class="form-control"></td>
											</tr>
											<tr>
												<td>Postcode:</td>
												<td><input type="text" value="<?= $orders->order->shipping_zip ?>" name="shipping_zip" id="shipping_zip" class="form-control"></td>
											</tr>
											<tr>
												<td>Region / State:</td>
												<td>
													<select name="shipping_state" id="shipping_zip" class="form-control">
													<?php foreach ($state as $st): ?>
														<option value="<?= $st->code ?>" <?= $orders->order->shipping_state ? 'selected' :'' ?>><?= $st->name ?></option>
													<?php endforeach ?>
													</select>
												</td>
											</tr>
											
										<tfoot>
										<tr>
											<td></td>
											<td>
												<input type="submit" value="Save" class="btn btn-primary" >
											</td>
										</tr>
										</tfoot>
									</table>
									</form>
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
														<td></td>
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
															<td><a data-href ="<?php echo site_url('orders/deleteitemandvalue/'.$item->oi_id.'/'.$item->s_id.'') ?>" class="del btn btn-danger" >Delete</a></td>
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
															<td colspan="4" class="text-right">Sub-Total:</td>
															<td class="text-right">$<?=$total; ?></td>
														</tr>
														<tr>
															<td colspan="4" class="text-right">Tip (in %):<?= $orders->order->tip_amount  ?></td>
															<td class="text-right">$<?= $tip = ($total * $orders->order->tip_amount )/100; ?></td>
														</tr>
														
														<tr>
															<td colspan="4" class="text-right">Total:</td>
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
															<td class="text-right">$<?= $mainTotal-$orders->order_coupon->discount ?></td>
														<?php else: ?>
															<td class="text-right">$<?= $mainTotal  ?></td>
														<?php endif; ?>
													</tr>	
													</tbody>
												</table>

											</li>
											

										</ul>
									</div>
									<fieldset>

					                    <legend>Add Product(s)</legend>
					                    <div class="form-group">
					                      <label class="col-sm-2 control-label" for="input-product">Store Select</label>
						                      <div class="col-sm-10">
						                        	<select class="form-control" name="store" id="store">
						                        		<option>None</option>
						                        		<?php foreach ($store as $st): ?>
						                        			<option value="<?= $st->store_id ?>" data-name="<?= $st->store_name; ?>" ><?= $st->store_name; ?></option>
						                        		<?php endforeach ?>
													</select>
						                       </div>
					                    </div>
					                    <div class="pb"></div>
					                    <div class="form-group">
					                      <label class="col-sm-2 control-label" for="input-product">Choose Product</label>
						                      <div class="col-sm-10">
						                        	<!-- <input type="text" name="product" value="" id="input-product" class="form-control" autocomplete="off">
						                        	 -->
						                        	 <div>
						                        		<ul id="showproduct" class="list-group">
						                        			
						                        		</ul>
						                        	</div>
						                        	
						                      </div>
					                    </div>
					                    <div class="pb"></div>
					                    
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Add Product</h2>
				</div>
				<div class="dataforoption">
				</div>
				
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-validation/jquery.validate.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.min.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 
<script type="text/javascript">
$('#store').change(function(){
		var store_id = $(this).val();
		var order_id = '<?php echo $orders->order->o_id ?>';
		var store_name = $('#store option:selected').attr('data-name');
		
	  $.ajax({
            type: "POST",
            url: "<?php echo site_url('orders/getproducts') ?>",
            data: 'store_id='+store_id,
            cache: false,
            dataType: "json",
            success: function(data) {
            	$('#showproduct').html('');
            	for (var i = 0; i < data.length; i++) {
            		$('#showproduct').append('<li class="list-group-item" ><a  onclick="showdata('+data[i].product_id+','+order_id+','+store_id+',\'' + store_name + '\')" >'+data[i].product_name+'</a></li>');
            	};
            	

            }
        })

});


	function showdata(product_id,order_id,store_id,store_name){
		data ={
			product_id : product_id,
		}
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('orders/getProductData') ?>",
			data: data,
			beforeSend: function(){
			},
			success: function(data){
				$('#myModal').modal('show') 
				$('.dataforoption').html(data);
				$('.dataforoption form').append('<input type="hidden" value="'+order_id+'" name="order_id" id="order_id">');
				$('.dataforoption form').append('<input type="hidden" value="'+store_id+'" name="store_id" id="store_id">');
				$('.dataforoption form').append('<input type="hidden" value="'+store_name+'" name="store_name" id="store_name">');
			}
		})
	}
	$('#datetimepicker').datetimepicker({
		format: 'yyyy-mm-dd HH:ii P',
		showMeridian: true,
        autoclose: true,
        todayBtn: true
	});
	$('.del').click(function(event){
			var url = $(this).data("href")
        	var $tr = $(this).closest('tr');
			alertify.confirm("Are you sure you want to Delete this product ?", function (result) {
			    if (result) {
					$.ajax({
						url : url,
						type: "GET",
						success:function(data){
							window.location.reload(); 
						}
					});
       
			    } else {
			      
			    }
			});
		});

$(function(){
		$('#customer_id,#products').select2({});

		$('#customer_id').change(function(){
			var data = {
				id : $(this).val()
			};
			$.ajax({
				url : "<?php echo site_url('orders/getCustAddress') ?>",
				type: "POST",
				dataType: "json",
				data: data,
				success:function(data){
					html = '<option value="">--none--</option>';
					if ( data.length) {
						for (i = 0; i < data.length; i++) {
							html += '<option value="' + data[i]['address_id'] + '"';
							html += '>' + data[i]['apt_name'] + ','+ data[i]['city'] +'</option>';
						}
					} 
					$('#pay_address_select').html(html);
					$('#shiping_address_select').html(html);
					
				}	
			});
		});

		$('.address_select').change(function(){
			name = $(this).data('name')
			var data = {
				id : $(this).val()
			};
			$.ajax({
				url : "<?php echo site_url('orders/getAddressdetails') ?>",
				type: "POST",
				dataType: "json",
				data: data,
				success:function(data){
					$('#'+name+'_address').val(data.street_address);
					$('#'+name+'_apt_name').val(data.apt_name);
					$('#'+name+'_city').val(data.city);
					$('#'+name+'_state').val(data.state);
					$('#'+name+'_zip').val(data.zip);
					loadstore();
				}	
			});
		});
		$('#datetimepicker').datetimepicker();
		

	});
</script>
</body>
</html>
