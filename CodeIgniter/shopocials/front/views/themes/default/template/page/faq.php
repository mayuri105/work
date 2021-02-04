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
                    <h2>FAQ</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
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
                <div class="accordion theme-accordion" id="accordionExample">

                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0"><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">What is My Account?</button></h5></div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Once you will register with us at shopocial.com, your account will be created and you will be allowed for viewing all your details, tracking your placed order, going through your wishlist, updating all your personal information such as address, contact number, email address as well as you can change your password. Moreover, you can place your orders by following instructions of "My Account".
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How do I know my order has been confirmed?</button></h5></div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Once you have made payment successfully, your order is processed with immediate effect. Our executives will send you a confirmation mail regarding the order you have placed at the email ID which is associated with your account with us. This email will let you get a “Unique Order ID” for your reference with our customer service team. Here you can find listing of the item(s) as well as expected delivery time for your orders. However, if you choose Cash on Delivery as payment mode for your order, we will send you a confirmation email.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Can I place an order for a product which is 'Out of Stock'?</button></h5></div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>No, it is just impossible to place an order for a product which is not in stock any longer.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Is it mandatory to get registered with shopocial for placing any order?</button></h5></div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                    Though it is not mandatory to have an account on shopocial.com to place any order, yet we suggest to have an account on shopocial.com because it is easy to shop just by using your email ID.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">How do I make a payment for an order at shopocial?</button></h5></div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                    We at shopocial.com offer several payment methods such as Net Banking, Debit Card, Credit Card, Bank Transfer, Cash on Delivery, etc. We assure our customers’ Credit/Debit card details to keep private and confidential. We and our trustworthy payment gateways apply SSL encryption technology in order to protect card’s information of the customers.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">What is Cash on Delivery?</button></h5></div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                    Cash-on-Delivery (COD) is one of the best possible payment methods to buy any product on shopocial.com. In the COD payment terms or COD service, buyers have to pay at the time of the delivery at their doorstep instead making payment in advance. Please keep in mind that the courier guy will hand over the ordered parcel only after collecting cash payment and it is not allowed to open the parcel before making payment to him. Should you have any concern after opening the parcel, you can contact us at customercare@shopocial.com
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSevan" aria-expanded="false" aria-controls="collapseSevan">Are there any charges for a COD purchase?</button></h5></div>
                        <div id="collapseSevan" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                   There may be COD charges applicable per product and it will be asked to the customers while placing an order on shopocial.com. COD orders for invoice of more than Rupees. 10,000 value will not be processed. Cash-on-Delivery option is offered with all the products available online, except those products where it is clearly mentioned in the description that “Cash on delivery is not available“. All you need to do is just adding the product (s) to your shopping cart and proceed to checkout.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingEight">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">How do I pay with a Credit/Debit card and would it be safe?</button></h5></div>
                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                   We at shopocial.com accept all types of cards such as VISA, MasterCard both Indian as well as International. Buyers are asked to provide their 16-digit Credit/Debit Card number along with 3 digit CVV Code which can be found on the back of the card) to make the payment successfully.<br><br>
                                   All of the details pertaining to Credit/Debit card of the buyers are kept confidential and private. We and our trusted payment gateways use SSL encryption technology for protecting the card information of the buyers.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingNine">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">What should I do if courier company asks to pay Octroi?</button></h5></div>
                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                   Octroi is a local tax which is collected by the state government or the city municipality on the products that are brought into the town for local use. Nagpur, Sangli, Dombivili, Nasik, Mumbai, Pimpri & Chinchwardi, Kothrud (Pune), Ahmednagar, Pune and Akola are some of the cities that come under Octroi. Any applicable octroi is paid by the recipients at the time of delivery. Customers are requested to pay Octroi to the courier company if asked by them in the above mentioned cities. shopocial.com do not take responsibility for the charges of octroi payment.
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" id="headingTen">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">How buyers can check the current status of their orders?</button></h5></div>
                        <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                  Buyers can check the status as well as other information of all their orders, whether pending or delivered from shopocial.com. In order to view the status of their pending order(s), simply click on the “Login” link in the top right of any page and login into My account. It will take them to their Account page, where they can click on the “My Orders” link to check the status of their orders.
                                  <br><br>
                                  Other than this, for checking the status of any specific order, just by clicking on the “Order Number”. Once an order is shipped out, our executives send a mail to buyers with all the shipping details.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingEleven">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">What does the below mentioned order status mean?</button></h5></div>
                        <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                 <b>Processing : </b>shopocial.com has received authorization from the payment gateway and your order is in process.<br>    
                                 <b>Dispatch : </b>We have shipped out your order and it will be delivered to your delivery location very soon.<br>
                                 <b>Complete : </b>An order has been delivered already at the specified delivery location.<br>
                                 <b>Canceled : </b>Your order has been canceled.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTwelve">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">When and how an order can be canceled?</button></h5></div>
                        <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                Buyers can cancel their order any time if they don’t find it fit into their expectations. All they need to do is clicking on Cancel button against the order in My Orders in My Account.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingThirteen">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">How are ordered items packaged?</button></h5></div>
                        <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                 In order to avoid any kind of damage, all of the ordered items are packaged very carefully at either company’s warehouses or our seller’s warehouses. We assure our buyers that their package is water proof with plastic wrap.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingFourteen">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">What are the delivery charges?</button></h5></div>
                        <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                 Generally, our sellers provide free delivery on most of the items all over India, only few specific items are sold with shipping charges that depends on the nature of the item. In case of International orders, shipping charges for different items may vary from country to country and it is clearly mentioned on the product page itself. Adding to this, prices for available items may also vary for different countries in order to account for shipping costs because sellers are free to decide their own prices. Moreover, prices listed in INR are valid only for Indian locations.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingFifteen">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">What is the estimated delivery time?</button></h5></div>
                        <div id="collapseFifteen" class="collapse" aria-labelledby="headingFifteen" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                 The estimated delivery timeof a placed order is 7 business days for orders in India and it can be 12-18 business days for the orders out of India.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingSixteen">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">How will the delivery be done?</button></h5></div>
                        <div id="collapseSixteen" class="collapse" aria-labelledby="headingSixteen" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                 shopocial.com process all the deliveries through highly reputed and trustworthy courier companies.<br><br>
                                 What if no courier service is available in any area, we try to reachout our valued buyers at best possible alternate delivery location that are served by our courier partners.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingSeventeen">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">Does Zipker deliver items internationally?</button></h5></div>
                        <div id="collapseSeventeen" class="collapse" aria-labelledby="headingSeventeen" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                Of course, we at shopocial.com deliver items not only in India but also in many different countries. Our team welcome interested buyers to place their orders on our site and make payment according to their convenience and applicable on international orders.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingEighteen">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEighteen" aria-expanded="false" aria-controls="collapseEighteen">How can buyers track the delivery status of their order?</button></h5></div>
                        <div id="collapseEighteen" class="collapse" aria-labelledby="headingEighteen" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                All of the items that are sold on shopocial.com are delivered through trusted courier companies that also provide Tracking ID for buyers’ order, by using that they can track the delivery status on their respective websites.Also, our executives sendan email to the buyers with tracking number once the order is dispatched.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingNinteen">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNinteen" aria-expanded="false" aria-controls="collapseNinteen">What is the return and exchange policy?</button></h5></div>
                        <div id="collapseNinteen" class="collapse" aria-labelledby="headingNinteen" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                                shopocial.com lets you experience a hassle free return/exchange policy, in case buyers don't like the ordereditems or find it damaged, they can speak to our executivesregarding it within 48 hours of receiving the product. For further more details, just go through Return & Exchange policy.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTewnty">
                            <h5 class="mb-0"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTewnty" aria-expanded="false" aria-controls="collapseTewnty">What to do if a buyer receives a defective item?</button></h5></div>
                        <div id="collapseTewnty" class="collapse" aria-labelledby="headingTewnty" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>
                               In case a buyerreceives defective or damaged product, he is asked to send us photos of the product at customercare@shopocial.com within 48 hours of receiving the same. Buyers don’t need to worry for shipping charges because if it is seller’s fault, the return shipping charges to the seller for the defective product will be given by the seller only.
                                </p>
                            </div>
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