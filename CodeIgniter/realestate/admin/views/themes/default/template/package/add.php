<?php echo Modules::run('header/header/index'); ?>

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('package') ?>">Package</a></li>
				<li class="active"><a href="">Add Package</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add Package</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'package');

						echo form_open_multipart('package/add', $attributes);  ?>
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        	
						</ul>		
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Package Name
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="package_name" required="" id="package_name" value="" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label">Package price
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="number" name="package_price" required="" id="package_price" value="" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Package periods(days)
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="number" name="package_periods" required="" id="package_periods" value="" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Package Category
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<select name="package_category_id" required="" id="package_category_id" class="form-control">
												<?php foreach ($package_category as $pc): ?>
														<option value="<?php echo $pc->package_category_id ?>"><?php echo $pc->package_category_name ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									
								</div>
						         <div class="modal-footer">
									<a href="<?= site_url('package') ?>" class="btn btn-default" >Close</a>
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
	$('#package').validate({
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
