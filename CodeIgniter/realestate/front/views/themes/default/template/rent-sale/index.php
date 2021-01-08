<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title ?></title>
   	<?php echo Modules::run('header/header/css') ?>
     <meta itemprop="title" content="<?php echo $meta_titles ?> ">
    <meta itemprop="description" content="<?php echo $meta_descriptions ?>">
    <meta itemprop="keywords" content="<?php echo $meta_keywords ?>">
    
</head>
<body>
<?php echo Modules::run('header/header/index'); ?>

	<!-- Header Stat Banner -->
	<header id="banner" class="stat_bann">
	<div class="bannr_sec">
	    <img src="<?= site_url('front/views/themes/default'); ?>/assets/images/banner_5.jpg" alt="Banner">
	        <h1 class="main_titl">
	        	Rent - Sale
	        </h1>
	        <!-- <h4 class="sub_titl">
	            Wes Anderson American Apparel
	        </h4> -->
   </div>
	</header>	

    <!-- Page Content -->
    <section id="srch_slide">

        <div class="container">

            <!-- Search & Slider -->
            <div class="row">
                <!-- Search Form -->
                <div class="col-md-4">
                    <div class="srch_frm">
                       <!--  <h3>Real Estate Search</h3> -->
                        <?php 
                        $attributes = array('id' => 'contactForm','name'=>'sentMessage','method'=>'GET' );
                        echo form_open('rent-sale/search', $attributes);  ?>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <!-- <label>Keyword </label> -->
                                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Any keyword">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <!-- <label>Location</label> -->
                                    <div class="spacer-10"></div>
                                    <select name="area" class="form-control" >
                                        <option value="" selected="selected">Any Location</option>
                                        <?php foreach ($loc as $a ): ?>
                                           <option value="<?php echo $a->area_id ?>" ><?php echo $a->area_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls col-md-6 first">
                                    <label>Type </label>
                                    <select name="type" class="form-control"  >
                                        <option value="" selected="selected">None</option>
                                        <?php foreach ($types as $t ): ?>
                                            <option value="<?php echo $t->cat_id ?>"><?php echo $t->category ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="controls col-md-6">
                                    <label>Actions </label>
                                    <select name="actions" class="form-control" id="actions" >
                                        <option value="" selected="selected">None</option>
                                        <option value="rent" >For Rent</option>
                                        <option value="sale">For Sale</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="control-group form-group">
                                <div class="controls col-md-6 first">
                                    <label>Min. Price </label>
                                    <select name="min-price" id="minprice" class="form-control">
                                         <option value="" selected="selected">None</option>
                                        
                                    </select>
                                </div>
                                <div class="controls col-md-6">
                                    <label>Max. Price </label>
                                    <select name="max-price" id="maxprice" class="form-control"  >
                                        <option value="" selected="selected">None</option>
                                        
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
                <!-- Slider -->
                <div class="col-md-8 slide_sec">
                    <div id="slider" class="silde_img flexslider">
                        <ul class="slides">

                            <?php if ($sliderpro): ?>
                                <?php foreach ($sliderpro as $s): ?>
                                    <li>
                                        <img src="<?php echo getuploadpath().'property/'.$s->slider_image; ?>" alt="Slider image" />
                                        <div class="slide-info">
                                            <p class="sli_price"> Rs. <?php echo  convertNumber($s->cost) ?></p>
                                            <p class="sli_titl"><?php echo ucfirst($s->property_title) ?></p>
                                            <p class="sli_desc"><?php echo ucfirst(summary($s->property_small_desc)) ?> </p>
                                        </div>
                                    </li>
                                <?php endforeach ?>
                            <?php else: ?>
                                <!-- Slide 1 -->
                                <li>
                                    <img src="<?= site_url('front/views/themes/default'); ?>/assets/images/slider_4.jpg" alt="Slider image" />
                                    <div class="slide-info">
                                        <p class="sli_price"> $425.000 </p>
                                        <p class="sli_titl"> Amillarah Private Islands </p>
                                        <p class="sli_desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit </p>
                                    </div>
                                </li>
                            <?php endif ?>
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </section>
    
    <div class="spacer-60"></div>

    <!-- Featured Properties Section -->
    <section id="feat_propty">
        <div class="container">
            <div class="row">
                <div class="titl_sec">
                    <div class="col-xs-6">
                        <h3 class="main_titl text-left">
                    	   Featured Properties
                        </h3>
                    </div>
                    <div class="col-xs-6">
                        <h3 class="link_titl text-right">
                            <!-- <a href="<?php echo site_url('property') ?>"> View Properties </a> -->
                        </h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php foreach ($property as $p): ?>
                <!-- Property 1 -->
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
                                   
                                    <a  class="btn btn-default btn_trans" data-toggle="modal" href="#login_box" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                          
                                <?php endif ?>
                            </div>

                        </div>
                        <div class="sal_labl">
                            <?php if ($p->sold): ?>
                                Sold
 
                            <?php elseif($p->rent): ?>
                              Rented
                            <?php else: ?>
                             For <?php echo ucfirst($p->property_action) ?>
 
                            <?php endif ?>
                            

                        </div>

                        <div class="panel-body">
                            <div class="prop_feat">
                                <p class="area"><i class="fa fa-home"></i> <?php echo $p->built_up_area ?> Sq.ft</p>
                                <p class="category-type"><i class="fa fa-building"></i> <?php echo ucfirst($p->category) ?></p>
                            
                            </div>
                            <h3 class="sec_titl">
                                <?php echo ucfirst($p->property_title) ?>
                            </h3>

                            <p class="sec_desc">
                                <?php echo ucfirst(summary($p->property_small_desc)) ?>
                            </p>
                            <?php if ($p->sold): ?>
                                <div class="panel_bottom">
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
                                <div class="spacer-15"></div>
                                <?php endif ?>
                             
                             <?php if ($p->rent): ?>
                                <div class="panel_bottom">
                                    <div class="spacer-10"></div>
                                    <div class="col-md-6">
                                      <strong>Rented:</strong>
                                        <?php echo $p->rent->first_name.' '.$p->rent->last_name ?>
                                    </div>
                                    <div class="col-md-6">
                                      <strong>Phone:</strong>
                                        <?php echo $p->rent->phone ?>
                                    </div>
                                </div>
                                 <?php else: ?>
                                <div class="spacer-15"></div>
                                <?php endif ?>
                            
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

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <div class="spacer-60"></div>

    

    <!-- Testimonial Section -->
    <section id="testim">
        <div class="container">
            <div class="row testim_sec m0">
                <!-- Testimonial 1 -->
                <?php foreach ($testimonial as $t): ?>
                <div class="testim_box">
                    <blockquote>
                       <?php echo  $t->testimonial ?>
                    </blockquote>
                    <div class="auth_sec">
                        <img src="<?php echo getuploadpath().'testimonial/'.$t->user_image ?>" alt="">
                        <h6 class="auth_nam">
                           <?php echo $t->testimonial_name ?>
                            <span class="auth_pos">
                           <?php echo $t->user_position ?>
                        </span>
                        </h6>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <div class="spacer-60"></div>
    <!-- Subscribe Section -->
   
     <section id="testim">
            <div class="container">

                <div class="col-md-6 text-center">
                  <a href="<?php echo site_url() ?>" class=" btn  btn-lg btn-danger">Bidding</a>
                </div>

                <div class="col-md-6 text-center">
                  <a href="<?php echo site_url('investment-opportunities') ?>"   class=" btn  btn-lg btn-danger">Investment Opportunity</a>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
    </section>

     <div class="spacer-60"></div>
    
    <!-- Our clients -->
    <section id="clients">
        <div class="container">
            <div id="owl-carousel" class="row">
                <h2 class="hide"> Our Clients </h2>
                <?php foreach ($clients as $c): ?>
                <div class="owl_col">
                    <div class="mid_img"> <img class="img-responsive customer-img" src="<?php echo getuploadpath().'clients/'.$c->image_name ?>" alt="">
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <!-- /.row -->
        </div>

    </section>

<div class="spacer-60"></div>

<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
     $('.subscribe').click(function(e){
        e.preventDefault()
        var form = $('#subscribefrn');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
                //window.location.reload();
            };
            showMessage(response.Type,response.Message);
          }
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