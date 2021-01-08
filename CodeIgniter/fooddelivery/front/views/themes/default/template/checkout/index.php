<?php echo Modules::run('header/header/account');
?>

<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/plugins/font-awesome/css/font-awesome.min.css">
<div class="page-wrapper">
	<div class="no-default" id="page-header-wrapper" style="background-image: url('<?=getuploadpath() . 'store/' . $store_info->store_data->store_banner;''?>')">
		<div class="sub-navigation-wrapper">
			<div>
				<div>
					<div class="container">
						<ul class="match-media-small">
							<li class="home-nav"><a href="">Search</a></li>
							<li class="merchant-nav"><a href="">Pick merchant</a></li>
							<li class="menu-nav"><a href="">Create order</a></li>
							<li class="checkout-nav"><a>Checkout</a></li>
						</ul>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="page-header">
			<h1>Checkout</h1>
			<p>Almost there! Only one more step to complete your order</p>
		</div>
	</div>
	<div id="main-content-wrapper">
		<div id="main-content">
			<aside class="menu-aside">
				<div class="module cart ready" id="cartWrapper" >
					<header>
						<h3>Your bag</h3>
					</header>
					<section>
						<div class="cart-items">
							<div id="cartBody">
							<?php if ($this->cart->contents()) {
							$storeid = 0;
							$storezip = array();
							foreach ($this->cart->contents() as $key) {?>
								<div class="item mini_cart_item">
									<?php if ($storeid != $key['store_id']): ?>
									<?php 

										$storezip[] = $this->cart_model->getStoreZip($key['store_id']);
									 
									 ?>		
									<h4>Store Name :<?=$store_name = $this->cart_model->get_store_name($key['store_id']);?> </h3>
									<?php endif?>
									<div class="details">

										<div class="name">
											<?=$key['qty'];?>-<?=$key['name'];?>

											<span class="price">
												<span class="amount">
													<strong>$<?=$key['subtotal'];?></strong>
												</span>
											</span>
										</div>
										<?php if ($key['options']): ?>
											<div class="instructions">
												<?php foreach ($key['options'] as $s):
												if (is_array($s)) {
													foreach ($s as $k):
														$ret = $this->cart_model->getOptionData($k);
														echo '<div >' . $ret->option_value . '' . '<span class="pull-right">$' . $ret->price . '</span></div>';
													endforeach;
												} else {
													echo '<div >' . $s . '</div>';
												}
											endforeach;
											?>
											</div>
										<?php endif?>
									</div>
									<div style="clear:both"></div>
								</div>
								<?php $storeid = $key['store_id'];?>
							<?php }} else {?>
							<div class="empty-cart" >
								<div>No items in your bag</div>
							</div>
							<?php } ?>
							
							</div>
						</div>
					</section>
					<footer>
						<div class="cart-info" >
							<div class="cart-info" id="cartinfo">


								<div class="subtotal" >
									<span class="label">Subtotal:</span>$<span id="mainsubtotal"><?=$this->cart->total();?> </span>
								</div>
								<?php if ($this->session->userdata('paymenttype') != 'paying-cash'): ?>
								<?php if ($coupon): ?>
								<div class="subtotal" >
									<span class="label">Coupon Discount:</span> -$<span class=""><?=$coupon;?> </span>
								</div>
								<?php endif?>
								
								<?php if ($wallets): ?>
								<div class="subtotal" >
									<span class="label">Wallet Credit:</span> -$
									<span class=""> 
									<input value="<?=$wall;?>" max="<?=$wallets->credit;?>" onkeyup="updatewallet()" type="number" id="walletvalue" style="width:50px" name="walletvalue">
									
									</span>

								</div>
								<?php endif?>

								<?php endif?>

								<div class="tipamount">
									<span class="label">Tip(%<?=$tip?>)</span>
									<span class="value"><?=$tipamount = ($this->cart->total() * $tip) / 100;?></span>
								</div>

								<div class="total"><strong class="label">Total:</strong>
									<strong class="value">
										<?php if ($this->session->userdata('paymenttype') != 'paying-cash') {?>
											
											<?php if ($wallets) {?>
											<div id="">$<span id="grandTotalaft"><?= $final = $this->cart->total() - $wall - $coupon + $tipamount;?></span></div>
											<?php } else {?>
											<div id="">$<span id="grandTotalaft"><?= $final =  $this->cart->total() - $coupon + $tipamount;?></span></div>
											<?php }
											?>

										<?php } else {?>
										<div id="">$<span id="grandTotalaft"><?=   $final = $this->cart->total() + $tipamount?></span></div>
										<?php }
										?>
									</strong>
								</div>
							</div>
						</div>
						<div class="cta">
							<button type="button" class="button primary " id="submitbtn2">Place your order</button>
						</div>
						<div >
						    <div class="cart-points points-odometer" tooltip="" tooltip-placement="bottom">
						    	<span class="icon-trophy"></span>
						        <dcom-odometer ng-model="cart_points" class="odometer odometer-auto-theme">
						            <div class="odometer-inside">

						            </div>
						        </dcom-odometer>Points
						    </div>
						</div>

					</footer>


				</div>
			</aside>
			<div class="checkout-details">
				<form name="locationform" id="payment-form" class="address" action="<?=site_url('checkout/addorder')?>" method="post">
					<input name="my_cartdata" value="" type="hidden" id="my_cartdata">

					<div class="info">
							<div class="section review-order">
								<div class="text-container">Please review your
									<strong><?=$store_info->store_data->store_name;?></strong> order for
									<?php if ('4' == $store_info->store_data->store_type): ?>
										<strong>
											Pick Up  times: <?=date('M-d,Y', strtotime($this->session->userdata('pickupdate'))) . ' ' . date('g : i  a ', strtotime($this->session->userdata('picuptime')))?>
											Delivery times: <?=date('M-d,Y', strtotime($this->session->userdata('deliverydate'))) . ' ' . date('g : i  a ', strtotime($this->session->userdata('deliverytime')))?>

										</strong>
									<?php else: ?>
									<strong>

										<span>
											<?=ucfirst($this->session->userdata('pickordelivery'))?></span>
											<?=date('M-d,Y', strtotime($this->session->userdata('date'))) . ' ' . date('g : i  a ', strtotime($this->session->userdata('time')))
										?>
									</strong>
									<?php endif;?>
								</div>

							</div>

							<div class="section form-container delivery-informations">
								<div class="text-container">

									<div>
										<h3 class="header">Delivery information</h3>


										<hr>
										<?php if ($this->session->flashdata('error')): ?>


										<div class="error-messages ">
											<div class="message"><?=$this->session->flashdata('error');?></div>
										</div>
										<?php endif?>
										<?php if (!empty($customer_data->customer_address)): ?>
										<div class="delivery-address">
											<div class="address-box">
												<div class="address">
													<?=$customer_data->customer_address->apt_name . ',' . $customer_data->customer_address->street_address?>
												</div>
												<?=$customer_data->customer_address->city . ',' . $customer_data->customer_address->state . ' , ' . $customer_data->customer_address->zip?>
											</div>
											<a class="edit" onclick="toggleeditaddress();">(edit)</a>
										</div>
										<?php endif?>
									</div>



								</div>
								<!-- Customer Address Code Starts Here -->
								<?php if (!empty($customer_data->customer_address)) {?>
								<div class="address-fields ng-hide ">
									<input id="address_id" type="hidden" name="address_id" value="<?=$customer_data->customer_address->address_id;?>">
									<div class="form-field address">
										<label for="street-input">Street address <sup>*</sup></label>
										<input type="text" id="street-input" name="street" value="<?=$customer_data->customer_address->street_address;?>">
									</div>
									<div class="form-field city">
										<label for="city-input">City <sup>*</sup></label>
										<input type="text" id="city-input" name="city" value="<?=$customer_data->customer_address->city;?>">
									</div>
									<div class="form-field state">
										<label for="state-input">State <sup>*</sup></label>
										<select name="state" id="state">
											<option value="none">None</option>
											<?php foreach ($state as $st): ?>
												<option value="<?=$st->code?>" <?=$st->code == $customer_data->customer_address->state ? 'selected' : ''?>><?=$st->name?></option>
											<?php endforeach?>

										</select>
									</div>
									<div class="form-field zip">
										<label for="zip-input">Zip code <sup>*</sup></label>
										<input type="number" maxlength="6" id="zip-input" name="zip"  placeholder="Enter zip code" value="<?= $customer_data->customer_address->zip;?>">
									</div>
								</div>
								<div class="form-field unit">
									<label for="unit-input">Apt / suite / company</label>
									<input type="text" id="unit-input" name="apt_name" value="<?=$customer_data->customer_address->apt_name;?>" class="ng-pristine ng-untouched ng-valid">
								</div>
								<div class="form-field phone">
									<label for="phone-input">Phone number <sup>*</sup></label>
									<input type="number" maxlength="14" name="phone" value="<?=$customer_data->customer_address->phone_no;?>" id="phone-input" >
								</div>

								<?php } else {?>
								<div class="address-fields ">
									<div class="form-field address">
										<label for="street-input">Street address <sup>*</sup></label>
										<input type="text" id="street-input" name="street" value="">
									</div>
									<div class="form-field city">
										<label for="city-input">City <sup>*</sup></label>
										<input type="text" id="city-input" name="city" value="">
									</div>
									<div class="form-field state">
										<label for="state-input">State <sup>*</sup></label>
										<select name="state" id="state">
											<option value="none">None</option>
											<?php foreach ($state as $st): ?>
												<option value="<?=$st->code?>" ><?=$st->name?></option>
											<?php endforeach?>

										</select>
									</div>
									<div class="form-field zip">
										<label for="zip-input">Zip code <sup>*</sup></label>
										<input type="text" maxlength="5" id="zip-input" name="zip"  placeholder="Enter zip code" value="">
									</div>
								</div>
								<div class="form-field unit">
									<label for="unit-input">Apt / suite / company</label>
									<input type="text" id="unit-input" name="apt_name" value="" class="ng-pristine ng-untouched ng-valid">
								</div>
								<div class="form-field phone">
									<label for="phone-input">Phone number <sup>*</sup></label>
									<input type="tel" maxlength="14" name="phone" value="" id="phone-input" >
								</div>

								<?php }
