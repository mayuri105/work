<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Settings</a></li>
			</ol> 
 
			 <div class="container-fluid">
			 	<?php echo Modules::run('messages/message/index'); ?>
				<div class="row">
					
                    <div class="panel panel-inverse">
                    	<div class="panel-body ">
						<ul class="nav nav-pills " id="address">
	                        <li class="active"><a href="#tab-general" data-toggle="tab" aria-expanded="true">General</a></li>
	                    	<li class=""><a href="#tab-seo" data-toggle="tab" aria-expanded="true">SEO</a></li>
	                    	<li class=""><a href="#tab-mail" data-toggle="tab" aria-expanded="true">Mail </a></li>
	                    	<li class=""><a href="#tab-sms" data-toggle="tab" aria-expanded="true">Sms </a></li>
	                    	
	                    	<li class=""><a href="#tab-social" data-toggle="tab" aria-expanded="true">Social Media</a></li>
	                    	<li class=""><a href="#tab-options" data-toggle="tab" aria-expanded="true">Options</a></li>
	                    	
	                    	
	                    </ul>
	                    <div class="tab-content">
		                    <div class="tab-pane active" id="tab-general">
		                    	<form action="<?php echo site_url('settings/savesettings') ?>" method="post" class="form-horizontal row-border">
								<div class="panel-editbox" data-widget-controls=""></div>
								<div class="panel-body">
									
									<div class="form-group">
										<label class="col-sm-4 control-label">Site Name</label>
										<div class="col-sm-8">
											
											<input type="text" name="site_name" value="<?= $site_name ?>"class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Owner</label>
										<div class="col-sm-8">
											
											<input type="text" name="owner" value="<?= $owner ?>"class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Address</label>
										<div class="col-sm-8">
											<textarea class="form-control" name="address"><?= $address ?></textarea>
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Phone</label>
										<div class="col-sm-8">
											
											<input type="number" name="phone" value="<?= $phone ?>"class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Admin Themes Select</label>
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
										<label class="col-sm-4 control-label">Front Themes Select</label>
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
										<label class="col-sm-4 control-label">Language</label>
										<div class="col-sm-8">
											
											<input type="text" name="language" value="<?= $language ?>"class="form-control">
										</div>
									</div>
														
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="pull-right">
											<button class="btn-primary btn">Submit</button>
											
										</div>
									</div>
								</div>
								</form>



		                    </div>
		                    <div class="tab-pane" id="tab-seo">
		                    	<form action="<?php echo site_url('settings/seosetting') ?>" name="seosetting" id="seosetting" method="post" class="form-horizontal row-border">
								<div class="panel-editbox" data-widget-controls=""></div>
								<div class="panel-body">
									
									<div class="form-group">
										<label class="col-sm-4 control-label">Meta Title</label>
										<div class="col-sm-8">
											<input type="text" value="<?= $meta_titles ?>" class="form-control" name="meta_titles" /> 
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-4 control-label">Meta keywords</label>
										<div class="col-sm-8">
											<textarea class="form-control" name="meta_keywords" /> <?= $meta_keywords ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Meta Description</label>
										<div class="col-sm-8">
											<textarea class="form-control" name="meta_descriptions" /> <?= $meta_descriptions ?></textarea>
										</div>
									</div>
								</div>
								
								<div class="panel-footer">
									<div class="row">
										<div class="pull-right">
											<button class="btn-primary btn">Submit</button>
											
										</div>
									</div>
								</div>
								</form>
		                    </div>
		                    <div class="tab-pane" id="tab-mail">
		                    	<form action="<?php echo site_url('settings/smtpsetting') ?>" name="smtpsetting" id="smtpsetting" method="post" class="form-horizontal row-border">
								<div class="panel-editbox" data-widget-controls=""></div>
								<div class="panel-body">
									
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
								
								<div class="panel-footer">
									<div class="row">
										<div class="pull-right">
											<button class="btn-primary btn">Submit</button>
											
										</div>
									</div>
								</div>
								</form>
		                    </div>
		                    <div class="tab-pane" id="tab-sms">
		                    	<form action="<?php echo site_url('settings/smssetting') ?>" name="smssetting" id="smssetting" method="post" class="form-horizontal row-border">
								<div class="panel-editbox" data-widget-controls=""></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="col-sm-4 control-label">Sms Notification Enabled</label>
										<div class="col-sm-8">
											<select class="form-control" name="sms_enabled">
												<option value="0" <?= $sms_enabled ? '':'selected'  ?>>No</option>
												<option value="1" <?= $sms_enabled  ? 'selected':''?>>Yes</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Twilio Sid</label>
										<div class="col-sm-8">
											
											<input class="form-control" value="<?= $twilio_sid ?>" name="twilio_sid" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Auth token</label>
										<div class="col-sm-8">
											
											 <input class="form-control" value="<?= $twilio_auth_token ?>" name="twilio_auth_token" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Messaging Service Sid</label>
										<div class="col-sm-8">
											
											<input class="form-control" value="<?= $twilio_messaging_service_sid ?>" name="twilio_messaging_service_sid" />
										</div>
									</div>
									
									
								</div>
								
								<div class="panel-footer">
									<div class="row">
										<div class="pull-right">
											<button class="btn-primary btn">Submit</button>
											
										</div>
									</div>
								</div>
								</form>
		                    </div>
		                    <div class="tab-pane" id="tab-social">
		                    	<form action="<?php echo site_url('settings/socialmediasetting') ?>" name="socialmediasetting" id="socialmediasetting" method="post" class="form-horizontal row-border">
									<div class="panel-body">
										
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
									
									<div class="panel-footer">
										<div class="row">
											<div class="pull-right">
												<button class="btn-primary btn">Submit</button>
												
											</div>
										</div>
									</div>
									</form>
		                    </div>
		                    <div class="tab-pane" id="tab-options">
		                    	<form action="<?php echo site_url('settings/optionsettings') ?>" name="optionsettings" id="optionsettings" method="post" class="form-horizontal row-border">
									<div class="panel-body">
				                    	<div class="form-group">
											<label class="col-sm-4 control-label">Multiple Store Order</label>
											<div class="col-sm-8">
												<select class="form-control" name="multiple_store_order" id="multiple_store_order">
													<option value="yes" <?= $multiple_store_order == 'yes'?'selected' : '' ?>>Yes</option>
													<option value="no" <?= $multiple_store_order == 'no'?'selected' : '' ?>>No</option>
												</select>
												
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Redeem points Value</label>
											<div class="col-sm-8">
												
												<input type="text" name="redeem_points" value="<?= $redeem_points ?>"class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Refer By Credits</label>
											<div class="col-sm-8">
												
												<input type="text" name="refbycredits" value="<?= $refbycredits ?>"class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">Min Order for Refer By Credits</label>
											<div class="col-sm-8">
												<input type="text" name="minorder_for_credits" value="<?= $minorder_for_credits ?>"class="form-control">
											</div>
										</div>	
										<div class="form-group">
											<label class="col-sm-4 control-label">Google API</label>
											<div class="col-sm-8">
												<input type="text" name="google_api_key" value="<?= $google_api_key ?>"class="form-control">
											</div>
										</div>	
										<div class="form-group">
											<label class="col-sm-4 control-label">Per Page</label>
											<div class="col-sm-8">
												<input type="text" name="per_page" value="<?= $per_page ?>" class="form-control">
											</div>
										</div>

									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="pull-right">
												<button class="btn-primary btn">Submit</button>
												
											</div>
										</div>
									</div>
								<form>

		                    </div>

						</div>

	                    </div>


                    </div>

				</div>
				
			</div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
</body>
</html>