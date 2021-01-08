<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Customer</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('customer/addcustomer') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
						<div class="panel-body ">
							<div class="well">
								<form action="<?=  site_url('customer'); ?>" method="get" name="filter">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Customer Name</label>
											<input type="text" name="customer" value="<?php echo $customer ?>" placeholder="Customer Name" id="input-name" class="form-control" autocomplete="off">
											<ul class="dropdown-menu"></ul>
										</div>
										<div class="form-group">
											<label class="control-label" for="input-email">E-Mail</label>
											<input type="text" name="email" value="<?php echo $email ?>" placeholder="E-Mail" id="input-email" class="form-control" autocomplete="off">
											<ul class="dropdown-menu"></ul>
										</div>
									</div>
									
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-ip">Phone</label>
											<input type="tel" name="phone" value="<?php echo $phone ?>" placeholder="phone" id="input-phone" class="form-control">
										</div>
										<div class="form-group">
											<label class="control-label" for="input-approved">Enable</label>
											<select name="enable" id="input-approved" class="form-control">
												<option value="0"  <?= $enable =='0' ? 'selected' : '' ?>></option>
												<option value="1" <?= $enable ? 'selected' : '' ?> >Yes</option>
												<option value="2" <?= $enable == '2'? 'selected' : '' ?>>No</option>
											</select>
										</div>
										
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-date-added">Date Added</label>
											<div class="input-group date">
												
												<input type="text" name="date_added" value="<?= $date_added =='01-01-1970' ? '' :$date_added ?>" placeholder="Date Added"  id="input-date-added" class="form-control">
												<span class="input-group-btn">
											  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
											  </span></div>
										</div>
										<div class="form-group">
											<label class="control-label" for="input-ip">IP</label>
											<input type="text" name="ip" value="<?= $ip ?>" placeholder="IP" id="input-ip" class="form-control">
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
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Enable</th>
										<th>Date</th>
										<th>IP</th>
										<th class="text-right"> Action</th>
										
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($customers)): foreach($customers as $customer): ?>
									<tr>
										<td><input type="checkbox" value="<?= $customer->c_id ?>" class="delete" name="delete[]"></td>
										<td><?php echo $customer->first_name.' '.$customer->last_name ?></td>
										<td><?php echo $customer->email ?></td>
										<td><?php echo $customer->phone ?></td>
										<td><?php echo $customer->enabled ? 'True' : 'False' ?></td>
										<td><?php echo date('d-m-y',strtotime($customer->created_on)) ?></td>
										<td><?php echo $customer->ip ?></td>
										<td class="text-right">
											<?php $id = $customer->c_id; ?>
											<a href="<?= site_url('customer/edit/'.$id.'') ?>" class="btn btn-primary">Edit</a>
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">Customer(s) not available.</td></tr>
									<?php endif; ?>
									
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
			
        	var users = $('input:checkbox.delete').serialize();
        	
			alertify.confirm("Are you sure you want to Delete this customers ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('customer/deletemultiple'); ?>",
						type: "post",
						data:users+'&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>',
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

