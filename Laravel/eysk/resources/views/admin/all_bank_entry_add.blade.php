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
								Add Bank Entry                           
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
							<a href="{{ route('session-destroy') }}">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
						</div>						
					</div>
				</div>
			</div>
		</div>
	<!-- end:: Subheader -->        
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
	<!-- begin:: Content -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height: 500px;">
		<!--begin::Portlet-->
		<form method="POST" action="{{ route('save-all-bank-entry') }}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="kt-portlet kt-portlet--tab">
				<div class="main-padding">
					<div class="form-group1 m-form__group1 row">  
						<label class="col-lg-2 col-form-label">Payment Date
							<span class="text-danger">*</span></label>  
							<div class="col-lg-9">
								<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ old('today_date') }}" id="today_date" name="today_date">
								@if ($errors->has('today_date'))
								<span style="color: red;">
									{{ $errors->first('today_date') }}
								</span>
								@endif
							</div>
						</div>

						<div class="form-group1 m-form__group1 row">	
							<label class="col-lg-2 col-form-label">YSK Bank Name<span class="text-danger">*</span></label>	
							<div class="col-lg-9">
								<select class="form-control kt-select2" id="kt_select23_21" name="fk_bank_id">
									<option selected disabled>SELECT BANK</option>
									@foreach($bankName as $bankNames)
									<option @if(Session::get('a') == $bankNames->ledger_account_id) selected @endif value="{{ $bankNames->ledger_account_id }}">{{ $bankNames->legder_name }}</option>
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
								{{-- <div class="col-sm-12">
									<div id="London" class="tabcontent tabs-r-active">
										<h3 class="check-box-title">Debit</h3>
										<div class="row check-box">	
											<div class="col-sm-12">
												<label>Date</label>
												<input type="text" class="form-control debit_date" placeholder="Enter Debit Date" name="debit_date" id="date" value="{{ old('debit_date') }}">
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
												<textarea class="form-control" placeholder="Enter Debit Details" name="debit_details" id="details" rows="5">{{ old('debit_details') }}</textarea>	
												@if ($errors->has('debit_details'))
												<span style="color: red;">
													{{ $errors->first('debit_details') }}
												</span>
												@endif
											</div>	
											<div class="col-sm-12 padding-mt">	
												<label>Expense Type<span class="text-danger">*</span></label>
												<select class="form-control kt-select2" id="fk_expense_type_id" onchange="function1()" name="fk_expense_type_id" style="width: 100%;">
													<option selected disabled>Select a Expense</option>
													@foreach($expenseType as $expenseTypes)
													<option value="{{ $expenseTypes->expense_type_id }}">{{ $expenseTypes->expense_type }}</option>
													@endforeach
													<option value="Divangat">Divangat</option>
													<option value="Suspense Account">Suspense Account</option>
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
												<input type="text" class="form-control credit_date" placeholder="Enter Credit Date" name="credit_date" value="{{ old('date') }}">
												@if ($errors->has('credit_date'))
												<span style="color: red;">
													{{ $errors->first('credit_date') }}
												</span>
												@endif
											</div>	
											<div class="col-sm-12 padding-mt">
												<label>Amount<span class="text-danger">*</span></label>	
												<input type="text" class="form-control" placeholder="Enter Credit Amount" name="credit_amount" value="{{ old('credit_amount') }}" aria-describedby="emailHelp">
												@if ($errors->has('credit_amount'))
												<span style="color: red;">
													{{ $errors->first('credit_amount') }}
												</span>
												@endif
											</div>
											<div class="col-sm-12 padding-mt">
												<label>Detail<span class="text-danger">*</span></label>
												<textarea class="form-control" name="credit_details" id="exampleTextarea" rows="5" placeholder="Enter Details Here">{{ old('credit_details') }}</textarea>	
												@if ($errors->has('credit_details'))
												<span style="color: red;">
													{{ $errors->first('credit_details') }}
												</span>
												@endif
											</div>	
											<div class="col-sm-12 padding-mt">	
												<label>Behalf Of Payment<span class="text-danger">*</span></label>
												<select class="form-control kt-select2" id="behalf_of_payment_id" onchange="forSuspenseAccount()" name="fk_behalf_of_payment_id" style="width: 100%;">
													<option selected disabled>Select Type</option>
													@foreach($behalfOfPayment as $behalfOfPayments)
													<option value="{{ $behalfOfPayments->behalf_of_payment_id }}">{{ $behalfOfPayments->behalf_of_payment }}</option>
													@endforeach
													<option value="Suspense Account">Suspense Account</option>
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

						<div class="form-group1 m-form__group1 row">  
							<label class="col-lg-2 col-form-label">Ledger Account
								<span class="text-danger">*</span></label>  
								<div class="col-lg-9">
									<select class="form-control kt-select2" id="behalf_of_payment_id" name="ledger_account_id" style="width: 100%;">
										<option disabled>Select Account</option>						
										<option selected value="Suspense Account">Suspense Account</option>
										@foreach($sunCreaditorData as $key => $sunCreaditorDatas)
											<option value="{{ $sunCreaditorDatas->registration_id }}">
												@if($sunCreaditorDatas->ysk_id != '' && $sunCreaditorDatas->ysk_confirmation_date == '0000-00-00'){{ $sunCreaditorDatas->hidden_name_as_per_yuva_sangh_org }}(YskId- {{ $sunCreaditorDatas->ysk_id }})(Region- {{ $sunCreaditorDatas->region_name }})(PendingAmount- {{ floor($sunCreaditorDatas->registration_amount) }}) 

												@elseif($sunCreaditorDatas->ysk_id != '' && $sunCreaditorDatas->ysk_confirmation_date != '0000-00-00') {{ $sunCreaditorDatas->hidden_name_as_per_yuva_sangh_org }}(YskId- {{ $sunCreaditorDatas->ysk_id }})(Region- {{ $sunCreaditorDatas->region_name }}) (RepaymentAmount -{{ $finaltotall[$key] }})

												@elseif($sunCreaditorDatas->pre_ysk_id == '' && $sunCreaditorDatas->ysk_confirmation_date == '0000-00-00') {{ $sunCreaditorDatas->hidden_name_as_per_yuva_sangh_org }}(ProcessingId- {{  $sunCreaditorDatas->processing_id }}))(Region- {{ $sunCreaditorDatas->region_name }})(PendingAmount- {{ floor($sunCreaditorDatas->registration_amount) }}) 

												@elseif($sunCreaditorDatas->pre_ysk_id != '' && $sunCreaditorDatas->ysk_confirmation_date != '0000-00-00') {{ $sunCreaditorDatas->hidden_name_as_per_yuva_sangh_org }}(PreYskId- {{  $sunCreaditorDatas->pre_ysk_id }})(Region- {{ $sunCreaditorDatas->region_name }}) (RepaymentAmount -{{ $finaltotall[$key] }})
												@endif</option>		
										@endforeach
										{{-- @foreach($ledgerAccount as $ledgerAccounts)
											<option value="{{ $ledgerAccounts->group_id }}">{{ $ledgerAccounts->group_name }}</option>
										@endforeach --}}
										{{-- <optgroup label="Sundry Creditors">
										
										</optgroup> --}}
									</select>
									@if ($errors->has('ledger_account'))
									<span style="color: red;">
										{{ $errors->first('ledger_account') }}
									</span>
									@endif
								</div>
							</div> 

							{{-- <div class="form-group1 m-form__group1 row">  
								<label class="col-lg-2 col-form-label">User Ledger
									<span class="text-danger">*</span>
								</label>  
								<div class="col-lg-9">
									<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
										<input type="checkbox" name="user_ledger" value="1" onchange="checkAll()" class="check_all" id="check_all">&nbsp;<span></span>
									</label>
									@if ($errors->has('user_ledger'))
									<span style="color: red;">
										{{ $errors->first('user_ledger') }}
									</span>
									@endif	
								</div>
							</div> --}} 

							<div class="form-group1 m-form__group1 row">  
								<label class="col-lg-2 col-form-label">Amount
									<span class="text-danger">*</span>
								</label>  
								<div class="col-lg-9">
									<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ old('total_amount') }}" id="total_amount" name="total_amount" placeholder="ENTER AMOUNT">
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
									<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ old('cheque_number') }}" id="cheque_number" name="cheque_number" placeholder="ENTER CHEQUE NUMBER">
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
									<input type="text" class="form-control" aria-describedby="emailHelp" value="{{ old('transaction_id') }}" id="transaction_id" name="transaction_id" placeholder="ENTER TRANSACTION ID">
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
									<textarea class="form-control" id="narration" name="details" placeholder="ENTER DETAILS" rows="4" cols="5" style="text-transform: uppercase;">{{ old('details') }}</textarea>
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
											<input type="radio" name="payment_mode" value="Cash Deposit"> Cash Deposit
											<span class="tablinks"></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="payment_mode" value="NEFT / RTGS"> NEFT / RTGS
											<span class="tablinks"></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="payment_mode" value="Cheque"> Cheque
											<span class="tablinks"></span>
										</label>
										<label class="kt-radio">
											<input type="radio" name="payment_mode" value="Online"> Online
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


							  <div class="form-group1 m-form__group1 row details" id="showUserLedger" style="display: none;">	
								<label class="col-lg-2 col-form-label">Details<span class="text-danger">*</span></label>
								<div class="registration-list-modal">
									<div class="row" style="width: 152%;padding-left: 10px;">	
										<div class="col-lg-4 padding-mt">	
											<label>User</label>
											<div>
												<select class="form-control kt-select2" id="user_name1" onchange="getRegistrationAmount(this.value,1)" name="fk_registration_id[]" style="width: 320px;">
													<option selected disabled>Select User</option>
													@foreach($registrationIdData as $registrationDatas)
													<option value="{{ $registrationDatas->registration_id }}">@if($registrationDatas->ysk_id != ""){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }}, Ysk- {{ $registrationDatas->ysk_id }})@else{{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }}, PreYsk- {{ $registrationDatas->pre_ysk_id }})@endif</option>
													@endforeach
												</select>
											</div>		
											@if ($errors->has('fk_registration_id'))
											<span style="color: red;">
												{{ $errors->first('fk_registration_id') }}
											</span>
											@endif	
										</div>
										<div class="col-lg-6 padding-mt" style="padding-left: 40px;">
											<label>Amount</label>	
											<input type="text" class="form-control addAmount" placeholder="Enter Amount" name="amount[]" id="addAmount1" aria-describedby="emailHelp">
											@if ($errors->has('amount'))
											<span style="color: red;">
												{{ $errors->first('amount') }}
											</span>
											@endif
										</div>
										<div class="col-lg-2 padding-kt" style="margin-top: 50px;">
											<a href="javascript:void(0);" class="nominee-details-add add_button" title="Add field"><i class="la la-plus"></i></a>
										</div>
									</div>  
								

							{{-- <div class="registration-list-modal" id="nominee_details1" style="display: none;">
								<div class="row" style="width: 145%;padding-left: 34px;">	
									<div class="col-lg-4 padding-mt">	
										<label>Nominee<span class="text-danger">*</span></label>
										<div>
											<select class="form-control kt-select2" id="nominee_name1" onchange="getNomineeAmount(this.value,1)" name="fk_registration_id[]" style="width: 259px;">
												<option selected disabled>Select Nominee</option>
												@foreach($registrationIdData as $registrationDatas)
												<option value="{{ $registrationDatas->registration_id }}">@if($registrationDatas->ysk_id != ""){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},{{ $registrationDatas->ysk_id }})@else{{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }})@endif</option>
												@endforeach
											</select>
										</div>		
										@if ($errors->has('fk_registration_id'))
										<span style="color: red;">
											{{ $errors->first('fk_registration_id') }}
										</span>
										@endif	
									</div>
									<div class="col-lg-6 padding-mt" style="padding-left: 61px;">
										<label>Amount<span class="text-danger">*</span></label>	
										<input type="text" class="form-control addAmount" placeholder="Enter Amount" name="amount[]" id="addAmount1" aria-describedby="emailHelp" style="width: 248px;">
										@if ($errors->has('amount'))
										<span style="color: red;">
											{{ $errors->first('amount') }}
										</span>
										@endif
									</div>
									<div class="col-lg-2 padding-kt" style="margin-top: 50px;margin-left: -107px;">
										<a href="javascript:void(0);" class="nominee-details-add add_button_one" title="Add field"><i class="la la-plus"></i></a>
									</div>
								</div>
								<div class="field_wrapper_one">

								</div>
							</div> --}}

							  <div class="field_wrapper">

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
												<a href="{{ route('all-bank-entry') }}" class="btn-cancel-registration">Cancel</a>
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
<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>
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
	$("#fk_expense_type_id").select2();
	$("#user_name1").select2();
	$("#nominee_name1").select2();
