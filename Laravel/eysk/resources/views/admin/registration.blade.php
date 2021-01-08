@extends('elements.admin_master',array('accessData'=>$accessData))
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Registration
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

	<div class="kt-container view-mtt">
		<div class="view-table-section registration-list">
			<div class="m-widget29">
				<div class="m-widget_content p-0">
					<div class="m-widget_content-items-list">
						<ul style="list-style: none;">
							<li style="width: 33%;margin-bottom: 15px;">
								<div class="m-widget_content-item-list">
									<span class="list-title">Processing ID</span>
									<span class="list-and kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill" style="width:24%;height: 40px;color:#ffffff;">{{$processingId}}</span>
								</div>
							</li>
							<li style="width: 33%;margin-bottom: 15px;">
								<div class="m-widget_content-item-list">
									<span class="list-title">YSK ID Serial No</span>
									<span class="list-and kt-badge  kt-badge--info color-mt kt-badge--inline kt-badge--pill" style="width:34%;height: 40px;">{{ $getYskSerialNo }}</span>
								</div>
							</li>
							{{-- <li style="width: 33%;margin-bottom: 15px;">
								<div class="m-widget_content-item-list">
									<span class="list-title">Pre YSK ID Serial No</span>
									<span class="list-and kt-badge  kt-badge--info color-mt kt-badge--inline kt-badge--pill" style="width:34%;height: 40px;">{{ $getPreYskSerialNo }}</span>
								</div>
							</li> --}}
							<li style="width: 33%;margin-bottom: 15px;">
								<div class="m-widget_content-item-list">
									<span class="list-title">Active</span>
									@if(count($activeUser) == '0')
										<span class="list-and">0</span>
									@else
										<span class="list-and">{{ count($activeUser) }}</span>
									@endif
								</div>
							</li>
							<li style="width: 33%;margin-bottom: 15px;">
								<div class="m-widget_content-item-list">
									<span class="list-title">Deactive</span>
									<span class="list-and">{{ $deActiveUser }}</span>
								</div>
							</li>
							<li style="width: 33%;">
								<div class="m-widget_content-item-list">
									<span class="list-title">Partially Desability Members</span>
									<span class="list-and">{{ $totalHalfDisiability }}</span>
								</div>
							</li>
							<li style="width: 33%;">
								<div class="m-widget_content-item-list">
									<span class="list-title">YSK MITRA</span>
									@if(count($yskMitra) == '0')
										<span class="list-and">0</span>
									@else
										<span class="list-and">{{ count($yskMitra) }}</span>
									@endif
								</div>
							</li>
						</ul>
					<div class="m-separator m-separator--dashed"></div>
					<div class="divangat-title">
						<h4>Deactive</h4>
					</div>
					<div class="m-separator m-separator--dashed"></div>
					<ul style="list-style: none;">
							<li style="width: 33%;">
								<div class="m-widget_content-item-list">
									<span class="list-title">55 Years
									</span>
									<span class="list-and">{{ $pendingEntry }}</span>
								</div>
							</li>
							<li style="width: 33%;">
								<div class="m-widget_content-item-list">
									<span class="list-title">Divangat
									</span>
									<span class="list-and">{{ $totalDivangat }}</span>
								</div>
							</li>

							<li style="width: 33%;">
								<div class="m-widget_content-item-list">
									<span class="list-title">Full Desability Members</span>
									<span class="list-and">{{ $totalFullDisiability }}</span>
								</div>
							</li>
						</ul>

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
						{!! Form::text('start_date_xml',null,['id'=>'start_date_xml','class'=>'form-control m-input','placeholder'=>'Start Date','required']) !!}

						<div id="name_error" class="text-danger" id="start_date_xml_error" style="display: none"></div>
					</div>
					<div class="col-lg-2">
						{!! Form::text('end_date_xml',null,['id'=>'end_date_xml','class'=>'form-control m-input','placeholder'=>'End Date','required']) !!}

						<div id="name_error" class="text-danger" id="end_date_xml_error"  style="display: none"></div>
					</div>

					<div class="col-sm-2 col-md-2">

						<select class="form-control kt-select2" id="council_name" name="council_name" >
							<option value="0">Select a Council</option>
							@foreach($councilData as $councilData1)
							<option value="{{ $councilData1['council_id'] }}">{{
							$councilData1['name'] }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-2 col-md-2">

						<select class="form-control kt-select2" id="region_name" name="region_name">
							<option value="0">Select a Region</option>
							@foreach($regionData as $regionDataval)
							<option value="{{ $regionDataval['region_id'] }}">{{
							$regionDataval['region_name'] }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-2 col-md-2">

						<select class="form-control kt-select2" id="division_name" name="division_name">
							<option value="0">Select a Division</option>
							@foreach($divisionData as $divisionData1)
							<option value="{{ $divisionData1['division_id'] }}">{{
							$divisionData1['division_name'] }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-2 col-md-2">

						<select class="form-control kt-select2" id="samajzone_name" name="samajzone_name">
							<option value="0">Select a SamajZone</option>
							@foreach($samajZone as $samajZone1)
							<option value="{{ $samajZone1['samaj_zone_id'] }}">{{
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
							<option value="{{ $yuvaMandal1['yuva_mandal_number_id'] }}">{{
							$yuvaMandal1['yuva_mandal_number'] }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-2 col-md-2">

						<select class="form-control kt-select2" id="agegroup_name" name="agegroup_name">
							<option value="0">Age Group</option>
							{{-- @foreach($RegistrationFee as $RegistrationFee1) --}}
							<option value="{{
								$RegistrationFee[0]['start_age1']}}-{{ $RegistrationFee[0]['end_age1']}}">{{
							$RegistrationFee[0]['start_age1']}} - {{
							$RegistrationFee[0]['end_age1']}}</option>

							<option value="{{
							$RegistrationFee[0]['start_age2']}}-{{$RegistrationFee[0]['end_age2'] }}">{{
							$RegistrationFee[0]['start_age2']}} - {{$RegistrationFee[0]['end_age2'] }}</option>

							<option value="{{
							$RegistrationFee[0]['start_age3']}}-{{$RegistrationFee[0]['end_age3'] }}">{{
							$RegistrationFee[0]['start_age3']}} - {{$RegistrationFee[0]['end_age3'] }}</option>

							<option value="{{
							$RegistrationFee[0]['start_age4']}}-{{$RegistrationFee[0]['end_age4'] }}">{{
							$RegistrationFee[0]['start_age4']}} - {{$RegistrationFee[0]['end_age4'] }}</option>
							{{-- @endforeach --}}
						</select>
					</div>
					<div class="col-sm-2 col-md-2">

						<select class="form-control kt-select2" id="gender_name" name="gender_name">
							<option value="0">Gender</option>
							{{-- @foreach($RegistrationFee as $RegistrationFee1) --}}
							<option value="1">Male</option>

							<option value="2">Female</option>
							{{-- @endforeach --}}
						</select>
					</div>
					<div class="col-sm-2 col-md-2">
						{!! Form::text('processing_id',null,['id'=>'processing_id','class'=>'form-control m-input','placeholder'=>'Processing Id','required']) !!}
					</div>
					<div class="col-sm-2 col-md-2">
						{!! Form::text('ysk_name',null,['id'=>'ysk_name','class'=>'form-control m-input','placeholder'=>'YSK Member Name','required']) !!}
					</div>
					<div class="col-sm-2 col-md-2">
						{!! Form::text('ysk_id_new',null,['id'=>'ysk_id_new','class'=>'form-control m-input','placeholder'=>'YSK Number','required']) !!}

					</div>

				</div><br>
				<div class="row">
					<div class="col-sm-2 col-md-2">
						{!! Form::text('ysk_id_new_pre',null,['id'=>'ysk_id_new_pre','class'=>'form-control m-input','placeholder'=>'Pre YSK Number','required']) !!}

					</div>
					<div class="col-sm-2 col-md-2">
						<select class="form-control kt-select2" id="status_name" name="status_name">
							<option value="10">Status</option>
							{{-- @foreach($RegistrationFee as $RegistrationFee1) --}}
							<option value="1">Active</option>
							<option value="0">Pending</option>
							<option value="2">Deactive</option>
							<option value="8">Transfer</option>
							<option value="7">YSK Mitra</option>
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
						</h3>&nbsp;
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">
								<a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="export_all" >Export Data</a>
								<a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="export_all_filds" >Export All Data</a>
								@if(in_array('add-registration',$accessData))
									<a href="{{ route('add-registration') }}" class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
										<i class="la la-plus"></i>
										Add Registration
									</a>
								@endif
                                @if(in_array('delete-all-registration',$accessData))
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
						<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="guest-table" role="grid" aria-describedby="kt_table_1_info" style="width: 1147px;" >
							<thead>
								<tr>
									 <th>
										<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
											<input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages">&nbsp;<span></span>
										</label>
									</th>
									<th>Entry Date</th>
									<th>Processing ID</th>
									<th>YSK Date</th>
									<th>YSK Number</th>
									<th>YSK Member Name</th>
									<th>City Name</th>
									<th>Contact</th>
									{{-- <th>Region</th> --}}
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- registration date table -->
		</div>
	</div>
