@extends('elements.admin_master')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Division                       
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
									<a href="{{ route('division') }}" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										Back
									</a>
								</div>	
							</div>		
						</div>
					</div>
					<!--begin::Form-->
					<form class="kt-form" action="{{ route('save-division') }}" method="POST" style="margin-top: -5px;">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="kt-portlet__body">
							<div class="kt-form__section kt-form__section--first">

								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Region Name <span class="text-required">*</span></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<select class="form-control m-input" name="fk_region_id" id="fk_region_id">
											<option selected value="">SELECT REGION</option>
											@foreach($regionData as $regions) 
											<option value="{{ $regions->region_id }}">{{ $regions->region_name }}({{ $regions->region_code }})</option>
											@endforeach
										</select>
										@if ($errors->has('fk_region_id'))
										<span style="color: red;">
											{{ $errors->first('fk_region_id') }}
										</span>
										@endif
									</div>
								</div>

								<div class="form-group1 m-form__group1 row details">	
									<label class="col-lg-2 col-form-label" style="margin-left: -28px;">Division Name
										<span class="text-danger">*</span>
									</label>
									<div class="registration-list-modal" style="margin-left: 18px;">
										<div class="row">	
											<div class="col-lg-10">	
												<input type="text" class="form-control" name="division_name[]" placeholder="ENTER DIVISION NAME" style="text-transform: uppercase;">

												@if ($errors->has('division_name'))
												<span style="color: red;">
													{{ $errors->first('division_name') }}
												</span>
												@endif	
											</div>
											<div class="col-lg-2" style="margin-top: 8px;">
												<a href="javascript:void(0);" class="nominee-details-add add_button" title="Add field"><i class="la la-plus"></i></a>
											</div>
										</div>
										<div class="field_wrapper">

										</div>
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
										<a href="{{ route('division') }}" class="btn btn-secondary">Cancel</a>
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
<script>
$('#fk_region_id').select2();
</script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    
    var x = 2; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_button').click(function(){
    	var fieldHTML = '<div class="row field_wrapper remove_div_data_'+x+'" style="padding-left: 10px;"><div class="col-lg-10 padding-mt" style="margin-left: -10px;"><div><input type="text" class="form-control" name="division_name[]" placeholder="ENTER DIVISION NAME" style="text-transform: uppercase;"></div>@if ($errors->has('division_name'))<span style="color: red;">{{ $errors->first('division_name') }}</span>@endif</div><div class="col-lg-2" style="margin-top: 33px;margin-left:10px"><a href="javascript:void(0);" class="nominee-details-add remove_button" title="Remove field" onclick="removeButton('+x+')"><i class="la la-minus"></i></a></div></div>';
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
            //$(".select2_data_"+x).select2();
            var i;
			for (i = 1; i < x; i++) {
				$("#user_name"+i).select2();
			}
        }
    });
});
function removeButton(id){
	$('.remove_div_data_'+id).remove();
}
</script>
@endsection