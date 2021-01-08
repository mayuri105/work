@extends('elements.admin_master',array('accessData'=>$accessData))

@section('content')



<style>

	select option {

		margin: 40px;

		background: #fff;

		text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);

	}

</style>



<!-- content -->

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Subheader -->

	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">

			<div class="kt-container  kt-container--fluid ">

				<div class="kt-subheader__main">

					<h3 class="kt-subheader__title">

						Cheque Clearence

					</h3>

				</div>

				<div class="kt-subheader__toolbar">

					<div class="kt-subheader__wrapper"></div>

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

	{{-- </div>

		<!-- registration date table -->

		<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}

			<div class="kt-portlet kt-portlet--mobile">

				<div class="kt-portlet__head kt-portlet__head--lg">



					<div class="kt-portlet__head-label">

						<span class="kt-portlet__head-icon">

							<i class="kt-font-brand flaticon2-line-chart"></i>

						</span>

						<h3 class="kt-portlet__head-title">

							List

						</h3>

					</div>



					<div class="kt-portlet__head-toolbar">

						<div class="kt-portlet__head-wrapper">

							<div class="kt-portlet__head-actions">

								<select class="btn btn-brand btn-warning btn-elevate btn-icon-lg" name="same_status" id="status" onchange="getAllSameStatus(this.value)">

									<option selected disabled>Select Status</option>

									<option value="Registration" selected>Registration</option>

									<option value="Sahyognidhi">Sahyognidhi</option>

									<option value="Repayment">Repayment</option>

								</select>

								 {{-- <a href="{{ route('add-all-bank-entry') }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">

									<i class="la la-plus"></i>

									Add All Bank Entry

								</a>



								<a href="#" id="delete_all" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">

									<i class="la la-trash"></i>

									Delete All

								</a> --}}

							</div>

						</div>

					</div>





				</div>

				<div class="kt-portlet__body checkClerence">

					<!--begin: Datatable -->

					<div class="table-responsive">

						<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="today_datatable" role="grid" aria-describedby="kt_table_1_info" style="width: 1147px;">

							<thead>

								<tr role="row">

									{{-- <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">

										<input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>

									</th> --}}

									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">YSK Member Name</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">YSK Member Bank Name</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">Amount</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Branch Name</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Cheque Number</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Narration</th>

									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Bank Name</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Created Date</th>





									<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 30.5px;" aria-label="Actions">Actions</th>

								</tr>

							</thead>

							 <tbody id="tabel_html">

								 @foreach($getCheckClearence as $getCheckClearences)

									<tr role="row" class="odd">

										<td>{{ $getCheckClearences->hidden_name_as_per_yuva_sangh_org }}</td>

										<td>{{ $getCheckClearences->ysk_member_bank_name }}</td>

										<td><i class="la la-inr"></i>{{ $getCheckClearences->bank_amount }}</td>

										<td>{{ $getCheckClearences->branch_name }}</td>

                                        <td>@if($getCheckClearences->cheque_number != ''){{ $getCheckClearences->cheque_number }}@endif</td>

                                        <td>

                                        	<?php $string = strip_tags($getCheckClearences->narration);

                                        		if (strlen($string) > 10) {

                                        			$stringCut = substr($string, 0, 10);

    												$endPoint = strrpos($stringCut, ' ');

    												$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);

    												$string .= '...<br/> <a href="#" title ="'.$getCheckClearences->narration.'" onclick="openModelOne()">Read More</a>';

                                        		}

                                        		echo $string;

                                         	?>

                                         		<input type="hidden" id="hiddenNarration" name="hiddenNarration" value="{{ $getCheckClearences->narration }}">

                                         	</td>

                                        <td>{{ $getCheckClearences->legder_name }}</td>

                                        <td> @if($getCheckClearences->created_at != "0000-00-00 00:00:00" && $getCheckClearences->created_at != NULL) {{ date("d-m-Y",strtotime($getCheckClearences->created_at)) }} @endif </td>

										<td nowrap="" style="text-align: center;">
											<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" onclick="openModel({{ $getCheckClearences->fk_registration_id }},{{ $getCheckClearences->registration_payment_detail_id }})" title="Genrate YSK ID">
												<i class="la la-external-link"></i>
											</a>
										</td>

									</tr>

								 @endforeach

							</tbody>

						</table>

					</div>

				</div>



				<div class="kt-portlet__body sahyognidhi" style="display: none;">

					<!--begin: Datatable -->

					<div class="table-responsive">

						<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline sahyognidhi" id="today_datatable1" role="grid" aria-describedby="kt_table_1_info" style="width: 1147px;display: none;">

							<thead>

								<tr role="row">

									{{-- <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">

										<input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>

									</th> --}}

									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">YSK Member Name</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">YSK Member Bank Name</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">Amount</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Branch Name</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Cheque Number</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Narration</th>

									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Bank Name</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Created Date</th>





									<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 30.5px;" aria-label="Actions">Actions</th>

								</tr>

							</thead>

							  <tbody>

								@foreach($getCheckClearenceOfSahyognidhi as $getCheckClearenceOfSahyognidhis)

									<tr role="row" class="odd">

										<td>{{ $getCheckClearenceOfSahyognidhis->payment_give_nominee_name }}</td>

										<td>{{ $getCheckClearenceOfSahyognidhis->nominee_ysk_id }}</td>

										<td><i class="la la-inr"></i>{{ $getCheckClearenceOfSahyognidhis->sahyognidhi_amount }}</td>

										<td></td>

										<td></td>

										<td>Sahyognidhi Payment</td>

                                        <td>{{ $getCheckClearenceOfSahyognidhis->legder_name }}</td>

                                        <td> @if($getCheckClearenceOfSahyognidhis->created_at != "0000-00-00 00:00:00" && $getCheckClearenceOfSahyognidhis->created_at != NULL) {{ date("d-m-Y",strtotime($getCheckClearenceOfSahyognidhis->created_at)) }} @endif </td>

                                        <td nowrap="" style="text-align: center;">

                                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" onclick="openModelForSahyognidhi({{ $getCheckClearenceOfSahyognidhis->fk_sahyognidhi_id }})" title="Genrate YSK ID">

                                        		<i class="la la-external-link"></i>

                                        	</a>

                                        </td>

									</tr>

								@endforeach

							</tbody>

						</table>

					</div>

				</div>

				<!--end: Datatable -->

			</div>

		</div>

		<!-- registration date table -->

		<div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title" id="exampleModalLabel">Cheque Clerence</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						</button>

					</div>

					<div class="modal-body">

						<form method="GET" action="{{ route('save-check-clearence') }}">

							<input type="hidden" name="_token" value="{{csrf_token()}}">



							<div class="registration-list-modal">

								<div class="row">



									<div class="col-sm-12 col-md-12">

										<label>Cheque Clearence Date</label>

										<input type="text" class="form-control" name="check_clear_date" id="check_clear_date">

									</div>



									<div class="col-sm-12 col-md-12">

										<label>Transaction Id</label>

										<input type="text" class="form-control" placeholder="ENTER TRANSACTION ID" name="transaction_id" id="transaction_id">

									</div>



								</div>

							</div>

							<input type="hidden" name="registration_id" id="registration_id" value="">
							<input type="hidden" name="payment_details_id" id="payment_details_id" value="">
							<div class="modal-footer">

								<input type="submit" class="btn btn-primary" name="submit" value="Accept">

								<input type="submit" class="btn btn-danger" name="submit" value="Reject">

							</div>



						</form>

					</div>

				</div>

			</div>

		</div>



		<div class="modal fade" id="kt_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title" id="exampleModalLabel">Genrate YSK ID</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						</button>

					</div>

					<div class="modal-body">

						<form method="GET" action="{{ route('save-check-clearence-of-sahyognidhi') }}">

							<input type="hidden" name="_token" value="{{csrf_token()}}">



							<div class="registration-list-modal">

								<div class="row">



									<div class="col-sm-12 col-md-12">

										<label>Cheque Clearence Date</label>

										<input type="text" class="form-control" name="check_clear_date" id="sahyognidhi_check_clear_date">

									</div>
                                    <div class="col-sm-12 col-md-12">

                                        <label>Transaction Id</label>

                                        <input type="text" class="form-control" placeholder="ENTER TRANSACTION ID" name="transactionid" id="transactionid">

                                    </div>


									{{-- <div class="col-sm-12 col-md-12">

										<label>Transaction Id</label>

										<input type="text" class="form-control" placeholder="Enter Transaction Id" name="transaction_id" id="transaction_id">

									</div> --}}



								</div>

							</div>

							<input type="hidden" name="sahyognidhi_id" id="sahyognidhi_id" value="">

							<div class="modal-footer">

								<input type="submit" class="btn btn-primary" name="submit" value="Accept">

								{{-- <input type="submit" class="btn btn-danger" name="submit" value="Reject"> --}}

							</div>



						</form>

					</div>

				</div>

			</div>

		</div>

	{{-- </div> --}}

