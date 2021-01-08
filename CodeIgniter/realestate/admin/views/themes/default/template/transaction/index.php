<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Transaction</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('transaction/addtransaction') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
						<div class="panel-body ">
							<div class="well">
								<form action="<?=  site_url('transaction'); ?>" method="get" name="filter">
								<div class="row">
									
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Customer Name</label>
											<input type="text" name="customer" value="<?php echo $customer; ?>" placeholder="Customer Name" id="input-name" class="form-control" autocomplete="off">
											<ul class="dropdown-menu"></ul>
										</div>
										
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Transaction Type</label>
											<select class="form-control" name="transaction_type">
												<option value="">None</option>
												<option value="rent" <?php echo $transaction_type=='rent' ? 'selected' : '' ; ?>>Rent</option>
												<option value="purchase" <?php echo $transaction_type=='purchase' ? 'selected' : '' ; ?>>Purchase</option>
											 </select>
										</div>
										
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Transaction date</label>
											<input type="text" name="transaction_date" value="<?php echo $transaction_date; ?>" placeholder="Transaction date" id="input-name" class="form-control date" autocomplete="off">
											<ul class="dropdown-menu"></ul>
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
										<th>Customer</th>
										<th>Transaction type</th>
										<th>Transaction date</th>
										<th class="text-right"> Action</th>
										
									</tr>
								</thead>
								<tbody id="tbody">
									<?php if ($transaction): ?>
									<?php foreach ($transaction as $s): ?>
									<tr>
										<td><input type="checkbox" value="<?= $s->transaction_id ?>" class="delete" name="delete[]"></td>
										<td><?php echo $s->first_name.' '.$s->last_name ?></td>
										<td><?php echo $s->transaction_type ?></td>
										<td><?php echo date('d-m-Y',strtotime($s->transaction_date)) ?></td>
										
										<td class="text-right"><a href="<?php echo site_url('transaction/edit/'.$s->transaction_id.'') ?>" class="btn btn-primary">Edit</a>	</td>
									</tr>
									<?php endforeach ?>
									<?php else: ?>
									<tr>
										<td>No transaction found</td>
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
        	
			alertify.confirm("Are you sure you want to Delete this Transaction ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('transaction/deletemultiple'); ?>",
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

