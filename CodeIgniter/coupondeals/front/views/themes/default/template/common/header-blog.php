
<?php error_reporting(0); ?>
<header class="mod-header">
  <div class="grid_frame">
    <div class="container_grid clearfix">
      <div class="grid_12">
        <div class="header-content clearfix">
          <h1 id="logo" class="rs"> <a href="<?=site_url('home');?>"> <img src="<?=site_url('front/views/themes/default');?>/asset/images/logo.png"  style="height:65px;" /> </a> </h1>
            <?php if (is_login()): ?>
          <a class="btn btn-green type-login btn-login" href="<?php echo site_url('login/logout') ?>">Log out</a>
            
             <?php else: ?>
              <a href="<?=site_url('login/mobsignup');?>"  class="btn btn-green type-login btn-login">Sign Up</a>
          <a id="sys_head_login" class="btn btn-green type-login btn-login" >Login</a>
          <?php endif ?>
          <nav class="main-nav">
            <ul id="main-menu" class="nav nav-horizontal clearfix">
              <li> <a href="<?=site_url('blog');?>">Home</a> </li>
               <?php foreach ($blog_cat as $c): ?>
              <li> <a href="<?=site_url($c->blog_cat_slug);?>"> <?= $c->blog_cat_name ?></a> </li>
              <?php endforeach ?>
              
               <?php if (is_login()): ?>
              <li class="has-sub"> <a href="#"><?php echo ucfirst($this->session->userdata('username')); ?></a>
              <ul class="sub-menu">
              <li><a href="#">My Coupon</a></li>
              </ul>
              
               </li>
                <?php endif ?>
            </ul>
            <a id="sys_btn_toogle_menu" class="btn-toogle-res-menu" href="#alternate-menu"></a> </nav>
        </div>
      </div>
    </div>
  </div>
  <div id="sys_pop_login" class="pop-login">
    <div class="viewport-pop">
      <div class="transport-viewer clearfix">
        <div class="mod-register">
          <h3 class="rs title-mod">Hello Shoppers! Welcome to Savetakatak.com</h3>
          <div class="wrap-form-reg clearfix">
              <?php 
                        $attributes = array('class' => 'form-horizontal', 'id' => 'loginForm','name'=>'sentMessage' );
                        echo form_open('login/validateLoginJs', $attributes);  ?>
              <div class="left-form">
                <label class="wrap-txt" for="sys_email">
                  <input class="input-txt" id="sys_email" type="email" name="email" placeholder="your@mail.com">
                </label>
                <label class="wrap-txt" for="sys_pass">
                  <input class="input-txt" id="sys_pass" type="password" name="password" placeholder="password please!">
                </label>
                <!--<label class="wrap-check" for="sys_chk_news">
                  <input id="sys_chk_news" class="input-chk" type="checkbox">
                  Remember me <i class="icon iUncheck"></i> <a class="lost-pass" href="#">Forgot password ?</a> </label>-->
                <div class="wrap-login-btn">
                  <button class="btn-flat gr btn-submit-reg" type="button" id="loginSub">Login</button>
                  <div class="sep-connect"> <span>Or</span> </div>
                  <div class="grp-connect"> <a class="btn-flat fb" href="<?= site_url('loginfb') ?>">Facebook</a> <a class="btn-flat gg" href="<?= $authUrl ?>">Google</a> </div>
                </div>
              </div>
              <div class="right-create-acc"> <img class="account" src="<?=site_url('front/views/themes/default');?>/asset/images/reg-account.png" alt="Savetakatak.com">
                <p class="lbl-dung-lo rs">Not a member? Don’t worry</p>
                <a id="sys_link_reg_panel" href="#" class="btn-flat yellow btn-submit-reg">Create an account</a>
                <div id="sys_warning_sms" class="warning-sms" data-warning-txt="No spam guarantee,No disturb,Promotion News"></div>
              </div>
            </form>
            <i class="line-sep"></i> </div>
        </div>
        <!--end: Login panel -->
        <div class="mod-register">
          <h3 class="rs title-mod">Hello shoppers! Welcome to Savetakatak.com</h3>
          <div class="desc-reg">Sign up for free and get exclusive access to members-only savings, rewards and special promotions from Coupons.com. Enter in an email and a password or sign up with Facebook.</div>
          <div class="wrap-form-reg clearfix">
             <?php 
                        $attributes = array('class' => 'form-horizontal', 'id' => 'RegisForm','name'=>'sentMessage' );

                        echo form_open('login/signupjs', $attributes);  ?>
              <div class="left-form">
              <label class="wrap-txt" for="sys_email_reg">
                  <input class="input-txt" id="sys_email_reg" type="text" placeholder="username" name="username" />
                </label>
                <label class="wrap-txt" for="sys_email_reg">
                  <input class="input-txt" id="sys_email_reg" type="email" placeholder="your@mail.com" name="email" />
                </label>
                <label class="wrap-txt" for="sys_pass_reg">
                  <input class="input-txt" id="sys_pass_reg" type="password" placeholder="password please!" name="password"/>
                </label>
                 <label class="wrap-txt" for="sys_pass_reg">
                  <input class="input-txt" id="sys_pass_reg" type="password" placeholder="confirm password please!" name="cpassword"/>
                </label>
               
                <label class="wrap-check" for="sys_chk_agree">
                  <input id="sys_chk_agree" class="input-chk" type="checkbox" name="agree" value="yes"/>
                  I agree to the <a href="<?=site_url('term-condition');?>">Terms of Use</a> and <a href="<?=site_url('privacy');?>">Privacy Policy</a>. <i class="icon iUncheck"></i> </label>
              </div>
              </form>
              <div class="right-connect">
                <button class="reg btn-flat yellow btn-submit-reg" id="reg" type="button">Create an account</button>
                
                 <div id="success3"></div>
                <div class="sep-connect"> <span>Or</span> </div>
                <div class="grp-connect">
                  <p class="rs">Sign up using your account on:</p>
 <a class="btn-flat fb" href='<?= site_url('loginfb') ?>'>Facebook</a>
                                            <a class="btn-flat gg" href="<?= $authUrl ?>">Google</a>
                
                 

              </div>
            
          </div>
          <p class="rs wrap-link-back"> <a id="sys_link_login_panel" href="#" class="link-back"> <i class="pick-r"></i> Back to login </a> </p>
        </div>
      </div>
      <div id="sys_paging_state" class="paging-state"> <i class="active"></i> <i></i> </div>
      <i id="sys_close_login_popup" class="icon iClose close-popop"></i> </div>
  </div>
  
