
<footer>
    <!-- Footer Top -->
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-3 abt_sec">
                    <h2 class="foot_title">
                   About <?php echo $site_name; ?>
                </h2>
                    <p><?php echo $aboutus; ?></p>
                </div>
                <!-- Latest Tweets -->
                <div class="col-md-3">
                    <h2 class="foot_title">
                   Social Media 
                </h2>
                <div class="soc_ico" id="soc_ico_footer">
                  <ul>
                    <?php if (isset($googleplus)): ?>
                    <li class="insta">
                        <a href="<?php echo $googleplus?>">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <?php endif?>

                    <?php if (isset($twitter)): ?>

                    <li class="tweet">
                        <a href="<?php echo $twitter?>">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <?php endif?>
                    <?php if (isset($facebook)): ?>
                    <li class="fb">
                        <a href="<?php echo $facebook?>">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <?php endif?>
                    <?php if (isset($instagram)): ?>
                    <li class="insta">
                        <a href="<?php echo $instagram?>">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                    <?php endif?>
                </ul>             
                </div>
                </div>
                <!-- Contact Info -->
                <div class="col-md-3">
                    <h2 class="foot_title">
                   Contact Info
                </h2>
                    <ul class="cont_info">
                        <li><i class="fa fa-map-marker"></i>
                            <p><?php echo $address; ?> </p>
                        </li>
                        <li><i class="fa fa-phone"></i>
                            <p> <a href="tel:<?php echo $phone ?>"> Phone: <?php echo $phone ?> </a> </p>
                        </li>
                        <li><i class="fa fa-envelope"></i>
                            <p> <a href="mailto:<?php echo $email_address ?>"> Email: <?php echo $email_address ?> </a> </p>
                        </li>
                    </ul>

                </div>
                <!-- Useful Links -->
                <div class="col-md-3">
                    <h2 class="foot_title">
                            Useful Links
                        </h2>
                    <ul class="foot_nav">
                        <?php foreach ($page as $p): ?>
                         <li> <a href="<?php echo site_url($p->unique_alias) ?>"><?php echo ucfirst($p->title) ?></a> </li>
                        <?php endforeach ?>
                         <li> <a href="<?php echo site_url('last-10-sold') ?>">Last 10 Sold</a> </li>
                        <li> <a href="<?php echo site_url('last-10-rent') ?>">Last 10 Rent</a> </li>
                        <!--  <li> <a href="<?php echo site_url('terms-and-conditions') ?>">Terms and Conditions</a> </li>
                         -->
                    </ul>

                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

    </div>
    <!-- Copyright -->
    <div class="footer_copy_right">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <p>&copy; Copyright <?php echo date('Y') ?>. All Rights Reserved by <a href="#"> <?php echo ucfirst($title) ?> </a>
                    </p>
                </div>
                 <div class="col-sm-6 text-right">
                    <p>Developed by <a href="http://www.krafty.in?utm_source=Labhchar&utm_medium=Footer" target="_blanck">KRAFTY</a>
                    </p>
                </div>
                
            </div>
        </div>
    </div>
