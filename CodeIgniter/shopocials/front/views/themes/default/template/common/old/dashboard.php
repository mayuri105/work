<!DOCTYPE html>
 <html class="no-js" lang="en"> 
    <head>
        <meta charset="utf-8">

        <title>demo</title>

        <meta name="description" content="">
        <meta name="title" content="">
        <meta name="robots" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        
        <link rel="shortcut icon" href="<?= site_url('front/views/themes/default'); ?>/img/favicon.png">
        <link rel="apple-touch-icon" href="<?= site_url('front/views/themes/default'); ?>/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?= site_url('front/views/themes/default'); ?>/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?= site_url('front/views/themes/default'); ?>/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?= site_url('front/views/themes/default'); ?>/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?= site_url('front/views/themes/default'); ?>/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?= site_url('front/views/themes/default'); ?>/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?= site_url('front/views/themes/default'); ?>/img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="<?= site_url('front/views/themes/default'); ?>/img/icon180.png" sizes="180x180">
      
        <link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/css/bootstrap.min.css">

      
        <link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/css/plugins.css">

       
        <link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/css/main.css">

        <link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/css/themes.css">
       
        <script src="<?= site_url('front/views/themes/default'); ?>/js/vendor/modernizr.min.js"></script>
    </head>
    <body>
        
        <div id="page-container">
           
           <?php echo Modules::run('header/header/index'); ?>

           
            <div id="home-carousel" class="carousel carousel-home slide" data-ride="carousel" data-interval="5000">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    
                    
                    <div class="active item">
                        <section class="site-section site-section-light site-section-top themed-background-dark-amethyst">
                            <div class="container">
                                <h1 class="text-center animation-hatch hidden-xs"><strong><?= $shop_name ?></strong></h1>
                               
                            </div>
                        </section>
                    </div>
                    
            
           

          
           

           
            <?php echo Modules::run('footer/footer/index'); ?>
            
        </div>
        

        
        <a href="#" id="to-top"><i class="fa fa-angle-up"></i></a>

      
        <script src="<?= site_url('front/views/themes/default'); ?>/js/vendor/jquery.min.js"></script>
        <script src="<?= site_url('front/views/themes/default'); ?>/js/vendor/bootstrap.min.js"></script>
        <script src="<?= site_url('front/views/themes/default'); ?>/js/plugins.js"></script>
        <script src="<?= site_url('front/views/themes/default'); ?>/js/app.js"></script>
    </body>
</html>