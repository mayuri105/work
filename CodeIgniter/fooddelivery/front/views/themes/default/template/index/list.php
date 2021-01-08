<?php echo Modules::run('header/header/account'); ?>
	<?php 
		$type = $this->session->userdata('type');
		$cusine_type = str_replace('-',' ', $this->uri->segment(2));
		
	?>
<div class="page-wrapper">
	<div >
		<div style="background-image: url('<?= getuploadpath().'city/'.$city_data->city_banner_image; ?>');" id="page-header-wrapper" class="no-default header-seo">
			<div class="site-breadcrumb-wrapper" >
				<div class="" >
					<ul id="site-breadcrumb" class="container">
						<li class="crumb" >
							<a itemprop="url" href="<?= site_url() ?>"><span itemprop="title">Home</span></a>
						</li>
						<li class="crumb" >
							<span class="gt">&gt;</span>
							<a href="<?= site_url('cities/'.url_title($city_data->city_name).'/'.url_title($city_data->state).'/'.url_title($type)); ?>" itemprop="url" ><span itemprop="title"><?=  $city_data->city_name; ?></span></a>
						</li>
						<li class="crumb" >
							<span class="gt">&gt;</span>
							<a href="<?= site_url('category/'.url_title($type)) ?>" itemprop="url" ><span itemprop="title"><?=  $type ?></span></a>
						</li>
					</ul>
					<div class="clear-breadcrumbs"></div>                        
				</div>
			</div>
			<div id="page-header">
				<div>
					<h1><?= ucfirst($type) ?> delivering in <?= $city_data->city_name.','.$city_data->state ?> </h1>
					<div>
						<div class="search-field seo" id="mainSearchForm" >                            
							<div id="text-wrapper" ><span class="split-text">Enter your address to get started</span></div>
							<div  data-placeholder="Street Address, City, State" data-search-input-id="address-search" data-pickup-toggle="true" class="search-form">
								<div class="address-search">
									
									<form class="ng-pristine ng-valid" name="main-searchform" action="<?= site_url('search'); ?>" method="GET">
									<div class="delivery-pickup">

                                        <span class="delivery-select <?= $pickordelivery =='delivery' ? 'active' : 'inactive' ?>">Delivery
                                        </span> 
                                        <input type="checkbox"  name="pickordelivery" class="optionpicordel"  <?= $pickordelivery =='pickup' ? 'checked' : '' ?>  > 
                                        <span class="pickup-select <?= $pickordelivery =='pickup' ? 'active' : 'inactive' ?>">Pickup</span>
                                    </div>
									<span class="laundry-toggle-message ng-hide" >Schedule pickup and delivery</span>
									<div class="dropdown-arrow-wrapper" ></div>
									<div dcom-location-based-search="" class="location-based-search-wrapper ng-pristine ng-untouched ng-valid left-toggle" >
										<div class="location-button-wrapper" >
											<span class="icon-location-arrow" ></span>
											<span class="spinner ng-hide"></span>                                        
										</div>
									</div>
									<div class="" id="locationField">
										<input  id="address-search" required placeholder="Street Address, City, State" autocomplete="off" tabindex="1"  type="search">
										
									</div>
									
										<input class="field" name="street_number" type="hidden" id="street_number"disabled="true">
										<input class="field" type="hidden" id="route" disabled="true">
										<input class="field" name="city" type="hidden" id="locality" disabled="true">
										<input class="field" name="state" type="hidden" id="administrative_area_level_1" disabled="true">
										<input class="field" name="zip" type="hidden" id="postal_code" disabled="true">
										<input class="field"  type="hidden" id="country" disabled="true">
										<input class="field" name="type" type="hidden" id="type" value="<?= $type; ?>" disabled="true">
										
									<button type="submit" class="address-search-submit button primary" tabindex="3">Search</button>
								</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div  class="dcom-loader search-results-page ng-hide"></div>
		<div id="main-content-wrapper" class="search-results-page">
			<div id="main-content" class="search-results-page visible" >
				<div class="messages ng-hide">
					<div ></div>
				</div>
			   
				<div  class="order_online_heading">
					<h2>Order online from <strong><?= $totalstore ?> <?= ucfirst($type) ?> Store</strong> delivering <strong></strong> in <strong> <?= $city_data->city_name.','.$city_data->state ?></strong></h2>
				</div>
				<div class="" id="both-col-wrapper" >
					<div id="left-col-filters" class="seo filters-wrapper">
						<div class="filters" >
							<div class="all-filters seo">
								<span class="icon-filters-burger seo" ></span>
								<div>
									<div class="results-search-container" >
										<form class="" >
											<form class="" >
												<input id="search-filter" placeholder="Search by name or cuisine" class="search-in-results seo ng-pristine ng-untouched ng-valid" type="text">
											</form>
											<div style="position: relative">
												<span class="spinner seo ng-hide" ></span>
												<span class="icon-search seo" ></span>
											</div>
										</form>
									</div>
								</div>
								<div class="filters-bar seo" >
									<div class="filter-box seo" >
										<?php foreach ($categories as $category ): ?>
										<div  class="filter options-wrapper <?= $type == $category->type ? 'active' : '' ?>"  >
											<label>
												<a href="<?= strtolower( site_url('cities/'.url_title($city_data->city_name).'/'.url_title($city_data->state).'/'.url_title($category->type))) ?>" >
													<span class="icon-"></span><?=  ucfirst($category->type) ?>
													<!-- <span class="info">(24)</span> -->
												</a>
											</label>
										</div>
										
										<?php endforeach ?>
									</div>
									<?php if ($type== 'food'): ?>
									<div class="filter-box seo" >
										<div>
											<div class="selected">
												<span class="selection-wrapper">
													<span class="selection-label">Browse by cuisines</span>
												</span>
											</div>
											
											<div class="seo-popular-items">
												<div id="popular-cuisine-filters" class="options-wrapper popular-cuisines">
													<div class="popular-cuisines-wrapper" id="popular-cuisines-wrapper">
														<?php 

														?>
														<?php foreach ($cuisine_data as $cd): ?>
																
														   
														<div class="filter inactive <?= $cd->cusine_type== $cusine_type ? 'active' :'inactive'; ?>">
															<label>
																 <a href="<?= strtolower(site_url('food/'. url_title($cd->cusine_type).'/'.url_title($city_data->city_name).'/'.url_title($city_data->state).'')) ?>">
																	<span class="name"><?= ucfirst( $cd->cusine_type); ?></span>
																</a>
															</label>
														</div>
														  <?php endforeach ?>       
													</div>
												</div>
												
											</div>
										</div>
									</div>
									<?php endif ?>
									<div class="filter-box seo" >
										<div>
											<div class="selected">
												<span class="selection-wrapper">
													<span class="selection-label">Browse by neighborhood</span>
												</span>
											</div>
											
											<div class="seo-popular-items">
												<div id="popular-cuisine-filters" class="options-wrapper popular-cuisines">
													<div class="popular-cuisines-wrapper" id="popular-cuisines-wrapper">

														<?php foreach ($cities_data as $city): ?>
																
														   
														<div class="filter <?= $city_data->city_name == $city->city_name ? 'active':'inactive'; ?>" >
															<label>
																 <a href="<?= strtolower(site_url('cities/'. url_title($city->city_name).'/'.url_title($city->state).'/'.url_title($type).'')) ?>"><span class="name"><?= $city->city_name ?></span></a>
															</label>
														</div>
														  <?php endforeach ?>       
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="right-col-filters" class="filters-wrapper seo">
						<div class="filters seo" >
							<div class="sortby-options seo">
								<label for="sortby-combo" >Sort by:</label>
								<select class="ng-pristine ng-untouched ng-valid" id="sortby-combo">
									<option label="Rating" selected="selected" value="rating">Rating</option>
									<option label="Minimum" value="minimumOrder">Minimum</option>
									<option label="A-Z" value="name">A-Z</option>
								</select>
								<span class="dropdown-icon icon-down-arrow-thick"></span>
							</div>
						</div>
						<span class="icon-search seo" ></span>
						<span class="search-icon-down-arrow ng-hide" ></span>
					</div>
				</div>                
				<div class="mobile-only-clear"></div>
				<div class="section-page-wrapper" >
					<section class="search-results seo" >                        
						<div class="set seo" id="appendhere">

							<?php foreach ($store_list as $s): ?>
								
						   
							<div class="item food seo" >
								<div class="discount_wrap" ></div>
								<img src="<?= getuploadpath().'store/'.$s->store_logo.'' ?>" class="merchant-logo" alt="<?= $s->store_name; ?>logo" height="94" width="94">
								<div class="merchant-info">
									<div class="row">
										<a href="<?= strtolower(site_url('cities/'.url_title($city_data->city_name).'/'.url_title($city_data->state).'/'.url_title($type).'/'.$s->unique_alias)) ?>" class="textual-information seo name" >
											<?= $s->store_name ?>
										</a>
										<span class="rating-container ratings aside seo" >
			
											<span class="rating">
												<div>
													<div class="starrating"  data-storeid = "" data-id="" data-rating="<?= $s->rating_avg; ?>"></div>
												</div>
											</span>
											
										</span>
									</div>
									
									<div class="row middle">

										<div class="textual-information not-laundry seo full-width-mobile">
											<div class="top-dishes" ><span><?= $s->store_street; ?></span></div>
										</div>
										<br>
										<div class="aside tags buttons" >
											<a href="<?= strtolower(site_url('cities/'.url_title($city_data->city_name).'/'.url_title($city_data->state).'/'.url_title($type).'/'.$s->unique_alias)) ?>" class="button secondary tag seo" title="Order from <?= $s->store_name; ?>">Order ahead</a>
										</div>
									</div>
									<div class="row footer" ng-include="'result-footer.html'">
										<div class="textual-information not-laundry seo result-footer">
											<span class="atom">$<?= $s->minorder ?> minimum</span>
											<span class="atom"> $<?= $s->delivery_fee ?> delivery fee</span>
										</div>
										<!-- <strong ng-if="matchMedia.smallPortrait" class="new-constraints alert">Next delivery time: ----</strong> -->
									</div>
									

									<div class="row middle extra-info">
										<div class="textual-information seo full-width-mobile"></div>
									</div>

									<div class="row footer" >
										<div class="textual-information seo result-footer"></div>
										<!-- <strong  class="new-constraints alert">Next delivery time: Today at 9:00pm</strong> -->
									</div>
								</div>
							</div>
							 <?php endforeach ?>
						</div> 
						<?php if (!($offset >= $totalstore - 10)): ?>
						<div class="load-more-btn-wrapper">
							<a href="" id="loadMoreResults" class="button secondary">
								<span class="contents">
									<span>Load more restaurants</span>
								</span>
								<span class="spinner"></span>
							</a>
						</div>
						<?php endif ?>
					</section>
				</div>
				<div style="clear:both"></div>
			</div>

		</div>        
	</div>
