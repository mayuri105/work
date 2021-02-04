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
                    <li>User </li>
                    <li>Edit User  </li>
                    
                </ul>
                
              	<?php echo Modules::run('messages/message/index'); ?> 
			<div class="block">
				<div class="panel panel-inverse">
                    <div class="panel-body">
									<form action="<?= site_url('users/update') ?>" class="form-horizontal" name="form-update" id="form-update" name="form-update" method="post">
										<input type="hidden" name="u_id"  value="<?= $users->u_id; ?>"class="form-control">
									
											<div class="col-md-8">
													<label class="control-label">User Name</label>
													
														<input type="text" name="user_name" minlength="5"   maxlength="15"  required id="user_name"  value="<?= $users->username ?>"class="form-control">
													</div>
											<div class="col-md-8">
												<label class="control-label">First Name</label>
												
													<input type="text" name="first_name" id="first_name" required value="<?= $users->first_name ?>" class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">Last Name</label>
												
													<input type="text" name="last_name" value="<?= $users->last_name ?>"  value=""class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">Email</label>
												
													<input type="text" name="email" id="email" required value="<?= $users->email ?>"  class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">Current Password</label>
												
													<input type="password" name="curpassword" minlength="5"   value="" class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">New Password</label>
												
													<input type="password" name="newpassword"  minlength="5"  value="" class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">Select Group</label>
												
													<select class="form-control" name="user_group_id" required id="user_group_id">
														<?php foreach ($usersgroups as $g ): ?>
															<option value="<?= $g->group_id ?>" <?= $users->user_group_id == $g->group_id ? 'selected' :'' ?>><?= $g->name ?></option>
														<?php endforeach ?>
														
													</select>
												</div>
											<div class="col-md-8">
												<label class="control-label">Enabled</label>
											
													<select class="form-control" name="status">
														<option value="1"  <?= $users->status == 1 ? 'selected' :'' ?>>True</option>
														<option value="0"  <?= $users->status == 0 ? 'selected' :'' ?>> False</option>
													</select>
												</div>
											<div class="col-md-8">
										<div class="modal-footer">
												<a href="<?= site_url('users') ?>" class="btn btn-default" >Close</a>
												<button type="submit" class="btn btn-primary">Save changes</button>
											</div>
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


<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>

<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
</body>
</html>