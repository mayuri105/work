<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Ads Package</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<button data-toggle="modal" href="#myModal"  class="btn btn-primary  pull-right ml"><i class="fa fa-plus"></i>Add</button>
					
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					
						<div class="panel-body ">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Package name</th>
										<th>Price</th>
										<th>Periods(in month)</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php foreach ($adspackage as $ap ): ?>
									<tr>
									<td><input type="checkbox" value="<?= $ap->asp_id ?>" class="delete" name="delete[]"></td>
									<td><?= $ap->package_name ?></td>
									<td>$<?= $ap->package_price ?></td>
									<td><?= $ap->package_periods ?></td>
									<td class="text-right">
										<button class="btn btn-primary" onclick="edit('<?php echo $ap->asp_id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $ap->asp_id; ?>" >Edit</button>
									</td>
									</tr>
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr>
										<td>
										</td>
										<td colspan="2"></td>
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
	function edit(ids){
		
		var data = {
			id : ids
		};
		$.ajax({
			url : "<?php echo site_url('adspackage/getpackage') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){

				$('#asp_id').val(data.asp_id);
				$('#package_name').val(data.package_name);
				$('#package_periods').val(data.package_periods);
				$('#package_price').val(data.package_price);
				
			}
		});
		
	}
	$(document).ready(function(){
		
		$('#delete').click(function(event){
			
        	var packages = $('input:checkbox.delete').serialize();
        	
			alertify.confirm("Are you sure you want to Delete this Package ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('adspackage/deletemultiple'); ?>",
						type: "post",
						data:packages,
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Add Ads Package</h2>
				</div>
				<form name="adduser" action="<?php echo site_url('adspackage/add') ?>" method="post">
			
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Package Name</label>
						<div class="col-sm-8">
							<input type="text" name="package_name" value="" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Package Price</label>
						<div class="col-sm-8">
							<input type="number" name="package_price" value="" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					
					<div class="form-group">
						<label class="col-sm-4 control-label">Package Periods</label>
						<div class="col-sm-8">
							<input type="number" name="package_periods" value="" class="form-control">
						</div>
					</div>
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
				</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Update Ads Package</h2>
				</div>
				<form name="updatecategory" action="<?php echo site_url('adspackage/update') ?>" method="post" enctype="multipart/form-data">
			
				<div class="modal-body"	>
					
					<input type="hidden" name="asp_id" id="asp_id" value=""class="form-control">
					
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Package Name</label>
						<div class="col-sm-8">
							<input type="text" name="package_name" id="package_name" value="" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Package Price</label>
						<div class="col-sm-8">
							<input type="number" name="package_price" id="package_price" value="" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					
					<div class="form-group">
						<label class="col-sm-4 control-label">Package Periods</label>
						<div class="col-sm-8">
							<input type="number" name="package_periods" id="package_periods" value="" class="form-control">
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
