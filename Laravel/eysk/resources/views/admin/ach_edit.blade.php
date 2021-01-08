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
								Edit ACH                     
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
							<a href="{{ route('ach') }}">
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
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!--begin::Portlet-->
		<form action="{{ route('update-ach') }}" method="POST"> 
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="kt-portlet kt-portlet--tab">
				<div class="kt-title__head">
					<div class="kt-portlet__header">
						<h3 class="title-ktt">
							ACH Details
						</h3>
						@if($editAch['umrn_number'] != '')
							<p class="title-ktt" style="float: right;">
								<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill" style="font-size: 15px;">UMRN Number</span>
								<input type="text" name="umrn_number" placeholder="Enter UMRN Number" value="{{ $editAch['umrn_number'] }}" style="height: 20px;border-radius: 2px;">
							</p>
						@endif
					</div>
				</div>


				<div class="main-padding">
					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">YSK ID
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<select class="form-control kt-select2" id="fk_ysk_id" name="fk_ysk_id" style="width: 100%;">
								<option value="" selected disabled>Select a YSK</option>
								@foreach($yskId as $yskIds)
									<option @if($editAch->fk_ysk_id == $yskIds->ysk_id) selected @endif value="{{ $yskIds->ysk_id }}">{{ $yskIds->name_as_per_yuva_sangh_org }}({{ $yskIds->ysk_id }})</option>
								@endforeach
							</select>
							@if ($errors->has('fk_ysk_id'))
								<span style="color: red;">
									{{ $errors->first('fk_ysk_id') }}
								</span>
							@endif
						</div>
					</div>	

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Region
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<select class="form-control kt-select2" id="fk_region_id" name="fk_region_id" style="width: 100%;">
								<option value="" selected disabled>Select a region</option>
								@foreach($regionName as $regionNames)
								@if($editAch->fk_region_id == $regionNames->region_id)
								<option selected value="{{ $regionNames->region_id }}">{{ $regionNames->region_name }}({{ $regionNames->region_code }})</option>
								@else
								<option value="{{ $regionNames->region_id }}">{{ $regionNames->region_name }}({{ $regionNames->region_code }})</option>
								@endif
								@endforeach
							</select>
							@if ($errors->has('fk_region_id'))
							<span style="color: red;">
								{{ $errors->first('fk_region_id') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Yuva Mandal Name
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<select class="form-control kt-select2" id="fk_yuva_mandal" name="yuva_mandal_number_id" style="width: 100%;">
								<option value="" selected disabled>Select a Yuva Mandal</option>
								@foreach($yuvaMandalName as $yuvaMandals)
									@if($editAch->fk_yuva_mandal == $yuvaMandals->yuva_mandal_number_id)
										<option selected value="{{ $yuvaMandals->yuva_mandal_number_id }}">{{ $yuvaMandals->yuva_mandal_number }}</option>
									@else
										<option value="{{ $yuvaMandals->yuva_mandal_number_id }}">{{ $yuvaMandals->yuva_mandal_number }}</option>
									@endif
								@endforeach 
							</select>
							@if ($errors->has('yuva_mandal_number_id'))
							<span style="color: red;">
								{{ $errors->first('yuva_mandal_number_id') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">City
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<input type="text" name="city_name" placeholder="Enter City" value="{{ $editAch['city_name'] }}" class="form-control" aria-describedby="emailHelp">
							@if ($errors->has('city_name'))
							<span style="color: red;">
								{{ $errors->first('city_name') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Name As Per Yuva Sangh Org 
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<input type="text" name="name_as_per_yuva_sangh_org" placeholder="Enter Name" value="{{ $editAch['name_as_per_yuva_sangh_org'] }}" class="form-control" aria-describedby="emailHelp">
							@if ($errors->has('name_as_per_yuva_sangh_org'))
							<span style="color: red;">
								{{ $errors->first('name_as_per_yuva_sangh_org') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Phone Number
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<input type="text" class="form-control" placeholder="Enter Phone Number" name="phone_number" value="{{ $editAch['phone_number'] }}" aria-describedby="emailHelp">
							@if ($errors->has('phone_number'))
							<span style="color: red;">
								{{ $errors->first('phone_number') }}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group1 m-form__group1 row">	
						<label class="col-lg-2 col-form-label">Apply Date
							<span class="text-danger">*</span>
						</label>	
						<div class="col-lg-9">
							<input type="text" class="form-control" id="apply_date" placeholder="Enter Apply Date" name="apply_date" aria-describedby="emailHelp" value="{{ date('d-m-Y',strtotime($editAch['apply_date'])) }}">
							@if ($errors->has('apply_date'))
							<span style="color: red;">
								{{ $errors->first('apply_date') }}
							</span>
							@endif
						</div>
					</div>

						<div class="form-group1 m-form__group1 row">	
							<label class="col-lg-2 col-form-label">Bank Name
								<span class="text-danger">*</span></label>	
								<div class="col-lg-9">
								    <input type="text" class="form-control" placeholder="Enter Bank Name" name="fk_bank_id" aria-describedby="emailHelp" value="{{ $editAch['fk_bank_id'] }}">
									<!--<select class="form-control kt-select2" id="fk_bank_id" name="fk_bank_id" style="width: 100%;">
										<option value="" selected disabled>Select bank name</option>
										@foreach($bankName as $bankNames)
											@if($editAch->fk_bank_id == $bankNames->ledger_account_id)
												<option  selected value="{{ $bankNames->ledger_account_id }}">{{ $bankNames->legder_name }}</option>
											@else
												<option value="{{ $bankNames->ledger_account_id }}">{{ $bankNames->legder_name }}</option>
											@endif
										@endforeach
									</select>-->
									@if ($errors->has('fk_bank_id'))
										<span style="color: red;">
											{{ $errors->first('fk_bank_id') }}
										</span>
									@endif
								</div>
							</div>

							<div class="form-group1 m-form__group1 row">	
								<label class="col-lg-2 col-form-label">Bank Account Number
									<span class="text-danger">*</span>
								</label>	
								<div class="col-lg-9">
									<input type="text" class="form-control" placeholder="Enter Bank Account Number" value="{{ $editAch['bank_account_number'] }}" name="bank_account_number" aria-describedby="emailHelp">
									@if ($errors->has('bank_account_number'))
										<span style="color: red;">
											{{ $errors->first('bank_account_number') }}
										</span>
									@endif
								</div>
							</div>

							<div class="form-group1 m-form__group1 row">	
								<label class="col-lg-2 col-form-label"> IFSC Code
									<span class="text-danger">*</span></label>	
									<div class="col-lg-9">
										<input type="text" class="form-control" placeholder="Enter IFSC Code" value="{{ $editAch['ifsc_code'] }}" name="ifsc_code" aria-describedby="emailHelp">
										@if ($errors->has('ifsc_code'))
											<span style="color: red;">
												{{ $errors->first('ifsc_code') }}
											</span>
										@endif
									</div>
								</div>

								<div class="form-group1 m-form__group1 row">	
									<label class="col-lg-2 col-form-label">MICR Code
									</label>	
									<div class="col-lg-9">
										<input type="text" class="form-control" placeholder="Enter MICR Code" value="{{ $editAch['micr_code'] }}" name="micr_code" aria-describedby="emailHelp">
										@if ($errors->has('micr_code'))
											<span style="color: red;">
												{{ $errors->first('micr_code') }}
											</span>
										@endif
									</div>
								</div>

								<div class="form-group1 m-form__group1 row">	
									<label class="col-lg-2 col-form-label">Ach Limit
										<span class="text-danger">*</span>
									</label>	
									<div class="col-lg-9">
										<input type="text" class="form-control" placeholder="Enter Ach Limit" value="{{ $editAch['ach_limit'] }}" name="ach_limit" aria-describedby="emailHelp">
										@if ($errors->has('ach_limit'))
											<span style="color: red;">
												{{ $errors->first('ach_limit') }}
											</span>
										@endif
									</div>
								</div>
 
								</div>
								<input type="hidden" name="editId" value="{{ $editAch['ach_id'] }}">

								<div class="kt-title__head">
									<div class="kt-portlet__header">
									</div>
								</div>

								<div class="main-padding">
									<div class="form-group1 m-form__group1 row">	
										<label class="col-lg-2 col-form-label"></label>	
										<div class="col-lg-9">
											<div class="kt-portlet__head-toolbar">
												<div class="kt-portlet__head-wrapper">
													<div class="kt-portlet__head-actions">
														<input type="submit" name="submit" value="  Edit  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">
														<a href="{{ route('ach') }}" class="btn-cancel-registration">Cancel</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<!--end::Portlet-->
						</div>
					</div>
					<!-- content end -->    
					<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<!-- registration date table -->
		<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet kt-portlet--mobile">
				<div class="kt-portlet__head kt-portlet__head--lg">

					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							UMRN Status
						</h3>
					</div>

					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions"> </div>
						</div>
					</div>
				</div>
				
					<div class="kt-portlet__body">
							<!--begin: Datatable -->
							<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
								<div class="row">
									<div class="col-sm-12">
									
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Reason</th>
													<th>Created Date</th>
												</tr>
											</thead>
											<tbody>
											    
												<tr>
												   
													<td> @for($i = 0;$i<count($explodeReason);$i++) {{ $explodeReason[$i] }}<br></count> @endfor</td>
													
													<td>@for($i = 0;$i<count($explodeDate);$i++) @if($explodeDate[$i] != '0000-00-00') {{ date('d-m-Y',strtotime($explodeDate[$i])) }} @else 00-00-0000  @endif <br>@endfor</td>
												</tr>
												
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
					<!--ENd:: Chat-->
					@endsection
@section('content_js')
<script>
	$("#fk_ysk_id").select2();
	$("#fk_bank_id").select2();
	$("#fk_region_id").select2();
	$("#fk_yuva_mandal").select2();
</script>
@endsection