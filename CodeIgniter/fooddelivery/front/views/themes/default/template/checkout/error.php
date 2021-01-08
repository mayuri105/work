

<?php echo Modules::run('header/header/account');?>

<div class="page-wrapper">
    <div class="group-bg-f" id="page-header-wrapper" style="background-image: url('<?=getuploadpath() . 'store/' . $store_info->store_data->store_banner;''?>')">
        <div id="page-header">
            <h1>Error ! Thank you for your order</h1>
            <p>You have earned a total of <strong>{points Earned}</strong> delivery points.</p>
        </div>
    </div>
    <div id="main-content-wrapper">
        <div id="main-content">
            <div class="contents-wrapper">
                <div class="page-checkout">
                    <div class="post-order-links">
                        <div class="post-order-wrapper">
                            <div class="info-column">
                                <div class="order-info">
                                    <p>Your order # is <span class="order-id">15890827</span>. You can access your order details any time at <a href="pages/order_history.php">My Order</a>.</p>

                                </div>

                                <div class="steps-header"><h2>What happens next?</h2></div>
                                <div class="post-order-flow">
                                    <div class="wrapper">
                                        <div class="steps-container">
                                            <div class="step">
                                                <div class="icon">
                                                    <div class="icon-order-confirmation"></div>
                                                </div>
                                                <div class="text">The merchant confirms your order</div>
                                            </div>
                                            <div class="step">
                                                <div class="icon"><span class="icon-burger-soda"></span> <span class="icon-alcohol ng-hide"></span> <span class="icon-groceries ng-hide"></span></div>
                                                <div class="text">They prepare it for delivery or pickup</div>
                                            </div>
                                            <div class="step">
                                                <div class="icon"><span class="icon-delivery-guy"></span></div>
                                                <div class="text">You kick back (or pick it up) and enjoy</div>
                                            </div>
                                        </div>
                                        <div class="steps-container ng-hide">
                                            <div class="step">
                                                <div class="icon">
                                                    <div class="icon-order-confirmation"></div>
                                                </div>
                                                <div class="text">The merchant confirms your order</div>
                                            </div>
                                            <div class="step">
                                                <div class="icon"><span class="icon-mobile"></span></div>
                                                <div class="text laundry-text">We send you pickup and delivery updates along the way</div>
                                            </div>
                                            <div class="step">
                                                <div class="icon"><span class="icon-delivery-guy-laundry"></span></div>
                                                <div class="text">Your clean clothes come back at the scheduled time</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner">
                                    <h2>Did you know you can also get wine and liquor delivered? Cheers to that!</h2>
                                    <div class="callout-img"><img src="images/0cf92175.booze_maketing_banner_image.png"></div>
                                    <div class="order-now"><a class="button primary">Order Now</a></div>
                                </div>
                                <div class="banner ng-hide">
                                    <h2>Worked up an appetite? Check out local restaurants that deliver near you!</h2>
                                    <div class="callout-img"><img src="images/c0e4d1b3.food_maketing_banner_image.png"></div>
                                    <div class="order-now"><a class="button primary">Order Now</a></div>
                                </div>
                                <div class="order-chat-info">
                                    <h2>Any Questions?</h2>
                                    <p>For questions about your order, call <span class="contact-info">Greenwich Village Pizza</span> at <span class="contact-info contact-numbers">213-749-3920</span>.<br>If there's a problem, chat with us below or call Customer Support at <span class="contact-info contact-numbers">1-800-709-7191</span>.</p>
                                    <a class="button chat-button"><span class="icon-chat"></span> Chat with Delivery</a>
                                </div>
                            </div>
                            <div class="cta-column">

                            </div>
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
</div>

<?php echo Modules::run('footer/footer/index');?>
