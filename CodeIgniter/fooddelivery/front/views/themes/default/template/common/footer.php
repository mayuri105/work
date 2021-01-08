
<div class="site-footer-wrapper">
    <footer class="site-footer footer-container">
        <div class="links match-media-small">
            <div class="quick-links">
                <div class="footer-nav">
                    <nav >
                        <ul>
                            <div id="maincontainer">
                                <div id="leftcolumn">
                                    <?php foreach ($page as $p): ?>
                                    <li class="menu-items text-footer"><a href="<?php echo site_url('page/show/'.$p->unique_alias.'') ?>" ><?= ucfirst($p->title); ?></a></li>
                                    <?php endforeach ?>
                                    <li class="menu-items text-footer"><a href="<?php echo site_url('page/merchant/') ?>" ><?= ucfirst('Merchant Signup'); ?></a></li>
                                                                            
                                </div>
                                <div id="contentwrapper">
                                    <div id="rightcolumn">
                                        <li class="menu-items icons"><a href="<?= $googleplus ?>" class="icon-google-plus-g" target="_blank"></a></li>
                                        <li class="menu-items icons"><a href="<?= $instagram ?>" class="icon-instagram" target="_blank"></a></li>
                                        <li class="menu-items icons"><a href="<?= $twitter ?>" class="icon-twitter-bird" target="_blank"></a></li>
                                        <li class="menu-items icons"><a href="<?= $facebook ?>" class="icon-facebook-f" target="_blank"></a></li>
                                    </div>
                                    <div id="contentcolumn">
                                        <li class="menu-items images-stores apple"><a href="<?= $appstorelink ?>" target="_blank"></a></li>
                                        <li class="menu-items images-stores google"><a href="<?= $playstorelink ?>" target="_blank"></a></li>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="legal" >
            
            <div class="disclaimer">
                    <span class="terms">&nbsp;By using our site you agree to our <a href="<?= site_url('page/show/terms-of-use') ?>">Terms of Use</a>. Read our <a href="<?= site_url('page/show/privacy-policy') ?>">Privacy Policy</a>.</span>
                    <span class="copyright">© <?php echo date('Y') ?> . All rights reserved.</span>
            </div>
        </div>
    </footer>
</div>
<script>
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            $('.sticky-search').addClass('visible');
        }
        else
        {
            $('.sticky-search').removeClass('visible');
        }
    });
</script>
<div modal-animation-class="fade" class="modal-backdrop fade in ng-hide" modal-backdrop="modal-backdrop" modal-animation="true" style="z-index: 1040;"></div>
<div class="login-modal">
    <div modal-animation-class="fade" class="modal fade user-login-modal in ng-hide" role="dialog" tabindex="-1" modal-render="true" modal-window="modal-window" window-class="user-login-modal" index="0" animate="animate" modal-animation="true" style="z-index: 1050; display: block;">
        <div class="modal-dialog">
            <div modal-transclude="" class="modal-content">
                <div class="user-login-modal">
                    <div class="modal-header">
                        <button aria-hidden="true" class="close" type="button">x</button>
                        <h3>Log in to your account</h3>
                        <div class="ng-hide">
                            <h3>Need to reset your password?</h3>
                            <h3 class="ng-hide">Check Your Inbox</h3>
                            <div class="sub-title-text">Enter your email address below</div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class="ng-pristine ng-valid ng-valid-email" id="loginform" action="" method="post">
                            <div class="error-messages-container" style="display:none">
                                <!-- ngRepeat: message in login.messages -->
                                <!-- end ngRepeat: message in login.messages -->
                            </div>
                            <div class="form-field email">
                                <input type="email" id="email" name="email" id="email" placeholder="Email address"  required>
                            </div>
                            <div class="form-field password">
                                <input type="password" id="password" name="password" id="password" placeholder="Password" required>
                            </div>
                            <div class="form-field sign-in">
                                <button value="Log in" id="login" class="button primary" type="button">
                                <span class="contents" >
                                    <span class="contents">
                                        <span>Log in</span>
                                    </span> 
                                    <span class="spinner"></span>
                                </span>
                                    <span class="spinner"></span>
                                </button>
                            </div>
                            <div class="form-field remember-me"><label><input type="checkbox" id="remember-me-chk" class="ng-pristine ng-untouched ng-valid"> Keep me logged in to my account</label></div>
                            <div class="forgot-password"><a class="forget-click">Forgot your password?</a></div>
                        </form>
                        <form class="ng-pristine ng-valid ng-valid-email ng-hide">
                            <div class="form-field"><input type="email" placeholder="Email address" class="ng-pristine ng-untouched ng-valid ng-valid-email"></div>
                            <div class="form-field"><button value="Submit" class="button primary" id="login" dcom-processing="false" type="submit"><span class="contents"><span class="contents"><span>Submit</span></span> <span class="spinner"></span></span><span class="spinner"></span></button></div>
                            <div class="forgot-password-cancel close"><a>Cancel</a></div>
                        </form>
                        <div>
                            <div class="success-message ng-hide">We sent a password reset link to your email address. Please click the link in the email to create a new password.<br><br>The link will only be active for 1 hour. After that, you will need to request a new one.</div>
                        </div>
                        <div class="signup">
                            <div class="text">
                                <h3>New to delivery.com?</h3>
                                <span>Sign up <a href="javascript:void(0);" class="sign-in-click">here</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- signup-->
