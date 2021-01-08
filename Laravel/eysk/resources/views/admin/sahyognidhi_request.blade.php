@extends('elements.admin_master',array('accessData'=>$accessData))
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


		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						Show Entries	
					</h3>
				</div>
			</div>       			
			<div class="main-padding ceparetar">
				<div class="row"> 
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Sahyognidhi Pending Request</span>
							<span class="view-value-text">{{ $totalPendingSahyognidhiRequest }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Divangat Members</span>
							<span class="view-value-text">{{ $totalDevangatMember }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Full Disiability </span>
							<span class="view-value-text">{{ $totalFullDisiabilityMember }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Half Disiability </span>
							<span class="view-value-text">{{ $totalHalfDisiabilityMember }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Divangat Natural </span>
							<span class="view-value-text">{{ $totalDevangatNatural }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Divangat Accidentally </span>
							<span class="view-value-text"> {{ $totalDevangatAccident }} </span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Eligible(Pending Payment)</span>
							<span class="view-value-text">{{ $pendingButEligableMember }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Eligible(Paid Payment)</span>
							<span class="view-value-text">{{ $paidButEligableMember }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view" style="text-align: center;">
						Deactive	
					</h3>
				</div>
			</div>       			
			<div class="main-padding ceparetar">
				<div class="row"> 
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Locking Period</span>
							<span class="view-value-text">{{ $totalLockingPeriodMember }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Sucide</span>
							<span class="view-value-text">{{ $totalSucidePeriodMember }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Repayment Not Paid</span>
							<span class="view-value-text">{{ $repaymentNtPaidMember }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Others Reason</span>
							<span class="view-value-text">{{ $otherReasonMember }}</span>
						</div>
					</div>
				</div>
			</div>			
		</div>

	<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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

					<div class="col-sm-2 col-md-2" >	

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

							<option  @if($RegistrationFee[0]['start_age2'].'-'. $RegistrationFee[0]['end_age2'] == $agegroup) selected="selected" @endif value="{{ 
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
							<option @if($gender == 1) selected="selected" @endif value="1">Male</option>

							<option @if($gender == 2) selected="selected" @endif value="2">Female</option>
							{{-- @endforeach --}}
						</select>
					</div>
					
					<div class="col-sm-2 col-md-2">
						<select class="form-control kt-select2" id="status_name" name="status_name">
							<option value="0">Status</option>
							
							<option @if($statuslock == 1) selected="selected" @endif value="1">Locking Period</option>
							<option @if($statuslock == 2) selected="selected" @endif value="2">Sucide</option>
							<option @if($statuslock == 3) selected="selected" @endif value="3">Repayment Not Paid</option>
							<option @if($statuslock == 4) selected="selected" @endif value="4">Other Reason</option>
							<option @if($statuslock == 5) selected="selected" @endif value="5">Eligible (Paid Payment)</option>
							<option @if($statuslock == 6) selected="selected" @endif value="6">Eligible (Pending Payment)</option>
						</select>
					</div>
					<div class="col-sm-2 col-md-2">
						<select class="form-control kt-select2" id="status_name2" name="status_name2">
							<option value="0">Sahyognidhi Status</option>
							<option @if($statuslock2 == 1) selected="selected" @endif value="1">Half Disability</option>
							<option @if($statuslock2 == 2) selected="selected" @endif value="2">Full Disability</option>
							<option @if($statuslock2 == 3) selected="selected" @endif value="3">Devantage</option>
						</select>
					</div>
					<div class="col-sm-2 col-md-2">
							<button class="btn btn-info" type = "button" name="search"  onclick="SearchData();" id = "search">Search</button>
					</div>
				</div>
			</form>
		</div>	
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
								<a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="export_all" >Export Data</a>

							    @if(in_array('add-sahyognidhi-request',$accessData))
    								<a href="{{ route('add-sahyognidhi-request') }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
    									<i class="la la-plus"></i>
    									Add Sahyognidhi Request
    								</a>
    							@endif
                                @if(in_array('delete-all-sahyognidhi-request',$accessData))
    								<a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="delete_all">
    									<i class="la la-trash"></i>
    									Delete All
    								</a>
    							@endif
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
									<th>Inform Date</th>
									<th>Sahyognidhi Request</th>
									<th>Region</th>
									 <th>Status</th>
									 <th>Eligible</th>
									<th>Actions</th>
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
									<td>{{ date("d-m-Y", strtotime($sahyognidhiRequests->inform_date)) }}</td>
									@if($sahyognidhiRequests->sahyognidhi_request == 'Half Disability')
										<td><span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">{{ $sahyognidhiRequests->sahyognidhi_request }}</span></td>
									@elseif($sahyognidhiRequests->sahyognidhi_request == 'Full Disability')
										<td><span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">{{ $sahyognidhiRequests->sahyognidhi_request }}</span></td>
									@elseif($sahyognidhiRequests->sahyognidhi_request == 'Devantage')
										<td><span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">{{ $sahyognidhiRequests->sahyognidhi_request }}</span></td>
									@endif
									<td>{{ strtoupper($sahyognidhiRequests->region_name) }}</td>
									   {{--  <td>@if($sahyognidhiRequests->payment_status == '')Processing @endif</td> --}}    

									 {{-- <td>@if($totalSahyognidhiAmount[$key] == '2') {{ $givenSahyognidhiAmount }} @else {{ $givenSahyognidhiAmount1 }} @endif</td>
									 <td>@if($sahyognidhiRequests->sahyognidhi_request == 'Devantage'){{ $divangatAmount }} @else {{ $fullDisibility }} @endif</td>  --}} 
									 @if($paymentStatus[$key] == '1')
										<td><span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">Pending</span></td>
									 @elseif($sahyognidhiRequests['status'] == '1') 
										<td><span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">Paid</span></td>
									@elseif($sahyognidhiRequests['status'] == '4')
										<td><span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">Reject</span></td>								
									@elseif($paymentStatus[$key] == '' || $paymentStatus1[$key] == '2')
									<td><span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">Processing</span></td>
									@endif  
                                    
                                    <td>@if($sahyognidhiRequests->sahyognidhiError1 != '')<span class="kt-badge  kt-badge--dark kt-badge--inline kt-badge--pill"> Not Eligible </span>@else <span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill"> Eligible </span> @endif</td>
									<td>
									    @if(in_array('view-sahyognidhi-request',$accessData))
    										<a href="view-sahyognidhi-request/{{ $sahyognidhiRequests->sahyognidhi_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
    											<i class="la la-eye"></i>
    										</a>
    									@endif
                                        
                                        @if(in_array('edit-sahyognidhi-request',$accessData))
    										<a href="edit-sahyognidhi-request/{{ $sahyognidhiRequests->sahyognidhi_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit">
    											<i class="la la-edit"></i>
    										</a>
    									@endif
                                        @if(in_array('delete-sahyognidhi-request',$accessData))
    										<a href="#" onclick="deleteSahyognidhi({{ $sahyognidhiRequests->sahyognidhi_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete">
    											<i class="la la-trash"></i>
    										</a>
    									@endif

										{{-- <a href="#" onclick="openModel({{ $sahyognidhiRequests->sahyognidhi_id }})" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" data-toggle="modal" data-target="#kt_modal_4" title="Genrate YSK ID"> <i class="la la-external-link"></i></a> --}}
                                        @if(in_array('payment-sahyognidhi-request',$accessData))
    										<a href="sahyognidhi-request-payment-details/{{ $sahyognidhiRequests->sahyognidhi_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Payment Details">
    											<i class="fas fa-credit-card"></i>
    										</a>
    									@endif
    									@if(in_array('sahyognidhi-request-after-half-disiability',$accessData))
        									@if($sahyognidhiRequests->sahyognidhi_request == 'Half Disability')
    											<a href="devangat-after-half-disiability/{{ $sahyognidhiRequests->sahyognidhi_id }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Payment Details">
    												<i class="far fa-clipboard"></i>
    											</a>
    										@endif
    									@endif

									</td>
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
	$('#status_name2').select2();
	$('#agegroup_name').select2();
	
	$('#start_date_xml').mask('00-00-0000');
	$('#end_date_xml').mask('00-00-0000');
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
	$('#export_all').on('click', function(e) {
		//alert(1);
		var idsArr = [];
		$(".sub_check_all:checked").each(function() {  
			idsArr.push($(this).attr('value'));
		});
		if(idsArr.length <=0)  
		{  
			var baseUrl 	= 'sayognidhi-request-excel-all';
			var region 		= $('#region_name').val();
			var council 	= $('#council_name').val();
			var division 	= $('#division_name').val();
			var samajzone 	= $('#samajzone_name').val();
			var yuvamandal 	= $('#yuvamandal_name').val();
			var gender 		= $('#gender_name').val();
			var status1 	= $('#status_name').val();
			var status2 	= $('#status_name2').val();
			var agegroup 	= $('#agegroup_name').val();
			var startDate 	= $('#start_date_xml').val();
			var endDate 	= $('#end_date_xml').val();
			
			if(startDate==''){
				startDate =0;
			}if(endDate==''){
				endDate =0;
			}
			/*$url = baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender+'/'+ status1 ;
			 document.location.href=url;*/

			/* url(baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender+'/'+ status1 ).load();
			 document.location.href=url;*/
			 var urldonut = "{{ route('sayognidhi-request-excel-all',[":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1",":status2"]) }}";
				urldonut = urldonut.replace(':region', region);
				urldonutbar = urldonut.replace(':council',council);
				urldonutstackbar = urldonutbar.replace(':startDate',startDate);
				urldonutstackbar1 = urldonutstackbar.replace(':endDate',endDate);
				urldonutstackbar2 = urldonutstackbar1.replace(':division',division);
				urldonutstackbar3 = urldonutstackbar2.replace(':samajzone',samajzone);
				urldonutstackbar4 = urldonutstackbar3.replace(':yuvamandal',yuvamandal);
				urldonutstackbar5 = urldonutstackbar4.replace(':agegroup',agegroup);
				urldonutstackbar6 = urldonutstackbar5.replace(':gender',gender);
				urldonutstackbar7 = urldonutstackbar6.replace(':status1',status1);
				urldonutbarpie = urldonutstackbar7.replace(':status2',status2);
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
			var status2 	= $('#status_name2').val();
			var agegroup 	= $('#agegroup_name').val();
			var startDate 	= $('#start_date_xml').val();
			var endDate 	= $('#end_date_xml').val();
			//var processinid 	= $('#processing_id').val();
			if(startDate==''){
				startDate =0;
			}if(endDate==''){
				endDate =0;
			}
			var strIds = idsArr.join(",");
			
		    var urldonut = "{{ route('sayognidhi-request-excel',[":strIds",":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1",":status2"]) }}";
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
				urldonutstackbar7 = urldonutstackbar6.replace(':status1',status1);
				urldonutbarpie = urldonutstackbar7.replace(':status2',status2);
				window.location = urldonutbarpie;

				
		}
	}
);

function deleteSahyognidhi(id) {
	swal({
		title: "Are you sure?",
		text: "Once deleted, you will not be able to recover this data!",
		icon: "warning",
		buttons: ["Cancel", "Do it!"],
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {

			location.href = 'delete-sahyognidhi-request/'+id;

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
							url: "{{ route('multiple-delete-sahyognidhi-request') }}",
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

function SearchData(){
	//var table = $('#guest-table').DataTable();
	//	table.ajax.reload();
	var baseUrl 	= 'registration-test';
	var region 		= $('#region_name').val();
	var council 	= $('#council_name').val();
	var division 	= $('#division_name').val();
	var samajzone 	= $('#samajzone_name').val();
	var yuvamandal 	= $('#yuvamandal_name').val();
	var gender 		= $('#gender_name').val();
	var status1 	= $('#status_name').val();
	var status2 	= $('#status_name2').val();
	var agegroup 	= $('#agegroup_name').val();
	var startDate 	= $('#start_date_xml').val();
	var endDate 	= $('#end_date_xml').val();
	//var processinid 	=  $('#processing_id').val() ;
	if(startDate==''){
		startDate =0;
	}if(endDate==''){
		endDate =0;
	}
	// $('#guest-table').DataTable().ajax.url(baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender +'/'+ status1  +'/'+ processinid ).load();
	var urldonut = "{{ route('sahyognidhi-request',[":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1",":status2"]) }}";
				urldonut = urldonut.replace(':region', region);
				urldonutbar = urldonut.replace(':council',council);
				urldonutstackbar = urldonutbar.replace(':startDate',startDate);
				urldonutstackbar1 = urldonutstackbar.replace(':endDate',endDate);
				urldonutstackbar2 = urldonutstackbar1.replace(':division',division);
				urldonutstackbar3 = urldonutstackbar2.replace(':samajzone',samajzone);
				urldonutstackbar4 = urldonutstackbar3.replace(':yuvamandal',yuvamandal);
				urldonutstackbar5 = urldonutstackbar4.replace(':agegroup',agegroup);
				urldonutstackbar6 = urldonutstackbar5.replace(':gender',gender);
				urldonutstackbar7 = urldonutstackbar6.replace(':status1',status1);
				urldonutbarpie = urldonutstackbar7.replace(':status2',status2);
				window.location = urldonutbarpie;
}

function openCity(evt, cityName) {
  	var i, tabcontent, tablinks;
  	tabcontent = document.getElementsByClassName("tabcontent");
  	for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
 	 }
  	tablinks = document.getElementsByClassName("tablinks");
  	for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  	}
  	document.getElementById(cityName).style.display = "block";
  	evt.currentTarget.className += " active";
	}


	function openModel(id) {
		$('#kt_modal_4').modal();
		$('#sahyognidhi_payment_id').val(id);
		$.ajax({
			url: '{{ route('get-data-by-sahyognidhi-id') }}',
			type: 'POST',
			data: {sahyognidhi_payment_id:id,_token:"{{ csrf_token() }}"},
			success:function(response) {
				var obj = JSON.parse(response);
				if (obj.success == 1) {
					if (obj.html_data == '') {
						$('.donemessage').show();
						$('.payment_form').hide();
					}
					else{
						$('.nominee_name').html(obj.html_data);
					}
				}
			}
		})
	}

	function getRelation(value) {
		$.ajax({
			url: '{{ route('get-relation') }}',
			type: 'POST',
			data: {nominee_name: value,_token:"{{ csrf_token() }}"},
			success:function (response) {
				var obj = JSON.parse(response);
				if (obj.success == 1) {
					$('.nominee_relation').val(obj.NomineeRelation);
				}
			}
		})
		
	}
$('.date').mask('00-00-0000');
$('.cheque_deposit_date').mask('00-00-0000');
$('.nominee_name').select2();
</script>
@endsection