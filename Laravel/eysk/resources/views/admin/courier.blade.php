@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 55px;
  height: 24px;
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
  height: 20px;
  width: 20px;
  left: 4px;
  bottom: 2px;
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
<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Courier                       
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
							    @if(in_array('add-courier',$accessData))
								<a href="{{ route('add-courier') }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
									<i class="la la-plus"></i>
									Add Courier
								</a>
								@endif
                                @if(in_array('delete-all-courier',$accessData))
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
									<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">YSK Id</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Ysk Member Name</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Phone Number</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Courier Status</th>

									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Status</th>

									<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.5px;" aria-label="Actions">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($courier as $couriers)
									<tr role="row" class="odd">
										<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value="{{ $couriers->courier_id }}" onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span></label>
										</th>
										<td>{{ $couriers->fk_registration_id }}</td>
										<td>{{ $couriers->name_as_per_yuva_sangh_org }}</td>
										<td>{{ $couriers->phone_number }}</td>
										<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">@if($couriers->courier_status != ''){{ $couriers->courier_status }} @else Pending @endif</span>	
										</td>

										<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ $couriers->courier_for }}</span>	
										</td>
										<td nowrap="">
											<a href="details-courier/{{ $couriers->courier_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
												<i class="la la-eye"></i>
											</a>
											<a href="edit-courier/{{ $couriers->courier_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
												<i class="la la-edit"></i>
											</a>
											<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete" onclick="deleteCourier({{ $couriers->courier_id }})">
												<i class="la la-trash"></i>
											</a>
										</td>
									</tr>
								@endforeach

								@foreach($registrationData as $key => $registrationDatas)
									<tr role="row" class="odd">
										<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value="" onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span></label>
										</th>
										<td>@if($registrationDatas->ysk_id != '') {{ $registrationDatas->ysk_id }} @else {{ $registrationDatas->pre_ysk_id }} @endif</td>
										<td>{{ $registrationDatas->name_as_per_yuva_sangh_org }}</td>
										<td>{{ $registrationDatas->phone_number_first }}</td>
										<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> Pending </span>	
										</td>
										<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Registration</span>	
										</td>
										<td nowrap="">
												<a href="{{ route('add-courier-for-registration-sahyognidhi',$registrationDatas->registration_id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Send Courier">
													<i class="la la-edit"></i>
												</a>
										</td>
									</tr>
								@endforeach

								@foreach($sahyognidhiData as $key => $sahyognidhiDatas)
									<tr role="row" class="odd">
										<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value="" onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span></label>
										</th>
										<td>{{ $sahyognidhiDatas->fk_ysk_id }} </td>
										<td>{{ $sahyognidhiDatas->name_as_per_yuvasangh_org }}</td>
										<td>{{ $sahyognidhiDatas->first_phone_number }}</td>
										<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> Pending</span>	
										</td>
										<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Sahyognidhi Request</span>	
										</td>
										<td nowrap="">
												<a href="{{ route('add-courier-for-registration-sahyognidhi',$sahyognidhiDatas->sahyognidhi_id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Send Courier">
													<i class="la la-edit"></i>
												</a>
										</td>
									</tr>
								@endforeach

								@foreach($getFiftyFiveYearsData as $key => $value)
									<tr role="row" class="odd">
										<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value="" onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span></label>
										</th>
										<td> @if($value[0]['pre_ysk_id'] != '')  {{ $value[0]['pre_ysk_id']  }} @else {{ $value[0]['ysk_id']  }} @endif</td>
										<td>{{ $value[0]['name_as_per_yuva_sangh_org'] }}</td>
										<td>{{ $value[0]['phone_number_first'] }}</td>
										<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> Pending</span>	
										</td>
										<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">55 Years</span>	
										</td>
										<td nowrap="">
												<a href="{{ route('add-courier-for-registration-sahyognidhi',$value[0]['registration_id']) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Send Courier">
													<i class="la la-edit"></i>
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
	{{-- </div> --}}
</div>
<!-- content end -->
<!--begin::Modal-->
<!--end::Modal-->       
@endsection
@section('content_js')
<script>
	setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);
</script>
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

	function deleteCourier(id) {
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: ["Cancel", "Do it!"],
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {

					location.href = 'delete-courier/'+id;

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
							url: "{{ route('multiple-delete-courier') }}",
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