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
						Fix Deposit
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
								@if(in_array('add-fix-deposit',$accessData))
    								<a href="{{ route('add-fix-deposit') }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
    									<i class="la la-plus"></i>
    									Add Fix Deposit
    								</a>
								@endif
                                @if(in_array('delete-all-fix-deposit',$accessData))
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
									<th>Date</th>
									<th>Fix Deposit Number</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							@foreach($fixdepositData as $fixdepositDatas)
								<tr>
									<td>
										<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value=" {{ $fixdepositDatas->fix_deposit_id }} " onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span>
										</label>
									</td>
									<td>{{ date('d-m-Y',strtotime($fixdepositDatas['date'])) }}</td>
									<td>{{ $fixdepositDatas->fix_deposit_no }}</td>

									<td>
									     @if(in_array('details-fix-deposit',$accessData))
    									<a href="view-fix-deposit/{{ $fixdepositDatas->fix_deposit_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
    											<i class="la la-eye"></i>
    										</a>
    									@endif
    							        @if(in_array('edit-fix-deposit',$accessData))
    									<a href="edit-fix-deposit/{{ $fixdepositDatas->fix_deposit_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
    											<i class="la la-edit"></i>
    										</a>
								        @endif
								        @if(in_array('delete-fix-deposit',$accessData))
    										<a href="#" onclick="deletefixdeposit({{ $fixdepositDatas->fix_deposit_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
    											<i class="la la-trash"></i>
    										</a>
    									@endif
                                             @if(in_array('details-fix-deposit',$accessData))
                                                 <a href="withdraw-fix-deposit/{{ $fixdepositDatas->fix_deposit_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
                                                     <span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill" style="background-color: #ffb822">withdraw</span>
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

	function deletefixdeposit(id) {
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			icon: "warning",
			buttons: ["Cancel", "Do it!"],
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				location.href = 'delete-fix-deposit/'+id;

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
							url: "{{ route('multiple-delete-fix-deposit') }}",
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
