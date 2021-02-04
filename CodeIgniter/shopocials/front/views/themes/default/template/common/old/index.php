<!DOCTYPE html>
 <html class="no-js" lang="en"> 
    <head>
        <meta charset="utf-8">

        <title><?= $title ?></title>

        <meta name="description" content="<?= $meta_descriptions ?>">
        <meta name="title" content="<?= $meta_titles ?>">
        <meta name="robots" content="noindex, nofollow">

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
                                <h1 class="text-center animation-hatch hidden-xs"><strong>Fully Responsive and Retina Ready</strong></h1>
                                <h2 class="text-center animation-hatch push hidden-xs">The UI will look great and crisp</h2>
                                <p class="text-center animation-hatch">
                                    <img src="<?= site_url('front/views/themes/default'); ?>/img/placeholders/screenshots/promo_mobile.png" alt="Promo Image 3">
                                </p>
                            </div>
                        </section>
                    </div>
                    
            
            <section class="site-content site-section site-slide-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInRight" data-element-offset="-180">
                            <img src="<?= site_url('front/views/themes/default'); ?>/img/placeholders/screenshots/promo_tablet.png" alt="Promo #3" class="img-responsive">
                        </div>
                        <div class="col-sm-6 col-md-5 col-md-offset-1 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInLeft" data-element-offset="-180">
                            <h3 class="h2 site-heading site-heading-promo"><strong>Fully</strong> Responsive</h3>
                            <p class="promo-content">The User Interface will just work in mobile phones, tablets, laptops and desktops. You can focus on creating the project you want. <a href="<?= site_url('how_it_works'); ?>">Learn More..</a></p>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            

          
            <section class="site-content site-section">
                <div class="container">
                    <!-- Testimonials Carousel -->
                    <div id="testimonials-carousel" class="carousel slide carousel-html" data-ride="carousel" data-interval="4000">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#testimonials-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#testimonials-carousel" data-slide-to="1"></li>
                            <li data-target="#testimonials-carousel" data-slide-to="2"></li>
                        </ol>
                        <!-- END Indicators -->

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner text-center">
                            <div class="active item">
                                <p>
                                    <img src="<?= site_url('front/views/themes/default'); ?>/img/placeholders/avatars/avatar12.jpg" alt="Avatar" class="img-circle">
                                </p>
                                <blockquote class="no-symbol">
                                    <p>An awesome team that brought our ideas to life! Highly recommended!</p>
                                    <footer><strong>Sophie Illich</strong>, example.com</footer>
                                </blockquote>
                            </div>
                            <div class="item">
                                <p>
                                    <img src="<?= site_url('front/views/themes/default'); ?>/img/placeholders/avatars/avatar7.jpg" alt="Avatar" class="img-circle">
                                </p>
                                <blockquote class="no-symbol">
                                    <p>I have never imagined that our final product would look that good!</p>
                                    <footer><strong>David Cull</strong>, example.com</footer>
                                </blockquote>
                            </div>
                            <div class="item">
                                <p>
                                    <img src="<?= site_url('front/views/themes/default'); ?>/img/placeholders/avatars/avatar9.jpg" alt="Avatar" class="img-circle">
                                </p>
                                <blockquote class="no-symbol">
                                    <p>An extraordinary service that helped us grow way too fast!</p>
                                    <footer><strong>Nathan Brown</strong>, example.com</footer>
                                </blockquote>
                            </div>
                        </div>
                       
                    </div>
                   
                </div>
            </section>
            
            <section class="site-content site-section themed-background">
                <div class="container">
                   
                    <div class="row" id="counters">
                        <div class="col-sm-4">
                            <div class="counter site-block">
                                <span data-toggle="countTo" data-to="6800" data-after="+"></span>
                                <small>Projects</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="counter site-block">
                                <span data-toggle="countTo" data-to="5500" data-after="+"></span>
                                <small>Happy Customers</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="counter site-block">
                                <span data-toggle="countTo" data-to="100" data-after="+"></span>
                                <small>New Accounts Today</small>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </section>
           

           
            <?php echo Modules::run('footer/footer/index'); ?>
            
        </div>
        

        
        <a href="#" id="to-top"><i class="fa fa-angle-up"></i></a>

      
        <script src="<?= site_url('front/views/themes/default'); ?>/js/vendor/jquery.min.js"></script>
        <script src="<?= site_url('front/views/themes/default'); ?>/js/vendor/bootstrap.min.js"></script>
        <script src="<?= site_url('front/views/themes/default'); ?>/js/plugins.js"></script>
        <script src="<?= site_url('front/views/themes/default'); ?>/js/app.js"></script>
    </body>
</html>