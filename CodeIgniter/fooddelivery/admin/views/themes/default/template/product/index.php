<?php echo Modules::run('header/header/index'); ?>
<?php echo $this->session->userdata('is_admin') ?  Modules::run('sidebar/sidebar/index') : Modules::run('sidebar/sidebar/merchant')  ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php echo site_url('products'); ?>">Home</a></li>
				<li class="active"><a href="">Products</a></li>
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					<div class="panel-body">
						<div class="well">
							<form action="<?=  site_url('products'); ?>" method="get" name="filter">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label class="control-label" for="input-name">Product Name</label>
										<input type="text" name="name" value="<?= $name ?>" placeholder="Product Name" id="input-name" class="form-control" autocomplete="off">
										<ul class="dropdown-menu"></ul>
									</div>
									<div class="form-group">
										<label class="control-label" for="input-merchant">Store name</label>
										<input type="text" name="store_name" value="<?= $store_name ?>" placeholder="Store name" id="input-merchant" class="form-control" autocomplete="off">
										<ul class="dropdown-menu"></ul>
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
										<label class="control-label" for="input-ip">Cuision</label>
										<input type="text" name="cuision" value="<?php echo $cuision ?>" placeholder="Cuision" id="input-cuision" class="form-control">
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
									<div class="form-group">
										<label class="control-label" for="input-City">Zipcode</label>
										<input type="text" name="zipcode" value="<?php echo $zipcode ?>" placeholder="Zipcode" id="input-zipcode" class="form-control">
									</div>
									<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
								</div>
							</div>
							</form>
						</div>
						<div class="panel-body ">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Product Name</th>
										<th>Store Name</th>
										<th>Zipcode</th>
										<th>Price</th>
										<th>Enabled</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($products)): foreach($products as $product): ?>
									<tr>
										<td><?= $i; ?></td>
										<td><?php echo $product->product_name ?></td>
										<td><?php echo $product->store_name ?></td>
										<td><?php echo $product->store_zip ?></td>
										<td><?php echo $product->price ?></td>
										<td><?php echo $product->status ? 'available' :'Not-available' ?></td>
										<td><?php echo date('d-m-Y',strtotime($product->added_on)) ?></td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">Product(s) not available.</td></tr>
									<?php endif; ?>
									
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td colspan="5"></td>
										<td >
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

</body>
</html>
