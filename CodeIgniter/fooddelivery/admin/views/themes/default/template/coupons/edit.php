<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css" rel="stylesheet">
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('coupons') ?>">Coupons</a></li>
				<li class="active"><a href="">Edit Coupons</a></li>
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-default">
				    <div class="panel-heading">
				        <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Coupon</h3>
				    </div>
				    <div class="panel-body">
				        <form action="<?= site_url('coupons/updatecoupon') ?>" method="post" enctype="multipart/form-data" id="form-coupon" class="form-horizontal">
				            <button class="btn btn-primary pull-right" type="submit">Update</button>
				            <br>
				            <br>
				           	<ul class="nav nav-tabs">
						        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
						        <li class=""><a href="#tab-history" data-toggle="tab">History</a></li>
						    </ul>
				            <div class="tab-content" >
				            	<div class="tab-pane active" id="tab-general">

					            	<div class="pb"></div>
					            	<input type="hidden" name="c_id" value="<?= $coupons->c_id ?>" placeholder="Coupon Name" id="input-name" class="form-control">
					                <div class="tab-pane active" id="tab-general">
					                    <div class="form-group required">
					                        <label class="col-sm-2 control-label" for="input-name">Coupon Name</label>
					                        <div class="col-sm-10">
					                            <input type="text" name="coupon_name" value="<?= $coupons->coupon_name ?>" placeholder="Coupon Name" id="input-name" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group required">
					                        <label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" title="" data-original-title="The code the customer enters to get the discount.">Code</span></label>
					                        <div class="col-sm-10">
					                            <input type="text" name="coupon_code" value="<?= $coupons->coupon_code ?>" placeholder="Code" id="input-code" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-2 control-label" for="input-type"><span data-toggle="tooltip" title="" data-original-title="Percentage or Fixed Amount.">Type</span></label>
					                        <div class="col-sm-10">
					                            <select name="type" id="input-type" class="form-control">
					                                
					                                <option value="F" <?= $coupons->type=='F' ? 'selected' : '' ?> >Fixed Amount</option>
					                                <option value="P" <?= $coupons->type=='P' ? 'selected' : '' ?>>Percentage</option>
					                            </select>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-2 control-label" for="input-discount">Discount</label>
					                        <div class="col-sm-10">
					                            <input type="text" name="discount" value="<?= $coupons->discount ?>" placeholder="Discount" id="input-discount" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="" data-original-title="The total amount that must be reached before the coupon is valid.">Total Amount</span></label>
					                        <div class="col-sm-10">
					                            <input type="text" name="total_amount" value="<?= $coupons->total_amount ?>" placeholder="Total Amount" id="input-total" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group">
											<label class="col-sm-2 control-label"> Discount Date </label>
											<div class="col-sm-10">
												<div class="input-daterange input-group" id="datepicker">
													<input type="text" class="form-control" value="<?= $coupons->date_start != '1970-01-01' ? $coupons->date_start :'' ?>" name="start" />
													<span class="input-group-addon">to</span>
													<input type="text" class="form-control"  value="<?=  $coupons->date_end != '1970-01-01' ? $coupons->date_end :'' ?>" name="end" />
												</div>
											</div>
											
										</div>
					                   
					                    <div class="form-group">
					                        <label class="col-sm-2 control-label" for="input-uses-total"><span data-toggle="tooltip" title="" >Uses Per Coupon</span></label>
					                        <div class="col-sm-10">
					                            <input type="text" name="uses_per_coupon" value="<?= $coupons->uses_per_coupon ?>" placeholder="Uses Per Coupon" id="input-uses-total" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-2 control-label" for="input-uses-total">Uses Per Customer</span></label>
					                        <div class="col-sm-10">
					                            <input type="text" name="uses_per_customer" value="<?= $coupons->uses_per_customer  ?>" placeholder="Uses Per customer" id="input-uses-total" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-2 control-label" for="input-status">Status</label>
					                        <div class="col-sm-10">
					                            <select name="status" id="input-status" class="form-control">
					                                <option value="1" <?= $coupons->status ? 'selected' :'' ?>>Enabled</option>
					                                <option value="0"  <?= $coupons->status ? '' :'selected' ?> >Disabled</option>
					                            </select>
					                        </div>
					                    </div>
					                </div>
				                </div>
				                <div class="tab-pane" id="tab-history">
				                	<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>Order id</th>
										<th>Customer</th>
										<th>Date</th>
										
									</tr>
								</thead>
								<tbody id="tbody">
									<?php foreach ($coupon_history as $ch): ?>
										
									
									<tr>
										<td><?=  $ch->order_id ?></td>
										<td><?=  $ch->first_name.' '.$ch->last_name;     ?></td>
										<td><?=  date('d-m-Y',strtotime($ch->added_date)) ?></td>
										
									</tr>
									<?php endforeach ?>
								</tbody>
								
							</table>


				                </div>
				            </div>                        
				        </form>			    </div>                     
				</div>                                                                          
        	</div>                           
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#datepicker').datepicker();
	$('#product_id').select2();
$('#input-type').change(function(){
 	var type = $(this).val();
	if(type="P"){
		$('#input-discount').attr('max', '100');
	}else{
		$('#input-discount').attr('max', '');
	}
});
</script>
<script type="text/javascript">
	$('#form-coupon').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		
	});
</script>
</body>
</html>
