<!DOCTYPE html>
<html class="no-js" lang="en">
<?php echo Modules::run('header/header/head'); ?>
<body>
<div id="page-wrapper">
    <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
        <?php echo Modules::run('sidebar/sidebar/index'); ?>
        <div id="main-container">
         <?php echo Modules::run('header/header/index'); ?>
         <div id="page-content">
            <div class="content-header">
                <div class="header-section">
                    <h1>
                        <i class="gi gi-brush"></i>Welcome<br><small>Shopocial</small>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <!-- Widget -->
                    <a href="#" class="widget widget-hover-effect1">
                        <div class="widget-simple">
                            <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <h3 class="widget-content text-right animation-pullDown">
                                11 <strong>Marketer</strong><br>
                                <small>New Registration</small>
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <!-- Widget -->
                    <a href="#" class="widget widget-hover-effect1">
                        <div class="widget-simple">
                            <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                                <i class="gi gi-usd"></i>
                            </div>
                            <h3 class="widget-content text-right animation-pullDown">
                                + <strong>2</strong><br>
                                <small> New Orders Today</small>
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <!-- Widget -->
                    <a href="#" class="widget widget-hover-effect1">
                        <div class="widget-simple">
                            <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
                                <i class="gi gi-envelope"></i>
                            </div>
                            <h3 class="widget-content text-right animation-pullDown">
                                55 <strong>Product</strong>
                                <small>Share Today </small>
                            </h3>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="#" class="widget widget-hover-effect1">
                        <div class="widget-simple">
                            <div class="widget-icon pull-left themed-background-amethyst animation-fadeIn">
                                <i class="gi gi-picture"></i>
                            </div>
                            <h3 class="widget-content text-right animation-pullDown">
                                +30 <strong>New Products</strong>
                                <small>View All</small>
                            </h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php echo Modules::run('footer/footer/index'); ?>
    </div>
</div>
</div>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
</body>
</html>