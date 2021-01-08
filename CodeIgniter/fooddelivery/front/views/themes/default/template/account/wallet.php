<?php echo Modules::run('header/header/account'); ?>
<div class="page-wrapper">
	<div id="page-header-wrapper">
		<div id="page-header">
			<h1>Your account</h1>
		</div>
	</div>
	<div id="main-content-wrapper" >
		<div id="main-content">
		   <div  class="page-profile">
				<div class="side-nav" >
					
					<div class="account-side-nav">
						<div class="account-pages">
							
							
							<div class="link"><a href="<?= site_url('account/orders') ?>">Order history</a></div>
							
							<div class="link"><a href="<?= site_url('account/tell-a-friend') ?>">Tell a friend</a></div>
							
							<div class="link"><a href="<?= site_url('account/profile') ?>">Profile</a></div>
							
							<div class="link"><a href="<?= site_url('account/addresses') ?>">Addresses</a></div>
						  
							<!-- <div class="link "><a href="<?= site_url('account/cards') ?>">Credit cards</a></div> -->
							
							<div class="link active"><a href="<?= site_url('account/wallets') ?>">Wallets</a></div>
						   
						</div>
					</div>
				  
				</div>
				<!-- page content -->
				<div class="content">
					<div class="heading">
						<h3>Wallet History</h3>

					</div>
					<div class="order-history">
					<?php if (empty($wallet)){ ?>
					<div class="no-orders">
						<div class="rows">
							<p class="bold">You have no past history for wallet.</p>
							<p><a href="<?= site_url(); ?>" class="button primary">Start your first order now</a></p>
						</div>
					</div>
					<?php }else{ ?>
						<div class="orders-wrapper" >
							<div class="rows f">
								<div class="info-container" >
									<div class="row-1">
										<div class="name">
										   Total Earn Credit
										</div>
										<div class="items" >
											<span class="cart-items" ></span>
										</div>
									</div>
									
									<div class="total">$<?= $wallet->credit ?></div>
								</div>
								<div class="clear-both"></div>
								<div class="row-2">
									<div class="details">
										<span class="text">Total Points used:</span> 
										<span class=""><?= $redeemHistory->p; ?>|</span>
										<span class="text">Total Remaining Points:</span> 
										<span class=""><?= $points->points; ?></span> 
									</div>
								</div>
							</div>
							</div>                            
					<?php } ?>
					<div class="clear-both"></div>
				</div>
					
				</div>
			 </div>
		</div>
	</div>
</div>

<?php echo Modules::run('footer/footer/account'); ?>