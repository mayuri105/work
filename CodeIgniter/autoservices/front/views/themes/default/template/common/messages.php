<?php if($this->session->flashdata('error')){ ?>
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
		<?php 
			echo $this->session->flashdata('error');
		 ?>
	
</div>
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
		<?php 
			echo $this->session->flashdata('success');
		 ?>
</div>
<div class="mt-xl"></div> 
<?php } ?>
<?php if($this->session->flashdata('warnings')){ ?>
<div class="alert alert-info alert-dismissible">
	
	<button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
		<?php 
			echo $this->session->flashdata('warnings');
		 ?>
</div>
<div class="mt-xl"></div> 
<?php } ?>