</header>
 

  <!-- Modal -->
 
  <script src="<?=site_url('front/views/themes/default');?>/asset/scripts/jquery.js"></script>
<script src="<?=site_url('front/views/themes/default');?>/asset/scripts/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?=site_url('front/views/themes/default');?>/asset/scripts/bootstrap.min.js"></script>

<script>
jQuery(document).ready(function($) {
    jQuery("*").find("a[href='"+window.location.href+"']").each(function(){
        jQuery(this).addClass("active");
        //add additional code here if needed
    })
}); 
  </script>
 
<!-- Login & Sign Up -->
<script type="text/javascript">
function showMessage(n,t){var i="<div class='notification'>"+t+"<\/div>  ";$(".notification").remove();$("body").append(i);setTimeout(function(){$(".notification").fadeOut(2e3,function(){$(this).remove()})},8e3)}

</script>
<!-- Login & Sign Up -->

<script type="text/javascript">
document.getElementById('loginForm').onkeydown = function(event) {
if (event.keyCode == 13) {
        $('#loginSub').click();
    }
}
     $('#loginSub').click(function(e){
        e.preventDefault()

        var form = $('#loginForm');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
                window.location  = '<?=site_url('home');?>';
            };
            showMessage(response.Type,response.Message);
          }
        });

    });
    $('#reg').click(function(e){
		//alert('hiii');
        e.preventDefault()
        var form = $('#RegisForm');
		//alert(form);
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
		
          success: function( response ) {
			 // alert('hello');
            if (response.n) {
				//console.log(response.n);
               window.location  = '<?=site_url('home');?>';
			   
            };
			
            showMessage(response.Type,response.Message);
          }
        });
    });
	$('#nav ul li').click(function(){
    $(this).parent().find('li.active').removeClass('active');
    $(this).addClass('active');
});
	</script>
  
 