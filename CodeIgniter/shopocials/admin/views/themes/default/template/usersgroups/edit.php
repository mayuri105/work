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
                    <li>User Group</li>
                    <li>Edit User Group </li>                    
                </ul>
			<div class="block">
                     
				<div class="panel panel-inverse">
                    <div class="panel-body">
						<form name="adduser" action="<?php echo site_url('users_groups/update') ?>" method="post">
							<input type="hidden" value="<?= $user_group->group_id ?>" name="group_id">
							
								<div class="row">
								<div class="col-md-3">
									<label class="control-label"> Name</label>
									
										<input type="text" name="name" value="<?= $user_group->name ?>" class="form-control">
									</div>
								<div class="col-md-3">
									<label class="control-label">Access Rights</label>
									
										<?php  $permission = json_decode($user_group->permission ) ? json_decode($user_group->permission ) : array() ?>
										<p><select class="form-control" id="access"  multiple="multiple" name="permission[]">	
											<?php foreach ($rights as $r): ?>
												<option value="<?= $r ?>" <?= in_array($r,$permission) ? 'selected':'' ?>><?= $r ?></option>
											<?php endforeach ?>
										</select></p>
									</div>
								<div class="col-md-3">
									<label class="control-label">Modify Rights</label>
									
										<?php  $modify = json_decode($user_group->modify ) ? json_decode($user_group->modify ) : array() ?>
										<p><select class="form-control" id="modify"  multiple="multiple" name="modify[]">	
											<?php foreach ($rights as $r): ?>
												<option value="<?= $r ?>" <?= in_array($r,$modify) ? 'selected':'' ?>><?= $r ?></option>
											<?php endforeach ?>
										</select></p>
									</div>
								<div class="col-md-12">
							
								<a href="<?= site_url('users_groups') ?>" class="btn btn-default" >Close</a>
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
</div>
</body>




<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
 <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
	$(function() {
	$('#access,#modify').multiselect({
		includeSelectAllOption: true
	});
	});
</script>
</body>
</html>
