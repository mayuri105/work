<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title ?></title>
   	<?php echo Modules::run('header/header/css') ?>
    <link href="<?= site_url('front/views/themes/default'); ?>/assets/scripts/countdown/TimeCircles.css" rel="stylesheet">
    <meta itemprop="title" content="<?php echo $meta_titles ?> ">
    <meta itemprop="description" content="<?php echo $meta_descriptions ?>">
    <meta itemprop="keywords" content="<?php echo $meta_keywords ?>">
    <!-- <meta http-equiv="refresh" content="10; " />
    <meta http-equiv="pragma" content="no-cache"> -->
</head>
<body>

<?php echo Modules::run('header/header/index'); ?>
    
<img src="<?=site_url('front/views/themes/default');?>/assets/images/hindi-logo.png" id="right-logo" class="pull-right" alt="logo">

<img src="<?=site_url('front/views/themes/default');?>/assets/images/guj-logo.png" id="left-logo" class="pull-left"  alt="logo">
    <div class="container">
        <div class="row">
            <!-- Properties Section -->
            <section id="feat_propty">
                <div class="container">
                    <div class="row">
                        <?php if (!$properties): ?>
                       
                        <?php if ($endprop): ?>
                            <div class="col-md-6 col-md-offset-3">
                                <h3 class="text-center">BID TIME OVER</h3>  
                                <div class="spacer-30"></div>
                            </div>  

                             <?php $i=1;foreach ($endprop as $p): ?>
                                <!-- Property listing 1 -->

                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-image">
                                            <img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$p->feature_image ?>" alt="">
                                            <div class="img_hov_eff">
                                                <a class="btn btn-default btn_trans" href="<?php echo site_url('bid/bidover-property/'.$p->property_slug.'') ?>">Bid Winner</a>
                                            </div>

                                        </div>
                                        <div class="sal_labl">
                                            
                                            <?php if ($p->sold): ?>
                                                Sold
                                            <?php else: ?>
                                               For <?php echo $p->property_action ?> 
                                            <?php endif ?>

                                        </div> 
                                        
                                        <div class="panel-body">
                                            <div class="prop_feat">
                                                <p class="area"><i class="fa fa-home"></i> <?php echo $p->built_up_area ?> Sq.ft</p>
                                                 <p class="category-type"><i class="fa fa-building"></i> <?php echo ucfirst($p->category) ?></p>
                                             
                                            </div>
                                            <h3 class="sec_titl">
                                                 <?php echo  ucfirst($p->property_title) ?>
                                            </h3>

                                            <p class="sec_desc">
                                               <?php echo  ucfirst( summary($p->property_small_desc )) ?>
                                            </p>
                                            <?php if ($p->sold): ?>
                                            <div class="panel_bottom ">
                                                <div class="spacer-10"></div>
                                                <div class="col-md-6">
                                                  <strong>Sold:</strong>
                                                    <?php echo $p->sold->first_name.' '.$p->sold->last_name ?>
                                                </div>
                                                <div class="col-md-6">
                                                  <strong>Phone:</strong>
                                                    <?php echo $p->sold->phone ?>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                                <div class="spacer-30"></div>
                                            <?php endif ?>
                                            <?php if ($p->bid): ?>
                                           <div class="price">
                                              <strong>  Rs. <?php echo  convertNumber($p->bid->amount) ?></strong>
                                            </div>        
                                             <?php else: ?>      
                                            <div class="price">
                                              <strong>  Rs. <?php echo  convertNumber($p->cost) ?></strong>
                                            </div>
                                            <?php endif; ?>
                                            <hr>
                                            <div class="properties-actions">
                                                <a href="<?php echo site_url('bid/bidover-property/'.$p->property_slug.'') ?>" class="btn btn-outlined btn-theme pull-left btn-large btn-caps"><i class="fa fa-gavel"></i> Bid Over</a>
                                                <a href="<?php echo site_url('bid/bidover-property/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                                <div class="spacer-10"></div> 
                                            </div>
                                        </div>

                                    </div>  
                                </div>
                                <?php if ($i =='3'): ?>
                                    <div class="spacer-40"></div>
                                <?php $i=0; ?>
                            <?php endif ?>
                            <?php $i++; endforeach ?>
                        <?php else: ?>
                            <div class="col-md-6 col-md-offset-3">
                                <h3 class="text-center">BID STARTS IN</h3>  
                                <div class="spacer-30"></div>
                            </div> 

                            
                            <?php if ($datetimebid): ?>
                               <div class="col-md-6 col-md-offset-3">
                                   <div id="DateCountdown" data-date="<?php echo  $current = $datetimebid->date.' '.$datetimebid->start_time; ?>"></div>
                                </div>
                            <?php 
                           if ($todaysbidpro): 
                            $i=1;foreach ($todaysbidpro as $p): ?>
                                <!-- Property listing 1 -->

                                <div class="col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-image">
                                            <img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$p->feature_image ?>" alt="">
                                            <div class="img_hov_eff">
                                                <a class="btn btn-default btn_trans" href="<?php echo site_url('bid/property_show/'.$p->property_slug.'') ?>"> More Details </a>
                                                   
                                            </div>

                                        </div>
                                        <div class="sal_labl">
                                           <?php if ($p->sold): ?>
                                                Sold
                                            <?php else: ?>
                                               For <?php echo $p->property_action ?> 
                                            <?php endif ?>
                                        </div> 
                                        
                                        <div class="panel-body">
                                            <div class="prop_feat">
                                                <p class="area"><i class="fa fa-home"></i> <?php echo $p->built_up_area ?> Sq.ft</p>
                                                 <p class="category-type"><i class="fa fa-building"></i> <?php echo ucfirst($p->category) ?></p>
                                             
                                            </div>
                                            <h3 class="sec_titl">
                                                 <?php echo  ucfirst($p->property_title) ?>
                                            </h3>

                                            <p class="sec_desc">
                                               <?php echo  ucfirst( summary($p->property_small_desc )) ?>
                                            </p>
                                            <?php if ($p->sold): ?>
                                            <div class="panel_bottom ">
                                                <div class="spacer-10"></div>
                                                <div class="col-md-6">
                                                  <strong>Sold:</strong>
                                                    <?php echo $p->sold->first_name.' '.$p->sold->last_name ?>
                                                </div>
                                                <div class="col-md-6">
                                                  <strong>Phone:</strong>
                                                    <?php echo $p->sold->phone ?>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                                <div class="spacer-30"></div>
                                            <?php endif ?>
                                            <?php if ($p->bid): ?>
                                           <div class="price">
                                              <strong>  Rs. <?php echo  convertNumber($p->bid->amount) ?></strong>
                                            </div>        
                                             <?php else: ?>      
                                            <div class="price">
                                              <strong>  Rs. <?php echo  convertNumber($p->cost) ?></strong>
                                            </div>
                                            <?php endif; ?>
                                            <hr>
                                           
                                             <div class="properties-actions">
                                             <?php if (is_login()): ?>
                                                    
                                                      <a href="<?php echo site_url('bid/property_show/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                            <div class="spacer-10"></div>
                                            <?php else: ?>
                                                    <!-- <a data-toggle="modal" href="#login_box" class="btn btn-outlined btn-theme pull-left btn-large btn-caps"><i class="fa fa-gavel"></i>Bid</a> -->
                                                    <a href="<?php echo site_url('bid/property_show/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                                    <div class="spacer-10"></div>

                                            <?php endif ?>
                                            </div> 

                                        </div>

                                    </div>  
                                </div>
                                <?php if ($i =='3'): ?>
                                    <div class="spacer-40"></div>
                                <?php $i=0; ?>
                            <?php endif ?>

                            <?php $i++; endforeach ?>
                             <?php endif ?>
                            <?php else: ?>
                                  <h3 class="text-center">Not</h3>  
                            <?php endif ?>
                             </div>

                        <?php endif ?>    


                        <?php else: ?>
                        <div class="col-md-6 col-md-offset-3">
                                <h3 class="text-center">BID IS GOING ON</h3>  
                                <div class="spacer-30"></div>
                            </div> 
                        <?php $i=1;foreach ($properties as $p): ?>
                            <!-- Property listing 1 -->


                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-image">
                                        <img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$p->feature_image ?>" alt="">
                                        <div class="img_hov_eff">
                                            <?php if (is_login()): ?>
                                                <?php if (checkPackage('2')): ?>
                                                    <a class="btn btn-default btn_trans" href="<?php echo site_url('bid/property/'.$p->property_slug.'') ?>"> More Details </a>
                                                <?php else: ?>
                                                    <a class="btn btn-default btn_trans" href="<?php echo site_url('package') ?>?id=2">Subscribe Package</a>
                                                <?php endif ?>
                                            <?php else: ?>
                                                <a class="btn btn-default btn_trans" data-toggle="modal" href="#login_box" >Login</a>
                                            <?php endif ?>
                                        </div>

                                    </div>
                                    <div class="sal_labl">
                                        <?php if ($p->sold): ?>
                                            Sold
                                        <?php else: ?>
                                           For <?php echo $p->property_action ?> 
                                        <?php endif ?>
                                    </div> 
                                    
                                    <div class="panel-body">
                                        <div class="prop_feat">
                                            <p class="area"><i class="fa fa-home"></i> <?php echo $p->built_up_area ?> Sq.ft</p>
                                            <p class="category-type"><i class="fa fa-building"></i> <?php echo ucfirst($p->category) ?></p>
                                                
                                        </div>
                                        <h3 class="sec_titl">
                                            <?php echo  ucfirst($p->property_title) ?>
                                        </h3>

                                        <p class="sec_desc">
                                           <?php echo  ucfirst( summary($p->property_small_desc )) ?>
                                        </p>
                                        <?php if ($p->sold): ?>
                                        <div class="panel_bottom ">
                                            <div class="spacer-10"></div>
                                            <div class="col-md-6">
                                              <strong>Sold:</strong>
                                                <?php echo $p->sold->first_name.' '.$p->sold->last_name ?>
                                            </div>
                                            <div class="col-md-6">
                                              <strong>Phone:</strong>
                                                <?php echo $p->sold->phone ?>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                            <div class="spacer-30"></div>
                                        <?php endif ?>
                                        <?php if ($p->bid): ?>
                                       <div class="price">
                                          <strong>  Rs. <?php echo  convertNumber($p->bid->amount) ?></strong>
                                        </div>        
                                         <?php else: ?>      
                                        <div class="price">
                                          <strong>  Rs. <?php echo  convertNumber($p->cost) ?></strong>
                                        </div>
                                        <?php endif; ?>



                                        <hr>
                                        <div class="properties-actions">
                                             <?php if (is_login()): ?>
                                                <?php if (checkPackage('2')): ?>
                                                    <a href="<?php echo site_url('bid/property/'.$p->property_slug.'') ?>" class="btn btn-outlined btn-theme pull-left btn-large btn-caps"><i class="fa fa-gavel"></i> Bid</a>
                                                    <a href="<?php echo site_url('bid/property/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                                <?php else: ?>
                                                    <a href="<?php echo site_url('package') ?>?id=2" class="btn btn-outlined btn-theme pull-left btn-large btn-caps"><i class="fa fa-gavel"></i>Bid</a>
                                                    <a href="<?php echo site_url('bid/property_show/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                                 <?php endif ?>
                                            <?php else: ?>

                                                    <!-- <a data-toggle="modal" href="#login_box" class="btn btn-outlined btn-theme pull-left btn-large btn-caps"><i class="fa fa-gavel"></i>Bid</a> -->
                                                    <a href="<?php echo site_url('bid/property_show/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                            <?php endif ?>
                                            <div class="spacer-10"></div>

                                        </div>
                                    

                                    </div>

                                </div>  
                            </div>
                            <?php if ($i =='3'): ?>
                                <div class="spacer-40"></div>
                            <?php $i=0; ?>
                            <?php endif ?>
                        <?php $i++; endforeach ?>
                        <?php endif ?>

                    </div>


                   
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
            <div class="row">
                <div class="col-md-4 col-md-offset-2 text-center subs_form">

                     <div class="form-group">
                        <select class="form-control" id="biddate_selector" name="biddate_selector">
                           <option value="">Select Date for Bid Time</option>
                            
                            <?php foreach ($bid_dates as $b): ?>
                                <option  value="<?php echo date('m/d/Y',strtotime($b->date)) ?>">
                                    <?php echo date('l  d/m/Y',strtotime($b->date)) ?>
                                </option>

                               
                            <?php endforeach ?>
                        </select>
                    </div>
                           
                    
                </div>  
                <div class="col-md-4 text-centersubs_form">
                    <div class="form-group">
                        <input class="form-control" id="time-schedule" readonly="true" placeholder = "Times for Biding Open">
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <div class="spacer-60"></div>

         <div class="container">

                <div class="col-md-4 col-md-offset-2 text-center">
                  <a href ="<?php echo site_url('rent-sale') ?>" class="subscribe btn  btn-lg btn-danger">Rent/Sale Property</a>
                </div>

                <div class="col-md-4 text-center">
                  <a href ="<?php echo site_url('investment-opportunities') ?>"   class="subscribe btn  btn-lg btn-danger">Investment Opportunity</a>
                </div>
                <!-- /.row -->
            </div>
    </section>
 

<?php echo Modules::run('footer/footer/index'); ?>
<script src="front/views/themes/default/assets/scripts/countdown/TimeCircles.js"></script>

 <script type="text/javascript">
    $('#biddate_selector').change(function(){
        var date = $(this).val();

        var data = {
                date : date
            };
            $.ajax({
                url : "<?php echo site_url('bid/getTimeSlotforbid') ?>",
                type: "get",
                dataType: "json",
                data: data,
                success:function(data){
                    var timeslot = $('#time-schedule');
                    html = '';
                    if (data.start_time) {
                        html += data.start_time+'-'+data.end_time;
                    }else{
                        html += 'No Times Defined For Bidding right now';
                    }
                    timeslot.val(html);           
                }
            });
    });
$("#DateCountdown").TimeCircles({}).addListener(function(unit,value,total){
    if(total == 0) {
        window.location.href = window.location.href; //This is a possibility
        window.location.reload(); //Another possiblity
        history.go(0); //And another
    }
});
</script>
</body>

</html>