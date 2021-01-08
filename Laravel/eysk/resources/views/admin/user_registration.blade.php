@extends('elements.user_admin')
@section('content')			

<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Registration                           
					</h3>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper"></div>
				</div>
			</div>
		</div>
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
	</div>
	
	<!-- end:: Subheader -->  
  
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="filter-section-bg">
			<form action="{{ route('update-user-registration',$registrationData['registration_id']) }}" method="POST">
				@csrf
				<div class="row">
					<div class="col-lg-3">
						<label>Phone Number 1</label>
						<input type="text" name="phone_number_first" value="{{ $registrationData['phone_number_first'] }}" class="form-control m-input" placeholder="Enter Contact Number">
					</div>
					<div class="col-lg-3">
						<label>Phone Number 2</label>
						<input type="text" name="phone_number_second" value="{{ $registrationData['phone_number_second'] }}" class="form-control m-input" placeholder="Enter Contact Number">
					</div>	

					<div class="col-sm-3">	
						<label>Email Id</label>
						<input type="text" name="email" value="{{ $registrationData['email'] }}" class="form-control m-input" placeholder="Enter Email">
						
					</div>

					<div class="col-sm-3 col-md-2" style="margin-top: 25px;">	
						<input type="submit" name="submit" value=" Submit " class="btn btn-info">
						
					</div>
				</div>
				<br>
			</form>
		</div>	
	</div>
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!-- registration date table -->
		<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet kt-portlet--mobile">
				<div class="kt-portlet__head kt-portlet__head--lg">

					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon2-line-chart"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							View
						</h3>&nbsp;
					</div>
					<div class="kt-portlet__head-toolbar"> 
						
					</div>
				</div>
				<div class="kt-portlet__body">
					<!--begin: Datatable -->
					<div class="kt-portlet kt-portlet--tab">
					<div class="kt-title__head">
						<div class="kt-portlet__header">
							<h3 class="title-ktt-view">
								Personal Info
							</h3>
						</div>
						 @if($registerPayment['check_bounce_amount'] != '0.00') 
							<div class="kt-portlet__header" style="float: right;margin-top: -20px;">
								<h3 class="title-ktt-view">
									Pending Amount:
									<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> {{ $pendingAmount }} </span>
								</h3>
							</div>
						 @endif 

						@if($registrationData['ysk_confirmation_date'] != '0000-00-00')
							<div class="kt-portlet__header" style="float: right;margin-top: -20px;">
								<h3 class="title-ktt-view">
									Risk Start Date:
									<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ date('d-m-Y',strtotime($registrationData['ysk_confirmation_date'])) }}</span>
								</h3>
							</div>
						 @endif

						 @if($umrnNumber['umrn_number'] != '') 
							<div class="kt-portlet__header" style="float: right;margin-top: -20px;">
								<h3 class="title-ktt-view">
									UMRN Number:
									<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> {{ $umrnNumber['umrn_number'] }} </span>
								</h3>
							</div>
						 @endif 
					</div>


					<div class="main-padding ceparetar">
						<div class="row"> 
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Family ID</span>
									<span class="view-value-text">{{ $registrationData['family_id'] }} </span>
								</div>
							</div>

							 @if($registrationData['ysk_id'] != '') 
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Ysk Id/Processing ID</span>
										<span class="view-value-text">{{ $registrationData['ysk_id'] }} &nbsp;/</span>&nbsp;<span class="list-and kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill" style="width:30%;height: 20px;color:#ffffff;">{{ $registrationData['processing_id']}}</span>
									</div>
								</div>
							 @elseif($registrationData['pre_ysk_id'] != '') 
									 <div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Ysk Id/Processing ID</span>
											<span class="view-value-text">{{ $registrationData['pre_ysk_id'] }}&nbsp;/</span>&nbsp;<span class="list-and kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill" style="width:30%;height: 20px;color:#ffffff;"> {{ $registrationData['processing_id']}} </span>
										</div>
									</div> 
							 @endif 

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Member ID</span>
									<span class="view-value-text">{{ $registrationData['member'] }}</span>
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Name As Per YuvaSangh.org</span>
									<span class="view-value-text">{{ $registrationData['hidden_name_as_per_yuva_sangh_org'] }}</span>
								</div>
							</div>	

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Name As Per YSK Registration Form</span>
									<span class="view-value-text">{{ $registrationData['name_as_per_yuva_sangh_org'] }}</span>
								</div>
							</div>	
							
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Date of Birth</span>
									<span class="view-value-text">{{ date('d-m-Y',strtotime($registrationData['date_of_birth'])) }}</span>
								</div>
							</div>
							
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Age</span>
									<span class="view-value-text">{{ $registrationData['age'] }}</span>
								</div>
							</div>
							
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Gender</span>
									<span class="view-value-text">{{ $registrationData['gender'] }}</span>
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Registration Amount</span>
									<span class="view-value-text">{{ $registrationData['registration_amount'] }}</span>
								</div>
							</div>
                        
							@if($registrationData['aadhar_card_number'] != '') 
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Aadhar Card Number</span>
										<span class="view-value-text">{{ $registrationData['aadhar_card_number'] }}</span>
									</div>
								</div>
							@endif 

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Other Document Number</span>
								 @if($registrationData['other_document_number'] != '') 
									<span class="view-value-text">{{ $registrationData['other_document_number'] }}</span>
								 @else 
									<span class="view-value-text">-</span> 
								 @endif 
								</div>
							</div>

							 <div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Member Photo</span>
									@foreach($profilePhoto as $profilePhotos)
									<a href="{{ URL::asset('assets/uploads/user_image/').'/'.$profilePhotos['upload_registration_document'] }}" target="_blank"><img src="{{ URL::asset('assets/uploads/user_image/').'/'.$profilePhotos['upload_registration_document'] }}"></a> 
									
									@endforeach
									@if($profilePhoto == [])
									<img src="{{ URL::asset('assets/img/product10.jpg') }}">
									@endif
								</div>
							</div> 

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Aadhar Photo</span>
									@foreach($aadharPhoto as $aadharPhotos)
									@if($aadharPhotos['upload_document_extension'] != 'pdf')
									<a href="{{ URL::asset('assets/uploads/aadhar_image/').'/'.$aadharPhotos['upload_registration_document'] }}" target="_blank"><img src="{{ URL::asset('assets/uploads/aadhar_image/').'/'.$aadharPhotos['upload_registration_document'] }}"></a>
									@else
									<a href="{{ URL::asset('assets/uploads/aadhar_image/').'/'.$aadharPhotos['upload_registration_document'] }}" target="_blank"><img src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}"></a>
									@endif
									@endforeach
									@if($aadharPhoto == [])
									<img src="{{ URL::asset('assets/img/product10.jpg') }}">
									@endif
								</div>
							</div> 
							
							{@if($registrationData['other_document_number'] != '') 
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Other Document Number</span>
									<span class="view-value-text">{{ $registrationData['other_document_number'] }} </span>
								</div>
							</div>
						 @endif
                 
							<div class="col-sm-12 col-md-12 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Home Address</span>
									<span class="view-value-text"> {{ $registrationData['home_address'] }}</span>
								</div>
							</div>
							
							<div class="col-sm-4 col-md-4 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">City</span>
									<span class="view-value-text">{{ $registrationData['fk_city_id'] }}</span>
								</div>
							</div>
							
							<div class="col-sm-4 col-md-4 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">District</span>
									<span class="view-value-text">{{ $registrationData['fk_district_id'] }}</span>
								</div>
							</div>
							
							<div class="col-sm-4 col-md-4 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">State</span>
									<span class="view-value-text">{{ $registrationData['fk_state_id'] }} </span>
								</div>
							</div>
							
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Region</span>
									<span class="view-value-text">{{ $registrationData['region_name'] }}({{ $registrationData['region_code'] }})</span>
								</div>
							</div>

							 @if($registrationData['name'] != '') 
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Council</span>
										<span class="view-value-text">{{ $registrationData['name'] }}({{ $registrationData['code'] }})</span>
									</div>
								</div>
							 @endif 

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Samaj Zone</span>
									<span class="view-value-text">{{ $registrationData['samaj_zone_name'] }} </span>
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Yuva Mandal</span>
									<span class="view-value-text"> {{ $registrationData['yuva_mandal_number'] }} </span>
								</div>
							</div>
                            <div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Mobile Number 1</span>
									<span class="view-value-text"> {{ $registrationData['phone_number_first'] }} </span>
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Mobile Number 2</span>
									@if($registrationData['phone_number_second'] != '') 
									<span class="view-value-text">{{ $registrationData['phone_number_second'] }}</span>
									@else 
									 <span class="view-value-text">-</span> 
									@endif 
								</div>
							</div>                          
								
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Email</span>
									@if($registrationData['email'] != '')
									<span class="view-value-text"> {{ $registrationData['email'] }} </span>
									@else	
									 <span class="view-value-text">-</span>	
									@endif	
								</div>
							</div>

							<div class="col-sm-4 col-md-4 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Password</span>
									<span class="view-value-text">{{ $registrationData['password'] }} </span>
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Existing Disease</span>
									 @if($diseaseName != '') 
									<span class="view-value-text">abc,bcd {{ implode(',', $diseaseName) }} </span>
									 @else 
									 <span class="view-value-text">-</span> 
									 @endif 
								</div>
							</div>


					 <div class="view-section">
						<div class="kt-title__head">
							<div class="kt-portlet__header">
								<h3 class="title-ktt-view">
									Payment Details 
								</h3>
							</div>
						</div>	 
						<div class="main-padding ceparetar">
							<div class="row"> 
							        @if(count($paymentDetails)> 0) 
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Date</span>
										
											<span class="view-value-text"> {{ date('d-m-Y',strtotime($paymentDetails[0]['payment_date'])) }} </span>
										</div>
									</div>
							
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Bank Name</span>
										 @if($paymentDetails[0]['fk_reg_bank_name'] != '0') 
											<span class="view-value-text"> {{ $paymentDetails[0]['legder_name'] }} </span>
										 @else 
											 <span class="view-value-text">-</span> 
										 @endif 
										</div>
									</div>


									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">YSK Member Bank Name</span>
											 @if($registerPayment['ysk_member_bank_name'] != '') 
												<span class="view-value-text">Bank of baroda {{ $registerPayment['ysk_member_bank_name'] }} </span>
											 @else 
												 <span class="view-value-text">-</span> 
											 @endif 
										</div>
									</div>
									
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Branch Name</span>
											 @if($registerPayment['branch_name'] != '') 
												<span class="view-value-text">Motera {{ $registerPayment['branch_name'] }} </span>
											  @else 
												 <span class="view-value-text" style="text-align: center;">-</span> 
											 @endif 
										</div>
									</div>
								
									
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Number</span>
											 @if($paymentDetails[0]['cheque_number'] != '') 
												<span class="view-value-text"> {{ $paymentDetails[0]['cheque_number'] }} </span>
											 @else 
												 <span class="view-value-text">-</span> 
											 @endif 
										</div>
									</div>
								

									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Amount</span>
											<span class="view-value-text"> {{ $paymentDetails[0]['amount'] }} </span>
										</div>
									</div>

								
					
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">YSK Bank Transaction ID</span>
										  @if($paymentDetails[0]['transaction_id'] != '') 
											<span class="view-value-text"> {{ $paymentDetails[0]['transaction_id'] }} </span>
										 @else  
											 <span class="view-value-text">-</span> 
									  @endif  
									</div>
								</div> 
								
								 
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Narration</span>
										 @if($paymentDetails[0]['details'] != '') 
											<span class="view-value-text"> {{ $paymentDetails[0]['details'] }} </span>
										 @else 
											 <span class="view-value-text">-</span> 
										 @endif 
									</div>
								</div>
							

								 <div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Mode Of Payment</span>
										<span class="view-value-text"> {{ $paymentDetails[0]['payment_mode'] }}</span>
									</div>
								</div>
								 @else 
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Date</span>
										
											<span class="view-value-text">{{ date('d-m-Y',strtotime($registerPayment['created_at'])) }} </span>
										</div>
									</div>
							
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Bank Name</span>
										 @if($registerPayment['fk_reg_bank_name'] != '0') 
											<span class="view-value-text"> {{ $registerPayment['legder_name'] }} </span>
										 @else 
											 <span class="view-value-text">-</span> 
										 @endif 
										</div>
									</div>


									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">YSK Member Bank Name</span>
											 @if($registerPayment['ysk_member_bank_name'] != '') 
												<span class="view-value-text">{{ $registerPayment['ysk_member_bank_name'] }} </span>
											 @else 
												 <span class="view-value-text">-</span> 
											 @endif 
										</div>
									</div>
									
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Branch Name</span>
											 @if($registerPayment['branch_name'] != '')
												<span class="view-value-text"> {{ $registerPayment['branch_name'] }} </span>
											 @else 
												 <span class="view-value-text" style="text-align: center;">-</span> 
											 @endif 
										</div>
									</div>
								
									
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Number</span>
											 @if($registerPayment['cheque_number'] != '0') 
												<span class="view-value-text"> {{ $registerPayment['cheque_number'] }} </span>
											 @else 
												 <span class="view-value-text">-</span> 
											 @endif 
										</div>
									</div>
								

									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Amount</span>
											<span class="view-value-text"> {{ $registerPayment['bank_amount'] }} </span>
										</div>
									</div>

								

								 @if($registerPayment['check_bounce_amount'] != '0.00') 
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Bounce Amount</span>
											<span class="view-value-text"> {{ $registerPayment['check_bounce_amount'] }} </span>
										</div>
									</div>
							    @elseif($registerPayment['check_clear_date'] != '0000-00-00') 
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Clear Date</span>
											<span class="view-value-text"> {{ date('d-m-Y',strtotime($registerPayment['check_clear_date'])) }}</span>
										</div>
									</div>
								 @endif 
					
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">YSK Bank Transaction ID</span>
										 @if($registerPayment['transaction_id'] != '') 
											<span class="view-value-text">{{ $registerPayment['transaction_id'] }}</span>
										 @else  
											 <span class="view-value-text">-</span> 
										 @endif 
									</div>
								</div> 
								
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Narration</span>
										@if($registerPayment['narration'] != '') 
											<span class="view-value-text">{{ $registerPayment['narration'] }} </span>
										@else 
											<span class="view-value-text">-</span>
										@endif 
									</div>
								</div>
							
								@endif 

							</div>
						</div>
					 </div>  

				<!--end::Portlet-->
				@if($registrationData->first_nominee_name != '' || $registrationData->second_nominee_name != '') 
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
								@if($registrationData['first_nominee_family_id'] != '0') 
									<div class="col-sm-4 col-md-4 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">First Nominee Family Id</span>
											<span class="view-value-text">{{ $registrationData['first_nominee_family_id'] }}</span>
										</div>
									</div>
								@endif

								<div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">First Nominee Name</span>
										<span class="view-value-text">{{ $registrationData['first_nominee_name'] }}</span>
									</div>
								</div>

								<div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">First Nominee Relation</span>
										<span class="view-value-text">{{ $registrationData['first_nominee_relation'] }}</span>
									</div>
								</div>
								@if($registrationData['second_nominee_family_id'] != '0') 
									<div class="col-sm-4 col-md-4 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Second Nominee Family Id</span>
											<span class="view-value-text">{{ $registrationData['second_nominee_family_id'] }}</span>
										</div>
									</div>
								 @endif 

								<div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Second Nominee Name</span>
										<span class="view-value-text"> {{ $registrationData['second_nominee_name'] }}</span>
									</div>
								</div>

								<div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Second Nominee Relation</span>
										<span class="view-value-text">{{ $registrationData['second_nominee_relation'] }} </span>
									</div>
								</div>
							</div>
						</div>
					</div>
				 @endif

					<div class="view-section">
						<div class="kt-title__head">
							<div class="kt-portlet__header">
								<h3 class="title-ktt-view">
									Family Ysk MemberId
								</h3>
							</div>
						</div>	
						<div class="main-padding ceparetar">
							<div class="row"> 
								 @foreach($getOtherMemberDetails as $getOtherMemberDetailss) 	
								 <div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">YSK Id</span>
										 @if($getOtherMemberDetailss['pre_ysk_id'] == '' && $getOtherMemberDetailss['ysk_id'] == '') 
											 <span class="view-value-text">-</span> 
										 @elseif($getOtherMemberDetailss['ysk_id'] == '') 
											<span class="view-value-text">{{ $getOtherMemberDetailss['pre_ysk_id'] }} </span>
										 @elseif($getOtherMemberDetailss['ysk_id'] != '') 
											 <span class="view-value-text">{{ $getOtherMemberDetailss['ysk_id'] }}</span> 
										
										 @endif 
									</div>
								</div>
									<div class="col-sm-4 col-md-4 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Name As Per YskSabgh.org</span>
											<span class="view-value-text">{{ $getOtherMemberDetailss['name_as_per_yuva_sangh_org'] }} </span>
										</div>
									</div>	

								 <div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Member Id</span>
										<span class="view-value-text"> {{ $getOtherMemberDetailss['member'] }} </span>
									</div>
								</div> 

								<!--<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Family Id</span>
										<span class="view-value-text"> {{ $getOtherMemberDetailss['family_id'] }}</span>
									</div>
								</div>-->

								
								 @endforeach 
							</div>
						</div>
					</div>
					
					@if($umrnNumber != '') 
					<div class="view-section">
						<div class="kt-title__head">
							<div class="kt-portlet__header">
								<h3 class="title-ktt-view">
									ACH Reject Reason
								</h3>
							</div>
						</div>	
						<div class="main-padding ceparetar">
							<div class="row"> 
								 	
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt"></span>
											<span class="view-value-text"> {{ $umrnNumber['umrn_number_reject'] }}  </span>
										</div>
									</div>	

							</div>
						</div>
					</div>
					@endif


				</div>
			</div>
			<!-- content end -->          
		</div>
				</div>
			</div>	
			<!-- registration date table -->
		</div>
	</div>
</div>
	<!-- content end -->
@endsection
@section('content_js')
<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>
@endsection