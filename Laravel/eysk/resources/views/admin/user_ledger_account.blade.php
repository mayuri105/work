@extends('elements.user_admin')
@section('content')
<!-- content -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="row" style="width: 100%;">
				<div class="col-md-10">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">
								Ledger Account                           
							</h3>
						</div>
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper"></div>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__toolbar">
							<div class="kt-subheader__wrapper"></div>
						</div>
						<div class="kt-subheader__main">
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->        


	<!-- begin:: Content -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height: 440px;">
		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						Payment Details
					</h3>
				</div>
			</div>

			<div class="main-padding ceparetar">
				<div class="row"> 
				
								
						@if($registrationData->pre_ysk_id != '')
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Ysk Id</span>
								<span class="view-value-text">{{ $registrationData['pre_ysk_id'] }}</span>
							</div>
						</div> 
					 @elseif($registrationData->ysk_id != '') 
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Ysk Id</span>
								<span class="view-value-text"> {{ $registrationData['ysk_id'] }} </span>
							</div>
						</div>
					 @else 
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Processing Id</span>
								<span class="view-value-text"> {{ $registrationData['processing_id'] }} </span>
							</div>
						</div>
					 @endif 

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Member Name</span>
							<span class="view-value-text"> {{ $registrationData['hidden_name_as_per_yuva_sangh_org'] }} </span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Region</span>
							<span class="view-value-text"> {{ $registrationData['region_name'] }}({{ $registrationData['region_code'] }}) </span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Total Received Amount</span>
							<span class="view-value-text"><i class="la la-inr"></i> {{ array_sum($totalAmount) }} </span>
						</div>
					</div>
					
						 <div class="table-responsive" style="margin-top: 10px;">
							<table class="table">
								<thead>
									<tr>
										<th>Date</th>
										<th>Payment Mode</th>
										<th>Credit</th>
										<th>Debit</th>
										 <th>Payment For</th>
										<th>Amount</th> 
									</tr>
								</thead>
								<tbody>
									  @foreach($getAllBankEntryDetails as $getAllBankEntryDetailsData) 
										<tr>
											<td> {{ date('d-m-Y',strtotime($getAllBankEntryDetailsData['payment_date'])) }} </td>
											<td> {{ $getAllBankEntryDetailsData['payment_mode'] }} </td>
											<td> @if($getAllBankEntryDetailsData['payment_type'] == 'Credit'){{ $getAllBankEntryDetailsData['amount'] }} @else ----@endif </td>
											<td> @if($getAllBankEntryDetailsData['payment_type'] == 'Debit'){{ $getAllBankEntryDetailsData['amount'] }} @else ----@endif </td>
											 <td>{{ $getAllBankEntryDetailsData['payment_date'] }}</td>
											 <td>@if($registrationData['aadhar_card_number'] == '' || $registrationData['aadhar_card_number'] == '' || $registrationData['profile_photo'] == '')
											Registration Amount @else Repayment @endif</td>  
										</tr>
									   @endforeach 
								</tbody>
							</table>
						</div>
				</div>
			</div>
			<!--end::Portlet-->
			
		</div>
	</div>
</div>
<!-- content end -->   
@endsection 
