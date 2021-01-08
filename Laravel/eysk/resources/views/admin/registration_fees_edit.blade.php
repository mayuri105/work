@extends('elements.admin_master')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Registration Fees                       
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
				@include('elements.left_bar',array('accessData'=>$accessData))
			</div>
			<div class="col-xl-4 col-lg-9 order-lg-1 order-xl-1">
				<div class="kt-portlet kt-portlet--mobile">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Update 
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<a href="{{ route('registration-fees') }}" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										Back
									</a>
								</div>	
							</div>		
						</div>
					</div>


					<form class="kt-form" action="{{ route('update-registration-fees') }}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="editId" value="{{ $editRegistrationFeesData->registration_fees_id }}">
						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<h3 class="kt-section__title">Date Info:</h3>
								<div class="kt-section__body">
									<div class="row">
										<div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Start Date <span class="text-required">*</span></label>
												<div class="col-lg-9">
													{!! Form::text('start_date',old("start_date", date("d-m-Y",strtotime($editRegistrationFeesData->start_date)) ?: ''),['id'=>'start_date','class'=>'form-control start_date','placeholder'=>'ENTER START DATE']) !!}

													@if ($errors->has('start_date'))
													<span style="color: red;">
														{{ $errors->first('start_date') }}
													</span>
													@endif
												</div>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">End Date <span class="text-required">*</span></label>
												<div class="col-lg-9">
													{!! Form::text('end_date',old("end_date", date("d-m-Y",strtotime($editRegistrationFeesData->end_date)) ?: ''),['id'=>'end_date','class'=>'form-control end_date','placeholder'=>'ENTER END DATE']) !!}
													@if ($errors->has('end_date'))
													<span style="color: red;">
														{{ $errors->first('end_date') }}
													</span>
													@endif
												</div>
											</div>
										</div>
									</div>	
								</div>

								<div class="kt-separator kt-separator--border-dashed kt-separator--space-smlg"></div>

								<h3 class="kt-section__title">Age Group - 1 </h3>
								<div class="kt-section__body">
									<div class="row">
										<div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-5 col-form-label">Start Age <span class="text-required">*</span></label>
												<div class="col-xl-7 col-lg-7 col-sm-12 col-md-12">
													{!! Form::text('start_age1',old("start_age1", $editRegistrationFeesData->start_age1 ?: ''),['id'=>'start_age1','class'=>'form-control','placeholder'=>'START AGE']) !!}
												</div>
												@if ($errors->has('start_age1'))
												<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
													<span style="color: red;">
														{{ $errors->first('start_age1') }}
													</span>
												</div>
												@endif
											</div>
										</div>
										<div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-5 col-form-label">End Age <span class="text-required">*</span></label>
												<div class="col-xl-7 col-lg-7 col-sm-12 col-md-12">
													{!! Form::text('end_age1',old("end_age1", $editRegistrationFeesData->end_age1 ?: ''),['id'=>'end_age1','class'=>'form-control','placeholder'=>'END AGE']) !!}
												</div>
												@if ($errors->has('end_age1'))
													<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
													<span style="color: red;">
														{{ $errors->first('end_age1') }}
													</span>
													</div>
												@endif
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Fees Amount <span class="text-required">*</span></label>
												<div class="col-xl-9 col-lg-9 col-sm-12 col-md-12">
													{!! Form::text('fees_amount1',old("fees_amount1", $editRegistrationFeesData->fees_amount1 ?: ''),['id'=>'fees_amount1','class'=>'form-control','placeholder'=>'ENTER REGISTRATION FEES AMOUNT']) !!}
													@if ($errors->has('fees_amount1'))
													<span style="color: red;">
														{{ $errors->first('fees_amount1') }}
													</span>
													@endif
												</div>
											</div>
										</div>
									</div>
					            </div>

					            <div class="kt-separator kt-separator--border-dashed kt-separator--space-smlg"></div>

								<h3 class="kt-section__title">Age Group - 2 </h3>
								<div class="kt-section__body">
									<div class="row">
										<div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-5 col-form-label">Start Age <span class="text-required">*</span></label>
												<div class="col-xl-7 col-lg-7 col-sm-12 col-md-12">
													{!! Form::text('start_age2',old("start_age2", $editRegistrationFeesData->start_age2 ?: ''),['id'=>'start_age2','class'=>'form-control','placeholder'=>'START AGE']) !!}
												</div>
												@if ($errors->has('start_age2'))
												<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
													<span style="color: red;">
														{{ $errors->first('start_age2') }}
													</span>
												</div>
												@endif
											</div>
										</div>
										<div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-5 col-form-label">End Age <span class="text-required">*</span></label>
												<div class="col-xl-7 col-lg-7 col-sm-12 col-md-12">
													{!! Form::text('end_age2',old("end_age2", $editRegistrationFeesData->end_age2 ?: ''),['id'=>'end_age2','class'=>'form-control','placeholder'=>'END AGE']) !!}
												</div>
												@if ($errors->has('end_age2'))
												<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
													<span style="color: red;">
														{{ $errors->first('end_age2') }}
													</span>
												</div>
												@endif
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Fees Amount <span class="text-required">*</span></label>
												<div class="col-xl-9 col-lg-9 col-sm-12 col-md-12">
													{!! Form::text('fees_amount2',old("fees_amount2", $editRegistrationFeesData->fees_amount2 ?: ''),['id'=>'fees_amount2','class'=>'form-control','placeholder'=>'ENTER REGISTRATION FEES AMOUNT']) !!}
													@if ($errors->has('fees_amount2'))
													<span style="color: red;">
														{{ $errors->first('fees_amount2') }}
													</span>
													@endif
												</div>
											</div>
										</div>
									</div>
					            </div>

					            <div class="kt-separator kt-separator--border-dashed kt-separator--space-smlg"></div>

								<h3 class="kt-section__title">Age Group - 3 </h3>
								<div class="kt-section__body">
									<div class="row">
										<div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-5 col-form-label">Start Age <span class="text-required">*</span></label>
												<div class="col-xl-7 col-lg-7 col-sm-12 col-md-12">
													{!! Form::text('start_age3',old("start_age3", $editRegistrationFeesData->start_age3 ?: ''),['id'=>'start_age3','class'=>'form-control','placeholder'=>'START AGE']) !!}
												</div>
												@if ($errors->has('start_age3'))
												<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
													<span style="color: red;">
														{{ $errors->first('start_age3') }}
													</span>
												</div>
												@endif
											</div>
										</div>
										<div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-5 col-form-label">End Age <span class="text-required">*</span></label>
												<div class="col-xl-7 col-lg-7 col-sm-12 col-md-12">
													{!! Form::text('end_age3',old("end_age3", $editRegistrationFeesData->end_age3 ?: ''),['id'=>'end_age3','class'=>'form-control','placeholder'=>'END AGE']) !!}
												</div>
												@if ($errors->has('end_age3'))
												<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
													<span style="color: red;">
														{{ $errors->first('end_age3') }}
													</span>
												</div>
												@endif
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Fees Amount <span class="text-required">*</span></label>
												<div class="col-xl-9 col-lg-9 col-sm-12 col-md-12">
													{!! Form::text('fees_amount3',old("fees_amount3", $editRegistrationFeesData->fees_amount3 ?: ''),['id'=>'fees_amount3','class'=>'form-control','placeholder'=>'ENTER REGISTRATION FEES AMOUNT']) !!}
													@if ($errors->has('fees_amount3'))
													<span style="color: red;">
														{{ $errors->first('fees_amount3') }}
													</span>
													@endif
												</div>
											</div>
										</div>
									</div>
					            </div>

					            <div class="kt-separator kt-separator--border-dashed kt-separator--space-smlg"></div>

								<h3 class="kt-section__title">Age Group - 4 </h3>
								<div class="kt-section__body">
									<div class="row">
										<div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-5 col-form-label">Start Age <span class="text-required">*</span></label>
												<div class="col-xl-7 col-lg-7 col-sm-12 col-md-12">
													{!! Form::text('start_age4',old("start_age4", $editRegistrationFeesData->start_age4 ?: ''),['id'=>'start_age4','class'=>'form-control','placeholder'=>'START AGE']) !!}
												</div>
												@if ($errors->has('start_age4'))
												<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
													<span style="color: red;">
														{{ $errors->first('start_age4') }}
													</span>
												</div>
												@endif
											</div>
										</div>
										<div class="col-xl-3 col-lg-3 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-5 col-form-label">End Age <span class="text-required">*</span></label>
												<div class="col-xl-7 col-lg-7 col-sm-12 col-md-12">
													{!! Form::text('end_age4',old("end_age4", $editRegistrationFeesData->end_age4 ?: ''),['id'=>'end_age4','class'=>'form-control','placeholder'=>'END AGE']) !!}
												</div>
												@if ($errors->has('end_age4'))
												<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
													<span style="color: red;">
														{{ $errors->first('end_age4') }}
													</span>
												</div>
												@endif
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Fees Amount <span class="text-required">*</span></label>
												<div class="col-xl-9 col-lg-9 col-sm-12 col-md-12">
													{!! Form::text('fees_amount4',old("fees_amount4", $editRegistrationFeesData->fees_amount4 ?: ''),['id'=>'fees_amount4','class'=>'form-control','placeholder'=>'ENTER REGISTRATION FEES AMOUNT']) !!}
													@if ($errors->has('fees_amount4'))
													<span style="color: red;">
														{{ $errors->first('fees_amount4') }}
													</span>
													@endif
												</div>
											</div>
										</div>
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
										<a href="{{ route('registration-fees') }}" class="btn btn-secondary">Cancel</a>
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
	$('.start_date').mask('00-00-0000');		
	$('.end_date').mask('00-00-0000');		
</script>
@endsection