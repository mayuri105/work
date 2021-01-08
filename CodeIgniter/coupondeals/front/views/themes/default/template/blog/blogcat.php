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
a:active { 
   color: yellow;
}
a {
	color: #000;
}
.col-md-4 img-hover {
	overflow: hidden !important;
	opacity: 0.5;
}
.img-hover img {
	-webkit-transition: all .3s ease; /* Safari and Chrome */
	-moz-transition: all .3s ease; /* Firefox */
	-o-transition: all .3s ease; /* IE 9 */
	-ms-transition: all .3s ease; /* Opera */
	transition: all .3s ease;
}
.img-hover img:hover {
	-webkit-backface-visibility: hidden;
	backface-visibility: hidden;
	-webkit-transform: translateZ(0) scale(1.20); /* Safari and Chrome */
	-moz-transform: scale(1.20); /* Firefox */
	-ms-transform: scale(1.20); /* IE 9 */
	-o-transform: translatZ(0) scale(1.20); /* Opera */
	transform: translatZ(0) scale(1.20);
	overflow: hidden;
}
.grayscale {
	-webkit-filter: brightness(1.10) grayscale(100%) contrast(90%);
	-moz-filter: brightness(1.10) grayscale(100%) contrast(90%);
	filter: brightness(1.10) grayscale(100%);
}
.carousel-caption {
	font-size: 19px;
	text-align: start;
	font-weight: bold;
	z-index: 1;
}
@media screen and (min-width: 993px) {
    .col-md-3 abhi{
        height:328px !important; 
		
    }
}
</style>

</head>
<body>
<div class="container-page">
  <div class="mp-pusher" id="mp-pusher"> <?php echo Modules::run('header/header/blog'); ?> <?php echo Modules::run('header/header/blogmob'); ?>
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
    </div><br>
    <div class="grid_frame page-content">
    
      <div class="container_grid">
       <?php if ($allfeatureblog): ?>
        <div class="row">
         <?php foreach ($allfeatureblog as $ct): ?>
          <div class="col-md-4 img-hover" style="overflow:hidden;"> <a href="<?php echo $ct->blog_slug ?>"><img class="img-responsive img-rounded"  style="width:100%;" src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>">
            <p class="carousel-caption"><?php echo $ct->title ?> </p>
            </a> </div>
          <?php endforeach ?>
          <?php endif ?>
        </div>
        <div class="layout-2cols pt-hight clearfix">
          <div class="grid_8 content">
          <?php if ($blogscat): ?>
            <div class="row">
             <?php foreach ($blogscat as $ct): ?>
              <div class="col-md-3 abhi" style=" height:335px;
   "> 
<img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" style="    height: 143px; width:100%;">
                <h4> <a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?> </a></h4>
                 <?php 
                      $dateTime=$ct->added_date;
					$formattedDate = date("d M /Y", strtotime($dateTime) );
					?>
             <p><?php //echo $ct->author ?> <span><?php echo $formattedDate; ?></span></p>
              </div>
               <?php endforeach ?>
          
            
             
            </div>
             <?php endif ?>
          </div>
           <?php echo Modules::run('blog/blog/sidebar'); ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo Modules::run('footer/footer/index'); ?>
</div>
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