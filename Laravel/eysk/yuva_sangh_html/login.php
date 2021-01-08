<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8"/>
	<title>Login</title>
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
	<link href="assets/css/login-1.css" rel="stylesheet" type="text/css" />
	<link href="assets/vendors/global/vendors.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="assets/media/logos/favicon.png" type="image/png"/>
</head>
<!-- end::Head -->
<!-- begin::Body -->
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading"  >
	<!-- begin:: Page -->
	<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
		<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
				<!--begin::Aside-->
				<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url('assets/media/misc/login_left.png');">
					<div class="kt-grid__item" style="margin: auto;padding: 30px;">
						<a href="#" class="kt-login__logo">
							<img src="assets/media/logos/logo-7.png">
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
				<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
					<!--begin::Head-->
					<div class="kt-login__head">
						<span class="kt-login__signup-label">Don't have an account activated yet?</span>&nbsp;&nbsp;
						<a href="#" class="kt-link kt-login__signup-link">Active!</a>
					</div>
					<!--end::Head-->
					<!--begin::Body-->
					<div class="kt-login__body">
						<!--begin::Signin-->
						<div class="kt-login__form">
							<div class="kt-login__title">
								<h3>Sign In</h3>
							</div>          
							<!--begin::Form-->

							<form method="POST" action="#" accept-charset="UTF-8" enctype="multipart/form-data">
								<div class="form-group">
									<label class="custom-label">Email <span class="text-danger">*</span></label>
									<input id="email" class="form-control" placeholder="Email" name="email" type="email">
								</div>
								<div class="form-group">
									<label class="custom-label">Password <span class="text-danger">*</span></label>
									<input id="password" class="form-control" placeholder="Password" name="password" type="password" value="">
								</div>
								<!--begin::Action-->
								<div class="kt-login__actions">
									<a href="#" class="kt-link kt-login__link-forgot">
										Forgot Password ?
									</a>
									<button type="submit" class="btn btn-warning btn-wide">Sign In</button>
								</div>
								<!--end::Action-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Signin-->
					</div>
					<!--end::Body-->
				</div>
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
	<link href="assets/vendors/global/vendors.bundle.js" rel="stylesheet" type="text/css" />
	<link href="assets/js/scripts.bundle.js" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Bundle -->
</body>
</html>