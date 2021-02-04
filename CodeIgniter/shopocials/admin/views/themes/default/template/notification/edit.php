<!DOCTYPE html>
<html class="no-js" lang="en">
<?php echo Modules::run('header/header/head'); ?>
 
<body>

    <div id="page-wrapper">

        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">



            <?php echo Modules::run('sidebar/sidebar/index'); ?>

            <div id="main-container">

             <?php echo Modules::run('header/header/index'); ?>



             <div id="page-content">

                <ul class="breadcrumb breadcrumb-top">
                    <li>Notification</li>
                    <li>Add Notification </li>
                    
                </ul>
                
               
<div class="block">
                            
                
                
                                
                
                <div class="panel panel-inverse">
                    <div class="panel-body">


                 <?php echo Modules::run('messages/message/index'); ?>


                   <?php 
                   $attributes = array('class' => 'form-horizontal', 'id' => 'mails');

                   echo form_open_multipart('notification/update', $attributes);  ?>
									
								
							<input type="hidden" name="mt_id" value="<?php echo $mail->mt_id; ?>" class="form-control">

								
								<div class="col-md-8">
                                    <label class="control-label">Name</label>
                                    
                                        <input type="text" disabled="disabled" name="name" value="<?= $mail->name; ?>" class="form-control" >
                                    </div>
								
								<div class="col-md-8">
                                    <label class="control-label">Title</label>
                                    
                                        <input type="text" disabled="disabled" name="mail_title" value="<?= $mail->mail_title; ?>" class="form-control">
                                    </div>
                                
								
								<div class="col-md-8">
									<label class="control-label">Content</label>
									
										<textarea type="text" id="textarea-ckeditor" name="mail_content" class="ckeditor"><?= set_value('mail_content') ?><?php echo $mail->mail_content; ?></textarea>
									</div>
								
							
								<div class="col-md-12">

									<a href="<?= site_url('notification') ?>" class="btn btn-default" >Close</a>
									
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
								
											
							</form>
					</div>
				</div>
			</div>
		</div>
		<?php echo Modules::run('footer/footer/index'); ?>
	</div>
</div>
</div>
</body>





<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/jqueryui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>

<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>

<script src="<?= site_url('views/themes/default') ?>/assets/js/helpers/ckeditor/ckeditor.js"></script>

<!-- The Canvas to Blob plugin is included for image resizing functionality -->


</body>
</html>
