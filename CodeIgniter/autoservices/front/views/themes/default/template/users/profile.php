
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| Profile</title>
 
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
        <li class="active">Profile</li>
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
              <h3 class="box-title">Update Profile</h3>
            </div>
            
									
								<?php 
								$attributes = array( 'id' => 'profile');
								echo form_open('users/updateprofile', $attributes);  ?>	
								<div class="box-body">
								 <?php echo Modules::run('messages/message/index'); ?>
								<div class="col-xs-6">
								<input type="hidden" name="u_id" id="u_id" value="<?= $users->u_id; ?> " class="form-control">
									<div class="form-group">
									
										<label >User Name</label>
										
											<input type="text" name="user_name" id="user_name" value="<?= $users->username; ?>" class="form-control">
										</div>
									</div>
									
									<div class="col-xs-6">
									<div class="form-group">
										<label>First Name</label>
										
											<input type="text" name="first_name"  id="first_name" value="<?= $users->first_name; ?>" class="form-control">
										</div>
									</div>
									<div class="col-xs-6">
									<div class="form-group">
										<label >Last Name</label>
										
											<input type="text" name="last_name" id="last_name"  value="<?= $users->last_name; ?>"  value=""class="form-control">
										</div>
									</div>
									<div class="col-xs-6">
									<div class="form-group">
										<label >Email</label>
										
											<input type="text" name="email" id="email" value="<?= $users->email; ?>"  class="form-control">
										</div>
									</div>
									<div class="col-xs-6">
									<div class="form-group">
										<label >Current Password</label>
										
											<input type="password" name="curpassword"  value="" class="form-control">
										</div>
									</div>
									<div class="col-xs-6">
									<div class="form-group">
										<label >New Password</label>
										
											<input type="password" name="newpassword"  value="" class="form-control">
										</div>
									</div>
									
								</div>

								<div class="box-footer">
									<a type="button" href="<?= site_url('home') ?>" class="btn btn-default" >Close</a>
									<button type="submit" class="btn btn-primary">Update changes</button>
								</div>
								
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
<script>
    $(document).ready(function(){
        var date_input=$('input[name="certificate_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'yyyy-mm-dd',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="issue_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'yyyy-mm-dd',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="validity_from_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'yyyy-mm-dd',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="validity_to_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'yyyy-mm-dd',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
   
</script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $("#profile").validate(
      {
        rules: 
        {
          username: 
          {
            required: true
    
          },
          first_name: 
          {
            required: true
            
          },
           last_name: 
          {
            required: true
            
          },
           email: 
          {
            required: true,
            email: true
            
          }
        },
        messages: 
        {
          username: 
          {
            required: "Please enter username."
          },
          first_name: 
          {
            required: "Please enter firstname."
          }
          ,
          lastname: 
          {
            required: "Please enter lastname."
          }
          ,
          email: 
          {
          	
            required: "Please enter email."
          }
          
        }
      });   
    
    
</script>
</body>
</html>
