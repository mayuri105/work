<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Payments</a></li>
			</ol> 
			<div class="container-fluid">
				
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
										<th>Payment Methods</th>
										<th>Active</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<tr>
										<td>1</td>
										<td>Cash on Delivery</td>
										<td><?= $cod_enable ? 'Active' :'Inactive' ?></td>
										<td class="text-right">
											<a data-toggle="modal" href="#myCod" class="btn btn-primary">Edit</a>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Paypal</td>
										<td><?= $paypal_enable ? 'Active' :'Inactive' ?></td>
										<td class="text-right">
											<a data-toggle="modal" href="#myPaypal" class="btn btn-primary">Edit</a>
										</td>
									</tr>
									<tr>
										<td>3</td>
										<td>Stripe Payment Gateway</td>
										<td><?= $stripe_enable ? 'Active' :'Inactive' ?></td>
										<td class="text-right">
											<a data-toggle="modal" href="#myStrip"  class="btn btn-primary">Edit
											</a>
										</td>
									</tr>
								</tbody>
								
							</table>
						</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<div class="modal fade" id="myStrip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Stripe Settings</h2>
				</div>
				<form action="<?php echo site_url('payments/savestripesetting') ?>" name="stripesetting" id="stripesetting" method="post" class="form-horizontal row-border">
					<div class="modal-body"	>
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Stripe Enable </label>
							<div class="col-sm-8">
								
								<select class="form-control" name="stripe_enable">
		                            <?php if($stripe_enable=='1'){ ?>
		                                <option value="1" selected="">True</option>
		                                <option value="0">False</option>
		                            <?php }else{ ?>
		                                <option value="1">True</option>
		                                <option selected="" value="0">False</option>
		                            <?php } ?>
		                        </select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Stripe threshold Amt </label>
							<div class="col-sm-8">
								
								<input type="text" class="form-control" name="stripe_threshold_value" value="<?=  $stripe_threshold_value ?>">
		                           
							</div>
						</div>
							
						<div class="form-group">
							<label class="col-sm-4 control-label">Stripe test mode</label>
							<div class="col-sm-8">
								
								<select class="form-control" name="stripe_test_mode">
		                            <?php if($stripe_test_mode=='true'){ ?>
		                                <option value="true" selected="">True</option>
		                                <option value="false">False</option>
		                            <?php }else{ ?>
		                                <option value="true">True</option>
		                                <option selected="" value="false">False</option>
		                            <?php } ?>
		                        </select>
							</div>
						</div>
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Stripe Verify SSl</label>
							<div class="col-sm-8">
								
								<select class="form-control" name="stripe_verify_ssl">
		                            <?php if($stripe_verify_ssl=='true'){ ?>
		                                <option value="true" selected="">True</option>
		                                <option value="false">False</option>
		                            <?php }else{ ?>
		                                <option value="true">True</option>
		                                <option selected="" value="false">False</option>
		                            <?php } ?>
		                        </select>
							</div>
						</div>
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Stripe key test public</label>
							<div class="col-sm-8">
								
								 <input class="form-control" value="<?= $stripe_key_test_public ?>" name="stripe_key_test_public" />
							</div>
						</div>
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Stripe key test secret</label>
							<div class="col-sm-8">
								
								<input class="form-control" value="<?= $stripe_key_test_secret ?>" name="stripe_key_test_secret" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Stripe key live public</label>
							<div class="col-sm-8">
								
								 <input class="form-control" value="<?= $stripe_key_live_public ?>" name="stripe_key_live_public" />
							</div>
						</div>
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Stripe key live secret</label>
							<div class="col-sm-8">
								
								<input class="form-control" value="<?= $stripe_key_live_secret ?>" name="stripe_key_live_secret" />
							</div>
						</div>
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Stripe Currency Code</label>
							<div class="col-sm-8">
								<input class="form-control" value="<?= $stripe_currency_code ?>" name="stripe_currency_code" />
																
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
<div class="modal fade" id="myCod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Cash On Delivery Settings</h2>

				</div>	
				<form action="<?php echo site_url('payments/savecod') ?>" name="savecod" id="savecod" method="post" class="form-horizontal row-border">
					
					<div class="modal-body">
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Cod Enable </label>
							<div class="col-sm-8">
								
								<select class="form-control" name="cod_enable">
		                            <?php if($cod_enable=='1'){ ?>
		                                <option value="1" selected="">True</option>
		                                <option value="0">False</option>
		                            <?php }else{ ?>
		                                <option value="1">True</option>
		                                <option selected="" value="0">False</option>
		                            <?php } ?>
		                        </select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Cash threshold Amt </label>
							<div class="col-sm-8">
								
								<input type="text" class="form-control" name="cash_threshold_value" value="<?=  $cash_threshold_value ?>">
		                           
							</div>
						</div>

						<div class="pb"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</div>
					
				</form>
				
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="myPaypal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Paypal Settings</h2>
				</div>
				<form action="<?php echo site_url('payments/savepaypalsetting') ?>" name="paypalsetting" id="paypalsetting" method="post" class="form-horizontal row-border">
					
					<div class="modal-body">
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Paypal Enable </label>
							<div class="col-sm-8">
								
								<select class="form-control" name="paypal_enable">
		                            <?php if($paypal_enable=='1'){ ?>
		                                <option value="1" selected="">True</option>
		                                <option value="0">False</option>
		                            <?php }else{ ?>
		                                <option value="1">True</option>
		                                <option selected="" value="0">False</option>
		                            <?php } ?>
		                        </select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Paypal threshold Amt </label>
							<div class="col-sm-8">
								
								<input type="text" class="form-control" name="paypal_threshold_value" value="<?=  $paypal_threshold_value ?>">
		                           
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Paypal test</label>
							<div class="col-sm-8">
								
								<select class="form-control" name="paypal_test">
		                            <?php if($paypal_test){ ?>
		                                <option value="1" selected="">Yes</option>
		                                <option value="0">No</option>
		                            <?php }else{ ?>
		                                <option value="1">Yes</option>
		                                <option selected="" value="0">No</option>
		                            <?php } ?>
		                        </select>
							</div>
						</div>
						<div class="pb"></div>
						<div class="form-group">
							<label class="col-sm-4 control-label">signature</label>
							<div class="col-sm-8">
								<input class="form-control" value="<?= $paypal_signature ?>" name="paypal_signature" />
							</div>
						</div>
						<div class="pb"></div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Paypal Username</label>
							<div class="col-sm-8">
								
								<input class="form-control" value="<?= $paypal_username ?>" name="paypal_username" />
							</div>
						</div>
						<div class="pb"></div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Paypal Password</label>
							<div class="col-sm-8">
								
								 <input class="form-control" value="<?= $paypal_password ?>" name="paypal_password" />
							</div>
						</div>
						<div class="pb"></div>
						<div class="form-group">
							<label class="col-sm-4 control-label">currency</label>
							<div class="col-sm-8">
								
								<input class="form-control" value="<?= $currency ?>" name="currency" />
							</div>
						</div>

						<div class="pb"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</div>
					
				</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

</body>
</html>

