<?php echo Modules::run('header/header/index'); ?>
 <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css">
   
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('appointment') ?>">Appointment</a></li>
				<li class="active"><a href="">Add Appointment</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add Appointment</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						
						
					    <ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">Property</a></li>
					        
					        	
						</ul>		
					    <div class="pb"></div>
					   	    <div class="tab-content">

						        <div class="tab-pane active" id="tab-general">
						        	<?php 
									$attributes = array('class' => 'form-horizontal', 'id' => 'appointment');

									echo form_open_multipart('appointment/add', $attributes);  ?>
									<input type="hidden" name="appointment_for" value="property">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Customer Name
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<select name="customer" id="customer2" required> 
												<option value=''>None</option>
												<?php foreach ($cust as $c): ?>
													<option value='<?php echo $c->c_id ?>'><?php echo $c->first_name.' '.$c->last_name ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Property
											<span class="required">*</span></label>
											 <!-- <p>Search Property with Title and Id</p> -->
										<div class="col-sm-8">
											<input type="text" class="form-control auto" value="<?php echo set_value('property') ?>" id="property" name="property" required>
										</div>
										<input type="hidden" class="form-control" id="property_id" name="property_id" required>
									</div>
									<div class="form-group">
										
										
					                        <label class="col-sm-3 control-label">Appointment For  
					                            <span class="required">*</span></label>
					                        <div class="col-sm-8">
					                            <select class="form-control" required id="appointment_for" name="appointment_for">
					                                <option value="">None</option>
					                                <option value="sale">Sale</option> 
					                                <option value="rent">Rent</option> 
					                                <option value="investments">Investments</option> 
					                            </select>
					                        </div>
					                    

									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Appointment Date	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<select class="form-control" required id="appointment_date" name="appointment_date">
			                                   <option value="">None</option>
			                                    <?php for ($i=1; $i < 30; $i++) { 
			                                    $day = date('m/d/Y',strtotime('+' . $i . 'day'));
			                                    $d = date('w', strtotime($day));

			                                    if(in_array($d,$open_day)):
			                                    ?>
			                                    <option  value="<?php echo date('m/d/Y',strtotime('+' . $i . 'day')) ?>">
			                                        <?php echo date('l  d/m/Y',strtotime('+' . $i . ' day')) ?>
			                                    </option>

			                                    <?php endif; 
			                                        }
			                                    ?>
			                                </select>
										</div>
									</div>
									<div class="form-group">
				                        <label class="col-sm-3 control-label">Appointment Time  
				                            <span class="required">*</span>
				                        </label>
				                        <div class="col-sm-8">
				                            <select class="form-control" id="appointment_time" name="appointment_time">
				                                
				                            </select>
				                        </div>
				                    </div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Appointment note	
											</label>
										<div class="col-sm-8">
											<textarea class="form-control " id="appointment_note" name="appointment_note"  ><?php echo set_value('appointment_note') ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Appointment Status	
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<select class="form-control" name="appointment_status" required>
												<option value="">None</option>
												<?php foreach ($appstatus as $a ): ?>
													<option value="<?php echo $a->aps_id ?>"  ><?php echo $a->appointment_status ?></option>
												<?php endforeach ?>
											</select>
											
										</div>
									</div>
									   <div class="modal-footer">
										<a href="<?= site_url('appointment') ?>" class="btn btn-default" >Close</a>
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
									</form>

								</div>
							      	 

								
						    </div>
						
					</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
 <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.min.js"></script><!-- Validate Plugin -->
       
<script type="text/javascript">
jQuery.validator.addMethod("greaterThan", 
	function(value, element, params) {

	    if (!/Invalid|NaN/.test(new Date(value))) {
	        return new Date(value) < new Date($(params).val());
	    }

	    return isNaN(value) && isNaN($(params).val()) 
	        || (Number(value) > Number($(params).val())); 
	},'Must be greater than {0}.');	
	$('#appointment').validate({
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
	
	$('#customer,#customer2').select2({})


$('#appointment_date').change(function(){
    var date = $(this).val();
    var data = {
            date : date
        };
        $.ajax({
            url : "<?php echo site_url('appointment/getTimeSlotAvailable') ?>",
            type: "get",
            dataType: "json",
            data: data,
            success:function(data){
                var timeslot = $('#appointment_time');
                timeslot.html('<option value="">None</option>'); 
                var html = '';
                 for (var i = data.length - 1; i >= 0; i--) {
                        console.log()
                        html +='<option value="'+data[i].ts_id+'">'+data[i].start_time+'-'+data[i].end_time+'</option>';
                  };         
                  timeslot.append(html);           
            }
        });
});

$("#property").autocomplete({
    source: "<?php echo site_url('appointment/getproperty') ?>",
    minLength: 1,
    select: function (event, ui) {
        $("#txtAllowSearch").val(ui.item.label); // display the selected text
        $("#property_id").val(ui.item.id); // save selected id to hidden input
    }
}); 


</script>

</body>
</html>
