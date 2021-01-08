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
						Employee Registration                      
					</h3>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper"></div>
				</div>
			</div>
		</div>
	{{-- </div> --}}
	<!-- end:: Subheader --> 

	<!-- my section new add start-->
	{{-- <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}
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
	</div>
	<!-- my section new add end-->   
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!-- registration date table -->
		<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
							    @if(in_array('add-employee-registration',$accessData))
    								<a href="{{ route('add-employee-registration') }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
    									<i class="la la-plus"></i>
    									Add Employee Registration
    								</a>
    							@endif
                                @if(in_array('delete-all-employee-registration',$accessData))
    								<a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="delete_all">
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
						<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline view_table" id="today_datatable">
							<thead>
								<tr>
									<th>
										<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span>
										</label>
									</th>
									<th>Employee Name</th>
									<th>Email</th>
									<th>Contact Number</th>
									<th>Address</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							@foreach($employeeRegistrationData as $employeeRegistrationDatas) 
								<tr>
									<td>
										<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value=" {{ $employeeRegistrationDatas->employee_registration_id }} " onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span>
										</label>
									</td>
									<td>{{ $employeeRegistrationDatas->employee_name }}</td>
									<td>{{ $employeeRegistrationDatas->employee_email }}</td>
									<td>{{ $employeeRegistrationDatas->employee_first_phone_number }}</td>
									<td>{{ $employeeRegistrationDatas->employee_address }}</td>
									<td>
									    @if(in_array('details-employee-registration',$accessData))
    										<a href="view-employee-registration/{{ $employeeRegistrationDatas->employee_registration_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
    											<i class="la la-eye"></i>
    										</a> 
    									@endif
    									@if(in_array('edit-employee-registration',$accessData))
    										<a href="edit-employee-registration/{{ $employeeRegistrationDatas->employee_registration_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
    											<i class="la la-edit"></i>
    										</a>
    									@endif
    									@if(in_array('delete-employee-registration',$accessData))
    										<a href="#" onclick="deleteEmployeeRegistration({{ $employeeRegistrationDatas->employee_registration_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
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
			</div>	
			<!-- registration date table -->
		</div>
	</div>
	<!-- content end -->          
</div>
<!--ENd:: Chat-->
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

	function deleteEmployeeRegistration(id) {
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			icon: "warning",
			buttons: ["Cancel", "Do it!"],
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				location.href = 'delete-employee-registration/'+id;

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
							url: "{{ route('multiple-delete-employee-registration') }}",
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
</script>
@endsection