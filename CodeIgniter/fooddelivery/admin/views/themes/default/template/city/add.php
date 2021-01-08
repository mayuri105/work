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
					<h2>Add New City</h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					<div class="panel-body">
						<form name="adduser" class="form-horizontal" action="<?php echo site_url('city/add') ?>" method="post" enctype="multipart/form-data">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
							<li class=""><a href="#tab-zip" data-toggle="tab">Zipcodes</a></li>
							<li class=""><a href="#tab-image" data-toggle="tab">Image</a></li>
						</ul>
						
						
						<div class="pb"></div> 
						<div class="tab-content">

							<div class="tab-pane active"  id="tab-general">
								<div class="modal-body"	>
								<div class="pb"></div> 
								<div class="form-group">
									<label class="col-sm-4 control-label">City Name</label>
									<div class="col-sm-8">
										<input type="text" name="city_name" value="<?= set_value('city_name') ?>" class="form-control">
									</div>
								</div>
								<div class="pb"></div> 
								<div class="form-group">
									<label class="col-sm-4 control-label">State Name</label>
									<div class="col-sm-8">
										<select name="state" class="form-control">
											<option value="">None</option>
											<?php foreach ($state as $s ): ?>
												<option value="<?= $s->code; ?>" <?= set_value('state') == $s->code ? 'selected' : '' ?>><?= $s->name; ?></option>
											<?php endforeach ?>
										
										</select>
									</div>
								</div>
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
								<div class="form-group">
									<label class="col-sm-4 control-label">Feature City On Home page</label>
									<div class="col-sm-8">
										<input type="checkbox" name="feature_city" value="1">
									</div>
								</div>
							</div>
							</div>
							<div class="tab-pane" id="tab-zip">
								<div class="pb"></div> 
								<table id="ziptable" class="table table-bordered m" cellspacing="0">
										<thead>
											<tr>
											<th>Zip code</th>
											<th>Enabled</th>
											<th>Action</th>
											
											</tr>
										</thead>
										<tbody>
											<tr>

											<td>
												<input class="form-control" type="text" name="zipcode[]" id="zipcode" value="">
											</td>
											<td>
												<select class="form-control" name="zip_status[]">
													<option value="1">Enabled</option>
													<option value="0">Enabled</option>
												</select>
											</td>
											
											<td>
												<a href="javascript:void(0)" onclick="deleteRow(this,'ziptable')" class="delrow">Delete</a>
											</td>
											</tr>
												
										<button class="btn btn-primary m" type="button" id="addmorezip">Add Zipcode</button>
									</table>

							</div>
							<div class="tab-pane" id="tab-image">
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
</script>
</body>
</html>

