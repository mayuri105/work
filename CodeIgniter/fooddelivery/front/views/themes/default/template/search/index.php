<?php echo Modules::run('header/header/account'); ?>
<?php $url = $this->input->get();
$url2 = $this->input->get(); 
$url3 = $this->input->get()  ?>
	<div class="page-wrapper" >
<?php switch ($type) {
	case 'food':
		$data = 'group-bg-f';
		break;
	 case 'grocery':
		$data = 'group-bg-g';
		break;
	 case 'liquor':
		$data = 'group-bg-b';
		break;
	 case 'cleaner':
		$data = 'group-bg-l';
		break;
	default:
		$data = 'group-bg-f';
		break;
} ?>
		<div id="page-header-wrapper" class="no-default <?= $data; ?>">
			
			<div  class="sub-navigation-wrapper">
				<div >
				   
					<div >
						<div class="container">
							
							<ul  class="match-media-small">
								<li  class="home-nav"><a >Search</a></li>
								<li class="merchant-nav"><a >Pick merchant</a></li>
								<li class="menu-nav"><a >Create order</a></li>
								<li class="checkout-nav"><a>Checkout</a></li>
							</ul>
							
							<div  class="order-time ng-pristine ng-untouched ng-valid">
								
								<div class="order-time-menu ng-hide">
									<select id="orderTypeMenu" class="ng-pristine ng-untouched ng-valid">
										<option value="0" selected="selected" label="delivery">delivery</option>
										<option value="1" label="pickup">pickup</option>
									</select>
									<select id="orderDateMenu" class="ng-pristine ng-untouched ng-valid">
										
									</select>
									<select id="orderTimeMenu" class="ng-pristine ng-untouched ng-valid">
									   
									</select>
									<a dcom-processing="false" ng-class="{'disabled' : processingDisabled}" class="button primary" ng-click="updateOrderType()"><span ng-transclude="" class="contents"><span class="cta">Update</span></span><span class="spinner"></span></a><span class="cancel" ng-click="toggleTimeDisplay(false)"></span>
								</div>
							</div>
						   
							<div class="clear"></div>
						</div>
					</div>
					
				</div>
			</div>

			<div id="page-header">
				<div class="tab-wrapper">
					<div class="group-arrow v-left-arrow ng-hide" >
						<a class="group-icon-arrow icon-left-arrow"></a>
					</div>
					<div class="verticals-wrapper">
						<ul class="header-tabs">
							<li class="tab food-tab <?= $type=='food' ? 'active' : '' ?> food tab-index-0" >
								<a href =" <?= site_url('search?type='.'food'.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].''); ?>">
									<span class="icon-food"></span>
									Food
								</a>
							</li>
							<li  class="tab alcohol-tab alcohol  <?= $type=='liquor' ? 'active' : '' ?> tab-index--1" >
								<a href =" <?= site_url('search?type='.'liquor'.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].''); ?> " class=""><span class="icon-alcohol"></span> 
									Alcohol
								</a>
							</li>
							<li class="tab groceries-tab  <?= $type=='grocery' ? 'active' : '' ?> groceries" >
								<a href =" <?= site_url('search?type='.'grocery'.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].''); ?>" class="">
									<span class="icon-groceries"></span> 
									Groceries
								</a>
							</li>
							<li class="tab laundry-tab laundry  <?= $type=='cleaner' ? 'active' : '' ?> tab-index-1" >
								<a href =" <?= site_url('search?type='.'cleaner'.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].''); ?>" class="">
									<span class="icon-laundry"></span> 
									Laundry
								</a>
							</li>
						</ul>
					</div>
					<div  class="group-arrow v-right-arrow ng-hide">
						<a class="group-icon-arrow icon-arrow"></a>
					</div>
				</div>
			</div>
		</div>
		<div id="main-content-wrapper" class="search-results-page">
			<div id="main-content" class="search-results-page visible" >
				<div class="messages ng-hide">
					<div ></div>
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
													   <?php if ($cuisine_data):
														 $cusine_type = $cusine;
														?>
													   <?php foreach ($cuisine_data as $cd): ?>
														<div class="filter  <?= $cd->cusine_type== $cusine_type ? 'active' :'inactive'; ?>">
															<label>
																 <a href="<?= site_url('search?type='.'food'.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&cusine='.url_title($cd->cusine_type).''); ?>">
																	<span class="name"><?= ucfirst( $cd->cusine_type); ?></span>
																</a>
															</label>
														</div>
														<?php endforeach ?>       
														<?php endif ?>
														<div class="filter ">
															<label>
																<?php 
																	unset($url['cusine']);	
																	$base_url = http_build_query($url);
																 ?>	

																 <a href="<?php echo current_url().'?'.$base_url; ?>">
																	<span class="name">Clear Filter</span>
																</a>
															</label>
														</div>
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
														<?php if ($cities_data){
														foreach ($cities_data as $city): ?>
															<?php if ( $address['city'] != $city->city_name): ?>
																
															
															<div class="filter <?= $address['city'] == $city->city_name ? 'active':'inactive'; ?>" >
																<label>
																	 <a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$city->city_name.'&state='.$city->state.'&zip='.$address['zip'].''); ?>"><span class="name"><?= $city->city_name ?></span></a>
																</label>
															</div>
															<?php endif ?>
														  <?php endforeach ?>   
														  <?php }else{ ?>    
															<div class="filter" >
															<label>
																<a href=""><p>No City Founds</p></a>
															</label>
															</div>
														  <?php } ?>
													</div>
												</div>
												
											</div>
										</div>
									</div>
									<div class="filter-box seo">
										<div>
											<div class="selected">
													<span class="selection-wrapper">
														<span class="selection-label">Browse by Rating</span>
												</span>
											</div>
											<div class="seo-popular-items">
												<div id="popular-cuisine-filters" class="options-wrapper popular-cuisines">
													<div class="popular-cuisines-wrapper" id="popular-cuisines-wrapper">
													   	<?php $rat = $rating; ?>
													   	<div class="filter <?= $rating== 5 ? 'active':'' ?> ">
															<label>
																 <a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&rat='.'5'.''); ?>">

																	<span class="name"><div class="starrating"  data-storeid = "" data-id="" data-rating="5"></div></span>
																</a>
															</label>
														</div>
														<div class="filter <?= $rating== 4 ? 'active':'' ?>">
															<label>
																 <a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&rat='.'4'.''); ?>">
																		<div class="starrating"  data-storeid = "" data-id="" data-rating="4"></div>
																</a>
															</label>
														</div>
														<div class="filter <?= $rating== 3 ? 'active':'' ?>">
															<label>
																 <a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&rat='.'3'.''); ?>">

																 	<div class="starrating"  data-storeid = "" data-id="" data-rating="3"></div>
																	
																</a>
															</label>
														</div>
														<div class="filter <?= $rating== 2 ? 'active':'' ?>">
															<label>
																 <a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&rat='.'2'.''); ?>">

																 	<div class="starrating"  data-storeid = "" data-id="" data-rating="2"></div>
																	
																</a>
															</label>
														</div>
														<div class="filter ">
															<label>
																<?php 
																	unset($url2['rat']);	
																	$base_url2 = http_build_query($url2);
																 ?>	
																 <a href="<?php echo current_url().'?'.$base_url2; ?>"  class="">
																	<span class="name">Clear Filter</span>
																</a>
															</label>
														</div>	
														 
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="filter-box seo">
										<div>
											<div class="selected">
													<span class="selection-wrapper">
														<span class="selection-label">Min. delivery</span>
												</span>
											</div>
											<div class="seo-popular-items">
												<div id="popular-cuisine-filters" class="options-wrapper popular-cuisines">
													<div class="popular-cuisines-wrapper" id="popular-cuisines-wrapper">
														
													   	<div class="filter <?= $min== 1 ? 'active':'' ?>">
															<label>
																 <a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&min='.'0'.''); ?>">
																	<span class="name">Free</span>
																</a>
															</label>
														</div>
													   	<div class="filter <?= $min== 5 ? 'active':'' ?>">
															<label>
																 <a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&min='.'5'.''); ?>">

																	<span class="name"><$5</span>
																</a>
															</label>
														</div>
														<div class="filter <?= $min== 10 ? 'active':'' ?>">
															<label>
																 <a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&min='.'10'.''); ?>">

																	<span class="name"><$10</span>
																</a>
															</label>
														</div>
														<div class="filter <?= $min== 15 ? 'active':'' ?>">
															<label>
																<a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&min='.'15'.''); ?>">

																	<span class="name"><$15</span>
																</a>
															</label>
														</div>
														<div class="filter <?= $min== 20 ? 'active':'' ?>">
															<label>
																 <a href="<?= site_url('search?type='.$type.'&street_number='.$address['street_number'].'&city='.$address['city'].'&state='.$address['state'].'&zip='.$address['zip'].'&min='.'20'.''); ?>">

																	<span class="name"><$20</span>
																</a>
															</label>
														</div>
														<div class="filter ">
															<label>
																 <?php 
																	unset($url3['min']);	
																	$base_url3 = http_build_query($url3);
																 ?>	
																 <a href="<?php echo current_url().'?'.$base_url3; ?>"  class="">
																	<span class="name">Clear Filter</span>
																</a>
															</label>
														</div>
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
								<select class="ng-pristine ng-untouched ng-valid" id="sortby">
									<option label="Rating"  value="rating" <?= $this->session->userdata('orderby') == 'rating' ? 'selected' : ''; ?> >Rating</option>
									<option label="Minimum" value="minimumOrder" <?= $this->session->userdata('orderby')== 'minimumOrder' ? 'selected' : ''; ?> >Minimum</option>
									<option label="A-Z"   value="name"  <?= $this->session->userdata('orderby')== 'name' ? 'selected' : ''; ?>>A-Z</option>
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
							<?php if ($store_list){ ?>
							<?php foreach ($store_list as $s): ?>
							<div class="item food seo" >
								<div class="discount_wrap" ></div>
								<img src="<?= getuploadpath().'store/'.$s->store_logo.'' ?>" class="merchant-logo" alt="<?= $s->store_name; ?>logo" height="94" width="94">
								<div class="merchant-info">
									<div class="row">
										<a href="<?= site_url('cities/'.url_title($s->city_name).'/'.url_title($s->state).'/'.url_title($type).'/'.url_title($s->unique_alias)) ?>" class="textual-information seo name" >
											<?= ucfirst($s->store_name) ?>
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
											<a href="<?= site_url('cities/'.url_title($s->city_name).'/'.url_title($s->state).'/'.url_title($type).'/'.url_title($s->store_name)) ?>" class="button secondary tag seo" title="Order from <?= $s->store_name; ?>">Order ahead</a>
										</div>
									</div>
									<div class="row footer" ng-include="'result-footer.html'">
										<div class="textual-information not-laundry seo result-footer">
											<span class="atom">$<?= $s->minorder ?> minimum</span>
											<span class="atom"> $<?= $s->delivery_fee ?> delivery fee</span>
										</div>
										
									</div>

									<div class="row middle extra-info">
										<div class="textual-information seo full-width-mobile"></div>
									</div>

									<div class="row footer" >
										<div class="textual-information seo result-footer"></div>
										
									</div>
								</div>
							</div>
							 <?php endforeach ?>
							 <?php }else{ ?>
							 <div class="item food seo" >
								<div class="discount_wrap" ></div>
								<div class="merchant-info">
									<div class="row">
										<h3>No Stores Found</h3>  
									</div>   
								</div>
							</div>
							 <?php } ?>
						</div> 
							<?php if (!($offset >= $totalstore - 10)): ?>
							<div class="load-more-btn-wrapper">
								<a href="#" id="loadMoreResults" class="button secondary">
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
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
	$('#sortby').change(function(){
		data = {
			orderby : $(this).val()
		};
		$.ajax({
        url : "<?php echo site_url('search/setOrderby') ?>",
        type: "POST",
        
        data: data,
        success:function(data){

	        document.location.reload(true);  
	   	 }
    	});


	});


$('.starrating').raty({
	
	score: function() {
	return $(this).attr('data-rating');
	},
  	readOnly: true
});

$(document).ready(function(){

	var totalstore = <?= $totalstore?>;
	var offset = 0;
	var ct = '<?=$ct?>';
	var state = '<?=$state?>';
	var zip = '<?=$zip?>';
	var type = '<?=$type?>';
	var cusine = '<?=$cusine?>';
	var orderby = '<?=$orderby?>';
	
		$("#loadMoreResults").click(function(e){

			e.preventDefault();
			offset += 10;
			$.get("<?php echo site_url('search/loadmorestore') ?>?ct="+ct+'&state='+state+'&zip='+zip+'&type='+type+'&offset='+offset+'&cusine='+cusine+'&orderby='+orderby, function(data){
				$("#appendhere").append(data);
			});
 
			if(offset >= totalstore - 10)
			{
				$("#loadMoreResults").hide();
			}
		})
	})
</script>