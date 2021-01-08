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
				@include('elements.left_bar',array('accessData'=>$accessData))
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
								<div class="kt-portlet__head-actions">
								    @if(in_array('sahyognidhi-manpower-view-all',$accessData))
    									<a href="{{ route('sahyognidhi-manpower-view') }}" class="btn btn-warning btn-elevate btn-icon-sm">
    										View
    									</a>
    								@endif
								</div>
							</div>
						</div>

					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							{{-- <form>  --}}
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
								<div class="col-lg-2">
									<input type="submit" class="btn btn-success" id="get_data" value="Submit" >
								</div>

							</div>
						{{-- </form> --}}
						</div><br>
						<div class="kt-portlet__foot"></div>
					</div>
				<div id="showdata" style="display: none;">
					<form method="post" enctype="multipart/form-data" id="submit_form">
						<div class="kt-portlet__body">
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									<div class="kt-portlet__head-actions" style="margin-left: 456px;">
										<h5 class="kt-portlet__head-title">
											Age Group
										</h5>
										<div id="agetype">
											<div class="row" >
												<div class="col-sm-3">aa
													<span class="kt-portlet__head-title">18 to 30</span>
													<p ><input type="text" id="get18To30" name="get18To30" value="0" readonly style="width: 30px; border: none"></p>
												</div>

												<div class="col-sm-3">
													<span class="kt-portlet__head-title">31 to 37</span>
													<p ><input type="text" id="get31To37" name="get31To37" value="0" readonly style="width: 30px; border: none"></p>
												</div>
												<div class="col-sm-3">
													<span class="kt-portlet__head-title">38 to 47</span>
													<p ><input type="text" id="get38To47" name="get38To47" value="0" readonly style="width: 30px; border: none"></p>
												</div>
												<div class="col-sm-3">
													<span class="kt-portlet__head-title">48 to 55</span>
													<p ><input type="text" id="get48To55" name="get48To55" value="0" readonly style="width: 30px; border: none"></p>
												</div>
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
										<p id="sahyognidhi_request">0</p>
									</div>
								</div>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									<div class="kt-portlet__head-actions">
										<h5 class="kt-portlet__head-title">
											Amount
										</h5>
										<p id="totalSahyognidhiAmount">0000</p>
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
											<input type="text" class="form-control" id="reserveFundPercentage" name="reserve_fund_percentage" placeholder="Enter Reserve Funds" value="{{ old('reserve_fund_percentage') }}" readonly>
											@if ($errors->has('reserve_fund_percentage'))
											<span style="color: red;">
												{{ $errors->first('reserve_fund_percentage') }}
											</span>
											@endif
										</div>
										<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
											{{-- <span class="col-lg-2 col-form-label">Amount</span> --}}
											<input type="text" class="form-control" id="totalReserveFundAmount" name="reserve_fund_amount" placeholder="Reserve Fund Amount" value="{{ old('reserve_fund_amount') }}" readonly style="background-color: #d3d3d3;">
											@if ($errors->has('reserve_fund_amount'))
											<span style="color: red;">
												{{ $errors->first('reserve_fund_amount') }}
											</span>
											@endif
										</div>
										<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
											{{-- <span class="col-lg-2 col-form-label">Last Year Reserve Fund</span> --}}
											<input type="text" class="form-control" id="lastYearReserveFund" name="last_year_reserve_fund_amount" placeholder="Last Year Reserve Fund" value="{{ old('last_year_reserve_fund_amount') }}" readonly style="background-color: #d3d3d3;">
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
											<input type="text" class="form-control" name="drop_ratio_percentage" id="drop_ratio_percentage" placeholder="Enter Drop Ratio" value="{{ old('drop_ratio_percentage') }}" onchange="dropRatioAmount(this.value)">

											@if ($errors->has('drop_ratio_percentage'))
											<span style="color: red;">
												{{ $errors->first('drop_ratio_percentage') }}
											</span>
											@endif
										</div>
										<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
											<span class="col-lg-2 col-form-label">Amount</span>
											<input type="text" class="form-control" id="drop_ratio_amount" name="round_up_drop_ratio_amount" placeholder="Enter Amount" value="{{ old('round_up_drop_ratio_amount') }}" readonly style="background-color: #d3d3d3;" >
											@if ($errors->has('round_up_drop_ratio_amount'))
											<span style="color: red;">
												{{ $errors->first('round_up_drop_ratio_amount') }}
											</span>
											@endif
										</div>
										<div class="col-xl-3 col-lg-3 col-sm-4 col-md-4">
											<span class="col-lg-2 col-form-label">Difference Amount</span>
											<input type="text" class="form-control" name="actual_drop_ratio_amount" id="actual_drop_ratio_amount" placeholder="Enter Difference Amount" value="{{ old('actual_drop_ratio_amount') }}" readonly style="background-color: #d3d3d3;">
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
													<input type="hidden" name="design_id[]" id="design_id1" value="1">
													{{-- <div> --}}
														<select class="form-control kt-select2" id="ledger_account1" name="fk_ledger_account_id[]" style="width: 216px;">
															<option selected disabled>Select Ledger Account</option>
															@foreach($incomeLedgerAccount as $incomeLedgerAccounts)
															<option value="{{ $incomeLedgerAccounts->ledger_account_id }}">{{ $incomeLedgerAccounts->legder_name }}</option>
															@endforeach
														</select>
													</div>
													@if ($errors->has('fk_ledger_account_id'))
													<span style="color: red;">
														{{ $errors->first('fk_ledger_account_id') }}
													</span>
													@endif
												{{-- </div> --}}
												<div class="col-xl-4 col-lg-4 col-sm-5 col-md-5" style="padding-left: 33px;">
													<input type="text" class="form-control addAmount" name="reduct_amount[]" id="addAmount1" aria-describedby="emailHelp" placeholder="Enter Amount" style="width: 215px;" onchange="getTotalAmount(this.value,1)">
													@if ($errors->has('reduct_amount'))
													<span style="color: red;">
														{{ $errors->first('reduct_amount') }}
													</span>
													@endif
												</div>
												<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2" style="margin-top: 9px;padding-left: 70px;">
													<a href="javascript:void(0);" class="nominee-details-add add_button" title="Add field"><i class="la la-plus"></i></a>
												</div>
											 </div>
											<div class="field_wrapper">

											</div>
										</div>
									</div>
									<input type="text" class="form-control totalAmount" id="total_amount" name="total_amount" aria-describedby="emailHelp" placeholder="Total Amount" style="width: 215px;float: right;" readonly>
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
											<input type="submit" class="btn btn-success" value="Submit" style="float: right;">
										</div>

									</div>
								</div>
							</div>
					</form>
				<div>
				</div>
				<div class="kt-portlet kt-portlet--mobile" style="margin-top: -10px;">
					{{-- <form class="kt-form" action="" method="POST" style="margin-top: -5px;"> --}}
						<input type="hidden" name="_token" value="{{csrf_token()}}">

					<div  id='payment_id_data'>

					</div>
					{{-- </form> --}}

				</div>

				<div class="kt-portlet kt-portlet--mobile" style="margin-top: -10px;">
					<form class="kt-form" action="" method="POST" style="margin-top: -5px;">
					<div id="adminfinalamount">
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$('#start_year').select2();
	$('#end_year').select2();
	$('#ledger_account').select2();
