<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('customer') ?>">Customer</a></li>
				<li class="active"><a href="">Add Customer</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add Customer</h2>
				
					
				
				<div class="panel panel-inverse">
						
					<div class="panel-body">
						
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'form-customer');

						echo form_open_multipart('customer/add', $attributes);  ?>
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        <li class=""><a href="#tab-address" data-toggle="tab">Address</a></li>
					    </ul>
					    <div class="pb"></div>
					   	
						    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
						            <div >
					               		<div>
					                           <div class="pb"></div>
					                            <div class="form-group required ">
					                                <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
					                                <div class="col-sm-10">
					                                    <input type="text" name="firstname" id="firstname" required value="" placeholder="First Name" id="input-firstname" class="form-control">
					                                   
					                                </div>
					                            </div>
					                            <div class="form-group required ">
					                                <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
					                                <div class="col-sm-10">
					                                    <input type="text" name="lastname" id="lastname" required  value="" placeholder="Last Name" id="input-lastname" class="form-control">
					                                    
					                                </div>
					                            </div>
					                            <div class="form-group required ">
					                                <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
					                                <div class="col-sm-10">
					                                    <input type="text" name="email" id="email" required value="" placeholder="E-Mail" id="input-email" class="form-control">
					                                   
					                                </div>
					                            </div>
					                             <div class="form-group required ">
					                                <label class="col-sm-2 control-label" for="input-phone">Phone</label>
					                                <div class="col-sm-10">
					                                    <input type="tel" name="phone"  value="" placeholder="Phone" id="input-email" class="form-control">
					                                   
					                                </div>
					                            </div>
					                            
					                            <div class="form-group required ">
					                                <label class="col-sm-2 control-label" for="input-password">Password</label>
					                                <div class="col-sm-10">
					                                    <input type="password" name="password" required value="" placeholder="Password" id="input-password" class="form-control" autocomplete="off">
					                                   
					                                </div>
					                            </div>
					                            <div class="form-group required">
					                                <label class="col-sm-2 control-label" for="input-confirm">Confirm</label>
					                                <div class="col-sm-10">
					                                    <input type="password" name="confirm" required placeholder="Confirm" autocomplete="off" id="input-confirm" class="form-control">
					                                   
					                                </div>
					                            </div>
					                            <div class="form-group">
													<label class="col-sm-2 control-label">Profile image</label>
													<div class="col-sm-10">
														<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
															<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;"></div>
															<div>
																<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
																<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
																<input type="file" name="fileinput"></span>
															</div>
														</div>
													</div>
												</div> 
					                            <div class="form-group">
					                                <label class="col-sm-2 control-label" for="input-newsletter">Newsletter</label>
					                                <div class="col-sm-10">
					                                    <select name="newsletter" id="input-newsletter" class="form-control">
					                                        <option value="1">Enabled</option>
					                                        <option value="0" selected="selected">Disabled</option>
					                                    </select>
					                                </div>
					                            </div>
					                            <div class="form-group">
					                                <label class="col-sm-2 control-label" for="input-status">Status</label>
					                                <div class="col-sm-10">
					                                    <select name="enabled" id="input-enabled" class="form-control">
					                                        <option value="1" selected="selected">Enabled</option>
					                                        <option value="0">Disabled</option>
					                                    </select>
					                                </div>
					                            </div>
										</div>
						            </div>
						        </div>
						        <div class="tab-pane" id="tab-address">
						        	<div class="form-group">
		                                <label class="col-sm-2 control-label" for="input-status">Address</label>
		                                <div class="col-sm-10">
		                                 	<input type="text" name="address" id="address"  id="input-firstname" class="form-control">
		                                </div>
		                            </div>
		                            <div class="form-group">
		                                <label class="col-sm-2 control-label" for="input-status">City</label>
		                                <div class="col-sm-10">
		                                 	<input type="text" name="city" id="city"  id="input-firstname" class="form-control">
		                                </div>
		                            </div>
		                             <div class="form-group">
		                                <label class="col-sm-2 control-label" for="input-status">State</label>
		                                <div class="col-sm-10">
		                                 	<input type="text" name="state" id="state"  id="input-firstname" class="form-control">
		                                </div>
		                            </div>
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
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script><!-- Validate Plugin -->
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
	html += '    <label class="col-sm-2 control-label" for="input-city' + address_row + '">City</label>';
	html += '    <div class="col-sm-10"><input name="address[' + address_row + '][city]" id="input-city' + address_row + '"  class="form-control"></div>';
	html += '  </div>';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-state' + address_row + '">State</label>';
	html += '    <div class="col-sm-10"><input name="address[' + address_row + '][state]" id="input-state' + address_row + '"  class="form-control"></div>';
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