</div>
	<!-- content end -->
@endsection
@section('content_js')
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
	/*$('#start_date_xml').datepicker({
	    todayBtn: 'linked',
	    todayHighlight: true,
	    format: "yyyy-mm-dd",
	    autoclose: true
	});
	$('#end_date_xml').datepicker({
	    todayBtn: 'linked',
	    todayHighlight: true,
	    format: "yyyy-mm-dd",
	    autoclose: true
	});*/
$(function() {
var baseUrl 	= 'registration-test';
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
var processinid = $('#processing_id').val();
var yskname 	= $('#ysk_name').val();
var yskidnew 	= $('#ysk_id_new').val();
var yskidnewpre 	= $('#ysk_id_new_pre').val();

if(startDate==''){
	startDate =0;
}if(endDate==''){
	endDate =0;
}
if(processinid == '')
			{
				processinid=0;
			}
			if(yskname == '')
			{
				yskname=0;
			}
			if(yskidnew == '')
			{
				yskidnew=0;
			}
			if(yskidnewpre == '')
			{
				yskidnewpre=0;
			}
$('#guest-table').DataTable({
    processing: true,
    serverSide: true,
     ajax: {
            url: baseUrl+ '/'+region +'/'+council+'/'+ startDate +'/'+ endDate +'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender +'/'+ status1 +'/'+ processinid +'/'+ yskname +'/'+ yskidnew +'/'+ yskidnewpre,

          },
    columns: [
        /*{ data: 'amount', name: 'amount', orderable: false },
       */
        {  'targets': 0,
         'searchable': true,
         'orderable': false,
         'className': 'dt-body-center',
	       	"render": function(data, type, full, meta){
	       		if(full["registration_id"]>0){

	          		return "<label class='kt-checkbox kt-checkbox--single kt-checkbox--solid'><input type='checkbox' name='sub_check_all[]' value="+full["registration_id"]+" onchange='checkSubCheckbox()' class='sub_check_all' id='pages'><span></span></label>";
	       		}else{
	       			return '';
	       		}
	       }
	   	},

        { data: 'today_date', name: 'today_date', orderable: false},
        { 'targets': 0,
         'orderable': false,
         'className': 'dt-body-center',
          'name': 'processing_id'
         ,
	       	"render": function(data, type, full, meta){
	          return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">'+
	          full["processing_id"]+'</span>' ;
	       }
	   	},
        { data: 'ysk_date', name: 'ysk_date', orderable: false},
       	{	'targets': 0,
         'orderable': false,
         'className': 'dt-body-center',
	       	"render": function(data, type, full, meta){
	          return full["ysk_id"] + " " + full["pre_ysk_id"];
	       }
	    },
	    { data: 'name_as_per_yuva_sangh_org', name: 'name_as_per_yuva_sangh_org', orderable: false,uppercase: true},
	    { data: 'fk_city_id', name: 'fk_city_id', orderable: false,uppercase: true},
	    { data: 'phone_number_first', name: 'phone_number_first', orderable: false,uppercase: true},
       /* { data: 'region_name', name: 'region_name', orderable: false},*/

	   	 { 'targets': 0,
         'orderable': false,
         'className': 'dt-body-center',
	       	"render": function(data, type, full, meta){
	          if( full["status"] == '1'){
	          	return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Active</span>';
	          }
	          else if(full["status"] == '0'){
	          		return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill" style="background-color: #ffb822">Pending</span>';
	          }else if(full["status"] == '8'){
	          	return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Transfer</span>';
	          }else if(full["status"] == '7'){
	          	return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">YSK Mitra</span>';
	          }else{
	          	return '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">De Active</span>';
	          }
	       }
	   	},
	   	{'targets': 0,
         'searchable': false,
         'orderable': false,
         'className': 'dt-body-center',
	       	"render": function(data, type, full, meta){


	       		/*if(full["upload"] == '1,3' || full["upload"] == '3,1'  || full["amount"] == '' || full["first_nominee_name"] == '' || full["second_nominee_name"] == '')
	       		{
	       			var tool =  '';
	       		}else if(full["upload"] == '1' || full["upload"] == '3'  || full["amount"] == '' || full["first_nominee_name"] == '' || full["second_nominee_name"] == ''){
	       			var tool = "<a href='#' class='btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon hoverTooltip' id="+full["registration_id"]+" onmousemove ='fethool();'><i class='fa fa-question-circle' style='color: red;'></i></a>";
	       		}else{
	       			var tool = "<a href='#' class='btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon hoverTooltip' id="+full["registration_id"]+" onmousemove ='fethool();' ><i class='fa fa-question-circle' style='color: red;'></i></a>";
	       		}*/
	       		var as = '<a href="details-registrationstatus/'+full["registration_id"]+'"class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="View"><i class="la la-eye"></i></a><a href="edit-registration/'+full["registration_id"]+'" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Edit"><i class="la la-edit"></i></a><a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Delete" onclick="deleteRegistration('+full["registration_id"]+')"><i class="la la-trash"></i></a><div id="fetch_data1"></div>';
	       		$.ajax({
					url:"{{ route('tooltip-status-all') }}",
					method:"POST",
					async: false,
					data:{id:full["registration_id"],_token:"{{ csrf_token() }}"},
					success:function(response)
					{
						var obj = JSON.parse(response);
						//var fetch_data1 = obj.html_data;
						if(obj.html_data == '1' || obj.amount == '0'){
						as += '<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon hoverTooltip" id='+full["registration_id"]+' onmousemove ="fethool();"><i class="fa fa-question-circle" style="color: red;"></i></a>';
                            as += '<a href="{{url('/onlinetransaction')}}" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon " title="Online Payment"><i class="fa fa-paypal" style="color:green;"></i></a>' ;
						}else{
							as += '' ;
						}
						if(obj.amount != '0'){
							as +='<a href="payment-details/'+full["registration_id"]+'" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" title="Payment Details"><i class="fas fa-credit-card"></i></a>';
						}
					}
				});


				return as ;

	       	}
	   	},
	   	//{ data: 'upload', name: 'upload', orderable: false},var array = $('#searchKeywords').val().split(",");
    ]
   });
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
	var agegroup 	= $('#agegroup_name').val();
	var startDate 	= $('#start_date_xml').val();
	var endDate 	= $('#end_date_xml').val();
	var processinid 	=  $('#processing_id').val() ;
	var yskname 	= $('#ysk_name').val();
	var yskidnew 	= $('#ysk_id_new').val();
	var yskidnewpre 	= $('#ysk_id_new_pre').val();

	if(startDate==''){
		startDate =0;
	}if(endDate==''){
		endDate =0;
	}
	if(processinid == '')
			{
				processinid=0;
			}
			if(yskname == '')
			{
				yskname=0;
			}
			if(yskidnew == '')
			{
				yskidnew=0;
			}
			if(yskidnewpre == '')
			{
				yskidnewpre=0;
			}
	$('#guest-table').DataTable().ajax.url(baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender +'/'+ status1  +'/'+ processinid +'/'+ yskname +'/'+ yskidnew +'/'+ yskidnewpre).load();
}
</script>
<script>
	setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);

	function deleteRegistration(id) {
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			icon: "warning",
			buttons: ["Cancel", "Do it!"],
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				location.href = 'delete-registration/'+id;

			} else {
				swal({
					buttons: false, // There won't be any confirm button
					text:"Your data is safe!"
				});
			}
		});
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
							url: "{{ route('multiple-delete-registration') }}",
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




	$(document).ready(function(){

		$('.hoverTooltip').tooltip({
			title: fetchData,
			html: true,
			placement: 'right'
		});

		function fetchData()
		{
			var id = $(this).attr("id");
			var fetch_data = '';
			$.ajax({
				url:"{{ route('tooltip-status') }}",
				method:"POST",
				async: false,
				data:{id:id,_token:"{{ csrf_token() }}"},
				success:function(response)
				{
					var obj = JSON.parse(response);
					fetch_data = obj.html_data;
				}
			});
			return fetch_data;
		}
	});

