<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/merchant')  ?>

<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php echo site_url('store'); ?>">Home</a></li>
				<li class="active"><a href="">Store</a></li>
				
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('store/add') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					<div class="panel-body">
						<div class="well">
							<form action="<?=  site_url('store'); ?>" method="get" name="filter">
							<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-name">Store Name</label>
									<input type="text" name="name" value="<?= $name ?>" placeholder="Store Name" id="input-name" class="form-control" autocomplete="off">
									<ul class="dropdown-menu"></ul>
								</div>
								
								<div class="form-group">
									<label class="control-label" for="input-ip">Cuisine</label>
									<input type="text" name="cuisine" value="<?= $cuisine ?>" placeholder="Cuisine" id="input-cuisine" class="form-control">
								</div>
								
							</div>
							
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label" for="input-approved">Approved</label>
									<select name="enable" id="input-approved" class="form-control">
										<option value="0"  <?= $enable =='0' ? 'selected' : '' ?>></option>
										<option value="1" <?= $enable ? 'selected' : '' ?> >Yes</option>
										<option value="2" <?= $enable == '2'? 'selected' : '' ?>>No</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label" for="input-City">City</label>
									<input type="text" name="city" value="<?php echo $city; ?>" placeholder="City" id="input-city" class="form-control">
								</div>
								
							</div>
							<div class="col-sm-4">
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
						<div class="panel-body no-padding">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Logo</th>
										<th>Store Name</th>
										<th>Phone</th>
										<th>City</th>
										<th>Status</th>
										<th>Date</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($stores)): foreach($stores as $store): ?>
									<tr>
										<td><input type="checkbox" value="<?= $store->store_id ?>" class="delete" name="delete[]"></td>
										<td>
											
											<?php $upload_path =  $this->config->item('show_upload_path').'/store/'; ?>
											<?php if ($store->store_logo): ?>
											<img src="<?= $upload_path.$store->store_logo; ?>" width="50px" height="50px">
											<?php endif ?>
										</td>
										<td><?php echo $store->store_name ?></td>
										<td><?php echo $store->store_phone ?></td>
										<td><?php echo $store->city_name; ?></td>
										
										<td><?php echo $store->status  ? 'Approved' :'Not-approved' ?></td>
										<td><?php echo date('d-m-Y',strtotime($store->created_on)) ?></td>
										<td class="text-right">
											<?php $id = $store->store_id;?>
											<a href ="<?php echo site_url('store/edit/'.$id.'') ?>" class="btn btn-primary">Edit</a>
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">Store(s) not available.</td></tr>
									<?php endif; ?>
									
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
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">

	$(document).ready(function(){
		$('#delete').click(function(event){
			
        	var users = $('input:checkbox.delete').serialize();
        	
			alertify.confirm("Are you sure you want to Delete this Stores ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('store/deletemultiple'); ?>",
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
