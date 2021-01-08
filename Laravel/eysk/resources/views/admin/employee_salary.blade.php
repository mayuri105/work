@extends('elements.admin_master',array('accessData'=>$accessData))

@section('content')

<!-- content -->

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Subheader -->

	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">

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

					<form action="{{ route('save-employee-salary') }}" enctype="multipart/form-data" method="POST">

							<input type="hidden" name="_token" value="{{csrf_token()}}">

					<div class="mtt-body">

						<div class="row">

							<div class="col-sm-3">

								<select class="form-control" id="fk_employee_id" name="fk_employee_id" onchange="getThisMonthData(this.value)">

									<option>Select Employee</option>

									@foreach($employeeRegistrationData as $employeeRegistrationDatas)

										<option value="{{ $employeeRegistrationDatas->employee_registration_id }}">{{ $employeeRegistrationDatas->employee_name }}</option>

									@endforeach

								</select>							

							</div>

							<div class="col-sm-3">

								<input type="text" name="start_date" id="start_date" placeholder="START DATE" class="form-control">								

							</div>

							<div class="col-sm-3">

								<input type="text" name="end_date" id="end_date" placeholder="END DATE" class="form-control">								

							</div>

							@if(in_array('view-employee-salary',$accessData))

    							<div class="col-sm-3">

    								<input type="submit" name="submit" value="  Search  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">								

    							</div>

    						@endif

						</div>

							

							

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

															<th>Date</th>

															<th>Employee Name</th>

															<th>Intime</th>

															<th>Outtime</th>

															<th>Total Time</th>

															<th>Over Time</th>

														</tr>

													</thead>

													<tbody>

														

														<tr>

															<td style="width: 150px;"><input type="text" name="today_date" id="today_date" value="0000-00-00" onchange="getThisMonthDatachanges(this.value)" style="border-style: none;"></td>

															<td style="width: 150px;"><input type="text" name="employee_name" id="employee_name" value="" style="border-style: none;"></td>

															<td style="width: 150px;"><a onclick="timeNow(intime)" href="#"></a>

																<input id="intime" type="time" value=" " name="intime" class="form-control">{{-- <input type="text" name="intime" placeholder="IN TIME" class="form-control" --}}</td>

															<td style="width: 150px;"><a onclick="timeNow(outtime)" href="#"></a>

																<input id="outtime" type="time" value=" " name="outtime" class="form-control" onchange="getTotalHours(this.value)">{{-- <input type="text" name="outtime" placeholder="OUT TIME" class="form-control" onchange="getTotalHours()"> --}}</td>

															<td style="width: 150px;"><input type="text" name="totaltime" id="totaltime" class="form-control" placeholder="TOTAL TIME"></td>

															<td style="width: 150px;"><input type="text" name="overtime" id="overtime" class="form-control" placeholder="OVER TIME"></td>

														</tr>



													</tbody>

												</table>



											</div>

										</div>

									</div>

								</div>

								<div class="row">

									<div class="col-sm-4">

										<p><span>Total Hours(Monthly)</span></p>									

										<input type="text" name="total_hours_monthly" id="total_hours_monthly" value="0" style="border-style: none;">										

									</div>

									<div class="col-sm-4">

										<p><span>Total Hours</span></p>									

										<input type="text" name="employee_total_hours_monthly" id="employee_total_hours_monthly" value="0" style="border-style: none;">

									</div>

									<div class="col-sm-4">

										<p><span>Total Employee Hours(Monthly)</span></p>									

										<input type="text" name="employee_monthly_hours" id="employee_monthly_hours" value="0" style="border-style: none;">

									</div>

								</div>



								<div class="row" style="margin-top: 10px;">

									<div class="col-sm-6">

										<p><span>Per Month Salary</span></p>									

										<input type="text" name="actual_salary" id="actual_salary" value="0" style="border-style: none;">										

									</div>

									<div class="col-sm-6">

										<p><span>Current Month Salary</span></p>									

										<input type="text" name="current_salary" class="form-control" placeholder="Current Salary">

									</div>

									{{-- <div class="col-sm-2">								

										<input type="submit" name="submit" value="  Save  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm" style="float: right;margin-top: 25px;">

									</div> --}}

								</div>

								<div class="row" style="margin-top: 10px;">

									<div class="col-sm-6">

										<p><span>Narration / Festival</span></p>									

										<textarea class="form-control" name="narration_or_festival" id="narration_or_festival">{{ old('narration_or_festival') }}</textarea>										

									</div>

									<div class="col-sm-6">

										<p><span>Amount</span></p>									

										<input type="text" name="bonus_amount" class="form-control" placeholder="Bonus Amount">

									</div>

								</div>

								<div class="row">

									<div class="col-sm-12">

										<input type="submit" name="submit" value="  Save  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm" style="float: right;margin-top: 25px;">

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

<script>setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);	</script>

<script>

	$('#fk_employee_id').select2();

	$('#start_date').mask('00-00-0000');

	$('#end_date').mask('00-00-0000');

</script>

