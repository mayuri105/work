@extends('elements.admin_master')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Bank Details                      
					</h3>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->                    
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">
			<div class="col-xl-4 col-lg-3 order-lg-1 order-xl-1">
				@include('elements.left_bar')
			</div>
			<div class="col-xl-4 col-lg-9 order-lg-1 order-xl-1">
				<div class="kt-portlet kt-portlet--mobile">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Add  
							</h3>
						</div>
					<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<a href="{{ route('bank-details') }}" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										Back
									</a>
								</div>	
							</div>		
						</div>
					</div>
					<!--begin::Form-->
					<form class="kt-form" action="{{ route('save-bank-details') }}" method="POST" style="margin-top: -5px;">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="kt-portlet__body">
							<div class="kt-form__section kt-form__section--first">
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Bank Name:<storage class="text-danger">*</storage></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<select class="form-control" name="bank_name" id="bank_name">
										<option selected disabled>Select Bank Name</option>
										@foreach($bankName as $bankNames)
											<option value="{{ $bankNames->bank_name_id }}">{{ $bankNames->bank_name }}</option>
										@endforeach
											</select>
										{{-- <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="{{ old('bank_name') }}"> --}}
										@if ($errors->has('bank_name'))
										<span style="color: red;">
											{{ $errors->first('bank_name') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Bank Account Type:<storage class="text-danger">*</storage></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<input type="text" class="form-control" name="bank_account_type" placeholder="Enter Bank Account type" value="{{ old('bank_account_type') }}">
										@if ($errors->has('bank_account_type'))
										<span style="color: red;">
											{{ $errors->first('bank_account_type') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Bank Branch:<storage class="text-danger">*</storage></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<input type="text" class="form-control" name="bank_branch" placeholder="Enter Bank Branch" value="{{ old('bank_branch') }}">
										@if ($errors->has('bank_branch'))
										<span style="color: red;">
											{{ $errors->first('bank_branch') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Account Number:<storage class="text-danger">*</storage></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<input type="text" class="form-control" name="bank_account_number" placeholder="Enter Account Number" value="{{ old('bank_account_number') }}">
										@if ($errors->has('bank_account_number'))
										<span style="color: red;">
											{{ $errors->first('bank_account_number') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">IFSC Code:<storage class="text-danger">*</storage></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<input type="text" class="form-control" name="bank_ifsc_code" placeholder="Enter IFSC Code" value="{{ old('bank_ifsc_code') }}">
										@if ($errors->has('bank_ifsc_code'))
										<span style="color: red;">
											{{ $errors->first('bank_ifsc_code') }}
										</span>
										@endif
									</div>
								</div>

							</div>
						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-10">
										<input type="submit" class="btn btn-success" value="Submit">
										<a href="{{ route('bank-details') }}" class="btn btn-secondary">Cancel</a>
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
@endsection
@section('content_js')
<script src="{{ URL::asset('assets/js/dashboard.js') }}" type="text/javascript"></script>
<script>
	$('#bank_name').select2();
</script>
@endsection