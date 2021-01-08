<?php echo Modules::run('header/header/account');  
		
		$dayarray = array(
			'monday' => $store_info->store_data->monday, 
			'tuesday' => $store_info->store_data->tuesday, 
			'wednesday' => $store_info->store_data->wednesday, 
			'thursday' => $store_info->store_data->thursday, 
			'friday' => $store_info->store_data->friday, 
			'saturday' => $store_info->store_data->saturday, 
			'sunday' => $store_info->store_data->sunday, 
		);
		$day = strtolower(date("l"));
		$daycheck = $dayarray[$day];
		
?>

<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/plugins/font-awesome/css/font-awesome.min.css">


<div class="page-wrapper" >
	<div style="background-image: url('<?= getuploadpath().'store/'.$store_info->store_data->store_banner; ?>');" id="page-header-wrapper" class="no-default" >
		<div class="sub-navigation-wrapper">
			<div >
				<div>
					<div class="container">
						<ul class="match-media-small">
							<li class="home-nav"><a href="">Search</a></li>
							<li class="merchant-nav"><a href="">Pick merchant</a></li>
							<li class="menu-nav"><a>Create order</a></li>
							<li class="checkout-nav"><a>Checkout</a></li>
						</ul>
						
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="page-header">
			<section class="merchant-info">
				<h1 itemprop="name"><?= $store_info->store_data->store_name ?></h1>
				<div >
					
				</div>
				
				<div class="address" itemprop="address">
					<div class="street-address">
						<span on-click="setActiveTab('info')" class="click-area"><span class="icon-map-marker"></span>
							<span><?= $store_info->store_data->store_street ?></span> 
						 </span>
					</div>
					<div class="city"><?= $store_info->store_data->city_name ?></div>
					<div class="state"><?= $store_info->store_data->state ?></div>
					<div class="zip"><?= $store_info->store_data->store_zip ?></div>
				</div>
				
				<ul class="menu-tabs " >

					<li class="active" >
						<a href="#main" >
						<span class="icon-merchant-menu"></span> 
						<?= $store_info->store_data->store_type !='4' ?'Menu' : 'Services' ?></a>

					</li>
					<li ><a href="#info" ><span class="icon-info"></span> Info</a></li>
					<li ><a href="#reviews" ><span class="icon-reviews"></span> Reviews</a></li>
				</ul>
				
			</section>
		</div>
	</div>
	<div id="main-content-wrapper">
		<div id="main" class="tab-content">
			<div id="main-content">
				<section>
					<?php if ($store_info->store_data->store_type == '1' ||$store_info->store_data->store_type == '4'): ?>
					<section class="menu">
						<?php if ($store_info->store_data->notice): ?>
						<div dcom-notices="notices">
							<div class="notices">
								<div class="header">
									<h3> Notices</h3>
								</div>
								<div class="body">
									<div class="notice">
										<i class="glyphicon glyphicon-info-sign"></i>

										<div class="text">
											<?= $store_info->store_data->notice; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endif ?>
						
						<?php if (!$daycheck): ?>
							<div dcom-notices="notices">
							<div class="notices">
								<div class="header">
									<h3> Notices</h3>
								</div>
								<div class="body">
									<div class="notice">
										<i class="glyphicon glyphicon-info-sign"></i>

										<div class="text">
											Store is closed today you can schedule your next order
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endif ?>
					 
						<section class="quick-navigation" >
							<?php if ($store_info->store_data->store_type !='4'): ?>
								
							
							<nav>
								<div class="menu-navigation-wrapper">
									<div onclick="toggleMenuNavigation()" class="menu-navigation">
										<span class="menu-navigation-button">Jump to menu <span class="dropdown-icon icon-down-arrow-thick"></span></span>
										<ul style="display:none;" id="menu_navigation" >
											<?php foreach ($store_info->category as $category): ?>
											<li><a  href="#menu-<?= $category->cat_id  ?> "><?= $category->category; ?></a></li>  
											<?php endforeach ?>
										</ul>
									</div>
								</div>

								<div class="search">
									<form class=""  name="searchbar" >
										<input class="" id="search-filter" required="" maxlength="30" name="query" placeholder="e.g. pizza, burger, pasta"  type="text"> 
										<input type="hidden" id="store_id" value="<?= $store_info->store_data->store_id; ?>">
										<span class="spinner ng-hide"></span>
									</form>
									<span class="icon-search " onclick="toggleSearchBar()"></span>
								</div>
							</nav>
							<div class="search-results menu-section-content ng-hide" id="searchresult" >
								<div class="messages">
									<div class="messages ng-hide" >Search results for <strong>""</strong></div>
									<div class="messages ng-hide" >Please enter at least 3 characters</div>
									<div class="messages ng-hide" >There are no search results for <strong>""</strong></div>
								</div>
								<div class="clearfix"></div>
								<div class="menu-section"  id="searchItems" >
									
								</div> 
							</div>
							<?php endif ?>
						</section>

							<?php if ($store_info->popular_product): ?>
							<div class="menu-section"  id="popularItems" >
									<header class="">
										<h3><span class="icon-star"></span>Popular Items</h3>
									</header>
									<div class="menu-section-content">
										<div class="menu-section-content-inner-wrapper">
										   <?php $j= 0; foreach ($store_info->popular_product as $pp): 
										   $dicountPrice = $this->index->DiscountOnPrdoduct($pp->product_id);
										   ?>
											 <div class="type-item <?= $j%2==0 ? 'even' : 'odd'  ?>" >
												<div class="menu-item-wrapper index-<?=$j ?>" >
													<div>
														<div class="menu-item has-description" 
														onclick="openmodel('<?= $pp->product_id; ?>');" >
															<div class="popularFlagWrapper" >
																<div class="popularFlag"></div>
																<span class="icon-star"></span>
															</div>
															<div class=""></div>
															<div  class="name"><?= $pp->product_name; ?></div>

															<div class="price">
																<?php if ($pp->price != $dicountPrice): ?>
																	<del>$<span class="amount"><?= $pp->price; ?></span></del>
																<?php endif ?>
																$<?= $dicountPrice ?>
															</div>
															<div class="description" >
																<?= $pp->small_desc; ?>
															</div>

														</div>
													</div>
												</div>
											</div>
											
											<?php $j++; endforeach ?>
										</div>
									</div>
							</div>
							<?php endif ?>
							<div>
							<?php foreach ($store_info->category as $ct): ?>
							   
							<div id="menu-<?= $ct->cat_id ?>" >
								<div style="z-index: 20;"  class="menu-section" >
									<header class="" onclick="toggleContent($event)"><h3 ><?= ucfirst($ct->category); ?></h3></header>
									<div class="menu-section-content">
										<div class="menu-section-content-inner-wrapper">
													
													<?php $product = $this->index->getproductdata($ct->cat_id); ?>
													<?php $i= 0; if(!empty($product)) { foreach ($product as $pt): 

														$dicountPrice = $this->index->DiscountOnPrdoduct($pt->product_id);
													?>
													
													<div class="type-item <?= $i%2==0 ? 'even' : 'odd'  ?>">
														<div class="simpleCart_shelfItem" >
															
															<div class="menu-item-wrapper index-<?=$i ?>">
																<div >                                                
																	<div class="menu-item has-description" onclick="openmodel('<?= $pt->product_id; ?>');">                                                            
																		
																		<?php if ($pt->is_popular): ?>
																			
																		<div class="popularFlagWrapper">
																			<div class="popularFlag"></div>
																			<span class="icon-star"></span>
																		</div>
																		<?php endif ?>

																		<div  class="item_name name"><?= $pt->product_name; ?></div>
																		<div class="item_price price">
																			<?php if ($pt->price != $dicountPrice): ?>
																				<del>$<span class="amount"><?= $pt->price; ?></span></del>
																			<?php endif ?>
																			$<?= $dicountPrice ?>

																		</div>
																		<div  class="description" ><?= $pt->small_desc; ?>
																		</div>

																	</div>
																</div>
															</div> 
														</div>
													</div>


											<?php $i++; endforeach;}else{   ?>
												<div class="type-item">
														<div>
															<div class="menu-item-wrapper">
																<div>                                                
																	<div class="menu-item has-description"> 
																		<p>No Products Found</p>       
																	</div>
																</div>
															</div>
														</div>
													</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach ?>
							</div>
					</section>
					<?php elseif ($store_info->store_data->store_type == '2' || $store_info->store_data->store_type == '3'): ?>
					<div class="menu" id="grocerry-menu" >
						<section class="quick-navigation">
							<nav  class="start">
								<div class="search-wrapper">
									<!-- SEARCH BAR-->
									<div class="search">
										<form  name="searchbar"  class="ng-pristine ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength">
											<input id="search-filter" required=""  maxlength="30" name="query" type="text" placeholder="e.g. milk, water" class="ng-pristine ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength ng-touched"> <span  class="spinner ng-hide"></span>
										</form>
										<span class="icon-search"></span>
									</div>
								</div>
								<div class="path-navigation-wrapper"><span class="quick-search" ><span class="text">Quick search</span> <span class="icon-quick-search-arrow"></span></span>
									
									<div class="path-navigation ng-hide" >
										
										<div class="breadcrums">
											<span class="node-view" ><span class="node">Categories</span> <span class="icon-breadcrumb-arrow"></span></span>
										</div>
										
										<div class="dropdown ng-hide">
											<div class="dropdown-button"><strong>Browsing:</strong> <span class="currentnode">Categories</span> <span class="dropdown-icon icon-down-arrow-thick"></span></div>
											<ul class="ng-hide">
												<li><a >Categories</a></li>
											</ul>
										</div>
									</div>
								</div>
							</nav>
							<div class="search-results menu-section-content ng-hide" id="searchresult" >
								<div class="messages">
									<div class="ng-hide">Search result for <strong>""</strong></div>
									<div class="ng-hide">Please enter at least 3 characters</div>
									<div class="ng-hide">There are no search result for <strong>""</strong></div>
								</div>
								
								<div class="clearfix"></div>
							</div>
						</section>
						<div>
							<?php if ($store_info->store_data->notice): ?>
								<div dcom-notices="notices">
									<div class="notices">
										<div class="header">
											<h3> Notices</h3>
										</div>
										<div class="body">
											<div class="notice">
												<i class="glyphicon glyphicon-info-sign"></i>

												<div class="text">
													<?= $store_info->store_data->notice; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
						<div class="menu-section">
							<header>
							<h3 class="current-category">Categories</h3></header>
							<div class="menu-section-content" id="category-load">
								<?php foreach ($store_info->category as $sc): ?>
								<div>
									<div  class="menu-item menu-category border" onclick="getSubcategory('<?= $sc->cat_id; ?>');"><span><?= ucfirst($sc->category); ?></h3></span>
									<span class="icon-arrow"></span>
									</div>
								</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<aside  class="menu-aside">
						<div>
							<?php if ($store_info->store_data->store_type !='4'): ?>
							<div class="module order-settings">
								<header>
									
									<?php $opt =  $pickordelivery; ?>
									<?php if ($store_info->store_data->deliveryoption=='Delivery & Pickup'){ ?>
									<div class="delivery-pickup">
										<span class="delivery-select <?= $opt =='delivery' ? 'active' : 'inactive' ?>">Delivery
										</span> 
										<input type="checkbox" class="optionpicordel"  <?= $opt =='pickup' ? 'checked' : '' ?>  > 
										<span class="pickup-select <?= $opt =='pickup' ? 'active' : 'inactive' ?>">Pickup</span>
									</div>
									
									<?php }elseif ($store_info->store_data->deliveryoption == 'Delivery only') {
										$result = array(
											'pickordelivery'=>'delivery'
										);
										$this->session->set_userdata($result);
									?>
										<div class="delivery-pickup">
											<span class="delivery-select active">Delivery
											</span> 
											<input type="checkbox" disabled="true" class="optionpicordel"> 
											<span class="pickup-select inactive">Pickup</span>
										</div>
									<?php } else{ 
										$result = array(
											'pickordelivery'=>'pickup'
										);
										$this->session->set_userdata($result);
									?>	
										<div class="delivery-pickup">
											<span class="delivery-select inactive">Delivery
											</span> 
											<input type="checkbox" disabled="true" checked class="optionpicordel"> 
											<span class="pickup-select active">Pickup</span>
										</div>
									<?php }  ?>
								</header>
								<div class="order-time-edit-container">
									<div class="order-time-label" id="order-time-label" onclick="toggleEditForm()">
										<?php if($date_time_detail['date']): ?>
										<span id="datedel"><?php echo date('l m/d/Y',strtotime($date_time_detail['date'])) ?></span>
										<span>&nbsp;at&nbsp; </span>
										<span id="timedel"><?= date('g:i a',strtotime($date_time_detail['time'])); ?></span>
										<span class="icon-pencil"></span>
										<?php else: ?>
										No Delivery Date and Time select <span class="icon-pencil"></span>
										<?php endif; ?>
									</div>
									<div class="order-time-edit hide" id="order-time-edit">
										<div class="date-select">
											<select class="date" id="orderDateMenu">
												<?php for ($i=0; $i < 7; $i++) { ?>
												<?php $dayc =  strtolower(date('l',strtotime('+'.$i.'day')));
												if ($dayarray[$dayc]) {
												 ?>
												<option label="<?php echo date('l m/d/Y',strtotime('+'.$i.'day')) ?>" value="<?php echo date('l m/d/Y',strtotime('+' . $i . 'day')) ?>">
													<?php echo date('l m/d/Y',strtotime('+' . $i . ' day')) ?>
												</option>
												<?php }
												 } ?>
											</select>
											<span class="dropdown-icon icon-down-arrow-thick"></span>
										</div>
										<div class="time-select">
											<select class="time " id="orderTimeMenu" >
												<?php foreach ($times as $key ): ?>
													<option label="<?= $key ?>" value="<?= date('H:i:s',strtotime($key)); ?>">
														<?= $key ?> 
													</option>
												<?php endforeach ?>
											</select>

											<span class="dropdown-icon icon-down-arrow-thick"></span>
										</div>
										<a class="button secondary" id="dateandtimeupdate">
											<span  class="contents">
												<span class="cta">Update</span>
											</span>
											<span class="spinner"></span>
										</a>
									</div>
								</div>
							</div>
							<?php else: ?>

							<div class="module order-settings">
								<header></header>
								<div class="order-time-edit-container">
									<div class="order-time-label" id="order-time-label" onclick="toggleEditForm()">
										<?php if($this->session->pickupdate): ?>
										Pickup :<span id="pickdate"><?php echo date('l m/d/Y',strtotime($this->session->pickupdate)) ?></span>
										<span>&nbsp;at&nbsp; </span>
										<span id="picktime"><?= date('g:i a',strtotime($this->session->pickuptime)); ?></span>
										<br>
										Delivery :<span id="deldate"><?php echo date('l m/d/Y',strtotime($this->session->date)) ?></span>
										<span>&nbsp;at&nbsp; </span>

										<span id="deltime"><?= date('g:i a',strtotime($this->session->time)); ?></span>
										<span class="icon-pencil"></span>
										<?php else: ?>
										No Delivery Date and Time select <span class="icon-pencil"></span>
										<?php endif; ?>
									</div>
									<div class="order-time-edit hide" id="order-time-edit">
										<div class="time-selection-wrapper">
											<div class="time-selection">
												<span class="laundry-label">Pickup time</span>
												<?php 
													$start        = new DateTime(date('Y-m-d H:i:s'));
													$end 	      = new DateTime(date('Y-m-d H:i:s',strtotime('+7 day')));
													$interval     = new DateInterval('P1D');
													$pickuptime   = new DatePeriod($start, $interval, $end);
												 ?>
												 
												<select id="pickupdate"  class="ng-valid ng-touched ng-dirty ng-valid-parse">
													<option value="" class="">Select a pickup time</option>
													<?php 
														foreach ($pickuptime as $dt):
														$dayc =  strtolower($dt->format("l"));
														if ($dayarray[$dayc]) {?>
																<option  value="<?= $dt->format("Y-m-d") ?>">
																	<?= $dt->format("l M-d-y") ?>
																</option>
															<?php 
															}
														endforeach;
														?>
												</select>
												<div class="time-select">
													<select class="time " id="pickuptime" >
														<?php foreach ($timesForLaundry as $key ): ?>
															<option value="<?= date('H:i:s',strtotime($key)); ?>">
																<?= $key ?> 
															</option>
														<?php endforeach ?>
													</select>
												</div>

											</div>
										</div>
										<div class="time-selection-wrapper ">
											<div class="time-selection">
												<span class="laundry-label">Delivery time</span>
												<?php 
													$start    = new DateTime(date('Y-m-d H:i:s'));
													$end 	  = new DateTime(date('Y-m-d H:i:s',strtotime('+7 day')));
													$interval = new DateInterval('P1D');
													$pickuptime   = new DatePeriod($start, $interval, $end);
												 ?>
												 
												<select id="deliverydate"  class="ng-valid ng-touched ng-dirty ng-valid-parse">
													<option value="" class="">Select a delivery time</option>
													
												</select>
												<div class="time-select">
													<select class="time " id="deliverytime" >
														<?php foreach ($timesForLaundry as $key ): ?>
															<option label="<?= $key ?>" value="<?= date('H:i:s',strtotime($key)); ?>">
																<?= $key ?> 
															</option>
														<?php endforeach ?>
													</select>
												</div>
												<a class="button secondary" id="laudary-datetime-update">
													<span  class="contents">
														<span class="cta">Update</span>
													</span>
													<span class="spinner"></span>
												</a>
											</div>
										</div>
									</div>	
								</div>
							</div>	
							<?php endif; ?>
						</div>
						<div >
							<div class="module cart" id="cartWrapper" dcom-viewport-spy="cartWrapper">
								<header><h3>Your bag</h3></header>
								<section>

									<div class="cart-items">
										<div id="cartBody">
										<?php if ($this->cart->contents()){ ?>

										<?php  $storeid=0; foreach ($this->cart->contents() as $key ) { ?>
											<div class="item mini_cart_item"> 
												<?php if ( $storeid != $key['store_id']): ?>
												<h4>Store Name :<?= $store_name  = $this->cart_model->get_store_name($key['store_id']); ?> </h3>
												<?php endif ?>	
												<div class="details"> 

													<div class="name">
														<?= $key['qty']; ?>-<?= $key['name']; ?>
														
														<span class="price">
															<span class="amount">
																<strong>$<?= $key['subtotal']; ?></strong>
															</span>
														</span>
													</div>
													<?php if ($key['options']): ?>
														<div class="instructions">
															<?php foreach ($key['options'] as $s): 
																if (is_array($s)){ 
																	foreach ($s as $k ):
																		$ret = $this->cart_model->getOptionData($k);
																		echo '<div >'.$ret->option_value.''.'<span class="pull-right">$'.$ret->price.'</span></div>';
																	endforeach; 
																}else{
																	echo '<div >'.$s.'</div>';
																}
																endforeach; 
															?>
														</div>
													<?php endif ?>
												</div>
												<div style="clear:both"></div>

													
												<div class="manage">
													<span class="delete removeCartItem" onclick="removeCartItem('<?= $key['rowid'] ?>')"  ></span>
													<span class="editCart edit" onclick="editcart('<?= $key['rowid'] ?>','<?= $key['id']; ?>')" >
													</span>
												</div>

											</div>
										<?php $storeid = $key['store_id']; ?>	
										<?php } }else{  ?>
										<div class="empty-cart" >
											<div>No items in your bag</div>
										</div>
										<?php } ?>
										</div>	
									</div>
								</section>
								<footer>
									<div class="cart-info" >
										<div class="cart-info">
											<div class="total">
												<strong class="label">Total:</strong> 
												<strong class="value">$<span class="grandtotal"><?= $this->cart->total(); ?></span></strong>
											</div>
										</div>
										<?php if ($this->cart->total() <= $store_info->store_data->minorder ): ?>
										<div class="cart-minimum">
											Subtotal must exceed $<?= $store_info->store_data->minorder ?>
										</div>
										<?php endif ?>
									</div>
									<?php if($date_time_detail['date']): ?>
									<div class="cta">
										<a onclick="<?= ($this->cart->contents() && $this->cart->total() >= $store_info->store_data->minorder ) ? 'checkout()' :'' ?>" id="checkoutbtn" class="button primary <?= ($this->cart->contents() && $this->cart->total() >= $store_info->store_data->minorder )? '' :'disabled' ?> " >Checkout</a>
									</div>
									<?php endif; ?>
									<div class="cart-points points-odometer">
										<span class="icon-trophy"></span>
										<dcom-odometer ng-model="cart_points"  class="odometer odometer-auto-theme">
											<div class="odometer-inside">
												
											</div>
										</dcom-odometer>Points
									</div>

								</footer>

							</div>
							
						</div>
						
					</aside>
				</section>
			</div>
		</div>
		<div id="info" class="tab-content" >
			<div id="main-content">
		 
			<section >
			 
				<div >
			 
				   <section class="menu">
					  <div class="merchant-info-page">
						 <div class="details">
							<img itemprop="logo" src="<?= getuploadpath().'store/'.$store_info->store_data->store_logo.'' ?>">
							<div class="info">
							   <div itemprop="address" class="address"><?= $store_info->store_data->store_street ?>,<?= $store_info->store_data->state ?><?= $store_info->store_data->store_zip ?>  </div>
							   
							   <div itemprop="telephone" class="phone"></div>
							   <input type="hidden" id="store_id" value="<?= $store_info->store_data->store_id; ?>">
							</div>
						 </div>
						 <div class="description" ></div>
					  </div>
						  <div class="schedule-info">
							 <div class="hours-container" >
							  
							 </div>
						  </div>
					  
				   </section>
				   
				</div>
				<aside  class="menu-aside">
						<div>
							<?php if ($store_info->store_data->store_type !='4'): ?>
							<div class="module order-settings">
								<header>
									<?php $opt =  $pickordelivery; ?>
									<?php if ($store_info->store_data->deliveryoption=='Delivery & Pickup'){ ?>
									<div class="delivery-pickup">
										<span class="delivery-select <?= $opt =='delivery' ? 'active' : 'inactive' ?>">Delivery
										</span> 
										<input type="checkbox" class="optionpicordel"  <?= $opt =='pickup' ? 'checked' : '' ?>  > 
										<span class="pickup-select <?= $opt =='pickup' ? 'active' : 'inactive' ?>">Pickup</span>
									</div>
									
									<?php }elseif ($store_info->store_data->deliveryoption == 'Delivery only') {?>
										<div class="delivery-pickup">
											<span class="delivery-select active">Delivery
											</span> 
											<input type="checkbox" disabled="true" class="optionpicordel"> 
											<span class="pickup-select inactive">Pickup</span>
										</div>
									<?php } else{ ?>	
										<div class="delivery-pickup">
											<span class="delivery-select inactive">Delivery
											</span> 
											<input type="checkbox" disabled="true" checked class="optionpicordel"> 
											<span class="pickup-select active">Pickup</span>
										</div>
									<?php }  ?>
								</header>
								<div class="order-time-edit-container">
									<div class="order-time-label" id="order-time-label" onclick="toggleEditForm()">
										<?php if($date_time_detail['date']): ?>
										<span id="datedel"><?php echo date('l m/d/Y',strtotime($date_time_detail['date'])) ?></span>
										<span>&nbsp;at&nbsp; </span>
										<span id="timedel"><?= date('g:i a',strtotime($date_time_detail['time'])); ?></span>
										<span class="icon-pencil"></span>
										<?php else: ?>
										No Delivery Date and Time select <span class="icon-pencil"></span>
										<?php endif; ?>
									</div>
									<div class="order-time-edit hide" id="order-time-edit">
										<div class="date-select">
											<select class="date" id="orderDateMenu">
												<?php for ($i=0; $i < 7; $i++) { ?>
												<?php $dayc =  strtolower(date('l',strtotime('+'.$i.'day')));
												if ($dayarray[$dayc]) {
												 ?>
												<option label="<?php echo date('l m/d/Y',strtotime('+'.$i.'day')) ?>" value="<?php echo date('l m/d/Y',strtotime('+' . $i . 'day')) ?>">
													<?php echo date('l m/d/Y',strtotime('+' . $i . ' day')) ?>
												</option>
												<?php }
												 } ?>
											</select>
											<span class="dropdown-icon icon-down-arrow-thick"></span>
										</div>
										<div class="time-select">
											<select class="time " id="orderTimeMenu" >
												<?php foreach ($times as $key ): ?>
													<option label="<?= $key ?>" value="<?= date('H:i:s',strtotime($key)); ?>">
														<?= $key ?> 
													</option>
												<?php endforeach ?>
											</select>

											<span class="dropdown-icon icon-down-arrow-thick"></span>
										</div>
										<a class="button secondary" id="dateandtimeupdate">
											<span  class="contents">
												<span class="cta">Update</span>
											</span>
											<span class="spinner"></span>
										</a>
									</div>
								</div>
							</div>
							<?php else: ?>
							<div class="module order-settings">
								<header></header>
								<div class="order-time-edit-container">
									<div class="order-time-label" id="order-time-label" onclick="toggleEditForm()">
										<?php if($date_time_detail_laundry['pickupdate']): ?>
										Pickup :<span id="pickdate"><?php echo date('l m/d/Y',strtotime($date_time_detail_laundry['pickupdate'])) ?></span>
										<span>&nbsp;at&nbsp; </span>
										<span id="picktime"><?= date('g:i a',strtotime($date_time_detail_laundry['pickuptime'])); ?></span>
										<br>
										Delivery :<span id="deldate"><?php echo date('l m/d/Y',strtotime($date_time_detail_laundry['date'])) ?></span>
										<span>&nbsp;at&nbsp; </span>

										<span id="deltime"><?= date('g:i a',strtotime($date_time_detail_laundry['time'])); ?></span>
										<span class="icon-pencil"></span>
										<?php else: ?>
										No Delivery Date and Time select <span class="icon-pencil"></span>
										<?php endif; ?>
									</div>
									<div class="order-time-edit hide" id="order-time-edit">
										<div class="time-selection-wrapper">
											<div class="time-selection">
												<span class="laundry-label">Pickup time</span>
												<?php 
													$start        = new DateTime(date('Y-m-d H:i:s'));
													$end 	      = new DateTime(date('Y-m-d H:i:s',strtotime('+7 day')));
													$interval     = new DateInterval('P1D');
													$pickuptime   = new DatePeriod($start, $interval, $end);
												 ?>
												 
												<select id="pickupdate"  class="ng-valid ng-touched ng-dirty ng-valid-parse">
													<option value="" class="">Select a pickup time</option>
													<?php 
														foreach ($pickuptime as $dt):
														$dayc =  strtolower($dt->format("l"));
														if ($dayarray[$dayc]) {?>
																<option  value="<?= $dt->format("Y-m-d") ?>">
																	<?= $dt->format("l M-d-y") ?>
																</option>
															<?php 
															}
														endforeach;
														?>
												</select>
												<div class="time-select">
													<select class="time " id="pickuptime" >
														<?php foreach ($timesForLaundry as $key ): ?>
															<option value="<?= date('H:i:s',strtotime($key)); ?>">
																<?= $key ?> 
															</option>
														<?php endforeach ?>
													</select>
												</div>

											</div>
										</div>
										<div class="time-selection-wrapper ">
											<div class="time-selection">
												<span class="laundry-label">Delivery time</span>
												<?php 
													$start    = new DateTime(date('Y-m-d H:i:s'));
													$end 	  = new DateTime(date('Y-m-d H:i:s',strtotime('+7 day')));
													$interval = new DateInterval('P1D');
													$pickuptime   = new DatePeriod($start, $interval, $end);
												 ?>
												 
												<select id="deliverydate"  class="ng-valid ng-touched ng-dirty ng-valid-parse">
													<option value="" class="">Select a delivery time</option>
													
												</select>
												<div class="time-select">
													<select class="time " id="deliverytime" >
														<?php foreach ($timesForLaundry as $key ): ?>
															<option label="<?= $key ?>" value="<?= date('H:i:s',strtotime($key)); ?>">
																<?= $key ?> 
															</option>
														<?php endforeach ?>
													</select>
												</div>
												<a class="button secondary" id="laudary-datetime-update">
													<span  class="contents">
														<span class="cta">Update</span>
													</span>
													<span class="spinner"></span>
												</a>
											</div>
										</div>
									</div>	
								</div>
							</div>
							<?php endif; ?>

						</div>
						<div >
							<div class="module cart" id="cartWrapper" dcom-viewport-spy="cartWrapper">
								<header><h3>Your bag</h3></header>
								<section>

									<div class="cart-items">
											<div id="cartBody">
											<?php if ($this->cart->contents()){ ?>

											<?php  $storeid=0; foreach ($this->cart->contents() as $key ) { ?>
												<div class="item mini_cart_item"> 
													<?php if ( $storeid != $key['store_id']): ?>
													<h4>Store Name :<?= $store_name  = $this->cart_model->get_store_name($key['store_id']); ?> </h3>
													<?php endif ?>	
													<div class="details"> 

														<div class="name">
															<?= $key['qty']; ?>-<?= $key['name']; ?>
															
															<span class="price">
																<span class="amount">
																	<strong>$<?= $key['subtotal']; ?></strong>
																</span>
															</span>
														</div>
														<?php if ($key['options']): ?>
															<div class="instructions">
																<?php foreach ($key['options'] as $s): 
																	if (is_array($s)){ 
																		foreach ($s as $k ):
																			$ret = $this->cart_model->getOptionData($k);
																			echo '<div >'.$ret->option_value.''.'<span class="pull-right">$'.$ret->price.'</span></div>';
																		endforeach; 
																	}else{
																		echo '<div >'.$s.'</div>';
																	}
																	endforeach; 
																?>
															</div>
														<?php endif ?>
													</div>
													<div style="clear:both"></div>

														
													<div class="manage">
														<span class="delete removeCartItem" onclick="removeCartItem('<?= $key['rowid'] ?>')"  ></span>
														<span class="editCart edit" onclick="editcart('<?= $key['rowid'] ?>','<?= $key['id']; ?>')" >
														</span>
													</div>

												</div>
											<?php $storeid = $key['store_id']; ?>	
											<?php } }else{  ?>
											<div class="empty-cart" >
												<div>No items in your bag</div>
											</div>
											<?php } ?>
											</div>	
										</div>
								</section>
								<footer>
									<div class="cart-info" >
										<div class="cart-info">
											<div class="total">
												<strong class="label">Total:</strong> 
												<strong class="value">$<span class="grandtotal"><?= $this->cart->total(); ?></span></strong>
											</div>
										</div>
										<?php if ($this->cart->total() <= $store_info->store_data->minorder ): ?>
										<div class="cart-minimum">
											Subtotal must exceed $<?= $store_info->store_data->minorder ?>
										</div>
										<?php endif ?>
									</div>

									<?php if($date_time_detail['date']): ?>
										<div class="cta">
											<a onclick="<?= ($this->cart->contents() && $this->cart->total() >= $store_info->store_data->minorder ) ? 'checkout()' :'' ?>" id="checkoutbtn" class="button primary <?= ($this->cart->contents() && $this->cart->total() >= $store_info->store_data->minorder )? '' :'disabled' ?> " >Checkout</a>
										</div>
										<?php endif; ?>
									<div class="cart-points points-odometer">
										<span class="icon-trophy"></span>
										<dcom-odometer ng-model="cart_points" class="odometer odometer-auto-theme">
											<div class="odometer-inside">

											</div>
										</dcom-odometer>Points
									</div>

								</footer>

							</div>
						</div>
						
				</aside>
			 </section>
		 
			</div>	
			 
		</div>
		<div id="reviews" class="tab-content">
			<div id="main-content">
				<section>
						<div>
							<section class="menu">
								<div class="merchant-reviews-page">
									<section class="merchant-reviews">
										<h3>Reviews</h3>
										<?php if($store_info->review_detail):  ?>
										<div class="stats" >
												<div>
													<div class="showrating"  data-storeid = "" data-id="" data-rating="<?= $store_info->store_data->rating_avg; ?>"></div>
												</div>
												 Based on 
												<strong><?= count($store_info->review_detail)  ?> reviews</strong>
										</div>

										<div class="recent-reviews">
												
												<?php foreach ($store_info->review_detail as $rd): ?>
													
													 <div class="review odd">
															<div>
																<div class="showrating"  data-storeid = "" data-id="" data-rating="<?= $rd->review_rating ?>"></div>
															</div>
															<div class="reviewer">
																 By: <?= $rd->first_name.' '.$rd->last_name; ?> <span class="date" >on <?= date('M d,y',strtotime($rd->review_on)) ?></span>
															</div>
															<div itemprop="reviewBody" class="the-review" >
																 <?= $rd->review ?>
															</div>
													 </div>
												<?php endforeach ?>
										
										</div>
										<?php else: ?>
										<div  class="stats">This merchant does not currently have any reviews.
										</div>
										
										<?php endif; ?>
									</section>

									
									<?php if ($store_review_cust) { ?>
										<section class="merchant-reviews">
											<form id="rest_review_form" class="rest_review_form" name="rest_review_form" action="<?= site_url('addReview') ?>" method="post">                

								                <h3  class="review_title">
								                    Write your feedback
								                </h3>

								                <div class="padding15">
								                    <input type="hidden" name="customer_id" value="<?= $this->session->c_id ?>">
								                    <input type="hidden" name="store_id" value="<?= $store_info->store_data->store_id ?>">
								                    <div class="form-group">
								                        <label>Rating</label>
								                        <span class="rating-container" >
													
															<span class="rating">
																<div>
																	<div class="starrating"  data-storeid = "" data-id="" data-rating="0"></div>
																</div>
															</span>
															
														</span>
								                    </div>
								                    <div class="form-group">
								                        <label>Review</label>
								                        <textarea name="review" id="review" class="form-control"></textarea>
								                    </div>
								                    <div class="button-group">
								                        <button class="button primary" id="submitReviews" type="button">Submit</button>
								                    </div>                
								                </div>
								            </form>
									<?php } ?>


								</div>
							</section>
						</div>
						<aside  class="menu-aside">
							<div>
								<?php if ($store_info->store_data->store_type !='4'): ?>
								<div class="module order-settings">
									<header>
										<?php $opt =  $pickordelivery; ?>
										<?php if ($store_info->store_data->deliveryoption=='Delivery & Pickup'){ ?>
										<div class="delivery-pickup">
											<span class="delivery-select <?= $opt =='delivery' ? 'active' : 'inactive' ?>">Delivery
											</span> 
											<input type="checkbox" class="optionpicordel"  <?= $opt =='pickup' ? 'checked' : '' ?>  > 
											<span class="pickup-select <?= $opt =='pickup' ? 'active' : 'inactive' ?>">Pickup</span>
										</div>
										
										<?php }elseif ($store_info->store_data->deliveryoption == 'Delivery only') {?>
											<div class="delivery-pickup">
												<span class="delivery-select active">Delivery
												</span> 
												<input type="checkbox" disabled="true" class="optionpicordel"> 
												<span class="pickup-select inactive">Pickup</span>
											</div>
										<?php } else{ ?>	
											<div class="delivery-pickup">
												<span class="delivery-select inactive">Delivery
												</span> 
												<input type="checkbox" disabled="true" checked class="optionpicordel"> 
												<span class="pickup-select active">Pickup</span>
											</div>
										<?php }  ?>
									</header>
									<div class="order-time-edit-container">
										<div class="order-time-label" id="order-time-label" onclick="toggleEditForm()">
											<?php if($date_time_detail['date']): ?>
											<span id="datedel"><?php echo date('l m/d/Y',strtotime($date_time_detail['date'])) ?></span>
											<span>&nbsp;at&nbsp; </span>
											<span id="timedel"><?= date('g:i a',strtotime($date_time_detail['time'])); ?></span>
											<span class="icon-pencil"></span>
											<?php else: ?>
											No Delivery Date and Time select <span class="icon-pencil"></span>
											<?php endif; ?>
										</div>
										<div class="order-time-edit hide" id="order-time-edit">
											<div class="date-select">
												<select class="date" id="orderDateMenu">
													<?php for ($i=0; $i < 7; $i++) { ?>
													<?php $dayc =  strtolower(date('l',strtotime('+'.$i.'day')));
													if ($dayarray[$dayc]) {
													 ?>
													<option label="<?php echo date('l m/d/Y',strtotime('+'.$i.'day')) ?>" value="<?php echo date('l m/d/Y',strtotime('+' . $i . 'day')) ?>">
														<?php echo date('l m/d/Y',strtotime('+' . $i . ' day')) ?>
													</option>
													<?php }
													 } ?>
												</select>
												<span class="dropdown-icon icon-down-arrow-thick"></span>
											</div>
											<div class="time-select">
												<select class="time " id="orderTimeMenu" >
													<?php foreach ($times as $key ): ?>
														<option label="<?= $key ?>" value="<?= date('H:i:s',strtotime($key)); ?>">
															<?= $key ?> 
														</option>
													<?php endforeach ?>
												</select>

												<span class="dropdown-icon icon-down-arrow-thick"></span>
											</div>
											<a class="button secondary" id="dateandtimeupdate">
												<span  class="contents">
													<span class="cta">Update</span>
												</span>
												<span class="spinner"></span>
											</a>
										</div>
									</div>
								</div>
								<?php else: ?>

								<div class="module order-settings">
									<header></header>
									<div class="order-time-edit-container">
										<div class="order-time-label" id="order-time-label" onclick="toggleEditForm()">
											<?php if($date_time_detail_laundry['pickupdate']): ?>
											Pickup :<span id="pickdate"><?php echo date('l m/d/Y',strtotime($date_time_detail_laundry['pickupdate'])) ?></span>
											<span>&nbsp;at&nbsp; </span>
											<span id="picktime"><?= date('g:i a',strtotime($date_time_detail_laundry['pickuptime'])); ?></span>
											<br>
											Delivery :<span id="deldate"><?php echo date('l m/d/Y',strtotime($date_time_detail_laundry['date'])) ?></span>
											<span>&nbsp;at&nbsp; </span>

											<span id="deltime"><?= date('g:i a',strtotime($date_time_detail_laundry['time'])); ?></span>
											<span class="icon-pencil"></span>
											<?php else: ?>
											No Delivery Date and Time select <span class="icon-pencil"></span>
											<?php endif; ?>
										</div>
										<div class="order-time-edit hide" id="order-time-edit">
											<div class="time-selection-wrapper">
												<div class="time-selection">
													<span class="laundry-label">Pickup time</span>
													<?php 
														$start        = new DateTime(date('Y-m-d H:i:s'));
														$end 	      = new DateTime(date('Y-m-d H:i:s',strtotime('+7 day')));
														$interval     = new DateInterval('P1D');
														$pickuptime   = new DatePeriod($start, $interval, $end);
													 ?>
													 
													<select id="pickupdate"  class="ng-valid ng-touched ng-dirty ng-valid-parse">
														<option value="" class="">Select a pickup time</option>
														<?php 
															foreach ($pickuptime as $dt):
															$dayc =  strtolower($dt->format("l"));
															if ($dayarray[$dayc]) {?>
																	<option  value="<?= $dt->format("Y-m-d") ?>">
																		<?= $dt->format("l M-d-y") ?>
																	</option>
																<?php 
																}
															endforeach;
															?>
													</select>
													<div class="time-select">
														<select class="time " id="pickuptime" >
															<?php foreach ($timesForLaundry as $key ): ?>
																<option value="<?= date('H:i:s',strtotime($key)); ?>">
																	<?= $key ?> 
																</option>
															<?php endforeach ?>
														</select>
													</div>

												</div>
											</div>
											<div class="time-selection-wrapper ">
												<div class="time-selection">
													<span class="laundry-label">Delivery time</span>
													<?php 
														$start    = new DateTime(date('Y-m-d H:i:s'));
														$end 	  = new DateTime(date('Y-m-d H:i:s',strtotime('+7 day')));
														$interval = new DateInterval('P1D');
														$pickuptime   = new DatePeriod($start, $interval, $end);
													 ?>
													 
													<select id="deliverydate"  class="ng-valid ng-touched ng-dirty ng-valid-parse">
														<option value="" class="">Select a delivery time</option>
														
													</select>
													<div class="time-select">
														<select class="time " id="deliverytime" >
															<?php foreach ($timesForLaundry as $key ): ?>
																<option label="<?= $key ?>" value="<?= date('H:i:s',strtotime($key)); ?>">
																	<?= $key ?> 
																</option>
															<?php endforeach ?>
														</select>
													</div>
													<a class="button secondary" id="laudary-datetime-update">
														<span  class="contents">
															<span class="cta">Update</span>
														</span>
														<span class="spinner"></span>
													</a>
												</div>
											</div>
										</div>	
									</div>
								</div>	
								<?php endif; ?>
							</div>
							<div >
								<div class="module cart" id="cartWrapper" >
									<header><h3>Your bag</h3></header>
									<section>

										<div class="cart-items">
											<div id="cartBody">
											<?php if ($this->cart->contents()){ ?>

											<?php  $storeid=0; foreach ($this->cart->contents() as $key ) { ?>
												<div class="item mini_cart_item"> 
													<?php if ( $storeid != $key['store_id']): ?>
													<h4>Store Name :<?= $store_name  = $this->cart_model->get_store_name($key['store_id']); ?> </h3>
													<?php endif ?>	
													<div class="details"> 

														<div class="name">
															<?= $key['qty']; ?>-<?= $key['name']; ?>
															
															<span class="price">
																<span class="amount">
																	<strong>$<?= $key['subtotal']; ?></strong>
																</span>
															</span>
														</div>
														<?php if ($key['options']): ?>
															<div class="instructions">
																<?php foreach ($key['options'] as $s): 
																	if (is_array($s)){ 
																		foreach ($s as $k ):
																			$ret = $this->cart_model->getOptionData($k);
																			echo '<div >'.$ret->option_value.''.'<span class="pull-right">$'.$ret->price.'</span></div>';
																		endforeach; 
																	}else{
																		echo '<div >'.$s.'</div>';
																	}
																	endforeach; 
																?>
															</div>
														<?php endif ?>
													</div>
													<div style="clear:both"></div>

														
													<div class="manage">
														<span class="delete removeCartItem" onclick="removeCartItem('<?= $key['rowid'] ?>')"  ></span>
														<span class="editCart edit" onclick="editcart('<?= $key['rowid'] ?>','<?= $key['id']; ?>')" >
														</span>
													</div>

												</div>
											<?php $storeid = $key['store_id']; ?>	
											<?php } }else{  ?>
											<div class="empty-cart" >
												<div>No items in your bag</div>
											</div>
											<?php } ?>
											</div>	
										</div>
									</section>
									<footer>
										<div class="cart-info" >
											<div class="cart-info">
												<div class="total">
													<strong class="label">Total:</strong> 
													<strong class="value">$<span class="grandtotal"><?= $this->cart->total(); ?></span></strong>
												</div>
											</div>
											<?php if ($this->cart->total() <= $store_info->store_data->minorder ): ?>
											<div class="cart-minimum">
												Subtotal must exceed $<?= $store_info->store_data->minorder ?>
											</div>
											<?php endif ?>
										</div>

										<?php if($date_time_detail['date']): ?>
										<div class="cta">
											<a onclick="<?= ($this->cart->contents() && $this->cart->total() >= $store_info->store_data->minorder ) ? 'checkout()' :'' ?>" id="checkoutbtn" class="button primary <?= ($this->cart->contents() && $this->cart->total() >= $store_info->store_data->minorder )? '' :'disabled' ?> " >Checkout</a>
										</div>
										<?php endif; ?>
										<div class="cart-points points-odometer">
											<span class="icon-trophy"></span>
											<dcom-odometer  class="odometer odometer-auto-theme">
												<div class="odometer-inside">
													<?= $this->cart->total() ?>
												</div>
											</dcom-odometer>Points
										</div>

									</footer>

								</div>
							</div>
							
						</aside>
				</section>
			</div>
		</div>
		
	</div>
	
</div>

<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
$(document).ready(function() {
	$(".menu-tabs a").click(function(event) {
		event.preventDefault();
		$(this).parent().addClass("active");
		$(this).parent().siblings().removeClass("active");
		var tab = $(this).attr("href");
		$(".tab-content").not(tab).css("display", "none");
		$(tab).fadeIn();
	});
});
</script>

<script type="text/javascript">
	function openmodel(product_id){
		data ={
			product_id : product_id
		}
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('cart/getproductoption') ?>",
			data: data,
			
			beforeSend: function(){
			},
			success: function(data) {
				$('.item-option-modal,.modal-backdrop').css({"display":"block","z-index":"1050"});
				$('.item-option-modal,.modal-backdrop').addClass('in');
				$('.item-option-modal #data').html(data);

			}
		})
	}

	function removeCartItem(rowid){
		data ={
			rowid : rowid
		}
		 alertify.confirm("Are you sure you want to Delete this Item ?", function (result) {
				if (result) {
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('cart/removeCart') ?>",
						data: data,
						beforeSend: function(){
						},
						success: function(data) { $('#cartWrapper').html(data)}
					});		
			
				} else {
				  
				}
			});
	}
	function editcart(rowid,product){
		
		data ={
			rowid : rowid,
			product_id:product
		}
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('cart/editCart') ?>",
			data: data,
			beforeSend: function(){
			},
			success: function(data){
				$('.item-option-modal,.modal-backdrop').css({"display":"block","z-index":"1050"});
				$('.item-option-modal,.modal-backdrop').addClass('in');
				$('.item-option-modal #data').html(data);
			}
		});		
	}
