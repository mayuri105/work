<?php echo Modules::run('header/header/index'); ?>

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('package_category') ?>">Package category</a></li>
				<li class="active"><a href="">Edit Package category</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Edit Package category</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'package_category');

						echo form_open_multipart('package_category/update', $attributes);  ?>
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        	
						</ul>	
						<input type="hidden" name="package_category_id" value="<?php echo $package_category->package_category_id; ?>">	
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Package category Name
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="package_category_name" required="" id="package_category_name" value="<?php echo $package_category->package_category_name; ?>" class="form-control">
										</div>
									</div> 
									
									<div class="form-group">
										<label class="col-sm-3 control-label">Extend Days(For same category package buy)
											<span class="required">*</span></label>
										<div class="col-sm-8">
												
											<input type="text" name="extend_days_for_same_package" required="" id="extend_days_for_same_package" value="<?php echo $package_category->extend_days_for_same_package; ?>" class="form-control">
										</div>
									</div>
									
									
								</div>
						        <div class="modal-footer">
									<a href="<?= site_url('package_category') ?>" class="btn btn-default" >Close</a>
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
	$('#package_category').validate({
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
