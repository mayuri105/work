<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Appointment</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('appointment/addappointment') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
						<div class="panel-body ">
							<div class="well">
								<form action="<?=  site_url('appointment'); ?>" method="get" name="filter">
									<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Customer Name</label>
											<input type="text" name="customer" value="<?php echo $customer ?>" placeholder="Customer Name" id="input-name" class="form-control" autocomplete="off">
											
										</div>
										
									</div>
									
									<div class="col-sm-4">
										
										<div class="form-group">
											<label class="control-label" for="input-approved">Appointment Status</label>
											<select class="form-control" name="appointment_status">
												<option value="">None</option>
												<?php foreach ($appstatus as $a ): ?>
													<option value="<?php echo $a->aps_id ?>" <?php echo $a->aps_id == $appointment_status ? 'selected' :'' ?> ><?php echo $a->appointment_status ?></option>

												<?php endforeach ?>
											</select>
										</div>
										
									</div>
									
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-date-added">Appointment date</label>
											<div class="input-group date">
												
												<input type="text" name="date_added" value="<?= $date_added =='01-01-1970' ? '' :$date_added ?>" placeholder="Date Added"  id="input-date-added" class="form-control">
												<span class="input-group-btn">
											  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
											  </span></div>
										</div>
										
										<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
									</div>
									</div>
								</form>
							</div>
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Customer Name</th>
										<th>Property Name</th>
										<th>Appointment Date</th>
										<th>Appointment Time</th>
										<th>Appointment Status</th>
										<th>Appointment Type</th>
										
										<th class="text-right"> Action</th>
										
									</tr>
								</thead>
								<tbody id="tbody">
									<?php if ($appointment): ?>
									<?php foreach ($appointment as $s): ?>
									<tr>
										<td><input type="checkbox" value="<?= $s->appointment_id ?>" class="delete" name="delete[]"></td>
										<td><?php echo $s->first_name.' '.$s->last_name  ?></td>
										<td><?php echo $s->property_title  ?></td>
										
										<td><?php echo date('d-m-Y',strtotime($s->appointment_date))  ?></td>
										<td><?php echo date('g:i:a',strtotime($s->start_time)).'-'.date('g:i:a',strtotime($s->end_time)) ?></td>
										<td><?php echo $s->appointment_status ?></td>	
										<td><?php echo ucfirst($s->appointment_for) ?></td>	
										
										<td class="text-right"><a href="<?php echo site_url('appointment/edit/'.$s->appointment_id.'') ?>" class="btn btn-primary">Edit</a>	</td>
									
									</tr>
									<?php endforeach ?>
									<?php else: ?>
									<tr>
										<td>No appointment found</td>
									</tr>
									<?php endif ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7"></td>
										<td>
											<ul class="pagination">
												<?php echo $pagination_helper->create_links(); ?>
											</ul>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
				</div>	
			</div>
		</div>
		<!-- #page-content -->
	</div>
			   
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('#delete').click(function(event){
			
        	var dat = $('input:checkbox.delete').serialize();
        	
			alertify.confirm("Are you sure you want to Delete this Appointment ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('appointment/deletemultiple'); ?>",
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
	

</script>
</body>
</html>

