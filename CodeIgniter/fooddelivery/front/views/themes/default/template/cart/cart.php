	<header><h3>Your bag</h3></header>
	<section>
		<div class="cart-items">
			<div id="cartBody">
			<?php $storeid=0;
			if ($this->cart->contents()){ ?>
			<?php foreach ($this->cart->contents() as $key ) { ?>
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
						<span class="editCart edit" onclick="editcart('<?= $key['rowid'] ?>','<?= $key['id']; ?>')" ></span>
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
			<?php if ($this->cart->total() <= $min_order ): ?>
			<div class="cart-minimum">
				Subtotal must exceed $<?= $min_order ?>
			</div>
			<?php endif ?>
		</div>
		<?php if($date_time_detail['date']): ?>
		<div class="cta">
			<a onclick="<?= ($this->cart->contents() && $this->cart->total() >= $min_order ) ? 'checkout()' :'' ?>" id="checkoutbtn" class="button primary <?= ($this->cart->contents() && $this->cart->total() >= $min_order )? '' :'disabled' ?> " >Checkout</a>
		</div>
		<?php endif ?>
	    <div class="cart-points points-odometer">
	    	<span class="icon-trophy"></span>
	        <dcom-odometer class="odometer odometer-auto-theme">
	            <div class="odometer-inside">
	            
	            </div>
	        </dcom-odometer>Points
	    </div>
	</footer>
