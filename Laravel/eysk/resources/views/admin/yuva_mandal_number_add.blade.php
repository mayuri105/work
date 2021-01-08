@extends('elements.admin_master')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Yuva Mandal                       
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
							<h3 class="kt-portlet__head-title">
								Add
							</h3>
						</div>
					<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<a href="{{ route('yuva-mandal-number') }}" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										Back
									</a>
								</div>	
							</div>		
						</div>
					</div>
					<!--begin::Form-->
					<form class="kt-form" action="{{ route('save-yuva-mandal-number') }}" method="POST" style="margin-top: -5px;" onSubmit="return saveComment();">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="kt-portlet__body">
							<div class="kt-form__section kt-form__section--first">
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Region Name <span class="text-required">*</span></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<select class="form-control m-input" name="region_name" id="region_name">
											<option value="" selected="selected">SELECT REGION</option>
											@foreach($regions_data as $valueRegionsData)
											<option @if(Session::get('region_name') == $valueRegionsData->region_id) selected @endif value="{{ $valueRegionsData->region_id }}">{{ $valueRegionsData->region_name }}({{ $valueRegionsData->region_code }})</option>
											@endforeach
										</select>
										@if ($errors->has('region_name'))
										<span style="color: red;">
											{{ $errors->first('region_name') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Division Name <span class="text-required">*</span></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12" id="adddivision">
										<select class="form-control m-input" name="division_name" id="division_name">
											<option selected>SELECT DIVISION NAME</option>
										</select>
										@if ($errors->has('division_name'))
										<span style="color: red;">
											{{ $errors->first('division_name') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Samaj Zone Name <span class="text-required">*</span></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12" id="addsamajzone">
										<select class="form-control m-input" name="samaj_zone_name" id="samaj_zone_name">
											<option selected>SELECT SAMAJ ZONE</option>
										</select>
										@if ($errors->has('samaj_zone_name'))
										<span style="color: red;">
											{{ $errors->first('samaj_zone_name') }}
										</span>
										@endif
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Yuva Mandal Name <span class="text-required">*</span></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<input type="text" class="form-control" name="yuva_mandal_number" placeholder="Enter Yuva Mandal Name" value="{{ old('yuva_mandal_number') }}" id="yuva_mandal_number" style="text-transform: uppercase;">
										@if ($errors->has('yuva_mandal_number'))
										<span style="color: red;">
											{{ $errors->first('yuva_mandal_number') }}
										</span>
										@endif
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Yuva Mandal Code <span class="text-required">*</span></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<input type="text" class="form-control" name="yuva_mandal_code" placeholder="ENTER YUVA MANDAL CODE" value="{{ old('yuva_mandal_code') }}">
										@if ($errors->has('yuva_mandal_code'))
										<span style="color: red;">
											{{ $errors->first('yuva_mandal_code') }}
										</span>
										@endif
									</div>
								</div>

							</div>
						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-10">
										<input type="submit" class="btn btn-success" value="Submit">
										<a href="{{ route('yuva-mandal-number') }}" class="btn btn-secondary">Cancel</a>
									</div>
									
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('content_js')
<script src="{{ URL::asset('assets/js/dashboard.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);
	$('#region_name').on('change', function(){
        var regionID = $(this).val();
		$.ajax({
			url:"{{ route('get-region-data-by-id') }}",
			method:"POST",
			data:{region_id:regionID,_token:"{{ csrf_token() }}"},
			success: function(response){
				var obj = JSON.parse(response);
				if(obj.success == 1){
					$("#addsamajzone").html(obj.html_data);
					$("#samaj_zone_name").select2();
					$("#adddivision").html(obj.html_div_data);
					$("#division_name").select2();
				}
			}
		});
	});
</script>
<script>
	$("#region_name").select2();
	$("#samaj_zone_name").select2();
	$("#division_name").select2();
	/*window.onload = function() {
    var selItem = sessionStorage.getItem("SelItem");  
    $('#samaj_zone_name').val(selItem);
    }
    $('#samaj_zone_name').change(function() { 
        var selVal = $(this).val();
        sessionStorage.setItem("SelItem", selVal);
    });*/

   /*window.onload = function() {
    var selItem = sessionStorage.getItem("SelItem1");  
    $('#samaj_zone_name').val(selItem);
    }
    $('#samaj_zone_name').change(function() { 
        var selVal = $(this).val();
        sessionStorage.setItem("SelItem1", selVal);
    });*/
</script>

<script>
	$( document ).ready(function() {
        var regionID = $('#region_name').val();
		$.ajax({
			url:"{{ route('get-region-data-by-id') }}",
			method:"POST",
			data:{region_id:regionID,_token:"{{ csrf_token() }}"},
			success: function(response){
				var obj = JSON.parse(response);
				if(obj.success == 1){
					$("#addsamajzone").html(obj.html_data);
					$("#samaj_zone_name").select2();
					$("#adddivision").html(obj.html_div_data);
					$("#division_name").select2();
				}
			}
		});
});
</script>
@endsection