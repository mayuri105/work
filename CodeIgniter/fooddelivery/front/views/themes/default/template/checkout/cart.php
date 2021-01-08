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
			<div id="">$ <span id="grandTotalaft"><?=$this->cart->total() - $wall - $coupon + $tipamount;?></span></div>
			<?php } else {?>
			<div id="">$ <span id="grandTotalaft"><?=$this->cart->total() - $coupon + $tipamount;?></span></div>
			<?php }
	?>

		<?php } else {?>
		<div id="">$ <span id="grandTotalaft"><?=$this->cart->total() + $tipamount?></span></div>
		<?php }
?>
	</strong>
</div>