<div class="signup-modal">
    <div modal-animation-class="fade" class="modal fade user-signup-modal in ng-hide" role="dialog" tabindex="-1" modal-render="true" modal-window="modal-window" window-class="user-signup-modal" index="0" animate="animate" modal-animation="true" style="z-index: 1050; display: block;">
        <div class="modal-dialog">
            <div modal-transclude="" class="modal-content">
                <div class="user-signup-modal">
                    <div class="modal-header">
                        <button aria-hidden="true" class="close" type="button">x</button>
                        <div>
                            <h3>Create your account</h3>                        
                        </div>                    
                    </div>
                    <div class="modal-body">
                        <div class="error-messages-container" style="display:none">
                               
                         </div>
                        <form name="signup_form" novalidate="" class="ng-pristine ng-invalid ng-invalid-required ng-valid-email ng-valid-pattern ng-valid-minlength">
                            <div class="form-field">
                                
                                <input type="text" placeholder="First name" required="" name="firstname" id="firstname" class="ng-pristine ng-untouched ng-invalid ng-invalid-required">
                            </div>
                            <div class="form-field">
                               <input type="text" placeholder="Last name" required="" name="lastname" id="lastname" class="ng-pristine ng-untouched ng-invalid ng-invalid-required">
                            </div>
                            <div class="form-field">
                               <input type="email" placeholder="Email address" name="sigemail" id="sigemail" required="" class="ng-pristine ng-untouched ng-valid-email ng-invalid ng-invalid-required ng-valid-pattern">
                            </div>
                            <div class="form-field">
                                 <input type="password" placeholder="Password" required="" id="signup_pass" name="signup_pass" class="ng-pristine ng-untouched ng-invalid ng-invalid-required ng-valid-minlength">
                            </div>
                            <div class="sign-in">
                                <button class="button primary" id="signup" dcom-processing="false" type="button">
                                    <span class="contents"><span>Sign up</span></span><span class="spinner"></span>
                                </button>
                            </div>
                            <div class="form-field remember-me"><label><input type="checkbox" id="remember-me-chk" class="ng-pristine ng-untouched ng-valid"> Keep me logged in to my account</label></div>
                        </form>
                        <div class="signup">
                            <div class="text">
                                <h3>Already have an account?</h3>
                                <span>Log in <a class="login-nav-item2">here</a></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- forget password -->

