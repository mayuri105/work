@extends('elements.admin_master')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Ach Charge                       
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
									<a href="{{ route('ach-charges') }}" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										Back
									</a>
								</div>	
							</div>		
						</div>
					</div>
					<!--begin::Form-->
					<form class="kt-form" action="{{ route('save-ach-charge-amount') }}" method="POST" style="margin-top: -5px;">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="kt-portlet__body">
							<div class="kt-form__section kt-form__section--first">
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Charge Amount:<storage class="text-danger">*</storage></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<input type="text" class="form-control" name="ach_charges_amount" placeholder="Enter Ach Charge Amount" value="{{ old('ach_charges_amount') }}">
										@if ($errors->has('ach_charges_amount'))
										<span style="color: red;">
											{{ $errors->first('ach_charges_amount') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Start Date:<storage class="text-danger">*</storage></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<input type="text" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" placeholder="Enter Start Date">
										@if ($errors->has('start_date'))
										<span style="color: red;">
											{{ $errors->first('start_date') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">End Date:</label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<input type="text" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" placeholder="Enter End Date">
										@if ($errors->has('end_date'))
										<span style="color: red;">
											{{ $errors->first('end_date') }}
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
										<a href="{{ route('ach-charges') }}" class="btn btn-secondary">Cancel</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
	$('#start_date').mask('00-00-0000');
	$('#end_date').mask('00-00-0000');
</script>
@endsection