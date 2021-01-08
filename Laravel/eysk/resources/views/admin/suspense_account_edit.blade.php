@extends('elements.admin_master',array('accessData'=>$accessData))
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
								Edit Suspense Account                           
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
							<a href="{{ route('suspense-account') }}">
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


	<!-- begin:: Content -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height: 500px;">
		<!--begin::Portlet-->
		<form method="POST" action="{{ route('update-suspense-account') }}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="kt-portlet kt-portlet--tab">
				<div class="main-padding">

					<div class="form-group1 m-form__group1 row">  
						<label class="col-lg-2 col-form-label">Payment Date
							<span class="text-danger">*</span>
						</label>  
						<div class="col-lg-9">
							<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ date('d-m-Y',strtotime($editSuspenseAccount['date'])) }}" name="today_date" readonly>
							@if ($errors->has('today_date'))
							<span style="color: red;">
								{{ $errors->first('today_date') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">YSK Bank Name
							<span class="text-danger">*</span></label>	
							<div class="col-lg-9">
								<select class="form-control kt-select2" id="kt_select23_21" name="fk_bank_id">
									<option selected disabled>Select a Bank</option>
									@foreach($bankName as $bankNames)
										@if($editSuspenseAccount->fk_bank_id == $bankNames->ledger_account_id)
											<option selected value="{{ $bankNames->ledger_account_id }}">{{ $bankNames->legder_name }}</option>
										@endif
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
										<input type="radio" name="payment_type" value="Debit" {{ (isset($editSuspenseAccount) && $editSuspenseAccount->payment_type=='Debit')?'checked':'disabled' }}> Debit
										<span class="tablinks" onclick="openCity(event, 'London')"></span>
									</label>
									<label class="kt-radio">
										<input type="radio" name="payment_type" value="Credit" {{ (isset($editSuspenseAccount) && $editSuspenseAccount->payment_type=='Credit')?'checked':'disabled' }}> Credit
										<span class="tablinks" onclick="openCity(event, 'Paris')"></span>
									</label>
								</div>
								@if ($errors->has('payment_type'))
									<span style="color: red;">
										{{ $errors->first('payment_type') }}
									</span>
								@endif


								{{-- <div class="col-sm-12">
									<div id="London" class="tabcontent tabs-r-active">
										<h3 class="check-box-title">Debit</h3>
										
											<div class="row check-box">	
												<div class="col-sm-12">
													<label>Date</label>
													<input type="text" class="form-control debit_date" placeholder="Enter Debit Date" name="debit_date" id="date" value="@if($editSuspenseAccount['payment_type']=='Debit') {{ date("d-m-Y", strtotime($editSuspenseAccount['date']))  }} @endif">
													@if ($errors->has('debit_date'))
														<span style="color: red;">
															{{ $errors->first('debit_date') }}
														</span>
													@endif
												</div>	

												<div class="col-sm-12 padding-mt">
													<label>Amount<span class="text-danger">*</span></label>	
													<input type="text" class="form-control" placeholder="Enter Debit Amount" name="debit_amount" id="debit_amount" aria-describedby="emailHelp" value="@if($editSuspenseAccount['payment_type']=='Debit') {{ $editSuspenseAccount['amount'] }} @endif">
													@if ($errors->has('debit_amount'))
														<span style="color: red;">
															{{ $errors->first('debit_amount') }}
														</span>
													@endif
												</div>


												<div class="col-sm-12 padding-mt">
													<label>Detail<span class="text-danger">*</span></label>
													<textarea class="form-control" placeholder="Enter Debit Details" name="debit_details" id="details" rows="5">
														@if($editSuspenseAccount['payment_type']=='Debit')
															{{ $editSuspenseAccount['details'] }}
														@endif 
													</textarea>	
													@if ($errors->has('debit_details'))
														<span style="color: red;">
															{{ $errors->first('debit_details') }}
														</span>
													@endif
												</div>	

												<div class="col-sm-12 padding-mt">	
													<label>Expense Type
														<span class="text-danger">*</span></label>
														<select class="form-control kt-select2" id="fk_expense_type_id" onchange="function1()" name="fk_expense_type_id" style="width: 100%;">
															<option selected disabled>Select a Expense</option>
															@foreach($expenseType as $expenseTypes)
																<option @if($editSuspenseAccount->payment_type == 'Debit') @if($editSuspenseAccount['fk_payment_for'] == $expenseTypes->expense_type_id) selected @endif @endif value="{{ $expenseTypes->expense_type_id }}">{{ $expenseTypes->expense_type }}</option>
															@endforeach
																<option value="Divangat">Divangat</option>
														</select>
														@if ($errors->has('fk_expense_type_id'))
															<span style="color: red;">
																{{ $errors->first('fk_expense_type_id') }}
															</span>
														@endif
													</div>
													</div>
												</div>

												<div id="Paris" class="tabcontent">
													<h3 class="check-box-title">Credit</h3>
													<div class="row check-box">	
														<div class="col-sm-12">
															<label>Date</label>
															<input type="text" class="form-control credit_date" placeholder="Enter Credit Date" name="credit_date" value="@if($editSuspenseAccount['payment_type']=='Credit') {{ date("d-m-Y", strtotime($editSuspenseAccount['date']))  }} @endif">
															@if ($errors->has('credit_date'))
																<span style="color: red;">
																	{{ $errors->first('credit_date') }}
																</span>
															@endif
														</div>	

														<div class="col-sm-12 padding-mt">
															<label>Amount
																<span class="text-danger">*</span></label>	
																<input type="text" class="form-control" placeholder="Enter Credit Amount" name="credit_amount" value="@if($editSuspenseAccount['payment_type']=='Credit') {{ $editSuspenseAccount['amount'] }} @endif" aria-describedby="emailHelp">
																@if ($errors->has('credit_amount'))
																<span style="color: red;">
																	{{ $errors->first('credit_amount') }}
																</span>
																@endif
															</div>


															<div class="col-sm-12 padding-mt">
																<label>Detail<span class="text-danger">*</span></label>
																<textarea class="form-control" placeholder="Enter Credit Details" name="credit_details" id="exampleTextarea" rows="5">@if($editSuspenseAccount['payment_type']=='Credit') {{ $editSuspenseAccount['details'] }} @endif</textarea>	
																@if ($errors->has('credit_details'))
																	<span style="color: red;">
																		{{ $errors->first('credit_details') }}
																	</span>
																@endif
															</div>	

															<div class="col-sm-12 padding-mt">	
																<label>Behalf Of Payment
																	<span class="text-danger">*</span></label>
																	<select class="form-control kt-select2" id="behalf_of_payment_id" name="fk_behalf_of_payment_id" style="width: 100%;">
																		<option selected disabled>Select Type</option>

																		@foreach($behalfOfPayment as $behalfOfPayments)
																		<option @if($editSuspenseAccount->payment_type == 'Credit') @if($editSuspenseAccount['fk_payment_for'] == $behalfOfPayments->behalf_of_payment_id) selected @endif @endif value="{{ $behalfOfPayments->behalf_of_payment_id }}">{{ $behalfOfPayments->behalf_of_payment }}</option>
																		@endforeach
																	</select>
																	@if ($errors->has('fk_behalf_of_payment_id'))
																	<span style="color: red;">
																		{{ $errors->first('fk_behalf_of_payment_id') }}
																	</span>
																	@endif
																</div>


														</div>
													</div>
												</div> --}}
											</div>
										</div>

										{{-- <div class="form-group1 m-form__group1 row">  
											<label class="col-lg-2 col-form-label">Ledger Account
												<span class="text-danger">*</span>
											</label>  
											<div class="col-lg-9">
												<select class="form-control kt-select2" id="behalf_of_payment_id" name="ledger_account" style="width: 100%;">
													<option selected disabled>Select Account</option>			
													<option value="User Ledger">User Ledger</option>
												</select>
												@if ($errors->has('ledger_account'))
												<span style="color: red;">
													{{ $errors->first('ledger_account') }}
												</span>
												@endif
											</div>
										</div>  --}}

										<div class="form-group1 m-form__group1 row details">	
											<label class="col-lg-2 col-form-label">Ledger Account
												<span class="text-danger">*</span>
											</label>
											<div class="registration-list-modal">
												<div class="row" style="width: 152%;padding-left: 10px;">	
													<div class="col-lg-4">	
														<label>Ledger Account</label>
														<div>
															<select class="form-control kt-select2" id="user_name1" onchange="getRegistrationAmount(this.value,1)" name="fk_registration_id[]" style="width: 320px;">
																<option selected disabled>Select User</option>
																@foreach($sunCreaditorData as $sunCreaditorData)
																<option value="{{ $sunCreaditorData->registration_id }}">
																	@if($sunCreaditorData->ysk_id != "" && $sunCreaditorData->ysk_confirmation_date == '0000-00-00' && $sunCreaditorData->difference_amount == ''){{ $sunCreaditorData->name_as_per_yuva_sangh_org }}(Ysk- {{ $sunCreaditorData->ysk_id }})(Region- {{ $sunCreaditorData->region_name }})(PendingAmount- {{ floor($sunCreaditorData->registration_amount) }})
																	
																	@elseif($sunCreaditorData->ysk_id != "" && $sunCreaditorData->ysk_confirmation_date == '0000-00-00' && $sunCreaditorData->difference_amount != ''){{ $sunCreaditorData->name_as_per_yuva_sangh_org }}(Ysk- {{ $sunCreaditorData->ysk_id }})(Region- {{ $sunCreaditorData->region_name }})(PendingAmount- {{ floor($sunCreaditorData->difference_amount) }})

																	@elseif($sunCreaditorData->ysk_id != "" && $sunCreaditorData->ysk_confirmation_date != '0000-00-00'){{ $sunCreaditorData->name_as_per_yuva_sangh_org }}(Ysk- {{ $sunCreaditorData->ysk_id }})(Region- {{ $sunCreaditorData->region_name }})

																	@elseif($sunCreaditorData->ysk_id == "" && $sunCreaditorData->ysk_confirmation_date == '0000-00-00' && $sunCreaditorData->difference_amount == ''){{ $sunCreaditorData->name_as_per_yuva_sangh_org }}(ProcessingId- {{  $sunCreaditorData->processing_id }}))(Region- {{ $sunCreaditorData->region_name }})(PendingAmount- {{ floor($sunCreaditorData->registration_amount) }})
																	
																	@elseif($sunCreaditorData->ysk_id == "" && $sunCreaditorData->ysk_confirmation_date == '0000-00-00' && $sunCreaditorData->difference_amount != ''){{ $sunCreaditorData->name_as_per_yuva_sangh_org }}(ProcessingId- {{  $sunCreaditorData->processing_id }}))(Region- {{ $sunCreaditorData->region_name }})(PendingAmount- {{ floor($sunCreaditorData->difference_amount) }})

																	@elseif($sunCreaditorData->pre_ysk_id != "" && $sunCreaditorData->ysk_confirmation_date != '0000-00-00'){{ $sunCreaditorData->name_as_per_yuva_sangh_org }}(PreYsk- {{ $sunCreaditorData->pre_ysk_id }})(Region- {{ $sunCreaditorData->region_name }}) 
																	@endif</option>
																@endforeach
															</select>
														</div>		
														@if ($errors->has('fk_registration_id'))
														<span style="color: red;">
															{{ $errors->first('fk_registration_id') }}
														</span>
														@endif	
													</div>
													<div class="col-lg-6" style="padding-left: 40px;">
														<label>Amount</label>	
														<input type="text" class="form-control addAmount" placeholder="Enter Amount" name="amount[]" id="addAmount1" aria-describedby="emailHelp">
														@if ($errors->has('amount'))
														<span style="color: red;">
															{{ $errors->first('amount') }}
														</span>
														@endif
													</div>
													<div class="col-lg-2" style="margin-top: 34px;">
														<a href="javascript:void(0);" class="nominee-details-add add_button" title="Add field"><i class="la la-plus"></i></a>
													</div>
												</div>
												<div class="field_wrapper">

												</div>
											</div>
										</div> 

										<div class="form-group1 m-form__group1 row">  
											<label class="col-lg-2 col-form-label">Amount
												<span class="text-danger">*</span>
											</label>  
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $editSuspenseAccount['amount'] }}" id="total_amount" name="total_amount" placeholder="ENTER AMOUNT" readonly>
												@if ($errors->has('total_amount'))
												<span style="color: red;">
													{{ $errors->first('total_amount') }}
												</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">  
											<label class="col-lg-2 col-form-label">Cheque No
											</label>  
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $editSuspenseAccount['cheque_number'] }}" id="cheque_number" name="cheque_number" placeholder="ENTER CHEQUE NUMBER" readonly>
												@if ($errors->has('cheque_number'))
												<span style="color: red;">
													{{ $errors->first('cheque_number') }}
												</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">  
											<label class="col-lg-2 col-form-label">Transaction Id
											</label>  
											<div class="col-lg-9">
												<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $editSuspenseAccount['transaction_id']}}" id="transaction_id" name="transaction_id" placeholder="ENTER TRANSACTION ID" readonly>
												@if ($errors->has('transaction_id'))
												<span style="color: red;">
													{{ $errors->first('transaction_id') }}
												</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">  
											<label class="col-lg-2 col-form-label">Narration
											</label>  
											<div class="col-lg-9">
												<textarea class="form-control" id="narration" name="details" placeholder="ENTER DETAILS" rows="4" cols="5" readonly>{{ strtoupper($editSuspenseAccount['details']) }}</textarea>
												@if ($errors->has('details'))
												<span style="color: red;">
													{{ $errors->first('details') }}
												</span>
												@endif
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Payment Mode
												<span class="text-danger">*</span>	
											</label>	
											<div class="col-lg-9">
												<div class="kt-radio-inline redio-mt">
													<label class="kt-radio">
														<input type="radio" {{ (isset($editSuspenseAccount) && $editSuspenseAccount->payment_mode=='Cash Deposit')?'checked':'disabled' }} name="payment_mode" value="Cash Deposit"> Cash Deposit
														<span class="tablinks"></span>
													</label>
													<label class="kt-radio">
														<input type="radio" {{ (isset($editSuspenseAccount) && $editSuspenseAccount->payment_mode=='NEFT / RTGS')?'checked':'disabled' }} name="payment_mode" value="NEFT / RTGS"> NEFT / RTGS
														<span class="tablinks"></span>
													</label>
													<label class="kt-radio">
														<input type="radio" {{ (isset($editSuspenseAccount) && $editSuspenseAccount->payment_mode=='Cheque')?'checked':'disabled' }} name="payment_mode" value="Cheque"> Cheque
														<span class="tablinks"></span>
													</label>
													<label class="kt-radio">
														<input type="radio" {{ (isset($editSuspenseAccount) && $editSuspenseAccount->payment_mode=='Online')?'checked':'disabled' }} name="payment_mode" value="Online"> Online
														<span class="tablinks"></span>
													</label>
												</div>
												@if ($errors->has('payment_mode'))
												<span style="color: red;">
													{{ $errors->first('payment_mode') }}
												</span>
												@endif
											</div>
										</div>

										<input type="hidden" name="editId" value="{{ $editSuspenseAccount['suspense_account_id'] }}">

									<div class="main-padding">
										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label"></label>	
											<div class="col-lg-9">
												<div class="kt-portlet__head-toolbar">
													<div class="kt-portlet__head-wrapper">
														<div class="kt-portlet__head-actions">
															<input type="submit" name="submit" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" value="  Edit  ">
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
	$("#behalf_of_payment_id").select2();
	$("#user_name1").select2();
	$("#fk_expense_type_id").select2();
