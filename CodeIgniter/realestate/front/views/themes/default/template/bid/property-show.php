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
            <h1 class="pag_titl"> Property</h1>
            <h4 class="sub_titl"><?php echo $pro->property_title ?> </h4>
        </div>
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Home </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"> Property Details </p>
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
                            <div class="prop_feat">


                                <p class="area"><i class="fa fa-home"></i> <?php echo $pro->built_up_area ?> Sq.ft</p>
                                <p class="bedrom"><i class="fa fa-bed"></i> <?php echo $pro->beds ?> Bedrooms</p>
                                <p class="bedrom"><i class="fa fa-tint"></i><?php echo $pro->bathrums ?> Bath rooms</p>
                                <p class="category-type"><i class="fa fa-building"></i> <?php echo ucfirst($pro->category) ?></p>
                            </div>

                            <h3 class="sec_titl">
                               <?php echo $pro->property_title ?>
                            </h3>

                            <div class="col_labls larg_labl">

                                <p class="or_labl">For <?php echo ucfirst( $pro->property_action ) ?></p>
                                <p class="blu_labl">Rs.<?php echo  convertNumber($pro->cost) ?></p>

                            </div>

                            <p class="sec_desc">
                                <?php echo $pro->property_content ?>
                            </p>
                            
                            
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

<div id="bid-over-msg" class="modal fade" data-controls-modal="bid-over-msg" aria-hidden="true"
   data-backdrop="static" data-keyboard="false" href="#">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="log_form text-center">
                    <h2 > Bid Time is over </h2>
                    <p>Please See here bid result </p><a href="<?php echo site_url('bid/bidover-property'.$pro->property_slug) ?>"><?php echo ucfirst($pro->property_title) ?></a></a>
                </div>
            </div>
        </div>
    </div>
</div>






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
