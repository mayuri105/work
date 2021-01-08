<div id="wrapper">
	<div id="layout-static">
		<div class="static-sidebar-wrapper sidebar-midnightblue">
			 <div class="static-sidebar">
				<div class="sidebar">
					<div class="widget">
						<div class="widget-body">
							<div class="userinfo">
								<div class="avatar">
									<img src="" class="img-responsive img-circle">
								</div>
								<div class="info">
									<span class="username"><?php echo ucfirst($this->session->userdata('username')); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="widget stay-on-collapse" id="widget-sidebar">
						<nav role="navigation" class="widget-body">
							<ul class="acc-menu">
								<li class="nav-separator"><span>Explore</span></li>
								<li><a href="<?php echo site_url('index'); ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
								<li>
									<a href="javascript:;"><i class="fa fa-user"></i><span>User</span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('users'); ?>"><span>Users</span></span></a> </li>
										<li><a href="<?php echo site_url('users_groups'); ?>"><span>User groups</span></a></li>
									</ul>

								</li> 
								<li><a href="<?php echo site_url('customer'); ?>"><i class="fa fa-users"></i><span>Customer</span></span></a></li>                                   
								<li><a href="<?php echo site_url('merchant'); ?>"><i class="fa fa-archive"></i><span>Merchant</span></span></a></li>
								<li><a href="<?php echo site_url('store'); ?>"><i class="fa fa-shopping-cart"></i><span>Store</span></span></a></li>                                   
								<li><a href="<?php echo site_url('products'); ?>"><i class="fa fa-tags"></i><span>Product</span></span></a></li>
								<li><a href="<?php echo site_url('orders'); ?>"><i class="fa fa-ticket"></i><span>Orders</span></a></li>
								<li><a href="<?php echo site_url('adspackage/orders'); ?>"><i class="fa fa-ticket"></i><span>Ads Request Orders</span></a></li>

								<li><a href="<?php echo site_url('page'); ?>"><i class="fa fa-file"></i><span>Page</span></span></a></li>                                   
								<li><a href="javascript:;"><i class="fa fa-building-o"></i><span>Others</span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('city'); ?>"><span>City</span></a></li>
										<li><a href="<?php echo site_url('state'); ?>"><span>State</span></a></li>
										<li><a href="<?php echo site_url('cuisine'); ?>"></i><span>Cuisine</span></a></li>
										<li><a href="<?php echo site_url('category'); ?>"></i><span>Category</span></a></li>
										<li><a href="<?php echo site_url('rewardbucket'); ?>"></i><span>Reward Bucket</span></a></li>
										<li><a href="<?php echo site_url('coupons'); ?>"></i><span>Coupons</span></a></li>
									</ul>
								</li>
								<li>
									<a href="javascript:;">
										<i class="fa fa-gear"></i><span>Settings</span></span>
									</a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('settings'); ?>"><span>Settings</span></a></li>
										<li><a href="<?php echo site_url('settings/mailtemplate'); ?>"><span>Mail templates</span></a></li>
										<li><a href="<?php echo site_url('payments'); ?>"><span>Payments</span></a></li>
										<li><a href="<?php echo site_url('adspackage'); ?>"><span>Ads Package</span></a></li>
										
									</ul>
								</li>                                   
								<li><a href="javascript:;"><i class="fa fa-bar-chart-o"></i><span>Reports</span></span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('reports/sector_sale'); ?>"><span>Sector Sale</span></a></li>
										<li><a href="<?php echo site_url('reports/sale_report'); ?>"><span>Sale Report</span></a></li>
										<li><a href="<?php echo site_url('reports/order_report'); ?>"><span>Order Report</span></a></li>
										<li><a href="<?php echo site_url('reports/product_purchased_report'); ?>"><span>Purchased Report</span></a></li>
										<li><a href="<?php echo site_url('reports/sponsored_listing_report'); ?>"><span>Sponsored Listing</span></a></li>
										<li><a href="<?php echo site_url('reports/commission_report'); ?>"><span>Commission Reports</span></a></li>
										<li><a href="<?php echo site_url('reports/coupon_report'); ?>"><span>
										Coupons Report</span></a></li>
										<li><a href="<?php echo site_url('reports/tip_report'); ?>"><span>Tip Report</span></a></li>
										<li><a href="<?php echo site_url('reports/profit_report'); ?>"><span>Profit Report</span></a></li>
										<li><a href="<?php echo site_url('reports/customer_orders_report'); ?>"><span>
											Customer Orders Report</span></a></li>

									</ul>

								</li>                                   
							</ul>
						</nav>

					</div> 
					<div class="widget" id="widget-progress">
                            <div class="widget-heading">
                                Progress
                            </div>
                            <div class="widget-body">

                                <div class="mini-progressbar">
                                    <div class="clearfix mb-sm">
                                        <div class="pull-left">Orders Compelted</div>
                                        <div class="pull-right"><?= ceil($comp_percent) ?>%</div>
                                    </div>

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" style="width: <?= $comp_percent ?>%"></div>
                                    </div>
                                </div>
                                <div class="mini-progressbar">
                                    <div class="clearfix mb-sm">
                                        <div class="pull-left">Orders Processing</div>
                                        <div class="pull-right"><?= ceil($processing_percent) ?>%</div>
                                    </div>

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" style="width: <?= $processing_percent ?>%"></div>
                                    </div>
                                </div>
                                <div class="mini-progressbar">
                                    <div class="clearfix mb-sm">
                                        <div class="pull-left">Other Statuses</div>
                                        <div class="pull-right"><?= ceil($other_percent) ?>%</div>
                                    </div>

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" style="width: <?= $other_percent ?>%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
				</div>
			</div>
		</div>