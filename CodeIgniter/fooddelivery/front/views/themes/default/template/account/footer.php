
	<div class="site-footer-wrapper">
			<footer class="site-footer footer-container">
				<div class="links match-media-small">
					<div class="quick-links">
						<div class="footer-nav">
							<nav >
								<ul>
									<div id="maincontainer">
										<div id="leftcolumn">
		                                    <?php foreach ($page as $p): ?>
		                                    <li class="menu-items text-footer"><a href="<?php echo site_url('page/show/'.$p->unique_alias.'') ?>" ><?= ucfirst($p->title); ?></a></li>
		                                    <?php endforeach ?> 
		                                     <li class="menu-items text-footer"><a href="<?php echo site_url('page/merchant/') ?>" ><?= ucfirst('Merchant Signup'); ?></a></li>
                                                                            
		                                </div>
										<div id="contentwrapper">
											<div id="rightcolumn">
												<li class="menu-items icons"><a href="<?= $googleplus ?>" class="icon-google-plus-g" target="_blank"></a></li>
												<li class="menu-items icons"><a href="<?= $instagram ?>" class="icon-instagram" target="_blank"></a></li>
												<li class="menu-items icons"><a href="<?= $twitter ?>" class="icon-twitter-bird" target="_blank"></a></li>
												<li class="menu-items icons"><a href="<?= $facebook ?>" class="icon-facebook-f" target="_blank"></a></li>
											</div>
											<div id="contentcolumn">
												<li class="menu-items images-stores apple"><a href="<?= $appstorelink ?>" target="_blank"></a></li>
												<li class="menu-items images-stores google"><a href="<?= $playstorelink ?>" target="_blank"></a></li>
											</div>
										</div>
									</div>
								</ul>
							</nav>
						</div>
					</div>
				</div>
					<div class="legal" >
							
							<div class="disclaimer">
				                    <span class="terms">&nbsp;By using our site you agree to our <a href="<?= site_url('page/show/terms-of-use') ?>">Terms of Use</a>. Read our <a href="<?= site_url('page/show/privacy-policy') ?>">Privacy Policy</a>.</span>
				                    <span class="copyright">© <?php echo date('Y') ?> . All rights reserved.</span>
				            </div>
					</div>
			</footer>
	</div>
</div>
<script>
$('.modal').click(function() {    
		$('.modal-backdrop.fade.in , .modal').addClass('ng-hide');
});
//login
$('.login-nav-item , .login-modal .modal-dialog').click(function(event){
		 event.stopPropagation();
		 $('.modal-backdrop , .login-modal .modal').removeClass('ng-hide');
		 $('.signup-modal .modal ').addClass('ng-hide');
});
//signup
$('.sign-in-click , .signup-modal .modal-dialog').click(function(event){
		 event.stopPropagation();
		 $('.modal-backdrop , .signup-modal .modal ').removeClass('ng-hide'); 
		 $('.forget-modal .modal , .login-modal .modal').addClass('ng-hide');
});
//signup
$('.forget-click , .forget-modal .modal-dialog').click(function(event){
		 event.stopPropagation();
		 $('.login-modal .modal').addClass('ng-hide');
		 $('.modal-backdrop , .forget-modal .modal').removeClass('ng-hide');     
});

$(document).keyup(function(e) {  
	if (e.keyCode == 27) $('.modal').click();   // esc
});


$('.close').click(function(event){
		 event.stopPropagation();
	 $('.modal').click();
});
function toggleAccountNav() {
		$('.header-module.hiw-nav ,.header-module.taf-nav').hide();    
		$('.header-module.account-nav').toggle();
	 // $('.main-nav-item').addClass('active');
		
		
}
function toggleTafNav() {

		$('.header-module.hiw-nav , .header-module.account-nav').hide();    
		$('.header-module.taf-nav').toggle();
}
function toggleHiwNav() {
		$('.header-module.taf-nav , .header-module.account-nav').hide();    
		$('.header-module.hiw-nav').toggle();
}
$('.login-nav-item2').click(function(event){
		 event.stopPropagation();
		 $('.modal-backdrop , .login-modal .modal').removeClass('ng-hide');
		 $('.signup-modal .modal ').addClass('ng-hide');
});
$('.home-tabs li').click(function() {
		$('.home-tabs li').removeClass('active');
		$(this).addClass('active');
});
$('#pickup-checkbox , #settings-toggle').click(function() {
		
		if ($(this).prop('checked')==true){ 
				$('.delivery-select').addClass('inactive');
				$('.pickup-select').removeClass('inactive').addClass('active');
		} else {
				$('.pickup-select').addClass('inactive');
				$('.delivery-select').removeClass('inactive').addClass('active');        
		}
});

function toggleMenuNavigation(){

		$('#menu_navigation').toggle();
}
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?= $google_api_key;  ?>&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
<script type="text/javascript">
	
var placeSearch, autocomplete,autocomplete2;
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

  autocomplete2 = new google.maps.places.Autocomplete
  	(document.getElementById('address-search-sticky'), 
  		{ types: [ 'geocode' ] });
	 autocomplete2.addListener('place_changed', fillInAddress2);
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

var componentForm2 = {
  street_number_sticky: 'short_name',
  route_sticky: 'long_name',
  locality_sticky: 'long_name',
  administrative_area_level_1_sticky: 'short_name',
  country_sticky: 'long_name',
  postal_code_sticky: 'short_name'
};



function fillInAddress2() {
  // Get the place details from the autocomplete object.
  var place = autocomplete2.getPlace();

  for (var component in componentForm2) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm2[addressType]) {
      var val = place.address_components[i][componentForm2[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}



</script>