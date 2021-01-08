<nav id="mp-menu" class="mp-menu alternate-menu">
      <div class="mp-level">
        <h2>Menu</h2>
        <ul>
          <li><a href="<?=site_url('home');?>">Home</a></li>
          <li><a href="<?=site_url('coupon');?>">Coupons</a></li>
          
          <!--<li class="has-sub"> <a href="#">forum</a>
            <div class="mp-level">
              <h2>forum</h2>
              <a class="mp-back" href="#">back</a>
             
            </div>
          </li>-->
          <li> <a href="<?=site_url('brands');?>">Brands</a>
            
          </li>
          <li><a href="<?=site_url('blog');?>">News & Blog</a></li>
           
           <?php if (is_login()): ?>
           <li class="has-sub"> <a href="#"><?php echo ucfirst($this->session->userdata('username')); ?></a>
            <div class="mp-level">
              <h2>My Coupons(0)</h2>
              <a class="mp-back" href="#">back</a>
             
            </div>
          </li>
           <?php endif ?>
            <?php if (is_login()): ?>
          <li><a href="<?php echo site_url('login/logout') ?>">logout</a></li>
          <?php else: ?>
          <li><a href="<?php echo site_url('login/moblogin') ?>">Login</a></li>
           <a href="<?=site_url('login/mobsignup');?>"  class="btn btn-green type-login btn-login">Sign Up</a>
            <?php endif ?>
        </ul>
      </div>
    </nav>
    <script>
jQuery(document).ready(function($) {
    jQuery("*").find(" a[href='"+window.location.href+"']").each(function(){
        jQuery(this).addClass("active");
        //add additional code here if needed
    })
}); 
  </script>