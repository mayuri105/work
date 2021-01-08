<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('module/templates') ?> ">Module</a></li>
				<li class="active"><a href="">Edit Mail templates</a></li>
			</ol> 
 
			 <div class="container-fluid">
			 	<?php echo Modules::run('messages/message/index'); ?>
				<div class="row">
					
                    <div class="panel panel-inverse">
                    	<div class="panel-body ">
						
	                    <div class="tab-content">
		                    <div class="tab-pane active" id="tab-general">
		                    	
								<div class="panel-editbox" data-widget-controls=""></div>
								<div class="panel-body">
								<?php $attributes = array('class' => 'form-horizontal', 'id' => 'themesett');

									echo form_open('module/updatemailtemp', $attributes);  ?>
								<div class="modal-body"	>
									<div class="pb"></div> 
									<input type="hidden" name="mt_id" value="<?= $mail->mt_id; ?>">
									<div class="form-group">
										<label class="col-sm-4 control-label">Action</label>
										<div class="col-sm-8">
											<input type="text" name="" value="<?= $mail->mail_title; ?>" disabled class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-4 control-label">Mail Content</label>
										<div class="col-sm-8">
											<textarea name="mail_content" class="form-control"><?= $mail->mail_content; ?></textarea>
										</div>
									</div>

									
									<?php if ($mail->mail_title !='customer_welcome_mail' && $mail->mail_title != 'admin_forgott_mail_template'  ): ?>
										
									
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-8">
										
											<div class="checkbox">
											  <label><input type="checkbox" name="send_msg" value="1" <?= $mail->send_msg ? 'checked' :'' ?>>Send Msg </label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Sms Template</label>
										<div class="col-sm-8">
											<textarea name="msg_template" class="form-control"><?= $mail->msg_template; ?></textarea>
										</div>
									</div>
									
									<?php endif ?>
								</div>

								<div class="modal-footer">
									<a  class="btn btn-default" href="<?php echo site_url('module/templates')?>">Close</a>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
								</form>		
								</div>
								


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