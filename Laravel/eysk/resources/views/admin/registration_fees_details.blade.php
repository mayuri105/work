@extends('elements.admin_master')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Registration Fees                       
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
		<div class="row flashmessages">
			@if ($message = Session::get('success'))
			<div class="col-md-12 mb-12">
				<div class="alert alert-success" role="alert">
					{{ $message }}
				</div>
			</div>
			@endif
			@if ($message = Session::get('error'))
			<div class="col-md-12 mb-12">
				<div class="alert alert-danger" role="alert">
					{{ $message }}
				</div>
			</div>
			@endif
		</div>
		<div class="row">

			<div class="col-xl-4 col-lg-3 order-lg-1 order-xl-1">
				@include('elements.left_bar',array('accessData'=>$accessData))
			</div>
			<div class="col-xl-4 col-lg-9 order-lg-1 order-xl-1">
				<div class="kt-portlet kt-portlet--mobile">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Details
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<a href="{{ route('registration-fees') }}" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										Back
									</a>
								</div>	
							</div>		
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<div class="kt-widget12">
							<div class="kt-widget12__content">
				                <div class="kt-widget12__item">					 	 
				                    <div class="kt-widget12__info">
				                        <span class="kt-widget12__desc">Start Date</span> 
				                        <span class="kt-widget12__value">{{ date("d-m-Y",strtotime($editRegistrationFeesData->start_date)) }}</span>
				                    </div>	

				                    <div class="kt-widget12__info">
				                        <span class="kt-widget12__desc">End Date</span>
				                        <span class="kt-widget12__value">{{ date("d-m-Y",strtotime($editRegistrationFeesData->end_date)) }}</span> 
				                    </div>							 		 	 
				                </div>
				                
							</div>
							
						</div>
						<div class="table-responsive">
							<table class="table">
	                            <thead>
	                                <tr>
	                                    <th>DESCRIPTION</th>
	                                    <th>Start Age</th>
	                                    <th>End Age</th>
	                                    <th>Fees Amount</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <tr>
	                                    <td>Age Group - 1</td>
	                                    <td>{{ $editRegistrationFeesData->start_age1 }}</td>
	                                    <td>{{ $editRegistrationFeesData->end_age1 }}</td>
	                                    <td><i class="la la-inr"></i>{{ $editRegistrationFeesData->fees_amount1 }}</td>
	                                </tr>
	                                <tr>
	                                    <td>Age Group - 2</td>
	                                    <td>{{ $editRegistrationFeesData->start_age2 }}</td>
	                                    <td>{{ $editRegistrationFeesData->end_age2 }}</td>
	                                    <td><i class="la la-inr"></i>{{ $editRegistrationFeesData->fees_amount2 }}</td>
	                                </tr>
	                                <tr>
	                                    <td>Age Group - 3</td>
	                                    <td>{{ $editRegistrationFeesData->start_age3 }}</td>
	                                    <td>{{ $editRegistrationFeesData->end_age3 }}</td>
	                                    <td><i class="la la-inr"></i>{{ $editRegistrationFeesData->fees_amount3 }}</td>
	                                </tr>
	                                <tr>
	                                    <td>Age Group - 4</td>
	                                    <td>{{ $editRegistrationFeesData->start_age4 }}</td>
	                                    <td>{{ $editRegistrationFeesData->end_age4 }}</td>
	                                    <td><i class="la la-inr"></i>{{ $editRegistrationFeesData->fees_amount4 }}</td>
	                                </tr>
	                            </tbody>
	                        </table>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>
@endsection
@section('content_js')
<script src="{{ URL::asset('assets/js/dashboard.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection