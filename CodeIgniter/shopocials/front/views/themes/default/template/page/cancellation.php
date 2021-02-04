<!DOCTYPE html>
<html lang="en">
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
                    <h2>Cancellation</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cancellation</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->


<!--section start-->
<section class="faq-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="accordion theme-accordion">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Cancellation
                                </button>
                            </h5>
                        </div>
                            <div class="card-body">
                                <p>
                                   You don’t need to panic if you order any product on our website, but later didn’t find it up to your expectations. Yes, you can cancel your order whenever you want within a couple of days after receiving your order. For cancellation, all you need to do is enter in My Orders in My Account and click on cancel button against your order.<br><br>
                                    Our executives will cancel your order and you can get your refund within minimum time. Usually, it takes 1-2 business days of cancellation of any placed order and initiating the refund if applicable. But keep in mind that if an order is shipped already, you have to follow our return and exchange policies. In short, you don’t need to feel cheated by thinking that your money is gone once you place any order but don’t like it after receiving. Very easily you can choose to return it just by following our return policy soon after receiving and without any complication we will refund the full amount into your account. 
                                </p><br>
                                <p>
                                    <b>How long it takes to refund?</b><br>
                                    After cancellation, another important factor is how and when you can receive spent amount, so here is the answer to your query. Generally, the procedure takes 4-9 working days that are counted from the initiation date of refund. Once the cancellation is done, you will be informed via mail regarding this. However, if you have used Credit Card/Debit Card/Net banking as payment mode, we will refund your amount in the same account which you had used for making payment. If you choose to select the Cash on Delivery option, no amount is due to be refunded because you haven't paid while placing your order.<br>
                                </p><br>
                                <p>
                                    <b>Should you have any query?</b><br>
                                    Feel free to have a word with our executives at info.shopocial@gmail.com for any kind of concerns.<br>
                                </p>
                            </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

<!-- End About Section Start -->

<!-- footer -->
<?php echo Modules::run('footer/footer/index'); ?>
<!-- footer end -->

<!-- Start Model Pop-up -->
<?php //$this->load->view("Quick-view_modal_popup");?>
<!-- End Model Pop- Up -->

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
<script src="<?php echo base_url();?>front/views/themes/default/js/script.js" ></script>
<script>
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