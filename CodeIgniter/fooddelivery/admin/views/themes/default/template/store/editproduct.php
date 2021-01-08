<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css" rel="stylesheet"> 
<?php echo $this->session->userdata('is_admin') ?  Modules::run('sidebar/sidebar/index') : Modules::run('sidebar/sidebar/merchant')  ?>

<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('store'); ?>">Product</a></li>
				<li class="active"><a href="">Edit Product</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2>Edit Product</h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<form  method="post" action="<?= site_url('store/updateproduct') ?>" id="form-product" class="form-horizontal">
				<input type="submit" class="btn btn-primary" value="Save">
					<div class="pb"></div>	
					<input type="hidden" value="<?= $product->product_id; ?>" name="product_id">
					<div class="panel panel-inverse">
						
						<div class="panel-body ">
							
							<ul class="nav nav-pills" id="option">
		                        <li class="active"><a href="#tab-general" data-toggle="tab" aria-expanded="true">General</a></li>
		                        <li><a href="#tab-optionvalue" data-toggle="tab" aria-expanded="true">Option Value</a></li>
		                        <li class="">
		                        	<a href="#tab-optiongroup" data-toggle="tab" aria-expanded="true">Option Groups</a>
		                        </li>
		                        
		                    </ul>
							<div class="tab-content">
						        <div class="tab-pane active" id="tab-general">
						            <div class="row">
						                
						                <div class="col-sm-12">
						                    <div class="tab-content">
						                        <div class="tab-pane active" id="tab-products">
						                           <div class="pb"></div>
						                              
													<div class="form-group">
														<input type="hidden" id="cat_id" name="category_id" value="">
														<label class="col-sm-3 control-label">Product Name <span class="required">*</span></label>
														<div class="col-sm-8">
															<input type="text" name="product_name" value="<?= $product->product_name; ?>"  id="product_name" value="" class="form-control" required>
														</div>
													</div>
													
													<div class="form-group ">
														<label class="col-sm-3 control-label">Product Status <span class="required">*</span></label>
														<div class="col-sm-8">
															<select name="status"  id="status" class="form-control" required> 
																<option value="">None</option>
																<option value="1" <?= $product->status ? 'selected' :'' ; ?>>Available</option>
																<option value="0" <?= $product->status ? '' :'selected' ; ?>>Not Available</option>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														
														<label class="col-sm-3 control-label">Product price <span class="required">*</span></label>
														<div class="col-sm-8">
															<input type="text" name="price" value="<?= $product->price; ?>"  id="price" value="" class="form-control" required>
														</div>
													</div>
													<div class="form-group">
														
														<label class="col-sm-3 control-label">Discount(in %)</label>
														<div class="col-sm-8">
															<input type="number" max="100" name="discount" value="<?= $product->discount !='0.00' ? $product->discount : ''; ?>"  id="pro_discount"  class="form-control" >
														</div>
													</div>
													
													
													<div class="form-group">
														<label class="col-sm-3 control-label">Discount Date </label>
														<div class="col-sm-8">
															<div class="input-daterange input-group" id="datepicker">
																<input type="text" class="form-control" value="<?= $product->start_time != '1970-01-01'  ? $product->start_time :''; ?>" name="start_time">
																<span class="input-group-addon">to</span>
																<input type="text" class="form-control" value="<?= $product->end_time != '1970-01-01' ? $product->end_time :''  ?>" name="end_time">
															</div>
														</div>

													</div>
													

						                        </div>
						                    </div>
						                </div>
						            </div>

						        </div>
							    <div class="tab-pane" id="tab-optiongroup">
							    	<div class="pb"></div>
							    	<?php foreach ($optiongroup as $opt): ?>
							    	<ul class="list-group">
							    		<li class="list-group-item"><?= $opt->option_name ?>
							    			
											<a herf ="" data-href ="<?php echo site_url('store/deleteoptiongroup/'.$opt->option_id.'') ?>" class="del btn btn-danger ml mb-xs   pull-right"  ><i class="fa fa-trash"></i></a>

											<a class="ml mb-xs btn btn-primary pull-right" onclick="edit('<?php echo $opt->option_id; ?>')" data-toggle="modal" href="#myModaleditgroup"  class=""><i class="fa fa-edit"></i></a>
											<br/>
							    		</li>
									</ul>
							    	<?php endforeach ?>
							    	<button type="button" class="btn btn-primary pull-right" data-toggle="modal" href="#myModal" >Add Option Group</button>
							    </div> 
							    <div class="tab-pane" id="tab-optionvalue">
							    	<div class="pb"></div>
							    	<ul  class="list-group" >
							    	<?php foreach ($optiongroup as $opt): ?>
							    		<li class="list-group-item">
							    			<?= $opt->option_name ?>
							    			<?php $option = $this->store->product_optionvalue($opt->option_id); ?>
							    			<a  onclick="addgroupoptionValue('<?php echo $opt->option_id; ?>')" data-toggle="modal" href="#mymodeladdgroup"  class="pull-right btn btn-primary" >Add </a>
							    			<br>
								    		<?php if (!$option): ?>
								    		<table id="productGrouptable" class="table table-bordered m" cellspacing="0">
								    		 
								    		 <th>No Option value found</th>

								    		</table>
								    		<?php else: ?>
								    		<table id="productGrouptable" class="table table-bordered m" cellspacing="0">
												<thead>
													<th>Option Value</th>
													<th>Price</th>	
													<th>Action</th>
												</thead>
												<tbody>
												<?php

												
												 foreach ($option as $pg): ?>
												<tr>
													<td>
														<?= $pg->option_value ?>
													</td>
													<td>
														<?= $pg->price ?>
													</td>
													<td>
														<a class="btn btn-primary" onclick="editoption('<?php echo $pg->po_id; ?>')" data-toggle="modal" href="#myModaleditop"  class="btn btn-primary">Edit</a>
														<a herf ="" data-href ="<?php echo site_url('store/deleteoption/'.$pg->po_id.'') ?>" class="del btn btn-danger"  >Delete</a>
													</td>

												</tr>
												<?php endforeach ?>
											</tbody>
											</table>
											<?php endif; ?>
										</li>
							    	<?php endforeach ?>
							    	</ul>

							    </div>

							</div>
							

						</div>	
					</div>
				</form>	
			</div>
		</div>
		
		<!-- #page-content -->
	</div>
			   
