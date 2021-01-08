	 <!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8"/>
	<title>Yuva | Sangn</title>
	<meta name="description" content="Latest updates and statistic charts"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!--begin::Fonts -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!--end::Fonts -->
	<!--begin::Page Vendors Styles(used by this page) -->
	<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles -->
	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="assets/vendors/global/vendors.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->
	<!--begin::Layout Skins(used by all pages) -->
	<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugin/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="assets/media/logos/favicon.png" type="image/png"/>
</head>
<!-- end::Head -->
<!-- begin::Body -->
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading"  >
	<!-- begin:: Page -->
	<!-- begin:: Header Mobile -->
	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " >
		<div class="kt-header-mobile__logo">
			<a href="dashboard.php">
				<img alt="Logo" src="assets/media/logos/logo-7.png" style="width: 30%;" />
			</a>
		</div>
		<div class="kt-header-mobile__toolbar">
			<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
			<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
		</div>
	</div>
	<!-- end:: Header Mobile -->
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			<div class="kt-aside-menu-overlay"></div>
			<!-- end:: Aside -->
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				<!-- begin:: Header -->
				<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed " >
					<div class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout- "  >
						<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
							<div class="kt-aside__brand-logo">
								<a href="dashboard.php">
									<img alt="Logo" src="assets/media/logos/logo-7.png" style="width: 50%;">
								</a>
							</div>
						</div>
					</div>
					<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
					<div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
						<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout- "  >
							<ul class="kt-menu__nav ">
								<li class="kt-menu__item" aria-haspopup="true">
									<a href="dashboard.php" class="kt-menu__link ">
										<span class="kt-menu__link-text">Dashboard</span>
									</a>
								</li>
								
								<li class="kt-menu__item" aria-haspopup="true"><a href="registration.php" class="kt-menu__link"><span class="kt-menu__link-text">Registration</span></a></li>

								<li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true"><a href="sahyognidhi-request.php" class="kt-menu__link"><span class="kt-menu__link-text">Sahyognidhi Request</span></a></li>

								<li class="kt-menu__item" aria-haspopup="true"><a href="55-year-old.php" class="kt-menu__link"><span class="kt-menu__link-text">55 Year Old</span></a></li>
								
								<li class="kt-menu__item" aria-haspopup="true"><a href="ach.php" class="kt-menu__link"><span class="kt-menu__link-text">ACH</span></a></li>

								<li class="kt-menu__item" aria-haspopup="true"><a href="repayment.php" class="kt-menu__link"><span class="kt-menu__link-text">Repayment</span></a></li>
								
								<li class="kt-menu__item" aria-haspopup="true"><a href="courier.php" class="kt-menu__link"><span class="kt-menu__link-text">Courier</span></a></li>
								<li class="kt-menu__item" aria-haspopup="true"><a href="suspense-account.php" class="kt-menu__link"><span class="kt-menu__link-text">Suspense Account</span></a></li>
								
								 <li class="kt-menu__item" aria-haspopup="true"><a href="today_calling.php" class="kt-menu__link"><span class="kt-menu__link-text">Today's Calling</span></a></li>
							</ul>
						</div>
					</div>
					<!-- end: Header Menu -->   
					<!-- begin:: Header Topbar -->
					<div class="kt-header__topbar">
						<!--begin: Notifications -->
						<div class="kt-header__topbar-item dropdown">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
								<span class="kt-header__topbar-icon kt-header__topbar-icon--success"><i class="flaticon2-bell-alarm-symbol"></i></span>
								<span class="kt-hidden kt-badge kt-badge--danger"></span>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
								<form>
									<!--begin: Head -->
									<div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
										<h3 class="kt-head__title">
											User Notifications 
											&nbsp;
											<span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 new</span>
										</h3>
										<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
											<li class="nav-item">
												<a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">Alerts</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#topbar_notifications_events" role="tab" aria-selected="false">Events</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs" role="tab" aria-selected="false">Logs</a>
											</li>
										</ul>
									</div>
									<!--end: Head -->
									<div class="tab-content">
										<div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
											<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
												<a href="#" class="kt-notification__item">
													<div class="kt-notification__item-icon">
														<i class="flaticon2-line-chart kt-font-success"></i>
													</div>
													<div class="kt-notification__item-details">
														<div class="kt-notification__item-title">
															New order has been received
														</div>
														<div class="kt-notification__item-time">
															2 hrs ago
														</div>
													</div>
												</a>
											</div>
										</div>
										<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
											<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
												<a href="#" class="kt-notification__item">
													<div class="kt-notification__item-icon">
														<i class="flaticon2-psd kt-font-success"></i>
													</div>
													<div class="kt-notification__item-details">
														<div class="kt-notification__item-title">
															New report has been received
														</div>
														<div class="kt-notification__item-time">
															23 hrs ago
														</div>
													</div>
												</a>
											</div>
										</div>
										<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
											<div class="kt-grid kt-grid--ver" style="min-height: 200px;">
												<div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
													<div class="kt-grid__item kt-grid__item--middle kt-align-center">
														All caught up!
														<br>No new notifications.
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!--end: Notifications -->  
						<!--begin: Quick actions -->
						<div class="kt-header__topbar-item" style="margin:auto;">
							<a href="#">
								<div class="kt-header__topbar-wrapper">
									<span class="kt-header__topbar-icon kt-header__topbar-icon--warning"><i class="flaticon2-gear"></i></span>
								</div>
							</a>
						</div>
						<!--end: Quick actions -->
						<!--begin: User bar -->
						<div class="kt-header__topbar-item kt-header__topbar-item--user">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">           
								<span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
								<span class="kt-hidden kt-header__topbar-username">Nick</span>
								<img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg"/>
								<span class="kt-header__topbar-icon"><i class="flaticon2-user-outline-symbol"></i></span>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
								<!--begin: Head -->
								<div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
									<div class="kt-user-card__avatar">
										<img class="kt-hidden-" alt="Pic" src="assets/media/users/300_25.jpg" />
										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
									</div>
									<div class="kt-user-card__name">
										Sean Stone
									</div>
									<div class="kt-user-card__badge">
										<span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 messages</span>
									</div>
								</div>
								<!--end: Head -->
								<!--begin: Navigation -->
								<div class="kt-notification">
									<a href="#" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-calendar-3 kt-font-success"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												My Profile
											</div>
											<div class="kt-notification__item-time">
												Account settings and more
											</div>
										</div>
									</a>
									<a href="#" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-mail kt-font-warning"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												My Messages
											</div>
											<div class="kt-notification__item-time">
												Inbox and tasks
											</div>
										</div>
									</a>
									<a href="#" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-rocket-1 kt-font-danger"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												My Activities
											</div>
											<div class="kt-notification__item-time">
												Logs and notifications
											</div>
										</div>
									</a>
									<a href="#" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-hourglass kt-font-brand"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												My Tasks
											</div>
											<div class="kt-notification__item-time">
												latest tasks and projects
											</div>
										</div>
									</a>
									<a href="#" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-cardiogram kt-font-warning"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												Billing
											</div>
											<div class="kt-notification__item-time">
												billing & statements <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2 pending</span>
											</div>
										</div>
									</a>
									<div class="kt-notification__custom kt-space-between">
										<a href="#" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
										<a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>
									</div>
								</div>
								<!--end: Navigation -->     
							</div>
						</div>
						<!--end: User bar -->
					</div>
					<!-- end:: Header Topbar -->
				</div>
				<!-- end:: Header -->
				

				<!-- content -->
				<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
					<!-- begin:: Subheader -->
					<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
					<div class="kt-subheader kt-grid__item title-main-ktt kt-subheader-1" id="kt_subheader">
						<div class="kt-container--fluid ">
							<div class="kt-subheader__main">
								<h3 class="kt-subheader__title">
									Add Sahyognidhi Request                           
								</h3>
							</div>
							<div class="kt-subheader__toolbar">
								<div class="kt-subheader__wrapper"></div>
							</div>
						</div>
					</div>
				</div>
				

				<!-- end:: Subheader -->        
				<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
				<div class="row">		
				<div class="col-lg-12">
        		<!--begin::Portlet-->
        		<!-- <div class="kt-portlet">
        			
        			<div class="mtt-body">
        				<form>
        					<div class="form-group">
        						<div class="kt-radio-inline">
        							<div class="row">
        								<div class="col-sm-3 col-md-3">	
        									<label class="kt-radio">
        										<input type="radio" name="radio2"> Half Disability
        										<span class="tablinks" onclick="openCity('London')"></span>
        									</label>
        								</div>
        								<div class="col-sm-3 col-md-3">
        									<label class="kt-radio">
        										<input type="radio" name="radio2"> Full Disability
        										<span class="tablinks" onclick="openCity('Paris')"></span>
        									</label>
        								</div>
        								<div class="col-sm-3 col-md-3">
        									<label class="kt-radio">
        										<input type="radio" name="radio2"> Devatage
        										<span class="tablinks" onclick="openCity('Tokyo')"></span>
        									</label>
        								</div>
        							</div>
        						</div>
        					</div>	
        				</form>		
        			</div>
        		</div> -->
        <!--end::Portlet-->

        <div class="kt-portlet sahyognidhi-mtt">
        <div class="row">
        <div class="col-sm-12">	
        <div id="London" class="w3-container city">
		<div class="Half-section-details">
		<h3>General Information</h3>	
		<div class="sahyognidhi-border"></div>
		<form>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-lg-6">

				<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Date
		        <span class="text-danger">*</span></label>
		        <div class="col-lg-9">
		        <input type="name" class="form-control date" readonly>
		        </div>
		        </div>

				
				<div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Region Name</label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp" readonly>
	        	</div>
	            </div>	

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Council Name</label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp" readonly>
	        	</div>
	            </div>

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Samaj Zone Name</label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp" readonly>
	        	</div>
	            </div>	

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Yuva Mandal Name</label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp" readonly>
	        	</div>
	            </div>		

	             <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Name<br><small>(As per www.yuvasangh.org)</small>
	            <span class="text-danger">*</span></label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div>

	             <div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Members Photo</label>	
		        <div class="col-lg-6">
		        <input type="file" class="form-control profile-height" id="photo1" aria-describedby="emailHelp">
		        <small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.</small>
		        </div>
		        <div class="col-lg-3">
		        <div class="profile-img">
		        <img src="assets/img/300_3.jpg" id="profile1-img-tag">	
		        </div>	
		        </div>
				</div>

				<div class="form-group1 m-form__group1 row">
			 	<label class="col-lg-3 col-form-label">City</label>	
			 	<div class="col-lg-9">
			 	<select class="form-control kt-select2" id="kt_select2_4" name="param" disabled>
                <option value="AK">Select a City</option>
                <option value="AK">Alaska</option>
                <option value="HI">Hawaii</option>
                <option value="CA">California</option>
                <option value="NV">Nevada</option>
                <option value="OR">Oregon</option>
                <option value="WA">Washington</option>
        		</select>
        	    </div>
  				</div>	

  				<div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Email
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="email" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div>

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Aadhar Card Number
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div>

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Date of Birth
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="text" class="form-control date">
	        	</div>
	            </div>

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Cause of Death
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="age" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div>


	             <!-- <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Last Sahyognidhi repayment Date 
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="age" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div> -->
  					


         
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6">
				
         		<div class="form-group1 m-form__group1 row">		
		        <label class="col-lg-3 col-form-label">YSK ID
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <select class="form-control kt-select2" id="kt_select2_3_validate" name="param">
		            <option value="AK">Select a YSK</option>
		            <option value="AK">Alaska</option>
		            <option value="HI">Hawaii</option>
		            <option value="CA">California</option>
		            <option value="NV">Nevada</option>
		        </select>
		        </div>	
		        </div>

		          <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Family ID
	            <span class="text-danger">*</span></label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp" readonly>
	        	</div>
	            </div>	

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Name<br><small>(As per Ysk Registration Form)	</small>
	            <span class="text-danger">*</span></label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div>


		        <div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Informer Name
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		        </div>
		        </div>

			   <div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Informer Mobile
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <input type="text" class="form-control" aria-describedby="emailHelp">
		        </div>
		        </div>

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Designation</label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp" readonly>
	        	</div>
	            </div>	

	          
	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Gender
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	 <div class="kt-radio-inline">
	                <label class="kt-radio">
	                <input type="radio" name="radio2"> Male
	                <span></span>
	                </label>
	                <label class="kt-radio">
	                <input type="radio" name="radio2"> Female
	                <span></span>
	                </label>
	                </div>
	        	</div>
	            </div>

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Pincode
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp" readonly>
	        	</div>
	            </div>

	             <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Phone Number1
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div>

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Phone Number2
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div>

	            <div class="form-group1 m-form__group1 row">
			 	<label class="col-lg-3 col-form-label">Existing Disease</label>	
			 	<div class="col-lg-9">
			 	<select class="form-control kt-select2" id="kt_select2_5555" name="param" disabled>
                <option value="AK">Select a Disease</option>
                <option value="AK">Alaska</option>
                <option value="HI">Hawaii</option>
                <option value="CA">California</option>
                <option value="NV">Nevada</option>
                <option value="OR">Oregon</option>
                <option value="WA">Washington</option>
        		</select>
        	    </div>
  				</div>	

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Other Document Name & Number
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="name" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div>

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Age
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="age" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div>

	            <!-- <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Last Sahyognidhi repayment Rs. 
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="age" class="form-control" aria-describedby="emailHelp">
	        	</div>
	            </div> -->


				

				</div>
		</div>
		

		
  
				

        </div>
    	</div>
		<!-- </form>	
		</div>
  		</div>
 -->
		</div>
		</div>	
      
        <br>
        <br>



		<div id="Tokyo" class="w3-container city">
  		<div class="Half-section-details">
		<h3>Payment Details</h3>	
		<div class="sahyognidhi-border"></div>
		<form>
		   <div class="row">
			<div class="col-md-6 col-sm-6 col-lg-6">

				<div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Cheque Deposit Date 
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="text" class="form-control date">
	        	</div>
	            </div>

	             <div class="form-group1 m-form__group1 row">	
	        	<label class="col-lg-3 col-form-label">Attach Sahyognidhi Request Form
	        	<span class="text-danger">*</span>	
	        	</label>	
	        	<div class="col-lg-6">
	        	<input type="file" class="form-control profile-height" id="photo" aria-describedby="emailHelp">
	        	<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.</small>
	        	</div>
	        	<div class="col-lg-3">
	        	<div class="profile-img">
	        	<img src="assets/img/product10.jpg" id="profile-img-tag">	
	        	</div>	
	        	</div>
				</div>

	       
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6">
				
				<div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Date Amount Received in Bank
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="text" class="form-control date">
	        	</div>
	            </div>

	            <div class="form-group1 m-form__group1 row">	
	            <label class="col-lg-3 col-form-label">Attach Sahyognidhi Request Date
	            <span class="text-danger">*</span>	
	            </label>	
	            <div class="col-lg-9">
	          	<input type="text" class="form-control date">
	        	</div>
	            </div>

	           

				</div>

		   </div>
		   <div class="row">
		   	  <div class="col-md-12 col-sm-12 col-lg-12">
		   	  	
		   	  	 <div class="form-group1 m-form__group1 row">	
                <label class="col-lg-2 col-form-label">Mode of payment
            <span class="text-danger">*</span>	
            </label>	
            <div class="col-lg-10">
          	<div class="row">
						<div class="col-sm-3">	
						<div class="kt-radio-inline redio-mt">
							<label class="kt-radio">
								<input type="radio" name="radio2"> Cash Deposit
								<span class="tablinks" onclick="openCity(event, 'cash')"></span>
							</label>
						</div>
						</div>
						<div class="col-sm-3">	
						<div class="kt-radio-inline redio-mt">
							<label class="kt-radio">
								<input type="radio" name="radio2"> Cheque
								<span class="tablinks" onclick="openCity(event, 'cheque')"></span>
							</label>
						</div>
						</div>
						<div class="col-sm-3">	
						<div class="kt-radio-inline redio-mt">
							<label class="kt-radio">
								<input type="radio" name="radio2"> Online
								<span class="tablinks" onclick="openCity(event, 'online')"></span>
							</label>
						</div>
						</div>
				
						<div class="col-sm-3">	
						<div class="kt-radio-inline redio-mt">		
							<label class="kt-radio">
								<input type="radio" name="radio2"> NEFT/RTGS
								<span class="tablinks" onclick="openCity(event, 'NR')"></span>
							</label>
						</div>
						</div>
				
						<div class="col-sm-12">
						<div id="cash" class="tabcontent">
  						<h3 class="check-box-title" style="padding: 0px;">Cash Deposit</h3>
						<form>
  						<div class="row">	
  						<div class="col-sm-12">
  					 	<label>Bank name</label>
  					 	<select class="form-control kt-select2 select-mt" id="kt_select2_9" name="param" style="width: 100%;">
                        <option value="AK">Select Bank</option>
                        <option value="AK">ICIC Bank</option>
                        <option value="HI">Bank of India</option>
                        <option value="HI">HDFC Bank</option>
                		</select>
  						</div>	
						
  						<div class="col-sm-12 padding-mt">
						<label>Amount
        				<span class="text-danger">*</span></label>	
						<input type="name" class="form-control" aria-describedby="emailHelp" value="7000"readonly>
						</div>

						
						<div class="col-sm-9 padding-mt">
						<label>upload Proof<span class="text-danger">*</span></label>
        				<input type="file" class="form-control profile-height" id="photo2" aria-describedby="emailHelp">	
						</div>	

						<div class="col-sm-3 padding-mt">	
						<div class="profile-img upload-proof-img">
        				<img src="assets/img/product10.jpg" id="profile2-img-tag">	
        				</div>
						</div>	







						</div>
						</form>
						</div>

						<div id="cheque" class="tabcontent" >
  						<h3 class="check-box-title" style="padding: 0px;">Cheque</h3>
  						<form>
  						<div class="row check-box">	
  						<div class="col-sm-4">
  					 	<label>Bank name</label>
  					 	<input type="text" name="name" class="form-control">
  						</div>

  						<div class="col-sm-4">
  					 	<label>Branch name</label>
  					 	<input type="text" name="name" class="form-control">
  						</div>

  						<div class="col-sm-4">
  					 	<label>Cheque deposit date</label>
  					 	<input type="text" name="name" class="form-control date">
  						</div>

  						<div class="col-sm-4">
  					 	<label>Cheque amount</label>
  					 	<input type="text" name="name" class="form-control" value="5000" readonly>
  						</div>

  						<div class="col-sm-4">
  					 	<label>Cheque number</label>
  					 	<input type="text" name="name" class="form-control">
  						</div>	
						</div>
  						</form>
						</div>

						<div id="online" class="tabcontent" >
  						<h3 class="check-box-title" style="padding: 0px;">Online</h3>
  						<form>
  						<div class="row">	
  						<div class="col-sm-12">
  					 	<label>Bank name</label>
  					 	<select class="form-control kt-select2 select-mt" id="kt_select2_11" name="param" style="width: 100%;">
                        <option value="AK">Select Bank</option>
                        <option value="AK">ICIC Bank</option>
                        <option value="HI">Bank of India</option>
                        <option value="HI">HDFC Bank</option>
                		</select>
  						</div>

  						<div class="col-sm-12 padding-mt">
						<label>Amount
        				<span class="text-danger">*</span></label>	
						<input type="name" class="form-control" aria-describedby="emailHelp" value="1200" readonly>
						</div>	
						</div>
  						</form>
						</div>	

						<div id="NR" class="tabcontent">
  						<h3 class="check-box-title" style="padding: 0px;">NEFT/RTGS</h3>
  						<form>
  						<div class="row">	
  						<div class="col-sm-12">
						<label>Transaction Id:
        				<span class="text-danger">*</span></label>	
						<input type="name" class="form-control" aria-describedby="emailHelp">
						</div>

  							
						</div>
  						</form>
						</div>	
						</div>	
				</div>
				</div>
	            </div>
		   	  </div>
		   </div>
	    </form>
	    </div>
        </div>




        <div class="nominee-details-mtt Half-section-details">
        <h3>Nominee Details</h3>
        <div class="sahyognidhi-border"></div>
           <div class="row">
		   	  <div class="col-md-6 col-sm-6 col-lg-6">

		   	  	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Nominee Name
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       <!-- 	<div class="col-lg-1 padding-kt">
		       	<a href="#" class="nominee-details-add">
		        <i class="la la-plus"></i>
		        </a>
		        </div> -->
				</div>

				<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Relation
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		       	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Mobile No.
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		       

		       	 <div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Bank Name
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		       	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Branch Name
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		       	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Account Number
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		       	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">IFSC code
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-9">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>



		   	  </div>
		   	   <div class="col-md-6 col-sm-6 col-lg-6">

		   	   		  	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Nominee Name
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-8">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	<div class="col-lg-1 padding-kt">
		       	<a href="#" class="nominee-details-add">
		        <i class="la la-plus"></i>
		        </a>
		        </div>
				</div>

				<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Relation
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-8">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		       	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Mobile No.
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-8">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		      

		       	 <div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Bank Name
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-8">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		       	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Branch Name
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-8">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		       	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">Account Number
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-8">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		       	<div class="form-group1 m-form__group1 row">	
		        <label class="col-lg-3 col-form-label">IFSC code
		        <span class="text-danger">*</span></label>	
		        <div class="col-lg-8">
		        <input type="name" class="form-control" aria-describedby="emailHelp">
		       	</div>
		       	</div>

		   	  </div>
		   	</div>
		</div>
		   	  	<!--  <div class="form-group1 m-form__group1 row">	
            <label class="col-lg-2 col-form-label">Nominee
            <span class="text-danger">*</span>	
            </label>	
            <div class="col-lg-10"> -->
          	<!-- <div class="row"> -->
						<!-- <div class="col-sm-3">	
						<div class="kt-radio-inline redio-mt">
							<label class="kt-radio">
								<input type="radio" name="radio2"> Nominee 1
								<span class="tablinks" onclick="openCity(event, 'n1')"></span>
							</label>
						</div>
						</div>
						<div class="col-sm-3">	
						<div class="kt-radio-inline redio-mt">
							<label class="kt-radio">
								<input type="radio" name="radio2"> Nominee 2
								<span class="tablinks" onclick="openCity(event, 'n2')"></span>
							</label>
						</div>
						</div>
					 -->
				
						<!-- <div class="col-sm-12"> -->
					<!-- 	<div id="n1" class="tabcontent">
  						<h3 class="check-box-title" style="padding: 0px;margin-bottom: 0px;">Nominee 1</h3>
						<form>
  						<div class="row">	

  						<div class="col-sm-4 padding-mt">
  					 	<label>Nominee name</label>
  					 	<input type="text" name="name" class="form-control" readonly>
  						</div> 

				  		<div class="col-sm-4 padding-mt">	
				        <label>Relation</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp" readonly>
				        </div>

				        <div class="col-sm-4 padding-mt">	
				        <label>Mobile No</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp" readonly>
				        </div>

				         <div class="col-sm-4 padding-mt">	
				        <label>Bank Name</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp">
				        </div>

				         <div class="col-sm-4 padding-mt">	
				        <label>Branch Name</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp">
				        </div>

				        <div class="col-sm-4 padding-mt">	
				        <label>Account Number</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp">
				        </div>

				        <div class="col-sm-12 padding-mt">	
				        <label>Bank Details</label>	
				        <textarea class="form-control" id="exampleTextarea" rows="5"></textarea>
				        </div>

				        -->
				       	
				       <!-- 	<div class="col-lg-1 padding-kt">
				       	<a href="#" class="nominee-details-add">
				        <i class="la la-plus"></i>
				        </a>
				        </div> -->
						


  					<!-- 	<div class="col-sm-12 padding-mt">
  					 	<label>Bank name</label>
  					 	<select class="form-control kt-select2 select-mt" id="kt_select2_9" name="param" style="width: 100%;">
                        <option value="AK">Select Bank</option>
                        <option value="AK">ICIC Bank</option>
                        <option value="HI">Bank of India</option>
                        <option value="HI">HDFC Bank</option>
                		</select>
  						</div>	
						
  						<div class="col-sm-12 padding-mt">
						<label>Amount
        				<span class="text-danger">*</span></label>	
						<input type="name" class="form-control" aria-describedby="emailHelp" value="7000"readonly>
						</div>

						
						<div class="col-sm-9 padding-mt">
						<label>upload Proof<span class="text-danger">*</span></label>
        				<input type="file" class="form-control profile-height" id="photo2" aria-describedby="emailHelp">	
						</div>	

						<div class="col-sm-3 padding-mt">	
						<div class="profile-img upload-proof-img">
        				<img src="assets/img/product10.jpg" id="profile2-img-tag">	
        				</div>
						</div> -->	







						<!-- </div>
						</form>
						</div> -->
