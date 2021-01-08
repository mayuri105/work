@extends('elements.login_master')
@section('content')
<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
	<!--begin::Head-->
	{{-- <div class="kt-login__head">
		<span class="kt-login__signup-label">Don't have an account activated yet?</span>&nbsp;&nbsp;
		<a href="#" class="kt-link kt-login__signup-link">Active!</a>
	</div> --}}
	<!--end::Head-->
	<!--begin::Body-->
	<div class="kt-login__body">
		<!--begin::Signin-->
		<div class="kt-login__form">
			<div class="kt-login__title">
				<h3>Sign In For User</h3>
			</div>          
			<!--begin::Form-->
			{{-- @if(count($errors->login) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->login->all() as $error)
					<P>{{ $error }}</p>
					@endforeach
				</ul>
			</div>
			@endif --}} 
			@if (Session::has('error'))
			<div class="alert alert-warning">{{ Session::get('error') }}</div>
			@endif
			{!! Form::open(array('route' => 'user-login-authentication','method'=>'POST')) !!}
			@csrf
				<div class="form-group">
					<label class="custom-label">Ysk Id <span class="text-danger">*</span></label>
					{!! Form::text('ysk_id',NULL,['id'=>'ysk_id','class'=>'form-control','placeholder'=>'Ysk Id']) !!}
					@if ($errors->login->all('ysk_id'))
                        <div class="text-danger">
                            {{ $errors->login->first('ysk_id') }}
                        </div>
                    @endif
				</div>
				<div class="form-group">
					<label class="custom-label">Password <span class="text-danger">*</span></label>
					{!! Form::password('password',['id'=>'password','class'=>'form-control','placeholder'=>'Password']) !!}
					@if ($errors->login->all('password'))
                        <div class="text-danger">
                            {{ $errors->login->first('password') }}
                        </div>
                    @endif
				</div>
				<!--begin::Action-->
				<div class="kt-login__actions">
					<a href="#" class="kt-link kt-login__link-forgot">
						Forgot Password ?
					</a>
					<button type="submit" class="btn btn-warning btn-wide">Sign In</button>
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