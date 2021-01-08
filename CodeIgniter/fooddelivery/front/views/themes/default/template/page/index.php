<?php echo Modules::run('header/header/index'); ?>
<?php $type = $this->session->userdata('type'); ?>

    <div class="page-wrapper" >

        <div class="main group-f">
            <div class="tab">
                <div id="grocery" style="background-image: url('<?= site_url('front/views/themes/default'); ?>/images/HP_2_groceries_1920x800.jpg')" class="bg-image  <?= $type=='grocery' ? 'in':'' ?>  tab-content" ></div>
                <div id="liquor" style="background-image: url('<?= site_url('front/views/themes/default'); ?>/images/HP_1_alcohol_1920x800.jpg')" class="bg-image  <?= $type=='liquor' ? 'in':'' ?>  tab-content" ></div>
                <div id="cleaner" style="background-image: url('<?= site_url('front/views/themes/default'); ?>/images/HP_2_laundry_1920x800.jpg')" class="bg-image  <?= $type=='cleaner' ? 'in':'' ?>  tab-content" ></div>
                <div id="food"  style="background-image: url('<?= site_url('front/views/themes/default'); ?>/images/HP_3_food_1920x800.jpg')" class="bg-image   <?= $type=='food' ? 'in':'' ?>  tab-content" ></div>    
            </div>
            <div class="inner-wrapper">
                <div class="search-field" dcom-viewport-spy="mainSearchForm" id="mainSearchForm">
                    <!-- header-->
                    <div id="text-wrapper">
                        <span class="split-text">See who delivers</span>
                        <span class="split-text"> in your neighborhood.</span>
                    </div>

                    <div class="tabs-wrapper">
                        <ul class="home-tabs">
                            <li class="tab food-tab  <?= $type=='food' ? 'active':'' ?> " >
                                <a class="" title="food" href="#food" ><span class="icon-food"></span> Food</a>
                            </li>
                            <li class="tab alcohol-tab   <?= $type=='liquor' ? 'active':'' ?>" >
                                <a class="" title="liquor"  href="#liquor" ><span class="icon-alcohol"></span> Alcohol</a>
                            </li>
                            <li class="tab groceries-tab  <?= $type=='grocery' ? 'active':'' ?>" >
                                <a class="" title="grocery" href="#grocery" ><span class="icon-groceries"></span> Groceries</a>
                            </li>
                            <li class="tab laundry-tab  <?= $type=='cleaner' ? 'active':'' ?>" >
                                <a class="" title="cleaner" href="#cleaner" ><span class="icon-laundry"></span> Laundry</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="search-form dark " >
                        <div class="address-search">
                            <form class="ng-pristine ng-valid" name="main-searchform" action="<?= site_url('search'); ?>" method="GET">
                                <div class="delivery-pickup">

                                        <span class="delivery-select ">Delivery
                                        </span> 
                                        <input type="checkbox"  name="pickordelivery" class="optionpicordel" > 
                                        <span class="pickup-select">Pickup</span>

                                </div>
                                <span class="laundry-toggle-message ng-hide" >Schedule pickup and delivery</span>
                                <div class="dropdown-arrow-wrapper" ></div>
                                <div dcom-location-based-search="" class="location-based-search-wrapper ng-pristine ng-untouched ng-valid left-toggle" >
                                    <div class="location-button-wrapper" onclick="geolocate()"  >
                                        <span class="icon-location-arrow" ></span>
                                        <span class="spinner ng-hide"></span>                                        
                                    </div>
                                </div>
                                <div class="" id="locationField">
                                    <input  id="address-search" required placeholder="Street Address, City, State" autocomplete="off" tabindex="1" type="search">
                                    
                                </div>
                                <div  class="main-item-search-container " >
                                    <input  class="main-item-search " placeholder="Food" tabindex="2" name="keyword" type="text">
                                    <span class="icon-search"> </span>
                                </div>
                                    <input class="field" name="street_number" type="hidden" id="street_number"disabled="true">
                                    <input class="field" type="hidden" id="route" disabled="true">
                                    <input class="field" name="city" type="hidden" id="locality" disabled="true">
                                    <input class="field" name="state" type="hidden" id="administrative_area_level_1" disabled="true">
                                    <input class="field" name="zip" type="hidden" id="postal_code" disabled="true">
                                    <input class="field"  type="hidden" id="country" disabled="true">
                                    <input class="field" name="type" type="hidden" id="type" value="<?= $type; ?>">
                                    
                                <button type="submit" class="address-search-submit button primary" tabindex="3">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="message ng-hide"></div>
                </div>
            </div>
        </div>
        <div id="main-content-wrapper-home">
            <div id="main-content">
                <div class="current-points">
                    <h3 class="delivery-points">
                       <?php echo ucfirst($page->title); ?>
                    </h3>
                </div>

                <div class="mktg-callouts" >
                   
                </div>
                <div id="browse-by-container">
                    <?= $page->content ?>
                </div>
            </div>
        </div>
        
        <div  class="sticky-search" >
            <div class="search-directive-wrapper">
                <div class="help-text">Enter your address
                    <span class="desktop-only">&nbsp;to get started</span>
                    <span class="icon-quick-search-arrow"></span>
                </div>
                <div  class="search-form sticky-search-form ng-pristine ng-untouched ng-valid">
                    <div class="address-search">
                        <form id="stickysearch" name="stickysearchform" action="<?= site_url('search') ?>" method="GET">
                            <div class="delivery-pickup">

                                <span class="delivery-select ">Delivery
                                </span> 
                                <input type="checkbox" name="pickordelivery" class="optionpicordel2" > 
                                <span class="pickup-select ">Pickup</span>
                            </div>   
                            <div class="dropdown-arrow-wrapper" onclick="geolocate()"></div>
                            <div class="" >
                                <input id="address-search-sticky" required placeholder="Street Address, City, State"    autocomplete="off" tabindex="" type="search">
                            </div>
                            <input class="field" name="street_number" type="hidden" id="street_number_sticky">
                            <input class="field" type="hidden" id="route_sticky" >
                            <input class="field" name="city" type="hidden" id="locality_sticky" >
                            <input class="field" name="state" type="hidden" id="administrative_area_level_1_sticky" >
                            <input class="field" name="zip" type="hidden" id="postal_code_sticky" >
                            <input class="field" name="country" type="hidden" id="country_sticky">
                            <input name="type" type="hidden" id="typeof" disable="true" value="<?= $type; ?>">
                            <button type="submit" class="address-search-submit button primary" tabindex="">Search</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    </div>               
