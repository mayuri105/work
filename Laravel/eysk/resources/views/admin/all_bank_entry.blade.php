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
						All Bank Entry                           
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
							    @if(in_array('add-all-bank-entry',$accessData))
    								 <a href="{{ route('add-all-bank-entry') }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
    									<i class="la la-plus"></i>
    									Add All Bank Entry
    								</a>
    							@endif
                                @if(in_array('delete-all-bank-entry',$accessData))
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
									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Ysk No</th>
									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Cheque No</th>
									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Bank Name</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">Payment Type</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Payment Date</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Total Amount</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Payment Mode</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Created Date</th>
									

									<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.5px;" aria-label="Actions">Actions</th>
								</tr>
							</thead>
							<tbody>
								 @foreach($getAllBankEntry as $getAllBankEntries) 
									<tr role="row" class="odd">
										<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value=" {{ $getAllBankEntries->all_bank_entry_id }} " onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span></label>
										</th>
										<td>@if($getAllBankEntries->ysk_id != ''){{ $getAllBankEntries->ysk_id }} @else {{ $getAllBankEntries->pre_ysk_id }} @endif</td>
										<td>{{ $getAllBankEntries->cheque_number }}</td>
										<td>{{ $getAllBankEntries->legder_name }}</td>
										<td>{{ $getAllBankEntries->payment_type }}</td>
										<td>{{ date("d-m-Y", strtotime($getAllBankEntries->payment_date)) }}</td>
										<td><i class="la la-inr"></i>{{ $getAllBankEntries->amount }}</td>
                                        <td>{{ $getAllBankEntries->payment_mode }}</td>
                                        <td> @if($getAllBankEntries->created_at != "0000-00-00 00:00:00" && $getAllBankEntries->created_at != NULL) {{ date("d-m-Y",strtotime($getAllBankEntries->created_at)) }} @endif </td>
										<td nowrap="">
										    @if(in_array('view-all-bank-entry',$accessData))
    											<a href="details-all-bank-entry/{{ $getAllBankEntries->all_bank_entry_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
    												<i class="la la-eye"></i>
    											</a>
    										@endif
											{{-- <a href="" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
												<i class="la la-edit"></i>
											</a> --}}
											@if(in_array('delete-bank-entry',$accessData))
    											<a href="#" onclick="deleteAllBankEntry({{ $getAllBankEntries->all_bank_entry_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
    												<i class="la la-trash"></i>
    											</a>
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

	function deleteAllBankEntry(id) {
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			icon: "warning",
			buttons: ["Cancel", "Do it!"],
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				location.href = 'delete-all-bank-entry/'+id;

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
							url: "{{ route('multiple-delete-all-bank-entry') }}",
							type: 'POST',
							data: {ids: strIds,_token:"{{ csrf_token() }}"},
							success: function (data) {
							  var obj = JSON.parse(data);
							if (obj.success == "1") {
								location.reload();
							}
							else {
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
    //add more fields group
    $(".addMoreOne").click(function(){        
        var fieldHTML = '<br><div class="form-group fieldGroupOne">'+$(".fieldGroupCopyOne").html()+'</div>';
        $('body').find('.fieldGroupOne:last').after(fieldHTML);        
    });    
    //remove fields group
    $("body").on("click",".removeOne",function(){ 
        $(this).parents(".fieldGroupOne").remove();
    });
});


</script>
@endsection