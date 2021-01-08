 <?php $mainTot =0;$total=0; foreach ($this->cart->contents() as $item): ?>

	<tr>
    	<td><a href="javascript:;"  onclick="removecart('<?= $item['rowid'] ?>')" class="btn btn-danger">Delete</a></td>
											       
        <td class="text-left"><?= $item['name'] ?>
        	<table>
        	<?php $priceOfoption=0; if($item['options']): ?>
				<?php foreach ($item['options'] as $s): 
					if (is_array($s)){ 
						foreach ($s as $k ):
						$ret = $this->order->getOptionData($k); ?>
						<tr>
							<td><?= $ret->option_name.'--'.$ret->option_value ?>-<?= $ret->price ?></td>
						</tr>
						<?php
						$priceOfoption = $priceOfoption + $ret->price;
						 endforeach; 
					}else{ ?>
							<tr>
								<td><?= $s ?></td>
							</tr>
					<?php }
					endforeach; 
				?>
				</table>
		<?php endif ?>
        </td>
		<td class="text-right"><?= $item['qty'] ?></td>
		<td class="text-right">$<?= $item['price'] ?>
			
			<br>
				
				
			<hr>
		   	Total Price: $<?= $item['price'] + $priceOfoption ?>
		</td>
		<td class="text-right">
			$<?= $total = ($item['price'] + $priceOfoption) * $item['qty'] ?>
			<?php $mainTot += $total ?>
		</td>
       
    </tr>
<?php endforeach; ?>
	<tr>
		<td colspan="4" class="text-right">Sub-Total:</td>
		<td class="text-right">$<?=$mainTot; ?></td>
	</tr>
	
	<tr>
		<td colspan="4" class="text-right">Total:</td>
		<td class="text-right">$<?= $mainTot; ?></td>
	</tr>	
</tbody>