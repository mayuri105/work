<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	   <div class="static-content">
			 <div class="page-content">
				<ol class="breadcrumb">
					<li><a href="<?php site_url('index'); ?>">Home</a></li>
					<li><a href="<?php site_url('reports'); ?>">Report</a></li>
					<li class="active"><a href=""> Sponsored Listing Report</a></li>
				</ol> 
				<div class="container-fluid">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-bar-chart"></i> Sponsored Listing Report</h3>
						</div>
						<div class="panel-body">
							<div class="well">
								<div class="row">
								
									<form action="<?= site_url('reports/sponsored_listing_report') ?>" method="get" name="filter">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input-date-end">Sector</label>
												<select class="form-control" name="sector">
													<option value="">None</option>
													<?php foreach ($store_type as $st): ?>
														<option value = <?= $st->mt_id; ?> <?php echo $sector == $st->mt_id ? 'selected' : '' ?> ><?= ucfirst($st->type); ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label" for="input-group">Group By</label>
												<select name="group" id="input-group" class="form-control">
													<option value="year" <?php echo $group == 'year' ? 'selected' : '' ?> >Years</option>
													<option value="month" <?php echo $group == 'month' ? 'selected' : '' ?> >Months</option>
													<option value="week" <?php echo $group == 'week' ? 'selected' : '' ?>>Weeks</option>
													<option value="day"  <?php echo $group == 'day' ? 'selected' : '' ?>>Days</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input-date-start">Date Start</label>
												<div class="input-group date">
													<input type="text" name="date_start" value="<?php echo $date_start== '01-01-1970' ? '' : $date_start  ?>"  placeholder="Date Start" id="input-date-start" class="form-control">
													<span class="input-group-btn">
															<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
														</span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label" for="input-date-end">Date End</label>
												<div class="input-group date">
													<input type="text" name="date_end" value="<?php echo $date_end== '01-01-1970' ? '' : $date_end  ?>"  placeholder="Date End" id="input-date-end" class="form-control">
													<span class="input-group-btn">
															<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
														</span>
												</div>
											</div>
											<button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
										</div>
										
									</form>
								</div>
								
							</div>

							
							<br>

							<div data-widget-group="group1" class="ui-sortable">
								<div class="row">
									<div class="col-md-12">
							            <div class="panel panel-default" data-widget="{&quot;draggable&quot;: &quot;false&quot;}"  style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
							                <div class="panel-heading">
							                    <h2>Sponsored Listing Report</h2>
							                    <div class="panel-ctrls" ><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
							                </div>
							                <div class="panel-body">
							                    <div id="chart-sale" style="height: 300px; padding: 0px; position: relative;"></div>
							                </div>
							            </div>
							        </div>	

								</div>
							</div>	

							 <table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>Date Start</th>
										<th>Date End</th>
										<th>Total</th> 
									</tr>
								</thead>
								<tbody id="tbody">
										<?php foreach ($ads_order as $ads ): ?>
											<td><?= $ads->date_start ?></td>
											<td><?= $ads->date_end ?></td>
											<td><?= $ads->total ?></td> 
										<?php endforeach ?>
								</tbody>
							
							</table>
						</div>
					</div>
				</div>
			</div>	
	   </div>   
		  
	<?php echo Modules::run('footer/footer/index'); ?>
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.min.js"></script> 
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.resize.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.categories.min.js"></script>
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.orderBars.min.js"></script>  
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.time.min.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript">	
    	 var data = [];
        
        <?php foreach ($ads_order as $order){ ?>
            <?php if($mode == 'year'){ ?>    
                data.push(["<?= date('Y', strtotime($order->date_start)) ?>", <?= $order->total ?>]);
            <?php }else if($mode == 'month'){ ?>
                data.push(["<?= date('F, Y', strtotime($order->date_start)) ?>", <?= $order->total ?>]);
            <?php }else if($mode == 'day') { ?>
                data.push(["<?= date('d/m/Y', strtotime($order->date_start)) ?>", <?= $order->total ?>]);
            <?php }else{ ?>
                data.push(["<?= date('d/m/Y', strtotime($order->date_start)).' - '.date('d/m/Y', strtotime($order->date_end)) ?>", <?= $order->total ?>]);
            <?php } ?>
        <?php } ?>

        //var data = [ ["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9] ];

        $.plot("#chart-sale", [ data ], {
                shadowSize: 0,
                colors: ['#444444'],
                lines: { 
                        show: true
                },
                grid: {
                        backgroundColor: '#FFFFFF',
                        hoverable: true
                },
                points: {
                        show: true
                },
                xaxis: {
                        mode: "categories",
                        tickLength: 0
                }
        });
        
        $('#chart-sale').bind('plothover', function(event, pos, item) {
                $('.tooltip').remove();

                if (item) {
                        $('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">Selling: $' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');

                        $('#tooltip').css({
                                position: 'absolute',
                                left: item.pageX - ($('#tooltip').outerWidth() / 2),
                                top: item.pageY - $('#tooltip').outerHeight(),
                                pointer: 'cusror'
                        }).fadeIn('slow');	

                        $('#chart-sale').css('cursor', 'pointer');		
                } else {
                        $('#chart-sale').css('cursor', 'auto');
                }
        });
        
        
    </script>
   
  
</body>
</html>