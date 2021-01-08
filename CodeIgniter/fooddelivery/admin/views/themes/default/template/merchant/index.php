<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('merchant'); ?>">Merchant</a></li>
				
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('merchant/addnew') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
						
						<div class="panel-body ">
							<div class="well">
								<form action="<?=  site_url('merchant'); ?>" method="get" name="filter">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-name">Buisness Name</label>
											<input type="text" name="merchant" value="<?= $merchant ?>" placeholder="Buisness Name" id="input-name" class="form-control" autocomplete="off">
											<ul class="dropdown-menu"></ul>
										</div>
										<div class="form-group">
											<label class="control-label" for="input-email">E-Mail</label>
											<input type="text" name="email" value="<?= $email ?>" placeholder="E-Mail" id="input-email" class="form-control" autocomplete="off">
											<ul class="dropdown-menu"></ul>
										</div>
									</div>
									
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label" for="input-ip">Phone</label>
											<input type="tel" name="phone" value="<?= $phone ?>" placeholder="phone" id="input-phone" class="form-control">
										</div>
										<div class="form-group">
											<label class="control-label" for="input-approved">Approved</label>
											<select name="approved" id="input-approved" class="form-control">
												<option value="0"  <?= $approved =='0' ? 'selected' : '' ?>></option>
												<option value="1" <?= $approved ? 'selected' : '' ?> >Yes</option>
												<option value="2" <?= $approved == '2'? 'selected' : '' ?>>No</option>
											</select>
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
											<label class="control-label" for="input-ip">City</label>
											<input type="text" name="city" value="<?= $city ?>" placeholder="City" id="input-ip" class="form-control">
										</div>
										<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
									</div>
								</div>
								</form>
							</div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Business Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Physical City</th>
										<th>Date</th>
										<th  class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($merchants)): foreach($merchants as $merchant): ?>
									<tr>
										<td><input type="checkbox" value="<?= $merchant->m_id ?>" class="delete" name="delete[]"></td>
										<td class="col-md-3"><?php echo $merchant->business_name ?></td>
										<td><?= $merchant->username ?></td>
										<td><?= $merchant->phone ?></td>
										<td class=""><?php echo $merchant->physical_city ?></td>
										<td class=""><?= date('d-m-Y',strtotime($merchant->created_on)) ?></td>
										<td class="text-right">
											<?php $id = $merchant->m_id; ?>
											<a href="<?php echo site_url('merchant/loginasmerchant/'.$id.'') ?>" class="btn btn-primary"> Login As</a> 
											<a href ="<?php echo site_url('merchant/edit/'.$id.''); ?>"  class="btn btn-primary">Edit</a>
										</td>
									</tr>
									<?php $i++; endforeach; else: ?>
									<tr class="err_msg"><td colspan="7">Merchant(s) not available.</td></tr>
									<?php endif; ?>
									
								</tbody>
								
								<tfoot>
									<tr>
										
										<td colspan="6"></td>
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
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
	
$(document).ready(function(){
		$('#delete').click(function(event){
			
        	var users = $('input:checkbox.delete').serialize();
        	
			alertify.confirm("Are you sure you want to Delete this merchant ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('merchant/deletemultiple'); ?>",
						type: "post",
						data:users,
						success:function(data){
							window.location.reload();
						}
					});
       
			    } else {
			       
			    }
			});
		});

		
	});
</script>
</body>
</html>