</div>

<!--begin::Modal-->

	<div class="modal fade" id="kt_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

		<div class="modal-dialog" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">Details</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					</button>

				</div>

				<div class="modal-body">

					<textarea id="narration" cols="65" rows="5" readonly style="border: none;overflow: auto;background-color: transparent;resize: none;"></textarea>

				</div>

			</div>

		</div>

	</div>

	<!--end::Modal-->

<!-- content end -->

<!--begin::Modal-->

<!--end::Modal-->

@endsection

@section('content_js')

<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
	function openModel(id,payment_details_id) {
		//alert(payment_details_id);
		$('#kt_modal_1').modal();

		$('#registration_id').val(id);
		$('#payment_details_id').val(payment_details_id);
	}



	function openModelForSahyognidhi(id) {

		$('#kt_modal_3').modal();

		$('#sahyognidhi_id').val(id);

	}

	$('#check_clear_date').mask('00-00-0000');

	$('#sahyognidhi_check_clear_date').mask('00-00-0000');



	$(document).ready(function(){

		var date = new Date();



		var day = date.getDate();

		var month = date.getMonth() + 1;

		var year = date.getFullYear();



		if (month < 10) month = "0" + month;

		if (day < 10) day = "0" + day;



		var today = day + "-" + month + "-" + year;

		$('#check_clear_date').attr("value", today);

		$('#sahyognidhi_check_clear_date').attr("value", today);

	});



	function openModelOne() {

		var a = $('#hiddenNarration').val();

		//alert(a);

		$('#kt_modal_2').modal();

		$('#narration').val(a);

	}



	function getAllSameStatus(value) {



		$.ajax({

    		type:'post',

    		url:'{{ route('check-clearance-data') }}',

    		data:{value:value,_token:"{{ csrf_token() }}"},

    		success:function(response){

    			var obj = JSON.parse(response);

    			if (obj.success == 1) {



    				$('#tabel_html').html(obj.html);

    			}

    			else{



    			}

    		}

    	});

		/*if (value == "Registration") {

			$('.checkClerence').show();

			$('.sahyognidhi').hide();

		}

		else{

			$('.sahyognidhi').show();

			$('.checkClerence').hide();

		}*/

	}

</script>

@endsection
