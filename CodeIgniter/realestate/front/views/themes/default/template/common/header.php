 <!-- Top Bar -->
    <section class="top_sec">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 top_lft">
                    <div class="soc_ico">
                        <ul>
                            <?php if (isset($googleplus)): ?>
                            <li class="insta">
                                <a href="<?php echo $googleplus?>">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <?php endif?>

                            <?php if (isset($twitter)): ?>

                            <li class="tweet">
                                <a href="<?php echo $twitter?>">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <?php endif?>
                            <?php if (isset($facebook)): ?>
                            <li class="fb">
                                <a href="<?php echo $facebook?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <?php endif?>
                            <?php if (isset($instagram)): ?>
                            <li class="insta">
                                <a href="<?php echo $instagram?>">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                            <?php endif?>
                        </ul>

                    </div>
                </div>
                <!-- /.top-left -->
                <div class="col-xs-12 col-md-6 top_rgt">
                    <?php if (is_login()): ?>
                    <div class="submit_prop nav navbar-nav navbar-right">
                        <button class="subm_btn btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-bars"></i>
                         </button>
                        <ul class="dropdown-menu" id="dropdownMenu1" aria-labelledby="dropdownMenu1">
                            <li><a href="<?php echo site_url('account') ?>">Account</a></li>
                            <li><a href="<?php echo site_url('package') ?>">Package</a></li>
                            <li><a href="<?php echo site_url('login/logout') ?>">Log out</a></li>
                        </ul>
                    </div>

                    <?php else: ?>
                    <div class="sig_in">
                        <p><i class="fa fa-user"></i>
                            <a href="#login_box" class="log_btn" data-toggle="modal"> Sign in </a> or </p>
                    </div>
                    <div class="submit_prop">
                        <h3 class="subm_btn"><a  href="#reg_box" data-toggle="modal">
                            <i class="fa fa-bars"></i>
                            <span>Create Account </span></a>
                        </h3>
                    </div>
                     <?php endif ?>
                </div>
                <!-- /.top-right -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Navigation -->
    <nav class="navbar" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <!-- Logo -->
                <a class="navbar-brand" href="<?php echo site_url()?>">
                    <img src="<?=site_url('front/views/themes/default');?>/assets/images/main-logo.png" alt="logo">
                </a>
                 
            </div>
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
