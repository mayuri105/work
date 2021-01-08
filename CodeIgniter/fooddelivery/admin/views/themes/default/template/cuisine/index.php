<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Cuisine</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a data-toggle="modal" href="#myModal" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
					<div class="col-md-5 pull-right">
						<div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
				            <div class="input-group">
				            	<input type="text" id="cuisine_search" class="form-control" placeholder="Search...">
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
					<div class="panel-heading"></div>
						<div class="panel-body no-padding">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Thumb</th>
										
										<th>Cuisine Type</th>
										<th>Enabled</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($cuisines)): foreach($cuisines as $cuisine): ?>
									<tr>
										<td><input type="checkbox" value="<?= $cuisine->cu_id ?>" class="delete" name="delete[]"></td>
										
										<td>
											
											<?php $upload_path =  $this->config->item('show_upload_path').'/cuisine/'; ?>
											<?php if ($cuisine->cuisine_image_url): ?>
												<img src="<?= $upload_path.$cuisine->cuisine_image_url; ?>" width="50px" height="50px">

											<?php endif ?>
											
										</td>

										<td><?php echo $cuisine->cusine_type ?></td>
										
										<td><?php echo $cuisine->status ? 'Enabled' : 'Disabled' ?></td>
										<td class="text-right">
											<?php $id = $cuisine->cu_id; ?>
											<button class="btn btn-primary" onclick="edit('<?php echo $id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $cuisine->cu_id; ?>" >Edit</button>
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">cuisine(s) not available.</td></tr>
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
			url : "<?php echo site_url('cuisine/getcuisine') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){

				$('#cu_id').val(data.cu_id);
				$('#cusine_type').val(data.cusine_type);
				$('#status').val(data.status);
				if (data.featured_on) {
					$( "#featured_on" ).prop( "checked", true );
				} else{
					$( "#featured_on" ).prop( "checked", false );
				};
				
 
			}
		});
		
	}
	$(document).ready(function(){
		$('#delete').click(function(event){
		var cuisine = $('input:checkbox.delete').serialize();
		
		alertify.confirm("Are you sure you want to Delete this City ?", function (result) {
		    if (result) {
				$.ajax({
					url :" <?= site_url('cuisine/deletemultiple'); ?>",
					type: "post",
					data:cuisine,
					success:function(data){
						window.location.reload();
					}
				});

		    } else {
		       //alert();
		    }
		});
	});

	
		$('#setperpage').change(function(){
			var data = {
				p_value : $(this).val()
			};
			$.ajax({
				url : "<?php echo site_url('cuisine/setperpage') ?>",
				type: "POST",
				data:data,
				success:function(data){
					window.location.reload();
				}
			});
		});

		$('#cuisine_search').keyup(function() {
		s = $('#cuisine_search').val();
		setTimeout(function() { 
		        if($('#cuisine_search').val() == s){ // Check the value searched is the latest one or not. This will help in making the ajax call work when client stops writing.
		            $.ajax({
		                type: "POST",
		                url: "<?php echo site_url('cuisine/search') ?>",
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
					<h2 class="modal-title">Add cuisine</h2>
				</div>
				<form name="adduser" action="<?php echo site_url('cuisine/add') ?>" method="post" enctype="multipart/form-data">
			
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Cuisine Type</label>
						<div class="col-sm-8">
							<input type="text" name="cuisine_type" value="<?= set_value('cuisine_type') ?>" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					
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
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Status</label>
						<div class="col-sm-8">
							<select name="status" class="form-control">
								<option value="">None</option>
								<option value="1">Enabled</option>
								<option value="0">Disabled</option>
								
							</select>
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Feature on home page </label>
						<div class="col-sm-8">
							<input type="checkbox" name="featured_on"  value="1">
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
					<h2 class="modal-title">Update Cuisine</h2>
				</div>
				<form name="updatecuisine" action="<?php echo site_url('cuisine/update') ?>" method="post" enctype="multipart/form-data">
			
				<div class="modal-body"	>
					
					<input type="hidden" name="cu_id" id="cu_id" value=""class="form-control">
					
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Cuisine Type</label>
						<div class="col-sm-8">
							<input type="text" name="cusine_type" id="cusine_type" value="<?= set_value('cusine_type') ?>" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Change image Upload </label>
						<div class="col-sm-8">
							<input type="file" name="fileinput" class="form-contorl">
						</div>
						
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Change Banner Upload </label>
						<div class="col-sm-8">
							<input type="file" name="fileinput2" class="form-contorl">
						</div>
						
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Status</label>
						<div class="col-sm-8">
							<select name="status" id="status"class="form-control">
								<option value="">None</option>
								<option value="1">Enabled</option>
								<option value="0">Disabled</option>
								
							</select>
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Feature on home page </label>
						<div class="col-sm-8">
							<input type="checkbox" id="featured_on" name="featured_on"  value="1">
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
