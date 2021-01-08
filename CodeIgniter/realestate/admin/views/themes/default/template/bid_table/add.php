<?php echo Modules::run('header/header/index'); ?>

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('bid_table') ?>">Bid table </a></li>
				<li class="active"><a href="">Add Bid table </a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add Bid table </h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'bid_table');

						echo form_open_multipart('bid_table/add', $attributes);  ?>
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        	
						</ul>		
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Bid table date
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="date" required="" id="date" value="" class="date form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Start time
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="start_time" required="" id="start_time" value="" class="timepicker form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">End Time
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="end_time" required="" id="end_time" value="" class="timepicker form-control">
										</div>
									</div>
									
									
									
								</div>
						         <div class="modal-footer">
									<a href="<?= site_url('bid_table') ?>" class="btn btn-default" >Close</a>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
						    </div>
						</form>

					</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>

<script type="text/javascript">
jQuery.validator.addMethod("greaterThan", 
	function(value, element, params) {

	    if (!/Invalid|NaN/.test(new Date(value))) {
	        return new Date(value) < new Date($(params).val());
	    }

	    return isNaN(value) && isNaN($(params).val()) 
	        || (Number(value) > Number($(params).val())); 
	},'Must be greater than {0}.');	
	$('#bid_table').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		rules:{
	        start_date: { greaterThan: "#end_date" }
	    }
		
	});
	
</script>

</body>
</html>