</script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper

    var x = 2; //Initial field counter is 1

    //Once add button is clicked
    $('.add_button').click(function(){
    	var fieldHTML = '<input type="hidden" name="design_id[]" id="design_id'+x+'" value="'+x+'"><div class="row field_wrapper remove_div_data_'+x+'" style="width: 152%;padding-left: 10px;"><div class="col-xl-4 col-lg-4 col-sm-5 col-md-5 padding-mt"><div><select class="form-control select2_data_'+x+'" id="user_name'+x+'" id="ledger_account'+x+'" name="fk_ledger_account_id[]" style="width: 216px;"><option selected disabled>Select Ledger Account</option>@foreach($incomeLedgerAccount as $incomeLedgerAccounts)<option value="{{ $incomeLedgerAccounts->ledger_account_id }}">{{ $incomeLedgerAccounts->legder_name }}</option>@endforeach</select></div>@if ($errors->has('fk_ledger_account_id'))<span style="color: red;">{{ $errors->first('fk_ledger_account_id') }}</span>@endif</div><div class="col-xl-4 col-lg-4 col-sm-5 col-md-5 padding-mt" style="margin-left:-72px;"><input type="text" id="addAmount'+x+'" class="form-control addAmount add_more_data_'+x+'" name="reduct_amount[]" value="" aria-describedby="emailHelp" placeholder="Enter Amount" style="width: 215px;" onchange="getTotalAmount(this.value, '+x+')">@if ($errors->has('reduct_amount'))<span style="color: red;">{{ $errors->first('reduct_amount') }}</span>@endif</div><div class="col-xl-2 col-lg-2 col-sm-2 col-md-2" style="margin-top: 33px;margin-left:-60px;"><a href="javascript:void(0);" class="nominee-details-add remove_button" title="Remove field" onclick="removeButton('+x+')"><i class="la la-minus"></i></a></div></div>';
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
	var removeAmount = $('.add_more_data_'+id+'').val();
	var totalAmount  = $('.totalAmount').val();
	var afterRemoveAmount = Number(totalAmount) + Number(removeAmount);
	$('.totalAmount').val(afterRemoveAmount);
	$('.remove_div_data_'+id).remove();
}
function submitadmincharge(){
	var admin_charge  = $('#admin_charge').val();
	var startYear = $("#start_year").val();
    var endYear = $("#end_year").val();
	$.ajax({
    		type:'POST',
    		url:'{{ route('admincharge-add') }}',
    		data:{start_year:startYear, end_year:endYear,admin_charge:admin_charge,_token:"{{ csrf_token() }}"},
    		success:function(response){
    			var obj = JSON.parse(response);
    			if (obj.success == 1) {

    				$("#adminfinalamount").html(obj.html);


    			}
    			else{

    			}

    		}

    	});
}
function submitfinalrepayment(){

	var admin_charge  	= $('#admin_charge').val();
	var startYear 		= $("#start_year").val();
    var endYear 		= $("#end_year").val();
    var group1roudup 	= $("#group1roudup").val();
    var group2roudup 	= $("#group2roudup").val();
    var group3roudup 	= $("#group3roudup").val();
    var group4roudup 	= $("#group4roudup").val();
    var group5roudup 	= $("#group5roudup").val();
	$.ajax({
    		type:'post',
    		url:'{{ route('final-repayment-add') }}',
    		data:{start_year:startYear,end_year:endYear,admin_charge:admin_charge,group1roudup:group1roudup,group2roudup:group2roudup,group3roudup:group3roudup,group4roudup:group4roudup,group5roudup:group5roudup,_token:"{{ csrf_token() }}"},
    		success:function(response){
    			var obj = JSON.parse(response);
    			if (obj.success ==0) {

    			document.location.href="{!! route('sahyognidhi-manpower-view') !!}";

    			}
    			else{
                    document.location.href="{!! route('sahyognidhi-manpower-view') !!}";
    			}

    		}

    	});
}
$("#get_data").click(function(e){
        e.preventDefault();
        var startYear = $("#start_year").val();
        var endYear = $("#end_year").val();
        $('#hidden_start_year').val(startYear);
        $('#hidden_end_year').val(endYear);
        	$.ajax({
        		type:'POST',
        		url:'{{ route('get-data') }}',
        		data:{start_year:startYear, end_year:endYear,_token:"{{ csrf_token() }}"},
        		success:function(response){
        			var obj = JSON.parse(response);
        			if (obj.success == 1) {
        				$("#showdata").show();
        				$("#sahyognidhi_request").html(obj.countSahyognidhiRequest);
        				$("#total_sahyognidhi_request").val(obj.countSahyognidhiRequest);
        				$("#totalSahyognidhiAmount").html(obj.totalSahyognidhiAmount);
        				$("#total_sahyognidhi_amount").val(obj.totalSahyognidhiAmount);
        				$("#agetype").html(obj.agetype);
        				$("#reserveFundPercentage").val(obj.reserveFundPercentage);
        				$("#totalReserveFundAmount").val(obj.totalReserveFundAmount);
        				$("#lastYearReserveFund").val(obj.lastYearReserveFund);


        			}
        			else if(obj.success == 0){
        				$('#errormsg').html(obj.errorMsg);
        				$('#errormsg').show();
        			}
        			else if(obj.success == 2){
        				$('#errormsg').html(obj.errorMsg);
        				$('#errormsg').show();
        			}
        		}

        	});
	});

function dropRatioAmount(value) {
 	var totalReserveFundAmount = $('#totalReserveFundAmount').val();
 	var totalSahyognidhiAmount = document.getElementById("totalSahyognidhiAmount").textContent;
 	//alert(totalSahyognidhiAmount);
 	var reserveAndSahyognidhiAmount = Number(totalReserveFundAmount) + Number(totalSahyognidhiAmount);
 	//alert(reserveAndSahyognidhiAmount);
 	var amountWithDropRatio = (Number(reserveAndSahyognidhiAmount)*Number(value))/(Number(100));
 	$('#drop_ratio_amount').val(amountWithDropRatio);
 	var totalAmount = Number(reserveAndSahyognidhiAmount) + Number(amountWithDropRatio);
 	$('.totalAmount').val(totalAmount);
 	//alert(z);
 }

function getTotalAmount(value,id) {
 	if (id == '1') {
	 	var dropRatioAmount = $('#drop_ratio_amount').val();
	 	var totalReserveFundAmount = $('#totalReserveFundAmount').val();
	 	var totalSahyognidhiAmount = document.getElementById("totalSahyognidhiAmount").textContent;
	 	var reserveAndSahyognidhiAmount = Number(totalReserveFundAmount) + Number(totalSahyognidhiAmount) + Number(dropRatioAmount);
	 	if (value) {
	 		var totalAmount = Number(reserveAndSahyognidhiAmount) - Number(value);
	 	}
	 	else{
	 		var totalAmount = Number(reserveAndSahyognidhiAmount);
	 	}
 		$('.totalAmount').val(totalAmount);
 	}
 	else{
 		var allAmount = $('.totalAmount').val();
 		var actualAmount = Number(allAmount) - Number(value);
 		$('.totalAmount').val(actualAmount);
 	}

}


$("#submit_form").on('submit',(function(e) {
		$("#bkloader").show();
		e.preventDefault();
		$.ajax({
			url:"{{ route('save-sahyognidhi-manpower') }}",
			method: "POST",
			data:  new FormData(this),
			dataType:'JSON',
			contentType: false,
			cache: false,
			processData:false,
			success: function(response){
				$("#bkloader").hide();
				if(response.success == 1){
					$('#payment_id_data').html(response.html)

				}
				else{
					iziToast.error({
						title: response.message,
						position: 'topRight',
						timeout: 3000,
					});
				}
			}
		});
	}));

</script>
<script>

</script>

@endsection
