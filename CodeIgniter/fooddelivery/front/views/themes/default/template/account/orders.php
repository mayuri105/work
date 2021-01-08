<?php echo Modules::run('header/header/account'); ?>
	  


<div class="page-wrapper">
	<div id="page-header-wrapper">
		<div id="page-header">
			<!-- page header contents -->
			<h1>Your account</h1>
		</div>
	</div>
	<div id="main-content-wrapper" >
		<div id="main-content">
			
			<div class="side-nav" >
				
				<div class="account-side-nav">
					<div class="account-pages">
						
						
						<div class="link active"><a href="<?= site_url('account/orders') ?>">Order history</a></div>
						
						<div class="link" ><a href="<?= site_url('account/tell-a-friend') ?>">Tell a friend</a></div>
						
						<div class="link" ><a href="<?= site_url('account/profile') ?>">Profile</a></div>
						
						<div class="link" ><a href="<?= site_url('account/addresses') ?>">Addresses</a></div> 
					  
						<!-- <div class="link"><a href="<?= site_url('account/cards') ?>">Credit cards</a></div> -->
					   <div class="link "><a href="<?= site_url('account/wallets') ?>">Wallets</a></div>
						   
					</div>
				</div>
			  
			</div>
			
			<div class="content">
				<div class="heading">
					<h3>Order history</h3>
				</div>
				<div class="order-history">
					<?php if (empty($order_detail)){ ?>
					<div class="no-orders">
						<div class="rows">
							<p class="bold">You have no past orders.</p>
							<p><a href="<?php echo site_url() ?>" class="button primary">Start your first order now</a></p>
						</div>
					</div>
					<?php }else{ ?>
						<?php foreach ($order_detail as $order): ?>
							<div class="orders-wrapper" >
								<div class="rows f">
									<div class="info-container" >
										<div class="row-1">
											<div class="name">
												<span class="cuisine-icon icon-food"></span>
												<?= $order->store_name; ?>		
											</div>
											<div class="items" >
												<span class="cart-items" ><?php echo $order->productname ?></span>
											</div>
										</div>
										 <?php 

										 	$total =  explode(',',$order->pricetotal);
										 	$price  = 0;
										 	foreach ($total as $key ) {
										 		$price += $key; 
										 	}

										 	
										  ?>
										<div class="total">$<?=  $order->total ?></div>
									</div>
									<div class="clear-both"></div>
									<div class="row-2">
										<div class="details">
											<span class="text"><?php 
												$dt =  $order->delivery_or_pic_datetime; 
												echo date('g:i a d/m/y',strtotime($dt)); 
											?></span> 
											
											<span class="pipe">|</span> 
											<span class="text">Order #<?= $order->o_id; ?></span>
											<span class="pipe">|</span>
											<span class="order-type"><?= $order->delivery_option ?></span>
										</div>
										<?php $getrating = $this->account->getrating($order->o_id) ?>

										<?php if ($getrating ){ ?>
										<div class="review">
											<div >
												<span class="rating-container" >
													
													<span class="rating">
														<div>
															<div class="starrating"  data-storeid = "<?= $order->store_id ?>" data-id="<?= $order->o_id; ?>" data-rating="<?= $getrating->rating_star; ?>"></div>
														</div>
													</span>
													
												</span>
											</div>
										</div>
										<?php $set = $getrating->setasfav ? '0' :'1' ?>
										<div id="set<?= $order->o_id;  ?>"  class="favorite" order-details="" onclick="favordername('<?= $set ?>','<?= $order->o_id ?>','<?= $order->store_id ?>');">
											<span class="pipe">|</span> 
											<span  class="order-not-favorited icon-heart <?=  $getrating->setasfav ? 'ng-hide' : '' ?>">
											</span>
											<span class="order-favorited icon-heart  <?=  $getrating->setasfav ? '' : 'ng-hide' ?>">
											</span>
											
										</div>
										<?php }else{ ?>	
											<div class="review">
											<div >
												<span class="rating-container" >
													
													<span class="rating">
														<div>
															<div class="starrating"  data-storeid = "<?= $order->store_id ?>" data-id="<?= $order->o_id; ?>" data-rating="0"></div>
														</div>
													</span>
													
												</span>
											</div>
										</div>
											
										<div  id="set<?= $order->o_id;  ?>" class="favorite" order-details="" onclick="favordername('1','<?= $order->o_id ?>','<?= $order->store_id ?>');">
											<span class="pipe">|</span> 
											<span  class="order-not-favorited icon-heart ">
											</span>
										</div>
										<?php } ?>
										<div class="clear-both"></div>
									</div>
								</div>
							</div>                            
						<?php endforeach ?>
					<?php } ?>
					<div class="clear-both"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(window).scroll(function () {
		if ($(window).scrollTop() > 300) {
			$('.sticky-search').addClass('visible');
		}
		else
		{
			$('.sticky-search').removeClass('visible');
		}
	});
	$('.starrating').raty({
		path: '../front/views/themes/default/plugins/rating/images', 
		score: function() {
		return $(this).attr('data-rating');
		},
	  	click: function(score, evt) {
	    data = {
	    	score : score,
	    	id: $(this).attr('data-id'),
	    	storeid: $(this).attr('data-storeid')
	    }
	    $.ajax({
	    	method:'post',
    	 	url: '<?= site_url("account/updateOrderrating") ?>',
			data: data,
			success:function(data){
               //console.log(data);
            }
	    });


	  }
	});
	function favordername(setasfav,id,storeid){
		
		   data = {
		   		setasfav:setasfav,
	    		id:id,
	    		storeid:storeid
		    }
		    $.ajax({
		    	method:'post',
	    	 	url: '<?= site_url("account/updateOrderFav") ?>',
				data: data,
				dataType:"json",
				success:function(data){
	              if(data.fav){
	               		$('#set'+id+' .order-favorited').removeClass('ng-hide');
	               		$('#set'+id+' .order-not-favorited').addClass('ng-hide');
	               }
	               if(data.fav=='0'){
	            		
	               		$('#set'+id+' .order-not-favorited').removeClass('ng-hide');
		               	$('#set'+id+' .order-favorited').addClass('ng-hide');
		               	
	               }
	            }
		    });
        
	}
	
</script>

<?php echo Modules::run('footer/footer/account'); ?>