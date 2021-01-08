@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{{-- <script type='text/javascript'
  src='http://code.jquery.com/jquery-2.0.0b1.js'></script> --}}
{{-- <link rel="stylesheet" type="text/css"
  href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css"> --}}
{{-- <script type='text/javascript'
  src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script> --}}
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Sahyognidhi Manpower
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
		<div class="row">

			<div class="col-xl-4 col-lg-3 order-lg-1 order-xl-1">
				@include('elements.left_bar')
			</div>
			<div class="col-xl-4 col-lg-9 order-lg-1 order-xl-1">
				<div class="kt-portlet kt-portlet--mobile">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="fa fa-users" aria-hidden="true"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								Sahyognidhi Manpower
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<a href="{{ route('sahyognidhi-manpower-view') }}" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										Back
									</a>
							</div>
						</div>

					</div>
					{{-- <div class="kt-portlet__foot">
						<div class="kt-form__actions">

								@csrf
							<div class="row">
								<div class="col-lg-5">
									<select class="form-control" name="start_year" id="start_year">
										<option selected disabled>Select Start Year</option>
										@for ($year=2009; $year <= date('Y'); $year++)
										<option value="{{ $year }}">{{ $year }}</option>
										@endfor
									</select>
									 @if ($errors->has('start_year'))
									<span style="color: red;">
										{{ $errors->first('start_year') }}
									</span>
									@endif
								</div>
								<div class="col-lg-5">
									<select class="form-control" name="end_year" id="end_year">
										<option selected disabled>Select End Year</option>
										@for ($year=2009; $year <= date('Y'); $year++)
										<option value="{{ $year }}">{{ $year }}</option>
										@endfor
									</select>
									@if ($errors->has('end_year'))
									<span style="color: red;">
										{{ $errors->first('end_year') }}
									</span>
									@endif
									<p style="color: red;display: none;" id="errormsg">bgfdfcghjbkm</p>
								</div>

								<div class="kt-portlet__foot">
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-lg-2"></div>
											<div class="col-lg-10">
												<input type="submit" class="btn btn-success" id="get_data" value="Submit" style="margin-left: -450px;margin-top: 30px;">
											</div>

										</div>
									</div>
								</div>
							</div>

						</div><br>
						<div class="kt-portlet__foot"></div>
					</div> --}}
					<div class="kt-portlet__body">
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions" style="margin-left: 456px;margin-top: -16px;">
									<h5 class="kt-portlet__head-title">
										Age Group
									</h5>
									<div class="row">
										<div class="col-sm-3">
											<span class="kt-portlet__head-title">{{ $RegistrationFee[0]['start_age1'] }} to {{ $RegistrationFee[0]['end_age1'] }}</span>
											<p id="get18To30">{{ $getLastYearAmount[0]['total_group1_people'] }}</p>
										</div>

										<div class="col-sm-2">
											<span class="kt-portlet__head-title">{{ $RegistrationFee[0]['start_age2'] }} to {{ $RegistrationFee[0]['end_age2'] }}</span>
											<p id="get31To37">{{ $getLastYearAmount[0]['total_group2_people'] }}</p>
										</div>
										<div class="col-sm-2">
											<span class="kt-portlet__head-title">{{ $RegistrationFee[0]['start_age3'] }} to {{ $RegistrationFee[0]['end_age3'] }}</span>
											<p id="get38To47">{{ $getLastYearAmount[0]['total_group3_people'] }}</p>
										</div>
										<div class="col-sm-2">
											<span class="kt-portlet__head-title">{{ $RegistrationFee[0]['start_age4'] }} to {{ $RegistrationFee[0]['end_age4'] }}</span>
											<p id="get48To55">{{ $getLastYearAmount[0]['total_group4_people'] }}</p>
										</div>
										<div class="col-sm-2">
											<span class="kt-portlet__head-title">YSK Mitra</span>
											<p id="ysk">{{ $getLastYearAmount[0]['total_group5_people'] }}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-portlet__head-toolbar" style="margin-top: -76px;">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<h5 class="kt-portlet__head-title">
										Sahyognidhi Request
									</h5>
									<p id="sahyognidhi_request">{{ $getLastYearAmount[0]['total_sahyognidhi_request'] }}</p>
								</div>
							</div>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<h5 class="kt-portlet__head-title">
										Amount
									</h5>
									<p id="totalSahyognidhiAmount">{{ $getLastYearAmount[0]['total_sahyognidhi_amount'] }}</p>
								</div>
							</div>
						</div>
					</div>
					 {{-- <form>  --}}
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="kt-portlet__body">
							<div class="kt-form__section kt-form__section--first">

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Reserve Funds<span class="text-required">*</span></label>
									<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
										<input type="text" class="form-control" id="reserveFundPercentage" name="reserve_fund_percentage" placeholder="Enter Reserve Funds" value="{{ $getLastYearAmount[0]['reserve_fund_percentage'] }}" readonly style="border: none;">
										@if ($errors->has('reserve_fund_percentage'))
										<span style="color: red;">
											{{ $errors->first('reserve_fund_percentage') }}
										</span>
										@endif
									</div>
									<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
										{{-- <span class="col-lg-2 col-form-label">Amount</span> --}}
										<input type="text" class="form-control" id="totalReserveFundAmount" name="reserve_fund_amount" placeholder="Reserve Fund Amount" value="{{ $getLastYearAmount[0]['reserve_fund_amount'] }}" readonly style="border: none;">
										@if ($errors->has('reserve_fund_amount'))
										<span style="color: red;">
											{{ $errors->first('reserve_fund_amount') }}
										</span>
										@endif
									</div>
									<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
										{{-- <span class="col-lg-2 col-form-label">Last Year Reserve Fund</span> --}}
										<input type="text" class="form-control" id="lastYearReserveFund" name="last_year_reserve_fund_amount" placeholder="Last Year Reserve Fund" value="{{ $getLastYearAmount[0]['last_year_reserve_fund_amount'] }}" readonly style="border: none;">
										@if ($errors->has('last_year_reserve_fund_amount'))
										<span style="color: red;">
											{{ $errors->first('last_year_reserve_fund_amount') }}
										</span>
										@endif
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Drop Ratio <span class="text-required">*</span></label>
									<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
										<span class="col-lg-2 col-form-label">Percentage</span>
										<input type="text" class="form-control" name="drop_ratio_percentage" placeholder="Enter Drop Ratio" value="{{ $getLastYearAmount[0]['drop_ratio_percentage'] }}" onchange="dropRatioAmount(this.value)" style="border: none;">

										@if ($errors->has('drop_ratio_percentage'))
										<span style="color: red;">
											{{ $errors->first('drop_ratio_percentage') }}
										</span>
										@endif
									</div>
									<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
										<span class="col-lg-2 col-form-label">Amount</span>
										<input type="text" class="form-control" id="drop_ratio_amount" name="round_up_drop_ratio_amount" placeholder="Enter Amount" value="{{ $getLastYearAmount[0]['round_up_drop_ratio_amount'] }}" readonly style="border: none;" >
										@if ($errors->has('round_up_drop_ratio_amount'))
										<span style="color: red;">
											{{ $errors->first('round_up_drop_ratio_amount') }}
										</span>
										@endif
									</div>
									<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
										<span class="col-lg-2 col-form-label">Difference Amount</span>
										<input type="text" class="form-control" name="actual_drop_ratio_amount" placeholder="Enter Difference Amount" value="" readonly style="border: none;">
										@if ($errors->has('actual_drop_ratio_amount'))
										<span style="color: red;">
											{{ $errors->first('actual_drop_ratio_amount') }}
										</span>
										@endif
									</div>
								</div>


									<div class="form-group row details">


										<label class="col-lg-2 col-form-label">Income Ledger Account</label>
										<div class="registration-list-modal">

												<div class="row">
													<div class="col-xl-4 col-lg-4 col-sm-5 col-md-5" style="margin-left: 10px;">
                                                        @foreach($incomeLedgerAccount as $incomeLedgerAccounts)

                                                                <input type="text" name="lg" value="{{ $incomeLedgerAccounts->legder_name }}" readonly style="border: none;">


                                                        @endforeach


														</div>
														@if ($errors->has('fk_ledger_account_id'))
														<span style="color: red;">
															{{ $errors->first('fk_ledger_account_id') }}
														</span>
														@endif
													{{-- </div> --}}
													<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2" style="padding-left: 33px;"></div>
													<div class="col-xl-4 col-lg-4 col-sm-5 col-md-5" style="padding-left: 33px;">
                                                        <?php if(!empty($LedgerModel)){ foreach ($LedgerModel as $ledgeraccount){
														echo'<input type="text" class="form-control addAmount" name="reduct_amount" id="addAmount1" aria-describedby="emailHelp" value='.$ledgeraccount->reduct_amount.' placeholder="Enter Amount"  onchange="getTotalAmount(this.value,1)" readonly style="border: none;">';
														} }?>
														@if ($errors->has('reduct_amount'))
														<span style="color: red;">
															{{ $errors->first('reduct_amount') }}
														</span>
														@endif
													</div>

												</div> <br>

										</div>


									</div>


								<input type="text" class="form-control totalAmount" name="total_amount" aria-describedby="emailHelp" placeholder="Total Amount" style="width: 215px;float: right; border: none;" value="{{ $getLastYearAmount[0]['total_amount'] }}" readonly>
								<input type="hidden" name="hidden_start_year" id="hidden_start_year">
								<input type="hidden" name="hidden_end_year" id="hidden_end_year">
								<input type="hidden" name="total_sahyognidhi_request" id="total_sahyognidhi_request">
								<input type="hidden" name="total_sahyognidhi_amount" id="total_sahyognidhi_amount">

							</div>
						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-10">
										{{-- <input type="submit" class="btn btn-success" id="submit_form" value="Submit" style="float: right;"> --}}
									</div>

								</div>
							</div>
						</div>
					{{--  </form>  --}}

				</div>
				<div class="kt-portlet kt-portlet--mobile" style="margin-top: -10px;">
					{{-- <form class="kt-form" action="" method="POST" style="margin-top: -5px;"> --}}
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="kt-portlet__body">
						<div class="kt-form__section kt-form__section--first">
							<h4>Age Group</h4>
							<div class="form-group row">
								<div class="col-xl-2 col-lg-2 col-sm-3 col-md-3">
									<span class="col-lg-2 col-form-label">{{$RegistrationFee[0]['start_age1']}} to {{$RegistrationFee[0]['end_age1']}}</span>
									<p class="col-lg-2 col-form-label" id="amountGiven18To30">{{number_format($refundpayment[0],2)}}</p>
								</div>
								<div class="col-xl-2 col-lg-2 col-sm-3 col-md-3">
									<span class="col-lg-2 col-form-label">{{$RegistrationFee[0]['start_age2']}} to {{$RegistrationFee[0]['end_age2']}}</span>
									<p class="col-lg-2 col-form-label" id="amountGiven31To37">{{number_format($refundpayment[1],2)}}</p>
								</div>
								<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
									<span class="col-lg-2 col-form-label">{{$RegistrationFee[0]['start_age3']}} to {{$RegistrationFee[0]['end_age3']}}</span>
									<p class="col-lg-2 col-form-label" id="amountGiven38To47">{{number_format($refundpayment[2],2)}}</p>
								</div>
								<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
									<span class="col-lg-2 col-form-label">{{$RegistrationFee[0]['start_age4']}} to {{$RegistrationFee[0]['end_age4']}}</span>
									<p class="col-lg-2 col-form-label" id="amountGiven48To55">{{number_format($refundpayment[3],2)}}</p>
								</div>
								<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
									<span class="col-lg-2 col-form-label">YSK Mitra</span>
									<p class="col-lg-2 col-form-label" id="ysk">{{number_format($refundpayment[3],2)}}</p>
								</div>
							</div>
								<div class="form-group row" >
									<div id="MonthData"></div>
									<div class="col-xl-3 col-lg-3 col-sm-3 col-md-3">
										<span class="col-lg-3 col-form-label" style="font-weight: bold;">Registration Month</span>
										@foreach ($month_name as $key => $monthnamevalue)
											<p class="col-lg-3 col-form-label">{{$monthnamevalue}}</p>
										@endforeach
									</div>
									<div class="col-xl-3 col-lg-3 col-sm-3 col-md-3">
										<p class="col-lg-3 col-form-label" style="font-weight: bold;">Join Member</p>
										@foreach ($TotalRegistered as $key => $TotalRegisteredvalue)
											<span class="col-lg-3 col-form-label" id="newRegistrationApril">{{$TotalRegisteredvalue}}&nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle" title="18 to 30 - {{$MonthData[$key][0]}},31 to 37 - {{$MonthData[$key][1]}}<br>,38 to 47 - {{$MonthData[$key][2]}},48 to 55 - {{$MonthData[$key][3]}},Ysk Mitra - {{$MonthData[$key][4]}}" style="color: red;"></i></span>
											<br><br>
										@endforeach
									</div>
									<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
										<span class="col-lg-2 col-form-label" style="font-weight: bold;">Expected Amount</span>
										@foreach ($ExpectedData as $key => $ExpectedDatavalue)
											<p class="col-lg-2 col-form-label" id="monthRepaymentOfApril">{{number_format($ExpectedDatavalue[0],2)}}</p>
										@endforeach

									</div>
									<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
										<span class="col-lg-2 col-form-label" style="font-weight: bold;">Received Amount</span>
										@foreach ($ExpectedData as $key => $ExpectedDatavalue)
											<p class="col-lg-2 col-form-label" id="monthRepaymentOfApril">{{number_format($ExpectedDatavalue[1],2)}}</p>
										@endforeach
									</div>
									<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
										<span class="col-lg-2 col-form-label" style="font-weight: bold;">Difference Amount</span>
										@foreach ($ExpectedData as $key => $ExpectedDatavalue)
											<p class="col-lg-2 col-form-label" id="monthRepaymentOfApril">{{number_format($ExpectedDatavalue[2],2)}}</p>
										@endforeach

									</div>
								</div>
								<div class="kt-portlet__foot">
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-lg-3" style="font-weight: bold;">Total</div>
											<div class="col-lg-3" style="font-weight: bold;"><span>{{array_sum($TotalRegistered)}}</span></div>
											<div class="col-lg-2" style="font-weight: bold;"><span>{{number_format(array_sum($ExpectedTotal),2)}}</span></div>
											<div class="col-lg-2" style="font-weight: bold;"><span>{{number_format(array_sum($RealTotal),2)}}</span></div>
											<div class="col-lg-2" style="font-weight: bold;"><span>{{number_format(array_sum($diffTotal),2)}}</span></div>
										</div>
									</div>
								</div>
								<h4>Age Group</h4>
								<div class="form-group row">
									<div class="col-xl-2 col-lg-2 col-sm-3 col-md-3">
										<span class="col-lg-2 col-form-label">18 to 30</span>
										<p class="col-lg-2 col-form-label">{{number_format($refundpaymentSecond[0],2)}}</p>
									</div>
									<div class="col-xl-2 col-lg-2 col-sm-3 col-md-3">
										<span class="col-lg-2 col-form-label">31 to 37</span>
										<p class="col-lg-2 col-form-label">{{number_format($refundpaymentSecond[1],2)}}</p>
									</div>
									<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
										<span class="col-lg-2 col-form-label">38 to 47</span>
										<p class="col-lg-2 col-form-label">{{number_format($refundpaymentSecond[2],2)}}</p>
									</div>
									<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
										<span class="col-lg-2 col-form-label">48 to 55</span>
										<p class="col-lg-2 col-form-label">{{number_format($refundpaymentSecond[3],2)}}</p>
									</div>
									<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
										<span class="col-lg-2 col-form-label">YSK Mitra</span>
										<p class="col-lg-2 col-form-label">{{number_format($refundpaymentSecond[3],2)}}</p>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Admin Charge<span class="text-required">*</span></label>
									<div class="col-xl-5 col-lg-5 col-sm-6 col-md-6">
										<input type="text" class="form-control" name="admin_charge" placeholder="Enter Admin Charge" value="{{ $RefundpaymentAmounts[0]['admin_charge'] }}" id="admin_charge" readonly style="border: none;">
									</div>
								</div>
							</div>
						</div>

						<div class="kt-portlet__foot">
							<form class="kt-form" action="" method="POST" style="margin-top: -5px;">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="kt-portlet__body">
									<div class="kt-form__section kt-form__section--first">
										<h4>Age Group</h4>
										<div class="form-group row">
											<div class="col-xl-3 col-lg-3 col-sm-3 col-md-3">
												<span class="col-lg-1 col-form-label">{{ $RegistrationFee[0]['start_age1'] }} to {{ $RegistrationFee[0]['end_age1']}}</span>
												<p class="col-lg-2 col-form-label"><?= !empty($amountfinals) ? $amountfinals->group1:''?></p>
												<input type="text" class="form-control" name="drop_ratio" value="<?= !empty($amountfinals) ? $amountfinals->group1roudup:''?>" placeholder="Enter Round Off Amount" style="border: none;" readonly>

												@if ($errors->has('drop_ratio'))
												<span style="color: red;">
													{{ $errors->first('drop_ratio') }}
												</span>
												@endif
											</div>
											<div class="col-xl-3 col-lg-3 col-sm-3 col-md-3">
												<span class="col-lg-1 col-form-label">{{ $RegistrationFee[0]['start_age2'] }} to {{ $RegistrationFee[0]['end_age2']}}</span>
												<p class="col-lg-2 col-form-label"><?= !empty($amountfinals) ? $amountfinals->group2:''?></p>
												<input type="text" class="form-control" name="drop_ratio" value="<?= !empty($amountfinals) ? $amountfinals->group2roudup:''?>" placeholder="Enter Round Off Amount" style="border: none;" readonly>
												@if ($errors->has('drop_ratio_amount'))
												<span style="color: red;">
													{{ $errors->first('drop_ratio_amount') }}
												</span>
												@endif
											</div>
											<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
												<span class="col-lg-1 col-form-label">{{ $RegistrationFee[0]['start_age3'] }} to {{ $RegistrationFee[0]['end_age3']}}</span>
												<p class="col-lg-1 col-form-label"><?= !empty($amountfinals) ? $amountfinals->group3:''?></p>
												<input type="text" class="form-control" name="drop_ratio" value="<?= !empty($amountfinals) ? $amountfinals->group3roudup:''?>" placeholder="Enter Round Off Amount" style="border: none;" readonly>
												@if ($errors->has('drop_ratio_difference_amount'))
												<span style="color: red;">
													{{ $errors->first('drop_ratio_difference_amount') }}
												</span>
												@endif
											</div>
											<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
												<span class="col-lg-1 col-form-label">{{ $RegistrationFee[0]['start_age4'] }} to {{ $RegistrationFee[0]['end_age4']}}</span>
												<p class="col-lg-1 col-form-label"><?= !empty($amountfinals) ? $amountfinals->group4:''?></p>
												<input type="text" class="form-control" name="drop_ratio" value="<?= !empty($amountfinals) ? $amountfinals->group4roudup:''?>" placeholder="Enter Round Off Amount" style="border: none;" readonly>
												@if ($errors->has('drop_ratio_difference_amount'))
												<span style="color: red;">
													{{ $errors->first('drop_ratio_difference_amount') }}
												</span>
												@endif
											</div>
											<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2">
												<span class="col-lg-1 col-form-label">YSK Mitra</span>
												<p class="col-lg-1 col-form-label"><?= !empty($amountfinals) ? $amountfinals->group5:''?></p>
												<input type="text" class="form-control" name="drop_ratio" value="<?= !empty($amountfinals) ? $amountfinals->group5roudup:''?>" placeholder="Enter Round Off Amount" style="border: none;" readonly>

												@if ($errors->has('drop_ratio'))
												<span style="color: red;">
													{{ $errors->first('drop_ratio') }}
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
												{{-- <input type="submit" class="btn btn-success" value="Submit" style="float: right;"> --}}
											</div>

										</div>
									</div>
								</div>
							</form>
						</div>
					{{-- </form> --}}

				</div>
			</div>

		</div>
	</div>
</div>
@endsection
@section('content_js')
<script src="{{ URL::asset('assets/js/dashboard.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

</script>

@endsection
