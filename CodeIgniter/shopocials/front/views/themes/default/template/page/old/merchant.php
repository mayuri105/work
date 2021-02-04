<?php echo Modules::run('header/header/index'); ?>
<?php $type = $this->session->userdata('type'); ?>
<link rel="stylesheet" href="<?= site_url('front/views/themes/default'); ?>/css/merchant.css">
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
                            <div class="delivery-pickup" >
                                <span class="delivery-select" >Delivery</span>
                                <input id="pickup-checkbox" class="pickup-toggle pickup-toggle-round" type="checkbox">
                                <label id="label-pickup-checkbox" for="pickup-checkbox"></label>
                                <span class="pickup-select inactive" >Pickup</span>
                            </div>
                            <span class="laundry-toggle-message ng-hide" >Schedule pickup and delivery</span>
                            <div class="dropdown-arrow-wrapper" ></div>
                            <div dcom-location-based-search="" class="location-based-search-wrapper ng-pristine ng-untouched ng-valid left-toggle" >
                                <div class="location-button-wrapper" onclick="geolocate()" >
                                    <span class="icon-location-arrow" ></span>
                                    <span class="spinner ng-hide"></span>                                        
                                </div>
                            </div>
                            <div class="" id="locationField">
                                <input  id="address-search" required placeholder="Street Address, City, State" autocomplete="off" tabindex="1"  type="search">
                                
                            </div>
                            <div  class="main-item-search-container " >
                                <input  class="main-item-search " placeholder="Food " tabindex="2" name="keyword" type="text">
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
        <style type="text/css">
            
            
        </style>
        <div id="main-content">
            <div class="current-points">
                <h2>Sign up below to start growing your business today</h2>
            </div>
            <div class="mktg-callouts" >
               
            </div>
            <div id="browse-by-container">
               <div class="form-container join
" >
                <form action="<?= site_url('page/merchantsignup') ?>" method="post" name="merchantsignup">
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
                    <div class="form-field">
                        <label for="input"> Business Name <span> * </span>
                        </label>
                        <input id="BusinessName" type="text" name="BusinessName">
                    </div>
                   
                    <div class="form-field">
                       <label for="input"> Email Address  <span> * </span></label>
                       <input type="email" name="email" id="email">
                    </div>
                    <div class="form-field">
                        <label for="input"> Phone Number<span> * </span></label>
                        <input type="text" name="phone" id="phone">
                    </div>
                    <div class="form-field">
                        <label for="input"> Street Address</label>
                        <input type="text" name="streetaddress" id="streetaddress"> 
                    </div>

                    <div class="form-field">
                        <label for="input"> State <span> * </span></label>
                        <select class="selectBoxSize"  onchange="getCity(this);" id="state" name="state">
                            <option value="">--None--</option>
                            <?php foreach ($state as $s): ?>
                                <option value="<?= $s->code; ?>"><?= $s->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="input"> City <span> * </span></label>
                        
                        <select class="selectBoxSize" id="city" name="city">
                                <option value="">--None--</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="input"> Zipcode <span> * </span></label>
                        <input type="number" name="zipcode" id="zipcode"> 
                    </div>
                    <div class="form-field">
                         <button type="submit" class="address-search-submit button primary" tabindex="">Sign Up</button>
                    </div>  
                    
            </form>
                </div>
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
                        <div class="delivery-pickup" >
                            <span class="delivery-select" >Delivery</span>
                            <input id="sticky-checkbox" class="pickup-toggle pickup-toggle-round" type="checkbox">
                            <label id="label-sticky-checkbox" for="sticky-checkbox"></label>
                            <span class="pickup-select inactive" >Pickup</span>
                        </div>
                        
                        <div class="dropdown-arrow-wrapper"  onclick="geolocate()" > </div>
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
            if (type=='cleaner') {
                $('.laundry-toggle-message').removeClass('ng-hide')
                $('.search-autocomplete ').addClass('no-toggle');
                $('.main-item-search-container,.delivery-pickup').addClass('ng-hide')
                $('.location-based-search-wrapper').removeClass('left-toggle');
                $('.search-directive-wrapper').addClass('no-toggle')
            }else{
                $('.laundry-toggle-message').addClass('ng-hide')
                $('.search-autocomplete ').removeClass('no-toggle')
                $('.location-based-search-wrapper').addClass('left-toggle');
                $('.main-item-search-container,.delivery-pickup').removeClass('ng-hide')
                $('.search-directive-wrapper').removeClass('no-toggle')
            };
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
    var elems = Array.prototype.slice.call(document.querySelectorAll('.optionpicordel2'));
elems.forEach(function(html) {
var switchery = new Switchery(html ,{ color: '#6886aa', secondaryColor: '#6886aa', size: 'small' });
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
function getCity(element) {
    $.ajax({
        url: '<?php echo site_url("page/getcitybystate") ?>/' + element.value,
        dataType: 'json',
        success: function(json) {
            html = '<option value="">--none--</option>';
            if ( json.length) {
                for (i = 0; i < json.length; i++) {
                    html += '<option value="' + json[i]['city_name'] + '"';
                    html += '>' + json[i]['city_name'] + '</option>';
                }
            }   
            $('#city').html(html);
            
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
</script>