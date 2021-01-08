<!DOCTYPE html>

<html itemscope itemtype="https://schema.org/Product">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title ?> | <?php echo $page->title ?></title>
   	<?php echo Modules::run('header/header/css') ?>
 	<meta itemprop="keywords" content=" <?php echo $page->meta_keywords ?>">
    <meta itemprop="description" content="<?php echo $page->meta_description ?>">
	<meta itemprop="title" content="<?php echo $page->title?>">
	
</head>
<body>
<?php echo Modules::run('header/header/index'); ?>

    <!-- Header bradcrumb -->
    <header class="bread_crumb">
        <div class="pag_titl_sec">
            <h1 class="pag_titl"> <?php echo $page->title ?></h1>
            <h4 class="sub_titl"></h4>
        </div>
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Home </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"><?php echo $page->title ?> </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Go Back to Home </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="spacer-60"></div>
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <section id="contact_sec" class="col-md-8">
               <div class="row skill_sec">
                   
                    <div class="col-xs-12 skill_ara">
                        <?php echo $page->content ?>
                    </div>
                </div>
               
            </section>
            <!-- Sidebar Section -->
            <section id="sidebar" class="col-md-4">
                <!-- Contact Information -->
                <div class="row">
                    <div class="titl_sec">
                        <div class="col-lg-12">

                            <h3 class="main_titl text-left">
                                 <?php echo $company_name ?>
                            </h3>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="cont_info">
                        <div class="info_sec first">
                            <div class="icon_box">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <p class="infos"> 
                             <?php echo nl2br($address) ?></p>
                        </div>

                        <div class="info_sec">
                            <div class="icon_box">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <p class="infos"><a href="mailto:<?php echo $email_address ?>?Subject=Contact%20from%20labhchar-%20enquiry"> <?php echo $email_address ?> </a>
                            </p>
                        </div>

                        <div class="info_sec">
                            <div class="icon_box">
                                <i class="fa fa-phone"></i>
                            </div>
                            <p class="infos"> <a href="tel:<?php echo $phone ?>"> <?php echo $phone ?> </a> </p>
                        </div>

                        <div class="info_sec">
                            <div class="icon_box">
                                <i class="fa fa-facebook"></i>
                            </div>
                            <p class="infos"><?php echo $facebook ?></p>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </section>
            <div class="spacer-60"></div>

        </div>
    </div>
<?php echo Modules::run('footer/footer/index'); ?>
