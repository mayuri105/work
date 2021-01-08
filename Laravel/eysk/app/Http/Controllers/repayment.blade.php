@extends('elements.admin_master')
@section('content')
<link href="{{ URL::asset('assets/css/bootstrap-datepickernew.css') }}" rel="stylesheet" type="text/css" />				
<link href="{{ URL::asset('assets/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />				

<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						Repayment                      
					</h3>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper"></div>
				</div>
			</div>
		</div>
	</div>
					
	<!-- my section new add start-->

	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!--begin::Portlet-->


		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						Sahyognidhi Repayment:	
					</h3>
				</div>
			</div>


			<div class="main-padding ceparetar">
				<div class="row"> 
					<div class="col-sm-4 col-md-4 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Total Sahyognidhi Amount / Members</span>
							<span class="view-value-text">{{ $totalSahyognidhiAmount }} / {{ $countSahyognidhiRequest }}</span>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Sahyognidhi Paid Amount / Members</span>
							<span class="view-value-text">{{ $sahyognidhiPaymentamount }} / {{ $sahyognidhiPaymentpaid }}</span>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Sahyognidhi Pending Amount / Members</span>
							@php $totalPending = $totalSahyognidhiAmount - $sahyognidhiPaymentamount @endphp
							<span class="view-value-text">{{ $totalPending }}/ {{ $sahyognidhipending }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Sahyognidhi Cheque Return Entry</span>
							<span class="view-value-text">12</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Sahyognidhi ACH Return Entry</span>
							<span class="view-value-text">12</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">YSK Mitra Paid Amount / Member</span>
							<span class="view-value-text">7,200 / 12</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">YSK Mitra Pending Amount / Member</span>
							<span class="view-value-text">5,000 / 5</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- my section new add end-->   

	<!-- start:: filter -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="filter-section-bg">
			<form>
				<div class="row">	
					<div class="col-lg-2">
						<select class="form-control" name="start_year" id="start_year">
							<option selected disabled>Select Start Year</option>
							@for ($year=2009; $year <= date('Y'); $year++)
							<option value="{{ $year }}">{{ $year }}</option>
							@endfor
						</select>
						 @if ($errors->has('start_year'))
						<span style="color: red;">
							{{ $errors->first('start_year') }}
						</span>
						@endif 
					</div>
					<div class="col-lg-2">
						<select class="form-control" name="end_year" id="end_year">
							<option selected disabled>Select End Year</option>
							@for ($year=2009; $year <= date('Y'); $year++)
							<option value="{{ $year }}">{{ $year }}</option>
							@endfor
						</select>
						@if ($errors->has('end_year'))
						<span style="color: red;">
							{{ $errors->first('end_year') }}
						</span>
						@endif
						<p style="color: red;display: none;" id="errormsg">bgfdfcghjbkm</p>
					</div>	

					<div class="col-sm-2 col-md-2">	
						<select class="form-control kt-select2" id="region_name" name="region_name" onchange="checkRegiontotalamt(this.value);">
							<option value="0">Select a Region</option>
							@foreach($regionData as $regionDataval)
							<option value="{{ $regionDataval['region_id'] }}">{{ 
							$regionDataval['region_name'] }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-3 col-md-3">
						<div class="repayment-amount-mt">
							<span>Total Amount : <i class="la la-rupee"></i> <span id="total">00,00,000</span></span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3">
						<div class="repayment-amount-mtt">
							<span>Pending Amount : <i class="la la-rupee"></i> <span id="pending">00,00,000</span></span>
						</div>
					</div>	
				</div>
			</form>
		</div>	
	</div>
	<!-- end:: filter -->	

					



				

	<!-- end:: Subheader -->        
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
						        <select class="form-control kt-select2" id="region_name" name="region_name" onchange="SelectACH(this.value);">
									<option @if($ach==0) selected @endif value="0">Select a ACH</option>
									<option @if($ach==1) selected @endif value="1">All ACH</option>
									<option @if($ach==2) selected @endif value="2">ACH Pending</option>
									<option @if($ach==3) selected @endif value="3">ACH Paid</option>
									<option @if($ach==4) selected @endif value="4">ACH Bounce Only</option>
								</select>
							</div>
				       </div>
				   </div>

					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">
				           <a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" onclick="AchPaid();">
									{{-- <i class="la la-trash"></i >--}}
									ACH Pay
								</a>
								<a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" onclick="AchBounce();">
									{{-- <i class="la la-trash"></i> --}}
									ACH Bounce
								</a>
								<a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="delete_all">
									<i class="la la-trash"></i>
									Delete All
								</a>
				       </div>
				   </div>
				</div>
   			</div>
   <div class="kt-portlet__body">
      <!--begin: Datatable -->
      <div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="row">
            <div class="col-sm-12">
             	<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="today_datatable" role="grid" aria-describedby="kt_table_1_info" style="width: 1147px;">
				<thead>
                     
                    <tr role="row">
                       <th style="width: 1%;" class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="check_all[]" onchange="checkAll()" class="check_all" id="pages" style="width: 16px;height: 16px;">&nbsp;<span></span></label></th>
                        <th class="sorting_asc" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 46.25px;" aria-sort="ascending" aria-label="Record ID: activate to sort column descending">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 38.25px;" aria-label="Order ID: activate to sort column ascending">YSK ID</th>
                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 80.25px;" aria-label="Ship City: activate to sort column ascending">Age</th>
                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Region</th>
                      	<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Phone Number</th>
                      	<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 64.25px;" aria-label="Country: activate to sort column ascending">Status</th>
                     	<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 68.5px;" aria-label="Actions">Actions</th>
                     	</tr>
                  </thead>
                  <tbody>
                  	@foreach($RepaymentModel as $valRepaymentModel)
	                    <tr role="row" class="odd">
	                        <td class="text-center"><label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input type="checkbox" name="sub_check_all[]" value="{{ $valRepaymentModel->fk_registration_id  }}" class="sub_check_all" onchange="checkSubCheckbox()" id="pages" style="width: 16px;height: 16px;"><span></span></label></td>
	                        <td>{{ $valRepaymentModel->name }}</td>
	                        <td>{{ $valRepaymentModel->ysk_id }}</td>
	                        <td>{{ $valRepaymentModel->age }}</td>
	                        <td>{{ $valRepaymentModel->region_name }}</td>
	                        <td>{{ $valRepaymentModel->phone_number_first }}</td>

	                        <td>
		                        @if($valRepaymentModel->status == 0 )

		                        	<span class="list-and kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill" >Pending</span>

		                        @elseif($valRepaymentModel->status == 1 )

	                        		<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Paid</span>

	                        	@elseif($valRepaymentModel->status == 3 )

	                        		<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill">Deactive</span>

	                        	@endif
	                        </td>
	                        <td nowrap="">
	                          <a href="{{ route('repayment-view',$valRepaymentModel->ysk_id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" style="font-size: 25px;"><i class="la la-eye" style="font-size: 20px;"></i></a>
	                        @if($valRepaymentModel->status == 0)
	                        	<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md datatable-icon" onclick="openpayment({{ $valRepaymentModel->fk_registration_id }},{{  $valRepaymentModel->payment_status }});"title="Payment">
	                           <i class="la la-money"></i>
	                       	@endif
	                           </a>
	                        </td>
	                    </tr>
                    @endforeach
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

				
				<!--begin::Modal-->
				<div class="modal fade" id="payment_model_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    			<div class="modal-dialog modal-lg" role="document">
    			
        		<div class="modal-content">
            	<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            	</div>
            	<div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="folder_create">
           		@csrf
       			<div class="repayment-popup-payment">	        	
       			<div class="row">
       			<div class="col-sm-12">
       			<div class="form-group">
       				<input type="hidden" name="status"  id="status" value=""  class="form-control">
						<div class="kt-radio-inline">
							<label class="kt-radio">
								<input type="radio" name="radio2" value="2" id="cheque"> Cheque
								<span class="tablinks" onclick="openCity(event, 'Paris')"></span>
							</label>
							<label class="kt-radio">
								<input type="radio" name="radio2" value="3" id="online"> Online
								<span class="tablinks" onclick="openCity(event, 'Tokyo')"></span>
							</label>
							<label class="kt-radio">
								<input type="radio" name="radio2" value="1" id="ach"> ACH
								<span class="tablinks"  onclick="openCity(event, 'India')"></span>
							</label>
						</div>
					</div>
       			</div>	
       			
       			<input type="hidden" name="reg_id"  id="reg_id" value=""  class="form-control">
       			
       			<div class="col-sm-12 col-md-12">
       			<div id="Paris" class="tabcontent">
       			<h3>Cheque</h3>
       			<div class="row check-box pay-pop-cheque">	
  				<div class="col-sm-6">
  				<label>Bank name</label>
  				
  				<select class="form-control kt-select2" id="reg_bank_name" name="reg_bank_name">
					<option selected disabled>Select Bank Name</option>
					@foreach($bankName as $bankNames) 
						<option value="{{ $bankNames->ledger_account_id }}">{{ $bankNames->legder_name }}</option>
					@endforeach 
				</select>
  				</div>
  				<div class="col-sm-6">
  				<label>Amount</label>
  				<input type="text" name="bank_amount" id="bank_amount" required="required"  value="" class="form-control">
  				</div>
  				<div class="col-sm-6">
  				<label>YSK Member Bank Name</label>
  				<input type="text" name="ysk_member_bank_name" required="required" value=""  id="ysk_member_bank_name" class="form-control">
  				</div>
  				<div class="col-sm-6">
  				<label>Branch name</label>
  				<input type="text" name="branch_name" id="branch_name" required="required"  value="" class="form-control">
  				</div>  				
  				<div class="col-sm-6">
  				<label>Cheque number</label>
  				<input type="text" name="cheque_number"  value="" required="required" id="cheque_number" class="form-control">
  				</div>
  				<div class="col-sm-6">
  				<label>Narration</label>
  				<textarea class="form-control" name="narration" required="required"  value="" id="narration"></textarea>
  				<!-- <input type="text" name="name" class="form-control"> -->
  				</div>
  				<div class="col-sm-12 padding-mt">
				<div class="repayment-submit-btn-1">
					<input type="submit" class="repayment-submit-btn" value="Submit" >
				
				</div>
				</div>	
				</div>	
       			</div>

       			<!-- <div id="Tokyo" class="tabcontent">
       			<h3>Online</h3>	
       			<div class="row">	
  				<div class="col-sm-12">
  				<label>Bank name</label>
  				<select class="form-control kt-select2 select-mt" id="kt_select2_11" name="param" style="width: 100%;">
                <option value="AK">Select Bank</option>
                <option value="AK">ICIC Bank</option>
                <option value="HI">Bank of India</option>
                <option value="HI">HDFC Bank</option>
                </select>
  				</div>
  				<div class="col-sm-12 padding-mt">
				<label>Amount
        		<span class="text-danger">*</span></label>	
				<input type="name" class="form-control" aria-describedby="emailHelp">
				</div>
				<div class="col-sm-12 padding-mt">
				<div class="repayment-submit-btn-1">
				<a href="#" class="repayment-submit-btn">Submit</a>	
				</div>
				</div>	
				</div>
       			</div> -->	
       			</div>
				</div>	
				</div>	
				</form>
           		</div>
            	<div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button> -->
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
			         
			</div>
		</div>
	</div>
<div class="modal fade" id="ach_paid_id" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<form method="post" enctype="multipart/form-data" >
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ach Piad</h4>
				</div>
				<div class="modal-body">
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<label class="col-lg-3 col-form-label">Enter Date</label>
							<div class="col-lg-9" style="font-weight: 500;">
							{!! Form::text('start_date_paid',null,['id'=>'start_date_paid','class'=>'form-control m-input','placeholder'=>'Start Date','required']) !!}

							</div>
							
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="SendachPAid();" id="sbtok" name="sbtok" class="btn btn-primary">Send</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="ach_bounce_id" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<form method="post" enctype="multipart/form-data" >
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ach Bounce</h4>
				</div>
				<div class="modal-body">
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<label class="col-lg-3 col-form-label">Enter Date</label>
							<div class="col-lg-9" style="font-weight: 500;">
							{!! Form::text('start_date_bounce',null,['id'=>'start_date_bounce','class'=>'form-control m-input','placeholder'=>'Start Date','required']) !!}

							</div>
							
						</div>
						
						<div class="form-group m-form__group row">
			  				<label class="col-lg-3 col-form-label">Bank name</label>
			  				<div class="col-lg-9" style="font-weight: 500;">
			  						<select class="form-control kt-select2" id="reg_bank_name" name="reg_bank_name">
									<option selected disabled>Select Bank Name</option>
									@foreach($bankName as $bankNames) 
										<option value="{{ $bankNames->ledger_account_id }}">{{ $bankNames->legder_name }}</option>
									@endforeach 
								</select>
							</div>
			  			</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="SendachBounce();" id="sbtok" name="sbtok" class="btn btn-primary">Send</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
<!--ENd:: Chat-->
@section('content_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
	$('#start_year').select2();
	$('#end_year').select2();
	$('#start_date_paid').datepicker({
	    todayBtn: 'linked',
	    todayHighlight: true,
	    format: "mm/dd/yyyy",
	    autoclose: true
	});
	$('#start_date_bounce').datepicker({
	    todayBtn: 'linked',
	    todayHighlight: true,
	    format: "mm/dd/yyyy",
	    autoclose: true
	});

function checkRegiontotalamt(region_id){
	var startYear = $("#start_year").val();
    var endYear = $("#end_year").val();
	$.ajax({
    		type:'POST',
    		url:'{{ route('repayment-region-data') }}',
    		data:{start_year:startYear,end_year:endYear,region_id:region_id,_token:"{{ csrf_token() }}"},
    		success:function(response){
    			var obj = JSON.parse(response);
    			if (obj.success == 1) {
    				
    				$("#pending").html(obj.RepaymentModelpending);
    				$("#total").html(obj.RepaymentModelcmpleted);
    			} 
    			else{
    				
    			}  
    			        
    		}

    	});

}
function AchPaid(){
	
	$("#ach_paid_id").modal();
}

function AchBounce(){
	
	$("#ach_bounce_id").modal();
}
function SelectACH(achid){

	var urldonut = "{{ route('ach_list',[':achid']) }}";
	urldonut1 = urldonut.replace(':achid', achid);
	window.location = urldonut1;
}
function openpayment(registration_id,payment_status)
{ 	//alert(registration_id);
	var registeration_id = registration_id;
	$.ajax({
    		type:'post',
    		url:'{{ route('final-payment-total') }}',
    		data:{registeration_id:registeration_id,_token:"{{ csrf_token() }}"},
    		success:function(response){
    			var obj = JSON.parse(response);
    			if (obj.success == 1) {
    				
    				$('#bank_amount').val(obj.finaltotal);
    			} 
    			else{
    				
    			}  
    			        
    		}

    	});
	$('#reg_id').val(registeration_id);
	//$('#status').val(payment_status);
	if (($('input[name="radio2"][value="1"]').val()) == payment_status) {
		$('input[name="radio2"][value="1"]').attr('checked','checked');
		$('#ach').attr('checked',true);
	}
	$("#payment_model_id").modal();
 	
}

$("#folder_create").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url:"{{ route('paymentform') }}",
            method: "POST",
            data:  new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                if(response.success == 1){
                    location.reload();
                }
                else{ 
                }
            }       
        });
}));
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
	</script>

