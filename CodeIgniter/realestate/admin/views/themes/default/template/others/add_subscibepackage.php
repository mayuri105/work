<?php echo Modules::run('header/header/index'); ?>
 <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css">
   
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('others/subscribed_package') ?>">Subscription Package</a></li>
				<li class="active"><a href="">Add Subscription Package</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add Subscription Package</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'appointment');

						echo form_open_multipart('others/addsubpackageSubmit', $attributes);  ?>
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        	
						</ul>		
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Customer Name
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<select name="customer" id="customer" required> 
												<option value=''>None</option>
												<?php foreach ($cust as $c): ?>
													<option value='<?php echo $c->c_id ?>'><?php echo $c->first_name.' '.$c->last_name ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Package Name
											<span class="required">*</span></label>
											<!-- <p>Search Property with Title and Id</p> -->
										<div class="col-sm-8">
											<select name="package_name" id="package_name" class="form-control" required> 
												<option value=''>None</option>
												<?php foreach ($package as $p): ?>
													<option value='<?php echo $p->package_id ?>'><?php echo $p->package_name ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<input type="hidden" class="form-control " id="property_id" name="property_id" required>
										
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Package price	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" required id="package_price" name="package_price" disabled="disabled"  value="<?php echo set_value('package_price') ?>" >
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Package Start Date	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control time" required id="package_start_date" name="package_start_date"  disabled="disabled"  value="<?php echo date('Y-m-d') ?>" >
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Package End Date	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											
											<input type="text" class="form-control time" required id="package_end_date" name="package_end_date"  disabled="disabled"  value="<?php echo set_value('package_end_date') ?>" >
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Payment Method	
											</label>
										<div class="col-sm-8">
											<select name="payment_method" id="payment_method" class="form-control" required> 
												<option value=''>None</option>
												<option value='cash'>Cash</option>
											</select>
										</div>
									</div>


									
								</div>
						         <div class="modal-footer">
									<a href="<?= site_url('others/subscribed_package') ?>" class="btn btn-default" >Close</a>
									<button type="submit" class="btn btn-primary">Activate </button>
								</div>
						    </div>
						</form>

					</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script><!-- Validate Plugin -->
 <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.min.js"></script><!-- Validate Plugin -->
       
<script type="text/javascript">
	$('#appointment').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		rules:{
	        start_date: { greaterThan: "#end_date" }
	    }
		
	});
	$('#appointment_date').datepicker({
		startDate: '+1d',
   		endDate: '+1m'
	})
	$('#appointment_time').timepicker({})
	$('#customer').select2({})
  	$('#package_name').change(function(){

  		$.ajax({
	        url : "<?php echo site_url('others/getPackageDetail') ?>",
	        type: "GET",
	        dataType: "json",
	        data: { id:$(this).val()},
	        success:function(data){ 
	           
	           $('#package_price').val(data.package_price);
	           $('#package_end_date').val(data.package_end_date);
	          	 
	        }   
	    });
 	});
</script>

</body>
</html>
