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
								Add Sahyognidhi Request                            
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
						<form action="{{ route('save-sahyognidhi-request') }}" enctype="multipart/form-data" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group">
								<div class="kt-radio-inline">
									<div class="row">
									    <div class="col-sm-3 col-md-3">
											<label class="kt-radio">
												<input type="radio" name="sahyognidhi_request" id="sahyognidhi_request" onclick="function1(this.value)" value="Devantage" checked> Devantage
												<span class="tablinks"  {{-- onclick="openCity('Tokyo')" --}} ></span>
											</label>
										</div>
										<div class="col-sm-3 col-md-3">
											<label class="kt-radio">
												<input type="radio" name="sahyognidhi_request" id="sahyognidhi_request" value="Full Disability" onclick="function1(this.value)"> Full Disability
												<span class="tablinks" {{-- onclick="openCity('Paris')" --}}></span>
											</label>
										</div>
										<div class="col-sm-3 col-md-3">	
											<label class="kt-radio">
												<input type="radio" name="sahyognidhi_request" id="sahyognidhi_request" value="Half Disability"  onclick="function1(this.value)"> Half Disability
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
												<input type="text" class="form-control sahyognidhi_date" name="sahyognidhi_date" placeholder="Enter Date" value="{{ old('sahyognidhi_date') }}">
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
												<select class="form-control kt-select2" id="fk_ysk_id" name="fk_ysk_id" onchange="getDataByYskId(this.value)">
													<option selected disabled>Select YSK</option>
													@foreach($yskMember as $yskMembers)	
													  @if($yskMembers->ysk_id == '')
													  <option value="{{ $yskMembers->pre_ysk_id }}">{{ $yskMembers->hidden_name_as_per_yuva_sangh_org }}(PreYsk- {{ $yskMembers->pre_ysk_id }})</option>
													  @else
													  <option value="{{ $yskMembers->ysk_id }}">{{ $yskMembers->hidden_name_as_per_yuva_sangh_org }}(Ysk- {{ $yskMembers->ysk_id }})</option>
													  @endif
													@endforeach
												</select>
												@if ($errors->has('fk_ysk_id'))
													<span style="color: red;">
														{{ $errors->first('fk_ysk_id') }}
													</span>
												@endif
											<span id="sahyognidhiError" style="color: red;"></span>
											
											<span id="sahyognidhiNotPosible" style="color: red;"></span>
											</div>
										</div>
                                        
                                        <input type="hidden" name="sahyognidhiError" id="sahyognidhiError1">
										<input type="hidden" name="member_id" id="member_id">

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Family Id<span class="text-danger">*</span></label>
											<div class="col-lg-9">
												<input type="text" id="family_id" name="family_id" class="form-control" placeholder="Enter Family Id" readonly>
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
												<input type="text" class="form-control" aria-describedby="emailHelp" id="name_as_per_yuvasangh_org" name="name_as_per_yuvasangh_org" placeholder="ENTER NAME" readonly>
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
												<input type="text" class="form-control" aria-describedby="emailHelp" id="region_name" name="region_name" placeholder="ENTER REGION NAME" readonly>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Council Name</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="council_name" name="council_name" placeholder="ENTER COUNCIL NAME" readonly>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Samaj Zone Name <span class="text-danger">*</span></label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="samaj_zone_name" name="samaj_zone_name" placeholder="ENTER SAMAJ ZONE NAME" readonly>
											</div>
										</div>	

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Yuva Mandal Name <span class="text-danger">*</span></label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="yuva_mandal_name" name="yuva_mandal_name" placeholder="ENTER YUVA MANDAL NAME" readonly>
											</div>
										</div>	

										
										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">City
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" placeholder="ENTER CITY" id="city_name" name="city_name" value="{{ old('city_name') }}" aria-describedby="emailHelp" placeholder="Enter City" readonly>
												@if ($errors->has('city_name'))
												<span style="color: red;">
													{{ $errors->first('city_name') }}
												</span>
												@endif
											</div>
										</div>	

										{{-- <div class="form-group1 m-form__group1 row">  
											<label class="col-lg-2 col-form-label">Member Photo  
											</label>  
											<div class="col-lg-7 imageBox">
												 <input type="file" class="form-control profile-height" id="photo" aria-describedby="emailHelp" name="profile_photo">
												<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
												be no cropping and filtering facility available.</small>
												<br>
												<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError"> </span> 
											</div>
											<div class="col-lg-2">
												<div class="profile-img">
													<img class="addimage" src="{{ URL::asset('assets/img/300_3.jpg') }}" id="profile-img-tag"> 
												</div>  
											</div>
										</div> --}}
										
										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Phone Number1<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="phone_number1" name="first_phone_number" placeholder="ENTER FIRST PHONE NUMBER" readonly>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Phone Number2</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="phone_number2" name="second_phone_number" readonly placeholder="ENTER SECOND PHONE NUMBER">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Email
											</label>	
											<div class="col-lg-9">
												<input type="email" class="form-control" aria-describedby="emailHelp" id="email" name="email" placeholder="ENTER EMAIL" readonly>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Aadhar Card Number<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control aadharCardNumber" aria-describedby="emailHelp" id="aadhar_card_number" name="aadhar_card_number" placeholder="ENTER AADHAR NUMBER" readonly>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Date of Birth<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<input type="text" id="date_of_birth" name="date_of_birth" class="form-control date" placeholder="ENTER DATE OF BIRTH" readonly>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Gender<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<div class="kt-radio-inline">
													<label class="kt-radio">
														<input type="radio" name="gender" disabled value="Male"> Male
														<span></span>
													</label>
													<label class="kt-radio">
														<input type="radio" name="gender" value="Female" disabled> Female
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">
											<label class="col-lg-2 col-form-label">Existing Disease</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="existing_disease" name="existing_disease" readonly placeholder="ENTER EXISTING DISEASE">
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Other Document Name & Number</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="other_document_number" name="other_document_number" placeholder="ENTER OTHER DOCUMENT NUMBER" readonly>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Age<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="age" name="age" placeholder="ENTER AGE" readonly>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row disability_date" style="display: none;">	
											<label class="col-lg-2 col-form-label">Disability Start Date	
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" id="disability_date" name="disability_date" placeholder="ENTER DISABILITY DATE">
												@if ($errors->has('disability_date'))
												<span style="color: red;">
													{{ $errors->first('disability_date') }}
												</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row show_div">	
											<label class="col-lg-2 col-form-label">Cause of Death	
											</label>	
											<div class="col-lg-9">
												 <select class="form-control kt-select2" onchange="getDeathDescription(this.value);" id="cause_of_death" name="cause_of_death" style="width: 100%;">
													<option selected disabled>SELECT CAUSE OF DEATH</option>
													@foreach($deathType as $deathTypes)
														<option value="{{ $deathTypes->death_type_id }}">{{ $deathTypes->title }}</option>
													@endforeach
												</select> 
											</div>
											@if ($errors->has('cause_of_death'))
											<span style="color: red;">
												{{ $errors->first('cause_of_death') }}
											</span>
											@endif
										</div>

										<div class="form-group1 m-form__group1 row death_description" style="display: none;">	
											<label class="col-lg-2 col-form-label">Death Description
											</label>	
											<div class="col-lg-9">
												<textarea class="form-control" id="death_description" name="death_description" placeholder="ENTER DESCRIPTION" rows="4" cols="5">{{ old('death_description') }}</textarea>
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
												<input type="text" class="form-control" name="death_date" id="death_date" placeholder="ENTER DEATH DATE" value="{{ old('death_date') }}">
												@if ($errors->has('death_date'))
												<span style="color: red;">
													{{ $errors->first('death_date') }}
												</span>
												@endif
											</div>
										</div>
                                        
										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Inform Date<span class="text-danger">*</span>
											</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control inform_date" placeholder="ENTER INFORM DATE" id="inform_date" name="inform_date" value="{{ old('inform_date') }}">
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
														<option value="{{ $informerNames->karyakarta_id }}">{{ $informerNames->name_as_per_yuva_sangh_org }}({{ $informerNames->name }})</option>
													@endforeach
												</select>
												<!--<input type="text" class="form-control" placeholder="ENTER INFORMER NAME" name="informer_name" value="{{ old('informer_name') }}" aria-describedby="emailHelp">-->
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
												<input type="text" class="form-control" aria-describedby="emailHelp" name="informer_mobile" placeholder="ENTER INFORMER CONTACT NUMBER" value="{{ old('informer_mobile') }}">
												@if ($errors->has('informer_mobile'))
												<span style="color: red;">
													{{ $errors->first('informer_mobile') }}
												</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Designation</label>	
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" name="designation" placeholder="ENTER DESIGNATION" value="{{ old('designation') }}">
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
														<input type="text" id="first_nominee_name" name="first_nominee_name" placeholder="ENTER NOMINEE NAME" class="form-control" aria-describedby="emailHelp" readonly>
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
														<input type="text" id="first_nominee_relation" class="form-control" placeholder="ENTER NOMINEE RELATION" name="first_nominee_relation" aria-describedby="emailHelp" readonly>
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
														<input type="text" id="first_nominee_contact_number" class="form-control" placeholder="ENTER NOMINEE CONTACT NUMBER" name="first_nominee_contact_number" aria-describedby="emailHelp" value="{{ old('first_nominee_contact_number') }}">
														@if ($errors->has('first_nominee_contact_number'))
														<span style="color: red;">
															{{ $errors->first('first_nominee_contact_number') }}
														</span>
														@endif
													</div>
												</div>
												
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">First Nominee Email ID
													</label>	
													<div class="col-lg-9">
														<input type="text" id="first_nominee_email" class="form-control" placeholder="ENTER NOMINEE EMAIL ID" name="first_nominee_email" aria-describedby="emailHelp" value="{{ old('first_nominee_email') }}">
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
														<input type="text" id="second_nominee_name" name="second_nominee_name" placeholder="ENTER NOMINEE NAME" class="form-control" aria-describedby="emailHelp" readonly>
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
														<input type="text" id="second_nominee_relation" class="form-control" placeholder="ENTER NOMINEE RELATION" name="second_nominee_relation" aria-describedby="emailHelp" readonly>
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
														<input type="text" class="form-control" placeholder="ENTER NOMINEE CONTACT NUMBER" id="second_nominee_contact_number" name="second_nominee_contact_number" aria-describedby="emailHelp" value="{{ old('second_nominee_contact_number') }}">
														@if ($errors->has('second_nominee_contact_number'))
														<span style="color: red;">
															{{ $errors->first('second_nominee_contact_number') }}
														</span>
														@endif
													</div>
												</div>
												
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Second Nominee Email ID
													</label>	
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="ENTER NOMINEE EMAIL ID" name="second_nominee_email" id="second_nominee_email" aria-describedby="emailHelp" value="{{ old('second_nominee_email') }}">
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

													<div class="form-group1 m-form__group1 row show_divangat_upload_image">  
														<label class="col-lg-2 col-form-label">Medical Document  
														</label>  
														<div class="col-lg-9 imageBox">
															<input type="file" class="form-control profile-height" id="divangat_upload_image" onchange="validDivangatImage()" aria-describedby="emailHelp" name="divangat_upload_image[]" multiple>
															<br>
															<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
															be no cropping and filtering facility available.</small>
															<br>
															<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError1"> </span>
															<div class="gallery"></div>
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

													<div class="form-group1 m-form__group1 row show_disability_document" style="display: none;">  
														<label class="col-lg-2 col-form-label">Disability/Medical Document
														</label>  
														<div class="col-lg-9 imageBox">
															<input type="file" class="form-control profile-height" id="disability_document" onchange="validateImage()" aria-describedby="emailHelp" name="disability_document[]" multiple>
															<br>
															<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
															be no cropping and filtering facility available.</small>
															<br>
															<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError"> </span> 
															{{-- <div class="gallery2"></div> --}}
														</div>
													{{-- <div class="col-lg-2">
														<div class="profile-img">
															<img class="addimage" src="{{ URL::asset('assets/img/Blank+Image.jpg') }}" id="profile-img-tag"> 
														</div>  
													</div> --}}
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Description
													</label>	
													<div class="col-lg-9">
														<textarea class="form-control" id="description" name="description" placeholder="ENTER DESCRIPTION" rows="4" cols="5">{{ old('description') }}</textarea>
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
													<input type="text" id="ask_first_nominee_family_id" name="ask_first_nominee_family_id" placeholder="ENTER FAMILY ID" class="form-control" aria-describedby="emailHelp" onchange="nomineeCallApi1(this.value)">
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
														<option value="" selected="selected" disabled>SELECT NOMINEE</option>
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
														<input type="text" id="ask_first_nominee_name" name="ask_first_nominee_name" placeholder="ENTER NOMINEE NAME" class="form-control" aria-describedby="emailHelp" readonly>
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
														<input type="text" id="ask_first_nominee_relation" class="form-control" placeholder="ENTER NOMINEE RELATION" name="ask_first_nominee_relation" aria-describedby="emailHelp">
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
														<input type="text" id="ask_first_nominee_contact_number" class="form-control" placeholder="ENTER NOMINEE CONTACT NNUMBER" name="ask_first_nominee_contact_number" aria-describedby="emailHelp" value="{{ old('ask_first_nominee_contact_number') }}">
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
														<input type="text" id="ask_first_nominee_email" class="form-control" placeholder="ENTER NOMINEE EMAIL ID" name="ask_first_nominee_email" aria-describedby="emailHelp" value="{{ old('ask_first_nominee_email') }}">
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
													<input type="text" id="ask_second_nominee_family_id" name="ask_second_nominee_family_id" placeholder="ENTER FAMILY ID" class="form-control" aria-describedby="emailHelp" onchange="nomineeCallApi2(this.value)">
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
														<option value="" selected="selected" disabled>SELECT NOMINEE</option>
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
														<input type="text" id="ask_second_nominee_name" name="ask_second_nominee_name" placeholder="ENTER NOMINEE NAME" class="form-control" aria-describedby="emailHelp" readonly>
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
														<input type="text" id="ask_second_nominee_relation" class="form-control" placeholder="ENTER NOMINEE RELATION" name="ask_second_nominee_relation" aria-describedby="emailHelp">
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
														<input type="text" class="form-control" placeholder="ENTER NOMINEE CONTACT NUMBER" name="ask_second_nominee_contact_number" aria-describedby="emailHelp" value="{{ old('ask_second_nominee_contact_number') }}">
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
														<input type="text" class="form-control" placeholder="ENTER NOMINEE EMAIL ID" name="ask_second_nominee_email" aria-describedby="emailHelp" value="{{ old('ask_second_nominee_email') }}">
														@if ($errors->has('ask_second_nominee_email'))
														<span style="color: red;">
															{{ $errors->first('ask_second_nominee_email') }}
														</span>
														@endif
													</div>
												</div>
											<div class="nominee-details-mtt">
												<h3></h3>
												<div class="sahyognidhi-border"></div>
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label"></label>	
													<div class="col-lg-9">
														<div class="kt-portlet__head-toolbar">
															<div class="kt-portlet__head-wrapper">
																<div class="kt-portlet__head-actions">
																	<input type="submit" id="submitbutton" name="submit" value="  Add  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
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
	$('#inform_date').mask('00-00-0000');
	$('#death_date').mask('00-00-0000');

	/*function readURL3(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('#profile-img-tag2').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}	
	$("#death_certificate_document").change(function(){
		readURL3(this);
	});*/

	function getDataByYskId(value) {
		$.ajax({
			url: '{{ route('get-data-by-ysk-id') }}',
			type: 'POST',
			data: {fk_ysk_id: value,_token:"{{ csrf_token() }}"},
			success:function (response) {
				var obj = JSON.parse(response);
				if (obj.success == 1) {
				    
					$('#family_id').val(obj.familyId);
					$("#family_id").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 
					$('#member_id').val(obj.memberId);
					$('#name_as_per_yuvasangh_org').val(obj.nameAsPerYuvaSanghOrg);
					$("#name_as_per_yuvasangh_org").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 					
					/*$('#name_as_per_ysk_submission_form').val(obj.nameAsPerYskSubmissionForm);
					$("#name_as_per_ysk_submission_form").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); */			
					$('#region_name').val(obj.regionName.toUpperCase());
					$("#region_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 
					$('#council_name').val(obj.councilName);
					$("#council_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 
					$('#samaj_zone_name').val(obj.samajZoneName.toUpperCase());
					$("#samaj_zone_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 					
					$('#yuva_mandal_name').val(obj.yuvaMandalName.toUpperCase());
					$("#yuva_mandal_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 
					$('#city_name').val(obj.cityName.toUpperCase());
					$("#city_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					if (obj.email != '') {
						$('#email').val(obj.email);
						$("#email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}	
					else{
						$("#email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					$('.aadharCardNumber').val(obj.aadharCardNumber);
					$(".aadharCardNumber").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});	
					$('#date_of_birth').val(obj.dateOfBirth);
					$("#date_of_birth").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					if (($('input[name="gender"][value="Male"]').val()) == obj.Gender) {
						$('input[name="gender"][value="Male"]').attr('checked','checked');
						$('#male').attr('checked',true);
					}
					else{
						$('input[name="gender"][value="Female"]').attr('checked','checked');
						$('#female').attr('checked',true);
					}
					/*$('#pincode').val(obj.pincode);
					$("#pincode").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});*/
					$('#phone_number1').val(obj.phoneNumber1);
					$("#phone_number1").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					if (obj.phoneNumber2 != '') {
						$('#phone_number2').val(obj.phoneNumber2);
						$("#phone_number2").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					else{
						$("#phone_number2").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					$('#existing_disease').val(obj.existingDiseaseAll);
					$("#existing_disease").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});

					if (obj.otherDocument != '') {
						$('#other_document_number').val(obj.otherDocument);
						$("#other_document_number").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					else{
						$("#other_document_number").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					$('#age').val(obj.age);
					$("#age").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#first_nominee_name').val(obj.firstNomineeName);
					$("#first_nominee_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#hidden_first_nominee_member_id').val(obj.firstNomineeMemberId);
					$('#first_nominee_relation').val(obj.firstNomineeRelation);
					$("#first_nominee_relation").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#first_nominee_contact_number').val(obj.firstNomineePhoneNumber);
					$("#first_nominee_contact_number").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#first_nominee_email').val(obj.firstNomineeEmail);
					$("#first_nominee_email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#second_nominee_name').val(obj.secondNomineeName);
					$('#hidden_second_nominee_member_id').val(obj.secondNomineeMemberId);
					$("#second_nominee_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});	
					$('#second_nominee_relation').val(obj.secondNomineeRelation);
					$("#second_nominee_relation").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#second_nominee_contact_number').val(obj.secondNomineePhoneNumber);
					$("#second_nominee_contact_number").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#second_nominee_email').val(obj.secondNomineeEmail);
					$("#second_nominee_email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					
					 if (obj.sahyognidhiNotPosible == '1') {
				    	  $('#sahyognidhiNotPosible').html('').html('Sahyognidhi Request Add Not Posible');
				    	  
				    	  jQuery('#submitbutton').hide();
				    }
					
					
				}
				if (obj.success == '0') {
					$('#sahyognidhiError').html('This yskid is in locking period.');
					$('#sahyognidhiError1').val(obj.message);
					$('#family_id').val(obj.familyId);
					$("#family_id").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 
					$('#member_id').val(obj.memberId);
					$('#name_as_per_yuvasangh_org').val(obj.nameAsPerYuvaSanghOrg);
					$("#name_as_per_yuvasangh_org").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 					
					/*$('#name_as_per_ysk_submission_form').val(obj.nameAsPerYskSubmissionForm);
					$("#name_as_per_ysk_submission_form").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); */			
					$('#region_name').val(obj.regionName.toUpperCase());
					$("#region_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 
					$('#council_name').val(obj.councilName);
					$("#council_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 
					$('#samaj_zone_name').val(obj.samajZoneName.toUpperCase());
					$("#samaj_zone_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 					
					$('#yuva_mandal_name').val(obj.yuvaMandalName.toUpperCase());
					$("#yuva_mandal_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 
					$('#city_name').val(obj.cityName.toUpperCase());
					$("#city_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					if (obj.email != '') {
						$('#email').val(obj.email);
						$("#email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}	
					else{
						$("#email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					$('.aadharCardNumber').val(obj.aadharCardNumber);
					$(".aadharCardNumber").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});	
					$('#date_of_birth').val(obj.dateOfBirth);
					$("#date_of_birth").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					if (($('input[name="gender"][value="Male"]').val()) == obj.Gender) {
						$('input[name="gender"][value="Male"]').attr('checked','checked');
						$('#male').attr('checked',true);
					}
					else{
						$('input[name="gender"][value="Female"]').attr('checked','checked');
						$('#female').attr('checked',true);
					}
					/*$('#pincode').val(obj.pincode);
					$("#pincode").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});*/
					$('#phone_number1').val(obj.phoneNumber1);
					$("#phone_number1").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					if (obj.phoneNumber2 != '') {
						$('#phone_number2').val(obj.phoneNumber2);
						$("#phone_number2").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					else{
						$("#phone_number2").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					$('#existing_disease').val(obj.existingDiseaseAll);
					$("#existing_disease").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});

					if (obj.otherDocument != '') {
						$('#other_document_number').val(obj.otherDocument);
						$("#other_document_number").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					else{
						$("#other_document_number").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					$('#age').val(obj.age);
					$("#age").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#first_nominee_name').val(obj.firstNomineeName);
					$("#first_nominee_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#hidden_first_nominee_member_id').val(obj.firstNomineeMemberId);
					$('#first_nominee_relation').val(obj.firstNomineeRelation);
					$("#first_nominee_relation").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#first_nominee_contact_number').val(obj.firstNomineePhoneNumber);
					$("#first_nominee_contact_number").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#first_nominee_email').val(obj.firstNomineeEmail);
					$("#first_nominee_email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#second_nominee_name').val(obj.secondNomineeName);
					$('#hidden_second_nominee_member_id').val(obj.secondNomineeMemberId);
					$("#second_nominee_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});	
					$('#second_nominee_relation').val(obj.secondNomineeRelation);
					$("#second_nominee_relation").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#second_nominee_contact_number').val(obj.secondNomineePhoneNumber);
					$("#second_nominee_contact_number").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#second_nominee_email').val(obj.secondNomineeEmail);
					$("#second_nominee_email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					
				    if (obj.sahyognidhiNotPosible == '1') {
				    	  $('#sahyognidhiNotPosible').html('').html('Sahyognidhi Request Add Not Posible');
				    	  
				    	  jQuery('#submitbutton').hide();
				    }
				   
				}
			}
		})		
	}

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
		if (t == "jpeg" && t == "jpg" && t == "png" && t == "bmp" && t == "gif" && t == "pdf") {
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

	$(document).ready(function(){
		var date = new Date();

		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();

		if (month < 10) month = "0" + month;
		if (day < 10) day = "0" + day;

		var today = day + "-" + month + "-" + year;
		$('.sahyognidhi_date').attr("value", today);
		$('#inform_date').attr("value", today);
	});

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
<script>
function getDeathDescription(value) {
	$('.death_description').show();
}
</script>
@endsection
