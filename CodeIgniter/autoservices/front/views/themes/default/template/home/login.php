<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/AdminLTE.min.css">
  <!-- iCheck -->
 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
.error {
  
  
  color:#F00;
  
}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= site_url('home') ?>"><b>JMD</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login </p>
    <?php if($this->session->flashdata('error')){ ?>
        <div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
            <?php 

                    echo $this->session->flashdata('error');

                   ?>
          </div>
          <?php } ?>
          <?php if($this->session->flashdata('success')){ ?>
         <div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
            <?php 

                    echo $this->session->flashdata('success');

                   ?>
          </div>
          <?php } ?>
     <?php 

            $attributes = array('class' => 'form-horizontal', 'id' => 'logform');

            echo form_open('login/validateLogin', $attributes);  ?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      
      </div>
    </form>

    

  </div>
 
</div>

<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/jquery/dist/jquery.min.js"></script>

<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $("#logform").validate(
      {
        rules: 
        {
          username: 
          {
            required: true
    
          },
          password: 
          {
            required: true
            
          }
        },
        messages: 
        {
          username: 
          {
            required: "Please enter your Username."
          },
          password: 
          {
            required: "Please enter your Password."
          }
        }
      });   
    
    
</script>


</body>
</html>
