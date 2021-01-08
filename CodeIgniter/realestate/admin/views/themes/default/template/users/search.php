<?php $i= 1; if(!empty($users)):
 foreach($users as $user): ?>
	<tr>
		<td><?= $i; ?></td>
		<td><?php echo $user->username ?></td>
		<td><?php echo $user->first_name ?></td>
		<td><?php echo $user->last_name ?></td>
		<td>
			<?php $id = $user->u_id; ?>
			<button class="btn btn-primary" onclick="edit('<?php echo $id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $user->u_id; ?>" >Edit</button>

			<a herf ="" data-href ="<?php echo site_url('users/delete/'.$id.'') ?>" class="del btn btn-danger"  >Delete</a>
		</td>
	</tr>
	<?php $i++; endforeach; else: ?>
	<tr class="err_msg"><td colspan="5">User(s) not available.</td></tr>
	<?php endif; ?>