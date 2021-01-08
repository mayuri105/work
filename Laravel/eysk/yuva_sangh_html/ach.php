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
	
	<link href="assets/css/datatables.bundle.css" rel="stylesheet" type="text/css" />
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
								<a href="#">
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

								<li class="kt-menu__item" aria-haspopup="true"><a href="sahyognidhi-request.php" class="kt-menu__link"><span class="kt-menu__link-text">Sahyognidhi Request</span></a></li>

								<li class="kt-menu__item" aria-haspopup="true"><a href="55-year-old.php" class="kt-menu__link"><span class="kt-menu__link-text">55 Year Old</span></a></li>

								<li class="kt-menu__item kt-menu__item--active" aria-haspopup="true"><a href="ach.php" class="kt-menu__link"><span class="kt-menu__link-text">ACH</span></a></li>

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
					<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
						<div class="kt-container  kt-container--fluid ">
							<div class="kt-subheader__main">
								<h3 class="kt-subheader__title">
									ACH                      
								</h3>
							</div>
							<div class="kt-subheader__toolbar">
								<div class="kt-subheader__wrapper"></div>
							</div>
						</div>
					

					


					</div>
					</div>
					<!-- end:: Subheader -->        
						 <!-- my section new add start-->

    	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--begin::Portlet-->
        
        
		        <div class="kt-portlet kt-portlet--tab">
		            <div class="kt-title__head">
		                <div class="kt-portlet__header">
		                 	<h3 class="title-ktt-view">
		                       ACH Process:	
		                   </h3>
		                </div>
		            </div>
		            
					
					<div class="main-padding ceparetar">
		           	  <div class="row"> 
		           	     <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">ACH Pending</span>
		                    	<span class="view-value-text">10</span>
		           	        </div>
		             	</div>
		             	  <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">ACH Done</span>
		                    	<span class="view-value-text">120</span>
		           	        </div>
		             	</div>
		             	  <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">YSK member to YSK Office</span>
		                    	<span class="view-value-text">5</span>
		           	        </div>
		             	</div>
		             	  <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">Office To Bank</span>
		                    	<span class="view-value-text">4</span>
		           	        </div>
		             	</div>
		             	 <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">UMRN Received</span>
		                    	<span class="view-value-text">130</span>
		           	        </div>
		             	</div>
		             	 <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">ACH Rejected But Not reapply </span>
		                    	<span class="view-value-text">8</span>
		           	        </div>
		             	</div>
		             	 <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">ACH Reprocess</span>
		                    	<span class="view-value-text">80</span>
		           	        </div>
		             	</div>
		              </div>
		            </div>
		        </div>
          </div>


       <!-- my section new add end-->   
					<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
						
					
					
	<!-- registration date table -->
			<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<di<div class="kt-portlet kt-portlet--mobile">
   		<div class="kt-portlet__head kt-portlet__head--lg">
      
      <div class="kt-portlet__head-label">
         <span class="kt-portlet__head-icon">
         <i class="kt-font-brand flaticon2-line-chart"></i>
         </span>
         <h3 class="kt-portlet__head-title">
            List
         </h3>
      </div>
      
      <div class="kt-portlet__head-toolbar">
        <div class="dropdown-section">
        <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 180px;">
        Select Status
        </button>
       	<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
        <a class="dropdown-item" href="#">User To YSK Office</a>
        <a class="dropdown-item" href="#">ACH Form Received</a>
        <a class="dropdown-item" href="#">Sent To Bank</a>
        <a class="dropdown-item" href="#">Ready For UMRN</a>
        </div>
        </div>
    	</div>

         <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
               <a href="add-ach.php" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
               <i class="la la-plus"></i>
               Add ACH
               </a>

               <a href="add-registration.php" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
               <i class="la la-trash"></i>
               Delete All
               </a>
            </div>
         </div>
      </div>


   </div>
   <div class="kt-portlet__body">
      <!--begin: Datatable -->
      <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
         <div class="row">
               <div class="col-sm-12 col-md-6">
                  <div class="dataTables_length" id="kt_table_1_length">
                     <label>
                        Show 
                        <select name="kt_table_1_length" aria-controls="kt_table_1" class="custom-select custom-select-sm form-control form-control-sm">
                           <option value="10">10</option>
                           <option value="25">25</option>
                           <option value="50">50</option>
                           <option value="100">100</option>
                        </select>
                        entries
                     </label>
                  </div>
               </div>
               <div class="col-sm-12 col-md-6">
                  <div id="kt_table_1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="kt_table_1"></label></div>
               </div>
            </div> 
         <div class="row">
            <div class="col-sm-12">
               <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="kt_table_1" role="grid" aria-describedby="kt_table_1_info" style="width: 1147px;">
                  <thead>
                     
                    <tr role="row">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Apply Date</th>
                         <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">Region Name</th>
                         <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">YSK Number</th>
                        <th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">YSK Name</th> 
                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Phone Number</th>
                      	<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Status</th>
                     	<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.5px;" aria-label="Actions">Actions</th>
                     	</tr>
                  </thead>
                  <tbody>
                     <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                        <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>
                        <td>1234567890</td>
                        	
                       
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                           	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>
                     <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>

                        <td>1234567890</td>
                        
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>
                    <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>

                        <td>1234567890</td>
                        
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>
                     <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>

                        <td>1234567890</td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>
                    <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>

                        <td>1234567890</td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>
                     <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>

                        <td>1234567890</td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                          <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>
                     <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>

                        <td>1234567890</td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>
                     <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>

                        <td>1234567890</td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>
                     <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>

                        <td>1234567890</td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>
                     <tr role="row" class="odd">
                        <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
                        </th>
                         <td>12/12/2017</td>
                        <td>lorem ipsum</td>
                        <td>yuvasangh@121</td>
                        
                        <td>lorem ipsum</td>

                        <td>1234567890</td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Status
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                       	<a class="dropdown-item" href="#">User To YSK Office</a>
                        <a class="dropdown-item" href="#">ACH Form Received</a>
                        <a class="dropdown-item" href="#">Sent To Bank</a>
                        <a class="dropdown-item" href="#">Ready For UMRN</a>
                        </div>
                        </div>
                    	</td>
                        
                        <td nowrap="">
                          <a href="view-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                           <i class="la la-eye"></i>
                           </a>
                            <a href="edit-ach.php" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
                           <i class="la la-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
                           <i class="la la-trash"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_2" title="popup">
                        	<i class="la la-external-link"></i>
                        	</a>
                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
                        	<i class="la la-print"></i>
                        	</a>
                        </td>
                     </tr>

                  </tbody>
               </table>
            </div>
         </div>
      <div class="row">
               <div class="col-sm-12 col-md-5">
                  <div class="dataTables_info" id="kt_table_1_info" role="status" aria-live="polite">Showing 1 to 10 of 50 entries</div>
               </div>
               <div class="col-sm-12 col-md-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="kt_table_1_paginate">
                     <ul class="pagination">
                        <li class="paginate_button page-item previous disabled" id="kt_table_1_previous"><a href="#" aria-controls="kt_table_1" data-dt-idx="0" tabindex="0" class="page-link"><i class="la la-angle-left"></i></a></li>
                        <li class="paginate_button page-item active"><a href="#" aria-controls="kt_table_1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                        <li class="paginate_button page-item next" id="kt_table_1_next"><a href="#" aria-controls="kt_table_1" data-dt-idx="6" tabindex="0" class="page-link"><i class="la la-angle-right"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
      </div>
      <!--end: Datatable -->
   </div>
