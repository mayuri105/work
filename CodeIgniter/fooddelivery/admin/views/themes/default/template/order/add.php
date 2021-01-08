
<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css" rel="stylesheet"> 

<?php echo $this->session->userdata('is_admin') ?  Modules::run('sidebar/sidebar/index') : Modules::run('sidebar/sidebar/merchant')  ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php echo site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('orders') ?>">Order</a></li>
				<li class="active"><a href="">Add Order</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2>Add Order</h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				
				<div class="mt-xl"></div> 
				
				<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-list"></i> Orders</h3>
						</div>
						 <form class="form-horizontal"  name="addorder" method="post"  action="<?= site_url('orders/addorder') ?>">
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
										<div class="pb"></div>
										<div class="form-group">
					                        <label class="col-sm-2 control-label" for="input-customer">Customer</label>
					                        <div class="col-sm-10">
					                            <select id="customer_id" name="customer_id">
					                            	<option></option>
					                            	<?php foreach ($customer as $c ): ?>
					                            		<option value="<?= $c->c_id ?>"><?= $c->first_name . ' ' .$c->last_name; ?></option>
					                            	<?php endforeach ?>
					                            </select>
					                        </div>
					                    </div>
					                    
					                    <div class="form-group required">
				                            <label class="col-sm-2 control-label" for="input-payment-method">Payment Method</label>
				                            <div class="col-sm-10">
				                                <div class="input-group">
				                                    <select name="payment_method" id="input-payment-method" class="form-control">	<option value=""> --- Please Select --- </option>
				                                    	<option value="paying-cash">Cash on Delivery</option>
				                                    </select>
				                                    
				                  				</div>
				                            </div>
				                        </div>
				                       
				                        
				                        <div class="form-group">
				                            <label class="col-sm-2 control-label" for="input-order-status">Order Status</label>
				                            <div class="col-sm-10">
				                                <select name="order_status" id="input-order-status" class="form-control">
				                            		 <?php foreach ($order_status as $os): ?>
				                            		 		<option value="<?= $os->order_status_id ?>"><?= $os->name ?></option>	
				                            		 <?php endforeach ?>
				                                </select>
				                               
				                            </div>
				                        </div>

				                        <div class="form-group">
				                            <label class="col-sm-2 control-label" for="input-order-status">Delivery Option</label>
				                            <div class="col-sm-10">
				                                <select name="delivery_option" id="delivery_option" class="form-control">
				                            		<option value="delivery">Delivery</option> 
				                            		<option value="pickup">Pick Up</option>
				                                </select>
				                               
				                            </div>
				                        </div>

				                         <div class="form-group">
				                            <label class="col-sm-2 control-label" for="input-Date-Time">Date &amp; Time</label>
				                            <div class="col-sm-10">
				                                <input type="text" class="form-control" id="datetimepicker" name="datetime">
				                               
				                            </div>
				                        </div>
				                        

				                        <div class="form-group">
				                            <label class="col-sm-2 control-label" for="input-comment">Comment</label>
				                            <div class="col-sm-10">
				                                <textarea name="special_inst" rows="5" id="special_inst" class="form-control"></textarea>
				                            </div>
				                        </div>
				                        
									</div>
									<div class="tab-pane" id="tab-payment">
										<div class="pb"></div>

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
														
														<td>Street Address 1:</td>
														<td>
															<input type="text" value="" id="payment_address" name="payment_address" class="form-control">
														</td>
													</tr>
													<tr>
														<td>Apt name</td>
														<td>
															
															<input type="text" value=""  id="payment_apt_name" name="payment_apt_name" class="form-control">
														</td>
													</tr>
													<tr>
														<td>City:</td>
														<td><input type="text" value=""  id="payment_city"  name="payment_city" class="form-control"></td>
													</tr>
													<tr>
														<td>Region / State:</td>
														<td>
															<select name="payment_state" id="payment_state" class="form-control">
															<?php foreach ($state as $st): ?>
																<option value="<?= $st->code ?>"><?= $st->name ?></option>
															<?php endforeach ?>
															</select>
														</td>
													</tr>
													<tr>
														<td>Postcode:</td>
														<td><input type="text" value="" id="payment_zip"  name="payment_zip" name="zip" class="form-control"></td>
													</tr>
													
													
												</tbody>
												
											</table>
									</div>
									<div class="tab-pane" id="tab-shipping">
										<div class="pb"></div>
										<table class="table table-bordered">
										<tbody>
											<tr>
												<td>Select Address</td>
												<td>
													<select name="address_select" data-name='shiping' id="shiping_address_select" class="address_select form-control">
														<option></option>

													</select>
												</td>
											</tr>
											<tr>
														
												<td>Street Address 1:</td>
												<td>
													<input type="text" value="" id="shiping_address" name="shiping_address" class="form-control">
												</td>
											</tr>
											<tr>
												<td>Apt name</td>
												<td>
													
													<input type="text" value=""  id="shiping_apt_name" name="shiping_apt_name" class="form-control">
												</td>
											</tr>
											<tr>
												<td>City:</td>
												<td><input type="text" value=""  id="shiping_city"  name="shiping_city" class="form-control"></td>
											</tr>
											<tr>
												<td>Region / State:</td>
												<td>
													<select name="shiping_state" id="shiping_state" class="form-control">
													<?php foreach ($state as $st): ?>
														<option value="<?= $st->code ?>"><?= $st->name ?></option>
													<?php endforeach ?>
													</select>
												</td>
											</tr>
											<tr>
												<td>Postcode:</td>
												<td><input type="text" value="" id="shiping_zip"  name="shiping_zip" name="zip" class="form-control"></td>
											</tr>
											
									</table>
									</div>
									<div class="tab-pane" id="tab-product">
										<div class="pb"></div>
										 <div class="table-responsive">
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
					                            <tbody id="cart">
					                                <?php $total=0; foreach ($this->cart->contents() as $item): ?>

													<tr>
												    	<td><a href="javascript:;"  onclick="removecart('<?= $item['rowid'] ?>')" class="btn btn-danger">Delete</a></td>
												        <td class="text-left"><?= $item['name'] ?>
												        	<table>

												        	<?php $priceOfoption=0; if ($item['options']): ?>
															
																<?php foreach ($item['options'] as $s): 
																	if (is_array($s)){ 
																		foreach ($s as $k ):
																		$ret = $this->order->getOptionData($k); ?>
																		<tr>
																			<td><?= $ret->option_name.'--'.$ret->option_value ?>-<?= $ret->price ?></td>
																			
																		</tr>
																		<?php
																		$priceOfoption = $priceOfoption + $ret->price;
																		 endforeach; 

																	}else{ ?>
																			<tr><td><?= $s ?></td></tr>
																	<?php }
																	endforeach; 
																?>
																</table>
														<?php endif ?>
												        </td>
														<td class="text-right"><?= $item['qty'] ?></td>
														<td class="text-right">$<?= $item['price'] ?>
															
															<br>
																
																
															<hr>
														   	Total Price: $<?= $item['price'] + $priceOfoption ?>
														</td>
														<td class="text-right">
															$<?= $total = ($item['price'] + $priceOfoption) * $item['qty'] ?>
														</td>
												       
												    </tr>
												<?php endforeach; ?>
					                            </tbody>

					                        </table>
					                    </div>
				                     	<div class="form-group">
					                      <label class="col-sm-2 control-label" for="input-product">Store Select</label>
						                      <div class="col-sm-10">
						                        	<select class="form-control" name="store" id="store">
						                        		<option>None</option>
						                        	</select>
						                       </div>
					                    </div>
				                        <div class="form-group">
					                      <label class="col-sm-2 control-label" for="input-product">Choose Product</label>
						                      <div class="col-sm-10">
						                        	
						                        	 <div>
						                        		<ul id="showproduct" class="list-group">
						                        			
						                        		</ul>
						                        	</div>
						                        	
						                      </div>
					                    </div>
				                        <div class="text-right">
				                        <button type="submit" id="button-product-add" class="btn btn-primary">Save</button>
				                    	</div>

									</div>
									
								</div>
							</div>
						</form>
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
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-validation/jquery.validate.js"></script><!-- Validate Plugin -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-stepy/jquery.stepy.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.min.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 
<script type="text/javascript">
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
		$('#products').change(function(){
			
		});

	});
	function removecart(rowid){
			
			data ={
				rowid : rowid
			}
			 alertify.confirm("Are you sure you want to Delete this Item ?", function (result) {
	                if (result) {
	                    $.ajax({
							type: "POST",
							url: "<?php echo site_url('orders/removeCart') ?>",
							data: data,
							beforeSend: function(){
							},
							success: function(response) { 
								$('#cart').html(response);
	                			$('#total').html(response);
	                		}
						});		
	       		
	                } else {
	                  
	                }
	            });
	}
	$('#shiping_zip').keyup(function(){
		loadstore();
	});
	function loadstore(){
		var data = {
				zip : $('#shiping_zip').val()
		};
			$.ajax({
				url : "<?php echo site_url('orders/getStore') ?>",
				type: "POST",
				dataType: "json",
				data: data,
				success:function(data){
					html = '<option value="">--None--</option>';
					if ( data.length) {
						for (i = 0; i < data.length; i++) {
							html += '<option value="' + data[i]['store_id'] + '"';
							html += '>' + data[i]['store_name'] + '</option>';
						}
					} 
					$('#store').html(html);
					
					
				}	
			});
	}

	$('#store').change(function(){
		var store_id = $(this).val();
		 $.ajax({
            type: "POST",
            url: "<?php echo site_url('orders/getproducts') ?>",
            data: 'store_id='+store_id,
            cache: false,
            dataType: "json",
            success: function(data) {
            	$('#showproduct').html('');
            	for (var i = 0; i < data.length; i++) {
            		$('#showproduct').append('<li class="list-group-item" ><a  onclick="showdata('+data[i].product_id+')" >'+data[i].product_name+'</a></li>');
            	};
            	

            }
        })
	});
	function showdata(product_id){
		data ={
				product_id : product_id
			}
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('orders/getproduct') ?>",
				data: data,
				beforeSend: function(){
				},
				success: function(data){
					$('#myModal').modal('show') 
					$('.dataforoption').html(data);
				}
			})
	}
</script> 
</body>
</html>