<div class="forget-modal">
    <div modal-animation-class="fade" class="modal fade user-login-modal in ng-hide" role="dialog" tabindex="-1" modal-render="true" modal-window="modal-window" window-class="user-login-modal" index="0" animate="animate" modal-animation="true" style="z-index: 1050; display: block;">
        <div class="modal-dialog">
            <div modal-transclude="" class="modal-content">
                <div class="user-login-modal">
                    <div class="modal-header">
                        <button aria-hidden="true" class="close" type="button">x</button>                    
                        <div class="">
                            <h3>Need to reset your password?</h3>
                            <h3 class="ng-hide">Check Your Inbox</h3>
                            <div class="sub-title-text">Enter your email address below</div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="error-messages-container" style="display:none">
                                <!-- ngRepeat: message in login.messages -->
                                <!-- end ngRepeat: message in login.messages -->
                         </div>
                        <form class="ng-pristine ng-valid ng-valid-email" id="forgetpasswordfrm">
                            <div class="form-field"><input type="email" name="fogetemail" id="fogetemail" placeholder="Email address" class="ng-pristine ng-untouched ng-valid ng-valid-email"></div>
                            <div class="form-field">
                                <button value="button" class="button primary" id="forgetpassword" dcom-processing="false" type="button"><span class="contents" ><span class="contents"><span>Submit</span></span> <span class="spinner"></span></span><span class="spinner"></span></button></div>
                            <div class="forgot-password-cancel "><a>Cancel</a></div>
                        </form>
                        <div class="">
                            <div class="success-message"></div>
                        </div>
                        <div class="signup">
                            <div class="text">
                                <h3>New to delivery.com?</h3>
                                <span>Sign up <a class="sign-in-click">here</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.modal').click(function() {    
         $('.error-messages-container').hide();

    $('.modal-backdrop.fade.in , .modal').addClass('ng-hide');
});
//login
$('.login-nav-item , .login-modal .modal-dialog').click(function(event){
     event.stopPropagation();
     $('.error-messages-container').hide();
     $('.modal-backdrop , .login-modal .modal').removeClass('ng-hide');
     $('.signup-modal .modal ').addClass('ng-hide');
});
//signup
$('.sign-in-click , .signup-modal .modal-dialog').click(function(event){
     event.stopPropagation();
      $('.error-messages-container').hide();
     $('.modal-backdrop , .signup-modal .modal ').removeClass('ng-hide'); 
     $('.forget-modal .modal , .login-modal .modal').addClass('ng-hide');
});
//signup
$('.forget-click , .forget-modal .modal-dialog').click(function(event){
     event.stopPropagation();
     $('.button >.spinner').css("opacity", "0");
    $('.button >.spinner').css("display", "none");
    $('.button >.contents').css("display", "block");
      $('.error-messages-container').hide();
     $('.login-modal .modal').addClass('ng-hide');
     $('.modal-backdrop , .forget-modal .modal').removeClass('ng-hide');     
});

$(document).keyup(function(e) {  
  if (e.keyCode == 27) $('.modal').click();   // esc
});


$('.forgot-password-cancel,.close').click(function(event){
     event.stopPropagation();
   $('.modal').click();
});
function toggleAccountNav() {
    $('.header-module.hiw-nav ,.header-module.taf-nav').hide();    
    $('.header-module.account-nav').toggle();
    
   // $('.main-nav-item').addClass('active');
    
    
}
function toggleTafNav() {

    $('.header-module.hiw-nav , .header-module.account-nav').hide();    
    $('.header-module.taf-nav').toggle();
}
function toggleHiwNav() {
    $('.header-module.taf-nav , .header-module.account-nav').hide();    
    $('.header-module.hiw-nav').toggle();
}
function toggleHiwDisplay() {
     
     $('.header-module.hiw-nav').hide();
    $('.header-module.hiw-nav-laundry').toggle();
}
$('.login-nav-item2').click(function(event){
     event.stopPropagation();
    $('.button >.spinner').css("opacity", "0");
    $('.button >.spinner').css("display", "none");
    $('.button >.contents').css("display", "block");
    $('.error-messages-container').hide();
    $('.modal-backdrop , .login-modal .modal').removeClass('ng-hide');
    $('.signup-modal .modal ').addClass('ng-hide');
});
$('.home-tabs li').click(function() {
    $('.home-tabs li').removeClass('active');
    $(this).addClass('active');
});
$('#pickup-checkbox , #settings-toggle').click(function() {
    
    if ($(this).prop('checked')==true){ 
        $('.delivery-select').addClass('inactive');
        $('.pickup-select').removeClass('inactive').addClass('active');
    } else {
        $('.pickup-select').addClass('inactive');
        $('.delivery-select').removeClass('inactive').addClass('active');        
    }
});
</script>

<script type="text/javascript">

