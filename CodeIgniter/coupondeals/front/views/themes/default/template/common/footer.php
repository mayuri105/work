<footer class="mod-footer">
      <div class="footer-top">
        <div class="grid_frame">
          <div class="container_grid clearfix">
            <div class="grid_3">
              <div class="company-info"> <img src="<?=site_url('front/views/themes/default');?>/asset/images/logo-gray.png" alt="Savetakatak" style="height:65px;"/>
                <p class="rs"><?php echo $aboutus ?> </p>
                
              </div>
            </div>
            <div class="grid_3">
              <div class="block social-link">
                <h3 class="title-block">Follow us</h3>
                <div class="block-content">
                  <ul class="rs">
                    <li> <i class="fa fa-facebook-square fa-2x"></i> <a href="https://www.facebook.com/savetakatak/" target="_blank">Our Facebook page</a> </li>
                    <li> <i class="fa fa-twitter-square fa-2x"></i> <a href="https://twitter.com/Savetakatak_?lang=en" target="_blank">Follow our Tweets</a> </li>
                    <li> <i class="fa fa-pinterest-square fa-2x"></i> <a href="https://in.pinterest.com/savetakatakcom/" target="_blank">Follow our Pin board</a> </li>
                  </ul>
                </div>
              </div>
            </div>
            <!--end: Follow us -->
            <div class="grid_3">
              <div class="block intro-video">
                <h3 class="title-block"> Advertisement Video</h3>
                <div class="block-content">
                  <div class="wrap-video" id="sys_wrap_video">
                    <div class="lightbox-video"> <a class="html5lightbox" href="<?php echo $video_link ?>" title=""><i class="btn-play"></i><img src="<?=site_url('front/views/themes/default');?>/asset/images/video-img.png" alt=""></a> </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end: Intro Video -->
            <div class="grid_3">
              <div class="block blog-recent">
                <h3 class="title-block">Latest blog</h3>
                  <?php if ($allletestblog): ?>
                <div class="block-content">
                 <?php foreach ($allletestblog as $ct): ?>
                  <div class="entry-item flex"> <a class="thumb-left" href="<?php echo $ct->blog_slug ?>"> <img src="<?= site_url('upload/blogsimages/'.$ct->img_name.'') ?>" style="height:45px; width:auto !important;"/> </a>
                    <div class="flex-body"><a href="<?php echo $ct->blog_slug ?>"><?php echo $ct->title ?> </a></div>
                  </div>
                   <?php endforeach ?>
                </div>
                <?php endif ?>
              </div>
            </div>
            <!--end: blog-recent --> 
          </div>
        </div>
      </div>
      <!--end: .foot-top-->
      <div class="foot-copyright">
        <div class="grid_frame">
          <div class="container_grid clearfix">
            <div class="left-link"> <a href="<?=site_url('home');?>">Home</a> <a href="<?=site_url('term-condition');?>">Term of conditions</a> <a href="<?=site_url('privacy');?>">Privacy</a> <a href="<?=site_url('about');?>">About</a> <a href="<?=site_url('contact');?>">Contact</a> </div>
            <div class="copyright"> Copyright &copy; 2016  Designed and Developed <a href="http://prometheastech.com/" target="_blank">Prometheas Global Technology </a></div>
          </div>
        </div>
      </div>
    </footer>
   