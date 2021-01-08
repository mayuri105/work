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
								Add Courier                         
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
							<a href="{{ route('courier') }}">
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
						<form action="{{ route('save-courier') }}" enctype="multipart/form-data" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group">
								<div class="kt-radio-inline">
									<div class="row">
										<div class="col-sm-2 col-md-2">	
											<label class="kt-radio">
												{{-- <input type="radio" name="courier_status"  value="Send"> Send
												<span class="tablinks"></span> --}}
											</label>
										</div>
										<div class="col-sm-2 col-md-2" style="margin-left: 25px;">	
											<label class="kt-radio">
												<input type="radio" name="courier_status"  value="Send"> Send
												<span class="tablinks"></span>
											</label>
										</div>
										<div class="col-sm-2 col-md-2">
											<label class="kt-radio">
												<input type="radio" name="courier_status" value="Recieved"> Recieved
												<span class="tablinks"></span>
											</label>
										</div>
									</div>
									@if ($errors->has('courier_status'))
									<span style="color: red;">
										{{ $errors->first('courier_status') }}
									</span>
									@endif
								</div>
							</div>			
						
					
					<!--end::Portlet-->

					<div class="kt-portlet sahyognidhi-mtt">
						<div class="row">
							<div class="col-sm-12">	
								<div id="London" class="w3-container city">
									<div class="Half-section-details">

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">Date
												<span class="text-danger">*</span></label>	
												<div class="col-lg-9">
													<input type="text" class="form-control courier_date" placeholder="Enter Date" name="courier_date">
													@if ($errors->has('courier_date'))
													<span style="color: red;">
														{{ $errors->first('courier_date') }}
													</span>
													@endif
												</div>
											</div>

										<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Courier Company
												<span class="text-danger">*</span></label>	
												<div class="col-lg-9">
													<input type="text" class="form-control" aria-describedby="emailHelp" name="company_name" placeholder="Enter Courier name"> 
													@if ($errors->has('company_name'))
													<span style="color: red;">
														{{ $errors->first('company_name') }}
													</span>
													@endif
												</div>
											</div>

										<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Courier Id
													<span class="text-danger">*</span>
												</label>	
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Enter Courier Id" aria-describedby="emailHelp" name="courier_static_id">
													@if ($errors->has('courier_static_id'))
													<span style="color: red;">
														{{ $errors->first('courier_static_id') }}
													</span>
													@endif
												</div>
											</div> 

										<div class="form-group1 m-form__group1 row">	
											<label class="col-lg-2 col-form-label">YSK ID<span class="text-danger">*</span>
											</label>	
											<div class="col-lg-9">
												<select class="form-control kt-select2" id="fk_registration_id" name="fk_registration_id" onchange="getDataByYskId(this.value)">
													<option selected disabled>Select YSK</option>
													@foreach($yskMember as $yskMembers)	
													  @if($yskMembers->ysk_id == '')
													  <option value="{{ $yskMembers->pre_ysk_id }}">{{ $yskMembers->hidden_name_as_per_yuva_sangh_org }}(PreYsk- {{ $yskMembers->pre_ysk_id }})</option>
													  @else
													  <option value="{{ $yskMembers->ysk_id }}">{{ $yskMembers->hidden_name_as_per_yuva_sangh_org }}(Ysk- {{ $yskMembers->ysk_id }})</option>
													  @endif
													@endforeach
												</select>
												@if ($errors->has('fk_ysk_id'))
													<span style="color: red;">
														{{ $errors->first('fk_ysk_id') }}
													</span>
												@endif

											<span id="sahyognidhiError" style="color: red;"></span>
											</div>
										</div>

										<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Name
													<span class="text-danger">*</span>
												</label>	
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Enter Name" id="name_as_per_yuva_sangh_org" aria-describedby="emailHelp" name="name_as_per_yuva_sangh_org">
													@if ($errors->has('name_as_per_yuva_sangh_org'))
													<span style="color: red;">
														{{ $errors->first('name_as_per_yuva_sangh_org') }}
													</span>
													@endif
												</div>
											</div>

										<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Mobile Number
													<span class="text-danger">*</span>
												</label>	
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Enter Contact Number" id="phone_number" aria-describedby="emailHelp" name="phone_number">
													@if ($errors->has('phone_number'))
													<span style="color: red;">
														{{ $errors->first('phone_number') }}
													</span>
													@endif
												</div>
											</div>

										<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Narration
													<span class="text-danger">*</span>
												</label>	
												<div class="col-lg-9">
													<textarea class="form-control" placeholder="Enter Details" aria-describedby="emailHelp" name="courier_narration"></textarea>
													@if ($errors->has('courier_narration'))
													<span style="color: red;">
														{{ $errors->first('courier_narration') }}
													</span>
													@endif
												</div>
											</div>

										
												
											<div class="form-group1 m-form__group1 row">	
												<label class="col-lg-2 col-form-label">Courier Slip<span class="text-danger">*</span>	
												</label>	
												<div class="col-lg-9 imageBox">
													<input type="file" class="form-control profile-height" id="courier_slip" onchange="courierSlip()" aria-describedby="emailHelp" name="courier_slip[]" multiple>
													<br>
													<small>The photo should be simple <strong>JPEG/PNG/JPEG</strong> image and size <strong>500 KB.</strong> There will be no cropping and filtering facility available.
													be no cropping and filtering facility available.</small>
													<br>
													<span style="color: red; display: none; " class="text-danger db m-b-20" id="imgError"> </span>
													<div class="gallery"></div>
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
																	<a href="{{ route('sahyognidhi-request') }}" class="btn-cancel-registration">Cancel</a>
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

<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}

   
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
	$('#fk_registration_id').select2();
	
	function getDataByYskId(value) {
		$.ajax({
			url: '{{ route('get-data-by-ysk-id') }}',
			type: 'POST',
			data: {fk_ysk_id: value,_token:"{{ csrf_token() }}"},
			success:function (response) {
				var obj = JSON.parse(response);
				if (obj.success == 1) {
					$('#name_as_per_yuva_sangh_org').val(obj.nameAsPerYuvaSanghOrg);	
					
					$('#phone_number').val(obj.phoneNumber1);
					
					
				}
			}
		})		
	}

</script>
<script>
	$('.courier_date').mask('00-00-0000');
	function courierSlip(argument) {
		var formData = new FormData();
		var file = document.getElementById('courier_slip').files[0];
		formData.append("Filedata", file);
		var t = file.type.split('/').pop().toLowerCase();
		if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif" && t != "pdf") {
			$("#imgError").html("Extension File is Not Valid");
			$("#imgError").css("display", "block");
			document.getElementById("courier_slip").value = '';
			return false;
		}
		if (t == "jpeg" && t == "jpg" && t == "png" && t == "bmp" && t == "gif" && t == "pdf") {
			$("#imgError").hide();
		}
		if (Math.round(file.size/1024) > 500) {
			$("#imgError").html("Max Upload size is 500kb only");
			$("#imgError").css("display", "block");
			document.getElementById("courier_slip").value = '';
			return false;
		}
		else{
			$("#imgError").hide();
		}

		return true;
	}


	$(document).ready(function() {
		if (window.File && window.FileList && window.FileReader) {
			$("#courier_slip").on("change", function(e) {
				var fp = $("#courier_slip");
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
								"</span>").insertAfter("#courier_slip");
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
								"</span>").insertAfter("#courier_slip");
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
@endsection
