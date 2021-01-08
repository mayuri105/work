<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Coupons</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<button id='delete' class="btn btn-danger pull-right ml"><i class="fa fa-trash"></i> Delete</button>
					<a href="<?= site_url('coupons/add') ?>" class="btn btn-primary pull-right ml"><i class="fa fa-plus"></i> Add</a>
					<div class="col-md-5 pull-right">
						<div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
				            <div class="input-group">
				            	<input type="text" id="coupons_search" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
				            		<button class="btn" type="button"><i class="ti ti-search"></i></button>
				            	</span>
							</div>
			        	</div>
			    	</div>
				</div>
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
										<th>Coupon name</th>
										<th>Discount</th>
										<th>Type</th>
										<th>Code</th>
										<th>Date Start</th>
										<th>Date Expiry</th>
										<th>Enable</th>
										
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($coupons)): foreach($coupons as $coupon): ?>
									<tr>
										<td><input type="checkbox" value="<?= $coupon->c_id ?>" class="delete" name="delete[]"></td>
										<td><?php echo $coupon->coupon_name ?></td>
										<td><?php echo $coupon->discount ?></td>
										<td><?php echo $coupon->type ?></td>
										<td><?php echo $coupon->coupon_code ?></td>
										
										<td><?php echo date('d-m-Y',strtotime($coupon->date_start)) ?></td>
										<td><?php echo date('d-m-Y',strtotime($coupon->date_end)) ?></td>
										<td><?php echo $coupon->status ? 'YES' : 'NO' ?></td>
										<td class="text-right">
											<?php $id = $coupon->c_id; ?>
											<a class="btn btn-primary"href="<?php echo site_url('coupons/edit/'.$id.'') ?>"  >Edit</a>
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">Coupon(s) not available.</td></tr>
									<?php endif; ?>
									
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td colspan="3"></td>
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
        	
			alertify.confirm("Are you sure you want to Delete this City ?", function (result) {
			    if (result) {
					$.ajax({
						url :" <?= site_url('coupons/deletemultiple'); ?>",
						type: "post",
						data:users,
						success:function(data){
							window.location.reload();
						}
					});
       
			    } else {
			       //alert();
			    }
			});
		});

		$('#coupons_search').keyup(function() {
		s = $('#coupons_search').val();
		setTimeout(function() { 
		        if($('#coupons_search').val() == s){ // Check the value searched is the latest one or not. This will help in making the ajax call work when client stops writing.
		            $.ajax({
		                type: "POST",
		                url: "<?php echo site_url('coupons/search') ?>",
		                data: 'search=' + s,
		                cache: false,
		                beforeSend: function() {
		                   // loading image
		                },
		                success: function(data) {
		                	//console.log(data);
		                    // Your response will come here
		                    $('#tbody').html(data);
		                }
		            })
		        }
		    }, 1000); // 1 sec delay to check.
		});
		
	});
</script>

</body>
</html>
