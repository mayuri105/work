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
										<td>Payu Money Payment Gateway</td>
										<td><?= $payu_enable ? 'Active' :'Inactive' ?></td>
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
					<h2 class="modal-title">Payu Money Settings</h2>
				</div>
				<?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'package');

						echo form_open_multipart('payment/savepayu', $attributes);  ?>	

					<div class="modal-body"	>
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Payu Money Enable </label>
							<div class="col-sm-8">
								
								<select class="form-control" name="payu_enable">
		                            <?php if($payu_enable=='1'){ ?>
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
							<label class="col-sm-4 control-label">Payu Money test mode</label>
							<div class="col-sm-8">
								
								<select class="form-control" name="payu_test">
		                            <?php if($payu_test=='1'){ ?>
		                                <option value="1" selected="">True</option>
		                                <option value="0">False</option>
		                            <?php }else{ ?>
		                                <option value="1">True</option>
		                                <option selected="" value="0">False</option>
		                            <?php } ?>
		                        </select>
							</div>
						</div>
						<div class="pb"></div>	
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Payu Merchant key</label>
							<div class="col-sm-8">
								
								 <input class="form-control" value="<?= $payu_key ?>" name="payu_key" />
							</div>
						</div>
						<div class="pb"></div>	
						<div class="form-group">
							<label class="col-sm-4 control-label">Payu Salt</label>
							<div class="col-sm-8">
								
								<input class="form-control" value="<?= $payu_salt ?>" name="payu_salt" />
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

</body>
</html>

