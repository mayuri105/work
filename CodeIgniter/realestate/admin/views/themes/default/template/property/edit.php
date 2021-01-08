<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/form-select2/select2.css">
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/css/jquery.fileupload-ui.css" type="text/css" />
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/css/jquery.fileupload.css" type="text/css" />
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/css/style.css" type="text/css" />
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('property') ?>">Property</a></li>
				<li class="active"><a href="">Edit Property</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Edit Property</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<ul class="nav nav-tabs">
					        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
					        <li class=""><a href="#tab-propertyDe" data-toggle="tab">Property Details</a></li>
					       	<li class=""><a href="#tab-attributes" data-toggle="tab">Attributes</a></li>
					       	<li class=""><a href="#tab-amenities" data-toggle="tab">Amenities</a></li>
					       	<li class=""><a href="#tab-images" data-toggle="tab">Images</a></li>
					      	<li class=""><a href="#tab-history" data-toggle="tab">History</a></li>
					      	<li class="<?php echo $property->property_action == 'sale' ? '' :'hide' ?>" id="bigdate"><a href="#tab-dates"  data-toggle="tab">Bid Dates</a></li>
					      	<li class="<?php echo $property->property_action == 'investments' ? '' :'hide' ?>" id="roitable"><a href="#tab-roitable"  data-toggle="tab">Roi Table</a></li>
					      	<?php if ($bidingdata): ?>
					      	<li class=""><a href="#tab-bidonprop" data-toggle="tab">Bidding data</a></li>
					      	<?php endif ?>
					      	
						</ul>
						<?php 
							$attributes = array('class' => 'form-horizontal', 'id' => 'property');

							echo form_open_multipart('property/editchange', $attributes);  ?>		
					    <div class="pb"></div>
					   	    <div class="tab-content">
					   	    	
						        <div class="tab-pane active" id="tab-general">
					        	  	<div class="form-group">
										<label class="col-sm-3 control-label">Property Title
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<input type="text" name="property_title" required="" id="property_title" value="<?php echo $property->property_title ?>" class="form-control">
										</div>
									</div>

									
									<div class="form-group">
										<label class="col-sm-3 control-label">Property small Description
											
										</label>
										<div class="col-sm-8">
											<input type="text" name="property_small_desc" id="property_small_desc" value="<?php echo $property->property_small_desc ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Property Content	</label>
										<div class="col-sm-8">
											<textarea name="property_content" id="property_content" class="form-control"><?php echo $property->property_content ?></textarea> 
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Property type
											<span class="required">*</span>
										</label>
										<div class="col-sm-8">
											
											<select class="form-control" name="property_type" required> 
												<option value="">None</option>
												<?php foreach ($types as $t): ?>
													<option value="<?php echo $t->cat_id ?>"  <?php echo $property->property_type == $t->cat_id ? 'selected' :''  ?>><?php echo $t->category ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Approved
											<span class="required">*</span>
										</label>
										<div class="col-sm-8">
											<select class="form-control" name="approved" required>
												<option value="1" <?php echo $property->approved =='1' ? 'selected' :''  ?> >Yes</option>
												<option value="0" <?php echo $property->approved =='0' ? 'selected' :''  ?> >No</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Property Status
											<span class="required">*</span>
										</label>
										<div class="col-sm-8">
											<select class="form-control" name="property_status" required> 
												<option value="">None</option>
												<option value="On Investments" <?php echo $property->status == 'On Investments' ? 'selected' : '' ?> >On Investments</option>
												<option value="On Bid"  <?php echo $property->status == 'On Bid' ? 'selected' : '' ?>>On Bid</option>
												<option value="On Rent" <?php echo $property->status == 'On Rent' ? 'selected' : '' ?> >On Rent</option>
												<option value="On Sale"  <?php echo $property->status == 'On Sale' ? 'selected' : '' ?>>On Sale</option>
												<option value="Invested"  <?php echo $property->status == 'Invested' ? 'selected' : '' ?>>Invested</option>
												<option value="Rented"  <?php echo $property->status == 'Rented' ? 'selected' : '' ?>>Rented</option>
												
												<option value="Sold"  <?php echo $property->status == 'Sold' ? 'selected' : '' ?>>Sold</option>
												<option value="Bid ended"  <?php echo $property->status == 'Bid ended' ? 'selected' : '' ?>>Bid ended</option>
												
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Set As Feature Property
											
										</label>
										<div class="col-sm-8">
											<div class="checkbox">
											  <label><input type="checkbox" name="set_as_feature" value="1" <?php echo $property->set_as_feature ? 'checked' : '' ?>></label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label">Property Action
											<span class="required">*</span>
										</label>
										<div class="col-sm-8">
											<select class="form-control" name="property_action" id="property_action" required> 
												<option value="">None</option>
												<option value="rent" <?php echo $property->property_action =='rent' ? 'selected' :''  ?>>Rent</option>
												<option value="sale" <?php echo $property->property_action =='sale' ? 'selected' :''  ?>>Sale</option>
												<option value="investments" <?php echo $property->property_action =='investments' ? 'selected' :''  ?>>Investments</option>
												
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Landmark</label>
										<div class="col-sm-8">
											<input type="text" name="landmark" id="landmark" value="<?php echo $property->landmark ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Area</label>
										<div class="col-sm-8">
											<select name="area" id="area" class="form-control">
												<option value="">None</option>
												<?php foreach ($areas as $area): ?>
													<option value="<?php echo $area->area_id ?>" <?php echo $area->area_id == $property->area ? 'selected' : '' ?>><?php echo $area->area_name ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label">Feature image</label>
										<div class="col-sm-8">
											<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
												<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
													<?php if ($property->feature_image): ?>
														<img src="<?php echo getuploadpath().'property/'.$property->feature_image; ?>">
													<?php endif ?>
												</div>
												<div>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
													<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
													<input type="file" name="fileinput"></span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Set in Slider image</label>
										<div class="col-sm-8">
											<div class="checkbox">
											  <label><input type="checkbox" name="set_in_slider_img" value="1"  <?php echo $property->set_in_slider_img ? 'checked' :'' ?>></label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Slider image</label>
										<div class="col-sm-8">
											<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
												<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
													<?php if ($property->slider_image): ?>
														<img src="<?php echo getuploadpath().'property/'.$property->slider_image; ?>">
													<?php endif ?>
												</div>
												<div>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
													<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
													<input type="file" name="fileinput2"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="tab-propertyDe">
									<div class="form-group">
										<label class="col-sm-3 control-label">Beds</label>
										<div class="col-sm-8">
											<input type="number" name="beds" id="" value="<?php echo $property->beds ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Bath room</label>
										<div class="col-sm-8">
											<input type="number" name="bathrums" id="" value="<?php echo $property->bathrums ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Built Up Area</label>
										<div class="col-sm-8">
											<input type="text" name="built_up_area" id="built_up_area" value="<?php echo $property->built_up_area ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Carpet Area</label>
										<div class="col-sm-8">
											<input type="text" name="carpet_area" id="carpet_area" value="<?php echo $property->carpet_area ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Property owner</label>
										<div class="col-sm-8">
											<input type="text" value="<?php echo $property->property_owner ?>" class="form-control" name="property_owner" > 
												
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Property owner Phone</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" value="<?php echo $property->property_owner_phone ?>"  name="property_owner_phone"> 
										</div>
									</div>
									


									<div class="form-group">
										<label class="col-sm-3 control-label">Cost</label>
										<div class="col-sm-8">
											<input type="number" name="cost" id="cost" value="<?php echo $property->cost ?>" class="form-control">
										</div>
									</div>
									
									
									
									
								</div>
								
								

								<div class="tab-pane" id="tab-attributes">
									<input class="form-control" type="hidden" name="property_id" id="" value="<?= $property->property_id; ?>">	

									<table id="attributes" class="table table-bordered m" cellspacing="0">
										<thead>
											<tr>
												<th>Attributes Name</th>
												<th>Attributes Value</th>
												<th></th> 
											</tr>
										</thead>
										<tbody>
											
												<?php 

												$attribute_row = 0;

												foreach ($pro_attributes as $pa): ?>
																									
												<tr class="newform">
													<td>
														<select class="form-control" name="attributes[$attribute_row][attributes_id]">
															<?php foreach ($attr as $as): ?>
																<optgroup label="<?php echo $as->group_name ?>">
																	 <?php foreach ($as->attribute as $s): ?>
																	 	<option value="<?php echo $s->sa_id ?>" <?php echo $s->sa_id == $pa->attributes_id ? 'selected' : '' ?>><?php echo $s->attributes_name ?></option>	
																	 <?php endforeach ?>
																</optgroup>
															<?php endforeach ?>
														</select>
													</td>
													<td>
														<input class="form-control" type="text" name="attributes[$attribute_row][attributes_value]"  value="<?php echo $pa->attributes_value ?>">
													</td>
													<td>
														<a href="javascript:void(0)" onclick="SomeDeleteRowFunction(this);" class="btnDeleteAt">Delete</a>
													</td>
												</tr>
												<?php 
												$attribute_row++;
												endforeach ?>
																						

										</tbody>
											<button class="btn btn-primary m" type="button" id="add_more_attributes">Add More attributes</button>
										
									</table>
								</div>
								<div class="tab-pane" id="tab-images">
									<div id="images" class="span9">
					                    <span class="btn btn-success fileinput-button">
					                        <i class="fa fa-file-movie-o"></i>
					                        <span>Select file</span>
					                        <input id="fileupload" type="file" multiple name="attachment[]" class="form-control" />
					                    </span>
					                    <div style="display: none;">
					                        <span class="btn btn-primary start pull-right">
					                            <i class="icon-upload-alt"></i>
					                            <span>Start Upload</span>
					                        </span>
					                    </div>   
					                    <br><br>
					                    <!-- The global progress bar -->
					                    <div id="progress" class="progress">
					                        <div class="progress-bar progress-bar-success"></div>
					                    </div>
					                    <!-- The container for the uploaded files -->
					                    <div  >
					                        <div id="img_alg"></div>
					                        <table role="presentation" id="files" class="table table-striped">
					                        	<tbody class="files">
					                        		<?php foreach ($property_images as $proImage): ?>
					                        		<tr>
					                        				<td>
					                        			
					                        			<img src="<?php echo getuploadpath().'property/'.$proImage->image_name ?>" width="100" height="100">
					                        			<br>
					                        			<span><?php echo $proImage->image_name ?></span><br>
					                        			<input type="hidden" name="attachment[]" value="<?php echo $proImage->image_name ?>">
					                        			<button class="btn pull-right btn-danger delete"><i class="fa fa-minus"></i>
					                        				<span>Delete</span>
					                        			</button>
					                        			</td>
					                        		</tr>
					                        		<?php endforeach ?>

					                        	</tbody>
					                        </table>
					                    
					                    </div>
					                    <!-- END files -->
					                 </div>
					                 <!-- END .images -->
								</div>
								<div class="tab-pane" id="tab-amenities">
									<div class="form-group">
										<?php 
										$amen = explode(',',$property->at)
										?>
										<label class="col-sm-3 control-label">Selected Amenities 
											<span class="required">*</span></label>
										<div class="col-sm-8">
											<select name="amenities[]" id="amenities" multiple>
												<?php foreach ($amenities as $a): ?>
													<option value="<?php echo  $a->amenities_id ?>" <?php echo in_array($a->amenities_id,$amen) ? 'selected' :'' ?>><?php echo  $a->amenity_name ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="tab-dates">
									<div class="form-group">
										<label class="col-sm-3 control-label">Open For Bid</label>
										<div class="col-sm-8">
											<select class="form-control" name="open_for_bid"> 
												<option value="">None</option>
												<option value="1" <?php echo $property->open_for_bid ? 'selected' : '' ?>>Yes</option>
												<option value="0" <?php echo !$property->open_for_bid ? 'selected' : '' ?>>No</option>
												
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Bid Difference</label>
										<div class="col-sm-8">
											<input class="form-control" value="<?php echo $property->bid_difference  ?>" type="number" name="bid_difference" > 
											
										</div>
									</div>
									<table id="dates" class="table table-bordered m" cellspacing="0">
										<thead>
											<tr>
												<th>Bid Dates</th>
												<th></th> 
											</tr>
										</thead>
										<tbody>
											<?php 

												$date_row = 0;

												foreach ($bid_dates as $a): ?>

												<tr class="newform">
													
													<td>
														<input class="date form-control" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y',strtotime($a->dates)) ?>" type="text" name="dates[<?php echo $date_row ?>][value]"  >
													</td>
													<td>
														<a href="javascript:void(0)"  onclick="SomeDeleteRowFunction(this);"  class="btnDeleteDate">Delete</a>
													</td>
												</tr>
												<?php 
												$date_row++;
												endforeach ?>


										</tbody>
											<button class="btn btn-primary m" type="button" id="add_dates">Add Dates</button>
										
									</table>
								</div>
								<div class="tab-pane" id="tab-roitable">
									
									<table id="roi" class="table table-bordered m" cellspacing="0">
										<thead>
											<tr>
												<th>Roi Year</th>
												<th>Return Of investment (%)</th> 
											</tr>
										</thead>
										<tbody>
											<?php 

											$roi_row = 0;

												foreach ($roitable as $r): ?>

												<tr class="newform">
													
													<td>
														<input class=" form-control"  value="<?php echo $r->year ?>" type="number" name="roi[<?php echo $roi_row ?>][year]"  >
													</td>
													<td>
														<input class=" form-control"  value="<?php echo $r->return_of_investment ?>" type="number" name="roi[<?php echo $roi_row ?>][return_of_investment]"  >
													</td>
													<td>
														<a href="javascript:void(0)"  onclick="SomeDeleteRowFunction(this);"  class="btnDeleteDate">Delete</a>
													</td>
												</tr>
												<?php 
												$roi_row++;
												endforeach ?>
										</tbody>
											<button class="btn btn-primary m" type="button" id="add_roidata">Add Investment</button>
										
									</table>
								</div>
								<div class="tab-pane" id="tab-history">
									
									<table  class="table table-bordered m" cellspacing="0">
										<thead>
											<tr>
												<th>Action</th>
												<th>Date</th> 
											</tr>
										</thead>
											<tr>
												<td>Added By- <?php echo $property->username;  ?></td>
												<td><?php echo date('d-m-Y',strtotime($property->added_on)) ?></td> 
											</tr>
											
											<?php if ($rent): ?>
												<tr>
													<td>Rent To - <?php echo $rent->first_name .' '.$rent->last_name;  ?></td>
													<td><?php echo date('d-m-Y',strtotime($rent->date_added)) ?></td> 
												</tr>
												
											<?php endif ?>
											<?php if ($sold): ?>
												<tr>
													<td>Sold To - <?php echo $sold->first_name .' '.$sold->last_name;  ?></td>
													<td><?php echo date('d-m-Y',strtotime($sold->added_date)) ?></td> 
												</tr>
											<?php endif ?>
											

									</table>
								</div>
								<div class="tab-pane" id="tab-bidonprop">
									<table  class="table table-bordered m" cellspacing="0">
										<thead>
											<tr>
												<th>Bid</th>
												<th>Customer</th> 
												<th>Amount</th> 
											</tr>
										</thead>
											<?php $i=1; foreach ($bidingdata as $b): ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $b->first_name.' '.$b->last_name; ?></td> 
													<td><?php echo $b->amount; ?></td> 
												</tr>
											<?php $i++; endforeach ?>
									</table>
								</div>

								<div class="modal-footer">
									<a href="<?php echo site_url('property') ?>" class="btn btn-default">Close</a>
									<button type="submit" class="btn btn-primary">Save Changes</button>
								</div>
								
						    </div>
						

					</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>