<script type="text/javascript">
	function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile3-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#photo3").change(function(){
        readURL3(this);
    });
	</script>	
	<script>
</script>
<script>
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

	function  SendachPAid() {
		var start_date = $('#start_date_paid').val();
		var idsArr = [];
		$(".sub_check_all:checked").each(function() {  
			idsArr.push($(this).attr('value'));
		});
		if(idsArr.length <=0)  
		{
			var strIds = '0';
		}else{
			var strIds = idsArr.join(","); 
		}
		$.ajax({
			url:'{{ URL::route('multiple-ach-paid') }}',
			method: "GET",
			data:{ids: strIds,start_date:start_date,_token:"{{ csrf_token() }}"},
			success: function(response){
				var obj = JSON.parse(response);
				if(obj.success == 1){
					location.reload();
				}
				else{
					iziToast.error({
						title: obj.message,
						position: 'topRight',
						timeout: 3000,
					});
				}
			}         
		});
	}

	function  SendachBounce() {
		var start_date = $('#start_date_bounce').val();
		var bank_id = $('#reg_bank_name').val();
		var idsArr = [];
		$(".sub_check_all:checked").each(function() {  
			idsArr.push($(this).attr('value'));
		});
		if(idsArr.length <=0)  
		{
			var strIds = '0';
		}else{
			var strIds = idsArr.join(","); 
		}
		$.ajax({
			url:'{{ URL::route('multiple-ach-bounce') }}',
			method: "GET",
			data:{ids: strIds,start_date:start_date,bank_id:bank_id,_token:"{{ csrf_token() }}"},
			success: function(response){
				var obj = JSON.parse(response);
				if(obj.success == 1){
					location.reload();
				}
				else{
					iziToast.error({
						title: obj.message,
						position: 'topRight',
						timeout: 3000,
					});
				}
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
							url: "{{ route('multiple-delete-repayment') }}",
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