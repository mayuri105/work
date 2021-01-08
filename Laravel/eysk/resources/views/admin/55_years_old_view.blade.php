@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')

		<!-- content -->
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
										View Registration                           
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
									@if($detailsRegistration['age'] < '18')
										<a href="{{ route('minor-account') }}">
											<i class="la la-long-arrow-left"></i>
											Back
										</a>
										@else 
											<a href="{{ route('registration') }}">
												<i class="la la-long-arrow-left"></i>
												Back
											</a>
									@endif
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
								Personal Info
							</h3>
						</div>
						@if($registerPayment['check_bounce_amount'] != '0.00')
							<div class="kt-portlet__header" style="float: right;margin-top: -20px;">
								<h3 class="title-ktt-view">
									Pending Amount:
									<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ $pendingAmount }}</span>
								</h3>
							</div>
						@endif

						@if($detailsRegistration['ysk_confirmation_date'] != '0000-00-00')
							<div class="kt-portlet__header" style="float: right;margin-top: -20px;">
								<h3 class="title-ktt-view">
									Risk Start Date:
									<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ date('d-m-Y',strtotime($detailsRegistration['ysk_confirmation_date'])) }}</span>
								</h3>
							</div>
						@endif

						@if($umrnNumber['umrn_number'] != '')
							<div class="kt-portlet__header" style="float: right;margin-top: -20px;">
								<h3 class="title-ktt-view">
									UMRN Number:
									<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ $umrnNumber['umrn_number'] }}</span>
								</h3>
							</div>
						@endif
					</div>


					<div class="main-padding ceparetar">
						<div class="row"> 
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Family ID</span>
									<span class="view-value-text">{{ $detailsRegistration['family_id'] }}</span>
								</div>
							</div>

							@if($detailsRegistration['ysk_id'] != '')
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Ysk Id/Processing ID</span>
										<span class="view-value-text">{{ $detailsRegistration['ysk_id'] }}&nbsp;/</span>&nbsp;<span class="list-and kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill" style="width:30%;height: 20px;color:#ffffff;">{{ $detailsRegistration['processing_id']}}</span>
									</div>
								</div>
							@elseif($detailsRegistration['pre_ysk_id'] != '')
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Ysk Id/Processing ID</span>
										<span class="view-value-text">{{ $detailsRegistration['pre_ysk_id'] }}&nbsp;/</span>&nbsp;<span class="list-and kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill" style="width:30%;height: 20px;color:#ffffff;">{{ $detailsRegistration['processing_id']}}</span>
									</div>
								</div>
							@endif

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Member ID</span>
									<span class="view-value-text">{{ $detailsRegistration['member'] }}</span>
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Name As Per YuvaSangh.org</span>
									<span class="view-value-text">{{ $detailsRegistration['hidden_name_as_per_yuva_sangh_org'] }}</span>
								</div>
							</div>	

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Name As Per YSK Registration Form</span>
									<span class="view-value-text">{{ $detailsRegistration['name_as_per_yuva_sangh_org'] }}</span>
								</div>
							</div>	
							
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Date of Birth</span>
									<span class="view-value-text">{{ date('d-m-Y',strtotime($detailsRegistration['date_of_birth'])) }}</span>
								</div>
							</div>
							
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Age</span>
									<span class="view-value-text">{{ $findAge }}</span>
								</div>
							</div>
							
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Gender</span>
									<span class="view-value-text">{{ $detailsRegistration['gender'] }}</span>
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Registration Amount</span>
									<span class="view-value-text">{{ $detailsRegistration['registration_amount'] }}</span>
								</div>
							</div>
                        
							@if($detailsRegistration['aadhar_card_number'] != '')
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Aadhar Card Number</span>
										<span class="view-value-text">{{ $detailsRegistration['aadhar_card_number'] }}</span>
									</div>
								</div>
							@endif

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Other Document Number</span>
									@if($detailsRegistration['other_document_number'] != '')
									<span class="view-value-text">{{ $detailsRegistration['other_document_number'] }}</span>
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
									{{-- <div id="methods">
										<a href="{{ URL::asset('assets/uploads/user_image/').'/'.$profilePhotos->upload_registration_document }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div> --}} 
									@endforeach
									@if($profilePhoto == [])
									<img src="{{ URL::asset('assets/img/product10.jpg') }}">
									 {{-- <div id="methods">
										<a href="{{ URL::asset('assets/img/product10.jpg') }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div> --}} 
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
									{{-- <div id="methods">
										<a href="{{ URL::asset('assets/uploads/aadhar_image/').'/'.$aadharPhotos->upload_registration_document }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div> --}} 
									@endforeach
									@if($aadharPhoto == [])
									<img src="{{ URL::asset('assets/img/product10.jpg') }}">
									 {{-- <div id="methods">
										<a href="{{ URL::asset('assets/img/product10.jpg') }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div> --}} 
									@endif
								</div>
							</div>

							{{-- <div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Member Photo</span>
									@foreach($profilePhoto as $profilePhotos)
									@if($profilePhotos->upload_registration_document != "")
									<img src="{{ URL::asset('assets/uploads/user_image/').'/'.$profilePhotos->upload_registration_document }}">
									 <div id="methods">
										<a href="{{ URL::asset('assets/uploads/user_image/').'/'.$profilePhotos->upload_registration_document }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div> 
									@else
									<img src="{{ URL::asset('assets/img/product10.jpg') }}">
									<div id="methods">
										<a href="{{ URL::asset('assets/img/product10.jpg') }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div>
									@endif
									@endforeach
								</div>
							</div> --}}

                        {{-- @if(count($profilePhoto) >0)
							@if($profilePhoto->upload_registration_documnet_status  == '3')
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Aadhar Card Image Upload</span>
										@if($profilePhoto->upload_registration_documnet_status != "")
											@if(pathinfo($profilePhoto->upload_registration_documnet_status, PATHINFO_EXTENSION) == 'pdf')
											<a href="{{ URL::asset('assets/uploads/aadhar_image/').'/'.$profilePhoto[0]['upload_registration_documnet_status'] }}"><img src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a> 
											@else
											<img src="{{ URL::asset('assets/uploads/aadhar_image/').'/'.$profilePhoto->upload_registration_documnet_status }}">
											@endif
											<div id="methods1">
												@if(pathinfo($profilePhoto->upload_registration_documnet_status, PATHINFO_EXTENSION) != 'pdf')
													<a href="{{ URL::asset('assets/uploads/aadhar_image/').'/'.$profilePhoto->upload_registration_documnet_status }}">
														<div class="upload-img-title1">
															<i class="la la-eye"></i>	
														</div>
													</a>
												@endif
											</div>
										@else
											<img src="{{ URL::asset('assets/img/product10.jpg') }}">
											<div id="methods1">
												<a href="{{ URL::asset('assets/img/product10.jpg') }}">
													<div class="upload-img-title1">
														<i class="la la-eye"></i>	
													</div>
												</a>
											</div>
										@endif
										
									</div>
								</div>
							@endif


							@if($profilePhoto->upload_registration_documnet_status != '2')
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Ysk Registration Image</span>
										@if($profilePhoto->upload_registration_documnet_status != "")
											@if(pathinfo($profilePhoto->upload_registration_documnet_status, PATHINFO_EXTENSION) == 'pdf')
												<a href="{{ URL::asset('assets/uploads/ysk_registration_image/').'/'.$profilePhoto[0]['upload_registration_documnet_status'] }}">{{ $profilePhoto[0]['upload_registration_documnet_status'] }}</a> 
											@else
												<img src="{{ URL::asset('assets/uploads/ysk_registration_image/').'/'.$profilePhoto->upload_registration_documnet_status }}">
											@endif
											<div id="methods3">
												@if(pathinfo($profilePhoto->upload_registration_documnet_status, PATHINFO_EXTENSION) != 'pdf')
													<a href="{{ URL::asset('assets/uploads/ysk_registration_image/').'/'.$profilePhoto->upload_registration_documnet_status }}">
														<div class="upload-img-title1">
															<i class="la la-eye"></i>	
														</div>
													</a>
												@endif
											</div>
										@else
											<img src="{{ URL::asset('assets/img/product10.jpg') }}">
											<div id="methods3">
												<a href="{{ URL::asset('assets/img/product10.jpg') }}">
													<div class="upload-img-title1">
														<i class="la la-eye"></i>	
													</div>
												</a>
											</div>
										@endif
										
									</div>
								</div>
							@endif
					@endif		 --}}
							@if($detailsRegistration['other_document_number'] != '')
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Other Document Number</span>
									<span class="view-value-text">{{ $detailsRegistration['other_document_number'] }}</span>
								</div>
							</div>
							@endif
                   {{--  @if(count($profilePhoto)>0)
						@if($profilePhoto->upload_registration_documnet_status == "4")
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Other Document Photo</span>
									@if($profilePhoto->upload_registration_documnet_status != "")
										@if(pathinfo($profilePhoto->upload_registration_documnet_status, PATHINFO_EXTENSION) == 'pdf')
											<a href="{{ URL::asset('assets/uploads/proof_image/').'/'.$profilePhoto[0]['upload_registration_documnet_status'] }}">{{ $profilePhoto['upload_registration_documnet_status'] }}</a> 
										@else
											<img src="{{ URL::asset('assets/uploads/proof_image/').'/'.$profilePhoto->upload_registration_documnet_status }}">
										@endif
									<div id="methods2">
										@if(pathinfo($profilePhoto->upload_registration_documnet_status, PATHINFO_EXTENSION) != 'pdf')
											<a href="{{ URL::asset('assets/uploads/proof_image/').'/'.$profilePhoto->upload_registration_documnet_status }}">
												<div class="upload-img-title1">
													<i class="la la-eye"></i>	
												</div>
											</a>
										@endif
									</div>
									@else
										<img src="{{ URL::asset('assets/img/product10.jpg') }}">
										<div id="methods2">
											<a href="{{ URL::asset('assets/img/product10.jpg') }}">
												<div class="upload-img-title1">
													<i class="la la-eye"></i>	
												</div>
											</a>
										</div>
									@endif
								</div>
							</div>
							@endif
					@endif		 --}}
							<div class="col-sm-12 col-md-12 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Home Address</span>
									<span class="view-value-text">{{ $detailsRegistration['home_address'] }}</span>
								</div>
							</div>
							
							<div class="col-sm-4 col-md-4 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">City</span>
									<span class="view-value-text">{{ $detailsRegistration['fk_city_id'] }}</span>
								</div>
							</div>
							
							<div class="col-sm-4 col-md-4 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">District</span>
									<span class="view-value-text">{{ $detailsRegistration['fk_district_id'] }}</span>
								</div>
							</div>
							
							<div class="col-sm-4 col-md-4 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">State</span>
									<span class="view-value-text">{{ $detailsRegistration['fk_state_id'] }}</span>
								</div>
							</div>
							
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Region</span>
									<span class="view-value-text">{{ $detailsRegistration['region_name'] }}({{ $detailsRegistration['region_code'] }})</span>
								</div>
							</div>

							@if($detailsRegistration['name'] != '')
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Council</span>
										<span class="view-value-text">{{ $detailsRegistration['name'] }}({{ $detailsRegistration['code'] }})</span>
									</div>
								</div>
							@endif

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Samaj Zone</span>
									<span class="view-value-text">{{ $detailsRegistration['samaj_zone_name'] }}</span>
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Yuva Mandal</span>
									<span class="view-value-text">{{ $detailsRegistration['yuva_mandal_number'] }}</span>
								</div>
							</div>
                            <div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Mobile Number 1</span>
									<span class="view-value-text">{{ $detailsRegistration['phone_number_first'] }}</span>
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Mobile Number 2</span>
									@if($detailsRegistration['phone_number_second'] != '')
									<span class="view-value-text">{{ $detailsRegistration['phone_number_second'] }}</span>
									@else
									<span class="view-value-text">-</span>
									@endif
								</div>
							</div>                          
								
							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Email</span>
									@if($detailsRegistration['email'] != '')
									<span class="view-value-text">{{ $detailsRegistration['email'] }}</span>
									@else
									<span class="view-value-text">-</span>
									@endif
								</div>
							</div>

							<div class="col-sm-3 col-md-3 view-group">
								<div class="view-details-mtt">
									<span class="view-title-kt">Existing Disease</span>
									@if($diseaseName != '')
									<span class="view-value-text">{{ implode(',', $diseaseName) }}</span>
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
										
											<span class="view-value-text">{{ date('d-m-Y',strtotime($paymentDetails[0]['payment_date'])) }}</span>
										</div>
									</div>
							
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Bank Name</span>
										@if($paymentDetails[0]['fk_reg_bank_name'] != '0')
											<span class="view-value-text">{{ $paymentDetails[0]['legder_name'] }}</span>
										@else
											<span class="view-value-text">-</span>
										@endif
										</div>
									</div>


									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">YSK Member Bank Name</span>
											@if($registerPayment['ysk_member_bank_name'] != '')
												<span class="view-value-text">{{ $registerPayment['ysk_member_bank_name'] }}</span>
											@else
												<span class="view-value-text">-</span>
											@endif
										</div>
									</div>
									
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Branch Name</span>
											@if($registerPayment['branch_name'] != '')
												<span class="view-value-text">{{ $registerPayment['branch_name'] }}</span>
											@else
												<span class="view-value-text" style="text-align: center;">-</span>
											@endif
										</div>
									</div>
								
									
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Number</span>
											@if($paymentDetails[0]['cheque_number'] != '')
												<span class="view-value-text">{{ $paymentDetails[0]['cheque_number'] }}</span>
											@else
												<span class="view-value-text">-</span>
											@endif
										</div>
									</div>
								

									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Amount</span>
											<span class="view-value-text">{{ $paymentDetails[0]['amount'] }}</span>
										</div>
									</div>

								

								<!-- @if($registerPayment['check_bounce_amount'] != '0.00')
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Bounce Amount</span>
											<span class="view-value-text">{{ $registerPayment['check_bounce_amount'] }}</span>
										</div>
									</div>
								@elseif($registerPayment['check_clear_date'] != '0000-00-00')
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Clear Date</span>
											<span class="view-value-text">{{ date('d-m-Y',strtotime($registerPayment['check_clear_date'])) }}</span>
										</div>
									</div>
								@endif -->
					
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">YSK Bank Transaction ID</span>
										 @if($paymentDetails[0]['transaction_id'] != '')
											<span class="view-value-text">{{ $paymentDetails[0]['transaction_id'] }}</span>
										@else 
											<span class="view-value-text">-</span>
									 @endif 
									</div>
								</div> 
								
								 {{-- <div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Amount</span>
										@if($registerPayment['bank_amount'] != '')
											<span class="view-value-text">{{ $registerPayment['bank_amount'] }}</span>
										@else
											<span class="view-value-text">-</span>
										@endif
									</div>
								</div> --}}
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Narration</span>
										@if($paymentDetails[0]['details'] != '')
											<span class="view-value-text">{{ $paymentDetails[0]['details'] }}</span>
										@else
											<span class="view-value-text">-</span>
										@endif
									</div>
								</div>
							

								 <div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Mode Of Payment</span>
										<span class="view-value-text">{{ $paymentDetails[0]['payment_mode'] }}</span>
									</div>
								</div>
								@else
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Date</span>
										
											<span class="view-value-text">{{ date('d-m-Y',strtotime($registerPayment['created_at'])) }}</span>
										</div>
									</div>
							
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Bank Name</span>
										@if($registerPayment['fk_reg_bank_name'] != '0')
											<span class="view-value-text">{{ $registerPayment['legder_name'] }}</span>
										@else
											<span class="view-value-text">-</span>
										@endif
										</div>
									</div>


									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">YSK Member Bank Name</span>
											@if($registerPayment['ysk_member_bank_name'] != '')
												<span class="view-value-text">{{ $registerPayment['ysk_member_bank_name'] }}</span>
											@else
												<span class="view-value-text">-</span>
											@endif
										</div>
									</div>
									
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Branch Name</span>
											@if($registerPayment['branch_name'] != '')
												<span class="view-value-text">{{ $registerPayment['branch_name'] }}</span>
											@else
												<span class="view-value-text" style="text-align: center;">-</span>
											@endif
										</div>
									</div>
								
									
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Number</span>
											@if($registerPayment['cheque_number'] != '0')
												<span class="view-value-text">{{ $registerPayment['cheque_number'] }}</span>
											@else
												<span class="view-value-text">-</span>
											@endif
										</div>
									</div>
								

									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Amount</span>
											<span class="view-value-text">{{ $registerPayment['bank_amount'] }}</span>
										</div>
									</div>

								

								@if($registerPayment['check_bounce_amount'] != '0.00')
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Bounce Amount</span>
											<span class="view-value-text">{{ $registerPayment['check_bounce_amount'] }}</span>
										</div>
									</div>
								@elseif($registerPayment['check_clear_date'] != '0000-00-00')
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Check Clear Date</span>
											<span class="view-value-text">{{ date('d-m-Y',strtotime($registerPayment['check_clear_date'])) }}</span>
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
								
								<!-- <div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Amount</span>
										@if($registerPayment['bank_amount'] != '')
											<span class="view-value-text">{{ $registerPayment['bank_amount'] }}</span>
										@else
											<span class="view-value-text">-</span>
										@endif
									</div>
								</div> -->
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Narration</span>
										@if($registerPayment['narration'] != '')
											<span class="view-value-text">{{ $registerPayment['narration'] }}</span>
										@else
											<span class="view-value-text">-</span>
										@endif
									</div>
								</div>
							

								<!-- <div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Mode Of Payment</span>
										<span class="view-value-text">{{ $registerPayment['mode_of_payment'] }}</span>
									</div>
								</div> -->
								@endif

							</div>
						</div>
					 </div>  


					{{-- <div class="view-section">
						<div class="kt-title__head">
							<div class="kt-portlet__header">
								<h3 class="title-ktt-view">
									Details 
								</h3>
							</div>
						</div>	 
						<div class="main-padding ceparetar">
							<div class="row"> 
								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Email</span>
										<span class="view-value-text">{{ $detailsRegistration['email'] }}</span>
									</div>
								</div>

								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">First Phone Number</span>
										<span class="view-value-text">{{ $detailsRegistration['phone_number_first'] }}</span>
									</div>
								</div>

								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Second Phone Number</span>
										<span class="view-value-text">{{ $detailsRegistration['phone_number_second'] }}</span>
									</div>
								</div>

								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Region</span>
										<span class="view-value-text">{{ $detailsRegistration['region_name'] }}({{ $detailsRegistration['region_code'] }})</span>
									</div>
								</div>

								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Samaj Zone</span>
										<span class="view-value-text">{{ $detailsRegistration['samaj_zone_name'] }}</span>
									</div>
								</div>

								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Yuva Mandal</span>
										<span class="view-value-text">{{ $detailsRegistration['yuva_mandal_number'] }}</span>
									</div>
								</div>


							@if(count($profilePhoto)>0)
							@if($profilePhoto->upload_registration_documnet_status == '1')
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Profile Image</span>
											@if($profilePhoto->upload_registration_documnet_status != "")
												<img src="{{ URL::asset('assets/uploads/user_image/').'/'.$profilePhoto->upload_registration_documnet_status }}">
												<div id="methods">
													<a href="{{ URL::asset('assets/uploads/user_image/').'/'.$profilePhoto->upload_registration_documnet_status }}">
														<div class="upload-img-title">
															<i class="la la-eye"></i>	
														</div>
													</a>
												</div>
											@else
												<img src="{{ URL::asset('assets/img/product10.jpg') }}">
												<div id="methods">
													<a href="{{ URL::asset('assets/img/product10.jpg') }}">
														<div class="upload-img-title">
															<i class="la la-eye"></i>	
														</div>
													</a>
												</div>
											@endif
										</div>
									</div>
								@endif
								@endif
							</div>
						</div>
					</div> --}}
				<!--end::Portlet-->
				@if($detailsRegistration->first_nominee_name != '' || $detailsRegistration->second_nominee_name != '')
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
								@if($detailsRegistration['first_nominee_family_id'] != '0')
									<div class="col-sm-4 col-md-4 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">First Nominee Family Id</span>
											<span class="view-value-text">{{ $detailsRegistration['first_nominee_family_id'] }}</span>
										</div>
									</div>
								@endif

								<div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">First Nominee Name</span>
										<span class="view-value-text">{{ $detailsRegistration['first_nominee_name'] }}</span>
									</div>
								</div>

								<div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">First Nominee Relation</span>
										<span class="view-value-text">{{ $detailsRegistration['first_nominee_relation'] }}</span>
									</div>
								</div>
								@if($detailsRegistration['second_nominee_family_id'] != '0')
									<div class="col-sm-4 col-md-4 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Second Nominee Family Id</span>
											<span class="view-value-text">{{ $detailsRegistration['second_nominee_family_id'] }}</span>
										</div>
									</div>
								@endif

								<div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Second Nominee Name</span>
										<span class="view-value-text">{{ $detailsRegistration['second_nominee_name'] }}</span>
									</div>
								</div>

								<div class="col-sm-4 col-md-4 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Second Nominee Relation</span>
										<span class="view-value-text">{{ $detailsRegistration['second_nominee_relation'] }}</span>
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
									<div class="col-sm-3 col-md-3 view-group">
										<div class="view-details-mtt">
											<span class="view-title-kt">Name As Per YskSabgh.org</span>
											<span class="view-value-text"> {{ $getOtherMemberDetailss['name_as_per_yuva_sangh_org'] }} </span>
										</div>
									</div>	

								 <div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Member Id</span>
										<span class="view-value-text"> {{ $getOtherMemberDetailss['member'] }} </span>
									</div>
								</div> 

								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">Family Id</span>
										<span class="view-value-text"> {{ $getOtherMemberDetailss['family_id'] }} </span>
									</div>
								</div>

								<div class="col-sm-3 col-md-3 view-group">
									<div class="view-details-mtt">
										<span class="view-title-kt">YSK Id</span>
										@if($getOtherMemberDetailss['pre_ysk_id'] == '' && $getOtherMemberDetailss['ysk_id'] == '')
											<span class="view-value-text">-</span>
										@elseif($getOtherMemberDetailss['ysk_id'] == '')
											<span class="view-value-text">{{ $getOtherMemberDetailss['pre_ysk_id'] }}</span>
										@elseif($getOtherMemberDetailss['ysk_id'] != '')
											<span class="view-value-text">{{ $getOtherMemberDetailss['ysk_id'] }}</span>
										
										@endif
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>


				</div>
			</div>
			<!-- content end -->          
		</div>
		<!--ENd:: Chat-->
@endsection
@section('content_js')


<script>
	var $methods = $('#methods');
	var slide = '<a href="img/img2.jpg">' +
	'<img src="img/thumb2.jpg" />' +
	'</a>';

	$methods.lightGallery();
	$('#appendSlide').on('click', function() {
		$methods.append(slide);
		$methods.data('lightGallery').destroy(true);
		$methods.lightGallery();
	});
</script>

<script>
	var $methods = $('#methods1');
	var slide = '<a href="img/img2.jpg">' +
	'<img src="img/thumb2.jpg" />' +
	'</a>';

	$methods.lightGallery();
	$('#appendSlide').on('click', function() {
		$methods.append(slide);
		$methods.data('lightGallery').destroy(true);
		$methods.lightGallery();
	});
</script>

<script>
	var $methods = $('#methods3');
	var slide = '<a href="img/img2.jpg">' +
	'<img src="img/thumb2.jpg" />' +
	'</a>';

	$methods.lightGallery();
	$('#appendSlide').on('click', function() {
		$methods.append(slide);
		$methods.data('lightGallery').destroy(true);
		$methods.lightGallery();
	});
</script>

<script>
	var $methods = $('#methods2');
	var slide = '<a href="img/img2.jpg">' +
	'<img src="img/thumb2.jpg" />' +
	'</a>';

	$methods.lightGallery();
	$('#appendSlide').on('click', function() {
		$methods.append(slide);
		$methods.data('lightGallery').destroy(true);
		$methods.lightGallery();
	});
</script>
@endsection