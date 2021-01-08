@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style type="text/css" media="screen">
	input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>

<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="row" style="width: 100%;">
				<div class="col-md-10">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">
								Edit Sahyognidhi Request                            
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
							<a href="{{ route('sahyognidhi-request') }}">
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
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">		
			<div class="col-lg-12">
				<!--begin::Portlet-->
				<div class="kt-portlet">

					<div class="mtt-body">
						<form action="{{ route('update-sahyognidhi-request') }}" enctype="multipart/form-data" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group">
								<div class="kt-radio-inline">
									<div class="row">
									    <div class="col-sm-3 col-md-3">
											<label class="kt-radio">
												<input type="radio" name="sahyognidhi_request" id="sahyognidhi_request" onclick="function1(this.value)" {{ (isset($editSahyognidhiRequest) && $editSahyognidhiRequest->sahyognidhi_request=='Devantage')?'checked':'disabled' }} value="Devantage"> Devantage
												<span class="tablinks"  {{-- onclick="openCity('Tokyo')" --}} ></span>
											</label>
										</div>
										<div class="col-sm-3 col-md-3">
											<label class="kt-radio">
												<input type="radio" name="sahyognidhi_request" id="sahyognidhi_request" value="Full Disability" {{ (isset($editSahyognidhiRequest) && $editSahyognidhiRequest->sahyognidhi_request=='Full Disability')?'checked':'disabled' }} onclick="function1(this.value)"> Full Disability
												<span class="tablinks" {{-- onclick="openCity('Paris')" --}}></span>
											</label>
										</div>
										<div class="col-sm-3 col-md-3">	
											<label class="kt-radio">
												<input type="radio" name="sahyognidhi_request" id="sahyognidhi_request" value="Half Disability" {{ (isset($editSahyognidhiRequest) && $editSahyognidhiRequest->sahyognidhi_request=='Half Disability')?'checked':'disabled' }} onclick="function1(this.value)"> Half Disability
												<span class="tablinks" {{-- onclick="openCity('London')" --}}></span>
											</label>
										</div>
									</div>
									@if ($errors->has('sahyognidhi_request'))
									<span style="color: red;">
										{{ $errors->first('sahyognidhi_request') }}
									</span>
									@endif
								</div>
							</div>			
						
					
					<!--end::Portlet-->

					<div class="kt-portlet sahyognidhi-mtt">
						<div class="row">
							<div class="col-sm-12">	
								<div id="London" class="w3-container city">
									<div class="Half-section-details">
										<h3>General Information</h3>	
										<div class="sahyognidhi-border"></div>

										<div class="form-group1 m-form__group1 row">	
										   <label class="col-lg-2 col-form-label">Date<span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" class="form-control sahyognidhi_date" name="sahyognidhi_date" placeholder="Enter Date" value="{{ date('d-m-Y',strtotime($editSahyognidhiRequest->sahyognidhi_date)) }}" readonly>
												@if ($errors->has('sahyognidhi_date'))
													<span style="color: red;">
														{{ $errors->first('sahyognidhi_date') }}
													</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">YSK ID<span class="text-danger">*</span>
											</label>	
											<div class="col-lg-9">
												<select class="form-control kt-select2" id="fk_ysk_id" name="fk_ysk_id">
													<option selected disabled>Select YSK</option>
													<option value="{{ $editSahyognidhiRequest->fk_ysk_id }}" selected>{{ $editSahyognidhiRequest->name_as_per_yuvasangh_org }}(Ysk- {{ $editSahyognidhiRequest->fk_ysk_id }})</option>
												</select>
												@if ($errors->has('fk_ysk_id'))
													<span style="color: red;">
														{{ $errors->first('fk_ysk_id') }}
													</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Family Id<span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" id="family_id" name="family_id" class="form-control" placeholder="Enter Family Id" value="{{ $editSahyognidhiRequest->family_id }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
												@if ($errors->has('family_id'))
													<span style="color: red;">
														{{ $errors->first('family_id') }}
													</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Name<span class="text-danger">*</span></label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="name_as_per_yuvasangh_org" name="name_as_per_yuvasangh_org" placeholder="Enter Name" value="{{ $editSahyognidhiRequest->name_as_per_yuvasangh_org }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
												@if ($errors->has('name_as_per_yuvasangh_org'))
													<span style="color: red;">
														{{ $errors->first('name_as_per_yuvasangh_org') }}
													</span>
												@endif
											</div>
										</div>

										{{-- <div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Name<span class="text-danger">*</span><br><small>(As Per Ysk Submission Form)</small>
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" id="name_as_per_ysk_submission_form" placeholder="Enter Name As Per Ysk Submission Form" name="name_as_per_ysk_submission_form" value="{{ old('name_as_per_ysk_submission_form') }}" aria-describedby="emailHelp" readonly>
												@if ($errors->has('name_as_per_ysk_submission_form'))
												<span style="color: red;">
													{{ $errors->first('name_as_per_ysk_submission_form') }}
												</span>
												@endif
											</div>
										</div> --}}

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Region Name <span class="text-danger">*</span></label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="region_name" name="region_name" placeholder="Enter Region Name" value="{{ strtoupper($editSahyognidhiRequest->region_name) }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Council Name</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="council_name" name="council_name" placeholder="Enter Council Name" value="{{ $editSahyognidhiRequest->council_name }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Samaj Zone Name <span class="text-danger">*</span></label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="samaj_zone_name" name="samaj_zone_name" placeholder="Enter Samaj Zone Name" value="{{ strtoupper($editSahyognidhiRequest->samaj_zone_name) }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>	

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Yuva Mandal Name <span class="text-danger">*</span></label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="yuva_mandal_name" name="yuva_mandal_name" placeholder="Enter Yuva Mandal Name" value="{{ strtoupper($editSahyognidhiRequest->yuva_mandal_name) }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>	

										
										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">City
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" placeholder="Enter City" id="city_name" name="city_name" aria-describedby="emailHelp" placeholder="Enter City" value="{{ strtoupper($editSahyognidhiRequest->city_name) }}" aria-describedby="emailHelp" placeholder="Enter City" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
												@if ($errors->has('city_name'))
												<span style="color: red;">
													{{ $errors->first('city_name') }}
												</span>
												@endif
											</div>
										</div>	
										
										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Phone Number1<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="phone_number1" name="first_phone_number" placeholder="Enter First Phone Number" value="{{ $editSahyognidhiRequest->first_phone_number }}"  readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Phone Number2</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="phone_number2" name="second_phone_number" placeholder="Enter Second Phone Number" value="{{ $editSahyognidhiRequest->second_phone_number }}"  readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Email
											</label>	
											<div class="col-lg-9">
												<input type="email" class="form-control" aria-describedby="emailHelp" id="email" name="email" placeholder="Enter Email" value="{{ $editSahyognidhiRequest->email }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Aadhar Card Number<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control aadharCardNumber" aria-describedby="emailHelp" id="aadhar_card_number" name="aadhar_card_number" placeholder="Enter Aadhar Number" value="{{ $editSahyognidhiRequest->aadhar_card_number }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Date of Birth<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<input type="text" id="date_of_birth" name="date_of_birth" class="form-control date" placeholder="Enter Date Of Birth" value="{{ date('d-m-Y',strtotime($editSahyognidhiRequest->date_of_birth)) }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Gender<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="gender" disabled value="Male" {{ (isset($editSahyognidhiRequest) && $editSahyognidhiRequest->gender =='Male')?'checked':'disabled' }}> Male
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="gender" value="Female" {{ (isset($editSahyognidhiRequest) && $editSahyognidhiRequest->gender =='Female')?'checked':'disabled' }}> Female
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">
											<label class="col-lg-2 col-form-label">Existing Disease</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="existing_disease" name="existing_disease" placeholder="Enter Existing Disease" value="{{ $editSahyognidhiRequest->existing_disease }}" style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Other Document Name & Number</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="other_document_number" name="other_document_number" placeholder="Enter Other Document Number" value="{{ $editSahyognidhiRequest->other_document_number }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Age<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="age" name="age" placeholder="Enter Age" value="{{ $editSahyognidhiRequest->age }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
											</div>
										</div>

										@if($editSahyognidhiRequest->sahyognidhi_request == 'Full Disability')
										<div class="form-group1 m-form__group1 row disability_date">	
											<label class="col-lg-2 col-form-label">Disability Start Date
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="disability_date" name="disability_date" value="@if($editSahyognidhiRequest->disability_date != '0000-00-00') {{ date('d-m-Y',strtotime($editSahyognidhiRequest->disability_date)) }} @endif" placeholder="Enter Disability Date">
												@if ($errors->has('disability_date'))
												<span style="color: red;">
													{{ $errors->first('disability_date') }}
												</span>
												@endif
											</div>
										</div>
										@endif

										@if($editSahyognidhiRequest->sahyognidhi_request == 'Devantage')
										<div class="form-group1 m-form__group1 row show_div">	
											<label class="col-lg-2 col-form-label">Cause of Death <span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												 <select class="form-control kt-select2" id="cause_of_death" name="cause_of_death" style="width: 100%;">
													<option selected disabled>Select Cause Of Death</option>
													@foreach($deathType as $deathTypes)
														<option @if($editSahyognidhiRequest->cause_of_death == $deathTypes->death_type_id) selected @endif value="{{ $deathTypes->death_type_id }}">{{ $deathTypes->title }}</option>
													@endforeach
												</select> 
											</div>
											@if ($errors->has('cause_of_death'))
											<span style="color: red;">
												{{ $errors->first('cause_of_death') }}
											</span>
											@endif
										</div>

										<div class="form-group1 m-form__group1 row death_description">	
											<label class="col-lg-2 col-form-label">Death Description
											</label>	
											<div class="col-lg-9">
												<textarea class="form-control" id="death_description" name="death_description" placeholder="Enter Description" rows="4" cols="5">{{ $editSahyognidhiRequest->death_description }}</textarea>
												@if ($errors->has('death_description'))
												<span style="color: red;">
													{{ $errors->first('death_description') }}
												</span>
												@endif
											</div>
										</div>
										
										<div class="form-group1 m-form__group1 row death_date">	
											<label class="col-lg-2 col-form-label">Death Date
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" name="death_date" id="death_date" placeholder="ENTER DEATH DATE" value="@if($editSahyognidhiRequest['death_date'] != '0000-00-00'){{ date('d-m-Y',strtotime($editSahyognidhiRequest['death_date'])) }} @endif">
												@if ($errors->has('death_date'))
												<span style="color: red;">
													{{ $errors->first('death_date') }}
												</span>
												@endif
											</div>
										</div>

										@endif

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Inform Date<span class="text-danger">*</span>
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control inform_date" placeholder="Enter Inform Date" name="inform_date" value="{{ date('d-m-Y',strtotime($editSahyognidhiRequest->inform_date)) }}">
												@if ($errors->has('inform_date'))
												<span style="color: red;">
													{{ $errors->first('inform_date') }}
												</span>
												@endif
											</div>
										</div>
										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Informer Name<span class="text-danger">*</span>
											</label>	
											<div class="col-lg-9">
											    <select class="form-control" name="informer_name" id="informer_name">
													<option value="" selected>SELECT INFORMER NAME</option>
													@foreach($informerName as $informerNames)
													<option value="{{ $informerNames->karyakarta_id }}" @if($editSahyognidhiRequest->informer_name == $informerNames->karyakarta_id) selected @endif>{{ $informerNames->name_as_per_yuva_sangh_org }}({{ $informerNames->name }})</option>
													@endforeach
												</select>
												<!--<input type="text" class="form-control" placeholder="Enter Informer Name" name="informer_name" value="{{ $editSahyognidhiRequest->informer_name }}" aria-describedby="emailHelp">-->
												@if ($errors->has('informer_name'))
												<span style="color: red;">
													{{ $errors->first('informer_name') }}
												</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Informer Mobile<span class="text-danger">*</span></label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" name="informer_mobile" placeholder="Enter Informer Contact Number" value="{{ $editSahyognidhiRequest->informer_mobile }}">
											</div>
											@if ($errors->has('informer_mobile'))
												<span style="color: red;">
													{{ $errors->first('informer_mobile') }}
												</span>
											@endif
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Designation</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" name="designation" placeholder="Enter Designation" value="{{ $editSahyognidhiRequest->designation }}">
											</div>
										</div>
									</div>
								</div>


										<div class="nominee-details-mtt fieldGroupOne">
											<h3>Nominee Details</h3>
											<div class="sahyognidhi-border"></div>
											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">First Nominee Name<span class="text-danger">*</span></label>	
													<div class="col-lg-9">
														<input type="text" id="first_nominee_name" name="first_nominee_name" placeholder="Enter Nominee Name" class="form-control" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->first_nominee_name }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
													</div>
													@if ($errors->has('first_nominee_name'))
													<span style="color: red;">
														{{ $errors->first('first_nominee_name') }}
													</span>
													@endif
												</div>

												<input type="hidden" name="hidden_first_nominee_member_id" id="hidden_first_nominee_member_id">



												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">First Nominee Relation<span class="text-danger">*</span>
													</label>	
													<div class="col-lg-9">
														<input type="text" id="first_nominee_relation" class="form-control" placeholder="Enter Nominee Relation" name="first_nominee_relation" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->first_nominee_relation }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
														@if ($errors->has('first_nominee_relation'))
														<span style="color: red;">
															{{ $errors->first('first_nominee_relation') }}
														</span>
														@endif
													</div>
												</div>
												
										<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">First Nominee Contact Number<span class="text-danger">*</span>
													</label>	
													<div class="col-lg-9">
														<input type="text" id="first_nominee_contact_number" class="form-control" placeholder="Enter Nominee Contact Number" name="first_nominee_contact_number" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->first_nominee_contact_number }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
														@if ($errors->has('first_nominee_contact_number'))
														<span style="color: red;">
															{{ $errors->first('first_nominee_contact_number') }}
														</span>
														@endif
													</div>
												</div>
												
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">First Nominee Email ID<span class="text-danger">*</span>
													</label>	
													<div class="col-lg-9">
														<input type="text" id="first_nominee_email" class="form-control" placeholder="Enter Nominee Email Id" name="first_nominee_email" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->first_nominee_email }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
														@if ($errors->has('first_nominee_email'))
														<span style="color: red;">
															{{ $errors->first('first_nominee_email') }}
														</span>
														@endif
													</div>
												</div>
												
											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Second Nominee Name<span class="text-danger">*</span></label>	
													<div class="col-lg-9">
														<input type="text" id="second_nominee_name" name="second_nominee_name" placeholder="Enter Nominee Name" class="form-control" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->second_nominee_name }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
													</div>
													@if ($errors->has('second_nominee_name'))
													<span style="color: red;">
														{{ $errors->first('second_nominee_name') }}
													</span>
													@endif
												</div>

												<input type="hidden" name="hidden_second_nominee_member_id" id="hidden_second_nominee_member_id">

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Second Nominee Relation<span class="text-danger">*</span>
													</label>	
													<div class="col-lg-9">
														<input type="text" id="second_nominee_relation" class="form-control" placeholder="Enter Nominee Relation" name="second_nominee_relation" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->second_nominee_relation }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
														@if ($errors->has('second_nominee_relation'))
														<span style="color: red;">
															{{ $errors->first('second_nominee_relation') }}
														</span>
														@endif
													</div>
												</div>
												
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Second Nominee Contact Number<span class="text-danger">*</span>
													</label>	
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="Enter Nominee Contact Number" name="second_nominee_contact_number" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->second_nominee_contact_number }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
														@if ($errors->has('second_nominee_contact_number'))
														<span style="color: red;">
															{{ $errors->first('second_nominee_contact_number') }}
														</span>
														@endif
													</div>
												</div>
												
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Second Nominee Email ID<span class="text-danger">*</span>
													</label>	
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="Enter Nominee Email Id" name="second_nominee_email" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->second_nominee_email }}" readonly style="background:#d3d3d3;border-width:5px;border-style:solid;">
														@if ($errors->has('second_nominee_email'))
														<span style="color: red;">
															{{ $errors->first('second_nominee_email') }}
														</span>
														@endif
													</div>
												</div>
											</div>	
                                            
                                            <div class="nominee-details-mtt fieldGroupOne">
												<h3>Document Details</h3>
												<div class="sahyognidhi-border"></div>

												@if($editSahyognidhiRequest->sahyognidhi_request == 'Devantage')
												<div class="form-group1 m-form__group1 row show_divangat_upload_image">  
													<label class="col-lg-2 col-form-label">Medical Document  
													</label>  
													<div class="col-lg-9 imageBox">												
														<input type="file" id="divangat_upload_image" name="divangat_upload_image[]" multiple  class="form-control profile-height"   onchange="validDivangatImage()"/>
														@foreach($sahyognidhiDocument1 as $sahyognidhiDocuments1)
														@if($sahyognidhiDocuments1->document_extension == 'pdf')
														<span class="pip">
															<a href="../assets/uploads/divangat_image/{{ $sahyognidhiDocuments1->upload_document }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a> 
															<br/><span class="remove" onclick="deleteImage({{ $sahyognidhiDocuments1->registration_document_id }})">Remove image</span>
														</span>
														@else
														<span class="pip"> 
															<img class="imageThumb" src="../assets/uploads/divangat_image/{{ $sahyognidhiDocuments1->upload_document }}">
															<br/><span class="remove" onclick="deleteImage({{ $sahyognidhiDocuments1->sahyognidhi_upload_document_id }})">Remove image</span></span>
															@endif
															@endforeach
															<br>
															<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
															be no cropping and filtering facility available.</small>
															<br>
															<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError1"> </span>

															{{-- <div class="gallery"></div> --}}
														</div>
														{{-- <div class="col-lg-2">
															<div class="profile-img">
																<img class="addimage" src="{{ URL::asset('assets/img/Blank+Image.jpg') }}" id="profile-img-tag1"> 
															</div>  
														</div> --}}
													</div>

													<div class="form-group1 m-form__group1 row show_death_certificate_document">  
														<label class="col-lg-2 col-form-label">Death Certificate   
														</label>  
														<div class="col-lg-9 imageBox">
															<input type="file" class="form-control profile-height" id="death_certificate_document" onchange="validDeathCertificate()" aria-describedby="emailHelp" name="death_certificate_document[]" multiple>
															@foreach($sahyognidhiDocument2 as $sahyognidhiDocuments2)
															@if($sahyognidhiDocuments2->document_extension == 'pdf')
															<span class="pip">
																<a href="../assets/uploads/divangat_image/{{ $sahyognidhiDocuments2->upload_document }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a> 
																<br/><span class="remove" onclick="deleteImage({{ $sahyognidhiDocuments2->registration_document_id }})">Remove image</span>
															</span>
															@else
															<span class="pip"> 
																<img src="../assets/uploads/divangat_image/{{ $sahyognidhiDocuments2->upload_document }}" height="100px" width="100px" />
																<br/><span class="remove" onclick="deleteImage({{ $sahyognidhiDocuments2->sahyognidhi_upload_document_id }})">Remove image</span>
															</span>
															@endif
															@endforeach
															<br>
															<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
															be no cropping and filtering facility available.</small>
															<br>
															<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError2"> </span> 
															{{-- <div class="gallery1"></div> --}}
														</div>
														{{-- <div class="col-lg-2">
															<div class="profile-img">
																<img class="addimage" src="{{ URL::asset('assets/img/Blank+Image.jpg') }}" id="profile-img-tag2"> 
															</div>  
														</div> --}}
													</div>
													@endif

													@if($editSahyognidhiRequest->sahyognidhi_request == 'Full Disability')
													<div class="form-group1 m-form__group1 row show_disability_document">  
														<label class="col-lg-2 col-form-label">Disability/Medical Document
														</label>  
														<div class="col-lg-9 imageBox">
															<input type="file" class="form-control profile-height" id="disability_document" onchange="validateImage()" aria-describedby="emailHelp" name="disability_document[]" multiple>
															@foreach($sahyognidhiDocument3 as $sahyognidhiDocuments3)
															@if($sahyognidhiDocuments3->document_extension == 'pdf')
															<span class="pip">
																<a href="../assets/uploads/divangat_image/{{ $sahyognidhiDocuments3->upload_document }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a> 
																<br/><span class="remove" onclick="deleteImage({{ $sahyognidhiDocuments3->registration_document_id }})">Remove image</span>
															</span>
															@else
															<span class="pip"> 
																<img src="../assets/uploads/divangat_image/{{ $sahyognidhiDocuments3->upload_document }}" height="100px" width="100px" />
																<br/><span class="remove" onclick="deleteImage({{ $sahyognidhiDocuments3->sahyognidhi_upload_document_id }})">Remove image</span>
															</span>
															@endif
															@endforeach
															<br>
															<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
															be no cropping and filtering facility available.</small>
															<br>
															<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError"> </span> 
														</div>
														{{-- <div class="col-lg-2">
															<div class="profile-img">
																<img class="addimage" src="{{ URL::asset('assets/img/Blank+Image.jpg') }}" id="profile-img-tag"> 
															</div>  
														</div> --}}
													</div>
													@endif

													<div class="form-group1 m-form__group1 row">	
														<label class="col-lg-2 col-form-label">Description
														</label>	
														<div class="col-lg-9">
															<textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4" cols="5">{{ $editSahyognidhiRequest->description }}</textarea>
															@if ($errors->has('description'))
															<span style="color: red;">
																{{ $errors->first('description') }}
															</span>
															@endif
														</div>
													</div>
											</div>

											<div class="nominee-details-mtt fieldGroupOne">
											<h3>As Per Nominee Request</h3>
											<div class="sahyognidhi-border"></div>

											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">First Nominee Family Id</label>	
												<div class="col-lg-9">
													<input type="text" id="ask_first_nominee_family_id" name="ask_first_nominee_family_id" value="@if($editSahyognidhiRequest->ask_first_nominee_family_id != '0') {{ $editSahyognidhiRequest->ask_first_nominee_family_id }} @endif" placeholder="Enter Family Id" class="form-control" aria-describedby="emailHelp" onchange="nomineeCallApi1(this.value)">
												</div>
												@if ($errors->has('ask_first_nominee_family_id'))
												<span style="color: red;">
													{{ $errors->first('ask_first_nominee_family_id') }}
												</span>
												@endif
											</div>

											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">First Nominee</label>	
												<div class="col-lg-9">
													<select class="form-control kt-select2" id = "ask_first_nominee_member_id" name = "ask_first_nominee_member_id" onchange="getFirstNomineeName(this.value)">
														@if($editSahyognidhiRequest['ask_first_nominee_member_id'] != '0')
														<option value="" selected="selected" disabled>Select Nominee</option>
														<option  value="{{ $editSahyognidhiRequest['ask_first_nominee_member_id'] }}" selected>{{ $editSahyognidhiRequest['ask_first_nominee_name'] }}({{ $editSahyognidhiRequest['ask_first_nominee_member_id'] }})</option> 
														@else
														<option value="" selected="selected" disabled>Select Nominee</option>
														@endif
													</select>
													<span id="firstNomineeError" style="display: none; color: red;">Member cannot be a nominee.Select other.</span>
												</div>
												@if ($errors->has('ask_first_nominee_member_id'))
												<span style="color: red;">
													{{ $errors->first('ask_first_nominee_member_id') }}
												</span>
												@endif
											</div>

											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">First Nominee Name</label>	
													<div class="col-lg-9">
														<input type="text" id="ask_first_nominee_name" name="ask_first_nominee_name" placeholder="Enter Nominee Name" class="form-control" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->ask_first_nominee_name }}" readonly>
													</div>
													@if ($errors->has('ask_first_nominee_name'))
													<span style="color: red;">
														{{ $errors->first('ask_first_nominee_name') }}
													</span>
													@endif
													
												</div>



												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">First Nominee Relation
													</label>	
													<div class="col-lg-9">
														<input type="text" id="ask_first_nominee_relation" class="form-control" placeholder="Enter Nominee Relation" name="ask_first_nominee_relation" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->ask_first_nominee_relation }}">
														@if ($errors->has('ask_first_nominee_relation'))
														<span style="color: red;">
															{{ $errors->first('ask_first_nominee_relation') }}
														</span>
														@endif
													</div>
												</div>
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">First Nominee Contact Number
													</label>	
													<div class="col-lg-9">
														<input type="text" id="ask_first_nominee_contact_number" class="form-control" placeholder="Enter Nominee Contact Number" name="ask_first_nominee_contact_number" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->ask_first_nominee_contact_number }}">
														@if ($errors->has('ask_first_nominee_contact_number'))
														<span style="color: red;">
															{{ $errors->first('ask_first_nominee_contact_number') }}
														</span>
														@endif
													</div>
												</div>
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">First Nominee Email ID
													</label>	
													<div class="col-lg-9">
														<input type="text" id="ask_first_nominee_email" class="form-control" placeholder="Enter Nominee Email Id" name="ask_first_nominee_email" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->ask_first_nominee_email }}">
														@if ($errors->has('ask_first_nominee_email'))
														<span style="color: red;">
															{{ $errors->first('ask_first_nominee_email') }}
														</span>
														@endif
													</div>
												</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Second Nominee Family Id</label>	
												<div class="col-lg-9">
													<input type="text" id="ask_second_nominee_family_id" name="ask_second_nominee_family_id" placeholder="Enter Family Id" class="form-control" aria-describedby="emailHelp" value="@if($editSahyognidhiRequest->ask_second_nominee_family_id != '0') {{ $editSahyognidhiRequest->ask_second_nominee_family_id }} @endif" onchange="nomineeCallApi2(this.value)">
												</div>
												@if ($errors->has('ask_second_nominee_family_id'))
												<span style="color: red;">
													{{ $errors->first('ask_second_nominee_family_id') }}
												</span>
												@endif
											</div>

											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Second Nominee</label>	
												<div class="col-lg-9">
													<select class="form-control kt-select2" id = "ask_second_nominee_member_id" name = "ask_second_nominee_member_id" onchange="getSecondNomineeName(this.value)">
														@if($editSahyognidhiRequest['ask_second_nominee_member_id'] != '0')
														<option value="" selected="selected" disabled>Select Nominee</option>
														<option value="{{ $editSahyognidhiRequest['ask_second_nominee_member_id'] }}" selected>{{ $editSahyognidhiRequest['ask_second_nominee_name'] }}({{ $editSahyognidhiRequest['ask_second_nominee_member_id'] }})</option> 
														@else
														<option value="" selected="selected" disabled>Select Nominee</option>
														@endif
													</select>
													<span id="secondNomineeError" style="display: none; color: red;">Member cannot be a nominee.Select other.</span>
												</div>
												@if ($errors->has('ask_second_nominee_member_id'))
												<span style="color: red;">
													{{ $errors->first('ask_second_nominee_member_id') }}
												</span>
												@endif
											</div>

											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Second Nominee Name</label>	
													<div class="col-lg-9">
														<input type="text" id="ask_second_nominee_name" name="ask_second_nominee_name" placeholder="Enter Nominee Name" class="form-control" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->ask_second_nominee_name }}" readonly>
													</div>
													@if ($errors->has('ask_second_nominee_name'))
													<span style="color: red;">
														{{ $errors->first('ask_second_nominee_name') }}
													</span>
													@endif
												</div>



												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Second Nominee Relation
													</label>	
													<div class="col-lg-9">
														<input type="text" id="ask_second_nominee_relation" class="form-control" placeholder="Enter Nominee Relation" name="ask_second_nominee_relation" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->ask_second_nominee_relation }}">
														@if ($errors->has('ask_second_nominee_relation'))
														<span style="color: red;">
															{{ $errors->first('ask_second_nominee_relation') }}
														</span>
														@endif
													</div>
												</div>
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Second Nominee Contact Number
													</label>	
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="Enter Nominee Contact Number" name="ask_second_nominee_contact_number" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->ask_second_nominee_contact_number }}">
														@if ($errors->has('ask_second_nominee_contact_number'))
														<span style="color: red;">
															{{ $errors->first('ask_second_nominee_contact_number') }}
														</span>
														@endif
													</div>
												</div>
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Second Nominee Email ID
													</label>	
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="Enter Nominee Email Id" name="ask_second_nominee_email" aria-describedby="emailHelp" value="{{ $editSahyognidhiRequest->ask_second_nominee_email }}">
														@if ($errors->has('ask_second_nominee_email'))
														<span style="color: red;">
															{{ $errors->first('ask_second_nominee_email') }}
														</span>
														@endif
													</div>
												</div>
												<input type="hidden" name="editId" value="{{ $editSahyognidhiRequest['sahyognidhi_id'] }}">
											<div class="nominee-details-mtt">
												<h3></h3>
												<div class="sahyognidhi-border"></div>
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label"></label>	
													<div class="col-lg-9">
														<div class="kt-portlet__head-toolbar">
															<div class="kt-portlet__head-wrapper">
																<div class="kt-portlet__head-actions">
																	<input type="submit" name="submit" value="  Edit  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
																	<a href="{{ route('sahyognidhi-request') }}" class="btn-cancel-registration">Cancel</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>

									   </div>
									</div>
								</div>

							</form>
 						
						   </div>
					    </div>
					</div>
			</div>
		</div>
	</div>
						
	<!-- content end -->
