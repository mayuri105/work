@extends('elements.admin_master',array('accessData'=>$accessData))

@section('content')

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

	<!-- begin:: Subheader -->

	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<div class="kt-subheader kt-grid__item title-main-ktt" id="kt_subheader">

			<div class="kt-container  kt-container--fluid ">

				<div class="kt-subheader__main">

					<h3 class="kt-subheader__title">

						Sahyognidhi Manpower

					</h3>

				</div>

				<div class="kt-subheader__toolbar">

					<div class="kt-subheader__wrapper"></div>

				</div>

			</div>

		</div>

	</div>

	<!-- end:: Subheader -->

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

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

		<div class="row">

			<div class="col-xl-12 col-lg-12 order-lg-1 order-xl-1">

				<div class="kt-portlet kt-portlet--mobile">

					<div class="kt-portlet__head kt-portlet__head--lg">

						<div class="kt-portlet__head-label">

							<span class="kt-portlet__head-icon">

								<i class="kt-font-brand fa fa-users"></i>

							</span>

							<h3 class="kt-portlet__head-title">

								List

							</h3>

						</div>

						 <div class="kt-portlet__head-toolbar">

							<div class="kt-portlet__head-wrapper">

								<div class="kt-portlet__head-actions">

									<a href="{{ route('sahyognidhi-manpower') }}" class="btn btn-clean btn-icon-sm">

										<i class="la la-long-arrow-left"></i>

										Back

									</a>

								</div>

							</div>

						</div>

					</div>

					<div class="kt-portlet__body">

						<div class="table-responsive">

							<table id="example" class="table table-striped table-bordered table-hover">

								<thead>

									<tr>

										<th>Start Year</th>

										<th>End Year</th>

										<th>Drop Ratio</th>

										<th>Admin Charge</th>

										<th>Reserve Funds</th>

										<th>Created Date</th>

										<th style="width: 35%;">Action</th>

									</tr>

								</thead>

								<tbody>

									@foreach($getLastYearAmount as $getLastValue)

										<tr>

											<td>{{ $getLastValue->start_year }}</td>

											<td>{{ $getLastValue->end_year }}</td>

											<td>{{ $getLastValue->drop_ratio_percentage }}</td>

											<td>{{ $getLastValue->admin_charge1 }}</td>

											<td>{{ $getLastValue->reserve_fund_amount }}</td>

											<td>{{ date("d-m-Y",strtotime($getLastValue->created_at1)) }}</td>

											<td style="width: 35%;">

											    @if(in_array('sahyognidhi-manpower-view',$accessData))

												    <a href="{{ route('sahyognidhi-manpower-view-all',$getLastValue->sahyognidhi_manpower_id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit" style="font-size: 25px;"><i class="la la-eye" style="font-size: 20px;"></i></a>

												@endif

												@if(in_array('sahyognidhi-manpower-delete',$accessData))


													<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="m-tooltip" title="" data-original-title="Delete" onclick="deleteShippingOption('{{ $getLastValue->sahyognidhi_manpower_id }}');"><i class="la la-trash-o"></i></a>

													@if($getLastValue->status1 == 1)
														<a href="#"  data-toggle="m-tooltip" title="" data-original-title="Repayment" onclick="getallRepaymentData({{ $getLastValue->sahyognidhi_manpower_id }});getMsgSend()">Generate Repayment</a>
                                                          <a href="#" id="ring"  onclick="getMsgSend(this.value)" ><i class="fa fa-bell" aria-hidden="true"></i></a>
													<div id="msg"></div>
                                                        @endif
												@endif

											</td>

										</tr>

									@endforeach

								</tbody>

							</table>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@endsection

@section('content_js')

<script src="{{ URL::asset('assets/js/dashboard.js') }}" type="text/javascript"></script>

<script src="{{ URL::asset('assets/css/custom/components/base/sweetalert2.js') }}" type="text/javascript"></script>



<script>

	setTimeout(function() { $(".flashmessages").hide('slow'); }, 5000);



	$(document).ready(function() {

		$('#example').DataTable({

			stateSave: true,

			"bDestroy": true,

			"ordering": false

		});

	} );

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







</script>

<script>

	function deleteShippingOption(id){

		swal({

			title: "Are you sure?",

			text: "You want to permanently delete this Sahyognidhi Manpower.",

			type: "warning",

			showCancelButton: !0,

			confirmButtonText: "Yes, delete it!",

			cancelButtonText: "No, cancel!",

			reverseButtons: 0

		}).then(function (e) {

			e.value ? window.location = "delete-sahyognidhi-manpower/"+id+"/delete" : "cancel" === e.dismiss && swal("Cancelled", " Sahyognidhi Manpower is safe.", "error")

		})

	}



</script>



<script>

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

							url: "{{ route('multiple-delete-council') }}",

							type: 'POST',

							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

							data: 'ids='+strIds,

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



	function getallRepaymentData(id){

		$.ajax({

	    		type:'POST',

	    		url:'{{ route('repayment_reg_list') }}',

	    		data:{id:id,_token:"{{ csrf_token() }}"},

	    		success:function(response){

	    			var obj = JSON.parse(response);

	    			if (obj.success == 1) {



	    			}

	    			else{



	    			}



	    		}



	    	});

	}
	function getMsgSend() {
     alert("SMS Going to Send");
       /*  $.ajax({

            type:'POST',

            url:'{{ url('/getsendsms') }}',

            data:{'id':id},

            success:function(data){

             $('#msg').val(data);



            }



        });
 */
 $.ajax({
        url: "{{ url('/getsendsms') }}",
        type: 'post',
        dataType: "json",
        
       data:{_token:"{{ csrf_token() }}"},
        
        success: function( data ) {
         response( data );
        }
       });
    }

</script>

@endsection
