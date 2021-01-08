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
				<li><a href="">Theme Option</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Theme Option</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'themesett');

						echo form_open_multipart('module/savethemesetting', $attributes);  ?>
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
					        	  		
									<div class="form-group">
										<label class="col-sm-3 control-label">Site Name</label>
										<div class="col-sm-8">
											
											<input type="text" name="site_name" value="<?= $site_name ?>"class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Owner</label>
										<div class="col-sm-8">
											
											<input type="text" name="owner" value="<?= $owner ?>"class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label">Phone</label>
										<div class="col-sm-8">
											
											<input type="number" name="phone" value="<?= $phone ?>"class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Address</label>
										<div class="col-sm-8">
											<textarea class="form-control" name="address"><?= $address ?></textarea>
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">About Us</label>
										<div class="col-sm-8">
											<textarea class="form-control" name="aboutus"><?= $aboutus ?></textarea>
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Admin Themes Select</label>
										<div class="col-sm-8">
											
											<select class="form-control" name="admin_theme" placeholder="">

												 <?php foreach($admin_themes as $theme){ ?>
		                            			<?php if(preg_replace('#[^\w()/.%\-&]#',"",$theme) == $admin_theme){ ?>
					                                    <option selected=""><?= preg_replace('#[^\w()/.%\-&]#',"",$theme);  ?></option>
					                                <?php }else{ ?>
					                                    <option><?= preg_replace('#[^\w()/.%\-&]#',"",$theme); ?></option>
					                                <?php } ?>
					                            <?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Front Themes Select</label>
										<div class="col-sm-8">
											
											<select class="form-control" name="front_theme" placeholder="">

												 <?php foreach($admin_themes as $theme){ ?>
		                            			<?php if(preg_replace('#[^\w()/.%\-&]#',"",$theme) == $front_theme){ ?>
					                                    <option selected=""><?= preg_replace('#[^\w()/.%\-&]#',"",$theme);  ?></option>
					                                <?php }else{ ?>
					                                    <option><?= preg_replace('#[^\w()/.%\-&]#',"",$theme); ?></option>
					                                <?php } ?>
					                            <?php } ?>
											</select>
										</div>
									</div>

									
									<div class="form-group">
										<label class="col-sm-3 control-label">Logo image</label>
										<div class="col-sm-8">
											<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
												<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
													<?php if ($logoimage): ?>
														<img src="<?= getuploadpath().'/theme/'.$logoimage ?>">
													<?php endif ?>
												</div>
												<div>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
													<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
													<input type="file" name="logoimage"></span>
												</div>
											</div>
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