<script>

	function getThisMonthData(value) {

		$.ajax({

			url: '{{ route('get-data-by-employee') }}',

			type: 'POST',

			data: {fk_employee_id: value,_token:"{{ csrf_token() }}"},

			success:function (response) {

				var obj = JSON.parse(response);

				if (obj.success == 1) {

					$('#today_date').val(obj.todayDate);

					$('#employee_name').val(obj.employeeName);

					$('#total_hours_monthly').val(obj.totalHoursMonthly);

					$('#actual_salary').val(obj.salary);
					if(obj.totalTimeForEmployee == '0:00')
					{
						$('#employee_monthly_hours').val('');
					}else{

						$('#employee_monthly_hours').val(obj.totalTimeForEmployee);
					}
					if(obj.intime == '00:00:00'){
						$('#intime').css('border-color', 'red');
						$('#intime').val('');
						//document.getElementsByTagName('intime')[0].style.border = "red";
						//document.getElementsByTagName('intime')[0].style.borderWidth = "1px";
					}else{
						$('#intime').css('border-color', 'black');
						$('#intime').val(obj.intime);
					}
					if(obj.outtime == '00:00:00'){
						$('#outtime').css('border-color', 'red');
						$('#outtime').val('');
					}else{
						$('#outtime').css('border-color', 'black');
						$('#outtime').val(obj.outtime);
					}
					if(obj.total_time == '00:00:00'){
						$('#totaltime').val('');
					}else{
						
						$('#totaltime').val(obj.total_time);
					}
					if(obj.over_time == '00:00:00'){
						$('#overtime').val('');
					}else{
						
						$('#overtime').val(obj.over_time);
					}
					


				}

			}

		})

		

	}

	function getThisMonthDatachanges(dateas) {
		//alert(dateas);
		var fk_employee_id = $('#fk_employee_id').val();
		$.ajax({

			url: '{{ route('get-data-by-employee-changes') }}',

			type: 'POST',

			data: {fk_employee_id:fk_employee_id,dateas:dateas,_token:"{{ csrf_token() }}"},

			success:function (response) {

				var obj = JSON.parse(response);

				if (obj.success == 1) {

					$('#today_date').val(obj.todayDate);

					$('#employee_name').val(obj.employeeName);

					$('#total_hours_monthly').val(obj.totalHoursMonthly);

					$('#actual_salary').val(obj.salary);
					if(obj.totalTimeForEmployee == '0:00')
					{
						$('#employee_monthly_hours').val('');

					}else{

						$('#employee_monthly_hours').val(obj.totalTimeForEmployee);
						
					}
					if(obj.intime == '00:00:00'){
						$('#intime').css('border-color', 'red');
						$('#intime').val('');
						//document.getElementsByTagName('intime')[0].style.border = "red";
						//document.getElementsByTagName('intime')[0].style.borderWidth = "1px";
					}else{

						$('#intime').val(obj.intime);
						$('#intime').css('border-color', 'black');
					}
					if(obj.outtime == '00:00:00'){
						$('#outtime').css('border-color', 'red');
						$('#outtime').val('');

					}else{
						$('#outtime').val(obj.outtime);
						$('#outtime').css('border-color', 'black');
					}
					if(obj.total_time == '00:00:00'){
						
						$('#totaltime').val('');
					}else{
						
						$('#totaltime').val(obj.total_time);
					}
					if(obj.over_time == '00:00:00'){
						$('#overtime').val('');
					}else{
						
						$('#overtime').val(obj.over_time);
					}
					


				}

			}

		})

		

	}

	function timeNow(i) {

		var d = new Date(),

		h = (d.getHours()<10?'0':'') + d.getHours(),

		m = (d.getMinutes()<10?'0':'') + d.getMinutes();

		i.value = h + ':' + m;

	}

	function getTotalHours(value) {

		var intime = $('#intime').val();

		var outtime = $('#outtime').val();

		var hoursOuttime = value.split(':');

		var actualOuttimeHours = hoursOuttime[0];

		var actualOuttimeMin = hoursOuttime[1];

		var hoursIntime = intime.split(':');

		var actualIntimeHours = hoursIntime[0];

		var actualIntimeMin = hoursIntime[1];

		var totalTimeHours = Math.abs(actualOuttimeHours - actualIntimeHours);

		var totalTimeMin =  Math.abs(actualOuttimeMin - actualIntimeMin);
		//alert(totalTimeHours);
		if (totalTimeMin == 0) {

			var totalTime = totalTimeHours + ':' + '00';



		}

		else if(totalTimeMin <= '10'){

			var totalTime = totalTimeHours + ':' + '0'+totalTimeMin;

		}

		else{

			var totalTime = totalTimeHours + ':' + totalTimeMin;

		}

		var x = 8;

		var y = '00';	
		//alert(actualOuttimeHours);
		if (totalTimeHours >= x) {

			var overTimeHours = totalTimeHours - x;

			var overTimeMin = totalTimeMin;

			if (overTimeMin == '00') {

				var overTime = overTimeHours + ':' + '00';

			}

			else if(overTimeMin <= '10'){

				var overTime = overTimeHours + ':' + '0'.overTimeMin;

			}

			else{

				var overTime = overTimeHours + ':' + overTimeMin;

			}

		//alert(overTimeMin);

		}

		$('#totaltime').val(totalTime);			

		$('#overtime').val(overTime);		

		$('#employee_total_hours_monthly').val(totalTime);			

	}

</script>

@endsection