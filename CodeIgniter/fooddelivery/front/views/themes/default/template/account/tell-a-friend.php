<?php echo Modules::run('header/header/account'); ?>
<?php
$url    = site_url("share?code=".$customer->customer_detail->share_code."");
$text   = 'Order on'.$site_name.'and earn reward'.$url;
$image  = site_url("share?code=".$customer->customer_detail->share_code."");
?>
  


<div class="page-wrapper">
    <div id="page-header-wrapper">
        <div id="page-header">
            <!-- page header contents -->
            <h1>Your account</h1>
        </div>
    </div>
    <div id="main-content-wrapper" class="page-tellafriend">
        <div id="main-content">
            
            <div class="side-nav" >
                
                <div class="account-side-nav">
                    <div class="account-pages">
                        
                        
                        <div class="link "><a href="<?= site_url('account/orders') ?>">Order history</a></div>
                        
                        <div class="link active"  ><a href="<?= site_url('account/tell-a-friend') ?>">Tell a friend</a></div>
                        
                        <div class="link" ><a href="<?= site_url('account/profile') ?>">Profile</a></div>
                        
                        <div class="link" ><a href="<?= site_url('account/addresses') ?>">Addresses</a></div>
                      
                        <!-- <div class="link"><a href="<?= site_url('account/cards') ?>">Credit cards</a></div> -->
                        <div class="link"><a href="<?= site_url('account/wallets') ?>">Wallets</a></div>
                    </div>
                </div>
              
            </div>
            <!-- page content -->
            <div class="content">
                <div class="form-container">
                    <div class="heading"><h3>Tell a friend</h3></div>
                    <form class="taf-form ng-pristine ng-valid">
                        <h3>Give a friend 
                            <span>$<?= $refbycredits ?></span> 
                            to try delivery.com and you'll get 
                            <span>$<?= $refbycredits ?></span> when they place their first order!*
                        </h3>
                        <div class="form-input">
                            <label>Share this link:</label>
                            <input type="text" value="<?= site_url('share?code='.$customer->customer_detail->share_code.''); ?>"></div>
                            <div class="buttons-wrapper" >
                                <div class="top-arrow"></div>
                                <a onclick="facebook()" type="button" id="facebook-button" class="button facebook">
                                    <span class="btn-icon icon-facebook-f"></span> 
                                    <span class="btn-text">Post it</span>
                                </a> 
                                <a onclick="twitter()" type="button" id="twitter-button" class="button twitter">
                                    <span class="btn-icon icon-twitter-bird">
                                    </span>
                                     <span class="btn-text">Tweet it</span>
                                 </a> 
                                <a href="mailto:?subject=<?= $text ?>" type="button" id="email-button" class="button primary" ng-show="!isAndroid">
                                    <span class="btn-icon icon-envelope"></span> 
                                    <span class="btn-text">Send it</span>
                                </a>
                                
                            </div>
                            <h3 class="earnings ng-hide">
                                By telling friends, you've earned
                                <span>$0.00</span>
                            </h3>
                            <div class="legal">
                                *Referrer receives $<?= $refbycredits ?> 
                                <span>credit</span>only after referee has placed first order. Referee’s first order requires a minimum subtotal of $<?= $minorder_for_credits ?>, excluding taxes, tips, and fees. Neither PayPal nor cash orders are eligible for credit. Referrer and referee $<?= $refbycredits ?> 
                                <span>credit</span> is only valid on food, groceries, and alcohol orders. Not valid for past orders. Offer expires 3 months from issue date.
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
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
<script type="text/javascript">
function facebook(){
   location.href="<?=share_url('facebook',   array('url'=>$url, 'text'=>$text))?>";
}
function twitter(){
     location.href="<?=share_url('twitter',    array('url'=>$url, 'text'=>$text, ))?>";
}
</script>
<?php echo Modules::run('footer/footer/account'); ?>
