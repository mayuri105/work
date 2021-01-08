<!DOCTYPE html>
<html dir="ltr" lang="en">
<head></head>
<body>
<div class="container">
		<div style="page-break-after: always;">
		
		Hello sir <?= $username; ?>
		<br>
		Here are order detail which you ordered
		<br>

		<table border="1" class="table table-bordered">
		<thead>
			<tr>
				<td colspan="2">Order Details</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="width: 50%;">
					<address>
						<strong>Your Store</strong>
							<br />
							Address :<?php echo $address; ?>            
						</address>
					<b>Telephone</b> <?php echo $phone ?><br />
					<b>E-Mail</b> <?= $email_address; ?><br />
					</td>
					<td style="width: 50%;">
						<b>Date Added</b> <?php echo date('d-m-Y',strtotime($order->order->created_on)) ?><br />
						<b>Order ID:</b> <?= $order->order->o_id; ?>
						<br />
						<b>Payment Method</b> <?php 
						if ($order->order->payment_method =='paying-paypal'){
							echo 'Paypal';
						}elseif ($order->order->payment_method =='credit-and-other') {
							echo 'Credit & Others';
						}else{
							echo 'Cash on Delivery';
						} ?><br />
						
					</td>
			</tr>
		</tbody>
		</table>
	
		<table border="1" class="table table-bordered">
		<thead>
			<tr>
				<td style="width: 50%;"><b>Payment Address</b></td>
				<td style="width: 50%;"><b>Shipping Adress</b></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<address>
						<?= $order->order->first_name.' '.$order->order->last_name   ?>
							
						<br /><?= $order->order->payment_address   ?>
						<br /><?= $order->order->payment_apt_name   ?>
						<br /><?= $order->order->payment_city   ?>
						<br /><?= $order->order->payment_state   ?>
						<br /><?= $order->order->payment_zip   ?>
								
					</address>
				</td>
				<td>
					<address>
						<?= $order->order->first_name.' '.$order->order->last_name   ?>
							
						<br /><?= $order->order->shipping_address   ?>
						<br /><?= $order->order->shipping_apt_name   ?>
						<br /><?= $order->order->shipping_city   ?>
						<br /><?= $order->order->shipping_state   ?>
						<br /><?= $order->order->shipping_zip   ?>
								
					</address>
				</td>
			</tr>
		</tbody>
		</table>
			
		<?php $mainTotal = 0; foreach ($order->order_store as $oskey ): ?>
		
		<h4><?= ucfirst($oskey->store_name); ?></h4>
		<?php $order_item = $this->checkout->getOrderItemByStore($oskey->so_id) ?>
		<table border="1" class="table table-bordered" width="100%">
			<thead>
				<tr>
					<td class="text-left">Product</td>
					<td class="text-right">Quantity</td>
					<td class="text-right">Unit Price</td>
					<td class="text-right">Total</td>
				</tr>
			</thead>

			<tbody>
				<?php $total=0; 
				foreach ($order_item as $item): ?>
					<tr>
						<td class="text-left"><a href=""><?= $item->product_name ?></a>
							<br> 
							<?php $getOptionValue = $this->checkout->getOptionval($item->oi_id) ?>
							<?php if ($getOptionValue): ?>
								<table>
								<?php
									foreach($getOptionValue as $option): ?>
											<tr>
												<td><?= $option->option_name.'--'.$option->option_value ?></td>
											</tr>
										
									<?php endforeach; 
								 ?>
								</table>
							<?php endif ?>
							
						</td>
						
						<td class="text-right"><?= $item->pro_quantity ?></td>
						<td class="text-right">
							$<?= $item->product_price ?>
							<br>
							
								<?php $tot=0;
									foreach($getOptionValue as $option): ?>
											<table>
											<tr>
												<?= $option->price;
												$tot += $option->price; ?>
											</tr>
											</table>
									<?php endforeach; 
								 ?>
								
							<hr>
						   	Total Price: $<?= $totalUnitPrice = $tot + $item->product_price;    ?>
						</td>
						<td class="text-right">$<?= $price = $item->pro_quantity * $totalUnitPrice ?></td>
					</tr>

					<?php $total += $price  ?>
					<?php endforeach ?>
					<tr>
						<td colspan="3" class="text-right">Sub-Total:</td>
						<td class="text-right">$<?=$total; ?></td>
					</tr>
					<tr>
						<td colspan="3" class="text-right">Tip (in %):<?= $order->order->tip_amount  ?></td>
						<td class="text-right">$<?= $tip = ($total * $order->order->tip_amount )/100; ?></td>
					</tr>
					
					<tr>
						<td colspan="3" class="text-right">Total:</td>
							<?php $mainTotal = $mainTotal + ($tip+$total) ?>
							<td class="text-right">$<?=  $tip+$total; ?></td>
						
					</tr>

					

		
		<?php endforeach ?>
		<?php if ($order->order_coupon): ?>
				<tr>

					<td colspan="5" class="text-right">Coupon:</td>
					<td class="text-right">-$<?= $order->order_coupon->discount ?></td>
				</tr>
				<?php endif ?>
				
				<tr>
					<td colspan="3"  class="text-right">Main Total:</td>
					<?php if ($order->order_coupon): ?>
						<td class="text-right">$<?= $mainTotal-$order->order_coupon->discount; ?></td>
					<?php else: ?>
						<td class="text-right">$<?= $mainTotal; ?></td>
					<?php endif; ?>
				</tr>
		</tbody>
		</table>
			
		<?php if ($order->order->special_inst): ?>
			
		
		
			<table border="1" class="table table-bordered">
				<thead>
					<tr>
						<td><b>Customer Comment</b></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?= $order->order->special_inst  ; ?></td>
					</tr>
				</tbody>
			</table>
		
		<?php endif ?>
		</div>
	
	</div>
</body>
</html>