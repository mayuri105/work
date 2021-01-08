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
  <div class="mp-pusher" id="mp-pusher">
    
    <?php echo Modules::run('header/header/blog'); ?> 
	<?php echo Modules::run('header/header/blogmob'); ?>
    
    
    <div class="top-area">
      <div class="grid_frame">
        <div class="container_grid clearfix">
          <div class="grid_12">
            <h2 class="page-title">Blog</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="grid_frame page-content">
      <div class="container_grid">
        <div class="layout-2cols pt-hight clearfix">
          <div class="grid_8 content">
            <div class="mod-list-article">
              <?php if ($allblog): ?>
              <div class="list-article">
               <?php foreach ($allblog as $cr): ?>
                <div class="article-item"> <a href="<?=site_url($cr->blog_slug.'');?>"><img class="feature-img" src="<?= site_url('upload/blogsimages/'.$cr->img_name.'') ?>" alt="" height="" style="width:100%;"/></a>
                  <div class="flex">
                    <div class="thumb-left wrap-date-post">
                    <?php 
					$dateTime=$cr->added_date;
					$formattedDate = date("d", strtotime($dateTime) );	
					$formattedDate2 = date("M/ Y", strtotime($dateTime) );	?>
                      <div class="date"> <span class="day"><?php echo $formattedDate; ?></span> <span class="my"><?php echo $formattedDate2; ?></span> </div>
                    </div>
                    <div class="flex-body">
                      <p class="art-title rs"><a href="<?=site_url($cr->blog_slug.'');?>"><?php echo $cr->title ?></a></p>
                      <p class="rs art-desc"><?php echo $cr->short_desc ?> ...<a class="btn-more" href="<?=site_url($cr->blog_slug.'');?>" style="color:#0099ff;">Read more</a></p>
                    </div>
                  </div>
                </div>
               
               <?php endforeach ?>
              </div>
               
            
         
                 <td align="center">
                      <ul class="pagination">
                        <?php echo $pagination_helper->create_links(); ?>
                      </ul>
                    </td>
              <!--<div class="pagination"> <a class="page-num active" href="#">1</a> <a class="page-num" href="#">2</a> <a class="page-num" href="#">3</a> <a class="page-num" href="#">4</a> <a class="page-num" href="#">5</a> </div>-->
            </div>
            <?php else: ?>
           <div class="list-article">
          <h4>No Blog Found</h4>
          </div>
          <?php endif ?>
          </div>
         <?php echo Modules::run('blog/blog/sidebar'); ?> </div>
        </div>
      </div>
    </div>
     <?php echo Modules::run('footer/footer/index'); ?> </div>
  </div>
</div>
<script src="<?=site_url('front/views/themes/default');?>/asset/js/bootstrap.min.js"></script> 

<script type="text/javascript">

            var revapi;

            jQuery(document).ready(function() {
                "use strict";
                revapi = jQuery('.tp-banner').revolution(
                        {
                            delay: 15000,
                            startwidth: 1200,
                            startheight: 278,
                            hideThumbs: 10,
                            fullWidth: "on"
                        });

            });	//ready

        </script> 
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