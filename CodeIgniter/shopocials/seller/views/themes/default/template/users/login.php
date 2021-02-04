<!DOCTYPE html>
<html class="no-js" lang="en">

   <head>
        <meta charset="utf-8">

        <title>ProUI - Responsive Bootstrap Admin Template</title>

        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
        <link rel="shortcut icon" href="<?= site_url('views/themes/default') ?>/assets/img/favicon.png">

        <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/bootstrap.min.css">

       <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/plugins.css">

        <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/main.css">


        <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/themes.css">

        <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/modernizr.min.js"></script>
   </head>
    <body>

        <img src="<?= site_url('views/themes/default') ?>/assets/img/placeholders/backgrounds/login_full_bg.png" alt="Login Full Background" class="full-bg animation-pulseSlow">

        <div id="login-container" class="animation-fadeIn">

            <div class="login-title text-center">
                <h1><i class="gi gi-flash"></i> <strong>Shopocial</strong><br><small>Please <strong>Login</strong> </small></h1>
            </div>

            <div class="block push-bit">

                <form action="<?php echo site_url('login/validateLogin') ?>" method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">
                <?php if($this->session->flashdata('error')){ ?>
							<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

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
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <a href="javascript:void(0)" id="link-reminder-login"><small>Forgot password?</small></a>

                        </div>
                    </div>
                </form>

                <form action="<?php echo site_url('login/setforgotpassword') ?>" method="post" id="form-reminder" class="form-horizontal form-bordered form-control-borderless display-none">

                <?php if($this->session->flashdata('error')){ ?>

								<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php
										echo $this->session->flashdata('error');
										echo $this->session->flashdata('success');
									 ?>

							</div>
							<?php } ?>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="text" id="reminder-email" name="username" class="form-control input-lg" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Reset Password</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                             <a href="javascript:void(0)" id="link-reminder"><small>Login</small></a>
                        </div>
                    </div>
                </form>

            </div>

        </div>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/pages/login.js"></script>
        <script>$(function(){ Login.init(); });</script>



    </body>
</html>