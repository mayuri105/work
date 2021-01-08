<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('users') ?>">Users</a></li>
				<li class="active"><a href="">Add Users</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add User</h2>
				<div class="panel panel-inverse">
					<div class="panel-body ">
						<div>
							<div>
								<div>
									<form id="form-main" class="form-horizontal" name="form-main" action="<?php echo site_url('users/add') ?>" method="post">
										<div class="modal-body"	>
											<div class="form-group">
												<label class="col-sm-3 control-label">User Name</label>
												<div class="col-sm-8">
													<input type="text" name="user_name"  minlength="5"   maxlength="15"  required id="user_name" value="<?= set_value('user_name') ?>" class="form-control">
												</div>
											</div>
											<div class=""></div> 
											<div class="form-group">
												<label class="col-sm-3 control-label">First Name</label>
												<div class="col-sm-8">
													<input type="text" name="first_name" required id="first_name" value="<?= set_value('first_name') ?>" class="form-control">
												</div>
											</div>
											<div class=""></div> 
											<div class="form-group">
												<label class="col-sm-3 control-label">Last Name</label>
												<div class="col-sm-8">
													<input type="text" name="last_name" value="<?= set_value('last_name') ?>"  value=""class="form-control">
												</div>
											</div>
											<div class=""></div> 
											<div class="form-group">
												<label class="col-sm-3 control-label">Email</label>
												<div class="col-sm-8">
													<input type="email" name="email" value="<?= set_value('email') ?>" required id="email" class="form-control">
												</div>
											</div>
											<div class=""></div> 
											<div class="form-group">
												<label class="col-sm-3 control-label">Password</label>
												<div class="col-sm-8">
													<input type="password" id="password" minlength="5"  name="password" required value="<?= set_value('password') ?>" class="form-control">
												</div>
											</div>
											<div class=""></div> 
											
											<div class="form-group">
												<label class="col-sm-3 control-label">Select Group</label>
												<div class="col-sm-8">
													<select class="form-control" name="user_group_id">
														<?php foreach ($usersgroups as $g ): ?>
															<option value="<?= $g->group_id ?>"><?= $g->name ?></option>
														<?php endforeach ?>
														
													</select>
												</div>
											</div>
											
											<div class=""></div> 
											<div class="form-group">
												<label class="col-sm-3 control-label">Enabled</label>
												<div class="col-sm-8">
													<select class="form-control" name="status" required>
														<option value="1">True</option>
														<option value="0">False</option>
													</select>
												</div>
											</div>
											
										</div>

										<div class="modal-footer">
											<a href="<?= site_url('users') ?>" class="btn btn-default" >Close</a>
											<button type="submit" class="btn btn-primary">Save changes</button>
										</div>
									</form>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div>
					</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
	$('#form-main').validate({
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
