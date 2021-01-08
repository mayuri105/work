@extends('elements.user_admin')
@section('content')
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Sahyognidhi Request                      
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
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<!--begin: Datatable -->
					<div class="table-responsive">
						<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="today_datatable">
							<thead>
								<tr>
									<th>
										<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span>
										</label>
									</th>
									<th>YSK ID</th>
									<th>Name</th>
									<th>Date</th>
									<th>Sahyognidhi Request</th>
									<th>Region</th>
									<th>City</th>
								</tr>
							</thead>
							<tbody>
								@foreach($sahyognidhiRequest as $key =>$sahyognidhiRequests)
								<tr>
									<td>
										<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value="{{ $sahyognidhiRequests->sahyognidhi_id }}" onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span>
										</label>
									</td>
									<td>{{ $sahyognidhiRequests->fk_ysk_id }}</td>
									<td>{{ $sahyognidhiRequests->name_as_per_yuvasangh_org }}</td>
									<td>@if($sahyognidhiRequests->sahyognidhi_request == 'Half Disability' || $sahyognidhiRequests->sahyognidhi_request == 'Full Disability')@if($sahyognidhiRequests->disability_date != '0000-00-00'){{ date("d-m-Y", strtotime($sahyognidhiRequests->disability_date)) }}  @endif @else @if($sahyognidhiRequests->death_date != '0000-00-00') {{ date("d-m-Y", strtotime($sahyognidhiRequests->death_date)) }} @endif @endif</td>
									@if($sahyognidhiRequests->sahyognidhi_request == 'Half Disability')
										<td><span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">{{ $sahyognidhiRequests->sahyognidhi_request }}</span></td>
									@elseif($sahyognidhiRequests->sahyognidhi_request == 'Full Disability')
										<td><span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ $sahyognidhiRequests->sahyognidhi_request }}</span></td>
									@elseif($sahyognidhiRequests->sahyognidhi_request == 'Devantage')
										<td><span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">{{ $sahyognidhiRequests->sahyognidhi_request }}</span></td>
									@endif
									<td>{{ strtoupper($sahyognidhiRequests->region_name) }}</td>
									<td>{{ strtoupper($sahyognidhiRequests->city_name) }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<!--end: Datatable -->
				</div>
			</div>	
			<!-- registration date table -->
		</div>
	</div>
	<!-- content end -->   
</div>
<!--ENd:: Chat-->
@endsection