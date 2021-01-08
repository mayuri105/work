<?php if($this->session->flashdata('error')){ ?>
<div class="alert alert-dismissable alert-danger">
	<i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
		<?php 
			echo $this->session->flashdata('error');
		 ?>
	
</div>
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>
<div class="alert alert-dismissable alert-success">
	<i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
		<?php 
			echo $this->session->flashdata('success');
		 ?>
	
</div>
<div class="mt-xl"></div> 
<?php } ?>