<!--ENd:: Chat-->
@endsection
@section('content_js')

<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}

   
</script>
<script>
$('#fk_ysk_id').select2();
$('#fk_bank_id').select2();
$('#fk_bank_id1').select2();
$('#informer_name').select2();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>	

<script>
	$('#disability_date').mask('00-00-0000');	
	$('.sahyognidhi_date').mask('00-00-0000');	
	$('.inform_date').mask('00-00-0000');	
    $('#death_date').mask('00-00-0000');
	function readURL1(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('#profile-img-tag').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}	
	$("#disability_document").change(function(){
		readURL1(this);
	});


	function validateImage(argument) {
		var formData = new FormData();
		var file = document.getElementById('disability_document').files[0];
		formData.append("Filedata", file);
		var t = file.type.split('/').pop().toLowerCase();
		if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {
			$("#imgError").html("Extension File is Not Valid");
			$("#imgError").css("display", "block");
			document.getElementById("disability_document").value = '';
			return false;
		}
		if (t == "jpeg" && t == "jpg" && t == "png" && t == "bmp" && t == "gif" && t == "pdf"){
			$("#imgError").hide();
		}
		if (Math.round(file.size/1024) > 500) {
			$("#imgError").html("Max Upload size is 500kb only");
			$("#imgError").css("display", "block");
			document.getElementById("disability_document").value = '';
			return false;
		}
		else{
		    $("#imgError").hide();
		}
		return true;
	}

	function validDivangatImage(argument) {
		var formData = new FormData();
		var file = document.getElementById('divangat_upload_image').files[0];
		formData.append("Filedata", file);
		var t = file.type.split('/').pop().toLowerCase();
		if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {
			$("#imgError1").html("Extension File is Not Valid");
			$("#imgError1").css("display", "block");
			document.getElementById("divangat_upload_image").value = '';
			return false;
		}
		if (t == "jpeg" && t == "jpg" && t == "png" && t == "bmp" && t == "gif" && t == "pdf") {
			$("#imgError1").hide();
		}
		if (Math.round(file.size/1024) > 500) {
			$("#imgError1").html("Max Upload size is 500kb only");
			$("#imgError1").css("display", "block");
			document.getElementById("divangat_upload_image").value = '';
			return false;
		}
		else{
		    $("#imgError1").hide();
		}
		return true;
	}

	function validDeathCertificate(argument) {
		var formData = new FormData();
		var file = document.getElementById('death_certificate_document').files[0];
		formData.append("Filedata", file);
		var t = file.type.split('/').pop().toLowerCase();
		if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {
			$("#imgError2").html("Extension File is Not Valid");
			$("#imgError2").css("display", "block");
			document.getElementById("death_certificate_document").value = '';
			return false;
		}
		if (t == "jpeg" && t == "jpg" && t == "png" && t == "bmp" && t == "gif" && t == "pdf") {
			$("#imgError2").hide();
		}
		if (Math.round(file.size/1024) > 500) {
			$("#imgError2").html("Max Upload size is 500kb only");
			$("#imgError2").css("display", "block");
			document.getElementById("death_certificate_document").value = '';
			return false;
		}
		else{
		    $("#imgError2").hide();
		}
		return true;
	}


	function function1(value) {
		if (value == 'Half Disability' || value == 'Full Disability') {
			$('.show_div').hide();
			$('.disability_date').show();
			$('.show_disability_document').show();
			$('.show_death_certificate_document').hide();
			$('.show_divangat_upload_image').hide();
		}
		else{
			$('.show_div').show();
			$('.disability_date').hide();
			$('.show_disability_document').hide();
			$('.show_death_certificate_document').show();
			$('.show_divangat_upload_image').show();
		}
		
	}
	$('#cause_of_death').select2();
	$('#ask_first_nominee_member_id').select2();
	$('#ask_second_nominee_member_id').select2();


	function nomineeCallApi1(familyId) {		
			$.ajax({
				type:"POST",
				url:"{{ route('data-by-first-family-id') }}",
				data:{ask_first_nominee_family_id:familyId,_token:"{{ csrf_token() }}"},
				success: function(response){
					var obj = JSON.parse(response);
					if(obj.success == 1){
						$("#ask_first_nominee_member_id").html(obj.html_data);
						$("#ask_first_nominee_member_id").select2();
						$('.ask_first_nominee_invalid_user').hide(); 	
					    //$('.loader').hide();
					}
					else{
						$('.ask_first_nominee_invalid_user').html(obj.message);
						$('.ask_first_nominee_invalid_user').show();
						//$('.loader').hide();
					}
			}
		});
		}

		function nomineeCallApi2(familyId) {		
			$.ajax({
				type:"POST",
				url:"{{ route('data-by-second-family-id') }}",
				data:{ask_second_nominee_family_id:familyId,_token:"{{ csrf_token() }}"},
				success: function(response){
					var obj = JSON.parse(response);
					if(obj.success == 1){
						$("#ask_second_nominee_member_id").html(obj.html_data);
						$("#ask_second_nominee_member_id").select2();
						$('.first_nominee_invalid_user').hide(); 	
					    //$('.loader').hide();
					}
					else{
						$('.first_nominee_invalid_user').html(obj.message);
						$('.first_nominee_invalid_user').show();
						//$('.loader').hide();
					}
			}
		});
		}

		function getFirstNomineeName(value) {
			var nomineeFamilyId = $('#ask_first_nominee_family_id').val();
			var memberId = $('#member_id').val();
			$.ajax({
				url: '{{ route('get-first-nominee-data-by-family-id') }}',
				type: 'POST',
				data: {member_id:memberId,ask_first_nominee_family_id: nomineeFamilyId,ask_first_nominee_member_id:value,_token:"{{ csrf_token() }}"},
				success:function (response) {
					var obj = JSON.parse(response);
					if (obj.success = 1) {
						if (obj.MemberID != obj.firstNomineeId) {
							$('#ask_first_nominee_name').val(obj.Name);
							$('#firstNomineeError').hide();
						}
						else{
							$('#ask_first_nominee_name').val(null);
							$('#firstNomineeError').show();
						}
					}
				}
			})			
		}

		function getSecondNomineeName(value) {
			var nomineeFamilyId = $('#ask_second_nominee_family_id').val();
			var memberId = $('#member_id').val();
			$.ajax({
				url: '{{ route('get-second-nominee-data-by-family-id') }}',
				type: 'POST',
				data: {member_id:memberId,ask_second_nominee_family_id: nomineeFamilyId,ask_second_nominee_member_id:value,_token:"{{ csrf_token() }}"},
				success:function (response) {
					var obj = JSON.parse(response);
					if (obj.success = 1) {
						if (obj.MemberID != obj.firstNomineeId) {
							$('#ask_second_nominee_name').val(obj.Name);
							$('#secondNomineeError').hide();
						}
						else{
							$('#ask_second_nominee_name').val(null);
							$('#secondNomineeError').show();
						}
					}
				}
			})			
		}
