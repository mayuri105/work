@extends('elements.admin_master')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Bank Details                      
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
				@include('elements.left_bar')
			</div>
			<div class="col-xl-4 col-lg-9 order-lg-1 order-xl-1">
				<div class="kt-portlet kt-portlet--mobile">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="kt-font-brand la la-bank"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								List
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<a href="{{ route('add-bank-details') }}" class="btn btn-warning btn-elevate btn-icon-sm">
										<i class="la la-plus"></i>
										Add Bank Details
									</a>
									<a href="#" class="btn btn-warning btn-elevate btn-icon-sm" id="delete_all">
										<i class="la la-trash"></i>
										Delete All
									</a>
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
										<th>Bank Name</th>
										<th>Bank Account Type</th>
										<th>Bank Branch</th>
										<th>Bank Account Number</th>
										<th>Bank IFSC Code</th>
										<th>Default Account</th>
										<th>Created Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($bankDetailsData as $bankDetailsDatas)
										<tr>
											<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" value="{{ $bankDetailsDatas->bank_detail_id }}" class="sub_check_all" onchange="checkSubCheckbox()" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
											<td>{{ $bankDetailsDatas->bank_name }}</td>
											<td>{{ $bankDetailsDatas->bank_account_type }}</td>
											<td>{{ $bankDetailsDatas->bank_branch }}</td>
											<td>{{ $bankDetailsDatas->bank_account_number }}</td>
											<td>{{ $bankDetailsDatas->bank_ifsc_code }}</td>
											<td>
												<label class="switch">
													<input type="checkbox" @if($bankDetailsDatas->default_account == 1) checked @endif id="validAccount" onchange="switchFunction({{ $bankDetailsDatas->bank_detail_id }})">
													<span class="slider round"></span>
												</label>
											</td>
											<td>@if($bankDetailsDatas->created_at != "0000-00-00 00:00:00" && $bankDetailsDatas->created_at != NULL) {{ date("d-m-Y",strtotime($bankDetailsDatas->created_at)) }} @endif</td>
											<td style="width: 10%;">
												<a href="edit-bank-details/{{ $bankDetailsDatas->bank_detail_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><i class="la la-edit" style="font-size: 20px;"></i></a>
												<a href="#"  onclick="deleteFunction({{ $bankDetailsDatas->bank_detail_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete"><i class="fa fa-trash-o" style="font-size: 20px;"></i></a>
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

				location.href = 'delete-bank-details/'+id;

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
							url: "{{ route('multiple-delete-bank-details') }}",
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
<script>
	function switchFunction(id) {
		location.href = 'switch-bank-details/'+id;
	}
</script>

@endsection