?>
								<!-- Customer Address Code End Here -->
							</div>

							<div class="form-container special-instructions" >
								<div class="form-field ">
									<input  maxlength="100" type="text"
									placeholder="Special instructions (Limit 100 characters)" id="instructions-input"
									class="" name="specialinstruction">

								</div>
							</div>
							<div id="payment-info" class="payments">
								<?php $totalEnabled = $stripe_enable + $paypal_enable + $cod_enable;

							if ('0' != $totalEnabled): ?>
								<div class="payment-info">

									 <div class="select-payment-type tabs supports-<?=$totalEnabled?>">

										<?php if ($stripe_enable): ?>
										<a class="payment-type tab <?=$paymentmethod == 'credit-and-other' ? 'active' : ''?>" data-name="credit-and-other">
											<span class="">Credit card</span>
											<span class="ng-hide">Card</span>
										</a>
										<?php endif?>
										<?php if ($paypal_enable): ?>


										<a class="payment-type tab <?=$paymentmethod == 'paying-paypal' ? 'active' : ''?>" data-name="paying-paypal">
											<span class="icon-paypal-pay"></span>
											<span class="icon-paypal-pal"></span>
										</a>
										<?php endif?>
										<?php if ($cod_enable): ?>
										<a id="cash-tab" class="payment-type tab <?= $paymentmethod == 'paying-cash' ? 'active' : ''?>" data-name="paying-cash">Cash</a>
										<?php endif?>
									</div>

									<div class="credit-and-other payment-option  <?=$paymentmethod == 'credit-and-other' ? '' : 'ng-hide' ?>" id="credit-and-other">
										<div class="credit-new payment-method">
											<?php if ($stripe_threshold_value): ?>
											<label id="credit-new-label" >For this payment min order amount is $<?=$stripe_threshold_value?></label>
											<?php endif?>

											<div class="form-container">
												<div class="card-form ">
													<div class="error-messages ng-hide" id="card-errors">
														<div class="message"><div id="payment-errors"></div></div>
													</div>
													<div class="cc-images">
														<div dcom-card-type="">
															<span class="dcom-card-type">
																<span class="visa"></span>
																<span class="mastercard"></span>
																<span class="amex"></span>
																<span class="discover"></span>
																<span class="secure"></span>
															</span>
														</div>
													</div>
													<div class="cc-number">
														<label>Credit card number<sup>*</sup></label>

														<input type="text" size="20" data-stripe="number"/>
													</div>
													<div class="date">
														<div class="wrapper">
															<span class="exp-month">
																<label >Exp. month<sup>*</sup></label>
																<select id="cc-exp-month" data-stripe="exp-month">
																   <option value=""></option>
																   <?php for ($i = 1; $i <= 12; $i++) {?>
																   	   <option value="<?=$i?>" ><?=$i?>
																   	   </option>
																    <?php }
																	?>
																 </select>
															</span>
															<span class="exp-year">
																<label >Exp. year<sup>*</sup></label>
																<select id="cc-exp-year" data-stripe="exp-year" >
																   <option value=""></option>
																   <?php
																	$firstYear = (int) date('Y');
																	$lastYear = $firstYear + 20;
																	for ($i = $firstYear; $i <= $lastYear; $i++) {?>
																	  <option value="<?=$i?>" ><?=$i?>
																   	   </option>
																	<?php }
																?>
																</select>

															</span>
														</div>
													</div>
													<div class="cvv-and-billingzip">
															<div class="wrapper">
															<span class="cvv">
																<label >CVV<sup>*</sup></label>
																<input type="text" id="cvv" data-stripe="cvc"  maxlength="4"  value="" >
															</span>
															</div>
													</div>

													<div class="cancel ng-hide"><a>Cancel</a></div>
												</div>
											</div>
										</div>
									</div>
									<div id="paying-paypal" class="paypal payment-option  <?=$paymentmethod == 'paying-paypal' ? '' : 'ng-hide'
