@extends('elements.user_admin')
@section('content')
<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						ACH                      
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





	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="margin-top: -10px;">
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
						<div class="dropdown-section">
							<div class="btn-group">
							</div>
						</div>

						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">
								@if($userAch['name_as_per_yuva_sangh_org'] == '')
									<a href="{{ route('user-add-ach',$id) }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
										<i class="la la-plus"></i>
										Apply ACH
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
									<th>Name As Per Yuva Sangh Org</th>
									<th>YSK Number</th>
									<th>Region</th>
									<th>Yuva Mandal Name</th>
									<th>Phone Number</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@if($userAch['name_as_per_yuva_sangh_org'] != '')
									<tr>
										<td>{{ $userAch['name_as_per_yuva_sangh_org'] }}</td>
										<td>{{ $userAch['fk_ysk_id'] }}</td>
										<td>{{ $userAch['region_name'] }}</td>
										<td>{{ $userAch['yuva_mandal_number'] }}</td>
										<td>{{ $userAch['phone_number'] }}</td>
										<td style="width: 120px;">

											 <span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ $userAch['ach_status'] }}</span> 
										</td>
										<td>
												<a href="{{ route('view-user-ach',$userAch['created_by_user']) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
													<i class="la la-eye"></i>
												</a>
									
												<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
													<i class="la la-print"></i>
												</a>
										</td>
									</tr>
								@endif
								
							</tbody>
						</table>
					</div>
				</div>
			</div>	
			<!-- registration date table -->
		</div>
	</div>
	<!-- content end -->
	<!--begin::Modal-->

	<!--end::Modal-->           
</div>
<!--ENd:: Chat-->
@endsection
@section('content_js')
	<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection