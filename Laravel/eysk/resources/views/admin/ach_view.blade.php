@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')
<!-- content -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="row" style="width: 100%;">
				<div class="col-md-6">
					<div class="kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title top-title-mtt">
								View ACH
							</h3>
						</div>
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper"></div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions main-back">
								<a href="{{ route('ach') }}" class="btn btn-clean btn-icon-sm back-tt">
									<i class="la la-long-arrow-left"></i>
									Back
								</a>
							</div>	
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->        


	<!-- begin:: Content -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!--begin::Portlet-->
		<div class="main-height">
			<div class="kt-portlet kt-portlet--tab">
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="kt-title__head kt-title__head-1">
							<div class="kt-portlet__header">
								<h3 class="title-ktt-view">
									ACH Details
								</h3>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-6">
						<div class="umrn-number-section">
							@if($viewAch['umrn_number'] != '')  
							 	<span class="view-value-text">UMRN Number : {{ $viewAch['umrn_number'] }}</span>
							@endif	
						</div>
					</div>

					<div class="col-sm-12 col-md-12">
						<div class="view-ach-border"></div>	
					</div>

				</div>

				<div class="main-padding ceparetar">
					<div class="row"> 
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">YSK ID</span>
								<span class="view-value-text">{{ $viewAch['name_as_per_yuva_sangh_org'] }}(Ysk -{{ $viewAch['ysk_id'] }})</span>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Name</span>
								<span class="view-value-text">{{ $viewAch['name'] }}</span>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Bank Name</span>
								<span class="view-value-text">{{ $viewAch['bank_name'] }}</span>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Bank Account Number</span>
								<span class="view-value-text">{{ $viewAch['bank_account_number'] }}</span>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">IFSC Code</span>
								<span class="view-value-text">{{ $viewAch['ifsc_code'] }}</span>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">MICR Code </span>
								<span class="view-value-text">{{ $viewAch['micr_code'] }}</span>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">City</span>
								<span class="view-value-text">{{ $viewAch['city_name'] }}</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Email</span>
								<span class="view-value-text">{{ $viewAch['email'] }}</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Phone Number</span>
								<span class="view-value-text">{{ $viewAch['phone_number'] }}</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Region</span>
								<span class="view-value-text">{{ $viewAch['region_name'] }}({{ $viewAch['region_code'] }})</span>
							</div>
						</div>

					</div>
				</div>
				<!--end::Portlet-->
			</div>
		</div>
	</div>
	<!-- content end -->      
</div>
<!--ENd:: Chat-->
@endsection