@extends('elements.admin_master')
@section('content')


<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="row" style="width: 100%;">
				<div class="col-md-10">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">
								Payment
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
							<a href="{{ route('sahyognidhi-request') }}">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- start:: filter -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="filter-section-bg">
			<form method="POST" action="{{ route('save-sahyognidhi-payment') }}">
				@csrf
				<div class="row">
					<div class="col-sm-3 col-md-3">
						<label>Nominee Name</label>
						<select class="form-control kt-select2" id="nominee_name" onchange="getYskId(this.value)" name="nominee_member_id"  @if((count($sahyognidhiPaymentDetails) != 0) && ($sahyognidhiPaymentDetails[0]['close_reason'] != '')) disabled @endif>
							<option selected disabled>Select Nominee</option>
							@foreach($nomineeName as $nomineeNames)
							<option value="{{ $nomineeNames->hidden_first_nominee_member_id }}">{{ $nomineeNames->first_nominee_name }}</option>
							<option value="{{ $nomineeNames->hidden_second_nominee_member_id }}">{{ $nomineeNames->second_nominee_name }}</option>
							<option value="{{ $nomineeNames->ask_first_nominee_member_id }}">{{ $nomineeNames->ask_first_nominee_name }}</option>
							<option value="{{ $nomineeNames->ask_second_nominee_member_id }}">{{ $nomineeNames->ask_second_nominee_name }}</option>
							<input type="hidden" name="editId" value="{{ $nomineeNames['fk_sahyognidhi_id'] }}">
							@endforeach
						</select>
						@if ($errors->has('nominee_member_id'))
						<span style="color: red;">
							{{ $errors->first('nominee_member_id') }}
						</span>
						@endif
					</div>
					<input type="hidden" name="payment_give_nominee_name" id="payment_give_nominee_name">
					<div class="col-sm-2 col-md-2 ysk_id" style="display: none;">
						<label>YSK ID</label>
						<input type="text" id="nominee_ysk_id" class="form-control" placeholder="Enter Nominee Ysk Id" name="nominee_ysk_id" aria-describedby="emailHelp" value="{{ old('nominee_ysk_id') }}" readonly>
						@if ($errors->has('nominee_ysk_id'))
						<span style="color: red;">
							{{ $errors->first('nominee_ysk_id') }}
						</span>
						@endif
					</div>

					<div class="col-sm-2 col-md-2">
						<label>Date</label>
						<input type="text" id="sahyognidhi_payment_date" class="form-control" placeholder="Enter Date" name="sahyognidhi_payment_date" aria-describedby="emailHelp" value="{{ old('sahyognidhi_payment_date') }}" @if((count($sahyognidhiPaymentDetails) != 0) && ($sahyognidhiPaymentDetails[0]['close_reason'] != '')) readonly @endif>
						@if ($errors->has('sahyognidhi_payment_date'))
						<span style="color: red;">
							{{ $errors->first('sahyognidhi_payment_date') }}
						</span>
						@endif
					</div>

					<div class="col-sm-2 col-md-2">
						<label>Amount</label>
						<input type="text" id="sahyognidhi_amount" class="form-control" placeholder="Enter Amount" name="sahyognidhi_amount" aria-describedby="emailHelp" value="{{ old('sahyognidhi_amount') }}" @if((count($sahyognidhiPaymentDetails) != 0) && ($sahyognidhiPaymentDetails[0]['close_reason'] != '')) readonly @endif>
						@if ($errors->has('sahyognidhi_amount'))
						<span style="color: red;">
							{{ $errors->first('sahyognidhi_amount') }}
						</span>
						@endif
					</div>

					<div class="col-sm-2 col-md-2">
						<label>YSK Bank Cheque</label>
						<select class="form-control kt-select2" id="kt_select2_1" name="fk_bank_id" @if((count($sahyognidhiPaymentDetails) != 0) && ($sahyognidhiPaymentDetails[0]['close_reason'] != '')) disabled @endif>
							<option selected disabled>Select Bank</option>
							@foreach($bankName as $bankNames)
							<option value="{{ $bankNames->ledger_account_id }}">{{ $bankNames->legder_name }}</option>
							@endforeach
						</select>
						@if ($errors->has('fk_bank_id'))
						<span style="color: red;">
							{{ $errors->first('fk_bank_id') }}
						</span>
						@endif
					</div>
					<div class="col-sm-1 col-md-1">
						<input type="submit" class="btn btn-info" name="submit" value="Save" style="margin-top: 25px;">
					</div>
				</div>
			</form>
				<div class="row" style="margin-top: 50px;">
					<div class="col-sm-3 col-md-3">
						<label>Status</label>
						<select class="form-control" name="status_selection" id="status_selection" onchange="statusSelection(this.value)">
							<option value="" selected>SELECT REASON</option>
							<option value="Active">Active</option>
							<option value="Deactive">Deactive</option>
						</select>
						@if ($errors->has('status_selection'))
						<span style="color: red;">
							{{ $errors->first('status_selection') }}
						</span>
						@endif
					</div>
					<div class="col-sm-3 col-md-3 reason_selection">
						<label>Not Eligiable</label>
						<select class="form-control" name="reason_selection" id="reason_selection">
							<option value="" selected>SELECT REASON</option>
							<option value="Locking Period" @if($sahyognidhiPaymentDetails1['reason_selection']== 'Locking Period') selected @endif>Locking Period</option>
							<option value="Sucide" @if($sahyognidhiPaymentDetails1['reason_selection']== 'Sucide') selected @endif>Sucide</option>
							<option value="Repayment Not Paid" @if($sahyognidhiPaymentDetails1['reason_selection']== 'Repayment Not Paid') selected @endif>Repayment Not Paid</option>
							<option value="Other Reason" @if($sahyognidhiPaymentDetails1['reason_selection']== 'Other Reason') selected @endif>Other Reason</option>
						</select>
						@if ($errors->has('reason_selection'))
						<span style="color: red;">
							{{ $errors->first('reason_selection') }}
						</span>
						@endif
					</div>

					<div class="col-sm-3 col-md-3 close_reason">
						<label>Enter Reason</label>

						<textarea class="form-control" cols="20" rows="4" id="close_reason" name="close_reason"> @if(count($sahyognidhiPaymentDetails) != 0){{ $sahyognidhiPaymentDetails[0]['close_reason'] }} @else {{ old('close_reason') }} @endif {{ old('close_reason') }}</textarea>
						@if ($errors->has('close_reason'))
						<span style="color: red;">
							{{ $errors->first('close_reason') }}
						</span>
						@endif
					</div>

					<div class="col-sm-1 col-md-1">
						<input type="submit" class="btn btn-info" id="close" name="close" value="Submit" style="margin-top: 25px;" onclick="closeSahyognidhi({{ $nomineeNames['fk_sahyognidhi_id'] }})">
					</div>

				</div>

		</div>
	</div>
	<!-- end:: filter -->


	<!-- end:: Subheader -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!-- registration date table -->
		<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet kt-portlet--mobile">
				<div class="kt-portlet__head kt-portlet__head--lg">

					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Payment History
						</h3>
					</div>

					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions"> </div>
						</div>
					</div>
				</div>

				@if($sahyognidhiPaymentDetails1['close_reason'] != '')
					<div class="kt-portlet__body">
							<!--begin: Datatable -->
							<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
								<div class="row">
									<div class="col-sm-12">
										{{-- @if($sahyognidhiPaymentId['payment_give_nominee_name'] != '') --}}
										<table class="table table-bordered">
											<thead>
												<tr>
												    <th>Not Eligiable for</th>
													<th>Reason</th>
													<th>Created Date</th>
												</tr>
											</thead>
											<tbody>
												<tr>
												    <td>{{ $sahyognidhiPaymentDetails1['reason_selection'] }}</td>
													<td>{{ $sahyognidhiPaymentDetails1['close_reason'] }}</td>
													<td>{{ date('d-m-Y',strtotime($sahyognidhiPaymentDetails1['created_at'])) }}</td>
												</tr>
												@if($sahyognidhiPaymentDetails1['payment_status'] == '4')
												<tr>
												    <td colspan="2">Active</td>
												    <td>{{ date('d-m-Y',strtotime($sahyognidhiPaymentDetails1['updated_at'])) }}</td>
												</tr>
												@endif()
											</tbody>
										</table>
										{{-- @endif --}}
									</div>
								</div>
							</div>
							<!--end: Datatable -->
						</div>
				@endif
				@if((count($sahyognidhiPaymentDetails) != 0) && ($sahyognidhiPaymentDetails[0]['close_reason'] == ''))
					<div class="kt-portlet__body">
						<!--begin: Datatable -->
						<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
							<div class="row">
								<div class="col-sm-12">
									{{-- @if($sahyognidhiPaymentId['payment_give_nominee_name'] != '') --}}
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Nominee Name</th>
												<th>YSK ID</th>
												<th>Date</th>
												<th>Amount</th>
												<th>YSK Bank Name (Cheque Clearence Date)</th>
                                                <th>Transaction Id</th>
											</tr>
										</thead>
										<tbody>
											@foreach($sahyognidhiPaymentDetails as $sahyognidhiPaymentDetailss)
											<tr>
												<td>{{ $sahyognidhiPaymentDetailss->payment_give_nominee_name }}</td>
												<td>@if($sahyognidhiPaymentDetailss->nominee_ysk_id != '0'){{ $sahyognidhiPaymentDetailss->nominee_ysk_id }}@endif</td>
												<td>@if($sahyognidhiPaymentDetailss->sahyognidhi_payment_date != '0000-00-00'){{ date('d-m-Y',strtotime($sahyognidhiPaymentDetailss->sahyognidhi_payment_date)) }}@endif</td>
												<td>@if($sahyognidhiPaymentDetailss->sahyognidhi_amount != '0.00'){{ $sahyognidhiPaymentDetailss->sahyognidhi_amount }}@endif</td>
												<td>{{ $sahyognidhiPaymentDetailss->legder_name }} @if($sahyognidhiPaymentDetailss->cheque_clearence_date != '0000-00-00')({{ date('d-m-Y',strtotime($sahyognidhiPaymentDetailss->cheque_clearence_date)) }})@endif</td>
                                                <td>{{ $sahyognidhiPaymentDetailss->transaction_id }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									{{-- @endif --}}
								</div>
							</div>
						</div>
						<!--end: Datatable -->
					</div>
				@endif
			</div>
			<!-- registration date table -->
		</div>
	</div>
<!-- content end -->

</div>
</div>
</div>
<!--ENd:: Chat-->
@endsection
@section('content_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$('#sahyognidhi_payment_date').mask('00-00-0000');

	$(document).ready(function(){
		var date = new Date();

		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();

		if (month < 10) month = "0" + month;
		if (day < 10) day = "0" + day;

		var today = day + "-" + month + "-" + year;
		$('#sahyognidhi_payment_date').attr("value", today);
	});
	$('#nominee_name').select2();
	$('#reason_selection').select2();
	$('#status_selection').select2();

	function getYskId(value) {
		if (value) {
			$.ajax({
				url: '{{ route('get-nominee-ysk-id') }}',
				type: 'POST',
				data: {nominee_name:value,_token:"{{ csrf_token() }}"},
				success:function(response) {
					var obj = JSON.parse(response);
					if (obj.success == '1') {
						if (obj.ysk_id == '') {
							$('#nominee_ysk_id').val(obj.pre_ysk_id);
							$('#payment_give_nominee_name').val(obj.name);
							$('.ysk_id').show();
						}
						else{
							$('#nominee_ysk_id').val(obj.ysk_id);
							$('#payment_give_nominee_name').val(obj.name);
							$('.ysk_id').show();
						}
					}
				}
			})
		}
	}

	function closeSahyognidhi(id) {
		var closeReason = $('#close_reason').val();
		var reasonSelection = $('#reason_selection').val();
		var statusSelection = $('#status_selection').val();
	swal({
		title: "Are you sure?",
		text: "Once close, you will not be able to access account!",
		icon: "warning",
		buttons: ["Cancel", "Do it!"],
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				url: '{{ route('cancel-sahyognidhi-request') }}',
				type: 'POST',
				data: {close_reason:closeReason,reason_selection:reasonSelection,status_selection:statusSelection,id:id,_token:"{{ csrf_token() }}"},
				success:function (response) {
					var obj = JSON.parse(response);
					if (obj.success == "1") {
						window.location="{{ route('sahyognidhi-request') }}";
					}
				}
			})

		} else {
			swal({
					buttons: false, // There won't be any confirm button
					text:"Your data is safe!"
				});
		}
	});
}

function statusSelection(value) {
	if (value == 'Deactive') {
		$('.close_reason').show();
		$('.reason_selection').show();
	}
	else{
		$('.close_reason').hide();
		$('.reason_selection').hide();
	}
}
</script>
@endsection
