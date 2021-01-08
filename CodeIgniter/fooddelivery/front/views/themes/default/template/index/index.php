<?php echo Modules::run('header/header/account'); ?>
    <?php 
        $upload_path =  base_url().'upload/category/';
        $type = $this->session->userdata('type');
            
    ?>
   
	<div class="page-wrapper" >
    <div style="background-image: url('<?= $upload_path.$food_data->type_banner_image ?>');" id="page-header-wrapper" class="header-seo group-bg-f" >
        
        <div class="site-breadcrumb-wrapper" >
            <div class="" >
                <ul id="site-breadcrumb" class="container">
                    <li class="crumb">
                        <a itemprop="" href="<?= site_url(); ?>"><span itemprop="title">Home</span></a>
                    </li>
                    <li class="crumb" >
                        <span class="gt">&gt;</span>
                        <a href="<?= site_url('food/'); ?>" ><span itemprop="title"><?= $type ?></span></a>
                    </li>
                  </ul>
                <div class="clear-breadcrumbs">
                </div>
            </div>
        </div>
        <div id="page-header">
            <h1><!-- Order Food From More Than 7,000 Restaurants --></h1>
            <div >
                <style type="text/css">.delivery-pickup span.delivery-select{ margin-right: 0px  !important}</style>
                <div class="search-field seo" dcom-viewport-spy="mainSearchForm" id="mainSearchForm" >
                    <div id="text-wrapper" >
                        <span class="split-text">Enter your address to get started</span>
                    </div>
                    <div dcom-address-search="" data-placeholder="Street Address, City, State" data-search-input-id="address-search" data-pickup-toggle="true" class="search-form ng-pristine ng-untouched ng-valid" data-cta-text="Search" data-no-address-submit="noAddressSubmit" data-tab-index-address-search="1" data-tab-index-search-button="2">
                        <div class="address-search">
                            
                                    <form class="ng-pristine ng-valid" name="main-searchform" action="<?= site_url('search'); ?>" method="GET">
                                    
                                   <div class="delivery-pickup">

                                        <span class="delivery-select <?= $pickordelivery =='delivery' ? 'active' : 'inactive' ?>">Delivery
                                        </span> 
                                        <input type="checkbox"  name="pickordelivery" class="optionpicordel"  <?= $pickordelivery =='pickup' ? 'checked' : '' ?>  > 
                                        <span class="pickup-select <?= $pickordelivery =='pickup' ? 'active' : 'inactive' ?>">Pickup</span>
                                    </div>
                                    <div class="dropdown-arrow-wrapper" ></div>
                                    <div dcom-location-based-search="" class="location-based-search-wrapper ng-pristine ng-untouched ng-valid left-toggle" >
                                        <div class="location-button-wrapper" >
                                            <span class="icon-location-arrow" ></span>
                                            <span class="spinner ng-hide"></span>                                        
                                        </div>
                                    </div>
                                    <div class="" id="locationField">
                                        <input  id="address-search" required placeholder="Street Address, City, State" autocomplete="off" tabindex="1"  type="search">
                                        
                                    </div>
                                    
                                        <input class="field" name="street_number" type="hidden" id="street_number"disabled="true">
                                        <input class="field" type="hidden" id="route" disabled="true">
                                        <input class="field" name="city" type="hidden" id="locality" disabled="true">
                                        <input class="field" name="state" type="hidden" id="administrative_area_level_1" disabled="true">
                                        <input class="field" name="zip" type="hidden" id="postal_code" disabled="true">
                                        <input class="field"  type="hidden" id="country" disabled="true">
                                        <input class="field" name="type" type="hidden" id="type" value="<?= $type; ?>" disabled="true">
                                        
                                    <button type="submit" class="address-search-submit button primary" tabindex="3">Search</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-content">
        <div class="dcom-loader ng-hide"></div>
        <div class="seo-tags-pages" >
            <div class="cities">
                <div>
                    <section>
                        <div class="intro center">
                            <h2></h2>
                            <p>Got marinara sauce running through your veins? Get your pizza fix delivered when you order up a yummy slice of Italy online with delivery.com. Just enter your address and start browsing neighborhood pizzerias for that perfect pie. Mangia! Mangia!</p>
                        </div>
                    </section>
                    
                    <section>
                        <div class="center">
                            <h3>All Cities</h3>
                            <div class="list">
                                <?php foreach ($food_city as $fc): ?>
                                
                                <div class="column" >
                                    <div class="element" >
                                        <a href="<?= strtolower(site_url('cities/'.url_title($fc->city_name).'/'.url_title($fc->state).'/'.url_title($type))); ?>"><?= $fc->city_name.','.$fc->state ?></a><span>(<?= $fc->count ?>)</span>
                                    </div>
                                </div>

                                <?php endforeach ?>    
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div data-spy-on="mainSearchForm" class="sticky-search hidden" >
        <div class="search-directive-wrapper" >
            <div class="help-text">
                Enter your address<span class="desktop-only">&nbsp;to get started</span><span class="icon-quick-search-arrow"></span>
            </div>
            <div dcom-address-search="" checkbox-id="sticky-checkbox" is-sticky="true" data-placeholder="Street Address, City, State" data-search-input-id="sticky-address-search" data-pickup-toggle="true" data-cta-text="Search" class="search-form sticky-search-form ng-pristine ng-untouched ng-valid" data-no-address-submit="noAddressSubmit">
                <div class="address-search">
                    <form class="ng-pristine ng-valid">
                        <div class="delivery-pickup">

                            <span class="delivery-select <?= $pickordelivery =='delivery' ? 'active' : 'inactive' ?>">Delivery
                            </span> 
                            <input type="checkbox"  name="pickordelivery" class="optionpicordel"  <?= $pickordelivery =='pickup' ? 'checked' : '' ?>  > 
                            <span class="pickup-select <?= $pickordelivery =='pickup' ? 'active' : 'inactive' ?>">Pickup</span>
                        </div>
                        <span class="laundry-toggle-message ng-hide" >Schedule pickup and delivery</span>
                        <div class="dropdown-arrow-wrapper" >
                        </div>
                        <div dcom-location-based-search="" class="location-based-search-wrapper ng-pristine ng-untouched ng-valid left-toggle" >
                            <div class="location-button-wrapper" >
                                <span class="icon-location-arrow" ></span>
                                <span class="spinner ng-hide"></span>
                            </div>
                        </div>
                        <div class="ng-pristine ng-untouched ng-valid" dcom-address-search-autocomplete="" data-placeholder="Street Address, City, State" search-input-id="sticky-address-search" search-label="" has-dropdown="hasDropdown" suppress-automatic-search="suppressAutomaticSearch" no-address-submit="noAddressSubmit" tab-index="">
                            <label for="sticky-address-search" class="search-label ng-hide"></label>
                            <input class="ng-pristine ng-untouched ng-valid" id="sticky-address-search" placeholder="Street Address, City, State" autocomplete="off" tabindex="" type="search">
                            <div class="address-required-message" >
                                <span>Please enter your address</span>
                            </div>
                        </div>
                        <button type="submit" class="address-search-submit button primary" tabindex="">Search</button>
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

<?php echo Modules::run('footer/footer/account'); ?>

<script type="text/javascript">
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

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  autocomplete = new google.maps.places.Autocomplete(
    (document.getElementById('address-search')),
      {types: ['geocode']});
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}

</script>