<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/form-select2/select2.js"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload-image.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload-process.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload-validate.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload-image.js"></script>

<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script type="text/javascript">
	$('#property').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
	});


$attribute_row = '<?= $attribute_row ?>';

$("#add_more_attributes").click(function () {

	$html = '<tr class="newform">';
	$html += '	<td>';
	$html += '		<select class="form-control" name="attributes['+$attribute_row+'][attributes_id]">';
	$html += '			<option value="">None</option>';
	<?php foreach ($attr as $as): ?>
	$html += '<optgroup label="<?php echo $as->group_name ?>">';
	<?php foreach ($as->attribute as $s): ?>
	$html += '<option value="<?php echo $s->sa_id ?>" ><?php echo $s->attributes_name ?></option>';
	<?php endforeach ?>
	$html += '</optgroup>';
	<?php endforeach ?>
	$html += '		</select>';
	$html += '	</td>';
	$html += '	<td>';
	$html += '		<input class="form-control" type="text" name="attributes['+$attribute_row+'][attributes_value]"  value="">';
	$html += '	</td>';
	$html += '	<td>';
	$html += '		<a href="javascript:void(0)" class="btnDeleteAt">Delete</a>';
	$html += '	</td>';
	$html += '</tr>';
	$("#attributes tbody").append($html);
	$attribute_row++;
});
$date_row = '<?= $date_row ?>';
$("#add_dates").click(function () {
	
	$html = '<tr class="newform">';
	$html += '	<td>';
	$html += '		<input class="date form-control" type="text" name="dates['+$date_row+'][value]"  >';
	$html += '	</td>';
	$html += '	<td>';
	$html += '		<a href="javascript:void(0)"  onclick="SomeDeleteRowFunction(this);"  class="btnDeleteDate">Delete</a>';
	$html += '	</td>';
	$html += '</tr>';

	$("#dates tbody").append($html);

	$date_row++;
	 $('.date').datepicker({
	 	 dateFormat: 'dd-mm-yy'
	 });
});

