<?php $i= 1; if(!empty($pages)): foreach($pages as $page): ?>
	<tr>
		<td><?= $i; ?></td>
		<td><?php echo $page->title ?></td>
		<td>
			<?php $id = $page->p_id; ?>
			<a href="<?php echo site_url('page/edit/'.$page->p_id.''); ?>" class=" btn btn-primary">Edit</a>

			<a herf ="" data-href ="<?php echo site_url('page/delete/'.$id.'') ?>" class="del btn btn-danger"  >Delete</a>
		</td>
	</tr>
	<?php $i++;endforeach; else: ?>
	<tr class="err_msg"><td colspan="5">Page(s) not available.</td></tr>
	<?php endif; ?>
									