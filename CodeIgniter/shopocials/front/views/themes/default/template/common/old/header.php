 <header>
                <div class="container">
                    <!-- Site Logo -->
                    <a href="<?php echo site_url('home') ?>" class="site-logo">
                        <i class="gi gi-flash"></i> <strong>nexgi</strong>brand
                    </a>
                    <!-- Site Logo -->

                    <!-- Site Navigation -->
                    <nav>
                        <!-- Menu Toggle -->
                        <!-- Toggles menu on small screens -->
                        <a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm">
                            <i class="fa fa-bars"></i>
                        </a>
                        <!-- END Menu Toggle -->

                        <!-- Main Menu -->
                        <ul class="site-nav">
                            <!-- Toggles menu on small screens -->
                            <li class="visible-xs visible-sm">
                                <a href="javascript:void(0)" class="site-menu-toggle text-center">
                                    <i class="fa fa-times"></i>
                                </a>
                            </li>
                            <!-- END Menu Toggle -->
                            <li class="active">
                                <a href="<?php echo site_url('home') ?>" class="site-nav-sub">Home</a>
                               
                            </li>
                            
                            <li>
                                <a href="<?php echo site_url('how_it_works') ?>">How it works</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('pricing') ?>">Pricing</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('contact') ?>">Contact</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('about') ?>">About</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('merchant/login') ?>" class="btn btn-primary">Log In</a>
                            </li>
                            <li>
                                <a href="<?= site_url('account/register'); ?>" class="btn btn-success">Sign Up</a>
                            </li>
                        </ul>
                        <!-- END Main Menu -->
                    </nav>
                    <!-- END Site Navigation -->
                </div>
            </header>