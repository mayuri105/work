@extends('elements.admin_master')
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
								View Courier	
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
								<a href="{{ route('courier') }}" class="btn btn-clean btn-icon-sm back-tt">
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
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height: 440px;">
		<!--begin::Portlet-->


		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						Courier Details
					</h3>
				</div>
			</div>

			
			<div class="main-padding ceparetar">
				<div class="row"> 
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">YSK Number</span>
							<span class="view-value-text">Ysk -{{ $courierDetails['fk_registration_id'] }} </span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">YSK Number</span>
							<span class="view-value-text">{{ $courierDetails['name_as_per_yuva_sangh_org'] }} </span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Company Name</span>
							<span class="view-value-text"> {{ $courierDetails['company_name'] }} </span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Mobile Number</span>
							<span class="view-value-text">{{ $courierDetails['phone_number'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Details</span>
							<span class="view-value-text"> {{ $courierDetails['courier_narration'] }} </span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Courier Slip</span>
							<span class="view-value-text">
								@foreach($courierImage as $courierImageS)
								@if($courierImageS['upload_document_extension'] == 'pdf')
								<a href="../assets/uploads/courier_slip/{{ $courierImageS['upload_courier_slip'] }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a>
								@else
								<a href="{{ URL::asset('assets/uploads/courier_slip/').'/'.$courierImageS['upload_courier_slip'] }}" target="_blank"><img src="{{ URL::asset('assets/uploads/courier_slip/').'/'.$courierImageS['upload_courier_slip'] }}"></a> 
									{{-- <div id="methods">
											<a href="{{ URL::asset('assets/uploads/ser_image/').'/'.$courierImageS->upload_courier_slip }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div> --}} 
									@endif
									@endforeach
									@if($courierImage == [])
									<img src="{{ URL::asset('assets/img/product10.jpg') }}">
								 {{-- <div id="methods">
									<a href="{{ URL::asset('assets/img/product10.jpg') }}">
										<div class="upload-img-title">
											<i class="la la-eye"></i>	
										</div>
									</a>
								</div> --}} 
								@endif

							</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Courier Date</span>
							<span class="view-value-text">{{ date('d-m-Y',strtotime($courierDetails['courier_date'])) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Courier Id</span>
							<span class="view-value-text"> {{ $courierDetails['courier_static_id'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Status</span>
							<span class="view-value-text"> {{ $courierDetails['courier_status'] }} </span>
						</div>
					</div>

				</div>
			</div>	

			<!--end::Portlet-->
		</div>
	</div>         
</div>
<!--ENd:: Chat-->
@endsection