<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css">

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Property</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
						<div class="panel-body ">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-general" data-toggle="tab">Open Days</a></li>
								<li class=""><a href="#tab-propertyDe" data-toggle="tab">Time Slot Settings</a></li>
							</ul>	
							<div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
						        	<?php 
									$attributes = array('class' => 'form-horizontal', 'id' => 'themesett');

									echo form_open('scheduler/saveDayOption', $attributes);  ?>
									<div class="pb"></div>
						        	<div class="form-group">

										<label class="col-sm-4 control-label">Select Days For Open Appointment</label>
										<div class="col-sm-8">
											<?php $open_day_ar = explode(',',$open_day) ?>
											<select class="form-control" id="day" multiple name="open_day[]">
												<option value="0" <?php echo  in_array('0',$open_day_ar) ? 'selected' : '' ?> >Sunday</option>
												<option value="1" <?php echo  in_array('1',$open_day_ar) ? 'selected' : '' ?>>Monday</option>
												<option value="2" <?php echo  in_array('2',$open_day_ar) ? 'selected' : '' ?>>Tuesday</option>
												<option value="3" <?php echo  in_array('3',$open_day_ar) ? 'selected' : '' ?>>Wednesday</option>
												<option value="4" <?php echo  in_array('4',$open_day_ar) ? 'selected' : '' ?>>Thursday</option>
												<option value="5" <?php echo  in_array('5',$open_day_ar) ? 'selected' : '' ?>>Friday</option>
												<option value="6" <?php echo  in_array('6',$open_day_ar) ? 'selected' : '' ?>>Saturday</option>
												
											 </select>	
										</div>
									</div>

									<div class="modal-footer">
										
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
									</form>
						        </div>
						        <div class="tab-pane"  id="tab-propertyDe">
						        	<div class="pb"></div>
						        	<!-- <button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button> -->
						        	<table class="table table-border" id="aftersearch">
									<thead>
										<tr>
											<th>#</th>
											<th>Start Time</th>
											<th>End Time</th>
											<th>Enabled</th>
											<th>Action</th>
											
										</tr>
									</thead>
									<tbody id="tbody">
										<?php foreach ($timeslot as $t): ?>
										<tr>
											<td><input type="checkbox" value="<?= $t->ts_id ?>" class="delete" name="delete[]"></td>
											<td><?php echo date('g:i:a',strtotime($t->start_time)) ?></td>
											<td><?php echo date('g:i:a',strtotime($t->end_time)) ?></td>
											<td><?php echo $t->enabled ? 'Yes' : 'No' ?></td>
											<td class="text-right"><a onclick="edit('<?php echo $t->ts_id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $t->ts_id; ?>"  class="btn btn-primary">Edit</a>	</td>
											
										</tr>		

										<?php endforeach ?>

									</tbody>
									</table>

									<?php 
									$attributes = array('class' => 'form-horizontal', 'id' => 'themesett');

									echo form_open('scheduler/addtimeslot', $attributes);  ?>
									<div class="pb"></div>
									<div class="form-group ">
										<label class="col-sm-3 control-label">Start Time</label>
										<div class="col-sm-8">
											<input type="text" name="start_time" value="" class=" timepicker form-control">
										</div>
									</div>
									<div class="form-group ">
										<label class="col-sm-3 control-label">End time</label>
										<div class="col-sm-8">
											<input type="text" name="end_time" value="" class="timepicker form-control">
										</div>
									</div>
									<div class="form-group ">
										<label class="col-sm-3 control-label">Enabled</label>
										<div class="col-sm-8">
											<select   name="enabled" value="" class=" form-control">
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										
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
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>

<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Time Slot Edit</h2>
				</div>
				
				<div class="modal-body"	>
					<?php 
					$attributes = array('class' => 'form-horizontal', 'id' => 'appointment');

					echo form_open_multipart('scheduler/update', $attributes);  ?>
					
					<input type="hidden" name="ts_id" id="ts_id" value="" class="form-control">
					
					<div class="pb"></div> 
					<!-- <div class="form-group ">
						<label class="col-sm-3 control-label">Start Time</label>
						<div class="col-sm-8">
							<input type="text" name="start_time" id="start_time" value="" class=" timepicker2 form-control">
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-3 control-label">End time</label>
						<div class="col-sm-8">
							<input type="text" name="end_time" id="end_time" value="" class="timepicker2 form-control">
						</div>
					</div> -->
							<div class="form-group ">
								<label class="col-sm-3 control-label">Enabled</label>
								<div class="col-sm-8">
									<select   name="enabled" id="enabled" value="" class=" form-control">
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update changes</button>
				</div>
				</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('#delete').click(function(event){
        	var dat = $('input:checkbox.delete').serialize();
			alertify.confirm("Are you sure you want to Delete this TimeSlot ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('property/deletemultiple'); ?>",
						type: "post",
						data:dat+'&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>',
						success:function(data){
							window.location.reload();
						}
					});
       
			    } else {
			       //alert();
			    }
			});
		});
		
	});
function edit(ids){
		
		var data = {
			id : ids
		};
		$.ajax({
			url : "<?php echo site_url('scheduler/gettimesechudle') ?>",
			type: "get",
			dataType: "json",
			data: data,
			success:function(data){
				$('#ts_id').val(data.ts_id);
				$('#start_time').val(data.start_time);
				$('#end_time').val(data.end_time);
				$('#enabled').val(data.enabled);
					
			}
		});
		
	}
$(function() {
		$('#day').multiselect({
			includeSelectAllOption: true
		});
		//$('.timepicker').timepicker({})
		$('.timepicker2').timepicker({
		   template: 'modal'
		});
	});



</script>

</body>
</html>