<?php echo Modules::run('footer/footer/index'); ?>


<script type="text/javascript">
$('.tab').click(function(){
    $('.tab').removeClass('active');
    $(this).addClass('active');
    var type = $(this).find('a').attr('title');
    $('#typeof').val(type);
    $('#type').val(type);
    data = {
        type:$(this).find('a').attr('title')
    };
    $.ajax({
        url : "<?php echo site_url('index/setType') ?>",
        type: "POST",
        data: data,
        success:function(data){
        }
    });
});

$(document).ready(function() {
    $(".home-tabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
var elems = Array.prototype.slice.call(document.querySelectorAll('.optionpicordel'));
    elems.forEach(function(html) {
      var switchery = new Switchery(html ,{ color: '#6886aa', secondaryColor: '#6886aa', size: 'small' });
    });
var elems = Array.prototype.slice.call(document.querySelectorAll('.optionpicordel2'));
elems.forEach(function(html) {
var switchery = new Switchery(html ,{ color: '#6886aa', secondaryColor: '#6886aa', size: 'small' });
});
$('.optionpicordel').change(function(){
        var a = $('.optionpicordel').prop('checked');
        if(a){
            $('.pickup-select').removeClass('inactive');
            $('.pickup-select').addClass('active');
            $('.delivery-select').addClass('inactive');
        }else{
            $('.delivery-select').removeClass('inactive');
            $('.delivery-select').addClass('active');
            $('.pickup-select').addClass('inactive');
        }
        
        data ={
            pickordelivery : a
        }
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('setOptiondelorpic') ?>",
            data: data,
            dataType:"json",
            beforeSend: function(){
            },
            success: function(data) {
                
            }
        })
    });
$('.optionpicordel2').change(function(){
        var a = $('.optionpicordel2').prop('checked');
        if(a){
            $('.pickup-select').removeClass('inactive');
            $('.pickup-select').addClass('active');
            $('.delivery-select').addClass('inactive');
        }else{
            $('.delivery-select').removeClass('inactive');
            $('.delivery-select').addClass('active');
            $('.pickup-select').addClass('inactive');
        }
        
        data ={
            pickordelivery : a
        }
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('setOptiondelorpic') ?>",
            data: data,
            dataType:"json",
            beforeSend: function(){
            },
            success: function(data) {
                
            }
        })
    });
</script>