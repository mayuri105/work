<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Property</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('property/addproperty') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
						<div class="panel-body ">
							<div class="well">
								<form action="<?=  site_url('property'); ?>" method="get" name="filter">
								<div class="row">
									
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Property Title</label>
											<input type="text" name="property" value="<?php echo $propertys; ?>" placeholder="Property Name" id="input-name" class="form-control" autocomplete="off">
											
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Property Status</label>
											<select class="form-control" name="status">
												<option value="">None</option>
												<option value="rented" <?php echo $status == 'rented' ? 'selected' : '' ?>>Rented</option>
												<option value="sold" <?php echo $status == 'sold' ? 'selected' : '' ?>>Sold</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Property Type</label>
												
												<select class="form-control" name="property_type" > 
													<option value="">None</option>
													<?php foreach ($types as $t): ?>
														<option value="<?php echo $t->cat_id ?>"  <?php echo $property_type == $t->cat_id ? 'selected' :''  ?>><?php echo $t->category ?></option>
													<?php endforeach ?>
												</select>
										</div>
										<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Property Action</label>
											<select class="form-control" name="property_action">
												<option value="">None</option>
												<option value="rent"  <?php echo $property_action == 'rent' ? 'selected' : '' ?>>Rent</option>
												<option value="sale"  <?php echo $property_action == 'sale' ? 'selected' : '' ?>> Sale</option>
												<option value="investments"  <?php echo $property_action == 'investments' ? 'selected' : '' ?>> Investments</option>
												
											</select>
										</div>

										
									</div>
									
									
								</div>
								</form>
							</div>
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Property</th>
										<th>Property Type</th>
										<th>Property Action</th>
										<th>Approved</th>
										<th class="text-right"> Action</th>
										
									</tr>
								</thead>
								<tbody id="tbody">
									<?php if ($property): ?>
									<?php foreach ($property as $s): ?>
									<tr>
										<td><input type="checkbox" value="<?= $s->property_id ?>" class="delete" name="delete[]"></td>
										
										<td><?php echo $s->property_title ?></td>
										<td><?php echo ucfirst($s->category) ?></td>
										<td><?php echo ucfirst($s->property_action) ?></td>
										<td><?php echo $s->approved ? 'Yes' : 'No'?></td>
										<td class="text-right">
											<a href="#" data-id="<?php echo $s->property_id ?>"  class="approved btn btn-primary"><?php echo !$s->approved ? 'Enable' : 'Disable'?></a>
											<a href="<?php echo site_url('property/edit/'.$s->property_id.'') ?>" class="btn btn-primary">Edit</a>	</td>
									</tr>
									<?php endforeach ?>
									<?php else: ?>
									<tr>
										<td>No property found</td>
									</tr>
									<?php endif ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="5"></td>
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
		<!-- #page-content -->
	</div>
			   
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('#delete').click(function(event){
        	var dat = $('input:checkbox.delete').serialize();
			alertify.confirm("Are you sure you want to Delete this Property ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('property/deletemultiple'); ?>",
						type: "post",
						data:dat+'&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>',
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
				url :" <?= site_url('property/aprvdisapprove'); ?>",
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

