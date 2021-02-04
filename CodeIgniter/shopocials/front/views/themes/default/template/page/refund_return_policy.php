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
                    <h2>Return & Refund Policy</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Return & Refund Policy</li>
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
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Return & Refund Policy
                                </button>
                            </h5>
                        </div>
                            <div class="card-body">
                                <p>
                                Thanks for shopping at www.shopocial.com
                                </p><br>
                                <p>
                                If you are not entirely satisfied with your purchase, we're here to help.
                                </p><br><br>
                                <p>
                                    <b>Returns</b><br>
                                    You have 7 calendar days to return an item from the date you received it.<br>
                                    To be eligible for a return, your item must be unused and in the same condition that you received it.<br>
                                    Your item must be in the original packaging.<br>
                                    Your item needs to have the receipt or proof of purchase.<br>
                                </p><br><br>
                                <p>
                                    <b>Refunds</b><br>
                                    Once we receive your item, we will inspect it and notify you that we have received your returned
                                    item. We will immediately notify you on the status of your refund after inspecting the item.<br>
                                    If your return is approved, we will initiate a refund to your credit card (or original method of payment).<br>
                                    You will receive the credit within a certain amount of days, depending on your card issuer's policies.<br>
                                </p><br><br>
                                <p>
                                    <b>Shipping</b><br>
                                    To return your product, you should mail your product to: shopocial (attn. nidhi dudhatra) 9-B, Jivraj park society, Ahmedabad, Gujrat-INDIA, Vejalpur road, Vejalpur road, Ahmedabad, GJ 38005 India.<br>
                                    You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are non-refundable. If you receive a refund, the cost of return shipping will be deducted from your refund.<br>
                                    Depending on where you live, the time it may take for your exchanged product to reach you, may vary.<br>
                                    If you receive a refund, the cost of return shipping will be deducted from your refund.<br>
                                </p><br><br>
                                <p>
                                    <b>Contact Us</b><br>
                                    If you have any questions on how to return your item to us, contact us.
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