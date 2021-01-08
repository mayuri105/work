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
						Suspense Account           
					</h3>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper"></div>
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
	
        <!--begin::Portlet-->     
		        <div class="kt-portlet kt-portlet--tab">            
					<div class="main-padding ceparetar">
		           	  <div class="row"> 
		           	     <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">Pending Entry</span>
		                    	<span class="view-value-text">{{$pendingEntry}}</span>
		           	        </div>
		             	</div>
		             	  <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">Bank Total Rs.</span>
		                    	<span class="view-value-text"><i class="la la-inr"></i> {{$bankTotalAmount}}</span>
		           	        </div>
		             	</div>
		             	  <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">SBI Rs.</span>
		                    	<span class="view-value-text"><i class="la la-inr"></i>{{ $totalSbiAmount }} </span>
		           	        </div>
		             	</div>
		             	  <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">HDFC Rs.</span>
		                    	<span class="view-value-text"><i class="la la-inr"></i>{{ $totalHdfcAmount }}</span>
		           	        </div>
		             	</div>
		             	 <!--<div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">Courier Dispatch Pending</span>
		                    	<span class="view-value-text">100</span>
		           	        </div>
		             	</div>
		             	<div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">Post Dispatch Hand to Hand</span>
		                    	<span class="view-value-text">30</span>
		           	        </div>
		             	</div>-->
		              </div>
		            </div>
		        </div>
		    </div>

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="margin-top: -10px;"> 
		<!-- registration date table -->  
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
								
                                @if(in_array('delete-all-suspense-account',$accessData))
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
									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Bank Name</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">Payment Type</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Date</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Amount</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Created Date</th>
									<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.5px;" aria-label="Actions">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($suspenseAccount as $suspenseAccounts)
									<tr role="row" class="odd">
										<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value="{{ $suspenseAccounts->suspense_account_id }}" onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span></label>
										</th>
										<td>{{ $suspenseAccounts->legder_name }}</td>
										<td>{{ $suspenseAccounts->payment_type }}</td>
										<td>{{ date("d-m-Y", strtotime($suspenseAccounts->date)) }}</td>
										<td><i class="la la-inr"></i>{{ $suspenseAccounts->amount }}</td>
                                        <td>@if($suspenseAccounts->created_at != "0000-00-00 00:00:00" && $suspenseAccounts->created_at != NULL) {{ date("d-m-Y",strtotime($suspenseAccounts->created_at)) }} @endif</td>
										<td nowrap="">
										    @if(in_array('view-suspense-account',$accessData))
    											<a href="details-suspense-account/{{ $suspenseAccounts->suspense_account_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
    												<i class="la la-eye"></i>
    											</a>
    										@endif
    										@if(in_array('edit-suspense-account',$accessData))
    											<a href="edit-suspense-account/{{ $suspenseAccounts->suspense_account_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
    												<i class="la la-edit"></i>
    											</a>
    										@endif
    										@if(in_array('delete-suspense-account',$accessData))
    											<a href="#" onclick="deleteSuspenceAccount({{ $suspenseAccounts->suspense_account_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
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
		<!-- registration date table -->
	</div>
</div>     
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

	function deleteSuspenceAccount(id) {
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			icon: "warning",
			buttons: ["Cancel", "Do it!"],
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				location.href = 'delete-suspense-account/'+id;

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
							url: "{{ route('multiple-delete-suspense-account') }}",
							type: 'POST',
							data: {ids: strIds,_token:"{{ csrf_token() }}"},
							success: function (data) {
								var obj = JSON.parse(data);
							if (obj.success == "1") {
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
$('#user_name1').select2();


function openModel($id) {
	$('#kt_modal_1').modal();
    $('#assign_suspense_account').val($id); 
}

</script>
@endsection