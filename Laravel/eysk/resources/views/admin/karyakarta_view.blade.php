@extends('elements.admin_master',array('accessData'=>$accessData))
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
								View Karyakarta                           
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
							<a href="{{ route('karyakarta') }}">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
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
						Karyakarta Details
					</h3>
				</div>
			</div>

			
			<div class="main-padding ceparetar">
				<div class="row"> 
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Ysk Id</span>
							<span class="view-value-text">{{ $viewKaryakartaDetails['ysk_id'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Employee Name</span>
							<span class="view-value-text">{{ $viewKaryakartaDetails['name_as_per_yuva_sangh_org'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Details</span>
							<span class="view-value-text">{{ $viewKaryakartaDetails['ysk_details'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Start Date</span>
							<span class="view-value-text">{{ date('d-m-Y',strtotime($viewKaryakartaDetails['start_date'])) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Phone Number 1</span>
							<span class="view-value-text">{{ $viewKaryakartaDetails['phone_number_first'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Phone Number 2</span>
							<span class="view-value-text">@if($viewKaryakartaDetails['phone_number_second'] != ''){{ $viewKaryakartaDetails['phone_number_second'] }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Email</span>
							<span class="view-value-text">@if($viewKaryakartaDetails['email'] != ''){{ $viewKaryakartaDetails['email'] }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">City</span>
							<span class="view-value-text">@if($viewKaryakartaDetails['city'] != ''){{ $viewKaryakartaDetails['city'] }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Region</span>
							<span class="view-value-text">@if($viewKaryakartaDetails['region_name'] != ''){{ strtoupper($viewKaryakartaDetails['region_name']) }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Yuva Mandal</span>
							<span class="view-value-text">@if($viewKaryakartaDetails['yuva_mandal_name'] != ''){{ strtoupper($viewKaryakartaDetails['yuva_mandal_name']) }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Council</span>
							<span class="view-value-text">@if($viewKaryakartaDetails['council_name'] != '') {{ strtoupper($viewKaryakartaDetails['council_name']) }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Samaj Zone</span>
							<span class="view-value-text">@if($viewKaryakartaDetails['samaj_zone_name'] != ''){{ strtoupper($viewKaryakartaDetails['samaj_zone_name']) }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Division</span>
							<span class="view-value-text">@if($viewKaryakartaDetails['division_name'] != ''){{ strtoupper($viewKaryakartaDetails['division_name']) }} @else - @endif</span>
						</div>
					</div>
					
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Karyakarta Email Id</span>
							<span class="view-value-text">{{ $viewKaryakartaDetails['karyakarta_email_id'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Password</span>
							<span class="view-value-text">{{ $viewKaryakartaDetails['password'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Completion Date</span>
							<span class="view-value-text">@if($viewKaryakartaDetails['end_date'] != '0000-00-00'){{ $viewKaryakartaDetails['end_date'] }} @else - @endif</span>
						</div>
					</div>
				</div>
			</div>
			<!--end::Portlet-->
		</div>
	</div>
</div>
<!-- content end -->   
@endsection 
@section('content_js')
<script>
	$('#fk_designation_id').select2();
	$('#fk_region_id').select2();
</script>
@endsection