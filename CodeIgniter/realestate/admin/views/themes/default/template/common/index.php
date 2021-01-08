<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li class=""><a href="">Home</a></li>
				<li class="active"><a href="">Dashboard</a></li>
			</ol>  

			<div class="container-fluid">
						
					<div class="row">
					<form action="<?php echo site_url('index') ?>" method="get">
				       	<div class="col-md-6">
					         <div class="form-group">
								<label class="col-sm-2 control-label">  Date </label>
								<div class="col-sm-10">
									<div class="input-daterange input-group" id="datepicker">
										<input type="text"  value="<?php echo $start ? $start : '' ?>"   class="form-control date" name="start" />
										<span class="input-group-addon">to</span>
										<input type="text" value="<?php echo $end ? $end : '' ?>" class="form-control date" name="end" />
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="col-md-1"><button class="btn btn-primary pull-right" id="filter">Filter</button></div>
				   	</form>    	
				    </div>	
				    <div class="pb"></div>

					<div class="row">
						<div class="col-md-4">
							<div class="info-tile tile-orange" >
								<div class="tile-icon"><i class="ti ti-shopping-cart-full"></i></div>
								<div class="tile-heading"><span>Total Sells</span></div>
								<div class="tile-body"><span><?php echo $totalsoldpro; ?></span></div>
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="info-tile tile-orange" >
								<div class="tile-icon"><i class="fa fa-money"></i></div>
								<div class="tile-heading"><span>Total  Profit</span></div>
								<div class="tile-body"><span>Rs.<?php echo $totalProfit; ?></span></div>
								
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="info-tile tile-orange" >
								<div class="tile-icon"><i class="fa fa-users"></i></div>
								<div class="tile-heading"><span>Total  Customer</span></div>
								<div class="tile-body"><span><?php echo $totalCust ?></span></div>
								
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="info-tile tile-danger" >
								<div class="tile-icon"><i class="ti ti-archive"></i></div>
								<div class="tile-heading"><span>Property For Sale</span></div>
								<div class="tile-body"><span><?php echo $totalsalepro ?></span></div>
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="info-tile tile-orange" >
								<div class="tile-icon"><i class="ti ti-archive"></i></div>
								<div class="tile-heading"><span>Property For Rent</span></div>
								<div class="tile-body"><span><?php echo $totalrentpro ?></span></div>
								
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="info-tile tile-orange" >
								<div class="tile-icon"><i class="ti ti-shopping-cart-full"></i></div>
								<div class="tile-heading"><span>Todays Appointment</span></div>
								<div class="tile-body"><span><?php echo $todaysappointment ?></span></div>
								
							</div>
						</div>

					</div>
					<div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-gray" >
                                <div class="panel-heading">
                                    <h2>Recent Activities</h2>
                                    <div class="panel-ctrls button-icon-bg" >
                                    </div>
                                </div>
                               
                                <div class="panel-body scroll-pane has-scrollbar" style="height: 420px;">
                                    <div class="scroll-content" tabindex="0" style="right: -17px;">
                                        <ul class="mini-timeline">

                                        	<?php foreach ($userActivity as $ua): ?>
                                        	<li class="mini-timeline-lime">
                                                <div class="timeline-icon"></div>
                                                <div class="timeline-body">
                                                    <div class="timeline-content">
                                                      
                                                        <?= ucfirst($ua->act_key) ?> by
                                                          <a href="#" class="name">
                                                        	<?= $ua->first_name.' '.$ua->last_name ?> </a> 
                                                        <span class="time"><?= date('d-m-y g:i:a',strtotime($ua->date_added)) ?></span>

                                                    </div>
                                                </div>
                                            </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                <div class="scroll-track"><div class="scroll-thumb" ></div></div></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="panel panel-blue"  >
                                <div class="panel-heading">
                                    <h2>Appointment </h2>
                                    <div class="panel-ctrls button-icon-bg" >
                                    </div>
                                </div>
                               
                                <div class="panel-body  has-scrollbar" style="height: 320px;">
                                    <table class="table table-striped" >
									<thead>
										<tr>
											<th>#</th>
											<th>Customer Name</th>
											<th>Appointment Date</th>
											<th>Appointment Time</th>
											<th>Appointment Status</th>
											
											<th class="text-right"> Action</th>
											
										</tr>
									</thead>
									<tbody id="tbody">
										<?php if ($appointment): ?>
											<?php foreach ($appointment as $s): ?>
											<tr>
												<td><input type="checkbox" value="<?= $s->appointment_id ?>" class="delete" name="delete[]"></td>
												<td><?php echo $s->first_name.' '.$s->last_name  ?></td>
												<td><?php echo date('d-m-Y',strtotime($s->appointment_date))  ?></td>
												<td><?php echo date('g:i:a',strtotime($s->start_time)).'-'.date('g:i:a',strtotime($s->end_time))  ?></td>
												<td><?php echo $s->appointment_status ?></td>	
												<td class="text-right"><a href="<?php echo site_url('appointment/edit/'.$s->appointment_id.'') ?>" class="btn btn-primary">Edit</a>	</td>
											</tr>
											<?php endforeach ?>
											<?php else: ?>
											<tr>
												<td>No appointment found</td>
											</tr>
											<?php endif ?>
										</tbody>
										
									</table>
                            	</div>
                        	</div>
                    	</div>
                    </div>
			    	
			</div>
		</div>
		<!-- #page-content -->
	</div>
	

<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">	
$(function(){
$('#datepicker').datepicker();
});
</script>
</body>
</html>