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


       

      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
       
    
</head>
<body class="">

<div class="container-page">
    <div class="mp-pusher" id="mp-pusher">
        <?php echo Modules::run('header/header/index'); ?> 
        <?php echo Modules::run('menu/menu/index'); ?>
        <br><br><br><br>
        <div class="grid_frame page-content">
            <div class="container_grid">
             <div class="container">
             
             
             
              <?php echo $privacy->description;?>
             
             
             
             <br><br><br><br><br><br><br><br><br><br><br><br><br>
     
        </div>
            </div>
        </div>
         <?php echo Modules::run('footer/footer/index'); ?> 
    </div>
</div>

<script src="<?=site_url('front/views/themes/default');?>/asset/js/bootstrap.min.js"></script>


        <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
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