function fethool(){
	$('.hoverTooltip').tooltip({
			title: fetchData,
			html: true,
			placement: 'right'
		});
	function fetchData()
		{
			var id = $(this).attr("id");
			var fetch_data = '';
			$.ajax({
				url:"{{ route('tooltip-status') }}",
				method:"POST",
				async: false,
				data:{id:id,_token:"{{ csrf_token() }}"},
				success:function(response)
				{
					var obj = JSON.parse(response);
					fetch_data = obj.html_data;
				}
			});
			return fetch_data;
		}
}

$('#export_all_filds').on('click', function(e) {
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
			var processinid = $('#processing_id').val();
			var yskname 	= $('#ysk_name').val();
			var yskidnew 	= $('#ysk_id_new').val();
			var yskidnewpre 	= $('#ysk_id_new_pre').val();

			if(startDate==''){
				startDate =0;
			}if(endDate==''){
				endDate =0;
			}
			if(processinid == '')
			{
				processinid=0;
			}
			if(yskname == '')
			{
				yskname=0;
			}
			if(yskidnew == '')
			{
				yskidnew=0;
			}
			if(yskidnewpre == '')
			{
				yskidnewpre=0;
			}
			/*$url = baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender+'/'+ status1 ;
			 document.location.href=url;*/

			/* url(baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender+'/'+ status1 ).load();
			 document.location.href=url;*/
			 var urldonut = "{{ route('exceltest-all-fileds-admin',[":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1",":processinid",":yskname",":yskidnew",":yskidnewpre"]) }}";
				urldonut 			= urldonut.replace(':region', region);
				urldonutbar 		= urldonut.replace(':council',council);
				urldonutstackbar 	= urldonutbar.replace(':startDate',startDate);
				urldonutstackbar1 	= urldonutstackbar.replace(':endDate',endDate);
				urldonutstackbar2 	= urldonutstackbar1.replace(':division',division);
				urldonutstackbar3 	= urldonutstackbar2.replace(':samajzone',samajzone);
				urldonutstackbar4 	= urldonutstackbar3.replace(':yuvamandal',yuvamandal);
				urldonutstackbar5 	= urldonutstackbar4.replace(':agegroup',agegroup);
				urldonutstackbar6 	= urldonutstackbar5.replace(':gender',gender);
				urldonutstackbar7 	= urldonutstackbar6.replace(':status1',status1);
				urldonutbarpie8 	= urldonutstackbar7.replace(':processinid',processinid);
				urldonutbarpie9 	= urldonutbarpie8.replace(':yskname',yskname);
				urldonutbarpie10 		= urldonutbarpie9.replace(':yskidnew',yskidnew);
				urldonutbarpie 		= urldonutbarpie10.replace(':yskidnewpre',yskidnewpre);
				window.location 	= urldonutbarpie;

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
			var yskname 	= $('#ysk_name').val();
			var yskidnew 	= $('#ysk_id_new').val();
			var yskidnewpre 	= $('#ysk_id_new_pre').val();

			if(startDate==''){
				startDate =0;
			}if(endDate==''){
				endDate =0;
			}
			if(processinid == '')
			{
				processinid=0;
			}
			if(yskname == '')
			{
				yskname=0;
			}
			if(yskidnew == '')
			{
				yskidnew=0;
			}
			if(yskidnewpre == '')
			{
				yskidnewpre=0;
			}
			var strIds = idsArr.join(",");

		    var urldonut = "{{ route('exceltest-fileds-admin',[":strIds",":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1",":processinid",":yskname",":yskidnew",":yskidnewpre"]) }}";
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
				urldonutbarpie8 = urldonutstackbar7.replace(':processinid',processinid);
				urldonutbarpie9 = urldonutbarpie8.replace(':yskname',yskname);
				urldonutbarpie10 = urldonutbarpie9.replace(':yskidnew',yskidnew);
				urldonutbarpie 		= urldonutbarpie10.replace(':yskidnewpre',yskidnewpre);
				window.location = urldonutbarpie;


		}
	}
);
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
			var processinid = $('#processing_id').val();
			var yskname 	= $('#ysk_name').val();
			var yskidnew 	= $('#ysk_id_new').val();
			var yskidnewpre 	= $('#ysk_id_new_pre').val();

			if(startDate==''){
				startDate =0;
			}if(endDate==''){
				endDate =0;
			}
			if(processinid == '')
			{
				processinid=0;
			}
			if(yskname == '')
			{
				yskname=0;
			}
			if(yskidnew == '')
			{
				yskidnew=0;
			}
			if(yskidnewpre == '')
			{
				yskidnewpre=0;
			}
			/*$url = baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender+'/'+ status1 ;
			 document.location.href=url;*/

			/* url(baseUrl+ '/'+region+'/'+council+'/'+startDate +'/'+ endDate+'/'+ division +'/'+ samajzone +'/'+ yuvamandal +'/'+ agegroup +'/'+ gender+'/'+ status1 ).load();
			 document.location.href=url;*/
			 var urldonut = "{{ route('exceltest-all',[":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1",":processinid",":yskname",":yskidnew",":yskidnewpre"]) }}";
				urldonut 			= urldonut.replace(':region', region);
				urldonutbar 		= urldonut.replace(':council',council);
				urldonutstackbar 	= urldonutbar.replace(':startDate',startDate);
				urldonutstackbar1 	= urldonutstackbar.replace(':endDate',endDate);
				urldonutstackbar2 	= urldonutstackbar1.replace(':division',division);
				urldonutstackbar3 	= urldonutstackbar2.replace(':samajzone',samajzone);
				urldonutstackbar4 	= urldonutstackbar3.replace(':yuvamandal',yuvamandal);
				urldonutstackbar5 	= urldonutstackbar4.replace(':agegroup',agegroup);
				urldonutstackbar6 	= urldonutstackbar5.replace(':gender',gender);
				urldonutstackbar7 	= urldonutstackbar6.replace(':status1',status1);
				urldonutbarpie8 	= urldonutstackbar7.replace(':processinid',processinid);
				urldonutbarpie9 	= urldonutbarpie8.replace(':yskname',yskname);
				urldonutbarpie10 		= urldonutbarpie9.replace(':yskidnew',yskidnew);
				urldonutbarpie 		= urldonutbarpie10.replace(':yskidnewpre',yskidnewpre);
				window.location 	= urldonutbarpie;

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
			var yskname 	= $('#ysk_name').val();
			var yskidnew 	= $('#ysk_id_new').val();
			var yskidnewpre 	= $('#ysk_id_new_pre').val();

			if(startDate==''){
				startDate =0;
			}if(endDate==''){
				endDate =0;
			}
			if(processinid == '')
			{
				processinid=0;
			}
			if(yskname == '')
			{
				yskname=0;
			}
			if(yskidnew == '')
			{
				yskidnew=0;
			}
			if(yskidnewpre == '')
			{
				yskidnewpre=0;
			}
			var strIds = idsArr.join(",");

		    var urldonut = "{{ route('exceltest',[":strIds",":region",":council",":startDate",":endDate",":division",":samajzone",":yuvamandal",":agegroup",":gender",":status1",":processinid",":yskname",":yskidnew",":yskidnewpre"]) }}";
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
				urldonutbarpie8 = urldonutstackbar7.replace(':processinid',processinid);
				urldonutbarpie9 = urldonutbarpie8.replace(':yskname',yskname);
				urldonutbarpie10 = urldonutbarpie9.replace(':yskidnew',yskidnew);
				urldonutbarpie 		= urldonutbarpie10.replace(':yskidnewpre',yskidnewpre);
				window.location = urldonutbarpie;


		}
	}
);
    {{--$('#council_name').change(function(){--}}
    {{--    var councilname= $(this).val();--}}
    {{--    //alert(councilname);--}}
    {{--    if(councilname){--}}
    {{--        $.ajax({--}}
    {{--            type:"POST",--}}
    {{--            url:'{{url('/getcouncil')}}' ,--}}
    {{--            data:{'councilname':councilname,--}}
    {{--                _token:"{{ csrf_token() }}" },--}}
    {{--            success:function(res){--}}
    {{--                if(res){--}}
    {{--                    $("#region_name").empty();--}}
    {{--                    $("#region_name").append('<option>Select</option>');--}}
    {{--                    $.each(res,function(key,value){--}}
    {{--                        $("#region_name").append('<option value="'+key+'">'+value+'</option>');--}}
    {{--                    });--}}

    {{--                }else{--}}
    {{--                    $("#region_name").empty();--}}
    {{--                }--}}
    {{--            }--}}
    {{--        });--}}
    {{--    }else{--}}
    {{--        $("#region_name").empty();--}}

    {{--    }--}}
    {{--});--}}
    {{--$('#region_name').on('change',function(){--}}
    {{--    var region_name = $(this).val();--}}
    {{--    //alert(region_name);--}}
    {{--    if(region_name){--}}
    {{--        $.ajax({--}}
    {{--            type:"POST",--}}
    {{--            url:'{{url('/getregion')}}' ,--}}
    {{--            data:{'region_name':region_name,--}}
    {{--                _token:"{{ csrf_token() }}" },--}}
    {{--            success:function(res){--}}
    {{--                if(res){--}}
    {{--                    $("#division_name").empty();--}}
    {{--                    $.each(res,function(key,value){--}}
    {{--                        $("#division_name").append('<option value="'+key+'">'+value+'</option>');--}}
    {{--                    });--}}

    {{--                }else{--}}
    {{--                    $("#division_name").empty();--}}
    {{--                }--}}
    {{--            }--}}
    {{--        });--}}
    {{--    }else{--}}
    {{--        $("#division_name").empty();--}}
    {{--    }--}}

    {{--});--}}
    {{--$('#region_name').on('change',function(){--}}
    {{--    var region_name = $(this).val();--}}
    {{--    //alert(region_name);--}}
    {{--    if(region_name){--}}
    {{--        $.ajax({--}}
    {{--            type:"POST",--}}
    {{--            url:'{{url('/getdivision')}}' ,--}}
    {{--            data:{'region_name':region_name,--}}
    {{--                _token:"{{ csrf_token() }}" },--}}
    {{--            success:function(res){--}}
    {{--                if(res){--}}
    {{--                    $("#samajzone_name").empty();--}}
    {{--                    $.each(res,function(key,value){--}}
    {{--                        $("#samajzone_name").append('<option value="'+key+'">'+value+'</option>');--}}
    {{--                    });--}}

    {{--                }else{--}}
    {{--                    $("#samajzone_name").empty();--}}
    {{--                }--}}
    {{--            }--}}
    {{--        });--}}
    {{--    }else{--}}
    {{--        $("#samajzone_name").empty();--}}
    {{--    }--}}

    {{--});--}}
    {{--$('#region_name').on('change',function(){--}}
    {{--    var region_name = $(this).val();--}}
    {{--    //alert(region_name);--}}
    {{--    if(region_name){--}}
    {{--        $.ajax({--}}
    {{--            type:"POST",--}}
    {{--            url:'{{url('/getyuvamandal_name')}}' ,--}}
    {{--            data:{'region_name':region_name,--}}
    {{--                _token:"{{ csrf_token() }}" },--}}
    {{--            success:function(res){--}}
    {{--                if(res){--}}
    {{--                    $("#yuvamandal_name").empty();--}}
    {{--                    $.each(res,function(key,value){--}}
    {{--                        $("#yuvamandal_name").append('<option value="'+key+'">'+value+'</option>');--}}
    {{--                    });--}}

    {{--                }else{--}}
    {{--                    $("#yuvamandal_name").empty();--}}
    {{--                }--}}
    {{--            }--}}
    {{--        });--}}
    {{--    }else{--}}
    {{--        $("#yuvamandal_name").empty();--}}
    {{--    }--}}

    {{--});--}}

</script>
@endsection
