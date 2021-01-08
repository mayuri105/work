<?php echo Modules::run('header/header/index'); ?>
 <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css">
   
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('others/rentaproperty') ?>">Rent a Property</a></li>
				<li class="active"><a href="">Edit Rent a Property</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Edit Rent a Property</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'appointment');

						echo form_open_multipart('others/editrentapropertySubmit', $attributes);  ?>
						
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
													<option value='<?php echo $c->c_id ?>' <?php echo $custprop->customer_id == $c->c_id ? 'selected' : '' ?>> <?php echo $c->first_name.' '.$c->last_name ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label">Property
											<span class="required">*</span></label>
											<!-- <p>Search Property with Title and Id</p> -->
										<div class="col-sm-8">
											<input type="text" class="form-control auto" value="<?php echo $custprop->property_title ?>" id="property" name="property" required>
											
										</div>
										<input type="hidden" class="form-control " value="<?php echo $custprop->property_id ?>" id="property_id" name="property_id" required>
										<input type="hidden" class="form-control " value="<?php echo $custprop->rp_id ?>" name="rp_id" required>
										
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label">Start Date	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control date " required id="start_date" name="start_date"  value="<?php echo date('m-d-Y',strtotime( $custprop->start_date)) ?>" >
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">End date	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control date" required id="end_date" name="end_date"  value="<?php echo date('m-d-Y',strtotime( $custprop->end_date)) ?>" >
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Rent Amount	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="number" class="form-control " required id="rent" name="rent"  value="<?php echo $custprop->rent ?>" >
											
										</div>
									</div>
								</div>
						         <div class="modal-footer">
									<a href="<?= site_url('others/rentaproperty') ?>" class="btn btn-default" >Close</a>
									<button type="submit" class="btn btn-primary">Save Changes </button>
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
  	$("#property").autocomplete({
    source: "<?php echo site_url('appointment/getproperty') ?>",
    minLength: 1,
    select: function (event, ui) {
        $("#txtAllowSearch").val(ui.item.label); // display the selected text
        $("#property_id").val(ui.item.id); // save selected id to hidden input
    }
}); 
</script>

</body>
</html>
