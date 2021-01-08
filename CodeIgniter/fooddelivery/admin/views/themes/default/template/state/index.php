<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">State</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<button data-toggle="modal" href="#myModal"  class="btn btn-primary  pull-right ml"><i class="fa fa-plus"></i>Add</button>
					<div class="col-md-5 pull-right">
						<div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
				            <div class="input-group">
				            	<input type="text" id="state_search" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
				            		<button class="btn" type="button"><i class="ti ti-search"></i></button>
				            	</span>
							</div>
			        	</div>
			    	</div>
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
										<th>State name</th>
										<th>Code</th>
										<th>Enabled</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($states)): foreach($states as $st): ?>
									<tr>
										<td><input type="checkbox" value="<?= $st->id ?>" class="delete" name="delete[]"></td>
										<td><?php echo $st->name ?></td>
										<td><?php echo $st->code  ?></td>
										<td><?php echo $st->status ? 'Enabled' :'Disabled'  ?></td>

										<td class="text-right">
											<?php $id = $st->id; ?>
											
											<button class="btn btn-primary" onclick="edit('<?php echo $id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $st->id; ?>" >Edit</button>
											
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">State(s) not available.</td></tr>
									<?php endif; ?>
									
								</tbody>
								<tfoot>
									<tr>
										<td>
											
											

										</td>
										<td colspan="3"></td>
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
			url : "<?php echo site_url('state/getstate') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){

				$('#id').val(data.id);
				$('#name').val(data.name);
				$('#status').val(data.status);
				$('#code').val(data.code);
				
				
			}
		});
		
	}
	$(document).ready(function(){
		
		$('#delete').click(function(event){
			
        	var users = $('input:checkbox.delete').serialize();
        	
			alertify.confirm("Are you sure you want to Delete this City ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('state/deletemultiple'); ?>",
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

		

		$('#state_search').keyup(function() {
		s = $('#state_search').val();
		setTimeout(function() { 
		        if($('#state_search').val() == s){ // Check the value searched is the latest one or not. This will help in making the ajax call work when client stops writing.
		            $.ajax({
		                type: "POST",
		                url: "<?php echo site_url('state/search') ?>",
		                data: 'search=' + s,
		                cache: false,
		                beforeSend: function() {
		                   // loading image
		                },
		                success: function(data) {
		                	//console.log(data);
		                    // Your response will come here
		                    $('#tbody').html(data);
		                }
		            })
		        }
		    }, 1000); // 1 sec delay to check.
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
					<h2 class="modal-title">Add state</h2>
				</div>
				<form name="addstate" id="addstate"  class="form-horizontal" action="<?php echo site_url('state/add') ?>" method="post">
			
				<div class="modal-body"	>
					<div class=""></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">State Name</label>
						<div class="col-sm-8">
							<input type="text" name="state" value="<?= set_value('state') ?>" class="form-control" required>
						</div>
					</div>
					<div class=""></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Code</label>
						<div class="col-sm-8">
								<input type="text" name="code" maxlength="2" value="<?= set_value('code') ?>" class="form-control" required>
						</div>
						
					</div>

					<div class=""></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Status</label>
						<div class="col-sm-8">
							<select name="status"   class="form-control" required> 
								<option value="">None</option>
								<option value="1">Enabled</option>
								<option value="0">Disabled</option>
							</select>
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
					<h2 class="modal-title">Update state</h2>
				</div>
				<form name="updatestate" id="updatestate" class="form-horizontal" action="<?php echo site_url('state/update') ?>" method="post" enctype="multipart/form-data">
			
				<div class="modal-body"	>
					<div class=""></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">State Name</label>
						<div class="col-sm-8">
							<input type="hidden" name="id" id="id" value="" class="form-control" required>
							<input type="text" name="name" id="name" value="" class="form-control" required>
						</div>
					</div>
					<div class=""></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Code</label>
						<div class="col-sm-8">
								<input type="text" name="code" maxlength="2" id="code" class="form-control" required>
						</div>
						
					</div>

					<div class=""></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Status</label>
						<div class="col-sm-8">
							<select name="status" id="status"   class="form-control" required> 
								<option value="1">Enabled</option>
								<option value="0">Disabled</option>
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
	$('#addstate').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		
	});
	$('#updatestate').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		
	});
</script>
</body>
</html>