<!-- 
						<div id="n2" class="tabcontent" >
  						<h3 class="check-box-title" style="padding: 0px;margin-bottom: 0px;">Nominee 2</h3>
  						<form>
  						<div class="row">	
  						<div class="col-sm-4 padding-mt">
  					 	<label>Nominee name</label>
  					 	<input type="text" name="name" class="form-control" readonly>
  						</div> 

				  		<div class="col-sm-4 padding-mt">	
				        <label>Relation</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp" readonly>
				        </div>

				        <div class="col-sm-4 padding-mt">	
				        <label>Mobile No</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp" readonly>
				        </div>

				         <div class="col-sm-4 padding-mt">	
				        <label>Bank Name</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp">
				        </div>

				         <div class="col-sm-4 padding-mt">	
				        <label>Branch Name</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp">
				        </div>

				        <div class="col-sm-4 padding-mt">	
				        <label>Account Number</label>	
				        <input type="name" class="form-control" aria-describedby="emailHelp">
				        </div>

				        <div class="col-sm-12 padding-mt">	
				        <label>Bank Details</label>	
				        <textarea class="form-control" id="exampleTextarea" rows="5"></textarea>
				        </div>


						
  							
						</div>
  						</form>
						</div>	 -->
						<!-- </div>	 -->
				<!-- </div> -->
				<!-- </div>
	            </div> -->
		   	  <!-- </div>
		   </div> -->

   <!--      <div class="form-group1 m-form__group1 row">	
        <label class="col-lg-2 col-form-label">Nominee Name
        <span class="text-danger">*</span></label>	
        <div class="col-lg-9">
        <input type="name" class="form-control" aria-describedby="emailHelp">
       	</div>
       	<div class="col-lg-1 padding-kt">
       	<a href="#" class="nominee-details-add">
        <i class="la la-plus"></i>
        </a>
        </div>
		</div>
		<div class="form-group1 m-form__group1 row">	
        <label class="col-lg-2 col-form-label">Nominee Relation
        <span class="text-danger">*</span></label>	
        <div class="col-lg-9">
        <input type="name" class="form-control" aria-describedby="emailHelp">
       	</div>
       	</div>
       	<div class="form-group1 m-form__group1 row">	
        <label class="col-lg-2 col-form-label">Nominee Email ID
        <span class="text-danger">*</span></label>	
        <div class="col-lg-9">
        <input type="name" class="form-control" aria-describedby="emailHelp">
       	</div>
       	</div>
       	<div class="form-group1 m-form__group1 row">	
        <label class="col-lg-2 col-form-label">Nominee Contact Number
        <span class="text-danger">*</span></label>	
        <div class="col-lg-9">
        <input type="name" class="form-control" aria-describedby="emailHelp">
       	</div>
       	</div>
       	<div class="form-group1 m-form__group1 row">	
        <label class="col-lg-2 col-form-label">Nominee Bank Number
        <span class="text-danger">*</span></label>	
        <div class="col-lg-9">
        <input type="name" class="form-control" aria-describedby="emailHelp">
       	</div>
       	</div>
       	<div class="form-group1 m-form__group1 row">	
        <label class="col-lg-2 col-form-label">Nominee IFSC Code
        <span class="text-danger">*</span></label>	
        <div class="col-lg-9">
        <input type="name" class="form-control" aria-describedby="emailHelp">
       	</div>
       	</div> -->
		<!-- </div>	 -->
