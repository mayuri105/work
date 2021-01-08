@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
								Edit Karyakarta                            
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
							<a href="{{ route('karyakarta') }}">
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
						<form action="{{ route('update-karyakarta') }}" enctype="multipart/form-data" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">											
							<!--end::Portlet-->
							<div class="kt-portlet sahyognidhi-mtt">
								<div class="row">
									<div class="col-sm-12">	
										<div id="London" class="w3-container city">
											<div class="Half-section-details">											

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Designation<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<select class="form-control" id="fk_role_id" name="fk_role_id">
															<option disabled value="">SELECT DESIGNATION</option>
															<option selected value="{{ $editKaryakartaDetails['fk_role_id'] }}">{{ $editKaryakartaDetails['name'] }}</option>
														</select>
														@if ($errors->has('fk_role_id'))
														<span style="color: red;">
															{{ $errors->first('fk_role_id') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Start Date<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" aria-describedby="emailHelp" id="start_date" name="start_date" placeholder="ENTER START DATE" value="{{ date('d-m-Y',strtotime($editKaryakartaDetails['start_date'])) }}" readonly>
														@if ($errors->has('start_date'))
														<span style="color: red;">
															{{ $errors->first('start_date') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Ysk Id<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<select class="form-control" id="fk_registration_id" name="fk_registration_id">
															<option disabled value="">SELECT YSK ID</option>
															<option selected value="{{ $editKaryakartaDetails['fk_registration_id'] }}">{{ $editKaryakartaDetails['name_as_per_yuva_sangh_org'] }}({{ $editKaryakartaDetails['ysk_id'] }})</option>
														</select>
														@if ($errors->has('fk_registration_id'))
														<span style="color: red;">
															{{ $errors->first('fk_registration_id') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row ysk_name">	
													<label class="col-lg-2 col-form-label">Name<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="name_as_per_yuva_sangh_org" placeholder="ENTER NAME" value="{{ $editKaryakartaDetails['name_as_per_yuva_sangh_org'] }}" style="text-transform: uppercase;" readonly>
														@if ($errors->has('name_as_per_yuva_sangh_org'))
														<span style="color: red;">
															{{ $errors->first('name_as_per_yuva_sangh_org') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Contact Number<span class="text-danger">*</span>	
													</label>	
													<div class="col-lg-4">
														<label>Phone Number1</label>
														<input type="text" class="form-control" aria-describedby="emailHelp" id="phone_number_first" name="phone_number_first" placeholder="ENTER CONTACT NUMBER" value="{{ $editKaryakartaDetails['phone_number_first'] }}" readonly>
													    @if ($errors->has('phone_number_first'))
														<span style="color: red;">
															{{ $errors->first('phone_number_first') }}
														</span>
														@endif
													</div>
													<div class="col-lg-4">
														<label>Phone Number2</label>
														<input type="text" class="form-control" aria-describedby="emailHelp" id="phone_number_second" name="phone_number_second" placeholder="ENTER CONTACT NUMBER" value="{{ $editKaryakartaDetails['phone_number_second'] }}" readonly>
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Email<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="email" placeholder="ENTER EMAIL" value="{{ $editKaryakartaDetails['email'] }}" style="text-transform: uppercase;" readonly>
														@if ($errors->has('email'))
														<span style="color: red;">
															{{ $errors->first('email') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">City<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="city" placeholder="ENTER CITY" value="{{ $editKaryakartaDetails['city'] }}" style="text-transform: uppercase;" readonly>
														@if ($errors->has('city'))
														<span style="color: red;">
															{{ $errors->first('city') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Region<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="region_name" placeholder="ENTER REGION" value="{{ $editKaryakartaDetails['region_name'] }}" style="text-transform: uppercase;" readonly>
														@if ($errors->has('region_name'))
														<span style="color: red;">
															{{ $errors->first('region_name') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Yuva Mandal<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="yuva_mandal_name" placeholder="ENTER YUVA MANDAL" value="{{ $editKaryakartaDetails['yuva_mandal_name'] }}" style="text-transform: uppercase;" readonly>
														@if ($errors->has('yuva_mandal_name'))
														<span style="color: red;">
															{{ $errors->first('yuva_mandal_name') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Council<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="council_name" placeholder="ENTER COUNCIL" value="{{ $editKaryakartaDetails['council_name'] }}" style="text-transform: uppercase;" readonly>
														@if ($errors->has('council_name'))
														<span style="color: red;">
															{{ $errors->first('council_name') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Samaj Zone<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="samaj_zone_name" placeholder="ENTER SAMAJ ZONE" value="{{ $editKaryakartaDetails['samaj_zone_name'] }}" style="text-transform: uppercase;" readonly>
														@if ($errors->has('samaj_zone_name'))
														<span style="color: red;">
															{{ $errors->first('samaj_zone_name') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Division<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="division_name" placeholder="ENTER DIVISION" value="{{ $editKaryakartaDetails['division_name'] }}" style="text-transform: uppercase;" readonly>
														@if ($errors->has('division_name'))
														<span style="color: red;">
															{{ $errors->first('division_name') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Password<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="password" placeholder="ENTER PASSWORD" value="{{ $editKaryakartaDetails['password'] }}" style="text-transform: uppercase;">
														@if ($errors->has('password'))
														<span style="color: red;">
															{{ $errors->first('password') }}
														</span>
														@endif
													</div>
												</div>

                                                <div class="form-group1 m-form__group1 row ysk_name">	
													<label class="col-lg-2 col-form-label">Karyakarta Email Id<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" id="karyakarta_email_id" name="karyakarta_email_id" placeholder="ENTER Karyakarta Email Id" value="{{ $editKaryakartaDetails['karyakarta_email_id'] }}">
														@if ($errors->has('karyakarta_email_id'))
														<span style="color: red;">
															{{ $errors->first('karyakarta_email_id') }}
														</span>
														@endif
													</div>
												</div>
												
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Narration<span class="text-danger">*</span>
													</label>	
													<div class="col-lg-9">
														<textarea class="form-control" name="ysk_details" placeholder="ENTER DETAILS" style="text-transform: uppercase;">{{ $editKaryakartaDetails['ysk_details'] }}</textarea>
														@if ($errors->has('ysk_details'))
														<span style="color: red;">
															{{ $errors->first('ysk_details') }}
														</span>
														@endif
													</div>
												</div>

												<input type="hidden" name="editId" value="{{ $editKaryakartaDetails['karyakarta_id'] }}">
												<input type="hidden" name="hiddenYskId" value="{{ $editKaryakartaDetails['ysk_id'] }}">
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Completion Date</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" aria-describedby="emailHelp" id="end_date" name="end_date" placeholder="ENTER END DATE" value="@if($editKaryakartaDetails['end_date'] != '0000-00-00'){{ $editKaryakartaDetails['end_date'] }} @endif">
														@if ($errors->has('end_date'))
														<span style="color: red;">
															{{ $errors->first('end_date') }}
														</span>
														@endif
													</div>
												</div>

												 <div class="form-group m-form__group row">
													<label class="col-lg-2 col-form-label">Assign Permission  <storage class="text-danger">*</storage></label>
													<div class="col-lg-10">
														
														@foreach($modulePage as $key => $valueModulePage)
															<div class="m-demo">
																<div class="m-demo__preview m-demo__preview--badge p-4">
																	<p>{{ $key }}</p>
																	<div class="kt-checkbox-inline">
																		@foreach($valueModulePage as $key => $valueModulePageSlug)
																		@php
																		$checkedboxData = "";
																		if(in_array($valueModulePageSlug['page_id'], $currentPageId)){
																			$checkedboxData = "checked";
																		}
																		@endphp
																		<label class="kt-checkbox m-checkbox" cheched="">
																		@if($valueModulePageSlug['page_slug'] == "All")
																	
																			<input {{ $checkedboxData }} type="checkbox" value="{{ $valueModulePageSlug['page_id'] }}" name="page_slugs[]" onchange="checkAll({{ $valueModulePageSlug['page_id'] }})" id="pages{{ $valueModulePageSlug['page_id'] }}" class="add_class_{{ $valueModulePageSlug['page_id'] }} kt-checkbox kt-checkbox--single kt-checkbox--solid"> {{ $valueModulePageSlug['page_slug'] }}
																			<span></span>												
																		</label>
																		@else
																			<input {{ $checkedboxData }} type="checkbox" value="{{ $valueModulePageSlug['page_id'] }}" name="page_slugs[]" onchange="checkSubCheckbox({{ $valueModulePageSlug['page_id'] }},{{ $valueModulePageSlug['parent_page_id'] }})" id="pages{{ $valueModulePageSlug['page_id'] }}" class="add_class_sub_{{ $valueModulePageSlug['parent_page_id'] }} kt-checkbox kt-checkbox--single kt-checkbox--solid"> {{ $valueModulePageSlug['page_slug'] }}


																			<span></span>
																		</label>
																		@endif
																		@endforeach
																	</div>
																</div>
															</div>										
														@endforeach
														@if ($errors->has('page_slugs'))
														<span style="color: red;">
															{{ $errors->first('page_slugs') }}
														</span>
														@endif
													</div>
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
																<input type="submit" name="submit" value="  Edit  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
																<a href="{{ route('karyakarta') }}" class="btn-cancel-registration">Cancel</a>
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
</div>
</div>

<!-- content end -->
<!--ENd:: Chat-->
@endsection
@section('content_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
	$('#start_date').mask('00-00-0000');
	$('#end_date').mask('00-00-0000');
	$('#fk_registration_id').select2();
	$('#fk_role_id').select2();
	$('#fk_region_id').select2();
	$('#fk_yuva_mandal_id').select2();
	$('#fk_council_id').select2();
	$('#fk_samaj_zone_id').select2();
	$('#fk_division_id').select2();
	function getYskName() {
		$('.ysk_name').show();
	}
</script>
<script>
	function checkAll(ele) {
		var ischecked= $('.add_class_'+ele).is(':checked');
		//alert(ele);
		if(ischecked == true){
			$('.add_class_sub_'+ele).prop('checked', true);
		}
		else{
			$('.add_class_sub_'+ele).prop('checked', false);
		}
	}
	function checkSubCheckbox(ele,parentPageId) {
		var ischecked = $('#pages'+ele).is(':checked');
		//alert(ele);
		if(ischecked == false){
			$('.add_class_'+parentPageId).prop('checked', false);
		}
		else{
			if($('.add_class_sub_'+parentPageId+':checked').length == $('.add_class_sub_'+parentPageId).length){
				$('.add_class_'+parentPageId).prop('checked',true);
			}
		}
	}
</script>
@endsection
