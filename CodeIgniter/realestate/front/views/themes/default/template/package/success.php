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
		<div class="container">
				<!-- Pricing Section -->
				<section id="pricg_sec">
						<div class="row">

								<!-- Pricing Table 1 -->
							 
										<div class="col-xs-12">
												<h3 class="text-center">Your package subscription successfully</h3>   
												<div class="spacer-30"></div>
												<table class="table table-bordered">
												<thead>
													<tr>
														<th>Order Id</th>
														<th>Package Name</th>
														<th>Package Price</th>
													</tr>
												</thead>
												<tbody>
														<?php foreach ($active_package as $p): ?>
														<tr>
															<td><?php echo $p->cp_id ?></td>
															<td><?php echo $p->package_name ?></td>
															<td>Rs.<?php echo $p->package_price ?></td>
														</tr>
														 <?php endforeach ?>
												</tbody>
											</table>
										
										</div>

							 
								 <div class="col_labls larg_labl text-center">
										<div class="blu_labl">
												<!-- <a href="<?php echo site_url('appointment') ?>" class="pric_btn">Schedule Appointment Now</a> -->
										
										</div>
								</div>
						</div>
						<!-- /.row -->
				</section>
				<div class="spacer-60"></div>
		</div>    
<?php echo Modules::run('footer/footer/index'); ?>


</body>

</html>