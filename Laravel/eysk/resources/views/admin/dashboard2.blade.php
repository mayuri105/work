@extends('elements.admin_master')
@section('content')
<style type="text/css" media="screen">
	.kt-widget__item.active {
	    background-color: #f5f6fc;
	    color: #22b9ff !important;
	}
	.kt-widget.kt-widget--users .kt-widget__item {
	    display: flex;
	    margin: 3px 0 3px 0;
	    padding: 10px;
	}
	.kt-widget.kt-widget--users .active .kt-widget__info .kt-widget__section .kt-widget__username{
		color: #22b9ff !important;
	}
	i.flaticon2-bell-alarm-symbol{
		font-size: 16px;
	}
	.active-color{
		color: #22b9ff !important;
	}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Dashboard                            
				</h3>
			</div>
			<div class="kt-subheader__toolbar">
				<div class="kt-subheader__wrapper"></div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->                    
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
   

    <!--Begin:: App Aside-->
    <div class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--lg kt-app__aside--fit">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--last">
            <div class="kt-portlet__body">
                <div class="kt-searchbar text-center kt-subheader__main">
                    <h3 class="kt-subheader__title">General Settings</h3>
                </div>
                <hr style="width: 100%;margin-bottom: 0px;">
                <div class="kt-widget kt-widget--users kt-mt-10">
                    <div class="kt-scroll kt-scroll--pull">
                        <div class="kt-widget__items">
                            <div class="kt-widget__item active">
                            	<a href="#" class="kt-nav__link active-color">
	                                <span class="kt-userpic kt-userpic--circle"> 
	                                    <i class="flaticon2-bell-alarm-symbol"></i> 
	                                </span>
	                                <div class="kt-widget__info">
	                                    <div class="kt-widget__section">
	                                        <a href="#" class="kt-widget__username">Role</a>
	                                    </div>
	                                </div>
	                                <div class="kt-widget__action">
	                                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
	                                </div>
	                            </a>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-userpic kt-userpic--circle"> 
                                    <i class="flaticon2-bell-alarm-symbol"></i> 
                                </span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Role</a>
                                    </div>
                                </div>
                                <div class="kt-widget__action">
                                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
    <!--End:: App Aside-->

    <!--Begin:: App Content-->
    <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        
    </div>
    <!--End:: App Content-->
</div>
	</div>
</div>
@endsection
@section('content_js')
<script src="{{ URL::asset('assets/js/dashboard.js') }}" type="text/javascript"></script>
@endsection