</footer>
<!-- Modal HTML -->
<div id="login_box" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="log_form">
                    <h2 class="frm_titl"> Login Form </h2>
                    <!-- <form name="sentMessage" id="loginForm" > -->
                         <?php 
                        $attributes = array('class' => 'form-horizontal', 'id' => 'loginForm','name'=>'sentMessage' );
                        echo form_open('login/validateLoginJs', $attributes);  ?>

                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="text" class="form-control" id="u-name" name="userName" required placeholder="Email">
                                <p class="help-block"></p>
                            </div>

                            <div class="controls">
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                                <p class="help-block"></p>
                            </div>
                            <div class="forg_pass col-md-6 ">
                                <a href="#forgetbox"  data-toggle="modal"> Forgot your password?  </a>
                            </div>
                            <div class="clearfix"></div>

                            <button type="button" class="loginSub btn btn-primary">Sign In</button>
                            <div id="success2"></div>
                            <!-- For success/fail messages -->
                            
                            
                            <div class="socialsignin">
                                
                                <div class="or">OR</div>
                                
                                <div id="facebook-container" style="margin-bottom: 30px;">
                                    <a class="facebooksignin" href="<?= site_url('fb/login') ?>">
                                        <span>
                                            <i class="fa fa-facebook"></i>
                                        </span>
                                        <text>Sign in with Facebook</text>
                                    </a>
                                </div>
                                <div id="google-container">
                                    <a class="googlesignin" href="<?= site_url('gplus') ?>"><span>
                                            <i class="fa fa-google-plus"></i>
                                        </span>
                                        <text>Sign in with Google</text>
                                    </a>
                                </div>
                            </div>
                            <!-- For success/fail messages -->
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="forgetbox" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="log_form">
                    <h2 class="frm_titl"> Forget Password </h2>
                    <!-- <form name="sentMessage" id="loginForm" > -->
                         <?php 
                        $attributes = array('class' => 'form-horizontal', 'id' => 'forgetpw','name'=>'sentMessage' );
                        echo form_open('login/forgetpw', $attributes);  ?>

                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="text" class="form-control" id="email" name="email" required placeholder="Email">
                                <p class="help-block"></p>
                            </div>
                            <div class="clearfix"></div>

                            <button type="button" class="forgetpw btn btn-primary">Submit</button>
                            <div id="success2"></div>
                            
                            <div class="socialsignin">
                                
                                <div class="or">OR</div>
                                
                                <div id="facebook-container" style="margin-bottom: 30px;">
                                    <a class="facebooksignin" href="<?= site_url('fb/login') ?>">
                                        <span>
                                            <i class="fa fa-facebook"></i>
                                        </span>
                                        <text>Sign in with Facebook</text>
                                    </a>
                                </div>
                                <div id="google-container">
                                    <a class="googlesignin" href="<?= site_url('gplus') ?>"><span>
                                            <i class="fa fa-google-plus"></i>
                                        </span>
                                        <text>Sign in with Google</text>
                                    </a>
                                </div>
                            </div>
                            <!-- For success/fail messages -->
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="reg_box" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="log_form">
                    <h2 class="frm_titl"> Create Account </h2>
                    <!-- <form name="sentMessage" id="RegisForm" novalidate> -->
                         <?php 
                        $attributes = array('class' => 'form-horizontal', 'id' => 'RegisForm','name'=>'sentMessage' );

                        echo form_open('login/signupjs', $attributes);  ?>
                        <div class="control-group form-group">
                            
                            <div class="controls">
                                <input type="email" class="form-control" id="first_name" name="first_name" required  placeholder="Name">
                                <p class="help-block"></p>
                            </div>
                            <div class="controls">
                                <input type="email" class="form-control" id="e-mail" name="email" required  placeholder="Email">
                                <p class="help-block"></p>
                            </div>
                            <div class="controls">
                                <input type="text" class="form-control" id="phone" name="phone" required  placeholder="Phone">
                                <p class="help-block"></p>
                            </div>

                            <div class="controls">
                                <input type="password" class="form-control" id="passd" name="password" required placeholder="Password">

                                <p class="help-block"></p>
                            </div>
                            <div class="controls">
                                <input type="password" class="form-control" id="re-passd" name="repassword" required placeholder="Retype Password">

                                <p class="help-block"></p>
                            </div>

                            <button type="button"  class="reg btn btn-primary">Create Account</button>
                            
                            <div id="success3"></div>
                            <!-- For success/fail messages -->
                            
                            <div class="socialsignin">
                                
                                <div class="or">OR</div>
                                
                                <div id="facebook-container" style="margin-bottom: 30px;">
                                    <a class="facebooksignin" href="<?= site_url('fb/login') ?>">
                                        <span>
                                            <i class="fa fa-facebook"></i>
                                        </span>
                                        <text>Sign in with Facebook</text>
                                    </a>
                                </div>
                                <div id="google-container">
                                    <a class="googlesignin" href="<?= site_url('gplus') ?>"><span>
                                            <i class="fa fa-google-plus"></i>
                                        </span>
                                        <text>Sign in with Google</text>
                                    </a>
                                </div>
                            </div>
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="" id="mainSpinner">
<div class="loading">Loading&#8230;</div>
 </div>

