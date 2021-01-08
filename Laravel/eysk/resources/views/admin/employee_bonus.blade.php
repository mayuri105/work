@extends('elements.admin_master')
@section('content')
<!-- content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">
			<div class="row" style="width: 100%;">
				<div class="col-md-10">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">
								Salary                           
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
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- end:: Subheader -->        
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="margin-top: -25px;">
		<div class="row">		
			<div class="col-lg-12">
				<!--begin::Portlet-->
				<div class="kt-portlet">

					<div class="mtt-body">
						<div class="row">
							<div class="col-sm-4">
								<select class="form-control" name="year_bonus" id="year_bonus">
									<option>SELECT YEAR</option>
									@for($i = 2009;$i<= date('Y');$i++)
										<option value="{{ $i }}">{{ $i }}</option>
									@endfor
								</select>							
							</div>
							<div class="col-sm-4">
								@php 
								$months = array("JANUARY", "FEBRUARY", "MARCH","APRIL","May","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER"); 
								@endphp
								<select class="form-control" name="month_bonus" id="month_bonus">
									<option>SELECT MONTH</option>
									@foreach ($months as $month) 
										<option value="{{ $month }}">{{ $month }}</option>
									@endforeach
								</select>							
							</div>
							<div class="col-sm-4">
								<input type="submit" name="submit" value="  Search  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">								
							</div>
						</div>
						<form action="" enctype="multipart/form-data" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">	
							
							<!--end::Portlet-->
							<div class="kt-portlet sahyognidhi-mtt">
								<div class="row">
									<div class="col-sm-12">	
										<div id="London" class="w3-container city">
											<div class="Half-section-details">
												
												<div class="sahyognidhi-border"></div>
												<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline view_table">
													<thead>
														<tr>
															<th>Employee Name</th>
															<th>Festival Or Occsion</th>
															<th>Bonus Amount</th>
														</tr>
													</thead>
													<tbody>
														
														<tr>
															<td style="width: 150px;">ABC</td>
															<td style="width: 150px;"><input type="text" name="festival_occsion" placeholder="Festival Or Occsion" class="form-control"></td>
															<td style="width: 150px;"><input type="text" name="bonus_amount" placeholder="Bonus Amount" class="form-control"></td>				
														</tr>

													</tbody>
												</table>

											</div>
										</div>
									</div>
								</div>
								<div class="nominee-details-mtt">
									<h3></h3>
									<div class="sahyognidhi-border"></div>
									<div class="form-group1 m-form__group1 row">	
										<label class="col-lg-2 col-form-label"></label>	
										<div class="col-lg-9">
											<div class="kt-portlet__head-toolbar">
												<div class="kt-portlet__head-wrapper">
													<div class="kt-portlet__head-actions">
														<input type="submit" name="submit" value="  Save  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm" style="float: right;margin-right: -130px;margin-top: -30px;">				  						
													</div>
												</div>
											</div>
										</div>
									</div>
								</div> 

							</div>

						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- content end -->
<!--ENd:: Chat-->
@endsection
@section('content_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
	$('#fk_employee_id').select2();
	$('#year_bonus').select2();
	$('#month_bonus').select2();
</script>
@endsection