</script>



<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    
    var x = 2; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_button').click(function(){
    	var fieldHTML = '<div class="row field_wrapper remove_div_data_'+x+'" style="width: 152%;padding-left: 10px;"><div class="col-lg-4 padding-mt"><label>User</label><div><select class="form-control select2_data_'+x+'" id="user_name'+x+'" onchange="getRegistrationAmount(this.value,'+x+')" name="fk_registration_id[]" style="width: 320px;"><option selected disabled>Select User</option>@foreach($registrationIdData as $registrationDatas)<option value="{{ $registrationDatas->registration_id }}">@if($registrationDatas->ysk_id != ""){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},{{ $registrationDatas->ysk_id }})@else{{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }})@endif</option>@endforeach</select></div>@if ($errors->has('fk_registration_id'))<span style="color: red;">{{ $errors->first('fk_registration_id') }}</span>@endif</div><div class="col-lg-6 padding-mt" style="padding-left: 40px;"><label>Amounts</label><input type="text" id="addAmount'+x+'" class="form-control addAmount add_more_data_'+x+'" placeholder="Enter Amount" name="amount[]" aria-describedby="emailHelp">@if ($errors->has('amount'))<span style="color: red;">{{ $errors->first('amount') }}</span>@endif</div><div class="col-lg-2 padding-kt" style="margin-top: 50px;"><a href="javascript:void(0);" class="nominee-details-add remove_button" title="Remove field" onclick="removeButton('+x+')"><i class="la la-minus"></i></a></div></div>';
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
	
	function function1() {
		var expenseType = $('#fk_expense_type_id').val();
		if (expenseType == 'Divangat'){
			$('.details').show();
		}
		else{
			$('.details').hide();			
		}
}
function forSuspenseAccount() {
	var behalfPayment = $('#behalf_of_payment_id').val();
	if (behalfPayment == 'Suspense Account') {
		$('.details').hide();
	}
	else{
		$('.details').show();
	}
}

