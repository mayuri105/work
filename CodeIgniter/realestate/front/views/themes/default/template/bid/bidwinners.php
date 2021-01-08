<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title ?></title>
    <?php echo Modules::run( 'header/header/css' ) ?>
    <meta itemprop="title" content="<?php echo $meta_titles ?> ">
    <meta itemprop="description" content="<?php echo $meta_descriptions ?>">
    <meta itemprop="keywords" content="<?php echo $meta_keywords ?>">

</head>

<body>
<?php echo Modules::run( 'header/header/index' ); ?>
 <!-- Header bradcrumb -->
 <?php foreach ( $property as $pro ): ?>
    <header class="bread_crumb">
        <div class="pag_titl_sec">
            <h1 class="pag_titl"> Bids Winner</h1>
            <h4 class="sub_titl"><?php echo $pro->property_title ?> </h4>
        </div>
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Home </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"> Bids Winner </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </header>

    <div class="spacer-60"></div>
    <div class="container">
        <div class="row">
            <!-- Proerty Details Section -->
            <section id="prop_detal" class="col-md-8">
                <div class="row">
                    <div class="panel panel-default">
                        <!-- Proerty Slider Images -->

                            
                        
                        <div class="panel-image">
                        <?php if (!empty($pro->images)): ?>   
                            <ul id="prop_slid">
                                <?php foreach ( $pro->images as $img ): ?>
                                <li>
                                    <img class="img-responsive" src="<?php echo getuploadpath().'property/'.$img->image_name; ?>" alt="">
                                </li>
                                <?php endforeach ?>
                            </ul>
                            <!-- Proerty Slider Thumbnails -->
                            <div class="col-md-12 rel_img">
                                <ul id="slid_nav">

                                     <?php $i =0; foreach ( $pro->images as $img ): ?>
                                    <li>
                                        <a data-slide-index="<?php echo $i; ?>" href=""><img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$img->image_name; ?>" alt="">
                                        </a>
                                    </li>
                                    <?php $i++; endforeach ?>
                                </ul>
                            </div>
                            <div class="clearfix"></div>

                        <?php else: ?>
                        <div class="col-md-12 rel_img">
                            <img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$pro->feature_image; ?>" alt="">
                        </div>
                        <?php endif ?>
                        </div>
                       
                        <div class="panel-body">
                            

                            <h3 class="sec_titl">
                               <?php echo $pro->property_title ?>
                            </h3>

                            

                            <p class="sec_desc">
                                <?php echo $pro->property_content ?>
                            </p>
                            <!-- Proerty Additional Info -->
                            <div class="prop_addinfo" id="other_info">
                                <h2 class="add_titl">
                                    Bids Winner
                                </h2>
                                
                                <div class="info_sec first">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                                             No  
                                        </div>
                                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                                             Name   
                                        </div>
                                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                                             Phone   
                                        </div>
                                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                                             Bid Amount   
                                        </div>
                                    </div>
                                    <hr>
                                    <?php $i=1; foreach ($pro->bid as $b ): ?>
                                     <div class="row">
                                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                                             <?php echo $i; ?>  
                                        </div>
                                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                                            <?php echo  $b->first_name.' '.$b->last_name ?>  
                                        </div>
                                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                                            <?php echo  $b->phone ?>  
                                        </div>
                                        <div class="col-md-3 col-sm-2 col-xs-2 ">
                                           <?php echo  $b->amount ?>   
                                        </div>
                                    </div>
                                    <hr>   
                                    <?php $i++; endforeach ?>

                                </div>
                            </div>
                            
                            <div class="spacer-30"></div>
                            
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="spacer-30"></div>
            </section>
            
            <!-- Sidebar Section -->
            
             <section id="sidebar" class="col-md-4">
                <!-- Search Form -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="srch_frm">
                            <h3></h3>
                            <?php echo $sidebar_ads ?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="spacer-30"></div>
                

            </section>
            <div class="spacer-60"></div>

        </div>
    </div>

 <?php endforeach ?>
<?php echo Modules::run( 'footer/footer/index' ); ?>
<script src="<?php echo site_url( 'front/views/themes/default' ); ?>/assets/scripts/jquery.bxslider.min.js"></script>

<!-- Script to Activate the Carousel -->
<script>
    /* Product Slider Codes */
    $(document).ready(function () {
        'use strict';
        $('#prop_slid').bxSlider({
            pagerCustom: '#slid_nav'
        });
    });

</script>

</body>

</html>
