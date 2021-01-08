<html class="csstransforms csstransforms3d csstransitions">
    <head>
        <title>
        <?php echo $page->meta_title ?>
        </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"></meta>
        <meta content="”noodp”" name="”robots”"></meta>

        <meta content="<?php echo $page->meta_name ?>" itemprop="name"></meta>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"></meta>
        <meta content="<?php echo $page->meta_name ?>" itemprop="description"></meta>



        <link href="<?=site_url('front/views/themes/default');?>/assets/css/bootstrap.css" rel="stylesheet"></link>

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800,600" rel="stylesheet" type="text/css"></link>

        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"></link>

        <link href="<?=site_url('front/views/themes/default');?>/assets/css/style.css" id="mainstyle" media="all" rel="stylesheet" type="text/css"></link>
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/jquery.js" type="text/javascript">
        </script>
        <style type="text/css">
        </style>

        <meta content="<?php echo $page->meta_desc?>" name="description"/>
        <meta content="<?php echo $page->meta_keyword ?>" name="keywords"/>
        <link href="<?=site_url('front/views/themes/default');?>/assets/images/favicon.png" rel="icon"/>

        <link href="<?=site_url('front/views/themes/default');?>/assets/css/portfolio-slideshow.css" id="portfolio_slideshow-css" media="screen" rel="stylesheet" type="text/css"></link>
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/jquery.min.js" type="text/javascript">
        </script>
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/jquery.isotope.min.js" type="text/javascript">
        </script>
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/form-validation.js" type="text/javascript">
        </script>
        <meta content="Krafty Solutions" name="generator">
        </meta>

              
    </head>
    <body class="home page page-id-2 page-template page-template-main-php singular two-column right-sidebar">
        <?php echo Modules::run('header/header/index'); ?>
        <?php echo Modules::run('menu/menu/index'); ?>
        <div class="post-content">
            
               
                <?php echo $page->content ?>
                <br>
                
                <?php if ( $page->page_slug == 'careers'): ?>
                                         
                <?php echo Modules::run('careers/careers/index'); ?>
                <?php endif ?>                     
                


                 <?php if ( $page->page_slug == 'clients'): ?>
                                         
                <?php echo Modules::run('clients/clients/index'); ?>
                <?php endif ?>
                

                  
             
               
            
        </div>
        <?php echo Modules::run('footer/footer/index'); ?>
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/jquery.cycle.all.min.js" type="text/javascript">
        </script>
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/portfolio-slideshow.js" type="text/javascript">
        </script>
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/jquery(1).js">
        </script>
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/bootstrap.min.js">
        </script>
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/holder.js">
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
			$(".tooltips").tooltip();
			});
        </script>
        <!-- Contact Scroll -->
        <script src="<?=site_url('front/views/themes/default');?>/assets/javascript/plugins.js">
        </script>
       
        <script type="text/javascript">
            $('.dropdown-toggle').click(function() { $(this).next('.dropdown-menu').slideToggle(500); });
        </script>
    </body>
</html>
