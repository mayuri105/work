@extends('elements.admin_master')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<style type="text/css" media="screen">

	input[type="file"] {

		display: block;

	}

	.imageThumb {

		max-height: 75px;

		border: 2px solid;

		padding: 1px;

		cursor: pointer;

	}

	.pip {

		display: inline-block;

		margin: 10px 10px 0 0;

	}

	.remove {

		display: block;

		background: #444;

		border: 1px solid black;

		color: white;

		text-align: center;

		cursor: pointer;

	}

	.remove:hover {

		background: white;

		color: black;

	}

</style>

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

								Add Journal Voucher

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

							<a href="{{ route('journal-voucher') }}">

								<i class="la la-long-arrow-left"></i>

								Back

							</a>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>





	<!-- end:: Subheader -->

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<div class="row">

			<div class="col-lg-12">

				<!--begin::Portlet-->

				<div class="kt-portlet">



					<div class="mtt-body">

						<form action="{{ route('save-journal-voucher') }}" enctype="multipart/form-data" method="POST">

							<input type="hidden" name="_token" value="{{csrf_token()}}">

							<!--end::Portlet-->

							<div class="kt-portlet sahyognidhi-mtt">

								<div class="row">

									<div class="col-sm-12">

										<div id="London" class="w3-container city">

											<div class="Half-section-details">



												<div class="form-group1 m-form__group1 row">

													<label class="col-lg-2 col-form-label">Date<span class="text-danger">*</span></label>

													<div class="col-lg-2" style="margin-left: -150px;">

														<input type="text" id="today_date" name="date" class="form-control" placeholder="ENTER DATE" >

														@if ($errors->has('date'))

														<span style="color: red;">

															{{ $errors->first('date') }}

														</span>

														@endif

													</div>

													<div class="col-lg-5">
													</div>

													<label class="col-lg-2 col-form-label" style="padding-left: 20px;">Payment Number<span class="text-danger">*</span></label>

													<div class="col-lg-2">

														<input type="text" id="payment_no" name="journal_voucher_no" class="form-control" placeholder="ENTER JOURNAL VOUCHER NUMBER" value="{{ $journal_voucher_no }}" readonly="">

														@if ($errors->has('journal_voucher_no'))

														<span style="color: red;">

															{{ $errors->first('journal_voucher_no') }}

														</span>

														@endif

													</div>


												</div>

												<div class="form-group1 m-form__group1 row details">
													<div class="registration-list-modal" style="width: 100%;">
														<div class="row">
															<div class="col-lg-4">
																<label>Ledger Account</label>
																<div>
																	<select class="form-control" name="fk_ledger_account_id_main" id="fk_ledger_account_id1">

										<option value="" selected="selected">SELECT LEDGER ACCOUNT</option>

										@foreach($ledgeraccounts as $ledgeraccountss)
											<option value="{{ $ledgeraccountss->ledger_account_id }},1">{{ $ledgeraccountss->legder_name }}</option>
										@endforeach

{{--										@foreach($registrationaccounts as $registrationaccountss)--}}
{{--											<option value="{{ $registrationaccountss->registration_id }},2">{{ $registrationaccountss->name_as_per_yuva_sangh_org }}</option>--}}
{{--										@endforeach--}}

										</select>
										@if ($errors->has('fk_ledger_account_id'))<span style="color: red;">{{ $errors->first('fk_ledger_account_id') }}</span>@endif
									</div>

															</div>
															<div class="col-lg-2">
																<div class="row">
																	<div class="col-sm-3" style="margin-top: 10px;">
																		<label></label>
																		<div class="kt-radio-inline redio-mt">
																			<label class="kt-radio">
																				<input type="radio" name="transaction_type_main" value="Debit" checked> Debit
																				<span class="tablinks"></span>
																			</label>
																		</div>
																	</div>
																	<div class="col-sm-3" style="margin-top: 10px;margin-left: 20px;">
																		<label></label>
																		<div class="kt-radio-inline redio-mt">
																			<label class="kt-radio">
																				<input type="radio" name="transaction_type_main" value="Credit" disabled> Credit
																				<span class="tablinks" ></span>
																			</label>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-2">
																<label>Amount</label>
																<input type="text" class="form-control"  id="amount_main" name="amount_main" placeholder="ENTER AMOUNT" >
																@if ($errors->has('amount_main'))
																<span style="color: red;">
																	{{ $errors->first('amount_main') }}</span>@endif
																</div>


															</div>
														</div>
													</div>

													<div class="form-group1 m-form__group1 row details">	<div class="registration-list-modal"  style="width: 100%;">
														<div class="row">
															<div class="col-lg-4 padding-mt">
																<label>Ledger Account</label>
																<div>
										<select class="form-control" name="fk_ledger_account_id[]" id="fk_ledger_account_id">

										<option value="" selected="selected">SELECT LEDGER ACCOUNT</option>

										@foreach($ledgeraccounts2 as $ledgeraccounts2s)

    										<option value="{{ $ledgeraccounts2s->ledger_account_id }},1">{{ $ledgeraccounts2s->legder_name }}</option>

										@endforeach

