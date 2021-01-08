<?php $i= 1; if(!empty($categories)): foreach($categories as $category): ?>
<tr>
	<td><?= $i; ?></td>
	<td><?php echo $city->city_name ?></td>
	<td><?php echo $city->state ?></td>
	<td>
		
		<?php $upload_path =  $this->config->item('show_upload_path').'/city/'; ?>
		<img src="<?= $upload_path.$city->city_image_url; ?>" width="50px" height="50px">

	</td>
	<td>
		<?php $id = $city->city_id; ?>
		
		<button class="btn btn-primary" onclick="edit('<?php echo $id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $city->city_id; ?>" >Edit</button>
		<a herf ="" data-href ="<?php echo site_url('city/delete/'.$id.'') ?>" class="del btn btn-danger"  >Delete</a>
	</td>
</tr>
<?php $i++;endforeach; else: ?>
<tr class="err_msg"><td colspan="5">Category(s) not available.</td></tr>
<?php endif; ?>