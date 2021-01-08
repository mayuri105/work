@extends('elements.admin_master')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<style type="text/css" media="screen">

	input[type="file"] {

		display: block;

	}

	.imageThumb {

		max-height: 75px;

		border: 2px solid;

		padding: 1px;

		cursor: pointer;

	}

	.pip {

		display: inline-block;

		margin: 10px 10px 0 0;

	}

	.remove {

		display: block;

		background: #444;

		border: 1px solid black;

		color: white;

		text-align: center;

		cursor: pointer;

	}

	.remove:hover {

		background: white;

		color: black;

	}

</style>

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

								Add Employee Registration                            

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

							<a href="{{ route('employee-registration') }}">

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

	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<div class="row">		

			<div class="col-lg-12">

				<!--begin::Portlet-->

				<div class="kt-portlet">



					<div class="mtt-body">

						<form action="{{ route('save-employee-registration') }}" enctype="multipart/form-data" method="POST">

							<input type="hidden" name="_token" value="{{csrf_token()}}">											

							<!--end::Portlet-->

							<div class="kt-portlet sahyognidhi-mtt">

								<div class="row">

									<div class="col-sm-12">	

										<div id="London" class="w3-container city">

											<div class="Half-section-details">											



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Joining Date<span class="text-danger">*</span></label>

													<div class="col-lg-9">

														<input type="text" id="joining_date" name="joining_date" class="form-control" placeholder="ENTER JOINING DATE" >

														@if ($errors->has('joining_date'))

														<span style="color: red;">

															{{ $errors->first('joining_date') }}

														</span>

														@endif

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Employee Number<span class="text-danger">*</span></label>

													<div class="col-lg-9">

														<input type="text" id="employee_number" name="employee_number" class="form-control" placeholder="ENTER EMPLOYEE NUMBER" value="{{ $expldEmployeeId.'-'.$autoIncrement }}" readonly="">

														@if ($errors->has('employee_number'))

														<span style="color: red;">

															{{ $errors->first('employee_number') }}

														</span>

														@endif

													</div>

												</div>





												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Name<span class="text-danger">*</span></label>

													<div class="col-lg-9">

														<input type="text" class="form-control" name="employee_name" placeholder="ENTER EMPLOYEE NAME" value="{{ old('employee_name') }}" style="text-transform: uppercase;">

														@if ($errors->has('employee_name'))

														<span style="color: red;">

															{{ $errors->first('employee_name') }}

														</span>

														@endif

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Email<span class="text-danger">*</span></label>

													<div class="col-lg-9">

														<input type="text" id="employee_email" name="employee_email" class="form-control" placeholder="ENTER EMPLOYEE EMAIL" >

														@if ($errors->has('employee_email'))

														<span style="color: red;">

															{{ $errors->first('employee_email') }}

														</span>

														@endif

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Password<span class="text-danger">*</span></label>

													<div class="col-lg-9">

														<input type="text" id="employee_password" name="employee_password" class="form-control" placeholder="ENTER EMPLOYEE PASSWORD" >

														@if ($errors->has('employee_password'))

														<span style="color: red;">

															{{ $errors->first('employee_password') }}

														</span>

														@endif

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Contact Number<span class="text-danger">*</span></label>	

													<div class="col-lg-5">

														<input type="text" class="form-control" aria-describedby="emailHelp" id="employee_first_phone_number" name="employee_first_phone_number" placeholder="ENTER EMPLOYEE CONATCT NUMBER" >

														@if ($errors->has('employee_first_phone_number'))

														<span style="color: red;">

															{{ $errors->first('employee_first_phone_number') }}

														</span>

														@endif

													</div>

													<div class="col-lg-5">

														<input type="text" class="form-control" aria-describedby="emailHelp" id="employee_second_phone_number" name="employee_second_phone_number" placeholder="ENTER EMPLOYEE CONATCT NUMBER" >

														@if ($errors->has('employee_second_phone_number'))

														<span style="color: red;">

															{{ $errors->first('employee_second_phone_number') }}

														</span>

														@endif

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Address

													</label>	

													<div class="col-lg-9">

														<textarea class="form-control" name="employee_address" placeholder="ENTER EMPLOYEE ADDRESS" style="text-transform: uppercase;">{{ old('employee_address') }}</textarea>

														@if ($errors->has('employee_address'))

														<span style="color: red;">

															{{ $errors->first('employee_address') }}

														</span>

														@endif

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Timing<span class="text-danger">*</span>	

													</label>	

													<div class="col-lg-4">

														<label>AM</label>

														<input type="time" class="form-control" aria-describedby="emailHelp" id="timing_am" name="timing_am" value="10:00" placeholder="ENTER START TIME" >

													</div>

													<div class="col-lg-4">

														<label>PM</label>

														<input type="time" class="form-control" aria-describedby="emailHelp" id="timing_pm" name="timing_pm" value="18:00" placeholder="ENTER END TIME" >

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Govt. Document<span class="text-danger">*</span>	

													</label>	

													<div class="col-lg-9 imageBox">

														<input type="file" class="form-control profile-height" id="employee_govt_document" onchange="validDivangatImage()" aria-describedby="emailHelp" name="employee_govt_document[]" multiple>

														<br>

														<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.

														be no cropping and filtering facility available.</small>

														<br>

														<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError1"> </span>

														<div class="gallery"></div>

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Resume<span class="text-danger">*</span>	

													</label>	

													<div class="col-lg-9 imageBox">

														<input type="file" class="form-control profile-height" id="employee_resume" onchange="employeeResume()" aria-describedby="emailHelp" name="employee_resume[]" multiple>

														<br>

														<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.

														be no cropping and filtering facility available.</small>

														<br>

														<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError"> </span>

														<div class="gallery"></div>

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Narration

													</label>	

													<div class="col-lg-9">

														<textarea class="form-control" name="employee_details" placeholder="ENTER EMPLOYEE DETAILS" style="text-transform: uppercase;">{{ old('employee_details') }}</textarea>

													</div>

												</div>	



												<div class="form-group1 m-form__group1 row details">	

													<label class="col-lg-2 col-form-label">Salary

														<span class="text-danger">*</span>

													</label>

													<div class="registration-list-modal">

														<div class="row" style="width: 152%;padding-left: 10px;">	

															<div class="col-lg-3">	

																<label>Salary</label>

																<div>

																	<input type="text" class="form-control" aria-describedby="emailHelp" id="salary" name="salary[]" placeholder="ENTER EMPLOYEE SALARY" >



																</div>		

																@if ($errors->has('salary'))

																<span style="color: red;">

																	{{ $errors->first('salary') }}

																</span>

																@endif	

															</div>

															<div class="col-lg-3" style="padding-left: 40px;">

																<label>Start Date</label>	

																<input type="text" class="form-control" aria-describedby="emailHelp" id="start_date1" name="start_date[]" placeholder="ENTER START DATE" >

																@if ($errors->has('start_date'))

																<span style="color: red;">

																	{{ $errors->first('start_date') }}

																</span>

																@endif

															</div>



															<div class="col-lg-3" style="padding-left: 40px;">

																<label>End Date</label>	

																<input type="text" class="form-control" aria-describedby="emailHelp" id="end_date1" name="end_date[]" placeholder="ENTER END DATE" >

																@if ($errors->has('end_date'))

																<span style="color: red;">

																	{{ $errors->first('end_date') }}

																</span>

																@endif

															</div>

															<div class="col-lg-2" style="margin-top: 34px;">

																<a href="javascript:void(0);" class="nominee-details-add add_button" title="Add field"><i class="la la-plus"></i></a>

															</div> 

														</div>

														<div class="field_wrapper">



														</div>

												{{-- <div class="col-lg-2" style="margin-top: 39px;margin-left: 730px;">

													<a href="javascript:void(0);" class="nominee-details-add add_button" title="Add field"><i class="la la-plus"></i></a>

												</div> --}}

											</div>

										</div> 



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Completion Date<span class="text-danger">*</span>	

													</label>	

													<div class="col-lg-9">

														<input type="text" class="form-control" aria-describedby="emailHelp" id="completion_date" name="completion_date" placeholder="ENTER COMPLETION DATE" >

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Completion Document<span class="text-danger">*</span>	

													</label>	

													<div class="col-lg-9 imageBox">

														<input type="file" class="form-control profile-height" id="completion_document" onchange="completionDocument()" aria-describedby="emailHelp" name="completion_document[]" multiple>

														<br>

														<small>The photo should be simple <strong>JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.

														be no cropping and filtering facility available.</small>

														<br>

														<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError"> </span>

														<div class="gallery"></div>

													</div>

												</div>



												<div class="form-group1 m-form__group1 row">	

													<label class="col-lg-2 col-form-label">Designation<span class="text-danger">*</span></label>

													<div class="col-lg-9">

														<select class="form-control" id="fk_role_id" name="fk_role_id" onchange="assignPermission(this.value)">

															<option selected value="">SELECT DESIGNATION</option>

															@foreach($roleData as $roleDatas)

															<option value="{{ $roleDatas->role_id }}">{{ $roleDatas->name }}</option>

															@endforeach

														</select>

													</div>

												</div>



												<div class="form-group m-form__group row assign_permission" style="display: none;">

													<label class="col-lg-2 col-form-label">Assign Permission  <storage class="text-danger">*</storage></label>													

													<div class="col-lg-10" id="assignRolePermission">

														

														

														

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

																<input type="submit" name="submit" value="  Add  " class="btn btn-brand btn-warning btn-elevate btn-icon-sm">

																<a href="{{ route('employee-registration') }}" class="btn-cancel-registration">Cancel</a>

															</div>

														</div>

													</div>

												</div>

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
	function checkAll(ele) {
		var ischecked= $('.add_class_'+ele).is(':checked');
		//alert(ele);
		if(ischecked == true){
			$('.add_class_sub_'+ele).prop('checked', true);
		}
		else{
			$('.add_class_sub_'+ele).prop('checked', false);
		}
	}
	function checkSubCheckbox(ele,parentPageId) {
		var ischecked = $('#pages'+ele).is(':checked');
		//alert(ele);
		if(ischecked == false){
			$('.add_class_'+parentPageId).prop('checked', false);
		}
		else{
			if($('.add_class_sub_'+parentPageId+':checked').length == $('.add_class_sub_'+parentPageId).length){
				$('.add_class_'+parentPageId).prop('checked',true);
			}
		}
	}
