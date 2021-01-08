<?php echo Modules::run('header/header/index'); ?>


<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('merchant'); ?>">Merchant</a></li>
				<li class="active"><a href="">Edit Merchant</a></li>
			</ol> 
			<div class="container-fluid">
				<form id="form-merchant" action="<?php echo site_url('merchant/update'); ?>" method="post" id="" class="	form-horizontal">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Edit Merchant</h2>
				<div class="panel panel-inverse">
						<div class="panel-body ">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
									<li class=""><a href="#tab-orders" data-toggle="tab">Orders </a></li>
									<li class=""><a href="#tab-transactions" data-toggle="tab">Transactions</a></li>
									<li class=""><a href="#tab-contacts" data-toggle="tab">Contacts</a></li>
									<li class=""><a href="#tab-payments" data-toggle="tab">Payments</a></li>
									<li class=""><a href="#tab-store" data-toggle="tab">Store</a></li>
									<li class=""><a href="#tab-ads" data-toggle="tab">Ads</a></li>
									<li class=""><a href="#tab-iplog" data-toggle="tab">IP Log </a></li>
									
								</ul>
									
								<div class="pb"></div>
								<div class="tab-content">
									<div class="tab-pane active" id="tab-general">
										<div class="row">
											<div class="col-md-2">
												<ul class="nav nav-pills nav-stacked" id="address">
													<li class="active"><a href="#tab-merchant" data-toggle="tab" aria-expanded="true">General</a></li>
													
													<li class=""><a href="#tab-address" data-toggle="tab" aria-expanded="true">Address</a></li>
												</ul>

											</div>
											<div class="col-md-10">
												<div class="tab-content">
													<div class="tab-pane active" id="tab-merchant">
													   <div class="pb"></div>
														<div class="form-group">
															<input type="hidden" name="m_id" value="<?= $merchant->merchantinfo->m_id; ?>">
															<label for="fieldurl" class="col-md-3 control-label">Business Name <span class="required">*</span></label>
															<div class="col-md-6">
																<input id="business_name" class="form-control"  type="text" name="business_name" value="<?= $merchant->merchantinfo->business_name; ?>" required>
															</div>
														</div>
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Business Description</label>
															<div class="col-md-6">
																<textarea class="form-control" name="merchant_des" id="merchant_des"><?= $merchant->merchantinfo->merchant_des; ?>
																</textarea>
																
															</div>
														</div>
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Physical Verify Merchant</label>
															<div class="col-md-6">
																<select class="form-control" name="is_pverified" >
																	<option value="1" <?= $merchant->merchantinfo->is_pverified ? 'selected' :''; ?>>True</option>
																	<option value="0" <?= $merchant->merchantinfo->is_pverified ? '' :'selected'; ?> >False</option>
																</select>
															</div>
														</div>
														

														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Phone<span class="required">*</span></label>
															<div class="col-md-6"><input id="phone" class="form-control"  type="number" name="phone" value="<?= $merchant->merchantinfo->phone; ?>" required></div>
														</div>

														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Fax</label>
															<div class="col-md-6"><input id="fax" class="form-control"  type="number" name="fax" value="<?=  $merchant->merchantinfo->fax ?  $merchant->merchantinfo->fax : '' ?>"></div>
														</div>
														
														<div class="form-group">
															<label for="first_name" class="col-md-3 control-label">Email <span class="required">*</span></label>
															<div class="col-md-6">
																<input id="username" value="<?= $merchant->merchantinfo->username; ?>" class="form-control" name="username"  type="email" required>
															</div>
														</div>
														<div class="form-group">
															<label for="first_name" class="col-md-3 control-label">Password<span class="required">*</span></label>
															<div class="col-md-6">
																<input id="password" required  value="<?= $this->encrypt->decode($merchant->merchantinfo->password) ?>" class="form-control" name="password"  type="password" required>
															</div>
														</div>
														
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Federal Tax ID<span class="required">*</span></label>
															<div class="col-md-6"><input id="federaltaxid" class="form-control"  type="text" name="federaltaxid" value="<?= $merchant->merchantinfo->federal_tax_id; ?>"></div>
														</div>
													</div>
													<div class="tab-pane" id="tab-address">
														<div class="pb"></div>
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Physical Street <span class="required">*</span></label>
															<div class="col-md-6">
																<textarea id="physical_street_1" class="form-control"  name="physical_street" required>
																	<?= trim($merchant->merchantinfo->physical_street) ?>
																</textarea>
															</div>
														</div>
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Physical State<span class="required">*</span></label>
															<div class="col-md-6">
																<select id="physical_state" onchange="state(this,'1');" class="form-control"  type="text" name="physical_state" required >
																		<option value="">--None--</option>
																		<?php foreach ($state as $s ): ?>
																			<option value="<?= $s->code; ?>" <?= $s->code == $merchant->merchantinfo->physical_state ? 'selected' : '' ?>><?= $s->name; ?></option>
																		<?php endforeach ?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Physical City<span class="required">*</span></label>
															<div class="col-md-6">
																<select id="physical_city"  class="form-control"  type="text" name="physical_city" required >
																		<option value="">--None--</option>
																		<?php if ($merchant->merchantinfo->physical_city): ?>
																			<option value="<?= $merchant->merchantinfo->physical_city ?>" selected><?= $merchant->merchantinfo->physical_city ?></option>
																		<?php endif ?>
																</select>
															</div>
														</div>

														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Physical Zip Code<span class="required">*</span></label>
															<div class="col-md-6"><input id="physical_zipcode_1" class="form-control" maxlength="6" type="number" value="<?= $merchant->merchantinfo->physical_zip_code ?>" name="physical_zipcode" required></div>
														</div>
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Same as Physical</label>
															<div class="col-md-6"><input id="same_as_physical"  type="checkbox" name="same_as_physical" value="1"></div>
														</div>
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Billing Street</label>
															<div class="col-md-6">
																<input id="billing_street" class="form-control"  type="text" name="billing_street" value="<?= $merchant->merchantinfo->billing_street ?>">
															</div>
														</div>
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Billing State</label>
															<div class="col-md-6">
																
																<select id="billing_state" onchange="state(this,'2');" class="form-control"  type="text" name="billing_state" >
																		<option value="">--None--</option>
																		<?php foreach ($state as $s ): ?>
																			<option value="<?= $s->code; ?>" <?= $s->code == $merchant->merchantinfo->billing_state ? 'selected' : '' ?>><?= $s->name; ?></option>
																		<?php endforeach ?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Billing City</label>
															<div class="col-md-6">
																
																<select id="billing_city"  class="form-control"  type="text" name="billing_city"  >
																		<option value="">--None--</option>
																		<?php if ($merchant->merchantinfo->billing_city): ?>
																			<option value="<?= $merchant->merchantinfo->billing_city ?>" selected><?= $merchant->merchantinfo->billing_city ?></option>
																		<?php endif ?>
																</select>
															</div>
														</div>

														<div class="form-group">
															<label for="fieldurl" class="col-md-3 control-label">Billing Zip Code</label>
															<div class="col-md-6"><input id="billing_zip_code" class="form-control"  type="number" name="billing_zip_code" value="<?= $merchant->merchantinfo->billing_zip_code ? $merchant->merchantinfo->billing_zip_code : '' ?>" ></div>
														</div>	
													</div>
												</div>
											</div>
										</div>	
									</div>

									<div class="tab-pane" id="tab-orders">
										<table class="table table-bordered m" >
										<thead>
											<th>Store Name</th>
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
												<td><?= $order->store_name ?></td>
												<td><?= date('d-m-Y',strtotime($order->date_added))  ?></td>
												<td><a href="<?= site_url('orders/view/'.$order->so_id.'') ?>"><?= $order->so_id ?></a></td>
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
									<div class="tab-pane" id="tab-transactions">
										<table id="transactiontable" class="table table-bordered m" cellspacing="0">
											<thead>
												<tr>
													<th>#</th>
													<th>Transaction Type</th>
													<th>Transaction Order Id</th>
													<th>Details</th>
													<th>Transaction Amount</th>
												</tr>
											</thead>
											<tbody>

												<?php if ($merchant->merchant_transaction):
												$i = 1;
												foreach ($merchant->merchant_transaction as $mt): ?>
													<tr>
													<td><?= $i; ?></td>
													<td><?= ucfirst($mt->transaction_type) ?></td>
													<td><?= $mt->main_order ?></td>
													<td><?= $mt->description ?></td>
													<td><?= $mt->amount ?></td>
													</tr>
												<?php $i++; endforeach;
												 ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="4">Total Balance</td>
													<td><?= $merchant->merchantinfo->merchant_balance  ?></td>
												</tr>
											</tfoot>
										<?php else: ?>
											<tfoot>
												<tr>
													<td colspan="5">No transaction history found</td>
												</tr>
											</tfoot>
										<?php endif; ?>
										</table>

										<div class="row" id="FormToValidate">
											<div class="form-group" id="transaction-validation">
												<label for="fieldurl" class="col-md-3 control-label">Transaction<span class="required">*</span></label>
												<div class="col-md-6">
													<select class="form-control" id="transaction_type" required>
														<option value="0">None</option>
														<option value="credit">Credit</option>
														<option value="Debit" >Debit</option>
													</select>
												</div>
											</div>

											<div class="form-group" id="description-validation">
												<label for="fieldurl" class="col-md-3 control-label">Description<span class="required">*</span></label>
												<div class="col-md-6">
													<input type="text" name="description"    id="paymentdescription" class="form-control">
												</div>
											</div>
											<div class="form-group" id="amount-validation">
												<label for="fieldurl" class="col-md-3 control-label">Amount<span class="required">*</span></label>
												<div class="col-md-6">
													<input type="number" name="amount" id="amount"  class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label"></label>
												<div class="col-md-6">
													<input type="button" id="addtransaction" value="Add Transaction" class="btn btn-primary">
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab-contacts">
										
										<!-- here first info about first name and last name and mobile comes here from first form -->
										<table id="contacttable" class="table table-bordered m" cellspacing="0">
											<thead>
												<tr>
												<th>First Name</th>
												<th>Last Name</th>
												<th>Mobile </th>
												<th>Email </th>
												<th>Owner</th>
												<th>Manager</th>
												<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php if (!$merchant->merchant_contact): ?>
													<tr>

													<td>
														<input class="form-control" type="text" name="first_name[]" id="first_name_1" value="">
													</td>
													<td>
														<input class="form-control" type="text" name="last_name[]" id="last_name_1" value=""  >
													</td>
													<td><input class="form-control" type="number" name="mobile[]"id="mobile_1"  value=""></td>
													<td><input class="form-control" type="email" name="email[]" id="email_1" value=""></td>
													<td><input class="form-control" type="checkbox" name="owner[]" id="owner" value="1"  ></td>
													<td><input class="form-control" type="checkbox" name="manger[]" id="manger" value="1" ></td>
													<td><a href="javascript:void(0)" onclick="deleteRow(this,'contacttable')" class="delrow">Delete</a></td>
													</tr>
												<?php else: ?>
												<?php foreach ($merchant->merchant_contact as $mc): ?>
													
												<input type="hidden" name="mcid[]" id="mcid" value="<?= $mc->mc_id ?>"  >
												<tr>

												<td>
													<input class="form-control" type="text" name="first_name[]" id="first_name_1" value="<?= $mc->first_name ?>">
												</td>
												<td>
													<input class="form-control" type="text" name="last_name[]" id="last_name_1" value="<?= $mc->last_name ?>"  >
												</td>
												<td><input class="form-control" type="number" name="mobile[]"id="mobile_1"  value="<?= $mc->mobile ?>"  > </td>
												<td><input class="form-control" type="email" name="email[]" id="email_1" value="<?= $mc->email ?>"  > </td>
												<td><input class="form-control" type="checkbox" name="owner[]" id="owner" value="1" <?= $mc->is_owner ? 'checked': '' ?> ></td>
												<td><input class="form-control" type="checkbox" name="manger[]" id="manger" value="1" <?= $mc->is_manager ? 'checked': '' ?> ></td>
												<td><a href="javascript:void(0)"  class="btnDelete">Delete</a></td>
												</tr>

												<?php endforeach ?>
											</tbody>
											<?php endif ?>
											<button class="btn btn-primary m" type="button" id="addmanager_contact">Add Contact</button>
										</table>
									</div>
									<div class="tab-pane" id="tab-payments">
										<div class="pb"></div>
										<div class="form-group">
											<label for="fieldurl" class="col-md-3 control-label">Frequency<span class="required">*</span></label>
											<div class="col-md-6">
												
												<select class="form-control" name="frequency" required>
													<option value="15" <?= $merchant->merchantinfo->payment_frequency == '15' ? 'selected':'' ?>>15 days</option>
													<option value="30" <?= $merchant->merchantinfo->payment_frequency == '30' ? 'selected':'' ?>>30 days</option>
													
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="fieldurl" class="col-md-3 control-label">Mode<span class="required">*</span></label>
											<div class="col-md-6">
												<select class="form-control" name="payment_mode" required>
													<option value="Cash" <?= $merchant->merchantinfo->payment_mode == 'Cash' ? 'selected':'' ?>>Cash</option>
													<option value="Check" <?= $merchant->merchantinfo->payment_mode == 'Check' ? 'selected':'' ?>>Check</option>
													<option value="Wire Transfer" <?= $merchant->merchantinfo->payment_mode == 'Wire Transfer' ? 'selected':'' ?>>Wire Transfer </option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="fieldurl" class="col-md-3 control-label">ECS/Wire Transfer Details
											</label>
											<div class="col-md-6">
												<textarea class="form-control" name="ecswire_details">
													<?= $merchant->merchantinfo->wire_details ?>
												</textarea>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab-store">
										<table class="table table-bordered m">
										<thead>
											<tr>
												<th>#</th>
												<th>Logo</th>
												<th>Store Name</th>
												<th>Phone</th>
												<th>Status</th>
												<th class="text-right">Date Added</th>
											</tr>
										</thead>
										<tbody id="tbody">

											<?php $i= 1; if(!empty($stores)): foreach($stores as $store): ?>
											<tr>
												<td><?= $i; ?></td>
												<td>
													<?php $upload_path =  $this->config->item('show_upload_path').'/store/'; ?>
													<?php if ($store->store_logo): ?>
													<img src="<?= $upload_path.$store->store_logo; ?>" width="50px" height="50px">
													<?php endif ?>
												</td>
												<td><?php echo $store->store_name ?></td>
												<td><?php echo $store->store_phone ?></td>
												<td><?php echo $store->status  ? 'Approved' :'Not-approved' ?></td>
												<td class="text-right">
													<?php echo date('d-m-Y',strtotime($store->created_on)) ?>
												</td>
											</tr>
											<?php $i++;endforeach; else: ?>
											<tr class="err_msg"><td colspan="5">Store(s) not available.</td></tr>
											<?php endif; ?>
											
										</tbody>
										
										</table>

									</div>
									<div class="tab-pane" id="tab-ads">
										<table class="table table-bordered m">
										<thead>
											<tr>
												<th>#</th>
												<th>Logo</th>
												<th>Store Name</th>
												<th>Start Date</th>
												<th>End Date</th>
												<th class="text-right">Status</th>
											</tr>
										</thead>
										<tbody id="tbody">
											<?php $i= 1; if(!empty($stores)): foreach($stores as $store): ?>
											<?php if ($store->ads_status): ?>
											<tr>
												<td><?= $i; ?></td>
												<td>
													<?php $upload_path =  $this->config->item('show_upload_path').'/store/'; ?>
													<?php if ($store->store_logo): ?>
													<img src="<?= $upload_path.$store->store_logo; ?>" width="50px" height="50px">
													<?php endif ?>
												</td>
												<td><?php echo $store->store_name ?></td>
												<td><?php echo date($store->ads_start_date) ?></td>
												<td><?php echo date($store->ads_end_date) ?></td>
												<td><?php echo $store->ads_status  ? 'Approved' :'Not-approved' ?></td>
												
											</tr>
											<?php endif ?>
											<?php $i++;endforeach; else: ?>
											<tr class="err_msg"><td colspan="5">Store(s) not available.</td></tr>
											<?php endif; ?>
										</tbody>
											
										</table>

									</div>
									<div class="tab-pane" id="tab-iplog">
										<table class="table table-bordered m">

							        		<thead>
								        		<th>Last Login Date</th>
								        		<th>Ip</th>
							        		</thead>	
							        		<tbody>

							        			<tr>
							        				<td><?= date('d-m-Y g:i:a',strtotime( $merchant->merchantinfo->last_login)) ?></td>
							        				<td><?= $merchant->merchantinfo->ip ?></td>
							        			</tr>

							        		</tbody>
							        	</table>

									</div>
								</div>
								<div class="modal-footer">
										<a href="<?= site_url('merchant') ?>" class="btn btn-default" >Close</a>
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
							</form>
						</div>
				</div>	
			</div>
		</div>
		<!-- #page-content -->
	</div>
			   
