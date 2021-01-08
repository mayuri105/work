<div class="top-area">
      <div class="mod-head-slide">
        <div class="grid_frame">
          <div class="wrap-slide">
            <p class="ta-c"><img src="<?=site_url('front/views/themes/default');?>/asset/images/ajax-loader.gif" alt="loading"></p>
           
            <div id="sys_head_slide" class="head-slide flexslider">
             <?php if ($banners): ?>
              <ul class="slides">
               <?php foreach ($banners as $ct): ?>
                
                <li><a href="<?php echo $ct->banner_link ?>"  target="_blank"><img src="<?= site_url('upload/bannersimages/'.$ct->img_name.'') ?>" alt=""/></a> </li>
                
               
                 <?php endforeach ?>
              </ul>
                <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>