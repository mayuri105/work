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
						Repayment Details                
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
		
		{{-- <div class="row">
			<div class="col-xl-12 col-lg-12 "> --}}
				<div class="kt-portlet kt-portlet--mobile">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="fa fa-users" aria-hidden="true"></i>
							</span>
							{{-- <h3 class="kt-portlet__head-title">
								Repayment Details
							</h3> --}}
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<a href="{{ route('repayment') }}" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										Back
									</a>
							</div>		
						</div>
						
					</div>
					
					<div class="kt-portlet__body">
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<div class="row">
									    <div class="col-sm-4">
											@if($registration[0]['ysk_id'] != '' )
											  @php $yskid = $registration[0]['ysk_id'] @endphp
											@endif
											@if($registration[0]['pre_ysk_id'] != '')
												 @php $yskid =$registration[0]['pre_ysk_id'] @endphp
											@endif
											<span class="kt-portlet__head-title">Ysk Id :&nbsp;{{ $yskid }} </span>
										
										</div>
										<div class="col-sm-4">
											<span class="kt-portlet__head-title">Name :&nbsp;
											 {{ $registration[0]['name_as_per_yuva_sangh_org'] }}</span>
										</div>
										 @php $yskid = '-' @endphp
										
										<div class="col-sm-4">
											<span class="kt-portlet__head-title">Joining Date :&nbsp;{{ date("d-m-Y",strtotime($registration[0]['ysk_confirmation_date'])) }}</span>
										
										</div>
										
									</div>
								</div><br>
								<div class="kt-portlet__head-actions">
									<div class="row">
										<div class="col-sm-4">
											<span class="kt-portlet__head-title">Region :&nbsp;{{ $registration[0]['region_name'] }}</span>
											
										</div>
										<div class="col-sm-4">
											<span class="kt-portlet__head-title">City :&nbsp;{{ $registration[0]['fk_city_id'] }}</span>
											
										</div>
										<div class="col-sm-4">
											<span class="kt-portlet__head-title">Mobile Number :&nbsp;{{ $registration[0]['phone_number_first'] }}</span>
											
										</div>
									</div>
								</div>

							</div>		
						</div>
						{{-- <div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<h5 class="kt-portlet__head-title">
										Sahyognidhi Request
									</h5>
									<p id="sahyognidhi_request"></p>
								</div>	
							</div>		
						</div> --}}
						{{-- <div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<h5 class="kt-portlet__head-title">
										Amount
									</h5>
									<p id="totalSahyognidhiAmount"></p>
								</div>	
							</div>		
						</div> --}}
					</div>
				</div>
				@if(count($RepaymentAmountsModel)>0)
					@if($RepaymentAmountsModel[0]['payment_completed']==0)
						<div class="kt-portlet kt-portlet--mobile">
							
							<div class="kt-portlet__body">
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions" >
												<h5 class="kt-portlet__head-title">
												Pending Payment List
												</h5>
												
											</div>	
										</div>		
									</div>
									<div class="col-sm-12">
						             	<table class="table table-bordered" >
										<thead>
						                   	<tr role="row">
						                        <th >Year of Payment</th>
						                        <th >Repayment Amount</th>
						                        <th >Cheque Bouns</th>
						                        <th >Ach Bounce</th>
						                        <th >Delay Charge</th>
						                      	<th >Total Amount</th>
						                    </tr>
						                  </thead>
						                  <tbody>
						                  	@php $totalall = 0;$totalalltest = 0; @endphp
						                  	@foreach($RepaymentAmountsModel as $value)
						                  	<tr role="row">
						                        <th >{{ $value->start_year.'-'.$value->end_year }}</th>
						                        <th >{{ number_format($value->repayment_amount,2)}}</th>
						                        <th >{{ number_format($value->Cheque_bounce,2) }}@if($value->cheque_bounce_date!='')&nbsp;(&nbsp;{{ date("d-m-Y",strtotime($value->cheque_bounce_date)) }}&nbsp;)
						                        @endif</th>
						                        <th >{{ number_format($value->ach_bounce,2) }}@if($value->ach_bounce_date !='')&nbsp;(&nbsp;{{ date("d-m-Y",strtotime($value->ach_bounce_date)) }}&nbsp;)
						                        @endif</th>
						                        <th >{{ number_format($value->delay_charge,2)}}</th>
						                      	<th >@php $total = $value->repayment_amount + $value->delay_charge ;
						                      @endphp {{ number_format($total,2) }}</th>
						                      
						                      @php $totalall += $total @endphp
						                    </tr>
						                  	@endforeach
						                  	@php $totalalltest = $totalall + $RepaymentAmountsModel[0]['Cheque_bounce'] + $RepaymentAmountsModel[0]['ach_bounce']@endphp
						                  	<tr role="row">
						                        <th colspan="5" style="text-align: right"> Cheque Bouns</th>
						                        <th>{{ number_format($RepaymentAmountsModel[0]['Cheque_bounce'],2) }}</th>
						                    </tr>
						                    <tr role="row">
						                        <th colspan="5" style="text-align: right">Ach Bounce</th>
						                        <th>{{ number_format($RepaymentAmountsModel[0]['ach_bounce'],2) }}</th>
						                    </tr>
						                  	<tr role="row">
						                        <th colspan="5" style="text-align: right"> Total</th>
						                        <th>{{ number_format($totalalltest,2) }}</th>
						                    </tr>
						                  	
						                  </tbody>
						               </table>
						            </div>
							</div>
						</div>
					@endif
					
				@endif
				@if(count($RepaymentAmountsPaid)>0)
				
						<div class="kt-portlet kt-portlet--mobile">
							
							<div class="kt-portlet__body">
								<div class="kt-portlet__head-toolbar">
									<div class="kt-portlet__head-wrapper">
										<div class="kt-portlet__head-actions" >
											<h5 class="kt-portlet__head-title">
											Paid Payment List
											</h5>
											
										</div>	
									</div>		
								</div>

								<div class="col-sm-12">
						             	<table class="table table-bordered" >
										<thead>
						                   	<tr role="row">
						                        <th >Year of Payment</th>
						                        <th >Repayment Amount</th>
						                        <th >Cheque Bouns</th>
						                        <th >Ach Bounce</th>
						                        <th >Delay Charge</th>
						                      	<th >Total Amount</th>
						                    </tr>
						                  </thead>
						                  <tbody>
						                  	@php $totalallpaid = 0;$totalallpaidtest=0; @endphp
						                  	@foreach($RepaymentAmountsPaid as $value1)
						                  	<tr role="row">
						                        <th >{{ $value1->start_year.'-'.$value1->end_year }}</th>
						                        <th >{{ number_format($value1->repayment_amount,2)}}</th>
						                        <th >{{ number_format($value1->Cheque_bounce,2) }}@if($value1->cheque_bounce_date != '')&nbsp;(&nbsp;{{ date("d-m-Y",strtotime($value1->cheque_bounce_date)) }}&nbsp;)
						                        @endif</th>
						                        <th >{{ number_format($value1->ach_bounce,2) }}@if($value1->ach_bounce_date !='')&nbsp;(&nbsp;{{ date("d-m-Y",strtotime($value1->ach_bounce_date)) }}&nbsp;)
						                        @endif</th>
						                        <th >{{ number_format($value1->delay_charge,2)}}</th>
						                      	<th >@php $totalpaid = $value1->repayment_amount + $value1->delay_charge;
						                      @endphp {{ number_format($totalpaid,2) }}</th>
						                      
						                      @php $totalallpaid += $totalpaid @endphp
						                    </tr>
						                  	@endforeach
						                  	 @php $totalallpaidtest = $totalallpaid + $RepaymentAmountsPaid[0]['Cheque_bounce'] + $RepaymentAmountsPaid[0]['ach_bounce'] @endphp
						                  	<tr role="row">
						                        <th colspan="5" style="text-align: right"> Cheque Bouns</th>
						                        <th>{{ number_format($RepaymentAmountsPaid[0]['Cheque_bounce'],2) }}</th>
						                    </tr>
						                    <tr role="row">
						                        <th colspan="5" style="text-align: right">Ach Bounce</th>
						                        <th>{{ number_format($RepaymentAmountsPaid[0]['ach_bounce'],2) }}</th>
						                    </tr>
						                  	<tr role="row">
						                        <th colspan="5" style="text-align: right"> Total</th>
						                        <th>{{ number_format($totalallpaidtest,2) }}</th>
						                    </tr>
						                  </tbody>
						               </table>
					            </div>
							</div>
						</div>
					
				@endif

				@if(count($RepaymentAmountsHistory)>0)
					@foreach($RepaymentAmountsHistory as $RepaymentAmountsHistory1)
						<div class="kt-portlet kt-portlet--mobile">
							<div class="kt-portlet__head kt-portlet__head--lg">
								<div class="kt-portlet__head-label">
									<span class="kt-portlet__head-icon">
										{{-- <i class="fa fa-users" aria-hidden="true"></i> --}}
										<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill" style="background-color: #3a22ff;">{{ $RepaymentAmountsHistory1->start_year.'-'.$RepaymentAmountsHistory1->end_year }}</span>
										@if($RepaymentAmountsHistory1->payment_completed == 0)   <span class="list-and kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill" >Pending</span> @endif
										@if($RepaymentAmountsHistory1->payment_completed == 1) <span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Paid</span> @endif
									</span>
									
								</div>
								<div class="kt-portlet__head-toolbar">
									<div class="kt-portlet__head-wrapper">
										
									</div>		
								</div>
								
							</div>
							<div class="kt-portlet__body">
								<div class="kt-portlet__head-toolbar">
									<div class="kt-portlet__head-wrapper">
										@if($RepaymentAmountsHistory1->payment_completed == 1)
												{{-- cheque --}}
											@if($RepaymentAmountsHistory1->payment_status==2)
												<div class="kt-portlet__head-actions">
													<div class="row">
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Repayment Amount :&nbsp; {{  number_format($RepaymentAmountsHistory1->repayment_amount,2) }}</span>
														</div>
														<div class="col-sm-3">
															
															<span class="kt-portlet__head-title">Cheque Bounce Amount : &nbsp; 
																@if($RepaymentAmountsHistory1->bounce_status==2){{  number_format($RepaymentAmountsHistory1->Cheque_bounce,2) }}
																@else
																	-
																@endif
															</span>
														
														</div>
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Cheque Bounce Date :&nbsp;
																@if($RepaymentAmountsHistory1->cheque_bounce_date!=''){{ date("d-m-Y",strtotime( $RepaymentAmountsHistory1->cheque_bounce_date)) }}
																@else
																	-
																@endif
															</span>
														
														</div>
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Cheque Clear Date :&nbsp;
																@if($RepaymentAmountsHistory1->cheque_clear_date!=''){{ date("d-m-Y",strtotime( $RepaymentAmountsHistory1->cheque_clear_date)) }}
																@else
																	-
																@endif
															</span>
															
														</div>
														
													</div>
												</div><br>
												<div class="kt-portlet__head-actions">
													<div class="row">
														
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Bank Name : &nbsp;{{  $RepaymentAmountsHistory1->legder_name }}</span>
															
														</div>
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Ysk Member Bank Name :&nbsp;{{  $RepaymentAmountsHistory1->ysk_member_bank_name }}</span>
															
														</div>
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Branch Name :&nbsp;
																{{  $RepaymentAmountsHistory1->branch_name }}
																
															</span>
															
														</div>
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Cheque Number :&nbsp;
																{{  $RepaymentAmountsHistory1->cheque_number }}
															</span>
															
														</div>
													</div>
												</div>
											@endif
												{{-- ACH --}}
											@if($RepaymentAmountsHistory1->payment_status==1)
												<div class="kt-portlet__head-actions">
													<div class="row">
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Repayment Amount :&nbsp; {{  number_format($RepaymentAmountsHistory1->repayment_amount,2) }}</span>
														</div>
														<div class="col-sm-3">
															
															<span class="kt-portlet__head-title">ACH Bounce Amount : &nbsp; 
																@if($RepaymentAmountsHistory1->bounce_status==1){{  number_format($RepaymentAmountsHistory1->ach_bounce,2) }}
																@else
																	&nbsp; -
																@endif
															</span>
														
														</div>
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">ACH Bounce Date :&nbsp;
																@if($RepaymentAmountsHistory1->ach_bounce_date!=''){{ date("d-m-Y",strtotime( $RepaymentAmountsHistory1->ach_bounce_date)) }}
																@else
																	&nbsp; -
																@endif
															</span>
														
														</div>
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">ACH Clear Date :&nbsp;
																@if($RepaymentAmountsHistory1->ach_date!=''){{ date("d-m-Y",strtotime( $RepaymentAmountsHistory1->ach_date)) }}
																@else
																	&nbsp; -
																@endif
															</span>
															
														</div>
														
													</div>
												</div><br>
												<div class="kt-portlet__head-actions">
													<div class="row">
														
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Bank Name : &nbsp;{{  $RepaymentAmountsHistory1->legder_name }}</span>
															
														</div>
														{{-- <div class="col-sm-3">
															<span class="kt-portlet__head-title">Ysk Member Bank Name :&nbsp;{{  $RepaymentAmountsHistory1->ysk_member_bank_name }}</span>
															
														</div>
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Branch Name :&nbsp;
																{{  $RepaymentAmountsHistory1->branch_name }}
																
															</span>
															
														</div>
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Cheque Number :&nbsp;
																{{  $RepaymentAmountsHistory1->cheque_number }}
															</span>
															
														</div> --}}
													</div>
												</div>
											@endif
												{{-- Online --}}
											@if($RepaymentAmountsHistory1->payment_status==3)
												<div class="kt-portlet__head-actions">
													<div class="row">
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Repayment Amount :&nbsp; {{  number_format($RepaymentAmountsHistory1->repayment_amount,2) }}</span>
														</div>
														<div class="col-sm-3">
															
															<span class="kt-portlet__head-title">Payment Mode : &nbsp; 
																Online
															</span>
														
														</div>
														
													</div>
												</div>
											@endif
												{{-- cash Disposie --}}
											@if($RepaymentAmountsHistory1->payment_status==4)
												<div class="kt-portlet__head-actions">
													<div class="row">
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Repayment Amount :&nbsp; {{  number_format($RepaymentAmountsHistory1->repayment_amount,2) }}</span>
														</div>
														<div class="col-sm-3">
															
															<span class="kt-portlet__head-title">Payment Mode : &nbsp; 
																Cash Deposit
															</span>
														
														</div>
														
													</div>
												</div>
											@endif
												{{-- neft rtgs --}}
											@if($RepaymentAmountsHistory1->payment_status==5)
												<div class="kt-portlet__head-actions">
													<div class="row">
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Repayment Amount :&nbsp; {{  number_format($RepaymentAmountsHistory1->repayment_amount,2) }}</span>
														</div>
														<div class="col-sm-3">
															
															<span class="kt-portlet__head-title">Payment Mode : &nbsp; 
																NEFT/RTGS
															</span>
														
														</div>
														
													</div>
												</div>
											@endif
										@endif
										@if($RepaymentAmountsHistory1->payment_completed == 0)
											<div class="kt-portlet__head-actions">
													<div class="row">
														<div class="col-sm-3">
															<span class="kt-portlet__head-title">Repayment Amount :&nbsp; {{  number_format($RepaymentAmountsHistory1->repayment_amount,2) }}</span>
														</div>
													</div>
											</div>
										@endif		
									</div>		
								</div>
								
							</div>
						</div> 
					@endforeach
				@endif
			{{-- </div>		
		</div> --}}
	</div>
</div>
@endsection
@section('content_js')
<script src="{{ URL::asset('assets/js/dashboard.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	
</script>

@endsection