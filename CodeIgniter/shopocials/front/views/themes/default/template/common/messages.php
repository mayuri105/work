<?php if($this->session->flashdata('error')){ ?>
<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                       <?php 
			echo $this->session->flashdata('error');
		 ?>
                                    </div>
	
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>
<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                       <?php 
			echo $this->session->flashdata('success');
		 ?>
                                    </div>
	
<?php } ?>
<div class="mt-xl"></div> 

<?php if($this->session->flashdata('warnings')){ ?>
<div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                       <?php 
			echo $this->session->flashdata('warnings');
		 ?>
                                    </div>
<div class="mt-xl"></div> 
<?php } ?>