<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('customer') ?>">Customer</a></li>
				<li class="active"><a href="">Edit Customer</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Edit Customer</h2>
				
					
				
				<div class="panel panel-inverse">
						
					<div class="panel-body">
						
						<form  method="post" action="<?= site_url('customer/update') ?>" id="form-customer" class="form-horizontal">
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        <li class=""><a href="#tab-order" data-toggle="tab">Order</a></li>
					        <li class=""><a href="#tab-wallet" data-toggle="tab">Wallet</a></li>
					        <li class=""><a href="#tab-points" data-toggle="tab">Points</a></li>
					        <li class=""><a href="#tab-iplog" data-toggle="tab">Ip log</a></li>
					       	
					    </ul>
					    <div class="pb"></div>
					   	
						    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
						            <div class="row">
						                <div class="col-sm-2">
						                    <ul class="nav nav-pills nav-stacked" id="address">
						                        <li class="active"><a href="#tab-customer" data-toggle="tab" aria-expanded="true">General</a></li>
						                         <?php $address_row = 1; ?>
							                    <?php $address_row = 1; ?>
							                    <?php foreach ($customer->customer_address as $address) { ?>
							                    <li><a href="#tab-address<?php echo $address_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('#address a:first').tab('show'); $('#address a[href=\'#tab-address<?php echo $address_row; ?>\']').parent().remove(); $('#tab-address<?php echo $address_row; ?>').remove();"></i> <?php echo 'Address' . ' ' . $address_row; ?></a></li>
							                    <?php $address_row++; ?>
							                    <?php } ?>
							                    <li id="address-add"><a onclick="addAddress();"><i class="fa fa-plus-circle"></i> Add Address</a></li>
						                    </ul>
						                </div>

						                <div class="col-sm-10">
						                    <div class="tab-content">
						                        <div class="tab-pane active" id="tab-customer">
						                           <div class="pb"></div>
						                           <input type="hidden" name="c_id" value="<?= $customer->customer_detail->c_id ?>" >
						                                   
						                            <div class="form-group required ">
						                                <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
						                                <div class="col-sm-10">
						                                    <input type="text" name="firstname" id="firstname" required value="<?= $customer->customer_detail->first_name ?>" placeholder="First Name" id="input-firstname" class="form-control">
						                                   
						                                </div>
						                            </div>
						                            <div class="form-group required ">
						                                <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
						                                <div class="col-sm-10">
						                                    <input type="text" name="lastname" id="firstname" required value="<?= $customer->customer_detail->last_name ?>" placeholder="Last Name" id="input-lastname" class="form-control">
						                                    
						                                </div>
						                            </div>
						                            <div class="form-group required ">
						                                <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
						                                <div class="col-sm-10">
						                                    <input type="text" name="email" id="email" required value="<?= $customer->customer_detail->email ?>" placeholder="E-Mail" id="input-email" class="form-control">
						                                   
						                                </div>
						                            </div>
						                            <div class="form-group required ">
						                                <label class="col-sm-2 control-label" for="input-phone">Phone</label>
						                                <div class="col-sm-10">
						                                    <input  type="text" name="phone" maxlength="12" minlenth="10"  value="<?= $customer->customer_detail->phone ?>" placeholder="Phone" id="input-email" class="form-control">
						                                   
						                                </div>
						                            </div>
						                            <div class="form-group required ">
						                                <label class="col-sm-2 control-label" for="input-password">Password</label>
						                                <div class="col-sm-10">
						                                    <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" autocomplete="off">
						                                   
						                                </div>
						                            </div>
						                            <div class="form-group required">
						                                <label class="col-sm-2 control-label" for="input-confirm">Confirm</label>
						                                <div class="col-sm-10">
						                                    <input type="password" name="confirm" placeholder="Confirm" autocomplete="off" id="input-confirm" class="form-control">
						                                   
						                                </div>
						                            </div>
						                            <div class="form-group">
						                                <label class="col-sm-2 control-label" for="input-newsletter">Newsletter</label>
						                                <div class="col-sm-10">
						                                    <select name="newsletter" id="input-newsletter" class="form-control">
						                                        <option value="1" <?= $customer->customer_detail->newsletter ? 'selected':'' ?>>Enabled</option>
						                                        <option value="0" <?= $customer->customer_detail->newsletter ? '':'selected'  ?>>Disabled</option>
						                                    </select>
						                                </div>
						                            </div>
						                            <div class="form-group">
						                                <label class="col-sm-2 control-label" for="input-status">Status</label>
						                                <div class="col-sm-10">
						                                    <select name="enabled" id="input-enabled" class="form-control">
						                                        <option value="1" <?= $customer->customer_detail->enabled ? 'selected':'' ?>>Enabled</option>
						                                        <option value="0" <?= $customer->customer_detail->enabled ? '':'selected' ?>>Disabled</option>
						                                    </select>
						                                </div>
						                            </div>

						                            
						                        </div>
						                        <?php $address_row = 1; ?>
								                    <?php foreach ($customer->customer_address as $address) { ?>
								                    
								                    <div class="tab-pane " id="tab-address<?php echo $address_row; ?>">
								                    <input type="hidden" name="address[<?php echo $address_row; ?>][address_id]" value="<?php echo $address->address_id; ?>" />
								                    	
												    <div class="pb"></div>
												    <div class="form-group required">
												        <label class="col-sm-2 control-label" for="input-address-11">Street Address</label>
												        <div class="col-sm-10">
												            <input type="text" name="address[<?php echo $address_row; ?>][street_address]" value="<?php echo $address->street_address; ?>" placeholder="Street Address" id="input-address-11" class="form-control">
												        </div>
												    </div>
												    <div class="form-group">
												        <label class="col-sm-2 control-label" for="input-address-21">Apt name</label>
												        <div class="col-sm-10">
												            <input type="text" name="address[<?php echo $address_row; ?>][apt_name]" value="<?php echo $address->apt_name; ?>"  placeholder="Apt name" id="input-address-21" class="form-control">
												        </div>
												    </div>
												    <div class="form-group required">
												        <label class="col-sm-2 control-label" for="input-state1">State</label>
												        <div class="col-sm-10">
												            <select name="address[<?php echo $address_row; ?>][state]" id="input-state1" class="form-control" onchange="state(this, '<?php echo $address_row; ?>');">
												               <option>--None--</option>
												               <?php foreach ($states as $state): ?>
												               	<option value="<?= $state->code ?>" <?=  $state->code ==$address->state ? 'selected' :'' ?>><?= $state->name ?></option>
												               <?php endforeach ?>
												            </select>
												        </div>
												    </div>
												    <div class="form-group required">
												        <label class="col-sm-2 control-label" for="input-city1">City</label>
												        <div class="col-sm-10">
												            <select name="address[<?php echo $address_row; ?>][city]" id="input-city1" class="form-control">
												                <option value="">--none--</option>
												                <?php if ($address->city): ?>
												                	 <option value="<?= $address->city ?>" selected><?= $address->city ?></option>
												                <?php endif ?>
												               
												            </select>
												        </div>
												    </div>
												    <div class="form-group required">
												        <label class="col-sm-2 control-label" for="input-zip1">Zip</label>
												        <div class="col-sm-10">
												            <input type="text" name="address[<?php echo $address_row; ?>][zip]" value="<?php echo $address->zip; ?>" placeholder="zip" id="input-zip1" class="form-control">
												        </div>
												    </div>
												</div>
								                    <?php $address_row++; ?>
								                <?php } ?>
						                    </div>
						                </div>
						            </div>
						        </div>
						        <div class="tab-pane" id="tab-order">
									<table class="table table-striped" id="aftersearch">
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
											<td>No orders found</td>
										</tr>
										<?php else: ?>
										<?php foreach ($orders as $order): ?>
											<tr>
												<td><?= date('d-m-Y',strtotime($order->created_on))  ?></td>
												<td><a href="<?= site_url('orders/view/'.$order->o_id.'') ?>"><?= $order->o_id ?></a></td>
												
												<td><?= $order->total_amt;  ?></td>
												<td><?= $order->name ?></td>

												<td><?= $order->special_inst ?></td>
												<td>
													<a href="<?= site_url('orders/edit/'.$order->o_id.'') ?>" class="btn btn-primary">Edit</a>
												</td>
											</tr>
										<?php endforeach ?>
										<?php endif ?>		
										</tbody>
									</table>
						        </div>
						        <div class="tab-pane"  id="tab-wallet">

									<table class="table table-striped" id="aftersearch">
										<thead>
											<th>Order No:</th>
											<th>Credit Used:</th>
											<th>Date</th>
										</thead>
										<tbody>
										<?php if (!$walletHistory): ?>
											<tr class="err_msg"><td colspan="3">Customer(s) Wallet History not available.</td></tr>	
										<?php else: ?>	
										<?php foreach ($walletHistory as $wallet): ?>
											<tr>
												<td><?= $wallet->order_id ?></td>
												<td><?= $wallet->credit_used	 ?></td>
												<td><?=  date('d-m-Y',strtotime($wallet->date_added));?></td>
											</tr>
										<?php endforeach ?>
											
										</tbody>
										<tfoot>
										<tr>
												<td>Total Remaining Credits:</td>
												<td  colspan="2"><?= $wall->credit; ?></td>
											</tr>
										</tfoot>
										<?php endif ?>	
									</table>

						        </div>
						        <div class="tab-pane"  id="tab-points">

									<table class="table table-striped" id="aftersearch">
										<thead>
											<th>#</th>
											<th>Points Used</th>
											<th>Earned Credits</th>
											<th>Date</th>
										</thead>
										<tbody>
										<?php if (!$pointsHistory): ?>	
										<tr class="err_msg"><td colspan="3">Customer(s) Point History not available.</td></tr>	
										<?php else: ?>
										<?php $i=1; foreach ($pointsHistory as $reward): ?>
											<tr>
												<td><?= $i?></td>
												<td><?= $reward->points ?></td>
												<td><?= $reward->earn_credit ?></td>
												<td><?= date('d-m-Y',strtotime( $reward->date_added ))?></td>
											</tr>
										<?php $i++; endforeach ?>
										</tbody>
										<tfoot>
											<tr>
												<td>Total Point Remaing :</td>
												<td colspan="3">
													<?= $rewar->points  ?>
												</td>
											</tr>
										</tfoot>
										<?php endif; ?>
									</table>

						        </div>
						        <div class="tab-pane" id="tab-iplog">
						        	<table class="table table-striped">

						        		<thead>
							        		<th>Last Login Date</th>
							        		<th>Ip</th>
						        		</thead>	
						        		<tbody>

						        			<tr>
						        				<td><?= date('d-m-Y g:i:a',strtotime( $customer->customer_detail->last_login)) ?></td>
						        				<td><?= $customer->customer_detail->ip ?></td>
						        			</tr>

						        		</tbody>
						        	</table>
						        </div>
						    </div>
						    <div class="modal-footer">
								<a href="<?= site_url('customer') ?>" class="btn btn-default" >Close</a>
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
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 

