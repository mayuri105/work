<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css">

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('testimonial') ?>">Testimonial</a></li>
				<li class="active"><a href="">Edit Testimonial</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Edit Testimonial</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'testimonial');

						echo form_open_multipart('testimonial/update', $attributes);  ?>
						<input type="hidden" name="testimonial_id" value="<?php echo $testimonial->testimonial_id; ?>">
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        	
						</ul>		
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Testimonial Name
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="testimonial_name" required=""  id="testimonial_name" value="<?php echo $testimonial->testimonial_name; ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Testimonial
											<span class="required">*</span></label>
											<div class="col-sm-8">
												<textarea  name="testimonial" required=""  class="form-control"><?php echo $testimonial->testimonial; ?></textarea>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">User Position
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="user_position" required="" id="user_position" value="<?php echo $testimonial->user_position; ?>" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label">User image<span class="required">*</span></label>
										<div class="col-sm-8">
											<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
												<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
													<img src="<?php echo getuploadpath().'testimonial/'.$testimonial->user_image; ?>">
												</div>
												<div>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
													<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
													<input type="file" name="fileinput"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
						         <div class="modal-footer">
									<a href="<?= site_url('testimonial') ?>" class="btn btn-default" >Close</a>
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
<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>

<script type="text/javascript">
jQuery.validator.addMethod("greaterThan", 
	function(value, element, params) {

	    if (!/Invalid|NaN/.test(new Date(value))) {
	        return new Date(value) < new Date($(params).val());
	    }

	    return isNaN(value) && isNaN($(params).val()) 
	        || (Number(value) > Number($(params).val())); 
	},'Must be greater than {0}.');	
	$('#testimonial').validate({
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
