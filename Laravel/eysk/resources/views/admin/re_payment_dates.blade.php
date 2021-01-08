@extends('elements.admin_master')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Repayment Date                            
				</h3>
			</div>
			<div class="kt-subheader__toolbar">
				<div class="kt-subheader__wrapper"></div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->                    
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">
			<div class="col-xl-4 col-lg-3 order-lg-1 order-xl-1">
				@include('elements.left_bar')
			</div>
			<div class="col-xl-4 col-lg-9 order-lg-1 order-xl-1">
				<div class="ktt-sitebar-page-bady" style="padding:20px;">	
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<div class="row">
								<div class="col-lg-6">
									<span class="kt-portlet__head-icon kt-hidden">
										<i class="la la-gear"></i>
									</span>
									<h3 class="kt-portlet__head_title" id="add_role">
										Bank Charges
									</h3>
								</div>
								<div class="col-lg-6">
									
									<a href="{{ route('add-bank-charges') }}" class="btn btn-warning btn-wide" style="font-size: 15px;float: right;">
										<i class="la la-plus" style="font-size: 20px;"></i>
										Add Bank Charges
									</a>
									<a href="#" style="font-size: 15px;float: right;margin-right: 20px;" class="btn btn-warning btn-wide" id="delete_all"><i class="fa fa-trash-o" style="padding: 5px 7px;font-size: 20px;"></i>Delete All</a>
								</div>
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
					<br>
					<table id="example" class="table table-striped table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th style="width: 1%;" class="text-center"><input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages" style="width: 18px;height: 18px;"></th>
								<th>Bank Charge Amount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							
							<tr>
								<td class="text-center"><input type="checkbox" name="sub_check_all[]" value="" class="sub_check_all" onchange="checkSubCheckbox()" id="pages" style="width: 18px;height: 18px;"></td>
								<td>1</td>
								<td style="width: 10%;">
									<a href="" class="btn btn-sm btn-clean btn-icon btn-icon-md" style="color: #4fbf85;border: 1px solid  #4fbf85;font-size: 25px;"><i class="la la-edit" style="padding: 5px 7px;font-size: 20px;"></i></a>
									<a href="#"  onclick="deleteFunction()" class="btn btn-sm btn-clean btn-icon btn-icon-md" style="color: #4fbf85;border: 1px solid  #4fbf85;font-size: 25px;"><i class="fa fa-trash-o" style="padding: 5px 7px;font-size: 20px;"></i></a>
								</td>
							</tr>
							
						</tbody>
					</table>
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
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				location.href = 'delete-bank-charges/'+id;

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
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {

					var strIds = idsArr.join(","); 
						//alert(strIds);
						$.ajax({
							url: "",
							type: 'POST',
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							data: 'ids='+strIds,
							success: function (data) {
								if (data['status']==true) {
									$(".sub_check_all:checked").each(function() {  
										$(this).parents("tr").remove();
									});
									swal(data['message']);
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