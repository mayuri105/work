<form action="<?php echo $action?>" method="post" id="payu_form" name="payu_form" style="display:none" >
<input type="hidden" name="key" value="<?php echo $key;?>" />
<input type="hidden" name="txnid" value="<?php echo $txnid;?>" />
<input type="hidden" name="amount" value="<?php echo $amount;?>" />
<input type="hidden" name="email" value="<?php echo $email;?>" />

<?php echo '<input type="hidden" name="productinfo" value="' . htmlspecialchars($productinfo) . '"/>';?>
<input type="hidden" name="firstname" value="<?php echo $firstname;?>" />

<input type="hidden" name="phone" value="<?php echo $phone;?>" />
<input type="hidden" name="surl" value="<?php echo $surl;?>" />
<input type="hidden" name="furl" value="<?php echo $furl;?>" />
<input type="hidden" name="curl" value="<?php echo $curl;?>" />
<input type="hidden" name="hash" value="<?php echo $hash;?>" />
<input type="hidden" name="Pg" value="<?php echo $pg;?>" />
<input type="hidden" name="udf2" value="<?php echo $udf2;?>" />
<input type="hidden" name="service_provider" value="payu_paisa" />
<div class="buttons">
<div class="right hide" >
	<input type="submit" name="submit" id="frmsub" value="submit">
</div>
</div>
</form>
<script src="front/views/themes/default/assets/scripts/jquery.js"></script>
<script type="text/javascript">
	$('#frmsub').click();
</script>



