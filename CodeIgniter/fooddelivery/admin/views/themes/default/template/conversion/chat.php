
<ul class="list-group"  id="conversion-list">

	<?php if ($message): ?>
		
	
	<?php foreach ($message as $msg ): ?>
		
	
	<li class="list-group-item   <?= $msg['sender_id'] == $this->session->u_id ? 'text-left sender': 'receiver'   ?>">
		<p><?= $msg['message']; ?></p>
		<span class="<?= $msg['sender_id'] == $this->session->u_id ? 'pull-right ': 'pull-left'   ?>"><i class="fa  fa-chevron-down bigicon"></i>
	</span>
		
	 </li>
	 <br>

	<?php endforeach ?>	
	 <?php else: ?>
	 <p>No Conversion found</p>
	<?php endif; ?>
	 <br>
	
</ul>
