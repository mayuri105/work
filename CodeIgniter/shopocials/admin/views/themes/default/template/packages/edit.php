<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">

    <title>Make brand Merchant Home</title>

    <meta name="description" content="Make brand Merchant Home">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


    <link rel="shortcut icon" href="<?= site_url('views/themes/default') ?>/assets/img/favicon.png">
    <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon180.png" sizes="180x180">



    <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/bootstrap.min.css">


    <link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/bootstrap-multiselect/css/bootstrap-multiselect.css">


    <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/plugins.css">


    <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/main.css">


    <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/themes/amethyst.css">

    <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/modernizr.min.js"></script>
</head>
<body>

    <div id="page-wrapper">

        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">



            <?php echo Modules::run('sidebar/sidebar/index'); ?>

            <div id="main-container">

             <?php echo Modules::run('header/header/index'); ?>



             <div id="page-content">

                <!--<div class="content-header">
                    <div class="header-section">
                        <h1>
                            <i class="gi gi-brush"></i>Blank<br><small>A clean page to help you start!</small>
                        </h1>
                    </div>
                </div>-->
                <ul class="breadcrumb breadcrumb-top">
                    <li>Packages</li>
                    <li>Edit Package </li>
                    
                </ul>
                
               
<div class="block">
                            
                
                
                                
                
                <div class="panel panel-inverse">
                    <div class="panel-body">


                 <?php echo Modules::run('messages/message/index'); ?>


                   <?php 
                   $attributes = array('class' => 'form-horizontal', 'id' => 'pages');

                   echo form_open_multipart('packages/update', $attributes);  ?>
									
								
							<input type="hidden" name="package_id" value="<?php echo $package->package_id; ?>" class="form-control">

								<div class="col-md-8">
									<label class="control-label">Name</label>
									
										<input type="text" name="package_name" value="<?= $package->package_name; ?>" class="form-control">
									</div>
								
								
								
								
								<div class="col-md-8">
									<label class="control-label">Price</label>
									
										<input  type="text"  name="package_price" class="form-control" value="<?php echo $package->package_price; ?>">

									</div>
								<div class="col-md-8">
									<label class="control-label">Periods (months)</label>
									
										<input type="text"  name="package_periods" class="form-control" value="<?php echo $package->package_periods; ?>">
									</div>
								
								<div class="col-md-8">
<br>
<br>
<br>
<br>
									<a href="<?= site_url('packages') ?>" class="btn btn-default" >Close</a>
									
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
								
											
							</form>
					</div>

</div>

</div>



<?php echo Modules::run('footer/footer/index'); ?>

</div>

</div>

</div>


<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/jqueryui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>

<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>


<!-- The Canvas to Blob plugin is included for image resizing functionality -->


</body>
</html>