</script>

<div class="modal-backdrop fade " modal-animation-class="fade" modal-animation="true" style="display: none;"></div>
<div modal-render="true" tabindex="-1" role="dialog" class="modal fade in item-option-modal" modal-animation-class="fade" 
style="">
	<div class="modal-dialog" >
		<div class="modal-content" modal-transclude="">
			<div class="modal-body">
				<button type="button" class="close"  aria-hidden="true">×</button>
				<div class="content" id="data">
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('.close').click(function(){
				$('.item-option-modal,.modal-backdrop').css({"display":"none","z-index":"0"});
				$('.item-option-modal,.modal-backdrop').removeClass('in');
			});
		</script>
	</div>
</div>
<?php if ($clearcart): ?>

<script type="text/javascript">
	$(function(){
		$('.worningAboutcart,.modal-backdrop').css({"display":"block","z-index":"1040"});
		$('.worningAboutcart,.modal-backdrop').addClass('in');
	});

</script>
	

<div modal-render="true" tabindex="-1" role="dialog" class="modal fade in worningAboutcart" id="worningAboutcart" modal-animation-class="fade" 
style="">
	<div class="modal-dialog" >
		<div class="modal-content" modal-transclude="">
			<div class="modal-header">
			</div>
			<div class="modal-body">
			   
				<div class="content" id="data">
					<h3>Your cart will be cleared...</h3>
				</div>
			</div>
			<div class="modal-footer">
				<button class="cart_warning_continue pull-right button primary">Continue</button>
				<a onclick="<?= ($this->cart->contents() && $this->cart->total() >= $minorder ) ? 'checkout()' :'' ?>" id="checkoutbtn" class="button primary <?= ($this->cart->contents() && $this->cart->total() >= $minorder )? '' :'disabled' ?> " >Checkout</a>
				&nbsp;
			</div>
			<script type="text/javascript">
				$('.cart_warning_continue').click(function(){
					data ={
						is_post:1
					}
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('clearCart') ?>",
						data: data,
						cache: false,
						success: function(data) {	
							window.location.reload();
						}
					});
				});

			</script>
		</div>
	   
	</div>
