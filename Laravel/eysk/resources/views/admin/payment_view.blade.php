@extends('elements.admin_master')
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
								View Payment                          
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
							<a href="{{ route('payment') }}">
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
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" >
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
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Date</span>
							<span class="view-value-text">{{ date('d-m-Y',strtotime($viewPaymentData['date'])) }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Payment Number</span>
							<span class="view-value-text">{{ $viewPaymentData['payment_no'] }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Ledger Account</span>
							<span class="view-value-text"> 
							@if($viewPaymentData->type_account_main == '1')
							 {{(new \App\Helpers\Helper)->GetName('\App\LedgerAccountModel','legder_name','ledger_account_id',$viewPaymentData->fk_ledger_account_id_main)}}
							@else
							 {{(new \App\Helpers\Helper)->GetName('\App\RegistrationModel','name_as_per_yuva_sangh_org','registration_id',$viewPaymentData->fk_ledger_account_id_main)}}
							@endif
							</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Transaction Type</span>
							<span class="view-value-text">{{ $viewPaymentData['transaction_type_main'] }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Amount</span>
							<span class="view-value-text">{{ $viewPaymentData['amount_main'] }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Narration</span>
							<span class="view-value-text">{{ $viewPaymentData['narration_main'] }}</span>
						</div>
					</div>

				</div>
				
				
			</div>
			<!--end::Portlet-->
		</div>
	</div>

	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height: 440px;">
		<!--begin::Portlet-->
		<div class="kt-portlet kt-portlet--tab">
			<div class="kt-title__head">
				<div class="kt-portlet__header">
					<h3 class="title-ktt-view">
						Details
					</h3>
				</div>
			</div>
			
			<div class="main-padding ceparetar">
				<table class="table table-bordered">
					<thead>
						<th>Ledger Account</th>
						<th>Transaction Type </th>
						<th>Amount</th>
						<th>Narration</th>
					</thead>
					<tbody>
					    @foreach($viewPaymentDataDetails as $viewPaymentDataDetailss)
							<tr>
								<td>{{ $viewPaymentDataDetailss['legder_name'] }}
								    @if($viewPaymentDataDetailss->type_account == '1')
        							 {{(new \App\Helpers\Helper)->GetName('\App\LedgerAccountModel','legder_name','ledger_account_id',$viewPaymentDataDetailss->fk_ledger_account_id)}}
        							@else
        							 {{(new \App\Helpers\Helper)->GetName('\App\RegistrationModel','name_as_per_yuva_sangh_org','registration_id',$viewPaymentDataDetailss->fk_ledger_account_id)}}
        							@endif
								
								</td>
								<td>{{ $viewPaymentDataDetailss['transaction_type'] }}</td>
								<td>{{ $viewPaymentDataDetailss['amount'] }}</td>
								<td>{{ $viewPaymentDataDetailss['narration'] }}</td>
								
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!--end::Portlet-->
		</div>
	</div>
</div>
<!-- content end -->   
@endsection 
