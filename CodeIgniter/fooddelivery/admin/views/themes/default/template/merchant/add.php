<?php echo Modules::run('header/header/index'); ?>


<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('merchant'); ?>">Merchant</a></li>
				<li class="active"><a href="">Add Merchant</a></li>
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add New Merchant</h2>
				<div class="panel panel-inverse">
						
						<div class="panel-body ">
							<form id="form-merchant" action="<?php echo site_url('merchant/addnewmerchant'); ?>" method="post" id="wizard" class="	form-horizontal">
							
						    <div class="pb"></div>
						    <div class="row">
						    	<div class="col-md-2">
						    		<ul class="nav nav-pills nav-stacked" id="address">
						                <li class="active"><a href="#tab-customer" data-toggle="tab" aria-expanded="true">General</a></li>
				                        
					                    <li class=""><a href="#tab-address" data-toggle="tab" aria-expanded="true">Address</a></li>
				                    </ul>

						    	</div>
								<div class="col-md-10">
									<div class="tab-content">
				                        <div class="tab-pane active" id="tab-customer">
				                           <div class="pb"></div>
										    <div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Business Name <span class="required">*</span></label>
												<div class="col-md-6">
													<input id="business_name" class="form-control" value="<?= set_value('business_name') ?>" type="text" name="business_name" required>
												</div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Business Description</label>
												<div class="col-md-6">
													<textarea class="form-control"  value="" name="merchant_des" id="merchant_des"><?= set_value('merchant_des') ?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Phone<span class="required">*</span></label>
												<div class="col-md-6"><input id="phone" value="<?= set_value('phone') ?>" class="form-control"  type="tel" name="phone" required></div>
											</div>

											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Fax</label>
												<div class="col-md-6"><input id="fax" value="<?= set_value('fax') ?>" class="form-control"  type="number" name="fax"></div>
											</div>
											
											<div class="form-group">
												<label for="first_name" class="col-md-3 control-label">Email <span class="required">*</span></label>
												<div class="col-md-6">
													<input id="username" class="form-control" value="<?= set_value('username') ?>" name="username"  type="email" required>
												</div>
											</div>
											<div class="form-group">
												<label for="first_name" class="col-md-3 control-label">Password<span class="required">*</span></label>
												<div class="col-md-6">
													<input id="password" class="form-control" name="password"  type="password" required>
												</div>
											</div>
											<div class="form-group">
												<label for="first_name" class="col-md-3 control-label">Confirm Password<span class="required">*</span></label>
												<div class="col-md-6">
													<input id="confirm" class="form-control" name="confirm"  type="password" required>
												</div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Federal Tax ID<span class="required">*</span></label>
												<div class="col-md-6"><input id="federaltaxid" value="<?= set_value('federaltaxid') ?>" class="form-control"  type="text" name="federaltaxid"></div>
											</div>
										</div>
										<div class="tab-pane" id="tab-address">
											<div class="pb"></div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Physical Street <span class="required">*</span></label>
												<div class="col-md-6"><textarea id="physical_street_1" class="form-control"  name="physical_street" required><?= set_value('physical_street') ?>"</textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Physical State<span class="required">*</span></label>
												<div class="col-md-6">
													<select id="physical_state" onchange="state(this,'1');" class="form-control"  type="text" name="physical_state" required >
															<option value="">--None--</option>
															<?php foreach ($state as $s ): ?>
																<option value="<?= $s->code; ?>"><?= $s->name; ?></option>
															<?php endforeach ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Physical City<span class="required">*</span></label>
												<div class="col-md-6">
													<select id="physical_city"  class="form-control"  type="text" name="physical_city" required >
															<option value="">--None--</option>
															
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Physical Zip Code<span class="required">*</span></label>
												<div class="col-md-6"><input id="physical_zipcode_1" class="form-control" value="<?= set_value('physical_zipcode') ?>"  type="number" name="physical_zipcode" required></div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Same as Physical</label>
												<div class="col-md-6"><input id="same_as_physical"  type="checkbox" name="same_as_physical" value="1"></div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Billing Street</label>
												<div class="col-md-6">
													<input id="billing_street" class="form-control" value="<?= set_value('billing_street') ?>" type="text" name="billing_street">
												</div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Billing State</label>
												<div class="col-md-6">
													
													<select id="billing_state" onchange="state(this,'2');" class="form-control"  type="text" name="billing_state" >
															<option value="">--None--</option>
															<?php foreach ($state as $s ): ?>
																<option value="<?= $s->code; ?>"><?= $s->name; ?></option>
															<?php endforeach ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Billing City</label>
												<div class="col-md-6">
													
													<select id="billing_city"  class="form-control"  type="text" name="billing_city"  >
															<option value="">--None--</option>
															
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="fieldurl" class="col-md-3 control-label">Billing Zip Code</label>
												<div class="col-md-6"><input id="billing_zip_code" class="form-control" value="<?= set_value('billing_zip_code') ?>" type="number" name="billing_zip_code" ></div>
											</div>	
										</div>
									</div>
									<div class="modal-footer">
										<a href="<?= site_url('merchant') ?>" class="btn btn-default" >Close</a>
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
								</div>
							</div>	
							</form>
						</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php  echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>

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
</script>
<script type="text/javascript">
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
</script>
</body>
</html>
