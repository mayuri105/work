<div class="grid_4 sidebar">
           
            <div class="mod-simple-coupon block">
              <h3 class="title-block">Latest Deal</h3>
               <?php if ($allletesdeal): ?>
              <div class="block-content">
              
            <?php foreach ($allletesdeal as $ct): ?>
                <div class="coupons-code-item simple flex">
                  <div class="brand-logo thumb-left">
                    <div class="wrap-logo">
                      <div class="center-img"> <span class="ver_hold"></span> <a href="<?php echo $ct->deal_slug ?>" class="ver_container"><img src="<?= site_url('upload/dealsimages/'.$ct->img_name.'') ?>" alt=""></a> </div>
                    </div>
                  </div>
                  <div class="right-content flex-body">
                    <p class="rs save-price"><a href="<?php echo $ct->deal_slug ?>"><?php echo $ct->title ?> </a></p>
                  </div>
                </div>
               
                <?php endforeach ?>
          
              </div>
                <?php endif ?>
            </div>
            <div class="mod-list-store block">
              <h3 class="title-block">Popular store</h3>
              <div class="block-content">
                <div class="wrap-list-store clearfix"> 
                <?php if ($allfeaturebrands): ?>
            <?php foreach ($allfeaturebrands as $cr): ?>
                <a class="brand-logo" href="<?php echo $cr->brand_link ?>" target="_blank" > <span class="wrap-logo"> <span class="center-img"> <span class="ver_hold"></span> 
                <span class="ver_container"><img src="<?= site_url('upload/brandsimages/'.$cr->img_name.'') ?>" alt=""></span> </span> </span> </a>
                 
                  <?php endforeach ?>
            <?php endif ?>
                 </div>
              </div>
            </div>
          
            
          
            <!--<div class="mod-ads"><a href="#"><img src="<?=site_url('front/views/themes/default');?>/asset/images/ex/04-17.jpg" alt="$NAME"/></a></div>-->
            
          </div>