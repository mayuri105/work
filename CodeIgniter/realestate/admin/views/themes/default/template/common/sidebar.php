<!-- <div id="wrapper"> -->
	<div id="layout-static">
		<div class="static-sidebar-wrapper sidebar-midnightblue">
			 <div class="static-sidebar">
				<div class="sidebar">
					<div class="widget">
						<div class="widget-body">
							<div class="userinfo">
								
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
								<li><a href="<?php echo site_url('customer'); ?>"><i class="fa fa-users"></i><span>Customer</span></span></a></li>                                   
								<li><a href="<?php echo site_url('appointment'); ?>"><i class="fa fa-calendar"></i><span>Appointment</span></span></a></li>                                   
								
								<li>
									<a href="javascript:;"><i class="fa fa-building"></i><span>Catalog</span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('property'); ?>"><span>Properties</span></a></li>
										<li><a href="<?php echo site_url('categories'); ?>"><span>Categories</span></span></a> </li>
										<li><a href="<?php echo site_url('amenities'); ?>"><span>Amenites</span></a></li>
										<li><a href="<?php echo site_url('attributes'); ?>"><span>Specification Attribute</span></a></li>
										<li><a href="<?php echo site_url('groups'); ?>"><span>Specification Group</span></a></li>
									</ul>
								</li>
								<li><a href="<?php echo site_url('page'); ?>"><i class="fa fa-file"></i><span>Page</span></a></li>
								<li>
									<a href="javascript:;"><i class="fa fa-ticket"></i><span>Package</span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('package'); ?>"><span>Package</span></span></a> </li>
										<li><a href="<?php echo site_url('package_category'); ?>"><span>Package category</span></a></li>
									</ul>
								</li> 
								<li>
									<a href="javascript:;"><i class="fa fa-user"></i><span>User</span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('users'); ?>"><span>Users</span></span></a> </li>
										<li><a href="<?php echo site_url('users_groups'); ?>"><span>User groups</span></a></li>
									</ul>
								</li> 
								
								
								<li>
									<a href="javascript:;"><i class="fa fa-location-arrow"></i><span>Geographical</span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('area'); ?>"><span>Area</span></a></li>
									</ul>
								</li>
								<li>
									<a href="javascript:;"><i class="fa fa-filter"></i><span>Extension</span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('payment'); ?>"><span>Payment</span></a></li>
										<li><a href="<?php echo site_url('module/templates'); ?>"><span>Mail/SMS Template</span></a></li>
										<li><a href="<?php echo site_url('module'); ?>"><span>Modules</span></a></li>	
									</ul>

								</li> 
								<li>
									<a href="javascript:;"><i class="fa fa-cog"></i><span>Others</span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('others/subscribed_package'); ?>"><span>Subscribed Package Details</span></a></li>
										
										<li><a href="<?php echo site_url('others/rentaproperty'); ?>"><span>Rent a Property</span></a></li>
										<li><a href="<?php echo site_url('others/saleaproperty'); ?>"><span>Sale a Property</span></a></li>	
										
										<li><a href="<?php echo site_url('testimonial'); ?>"><span>Testimonial</span></a></li>
										<li><a href="<?php echo site_url('others/clients'); ?>"><span>Clients Images</span></a></li>	
										<li><a href="<?php echo site_url('bid_table'); ?>"><span>Bid Time Table</span></a></li>	
										<li><a href="<?php echo site_url('scheduler'); ?>"><span>Admin Schedular</span></a></li>	
										
									</ul>

								</li> 
								<li>
									<a href="javascript:;"><i class="fa fa-flag-checkered"></i><span>Reports</span></a>
									<ul class="acc-menu">
										<li><a href="<?php echo site_url('reports/rental'); ?>"><span>Rental Property </span></a></li>	
										<li><a href="<?php echo site_url('reports/sold_property'); ?>"><span>Sold Property </span></a></li>	
										<li><a href="<?php echo site_url('reports/subscription'); ?>"><span>Subscription</span></a></li>	
										<li><a href="<?php echo site_url('reports/property'); ?>"><span>Property </span></a></li>	
										
									</ul>

								</li> 
							</ul>
						</nav>

					</div> 
					
				</div>
			</div>
		</div>

