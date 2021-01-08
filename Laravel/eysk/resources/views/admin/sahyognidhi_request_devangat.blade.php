@extends('elements.admin_master',['accessData',$accessData])
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
								Add Devangat                            
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
						<form action="{{ route('save-divangat-after-death') }}" enctype="multipart/form-data" method="POST">
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
										
										<input type="hidden" name="editId" value="{{ $sahyognidhiData['sahyognidhi_id'] }}" id="editId">

										<div class="form-group1 m-form__group1 row show_div">	
											<label class="col-lg-2 col-form-label">Cause of Death	
											</label>	
											<div class="col-lg-9">
												 <select class="form-control kt-select2" onchange="getDeathDescription(this.value);" id="cause_of_death" name="cause_of_death" style="width: 100%;">
													<option selected>SELECT CAUSE OF DEATH</option>
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
											    @if ($errors->has('designation'))
												<span style="color: red;">
													{{ $errors->first('designation') }}
												</span>
												@endif
											</div>
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
											<div class="nominee-details-mtt">
												<h3></h3>
												<div class="sahyognidhi-border"></div>
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label"></label>	
													<div class="col-lg-9">
														<div class="kt-portlet__head-toolbar">
															<div class="kt-portlet__head-wrapper">
																<div class="kt-portlet__head-actions">
																	<input type="submit" name="submit" value="  Add  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
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
					
				}
				if (obj.success == '0') {
					//alert(obj.yuvaMandalName);
					$('#sahyognidhiError').html('This yskid is in locking period.');
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
					$('.aadharCardNumber').val(obj.aadharCardNumber);
					$(".aadharCardNumber").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#city_name').val(obj.cityName.toUpperCase());
					$("#city_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					if (obj.email != '') {
						$('#email').val(obj.email);
						$("#email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}	
					else{
						$("#email").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					}
					if (($('input[name="gender"][value="Male"]').val()) == obj.Gender) {
						$('input[name="gender"][value="Male"]').attr('checked','checked');
						$('#male').attr('checked',true);
					}
					else{
						$('input[name="gender"][value="Female"]').attr('checked','checked');
						$('#female').attr('checked',true);
					}
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
					$('#date_of_birth').val(obj.dateOfBirth);
					$("#date_of_birth").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});
					$('#samaj_zone_name').val(obj.samajZoneName.toUpperCase());
					$("#samaj_zone_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 					
					$('#yuva_mandal_name').val(obj.yuvaMandalName.toUpperCase());
					$("#yuva_mandal_name").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'}); 
					
					
						
					
					
					/*$('#pincode').val(obj.pincode);
					$("#pincode").css({'background':'#d3d3d3','border-width':'5px','border-style':'solid'});*/
					
				}
			}
		})		
	}

	function validateImage(argument) {
		var formData = new FormData();

		/*var fp = $("#disability_document");
		var lg = fp[0].files.length;
		var items = fp[0].files;
        var fileSize = 0;*/

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

		/*if (lg > 1) {
 			for (var i = 0; i < lg; i++) {
 				fileSize = items[i].size;
 			}
 			if (Math.round(fileSize/1024) > 500) {
 				$("#imgError").html("Max Upload size is 500kb only");
				$("#imgError").css("display", "block");
				document.getElementById("divangat_upload_image").value = '';
				return false;
 			}
 		}
 		else{*/
			if (Math.round(file.size/1024) > 500) {
				$("#imgError").html("Max Upload size is 500kb only");
				$("#imgError").css("display", "block");
				document.getElementById("disability_document").value = '';
				return false;
			}
		/*}*/
		return true;
	}

	function validDivangatImage(argument) {
		var formData = new FormData();

		/*var fp = $("#divangat_upload_image");
		var lg = fp[0].files.length;
		var items = fp[0].files;
        var fileSize = 0; */		

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

		/*if (lg > 1) {
 			for (var i = 0; i < lg; i++) {
 				fileSize = items[i].size;
 			}
 			if (Math.round(fileSize/1024) > 500) {
 				$("#imgError1").html("Max Upload size is 500kb only");
				$("#imgError1").css("display", "block");
				document.getElementById("divangat_upload_image").value = '';
				return false;
 			}
 		}
 		else{*/
 			if (Math.round(file.size/1024) > 500) {
 				$("#imgError1").html("Max Upload size is 500kb only");
 				$("#imgError1").css("display", "block");
 				document.getElementById("divangat_upload_image").value = '';
 				return false;
 			}
 		/*}*/

		return true;
	}

	function validDeathCertificate(argument) {
		var formData = new FormData();

		/*var fp = $("#death_certificate_document");
		var lg = fp[0].files.length;
		var items = fp[0].files;
        var fileSize = 0;*/

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

		/*if (lg > 1) {	
 			for (var i = 0; i < lg; i++) {
 				fileSize = items[i].size;
 			}
 				alert(fileSize);
 			if (Math.round(fileSize/1024) > 500) {
 				$("#imgError2").html("Max Upload size is 500kb only");
				$("#imgError2").css("display", "block");
				document.getElementById("death_certificate_document").value = '';
				return false;
 			}
 		}
 		else{*/
 			if (Math.round(file.size/1024) > 500) {
 				$("#imgError2").html("Max Upload size is 500kb only");
 				$("#imgError2").css("display", "block");
 				document.getElementById("death_certificate_document").value = '';
 				return false;
 			}
 		/*}*/

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