</script>

<script>

	$('#completion_date').mask('00-00-0000');

	$('#joining_date').mask('00-00-0000');

	$('#start_date1').mask('00-00-0000');

	$('#end_date1').mask('00-00-0000');

	function validDivangatImage(argument) {

		var formData = new FormData();

		var file = document.getElementById('employee_govt_document').files[0];

		formData.append("Filedata", file);

		var t = file.type.split('/').pop().toLowerCase();

		if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {

			$("#imgError1").html("Extension File is Not Valid");

			$("#imgError1").css("display", "block");

			document.getElementById("employee_govt_document").value = '';

			return false;

		}

		if (t == "jpeg" && t == "jpg" && t == "png" && t == "bmp" && t == "gif" && t == "pdf") {

			$("#imgError1").hide();

		}

		if (Math.round(file.size/1024) > 500) {

			$("#imgError1").html("Max Upload size is 500kb only");

			$("#imgError1").css("display", "block");

			document.getElementById("employee_govt_document").value = '';

			return false;

		}

		else{

			$("#imgError1").hide();

		}



		return true;

	}





	$(document).ready(function() {

		if (window.File && window.FileList && window.FileReader) {

			$("#employee_govt_document").on("change", function(e) {

				var fp = $("#employee_govt_document");

				var items = fp[0].files;

				var files = e.target.files,

				filesLength = files.length;

				for (var i = 0; i < filesLength; i++) {

					var t = items[i].type.split('/').pop().toLowerCase();

					var f = files[i]

					var name = "http://eysk.org/assets/img/pdf.png";

					var fileReader = new FileReader();

					if (t != 'pdf'){

						fileReader.onload = (function(e) {

							var file = e.target;		          	

							$("<span class=\"pip\">" +

								"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +

								"<br/><span class=\"remove\">Remove image</span>" +

								"</span>").insertAfter("#employee_govt_document");

							$(".remove").click(function(){

								$(this).parent(".pip").remove();

							});



						});

					}

					else{

						fileReader.onload = (function(e) {

							var file = e.target;		          	

							$("<span class=\"pip\">" +

								"<img class=\"imageThumb\" src=\"" + name + "\" title=\"" + file.name + "\"/>" +

								"<br/><span class=\"remove\">Remove image</span>" +

								"</span>").insertAfter("#employee_govt_document");

							$(".remove").click(function(){

								$(this).parent(".pip").remove();

							});



						});

					}

					fileReader.readAsDataURL(f);

				}

			});

		} else {

			alert("Your browser doesn't support to File API")

		}

	});

