@extends('elements.admin_master')
@section('content')
<!-- content -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="row" style="width: 100%;">
				<div class="col-md-10">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">
								View Employee Registration                           
							</h3>
						</div>
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper"></div>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper"></div>
						</div>
						<div class="kt-subheader__main">
							<a href="{{ route('employee-registration') }}">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->        


	<!-- begin:: Content -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height: 440px;">
		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						Employee Registration Details
					</h3>
				</div>
			</div>

			
			<div class="main-padding ceparetar">
				<div class="row"> 
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Joining Date</span>
							<span class="view-value-text">{{ date('d-m-Y',strtotime($viewEmployeeRegistrationData['joining_date'])) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Employee Number</span>
							<span class="view-value-text">{{ $viewEmployeeRegistrationData['employee_number'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Employee Name</span>
							<span class="view-value-text">{{ $viewEmployeeRegistrationData['employee_name'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Employee Email</span>
							<span class="view-value-text">{{ $viewEmployeeRegistrationData['employee_email'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Employee Password</span>
							<span class="view-value-text">{{ $viewEmployeeRegistrationData['employee_password'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Employee Contact Number</span>
							<span class="view-value-text">{{ $viewEmployeeRegistrationData['employee_first_phone_number'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Employee Contact Number</span>
							<span class="view-value-text">@if($viewEmployeeRegistrationData['employee_second_phone_number'] != ''){{ $viewEmployeeRegistrationData['employee_second_phone_number'] }} @else - @endif</span>
						</div>
					</div>


					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Address</span>
							<span class="view-value-text">{{ $viewEmployeeRegistrationData['employee_address'] }}</span>
						</div>
					</div>


					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">In Time(AM)</span>
							<span class="view-value-text">{{ date('g:i', strtotime($viewEmployeeRegistrationData['timing_am'])) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Out Time(PM)</span>
							<span class="view-value-text">{{ date('g:i', strtotime($viewEmployeeRegistrationData['timing_pm'])) }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Govt. Document</span>
							@foreach($govtDocument as $govtDocuments)
							@if($govtDocuments['upload_document_extension'] == 'pdf')
								<a href="../assets/uploads/employee_govt_image/{{ $govtDocuments['document_upload'] }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a>
							@else
								<a href="{{ URL::asset('assets/uploads/employee_govt_image/').'/'.$govtDocuments['document_upload'] }}" target="_blank"><img src="{{ URL::asset('assets/uploads/employee_govt_image/').'/'.$govtDocuments['document_upload'] }}"></a> 
									{{-- <div id="methods">
											<a href="{{ URL::asset('assets/uploads/ser_image/').'/'.$govtDocuments->document_upload }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div> --}} 
							@endif
							@endforeach
							@if($govtDocument == [])
								<img src="{{ URL::asset('assets/img/product10.jpg') }}">
								 {{-- <div id="methods">
									<a href="{{ URL::asset('assets/img/product10.jpg') }}">
										<div class="upload-img-title">
											<i class="la la-eye"></i>	
										</div>
									</a>
								</div> --}} 
							@endif
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Resume</span>
							@foreach($resumeDocument as $resumeDocuments)
							@if($resumeDocuments['upload_document_extension'] == 'pdf')
								<a href="../assets/uploads/employee_resume/{{ $resumeDocuments['document_upload'] }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a>
							@else
								<a href="{{ URL::asset('assets/uploads/employee_resume/').'/'.$resumeDocuments['document_upload'] }}" target="_blank"><img src="{{ URL::asset('assets/uploads/employee_resume/').'/'.$resumeDocuments['document_upload'] }}"></a> 
									{{-- <div id="methods">
											<a href="{{ URL::asset('assets/uploads/ser_image/').'/'.$resumeDocuments->document_upload }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div> --}} 
							@endif
							@endforeach
							@if($resumeDocument == [])
								<img src="{{ URL::asset('assets/img/product10.jpg') }}">
								 {{-- <div id="methods">
									<a href="{{ URL::asset('assets/img/product10.jpg') }}">
										<div class="upload-img-title">
											<i class="la la-eye"></i>	
										</div>
									</a>
								</div> --}} 
							@endif
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Narration</span>
							<span class="view-value-text">@if($viewEmployeeRegistrationData['employee_details'] != '') {{ $viewEmployeeRegistrationData['employee_details'] }} @else - @endif</span>
						</div>
					</div>

					{{-- <div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Salary</span>
							<span class="view-value-text"><i class="la la-inr"></i>{{ $viewEmployeeRegistrationData['salary'] }}</span>
						</div>
					</div> --}}

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Completion Date</span>
							<span class="view-value-text">@if($viewEmployeeRegistrationData['completion_date'] != '0000-00-00') {{ date('d-m-Y',strtotime($viewEmployeeRegistrationData['completion_date'])) }} @else 00-00-0000 @endif</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Completion Document</span>
							@foreach($completionDocument as $completionDocuments)
							@if($completionDocuments['upload_document_extension'] == 'pdf')
								<a href="../assets/uploads/employee_completion_document/{{ $completionDocuments['document_upload'] }}" target="_blank"><img class="imageThumb" src="{{ URL::asset('assets/img/').'/'.'pdf.png' }}" ></a> 
							@else
								<a href="{{ URL::asset('assets/uploads/employee_completion_document/').'/'.$completionDocuments['document_upload'] }}" target="_blank"><img src="{{ URL::asset('assets/uploads/employee_completion_document/').'/'.$completionDocuments['document_upload'] }}"></a> 
									{{-- <div id="methods">
											<a href="{{ URL::asset('assets/uploads/ser_image/').'/'.$completionDocuments->document_upload }}">
											<div class="upload-img-title">
												<i class="la la-eye"></i>	
											</div>
										</a>
									</div> --}} 
							@endif
							@endforeach
							@if($completionDocument == [])
								<img src="{{ URL::asset('assets/img/product10.jpg') }}">
								 {{-- <div id="methods">
									<a href="{{ URL::asset('assets/img/product10.jpg') }}">
										<div class="upload-img-title">
											<i class="la la-eye"></i>	
										</div>
									</a>
								</div> --}} 
							@endif
						</div>
					</div>
				</div>
			</div>
			<!--end::Portlet-->
		</div>
	</div>

	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height: 440px;">
		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						Employee Salary Details
					</h3>
				</div>
			</div>

			
			<div class="main-padding ceparetar">
				<table class="table table-bordered">
					<thead>
						<th>Salary</th>
						<th>Start Date</th>
						<th>End Date</th>
					</thead>
					<tbody>
						@foreach($employeeSalaryDetails as $employeeSalaryDetailss)
							<tr>
								<td>{{ $employeeSalaryDetailss['salary'] }}</td>
								<td>{{ date('d-m-Y',strtotime($employeeSalaryDetailss['start_date'])) }}</td>
								<td>{{ date('d-m-Y',strtotime($employeeSalaryDetailss['end_date'])) }}</td> 
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!--end::Portlet-->
		</div>
	</div>
</div>
<!-- content end -->   
@endsection 