<!-- 		<div class="nominee-details-mtt Half-section-details">
        <h3>Claim Details</h3>
        <div class="sahyognidhi-border"></div>
        <div class="claim-section">
        <div class="row">
       	<div class="col-md-12">
       	<div class="claim-total-amount-label">	
       	<span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Claim Total Amonut - <i class="la la-rupee"></i>10,00,000</span>	
       	</div>
       	</div>
       <div class="col-lg-4">
       	<label>Nominee Name
        <span class="text-danger">*</span></label>	
        <select class="form-control kt-select2" id="kt_select2_3" name="param" style="width: 100%;">
            <option value="AK">Select a Nominee</option>
            <option value="AK">Alaska</option>
            <option value="HI">Hawaii</option>
            <option value="CA">California</option>
            <option value="NV">Nevada</option>
        </select>
        </div>
        <div class="col-lg-4">
       	<label>Claim Amount
        <span class="text-danger">*</span></label>	
        <input type="name" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="col-lg-3">
       	<label>Claim Date
        <span class="text-danger">*</span></label>	
       	<input type="name" class="form-control dateselect">
        </div>
      	<div class="col-lg-1 text-right">
      	<div class="claim-add-btn">
      	<a href="#" class="nominee-details-add">
        <i class="la la-plus"></i>
        </a>	
      	</div>
      	</div>
      	</div>
      	</div>
		</div> -->
