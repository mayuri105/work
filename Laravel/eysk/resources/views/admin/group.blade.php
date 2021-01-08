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
						Group                       
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
								<i class="kt-font-brand fa fa-bars"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								List
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
								    @if(in_array('add-group',$accessData))
    									<a href="{{ route('add-group') }}" class="btn btn-warning btn-elevate btn-icon-sm">
    										<i class="la la-plus"></i>
    										Add Sub Group 
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
										<th>Sub Group Name(Parent Group)</th>
										<th>Group Sheet</th>
										<th>Group Division</th>
										<th style="width: 30%;">Created Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									 @foreach($getSubGroupName as $getSubGroupNames) 
										<tr>
											<td>{{ $getSubGroupNames->group_name }}({{ $getSubGroupNames->parent_menu_title }})</td>
											<td>@if($getSubGroupNames->group_sheet == '1') Balance Sheet @elseif($getSubGroupNames->group_sheet == '2') Trial balance @elseif($getSubGroupNames->group_sheet == '3') Income and Expenditure @elseif($getSubGroupNames->group_sheet == '4') Others @endif</td>											
											<td>@if($getSubGroupNames->group_division == '1') Liabilities @elseif($getSubGroupNames->group_division == '2') Assets @elseif($getSubGroupNames->group_division == '3') Indirect Expenses @elseif($getSubGroupNames->group_division == '4') Indirect Incomes @elseif($getSubGroupNames->group_division == '5') Others @endif</td>
											<td>@if($getSubGroupNames->created_at != "0000-00-00 00:00:00" && $getSubGroupNames->created_at != NULL){{ date("d-m-Y",strtotime($getSubGroupNames->created_at)) }} @endif</td>
											<td style="width: 10%;">
											    @if(in_array('edit-group',$accessData))
												    <a href="edit-group/{{ $getSubGroupNames->group_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" style="font-size: 25px;"><i class="la la-edit" style="font-size: 20px;"></i></a>
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
@endsection