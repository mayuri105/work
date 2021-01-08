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
								View Suspense Account                           
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
							<a href="{{ route('suspense-account') }}">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
						</div>						
					</div>
				</div>
			</div>
		</div>
	<!-- end:: Subheader -->        


	<!-- begin:: Content -->
		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						Suspense Account Details
					</h3>
				</div>
			</div>

			<div class="main-padding ceparetar">
				<div class="row"> 
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Bank Name</span>
							<span class="view-value-text">{{ $detailsSuspenseAccount['legder_name'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Payment Type</span>
							<span class="view-value-text">{{ $detailsSuspenseAccount['payment_type'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Payment Date</span>
							<span class="view-value-text">{{ date("d-m-Y", strtotime($detailsSuspenseAccount['date'])) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Amount</span>
							<span class="view-value-text"><i class="la la-inr"></i>{{ $detailsSuspenseAccount['amount'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Payment Mode</span>
							<span class="view-value-text">{{ $detailsSuspenseAccount['payment_mode'] }}</span>
						</div>
					</div>

					@if($detailsSuspenseAccount['cheque_number'] != '')
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Cheque Number</span>
								<span class="view-value-text">{{ $detailsSuspenseAccount['cheque_number'] }}</span>
							</div>
						</div>
					@endif

					@if($detailsSuspenseAccount['transaction_id'] != '')
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Transaction Id</span>
								<span class="view-value-text">{{ $detailsSuspenseAccount['transaction_id'] }}</span>
							</div>
						</div>
					@endif

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Detail</span>
							<span class="view-value-text">{{ $detailsSuspenseAccount['details'] }}</span>
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
