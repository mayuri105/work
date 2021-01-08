<?php echo Modules::run('header/header/index'); ?>

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('amenities') ?>">Amenity</a></li>
				<li class="active"><a href="">Add Amenity</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add Amenity</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'amenities');

						echo form_open_multipart('amenities/add', $attributes);  ?>
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        	
						</ul>		
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Amenity Name
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="amenities_name" required="" id="amenities_name" value="" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Amenity Icon
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="amenities_icon" required="" id="amenities_icon" value="" class="form-control">
										<p>Use  <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="blank">font awesome icon</a> </p>
										</div>

										
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label">Enabled <span class="required">*</span></label>
										<div class="col-sm-8">
											<select name="enabled" class="form-control" required>
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>
								</div>
						         <div class="modal-footer">
									<a href="<?= site_url('amenities') ?>" class="btn btn-default" >Close</a>
									<button type="submit" class="btn btn-primary">Save changes</button>
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

<script type="text/javascript">
jQuery.validator.addMethod("greaterThan", 
	function(value, element, params) {

	    if (!/Invalid|NaN/.test(new Date(value))) {
	        return new Date(value) < new Date($(params).val());
	    }

	    return isNaN(value) && isNaN($(params).val()) 
	        || (Number(value) > Number($(params).val())); 
	},'Must be greater than {0}.');	
	$('#amenities').validate({
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
	
</script>

</body>
</html>
