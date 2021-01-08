<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">City</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('city/addnew') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					<div class="panel-body">
						<div class="well">
								<form action="<?=  site_url('city'); ?>" method="get" name="filter">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">City Name</label>
											<input type="text" name="city" value="<?php echo $city; ?>" placeholder="City Name" id="input-name" class="form-control" autocomplete="off">
											<ul class="dropdown-menu"></ul>
										</div>
										<div class="form-group">
											<label class="control-label" for="input-email">State</label>
											<input type="text" name="state" value="<?php echo $state ?>" placeholder="State" id="input-state" class="form-control" autocomplete="off">
											<ul class="dropdown-menu"></ul>
										</div>
									</div>
									
									<div class="col-sm-4">
										
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
											<label class="control-label" for="input-ip">Zipcode</label>
											<input type="text" name="zipcode" value="<?php echo $zipcode ?>" placeholder="zipcode" id="input-zipcode" class="form-control">
										</div>
										<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
									</div>
								</div>
								</form>
						</div>
						<div class="panel-body ">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Thumb</th>
										<th>City Name</th>
										<th>State</th>
										<th>Enabled</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($citys)): foreach($citys as $city): ?>
									<tr>
										<td><input type="checkbox" value="<?= $city->city_id ?>" class="delete" name="delete[]"></td>
										<td>
											
											<?php $upload_path =  $this->config->item('show_upload_path').'/city/'; ?>
											<?php if ($city->city_image_url): ?>
											<img src="<?= $upload_path.$city->city_image_url; ?>" width="50px" height="50px">
											<?php endif ?>
										</td>
										<td><?php echo $city->city_name ?></td>
										<td><?php echo $city->name ?></td>
										<td><?php echo $city->status ? 'Enabled' : 'Disabled' ?></td>

										<td class="text-right">
											<?php $id = $city->city_id; ?>
											<a href="<?= site_url('city/edit/'.$id.'')?>" class="btn btn-primary">Edit</a>
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">City(s) not available.</td></tr>
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
        	
			alertify.confirm("Are you sure you want to Delete this City ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('city/deletemultiple'); ?>",
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