$roirow = <?= $roi_row ?>;
$("#add_roidata").click(function () {
	
	$html = '<tr class="newform">';
	$html += '	<td>';
	$html += '		<input class=" form-control" type="number" name="roi['+$roirow+'][year]"  >';
	$html += '	</td>';
	$html += '	<td>';
	$html += '		<input class=" form-control" type="number" name="roi['+$roirow+'][return_of_investment]"  >';
	$html += '	</td>';
	$html += '	<td>';
	$html += '		<a href="javascript:void(0)"  onclick="SomeDeleteRowFunction(this);"  class="btnDeleteDate">Delete</a>';
	$html += '	</td>';
	$html += '</tr>';

	$("#roi tbody").append($html);

	$roirow++;
	 
});
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?php echo site_url("property/upload_attachment") ?>',
        uploadButton = $('.start')
        .on('click', function () {
            var $this = $(this),
                data = $this.data();
            $this
                .off('click')
                .text('Abort')
                .on('click', function () {
                    $this.remove();
                    data.abort();
                });
            data.submit().always(function () {
                $this.remove();
            });
        });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<tbody/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<tr/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
            	var link = file.name;
                var html = '';
                var link = file.name;
                $(data.context.children()[index]).wrap(link).append('<input type="hidden" name="attachment[]" value="'+file.name+'" /><button class="btn pull-right btn-danger delete"><i class="fa fa-minus"></i><span>Delete</span></button>');
                // var link = $('<a>')
                //     .attr('target', '_blank')
                //     .prop('href', file.url);
                // $(data.context.children()[index]).wrap(link);

            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

// $(document).delegate('.delete','click',function(){
//     $(this).find('tr').remove();
// });

$('.delete').click(function(e){
	e.preventDefault();
	var $tr = $(this).closest('tr');
	$tr.find('td').fadeOut(1000,function(){ 
	$tr.remove();                    
	}); 	
})		
$('#amenities').select2({})
function SomeDeleteRowFunction(btndel) {
    if (typeof(btndel) == "object") {
        $(btndel).closest("tr").remove();
    } else {
        return false;
    }
}
$('#amenities').select2({});

$('#property_action').change(function(){
	
	if($(this).val() == 'sale'){
		$('#bigdate').removeClass('hide');
	}else{
		$('#bigdate').addClass('hide');
	}
	if($(this).val() == 'investments'){
		$('#roitable').removeClass('hide');
	}else{
		$('#roitable').addClass('hide');
	}
});
</script>

</body>
</html>