<!-- jQuery -->
<script src="front/views/themes/default/assets/scripts/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="front/views/themes/default/assets/scripts/bootstrap.min.js"></script>

<!-- Owl Carousel JavaScript -->
<script src="front/views/themes/default/assets/scripts/owl.carousel.min.js"></script>

<!-- Flexslider JavaScript -->
<script src="front/views/themes/default/assets/scripts/jquery.flexslider-min.js"></script>


<!-- Script to Activate the Carousels -->
<script type="text/javascript">
$('#mainSpinner').hide();
    (function($) {
        'use strict';
        $(document).ready(function() {
            $("#owl-carousel").owlCarousel({
                items: 5,
                itemsDesktop: [1199, 5],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1],
                navigation: true,
                navigationText: [
                    "<i class='fa fa-chevron-left icon-white'></i>",
                    "<i class='fa fa-chevron-right icon-white'></i>"
                ],
                autoPlay: false,
                pagination: false
            });

            $("#slide_pan").owlCarousel({
                items: 1,
                itemsDesktop: [1199, 1],
                itemsDesktopSmall: [979, 1],
                itemsTablet: [768, 1],
                itemsMobile: [479, 1],
                navigation: true,
                navigationText: [
                    "<i class='fa fa-chevron-left icon-white'></i>",
                    "<i class='fa fa-chevron-right icon-white'></i>"
                ],
                autoPlay: false,
                pagination: false
            });

            $(".testim_sec").owlCarousel({
                items: 2,
                itemsDesktop: [1199, 2],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 1],
                itemsMobile: [479, 1],
                navigation: true,
                navigationText: [
                    "<i class='fa fa-chevron-left icon-white'></i>",
                    "<i class='fa fa-chevron-right icon-white'></i>"
                ],
                autoPlay: false,
                pagination: false
            });


            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false
            });
            $('ul.drop_menu [data-toggle=dropdown]').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).parent().siblings().removeClass('open');
                $(this).parent().toggleClass('open');
            });
        });
    })(jQuery);
</script>
<!-- some functions used in script -->
<script type="text/javascript">
function showMessage(n,t){var i="<div class='notification'>"+t+"<\/div>  ";$(".notification").remove();$("body").append(i);setTimeout(function(){$(".notification").fadeOut(2e3,function(){$(this).remove()})},8e3)}

</script>
<!-- Login & Sign Up -->
<?php  $link = $this->session->userdata('last_page') ? $this->session->userdata('last_page')  : site_url() ; ?>

<script type="text/javascript">
document.getElementById('loginForm').onkeydown = function(event) {
if (event.keyCode == 13) {
        $('.loginSub').click();
    }
}
     $('.loginSub').click(function(e){
        e.preventDefault()

        var form = $('#loginForm');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
                window.location  = '<?php echo $link ?>';
            };
            showMessage(response.Type,response.Message);
          }
        });

    });
    $('.reg').click(function(e){
        e.preventDefault()
        var form = $('#RegisForm');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
               window.location  = '<?php echo site_url("package") ?>';
            };
            showMessage(response.Type,response.Message);
          }
        });
    });
    $('.forgetpw').click(function(e){
        e.preventDefault()
        var form = $('#forgetpw');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
                window.location.reload();
            };
            showMessage(response.Type,response.Message);
          }
        });
    });

$('#mainSpinner').bind('ajaxStart', function(){
    
    $(this).show();
}).bind('ajaxStop', function(){
    $(this).hide();
});

$(document).on('ajaxSend', function(){
    $("#mainSpinner").show();
   
}).on('ajaxComplete', function(){
    $("#mainSpinner").hide();
    
});
    
</script>