</div>
<?php endif ?>
<!-- js for search update time/pickup and point table -->
<script type="text/javascript">

	$('#search-filter').keyup(function() {

		var search = $('#search-filter').val();
		var data = {
			search:$('#search-filter').val(),
			store_id :$('#store_id').val(),
		}
		setTimeout(function() { 
			if($('#search-filter').val() == search){ 
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('searchprduct') ?>",
					data: data,
					cache: false,
					beforeSend: function() {
					  
					},
					success: function(data) {
						$('#searchresult').removeClass('ng-hide');
						$('#messages').removeClass('ng-hide');
						$('#searchresult').html(data);
					}
				})
			}
		}, 1000); // 1 sec delay to check.
		});

	function  search() {
		var search = $('#search-filter').val();
		var data = {
			search:$('#search-filter').val(),
			store_id :'<?= $store_info->store_data->store_id; ?>',
		}
		setTimeout(function() { 
			if($('#search-filter').val() == search){ 
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('searchprduct') ?>",
					data: data,
					cache: false,
					beforeSend: function() {
					  
					},
					success: function(data) {
						$('#searchresult').removeClass('ng-hide');
						$('#messages').removeClass('ng-hide');
						$('#searchresult').html(data);
					}
				})
			}
		}, 1000); // 1 sec delay to check.
		
	}
	$('#dateandtimeupdate').click(function(){
		var data = {
			date:$('#orderDateMenu').val(),
			time :$('#orderTimeMenu').val(),
			pickordelivery :$('#pickordelivery').val(),
		}
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('updateDatetime') ?>",
			data: data,
			dataType:"json",
			beforeSend: function(){
			},
			success: function(data) {
				window.location.reload();
				$('#order-time-edit').toggle();
				$('#datedel').html(''+data.date+'');
				$('#timedel').html(''+data.time+'');
				
			}
		})
	});
	$('#laudary-datetime-update').click(function(){
		
		var data = {
			pickupdate 	:$('#pickupdate').val(),
			pickuptime   :$('#pickuptime').val(),
			deliverydate :$('#deliverydate').val(),
			deliverytime :$('#deliverytime').val(),				
		}
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('updateDatetimeLaundry') ?>",
			data: data,
			dataType:"json",
			beforeSend: function(){
			},
			success: function(data) {
				window.location.reload();
				$('#order-time-edit').toggle();
				$('#pickdate').html(''+data.pickupdate+'');
				$('#picktime').html(''+data.pickuptime+'');
				$('#deldate').html(''+data.date+'');
				$('#deltime').html(''+data.time+'');
				//console.log(data);

			}
		})
	});
	
	function toggleEditForm(){
		$('#order-time-edit').toggle();
		}
	function toggleMenuNavigation(){
		$('#menu_navigation').toggle();
		}
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
			$('html,body').animate({
			  scrollTop: target.offset().top
			}, 500);
			return false;
		  }
		}
	  });
	  pointTable();
	});

	var elems = Array.prototype.slice.call(document.querySelectorAll('.optionpicordel'));
	elems.forEach(function(html) {
	  var switchery = new Switchery(html ,{ color: '#6886aa', secondaryColor: '#6886aa', size: 'small' });
	});
	$('.optionpicordel').change(function(){
		var a = $(this).attr('checked');
		if(a=='checked'){
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
	window.odometerOptions = {
	  format: '(ddd).dd'
	};

	function pointTable(){
		var totalamount = '<?= $this->cart->total(); ?>';
		var pointValue = '<?= $pointsvalue; ?>';

		setTimeout(function(){
			$('.odometer').html(parseInt(totalamount*pointValue));
		}, 1000);
	}

</script>
	
<script type="text/javascript">
		function checkout(){
			var data = {
				is_ajax:'1',
				store_id :$('#store_id').val(),
			};
			$.ajax({
				url:"<?php echo site_url('checkloginForcheckout'); ?>",
				type: "POST",
				dataType: "json",
				data: data,
				success:function(data){
					if(data.response==0){
						$('.login-nav-item2').click();
					}else{
						window.location.href = '<?php echo site_url("checkout") ?>';
					}	
				}
			 })
		}
function getProduct(cat_id){
		var data = {
			is_ajax:'1',
			cat_id :cat_id,
			store_id :'<?= $store_info->store_data->store_id ?>',
		};
		$.ajax({
			url:"<?php echo site_url('getProductByCategory'); ?>",
			type: "POST",
			data: data,
			success:function(data){
				$('#grocerry-menu').html(data);
			}
		 })
}
function getSubcategory(cat_id)
{
	var data = {
		is_ajax:'1',
		cat_id :cat_id,
		store_id :'<?= $store_info->store_data->store_id ?>',
	};
	$.ajax({
		url:"<?php echo site_url('getSubcategoryByCategory'); ?>",
		type: "POST",
		data: data,
		success:function(data){
			$('#grocerry-menu').html(data);
		}
	 })
}
function getCategory(){
		var data = {
			is_ajax:'1',
			store_id :'<?= $store_info->store_data->store_id ?>',
		};
		$.ajax({
			url:"<?php echo site_url('getCategoryOnProduct'); ?>",
			type: "POST",
			data: data,
			success:function(data){
				$('#grocerry-menu').html(data);
			}
		 })
}
function togglesearchform(){
	$("#search-from").removeClass('ng-hide');
	$(".dropdown").removeClass('ng-hide');
	$(".breadcrums").addClass('ng-hide');
}
function toggleDropdown(){

	
	if($("#showdropdown").hasClass("ng-hide")){
		$("#showdropdown").removeClass('ng-hide');
	}else{
		$("#showdropdown").addClass('ng-hide');
	}
	
}

</script>
<script type="text/javascript">
	$('#pickupdate').change(function(){
		var data = {
			is_ajax:'1',
			store_id :'<?= $store_info->store_data->store_id ?>',
			date : $(this).val(),
		};
		$.ajax({
			url:"<?php echo site_url('get_timeperiods'); ?>",
			type: "POST",
			data: data,
			dataType:'json',
			success:function(data){
				var ans='';
				$('#deliverydate').html();
				for (var i = 0; i < data.length; i++) {
					
					ans += '<option value="'+data[i]+'">'+data[i]+'</option>';
				};
				$('#deliverydate').html(ans);
			}
		 })
	});
$('.starrating').raty({
		path: '<?= site_url() ?>/front/views/themes/default/plugins/rating/images', 
		score: function() {
		return $(this).attr('data-rating');
		},
	  	click: function(score, evt) {
	    data = {
	    	score : score,
	    }
	   }
	});
$('#submitReviews').click(function(){
		var form = $('#rest_review_form');
		$.ajax({
		  type: "POST",
		  url: form.attr( 'action' ),
		  data: form.serialize(),
		  dataType:'json',
		  success: function( response ) {
			form.hide();
			 
			if (response.code) {
				alertify.success(response.res);
			}else{
				alertify.error(response.res)
			}
			
		  }
		});
});
$('.showrating').raty({
	score: function() {
	return $(this).attr('data-rating');
	},
  	readOnly: true
});

</script>