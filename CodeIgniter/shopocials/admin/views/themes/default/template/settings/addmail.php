<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>

<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('settings/mailtemplate') ?> ">Settings</a></li>
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
								<form name="adduser" action="<?php echo site_url('settings/insertemailtemp') ?>" method="post">
								<div class="modal-body"	>
									<div class="pb"></div> 
									
									<div class="form-group">
										<label class="col-sm-4 control-label">Title</label>
										<div class="col-sm-8">
											<input type="text" name="mail_title"  class="form-control">
										</div>
									</div>
									<div class="pb"></div> 
									<div class="form-group">
										<label class="col-sm-4 control-label">Mail Content</label>
										<div class="col-sm-8">
											<textarea name="mail_content" class="form-control"></textarea>
										</div>
									</div>
									
									<div class="pb"></div> 
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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