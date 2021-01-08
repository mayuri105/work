@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style type="text/css" media="screen">
	input[type="file"] {
		display: block;
	}
	.imageThumb {
		max-height: 75px;
		border: 2px solid;
		padding: 1px;
		cursor: pointer;
	}
	.pip {
		display: inline-block;
		margin: 10px 10px 0 0;
	}
	.remove {
		display: block;
		background: #444;
		border: 1px solid black;
		color: white;
		text-align: center;
		cursor: pointer;
	}
	.remove:hover {
		background: white;
		color: black;
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
						Today's Calling                            
					</h3>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->        
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="margin-top: -40px;">
		<!--begin::Portlet-->
		<div class="kt-portlet">
							 <div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									{{-- <h3 class="kt-portlet__head-title">
										Adjusted Pills
									</h3> --}}
								</div>
							</div> 
							<div class="kt-portlet__body">
								<ul class="nav nav-pills nav-fill" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#kt_tabs_5_1">Courier({{$courier_count}})</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_tabs_5_2">55 / 60 Years Old({{$getFiftyFiveYearsData_count}})</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_tabs_5_3">Repayment({{$RepaymentModel_count}})</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_tabs_5_5">Sahyognidhi({{$sahyognidhiRequest_count}})</a>
									</li>
									@php($regcount = 0)
									
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_tabs_5_4"> Registration({{ $regcount }})</a>
									</li>
								</ul>                    
								<div class="tab-content">
									<div class="tab-pane active" id="kt_tabs_5_1" role="tabpanel">
										<div class="table-responsive">
											<table id="today_datatable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th style="width: 1%;" class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages" style="width: 16px;height: 16px;">&nbsp;<span></span></label></th>
														<th>YSK Id</th>
														<th>YSK Member</th>
														<th>Region</th>
														<th>City</th>
														<th>Date</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												    
												    
												@foreach($registrationData_courier as $registrationData_couriers)
													<tr>
														<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" value="" onclick="checkSubCheckbox()" class="sub_check_all" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
														<td>@if($registrationData_couriers->ysk_id != '') {{ $registrationData_couriers->ysk_id }} @else {{ $registrationData_couriers->pre_ysk_id }} @endif</td>
														<td>{{ $registrationData_couriers->name_as_per_yuva_sangh_org }}</td>
														<td>{{ $registrationData_couriers->region_name }}</td>
														<td>{{$registrationData_couriers->fk_city_id}}</td>
														<td>{{ date("d-m-Y", strtotime($registrationData_couriers->today_date)) }}</td>										<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Registration</span>	
										</td>		
														<td>
															<a href="" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
																<i class="fa fa-print" aria-hidden="true"></i>
															</a>
															<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View" onclick="openModel(this.value)">
																<i class="la la-external-link"></i>
															</a>
														</td>
													</tr>
													@endforeach
													
													
													@foreach($sahyognidhiData_courier as $sahyognidhiData_couriers)
													<tr>
														<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" value="" onclick="checkSubCheckbox()" class="sub_check_all" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
														<td>{{ $sahyognidhiData_couriers->fk_ysk_id }}</td>
														<td>{{ $sahyognidhiData_couriers->name_as_per_yuvasangh_org }}</td>
														<td>{{ $sahyognidhiData_couriers->region_name }}</td>
														<td>{{$sahyognidhiData_couriers->city_name}}</td>
														<td>{{ date("d-m-Y", strtotime($sahyognidhiData_couriers->sahyognidhi_date)) }}</td>						<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Sahyognidhi Request</span>	
										</td>						
														<td>
															<a href="" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
																<i class="fa fa-print" aria-hidden="true"></i>
															</a>
															<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View" onclick="openModel(this.value)">
																<i class="la la-external-link"></i>
															</a>
														</td>
													</tr>
													@endforeach
													
												@foreach($getFiftyFiveYearsData_courier as $key => $value)
								        @if($value[0]['courier_for'] != '55 Years')
													<tr>
														<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" value="" onclick="checkSubCheckbox()" class="sub_check_all" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
														<td>@if($value[0]['pre_ysk_id'] != '')  {{ $value[0]['pre_ysk_id']  }} @else {{ $value[0]['ysk_id']  }} @endif</td>
														<td>{{ $value[0]['name_as_per_yuva_sangh_org'] }}</td>
														<td>{{ $value[0]['region_name'] }}</td>
														<td>{{ $value[0]['fk_city_id'] }} </td>
														<td>{{ $value[0]['today_date'] }}</td>							<td>
											<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">55 Years</span>	
										</td>					
														<td>
															<a href="" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
																<i class="fa fa-print" aria-hidden="true"></i>
															</a>
															<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View" onclick="openModel(this.value)">
																<i class="la la-external-link"></i>
															</a>
														</td>
													</tr>
													@endif
													@endforeach
													
													
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="kt_tabs_5_2" role="tabpanel">
										<div class="table-responsive">
											<table id="today_datatable1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th style="width: 1%;" class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages" style="width: 16px;height: 16px;">&nbsp;<span></span></label></th>
														<th>Name</th>
														<th>Ysk Id</th>
														<th>Contact Number</th>
														
													</tr>
												</thead>
												<tbody>
													@foreach($getFiftyFiveYearsData as $key => $value)
													<tr>
														<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" value="" onclick="checkSubCheckbox()" class="sub_check_all" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
														<td>{{ $value[0]['name_as_per_yuva_sangh_org'] }}</td>
													
														<td>@if($value[0]['pre_ysk_id'] != '')  {{ $value[0]['pre_ysk_id']  }} @else {{ $value[0]['ysk_id']  }} @endif</td>
														<td>{{ $value[0]['phone_number_first'] }}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="kt_tabs_5_3" role="tabpanel">
										<div class="table-responsive">
											<table id="today_datatable2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th style="width: 1%;" class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages" style="width: 16px;height: 16px;">&nbsp;<span></span></label></th>
														<th>Ysk Id</th>
														<th>Ysk Member Name</th>
														<th>Region</th>
														<th>Phone Number</th>
														<!--<th>Status</th>-->
													</tr>
												</thead>
												<tbody>
												    @foreach($RepaymentModel as $RepaymentModels)
													<tr>
														<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" onclick="checkSubCheckbox()" value="" class="sub_check_all" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
														<td>{{$RepaymentModels->ysk_id}}</td>
														<td>{{$RepaymentModels->name}}</td>
														<td>{{$RepaymentModels->region_name}}</td>
														<td>{{$RepaymentModels->phone_number_first}}</td>
													
														<<!--td><span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> Unread</span></td>-->
													</tr>
												@endforeach	
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="kt_tabs_5_5" role="tabpanel">
										<div class="table-responsive">
											<table id="today_datatable2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th style="width: 1%;" class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages" style="width: 16px;height: 16px;">&nbsp;<span></span></label></th>
														<th>Date</th>
														<th>Ysk Id</th>
														<th>Ysk Member Name</th>
														<th>Region</th>
														<th>City</th>
														<th>Amount</th>
														<th>Sahyognidhi Request</th>
														<th>Document</th>
													</tr>
												</thead>
												<tbody>
												@foreach($sahyognidhiRequest as $sahyognidhiRequests)  
												
											@php($GetDocumentUploadSahyognidhi_medical = (new \App\Helpers\Helper)->GetDocumentUploadSahyognidhi($sahyognidhiRequests->sahyognidhi_id,1))
											
										@php($GetDocumentUploadSahyognidhi_death = (new \App\Helpers\Helper)->GetDocumentUploadSahyognidhi($sahyognidhiRequests->sahyognidhi_id,2))
												
											@if($sahyognidhiRequests->sahyognidhi_request == 'Devantage')
											
											    @if($GetDocumentUploadSahyognidhi_medical == '0' || $GetDocumentUploadSahyognidhi_death == '0')
											
											    <tr>
														<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" onclick="checkSubCheckbox()" value="" class="sub_check_all" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
														<td>{{ date("d-m-Y", strtotime($sahyognidhiRequests->inform_date)) }}</td>
														<td>{{ $sahyognidhiRequests->fk_ysk_id }}</td>
														<td>{{ $sahyognidhiRequests->name_as_per_yuvasangh_org }}</td>
														<td>{{ strtoupper($sahyognidhiRequests->region_name) }}</td>
														<td>{{$sahyognidhiRequests->city_name}}</td>
														<td><i class="la la-inr"></i>{{ $sahyognidhiRequests->sahyognidhi_amount }}</td>
														<td>{{ $sahyognidhiRequests->sahyognidhi_request }}</td>
													
														<td><span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> Pending</span></td>
														
											
													</tr>
													
											    @endif
											@else
											
											    @if            ($GetDocumentUploadSahyognidhi_medical == '0')
											    
											    <tr>
														<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" onclick="checkSubCheckbox()" value="" class="sub_check_all" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
														<td>{{ date("d-m-Y", strtotime($sahyognidhiRequests->inform_date)) }}</td>
														<td>{{ $sahyognidhiRequests->fk_ysk_id }}</td>
														<td>{{ $sahyognidhiRequests->name_as_per_yuvasangh_org }}</td>
														<td>{{ strtoupper($sahyognidhiRequests->region_name) }}</td>
														<td>{{$sahyognidhiRequests->city_name}}</td>
														<td><i class="la la-inr"></i>{{ $sahyognidhiRequests->sahyognidhi_amount }}</td>
														<td>{{ $sahyognidhiRequests->sahyognidhi_request }}</td>
													
														<td><span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> Pending</span></td>
														
											
													</tr>
													
											    
											    @endif
											@endif
												
													
												@endforeach	
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="kt_tabs_5_4" role="tabpanel">
										<div class="table-responsive">
											<table id="today_datatable2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th style="width: 1%;" class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages" style="width: 16px;height: 16px;">&nbsp;<span></span></label></th>
														<th>Ysk Id / Processing Id</th>
														<th>Ysk Name</th>
														<th>Region</th>
														<th>City</th>
														<th>Mobile Number</th>
														<th>Document</th>
														<th>Payment</th>
													</tr>
												</thead>
												<tbody>
													@foreach($getRegistrationData as $getRegistrationDatas)
													
										@php($GetDocumentUpload = (new \App\Helpers\Helper)->GetDocumentUpload($getRegistrationDatas->registration_id))
										
										@php($GetAllBankEntry = (new \App\Helpers\Helper)->GetAllBankEntry($getRegistrationDatas->registration_id))
										
										@php($GetNomineeDetail = (new \App\Helpers\Helper)->GetNomineeDetail($getRegistrationDatas->registration_id))
										

									    @if($GetDocumentUpload == '1' || $GetDocumentUpload == '3' || $GetAllBankEntry == '' || $GetNomineeDetail == '1')
                                      
                                            @php($html  = "1")
                                        @else
                                       
                                            @php($html  = "0")
                                        @endif
                                        
                                        @if($html == '1' || $GetAllBankEntry == '0')
													
													<tr>
														<td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" value="{{-- {{ $getRegistrationDatas->registration_id }} --}}" onclick="checkSubCheckbox()" class="sub_check_all" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
														<td>{{$GetDocumentUpload}} - {{$GetAllBankEntry}} --  {{$GetNomineeDetail}}     @if($getRegistrationDatas->processing_id != '') {{ $getRegistrationDatas->processing_id }} @else {{ $getRegistrationDatas->pre_ysk_id }} @endif </td>
														<td>{{$getRegistrationDatas->name_as_per_yuva_sangh_org}}</td>
														<td>{{$getRegistrationDatas->region_name}}</td>
														<td>{{$getRegistrationDatas->fk_city_id}}</td>
														<td>{{$getRegistrationDatas->phone_number_first}}</td>
														<td>
														  @if($GetDocumentUpload != '1' || $GetDocumentUpload != '3')
														    <span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> Pending</span>
														 @endif
														</td>
														<td>
														@if($GetAllBankEntry != '')
														    <span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill"> Pending</span>
														 @endif
														 </td>
													</tr>
													@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>      
							</div>

							


						</div>
						<!--end::Portlet-->
					</div>
				</div>
				<!-- content end --> 
				<div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content" style="width: 150%;">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Courier</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								</button>
							</div>
							<div class="modal-body">
								<form method="GET" action="">
									<input type="hidden" name="_token" value="{{csrf_token()}}">

									<div class="registration-list-modal">

											<div class="form-group">
												<div class="kt-radio-inline">
													<div class="row">
														<div class="col-sm-2 col-md-2">	
															{{-- <label class="kt-radio">
																<input type="radio" name="courier_status"  value="Send"> Send
																<span class="tablinks"></span> --}}
															</label>
														</div>
														<div class="col-sm-2 col-md-2" style="margin-left: 25px;">	
															<label class="kt-radio">
																<input type="radio" name="courier_status"  value="Send"> Send
																<span class="tablinks"></span>
															</label>
														</div>
														<div class="col-sm-2 col-md-2">
															<label class="kt-radio">
																<input type="radio" name="courier_status" value="Recieved"> Recieved
																<span class="tablinks"></span>
															</label>
														</div>
													</div>
													@if ($errors->has('courier_status'))
													<span style="color: red;">
														{{ $errors->first('courier_status') }}
													</span>
													@endif
												</div>
											</div>


											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Date
													<span class="text-danger">*</span></label>	
													<div class="col-lg-9">
														<input type="text" class="form-control courier_date" placeholder="Enter Date" name="courier_date">
														@if ($errors->has('courier_date'))
														<span style="color: red;">
															{{ $errors->first('courier_date') }}
														</span>
														@endif
													</div>
												</div>

												<div class="form-group1 m-form__group1 row">	
													<label class="col-lg-2 col-form-label">Courier Company
														<span class="text-danger">*</span></label>	
														<div class="col-lg-9">
															<input type="text" class="form-control" aria-describedby="emailHelp" name="company_name" placeholder="Enter Courier name"> 
															@if ($errors->has('company_name'))
															<span style="color: red;">
																{{ $errors->first('company_name') }}
															</span>
															@endif
														</div>
													</div>

													<div class="form-group1 m-form__group1 row">	
														<label class="col-lg-2 col-form-label">Courier Id
															<span class="text-danger">*</span>
														</label>	
														<div class="col-lg-9">
															<input type="text" class="form-control" placeholder="Enter Courier Id" aria-describedby="emailHelp" name="courier_static_id">
															@if ($errors->has('courier_static_id'))
															<span style="color: red;">
																{{ $errors->first('courier_static_id') }}
															</span>
															@endif
														</div>
													</div>  

													<div class="form-group1 m-form__group1 row">	
														<label class="col-lg-2 col-form-label">YSK Id / Processing Id
															<span class="text-danger">*</span>
														</label>	
														<div class="col-lg-9">
															<select class="form-control kt-select2" id="fk_registration_id" name="fk_registration_id" onchange="getDataByYskId(this.value)" style="width: 100%;">
																<option value="" selected>Select a YSK</option>
													   @foreach($yskMember as $yskMembers)
														@if($yskMembers->pre_ysk_id == '' && $yskMembers->ysk_id == '')
															<option value="{{ $yskMembers->registration_id }}">{{ $yskMembers->name_as_per_yuva_sangh_org }}(Processing Id-{{ $yskMembers->processing_id }})</option>
														@elseif($yskMembers->ysk_id != '')
															<option value="{{ $yskMembers->registration_id }}">{{ $yskMembers->name_as_per_yuva_sangh_org }}({{ $yskMembers->ysk_id }})</option>
														@elseif($yskMembers->ysk_id == '')
															<option value="{{ $yskMembers->registration_id }}">{{ $yskMembers->name_as_per_yuva_sangh_org }}({{ $yskMembers->pre_ysk_id }})</option>								
														@endif
														@endforeach 
													</select>
													@if ($errors->has('fk_registration_id'))
													<span style="color: red;">
														{{ $errors->first('fk_registration_id') }}
													</span>
													@endif
												</div>
											</div>

											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Name
													<span class="text-danger">*</span>
												</label>	
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Enter Name" aria-describedby="emailHelp" name="name_as_per_yuva_sangh_org">
													@if ($errors->has('name_as_per_yuva_sangh_org'))
													<span style="color: red;">
														{{ $errors->first('name_as_per_yuva_sangh_org') }}
													</span>
													@endif
												</div>
											</div>

											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Mobile Number
													<span class="text-danger">*</span>
												</label>	
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Enter Contact Number" aria-describedby="emailHelp" name="phone_number">
													@if ($errors->has('phone_number'))
													<span style="color: red;">
														{{ $errors->first('phone_number') }}
													</span>
													@endif
												</div>
											</div>

											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Narration
													<span class="text-danger">*</span>
												</label>	
												<div class="col-lg-9">
													<textarea class="form-control" placeholder="Enter Details" aria-describedby="emailHelp" name="courier_narration"></textarea>
													@if ($errors->has('courier_narration'))
													<span style="color: red;">
														{{ $errors->first('courier_narration') }}
													</span>
													@endif
												</div>
											</div>

											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Courier Slip<span class="text-danger">*</span>	
												</label>	
												<div class="col-lg-9 imageBox">
													<input type="file" class="form-control profile-height" id="courier_slip" onchange="courierSlip()" aria-describedby="emailHelp" name="courier_slip[]" multiple>
													<br>
													<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
													be no cropping and filtering facility available.</small>
													<br>
													<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError"> </span>
													<div class="gallery"></div>
												</div>
											</div>

									</div>
									<input type="hidden" name="registration_id" id="registration_id" value="">
									<div class="modal-footer">
										<input type="submit" class="btn btn-primary" name="submit" value="Submit">
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>          
				@endsection
				@section('content_js')
				<script>
					$(document).ready(function() {
						$('#today_datatable,#today_datatable1,#today_datatable2').DataTable({
							stateSave: true,
							"bDestroy": true,
							"ordering": false
						});
					} );

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
</script>
<script>
	function openModel(id) {
		$('#kt_modal_1').modal();
		$('#registration_id').val(id);
	}
</script>
<script>
	$('#fk_registration_id').select2();
	function courierSlip(argument) {
		var formData = new FormData();
		var file = document.getElementById('courier_slip').files[0];
		formData.append("Filedata", file);
		var t = file.type.split('/').pop().toLowerCase();
		if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {
			$("#imgError").html("Extension File is Not Valid");
			$("#imgError").css("display", "block");
			document.getElementById("courier_slip").value = '';
			return false;
		}
		if (t == "jpeg" && t == "jpg" && t == "png" && t == "bmp" && t == "gif" && t == "pdf") {
			$("#imgError").hide();
		}
		if (Math.round(file.size/1024) > 500) {
			$("#imgError").html("Max Upload size is 500kb only");
			$("#imgError").css("display", "block");
			document.getElementById("courier_slip").value = '';
			return false;
		}
		else{
			$("#imgError").hide();
		}

		return true;
	}


	$(document).ready(function() {
		if (window.File && window.FileList && window.FileReader) {
			$("#courier_slip").on("change", function(e) {
				var fp = $("#courier_slip");
				var items = fp[0].files;
				var files = e.target.files,
				filesLength = files.length;
				for (var i = 0; i < filesLength; i++) {
					var t = items[i].type.split('/').pop().toLowerCase();
					var f = files[i]
					var name = "http://eysk.org/assets/img/pdf.png";
					var fileReader = new FileReader();
					if (t != 'pdf'){
						fileReader.onload = (function(e) {
							var file = e.target;		          	
							$("<span class=\"pip\">" +
								"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
								"<br/><span class=\"remove\">Remove image</span>" +
								"</span>").insertAfter("#courier_slip");
							$(".remove").click(function(){
								$(this).parent(".pip").remove();
							});

						});
					}
					else{
						fileReader.onload = (function(e) {
							var file = e.target;		          	
							$("<span class=\"pip\">" +
								"<img class=\"imageThumb\" src=\"" + name + "\" title=\"" + file.name + "\"/>" +
								"<br/><span class=\"remove\">Remove image</span>" +
								"</span>").insertAfter("#courier_slip");
							$(".remove").click(function(){
								$(this).parent(".pip").remove();
							});

						});
					}
					fileReader.readAsDataURL(f);
				}
			});
		} else {
			alert("Your browser doesn't support to File API")
		}
	});
</script>
@endsection