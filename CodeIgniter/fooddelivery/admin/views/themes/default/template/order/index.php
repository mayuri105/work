<?php echo Modules::run('header/header/index'); ?>
<?php echo  Modules::run('sidebar/sidebar/index')  ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php echo site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('orders') ?>">Order</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?php echo  site_url('orders/add') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h3>Recent Orders</h3>
				<div class="panel panel-inverse">

					
						<div class="panel-body ">
							<div class="well">
								<form action="<?=  site_url('orders'); ?>" method="get" name="filter">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Order Id</label>
											<input type="text" name="order_id" value="" placeholder="Order Id" id="input-order_id" class="form-control" autocomplete="off">
											
										</div>
										<div class="form-group">
											<label class="control-label" for="input-ip">Customer</label>
											<input type="tel" name="customer" value="<?php echo $customer ?>" placeholder="customer" id="input-customer" class="form-control">
										</div>
									</div>
									
									<div class="col-sm-4">
										
										<div class="form-group">
											<label class="control-label" for="input-email">CV - Status </label>
											
											<select name="cv_status" id="input-cv_status" class="form-control">
												<option value=""></option>
												<?php foreach ($order_status as $key ): ?>
													<option value="<?= $key->name ?>" <?= $cv_status == $key->name ? 'selected' :'' ?>><?= $key->name ?></option>
												<?php endforeach ?>
											</select>
											
										</div>
										<div class="form-group">
											<label class="control-label" for="input-approved">Payment Type</label>
											<select name="payment_type" id="input-payment_type" class="form-control">
												<option value=""></option>
												<option value="cash" <?= $payment_type == 'cash' ? 'selected' :'' ?>>Cash</option>
												<option value="paypal" <?= $payment_type == 'paypal' ? 'selected' :'' ?>>Paypal</option>
												<option value="credit-others" <?= $payment_type == 'credit-others' ? 'selected' :'' ?>>Credit-Others</option>
											</select>
										</div>
										
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-ip">Total Amt</label>
											<input type="text" name="totalamt" value="<?php echo $totalamt ?>" placeholder="Total Amt" id="input-totalamt" class="form-control">
										</div>
										<div class="form-group">
											<label class="control-label" for="input-date-added">Date Added</label>
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
										<td>#</td>
										<th>ID</th>
										<th>Customer</th>
										<th>Order Status</th>
										<th>Total Amt</th>
										<th>Payment Type</th>
										<th>Date</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($orders)): foreach($orders as $order): ?>
									<tr>
										<td><input type="checkbox" value="<?= $order->o_id ?>" class="delete" name="delete[]"></td>
										<td><?= $order->o_id; ?></td>
										<td><?php echo $order->first_name.' '.$order->last_name ?></td>
										<td><?php echo $order->name ?></td>
										<td><?php echo $order->total_amt ?></td>
										<td><?php echo str_replace('paying-',' ', $order->payment_method) ?></td>
										<td><?php echo date('d-m-y',strtotime($order->created_on)) ?></td>
										<td class="text-right">
											<?php $id = $order->o_id; ?>
											<a href="<?php echo site_url('orders/view/'.$id.'') ?>" class="btn btn-primary">View Order</a>
											<a href ="<?php echo site_url('orders/edit/'.$id.'') ?>" class="btn btn-primary">Edit</a>
											
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="7">Order(s) not available.</td></tr>
									<?php endif; ?>
									
								</tbody>
								<tfoot>
									<tr>
										<td>
										
										</td>
										<td colspan="6"></td>
										<td >
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
        	
			alertify.confirm("Are you sure you want to Delete this Orders ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('orders/deletemultiple'); ?>",
						type: "post",
						data:users,
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
