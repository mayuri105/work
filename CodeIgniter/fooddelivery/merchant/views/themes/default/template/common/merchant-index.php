<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/merchant'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
			<ol class="breadcrumb">
				<li class=""><a href="">Home</a></li>
				<li class="active"><a href="">Dashboard</a></li>
			</ol>  

			  <div class="container-fluid">
			  		
				    <div class="row">
				        <div class="col-sm-4">
				            <div class="form-group">
				                <div class="input-group date">
				                    <input type="text" name="startdate" value="<?= $this->session->startdate ?>" placeholder="Date Started" id="startdate" class="form-control">
				                    <span class="input-group-btn">
										<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
				            </div>
				        </div>
				       
				        <div class="col-sm-4">
				        	<div class="form-group">
				                <div class="input-group date">
				                	<button class="btn btn-primary" id="filter">Filter</button>
				                 </div>
				            </div>
				        </div>

				    </div>
					<div class="row">
						<div class="col-md-3">
							<div class="info-tile tile-orange" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
								<div class="tile-icon"><i class="ti ti-shopping-cart-full"></i></div>
								<div class="tile-heading"><span>Orders</span></div>
								<div class="tile-body"><span><?= $total_order; ?></span></div>
								
							</div>
						</div>
						<div class="col-md-3">
							<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
								<div class="tile-icon"><i class="fa fa-bar-chart"></i></div>
								<div class="tile-heading"><span>Total Sales</span></div>
								<div class="tile-body"><span>$<?= $totalAmount->total  ?></span></div>
								
							</div>
						</div>
						<div class="col-md-3">
							<div class="info-tile tile-danger" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
								<div class="tile-icon"><i class="fa fa-users"></i></div>
								<div class="tile-heading"><span>Total Stores</span></div>
								<div class="tile-body"><span><?= $totalStore ?></span></div>
								
							</div>
						</div>
						<div class="col-md-3">
							<div class="info-tile tile-orange" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
								<div class="tile-icon"><i class="fa fa-users"></i></div>
								<div class="tile-heading"><span>Total Customers</span></div>
								<div class="tile-body"><span><?= $totalcustomer; ?></span></div>
								
							</div>
						</div>
						
					</div>
					<div class="row">
						
						
					</div>

					


					<div data-widget-group="group1" class="ui-sortable">
						<div class="row">
							<div class="col-md-12">
					            <div class="panel panel-default" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
					                <div class="panel-heading">
					                    <h2>Sales Analysis</h2>
					                    <div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
					                </div>
					                <div class="panel-body">
					                    <div id="chartdata" style="height: 300px; padding: 0px; position: relative;"></div>
					                </div>
					            </div>
					        </div>	

						</div>
					</div>	
					<div class="row">
                        
                        <div class="col-md-12">
                            <div class="panel panel-blue" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                                <div class="panel-heading">
                                    <h2>Recent Orders</h2>
                                    <div class="panel-ctrls button-icon-bg" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}" data-action-colorpicker="" data-action-refresh-demo="{&quot;type&quot;: &quot;circular&quot;}">
                                    </div>
                                </div>
                               
                                <div class="panel-body scroll-pane has-scrollbar" style="height: 320px;">
                                    <div class="scroll-content" tabindex="0" style="right: -17px;">
                                        <table class="table table-striped" id="aftersearch">
										<thead>
											<tr>
												<th>#</th>
												<th>Customer</th>
												<th>Order Status</th>
												<th>Payment Type</th>
												<th>Total Amt</th>
												<th class="text-right">Action</th>
											</tr>
										</thead>
										<tbody id="tbody">
											<?php $i= 1; if(!empty($orders)): foreach($orders as $order): ?>
											<tr>

												<td><?= $i; ?></td>
												<td><?php echo $order->first_name.' '.$order->last_name ?></td>
												<td><?php echo $order->name ?></td>
												<td><?php echo str_replace('paying-',' ', $order->payment_method) ?></td>
												<td><?php echo $order->total_amt ?></td>
												<td class="text-right">
													<?php $id = $order->o_id; ?>
													<a href="<?php echo site_url('orders/view/'.$id.'') ?>" class="btn btn-primary">View Order</a>
													<a href ="<?php echo site_url('orders/edit/'.$id.'') ?>" class="btn btn-primary">Edit</a>
												</td>
											</tr>
											<?php $i++;endforeach; else: ?>
											<tr class="err_msg"><td colspan="5">Order(s) not available.</td></tr>
											<?php endif; ?>
											
										</tbody>
										
									</table>
                                    </div>
                            	</div>
                        	</div>
                    	</div>
                    </div>	
				</div>
		</div>
       	
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.min.js"></script> 
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.orderBars.min.js"></script>  
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.resize.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.time.min.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    

    <script type="text/javascript">	
    	var order = <?= $chartdata ?>;
    	var customer = <?= $chartdatacust ?>;
        //var dataset = [{label: "Revenues",data: order}];
 		var dataset = [
		    {
		        label: "Orders",
		        data: order,
		       	
		    },
		    {
		        label: "Customer",
		        data: customer,
		       
		    }
		];	
        var options = {
            series: {
                lines: { show: true },
                points: {
                    radius: 3,
                    show: true
                }
            },
	        xaxis: {
		        mode: "time",
		        timeformat: "%Y/%m/%d"
		    }
        };

        $(document).ready(function () {
            $.plot($("#chartdata"), dataset, options);
            $('#startdate').datepicker({})
        });
        $('#filter').click(function(){
        	var data = {
			startdate :  $('#startdate').val()
			};
			$.ajax({
				url : "<?php echo site_url('index/setFilter') ?>",
				type: "POST",
				data: data,
				success:function(data){
					window.location.reload();
				}
			});
        });
    </script>
</body>
</html>