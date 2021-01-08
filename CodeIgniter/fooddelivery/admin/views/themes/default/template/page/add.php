<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li><a href="<?= site_url('page'); ?>">Page</a></li>
				<li class="active"><a href="">Add Page</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2>Add Page</h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					
						<div class="panel-body ">
							<form name="adduser" class="form-horizontal" action="<?php echo site_url('page/addpage') ?>" method="post">
								<div class="pb"></div>
								<div class="form-group ">
									<label class="col-sm-3 control-label">Title</label>
									<div class="col-sm-8">
										<input type="text" name="title" value="<?= set_value('title') ?>" class="form-control">
									</div>
								</div>
								

								<div class="form-group ">
									<label class="col-sm-3 control-label">Url Alias</label>
									<div class="col-sm-8">
										
										<input type="text" name="alias" value="<?= set_value('alias') ?>" class="form-control">
									</div>
								</div>
								<div class="form-group ">
									<label class="col-sm-3 control-label">Show on Footer</label>
									<div class="col-sm-8">
										<input type="checkbox" id=""  name="show_on_footer" value="1" >
									</div>
								</div>
								<div class="form-group ">
									<label class="col-sm-3 control-label">Meta Keywords</label>
									<div class="col-sm-8">
										<textarea type="text" name="meta_keywords" class="form-control"><?= set_value('meta_keywords') ?></textarea>

									</div>
								</div>
								
								<div class="form-group ">
									<label class="col-sm-3 control-label">Meta Description</label>
									<div class="col-sm-8">
										<textarea type="text" name="meta_description" class="form-control"><?= set_value('meta_description') ?></textarea>
									</div>
								</div>
								
								<div class="form-group ">
									<label class="col-sm-3 control-label">Content</label>
									<div class="col-sm-8">
										<textarea type="text" name="content" class="ckeditor form-control"><?= set_value('content') ?></textarea>
									</div>
								</div>
								<div class="m-xl"></div> 
								<div class="form-group">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-8">
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
<script src="<?= site_url('views/themes/default') ?>/assets/ckeditor/ckeditor.js"></script>

</body>
</html>