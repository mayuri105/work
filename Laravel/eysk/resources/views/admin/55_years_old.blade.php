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
						55/60 Year Old                      
					</h3>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper"></div>
				</div>
			</div>
		</div>
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
	</div>
	<!-- end:: Subheader -->       
	<!-- my section new add start-->

	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						55/60 Years Old Members:
					</h3>
				</div>
			</div>

			<div class="main-padding ceparetar">
				<div class="row"> 
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">55 year Pending entries</span>
							<span class="view-value-text">{{ $pendingEntry }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Left Transfer Option</span>
							<span class="view-value-text">{{ $getTotalYskTransfer }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">YSK MITRA</span>
							<span class="view-value-text">{{ $getTotalYskMitra }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
							<option @if($councilData1['council_id']==$council) selected="selected" @endif value="{{ $councilData1['council_id'] }}">{{ 
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
							<option  @if($samajZone1['samaj_zone_id'] == $samajzone) selected="selected" @endif value="{{ $samajZone1['samaj_zone_id'] }}">{{ 
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

						<select class="form-control kt-select2" id="gender_name" name="gender_name">
							<option @if($gender == '0') selected="selected" @endif value="0">Gender</option>
							{{-- @foreach($RegistrationFee as $RegistrationFee1) --}}
							<option @if($gender == '1') selected="selected" @endif value="1">Male</option>

							<option @if($gender == '2') selected="selected" @endif value="2">Female</option>
							{{-- @endforeach --}}
						</select>
					</div>
					
					<div class="col-sm-2 col-md-2">	

						<select class="form-control kt-select2" id="status_name" name="status_name">
							<option @if($status1 == '1') selected="selected" @endif  value="1">Status</option>
							{{-- @foreach($RegistrationFee as $RegistrationFee1) --}}
							<option @if($status1 == '8') selected="selected" @endif  value="8">Transfer</option>
							<option @if($status1 == '7') selected="selected" @endif  value="7">YSK Mitra</option>
							{{-- <option value="5">55 Years Old not confirm</option> --}}
							{{-- @endforeach --}}
						</select>
					</div>
					<div class="col-sm-2 col-md-2">
							<button class="btn btn-info" type = "button" name="search"  onclick="SearchData();" id = "search">Search</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
	<!-- my section new add end-->   
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
							    @if(in_array('delete-all-55-years-old',$accessData))
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
					<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
						<div class="row">
							<div class="col-sm-12">
								<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline view_table" id="today_datatable">
									<thead>

										<tr role="row">
											<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
												<input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span></label>
											</th>
											<th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Name</th>
											<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">YSK ID</th>
											<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Contact Number</th>
											<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">Status</th>
											<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.5px;" aria-label="Actions">Actions</th>
										</tr>
									</thead>
									<tbody>
										@if(count($getFiftyFiveYearsData)>0)
											@foreach($getFiftyFiveYearsData as $key => $value)
											<tr role="row" class="odd">
												<th style="width: 5%;" class="text-center sorting_disabled" rowspan="1" colspan="1"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
													<input type="checkbox" name="sub_check_all[]" value="{{ $value[0]['registration_id'] }}" onchange="checkSubCheckbox()" class="sub_check_all" id="pages">&nbsp;<span></span></label>
												</th>
												<td>{{ $value[0]['name_as_per_yuva_sangh_org'] }}</td>
												<td> @if($value[0]['pre_ysk_id'] != '')  {{ $value[0]['pre_ysk_id']  }} @else {{ $value[0]['ysk_id']  }} @endif </td>
												<td>{{ $value[0]['phone_number_first'] }}</td>

												<td>
													<div class="btn-group">
													    @if(in_array('status-change-55-years-old',$accessData))
	    													<select id="cars" class="btn btn-secondary dropdown-toggle" onchange="function1(this.value,{{ $value[0]['registration_id'] }})">
	    														<option value="" selected>Select Status</option>
	    														<option @if($value[0]['status']=='7') selected="selected" @endif value="YSK Mitra">YSK Mitra</option>
	    														<option @if($value[0]['status']=='8') selected="selected" @endif value="Transfer">Transfer</option>
	    													</select>
	    												@endif
													</div>	
												</td>

												<td nowrap="">
												    @if(in_array('details-55-years-old',$accessData))
	    												<a  href="{{ URL::route('details-55-years', $value[0]['registration_id']) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View">
	    													<i class="la la-eye"></i>
	    												</a>
	    											@endif
												</td>
											</tr>
											@endforeach                                               
										@endif                
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!--end: Datatable -->
				</div>
			</div>	
			<!-- registration date table -->
		</div>
</div>
<!-- content end -->
@endsection      
@section('content_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>
<script>
	$('#start_date_xml').mask('00-00-0000');
	$('#end_date_xml').mask('00-00-0000');
	function SearchData(){
		//var table = $('#guest-table').DataTable();
		//	table.ajax.reload();
		var baseUrl 	= '55-years-old';
		var region 		= $('#region_name').val();
		var council 	= $('#council_name').val();
		var division 	= $('#division_name').val();
		var samajzone 	= $('#samajzone_name').val();
		var yuvamandal 	= $('#yuvamandal_name').val();
		var gender 		= $('#gender_name').val();
		var status1 	= $('#status_name').val();
		var startDate 	= $('#start_date_xml').val();
		var endDate 	= $('#end_date_xml').val();
		
		if(startDate==''){
			startDate =0;
		}if(endDate==''){
			endDate =0;
		}
		 var urldonut = "{{ route('55-years-old',[":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":gender",":status1"]) }}";
				urldonut = urldonut.replace(':region', region);
				urldonutbar = urldonut.replace(':council',council);
				urldonutstackbar = urldonutbar.replace(':startDate',startDate);
				urldonutstackbar1 = urldonutstackbar.replace(':endDate',endDate);
				urldonutstackbar2 = urldonutstackbar1.replace(':division',division);
				urldonutstackbar3 = urldonutstackbar2.replace(':samajzone',samajzone);
				urldonutstackbar4 = urldonutstackbar3.replace(':yuvamandal',yuvamandal);
				urldonutstackbar5 = urldonutstackbar4.replace(':gender',gender);
				urldonutbarpie = urldonutstackbar5.replace(':status1',status1);
				
				window.location = urldonutbarpie;
		
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

	function function1(value,id) {
		var region 		= $('#region_name').val();
		var council 	= $('#council_name').val();
		var division 	= $('#division_name').val();
		var samajzone 	= $('#samajzone_name').val();
		var yuvamandal 	= $('#yuvamandal_name').val();
		var gender 		= $('#gender_name').val();
		var status1 	= $('#status_name').val();
		var startDate 	= $('#start_date_xml').val();
		var endDate 	= $('#end_date_xml').val();
		
		if(startDate==''){
			startDate =0;
		}if(endDate==''){
			endDate =0;
		}
		if(value == "Transfer"){
			var url = "{{ route('add-55-years-old', ":id") }}";
        	url = url.replace(':id', id);
        	window.location = url;
			//window.location = 'add-55-years-old/'+ id;
		}
		if (value == "YSK Mitra") {
				swal({
					title: "Are you sure?",
					text: "This YSK Members is going to join as a YSK Mitra, Ysk Mitra has to pay every year sahyognidhi sharing amount but Ysk Mitra won't get any benifits from YSK Suraksha Kavach Membership!",
					icon: "warning",
					buttons: ["Cancel", "Do it!"],
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						//location.href = 'change-status-ysk-mitra/'+id;
						// window.location = 'change-status-ysk-mitra/'+id;
						var url = "{{ route('change-status-ysk-mitra', ":id") }}";
			        	url = url.replace(':id', id);
			        	window.location = url;

					} else {
						swal({
					buttons: false, // There won't be any confirm button
					text:"Your data is safe!"
				});
					}
				});
			
		}
	}
	$('#export_all').on('click', function(e) {
		var idsArr = [];
		$(".sub_check_all:checked").each(function() {  
			idsArr.push($(this).attr('value'));
		});
		if(idsArr.length <=0)  
		{  
			var baseUrl 	= 'fifty55exportall';
			var region 		= $('#region_name').val();
			var council 	= $('#council_name').val();
			var division 	= $('#division_name').val();
			var samajzone 	= $('#samajzone_name').val();
			var yuvamandal 	= $('#yuvamandal_name').val();
			var gender 		= $('#gender_name').val();
			var status1 	= $('#status_name').val();
			
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
			 var urldonut = "{{ route('fifty_exportall',[":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":gender",":status1"]) }}";
				urldonut = urldonut.replace(':region', region);
				urldonutbar = urldonut.replace(':council',council);
				urldonutstackbar = urldonutbar.replace(':startDate',startDate);
				urldonutstackbar1 = urldonutstackbar.replace(':endDate',endDate);
				urldonutstackbar2 = urldonutstackbar1.replace(':division',division);
				urldonutstackbar3 = urldonutstackbar2.replace(':samajzone',samajzone);
				urldonutstackbar4 = urldonutstackbar3.replace(':yuvamandal',yuvamandal);
				urldonutstackbar5 = urldonutstackbar4.replace(':gender',gender);
				urldonutbarpie = urldonutstackbar5.replace(':status1',status1);
				
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
			
			var startDate 	= $('#start_date_xml').val();
			var endDate 	= $('#end_date_xml').val();
			
			if(startDate==''){
				startDate =0;
			}if(endDate==''){
				endDate =0;
			}
			var strIds = idsArr.join(",");
			
		    var urldonut = "{{ route('fifty_export',[":strIds",":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":gender",":status1"]) }}";
		    	urldonut1 = urldonut.replace(':strIds', strIds);
				urldonut2 = urldonut1.replace(':region', region);
				urldonutbar = urldonut2.replace(':council',council);
				urldonutstackbar = urldonutbar.replace(':startDate',startDate);
				urldonutstackbar1 = urldonutstackbar.replace(':endDate',endDate);
				urldonutstackbar2 = urldonutstackbar1.replace(':division',division);
				urldonutstackbar3 = urldonutstackbar2.replace(':samajzone',samajzone);
				urldonutstackbar4 = urldonutstackbar3.replace(':yuvamandal',yuvamandal);
				urldonutstackbar5 = urldonutstackbar4.replace(':gender',gender);
				urldonutbarpie = urldonutstackbar5.replace(':status1',status1);
				
				window.location = urldonutbarpie;
			   

				
		}
	}
);
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
							url: "{{ route('multiple-delete-55-years') }}",
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
</script>
@endsection 