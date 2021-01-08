<?php $i= 1; if(!empty($states)): foreach($states as $st): ?>
	<tr>
		<td><input type="checkbox" value="<?= $st->id ?>" class="delete" name="delete[]"></td>
		<td><?php echo $st->name ?></td>
		<td><?php echo $st->code  ?></td>
		<td><?php echo $st->status ? 'Enabled' :'Disabled'  ?></td>

		<td class="text-right">
			<?php $id = $st->id; ?>
			<button class="btn btn-primary" onclick="edit('<?php echo $id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $st->id; ?>" >Edit</button>
		</td>
	</tr>
	<?php $i++;endforeach; else: ?>
	<tr class="err_msg"><td colspan="5">State(s) not available.</td></tr>
	<?php endif; ?>
									