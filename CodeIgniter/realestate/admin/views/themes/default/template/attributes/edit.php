<?php echo Modules::run('header/header/index'); ?>

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('attributes') ?>">Attributes</a></li>
				<li class="active"><a href="">Edit Attributes</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Edit Attributes</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributess = array('class' => 'form-horizontal', 'id' => 'attributes');

						echo form_open_multipart('attributes/update', $attributess);  ?>
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        	
						</ul>	
						<input type="hidden" name="sa_id" value="<?php echo $attributes->sa_id; ?>">	
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Attributes Name
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="attributes_name" required="" id="attributes_name" value="<?php echo $attributes->attributes_name; ?>" class="form-control">
										</div>
									</div> 
									
									

									<div class="form-group">
										<label class="col-sm-3 control-label">Attributes Groups
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<select name="attributes_group_id" class="form-control" required>
												<option>None</option>
												<?php foreach ($groups as $g): ?>
													<option value="<?php echo $g->ag_id ?>" <?php echo $attributes->attributes_group_id == $g->ag_id ? 'selected':'' ; ?>><?php echo $g->group_name ?></option>
												<?php endforeach ?>
											</select>
										</div>

										
									</div>
									
								</div>
						        <div class="modal-footer">
									<a href="<?= site_url('attributes') ?>" class="btn btn-default" >Close</a>
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
<script type="text/javascript">
	$('#attributes').validate({
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
