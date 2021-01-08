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
{{-- <style>
	.loader {
		border: 10px solid #f3f3f3;
		border-radius: 50%;
		border-top: 10px solid #3498db;
		width: 70px;
		height: 70px;
		-webkit-animation: spin 2s linear infinite; /* Safari */
		animation: spin 2s linear infinite;
	}

	/* Safari */
	@-webkit-keyframes spin {
		0% { -webkit-transform: rotate(0deg); }
		100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}
</style> --}}


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
								Edit Registration
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
						    @if($editRegistration['age'] > 18)
							<a href="{{ route('registration') }}">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
							@else
							<a href="{{ route('minor-account') }}">
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
		<form method="POST" action="{{ route('update-registration') }}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}">

			<div class="kt-portlet kt-portlet--tab">
				<div class="kt-title__head">
					<div class="kt-portlet__header">
						<h3 class="title-ktt">
							Personal Info
						</h3>
					</div>
				</div>


				<div class="main-padding">

					<div class="form-group1 m-form__group1 row">
						<label class="col-lg-2 col-form-label">Date
							<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input type="text" class="form-control" aria-describedby="emailHelp" id="today_date" name="today_date" value="{{ date('d-m-Y',strtotime($editRegistration['today_date'])) }}" >
								@if ($errors->has('today_date'))
								<span style="color: red;">
									{{ $errors->first('today_date') }}
								</span>
								@endif
							</div>
						</div>
                       <!-- readonly style="background-color: #d3d3d3;"-->
						@if($editRegistration['today_date'] < '2020-01-01')
						<div class="form-group1 m-form__group1 row getYskId">
							<label class="col-lg-2 col-form-label">Ysk Id
								<span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $editRegistration['ysk_id'] }}" placeholder="ENTER YSK ID" id="ysk_id" name="ysk_id">
									@if ($errors->has('ysk_id'))
									<span style="color: red;">
										{{ $errors->first('ysk_id') }}
									</span>
									@endif
								</div>
							</div>
						@else
						<div class="form-group1 m-form__group1 row getPreformatYskId" style="display: none;">
						<label class="col-lg-2 col-form-label">Ysk Id
							<span class="text-danger">*</span></label>
							<div class="col-lg-9">
								<input type="text" class="form-control" aria-describedby="emailHelp"  placeholder="ENTER YSK ID" id="pre_ysk_id" name="pre_ysk_id" >
								@if ($errors->has('pre_ysk_id'))
								<span style="color: red;">
									{{ $errors->first('pre_ysk_id') }}
								</span>
								@endif
							</div>
						</div>
						@endif


						<div class="form-group1 m-form__group1 row" id="familyId">
							<label class="col-lg-2 col-form-label">Family ID
								<span class="text-danger">*</span></label>
								<div class="col-lg-9">
									<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $editRegistration['family_id'] }}"
									id="family_id" name="family_id" placeholder="ENTER FAMILY ID">
									@if ($errors->has('family_id'))
									<span style="color: red;">
										{{ $errors->first('family_id') }}
									</span>
									@endif
									<span class="invalid_user" style="color: red;display: none;"></span>
								</div>
								<div class="col-lg-1">
									<img src="http://i.stack.imgur.com/FhHRx.gif" class="loader" style="display: none;">
								</div>
							</div>


							<div class="form-group1 m-form__group1 row" id="selectMember">
								<label class="col-lg-2 col-form-label">Name As Per YuvaSangh Org
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9">
									<select class="form-control kt-select2" id="member_name" name="member">
										<option disabled>Select Name</option>
										<option  value="{{ $editRegistration['member'] }}" selected="selected">{{ $editRegistration['hidden_name_as_per_yuva_sangh_org'] }}</option>
									</select>
									@if ($errors->has('member'))
									<span style="color: red;">
										{{ $errors->first('member') }}
									</span>
									@endif
								</div>
								{{-- <div class="col-lg-1">
									<img src="http://i.stack.imgur.com/FhHRx.gif" class="loaderOne" style="display: none;">
								</div> --}}
							</div>

							<div class="form-group1 m-form__group1 row" id="nameAsPerYuvaSangh">
								<label class="col-lg-2 col-form-label">Name As Per YSK Form
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9">
									<input type="text" class="form-control {{-- addname --}}" value="{{ $editRegistration['name_as_per_yuva_sangh_org'] }}" aria-describedby="emailHelp" name="name_as_per_yuva_sangh_org" placeholder="Enter Name As Per YuvaSangh Org" style="text-transform: uppercase;">
									@if ($errors->has('name_as_per_yuva_sangh_org'))
									<span style="color: red;">
										{{ $errors->first('name_as_per_yuva_sangh_org') }}
									</span>
									@endif
								</div>
							</div>

							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Region Name
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9">
									<select class="form-control kt-select2" id="region_name" name="fk_region_id" onchange="getSamajZone()">
										<option value="" selected="selected">SELECT REGION</option>
										@foreach($regionData as $valueRegionData)
										<option @if($editRegistration->fk_region_id== $valueRegionData->region_id) selected @endif value="{{ $valueRegionData->region_id }}">{{ strtoupper($valueRegionData->region_name) }}({{ $valueRegionData->region_code }})</option>
										@endforeach
									</select>
									@if ($errors->has('fk_region_id'))
									<span style="color: red;">
										{{ $errors->first('fk_region_id') }}
									</span>
									@endif
								</div>
							</div>

							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Council Name</label>
								<div class="col-lg-9">

									<select class="form-control kt-select2" id="council_name" name="fk_council_id">
										<option value="" selected="selected">SELECT COUNCIL</option>
										@foreach($councilData as $valueCouncilData)
										<option @if($editRegistration->fk_council_id== $valueCouncilData->council_id) selected @endif value="{{ $valueCouncilData->council_id }}">{{ strtoupper($valueCouncilData->name) }}({{ $valueCouncilData->code }})</option>
										@endforeach
									</select>

									@if ($errors->has('fk_council_id'))
									<span style="color: red;">
										{{ $errors->first('fk_council_id') }}
									</span>
									@endif
								</div>
							</div>

							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Yuva Mandal Name
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9 addyuvamandal">
									<select class="form-control kt-select2" id="yuva_mandal_name" name="fk_yuva_mandal_id" onchange="getYuvaMandal(this.value);">
										<option value="" selected="selected">SELECT YUVA MANDAL</option>
										@foreach($yuvaMandalData as $valueYuvaMandalData)
										<option @if($editRegistration->fk_yuva_mandal_id == $valueYuvaMandalData->yuva_mandal_number_id) selected @endif value="{{ $valueYuvaMandalData->yuva_mandal_number_id }}">{{ strtoupper($valueYuvaMandalData->yuva_mandal_number) }}</option>
										@endforeach
									</select>
									@if ($errors->has('fk_yuva_mandal_id'))
									<span style="color: red;">
										{{ $errors->first('fk_yuva_mandal_id') }}
									</span>
									@endif
								</div>
							</div>

							 <div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Division Name
								</label>
								<div class="col-lg-9 adddivision">
									<select class="form-control kt-select2" id="division_name" name="fk_division_id">
										<option value="" selected="selected">SELECT DIVISION</option>
										@foreach($divisionName as $valueDivisionName)
										<option @if($editRegistration->fk_division_id== $valueDivisionName->division_id) selected @endif value="{{ $valueDivisionName->division_id }}">{{ strtoupper($valueDivisionName->division_name) }}</option>
										@endforeach
									</select>
									@if ($errors->has('fk_division_id'))
									<span style="color: red;">
										{{ $errors->first('fk_division_id') }}
									</span>
									@endif
								</div>
							</div>

							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Samaj Zone Name
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9 addsamajzone">
									<select class="form-control kt-select2" id="samaj_zone_name" name="fk_samaj_zone_id">
										<option value="" selected="selected">SELECT SAMAJ ZONE</option>
										@foreach($samajZoneData as $valueSamajZoneData)
										<option @if($editRegistration->fk_samaj_zone_id== $valueSamajZoneData->samaj_zone_id) selected @endif value="{{ $valueSamajZoneData->samaj_zone_id }}">{{ strtoupper($valueSamajZoneData->samaj_zone_name) }}</option>
										@endforeach
									</select>
									@if ($errors->has('fk_samaj_zone_id'))
									<span style="color: red;">
										{{ $errors->first('fk_samaj_zone_id') }}
									</span>
									@endif
								</div>
							</div>


							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Member Photo
								</label>
								<div class="col-lg-9 imageBox">
				            		{{-- <input type="file" class="form-control profile-height" id="divangat_upload_image" onchange="validDivangatImage()" aria-describedby="emailHelp" name="divangat_upload_image[]" multiple> --}}

				            		<input type="file" id="photo" name="photo[]" multiple  class="form-control profile-height"   onchange="validateImage()"/>
				            		@foreach($profileDocument as $profileDocuments)
										{{-- <img src="../assets/uploads/divangat_image/{{ $profileDocuments->upload_document }}" height="100px" width="100px" />
											 <i class="fa fa-trash-o" onclick="deleteImage({{ $profileDocuments->sahyognidhi_upload_document_id }})" style="font-size: 20px;"></i> --}}
										<span class="pip">
											<img class="imageThumb" src="../assets/uploads/user_image/{{ $profileDocuments->upload_registration_document }}">
											<br/><span class="remove" onclick="deleteImage({{ $profileDocuments->registration_document_id }})">Remove image</span>
										</span>
									@endforeach
									<br>
									<small>The photo should be simple <strong>JPEG</strong>/<strong>PNG</strong> format and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
														be no cropping and filtering facility available.</small>
									<br>
									<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError"> </span>
								</div>

							</div>

							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Gender
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9">
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input type="radio" name="gender" id="addgender"  value="Male" id="male" {{ (isset($editRegistration) && $editRegistration->gender=='Male')?'checked':'' }}> Male
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="gender" id="addgender" value="Female" id="female" {{ (isset($editRegistration) && $editRegistration->gender=='Female')?'checked':'' }}> Female
											<span></span>
										</label>
									</div>
									@if ($errors->has('gender'))
									<span style="color: red;">
										{{ $errors->first('gender') }}
									</span>
									@endif
								</div>
							</div>


							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Home Address
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9">
									<textarea class="form-control addhomeaddress" id="exampleTextarea" name="home_address" rows="3" placeholder="Enter Home Address" style="text-transform: uppercase;">{{ $editRegistration['home_address'] }}</textarea>
									@if ($errors->has('home_address'))
									<span style="color: red;">
										{{ $errors->first('home_address') }}
									</span>
									@endif
								</div>
							</div>


							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Country
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9">
									<div class="row">
										<div class="col-sm-3">
											<div class="kt-radio-inline redio-mt">
												<label class="kt-radio">
													<input type="radio" name="country" value="India" {{ (isset($editRegistration) && $editRegistration->country=='India')?'checked':'' }}> India
													<span class="tablinks" onclick="openCity(event, 'abc')"></span>
												</label>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="kt-radio-inline redio-mt">
												<label class="kt-radio">
													<input type="radio" name="country" value="Overseas" {{ (isset($editRegistration) && $editRegistration->country=='Overseas')?'checked':'' }}> Overseas
													<span class="tablinks" onclick="openCity(event, 'xyz')"></span>
												</label>
											</div>
										</div>
										@if ($errors->has('country'))
										<span style="color: red;">
											{{ $errors->first('country') }}
										</span>
										@endif

										<div class="col-sm-12">
											<div id="abc" class="tabcontent">
												<div class="row">
													<div class="col-sm-12">
														<label class="col-form-label">State </label>

														<input type="text" id="state_name" class="form-control" name="india_state" value="{{ $editRegistration['fk_state_id'] }}" placeholder="Enter State" aria-describedby="emailHelp" style="text-transform: uppercase;">
														@if ($errors->has('india_state'))
														<span style="color: red;">
															{{ $errors->first('india_state') }}
														</span>
														@endif
													</div>

													<div class="col-sm-12">
														<label class="col-form-label">District</label>
														<div class="col-sm-12">
															<input type="text" id="district_name" class="form-control" name="fk_district_id" value="{{ $editRegistration['fk_district_id'] }}" placeholder="Enter State" aria-describedby="emailHelp" style="text-transform: uppercase;">
															@if ($errors->has('fk_district_id'))
															<span style="color: red;">
																{{ $errors->first('fk_district_id') }}
															</span>
															@endif
														</div>
													</div>

													<div class="col-sm-12">
														<label class="col-form-label">City</label>
														<div class="col-sm-12 addcity">
															<input type="text" id="city_name" class="form-control" name="fk_city_id" value="{{ $editRegistration['fk_city_id'] }}" placeholder="Enter State" aria-describedby="emailHelp" style="text-transform: uppercase;">
															@if ($errors->has('fk_city_id'))
															<span style="color: red;">
																{{ $errors->first('fk_city_id') }}
															</span>
															@endif
														</div>
													</div>
												</div>
											</div>

											<div id="xyz" class="tabcontent">
												<div class="row check-box">
													<div class="col-sm-12">
														<label class="col-form-label">State</label>
														<input type="text" class="form-control" name="overseas_state" value="{{ $editRegistration['overseas_state'] }}" placeholder="Enter State" aria-describedby="emailHelp" style="text-transform: uppercase;">
														@if ($errors->has('overseas_state'))
														<span style="color: red;">
															{{ $errors->first('overseas_state') }}
														</span>
														@endif
													</div>

													<div class="col-sm-12">
														<label class="col-form-label">City</label>
														<input type="text" class="form-control" name="overseas_city" value="{{ $editRegistration['overseas_city'] }}" placeholder="Enter City" aria-describedby="emailHelp" style="text-transform: uppercase;">
														@if ($errors->has('overseas_city'))
														<span style="color: red;">
															{{ $errors->first('overseas_city') }}
														</span>
														@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>



				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">Pincode
				            		<span class="text-danger">*</span>
				            	</label>
				            	<div class="col-lg-9">
				            		<input type="text" class="form-control addpincode" name="pincode" value="{{ $editRegistration['pincode'] }}" placeholder="Enter Pincode" aria-describedby="emailHelp" style="text-transform: uppercase;">
				            		@if ($errors->has('pincode'))
				            		<span style="color: red;">
				            			{{ $errors->first('pincode') }}
				            		</span>
				            		@endif
				            	</div>
				            </div>


				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">Mobile Number 1
				            		<span class="text-danger">*</span>
				            	</label>
				            	<div class="col-lg-9">
				            		<input type="text" class="form-control addphonenumber" aria-describedby="emailHelp" name="phone_number_first" value="{{ $editRegistration['phone_number_first'] }}" placeholder="Enter Phone Number" style="text-transform: uppercase;">
				            		{{-- <input type="text" class="form-control addphonenumber" id="addphonenumber" aria-describedby="emailHelp" name="phone_number_first"> --}}
				            		@if ($errors->has('phone_number_first'))
				            		<span style="color: red;">
				            			{{ $errors->first('phone_number_first') }}
				            		</span>
				            		@endif
				            	</div>
				            </div>


				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">Mobile Number 2
				            	</label>
				            	<div class="col-lg-9">
				            		<input type="text" class="form-control" aria-describedby="emailHelp" name="phone_number_second" value="{{ $editRegistration['phone_number_second'] }}" placeholder="Enter Phone Number" style="text-transform: uppercase;">
				            	</div>
				            </div>


				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">Email
				            	</label>
				            	<div class="col-lg-9">
				            		<input type="email" class="form-control" aria-describedby="emailHelp" name="email" value="{{ $editRegistration['email'] }}" placeholder="Enter Email Id">
				            		@if ($errors->has('email'))
				            		<span style="color: red;">
				            			{{ $errors->first('email') }}
				            		</span>
				            		@endif
				            	</div>
				            </div>

				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">Existing Disease</label>
				            	<div class="col-lg-9">
				            		<select class="form-control kt-select2" id="fk_existing_disease" name="fk_existing_disease[]" multiple="multiple">
				            			<?php $ex = explode(',', $editRegistration->fk_existing_disease) ?>
				            			@foreach($existing_disease as $valueExistingDisease)
				            			@php $selected_val = '' @endphp
				            			@if(in_array($valueExistingDisease->disease_id, $ex))
				            			@php $selected_val = 'selected' @endphp
				            			@endif
				            			<option {{ $selected_val }} value="{{ $valueExistingDisease->disease_id }}">{{ $valueExistingDisease->disease_name }}</option>
				            			@endforeach
				            		</select>
				            		@if ($errors->has('fk_existing_disease'))
				            		<span style="color: red;">
				            			{{ $errors->first('fk_existing_disease') }}
				            		</span>
				            		@endif
				            	</div>
				            </div>


				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">YSK Registration Image
				            	</label>
				            	<div class="col-lg-9 imageBox">
				            		{{-- <input type="file" class="form-control profile-height" id="divangat_upload_image" onchange="validDivangatImage()" aria-describedby="emailHelp" name="divangat_upload_image[]" multiple> --}}

				            		<input type="file" id="yskregistrationimage" name="ysk_registration_image[]" multiple  class="form-control profile-height"   onchange="validateYskRegistrationImage()" target="_blank"/>
				            		@foreach($yskImage as $yskImages)
				            		@if($yskImages->upload_document_extension == 'pdf')
				            		<span class="pip">
				            		<a href="../assets/uploads/ysk_registration_image/{{ $yskImages->upload_registration_document }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a>
				            		<br/><span class="remove" onclick="deleteImage({{ $yskImages->registration_document_id }})">Remove image</span>
				            	    </span>
										{{-- <img src="../assets/uploads/divangat_image/{{ $yskImages->upload_document }}" height="100px" width="100px" />
											 <i class="fa fa-trash-o" onclick="deleteImage({{ $yskImages->sahyognidhi_upload_document_id }})" style="font-size: 20px;"></i> --}}
									@else
										<span class="pip">
											<img class="imageThumb" src="../assets/uploads/ysk_registration_image/{{ $yskImages->upload_registration_document }}">
											<br/><span class="remove" onclick="deleteImage({{ $yskImages->registration_document_id }})">Remove image</span>
										</span>
									@endif
									@endforeach
									<br>
									<small>The photo should be simple <strong>JPEG</strong>/<strong>PNG</strong>/<strong>PDF</strong> format and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
														be no cropping and filtering facility available.</small>
									<br>
									<span style="color: red; display: none; " class="text-danger db m-b-20" id="erroryskregistrationimage"> </span>
								</div>

				            </div>

				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">Aadhar Card Number
				            	</label>
				            	<div class="col-lg-9">
				            		<input type="text" class="form-control" value="{{ $editRegistration['aadhar_card_number'] }}" aria-describedby="emailHelp" name="aadhar_card_number" id="aadhar_card_number" onchange ="aadharValidation()" placeholder="ENTER AADHAR CARD NUMBER">
				            		@if ($errors->has('aadhar_card_number'))
				            		<span style="color: red;">
				            			{{ $errors->first('aadhar_card_number') }}
				            		</span>
				            		@endif
				            		<span id="addharValidationMessage" style="display: none;color: red;"></span>
				            	</div>
				            </div>

				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">Aadhar Card Image <br>Upload
				            	</label>
				            	<div class="col-lg-9 imageBox">
				            		{{-- <input type="file" class="form-control profile-height" id="divangat_upload_image" onchange="validDivangatImage()" aria-describedby="emailHelp" name="divangat_upload_image[]" multiple> --}}

				            		<input type="file" id="aadhar_card_photo" name="aadhar_card_photo[]" multiple  class="form-control profile-height"   onchange="validateAadharImage()"/>
				            		@foreach($aadharDocument as $aadharDocuments)
				            		@if($aadharDocuments->upload_document_extension == 'pdf')
				            		<span class="pip">
				            		<a href="../assets/uploads/aadhar_image/{{ $aadharDocuments->upload_registration_document }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a>
				            		<br/><span class="remove" onclick="deleteImage({{ $aadharDocuments->registration_document_id }})">Remove image</span>
				            	    </span>
										{{-- <img src="../assets/uploads/divangat_image/{{ $aadharDocuments->upload_document }}" height="100px" width="100px" />
											 <i class="fa fa-trash-o" onclick="deleteImage({{ $aadharDocuments->sahyognidhi_upload_document_id }})" style="font-size: 20px;"></i> --}}
									@else
										<span class="pip">
											<img class="imageThumb" src="../assets/uploads/aadhar_image/{{ $aadharDocuments->upload_registration_document }}">
											<br/><span class="remove" onclick="deleteImage({{ $aadharDocuments->registration_document_id }})">Remove image</span></span>
									@endif
									@endforeach
									<br>
									<small>The photo should be simple <strong>JPEG</strong>/<strong>PNG</strong>/<strong>PDF</strong> format and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
														be no cropping and filtering facility available.</small>
									<br>
									<span style="color: red; display: none; " class="text-danger db m-b-20" id="aadharImgError"> </span>
								</div>
				            </div>



				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">Other Document Name & Number
				            	</label>
				            	<div class="col-lg-9">
				            		<input type="text" class="form-control" value="{{ $editRegistration['other_document_number'] }}" aria-describedby="emailHelp" name="other_document_number" id="other_document_number" placeholder="ENTER OTHER DOCUMENT NUMBER">
				            	</div>
				            </div>

				            <div class="form-group1 m-form__group1 row">
				            	<label class="col-lg-2 col-form-label">Other Document Photo
				            	</label>
				            	<div class="col-lg-9 imageBox">
				            		{{-- <input type="file" class="form-control profile-height" id="divangat_upload_image" onchange="validDivangatImage()" aria-describedby="emailHelp" name="divangat_upload_image[]" multiple> --}}

				            		<input type="file" id="otherDocumentImage" name="other_document_photo[]" multiple  class="form-control profile-height"   onchange="validateOtherDocumentImage()"/>
				            		@foreach($otherDocument as $otherDocuments)
				            		@if($otherDocuments->upload_document_extension == 'pdf')
				            		<span class="pip">
				            		<a href="../assets/uploads/proof_image/{{ $otherDocuments->upload_registration_document }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a>
				            		<br/><span class="remove" onclick="deleteImage({{ $otherDocuments->registration_document_id }})">Remove image</span>
				            	    </span>
										{{-- <img src="../assets/uploads/divangat_image/{{ $otherDocuments->upload_document }}" height="100px" width="100px" />
											 <i class="fa fa-trash-o" onclick="deleteImage({{ $otherDocuments->sahyognidhi_upload_document_id }})" style="font-size: 20px;"></i> --}}
									@else
										<span class="pip">
											<img class="imageThumb" src="../assets/uploads/proof_image/{{ $otherDocuments->upload_registration_document }}">
											<br/><span class="remove" onclick="deleteImage({{ $otherDocuments->registration_document_id }})">Remove image</span>
										</span>
									@endif
									@endforeach
									<br>
									<small>The photo should be simple <strong>JPEG</strong>/<strong>PNG</strong>/<strong>PDF</strong> format and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
														be no cropping and filtering facility available.</small>
									<br>
									<span style="color: red; display: none; " class="text-danger db m-b-20" id="otherDocumentImgError"> </span>
								</div>
							</div>


							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Date of Birth
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9">
									<input type="text" class="form-control reg_date adddateofbirth" value="@if($editRegistration->date_of_birth != '0000-00-00') {{ date("d-m-Y",strtotime($editRegistration->date_of_birth)) }} @endif" name="date_of_birth" placeholder="ENTER DATE OF BIRTH" onchange ="findAge(this.value)">
									@if ($errors->has('date_of_birth'))
									<span style="color: red;">
										{{ $errors->first('date_of_birth') }}
									</span>
									@endif
								</div>
							</div>

							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Age
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9">
									<input type="text" class="form-control adddage" value="{{ $editRegistration['age'] }}" name="age" placeholder="ENTER AGE" readonly style="background-color: #d3d3d3;">
									@if ($errors->has('age'))
									<span style="color: red;">
										{{ $errors->first('age') }}
									</span>
									@endif
									<span class="errorGreaterAge" style="color: red;display: none;">Your age is greater 55.</span>
								</div>
							</div>
							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">Registration amount
									<span class="text-danger">*</span>
								</label>
								<div class="col-lg-9">
									<input type="text" class="form-control addregistrationfees" aria-describedby="emailHelp" name="registration_amount" value="{{ $editRegistration['registration_amount'] }}" placeholder="ENTER YSK MEMBERSHIP AMOUNT" readonly style="background-color: #d3d3d3;">
									@if ($errors->has('registration_amount'))
									<span style="color: red;">
										{{ $errors->first('registration_amount') }}
									</span>
									@endif
								</div>
							</div>

							<div class="kt-title__head">
								<div class="kt-portlet__header">
									<h3 class="title-ktt">
										Payment Details:
									</h3>
								</div>
							</div>
							<div class="main-padding">
								<div class="form-group1 m-form__group1 row">
									<label class="col-lg-2 col-form-label">Bank Name
									</label>
									<div class="col-lg-9">
										<select class="form-control kt-select2" id="reg_bank_name" name="reg_bank_name">
											<option selected>SELECT BANK NAME</option>
											@foreach($bankName as $bankNames)
											<option @if($editRegistrationPayment->fk_reg_bank_name == $bankNames->ledger_account_id) selected @endif value="{{ $bankNames->ledger_account_id }}">{{ $bankNames->legder_name }}</option>
											@endforeach
										</select>
										@if ($errors->has('reg_bank_name'))
										<span style="color: red;">
											{{ $errors->first('reg_bank_name') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group1 m-form__group1 row">
									<label class="col-lg-2 col-form-label">Amount
									</label>
									<div class="col-lg-9">
										<input type="text" class="form-control addregistrationfees" id="bank_amount" name="bank_amount" value="{{$editRegistrationPayment['bank_amount'] }}" placeholder="ENTER AMOUNT" aria-describedby="emailHelp" readonly style="background-color: #d3d3d3;">
										@if ($errors->has('bank_amount'))
										<span style="color: red;">
											{{ $errors->first('bank_amount') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group1 m-form__group1 row">
									<label class="col-lg-2 col-form-label">YSK Member Bank Name
									</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" id="ysk_member_bank_name" name="ysk_member_bank_name" value="{{ $editRegistrationPayment['ysk_member_bank_name'] }}" placeholder="Enter Ysk Member Bank Name" aria-describedby="emailHelp" style="text-transform: uppercase;">
										@if ($errors->has('ysk_member_bank_name'))
										<span style="color: red;">
											{{ $errors->first('ysk_member_bank_name') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group1 m-form__group1 row">
									<label class="col-lg-2 col-form-label">Branch Name
									</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" id="branch_name" name="branch_name" value="{{ $editRegistrationPayment['branch_name'] }}" placeholder="Enter Branch Name" aria-describedby="emailHelp" style="text-transform: uppercase;">
										@if ($errors->has('branch_name'))
										<span style="color: red;">
											{{ $errors->first('branch_name') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group1 m-form__group1 row">
									<label class="col-lg-2 col-form-label">Check Numebr
									</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" id="cheque_number" name="cheque_number" value="@if($editRegistrationPayment['cheque_number'] != ''){{ $editRegistrationPayment['cheque_number'] }} @endif" placeholder="Enter Check Number" aria-describedby="emailHelp">
										@if ($errors->has('cheque_number'))
										<span style="color: red;">
											{{ $errors->first('cheque_number') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group1 m-form__group1 row">
									<label class="col-lg-2 col-form-label">Narration
									</label>
									<div class="col-lg-9">
										<textarea class="form-control" id="narration" name="narration" placeholder="Enter Details" rows="4" cols="5" style="text-transform: uppercase;">{{ $editRegistrationPayment['narration'] }}</textarea>
										@if ($errors->has('narration'))
										<span style="color: red;">
											{{ $errors->first('narration') }}
										</span>
										@endif
									</div>
								</div>
							</div>

						</div>



						<div class="kt-title__head">
							<div class="kt-portlet__header">
								<h3 class="title-ktt">
									Nominee Details:
								</h3>
							</div>
						</div>

						<div class="main-padding">
							<div class="form-group1 m-form__group1 row">
								<label class="col-lg-2 col-form-label">First Nominee Family Id
								</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="first_nominee_family_id" name="first_nominee_family_id" placeholder="ENTER FIRST NOMINEE FAMILY ID" aria-describedby="emailHelp" value="@if($nomineeData['first_nominee_family_id'] != '0'){{ $nomineeData['first_nominee_family_id'] }} @endif" onchange="nomineeCallApi1(this.value)">
									@if ($errors->has('first_nominee_family_id'))
									<span style="color: red;">
										{{ $errors->first('first_nominee_family_id') }}
									</span>
									@endif
									<span class="first_nominee_invalid_user" style="color: red;display: none;"></span>
								</div>
							</div>

							<div class="form-group1 m-form__group1 row" id="selectMember">
								<label class="col-lg-2 col-form-label">First Nominee
								</label>
								<div class="col-lg-9">
									<select class="form-control kt-select2" id = "first_nominee_member_id" onchange="getFirstNomineeName(this.value)" name = "first_nominee_member_id">
										@if($nomineeData['first_nominee_member_id'] != '0')
										<option value="" selected="selected">SELECT NOMINEE</option>
										<option  value="{{ $nomineeData['first_nominee_member_id'] }}" selected>{{ $nomineeData['first_nominee_name'] }}({{ $nomineeData['first_nominee_member_id'] }})</option>
										@else
										<option value="" selected="selected">SELECT NOMINEE</option>
										@endif
									</select>
									@if ($errors->has('first_nominee_member_id'))
									<span style="color: red;">
										{{ $errors->first('first_nominee_member_id') }}
									</span>
									@endif
								</div>
							{{-- <div class="col-lg-1">
								<img src="http://i.stack.imgur.com/FhHRx.gif" class="loaderOne" style="display: none;">
							</div> --}}
						</div>

						<div class="form-group1 m-form__group1 row">
							<label class="col-lg-2 col-form-label">First Nominee Name
							</label>
							<div class="col-lg-9">
								<input type="text" id="first_nominee_name" class="form-control" name="first_nominee_name" value="{{ $nomineeData['first_nominee_name'] }}" placeholder="Enter First Nominee Name" aria-describedby="emailHelp" readonly style="background-color: #d3d3d3;text-transform: uppercase;">
								@if ($errors->has('first_nominee_name'))
								<span style="color: red;">
									{{ $errors->first('first_nominee_name') }}
								</span>
								@endif
								<span id="firstNomineeError" style="display: none; color: red;">Member cannot be a nominee.Select other.</span>
							</div>
						</div>

						<div class="form-group1 m-form__group1 row">
							<label class="col-lg-2 col-form-label">First Nominee Relation
							</label>
							<div class="col-lg-9">
								<select class="form-control kt-select2" id = "first_nominee_relation" name = "first_nominee_relation">
									<option value="" selected="selected">SELECT NOMINEE RELATION</option>
									<option value="FATHER" @if($nomineeData['first_nominee_relation'] == 'FATHER') selected @endif>FATHER</option>
									<option value="MOTHER" @if($nomineeData['first_nominee_relation'] == 'MOTHER') selected @endif>MOTHER</option>
									<option value="BROTHER" @if($nomineeData['first_nominee_relation'] == 'BROTHER') selected @endif>BROTHER</option>
									<option value="SISTER" @if($nomineeData['first_nominee_relation'] == 'SISTER') selected @endif>SISTER</option>
									<option value="SON" @if($nomineeData['first_nominee_relation'] == 'SON') selected @endif>SON</option>
									<option value="DAUGHTER" @if($nomineeData['first_nominee_relation'] == 'DAUGHTER') selected @endif>DAUGHTER</option>
									<option value="HUSBAND" @if($nomineeData['first_nominee_relation'] == 'HUSBAND') selected @endif>HUSBAND</option>
									<option value="WIFE" @if($nomineeData['first_nominee_relation'] == 'WIFE') selected @endif>WIFE</option>
									<option value="SISTER IN LAW" @if($nomineeData['first_nominee_relation'] == 'SISTER IN LAW') selected @endif>SISTER IN LAW</option>
									<option value="MOTHER IN LAW" @if($nomineeData['first_nominee_relation'] == 'MOTHER IN LAW') selected @endif>MOTHER IN LAW</option>
									<option value="FATHER IN LAW" @if($nomineeData['first_nominee_relation'] == 'FATHER IN LAW') selected @endif>FATHER IN LAW</option>
									<option value="BROTHER IN LAW" @if($nomineeData['first_nominee_relation'] == 'BROTHER IN LAW') selected @endif>BROTHER IN LAW</option>
									<option value="UNCLE" @if($nomineeData['first_nominee_relation'] == 'UNCLE') selected @endif>UNCLE</option>
									<option value="AUNT" @if($nomineeData['first_nominee_relation'] == 'AUNT') selected @endif>AUNT</option>
									<option value="GRAND FATHER" @if($nomineeData['first_nominee_relation'] == 'GRAND FATHER') selected @endif>GRAND FATHER</option>
									<option value="GRAND MOTHER" @if($nomineeData['first_nominee_relation'] == 'GRAND MOTHER') selected @endif>GRAND MOTHER</option>
								</select>
								{{-- <input type="text" class="form-control" name="first_nominee_relation" value="{{ $nomineeData['first_nominee_relation'] }}" placeholder="First Nominee Relation" aria-describedby="emailHelp" style="text-transform: uppercase;"> --}}
								@if ($errors->has('first_nominee_relation'))
								<span style="color: red;">
									{{ $errors->first('first_nominee_relation') }}
								</span>
								@endif
							</div>
						</div>

						<div class="form-group1 m-form__group1 row">
							<label class="col-lg-2 col-form-label">Second Nominee Family Id
							</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="second_nominee_family_id" name="second_nominee_family_id" value="@if($nomineeData['second_nominee_family_id'] != '0') {{ $nomineeData['second_nominee_family_id'] }} @endif" placeholder="Enter Second Nominee Family Id" aria-describedby="emailHelp" onchange="nomineeCallApi2(this.value)">
								@if ($errors->has('second_nominee_family_id'))
								<span style="color: red;">
									{{ $errors->first('second_nominee_family_id') }}
								</span>
								@endif
								<span class="second_nominee_invalid_user" style="color: red;display: none;"></span>
							</div>
						</div>

						<div class="form-group1 m-form__group1 row" id="selectMember">
							<label class="col-lg-2 col-form-label">Second Nominee
							</label>
							<div class="col-lg-9">
								<select class="form-control kt-select2" id = "second_nominee_member_id" onchange="getSecondNomineeName(this.value)" name = "second_nominee_member_id">
									@if($nomineeData['second_nominee_member_id'] != '0')
									<option value="" selected="selected">SELECT NOMINEE</option>
									<option  value="{{ $nomineeData['second_nominee_member_id'] }}" selected>{{ $nomineeData['second_nominee_name'] }}({{ $nomineeData['second_nominee_member_id'] }})</option>
									@else
									<option value="" selected="selected">SELECT NOMINEE</option>
									@endif
								</select>
								@if ($errors->has('second_nominee_member_id'))
								<span style="color: red;">
									{{ $errors->first('second_nominee_member_id') }}
								</span>
								@endif
							</div>
							{{-- <div class="col-lg-1">
								<img src="http://i.stack.imgur.com/FhHRx.gif" class="loaderOne" style="display: none;">
							</div> --}}
						</div>


						<div class="form-group1 m-form__group1 row">
							<label class="col-lg-2 col-form-label">Second Nominee Name
							</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="second_nominee_name" name="second_nominee_name" value="{{ $nomineeData['second_nominee_name'] }}" placeholder="Enter Second Nominee Name" aria-describedby="emailHelp" readonly style="background-color: #d3d3d3;text-transform: uppercase;">
								@if ($errors->has('second_nominee_name'))
								<span style="color: red;">
									{{ $errors->first('second_nominee_name') }}
								</span>
								@endif
								<span id="nomineeError" style="display: none; color: red;">Member cannot be a nominee.Select other.</span>
							</div>
						</div>


						<div class="form-group1 m-form__group1 row">
							<label class="col-lg-2 col-form-label">Second Nominee Relation
							</label>
							<div class="col-lg-9">
								<select class="form-control kt-select2" id = "second_nominee_relation" name = "second_nominee_relation">
									<option value="" selected="selected">SELECT NOMINEE RELATION</option>
									<option value="FATHER" @if($nomineeData['second_nominee_relation'] == 'FATHER') selected @endif>FATHER</option>
									<option value="MOTHER" @if($nomineeData['second_nominee_relation'] == 'MOTHER') selected @endif>MOTHER</option>
									<option value="BROTHER" @if($nomineeData['second_nominee_relation'] == 'BROTHER') selected @endif>BROTHER</option>
									<option value="SISTER" @if($nomineeData['second_nominee_relation'] == 'SISTER') selected @endif>SISTER</option>
									<option value="SON" @if($nomineeData['second_nominee_relation'] == 'SON') selected @endif>SON</option>
									<option value="DAUGHTER" @if($nomineeData['second_nominee_relation'] == 'DAUGHTER') selected @endif>DAUGHTER</option>
									<option value="HUSBAND" @if($nomineeData['second_nominee_relation'] == 'HUSBAND') selected @endif>HUSBAND</option>
									<option value="WIFE" @if($nomineeData['second_nominee_relation'] == 'WIFE') selected @endif>WIFE</option>
									<option value="SISTER IN LAW" @if($nomineeData['second_nominee_relation'] == 'SISTER IN LAW') selected @endif>SISTER IN LAW</option>
									<option value="MOTHER IN LAW" @if($nomineeData['second_nominee_relation'] == 'MOTHER IN LAW') selected @endif>MOTHER IN LAW</option>
									<option value="FATHER IN LAW" @if($nomineeData['second_nominee_relation'] == 'FATHER IN LAW') selected @endif>FATHER IN LAW</option>
									<option value="BROTHER IN LAW" @if($nomineeData['second_nominee_relation'] == 'BROTHER IN LAW') selected @endif>BROTHER IN LAW</option>
									<option value="UNCLE" @if($nomineeData['second_nominee_relation'] == 'UNCLE') selected @endif>UNCLE</option>
									<option value="AUNT" @if($nomineeData['second_nominee_relation'] == 'AUNT') selected @endif>AUNT</option>
									<option value="GRAND FATHER" @if($nomineeData['second_nominee_relation'] == 'GRAND FATHER') selected @endif>GRAND FATHER</option>
									<option value="GRAND MOTHER" @if($nomineeData['second_nominee_relation'] == 'GRAND MOTHER') selected @endif>GRAND MOTHER</option>
								</select>
								{{-- <input type="text" class="form-control" name="second_nominee_relation" value="{{ $nomineeData['second_nominee_relation'] }}" placeholder="Enter Second Nominee Relation" aria-describedby="emailHelp" style="text-transform: uppercase;"> --}}
								@if ($errors->has('second_nominee_relation'))
								<span style="color: red;">
									{{ $errors->first('second_nominee_relation') }}
								</span>
								@endif
							</div>
						</div>

					</div>

                    <input type="hidden" name="editId" value="{{ $editRegistration['registration_id'] }}">
                    <div class="kt-title__head">
                    	<div class="kt-portlet__header">
                    	</div>
                    </div>

					<div class="main-padding">
						<div class="form-group1 m-form__group1 row">
							<label class="col-lg-2 col-form-label"></label>
							<div class="col-lg-9">
								<div class="kt-portlet__head-toolbar">
									<div class="kt-portlet__head-wrapper">
										<div class="kt-portlet__head-actions">
											<input type="submit" name="submit" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" value="  Edit  ">
											@if($editRegistration['age'] > 18)
											    <a href="{{ route('registration') }}" class="btn-cancel-registration">Cancel</a>
											@else
											    <a href="{{ route('minor-account') }}" class="btn-cancel-registration">Cancel</a>
											@endif

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!--end::Portlet-->
		</div>
	</div>
@endsection
@section('content_js')
<script>
	$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#aadhar_card_photo").on("change", function(e) {
      var fp = $("#aadhar_card_photo");
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
					            "</span>").insertAfter("#aadhar_card_photo");
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
					            "</span>").insertAfter("#aadhar_card_photo");
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
	$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#yskregistrationimage").on("change", function(e) {
      var fp = $("#yskregistrationimage");
      var items = fp[0].files;
      var files = e.target.files,
        filesLength = files.length;
		    for (var i = 0; i < filesLength; i++) {
		    	var t = items[i].type.split('/').pop().toLowerCase();
		        var f = files[i]
		     	var name = "http://eysk.org/assets/img/pdf.png";
		        var fileReader = new FileReader();
		        if (t != 'pdf') {
			        fileReader.onload = (function(e) {
			          var file = e.target;
			          	 $("<span class=\"pip\">" +
					            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
					            "<br/><span class=\"remove\">Remove image</span>" +
					            "</span>").insertAfter("#yskregistrationimage");
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
					            "</span>").insertAfter("#yskregistrationimage");
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
	$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#photo").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
		    for (var i = 0; i < filesLength; i++) {
		        var f = files[i]
		     	var name = "http://localhost/digital_book_printing/assets/images/logos/My-book-printer.png";
		        var fileReader = new FileReader();
		        fileReader.onload = (function(e) {
		          var file = e.target;
		          	 $("<span class=\"pip\">" +
				            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
				            "<br/><span class=\"remove\">Remove image</span>" +
				            "</span>").insertAfter("#photo");
				          $(".remove").click(function(){
				            $(this).parent(".pip").remove();
				          });

		        });
		        fileReader.readAsDataURL(f);
		    }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>
<script>
	$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#otherDocumentImage").on("change", function(e) {
      var fp = $("#otherDocumentImage");
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
					            "</span>").insertAfter("#otherDocumentImage");
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
					            "</span>").insertAfter("#otherDocumentImage");
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
	function myFunction() {
		var checkBox = document.getElementById("myCheck");
		var text = document.getElementById("text");
		if (checkBox.checked == true){
			text.style.display = "block";
		} else {
			text.style.display = "none";
		}
	}
</script>
<script>
	function myFunction() {
		var x = document.getElementById("myDIV");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
</script>

<script>
	function openCity(evt, cityName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}
</script>
<script>

	 function getSamajZone() {
	 	var regionID = $('#region_name').val();
	 	if(regionID){
	 		$.ajax({
	 			type:"POST",
	 			url:"{{ route('get-samaj-zone-by-region-id') }}",
	 			data:{region_id:regionID,_token:"{{ csrf_token() }}"},
	 			success: function(response){
	 				var obj = JSON.parse(response);
	 				if(obj.success == 1){
	 					$(".addsamajzone").html(obj.html_data);
	 					$("#samaj_zone_name").select2();
	 					$(".adddivision").html(obj.html_data_division);
	 					$("#division_name").select2();
	 				}
	 			}
	 		});
	 	}
	 }


	function getYuvaMandal(yuvamandalId) {
	 	if(yuvamandalId){
	 		$.ajax({
	 			type:"POST",
	 			url:"{{ route('get-yuva-mandal-number-by-samaj-zone') }}",
	 			data:{fk_yuva_mandal_id:yuvamandalId,_token:"{{ csrf_token() }}"},
	 			success: function(response){
	 				var obj = JSON.parse(response);
	 				if(obj.success == 1){
	 					$(".addsamajzone").html(obj.html_data);
	 					$("#samaj_zone_name").select2();
	 					$(".adddivision").html(obj.html_data1);
	 					$("#division_name").select2();
	 				}
	 			}
	 		});
	 	}
	 }

</script>
<script>
	$("#region_name").select2();
	$("#samaj_zone_name").select2();
	$("#yuva_mandal_name").select2();
	$("#kt_select2_12").select2();
	$("#member_name").select2();
	$("#first_nominee_member_id").select2();
	$("#second_nominee_member_id").select2();
	$("#fk_existing_disease").select2();
	$("#fk_taluka_id").select2();
	$("#council_name").select2();
</script>

<script>

		function nomineeCallApi1(familyId) {
				//$('.loader').show();
				$.ajax({
					type:"POST",
					url:"{{ route('get-data-by-first-nominee-family-id') }}",
					data:{first_nominee_family_id:familyId,_token:"{{ csrf_token() }}"},
					success: function(response){
						var obj = JSON.parse(response);
						if(obj.success == 1){
							$("#first_nominee_member_id").html(obj.html_data);
							$("#first_nominee_member_id").select2();
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
			var nomineeFamilyId = $('#first_nominee_family_id').val();
			var memberId = $('#member_name').val();
			//alert(memberId);
			$.ajax({
				url: '{{ route('get-first-nominee-data') }}',
				type: 'POST',
				data: {member:memberId,first_nominee_family_id: nomineeFamilyId,first_nominee_member_id:value,_token:"{{ csrf_token() }}"},
				success:function (response) {
					var obj = JSON.parse(response);
					if (obj.success = 1) {
						if (obj.MemberID != obj.firstNomineeId) {
							$('#first_nominee_name').val(obj.Name);
							$('#firstNomineeError').hide();
						}
						else{
							$('#first_nominee_name').val(null);
							$('#firstNomineeError').show();
						}
					}
				}
			})
		}


		function getSecondNomineeName(value) {
			var nomineeFamilyId = $('#second_nominee_family_id').val();
			var memberId = $('#member_name').val();
			$.ajax({
				url: '{{ route('get-second-nominee-data') }}',
				type: 'POST',
				data: {member:memberId,second_nominee_family_id: nomineeFamilyId,second_nominee_member_id:value,_token:"{{ csrf_token() }}"},
				success:function (response) {
					var obj = JSON.parse(response);
					if (obj.success = 1) {
						if (obj.MemberID != obj.secondNomineeId) {
							$('#second_nominee_name').val(obj.Name);
							$('#nomineeError').hide();
						}
						else{
							$('#second_nominee_name').val(null);
							$('#nomineeError').show();
						}
					}
				}
			})
		}

		function nomineeCallApi2(familyId) {
			//$('.loader').show();

			$.ajax({
				type:"POST",
				url:"{{ route('get-data-by-second-nominee-family-id') }}",
				data:{second_nominee_family_id:familyId,_token:"{{ csrf_token() }}"},
				success: function(response){
					var obj = JSON.parse(response);
					if(obj.success == 1){
						$("#second_nominee_member_id").html(obj.html_data);
						$("#second_nominee_member_id").select2();
						$('.second_nominee_invalid_user').hide();
					//$('.loader').hide();
				}
				else{
					$('.second_nominee_invalid_user').html(obj.message);
					$('.second_nominee_invalid_user').show();
						//$('.loader').hide();
					}
				}
			});
		}


		function findAge(date_of_birth) {
			var date = $('#today_date').val();
			$.ajax({
				url: '{{ route('find-age') }}',
				type: 'POST',
				data: {date_of_birth:date_of_birth,today_date:date,_token:"{{ csrf_token() }}"},
				success:function(response) {
					var obj = JSON.parse(response);
					if(obj.success == 1){
						if (obj.html_registration_fees == '') {
							$(".adddage").val(obj.html_data);
							$(".addregistrationfees").val('');
							$(".errorGreaterAge").show();
						}else{
							$(".errorGreaterAge").hide();
							$(".adddage").val(obj.html_data);
							$(".addregistrationfees").val(obj.html_registration_fees);
						}
					}
				}
			})
		}

		function validateImage(argument) {
			var formData = new FormData();
			var file = document.getElementById('photo').files[0];
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
				$("#imgError").html("Extension File is Not Valid");
				$("#imgError").css("display", "block");
				document.getElementById("photo").value = '';
				return false;
			}
			if (t == "jpeg" || t == "jpg" || t == "png" || t == "bmp" || t == "gif") {
				$("#imgError").hide();
			}
			if (Math.round(file.size/1024) > 500) {
				$("#imgError").html("Max Upload size is 500kb only");
				$("#imgError").css("display", "block");
				document.getElementById("photo").value = '';
				return false;
			}
			else{
			    $("#imgError").hide();
			}
			return true;
		}

		function validateAadharImage(argument) {
			var formData = new FormData();
			var file = document.getElementById('aadhar_card_photo').files[0];
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {
				$("#aadharImgError").html("Extension File is Not Valid");
				$("#aadharImgError").css("display", "block");
				document.getElementById("aadhar_card_photo").value = '';
				return false;
			}
			if (t == "jpeg" || t == "jpg" || t == "png" || t == "bmp" || t == "gif" || t != "pdf") {
				$("#aadharImgError").hide();
			}
			if (Math.round(file.size/1024) > 500) {
				$("#aadharImgError").html("Max Upload size is 500kb only");
				$("#aadharImgError").css("display", "block");
				document.getElementById("aadhar_card_photo").value = '';
				return false;
			}
			else{
			    $("#aadharImgError").hide();
			}
			return true;
		}

		function validateOtherDocumentImage(argument) {
			var formData = new FormData();
			var file = document.getElementById('otherDocumentImage').files[0];
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {
				$("#otherDocumentImgError").html("Extension File is Not Valid");
				$("#otherDocumentImgError").css("display", "block");
				document.getElementById("otherDocumentImage").value = '';
				return false;
			}
			if (t == "jpeg" || t == "jpg" || t == "png" || t == "bmp" || t == "gif" || t != "pdf") {
				$("#otherDocumentImgError").hide();
			}
			if (Math.round(file.size/1024) > 500) {
				$("#otherDocumentImgError").html("Max Upload size is 500kb only");
				$("#otherDocumentImgError").css("display", "block");
				document.getElementById("otherDocumentImage").value = '';
				return false;
			}
			else{
			    $("#otherDocumentImgError").hide();
			}
			return true;
		}


		function validateYskRegistrationImage(argument) {
			var formData = new FormData();
			var file = document.getElementById('yskregistrationimage').files[0];
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {
				$("#erroryskregistrationimage").html("Extension File is Not Valid");
				$("#erroryskregistrationimage").css("display", "block");
				document.getElementById("yskregistrationimage").value = '';
				return false;
			}
			if (t == "jpeg" || t == "jpg" || t == "png" || t == "bmp" || t == "gif" || t != "pdf") {
				$("#erroryskregistrationimage").hide();
			}
			if (Math.round(file.size/1024) > 500) {
				$("#erroryskregistrationimage").html("Max Upload size is 500kb only");
				$("#erroryskregistrationimage").css("display", "block");
				document.getElementById("yskregistrationimage").value = '';
				return false;
			}
			else{
			    $("#erroryskregistrationimage").hide();
			}
			return true;
		}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
	$('.reg_date').mask('00-00-0000');
	$('#reg_bank_name').select2();
	$('#division_name').select2();
	$('#first_nominee_relation').select2();
	$('#second_nominee_relation').select2();

	function deleteImage(id) {
		$.ajax({
			url: '{{ route('delete-upload-document','id') }}',
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
</script>
<script>
    $('#region_name').on('change',function(){
        var region_name = $(this).val();
        //alert(region_name);
        if(region_name){
            $.ajax({
                type:"POST",
                url:'{{url('/getregion')}}' ,
                data:{'region_name':region_name,
                    _token:"{{ csrf_token() }}" },
                success:function(res){
                    if(res){
                        $("#division_name").empty();
                        $.each(res,function(key,value){
                            $("#division_name").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#division_name").empty();
                    }
                }
            });
        }else{
            $("#division_name").empty();
        }

    });
    $('#region_name').on('change',function(){
        var region_name = $(this).val();
        //alert(region_name);
        if(region_name){
            $.ajax({
                type:"POST",
                url:'{{url('/getdivision')}}' ,
                data:{'region_name':region_name,
                    _token:"{{ csrf_token() }}" },
                success:function(res){
                    if(res){
                        $("#samajzone_name").empty();
                        $.each(res,function(key,value){
                            $("#samajzone_name").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#samajzone_name").empty();
                    }
                }
            });
        }else{
            $("#samajzone_name").empty();
        }

    });
    $('#region_name').on('change',function(){
        var region_name = $(this).val();
        //alert(region_name);
        if(region_name){
            $.ajax({
                type:"POST",
                url:'{{url('/getyuvamandal_name')}}' ,
                data:{'region_name':region_name,
                    _token:"{{ csrf_token() }}" },
                success:function(res){
                    if(res){
                        $("#yuva_mandal_name").empty();
                        $.each(res,function(key,value){
                            $("#yuva_mandal_name").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#yuva_mandal_name").empty();
                    }
                }
            });
        }else{
            $("#yuva_mandal_name").empty();
        }

    });

</script>

<script>
    $('#region_name').on('change',function(){
        var region_name = $(this).val();
        //alert(region_name);
        if(region_name){
            $.ajax({
                type:"POST",
                url:'{{url('/getcouncilname')}}' ,
                data:{'region_name':region_name,
                    _token:"{{ csrf_token() }}" },
                success:function(res){
                    if(res){
                        $("#council_name").empty();
                        $.each(res,function(key,value){
                            $("#council_name").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#council_name").empty();
                    }
                }
            });
        }else{
            $("#council_name").empty();
        }

    });
</script>
@endsection
