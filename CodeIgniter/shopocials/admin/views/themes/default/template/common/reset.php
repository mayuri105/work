<!doctype html>

<html lang="en" class="no-js">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Belmont Reset Password</title>

<!-- Font awesome -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/font-awesome.min.css">

<!-- Sandstone Bootstrap CSS -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap.min.css">

<!-- Bootstrap Datatables -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/dataTables.bootstrap.min.css">

<!-- Bootstrap social button library -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-social.css">

<!-- Bootstrap select -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-select.css">

<!-- Bootstrap file input -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/fileinput.min.css">

<!-- Awesome Bootstrap checkbox -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/awesome-bootstrap-checkbox.css">

<!-- Admin Stye -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/style.css">

<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

<style>
.error {
	color:#F00;
}
</style>
</head>

<body>
<div class="login-page bk-img" style="background-image: url(<?= site_url('front/views/themes/default') ?>/assets/img/login-bg.jpg);">
  <div class="form-content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <?php if($this->session->flashdata('error')){ ?>
          <div class="alert alert-dismissable alert-danger"> <i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
            <?php 

										echo $this->session->flashdata('error');

									 ?>
          </div>
          <?php } ?>
          <?php if($this->session->flashdata('success')){ ?>
          <div class="alert alert-dismissable alert-success"> <i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
            <?php 

										echo $this->session->flashdata('success');

									 ?>
          </div>
          <?php } ?>
          <div class="login">
          <h1 class="text-center text-bold text-light mt-4x">Reset Password</h1>
          <div class="well row pt-2x pb-3x bk-light">
            <div class="col-md-8 col-md-offset-2">
              <?php 
						$attributes = array( 'id' => 'resetpass');
						echo form_open('login/updatepassword', $attributes);  ?> 
            
              <p>
              <input type="hidden"  id="UniqueId" name="UniqueId"  value="<?php echo $UniqueId ?>" >
                <label for="password" class="text-uppercase text-sm">Password</label>
                <input type="password" placeholder="Password" name="PasswordHash" id="PasswordHash" class="form-control mb" size="40">
              </p>
              <p>
                <label for="password" class="text-uppercase text-sm">Confirm Password</label>
                <input type="password" placeholder="Password" name="cPasswordHash" id="cPasswordHash" class="form-control mb" size="40">
              </p>
              <button class="btn btn-primary btn-block" type="submit">Reset</button>
             <a class="btn btn-primary btn-block" href="<?= site_url('login') ?>" >Login</a>
              </form>
            </div>
          </div>
          </div>
           
          
         
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Loading Scripts --> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.min.js"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/bootstrap-select.min.js"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/bootstrap.min.js"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.dataTables.min.js"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/dataTables.bootstrap.min.js"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/Chart.min.js"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/fileinput.js"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/chartData.js"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/main.js"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/lib/jquery.js"></script>

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.validate.min.js" type="text/javascript"></script>
 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/additional-methods.min.js" type="text/javascript"></script>

<script>

	  $("#resetpass").validate(
      {
        rules: 
        {
          
          PasswordHash: 
          {
            required: true,
			minlength:3
			
            
          },
		  cPasswordHash: 
          {
            required: true,
			equalTo:PasswordHash
            
          }
        },
        messages: 
        {
          
          PasswordHash: 
          {
            required: "Please enter your New Password.",
			minlength:"Please enter atleast  3 Character"
          },
		  cPasswordHash: 
          {
            required: "Please enter your  Confirm Password.",
			equalTo:"Please Confirm Password"
			
          }
		  
        }
      }); 
</script>

</body>
</html>