<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('city'); ?>">City</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2>Edit City</h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					<div class="panel-body no-padding">
						<form name="adduser" class="form-horizontal" action="<?php echo site_url('city/update') ?>" method="post" enctype="multipart/form-data">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
							<li class=""><a href="#tab-zip" data-toggle="tab">Zipcodes</a></li>
							<li class=""><a href="#tab-image" data-toggle="tab">Image</a></li>
						</ul>
						<div class="pb"></div>
					   	
						
						<div class="pb"></div> 
						<div class="tab-content">

							<div class="tab-pane active"  id="tab-general">
								<div class="modal-body"	>
								<div class="pb"></div> 
								<div class="form-group">
									<label class="col-sm-4 control-label">City Name</label>
									<div class="col-sm-8">
										<input type="text" name="city_name" value="<?= $city->city_info->city_name; ?>" class="form-control">
										<input type="hidden" name="city_id" value="<?= $city->city_info->city_id  ?>">
									</div>
								</div>
								<div class="pb"></div> 
								<div class="form-group">
									<label class="col-sm-4 control-label">State Name</label>
									<div class="col-sm-8">
										<select name="state" class="form-control">
											<option value="">None</option>
											<?php foreach ($state as $s ): ?>
												<option value="<?= $s->code; ?>" <?= $city->city_info->state == $s->code  ? 'selected' :''; ?>><?= $s->name; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Status</label>
									<div class="col-sm-8">
										<select name="status" class="form-control">
											<option value="">None</option>
											<option value="1" <?= $city->city_info->state ? 'selected' :''; ?>>Enabled</option>
											<option value="0" <?= $city->city_info->status ? '' :'selected'; ?>>Disabled</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Feature City On Home page</label>
									<div class="col-sm-8">
										<?php if ($city->city_info->feature_city): ?>
										<input type="checkbox" name="feature_city" value="1" checked>	
										<?php else: ?>
										<input type="checkbox" name="feature_city" value="1">	
										<?php endif ?>
									</div>
								</div>
							</div>
							</div>
							<div class="tab-pane" id="tab-zip">
								<div class="pb"></div> 
							<!-- here first info about first name and last name and mobile comes here from first form -->
									<table id="ziptable" class="table table-bordered m" cellspacing="0">
										<thead>
											<tr>
											<th>Zip code</th>
											<th>Enabled</th>
											<th>Action</th>
											
											</tr>
										</thead>
										<tbody>
											<?php if ($city->city_zip): ?>
											<?php foreach($city->city_zip as $zip): ?>
											<tr>
												<td>
													<?= $zip->zipcode; ?>
												</td>
												<td>
													<?= $zip->enabled ? 'Enabled' : 'Disabled'; ?>
												</td>
												<td>
													<a class="btn btn-primary" onclick="edit('<?php echo $zip->cz_id; ?>')" data-toggle="modal" href="#myModaledit"  >Edit</a>
													<a href ="javascript::" data-href ="<?php echo site_url('city/deletezips/'.$zip->cz_id.'') ?>" class="del btn btn-danger"  >Delete</a>
												</td>
											</tr>
											<?php endforeach ?>
											<?php else: ?>
											<tr><td>No zip codes Founds</td></tr>
											<?php endif ?>
											<button data-toggle="modal" href="#myModal" class="btn btn-primary m" type="button" >Add Zipcode</button>
											
									</table>

							</div>
							<div class="tab-pane" id="tab-image">
								<div class="pb"></div> 
								
								<div class="form-group">

									<label class="col-sm-3 control-label">Image Upload</label>
									<div class="col-sm-8">
										<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
											<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
												<img src="<?php echo getuploadpath().'city/'.$city->city_info->city_image_url.''?>">
											</div>
											<div>
												<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="fileinput"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">

									<label class="col-sm-3 control-label">Image Upload</label>
									<div class="col-sm-8">
										<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
											<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
												<img src="<?php echo getuploadpath().'city/'.$city->city_info->city_banner_image.''?>">
											</div>
											<div>
												<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="fileinput2"></span>
											</div>
										</div>
									</div>
								</div> 
								<div class="pb"></div> 
								
							</div>
						</div>
						<div class="modal-footer">
								<a href="<?= site_url('city') ?>" class="btn btn-default" >Close</a>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</form>
					</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script><!-- Validate Plugin -->

<script type="text/javascript">
	$("#addmorezip").click(function () {
	     $("#ziptable").each(function () {
	         var tds = '<tr>';
	         jQuery.each($('tr:last td', this), function () {
	             tds += '<td>' + $(this).html() + '</td>';
	         });
	         tds += '</tr>';
	         if ($('tbody', this).length > 0) {
	             $('tbody', this).append(tds);
	         } else {
	             $(this).append(tds);
	         }
	     });
	});
	function deleteRow(r,tblid) {
    var i = r.parentNode.parentNode.rowIndex;
    if(i==1){
    	return false;
    }else{
    	 document.getElementById(tblid).deleteRow(i);

    }
}
$('.del').click(function(event){
	var url = $(this).data("href")

	var $tr = $(this).closest('tr');
	alertify.confirm("Are you sure you want to Delete this Zipcode ?", function (result) {
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
function edit(ids){
		var data = {
			id : ids
		};
		$.ajax({
			url : "<?php echo site_url('city/getzips') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){

				$('#cz_id').val(data.cz_id);
				$('#zipcode').val(data.zipcode);
				$('#zip_status').val(data.enabled);
				
				
			}
		});
		
	}
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Add Zipcode </h2>
				</div>
				<form name="adduser" action="<?php echo site_url('city/addnewzips') ?>" method="post" enctype="multipart/form-data">
			
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<input type="hidden" name="city_id" value="<?= $city->city_info->city_id; ?>" class="form-control">
						<label class="col-sm-4 control-label">Zipcode</label>
						<div class="col-sm-8">
							<input type="text"  name="zipcode" value="<?= set_value('zipcode') ?>" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Status</label>
						<div class="col-sm-8">
							<select class="form-control" name="zip_status">
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
					<h2 class="modal-title">Edit Zipcode </h2>
				</div>
				<form name="zipcode" action="<?php echo site_url('city/updatezips') ?>" method="post">
			
				<div class="modal-body"	>
					<div class="pb"></div> 
					<div class="form-group">
						<input type="hidden" name="cz_id" value=""  id="cz_id" class="form-control">
						<input type="hidden" name="city_id" value="<?= $city->city_info->city_id; ?>" class="form-control">
						<label class="col-sm-4 control-label">Zipcode</label>
						<div class="col-sm-8">
							<input type="number" name="zipcode" value="" id="zipcode" class="form-control">
						</div>
					</div>
					<div class="pb"></div> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Status</label>
						<div class="col-sm-8">
							<select class="form-control" name="zip_status" id="zip_status">
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
</body>
</html>