?>">
										<?php if ($paypal_threshold_value): ?>
											<label id="credit-new-label " class="red" >For this payment min order amount is $<?=$paypal_threshold_value?></label>
										<?php endif?>
										<div class="paypal-text">
											<p>Pay with your PayPal account</p>
											<p class="note">Make sure to review your order details now.
												<br>Once you press "Place your order" you'll be directed to PayPal
												to enter your payment information and process the order.</p>
										</div>
										<div class="paypal-logo"></div>

									</div>

									<div id="paying-cash" class="cash payment-option <?=$paymentmethod == 'paying-cash' ? '' : 'ng-hide'
?>">
										<?php if ($cash_threshold_value): ?>
											<label id="credit-new-label " class="red" >For this payment min order amount is $<?=$cash_threshold_value?></label>
										<?php endif?>
										<p>You will be paying with Cash</p>
										<p class="note">Note: cash cannot be combined with any other payments
										 (i.e. gift cards, Tell-a-Friend credits, or promo codes).</p>
									</div>

								</div>
								<?php endif?>
								<div class="adjustments-container">
									<div class="line-total tip">
										<p><span>Tip amount</span> <span class="per"></span></p>
										<div class="amount">
											<a class="tip-percent <?=$tip == 10 ? 'active' : ''?>">10%</a>
											<a class="tip-percent <?=$tip == 15 ? 'active' : ''?>" id="main-tip">15%</a>
											<a class="tip-percent <?=$tip == 20 ? 'active' : ''?>">20%</a>
											<a class="tip-percent <?=$tip == 'cash' ? 'active' : ''?> tip-cash">Tip cash</a>
											<input type="number" id="tip-input"  min="1" max="100" name="tip_amount">
										</div>
									</div>
									<input type="hidden"  id="tipamount" name="tipamount" value="<?=$tip?>">
									    <div  id="promo-gift-codes" class="other-payments">
									        <input type="text" class="discount-input" placeholder="Coupon Code"  name="couponcode" id="couponcode">
									        	<a class="button primary discount-button " id="submitcoupon">
									        		<span  class="contents">
									        		<span class="cta" >Add</span>
									        		<span class="icon-checkmark ng-hide"></span>
									        		</span>
									        		<span class="spinner"></span>

									    		</a>
									        <div class="clear"></div>
									    </div>
									    <div  class="other-payments active" id="promos-wrapper">
									    	<div id="errorcoupon"></div>
									    	<?php if ($coupon): ?>
									    		<div id="errorcoupon">You have successfully Applied Coupon </div>
									    	<?php endif?>
									    </div>

								</div>
							</div>
					</div>

					<div class="cta-wrapper">
						<div class="cart-info cart-info-checkout">


							<div class="btn-wrapper">
								<button class="button primary order-button" id="submitBtn" type="submit" >
									<span class="contents" >
										<span class="cta" >
											Place your order
										</span>
									</span>
									<span class="spinner"></span>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php 
