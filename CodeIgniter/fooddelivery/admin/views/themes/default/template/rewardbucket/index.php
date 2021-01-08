<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Reward Bucket</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button data-toggle="modal" href="#myModal"  class="btn btn-primary pull-left">Add New Reward Bucket</button>
					<div class="col-md-5 pull-right">
						<div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
				            <div class="input-group">
				            	<input type="text" id="rewardbucket_search" class="form-control" placeholder="Search...">
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
										<th>Title</th>
										<th>Rewardbucket Points</th>
										<th>Thumb</th>
										
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($rewardbuckets)): foreach($rewardbuckets as $rewardbucket): ?>
									<tr>
										<td><?= $i; ?></td>
										<td><?php echo $rewardbucket->title ?></td>
										<td>
											<?php echo $rewardbucket->points_reward ?></td>
										
										<td>
											
											<?php $upload_path =  $this->config->item('show_upload_path').'/rewardbucket/'; ?>
											<?php if ($rewardbucket->image): ?>
											<img src="<?= $upload_path.$rewardbucket->image; ?>" width="50px" height="50px">
											<?php endif ?>

										</td>

										

										<td class="text-right">
											<?php $id = $rewardbucket->rb_id; ?>
											
											<button class="btn btn-primary" onclick="edit('<?php echo $id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $rewardbucket->rb_id; ?>" >Edit</button>
											<a herf ="" data-href ="<?php echo site_url('rewardbucket/delete/'.$id.'') ?>" class="del btn btn-danger"  >Delete</a>
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">Reward Bucket(s) not available.</td></tr>
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
			url : "<?php echo site_url('rewardbucket/getRewardbucket') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){

				$('#rb_id').val(data.rb_id);
				$('#title').val(data.title);
				$('#points_reward').val(data.points_reward);
				$('#credits').val(data.credits);
				$('#description').val(data.description);
				
			}
		});
		
	}
	$(document).ready(function(){
		$('.del').click(function(event){
			var url = $(this).data("href")

        	var $tr = $(this).closest('tr');
			alertify.confirm("Are you sure you want to Delete this rewardbucket ?", function (result) {
			    if (result) {
					$.ajax({
						url : url,
						type: "GET",
						success:function(data){
							alertify.success('Deleted');
							 $tr.find('td').fadeOut(1000,function(){ 
	                            $tr.remove();                    
	                        }); 
						}
					});
       
			    } else {
			      
			    }
			});
		});
		$('#setperpage').change(function(){
			var data = {
				p_value : $(this).val()
			};
			$.ajax({
				url : "<?php echo site_url('rewardbucket/setperpage') ?>",
				type: "POST",
				data:data,
				success:function(data){
					window.location.reload();
				}
			});
		});

		$('#rewardbucket_search').keyup(function() {

		s = $('#rewardbucket_search').val();
		setTimeout(function() { 
		        if($('#rewardbucket_search').val() == s){ // Check the value searched is the latest one or not. This will help in making the ajax call work when client stops writing.
		            $.ajax({
		                type: "POST",
		                url: "<?php echo site_url('rewardbucket/search') ?>",
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
					<h2 class="modal-title">Add Reward bucket</h2>
				</div>
				<form name="adduser" action="<?php echo site_url('rewardbucket/add') ?>" method="post" enctype="multipart/form-data">
			
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Title</label>
						<div class="col-sm-8">
							<input type="text" name="title" value="<?= set_value('title') ?>" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Points reward</label>
						<div class="col-sm-8">
							<input type="number" name="points_reward" value="<?= set_value('points_reward') ?>" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Credit</label>
						<div class="col-sm-8">
							<input type="number" name="credits" value="<?= set_value('credits') ?>" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Image Upload </label>
						<div class="col-sm-8">
							<input type="file" name="fileinput" class="form-control">
						</div>
						
					</div>

					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Description</label>
						<div class="col-sm-8">
							<textarea  name="description" class="form-control"></textarea>
						</div>
						
					</div>
					<div class="pb"></div> 
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
					<h2 class="modal-title">Update Rewardbucket</h2>
				</div>
				<form name="updateRewardbucket" action="<?php echo site_url('rewardbucket/update') ?>" method="post" enctype="multipart/form-data">
			
				<div class="modal-body"	>
					
					<input type="hidden" name="rb_id" id="rb_id" value=""class="form-control">
					<div class="form-group">
						<label class="col-sm-4 control-label">Title</label>
						<div class="col-sm-8">
							<input type="text" name="title" id="title" value="<?= set_value('title') ?>" class="form-control">
						</div>
					</div>
					
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Points reward</label>
						<div class="col-sm-8">
							<input type="number" name="points_reward" id="points_reward" value="<?= set_value('points_reward') ?>" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Credit</label>
						<div class="col-sm-8">
							<input type="number" name="credits" id="credits" value="<?= set_value('credits') ?>" class="form-control">
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
						<label class="col-sm-4 control-label">Description</label>
						<div class="col-sm-8">
							<textarea  name="description" id="description" class="form-control"></textarea>
						</div>
						
					</div>
					<div class="pb"></div> 
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update changes</button>
				</div>
				</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
