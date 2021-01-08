<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/merchant'); ?>
<div class="static-content-wrapper">
	   <div class="static-content">
			 <div class="page-content">
				<ol class="breadcrumb">
					<li><a href="<?php site_url('index'); ?>">Home</a></li>
					<li><a href="<?php site_url('reports'); ?>">Reports</a></li>
					<li class="active"><a href=""> Tip Reports</a></li>
				</ol> 
				<div class="container-fluid">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-bar-chart"></i> Tip Reports</h3>
						</div>
						<div class="panel-body">
							<div class="well">
								<div class="row">
								
									<form action="<?= site_url('reports/tip_report') ?>" method="get" name="filter">
										
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
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label" for="input-group">Group By</label>
												<select name="group" id="input-group" class="form-control">
													<option value="year" <?php echo $group == 'year' ? 'selected' : '' ?> >Years</option>
													<option value="month" <?php echo $group == 'month' ? 'selected' : '' ?> >Months</option>
													<option value="week" <?php echo $group == 'week' ? 'selected' : '' ?>>Weeks</option>
													<option value="day"  <?php echo $group == 'day' ? 'selected' : '' ?>>Days</option>
												</select>
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
							            <div class="panel panel-default" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
							                <div class="panel-heading">
							                    <h2>Tip Reports</h2>
							                    <div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
							                </div>
							                <div class="panel-body">
							                    <div id="chart-ad" style="height: 300px; padding: 0px; position: relative;"></div>
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
										<th>Tips </th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php foreach ($tips as $t): ?>
									<tr>
										<td><?= $t->date_start ?></td>
										<td><?= $t->date_end ?></td>
										<td>$<?= $t->totaltip ?></td>
									</tr>
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
   
	<script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.time.min.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript">	
    	var data = [];

        
        <?php foreach ($tips as $t){ ?>
            <?php if($mode == 'year'){ ?>    
                data.push(["<?= date('Y', strtotime($t->date_start)) ?>", <?= $t->totaltip ?>]);
            <?php }else if($mode == 'month'){ ?>
                data.push(["<?= date('F, Y', strtotime($t->date_start)) ?>", <?= $t->totaltip ?>]);
            <?php }else if($mode == 'day') { ?>
                data.push(["<?= date('d/m/Y', strtotime($t->date_start)) ?>", <?= $t->totaltip ?>]);
            <?php }else{ ?>
                data.push(["<?= date('d/m/Y', strtotime($t->date_start)).' - '.date('d/m/Y', strtotime($t->date_end)) ?>", <?= $t->totaltip ?>]);
            <?php } ?>
        <?php } ?>
        

        //var data = [ ["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9] ];

        $.plot("#chart-ad", [ data ], {
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
        
        $('#chart-ad').bind('plothover', function(event, pos, item) {
                $('.tooltip').remove();

                if (item) {
                        $('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">Total Tips:$' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');

                        $('#tooltip').css({
                                position: 'absolute',
                                left: item.pageX - ($('#tooltip').outerWidth() / 2),
                                top: item.pageY - $('#tooltip').outerHeight(),
                                pointer: 'cusror'
                        }).fadeIn('slow');	

                        $('#chart-ad').css('cursor', 'pointer');		
                } else {
                        $('#chart-ad').css('cursor', 'auto');
                }
        });
        
        
    </script>
  
</body>
</html>