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
            <!-- <h1 class="pag_titl"> Property  </h1> -->
            <h1 class="pag_titl"><?php echo $pro->property_title ?> </h1>
        </div>
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Home </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"> Property  </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="lnk_pag"><a href="<?php echo site_url('rent-sale') ?>"> Go Back to Home </a> </p>
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
                        <ul id="prop_slid">
                         <li>
                            <img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$pro->feature_image; ?>" alt="">
                        </li>
                        </ul>
                        
                        <?php endif ?>
                        </div>
                        <div class="spacer-30"></div>
                        <div class="panel-body">
                            <div class="prop_feat">
                                <p class="area"><i class="fa fa-home"></i> <?php echo $pro->built_up_area ?> Sqft</p>
                                <p class="category-type"><i class="fa fa-building"></i> <?php echo ucfirst($pro->category) ?></p>
                                <p class="bedrom"><i class="fa fa-building"></i><?php echo $pro->area_name ?></p>
                            </div>

                            <h3 class="sec_titl">
                               <?php echo $pro->property_title ?>
                            </h3>

                            <div class="col_labls larg_labl">

                                <p class="or_labl">For <?php echo ucfirst( $pro->property_action ) ?></p>
                                <p class="blu_labl">Rs.<?php echo  convertNumber($pro->cost) ?></p>

                                <p class="blu_labl">
                                    <?php if (is_login()): ?>
                                        <?php if (buy_package()): ?>
                                        <a href="<?php echo site_url('appointment/') ?>?id=<?php echo $pro->property_id ?>"> Schedule Appointment</a>
                                        <?php else: ?>
                                        <a href="<?php echo site_url('package/property/'.$pro->property_slug.'') ?>">Buy Package For Schedule Appointment</a>
                                        <?php endif ?>
                                    <?php else: ?>
                                    <a href="#login_box" class="log_btn" data-toggle="modal">Login for Schedule Appointment</a>
                                    <?php endif ?>
                                </p>

                            </div>

                            <p class="sec_desc">
                                <?php echo $pro->property_content ?>
                            </p>
                          
                            <?php if (!empty($pro->amenity)): ?>    
                            
                            <!-- Proerty Additional Info -->
                            <div class="prop_addinfo">
                                <h2 class="add_titl">
                                    Amenities Details
                                </h2>

                                <div class="info_sec first">
                                    <div class="col-md-5">
                                        <ul>
                                            <?php foreach ( $pro->amenity as $p ): ?>
                                            <li>
                                                <a href="#">
                                                    <i class="<?php echo $p->amenity_icon ?>"></i>
                                                    <p class="infos"> <?php echo $p->amenity_name ?></p>
                                                </a>
                                            </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>


                                </div>
                            </div>
                            <?php endif ?>
                            <div class="spacer-30"></div>
                            <?php if (!empty($pro->addtional)): ?>
                            <div class="prop_addinfo">
                            <h2 class="add_titl">
                            Additional Details
                            </h2>

                            <div class="info_sec first">
                            <div class="col-md-5">
                            <ul>
                                <?php foreach ( $pro->addtional as $s ): ?>

                                <li>
                                    <a href="#">
                                        <?php echo $s->group_name ?>:
                                        <p class="infos"> <?php echo $s->attributes_name ?></p>
                                        <p class="infos"> <?php echo $s->attributes_value ?></p>
                                        
                                    </a>
                                </li>

                                <?php endforeach ?>
                            </ul>
                            </div>


                            </div>
                            </div>
                            <?php endif ?>
                            <div class="spacer-30"></div>

                            <?php if (!empty($pro->roitable)): ?>
                            <div class="prop_addinfo">
                            <h2 class="add_titl">
                                Roi Table(Return of investments)
                            </h2>

                            <div class="info_sec first">
                            <div class="row">
                                <div class="row  text-center">
                                    <div class="col-md-6">
                                        <strong>Years</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Return of investments (%) </strong>
                                    </div>
                                </div>
                                <hr>
                                <?php foreach ( $pro->roitable as $s ): ?>
                                    
                                <div class="row text-center">
                                    <div class="col-md-6">
                                        <?php echo $s->year ?>Year
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $s->return_of_investment ?>%
                                    </div>
                                </div>
                                <hr>
                                <?php endforeach ?>
                            
                            </div>


                            </div>
                            </div>
                            <div class="spacer-30"></div>
                            
                            <?php endif ?>

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
                            <h3>Real Estate Search</h3>
                            <?php  $attributes = array('id' => 'contactForm','name'=>'sentMessage','method'=>'GET' );
                        echo form_open('rent-sale/search', $attributes);  ?>
                                <div class="control-group form-group">
                                    <div class="controls">
                                    <label>Keyword </label>
                                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Any keyword">
                                    <p class="help-block"></p>
                                </div>
                                </div>
                                <div class="control-group form-group">
                                    <div class="controls">
                                        <label>Location </label>
                                        <select name="area" class="form-control" >
                                            <option value="" selected="selected">Any Location</option>
                                            <?php foreach ($loc as $a ): ?>
                                               <option value="<?php echo $a->area_id ?>" ><?php echo $a->area_name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <div class="controls  first">
                                        <label>Type </label>
                                        <select name="type" class="form-control"  >
                                            <option value="" selected="selected">None</option>
                                            <?php foreach ($types as $t ): ?>
                                              <option value="<?php echo $t->cat_id ?>"><?php echo $t->category ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </div>

                                
                                 <div class="control-group form-group">
                                <div class="controls col-md-6 first">
                                    <label>Min. Area Sqft </label>
                                    <select name="min-area" class="form-control">
                                        <option value="" selected="selected">None</option>
                                        <?php for ($i=1; $i <=50; $i++) { ?>
                                          <option value="<?php echo $i ?>00" ><?php echo $i ?>00</option>
                                        <?php } ?>
                                        <option value="10000" >10000</option>
                                        <option value="25000" >25000</option>
                                        <option value="50000" >50000</option>
                                    </select>
                                </div>
                                <div class="controls col-md-6">
                                    <label>Max. Area Sqft </label>
                                    <select name="max-area"  class="form-control"  >
                                        <option value="" selected="selected">None</option>
                                        <?php for ($i=1; $i <=50; $i++) { ?>
                                          <option value="<?php echo $i ?>00" ><?php echo $i ?>00</option>
                                        <?php } ?>
                                        <option value="10000" >10000</option>
                                        <option value="25000" >25000</option>
                                        <option value="50000" >50000</option>      
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                                <div id="success"></div>
                                <!-- For success/fail messages -->
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="spacer-30"></div>

                <!-- Featured Properties -->
                <div class="row">
                    <div class="titl_sec">
                        <div class="col-lg-12">

                            <h3 class="main_titl text-left">
                                Featured Properties
                            </h3>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="side_feat">
                        <?php foreach ($feature_property as $fa): ?>
                        <div class="panel panel-default">
                            <div class="panel-image col-md-3">

                                <a href="<?php echo site_url('property/'.$fa->property_slug.'') ?>">
                                    <img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$fa->feature_image ?>" alt="">
                                </a>

                            </div>

                            <div class=" col-md-9">
                                <h3 class="sec_titl">
                                    <a href="<?php echo site_url('investment-opportunities/'.$fa->property_slug.'') ?>"><?php echo ucfirst($fa->property_title) ?></a>
                                </h3>

                                <div class="prop_feat">
                                    <p class="area"><i class="fa fa-home"></i> <?php echo $fa->built_up_area.' '.'Sq.ft'; ?> </p>
                                    <p class="bedrom"><i class="fa fa-bed"></i><?php echo $fa->beds ?> Bathrooms</p>
                                </div>

                            </div>
                        </div>
                        <?php endforeach ?> 


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
<script type="text/javascript">
    $('#actions').change(function(){
        if($(this).val()=='rent'){
            var minprice = $('#minprice');
            var maxprice = $('#maxprice');
            minprice.html('<option value="">None</option>'); 
            maxprice.html('<option value="">None</option>'); 

            var html = '<option value="1000">1000</option>';
            html +='<option value="1000">5000</option>';
            html +='<option value="10000">10000</option>';
            html +='<option value="15000">15000</option>';
            html +='<option value="20000">20000</option>';
            html +='<option value="25000">25000</option>';
            html +='<option value="50000">50000</option>';
            html +='<option value="75000">75000</option>';
            html +='<option value="100000"><?php echo convertNumber(100000); ?></option>';
            html +='<option value="150000"><?php echo convertNumber(150000); ?></option>';
            html +='<option value="200000"><?php echo convertNumber(200000); ?></option>';
            html +='<option value="250000"><?php echo convertNumber(250000); ?></option>';
            minprice.append(html);  
            maxprice.append(html);

        }else{
            var minprice = $('#minprice');
            var maxprice = $('#maxprice');
            minprice.html('<option value="">None</option>'); 
            maxprice.html('<option value="">None</option>'); 
            var html = '';

            html +='<option value="500000"><?php echo convertNumber(500000); ?></option>';
            html +='<option value="1000000"><?php echo convertNumber(1000000); ?></option>';
            html +='<option value="1500000"><?php echo convertNumber(1500000); ?></option>';
            html +='<option value="2000000"><?php echo convertNumber(2000000); ?></option>';
            html +='<option value="2500000"><?php echo convertNumber(2500000); ?></option>';
            html +='<option value="3000000"><?php echo convertNumber(3000000); ?></option>';
            html +='<option value="4000000"><?php echo convertNumber(4000000); ?></option>';
            html +='<option value="5000000"><?php echo convertNumber(5000000); ?></option>';
            html +='<option value="10000000"><?php echo convertNumber(10000000); ?></option>';
            html +='<option value="15000000"><?php echo convertNumber(15000000); ?></option>';
            html +='<option value="20000000"><?php echo convertNumber(20000000); ?></option>';
            html +='<option value="30000000"><?php echo convertNumber(30000000); ?></option>';
            
            minprice.append(html);  
            maxprice.append(html);
        }
    })
</script>
</body>

</html>
