@extends('elements.admin_master')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader kt-grid__item" id="kt_subheader">
		<div class="row" style="width: 100%;">

			<div class="col-md-6">
				<div class="kt-container  kt-container--fluid ">
					<div class="kt-subheader__main">
						<h3 class="kt-subheader__title">
							Dashboard                            
						</h3>
					</div>
					
					
				</div>
			</div>
				<div class="col-md-6">
					<div class="kt-container  kt-container--fluid ">
						
							
						 <!-- <div class="kt-subheader__wrapper">  -->
						 	@if($employeedetails>0)

							 	<div class="row"  style="width: 100%;">
							 		<div class="col-sm-4 col-md-4">
							 		</div>
							 		<div class="col-sm-4 col-md-4">
							 			<span class="list-title"><a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="in_time" >IN Time</a>
										</span>
										<span class="list-and" id="intime_all">{{ $intimefinal }}</span>
										<input id="intime" type="hidden" value="{{ $intimefinal }}" name="intime" class="form-control">
							 		</div>
							 		<div class="col-sm-4 col-md-4">
							 			<span class="list-title"><a href="#" class="btn btn-brand btn-warning btn-elevate btn-icon-sm" id="out_time" >Out Time</a>
										</span>
										<span class="list-and" id="outtime_all">{{ $outtimefinal }}</span>
										<input id="outtime" type="hidden" value="{{ $outtimefinal }}" name="outtime" class="form-control" onchange="getTotalHours(this.value)">
							 		</div>
							 	</div>

							@endif

						 <!-- </div> -->
					</div>
				</div>
			
		</div>
	</div>
	<!-- end:: Subheader -->        
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		
	</div>
</div>
@endsection
@section('content_js')
<script src="{{ URL::asset('assets/asset/js/dashboard.js') }}" type="text/javascript"></script>
<script >
	$('#in_time').on('click', function(e) {
		$.ajax({
				url:"{{ route('in-time-employee') }}",
				method:"POST",
				async: false,
				data:{_token:"{{ csrf_token() }}"},
				success:function(response)
				{
					var obj = JSON.parse(response);
					$('#intime_all').html(obj.html_data);
					$('#intime').val(obj.html_data);

					
					//fetch_data = obj.html_data;
				}
		});   
	});
	$('#out_time').on('click', function(e) {
		$.ajax({
				url:"{{ route('out-time-employee') }}",
				method:"POST",
				async: false,
				data:{_token:"{{ csrf_token() }}"},
				success:function(response)
				{
					var obj = JSON.parse(response);
					$('#outtime_all').html(obj.html_data);
					$('#outtime').val(obj.html_data);
					if(obj.intimeshowyes != '00:00:00'){

						getTotalHours(obj.html_data);
					}
				}
		});   
	});
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

		if (totalTimeMin == 0) {

			var totalTime = totalTimeHours + ':' + '00';



		}

		else if(totalTimeMin <= '10'){

			var totalTime = totalTimeHours + ':' + '0'+totalTimeMin;

		}

		else{

			var totalTime = totalTimeHours + ':' + totalTimeMin;

		}
		//alert(totalTimeHours);
		var x = 8;

		var y = '00';	

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

		$.ajax({
				url:"{{ route('over-total-hours-employee') }}",
				method:"POST",
				async: false,
				data:{totalTime:totalTime,overTime:overTime,totalTime:totalTime,_token:"{{ csrf_token() }}"},
				success:function(response)
				{
					var obj = JSON.parse(response);
					//$('#outtime_all').html(obj.html_data);
					//$('#outtime').val(obj.html_data);
					//getTotalHours();
					//fetch_data = obj.html_data;
				}
		});   

		//$('#totaltime').val(totalTime);			

		//$('#overtime').val(overTime);		

		//$('#employee_total_hours_monthly').val(totalTime);			

	}
</script>
@endsection