</script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 100; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    
    var x = 2; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_button').click(function(){
    	var fieldHTML = '<div class="row field_wrapper remove_div_data_'+x+'" style="width: 152%;padding-left: 10px;"><div class="col-lg-4 padding-mt"><label>Ledger Account</label><div><select class="form-control select2_data_'+x+'" id="user_name'+x+'" onchange="getRegistrationAmount(this.value,'+x+')" name="fk_registration_id[]" style="width: 320px;"><option selected disabled>Select User</option>@foreach($registrationIdData as $registrationDatas)<option value="{{ $registrationDatas->registration_id }}">@if($registrationDatas->ysk_id != "" && $registrationDatas->ysk_confirmation_date == "0000-00-00" && $registrationDatas->difference_amount == ''){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},Ysk- {{ $registrationDatas->ysk_id }})(Region- {{ $registrationDatas->region_name }})(PendingAmount- {{ floor($registrationDatas->registration_amount) }})@elseif($registrationDatas->ysk_id != "" && $registrationDatas->ysk_confirmation_date == "0000-00-00" && $registrationDatas->difference_amount != ''){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},Ysk- {{ $registrationDatas->ysk_id }})(Region- {{ $registrationDatas->region_name }})(PendingAmount- {{ floor($registrationDatas->difference_amount) }})@elseif($registrationDatas->ysk_id != "" && $registrationDatas->ysk_confirmation_date != "0000-00-00"){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},Ysk- {{ $registrationDatas->ysk_id }})(Region- {{ $registrationDatas->region_name }})@elseif($registrationDatas->ysk_id == "" && $registrationDatas->ysk_confirmation_date == "0000-00-00" && $registrationDatas->difference_amount == ''){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},PreYsk- {{ $registrationDatas->pre_ysk_id }})(Region- {{ $registrationDatas->region_name }})(PendingAmount- {{ floor($registrationDatas->registration_amount) }})@elseif($registrationDatas->ysk_id == "" && $registrationDatas->ysk_confirmation_date == "0000-00-00" && $registrationDatas->difference_amount != ''){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},PreYsk- {{ $registrationDatas->pre_ysk_id }})(Region- {{ $registrationDatas->region_name }})(PendingAmount- {{ floor($registrationDatas->difference_amount) }})@elseif($registrationDatas->pre_ysk_id != "" && $registrationDatas->ysk_confirmation_date != "0000-00-00"){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},PreYsk- {{ $registrationDatas->pre_ysk_id }})(Region- {{ $registrationDatas->region_name }})@endif</option>@endforeach</select></div>@if ($errors->has('fk_registration_id'))<span style="color: red;">{{ $errors->first('fk_registration_id') }}</span>@endif</div><div class="col-lg-6 padding-mt" style="padding-left: 40px;"><label>Amount</label><input type="text" id="addAmount'+x+'" class="form-control addAmount add_more_data_'+x+'" placeholder="Enter Amount" name="amount[]" aria-describedby="emailHelp">@if ($errors->has('amount'))<span style="color: red;">{{ $errors->first('amount') }}</span>@endif</div><div class="col-lg-2" style="margin-top: 59px;"><a href="javascript:void(0);" class="nominee-details-add remove_button" title="Remove field" onclick="removeButton('+x+')"><i class="la la-minus"></i></a></div></div>';
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
            //$(".select2_data_"+x).select2();
            var i;
			for (i = 1; i < x; i++) {
				$("#user_name"+i).select2();
			}
        }
    });
});
function removeButton(id){
	$('.remove_div_data_'+id).remove();
}