</div>


<?php echo Modules::run('footer/footer/index'); ?>

<script type="text/javascript">
var elems = Array.prototype.slice.call(document.querySelectorAll('.optionpicordel'));
elems.forEach(function(html) {
  var switchery = new Switchery(html ,{ color: '#6886aa', secondaryColor: '#6886aa', size: 'small' });
});

    
$('.optionpicordel').change(function(){
    var a = $('.optionpicordel').prop('checked');
    if(a){
        $('.pickup-select').removeClass('inactive');
        $('.pickup-select').addClass('active');
        $('.delivery-select').addClass('inactive');
    }else{
        $('.delivery-select').removeClass('inactive');
        $('.delivery-select').addClass('active');
        $('.pickup-select').addClass('inactive');
    }
    
    data ={
        pickordelivery : a
    }
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('setOptiondelorpic') ?>",
        data: data,
        dataType:"json",
        beforeSend: function(){
        },
        success: function(data) {
            
        }
    })
});
$('.starrating').raty({
	score: function() {
	return $(this).attr('data-rating');
	},
  	readOnly: true
});

$(document).ready(function(){

	var totalstore = <?=$totalstore?>;
	var offset = 0;
	var city_id = <?php echo $city_data->city_id ?>;
	var type = '<?php echo $type  ?>';
		$("#loadMoreResults").click(function(e){
			e.preventDefault();
			offset += 10;
			$.get("<?php echo site_url('index/loadmorestore') ?>/"+city_id+'/'+type+'/'+offset, function(data){
				$("#appendhere").append(data);
 
			});
 
			if(offset >= totalstore - 10)
			{
				$("#loadMoreResults").hide();
				//alert('hide');
			}
		})
	})
</script>