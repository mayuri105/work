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
								View Fix Deposit
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
							<a href="{{ route('fix-deposit') }}">
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
						Fix Deposit Details
					</h3>
				</div>
			</div>


			<div class="main-padding ceparetar">
				<div class="row">
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Date</span>
							<span class="view-value-text">{{ date('d-m-Y',strtotime($viewFixDepositData['date'])) }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Fix Deposit Number</span>
							<span class="view-value-text">{{ $viewFixDepositData['fix_deposit_no'] }}</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Ledger Account</span>
							<span class="view-value-text">

							 {{(new \App\Helpers\Helper)->GetName('\App\LedgerAccountModel','legder_name','ledger_account_id',$viewFixDepositData->fk_ledger_account_id)}}

							</span>
						</div>
					</div>
					<div class="col-sm-3 col-md-3 view-group">
						<div class="view-details-mtt">
							<span class="view-title-kt">Amount</span>
							<span class="view-value-text">{{ $viewFixDepositData['amount_main'] }}</span>
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
				</div
			</div>

			<div class="main-padding ceparetar">
                <input type="hidden" id="fkid" value="{{$fkid}}">
				<table class="table table-bordered">
					<thead>
						<th>Fix Deposit Certificate No</th>
						<th>Fix Deposit Amount</th>
						<th>Fix Deposit Percentage</th>
						<th>Fix Deposit Maturity Date</th>
						<th>Fix Deposit Maturity Amount</th>
						<th>Narration</th>
                        <th>Action</th>
					</thead>
					<tbody>
					    @foreach($viewFixDepositDataDetails as $viewFixDepositDataDetailss)
							<tr>

								<td>{{ $viewFixDepositDataDetailss['fd_certificate_no'] }}</td>
								<td>{{ $viewFixDepositDataDetailss['fd_amount'] }}</td>
								<td>{{ $viewFixDepositDataDetailss['fd_percentage'] }}</td>
								<td>{{ date('d-m-Y',strtotime($viewFixDepositDataDetailss['fd_maturity_date'])) }}</td>
								<td>{{ $viewFixDepositDataDetailss['fd_maturity_amount'] }}</td>
								<td>{{ $viewFixDepositDataDetailss['narration'] }}</td>
                                <td> <a style="font-size:0.75rem" href="#"
                                        onclick="appartmentedit({{$viewFixDepositDataDetailss->fd_certificate_no}})"  class="btn btn-xs btn-info">Withdraw</a></td>
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
{{--edit popu--}}
<div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>
    <!--edit popup-->

@endsection
<script>
function appartmentedit(id) {
  //  alert(id);
var fkid= document.getElementById("fkid").value;
//alert(fkid);
$.ajax({
type: 'post',
url: "{{url('/fixdepositwithdraw')}}",
data: {
'id':id,
    'fkid':fkid,
'_token': "{{csrf_token()}}",
},
success: function(data) {

$('#exampleModalEdit').modal('show');
$('#exampleModalEdit').html(data);
}
});

}
</script>
