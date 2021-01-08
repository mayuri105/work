<!DOCTYPE html>
<html  class="no-js">
	
	<head>

		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta property="og:title" content="<?= $meta_titles ?>"/>
	    <meta property="og:type" content="website"/>
	    <meta property="og:url" content="<?php echo site_url() ?>"/>
	    <meta property="og:site_name" content="<?= $title ?>"/>
	    <meta property="og:description" content="<?= $meta_descriptions ?>"/>
	    <meta property="og:keywords" content="<?= $meta_keywords ?>"/>
	    
		<title ><?= $title ?></title>
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/css/index.css">
		<script src="<?= site_url('front/views/themes/default'); ?>/plugins/switcher/switchery.js"></script>
		<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/plugins/odometer/odometer-theme-minimal.css">
		<script src="<?= site_url('front/views/themes/default'); ?>/plugins/odometer/odometer.min.js"></script>
		
	</head>

	<body class="page-home <?php if($bodyclass) echo $bodyclass ?>">

		<div id="site-wrapper" class="site-wrapper" >

			<div class="view-wrapper" id="view-wrapper">

				<div  id="site-header-wrapper">

					<header  id="site-header">

						<div class="logo"><a href="<?php echo site_url(); ?>"><?= $title ?></a></div>
						
						<?php if(is_login()){ ?>
							
						
						<div  class="main-nav-item ">
							
							<div onclick="toggleAccountNav()" class="status match-media-small">
								<?php echo substr($username, 0,10); ?> <span class="icon-down-arrow-thick"></span>
							</div>

						</div>
						<nav  class="header-module account-nav" style="display: none;">
						    <ul>
						        <li  onclick="toggleAccountNav()" class="">

						        	<a href="<?= site_url('account/points') ?>" class="points">
						        		<span class="icon-trophy"></span> 
						        		<?php 
	                                		echo $points;
										 ?>
						        		 points
						        	</a>
						        </li>
						        <li onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/orders') ?>">Order history</a></li>
						        <li  onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/tell-a-friend') ?>">Tell a friend</a></li>
						        <li onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/profile') ?>">Profile</a></li>
						        <li onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/addresses') ?>">Addresses</a></li>
						        
						       	<li onclick="toggleAccountNav()" class=""><a href="<?= site_url('account/wallets') ?>">Wallets</a></li>
						        <li><a href="<?php echo site_url('login/logout') ?>" class="">Log out</a></li>
						    </ul>
						</nav>
						<?php }else{ ?>

						<div class="main-nav-item" >
							<div class="status match-media-small login-nav-item"  >Log in</div>                    
						</div>
						<?php } ?>
						
						<!-- <div class="main-nav-item no-link match-media-small" ><a >Chat&nbsp; <span class="icon-chat"></span></a></div> -->

						<div class="main-nav-item match-media-small" >
							<div class="status" onclick="toggleTafNav();"  >Get <span >$<?= $refbycredits; ?></span></div>
							<?php if (!$this->session->c_id): ?>
							<div  class="header-module taf-nav no-user-data" style="display: none;">
								<div >
									<h2>Tell a friend!</h2>
									<p class="sub-title">You'll <span>each get <span >$</span><?= $refbycredits; ?></span> when they order.</p>
									<p class="share-bottom"><a href="#" class="login-nav-item" >Log in</a> or <a href="#" class="sign-in-click" >create new account</a> to start inviting and earning.</p>
								</div>
							</div>   
							<?php else: ?>  
							<div  class="header-module taf-nav"  style="display: none;">
								   
								    <div >
								        <h2>Tell a friend!</h2>
								        <p class="sub-title">You'll <span>each get 
								        	<span>$13</span>
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
						<div class="header-module hiw-nav-laundry" style="display: none;">
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
						<div class="header-module hiw-nav" style="display: none;">
						    <div class="mktg-callouts">
						       
						        <div >
						            <!-- <div onclick="toggleHiwDisplay()" class="how-laundry-works">How laundry works</div> -->
						            <div class="callout"><span class="icon-order-confirmation"></span>
						                <h3>Place your order</h3>
						                <p>Enter your address, find what you're looking for, and easily order from the best restaurants and stores in your neighborhood.</p>
						            </div>
						            <div class="callout"><span class="icon-merchant"></span>
						                <h3>We handle the rest</h3>
						                <p>We work with the merchant to make sure everything is ready for delivery or pickup. Then we'll send you a confirmation.</p>
						            </div>
						            <div class="callout"><span class="icon-delivery-guy"></span>
						                <h3>The merchant arrives...</h3>
						                <p>...or you pick it up. Either way, you'll get 25 Delivery Points for every $1 spent, which you can cash in for awesome rewards.</p>
						            </div>
						        </div>
						        
						    </div>
						</div>
					</header>

				</div>

			</div>