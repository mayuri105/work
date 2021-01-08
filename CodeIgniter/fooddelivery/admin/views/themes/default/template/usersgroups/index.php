<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Users Groups</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">

					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('users_groups/addgroups') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i>Add</a>
				</div>

				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					
						<div class="panel-body no-padding">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php foreach ($users_groups as $ug ): ?>
										<tr>
											<td><input type="checkbox" class="delete" name="delete[]" value="<?= $ug->group_id; ?>"></td>
											<td><?= $ug->name ?></td>
											<td class="text-right">
												<a href="<?= site_url('users_groups/edit/'.$ug->group_id.'') ?>" class="btn btn-primary">Edit</a>
											</td>
										</tr>
									<?php endforeach ?>
									
								</tbody>
								
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
        	
			alertify.confirm("Are you sure you want to Delete this User groups ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('users_groups/deletemultiple'); ?>",
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


