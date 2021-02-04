<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/multikart/LTR/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Feb 2019 10:54:11 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    <title>Multikart - Multi-purpopse E-commerce Html Template</title>
    <!-- CSS Links -->
<link rel="icon" href="<?php echo base_url();?>front/views/themes/default/img/images/favicon/1.png" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo base_url();?>front/views/themes/default/img/images/logos/favicon.png" type="image/x-icon">
<!--Google font-->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!-- Icons -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front/views/themes/default/css/fontawesome.css">
<!--Slick slider css-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front/views/themes/default/css/slick.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front/views/themes/default/css/slick-theme.css">
<!-- Animate icon -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front/views/themes/default/css/animate.css">
<!-- Themify icon -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front/views/themes/default/css/themify-icons.css">
<!-- Bootstrap css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front/views/themes/default/css/bootstrap.css">
<!-- Theme css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front/views/themes/default/css/color1.css" media="screen" id="color">
<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front/views/themes/default/css/custom.css">
</head>
<body>

<!-- pre-loader start -->
<div class="loader-wrapper">
    <div class="loader"></div>
</div>
<!-- pre-loader end -->

<!-- header start -->
<?php echo Modules::run('header/header/index'); ?>
<!-- header end -->

<!--Start  About Section Start  -->

<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>customer's login</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                        <li class="breadcrumb-item active">login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!--section start-->
<section class="login-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3>Login</h3>
                <div class="theme-card">
                    <form action="<?= site_url('account/validateLogin') ?>" method="post" name="customer_login" class="theme-form">
                        <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-dismissable alert-danger">
                        <i class="fa fa-warning"></i>
                            <?php 
                                echo $this->session->flashdata('error');
                             ?>
                        <div class="pull-right">
                            <i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
                        </div>
                    </div>
                    <?php } ?>

                    <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-dismissable alert-success">
                        <i class="fa fa-check-circle"></i>
                            <?php 
                                echo $this->session->flashdata('success');
                             ?>
                         <div class="pull-right">
                            <i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
                        </div>
                    </div>
                    <div class="mt-xl"></div> 
                    <?php } ?>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="review">Password</label>
                            <input type="password" class="form-control" id="review" placeholder="Enter your password" name="password">
                        </div>
                        <button type="submit" class="btn btn-solid" tabindex="">login</button>
                        <a href="<?php echo site_url('account/forgotpassword');?>" class="btn btn-solid">Forget Password</a>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 right-login">
                <h3>New Customer</h3>
                <div class="theme-card authentication-right">
                    <h6 class="title-font">Create A Account</h6>
                    <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.</p><a href="<?php echo site_url('account/register'); ?>" class="btn btn-solid">Create an Account</a></div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->
<!-- End About Section Start -->


<!--  logo section -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="slide-6 no-arrow">
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/front/views/themes/default/img/images/logos/1.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/front/views/themes/default/img/images/logos/2.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/front/views/themes/default/img/images/logos/3.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/front/views/themes/default/img/images/logos/4.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/front/views/themes/default/img/images/logos/5.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/front/views/themes/default/img/images/logos/6.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/front/views/themes/default/img/images/logos/7.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/front/views/themes/default/img/images/logos/8.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  logo section end-->

<!-- footer -->
<?php echo Modules::run('footer/footer/index'); ?>
<!-- footer end -->

<!--modal popup start-->

<!-- Quick-view modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="quick-view-img"><img src="assets/images/pro3/1.jpg" alt="" class="img-fluid"></div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">
                            <h2>Women Pink Shirt</h2>
                            <h3>$32.96</h3>
                            <ul class="color-variant">
                                <li class="bg-light0"></li>
                                <li class="bg-light1"></li>
                                <li class="bg-light2"></li>
                            </ul>
                            <div class="border-product">
                                <h6 class="product-title">product details</h6>
                                <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium</p>
                            </div>
                            <div class="product-description border-product">
                                <div class="size-box">
                                    <ul>
                                        <li class="active"><a href="#">s</a></li>
                                        <li><a href="#">m</a></li>
                                        <li><a href="#">l</a></li>
                                        <li><a href="#">xl</a></li>
                                    </ul>
                                </div>
                                <h6 class="product-title">quantity</h6>
                                <div class="qty-box">
                                    <div class="input-group"><span class="input-group-prepend"><button type="button" class="btn quantity-left-minus" data-type="minus" data-field=""><i class="ti-angle-left"></i></button> </span>
                                        <input type="text" name="quantity" class="form-control input-number" value="1"> <span class="input-group-prepend"><button type="button" class="btn quantity-right-plus" data-type="plus" data-field=""><i class="ti-angle-right"></i></button></span></div>
                                </div>
                            </div>
                            <div class="product-buttons">
                                <a href="#" class="btn btn-solid">add to cart</a> 
                                <a href="<?php echo base_url()?>productdetail" class="btn btn-solid">view detail</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick-view modal popup end-->

<!-- facebook chat section start -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="2123438804574660"
     theme_color="#0084ff"
     logged_in_greeting="Hi! Welcome to PixelStrap Themes  How can we help you?"
     logged_out_greeting="Hi! Welcome to PixelStrap Themes  How can we help you?">
</div>
<!-- facebook chat section end -->

<!-- tap to top -->
<div class="tap-top top-cls">
    <div>
        <i class="fa fa-angle-double-up"></i>
    </div>
</div>
<!-- tap to top end -->

<!-- JSS Links -->
<script src="<?php echo base_url();?>front/views/themes/default/js/jquery-3.3.1.min.js" ></script>
<!-- fly cart ui jquery-->
<script src="<?php echo base_url();?>front/views/themes/default/js/jquery-ui.min.js"></script>
<!-- popper js-->
<script src="<?php echo base_url();?>front/views/themes/default/js/popper.min.js" ></script>
<!-- slick js-->
<script src="<?php echo base_url();?>front/views/themes/default/js/slick.js"></script>
<!-- menu js-->
<script src="<?php echo base_url();?>front/views/themes/default/js/menu.js"></script>
<!-- Bootstrap js-->
<script src="<?php echo base_url();?>front/views/themes/default/js/bootstrap.js" ></script>
<!-- Bootstrap Notification js-->
<script src="<?php echo base_url();?>front/views/themes/default/js/bootstrap-notify.min.js"></script>
<!-- Fly cart js-->
<script src="<?php echo base_url();?>front/views/themes/default/js/fly-cart.js" ></script>
<!-- Theme js-->
<script src="<?php echo base_url();?>front/views/themes/default/js/script.js" ></script><script>
    $(window).on('load',function(){
        $('#exampleModal').modal('show');
    });
    function openSearch() {
        document.getElementById("search-overlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("search-overlay").style.display = "none";
    }
</script>
</body>
</html>