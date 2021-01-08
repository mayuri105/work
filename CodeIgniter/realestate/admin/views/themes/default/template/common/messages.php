<?php if($this->session->flashdata('error')){ ?>
<div class="alert alert-dismissable alert-danger">
	<i class="fa fa-warning"></i>
		<?php 
			echo $this->session->flashdata('error');
		 ?>
	<div class="pull-right">
		<i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
	</div>
</div>
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>
<div class="alert alert-dismissable alert-success">
	<i class="fa fa-check-circle"></i>
		<?php 
			echo $this->session->flashdata('success');
		 ?>
	 <div class="pull-right">
		<i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
	</div>
</div>
<div class="mt-xl"></div> 
<?php } ?>
<?php if($this->session->flashdata('warnings')){ ?>
<div class="alert alert-dismissable alert-danger">
	
	<i class="fa fa-warning "></i>
		<?php 
			echo $this->session->flashdata('warnings');
		 ?>
	 <div class="pull-right">
		<i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
	</div>
</div>
<div class="mt-xl"></div> 
<?php } ?>