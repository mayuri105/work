<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title><?= $this->lang->line('Loginform') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="">

    <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet' type='text/css'> -->
    <link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">
    <link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">               <!-- Themify Icons -->
    <link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/css/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
        <link type="text/css" href="assets/css/ie8.css" rel="stylesheet">
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->
    
    </head>

    <body class="focused-form animated-content">
        
        
<div class="container" id="login-form">
		<a href="<?= site_url(); ?>" class="login-logo">
			<!-- <img src="assets/img/logo-big.png"> -->
		</a>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2><?= $this->lang->line('Loginform') ?></h2>
					</div>
					<div class="panel-body">
						
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'validate-form');
						echo form_open('login/validateLogin', $attributes);  ?>
							
							<?php if($this->session->flashdata('error')){ ?>
							<div class="alert alert-dismissable alert-danger">
								<i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
									<?php 
										echo $this->session->flashdata('error');
									 ?>
								
							</div>
							<?php } ?>
							<div class="form-group mb-md">
		                        <div class="col-xs-12">
		                        	<div class="input-group">							
										<span class="input-group-addon">
											<i class="ti ti-user"></i>
										</span>
										<input type="text" name="username" class="form-control" placeholder="<?= $this->lang->line('username'); ?>" data-parsley-minlength="6" placeholder="At least 6 characters" >
									</div>
		                        </div>
							</div>

							<div class="form-group mb-md">
		                        <div class="col-xs-12">
		                        	<div class="input-group">
										<span class="input-group-addon">
											<i class="ti ti-key"></i>
										</span>
										<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="<?= $this->lang->line('password'); ?>">
									</div>
		                        </div>
							</div>

							
							<div class="form-group mb-n">
								<div class="col-xs-12">
									<a href="<?php echo site_url('login/forgetpassword') ?>" class="pull-left">Forgot password?</a>
									<!-- <div class="checkbox-inline icheck pull-right p-n">
										<label for="">
											<input type="checkbox"></input>
											Remember me
										</label>
									</div> -->
								</div>
							</div>
						
					</div>
					<div class="panel-footer">
						<div class="clearfix">
							
							<button type="submit" class="btn btn-primary pull-right">Login</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
</div>

<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/velocityjs/velocity.ui.min.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/application.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/demo/demo.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/demo/demo-switcher.js"></script>
</body>
</html>