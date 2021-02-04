<!DOCTYPE html>
 <html class="no-js" lang="en">
        
<?php echo Modules::run('header/header/head'); ?>
    <body>
        
        <img src="<?= site_url('views/themes/default') ?>/assets/img/placeholders/backgrounds/login_full_bg.png" alt="Login Full Background" class="full-bg animation-pulseSlow">
        
        <div id="login-container" class="animation-fadeIn">
            
            <div class="login-title text-center">
                <h1><i class="fa fa-shopping-cart"></i> <strong>Shopocial</strong> Admin</h1>
            </div>
          
            <div class="block push-bit">
						<form action="<?php echo site_url('login/validateLogin') ?>" method="post" class="form-horizontal form-bordered form-control-borderless" id="loginform">
							
							<?php if($this->session->flashdata('error')){ ?>
							<div class="alert alert-dismissable alert-danger">
								<i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
									<?php 
										echo $this->session->flashdata('error');
									 ?>
								
							</div>
							<?php } ?>
							<div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="text" id="login-email" name="username" class="form-control input-lg" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" id="login-password" name="password" class="form-control input-lg" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-4">
                           
                        </div>
                        <div class="col-xs-8 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Login to Dashboard</button>
                        </div>
                    </div>
                    
                </form>
               
                
				</div>
			</div>
		<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?=  site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?=  site_url('views/themes/default') ?>/assets/js/app.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script>

      $("#loginform").validate(
      {
        rules: 
        {
          
          username: 
          {
            required: true,
            
            
          },
           password: 
          {
            required: true,
           
            
          }
        },
        messages: 
        {
          
          username: 
          {
            required: "Please enter username."
            
          },
           password: 
          {
            required: "Please enter password."
          }
           
          
        }
      }); 
       
</script> 
    </body>
</html> 