$zipsall = array_flatten($storezip); 
$forcheck = array('zipcode'=>$zipsall);

if ($customer_data->customer_address) {
	$custzip = $customer_data->customer_address->zip;

}else{
	$custzip ='0';
}


if ($custzip) {
	if (!in_array($custzip,$zipsall)) { ?>
	<script type="text/javascript">
	$(function(){
		$('.worningAboutcart,.modal-backdrop').css({"display":"block","z-index":"1040"});
		$('.worningAboutcart,.modal-backdrop').addClass('in');
	});

</script>
<div class="modal-backdrop fade " modal-animation-class="fade" modal-animation="true" style="display: none;"></div>	
<div modal-render="true" tabindex="-1" role="dialog" class="modal fade in worningAboutcart" id="worningAboutcart" modal-animation-class="fade" 
	style="">
		<div class="modal-dialog" >
			<div class="modal-content" modal-transclude="">
				<div class="modal-header">
				</div>
				<div class="modal-body">
					<div class="content" id="data">
						<h3>Store not providing delivery and pickup on your address</h3>
						Please chanage address 
						or <a href="<?php echo site_url('account/addresses') ?>" target="new">Add Address</a>
					</div>

				</div>
				
			</div>
		   <script type="text/javascript">
					$( '#submitbtn2,#submitBtn' ).addClass('disabled ' );
	     	$("#submitbtn2,#submitBtn").attr( "disabled", "disabled" );
			</script>
		</div>
	</div>
	
	<?php }
}
?>
<?php if ('credit-and-other' == $paymentmethod) {
?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<?php
echo '<script type="text/javascript">(function() {Stripe.setPublishableKey("' . $stripe_key_public . '");})();</script>';
	?>

<script type="text/javascript">
jQuery(function($){
	$('#payment-form').submit(function(event) {
    var $form = $(this);
	$form.find('button').prop('disabled', true);
	Stripe.card.createToken($form, stripeResponseHandler);
	return false;
  });
});
function stripeResponseHandler(status, response) {
  var $form = $('#payment-form');
  if (response.error) {
  	$form.find('#card-errors').removeClass('ng-hide');
    $form.find('#payment-errors').text(response.error.message);
    $form.find('button').prop('disabled', false);
  } else {
    var token = response.id;
    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
    $form.get(0).submit();
  }
};

</script>
<?php }
?>
<script type="text/javascript">
	$(function (){
	$('#submitbtn2').click(function(){
		$('#payment-form').submit();
	});
});
</script>
<script type="text/javascript">
	pointTable();
	window.odometerOptions = {
	  format: '(ddd).dd'
	};
	function pointTable(){
		var totalamount = '<?=$final;?>';
		var pointValue = '<?=$pointsvalue;?>';
		setTimeout(function(){
			$('.odometer').html(parseInt(totalamount*pointValue));
		}, 1000);
	}
	$('#submitcoupon').click(function(){
		data = {
			couponcode:$('#couponcode').val()
		}
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('checkout/applaycoupon')?>",
			data: data,
			dataType:"json",
			success: function(data){
				$('#errorcoupon').html(data.response);
				if(data.response_id==1){
					window.location.reload();
				}
			}
		})
	});
	$('.tab').click(function(e){
		var act = $(this).data('name');
		$('.payment-option').addClass('ng-hide');
		$('#'+act).removeClass('ng-hide');
		$('.tab').removeClass('active');
		$(this).addClass('active');
		if(act == 'credit-and-other'){

		}
		data = {
			paymenttype:act
		}
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('checkout/setpaymenttype')?>",
			data: data,
			dataType:"json",
			success: function(data){
				window.location.reload();
			}
		})

	});
	function toggleEditForm(){
		$('#order-time-edit').toggle();
	}
	function toggleMenuNavigation(){
		$('#menu_navigation').toggle();
	}
	function toggleeditaddress(){
	   var check = $( ".address-fields" ).hasClass( "ng-hide" );
	   check ? $('.address-fields').removeClass('ng-hide') : $('.address-fields').addClass('ng-hide')

	}
	function returntot(){
		return parseFloat($('#mainsubtotal').text());
	}

	$('.tip-percent').click(function(){
		$('.tip-percent').removeClass('active');
		$(this).addClass('active');
		$('#tipamount').val(parseInt(this.text));

		if(isNaN(parseFloat(this.text))){
			tip= 'cash';
		}else{
			tip= parseFloat(this.text);
		}
		data = {
			tip:tip
		}
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('checkout/settipamount')?>",
			data: data,

			success: function(data){
				$('#cartinfo').html(data);
			}
		})
	});

	$('#tip-input').keyup(function(){
		if ($(this).val()<=100) {
			data = {
				tip:$(this).val()
			}
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('checkout/settipamount')?>",
				data: data,
				success: function(data){
					$('#cartinfo').html(data);
				}
			})
		} else{};
	});