</script>

<script>

	function employeeResume(argument) {

		var formData = new FormData();

		var file = document.getElementById('employee_resume').files[0];

		formData.append("Filedata", file);

		var t = file.type.split('/').pop().toLowerCase();

		if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {

			$("#imgError").html("Extension File is Not Valid");

			$("#imgError").css("display", "block");

			document.getElementById("employee_resume").value = '';

			return false;

		}

		if (t == "jpeg" && t == "jpg" && t == "png" && t == "bmp" && t == "gif" && t == "pdf") {

			$("#imgError").hide();

		}

		if (Math.round(file.size/1024) > 500) {

			$("#imgError").html("Max Upload size is 500kb only");

			$("#imgError").css("display", "block");

			document.getElementById("employee_resume").value = '';

			return false;

		}

		else{

			$("#imgError").hide();

		}



		return true;

	}





	$(document).ready(function() {

		if (window.File && window.FileList && window.FileReader) {

			$("#employee_resume").on("change", function(e) {

				var fp = $("#employee_resume");

				var items = fp[0].files;

				var files = e.target.files,

				filesLength = files.length;

				for (var i = 0; i < filesLength; i++) {

					var t = items[i].type.split('/').pop().toLowerCase();

					var f = files[i]

					var name = "http://eysk.org/assets/img/pdf.png";

					var fileReader = new FileReader();

					if (t != 'pdf'){

						fileReader.onload = (function(e) {

							var file = e.target;		          	

							$("<span class=\"pip\">" +

								"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +

								"<br/><span class=\"remove\">Remove image</span>" +

								"</span>").insertAfter("#employee_resume");

							$(".remove").click(function(){

								$(this).parent(".pip").remove();

							});



						});

					}

					else{

						fileReader.onload = (function(e) {

							var file = e.target;		          	

							$("<span class=\"pip\">" +

								"<img class=\"imageThumb\" src=\"" + name + "\" title=\"" + file.name + "\"/>" +

								"<br/><span class=\"remove\">Remove image</span>" +

								"</span>").insertAfter("#employee_resume");

							$(".remove").click(function(){

								$(this).parent(".pip").remove();

							});



						});

					}

					fileReader.readAsDataURL(f);

				}

			});

		} else {

			alert("Your browser doesn't support to File API")

		}

	});

