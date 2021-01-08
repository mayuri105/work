<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?php echo site_url('reports') ?>">Reports</a></li>
				<li class="active"><a href="">Rental Reports</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
						<div class="panel-body ">
							<div class="">
								<form action="<?= site_url('reports/rental') ?>" method="get" name="filter">
										
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
											
											
										</div>
										<div class="col-sm-6">
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
							<div data-widget-group="group1" class="ui-sortable">
								<div class="row">
									<div class="col-md-12">
							            <div class="panel panel-default" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
							                <div class="panel-heading">
							                    <h2>Property Analysis</h2>
							                   
							                </div>
							                <div class="panel-body">
							                    <div id="piechart"  style="height:500px"></div>
							                </div>
							            </div>
							        </div>	

								</div>
							</div>	
							
						</div>
				</div>	
			</div>
		</div>
		<!-- #page-content -->
	</div>
			   
<?php echo Modules::run('footer/footer/index'); ?>
<?php 
	$hex = array(
    	'0' =>'E45151',
    	'1' =>'61BB57', 
    	'2' =>'8642A0', 
    	'3' =>'086AC1' ,  
    ); ?>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.min.js"></script> 
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.pie.min.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
     
	<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/charts-flot/jquery.flot.symbol.js"></script>
		
   
    <script src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
	
	<script type="text/javascript">


    var dataSet = [
    <?php $i=0; 
    if ($property) {
    foreach ($property as $key => $value): 
    ?>
    {
    	label: "<?= ucfirst($key) ?>", data:<?= $value ?>, 
    	color: "#<?= $hex[$i];?>" 
    },
    <?php $i++; endforeach; 
	}else{ ?>
		{"label":"No Data","data":0  }
	<?php }
   	?>
									
    ];
	var options1 = {
	    series: {
	        pie: {
	            show: true,
	        }
	    },
	    legend: {
        show: false
    }
	};

$(document).ready(function () {
    $.plot($("#piechart"), dataSet, options1);
});

 $('#piechart').bind('plothover', function(event, pos, item) {
                $('.tooltip').remove();

                if (item) {
                        $('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');

                        $('#tooltip').css({
                                position: 'absolute',
                                left: item.pageX - ($('#tooltip').outerWidth() / 2),
                                top: item.pageY - $('#tooltip').outerHeight(),
                                pointer: 'cusror'
                        }).fadeIn('slow');	

                        $('#piechart').css('cursor', 'pointer');		
                } else {
                        $('#piechart').css('cursor', 'auto');
                }
        });
</script>
  
</body>
</html>