<?php  echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-validation/jquery.validate.js"></script><!-- Validate Plugin -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-stepy/jquery.stepy.js"></script>  

<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
<script type="text/javascript">

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
			if (index==1) {
			
			$('#physical_city').html(html);
			} else{
				$('#billing_city').html(html);

			};
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
$("#addmanager_contact").click(function () {
	     $("#contacttable").each(function () {
	         var tds = '<tr>';
	         jQuery.each($('tr:last td', this), function () {
	             tds += '<td>' + $(this).html() + '</td>';
	         });
	         tds += '</tr>';
	         if ($('tbody', this).length > 0) {
	             $('tbody', this).append(tds);
	         } else {
	             $(this).append(tds);
	         }
	     });
	});



$(document).ready(function () {
        $("#addtransaction").click(function () {
           if ($('#transaction_type').val() ==0) {
           		$('#transaction-validation').addClass('has-error');
           		return false;
           }
           if ($('#paymentdescription').val() ==0) {
           		$('#description-validation').addClass('has-error');
           	return false;
           }
           if ($('#amount').val() =='') {
           		$('#amount-validation').addClass('has-error');
           		return false;
           }
            var data = {
				merchant_id :'<?= $merchant->merchantinfo->m_id; ?>',
				description :$('#paymentdescription').val(),
				transaction_type :$('#transaction_type').val(),
				amount : $('#amount').val(),
				ajax:'1'
			};
			$.ajax({
				url : "<?php echo site_url('merchant/addtransaction') ?>",
				type: "POST",
				data: data,
				success:function(data){
					window.location.reload();
				}
			});
        });
    });
$('#form-merchant').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		
	});
$("#contacttable").on('click', '.btnDelete', function () {
	var x = document.getElementById("contacttable").rows.length;
	if (x !='2') {
		$(this).closest('tr').remove();	
	};

});
</script>

</body>
</html>
