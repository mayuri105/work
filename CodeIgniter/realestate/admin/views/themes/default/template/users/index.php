<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Users</a></li>
				
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">

					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('users/adduser') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"> 
						Add</i></a>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					<div class="panel-body">
						<div class="well">
							<form action="<?=  site_url('users'); ?>" method="get" name="filter">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label" for="input-name">Name</label>
										<input type="text" name="name" value="<?php echo $name; ?>" placeholder="Name" id="input-name" class="form-control" autocomplete="off">
										<ul class="dropdown-menu"></ul>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label" for="input-name">Email</label>
										<input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" id="input-name" class="form-control" autocomplete="off">
										<ul class="dropdown-menu"></ul>
									</div>
									<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
								</div>
							</div>
							</form>
						</div>
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Username</th>
										<th>Status</th>
										<th>Group</th>
										<th>Date Added</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($users)): foreach($users as $user): ?>
									<tr>
										<td><input type="checkbox" name="delete[]" class="delete"value="<?= $user->u_id; ?>"></td>
										<td><?php echo $user->username ?></td>
										<td><?php echo $user->status ? 'Enabled' :'Disabled' ?></td>
										<td><?php echo $user->name ?></td>
										<td><?php echo date('d-m-y',strtotime($user->created_on)); ?></td>
										<td class="text-right">
											<?php $id = $user->u_id; ?>
											<a href="#" data-id="<?php echo $user->u_id ?>"  class="approved btn btn-primary"><?php echo !$user->status ? 'Approved' : 'Disapproved'?></a>
											
											<a href="<?= site_url('users/edituser/'.$id.'') ?>" class="btn btn-primary" >Edit</a>
										</td>
									</tr>
									<?php $i++; endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">User(s) not available.</td></tr>
									<?php endif; ?>
									
								</tbody>
								
								<tfoot>
									<tr>
										
										<td colspan="5"></td>
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
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('#delete').click(function(event){
			
        	var users = $('input:checkbox.delete').serialize();
        	
			alertify.confirm("Are you sure you want to Delete this Users ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('users/deletemultiple'); ?>",
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
		$('.approved').click(function(event){
        	var dat =$(this).data('id');
        	
			$.ajax({
				url :" <?= site_url('users/aprvdisapprove'); ?>",
				type: "post",
				data:'id='+dat+'&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>',
				success:function(data){
					window.location.reload();
				}
			});
       
			    
		});
		
	});
	

</script>
</body>
</html>
