@extends('elements.login_master')
@section('content')
<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
	<!--begin::Head-->
	<div class="kt-login__head">
		<span class="kt-login__signup-label">Don't have an account activated yet?</span>&nbsp;&nbsp;
		<a href="#" class="kt-link kt-login__signup-link">Active!</a>
	</div>
	<!--end::Head-->
	<!--begin::Body-->
	<div class="kt-login__body">
		<!--begin::Signin-->
		<div class="kt-login__form">
			<div class="kt-login__title">
				<h3>Two-Factor Authentication</h3>
			</div>          
			@if (Session::has('error'))
			<div class="alert alert-warning">{{ Session::get('error') }}</div>
			@endif
			{!! Form::open(array('route' => 'otp-authentication','method'=>'POST','files'=>'true')) !!}
				<div class="form-group">
					<label class="custom-label">Two-factor authentication code <span class="text-danger">*</span></label>
					{!! Form::text('otp',NULL,['id'=>'otp','class'=>'form-control','placeholder'=>'OTP']) !!}
					@if ($errors->otp_verification->all('otp'))
                        <div class="text-danger">
                            {{ $errors->otp_verification->first('otp') }}
                        </div>
                    @endif
				</div>
				<!--begin::Action-->
				<div class="kt-login__actions">
					<a href="{{ route('login') }}" class="kt-link kt-login__link-forgot">
						Back to Sign In?
					</a>
					<button type="submit" class="btn btn-warning btn-wide">Verify code</button>
				</div>
				<!--end::Action-->
			{!! Form::close() !!}
			<!--end::Form-->
		</div>
		<!--end::Signin-->
	</div>
	<!--end::Body-->
</div>
@endsection
@section('content_js')
<link href="{{ URL::asset('assets/js/login-1.js') }}" rel="stylesheet" type="text/css" />
@endsection