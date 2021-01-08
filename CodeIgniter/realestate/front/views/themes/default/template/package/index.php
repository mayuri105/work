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
	        	Best Real Estate Package 
	        </h1>
	        <!-- <h4 class="sub_titl">
	            Wes Anderson American Apparel
	        </h4> -->
   </div>
</header>	
<div class="spacer-60"></div>
    <div class="container">
        <!-- Pricing Section -->
        <section id="pricg_sec">
            <div class="row">

                <!-- Pricing Table 1 -->
                <?php $i=1; foreach ($package as $p): ?>
                    
                <div class="col-xs-4">
                    <div class="pric_tab text-center">

                    <?php 
                        $id  = $p->package_id;
                        $attributes = array('class' => 'form-horizontal', 'id' =>$id ,'name'=>$id);
                        echo form_open('package/buypackage', $attributes);  ?>
                        <input type="hidden" name="package_id" value="<?php echo $p->package_id ?>"> 
                        <h2 class="tab_titl">
                            <?php echo $p->package_name ?>
                        </h2>
                        <div class="pric_ara">
                            <h3 class="pric"> Rs.<?php echo $p->package_price ?><i></i></h3>
                        </div>
                        <ul class="pric_feat">
                            <li>Valid For <strong><?php echo $p->package_periods ?></strong> Days</li>
                            <li>Valid For <strong><?php echo $p->package_category_name ?></strong></li>
                            <!-- <li>Buy One or more same category package and earn reward days</li> -->
                        </ul>
                      <!--   <ul class="pric_feat">
                            <div class="col-md-6 col-md-offset-3 ">
                                <input type="number" Placeholder="Qty" class="form-control">
                            </div>
                            <div class="col-md-6">

                            </div>
                            
                        </ul> -->
                        <br>
                        <p><a href="<?php echo site_url('terms-and-conditions') ?>">Terms &amp; Conditions</a></p> 
                            <button class="pric_btn">Buy Now </button>
                        </form>
                    </div>
                </div>

                <?php if ($i =='3'): ?>
                <div class="spacer-40"></div>
                <?php $i=0; ?>
                <?php endif ?>

                <?php $i++; endforeach ?>

            </div>
            <!-- /.row -->
        </section>
        <div class="spacer-60"></div>
    </div>    
<?php echo Modules::run('footer/footer/index'); ?>


</body>

</html>