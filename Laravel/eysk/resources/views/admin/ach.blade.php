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
		        <div class="kt-portlet kt-portlet--tab">
		            <div class="kt-title__head">
		                <div class="kt-portlet__header">
		                 	<h3 class="title-ktt-view">
		                       ACH Process:	
		                   </h3>
		                </div>
		            </div>
		            
					
					<div class="main-padding ceparetar">
		           	  <div class="row"> 
		           	     <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">ACH Pending</span>
		                    	<span class="view-value-text">{{$totalPendingAch}}</span>
		           	        </div>
		             	</div>
		             	  <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">ACH Done</span>
		                    	<span class="view-value-text">{{$totalAchDone}}</span>
		           	        </div>
		             	</div>
		             	  <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">YSK member to YSK Office</span>
		                    	<span class="view-value-text">{{$totalUserToYSKOffice}}</span>
		           	        </div>
		             	</div>
		             	  <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">Office To Bank</span>
		                    	<span class="view-value-text">{{$totalSentToBank}}</span>
		           	        </div>
		             	</div>
		             	 <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">UMRN Received</span>
		                    	<span class="view-value-text">{{$totalAchDone}}</span>
		           	        </div>
		             	</div>
		             	 <!--<div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">ACH Rejected But Not reapply </span>
		                    	<span class="view-value-text">8</span>
		           	        </div>
		             	</div>
		             	 <div class="col-sm-3 col-md-3 view-group">
		           	         <div class="view-details-mtt">
		                    	<span class="view-title-kt">ACH Reprocess</span>
		                    	<span class="view-value-text">80</span>
		           	        </div>
		             	</div>-->
		              </div>
		            </div>
		        </div>
          </div>
       <!-- my section new add end-->   

    <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="margin-top: -10px;">
		<div class="filter-section-bg">
			<form>
				<div class="row">
					<div class="col-lg-2">
						{!! Form::text('start_date_xml',$startDate,['id'=>'start_date_xml','class'=>'form-control m-input','placeholder'=>'Start Date','required']) !!}
								
						<div id="name_error" class="text-danger" id="start_date_xml_error" style="display: none"></div>
					</div>
					<div class="col-lg-2">
						{!! Form::text('end_date_xml',$endDate,['id'=>'end_date_xml','class'=>'form-control m-input','placeholder'=>'End Date','required']) !!}
						
						<div id="name_error" class="text-danger" id="end_date_xml_error"  style="display: none"></div>
					</div>	

					<div class="col-sm-2 col-md-2">	

						<select class="form-control kt-select2" id="council_name" name="council_name" >
							<option value="0">Select a Council</option>
							@foreach($councilData as $councilData1)
							<option @if($councilData1['council_id']== $council) selected="selected" @endif value="{{ $councilData1['council_id'] }}">{{ 
							$councilData1['name'] }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-2 col-md-2">	

						<select class="form-control kt-select2" id="region_name" name="region_name">
							<option value="0">Select a Region</option>
							@foreach($regionData as $regionDataval)
							<option @if($regionDataval['region_id'] == $region) selected="selected" @endif value="{{ $regionDataval['region_id'] }}">{{ 
							$regionDataval['region_name'] }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-2 col-md-2">	

						<select class="form-control kt-select2" id="division_name" name="division_name">
							<option value="0">Select a Division</option>
							@foreach($divisionData as $divisionData1)
							<option @if($divisionData1['division_id'] == $division) selected="selected" @endif value="{{ $divisionData1['division_id'] }}">{{ 
							$divisionData1['division_name'] }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-2 col-md-2">	

						<select class="form-control kt-select2" id="samajzone_name" name="samajzone_name">
							<option value="0">Select a SamajZone</option>
							@foreach($samajZone as $samajZone1)
							<option @if($samajZone1['samaj_zone_id'] == $samajzone) selected="selected" @endif value="{{ $samajZone1['samaj_zone_id'] }}">{{ 
							$samajZone1['samaj_zone_name'] }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-2 col-md-2">	

						<select class="form-control kt-select2" id="yuvamandal_name" name="yuvamandal_name">
							<option value="0">Select a YuvaMandal</option>
							@foreach($yuvaMandal as $yuvaMandal1)
							<option @if($yuvaMandal1['yuva_mandal_number_id'] == $yuvamandal) selected="selected" @endif value="{{ $yuvaMandal1['yuva_mandal_number_id'] }}">{{ 
							$yuvaMandal1['yuva_mandal_number'] }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-2 col-md-2">	

						<select class="form-control kt-select2" id="agegroup_name" name="agegroup_name">
							<option value="0">Age Group</option>
							{{-- @foreach($RegistrationFee as $RegistrationFee1) --}}
							<option @if($RegistrationFee[0]['start_age1'].'-'. $RegistrationFee[0]['end_age1'] == $agegroup) selected="selected" @endif value="{{
								$RegistrationFee[0]['start_age1']}}-{{ $RegistrationFee[0]['end_age1']}}">{{ 
							$RegistrationFee[0]['start_age1']}} - {{ 
							$RegistrationFee[0]['end_age1']}}</option>

							<option @if($RegistrationFee[0]['start_age2'].'-'. $RegistrationFee[0]['end_age2'] == $agegroup) selected="selected" @endif value="{{ 
							$RegistrationFee[0]['start_age2']}}-{{$RegistrationFee[0]['end_age2'] }}">{{ 
							$RegistrationFee[0]['start_age2']}} - {{$RegistrationFee[0]['end_age2'] }}</option>

							<option @if($RegistrationFee[0]['start_age3'].'-'. $RegistrationFee[0]['end_age3'] == $agegroup) selected="selected" @endif value="{{ 
							$RegistrationFee[0]['start_age3']}}-{{$RegistrationFee[0]['end_age3'] }}">{{ 
							$RegistrationFee[0]['start_age3']}} - {{$RegistrationFee[0]['end_age3'] }}</option>

							<option @if($RegistrationFee[0]['start_ag4'] .'-'. $RegistrationFee[0]['end_age4'] == $agegroup) selected="selected" @endif value="{{ 
							$RegistrationFee[0]['start_age4']}}-{{$RegistrationFee[0]['end_age4'] }}">{{ 
							$RegistrationFee[0]['start_age4']}} - {{$RegistrationFee[0]['end_age4'] }}</option> 
							{{-- @endforeach --}}
						</select>
					</div>
					<div class="col-sm-2 col-md-2">	

						<select class="form-control kt-select2" id="gender_name" name="gender_name">
							<option value="0">Gender</option>
							{{-- @foreach($RegistrationFee as $RegistrationFee1) --}}
							<option  @if($gender == 1) selected="selected" @endif value="1">Male</option>

							<option @if($gender == 2) selected="selected" @endif value="2">Female</option>
							{{-- @endforeach --}}
						</select>
					</div>

					<div class="col-sm-2 col-md-2">	

						<select class="form-control kt-select2" id="status_name" name="status_name">
							
							<option value="0" >Select Status</option>
    									<option @if($status1 == 1) selected="selected" @endif value="1">User To YSK Office</option>
    									<option   @if($status1 == 2) selected="selected" @endif value="2">ACH Form Received</option>
    									<option  @if($status1 == 3) selected="selected" @endif value="3">Sent To Bank/Mail</option>
    									<option  @if($status1 == 4) selected="selected" @endif value="4">Confirm UMRN</option>
    									<option  @if($status1 == 5) selected="selected" @endif value="5">Reject UMRN</option>
							
						</select>
					</div>
					<div class="col-sm-2 col-md-2">
							<button class="btn btn-info" type = "button" name="search"  onclick="SearchData();" id = "search">Search</button>
					</div>
				</div>
			</form>
		</div>	
	</div>



	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" >
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
						<div class="dropdown-section" >
							<div class="btn-group">
							    @if(in_array('status-ach',$accessData))
    								<select class="btn btn-secondary" name="same_status" id="status" onchange="getAllSameStatus(this.value)">
    									<option selected>Select Status</option>
    									<option value="User To YSK Office">User To YSK Office</option>
    									<option value="ACH Form Received">ACH Form Received</option>
    									<option value="Sent To Bank/Mail">Sent To Bank/Mail</option>
    									<option value="Confirm UMRN">Confirm UMRN</option>
    									<option value="Reject UMRN">Reject UMRN</option>
    								</select>
    							@endif
							</div>
						</div>

						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">
							    @if(in_array('add-ach',$accessData))
    								<a href="{{ route('add-ach') }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
    									<i class="la la-plus"></i>
    									Add ACH
    								</a>
                                @endif

								@if(in_array('delete-all-ach',$accessData))
    								<a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="delete_all">
    									<i class="la la-trash"></i>
    									Delete All
    								</a>
    							@endif
    							<a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="export_all" >Export Data</a>
							</div>
						</div>
					</div>


				</div>
				<div class="kt-portlet__body">
					<div class="table-responsive">
						<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline view_table" id="today_datatable">
							<thead>
								<tr>
									<th>
										<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span>
										</label>
									</th>
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
								@foreach($ach as $achs)
								<tr>
									<td>
										<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="sub_check_all[]" value="{{ $achs->ach_id }}" onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span>
										</label>
									</td>
									<td>{{ $achs->name_as_per_yuva_sangh_org }}</td>
									<td>{{ $achs->fk_ysk_id }}</td>
									<td>{{ $achs->region_name }}</td>
									<td>{{ $achs->yuva_mandal_number }}</td>
									<td>{{ $achs->phone_number }}</td>
									<td style="width: 120px;">

										 <span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ $achs->ach_status }}</span> 
										{{-- <div class="btn-group">											
											<select class="btn btn-secondary" name="ach_status" onchange="changeStatus({{ $achs->ach_id }},this.value)">
												@if($achs->ach_status != '')
													<option  selected="{{ $achs->ach_status }}">{{ $achs->ach_status }}</option>
													<option  disabled>Select Status</option>
													<option value="User To YSK Office">User To YSK Office</option>
													<option value="ACH Form Received">ACH Form Received</option>
													<option value="Sent To Bank">Sent To Bank</option>
													<option value="Ready For UMRN">Ready For UMRN</option>
												@else
													<option selected disabled>Select Status</option>
													<option value="User To YSK Office">User To YSK Office</option>
													<option value="ACH Form Received">ACH Form Received</option>
													<option value="Sent To Bank">Sent To Bank</option>
													<option value="Ready For UMRN">Ready For UMRN</option>
												@endif												
											</select>												
										</div> --}}
									</td>
									<td>
										{{-- <a href="view-ach/{{ $achs->ach_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
											<i class="la la-eye"></i>
										</a> --}}
										
										@if($achs->created_by_user != '')
											<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Created by user">
												<i class="fa fa-user"></i>
											</a>
										@endif
										
										@if(in_array('edit-ach',$accessData))
    										<a href="edit-ach/{{ $achs->ach_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
    											<i class="la la-edit"></i>
    										</a>
    									@endif
										@if(in_array('delete-ach',$accessData))
    										<a href="#" onclick="deleteAch({{ $achs->ach_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
    											<i class="la la-trash"></i>
    										</a>
    									@endif
										@if(in_array('pop-up-ach',$accessData))
										@if($achs->umrn_number == '')
    										<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon"  onclick="openModel({{ $achs->ach_id }})" title="UMRN Number">
    											<i class="la la-external-link"></i>
    										</a>
										@endif
										@endif
										@if(in_array('print-ach',$accessData))
    										<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Print">
    											<i class="la la-print"></i>
    										</a>
    									@endif
									</td>
								</tr>
								@endforeach
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
	<div class="modal fade" id="kt_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Enter UMRN</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('generate-urmn-number') }}" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="registration-list-modal">
							<div class="row">	

								<div class="col-sm-12 col-md-12">
									<label>UMRN Number</label>
									<input type="text" name="umrn_number" placeholder="Enter UMRN Number" class="form-control" aria-describedby="emailHelp">
								</div>
								
								<div class="col-sm-12 col-md-12">
									<label>Umrn Reject</label>
									<textarea name="umrn_number_reject" placeholder="Enter UMRN Number Reject Reason" class="form-control">{{ old('umrn_number_reject') }}</textarea>
								</div>

							</div>
						</div>
						<input type="hidden" name="ach_id" id="ach_id" value="">
						<div class="modal-footer">
							<input type="submit" name="submit" class="btn btn-primary" value="Save">
						</div>
				  	</form>
				</div>
			</div>
		</div>
	</div>
	<!--end::Modal-->           