<!-- 		<div class="nominee-details-mtt Half-section-details">
        <h3>Not Applicable for claim</h3>
        <div class="sahyognidhi-border"></div>
    	<div class="form-group1 m-form__group1 row">	
        <label class="col-lg-2 col-form-label">Reason
        <span class="text-danger">*</span></label>	
        <div class="col-lg-9">
        <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
       	</div>
       	</div>
       	</div> -->
       	<div class="nominee-details-mtt">
       	<h3></h3>
       	<div class="sahyognidhi-border"></div>
       	<div class="form-group1 m-form__group1 row">	
        <label class="col-lg-2 col-form-label"></label>	
        <div class="col-lg-9">
        <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
        <div class="kt-portlet__head-actions">
        <a href="add-registration.php" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
        <i class="la la-plus"></i>
        Add
        </a>
        <a href="#" class="btn-cancel-registration">Cancel</a>
        </div>
        </div>
      	</div>
        </div>
        </div>
    	</div>
		</form>	
		</div>
		</div>










		</div>











</div>	
</div>	
</div>
</div>
<!-- content end -->
	

				<!-- begin:: Footer -->
				<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop"  id="kt_footer">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-footer__copyright">
							2019&nbsp;&copy;&nbsp;<a href="#" class="kt-link">Yuva Sangh</a>
						</div>
						<div class="kt-footer__menu">
							<a href="#" class="kt-footer__menu-link kt-link">About</a>
							<a href="#" class="kt-footer__menu-link kt-link">Team</a>
							<a href="#" class="kt-footer__menu-link kt-link">Contact</a>
						</div>
					</div>
				</div>
				<!-- end:: Footer -->           
			</div>
		</div>
	</div>
	<!--ENd:: Chat-->
	<!-- begin::Global Config(global config for global JS sciprts) -->
	<script>
		var KTAppOptions = {"colors":{"state":{"brand":"#22b9ff","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
	</script>
	<!-- end::Global Config -->
	<!--begin::Global Theme Bundle(used by all pages) -->
	<!-- <script src="{{ URL::asset('assets/vendors/global/vendors.bundle.js') }}" type="text/javascript"></script>
	<script src="assets/js/scripts.bundle.js" type="text/javascript"></script> -->
	<script src="assets/js/vendors.bundle.js" type="text/javascript"></script>
	<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	<!--end::Global Theme Bundle -->
	<!--begin::Page Vendors(used by this page) -->
	<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
	<script src="assets/vendors/custom/gmaps/gmaps.js" type="text/javascript"></script>
	<!--end::Page Vendors -->
	<!--begin::Page Scripts(used by this page) -->
	
	<!--begin::Page Scripts(used by this page) -->
    <script src="assets/js/select2.js" type="text/javascript"></script>
    <!--begin::Page Scripts(used by this page) -->

	<script src="assets/plugin/datatables/datatables.bundle.js" type="text/javascript"></script>
	<!--end::Page Scripts -->

	<script src="assets/js/dashboard.js" type="text/javascript"></script>
</body>
<script>
  $('.date').mask('00/00/0000');
 $("#kt_select2_5555").select2();

function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}
</script>

<script type="text/javascript">
	$(".dateselect").datepicker({
	  format: 'dd-mm-yyyy',
	  orientation: "bottom left",
	  todayHighlight:true

	}).on('change', function(){
        $('.datepicker').hide();
    });
	</script>


	<script>
	function openCity(evt, cityName) {
  	var i, tabcontent, tablinks;
  	tabcontent = document.getElementsByClassName("tabcontent");
  	for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
 	 }
  	tablinks = document.getElementsByClassName("tablinks");
  	for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  	}
  	document.getElementById(cityName).style.display = "block";
  	evt.currentTarget.className += " active";
	}
	</script>
</html>