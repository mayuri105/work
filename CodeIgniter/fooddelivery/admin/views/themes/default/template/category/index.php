<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Store Category</a></li>
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
					<div class="panel-heading"></div>
						<div class="panel-body no-padding">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Category name</th>
										<th>Thumb</th>
										
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($categories)): foreach($categories as $category): ?>
									<tr>
										<td><input type="checkbox" value="<?= $category->mt_id ?>" class="delete" name="delete[]"></td>
										<td><?php echo $category->type ?></td>
										
										<td>
											
											<?php $upload_path =  $this->config->item('show_upload_path').'/category/'; ?>
											<?php if ($category->category_image_url): ?>
											<img src="<?= $upload_path.$category->category_image_url; ?>" width="50px" height="50px">
											<?php endif ?>

										</td>
										
										<td class="text-right">
											<?php $id = $category->mt_id; ?>
											
											<button class="btn btn-primary" onclick="edit('<?php echo $id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $category->mt_id; ?>" >Edit</button>
											
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">Category(s) not available.</td></tr>
									<?php endif; ?>
									
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
			url : "<?php echo site_url('category/getcategory') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){

				$('#mt_id').val(data.mt_id);
				$('#type').val(data.type);
				
				
			}
		});
		
	}
	$(document).ready(function(){
		
		$('#delete').click(function(event){
			
        	var users = $('input:checkbox.delete').serialize();
        	
			alertify.confirm("Are you sure you want to Delete this Category ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('category/deletemultiple'); ?>",
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Add category</h2>
				</div>
				<form name="adduser" action="<?php echo site_url('category/add') ?>" method="post" enctype="multipart/form-data">
			
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Category Name</label>
						<div class="col-sm-8">
							<input type="text" name="type" value="<?= set_value('type') ?>" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Image Upload </label>
						<div class="col-sm-8">
							<input type="file" name="fileinput" class="form-contorl">
						</div>
						
					</div>

					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Banner Upload </label>
						<div class="col-sm-8">
							<input type="file" name="fileinput2" class="form-contorl">
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
					<h2 class="modal-title">Update category</h2>
				</div>
				<form name="updatecategory" action="<?php echo site_url('category/update') ?>" method="post" enctype="multipart/form-data">
			
				<div class="modal-body"	>
					
					<input type="hidden" name="mt_id" id="mt_id" value=""class="form-control">
					
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">category Name</label>
						<div class="col-sm-8">
							<input type="text" name="type" id="type" value="<?= set_value('type') ?>" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					
					<div class="form-group">
						<label class="col-sm-4 control-label">Image Upload </label>
						<div class="col-sm-8">
							<input type="file" name="fileinput" class="form-contorl">
						</div>
						
					</div>
					<div class="pb"></div> 

					<div class="form-group">
						<label class="col-sm-4 control-label">Banner Upload </label>
						<div class="col-sm-8">
							<input type="file" name="fileinput2" class="form-contorl">
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
