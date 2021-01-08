@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')
<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Minor Account                       
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
								 {{-- <a href="{{ route('add-all-bank-entry') }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
									<i class="la la-plus"></i>
									Add All Bank Entry
								</a> --}} 
                                @if(in_array('delete-all-minor-account',$accessData))
    								<a href="#" id="delete_all" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
    									<i class="la la-trash"></i>
    									Delete All
    								</a>
    							@endif
							</div>
						</div>
					</div> 


				</div>
				<div class="kt-portlet__body">
					<!--begin: Datatable -->
					<div class="table-responsive">
						<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="today_datatable" role="grid" aria-describedby="kt_table_1_info" style="width: 1147px;">
							<thead>
								<tr role="row">
									<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
										<input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
									</th>
									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Entry Date</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">YSK Date</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">YSK Number</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">YSK Member Name</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Region</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Processing ID</th>					

									<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.5px;" aria-label="Actions">Actions</th>
								</tr>
							</thead>
							<tbody>
								 @foreach($minorAccountData as $key => $minorAccountDatas) 
									<tr role="row" class="odd">
										<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value=" {{ $minorAccountDatas->registration_id }} " onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span></label>
										</th>
										<td>@if($minorAccountDatas->today_date != "0000-00-00" && $minorAccountDatas->today_date != NULL){{ date("d-m-Y",strtotime($minorAccountDatas->today_date)) }} @else -- @endif</td>
										<td>@if($minorAccountDatas->ysk_date != "0000-00-00" && $minorAccountDatas->ysk_date != NULL){{ date("d-m-Y",strtotime($minorAccountDatas->ysk_date)) }} @else -- @endif</td>
										<td>@if($minorAccountDatas->ysk_id != ''){{ $minorAccountDatas->ysk_id }} @elseif($minorAccountDatas->pre_ysk_id != '') {{ $minorAccountDatas->pre_ysk_id }} @else ---- @endif</td>
										<td>{{ $minorAccountDatas->hidden_name_as_per_yuva_sangh_org }}</td>
										<td>{{ $minorAccountDatas->region_name }}({{ $minorAccountDatas->region_code }})</td>
										<td>{{ $minorAccountDatas->processing_id }}</td>
										<td nowrap="">
										    @if(in_array('view-minor-account',$accessData))
    											<a href="details-registrationstatus/{{ $minorAccountDatas->registration_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
    												<i class="la la-eye"></i>
    											</a>
    										@endif
    										@if(in_array('edit-minor-account',$accessData))
    											<a href="edit-registration/{{ $minorAccountDatas->registration_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
    												<i class="la la-edit"></i>
    											</a>
    										@endif

											 @if($isProfilePhoto[$key] == '1' || $isProfilePhoto[$key] == '0' || $minorAccountDatas->amount == '' || $minorAccountDatas->first_nominee_name == '' || $minorAccountDatas->second_nominee_name == '') 
												<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon hoverTooltip" id="{{ $minorAccountDatas->registration_id }}">
													<i class="fa fa-question-circle" style="color: red;"></i>
												</a>
											 @endif 
                                            @if(in_array('delete-minor-account',$accessData))
    											<a href="#" onclick="deleteMinorAccount({{ $minorAccountDatas->registration_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
    												<i class="la la-trash"></i>
    											</a>
    										@endif
                                            
                                            @if(in_array('payment-minor-account',$accessData))
    											@if($minorAccountDatas->amount != '')
    												<a href="payment-details/{{ $minorAccountDatas->registration_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Payment Details">
    													<i class="fas fa-credit-card"></i>
    												</a>
    											@endif
    										@endif

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
	{{-- </div> --}}
</div>
<!-- content end -->
<!--begin::Modal-->
<!--end::Modal-->       
@endsection
@section('content_js')
<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	function checkAll() {
		var ischecked= $('.check_all').is(':checked');
		//alert(ele);
		if(ischecked == true){
			$('.sub_check_all').prop('checked', true);
		}
		else{
			$('.sub_check_all').prop('checked', false);
		}
	}

	function checkSubCheckbox() {

		if($('.sub_check_all:checked').length == $('.sub_check_all').length){

			$('.check_all').prop('checked',true);

		}else{

			$('.check_all').prop('checked',false);

		}
	}

	function deleteMinorAccount(id) {
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			icon: "warning",
			buttons: ["Cancel", "Do it!"],
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				location.href = 'delete-minor-account/'+id;

			} else {
				swal({
					buttons: false, // There won't be any confirm button
					text:"Your data is safe!"
				});
			}
		});
	}


$('#delete_all').on('click', function(e) {
		var idsArr = [];
		$(".sub_check_all:checked").each(function() {  
			idsArr.push($(this).attr('value'));
		});
		if(idsArr.length <=0)  
		{  
			swal({
			buttons: false, // There won't be any confirm button
			text:"Please select atleast one record to delete."}); 
		}else {  
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: ["Cancel", "Do it!"],
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {

					var strIds = idsArr.join(","); 
						//alert(strIds);
						$.ajax({
							url: "{{ route('multiple-delete-registration') }}",
							type: 'POST',
							data: {ids: strIds,_token:"{{ csrf_token() }}"},
							success: function (data) {
								if (data['status']==true) {
									$(".sub_check_all:checked").each(function() {  
										$(this).parents("tr").remove();
									});
									location.reload();
								}else {
								//alert(data['message']);
								swal('Whoops Something went wrong!!');
							}
						},
						error: function (data) {
							swal(data.responseText);
						}
					});

					} else {
						swal({
					buttons: false, // There won't be any confirm button
					text:"Your data is safe!"}); 
					}
				});
			
		}
	});
$('#kt_select24_24').select2();
$('#kt_select26_26').select2();

$(document).ready(function(){

		$('.hoverTooltip').tooltip({
			title: fetchData,
			html: true,
			placement: 'right'
		});

		function fetchData()
		{
			var id = $(this).attr("id");
			var fetch_data = '';
			$.ajax({
				url:"{{ route('tooltip-status') }}",
				method:"POST",
				async: false,
				data:{id:id,_token:"{{ csrf_token() }}"},
				success:function(response)
				{
					var obj = JSON.parse(response);
					fetch_data = obj.html_data;
				}
			});   
			return fetch_data;
		}
	});
</script>
@endsection