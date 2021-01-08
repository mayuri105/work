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
    <header class="bread_crumb">
        <div class="pag_titl_sec">
            <h1 class="pag_titl"> Property Search </h1>
            <!-- <h4 class="sub_titl"> Echo Park occupy mustache gastropub </h4> -->
        </div>
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Home </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"> Property Search </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Go Back to Home </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section id="srch_slide">

        <div class="container">

            <!-- Search Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="srch_frm">
                        <h3>Real Estate Search</h3>
                       <?php 
                        $attributes = array('id' => 'contactForm','name'=>'sentMessage','method'=>'GET' );
                        echo form_open('investment-oppurtunity/search', $attributes);  ?>
                            <div class="control-group form-group">
                                <div class="controls col-md-4 first">
                                    <label>Keyword </label>
                                    <input type="text" class="form-control" id="keyword" name="keyword" value="<?php echo $keyword ?>" placeholder="Any keyword">
                                    <p class="help-block"></p>
                                </div>

                                <div class="controls col-md-4">
                                    <label>Location </label>
                                    <select name="area" class="form-control" >
                                        <option value="" selected="selected">Any Location</option>
                                        <?php foreach ($loc as $a ): ?>
                                           <option value="<?php echo $a->area_id ?>" <?php echo $a->area_id == $area ? 'selected' : '' ?> ><?php echo $a->area_name ?></option>
                                        <?php endforeach ?>    
                                    </select>
                                </div>

                                <div class="controls col-md-2">
                                    <label>Min. Area Sqft </label>
                                    <select name="min-area" class="form-control">
                                        <option value="" selected="selected">None</option>
                                        <?php for ($i=1; $i <=50; $i++) { ?>
                                          <option value="<?php echo $i ?>00" <?php echo $min_area ==$i.'00' ? 'selected' : '' ?>><?php echo $i ?>00</option>
                                        <?php } ?>
                                        <option value="10000" <?php echo $max_area =='10000' ? 'selected' : '' ?>>10000</option>
                                        <option value="25000" <?php echo $max_area =='25000' ? 'selected' : '' ?>>25000</option>
                                        <option value="50000" <?php echo $max_area =='50000' ? 'selected' : '' ?>>50000</option>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                                <div class="controls col-md-2">
                                     <label>Max. Area Sqft </label>
                                   <select name="max-area" class="form-control">
                                        <option value="" selected="selected">None</option>
                                        <?php for ($i=1; $i <=50; $i++) { ?>
                                         <option value="<?php echo $i ?>00" <?php echo $max_area ==$i.'00' ? 'selected' : '' ?>><?php echo $i ?>00</option>
                                        <?php } ?>
                                        <option value="10000" <?php echo $max_area =='10000' ? 'selected' : '' ?>>10000</option>
                                        <option value="25000" <?php echo $max_area =='25000' ? 'selected' : '' ?>>25000</option>
                                        <option value="50000" <?php echo $max_area =='50000' ? 'selected' : '' ?>>50000</option>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                               
                                <div class="clearfix"></div>
                            </div>

                            <div class="control-group form-group col-md-11">
                                <div class="controls col-md-3 first">
                                    <label>Type </label>
                                    <select name="type" class="form-control"  >
                                        <option value="" selected="selected">None</option>
                                        <?php foreach ($type as $t): ?>
                                            <option value="<?php echo $t->cat_id ?>" <?php echo $type== $t->cat_id  ? 'selected':'' ?>><?php echo $t->category ?></option>
                                        <?php endforeach ?>
                                        
                                    </select>
                                </div>
                                
                                <div class="controls col-md-3">
                                    <label>Min. Price </label>
                                    <select name="min-price" id="minprice" class="form-control" >
                                        <option value="" selected="selected">None</option>
                                        
                                    </select>
                                </div>
                                <div class="controls col-md-3">
                                    <label>Max. Price </label>
                                    <select name="max-price" id="maxprice" class="form-control" >
                                        <option value="" selected="selected">None</option>
                                        
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="sub_btn col-md-1">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                            <div class="clearfix"></div>
                            <div id="success"></div>
                            <!-- For success/fail messages -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </section>


    <div class="spacer-60"></div>
    <div class="container">
        <div class="row">
            <!-- Properties Section -->
            <section id="feat_propty">
                <div class="container">

                    <?php if($properties): ?>
                    <div class="row">
                        <?php $i=1;foreach ($properties as $p): ?>
                         <!-- Property listing 1 -->
                        <div class="col-md-4">
                            <div class="panel panel-default">
                        <div class="panel-image">
                            <img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$p->feature_image; ?>" alt="">
                            <div class="img_hov_eff">
                                 <?php if (is_login()): ?>
                                    <?php if (checkPackage('3')): ?>
                                            
                                            <a class="btn btn-default btn_trans" href="<?php echo site_url('investment-oppurtunity/property/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                    <?php else: ?>
                                            
                                            <a class="btn btn-default btn_trans" href="<?php echo site_url('package') ?>?id=3" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                          
                                     <?php endif ?>
                                <?php else: ?>
                                   
                                    <a  class="btn btn-default btn_trans" data-toggle="modal" href="#login_box" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                          
                                <?php endif ?>
                            </div>

                        </div>
                        <div class="sal_labl">
                            For <?php echo ucfirst($p->property_action) ?>
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
                            
                             <div class="price">
                              <strong>  Rs. <?php echo  convertNumber($p->cost) ?></strong>
                            </div>
                            <div class="properties-actions">
                                 <?php if (is_login()): ?>
                                    <?php if (checkPackage('3')): ?>
                                            
                                            <a href="<?php echo site_url('investment-oppurtunity/property/'.$p->property_slug.'') ?>" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                    <?php else: ?>
                                            
                                            <a href="<?php echo site_url('package') ?>?id=3" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                          
                                     <?php endif ?>
                                <?php else: ?>
                                   
                                    <a data-toggle="modal" href="#login_box" class="btn btn btn-outlined btn-theme pull-right btn-large btn-caps">Read More</a>
                                          
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

                    </div>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="srch_frm">
                            <h2 class="text-center">Property not found.</h2>
                            </div>

                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- /.row -->
                    <div class="spacer-40"></div>
                    <!-- Pagination -->

                    <div class="pagin">
                        <ul class="">
                           
                            <?php foreach ($links as $link) {
                            echo "<li>". $link."</li>";
                            } ?>
                        </ul>
                    </div>

                </div>
                <!-- /.container -->
            </section>
            <div class="spacer-60"></div>

        </div>
    </div>
<?php echo Modules::run( 'footer/footer/index' ); ?>
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
    });

function  loadhtml() {
    <?php if ($actions=='sale'): ?>
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
        $('#minprice option[value="'+<?php echo $min_price ?>+'"]').attr('selected', 'selected');
        $('#maxprice option[value="'+<?php echo $max_price ?>+'"]').attr('selected', 'selected');
    <?php elseif ($actions=='rent'): ?>
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
        <?php if ($min_price): ?>
            $('#minprice option[value="'+<?php echo $min_price ?>+'"]').attr('selected', 'selected');
        <?php endif ?>
        <?php if ($max_price): ?>
            $('#maxprice option[value="'+<?php echo $max_price ?>+'"]').attr('selected', 'selected');
        <?php endif ?>
        <?php else: ?>
        <?php endif ?> 
}

loadhtml();
</script>
</body>


</html>