</script>
<script>
	function deleteImage(id) {
		$.ajax({
			url: '{{ route('delete-image','id') }}',
			type: 'GET',
			data: {id: id},
			success:function(response) {
				var obj = JSON.parse(response);
				if (obj.success == 1) {
					location.reload();
				}
			}
		})		
	}



	$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#divangat_upload_image").on("change", function(e) {
      var fp = $("#divangat_upload_image");
      var items = fp[0].files;
      var files = e.target.files,
        filesLength = files.length;
		    for (var i = 0; i < filesLength; i++) {
		    	var t = items[i].type.split('/').pop().toLowerCase();
		        var f = files[i]
		     	var name = "http://eysk.org/assets/img/pdf.png";
		        var fileReader = new FileReader();
		        if (t != 'pdf'){
			        fileReader.onload = (function(e) {
			          var file = e.target;		          	
			          	 $("<span class=\"pip\">" +
					            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
					            "<br/><span class=\"remove\">Remove image</span>" +
					            "</span>").insertAfter("#divangat_upload_image");
					          $(".remove").click(function(){
					            $(this).parent(".pip").remove();
					          });
			          
			        });
			    }
			    else{
			    	fileReader.onload = (function(e) {
			          var file = e.target;		          	
			          	 $("<span class=\"pip\">" +
					            "<img class=\"imageThumb\" src=\"" + name + "\" title=\"" + file.name + "\"/>" +
					            "<br/><span class=\"remove\">Remove image</span>" +
					            "</span>").insertAfter("#divangat_upload_image");
					          $(".remove").click(function(){
					            $(this).parent(".pip").remove();
					          });
			          
			        });
			    }
		        fileReader.readAsDataURL(f);
		    }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

	$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#death_certificate_document").on("change", function(e) {
      var fp = $("#death_certificate_document");
      var items = fp[0].files;
      var files = e.target.files,
        filesLength = files.length;
		    for (var i = 0; i < filesLength; i++) {
		    	var t = items[i].type.split('/').pop().toLowerCase();
		        var f = files[i]
		     	var name = "http://eysk.org/assets/img/pdf.png";
		        var fileReader = new FileReader();
		        if (t != 'pdf'){
			        fileReader.onload = (function(e) {
			          var file = e.target;		          	
			          	 $("<span class=\"pip\">" +
					            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
					            "<br/><span class=\"remove\">Remove image</span>" +
					            "</span>").insertAfter("#death_certificate_document");
					          $(".remove").click(function(){
					            $(this).parent(".pip").remove();
					          });
			          
			        });
			    }
			    else{
			    	fileReader.onload = (function(e) {
			          var file = e.target;		          	
			          	 $("<span class=\"pip\">" +
					            "<img class=\"imageThumb\" src=\"" + name + "\" title=\"" + file.name + "\"/>" +
					            "<br/><span class=\"remove\">Remove image</span>" +
					            "</span>").insertAfter("#death_certificate_document");
					          $(".remove").click(function(){
					            $(this).parent(".pip").remove();
					          });
			          
			        });
			    }
		        fileReader.readAsDataURL(f);
		    }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

	$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#disability_document").on("change", function(e) {
      var fp = $("#disability_document");
      var items = fp[0].files;
      var files = e.target.files,
        filesLength = files.length;
		    for (var i = 0; i < filesLength; i++) {
		    	var t = items[i].type.split('/').pop().toLowerCase();
		        var f = files[i]
		     	var name = "http://eysk.org/assets/img/pdf.png";
		        var fileReader = new FileReader();
		        if (t != 'pdf'){
			        fileReader.onload = (function(e) {
			          var file = e.target;		          	
			          	 $("<span class=\"pip\">" +
					            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
					            "<br/><span class=\"remove\">Remove image</span>" +
					            "</span>").insertAfter("#disability_document");
					          $(".remove").click(function(){
					            $(this).parent(".pip").remove();
					          });
			          
			        });
			    }
			    else{
			    	fileReader.onload = (function(e) {
			          var file = e.target;		          	
			          	 $("<span class=\"pip\">" +
					            "<img class=\"imageThumb\" src=\"" + name + "\" title=\"" + file.name + "\"/>" +
					            "<br/><span class=\"remove\">Remove image</span>" +
					            "</span>").insertAfter("#disability_document");
					          $(".remove").click(function(){
					            $(this).parent(".pip").remove();
					          });
			          
			        });
			    }
		        fileReader.readAsDataURL(f);
		    }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>
@endsection
