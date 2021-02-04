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
						<li>Customer Notifiction</li>
						<li>Edit Notifiction </li>
					</ul>
					<div class="block">
						<div class="panel panel-inverse">
							<div class="panel-body">
								<?php echo Modules::run('messages/message/index'); ?>
								<?php if($shopmail):?>
									<form name="adduser" class="form-horizontal" action="<?php echo site_url('notification/updatemailtemp') ?>" method="post">
										<div class="modal-body"	>
											<div class="pb"></div>
											<input type="hidden" name="shop_id" value="<?= $shop_id; ?>">
											<input type="hidden" name="mail_id" value="<?= $shopmail->mail_id; ?>">
											<div class="col-md-8">
												<label class="control-label">Action</label>
												<input type="text" name="" value="<?= $shopmail->mail_title; ?>" disabled class="form-control">
											</div>
											<div class="col-md-8">
												<label class="control-label">Mail Content</label>
												<textarea name="mail_content"  id="textarea-ckeditor" rows="115" class="ckeditor"><?= $shopmail->mail_content; ?></textarea>
											</div>
										</div>
										<div class="col-md-8">
											<div class="modal-footer">
												<a  href="<?= site_url('notification') ?>" class="btn btn-default" data-dismiss="modal">Close</a>
												<button type="submit" class="btn btn-primary">Save changes</button>
											</div>
										</div>
									</form>
									<?php else:?>
										<form name="adduser" class="form-horizontal" action="<?php echo site_url('notification/addemailtemplate') ?>" method="post">
											<div class="modal-body"	>
												<div class="pb"></div>
												<input type="hidden" name="shop_id" value="<?= $shop_id; ?>">
												<input type="hidden" name="mt_id" value="<?= $mail->mt_id; ?>">
												<div class="col-md-8">
													<label class="control-label">Action</label>
													<input type="text" name="" value="<?= $mail->mail_title; ?>" disabled class="form-control">
												</div>
												<div class="col-md-8">
													<label class="control-label">Mail Content</label>
													<textarea name="mail_content" id="textarea-ckeditor" rows="115" class="ckeditor"><?= $mail->mail_content; ?></textarea>
												</div>
											</div>
											<div class="col-md-8">
												<div class="modal-footer">
													<a  href="<?= site_url('notification') ?>" class="btn btn-default" data-dismiss="modal">Close</a>
													<button type="submit" class="btn btn-primary">Save changes</button>
												</div>
											</div>
										</form>
									<?php endif ?>
								</div>
							</div>
						</div>
						<?php echo Modules::run('footer/footer/index'); ?>
					</div>
				</div>
			</div>
			<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
			<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
			<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
			<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
			<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
			<script src="<?= site_url('views/themes/default') ?>/assets/js/helpers/ckeditor/ckeditor.js"></script>
		</body>
		</html>
