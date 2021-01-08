<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css">

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li><a href="<?= site_url('module') ?>">Module</a></li>
				<li><a href="">Sms Api </a></li>
			</ol> 
			<div class="container-fluid">
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Sms Api </h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'themesett');

						echo form_open('module/saveSocialMedia', $attributes);  ?>
					    	<div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
						        	<div class="form-group">
											<label class="col-sm-4 control-label">Facebook</label>
											<div class="col-sm-8">
												<input class="form-control" value="<?= $facebook ?>" name="facebook" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Twitter</label>
											<div class="col-sm-8">
												
												 <input class="form-control" value="<?= $twitter ?>" name="twitter" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Instagram</label>
											<div class="col-sm-8">
												
												<input class="form-control" value="<?= $instagram ?>" name="instagram" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Google plus</label>
											<div class="col-sm-8">
												
												 <input class="form-control" value="<?= $googleplus ?>" name="googleplus" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label">App store link</label>
											<div class="col-sm-8">
												
												<input class="form-control" value="<?= $appstorelink ?>" name="appstorelink" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">play store link</label>
											<div class="col-sm-8">
												
												<input class="form-control" value="<?= $playstorelink ?>" name="playstorelink" />
											</div>
										</div>
								</div>
								<div class="modal-footer">
										<a href="<?php echo site_url('module') ?>" class="btn btn-default">Close</a>
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
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>

<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

<!-- Validate Plugin -->
<script type="text/javascript">
	$('#themesett').validate({
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