$('#login').click(function(){
    var data = {
        email :$('#email').val(),
        password :$('#password').val(),
    };
    
        $.ajax({
        url : "<?php echo site_url('login/validateLogin') ?>",
        type: "POST",
        dataType: "json",
        data: data,
        beforeSend: function() {
                $('.button >.spinner').css("opacity", "1");
                $('.button >.spinner').css("display", "block");
                $('.button >.contents').css("display", "none");
        },
        success:function(data){
            setTimeout(function(){
                if(data.response ==0 ){
                    $('.button >.spinner').css("opacity", "0");
                    $('.button >.spinner').css("display", "none");
                    $('.button >.contents').css("display", "block");
                    $('.error-messages-container').show();
                    $('.error-messages-container').html('<div  class="error-messages">'+data.error+'</div>');
                }else{
                    //console.log(data);
                    window.location.reload();
                }
            },3000);  
        }
    });
      
});

$('#forgetpassword').click(function(){
    var data = {
        email :$('#fogetemail').val(),
    };
        
        $.ajax({
        url : "<?php echo site_url('login/forgetpassword') ?>",
        type: "POST",
        dataType: "json",
        data: data,
        beforeSend: function() {
           
                $('.button >.spinner').css("opacity", "1");
                $('.button >.spinner').css("display", "block");
                $('.button >.contents').css("display", "none");
            
        },
        success:function(data){
            setTimeout(function(){
                if(data.response ==0 ){
                    $('.button >.spinner').css("opacity", "0");
                    $('.button >.spinner').css("display", "none");
                    $('.button >.contents').css("display", "block");
                    $('.error-messages-container').show();
                    $('.error-messages-container').html('<div  class="error-messages">'+data.error+'</div>');
                }else{
                    $('.success-message').html(''+data.msg+'');
                     $('.error-messages-container').hide();
                    $('.button >.spinner').css("opacity", "0");
                    $('.button >.spinner').css("display", "none");
                    $('.button >.contents').css("display", "block");
                    //window.location.reload();
                }
            },3000);  
        }
    });
      
});
$('#signup').click(function(){
    var data = {
        firstname :$('#firstname').val(),
        lastname :$('#lastname').val(),
        sigemail :$('#sigemail').val(),
        signup_pass :$('#signup_pass').val(),
    };
        
        $.ajax({
        url : "<?php echo site_url('login/signup') ?>",
        type: "POST",
        dataType: "json",
        data: data,
        beforeSend: function() {
           
                $('.button >.spinner').css("opacity", "1");
                $('.button >.spinner').css("display", "block");
                $('.button >.contents').css("display", "none");
            
        },
        success:function(data){
            setTimeout(function(){
                if(data.response ==0 ){
                    $('.button >.spinner').css("opacity", "0");
                    $('.button >.spinner').css("display", "none");
                    $('.button >.contents').css("display", "block");
                    $('.error-messages-container').show();
                    $('.error-messages-container').html('<div  class="error-messages">'+data.error+'</div>');
                }else{
                    
                    window.location.reload();
                }
            },3000);  
        }
    });
      
});
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?= $google_api_key;  ?>&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
<script type="text/javascript">
    
var placeSearch, autocomplete,autocomplete2;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

document.getElementById('loginform').onkeydown = function(event) {
if (event.keyCode == 13) {
        $('#login').click();
    }
}

function initAutocomplete() {
  autocomplete = new google.maps.places.Autocomplete(
    (document.getElementById('address-search')),
      {types: ['geocode']});
  autocomplete.addListener('place_changed', fillInAddress);

  autocomplete2 = new google.maps.places.Autocomplete
    (document.getElementById('address-search-sticky'), 
        { types: [ 'geocode' ] });
     autocomplete2.addListener('place_changed', fillInAddress2);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}


function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
       // Log autocomplete bounds here
       var place = autocomplete.getPlace();
      
    });

  }
}

var componentForm2 = {
  street_number_sticky: 'short_name',
  route_sticky: 'long_name',
  locality_sticky: 'long_name',
  administrative_area_level_1_sticky: 'short_name',
  country_sticky: 'long_name',
  postal_code_sticky: 'short_name'
};



function fillInAddress2() {
  // Get the place details from the autocomplete object.
  var place = autocomplete2.getPlace();

  for (var component in componentForm2) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm2[addressType]) {
      var val = place.address_components[i][componentForm2[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}



</script>