</script>



<script>

	function completionDocument(argument) {

		var formData = new FormData();

		var file = document.getElementById('completion_document').files[0];

		formData.append("Filedata", file);

		var t = file.type.split('/').pop().toLowerCase();

		if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {

			$("#imgError").html("Extension File is Not Valid");

			$("#imgError").css("display", "block");

			document.getElementById("completion_document").value = '';

			return false;

		}

		if (t == "jpeg" && t == "jpg" && t == "png" && t == "bmp" && t == "gif" && t == "pdf") {

			$("#imgError").hide();

		}

		if (Math.round(file.size/1024) > 500) {

			$("#imgError").html("Max Upload size is 500kb only");

			$("#imgError").css("display", "block");

			document.getElementById("completion_document").value = '';

			return false;

		}

		else{

			$("#imgError").hide();

		}



		return true;

	}





	$(document).ready(function() {

		if (window.File && window.FileList && window.FileReader) {

			$("#completion_document").on("change", function(e) {

				var fp = $("#completion_document");

				var items = fp[0].files;

				var files = e.target.files,

				filesLength = files.length;

				for (var i = 0; i < filesLength; i++) {

					var t = items[i].type.split('/').pop().toLowerCase();

					var f = files[i]

					var name = "http://eysk.org/assets/img/pdf.png";

					var fileReader = new FileReader();

					if (t != 'pdf'){

						fileReader.onload = (function(e) {

							var file = e.target;		          	

							$("<span class=\"pip\">" +

								"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +

								"<br/><span class=\"remove\">Remove image</span>" +

								"</span>").insertAfter("#completion_document");

							$(".remove").click(function(){

								$(this).parent(".pip").remove();

							});



						});

					}

					else{

						fileReader.onload = (function(e) {

							var file = e.target;		          	

							$("<span class=\"pip\">" +

								"<img class=\"imageThumb\" src=\"" + name + "\" title=\"" + file.name + "\"/>" +

								"<br/><span class=\"remove\">Remove image</span>" +

								"</span>").insertAfter("#completion_document");

							$(".remove").click(function(){

								$(this).parent(".pip").remove();

							});



						});

					}

					fileReader.readAsDataURL(f);

				}

			});

		} else {

			alert("Your browser doesn't support to File API")

		}

	});

