<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8"/>
	<title>@yield('page-title')</title>
	<meta name="description" content="Login page example"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link href="{{ URL::asset('assets/css/login-1.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('assets/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="{{ URL::asset('assets/media/logos/favicon.png') }}" type="image/png"/>
</head>
<!-- end::Head -->
<!-- begin::Body -->
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading"  >
	<!-- begin:: Page -->
	<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
		<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
				<!--begin::Aside-->
				<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url({{ URL::asset('assets/media/misc/login_left.png') }});">
					<div class="kt-grid__item" style="margin: auto;padding: 30px;">
						<a href="#" class="kt-login__logo">
							<img src="{{ URL::asset('assets/media/logos/logo-7.png') }}">
						</a>
					</div>
					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
						<div class="kt-grid__item kt-grid__item--middle">
							<h3 class="kt-login__title">Welcome to Yuva Sangh!</h3>
							<h4 class="kt-login__subtitle"></h4>
						</div>
					</div>
					<div class="kt-grid__item">
						<div class="kt-login__info">
							<div class="kt-login__copyright">
								&copy 2019 Yuva Sangh
							</div>
							<div class="kt-login__menu">
								<a href="#" class="kt-link">Privacy</a>
								<a href="#" class="kt-link">Legal</a>
								<a href="#" class="kt-link">Contact</a>
							</div>
						</div>
					</div>
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				@yield('content')
				<!--end::Content-->
			</div>
		</div>
	</div>
	<!-- end:: Page -->
	<!-- begin::Global Config(global config for global JS sciprts) -->
	<script>
		var KTAppOptions = {"colors":{"state":{"brand":"#22b9ff","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
	</script>
	<!-- end::Global Config -->
	<!--begin::Global Theme Bundle(used by all pages) -->
	<link href="{{ URL::asset('assets/vendors/global/vendors.bundle.js') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('assets/js/scripts.bundle.js') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Bundle -->
	@yield('content_js')
</body>
</html>