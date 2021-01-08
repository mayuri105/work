<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css" rel="stylesheet"> 
<?php echo Modules::run('sidebar/sidebar/merchant')  ?>

<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('adsorder'); ?>">Ads Order</a></li>
				<li class="active"><a href="">Place Order</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2 >Ads Order </h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					
					<div class="panel-body">
						<ul class="nav nav-tabs">
							<li class= "active" ><a href="#tab-card"  data-toggle="tab">Credit &amp; Debit Payment</a></li>
							<li><a href="#tab-paypal" data-toggle="tab">Paypal Payment</a></li>
							
						</ul>
						<div class="tab-content">
							
							
							<div class="tab-pane active" id="tab-card">
								<div class="pb"></div>
								<form name="payment-form" class="form-horizontal" id="payment-form"  action="<?=  site_url('adsorder/addadsOrder') ?>" method="post">
							
									<div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer">Store Detail</label>
				                        <div class="col-sm-10">
				                          <input type="text" value="<?= $store->store_name ?>" class="form-control" disabled>
				                        </div>
				                    </div>
				                   
				                    <div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer">
				                        	Package Name</label>
				                        <div class="col-sm-10">
				                          	<input type="text" value="<?= $package->package_name ?>" class="form-control" disabled>
				                        </div>
				                    </div>
				                     <div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer">
				                        	Package Price</label>
				                        <div class="col-sm-10">
				                          	<input type="text" value="<?= $package->package_price ?>" class="form-control" disabled>
				                        </div>
				                    </div>
				                     <div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer">
				                        	Package Periods</label>
				                        <div class="col-sm-10">
				                          	<input type="text" value="<?= $package->package_periods ?>" class="form-control" disabled>
				                        </div>
				                    </div>
									<div class="error-messages red text-center" id="card-errors">
									<div class="message"><div id="payment-errors"></div></div>
									</div>
				                    <div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer">
				                        	Card No</label>
				                        <div class="col-sm-10">
				                          	<input type="text" size="20" class="form-control"  data-stripe="number"/ >

				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer">
				                        	Exp month </label>
				                        <div class="col-sm-10">
				                          <select id="cc-exp-month" data-stripe="exp-month"  class="form-control" >
											   <option value=""></option>
											   <?php for ($i=1; $i<=12; $i++) { ?>
											   	   <option value="<?= $i ?>" ><?= $i ?>
											   	   </option>
											    <?php } ?>
											 </select>
				                        </div>
				                    </div>
				                    
									<div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer">
				                        	Exp Year </label>
				                        <div class="col-sm-10">
					                          <select id="cc-exp-year" data-stripe="exp-year"  class="form-control"  >
												   <option value=""></option>
												   <?php 
													$firstYear = (int)date('Y');
													$lastYear = $firstYear + 20;
													for($i=$firstYear;$i<=$lastYear;$i++)
													{ ?>
													  <option value="<?= $i ?>" ><?= $i ?>
												   	   </option>
													<?php } ?>
												</select>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer"  class="form-control" >
				                        	CVV </label>
				                        <div class="col-sm-10">
					                         <input type="text" id="cvv" data-stripe="cvc"   class="form-control" maxlength="4"  value="" >
				                        </div>
				                    </div>
				                     <div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer"  class="form-control" >
				                        	</label>
				                        <div class="col-sm-10">
					                         <button type="submit" name="payment" class="btn btn-primary" value="" >Pay</button>
				                        </div>
				                    </div>
			                	</form>    
							</div>
							<div class="tab-pane" id="tab-paypal">
								<form name="payment-paypal-form" class="form-horizontal" id="payment-paypal-form-form"  action="<?=  site_url('adsorder/addadsOrder') ?>" method="post">
								<div class="pb"></div>
								<div class="tab-card active" id="card">

								<div class="form-group">
			                        <label class="col-sm-2 control-label" for="input-customer">Store Detail</label>
			                        <div class="col-sm-10">
			                          <input type="text" value="<?= $store->store_name ?>" class="form-control" disabled>
			                        </div>
			                    </div>
			                   
			                    <div class="form-group">
			                        <label class="col-sm-2 control-label" for="input-customer">
			                        	Package Name</label>
			                        <div class="col-sm-10">
			                          	<input type="text" value="<?= $package->package_name ?>" class="form-control" disabled>
			                        </div>
			                    </div>
			                     <div class="form-group">
			                        <label class="col-sm-2 control-label" for="input-customer">
			                        	Package Price</label>
			                        <div class="col-sm-10">
			                          	<input type="text" value="<?= $package->package_price ?>" class="form-control" disabled>
			                        </div>
			                    </div>
			                     <div class="form-group">
			                        <label class="col-sm-2 control-label" for="input-customer">
			                        	Package Periods</label>
			                        <div class="col-sm-10">
			                          	<input type="text" value="<?= $package->package_periods ?>" class="form-control" disabled>
			                        </div>
			                    </div>
								<div class="error-messages red text-center" id="card-errors">
								<div class="message"><div id="payment-errors"></div></div>
								</div>

								<div class="form-group">
				                        <label class="col-sm-2 control-label" for="input-customer"  class="form-control" >
				                        	</label>
				                        <div class="col-sm-10">
					                         <button type="submit" name="paybypal" class="btn btn-primary" value="" >Expreass Checkout Paypal</button>
				                        </div>
				                    </div>		
			                    
			                </form>


							</div>
						</div>
					</div>

						
				</div>
			</div>
		</div>
		<!-- #page-content -->
	</div>
<?php echo Modules::run('footer/footer/index'); ?>
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
  	// $form.find('#card-errors').removeClass('ng-hide');
    $form.find('#payment-errors').text(response.error.message);
    $form.find('button').prop('disabled', false);
  } else {
    var token = response.id;
    $form.append($('<input type="hidden" name="stripetoken" />').val(token));
    $form.get(0).submit();
  }
};

</script>
</body>
</html>