<?php echo Modules::run('header/header/account'); ?>
<?php  $type =$this->session->userdata('type'); ?> 
<div class="page-wrapper" ng-view="">
    <?php switch ($type) {
    case 'food':
        $class = 'group-bg-f';
        break;
     case 'grocery':
        $class = 'group-bg-g';
        break;
     case 'liquor':
        $class = 'group-bg-b';
        break;
     case 'cleaner':
        $class = 'group-bg-l';
        break;
    default:
        $class = 'group-bg-f';
        break;
} ?>

    <div id="page-header-wrapper" class="no-default <?= $class; ?>">
        
        <div id="page-header">
          
        </div>
    </div>
    <div  class="dcom-loader search-results-page ng-hide"></div>
    <div id="main-content-wrapper" class="search-results-page" >
        <div id="main-content" class="search-results-page visible" >
           
            <div style="clear:both"></div>
            <div class="messages" ng-if="results_message_length > 0">
                <div ng-repeat="message in messages" ng-switch="message.code">
                   
                    <div>
                        <div id="invalid-address">
                            <h2>Oops. We're having trouble finding that address.</h2>
                            <p>Please enter your address in one of the following formats and try again. Please do NOT enter your apartment or floor number here. If necessary, you can enter this information at checkout.</p>
                            <div >
                                <p>- Street address, city and state</p>
                                <p>- Street address, zip code</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-again">
                    <label for="search-again">Enter your new address</label>
                    <div dcom-address-search="" ng-model="search.query" data-placeholder="" data-search-input-id="search-again" data-no-address-submit="noAddressSubmit" class="ng-pristine ng-untouched ng-valid">
                        <div class="address-search">
                            <form class="ng-pristine ng-valid" name="main-searchform" action="<?= site_url('search'); ?>" method="GET">
                               
                                <div class="dropdown-arrow-wrapper" ></div>
                                
                                <div class="" id="locationField">
                                    <input  id="address-search" required placeholder="Street Address, City, State" autocomplete="off" tabindex="1" onFocus="geolocate()" type="search">
                                    
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
                </div>
            </div>
            <!-- end ngIf: results_message_length > 0 -->
            <!-- SEARCH page ending -->
        </div>
    </div>
    
</div>
<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhhmFWU2wnBGPblpdzHEALwfsh4WCTLwQ&signed_in=true&libraries=places&callback=initAutocomplete"
      async defer></script>
<script type="text/javascript">
    
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