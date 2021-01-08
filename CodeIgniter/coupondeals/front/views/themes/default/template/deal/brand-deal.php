<div class="mod-grp-coupon block clearfix">
           <?php if ($dealsbrand): ?>
          <div class="block-content list-coupon clearfix">
           
            <?php foreach ($dealsbrand as $cr): ?>
            <div class="coupon-item grid_3">
              <div class="coupon-content">
                <div class="img-thumb-center">
                  <div class="wrap-img-thumb"> <span class="ver_hold"></span> <a href="<?=site_url($cr->deal_slug.'');?>" class="ver_container"><img src="<?= site_url('upload/dealsimages/'.$cr->img_name.'') ?>" alt=""></a> </div>
                </div>
                 <div class="coupon-desc"><?php echo $cr->title ?> </div>
                                <div class="coupon-price">Rs: <?php  echo round($cr->total_price,2)?></div> <div class="main" style="float:right; margin-top:-9px;"><?php echo $cr->brand_name ?><!--<img src="../asset/images/amazon.jpg"/>--></div>
                                <del class="coupon-price">Rs: <?php  echo round($cr->orignal_price,2)?></del>
                <div class="time-left">
                  <?php 
				$timestamp = strtotime($cr->added_date);
				$post_date =$timestamp;
				$now = time();
				?>
                  <div class="time-left"><?php echo timespan($post_date, $now) . ' ago';?></div>
                  <a class="btn btn-blue btn-take-coupon" href="<?=site_url($cr->deal_slug.'');?>">Get Deal</a> </div>
                <?php if ( $cr->hotdeal == 1):  ?>
                <i class="stick-lbl hot-sale"></i>
                <?php endif ?>
              </div>
              
            </div>
            
           
            <?php endforeach ?>
           
            
          </div>
           <?php endif ?>
        </div>