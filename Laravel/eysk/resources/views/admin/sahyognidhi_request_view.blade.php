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
								View Sahyognidhi Request
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
								<a href="{{ route('sahyognidhi-request') }}" class="btn btn-clean btn-icon-sm back-tt">
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


		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						General Information
					</h3>
				</div>
			</div>

			
			<div class="main-padding ceparetar">
				<div class="row"> 

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Sahyognidhi Date</span>
							<span class="view-value-text">{{ date('d-m-Y',strtotime($viewSahyognidhiRequest['sahyognidhi_date'])) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">YSK ID</span>
							<span class="view-value-text">{{ $viewSahyognidhiRequest['fk_ysk_id'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Family ID</span>
							<span class="view-value-text">{{ $viewSahyognidhiRequest['family_id'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Name</span>
							<span class="view-value-text">{{ $viewSahyognidhiRequest['name_as_per_yuvasangh_org'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Region Name</span>
							<span class="view-value-text">{{ strtoupper($viewSahyognidhiRequest['region_name']) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Council Name</span>
							<span class="view-value-text">@if($viewSahyognidhiRequest['council_name'] != '') {{ strtoupper($viewSahyognidhiRequest['council_name']) }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Samaj Name</span>
							<span class="view-value-text">{{ strtoupper($viewSahyognidhiRequest['samaj_zone_name']) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Yuva Mandal Name</span>
							<span class="view-value-text">{{ strtoupper($viewSahyognidhiRequest['yuva_mandal_name']) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">City</span>
							<span class="view-value-text">{{ strtoupper($viewSahyognidhiRequest['city_name']) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Email</span>
							<span class="view-value-text">@if($viewSahyognidhiRequest['email'] != ''){{ $viewSahyognidhiRequest['email'] }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Aadhar Number</span>
							<span class="view-value-text">{{ $viewSahyognidhiRequest['aadhar_card_number'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Date Of Birth</span>
							<span class="view-value-text">{{ date('d-m-Y',strtotime($viewSahyognidhiRequest['date_of_birth'])) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Gender</span>
							<span class="view-value-text">{{ $viewSahyognidhiRequest['gender'] }}</span>
						</div>
					</div>

					{{-- <div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">pincode</span>
							<span class="view-value-text">@if($viewSahyognidhiRequest['pincode'] != ''){{ $viewSahyognidhiRequest['pincode'] }}@else - @endif</span>
						</div>
					</div> --}}

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">First Phone Number</span>
							<span class="view-value-text">{{ $viewSahyognidhiRequest['first_phone_number'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Second Phone Number</span>
							<span class="view-value-text">@if($viewSahyognidhiRequest['second_phone_number'] != ''){{ $viewSahyognidhiRequest['second_phone_number'] }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Existing Disease</span>
							<span class="view-value-text">@if($diseaseName != ''){{ $diseaseName }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Other Document Number</span>
							<span class="view-value-text">@if($viewSahyognidhiRequest['other_document_number'] != ''){{ $viewSahyognidhiRequest['other_document_number'] }} @else - @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Age</span>
							<span class="view-value-text">{{ $viewSahyognidhiRequest['age'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Cause Of Death</span>
							<span class="view-value-text">@if($viewSahyognidhiRequest['sahyognidhi_request'] != 'Devantage') {{ $viewSahyognidhiRequest['cause_of_death'] }} @else {{ $viewSahyognidhiRequest['title'] }} @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Inform Date</span>
							<span class="view-value-text">{{ date('d-m-Y',strtotime($viewSahyognidhiRequest['inform_date'])) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Informer Name</span>
							<span class="view-value-text">{{ $viewSahyognidhiRequest['informer_name'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Informer Mobile</span>
							<span class="view-value-text">{{ $viewSahyognidhiRequest['informer_mobile'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Designation</span>
							<span class="view-value-text">@if($viewSahyognidhiRequest['designation'] != '') {{ $viewSahyognidhiRequest['designation'] }} @else - @endif</span>
						</div>
					</div>
					
					@if($viewSahyognidhiRequest['sahyognidhiError'] != '')
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Not Eligible For</span>
								<span class="view-value-text">{{ $viewSahyognidhiRequest['sahyognidhiError'] }}</span>
							</div>
						</div>
					@endif
					
					@if($viewSahyognidhiRequest['death_description'] != '')
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Death Description</span>
								<span class="view-value-text">{{ $viewSahyognidhiRequest['death_description'] }}</span>
							</div>
						</div>
					@endif

					@if($viewSahyognidhiRequest['death_date'] != '0000-00-00')
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Death Date</span>
								<span class="view-value-text">{{ date('d-m-Y',strtotime($viewSahyognidhiRequest['death_date'])) }}</span>
							</div>
						</div>
					@endif

					@if($getMedicalDocument != [])
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Medical Document</span>
								@foreach($getMedicalDocument as $getMedicalDocuments)
									@if($getMedicalDocuments['document_extension'] != 'pdf')
									<a href="{{ URL::asset('assets/uploads/divangat_image/').'/'.$getMedicalDocuments['upload_document'] }}" target="_blank"><img src="{{ URL::asset('assets/uploads/divangat_image/').'/'.$getMedicalDocuments['upload_document'] }}"></a>
									@else
									<a href="{{ URL::asset('assets/uploads/divangat_image/').'/'.$getMedicalDocuments['upload_document'] }}" target="_blank"><img src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}"></a>
									@endif
								@endforeach
							</div>
						</div>
					@endif

					@if($getDeathCertificate != [])
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Medical Document</span>
								@foreach($getDeathCertificate as $getDeathCertificates)
									@if($getDeathCertificates['document_extension'] != 'pdf')
									<a href="{{ URL::asset('assets/uploads/divangat_image/').'/'.$getDeathCertificates['upload_document'] }}" target="_blank"><img src="{{ URL::asset('assets/uploads/divangat_image/').'/'.$getDeathCertificates['upload_document'] }}"></a>
									@else
									<a href="{{ URL::asset('assets/uploads/divangat_image/').'/'.$getDeathCertificates['upload_document'] }}" target="_blank"><img src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}"></a>
									@endif
								@endforeach
							</div>
						</div>
					@endif

					@if($getDisiabilityDocument != [])
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Disiability Document</span>
								@foreach($getDisiabilityDocument as $getDisiabilityDocument)
									@if($getDisiabilityDocument['document_extension'] != 'pdf')
									<a href="{{ URL::asset('assets/uploads/divangat_image/').'/'.$getDisiabilityDocument['upload_document'] }}" target="_blank"><img src="{{ URL::asset('assets/uploads/divangat_image/').'/'.$getDisiabilityDocument['upload_document'] }}"></a>
									@else
									<a href="{{ URL::asset('assets/uploads/divangat_image/').'/'.$getDisiabilityDocument['upload_document'] }}" target="_blank"><img src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}"></a>
									@endif
								@endforeach
							</div>
						</div>
					@endif
					
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Description</span>
							<span class="view-value-text">@if($viewSahyognidhiRequest['description'] != ''){{ $viewSahyognidhiRequest['description'] }} @else - @endif</span>
						</div>
					</div>

				</div>
			</div>



			<div class="view-section">
				<div class="kt-title__head">
					<div class="kt-portlet__header">
						<h3 class="title-ktt-view">
							Nominee Details
						</h3>
					</div>
				</div>	
				<div class="main-padding ceparetar">
					<div class="row"> 
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">First Nominee Name</span>
								<span class="view-value-text">{{ $sahyognidhiNominee['first_nominee_name'] }}</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">First Nominee Relation</span>
								<span class="view-value-text">{{ $sahyognidhiNominee['first_nominee_relation'] }}</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">First Nominee Email ID</span>
								<span class="view-value-text">{{ $sahyognidhiNominee['first_nominee_email'] }}</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">First Nominee Contact Number</span>
								<span class="view-value-text">{{ $sahyognidhiNominee['first_nominee_contact_number'] }}</span>
							</div>
						</div>	

					</div>




					<div class="row"> 
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Second Nominee Name</span>
								<span class="view-value-text">{{ $sahyognidhiNominee['second_nominee_name'] }}</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Second Nominee Relation</span>
								<span class="view-value-text">{{ $sahyognidhiNominee['second_nominee_relation'] }}</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Second Nominee Email ID</span>
								<span class="view-value-text">{{ $sahyognidhiNominee['second_nominee_email'] }}</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Second Nominee Contact Number</span>
								<span class="view-value-text">{{ $sahyognidhiNominee['second_nominee_contact_number'] }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="view-section">
				<div class="kt-title__head">
					<div class="kt-portlet__header">
						<h3 class="title-ktt-view">
							As Per Nominee Details
						</h3>
					</div>
				</div>	
				<div class="main-padding ceparetar">
					<div class="row"> 
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">First Nominee Name</span>
								<span class="view-value-text">@if($sahyognidhiNominee['ask_first_nominee_name'] != ''){{ $sahyognidhiNominee['ask_first_nominee_name'] }} @else - @endif</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">First Nominee Relation</span>
								<span class="view-value-text">@if($sahyognidhiNominee['ask_first_nominee_relation'] != ''){{ $sahyognidhiNominee['ask_first_nominee_relation'] }} @else - @endif</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">First Nominee Email ID</span>
								<span class="view-value-text">@if($sahyognidhiNominee['ask_first_nominee_email'] != ''){{ $sahyognidhiNominee['ask_first_nominee_email'] }} @else - @endif</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">First Nominee Contact Number</span>
								<span class="view-value-text">@if($sahyognidhiNominee['ask_first_nominee_contact_number'] != ''){{ $sahyognidhiNominee['ask_first_nominee_contact_number'] }} @else - @endif</span>
							</div>
						</div>
					</div>

					<div class="row"> 
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Second Nominee Name</span>
								<span class="view-value-text">@if($sahyognidhiNominee['ask_second_nominee_name'] != ''){{ $sahyognidhiNominee['ask_second_nominee_name'] }} @else - @endif</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Second Nominee Relation</span>
								<span class="view-value-text">@if($sahyognidhiNominee['ask_second_nominee_relation'] != ''){{ $sahyognidhiNominee['ask_second_nominee_relation'] }} @else - @endif</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Second Nominee Email ID</span>
								<span class="view-value-text">@if($sahyognidhiNominee['ask_second_nominee_email'] != ''){{ $sahyognidhiNominee['ask_second_nominee_email'] }} @else - @endif</span>
							</div>
						</div>

						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Second Nominee Contact Number</span>
								<span class="view-value-text"> @if($sahyognidhiNominee['ask_second_nominee_contact_number'] != ''){{ $sahyognidhiNominee['ask_second_nominee_contact_number'] }} @else - @endif</span>
							</div>
						</div>
					</div>
				</div>
			</div>


			{{-- <div class="view-section">
				<div class="kt-title__head">
					<div class="kt-portlet__header">
						<h3 class="title-ktt-view">
							Claim Details
						</h3>
					</div>
					<div class="kt-portlet__header">
						<h3 class="title-ktt-view" style="float: right;">
							<span class="view-value-text">Claim Total Amonut <i class="la la-rupee"></i> {{ $totalAmount }}</span>
						</h3>
					</div>
					<div class="kt-portlet__header">
						<h3 class="title-ktt-view" style="float: right;">
							<span class="view-value-text">Total Given Amonut <i class="la la-rupee"></i> {{ $givenAmount }}</span>
						</h3>
					</div>
				</div>	
				<div class="main-padding ceparetar">
					<div class="row"> 
						@foreach($nomineeDetails as $nomineeDetailss)
						<div class="col-sm-4 col-md-4 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Nominee Name</span>
								<span class="view-value-text">{{ $nomineeDetailss['nominee_name'] }}</span>
							</div>
						</div>

						<div class="col-sm-4 col-md-4 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Nominee Relation</span>
								<span class="view-value-text">{{ $nomineeDetailss['nominee_relation'] }}</span>
							</div>
						</div>

						<div class="col-sm-4 col-md-4 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Given Amount</span>
								<span class="view-value-text"><i class="la la-rupee"></i>{{ $nomineeDetailss['total_amount'] }}</span>
							</div>
						</div>
						@endforeach --}}
						{{-- <div class="col-sm-12 col-md-12 view-group">
							<div class="view-details-mtt">
								<div class="claim-total-amount-t">
									<span class="view-value-text">Claim Total Amonut <i class="la la-rupee"></i> {{ $totalAmount }}</span>
								</div>
							</div>
						</div> --}}

					{{-- </div>
				</div>
			</div> --}}

			{{-- <div class="view-section">
				<div class="kt-title__head">
					<div class="kt-portlet__header">
						<h3 class="title-ktt-view">
							Not Applicable for claim
						</h3>
					</div>
				</div>	
				<div class="main-padding ceparetar">
					<div class="row"> 
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Reason</span>
								<span class="view-value-text">{{ $viewSahyognidhiRequest['reason'] }}</span>
							</div>
						</div>

					</div>
				</div>
			</div> --}}
			<!--end::Portlet-->
		</div>
	</div>
	<!-- content end -->          
</div>
<!--ENd:: Chat-->
@endsection