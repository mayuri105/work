<?php $i= 1; if(!empty($coupons)): foreach($coupons as $coupon): ?>
	<tr>
		<td><?= $i; ?></td>
		<td><?php echo $coupon->coupon_name ?></td>
		<td><?php echo $coupon->discount ?></td>
		<td><?php echo $coupon->type ?></td>
		<td><?php echo $coupon->coupon_code ?></td>
		
		<td><?php echo date('d-m-Y',strtotime($coupon->date_start)) ?></td>
		<td><?php echo date('d-m-Y',strtotime($coupon->date_end)) ?></td>
		<td><?php echo $coupon->status ? 'YES' : 'NO' ?></td>
		
		<td class="text-right">
			<?php $id = $coupon->c_id; ?>
			<a class="btn btn-primary"href="<?php echo site_url('coupons/edit/'.$id.'') ?>"  >Edit</a>
			<a herf ="" data-href ="<?php echo site_url('coupons/delete/'.$id.'') ?>" class="del btn btn-danger"  >Delete</a>
		</td>
	</tr>
	<?php $i++;endforeach; else: ?>
	<tr class="err_msg"><td colspan="5">Coupon(s) not available.</td></tr>
	<?php endif; ?>