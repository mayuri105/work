<?php echo Modules::run('header/header/index'); ?>
 <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css">

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('transaction') ?>">Transaction</a></li>
				<li class="active"><a href="">Add Transaction</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add Transaction</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'transaction');

						echo form_open_multipart('transaction/add', $attributes);  ?>
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        	
						</ul>		
					    <div class="pb"></div>
					   	    <div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Customer Name
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<select name="customer" id="customer" required> 
												<option value=''>None</option>
												<?php foreach ($cust as $c): ?>
													<option value='<?php echo $c->c_id ?>'><?php echo $c->first_name.' '.$c->last_name ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label">Transaction Type	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<select class="form-control" required name="transaction_type">
												<option value="">None</option>
												<option value="rent" <?php echo set_value('transaction_type') =='rent' ? 'selected' : '' ; ?>>Rent</option>
												<option value="purchase" <?php echo set_value('transaction_type') =='purchase' ? 'selected' : '' ; ?>>Purchase</option>
											 </select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Transaction Amount	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="number" class="form-control " required id="transaction_amt" name="transaction_amt"  value="<?php echo set_value('transaction_amt') ?>" >
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Transaction Date	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control " required id="transaction_date" name="transaction_date"  value="<?php echo set_value('transaction_date') ?>" >
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Transaction Time	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control time" required id="transaction_time" name="transaction_time" value="<?php echo set_value('transaction_time') ?>" >
											
										</div>
									</div>
								</div>
						         <div class="modal-footer">
									<a href="<?= site_url('transaction') ?>" class="btn btn-default" >Close</a>
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
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script><!-- Validate Plugin -->
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.min.js"></script><!-- Validate Plugin -->

<script type="text/javascript">

	$('#transaction').validate({
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
	$('#transaction_date').datepicker({
		
	})
	$('#transaction_time').timepicker({})
	$('#customer').select2({})

</script>

</body>
</html>