</script>
<script type="text/javascript">
	$('#phone-input').keyup(function(){
		x = $(this).val();
	    if ( x == '' || x.length < 10 ||  x.length > 14  ) {
	     	$( '#submitbtn2,#submitBtn' ).addClass('disabled ' );
	     	$("#submitbtn2,#submitBtn").attr( "disabled", "disabled" );
	     } else {
	     	
	     	checkbothvalue();
	    }
	});
	function checkbothvalue(){
		var phon = $('#phone-input').val();
		var allzip = '<?php echo json_encode($forcheck) ?>';
		var json_obj = $.parseJSON(allzip);
		var Lstarr = json_obj.zipcode;
		var zip =  $('#zip-input').val();
		if ($.inArray(zip, Lstarr) > -1){
		    $('#submitbtn2,#submitBtn' ).removeClass('disabled ' )
	     	$("#submitbtn2,#submitBtn").removeAttr( "disabled", "disabled" );
	     }else{
	     	$( '#submitbtn2,#submitBtn' ).addClass('disabled ' );
	     	$("#submitbtn2,#submitBtn").attr( "disabled", "disabled" );
	     }

	}
	$('#zip-input').keyup(function(){
		var needle = $(this).val();
		var allzip = '<?php echo json_encode($forcheck) ?>';
		var json_obj = $.parseJSON(allzip);
		var Lstarr = json_obj.zipcode;
		if ($.inArray(needle, Lstarr) > -1){
		    $('#submitbtn2,#submitBtn' ).removeClass('disabled ' )
	     	$("#submitbtn2,#submitBtn").removeAttr( "disabled", "disabled" );
	     }else{
	     	$( '#submitbtn2,#submitBtn' ).addClass('disabled ' );
	     	$("#submitbtn2,#submitBtn").attr( "disabled", "disabled" );
	     	checkbothvalue();
	     }
		
	});
	function updatewallet(){
		
		var wall = document.getElementById("walletvalue").value;
		var cr = <?php echo $wallets->credit ?>;
		if (wall <= cr) {
			data = {
				wall:wall
			}
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('checkout/setwallet')?>",
				data: data,
				success: function(data){
					$('#cartinfo').html(data);
				}
			})
		} else{

			$('#walletvalue').val('<?php echo $wallets->credit ?>')
		};
	}

</script>
<?php echo Modules::run('footer/footer/index');?>
