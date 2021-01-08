@extends('elements.admin_master',array('accessData'=>$accessData))
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
								View Bank Entry                           
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
							<a href="{{ route('all-bank-entry') }}">
								<i class="la la-long-arrow-left"></i>
								Back
							</a>
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
						All Bank Entry Details
					</h3>
				</div>
			</div>

			
			<div class="main-padding ceparetar">
				<div class="row"> 
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Bank Name</span>
							<span class="view-value-text">{{ $getAllBankEntry['legder_name'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Payment Type</span>
							<span class="view-value-text">{{ $getAllBankEntry['payment_type'] }}</span>
						</div>
					</div>

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Payment Date</span>
							<span class="view-value-text">{{ date("d-m-Y", strtotime($getAllBankEntry['payment_date'])) }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Payment Mode</span>
							<span class="view-value-text">{{ $getAllBankEntry['payment_mode'] }}</span>
						</div>
					</div>


					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Ysk Id</span>
							<span class="view-value-text">@foreach($getAllBankEntryDetails1 as $getAllBankEntryDetailss)@if($getAllBankEntryDetailss['ysk_id'] != ''){{ $getAllBankEntryDetailss['ysk_id'] }} 
							@else {{ $getAllBankEntryDetailss['pre_ysk_id'] }} @endif @endforeach</span>
						</div>
					</div>

					@if($getAllBankEntry->cheque_number != '')
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Cheque Number</span>
								<span class="view-value-text">{{ $getAllBankEntry['cheque_number'] }}</span>
							</div>
						</div>
					@endif

					@if($getAllBankEntry->transaction_id != '')
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Transaction Id</span>
								<span class="view-value-text">{{ $getAllBankEntry['transaction_id'] }}</span>
							</div>
						</div>
					@endif

					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Total Amount</span>
							<span class="view-value-text"><i class="la la-inr"></i>{{ $getAllBankEntry['amount'] }}</span>
						</div>
					</div>

					{{-- <div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Payment For</span>
							<span class="view-value-text">@if($getAllBankEntry['payment_type'] == 'Credit'){{ $getPaymentForCredit['behalf_of_payment'] }}@else @if($getPaymentForDebit['expense_type'] == ''){{ $getAllBankEntry['fk_behalf_of_payment_id'] }} @else {{ $getPaymentForDebit['expense_type'] }} @endif @endif</span>
						</div>
					</div> --}}
					{{-- {{ $getPaymentForDebit['expense_type'] }}  --}}

					@if($getAllBankEntry['details'] != '')
						<div class="col-sm-3 col-md-3 view-group">
							<div class="view-details-mtt">
								<span class="view-title-kt">Payment Details</span>
								<span class="view-value-text">{{ $getAllBankEntry['details'] }}</span>
							</div>
						</div>
					@endif

					@if($getAllBankEntryDetails->toArray() != [])
						<div class="col-sm-9 col-md-9 view-group">
							<div class="kt-title__head">
								<div class="kt-portlet__header">
									<h3 class="title-ktt-view" style="text-align: center;margin-left: 172px;">
										Payment Details
									</h3>
								</div>
							</div>
						</div> 
					@endif

					@if($getAllBankEntryDetails->toArray() != [])
						 <div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>User Name</th>
										<th>Payment Type</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									@foreach($getAllBankEntryDetails as $getAllBankEntryDetailsData)
										<tr>
											<th style="font-weight: 100;">@if($getAllBankEntryDetailsData->fk_registration_id == 0) In YSK Account @else {{ $getAllBankEntryDetailsData->name_as_per_yuva_sangh_org }}@endif</th>
											<td>{{ $getAllBankEntryDetailsData->payment_type }}</td>
											<td>{{ $getAllBankEntryDetailsData->amount }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div> 
					@endif
				</div>
			</div>
			<!--end::Portlet-->
		</div>
	</div>
</div>
<!-- content end -->   
@endsection 
