<!DOCTYPE html>
<html id="ng-app" class="no-js"><!--<![endif]-->
	
	<head>
		<title ><?= $title ?></title>
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/css/index.css">
		<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/css/krafty.css">
		<script src="<?= site_url('front/views/themes/default'); ?>/plugins/alertifyjs/alertify.min.js"></script>
		<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/plugins/alertifyjs/alertify.core.css">
		<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/plugins/alertifyjs/alertify.bootstrap.css">
		<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/plugins/rating/jquery.raty.css">
		<script src="<?= site_url('front/views/themes/default'); ?>/plugins/rating/jquery.raty.js"></script>
		<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/plugins/odometer/odometer-theme-minimal.css">
		<script src="<?= site_url('front/views/themes/default'); ?>/plugins/odometer/odometer.min.js"></script>
		<script type="text/javascript">
			var url = '<?php echo site_url(); ?>';
			var assets =url+'front/views/themes/default/plugins/rating/images';
			$.fn.raty.defaults.path = assets;
		</script>
		<script src="<?= site_url('front/views/themes/default'); ?>/plugins/switcher/switchery.js"></script>
		
	</head>
	<body class="<?php echo $bodyclass; ?>" >

		<div id="site-wrapper" class="site-wrapper" >

			<div class="view-wrapper" id="view-wrapper">

				<div  id="site-header-wrapper">

					<header  id="site-header">

						<div class="logo"><a href="<?php echo site_url(); ?>">delivery.com</a></div>
						
						<?php if(is_login()){ ?>
							
						
						<div  class="main-nav-item ">
							
							<div onclick="toggleAccountNav()" class="status match-media-small">
									<?php echo substr($username, 0,10); ?>  <span class="icon-down-arrow-thick"></span>
							</div>

						</div>
						<nav  class="header-module account-nav" style="display: none;">
						     <ul>
						        <li  onclick="toggleAccountNav()" class="">

						        	<a href="<?= site_url('account/points') ?>" class="points">
						        		<span class="icon-trophy"></span>
						        		 <?php 
	                                		echo $points;
										 ?>points
						        	</a>
						        </li>
						        <li onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/orders') ?>">Order history</a></li>
						        <li onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/tell-a-friend') ?>">Tell a friend</a></li>
						        <li onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/profile') ?>">Profile</a></li>
						        <li onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/addresses') ?>">Addresses</a></li>
						        <li onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/wallets') ?>">Wallets</a></li>
						        <li><a href="<?php echo site_url('login/logout') ?>" class="">Log out</a></li>
						    </ul>
						</nav>
						<?php }else{ ?>

						<div class="main-nav-item" >
							<div class="status match-media-small login-nav-item" >Log in</div>                    
						</div>
						<?php } ?>
						<!-- <div class="main-nav-item no-link match-media-small" ><a >Chat&nbsp; <span class="icon-chat"></span></a></div> -->

						<div class="main-nav-item match-media-small" >
							<div class="status" onclick="toggleTafNav();"  >Get <span >$ <?= $refbycredits; ?></span></div>
							<?php if (!$this->session->c_id): ?>
							<div  class="header-module taf-nav no-user-data" style="display: none;">
								<div >
									<h2>Tell a friend!</h2>
									<p class="sub-title">You'll <span>each get <span >$</span><?= $refbycredits; ?></span> when they order.</p>
									<p class="share-bottom"><a href="#" >Log in</a> or <a href="#" >create new account</a> to start inviting and earning.</p>
								</div>
							</div>   
							<?php else: ?>  
							<div  class="header-module taf-nav"  style="display: none;">
								   
								    <div >
								        <h2>Tell a friend!</h2>
								        <p class="sub-title">You'll <span>each get 
								        	<span>$<?= $refbycredits; ?></span>
								            </span> when they order.</p>
								        <p class="share-title">Share this link:</p>
								       <input type="text" value="<?= site_url('share?code='.$refbycode.'') ?>">
								        <p class="share-bottom">Click <a onclick="toggleTafNav()" href="<?= site_url('account/tell_a_friend') ?>">here</a> for more ways to share.</p>
								    </div>
								    <!-- end ngIf: userData -->
							</div>
						<?php endif ?>
						</div>

						<div class="main-nav-item match-media-small" ><div class="status" onclick="toggleHiwNav();">How It Works</div></div>
						<div class="header-module hiw-nav" style="display: none;">
							<div class="mktg-callouts">
								<div >
									<div class="how-food-works" >How food, alcohol and groceries work</div>
									<div class="callout">
										<span class="icon-merchant"></span>
										<h3>Pick a cleaner</h3>
										<p>Customize your service with wash &amp; fold, dry cleaning, and tailoring options, and pick the best cleaner in your area based on convenience, reviews, and ratings.</p>
									</div>
									<div class="callout">
										<span class="icon-clock"></span>
										<h3>Schedule pickup and delivery</h3>
										<p>Easily arrange pickup and delivery times around your schedule, so that you can focus on the fun stuff and leave the laundry to the pros.</p>
									</div>
									<div class="callout">
										<span class="icon-dollar-sign"></span>
										<h3>Know what you’re paying for</h3>
										<p>Give us a laundry list with special instructions, or simply say, "Come get my clothes." You'll get an instant quote and a final update before the cleaner begins work.</p>
									</div>

								</div>
							</div>
						</div>

					</header>

				</div>

				