<?php echo Modules::run('footer/footer/index'); ?>

<script type="text/javascript">
$('#form-product').validate({
	errorClass: "help-block",
	validClass: "help-block",
	highlight: function(element, errorClass,validClass) {
	  $(element).closest('.form-group').addClass("has-error");
	},
	unhighlight: function(element, errorClass,validClass) {
	   $(element).closest('.form-group').removeClass("has-error");
	},
	
});
function edit(ids){
		var data = {
			id : ids
		};
		$.ajax({
			url : "<?php echo site_url('store/getoptiondata') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){

				$('#option_id').val(data.option_id);
				$('#option_name').val(data.option_name);
				if (data.required==1) {
					$('#required').attr('checked', 'checked');
				};
				if (data.multiple==1) {
					$('#multiple').attr('checked', 'checked');

				};
			}
		});
}
function editoption(ids){
		var data = {
			id : ids
		};
		$.ajax({
			url : "<?php echo site_url('store/getoptiondataofgroup') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){

				$('#po_id').val(data.po_id);
				$('#option_value').val(data.option_value);
				$('#option_group_id').val(data.option_group_id);
				$('#optprice').val(data.price);
				
			}
		});
}
function addgroupoptionValue(id){
	$('#groupid').val(id)
}
$('.del').click(function(event){
			var url = $(this).data("href")
        	var $tr = $(this).closest('tr');
			alertify.confirm("Are you sure you want to Delete ?", function (result) {
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

</script>


<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-validation/jquery.validate.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.min.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<div class="modal fade" id="mymodeladdgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Add Group Option</h2>
				</div>
				<form name="addgroupoption" action="<?php echo site_url('store/addgroupoption') ?>" method="post" >
				<input type="hidden" name="option_group_id" id="groupid"  value="" class="form-control">
				<input type="hidden" name="product_id" value="<?= $product->product_id ?>" class="form-control">
				
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Option value</label>
						<div class="col-sm-8">
							<input type="text" name="option_value" value="" class="form-control">
						</div>
					</div>
					
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Price</label>
						<div class="col-sm-8">
							<input type="text" name="price"  value="" class="form-control">
						</div>
						
					</div>
					<div class="pb"></div> 
					<!-- <div class="form-group">
						<label class="col-sm-4 control-label">Option Group Name</label>
						<div class="col-sm-8">
							<select  class="form-control" name="option_group_id">
								<?php if ($optiongroup): ?>
								<?php foreach ($optiongroup as $opt): ?>
									<option value="<?= $opt->option_id ?>"><?= $opt->option_name ?></option>
								<?php endforeach ?>
								<?php endif ?>
							</select>
						</div>
						
					</div> -->
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


<!-- add groups -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Add Product Option </h2>
				</div>
				<form name="adduser" action="<?php echo site_url('store/addgroup') ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="product_id"  value="<?= $product->product_id; ?>"class="form-control">
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Option Name</label>
						<div class="col-sm-8">
							<input type="text" name="option_name"  class="form-control">
						</div>
					</div>
					
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Is Required</label>
						<div class="col-sm-8">
							<input type="checkbox"  class="form-control"  name="required" value="1" checked>
						</div>
						
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Choose Multiple</label>
						<div class="col-sm-8">
							<input type="checkbox"  class="form-control"  name="multiple"  value="1" checked>
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

<!-- update group name -->
<div class="modal fade" id="myModaleditgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Edit Option Group</h2>
				</div>
				<form name="adduser" action="<?php echo site_url('store/updategroup') ?>" method="post" >
				<input type="hidden" name="option_id" id="option_id"  value=""class="form-control">
				<input type="hidden" name="product_id" id="product_id"  value="<?= $product->product_id ?>" class="form-control">
				
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Option Name</label>
						<div class="col-sm-8">
							<input type="text" name="option_name" id="option_name" value="" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					
					<div class="form-group">
						<label class="col-sm-4 control-label">Is Required</label>
						<div class="col-sm-8">
							<input type="checkbox"  class="form-control"  name="required" id="required" value="1" >
						</div>
						
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Choose Multiple</label>
						<div class="col-sm-8">
							<input type="checkbox"  class="form-control"  name="multiple" id="multiple" value="1" >
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
<!-- edit product option value -->
<div class="modal fade" id="myModaleditop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Edit Product Option</h2>
				</div>
				<form name="updateoption" action="<?php echo site_url('store/updateoption') ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="po_id" id="po_id"  value=""class="form-control">
				<input type="hidden" name="product_id" id="product_id"  value="<?= $product->product_id ?>" class="form-control">
				
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Option value</label>
						<div class="col-sm-8">
							<input type="text" name="option_value" id="option_value" value="" class="form-control">
						</div>
					</div>
					
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Price</label>
						<div class="col-sm-8">
							<input type="text" name="price" id="optprice" value="" class="form-control">
						</div>
						
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Option Group Name</label>
						<div class="col-sm-8">
							<select  class="form-control" name="option_group_id" id="option_group_id" >
								<?php if ($optiongroup): ?>
								<?php foreach ($optiongroup as $opt): ?>
									<option value="<?= $opt->option_id ?>"><?= $opt->option_name ?></option>
								<?php endforeach ?>
								<?php endif ?>
							</select>
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


</body>
</html>