</div>
<!--ENd:: Chat-->
@endsection
@section('content_js')
	<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	<script>
	$('#region_name').select2();
	$('#council_name').select2();
	$('#division_name').select2();
	$('#samajzone_name').select2();
	$('#yuvamandal_name').select2();
	$('#gender_name').select2();
	$('#status_name').select2();
	$('#agegroup_name').select2();
	
	$('#start_date_xml').mask('00-00-0000');
	$('#end_date_xml').mask('00-00-0000');
	function SearchData(){
		//var table = $('#guest-table').DataTable();
		//	table.ajax.reload();
		var region 		= $('#region_name').val();
				var council 	= $('#council_name').val();
				var division 	= $('#division_name').val();
				var samajzone 	= $('#samajzone_name').val();
				var yuvamandal 	= $('#yuvamandal_name').val();
				var gender 		= $('#gender_name').val();
				var status1 	= $('#status_name').val();
				var agegroup 	= $('#agegroup_name').val();
				var startDate 	= $('#start_date_xml').val();
				var endDate 	= $('#end_date_xml').val();
				var processinid 	= $('#processing_id').val();
				if(startDate==''){
					startDate =0;
				}if(endDate==''){
					endDate =0;
				}
				
			    var urldonut = "{{ route('ach',[":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1"]) }}";
			    	
					urldonut2 = urldonut.replace(':region', region);
					urldonutbar = urldonut2.replace(':council',council);
					urldonutstackbar = urldonutbar.replace(':startDate',startDate);
					urldonutstackbar1 = urldonutstackbar.replace(':endDate',endDate);
					urldonutstackbar2 = urldonutstackbar1.replace(':division',division);
					urldonutstackbar3 = urldonutstackbar2.replace(':samajzone',samajzone);
					urldonutstackbar4 = urldonutstackbar3.replace(':yuvamandal',yuvamandal);
					urldonutstackbar5 = urldonutstackbar4.replace(':agegroup',agegroup);
					urldonutstackbar6 = urldonutstackbar5.replace(':gender',gender);
					urldonutbarpie = urldonutstackbar6.replace(':status1',status1);
					//urldonutbarpie = urldonutstackbar7.replace(':processinid',processinid);
					window.location = urldonutbarpie;

	}
	$('#export_all').on('click', function(e) {
			var idsArr = [];
			$(".sub_check_all:checked").each(function() {  
				idsArr.push($(this).attr('value'));
			});
			if(idsArr.length <=0)  
			{  
				var baseUrl 	= 'exceltest-all';
				var region 		= $('#region_name').val();
				var council 	= $('#council_name').val();
				var division 	= $('#division_name').val();
				var samajzone 	= $('#samajzone_name').val();
				var yuvamandal 	= $('#yuvamandal_name').val();
				var gender 		= $('#gender_name').val();
				var status1 	= $('#status_name').val();
				var agegroup 	= $('#agegroup_name').val();
				var startDate 	= $('#start_date_xml').val();
				var endDate 	= $('#end_date_xml').val();
				var processinid 	= $('#processing_id').val();
				if(startDate==''){
					startDate =0;
				}if(endDate==''){
					endDate =0;
				}
				/*$url = baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender+'/'+ status1 ;
				 document.location.href=url;*/

				/* url(baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender+'/'+ status1 ).load();
				 document.location.href=url;*/
				 var urldonut = "{{ route('ach-excel-id-all',[":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1"]) }}";
					urldonut = urldonut.replace(':region', region);
					urldonutbar = urldonut.replace(':council',council);
					urldonutstackbar = urldonutbar.replace(':startDate',startDate);
					urldonutstackbar1 = urldonutstackbar.replace(':endDate',endDate);
					urldonutstackbar2 = urldonutstackbar1.replace(':division',division);
					urldonutstackbar3 = urldonutstackbar2.replace(':samajzone',samajzone);
					urldonutstackbar4 = urldonutstackbar3.replace(':yuvamandal',yuvamandal);
					urldonutstackbar5 = urldonutstackbar4.replace(':agegroup',agegroup);
					urldonutstackbar6 = urldonutstackbar5.replace(':gender',gender);
					urldonutbarpie = urldonutstackbar6.replace(':status1',status1);
					//urldonutbarpie = urldonutstackbar7.replace(':processinid',processinid);
					window.location = urldonutbarpie;
				   
			}else 
			{  //var baseUrl 	= 'exceltest-all';
				var region 		= $('#region_name').val();
				var council 	= $('#council_name').val();
				var division 	= $('#division_name').val();
				var samajzone 	= $('#samajzone_name').val();
				var yuvamandal 	= $('#yuvamandal_name').val();
				var gender 		= $('#gender_name').val();
				var status1 	= $('#status_name').val();
				var agegroup 	= $('#agegroup_name').val();
				var startDate 	= $('#start_date_xml').val();
				var endDate 	= $('#end_date_xml').val();
				var processinid 	= $('#processing_id').val();
				if(startDate==''){
					startDate =0;
				}if(endDate==''){
					endDate =0;
				}
				var strIds = idsArr.join(",");
				
			    var urldonut = "{{ route('ach-excel-id',[":strIds",":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1"]) }}";
			    	urldonut1 = urldonut.replace(':strIds', strIds);
					urldonut2 = urldonut1.replace(':region', region);
					urldonutbar = urldonut2.replace(':council',council);
					urldonutstackbar = urldonutbar.replace(':startDate',startDate);
					urldonutstackbar1 = urldonutstackbar.replace(':endDate',endDate);
					urldonutstackbar2 = urldonutstackbar1.replace(':division',division);
					urldonutstackbar3 = urldonutstackbar2.replace(':samajzone',samajzone);
					urldonutstackbar4 = urldonutstackbar3.replace(':yuvamandal',yuvamandal);
					urldonutstackbar5 = urldonutstackbar4.replace(':agegroup',agegroup);
					urldonutstackbar6 = urldonutstackbar5.replace(':gender',gender);
					urldonutbarpie = urldonutstackbar6.replace(':status1',status1);
					//urldonutbarpie = urldonutstackbar7.replace(':processinid',processinid);
					window.location = urldonutbarpie;

					
			}
		}
	);
	function openModel($id) {
			$('#kt_modal_2').modal();
			$('#ach_id').val($id);
		}

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

	function deleteAch(id) {
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this data!",
				icon: "warning",
				buttons: ["Cancel", "Do it!"],
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {

					location.href = 'delete-ach/'+id;

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
							url: "{{ route('multiple-delete-ach') }}",
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
	$("#status").select2();
	$("#status1").select2();


	function changeStatus(id,value) {
		swal({
			title: "Are you sure?",
			text: "You want to change the status!",
			icon: "warning",
			buttons: ["Cancel", "Do it!"],
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				$.ajax({
					url:"{{ route('change-ach-status') }}",
					method:"POST",
					data:{ach_id:id,ach_status:value,_token:"{{ csrf_token() }}"},
					success: function(response){
						location.reload();
					}
				});


			} else {
				swal({
					buttons: false, // There won't be any confirm button
					text:"Your data is safe!"
				});
			}
		});
	}

function getAllSameStatus(value) {
		var idsArr = [];
		$(".sub_check_all:checked").each(function() {  
			idsArr.push($(this).attr('value'));
		});
		if(idsArr.length <=0)  
		{  
			swal({
			buttons: false, // There won't be any confirm button
			text:"Please select atleast one record to change status."}); 
		}else {  
			swal({
				title: "Are you sure?",
				text: "You want to change the status!",
				icon: "warning",
				buttons: ["Cancel", "Do it!"],
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {

					var strIds = idsArr.join(","); 
						//alert(strIds);
						$.ajax({
							url: "{{ route('change-multiple-ach-status') }}",
							type: 'POST',
							data: {ids: strIds,same_status: value,_token:"{{ csrf_token() }}"},
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
							//text:"Your data is safe!"
						}); 
					}
					location.reload();
				});			
		}
	};

</script>
@endsection