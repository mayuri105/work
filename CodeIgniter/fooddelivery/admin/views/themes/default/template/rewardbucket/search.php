<?php $i= 1; if(!empty($rewardbuckets)): foreach($rewardbuckets as $rewardbucket): ?>
<tr>
	<td><?= $i; ?></td>
	<td>
		<?php echo $rewardbucket->points_reward ?></td>
	
	<td>
		
		<?php $upload_path =  $this->config->item('show_upload_path').'/rewardbucket/'; ?>
		<?php if ($rewardbucket->image): ?>
		<img src="<?= $upload_path.$rewardbucket->image; ?>" width="50px" height="50px">
		<?php endif ?>

	</td>

	

	<td class="text-right">
		<?php $id = $rewardbucket->rb_id; ?>
		
		<button class="btn btn-primary" onclick="edit('<?php echo $id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $rewardbucket->rb_id; ?>" >Edit</button>
		<a herf ="" data-href ="<?php echo site_url('rewardbucket/delete/'.$id.'') ?>" class="del btn btn-danger"  >Delete</a>
	</td>
</tr>
<?php $i++;endforeach; else: ?>
<tr class="err_msg"><td colspan="5">Reward Bucket(s) not available.</td></tr>
<?php endif; ?>