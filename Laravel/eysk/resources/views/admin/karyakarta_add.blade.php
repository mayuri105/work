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
								Add Karyakarta                            
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
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">		
			<div class="col-lg-12">
				<!--begin::Portlet-->
				<div class="kt-portlet">

					<div class="mtt-body">
						<form action="{{ route('save-karyakarta') }}" enctype="multipart/form-data" method="POST">
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
														<select class="form-control" id="fk_role_id" name="fk_role_id" onchange="assignPermission(this.value)">
															<option selected value="">SELECT DESIGNATION</option>
															@foreach($roleData as $roleDatas)
															<option value="{{ $roleDatas->role_id }}">{{ $roleDatas->name }}</option>
															@endforeach
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
														<input type="text" class="form-control" aria-describedby="emailHelp" id="start_date" name="start_date" placeholder="ENTER START DATE" >
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
														<select class="form-control" id="fk_registration_id" name="fk_registration_id" onchange="getYskName(this.value)">
															<option selected value="">SELECT YSK ID</option>
															@foreach($yskId as $yskIds)
																@if($yskIds->ysk_id == '')
																	<option value="{{ $yskIds->registration_id }}">{{ strtoupper($yskIds->name_as_per_yuva_sangh_org) }}({{ $yskIds->pre_ysk_id }})</option>
																@else 
																<option value="{{ $yskIds->registration_id }}">{{ strtoupper($yskIds->name_as_per_yuva_sangh_org) }}({{ $yskIds->ysk_id }})</option>
																@endif
															@endforeach
														</select>
														@if ($errors->has('fk_registration_id'))
														<span style="color: red;">
															{{ $errors->first('fk_registration_id') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row ysk_name" style="display: none;">	
													<label class="col-lg-2 col-form-label">Name<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" id="name_as_per_yuva_sangh_org" name="name_as_per_yuva_sangh_org" placeholder="ENTER NAME" value="{{ old('name_as_per_yuva_sangh_org') }}" style="text-transform: uppercase;background-color: #d3d3d3;" readonly>
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
														<input type="text" class="form-control" aria-describedby="emailHelp" id="phone_number_first" name="phone_number_first" placeholder="ENTER CONTACT NUMBER" readonly style="background-color: #d3d3d3;">
													    @if ($errors->has('phone_number_first'))
														<span style="color: red;">
															{{ $errors->first('phone_number_first') }}
														</span>
														@endif
													</div>
													<div class="col-lg-4">
														<label>Phone Number2</label>
														<input type="text" class="form-control" aria-describedby="emailHelp" id="phone_number_second" name="phone_number_second" placeholder="ENTER CONTACT NUMBER" readonly style="background-color: #d3d3d3;">
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Email<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" id="email" name="email" placeholder="ENTER EMAIL" value="{{ old('email') }}" style="background-color: #d3d3d3;" readonly> 
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
														<input type="text" class="form-control" id="city" name="city" placeholder="ENTER CITY" value="{{ old('city') }}" style="text-transform: uppercase;background-color: #d3d3d3;" readonly>
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
														<input type="text" class="form-control" name="region_name" id="region_name" placeholder="ENTER REGION NAME" style="background-color: #d3d3d3;" readonly>
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
														<input type="text" class="form-control" name="yuva_mandal_name" id="yuva_mandal_name" placeholder="ENTER YUVA MANDAL NAME" style="background-color: #d3d3d3;" readonly>
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
														<input type="text" class="form-control" name="council_name" id="council_name" placeholder="ENTER COUNCIL" style="background-color: #d3d3d3;" readonly>
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
														<input type="text" class="form-control" name="samaj_zone_name" id="samaj_zone_name" placeholder="ENTER SAMAJ ZONE" style="background-color: #d3d3d3;" readonly>
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
														<input type="text" class="form-control" name="division_name" id="division_name" placeholder="ENTER DIVISION NAME" style="background-color: #d3d3d3;" readonly>
													    @if ($errors->has('division_name'))
														<span style="color: red;">
															{{ $errors->first('division_name') }}
														</span>
														@endif
													</div>
												</div>
												
												<div class="form-group1 m-form__group1 row ysk_name">	
													<label class="col-lg-2 col-form-label">Karyakarta EmailId<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" id="karyakarta_email_id" name="karyakarta_email_id" placeholder="ENTER Karyakarta Email Id" value="{{ old('karyakarta_email_id') }}">
														@if ($errors->has('karyakarta_email_id'))
														<span style="color: red;">
															{{ $errors->first('karyakarta_email_id') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Password<span class="text-danger">*</span></label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="password" id="password" placeholder="ENTER PASSWORD">
													    @if ($errors->has('password'))
														<span style="color: red;">
															{{ $errors->first('password') }}
														</span>
														@endif
													</div>
												</div>


												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Narration<span class="text-danger">*</span>
													</label>	
													<div class="col-lg-9">
														<textarea class="form-control" name="ysk_details" placeholder="ENTER DETAILS" style="text-transform: uppercase;">{{ old('ysk_details') }}</textarea>
														@if ($errors->has('ysk_details'))
														<span style="color: red;">
															{{ $errors->first('ysk_details') }}
														</span>
														@endif
													</div>
												</div>
												<input type="hidden" name="ysk_id" id="ysk_id">
												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Completion Date</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" aria-describedby="emailHelp" id="end_date" name="end_date" placeholder="ENTER END DATE" >
														@if ($errors->has('end_date'))
														<span style="color: red;">
															{{ $errors->first('end_date') }}
														</span>
														@endif
													</div>
												</div>

												 <div class="form-group m-form__group row assign_permission" style="display: none;">
													<label class="col-lg-2 col-form-label">Assign Permission  <storage class="text-danger">*</storage></label>													
													<div class="col-lg-10" id="assignRolePermission">
														
														
														
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
																<input type="submit" name="submit" value="  Add  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
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
<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>
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
	function getYskName(value) {
		$.ajax({
			url: '{{ route('get-ysk-details-by-registration-id') }}',
			type: 'POST',
			data: {fk_registration_id:value,_token:"{{ csrf_token() }}"},
			success:function (response) {
				var obj = JSON.parse(response);
				if (obj.success == 1) {
					$('#name_as_per_yuva_sangh_org').val(obj.name_as_per_yuva_sangh_org);
					$('#phone_number_first').val(obj.phone_number_first);
					$('#phone_number_second').val(obj.phone_number_second);
					$('#email').val(obj.email);
					$('#city').val(obj.city);
					$('#region_name').val(obj.region_name);
					$('#yuva_mandal_name').val(obj.yuva_mandal_name);
					$('#council_name').val(obj.council_name);
					$('#samaj_zone_name').val(obj.samaj_zone_name);
					$('#division_name').val(obj.division_name);
					$('#ysk_id').val(obj.ysk_id);
					$('.ysk_name').show();
				}
			}
		})
		
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

	function assignPermission(value) {
		$('.assign_permission').show();
		$.ajax({
			url: '{{ route('get-assign-permission') }}',
			type: 'POST',
			data: {fk_designation_id: value,_token:"{{ csrf_token() }}"},
			success:function (response) {
				var obj = JSON.parse(response);
				if (obj.success == 1) {
					$('#assignRolePermission').html(obj.html_data);
					$('.assign_permission').show();
				}				
			}
		})		
	}
</script>
@endsection
