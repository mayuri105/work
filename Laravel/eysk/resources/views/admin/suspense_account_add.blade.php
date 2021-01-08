@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')
<!-- content -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="row" style="width: 100%;">
				<div class="col-md-6">
					<div class="kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title top-title-mtt">
								Add Suspense Account
							</h3>
						</div>
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions main-back">
								<a href="{{ route('suspense-account') }}" class="btn btn-clean btn-icon-sm back-tt">
									<i class="la la-long-arrow-left"></i>
									Back
								</a>
							</div>	
						</div>		
					</div>	

				</div>


			</div>

		</div>
	</div>
	<!-- end:: Subheader -->        


	<!-- begin:: Content -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height: 500px;">
		<!--begin::Portlet-->
		<form method="POST" action="{{ route('save-suspense-account') }}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="kt-portlet kt-portlet--tab">
				<div class="main-padding">
					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Bank
							<span class="text-danger">*</span></label>	
							<div class="col-lg-9">
								<select class="form-control kt-select2" id="kt_select23_21" name="fk_bank_id">
									<option selected disabled>Select a Bank</option>
									@foreach($bankName as $bankNames)
										<option value="{{ $bankNames->bank_name_id }}">{{ $bankNames->bank_name }}</option>
									@endforeach
								</select>
								@if ($errors->has('fk_bank_id'))
									<span style="color: red;">
										{{ $errors->first('fk_bank_id') }}
									</span>
								@endif
							</div>
						</div>	

						<div class="form-group1 m-form__group1 row">	
							<label class="col-lg-2 col-form-label">Payment Type
								<span class="text-danger">*</span>	
							</label>	
							<div class="col-lg-9">
								<div class="kt-radio-inline redio-mt">
									<label class="kt-radio">
										<input type="radio" name="payment_type" value="Debit"> Debit
										<span class="tablinks" onclick="openCity(event, 'London')"></span>
									</label>
									<label class="kt-radio">
										<input type="radio" name="payment_type" value="Credit"> Credit
										<span class="tablinks" onclick="openCity(event, 'Paris')"></span>
									</label>
								</div>
								@if ($errors->has('payment_type'))
									<span style="color: red;">
										{{ $errors->first('payment_type') }}
									</span>
								@endif


								<div class="col-sm-12">
									<div id="London" class="tabcontent tabs-r-active">
										<h3 class="check-box-title">Debit</h3>
										
											<div class="row check-box">	
												<div class="col-sm-12">
													<label>Date</label>
													<input type="text" class="form-control debit_date" placeholder="Enter Debit Date" name="debit_date" id="date" value="{{ old('date') }}">
													@if ($errors->has('debit_date'))
														<span style="color: red;">
															{{ $errors->first('debit_date') }}
														</span>
													@endif
												</div>	

												<div class="col-sm-12 padding-mt">
													<label>Amount<span class="text-danger">*</span></label>	
													<input type="text" class="form-control" placeholder="Enter Debit Amount" name="debit_amount" id="debit_amount" aria-describedby="emailHelp">
													@if ($errors->has('debit_amount'))
														<span style="color: red;">
															{{ $errors->first('debit_amount') }}
														</span>
													@endif
												</div>


												<div class="col-sm-12 padding-mt">
													<label>Detail<span class="text-danger">*</span></label>
													<textarea class="form-control" placeholder="Enter Debit Details" name="debit_details" id="details" rows="5">{{ old('details') }}</textarea>	
													@if ($errors->has('debit_details'))
														<span style="color: red;">
															{{ $errors->first('debit_details') }}
														</span>
													@endif
												</div>	

												<div class="col-sm-12 padding-mt">	
													<label>Expense Type
														<span class="text-danger">*</span></label>
														<select class="form-control kt-select2" id="kt_select25_25" name="fk_expense_type_id" style="width: 100%;">
															<option selected disabled>Select a Expense</option>
															@foreach($expenseType as $expenseTypes)
																<option value="{{ $expenseTypes->expense_type_id }}">{{ $expenseTypes->expense_type }}</option>
															@endforeach
														</select>
														@if ($errors->has('fk_expense_type_id'))
															<span style="color: red;">
																{{ $errors->first('fk_expense_type_id') }}
															</span>
														@endif
													</div>

													{{-- <div class="col-sm-12 padding-mt">	
														<label>Type
															<span class="text-danger">*</span></label>
															<select class="form-control kt-select2" id="kt_select27_27" name="type" style="width: 100%;">
																<option selected disabled>Select a Type</option>
																<option value="Registration Repayment">Registration Repayment</option>
																<option value="Registration Chequebounce">Registration Chequebounce</option>
															</select>
															@if ($errors->has('type'))
																<span style="color: red;">
																	{{ $errors->first('type') }}
																</span>
															@endif
														</div> --}}
													</div>
												</div>

												<div id="Paris" class="tabcontent">
													<h3 class="check-box-title">Credit</h3>
													<div class="row check-box">	
														<div class="col-sm-12">
															<label>Date</label>
															<input type="text" class="form-control credit_date" placeholder="Enter Credit Date" name="credit_date" value="{{ old('date') }}">
															@if ($errors->has('credit_date'))
																<span style="color: red;">
																	{{ $errors->first('credit_date') }}
																</span>
															@endif
														</div>	

														<div class="col-sm-12 padding-mt">
															<label>Amount
																<span class="text-danger">*</span></label>	
																<input type="text" class="form-control" placeholder="Enter Credit Amount" name="credit_amount" value="{{ old('amount') }}" aria-describedby="emailHelp">
																@if ($errors->has('credit_amount'))
																<span style="color: red;">
																	{{ $errors->first('credit_amount') }}
																</span>
																@endif
															</div>


															<div class="col-sm-12 padding-mt">
																<label>Detail<span class="text-danger">*</span></label>
																<textarea class="form-control" name="credit_details" id="exampleTextarea" rows="5" placeholder="Enter Details Here">{{ old('details') }}</textarea>	
																@if ($errors->has('credit_details'))
																	<span style="color: red;">
																		{{ $errors->first('credit_details') }}
																	</span>
																@endif
															</div>	
														</div>
													</div>
												</div>
											</div>
										</div>

									<div class="main-padding">
										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label"></label>	
											<div class="col-lg-9">
												<div class="kt-portlet__head-toolbar">
													<div class="kt-portlet__head-wrapper">
														<div class="kt-portlet__head-actions">
															<input type="submit" name="submit" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" value="  Add  ">
															<a href="{{ route('suspense-account') }}" class="btn-cancel-registration">Cancel</a>
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
<!--end::Portlet-->
@endsection
@section('content_js')
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

<script type="text/javascript">
	$("#kt_select23_21").select2();
	$("#kt_select25_25").select2();
	$("#kt_select27_27").select2();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
	$('.debit_date').mask('00-00-0000');		
	$('.credit_date').mask('00-00-0000');			
</script>
@endsection