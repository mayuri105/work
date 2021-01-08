
<ul class="list-group"  id="conversion-list">

	<?php $lastsender_id = 0; ?>
	<?php foreach ($message as $msg ): ?>
		
	
	<li class="list-group-item   <?= $msg['sender_id'] == $this->session->m_id ? 'text-left sender': 'receiver'   ?>">
		<p><?= $msg['message']; ?></p>
		<span class="<?= $msg['sender_id'] == $this->session->m_id ? 'pull-right ': 'pull-left'   ?>"><i class="fa  fa-chevron-down bigicon"></i>
	</span>
		
	 </li>
	 <br>
	 
	<?php endforeach ?>	
	 <br>
	
</ul>
