<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title ?></title>
   	<?php echo Modules::run('header/header/css') ?>
     <meta itemprop="title" content="<?php echo $meta_titles ?> ">
    <meta itemprop="description" content="<?php echo $meta_descriptions ?>">
    <meta itemprop="keywords" content="<?php echo $meta_keywords ?>">
    
</head>
<body>
<?php echo Modules::run('header/header/index'); ?>

	<!-- Header Stat Banner -->
	<header id="banner" class="stat_bann">
	<div class="bannr_sec">
	    <img src="<?= site_url('front/views/themes/default'); ?>/assets/images/banner_5.jpg" alt="Banner">
	        <h1 class="main_titl">
	        	Best Real Estate Deals site
	        </h1>
	        <!-- <h4 class="sub_titl">
	            Wes Anderson American Apparel
	        </h4> -->
   </div>
</header>	
<div class="spacer-60"></div>
<div class="spacer-60"></div>
    <div class="container">
        <!-- Pricing Section -->
        <section id="pricg_sec">
            <div class="row">
                <h2>Your Payment Failed</h2>   
                <p>Try again after some times or contact us for more support</p>
            </div>
            <!-- /.row -->
        </section>
        <div class="spacer-60"></div>
    </div>    
<?php echo Modules::run('footer/footer/index'); ?>


</body>

</html>