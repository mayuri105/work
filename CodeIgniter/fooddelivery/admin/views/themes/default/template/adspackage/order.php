<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('adspackage'); ?>">Ads Package</a></li>
				<li class="active"><a href="">Order</a></li>
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					
						<div class="panel-body ">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Store Name</th>
										<th>Package name</th>
										<th>Price</th>
										<th>Periods(in months)</th>
										<th>Approved</th>
										<th>Date Order</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php foreach ($adsorder as $ads): ?>
										<tr>
										<td>#</td>
										<td><?= $ads->store_name ?></td>
										<td><?= $ads->package_name ?></td>
										<td><?= $ads->package_price ?></td>
										<td><?= $ads->package_periods ?></td>
										<td><?= $ads->ads_approved ? 'Yes': 'No' ?></td>
										<td><?= date('d-m-Y',strtotime($ads->added_date)) ?></td>

										<td class="text-right">
											<?php if (!$ads->ads_approved): ?>
											<button class="btn btn-primary approved" id="approved" data-id="<?= $ads->ao_id; ?>">Approved</button>
											<?php else: ?>
											<button class="btn btn-danger disapproved"  data-id="<?= $ads->ao_id; ?>">Disapproved</button>
											<?php endif; ?>
											
										</td>
									</tr>
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr>
										<td>
										</td>
										<td colspan="2"></td>
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
	$('.approved').click(function(){
		data = {
			ao_id : $(this).data("id"),
			ajax :'1'
		}
		$.ajax({
			url : "<?php echo site_url('adspackage/approvedPackage') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){
				window.location.reload();
			}
		});
	});
	$('.disapproved').click(function(){
		data = {
			ao_id : $(this).data("id"),
			ajax :'1'
		}
		$.ajax({
			url : "<?php echo site_url('adspackage/disapprovedPackage') ?>",
			type: "POST",
			dataType: "json",
			data: data,
			success:function(data){
				window.location.reload();
			}
		});
	});


</script>

</body>
</html>
