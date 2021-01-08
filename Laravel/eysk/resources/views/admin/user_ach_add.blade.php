@extends('elements.admin_master')
@section('content')
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
								Add ACH                           
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
							<a href="{{ route('user-ach',$id) }}">
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


	<!-- begin:: Content -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!--begin::Portlet-->
		<form action="{{ route('save-user-ach',$id) }}" method="POST"> 
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="kt-portlet kt-portlet--tab">
				<div class="kt-title__head">
					<div class="kt-portlet__header">
						<h3 class="title-ktt">
							ACH Details
						</h3>
					</div>
				</div>


				<div class="main-padding">
					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">YSK ID
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<select class="form-control kt-select2" id="fk_ysk_id" name="fk_ysk_id" style="width: 100%;">
								<option value="">SELECT YSK</option>
								<option value="{{ $yskId }}" selected>{{ $nameAsPerYuvaSangh }}({{ $yskId }})</option>
							</select>
							@if ($errors->has('fk_ysk_id'))
								<span style="color: red;">
									{{ $errors->first('fk_ysk_id') }}
								</span>
							@endif
						</div>
					</div>	

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Region
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<select class="form-control kt-select2" id="fk_region_id" name="fk_region_id" style="width: 100%;">
								<option value="">SELECT REGION</option>
								<option value="{{ $regionId }}" selected>{{ $regionName }}</option>
							</select>
							@if ($errors->has('fk_region_id'))
							<span style="color: red;">
								{{ $errors->first('fk_region_id') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Yuva Mandal Name
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<select class="form-control kt-select2" id="fk_yuva_mandal" name="yuva_mandal_number_id" style="width: 100%;">
								<option value="">SELECT YUVA MANDAL</option>
								<option value="{{ $yuvaMandalId }}" selected>{{ $yuvaMandalName }}</option>
							</select>
							@if ($errors->has('yuva_mandal_number_id'))
							<span style="color: red;">
								{{ $errors->first('yuva_mandal_number_id') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">City
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<input type="text" id="city_name" name="city_name" placeholder="Enter City" class="form-control" aria-describedby="emailHelp" value="{{ $cityName }}" style="text-transform: uppercase;" readonly>
							@if ($errors->has('city_name'))
							<span style="color: red;">
								{{ $errors->first('city_name') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Email
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<input type="text" id="email" name="email" placeholder="Enter Email" class="form-control" aria-describedby="emailHelp" value="{{ $email }}" style="text-transform: uppercase;" readonly>
							@if ($errors->has('email'))
							<span style="color: red;">
								{{ $errors->first('email') }}
							</span>
							@endif
						</div>
					</div>

					<input type="hidden" name="email" id="email">

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Name As Per Yuva Sangh Org
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<input type="text" id="name_as_per_yuva_sangh_org" name="name_as_per_yuva_sangh_org" class="form-control" placeholder="Enter Name As Per Yuva Sangh Org" aria-describedby="emailHelp" value="{{ $nameAsPerYuvaSanghOrg }}" style="text-transform: uppercase;" readonly>
							@if ($errors->has('name_as_per_yuva_sangh_org'))
							<span style="color: red;">
								{{ $errors->first('name_as_per_yuva_sangh_org') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Phone Number
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<input type="text" class="form-control" placeholder="ENTER PHONE NUMBER" id="phone_number" name="phone_number" aria-describedby="emailHelp" value="{{ $phoneNumberFirst }}" readonly>
							@if ($errors->has('phone_number'))
							<span style="color: red;">
								{{ $errors->first('phone_number') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Apply Date
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<input type="text" class="form-control" id="apply_date" placeholder="ENTER APPLY DATE" name="apply_date" aria-describedby="emailHelp" value="{{ old('apply_date') }}" readonly>
							@if ($errors->has('apply_date'))
							<span style="color: red;">
								{{ $errors->first('apply_date') }}
							</span>
							@endif
						</div>
					</div>

							<div class="form-group1 m-form__group1 row">	
								<label class="col-lg-2 col-form-label">Bank Name
									<span class="text-danger">*</span>
								</label>	
								<div class="col-lg-9">
									<input type="text" class="form-control" placeholder="ENTER BANK NAME" name="fk_bank_id" aria-describedby="emailHelp" value="{{ old('fk_bank_id') }}">
									@if ($errors->has('fk_bank_id'))
										<span style="color: red;">
											{{ $errors->first('fk_bank_id') }}
										</span>
									@endif
								</div>
							</div>

							<div class="form-group1 m-form__group1 row">	
								<label class="col-lg-2 col-form-label">Bank Account Number
									<span class="text-danger">*</span>
								</label>	
								<div class="col-lg-9">
									<input type="text" class="form-control" placeholder="ENTER BANK ACCOUNT NUMBER" name="bank_account_number" aria-describedby="emailHelp" value="{{ old('bank_account_number') }}">
									@if ($errors->has('bank_account_number'))
										<span style="color: red;">
											{{ $errors->first('bank_account_number') }}
										</span>
									@endif
								</div>
							</div>

							<div class="form-group1 m-form__group1 row">	
								<label class="col-lg-2 col-form-label"> IFSC Code
									<span class="text-danger">*</span></label>	
									<div class="col-lg-9">
										<input type="text" class="form-control" name="ifsc_code" placeholder="ENTER IFSC CODE" aria-describedby="emailHelp" value="{{ old('ifsc_code') }}">
										@if ($errors->has('ifsc_code'))
											<span style="color: red;">
												{{ $errors->first('ifsc_code') }}
											</span>
										@endif
									</div>
								</div>

								<div class="form-group1 m-form__group1 row">	
									<label class="col-lg-2 col-form-label">MICR Code<span class="text-danger">*</span>
									</label>	
									<div class="col-lg-9">
										<input type="text" class="form-control" placeholder="ENTER MICR CODE" name="micr_code" aria-describedby="emailHelp" value="{{ old('micr_code') }}">
										@if ($errors->has('micr_code'))
											<span style="color: red;">
												{{ $errors->first('micr_code') }}
											</span>
										@endif
									</div>
								</div>


								</div>

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
														<input type="submit" name="submit" value="  Add  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
														<a href="{{ route('user-ach',$id) }}" class="btn-cancel-registration">Cancel</a>
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
					<!-- content end -->          
					<!--ENd:: Chat-->
					@endsection
@section('content_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
	$("#fk_ysk_id").select2();
	$("#fk_bank_id").select2();
	$("#fk_region_id").select2();
	$("#fk_yuva_mandal").select2();
</script>
<script>
	$('#apply_date').mask('00-00-0000');
	$(document).ready(function(){
		var date = new Date();

		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();

		if (month < 10) month = "0" + month;
		if (day < 10) day = "0" + day;

		var today = day + "-" + month + "-" + year;
		$('#apply_date').attr("value", today);
	});
</script>
@endsection