<script type="text/javascript"><!--
var address_row = <?php echo $address_row; ?>;

function addAddress() {
	html  = '<div class="tab-pane" id="tab-address' + address_row + '">';
	html += '  <input type="hidden" name="address[' + address_row + '][address_id]" value="" />';

	html += '<div class="pb"></div><div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-address-1' + address_row + '">Street Address</label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][street_address]" value="" placeholder="Street Address" id="input-address-1' + address_row + '" class="form-control" /></div>';
	html += '  </div>';

	html += '  <div class="form-group">';
	html += '    <label class="col-sm-2 control-label" for="input-address-2' + address_row + '">Apt name</label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][apt_name]" value="" placeholder="Apt name" id="input-address-2' + address_row + '" class="form-control" /></div>';
	html += '  </div>';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-state' + address_row + '">State</label>';
	html += '    <div class="col-sm-10"><select name="address[' + address_row + '][state]" id="input-state' + address_row + '"  class="form-control"  onchange="state(this, \'' + address_row + '\');">';
    html += '         <option value="">--none--</option>';
    <?php foreach ($states as $state) { ?>
    html += '         <option value="<?php echo $state->code; ?>"><?php echo addslashes($state->name); ?></option>';
    <?php } ?>
    html += '      </select></div>';
	html += '  </div>';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-city' + address_row + '">City</label>';
	html += '    <div class="col-sm-10"><select name="address[' + address_row + '][city]" id="input-city' + address_row + '"  class="form-control">';
    html += '         <option value="">--none--</option>';
   
    html += '      </select></div>';
	html += '  </div>';

	

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-zip' + address_row + '">Zip</label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][zip]" value="" placeholder="zip" id="input-zip' + address_row + '" class="form-control" /></div>';
	html += '  </div>';
	


    html += '</div>';

	$('#tab-general .tab-content').append(html);


	$('#address-add').before('<li><a href="#tab-address' + address_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#address a:first\').tab(\'show\'); $(\'a[href=\\\'#tab-address' + address_row + '\\\']\').parent().remove(); $(\'#tab-address' + address_row + '\').remove();"></i> Address' + address_row + '</a></li>');

	$('#address a[href=\'#tab-address' + address_row + '\']').tab('show');


	$('#tab-address' + address_row + ' .form-group[data-sort]').detach().each(function() {
		if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#tab-address' + address_row + ' .form-group').length) {
			$('#tab-address' + address_row + ' .form-group').eq($(this).attr('data-sort')).before(this);
		}

		if ($(this).attr('data-sort') > $('#tab-address' + address_row + ' .form-group').length) {
			$('#tab-address' + address_row + ' .form-group:last').after(this);
		}

		if ($(this).attr('data-sort') < -$('#tab-address' + address_row + ' .form-group').length) {
			$('#tab-address' + address_row + ' .form-group:first').before(this);
		}
	});

	address_row++;
}
//-->
</script>

<script type="text/javascript">
	function state(element, index) {
	$.ajax({
		url: '<?php echo site_url("customer/getcitybystate") ?>/' + element.value,
		dataType: 'json',
		
		success: function(json) {
			
			html = '<option value="">--none--</option>';
			if ( json.length) {
				for (i = 0; i < json.length; i++) {
					html += '<option value="' + json[i]['city_name'] + '"';
						
					html += '>' + json[i]['city_name'] + '</option>';
				}
			} 
			
			

			$('select[name=\'address[' + index + '][city]\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
</script>
<script type="text/javascript">
	$('#form-customer').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		
	});
</script>
</body>
</html>
