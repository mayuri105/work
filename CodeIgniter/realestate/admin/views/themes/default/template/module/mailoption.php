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

						echo form_open('module/saveMailOption', $attributes);  ?>
					    	<div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
									<div class="form-group">
										<label class="col-sm-4 control-label">Username</label>
										<div class="col-sm-8">
											
											<input class="form-control" value="<?= $smtp_user ?>" name="smtp_user" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Password</label>
										<div class="col-sm-8">
											
											 <input class="form-control" value="<?= $smtp_pass ?>" name="smtp_pass" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Timeout</label>
										<div class="col-sm-8">
											
											<input class="form-control" value="<?= $smtp_timeout ?>" name="smtp_timeout" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Port</label>
										<div class="col-sm-8">
											
											 <input class="form-control" value="<?= $smtp_port ?>" name="smtp_port" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Host</label>
										<div class="col-sm-8">
											
											<input class="form-control" value="<?= $smtp_host ?>" name="smtp_host" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Protocol</label>
										<div class="col-sm-8">
											
											<input class="form-control" value="<?= $mail_protocol ?>" name="mail_protocol" />
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
