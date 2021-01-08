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
						Employee Salary                       
					</h3>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper"></div>
				</div>
				<div class="kt-subheader__main">
					<a href="{{ route('employee-salary') }}">
						<i class="la la-long-arrow-left"></i>
						Back
					</a>
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

								{{-- <a href="#" id="delete_all" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
									<i class="la la-trash"></i>
									Delete All
								</a> --}}
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
									{{-- <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
										<input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
									</th> --}}
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">Date</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">Employee Name</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Intime</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">Outtime</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Total Time</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Over Time</th>
									<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Total Working Hours</th>
												
								</tr>
							</thead>
							<tbody>
								 @foreach($getDataOfEmployee as $getDataOfEmployees) 
									<tr role="row" class="odd">
										{{-- <th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value=" {{ $minorAccountDatas->registration_id }} " onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span></label>
										</th> --}}
										<td>@if($getDataOfEmployees['today_date'] != "0000-00-00" && $getDataOfEmployees['today_date'] != NULL){{ date("d-m-Y",strtotime($getDataOfEmployees['today_date'])) }} @else -- @endif</td>
										<td>{{ $getDataOfEmployees['employee_name'] }}</td>
										<td>{{ date("g:i", strtotime($getDataOfEmployees['intime'])) }}</td>
										<td>{{ date("g:i", strtotime($getDataOfEmployees['outtime'])) }}</td>
										<td>{{ date("g:i", strtotime($getDataOfEmployees['total_time'])) }}</td>
										<td>{{ date("g:i", strtotime($getDataOfEmployees['over_time'])) }}</td>
										<td>{{ date("g:i", strtotime($getDataOfEmployees['employee_total_hours_monthly'])) }}</td>
										
									</tr>								
								 @endforeach 
							</tbody>
							<tfoot>								
								Total Salary: {{ $currentSalary }}&nbsp;&nbsp;&nbsp;&nbsp;									
								Total Employee Working hours Monthly: {{ $totalTimeForEmployee }}									
							</tfoot>
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