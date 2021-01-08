<?php echo Modules::run('header/header/account'); ?>

<div class="page-wrapper">
    <div class="group-bg-f" id="page-header-wrapper" style="background-image: url('<?= getuploadpath().'store/'.$store_info->store_data->store_banner;'' ?>')">
        <div id="page-header">
            <h1>Success! Thank you for your order</h1>
            <p>You have earned a total of <strong><?= $points->points; ?></strong> delivery points.</p>
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
                                    <p>Your order # is <span class="order-id"><?= $this->session->userdata('order_id'); ?></span>. 
                                        You can access your order details any time at <a href="<?= site_url('account/orders') ?>">My Order</a>.</p>
                                    <div tooltip-placement="bottom" tooltip="Every $1 you spend on delivery.com earns 25 points. Rack 'em up and cash 'em in for great rewards." class="checkout-complete-points points-odometer">
                                        <span class="icon-trophy"></span>
                                         <dcom-odometer ng-model="cart_points" class="odometer odometer-auto-theme">
                                            <div class="odometer-inside">
                                                
                                            </div>
                                        </dcom-odometer>
                                        <a href="<?= site_url('account/points') ?>" class="points-link">Total Points Earned <span class="icon-full-arrow-right"></span></a>
                                    </div>
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
                                
                                <div class="order-chat-info">
                                    <h2>Any Questions?</h2>
                                    <p>For questions about your order, call 
                                        <span class="contact-info"><?= $store_info->store_data->store_name; ?></span> at 
                                        <span class="contact-info contact-numbers"><?= $store_info->store_data->store_phone ?></span>.
                                       
                                </div>
                            </div>
                            <!-- <div class="cta-column">
                                <div order-details="" class="favorite-order">
                                    <h3>Favorite this order</h3>
                                    <p>Make reordering fast and easy for next time.</p>
                                    <h3 class="ng-hide">You have favorited this order.</h3>
                                    <p class="ng-hide">This order will now appear on your homepage.</p>
                                    <div class="wrapper">
                                        <form class="ng-pristine ng-valid"><input type="text" id="fav-order-name" placeholder="Name this favorite order" class="ng-pristine ng-untouched ng-valid"></form>                                        <div class="title-and-order-favoriting" order-details="">
                                            <div class="icon-heart order-favorited ng-hide"></div>
                                            <a class="ok-favorite-order button primary">Save</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    localStorage.clear();
</script>
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
    window.odometerOptions = {
      format: '(ddd).dd'
    };
    setTimeout(function(){
   
    $('.odometer').html(<?= $points->points; ?>);
    }, 1000);

</script>