<div >
	<?php if (isset($cuisine)): ?>
		<div class="cuisine-container" >
			<h3>Browse by Cuisine</h3>
			<?php $upload_path =  base_url().'upload/cuisine/'; ?>
			<?php $i =0; foreach($cuisine as $c): 
			 ?>
			<?php if ($c->featured_on): ?>
			<a href="<?= site_url('food/'.url_title(strtolower($c->cusine_type)).''); ?>">
				<div class="overlay"></div><h4><?= $c->cusine_type;?>
				</h4>
				<img src="<?= $upload_path.$c->cuisine_image_url ?>" class="b-lazy " alt="Order <?= $c->cusine_type;?> for delivery or takeout" >
			</a>
			<?php endif; ?>
			<?php  $i++; endforeach; ?>
			<div class="clearfix"></div>
			<table id="cuisines-list">
				<tbody>
					
					<tr>
						<?php $b =1;  foreach ($cuisinelist as $ct): ?>
						<?php echo $b =='1' ? '<td>' :'' ?>
							<a href="<?= site_url('food/'.url_title(strtolower($ct->cusine_type)).''); ?>" ><?= $ct->cusine_type; ?></a>
						 <?php echo $b =='3'  ? '<td>' :''  ?>
						<?php if($b==3){ $b =0 ;}  $b++; endforeach; ?>
					   
					</tr>
				</tbody>
			</table>   
		</div>
	<?php endif ?>
	<div class="city-container">
		<h3>Browse by City</h3>
		<?php $upload_pathcity =  base_url().'upload/city/'; ?>
		<?php $upload_pathlarge = getuploadpath().'city/large/'; ?>
		<?php $uploadpathsmall = getuploadpath().'city/small/'; ?>
		<?php $j = 1; foreach ($city as $cit ): ?>
			

		<?php if ($cit->feature_city): ?>
			
		<?php if ($j=='1' || $j=='4' ): ?>
			<a href="<?= strtolower(site_url('cities/'. url_title($cit->city_name).'/'.url_title($cit->state).'/'.url_title($type).'')) ?>" class="<?= $j==1 || $j == 4 ? 'long-city' : 'city'?>">
				<div class="overlay long-city"></div><h4><?php echo $cit->city_name.' '.$cit->state; ?></h4>
				<img src="<?= $upload_pathlarge.$cit->city_image_url ?>" alt="Get food, alcohol, groceries and laundry delivery in <?php echo $cit->city_name.' '.$cit->state; ?>">
			</a> 
		<?php else: ?>
			<a href="<?= strtolower(site_url('cities/'. url_title($cit->city_name).'/'.url_title($cit->state).'/'.url_title($type).'')) ?>" class="<?= $j==1 || $j == 4 ? 'long-city' : 'city'?>">
				<div class="overlay long-city"></div><h4><?php echo $cit->city_name.' '.$cit->state; ?></h4>
				<img src="<?= $uploadpathsmall.$cit->city_image_url ?>" alt="Get food, alcohol, groceries and laundry delivery in <?php echo $cit->city_name.' '.$cit->state; ?>">
			</a> 
		<?php endif ?>

		<?php endif ?>
		<?php if ($j=='4'): ?>
		<?php $j=0; ?>
		<?php endif ?>
		<?php $j++;


		endforeach ?>

		 <table id="cities-list">
			<tbody>
				<tr>
					<?php $k =1;  foreach ($citylist as $ct): ?>
					<?php echo $k =='1' ? '<td>' :'' ?>
						<a href="<?= strtolower(site_url('cities/'. url_title($ct->city_name).'/'.url_title($ct->state).'/'.url_title($type).'')) ?>" ><?= $ct->city_name.','.$ct->state; ?><span>(<?= $ct->count ?>)</span></a>
					 <?php echo $k =='3'  ? '<td>' :''  ?>
					<?php if($k==3){ $k =0 ;}  $k++; endforeach; ?>
					<!-- <a href="" >See All Cities</a> -->
				</tr>
			</tbody>
		</table>   
	</div>
	

	<div class="category-container">

		<h3>Browse by Category</h3>
		<?php foreach ($categories as $category ): ?>
			
		
		<a href="<?php echo site_url('category/'.url_title($category->type)) ?>">
			<div class="category-img-container">
				<img src="<?= getuploadpath().'category/'.$category->category_image_url; ?>"  class="b-lazy b-loaded catimage" alt="Order food for delivery" >
			</div>
			<h4><?= $category->type ?></h4>
		</a> 
		<?php endforeach ?>

	</div>
</div>