function getRegistrationAmount(value,id) {
	var behalfPayment = $('#behalf_of_payment_id').val();
    var expenseType   = $('#fk_expense_type_id').val();
	if (behalfPayment) {
		$.ajax({
			url: '{{ route('get-amount-by-registration') }}',
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
	else if(expenseType){
		$.ajax({
			url: '{{ route('get-divangat-amount-by-registration') }}',
			type: 'POST',
			data: {fk_expense_type_id:expenseType,fk_registration_id:value,_token:"{{ csrf_token() }}"},
			success:function(response) {
				var obj = JSON.parse(response);
				if (obj.success == '1') {
					$('#addAmount'+id).val(obj.html_data);
					//alert(obj.html_data);
					if (obj.html_data == null) {
						$('#nominee_details'+id).hide();
					}
					else{
						//alert(id);
						$('#nominee_details'+id).show();						
					}
				}
			}
		})
	}
}

</script>

{{-- <script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    
    var x = 2; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_button').click(function(){
    	var fieldHTML = '<div class="registration-list-modal" id="nominee_details'+x+'" style="display: none;"><div class="row field_wrapper remove_div_data_'+x+'" style="width: 145%;padding-left: 34px;"><div class="col-lg-4 padding-mt"><label>User<span class="text-danger">*</span></label><div><select class="form-control select2_data_'+x+'" id="user_name'+x+'" onchange="getRegistrationAmount(this.value,'+x+')" name="fk_registration_id[]" style="width: 259px;"><option selected disabled>Select User</option>@foreach($registrationIdData as $registrationDatas)<option value="{{ $registrationDatas->registration_id }}">@if($registrationDatas->ysk_id != ""){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},{{ $registrationDatas->ysk_id }})@else{{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }})@endif</option>@endforeach</select></div>@if ($errors->has('fk_registration_id'))<span style="color: red;">{{ $errors->first('fk_registration_id') }}</span>@endif</div><div class="col-lg-6 padding-mt" style="padding-left: 61px;"><label>Amount<span class="text-danger">*</span></label><input type="text" id="addAmount'+x+'" class="form-control addAmount add_more_data_'+x+'" placeholder="Enter Amount" name="amount[]" aria-describedby="emailHelp" style="width: 248px;">@if ($errors->has('amount'))<span style="color: red;">{{ $errors->first('amount') }}</span>@endif</div><div class="col-lg-2 padding-kt" style="margin-top: 50px;margin-left: -107px;"><a href="javascript:void(0);" class="nominee-details-add add_button_one" title="Add field"><i class="la la-plus"></i></a></div></div></div>';
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
</script> --}}

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button_one'); //Add button selector
    var wrapper = $('.field_wrapper_one'); //Input field wrapper
    
    var x = 2; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_button_one').click(function(){
    	var fieldHTML = '<div class="row field_wrapper_one remove_one_div_data_'+x+'" style="width: 145%;padding-left: 34px;"><div class="col-lg-4 padding-mt"><label>Nominee<span class="text-danger">*</span></label><div><select class="form-control select2_data_'+x+'" id="nominee_name'+x+'" onchange="getNomineeAmount(this.value,'+x+')" name="fk_registration_id[]" style="width: 259px;"><option selected disabled>Select Nominee</option>@foreach($registrationIdData as $registrationDatas)<option value="{{ $registrationDatas->registration_id }}">@if($registrationDatas->ysk_id != ""){{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }},{{ $registrationDatas->ysk_id }})@else{{ $registrationDatas->name_as_per_yuva_sangh_org }}({{ $registrationDatas->processing_id }})@endif</option>@endforeach</select></div>@if ($errors->has('fk_registration_id'))<span style="color: red;">{{ $errors->first('fk_registration_id') }}</span>@endif</div><div class="col-lg-6 padding-mt" style="padding-left: 61px;"><label>Amount<span class="text-danger">*</span></label><input type="text" id="addAmount'+x+'" class="form-control addAmount add_more_data_'+x+'" placeholder="Enter Amount" name="amount[]" aria-describedby="emailHelp" style="width: 248px;">@if ($errors->has('amount'))<span style="color: red;">{{ $errors->first('amount') }}</span>@endif</div><div class="col-lg-2 padding-kt" style="margin-top: 50px;margin-left: -107px;"><a href="javascript:void(0);" class="nominee-details-add remove_button" title="Remove field" onclick="removeButtonone('+x+')"><i class="la la-minus"></i></a></div></div>';
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
            //$(".select2_data_"+x).select2();
            var i;
			for (i = 1; i < x; i++) {
				$("#nominee_name"+i).select2();
			}
        }
    });
});
function removeButtonone(id){
	$('.remove_one_div_data_'+id).remove();
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
	$('.debit_date').mask('00-00-0000');
	$('.credit_date').mask('00-00-0000');
	$('#today_date').mask('00-00-0000');

	$(document).ready(function(){
		var date = new Date();

		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();

		if (month < 10) month = "0" + month;
		if (day < 10) day = "0" + day;

		var today = day + "-" + month + "-" + year;
		$('#today_date').attr("value", today);
	});
</script>
<script>
	function checkAll(value) {
		if (value == 'User Ledger') {
			$('#showUserLedger').show();
		}
		else{
			$('#showUserLedger').hide();
		}
	}
</script>
@endsection
