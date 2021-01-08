@extends('elements.admin_master')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Late Fees Amount                       
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
								<i class="kt-font-brand fa fa-dollar"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								List
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
								    @if(in_array('add-late-fees-amount',$accessData))
    									<a href="{{ route('add-late-fees-amount') }}" class="btn btn-warning btn-elevate btn-icon-sm">
    										<i class="la la-plus"></i>
    										Add Late Fees Amount
    									</a>
    								@endif
    								@if(in_array('delete-all-late-fees-amount',$accessData))
    									<a href="#" class="btn btn-warning btn-elevate btn-icon-sm" id="delete_all">
    										<i class="la la-trash"></i>
    										Delete All
    									</a>
    								@endif
								</div>	
							</div>		
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th style="width: 1%;" class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages" style="width: 16px;height: 16px;">&nbsp;<span></span></label></th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Late Fees Days</th>
										<th>Late Fees Charges</th>
										<th>Grace Days</th>
										<th>Grace Period Charges</th>
										<th>Created Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($lateFeesAmount as $lateFeesAmount)
										<tr>
											<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" value="{{ $lateFeesAmount->late_fees_amount_id }}" class="sub_check_all" onchange="checkSubCheckbox()" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
											<td>{{ date("d-m-Y",strtotime($lateFeesAmount->start_date)) }}</td>
											<td>@if($lateFeesAmount->end_date != "0000-00-00") {{ date("d-m-Y",strtotime($lateFeesAmount->end_date)) }} @endif</td>
											<td>{{ $lateFeesAmount->late_fees_days }}</td>
											<td><i class="la la-inr"></i>{{ number_format($lateFeesAmount->late_fees_charges,2) }}</td>
											<td>{{ $lateFeesAmount->grace_days }}</td>										
											<td><i class="la la-inr"></i>{{ number_format($lateFeesAmount->grace_period_charges,2) }}</td>
											<td>@if($lateFeesAmount->created_at != "0000-00-00 00:00:00" && $lateFeesAmount->created_at != NULL) {{ date("d-m-Y",strtotime($lateFeesAmount->created_at)) }} @endif</td>
											<td style="width: 10%;">
											    @if(in_array('edit-late-fees-amount',$accessData))
												    <a href="edit-late-fees-amount/{{ $lateFeesAmount->late_fees_amount_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" style="font-size: 25px;"><i class="la la-edit" style="font-size: 20px;"></i></a>
												@endif
												@if(in_array('delete-late-fees-amount',$accessData))
												    <a href="#"  onclick="deleteFunction({{ $lateFeesAmount->late_fees_amount_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete" style="font-size: 25px;"><i class="fa fa-trash-o" style="font-size: 20px;"></i></a>
											    @endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
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
	setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);

	$(document).ready(function() {
		$('#example').DataTable({
			stateSave: true,
			"bDestroy": true,
			"ordering": false
		});
	} );
</script>
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



</script>
<script>
	function deleteFunction(id) {
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			icon: "warning",
			buttons: ["Cancel", "Do it!"],
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				location.href = 'delete-late-fees-amount/'+id;

			} else {
				swal({
					buttons: false, // There won't be any confirm button
					text:"Your data is safe!"
				});
			}
		});
	}
</script>

<script>
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
							url: "{{ route('multiple-delete-late-fees-amount') }}",
							type: 'POST',
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							data: 'ids='+strIds,
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
</script>
@endsection