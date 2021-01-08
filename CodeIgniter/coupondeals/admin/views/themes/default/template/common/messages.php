<?php if($this->session->flashdata('error')){ ?>
<div class="alert alert-block alert-danger fade in">
 <button type="button" class="close" data-dismiss="alert"></button>
           <h4 class="alert-heading">Error!</h4>
            <p>
		<?php 
			echo $this->session->flashdata('error');
		 ?>
         </p>
	
</div>
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>
<div class="alert alert-block alert-success fade in">
 <button type="button" class="close" data-dismiss="alert"></button>
           <h4 class="alert-heading">Success!</h4>
            <p>
		<?php 
			echo $this->session->flashdata('success');
		 ?>
	</p>
</div>
<div class="mt-xl"></div> 
<?php } ?>
<?php if($this->session->flashdata('warnings')){ ?>
<div class="alert alert-block alert-warning fade in">
 <button type="button" class="close" data-dismiss="alert"></button>
           <h4 class="alert-heading">Warning!</h4>
            <p>
		<?php 
			echo $this->session->flashdata('warnings');
		 ?>
         </p>
	 
</div>
<div class="mt-xl"></div> 
<?php } ?>

