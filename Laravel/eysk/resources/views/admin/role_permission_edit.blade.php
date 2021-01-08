@extends('elements.admin_master')
@section('content')
<style type="text/css" media="screen">
	.m-demo {
		background: #f7f7fa;
		margin-bottom: 20px;
	}
	.m-demo .m-demo__preview {
		background: white;
		border: 4px solid #f7f7fa;
		padding: 30px;
	}
	.form-group .m-demo p {
		font-weight: 500;
	}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Role Permission                     
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
								Update 
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
									<a href="{{ route('list-role-permission') }}" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										Back
									</a>
								</div>	
							</div>		
						</div>
					</div>
					<!--begin::Form-->
					<form class="kt-form" action="{{ route('update-role-permission') }}" method="POST" style="margin-top: -5px;">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="kt-portlet__body">
							<div class="kt-form__section kt-form__section--first">
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Role Name: <storage class="text-danger">*</storage></label>
									<div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
										<select class="form-control" name="role_type">
											<option value="{{ $listRoleData->role_id }}">{{ $listRoleData->name }}</option>
										</select>
										@if ($errors->has('role_type'))
										<span style="color: red;">
											{{ $errors->first('role_type') }}
										</span>
										@endif
									</div>
								</div>
								<div class="form-group m-form__group row">
									<label class="col-lg-2 col-form-label">Assign Permission  <storage class="text-danger">*</storage></label>
									<div class="col-lg-10">
										
										@foreach($modulePage as $key => $valueModulePage)
										<div class="m-demo">
											<div class="m-demo__preview m-demo__preview--badge p-4">
												<p>{{ $key }}</p>
												<div class="kt-checkbox-inline">
													@foreach($valueModulePage as $key => $valueModulePageSlug)
													@php
													$checkedboxData = "";
													if(in_array($valueModulePageSlug['page_id'], $currentPageId)){
														$checkedboxData = "checked";
													}
													@endphp
													<label class="kt-checkbox m-checkbox" cheched="">
													@if($valueModulePageSlug['page_slug'] == "All")
												
														<input {{ $checkedboxData }} type="checkbox" value="{{ $valueModulePageSlug['page_id'] }}" name="page_slugs[]" onchange="checkAll({{ $valueModulePageSlug['page_id'] }})" id="pages{{ $valueModulePageSlug['page_id'] }}" class="add_class_{{ $valueModulePageSlug['page_id'] }} kt-checkbox kt-checkbox--single kt-checkbox--solid"> {{ $valueModulePageSlug['page_slug'] }}
														<span></span>												
													</label>
													@else
														<input {{ $checkedboxData }} type="checkbox" value="{{ $valueModulePageSlug['page_id'] }}" name="page_slugs[]" onchange="checkSubCheckbox({{ $valueModulePageSlug['page_id'] }},{{ $valueModulePageSlug['parent_page_id'] }})" id="pages{{ $valueModulePageSlug['page_id'] }}" class="add_class_sub_{{ $valueModulePageSlug['parent_page_id'] }} kt-checkbox kt-checkbox--single kt-checkbox--solid"> {{ $valueModulePageSlug['page_slug'] }}


														<span></span>
													</label>
													@endif
													@endforeach
												</div>
											</div>
										</div>										
										@endforeach
										@if ($errors->has('page_slugs'))
										<span style="color: red;">
											{{ $errors->first('page_slugs') }}
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
										<a href="{{ route('list-role-permission') }}" class="btn btn-secondary">Cancel</a>
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
	function checkAll(ele) {
		var ischecked= $('.add_class_'+ele).is(':checked');
		//alert(ele);
		if(ischecked == true){
			$('.add_class_sub_'+ele).prop('checked', true);
		}
		else{
			$('.add_class_sub_'+ele).prop('checked', false);
		}
	}
	function checkSubCheckbox(ele,parentPageId) {
		var ischecked = $('#pages'+ele).is(':checked');
		//alert(ele);
		if(ischecked == false){
			$('.add_class_'+parentPageId).prop('checked', false);
		}
		else{
			if($('.add_class_sub_'+parentPageId+':checked').length == $('.add_class_sub_'+parentPageId).length){
				$('.add_class_'+parentPageId).prop('checked',true);
			}
		}
	}
</script>
<script>
	$(".form-control").select2( {
		placeholder: "Select Role",
		allowClear: false
	} );
</script>
@endsection