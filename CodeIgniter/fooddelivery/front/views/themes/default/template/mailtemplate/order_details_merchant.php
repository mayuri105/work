<!DOCTYPE html>
<html dir="ltr" lang="en">
<head></head>
<body>
<div class="container">
		<div style="page-break-after: always;">

		Hello sir 
		<br>
		Here are order detail for your store(s).
		<br>

		<?php $mainTotal = 0;
		 ?>

		
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
				<?php $total = 0;
				foreach ($order_item as $item): ?>
					<tr>
						<td class="text-left"><a href=""><?php echo $item->product_name?></a>
							<br>
							<?php $getOptionValue = $this->checkout->getOptionval($item->oi_id)?>
							<?php if ($getOptionValue): ?>
								<table>
								<?php
									foreach ($getOptionValue as $option): ?>
									<tr>
										<td><?php echo $option->option_name . '--' . $option->option_value?></td>
									</tr>
									<?php endforeach;
									?>
								</table>
							<?php endif?>

						</td>

						<td class="text-right"><?php echo $item->pro_quantity?></td>
						<td class="text-right">
							$<?php echo $item->product_price?>
							<br>

								<?php $tot = 0;
									foreach ($getOptionValue as $option): ?>
											<table>
											<tr>
												<?php echo $option->price;
												$tot += $option->price;?>
											</tr>
											</table>
									<?php endforeach;
									?>

							<hr>
						   	Total Price: $<?php echo $totalUnitPrice = $tot + $item->product_price;?>
						</td>
						<td class="text-right">$<?php echo $price = $item->pro_quantity * $totalUnitPrice?></td>
					</tr>

					<?php $total += $price?>
					
					<tr>
						<td colspan="3" class="text-right">Sub-Total:</td>
						<td class="text-right">$<?php echo $total;?></td>
					</tr>
					<tr>
						<td colspan="3" class="text-right">Tip (in %):<?php echo $order->order->tip_amount?></td>
						<td class="text-right">$<?php echo $tip = ($total * $order->order->tip_amount) / 100;?></td>
					</tr>
					<tr>
						<td colspan="3" class="text-right">Total:</td>
							<?php $mainTotal = $mainTotal + ($tip + $total)?>
							<td class="text-right">$<?php echo $tip + $total;?></td>
					</tr>
		<?php endforeach?>



		<?php if ($order->order_coupon): ?>
				<tr>

					<td colspan="5" class="text-right">Coupon:</td>
					<td class="text-right">-$<?php echo $order->order_coupon->discount?></td>
				</tr>
				<?php endif?>

				<tr>
					<td colspan="3"  class="text-right">Main Total:</td>
					<?php if ($order->order_coupon): ?>
						<td class="text-right">$<?php echo $mainTotal - $order->order_coupon->discount;?></td>
					<?php else: ?>
						<td class="text-right">$<?php echo $mainTotal;?></td>
					<?php endif;?>
				</tr>
		</tbody>
		</table>

		
		</div>

	</div>
</body>
</html>
