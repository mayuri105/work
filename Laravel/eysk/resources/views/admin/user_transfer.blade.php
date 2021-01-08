@extends('elements.user_admin')
@section('content')
<!-- content -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="row" style="width: 100%;">
				<div class="col-md-10">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">
								Transfer                  
							</h3>
						</div>
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper"></div>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper"></div>
						</div>
						<div class="kt-subheader__main">
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->        


	<!-- begin:: Content -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height: 440px;">
		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						 Details
					</h3>
				</div>
			</div>

			{{-- @foreach($getAllBankEntry as $getAllBankEntry) --}}
			<div class="main-padding ceparetar">
				<div class="row"> 

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Ysk Id</span>
							<span class="view-value-text">@if($myRegistrationData['ysk_id'] != '') {{ $myRegistrationData['ysk_id'] }} @else {{ $myRegistrationData['pre_ysk_id'] }} @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Ysk Member Name</span>
							<span class="view-value-text">{{ strtoupper($myRegistrationData['name_as_per_yuva_sangh_org']) }} </span>
						</div>
					</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Joining Date</span>
								<span class="view-value-text">{{ date('d-m-Y',strtotime($myRegistrationData['today_date'])) }} </span>
							</div>
						</div>
					{{-- @else --}}
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Joining Age</span>
								<span class="view-value-text"> {{ $myRegistrationData['age'] }}</span>
							</div>
						</div>
					{{-- @endif --}}

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Joining Amount</span>
							<span class="view-value-text"> {{ $myRegistrationData['registration_amount'] }} </span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Transfer Date</span>
							<span class="view-value-text"> {{ date('d-m-Y',strtotime($myRegistrationData['updated_at'])) }} </span>
						</div>
					</div>
				</div>
				<hr>
				<div class="row"> 

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">New Ysk Id</span>
							<span class="view-value-text">@if($transferRegistrationData['ysk_id'] != '') {{ $transferRegistrationData['ysk_id'] }} @elseif($transferRegistrationData['ysk_id'] == '') {{ $transferRegistrationData['pre_ysk_id'] }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">New Ysk Member Name</span>
							<span class="view-value-text"> {{ $transferRegistrationData['name_as_per_yuva_sangh_org'] }}</span>
						</div>
					</div>


						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Joining Date</span>
								<span class="view-value-text">@if($transferRegistrationData['today_date'] != '') {{ date('d-m-Y',strtotime($transferRegistrationData['today_date'])) }} @else -  @endif </span>
							</div>
						</div>
					
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Joining Age</span>
								<span class="view-value-text"> {{ $transferRegistrationData['age'] }}</span>
							</div>
						</div>
					

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Transfer Date</span>
							<span class="view-value-text">@if($transferRegistrationData['created_at'] != '') {{ date('d-m-Y',strtotime($transferRegistrationData['created_at'])) }} @else - @endif </span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Joining Amount</span>
							<span class="view-value-text"> {{ $transferRegistrationData['registration_amount'] }} </span>
						</div>
					</div>

					@php $differenceAmount = $transferRegistrationData['registration_amount'] - $myRegistrationData['registration_amount']@endphp
					@if($transferRegistrationData['registration_amount'] > $myRegistrationData['registration_amount'])
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Difference Amount</span>
							<span class="view-value-text"> {{ $differenceAmount }} </span>
						</div>
					</div>
					@endif
				</div>
			</div>
			<!--end::Portlet-->
			{{-- @endforeach --}}
		</div>
	</div>
</div>
<!-- content end -->   
@endsection 