</script>



<script type="text/javascript">

$(document).ready(function(){

    var maxField = 100; //Input fields increment limitation

    var addButton = $('.add_button'); //Add button selector

    var wrapper = $('.field_wrapper'); //Input field wrapper

    

    var x = 2; //Initial field counter is 1

    

    //Once add button is clicked

    $('.add_button').click(function(){

    	var fieldHTML = '<div class="row field_wrapper remove_div_data_'+x+'" style="width: 152%;padding-left: 10px;"><div class="col-lg-3 padding-mt"><label>Salary</label><div><input type="text" class="form-control" aria-describedby="emailHelp" id="salary'+x+'" name="salary[]" placeholder="ENTER EMPLOYEE SALARY" ></div>@if ($errors->has('salary'))<span style="color: red;">{{ $errors->first('salary') }}</span>@endif</div><div class="col-lg-3 padding-mt" style="padding-left: 40px;"><label>Start Date</label><input type="text" class="form-control" aria-describedby="emailHelp" id="start_date'+x+'" name="start_date[]" placeholder="ENTER START DATE" >	@if ($errors->has('start_date'))<span style="color: red;">{{ $errors->first('start_date') }}</span>@endif</div><div class="col-lg-3 padding-mt" style="padding-left: 40px;"><label>Start Date</label><input type="text" class="form-control" aria-describedby="emailHelp" id="end_date'+x+'" name="end_date[]" placeholder="ENTER END DATE" >@if ($errors->has('end_date'))<span style="color: red;">{{ $errors->first('end_date') }}</span>@endif</div><div class="col-lg-2" style="margin-top: 59px;"><a href="javascript:void(0);" class="nominee-details-add remove_button" title="Remove field" onclick="removeButton('+x+')"><i class="la la-minus"></i></a></div></div>';

        //Check maximum number of input fields

        if(x < maxField){ 

            x++; //Increment field counter

            $(wrapper).append(fieldHTML); //Add field html

            //$(".select2_data_"+x).select2();

            var i;

			for (i = 1; i < x; i++) {

				$('#start_date'+i).mask('00-00-0000');

				$('#end_date'+i).mask('00-00-0000');

			}

        }

    });

});

function removeButton(id){

	$('.remove_div_data_'+id).remove();

}



function assignPermission(value) {

		$('.assign_permission').show();

		$.ajax({

			url: '{{ route('get-assign-permission') }}',

			type: 'POST',

			data: {fk_designation_id: value,_token:"{{ csrf_token() }}"},

			success:function (response) {

				var obj = JSON.parse(response);

				if (obj.success == 1) {

					$('#assignRolePermission').html(obj.html_data);

					$('.assign_permission').show();

				}				

			}

		})		

	}

$('#fk_role_id').select2();

</script>

@endsection