{{--										@foreach($registrationaccounts as $registrationaccountss)--}}
{{--											<option value="{{ $registrationaccountss->registration_id }},2">{{ $registrationaccountss->name_as_per_yuva_sangh_org }}</option>--}}
{{--										@endforeach--}}
										</select>
																	@if ($errors->has('fk_ledger_account_id'))
																	<span style="color: red;">
																		{{ $errors->first('fk_ledger_account_id') }}
																	</span>
																	@endif

																</div>

															</div>
															<div class="col-lg-2 padding-mt">
																<div class="row">
																	<div class="col-sm-3" style="margin-top: 10px;">
																		<label></label>
																		<div class="kt-radio-inline redio-mt">
																			<label class="kt-radio">
																				<input type="radio" name="transaction_type[1][]" value="Debit" disabled> Debit
																				<span class="tablinks"></span>
																			</label>
																		</div>
																	</div>
																	<div class="col-sm-3" style="margin-top: 10px;margin-left: 20px;">
																		<label></label>
																		<div class="kt-radio-inline redio-mt">
																			<label class="kt-radio">
																				<input type="radio" name="transaction_type[1][]" value="Credit" checked > Credit
																				<span class="tablinks" ></span>
																			</label>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-2 padding-mt">
																<label>Amount</label>
																<input type="text" class="form-control"  id="amount" name="amount[]" placeholder="ENTER AMOUNT" value="{{ old('amount.0') }}" required>
																@if ($errors->has('amount'))
																<span style="color: red;">
																	{{ $errors->first('amount') }}</span>@endif
                                                                <span id='message'></span>
																</div>



																<div class="col-lg-1 padding-mt" style="margin-top: 34px;">
																	<a href="javascript:void(0);" class="nominee-details-add add_button" title="Add field"><i class="la la-plus"></i></a>
																</div>
															</div>
															<div class="field_wrapper">


															</div>
														</div>
													</div>
                                                <div class="form-group1 m-form__group1 row">
                                                    <div class="col-lg-8">
                                                        <label>Narration<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="narration_main" name="narration_main" placeholder="ENTER NARRATION" value="{{ old('narration_main') }}" maxlength="150"></textarea>
                                                        @if ($errors->has('narration_main'))
                                                            <span style="color: red;">
																		{{ $errors->first('narration_main') }}
																	</span>
                                                        @endif
                                                    </div>
                                                </div>

													<div class="nominee-details-mtt">

														<h3></h3>

														<div class="sahyognidhi-border"></div>

														<div class="form-group1 m-form__group1 row">

															<label class="col-lg-2 col-form-label"></label>

															<div class="col-lg-9">

																<div class="kt-portlet__head-toolbar">

																	<div class="kt-portlet__head-wrapper">

																		<div class="kt-portlet__head-actions">

																			<input type="submit" name="submit" value="  Add  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">

																			<a href="{{ route('journal-voucher') }}" class="btn-cancel-registration">Cancel</a>

																		</div>

																	</div>

																</div>

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

				</div>

			</div>

		</div>

	</div>



	<!-- content end -->

	<!--ENd:: Chat-->

	@endsection

	@section('content_js')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        function checkAll(ele) {
            var ischecked= $('.add_class_'+ele).is(':checked');
            //alert(ele);
            if(ischecked == true){
                $('.add_class_sub_'+ele).prop('checked', true);
            }
            else{
                $('.add_class_sub_'+ele).prop('checked', false);
            }
        }
        function checkSubCheckbox(ele,parentPageId) {
            var ischecked = $('#pages'+ele).is(':checked');
            //alert(ele);
            if(ischecked == false){
                $('.add_class_'+parentPageId).prop('checked', false);
            }
            else{
                if($('.add_class_sub_'+parentPageId+':checked').length == $('.add_class_sub_'+parentPageId).length){
                    $('.add_class_'+parentPageId).prop('checked',true);
                }
            }
        }
    </script>


    <script type="text/javascript">

        $(document).ready(function(){

            var maxField = 100; //Input fields increment limitation

            var addButton = $('.add_button'); //Add button selector

            var wrapper = $('.field_wrapper'); //Input field wrapper

            var x = 2; //Initial field counter is 1

            //Once add button is clicked

            $('.add_button').click(function(){

                var fieldHTML = '<div class="row field_wrapper remove_div_data_'+x+'" ><div class="col-lg-4 padding-mt"><label>Ledger Account</label><div><select class="form-control" name="fk_ledger_account_id[]" id="fk_ledger_account_id'+x+'"><option value="" selected="selected">SELECT LEDGER ACCOUNT</option>@foreach($ledgeraccounts2 as $ledgeraccounts2s)<option value="{{ $ledgeraccounts2s->ledger_account_id }},1">{{ $ledgeraccounts2s->legder_name }}</option>@endforeach @foreach($registrationaccounts as $registrationaccountss)<option value="{{ $registrationaccountss->registration_id }},2">{{ $registrationaccountss->name_as_per_yuva_sangh_org }}</option>@endforeach</select>@if ($errors->has('fk_ledger_account_id'))<span style="color: red;">{{ $errors->first('fk_ledger_account_id') }}</span>@endif</div></div><div class="col-lg-2 padding-mt"><div class="row"><div class="col-sm-3" style="margin-top: 10px;"><label></label><div class="kt-radio-inline redio-mt"><label class="kt-radio"><input type="radio" name="transaction_type['+x+'][]" value="Debit" id="Debit"> Debit<span class="tablinks"></span></label></div></div><div class="col-sm-3" style="margin-top: 10px;margin-left: 20px;"><label></label><div class="kt-radio-inline redio-mt"><label class="kt-radio"><input type="radio" name="transaction_type['+x+'][]" value="Credit" id="Credit" checked> Credit<span class="tablinks" ></span></label></div></div></div></div><div class="col-lg-2 padding-mt"><label>Amount</label><input type="text" class="form-control amount"  id="amount" name="amount[]" placeholder="ENTER AMOUNT" >@if ($errors->has('amount'))<span style="color: red;">{{ $errors->first('amount') }}</span>@endif</div><div class="col-lg-1 padding-mt" style="margin-top: 32px;"><a href="javascript:void(0);" class="nominee-details-add remove_button" title="Remove field" onclick="removeButton('+x+')"><i class="la la-minus"></i></a></div></div>';

                //Check maximum number of input fields

                if(x < maxField){

                    x++; //Increment field counter

                    $(wrapper).append(fieldHTML); //Add field html

                    // $("#fk_ledger_account_id"+x).select2();


                    var i;

                    for (i = 1; i < x; i++) {

                        $("#fk_ledger_account_id"+i).select2( {
                            placeholder: "Select Ledger Account",
                            allowClear: false
                        } );

                        $(".amount").on("keyup", function() {
                            calculateSum();
                        });


                        var transaction_type_main = $('input[name=transaction_type_main]:checked').val();

                        if(transaction_type_main == 'Credit')
                        {
                            $("#Debit").prop("checked", true);
                        }
                        else
                        {
                            $("#Credit").prop("checked", true);
                        }

                    }
                }

            });

        });

        function removeButton(id){

            $('.remove_div_data_'+id).remove();

        }

        $('#date').mask('00-00-0000');


    </script>
    <script>
        $("#fk_ledger_account_id").select2( {
            placeholder: "Select Ledger Account",
            allowClear: false
        } );
        $("#fk_ledger_account_id1").select2( {
            placeholder: "Select Ledger Account",
            allowClear: false
        } );
    </script>
    <script>
        $(document).ready(function() {
            // calculateSum();

            $(".amount").on("keyup", function() {
                calculateSum();
            });

            $(".amount_main").on("keyup", function() {
                calculateSum();
            });
        });

        function calculateSum() {
            var sum = 0;

            var amount_main = document.getElementById("amount_main").value;
            // alert(amount_main);
            $(".amount").each(function(){
                sum += +$(this).val();
            });

            var totalsum = sum;
            // alert(totalsum);
            if(amount_main < totalsum)
            {
                //this.value = value.substr(0,value.length-1);
                //alert('Please add Fix Deposit Amount Total Lessthen Main Amount');
                swal('Please Add Fix Deposit Amount Total Less than Main Amount');
                //$('.fd_amount').val('');
            }
            else{
                var differ=amount_main-totalsum;
                $('#message').html('**The reamining amount is:-'+differ).css('color', 'red');
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.transaction_type_main').click(function () {

                var transaction_type_main = $("input[name='transaction_type_main']:checked").val();

                if(transaction_type_main == 'Credit')
                {
                    $("#Debit").prop("checked", true);
                }
                else
                {
                    $("#Credit").prop("checked", true);
                }

            });

        });
        $('#date').mask('00-00-0000');
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

    @endsection

