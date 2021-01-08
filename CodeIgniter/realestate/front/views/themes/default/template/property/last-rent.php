<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>
        <?php echo $title ?>
    </title>
    <?php echo Modules::run('header/header/css') ?>
    <link href="<?= site_url('front/views/themes/default'); ?>/assets/scripts/countdown/TimeCircles.css" rel="stylesheet">
    <meta itemprop="title" content="<?php echo $meta_titles ?> ">
    <meta itemprop="description" content="<?php echo $meta_descriptions ?>">
    <meta itemprop="keywords" content="<?php echo $meta_keywords ?>">

</head>

<body>

    <?php echo Modules::run('header/header/index'); ?>

    <img src="<?=site_url('front/views/themes/default');?>/assets/images/hindi-logo.png" id="right-logo" class="pull-right" alt="logo">

    <img src="<?=site_url('front/views/themes/default');?>/assets/images/guj-logo.png" id="left-logo" class="pull-left" alt="logo">
    <div class="container">
        <div class="row">
            <!-- Properties Section -->
            <section id="feat_propty">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h3 class="text-center">Last 10 Rent Property</h3>
                             <div class="spacer-20"></div>
                        </div>
                        <?php if (!$properties): ?>

                        <?php else: ?>

                        <?php foreach ($properties as $p): ?>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-image">
                                    <img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$p->feature_image; ?>" alt="">
                                    <div class="img_hov_eff">

                                        <?php if (is_login()): ?>
                                        <?php if (checkPackage('1')): ?>

                                        <a class="btn btn-default btn_trans" href="<?php echo site_url('rent-sale/property/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                        <?php else: ?>

                                        <a class="btn btn-default btn_trans" href="<?php echo site_url('package') ?>?id=1" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>

                                        <?php endif ?>
                                        <?php else: ?>

                                        <a class="btn btn-default btn_trans" data-toggle="modal" href="#login_box" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>

                                        <?php endif ?>
                                    </div>

                                </div>
                                <div class="sal_labl">
                                    Rent
                                </div>

                                <div class="panel-body">
                                    <div class="prop_feat">
                                        <p class="area"><i class="fa fa-home"></i>
                                            <?php echo $p->built_up_area ?> Sq.ft</p>
                                        <p class="category-type"><i class="fa fa-building"></i> <?php echo ucfirst($p->category) ?></p>
                                

                                    

                                    </div>
                                    <h3 class="sec_titl">
                                                    <?php echo ucfirst($p->property_title) ?>
                                                </h3>

                                    <p class="sec_desc">
                                        <?php echo ucfirst(summary($p->property_small_desc)) ?>
                                    </p>

                                    <div class="panel_bottom">
                                        <div class="spacer-10"></div>
                                        <div class="col-md-6">
                                            <strong>Rent:</strong>
                                            <?php echo $p->first_name.' '.$p->last_name ?>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Phone:</strong>
                                            <?php echo $p->phone ?>
                                        </div>
                                    </div>
                                   <div class="price">
                                        <strong>  Rs. <?php echo  convertNumber($p->cost) ?></strong>
                                    </div>
                                    <div class="properties-actions">
                                        <?php if (is_login()): ?>
                                        <?php if (checkPackage('1')): ?>

                                        <a href="<?php echo site_url('rent-sale/property/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                        <?php else: ?>

                                        <a href="<?php echo site_url('package') ?>?id=1" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>

                                        <?php endif ?>
                                        <?php else: ?>

                                        <a data-toggle="modal" href="#login_box" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>

                                        <?php endif ?>
                                        <div class="spacer-10"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <?php endforeach ?>

                        <?php endif; ?>

                    </div>


                    <!-- /.row -->
                    <div class="spacer-40"></div>
                    <!-- Pagination -->

                    <div class="pagin">
                        <!--  -->
                    </div>

                </div>
                <!-- /.container -->
            </section>
            <div class="spacer-60"></div>

        </div>
    </div>

   
    <section id="testim">
        <div class="container">

            <div class="col-md-6 text-center">
                <a href="<?php echo site_url('rent-sale') ?>" class="subscribe btn  btn-lg btn-danger">Rent/Sale</a>
            </div>

            <div class="col-md-6 text-center">
                <a href="<?php echo site_url('investment-opportunities') ?>" class="subscribe btn  btn-lg btn-danger">Investment Opportunity</a>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
   
    <?php echo Modules::run('footer/footer/index'); ?>
    <script src="front/views/themes/default/assets/scripts/countdown/TimeCircles.js"></script>

    <script type="text/javascript">
        $('#biddate_selector').change(function() {
            var date = $(this).val();

            var data = {
                date: date
            };
            $.ajax({
                url: "<?php echo site_url('bid/getTimeSlotforbid') ?>",
                type: "get",
                dataType: "json",
                data: data,
                success: function(data) {
                    var timeslot = $('#time-schedule');
                    html = '';
                    if (data.start_time) {
                        html += data.start_time + '-' + data.end_time;
                    } else {
                        html += 'No Times Defined For Bidding right now';
                    }
                    timeslot.val(html);
                }
            });
        });
        $("#DateCountdown").TimeCircles({}).addListener(function(unit, value, total) {
            if (total == 0) {
                window.location.href = '<?php echo site_url() ?>';
            }
        });
    </script>
</body>

</html>