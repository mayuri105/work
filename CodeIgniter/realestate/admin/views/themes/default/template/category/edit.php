<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css">

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('categories') ?>">Category</a></li>
				<li class="active"><a href="">Edit Category</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Edit Category</h2>
				
					
				
				<div class="panel panel-inverse">
						
					<div class="panel-body">
						
						
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'categories');

						echo form_open_multipart('categories/update', $attributes);  ?>
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        
					        	
						</ul>
							
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">

					        	  	<input type="hidden" value="<?= $categories->cat_id ?>" name="cat_id">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Category Name<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="categories_name" required="" id="categories_name" value="<?= $categories->category ?>" class="form-control">
										</div>
									</div> 
									<div class="form-group">
									<label class="col-sm-3 control-label">Parent Category </label>
										<div class="col-sm-8">
											<select name="parent_category" class="form-control"  id="parent_category"  >
												<option value="0">None</option>
												<?php foreach ($category_par as $l): ?>
													<?php if ($categories->cat_id != $l->cat_id): ?>
														<option value="<?= $l->cat_id ?>"  <?= $categories->parent_category == $l->cat_id ? 'selected': '' ?>><?= $l->category ?></option>
													<?php endif ?>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									 
									<div class="form-group">
										<label class="col-sm-3 control-label">Enabled</label>
										<div class="col-sm-8">
											<select name="enabled" class="form-control" >
												<option value="1" <?= $categories->enabled ? 'selected':'' ?> >Yes</option>
												<option value="0" <?= $categories->enabled ? '':'selected' ?> >No</option>
											</select>
										</div>
									</div>
								</div>
					          
					        
						    </div>
						    <div class="modal-footer">
								<a href="<?= site_url('categories') ?>" class="btn btn-default" >Close</a>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</form>

					</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script><!-- Validate Plugin -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

<script type="text/javascript">
	$('#categories').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		
	});
	$('#categories_name').change(function() {
		$(this).val($.trim($(this).val()));
		$(this).val($(this).val().replace(/\s+/g,' '));
		// replace more then 1 space with only one
		$('#categories_slug').val($(this).val().toLowerCase());
		$('#categories_slug').val($('#categories_slug').val().replace(/\W/g, ' '));
		$('#categories_slug').val($.trim($('#categories_slug').val()));
		$('#categories_slug').val($('#categories_slug').val().replace(/\s+/g, '-'));
	});

</script>
<script type="text/javascript">
	$(function() {
	$('#location').multiselect({
		includeSelectAllOption: true
	});

	});
</script>
</body>
</html>
