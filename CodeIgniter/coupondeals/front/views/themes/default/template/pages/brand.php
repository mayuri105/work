<!DOCTYPE html>
<html>
<head>
<title>Save TakaTak</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/font.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/font-awesome.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/normalize.css"/>
<!--css plugin-->
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/flexslider.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/jquery.nouislider.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/jquery.popupcommon.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/style.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/res-menu.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/responsive.css"/>
<link href="<?=site_url('front/views/themes/default');?>/asset/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=site_url('front/views/themes/default');?>/asset/css/custom.css" rel="stylesheet">
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/font-awesome-4.0.3/css/font-awesome.min.css">
</head>

<body>
<div class="container-page">
  <div class="mp-pusher" id="mp-pusher"> <?php echo Modules::run('header/header/index'); ?> <?php echo Modules::run('menu/menu/index'); ?>
    <div class="grid_frame page-content">
      <div class="container_grid">
        <div class="container">
          <div class="mod-brands block clearfix">
                    <div class="grid_12">
                        <h3 class="title-block has-link">
                            POPULAR BRANDS
                          
                        </h3>
                    </div>
                    <?php if ($brands): ?>
          
                    <div class="block-content list-brand clearfix">
                     <?php foreach ($brands as $cr): ?>
                        <div class="brand-item grid_4">
                            <div class="brand-content">
                                <div class="brand-logo">
                                    <div class="wrap-img-logo">
                                        <span class="ver_hold"></span>
                                        <a href="<?php echo $cr->brand_link ?>" class="ver_container" target="_blank"><img src="<?= site_url('upload/brandsimages/'.$cr->img_name.'') ?>" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div><!--end: .brand-item -->
                       <?php endforeach ?>
            
                    </div>
                 <ul class="pagination">
                        <?php echo $pagination_helper->create_links(); ?>
                      </ul>
                     <?php endif ?>
                </div>
        </div>
      </div>
    </div>
    <?php echo Modules::run('footer/footer/index'); ?> </div>
</div>
<script src="<?=site_url('front/views/themes/default');?>/asset/js/bootstrap.min.js"></script> 


<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery-1.10.2.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery.flexslider-min.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery.nouislider.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery.popupcommon.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/html5lightbox.js"></script> 

<!--//js for responsive menu--> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/modernizr.custom.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/classie.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/mlpushmenu.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/script.js"></script>
</body>
</html>