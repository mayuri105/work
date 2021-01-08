<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css" rel="stylesheet"> 
<?php echo  Modules::run('sidebar/sidebar/index') ?>

<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('store'); ?>">Store</a></li>
				<li class="active"><a href="">Add Store</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2>Add Store</h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					
						<div class="panel-body ">
							<form name="addstore" id="addstore" class="form-horizontal" action="<?php echo site_url('store/addstore') ?>" method="post" enctype="multipart/form-data">
								
							    <ul class="nav nav-tabs">
							        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
							    </ul>
							    <div class="pb"></div>
							   	

								<div class="tab-content">
							        <div class="tab-pane active" id="tab-general">
							            <div class="row">
							                <div class="col-sm-2">
							                	 <ul class="nav nav-pills nav-stacked" id="address">
							                        <li class="active"><a href="#tab-store" data-toggle="tab" aria-expanded="true">General</a></li>
							                        <li class=""><a href="#tab-address" data-toggle="tab" aria-expanded="true">Address</a></li>
							                         
							                    </ul>
							                </div>
							                <div class="col-md-10">
							                	<div class="tab-content">
									             	<div class="tab-pane active" id="tab-store">
														<div class="form-group ">
															<label class="col-sm-3 control-label">Store Name <span class="required">*</span></label>
															<div class="col-sm-8">
																<input type="text" name="store_name" value="<?= set_value('store_name') ?>" class="form-control" required>
															</div>
														</div>	


														
														<div class="form-group ">
															<label class="col-sm-3 control-label">Store Status  <span class="required">*</span></label>
															<div class="col-sm-8">
																<select name="status"  id="status" class="form-control" required> 
																	<option value="">None</option>
																	<option value="1" <?= set_value('status') ? 'selected' :'' ?> >Approved</option>
																	<option value="0" <?= set_value('status')  ? 'selected' :'' ?> >Not Approved</option>
																</select>
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-3 control-label"> Merchant Name  <span class="required">*</span></label>
															<div class="col-sm-8">
																<select name="merchant_id" id="merchant_id" class="form-control" required> 
																	<option value="">None</option>
																	<?php foreach ($merchant as $s ): ?>
																		<option value="<?= $s->m_id; ?>" <?= set_value('merchant_id') == $s->m_id  ? 'selected' :'' ?>><?= $s->business_name; ?></option>
																	<?php endforeach ?>
																</select>
															</div>
														</div>	
														<div class="form-group ">
															<label class="col-sm-3 control-label"> Set Store Commission<span class="required">*</span></label>
															<div class="col-sm-8">
																<input type="number" name="store_commission" value="<?= set_value('store_commission') ?>" class="form-control" required>
															</div>
														</div>		
															
														<div class="form-group ">
															<label class="col-sm-3 control-label">Store Type  <span class="required">*</span></label>
															<div class="col-sm-8">
																<select name="store_type" id="store_type"  class="form-control" required> 
																	<option value="">None</option>
																	<?php foreach ($merchant_type as $m ): ?>
																		<option value="<?= $m->mt_id; ?>" <?= set_value('store_type') == $m->mt_id  ? 'selected' :'' ?>><?= $m->type; ?></option>
																	<?php endforeach ?>
																</select>
															</div>
														</div>
														<div id="restorentdiv" style="display:none">
															<div class="form-group">
																<label for="fieldurl" class="col-md-3 control-label">Select Cusine </label>
																<div class="col-md-6">	
																	<select  name="multicusine[]" id="multicusine" multiple>
																		<?php foreach ($cusine_data as $c ): ?>
																		<option value="<?= $c->cu_id; ?>"><?= $c->cusine_type; ?></option>
																	<?php endforeach ?>
																	</select>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="col-md-3 control-label">Phone</label>
															<div class="col-sm-8">
																<input type="number" name="phone"  value="<?= set_value('phone') ?>" class="form-control">
															</div>
														</div>
														
														<div class="form-group">
															<label class="col-md-3 control-label">Logo Upload <span class="required">*</span> </label>
															<div class="col-md-6">
																<input type="file" name="fileinput" class="form-contorl">
															</div>
														</div>

														<div class="form-group">
															<label class="col-md-3 control-label">Banner Upload  <span class="required">*</span></label>
															<div class="col-md-6">
																<input type="file" name="fileinput2" class="form-contorl">
															</div>
														</div>	
													</div>
													<div class="tab-pane" id="tab-address">
														<div class="form-group ">
															<label class="col-sm-3 control-label">Store Street</label>
															<div class="col-sm-8">
																<textarea type="text" name="store_street" class="form-control" required><?= set_value('store_street') ?></textarea>
															</div>
														</div>

														<div class="form-group ">
															<label class="col-sm-3 control-label">Store City</label>
															<div class="col-sm-8">
																
																<select  name="store_city" id="storecity" class="" required >
																	<?php foreach ($city as $ct ): ?>
																	<option value="<?= $ct->city_id; ?>" <?= set_value('store_city')== $ct->city_id ? 'selected' : '' ?> ><?= $ct->city_name.' '.$ct->state; ?></option>
																<?php endforeach ?>
																</select>

															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-3 control-label">Store Zipcode</label>
															<div class="col-sm-8">
																<input type="number" maxlength="6" name="store_zip" value="<?= set_value('store_zip') ?>" required class="form-control">
															</div>
														</div>
														
	
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<a href="<?= site_url('store') ?>" class="btn btn-default" >Close</a>
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

<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.min.js"></script>

<script type="text/javascript">
$('#addstore').validate({
	errorClass: "help-block",
	validClass: "help-block",
	highlight: function(element, errorClass,validClass) {
	  $(element).closest('.form-group').addClass("has-error");
	},
	unhighlight: function(element, errorClass,validClass) {
	   $(element).closest('.form-group').removeClass("has-error");
	},
	rules: {
        status: { required: true },
        merchant_id: { required: true },
        store_state: { required: true },
    }
	
});

$("#addhours").click(function () {
     $("#businesshours").each(function () {
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
$("#adddeleviryrow").click(function () {
     $("#deleviryinfo").each(function () {
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
function deleteRowforBus(r){
	var i = r.parentNode.parentNode.rowIndex;
	
    if(i==2){
    	return false;
    }else{
    	 document.getElementById('businesshours').deleteRow(i);

    }
}		     
$(document).ready(function(){
	$('#multicusine').select2({ maximumSelectionLength: 2});
	
	$('#storecity').select2({});
});

$('#store_type').change(function(){
	if($(this).val()==1){
		$('#restorentdiv').show();

	}else{
		$('#restorentdiv').hide();
	}
});
</script>
</body>
</html>

<!-- logo,gallery images -->