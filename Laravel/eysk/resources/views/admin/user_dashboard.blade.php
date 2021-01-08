 @extends('elements.user_admin')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-subheader kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Dashboard                            
				</h3>
			</div>
			<div class="kt-subheader__toolbar">
				<div class="kt-subheader__wrapper"></div>
			</div>

		</div>
	</div>
</div>

	<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="margin-top: -150px;">
		<div class="filter-section-bg">
			<form>
				<div class="row">
					<div class="col-lg-4">
						<label>Sahyognidhi Member</label>
						<input type="text" name="phone_number_first" value="{{ $totalDevangatMember }}" class="form-control m-input" placeholder="Enter Contact Number" style="border:none;" readonly>
					</div>
					<div class="col-lg-4">
						<label>Pending Repayment</label>
						<input type="text" name="phone_number_first" value="6" class="form-control m-input" placeholder="Enter Contact Number" style="border:none;" readonly>
					</div>	

					<div class="col-sm-4">	
						<label>Ledger Account</label>
						<input type="text" name="email" value="5" class="form-control m-input" placeholder="Enter Email" style="border:none;" readonly>
						
					</div>
				</div>
				<br>
			</form>
		</div>	
	</div>
	<!-- end:: Subheader -->        
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		
	</div>
</div>
@endsection
@section('content_js')
<script src="{{ URL::asset('assets/asset/js/dashboard.js') }}" type="text/javascript"></script>
@endsection
