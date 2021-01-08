<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| Edit User </title>
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/AdminLTE.min.css">
 <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-datepicker3.css"/>

  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/skins/_all-skins.min.css">

  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
.error {
  
  
  color:#F00;
  
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <?php echo Modules::run('header/header/index'); ?>
  <?php echo Modules::run('menu/menu/index'); ?>
  <div class="content-wrapper">
   
    <section class="content-header">
      
      <ol class="breadcrumb">
        <li><a href="<?= site_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit User </li>
      </ol>
    </section>

   
    <section class="content">

     <div class="row">
      
        <div class="col-xs-12">
         <br>
          <br>
           <br>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit User </h3>
            </div>
              <?php 

            $attributes = array('id' => 'plus');

            echo form_open_multipart('users/update', $attributes);  ?>
								
									    <div class="box-body">
              <?php echo Modules::run('messages/message/index'); ?>
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
														<option value="1"  <?= $users->status == 1 ? 'selected' :'' ?>>Active</option>
														<option value="0"  <?= $users->status == 0 ? 'selected' :'' ?>> InActive</option>
													</select>
												</div>
											<div class="col-md-8">
										<div class="modal-footer">
												<a href="<?= site_url('users') ?>" class="btn btn-default" >Close</a>
												<button type="submit" class="btn btn-primary">Save changes</button>
											</div>
											</div>
												</div>
									</form>
								
						  </div>

          </div>
          </div>
      

    </section>
  
  </div>
  

 <?php echo Modules::run('footer/footer/index'); ?>

 
      
  
</div>

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.min.js"></script>

<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script type="text/javascript" src="<?= site_url('front/views/themes/default') ?>/assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/fastclick/lib/fastclick.js"></script>

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/adminlte.min.js"></script>
</body>
</html>