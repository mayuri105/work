<div id="wrapper">
    <div id="layout-static">
        <div class="static-sidebar-wrapper sidebar-midnightblue">
             <div class="static-sidebar">
                <div class="sidebar">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="userinfo">
                                    <span class="username"><?php echo ucfirst($this->session->userdata('username')); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="widget stay-on-collapse" id="widget-sidebar">
                        <nav role="navigation" class="widget-body">
                            <ul class="acc-menu">
                                <li class="nav-separator"><span>Explore</span></li>
                                <li><a href="<?php echo site_url('index'); ?>"><i class="ti ti-home"></i><span>Dashboard</span></a></li>
                                <li><a href="<?php echo site_url('store'); ?>"><i class="ti ti-archive"></i><span>Store</span></a></li>
                                <li><a href="<?php echo site_url('products'); ?>"><i class="fa fa-tags"></i><span>Products</span></a></li>
                                <li><a href="<?php echo site_url('orders'); ?>"><i class="fa fa-ticket"></i><span>Orders</span></a></li>
                                <li><a href="<?php echo site_url('index/profilesetting'); ?>"><i class="fa fa-gears"></i><span>Profile Setting</span></a></li>
                                <li><a href="javascript:;"><i class="fa fa-bar-chart-o"></i><span>Reports</span></span></a>
                                    <ul class="acc-menu">
                                        <li><a href="<?php echo site_url('reports/sector_sale'); ?>"><span>Sector Sale</span></a></li>
                                        <li><a href="<?php echo site_url('reports/sale_report'); ?>"><span>Sale Report</span></a></li>
                                        <li><a href="<?php echo site_url('reports/order_report'); ?>"><span>Sub-Order Report</span></a></li>
                                        <li><a href="<?php echo site_url('reports/product_purchased_report'); ?>"><span>Purchased Report</span></a></li>
                                        <li><a href="<?php echo site_url('reports/commission_report'); ?>"><span>Commission Reports</span></a></li>
                                       <li><a href="<?php echo site_url('reports/tip_report'); ?>"><span>Tip Report</span></a></li>
                                        

                                    </ul>

                                </li>   
                            </ul>
                        </nav>
                    </div> 
                </div>
            </div>
        </div>