<?php echo Modules::run('header/header/index'); ?>

<div class="page-wrapper" >
    <div style="background-image: url('<?= site_url('front/views/themes/default') ?>/images/static/delivery-points/header-1920x300.jpg');" id="page-header-wrapper" dcom-responsive-background="headerImages">
        <div id="page-header">
            <h1 class="split-text delivery-points items-page guest">Got Points? Get rewards!</h1>
            <h1 class="ribbon-header">Earn <?= $pointValue; ?> points for every $1 spent</h1>
        </div>
    </div>
    <div id="main-content-wrapper">
        <div id="main-content">
            <div class="contents-wrapper">
                <div class="summary container">
                    <div class="summary-container">
                        <div class="account-info">
                            <span >
                                <div class="odometer-wrapper">
                                	
                                    <dcom-odometer class="ng-pristine ng-untouched ng-valid odometer odometer-auto-theme" >
                                        <div class="odometer-inside">
	                                    <?php 
                                            if (!is_login()) {
                                                $points = '0';
                                            }
	                                		echo $points;
										 ?>
                                        </div>
                                    </dcom-odometer>
                                    <br>Points Earned
                                </div>
                                <div class="progressbar-with-sections">
                                    <dcom-progressbar dcom-progressbar-max="18000" dcom-progressbar-delay="2000" class="large ng-pristine ng-untouched ng-valid" id="progressbar">
                                    <?php $value = ($points * 100)/18000; ?>
                                        <div style="width:<?= $value ?>%" class="progress" ></div>
                                    </dcom-progressbar>
                                    <div class="section section-5000" >
                                        <span class="price">$5</span>
                                        <span class="point">5,000</span>
                                    </div>
                                    <div class="section section-9500" >
                                        <span class="price">$10</span>
                                        <span class="point">9,500</span>
                                    </div>
                                    <div class="section section-18000" >
                                        <span class="price">$20</span>
                                        <span class="point">18,000</span>
                                    </div>
                                </div>

                            </span>
                             
                            <div class="point-cycle">
                                <img src="<?= site_url('front/views/themes/default') ?>/images/cd054b07.png" height="190" width="210">
                            </div>
                        </div>
                        <div class="section-title">Redeem your points</div>
                        
                            <?php $i=0; foreach ($points50 as $kpf): ?>

                            <div class="bucket bucket-<?php echo $i ?>" >
                                <div class="bucket-header"><?= $kpf->points_reward ?> Point Rewards</div>

                                <div class="gift gift-<?= $kpf->rb_id  ?>" >
                                    <img src="<?= getuploadpath().'/rewardbucket/'.$kpf->image; ?>" >
                                    <div class="content">
                                        <div class="name"><?= $kpf->title; ?></div>
                                        <a tooltip-placement="bottom" tooltip-html-unsafe="<?= $kpf->description; ?>">Learn more</a>
                                        <dcom-progressbar dcom-progressbar-max="<?= $kpf->points_reward ?>" dcom-progressbar-delay="2000" class="small ng-pristine ng-untouched ng-valid">
                                            <?php $value = ($points * 100)/$kpf->points_reward; ?>
                                            <div style="width:<?= $value ?>%" class="progress" ></div>
                                        </dcom-progressbar>
                                        <div >
                                            <?php if ($points < $kpf->points_reward ){ ?>
                                                <div class="points"><?= $kpf->points_reward - $points; ?> points away</div>
                                                <button disabled="disabled" class="button disabled">Redeem</button>
                                             <?php }else{ ?>
                                                <div class="points"><?=  $points-$kpf->points_reward; ?> points </div>
                                                <button  class="button primary " onclick="redeempoints('<?= $kpf->rb_id ?>')">Redeem</button>
                                             <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                  
                            </div>

                        <?php $i++;
                        if ($i=='3') {
                            $i=0;
                        }
                         endforeach ?>  
                        <!--  Other Bucket -->




                </div>
            </div>
        </div>
    </div>
</div>
<?php echo Modules::run('footer/footer/account'); ?>
<script type="text/javascript">
function redeempoints(bucketid){
var data = {
        bucketid : bucketid
    }
    $.ajax({
        url:"<?php echo site_url('account/redeempoints'); ?>",
        type:"POST",
        dataType:"json",
        data:data,
        success:function(data){
        window.location.reload()
        }
    });
} 
</script>
</body>
</html>