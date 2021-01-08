<!DOCTYPE html>
<html>
<head>
<title>Save TakaTak</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width" />
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<style>
a{
	color:#000;
}
@media only screen and (min-width: 992px) {
   

    .col-md-4 abhi {
        height:290px !important;
    }
}
</style>
      
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
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- First One -->

<ins class="adsbygoogle"
     style="display:block; "
     data-ad-client="ca-pub-7439160288329973"
     data-ad-slot="5814151249"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="grid_frame page-content">
      <div class="container_grid">
                <div class="layout-2cols pt-hight clearfix">
                    <div class="grid_8 content">
                     <?php if ($topblog): ?>
                      <div class="row">
                        
        <?php foreach ($topblog as $ct): ?>
                    
                      <div class="col-md-4 abhi" style="height: 355px;">
                      <?php 
                      $dateTime=$ct->added_date;
					$formattedDate = date("d M /Y", strtotime($dateTime) );
					?>
                      <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%; height:200px;" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
      <p style="margin-top:-7px; color:#000; font-family:'Comic Sans MS', cursive;"><?php //echo $ct->author ?><span> - <?php echo $formattedDate; ?></span></p>
     <!-- <p><?php //echo $ct->short_desc ?></p>-->
                      </div>
                    
                      <?php  endforeach ?>
          
                
                      </div> 
                   <?php endif ?>
                   
                      <div class="col-md-12">
                      <!--mobile-->
                      
                      <!-- ex2-->
                       <?php if ($thblog): ?>
                       <h4><a href="<?=site_url('tech');?>">Tech</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($thblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
     <!-- <p><?php //echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                        <!-- ex2-->
                       <?php if ($mblog): ?>
                       <h4><a href="<?=site_url('mobile');?>">Mobile & Tablet</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($mblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
     <!-- <p><?php //echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                      <!--news-->
                       <?php if ($nblog): ?>
                       
                       <h4><a href="<?=site_url('news');?>">News</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($nblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
     <!-- <p><?php //echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                      
                      <!--ex-->
                      <?php if ($fblog): ?>
                       <h4><a href="<?=site_url('food');?>">Food</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($fblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
     <!-- <p><?php // echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                      
                       <!-- ex2-->
                       <?php if ($tblog): ?>
                       <h4><a href="<?=site_url('tips');?>">Tips</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($tblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
     <!-- <p><?php // echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                       
                         <!-- ex2-->
                       <?php if ($hblog): ?>
                       <h4><a href="<?=site_url('health');?>">Health</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($hblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
     <!-- <p><?php //echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                        <!-- ex2-->
                       <?php if ($sblog): ?>
                       <h4><a href="<?=site_url('shopping');?>">Shopping</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($sblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
    <!--  <p><?php //echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                        <!-- ex2-->
                       <?php if ($fsblog): ?>
                       <h4><a href="<?=site_url('fashion');?>">Fashion & Beauty</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($fsblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
    <!--  <p><?php //echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                        
                       <?php if ($enblog): ?>
                       <h4><a href="<?=site_url('entertainment');?>">Entertainment</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($enblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
     <!-- <p><?php //echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                       <?php if ($lblog): ?>
                       <h4><a href="<?=site_url('lifestyle');?>">Lifestyle</a></h4>
                       <hr>
                       
                       <div class="row">
                       <?php $i =0; foreach ($lblog as $ct): ?>
        <?php if($i == 0) : ?>
                       <div class="col-md-6" style="border-right: 1px solid #dbdbdb;">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" style="width:100%" alt="Image"></a>
      <h4><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h4>
      <!--<p><?php //echo $ct->short_desc ?></p>-->
                       
                       </div>
                        <?php else: ?>
                       <div class="col-md-6">
                       <div class="row">
                       <div class="col-md-12">
                       <div class="row">
                      
                       <div class="col-md-4">
                        <a href="<?php echo $ct->blog_slug ?>"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" class="img-responsive" height="70" width="70" alt="Image"></a>
                        </div>
                       <div class="col-md-8">
                       <h5><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?></a></h5>
    
                       </div>
                       </div>
                        <hr>
                       </div>
                      
                       </div>
                       
                       </div>
                       <?php endif ?>
                        <?php $i++; endforeach ?>
                       </div>
                      <?php endif ?>
                        <!-- ex2-->
                       
                       
                       </div>
                       
                    </div>
                     
                     <div class="grid_4 sidebar">
            
            <div class="mod-simple-coupon block">
              <h3 class="title-block">Latest Blogs</h3>
               <?php if ($allletestblog): ?>
              <div class="block-content">
              
            <?php foreach ($allletestblog as $ct): ?>
                <div class="coupons-code-item simple flex">
                  <div class="brand-logo thumb-left">
                    <div class="wrap-logo">
                      <div class="center-img"> <span class="ver_hold"></span> <a href="<?php echo $ct->blog_slug ?>" class="ver_container"><img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" alt=""></a> </div>
                    </div>
                  </div>
                  <div class="right-content flex-body">
                    <p class="rs save-price"><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?> </a></p>
                  </div>
                </div>
               
                <?php endforeach ?>
          
              </div>
                <?php endif ?>
            </div>
            
          <div class="mod-simple-coupon block">
              <h3 class="title-block">Latest Deals</h3>
               <?php if ($allletesdeal): ?>
              <div class="block-content">
              
            <?php foreach ($allletesdeal as $ct): ?>
                <div class="coupons-code-item simple flex">
                  <div class="brand-logo thumb-left">
                    <div class="wrap-logo">
                      <div class="center-img"> <span class="ver_hold"></span> <a href="<?php echo $ct->deal_slug ?>" class="ver_container"><img src="<?= site_url('upload/dealsimages/'.$ct->img_name.'') ?>" alt=""></a> </div>
                    </div>
                  </div>
                  <div class="right-content flex-body">
                    <p class="rs save-price"><a href="<?php echo $ct->deal_slug ?>"><?php echo $ct->title ?> </a></p>
                  </div>
                </div>
               
                <?php endforeach ?>
          
              </div>
                <?php endif ?>
            </div>
            
          
            <!--<div class="mod-ads"><a href="#"><img src="<?=site_url('front/views/themes/default');?>/asset/images/ex/04-17.jpg" alt="$NAME"/></a></div>-->
            
          </div>
                      </div>
                </div>
            </div>
      </div>
    </div>
     <?php echo Modules::run('footer/footer/index'); ?> </div>
  </div>
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