</div>	
<!-- registration date table -->
</div>
</div>
<!-- content end -->

				

			<!--begin::Modal-->
				<div class="modal fade" id="kt_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    			<div class="modal-dialog" role="document">
        		<div class="modal-content">
            	<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter UMRN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            	</div>
            	<div class="modal-body">
               	<form>
               	<div class="registration-list-modal">
               	<div class="row">	
               	
               	<div class="col-sm-12 col-md-12">
               	<label>UMRN Number</label>
               	<input type="name" class="form-control" aria-describedby="emailHelp">
               	</div>

               	</div>

               	</div>
               	</form>
               	</div>
            	<div class="modal-footer">
               	<button type="button" class="btn btn-primary">Save</button>
               	
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->



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
	<!--end::Global Theme Bundle -->
	<!--begin::Page Vendors(used by this page) -->
	<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
	<script src="assets/vendors/custom/gmaps/gmaps.js" type="text/javascript"></script>
	<!--end::Page Vendors -->
	<!--begin::Page Scripts(used by this page) -->
	
	<script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>


	<!--end::Page Scripts -->
	<!--begin::Page Scripts(used by this page) -->
    <script src="assets/js/datatables.bundle.js" type="text/javascript"></script>
    <!--end::Page Scripts -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="assets/js/select2.js" type="text/javascript"></script>
    <!--end::Page Scripts -->
	<script src="assets/js/dashboard.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(".dateselect").datepicker({
	  format: 'dd-mm-yyyy',
	  orientation: "bottom left",
	  todayHighlight:true

	}).on('change', function(){
        $('.datepicker').hide();
    });
</script>
</body>
</html>