</script>
<script>
	function getRegistrationAmount(value,id) {
		var behalfPayment = $('#behalf_of_payment_id').val();
		var expenseType = $('#fk_expense_type_id').val();
		if (behalfPayment) {
			$.ajax({
				url: '{{ route('get-amount-by-registration-id') }}',
				type: 'POST',
				data: {fk_behalf_of_payment_id:behalfPayment,fk_registration_id:value,_token:"{{ csrf_token() }}"},
				success:function(response) {
					var obj = JSON.parse(response);
					if (obj.success == '1') {
						$('#addAmount'+id).val(obj.html_data);
					}
				}
			})
		}
		else{
			$.ajax({
				url: '{{ route('get-divangat-amount-by-registration-id') }}',
				type: 'POST',
				data: {fk_expense_type_id:expenseType,fk_registration_id:value,_token:"{{ csrf_token() }}"},
				success:function(response) {
					var obj = JSON.parse(response);
					if (obj.success == '1') {
						$('#addAmount'+id).val(obj.html_data);
					}
				}
			})
		}
	}


	function function1() {
		var expenseType = $('#fk_expense_type_id').val();
		if (expenseType == 'Divangat') {
			$('.details').show();
		}
		else{
			$('.details').hide();
		}
	}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>
<script>
	$('#today_date').mask('00-00-0000');

	/*$(document).ready(function(){
		var date = new Date();

		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();

		if (month < 10) month = "0" + month;
		if (day < 10) day = "0" + day;

		var today = day + "-" + month + "-" + year;
		$('#today_date').attr("value", today);
	});*/		
</script>
@endsection