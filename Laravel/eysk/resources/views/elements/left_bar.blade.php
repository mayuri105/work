<style type="text/css" media="screen">

</style>

<div class="ktt-sitebar-bady">	
	<h3 class="kt-subheader__title text-center">
		General Settings                        
	</h3>
	<div class="edit-sidebar-menu">
		<div class="kt-section">
			<div class="kt-section__content kt-section__content--border kt-section__content--fit">
				<ul class="kt-nav">
				    
				    
    				@if(Route::currentRouteName() == 'role-list' || Route::currentRouteName() == 'add-role' || Route::currentRouteName() == 'edit-role')         
    				@php $activeMenu = "kt-nav__item--active" @endphp
    				@else
    				@php $activeMenu = "" @endphp
    				@endif
    				@if(in_array('role',$accessData))
        				<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
        					<a href="{{ route('role-list') }}" class="kt-nav__link kt-demo-icon__preview">
        						<i class="kt-nav__link-icon la la-certificate"></i>
        						<span class="kt-nav__link-text">Role</span>
        					</a>
        				</li>
        			    @endif
    			
					@if(Route::currentRouteName() == 'list-role-permission' || Route::currentRouteName() == 'add-role-permission' || Route::currentRouteName() == 'edit-role-permission')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('role-permission',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('list-role-permission') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-group"></i>
    							<span class="kt-nav__link-text" id="reshmi">Role Permission</span>
    						</a>
    					</li>
    				@endif
					@if(Route::currentRouteName() == 'death-type' || Route::currentRouteName() == 'add-death-type' || Route::currentRouteName() == 'edit-death-type')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('death-type',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('death-type') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-heartbeat"></i>
    							<span class="kt-nav__link-text">Death Type</span>
    						</a>
    					</li>
    				@endif
					@if(Route::currentRouteName() == 'sahyognidhi-amount' || Route::currentRouteName() == 'add-sahyognidhi-amount' || Route::currentRouteName() == 'edit-sahyognidhi-amount' || Route::currentRouteName() == 'details-death-type-amount')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('death-type-amount',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('sahyognidhi-amount') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-inr"></i>
    							<span class="kt-nav__link-text">Sahyognidhi Amount</span>
    						</a>
    					</li>
    				@endif
					{{-- @if(Route::currentRouteName() == 'bank-details' || Route::currentRouteName() == 'add-bank-details' || Route::currentRouteName() == 'edit-bank-details')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
						<a href="{{ route('bank-details') }}" class="kt-nav__link kt-demo-icon__preview">
							<i class="kt-nav__link-icon la la-bank"></i>
							<span class="kt-nav__link-text">Bank Details</span>
						</a>
					</li> --}}
					@if(Route::currentRouteName() == 'bank-charge' || Route::currentRouteName() == 'add-bank-charges' || Route::currentRouteName() == 'edit-bank-charges')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('bank-ach-charges',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('bank-charge') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-money"></i>
    							<span class="kt-nav__link-text">Check & ACH (ECH) Return Charges</span>
    						</a>
    					</li>
    				@endif
					{{-- @if(Route::currentRouteName() == 'ach-charges' || Route::currentRouteName() == 'add-ach-charges' || Route::currentRouteName() == 'edit-ach-charge-amount')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
						<a href="{{ route('ach-charges') }}" class="kt-nav__link kt-demo-icon__preview">
							<i class="kt-nav__link-icon la la-credit-card"></i>
							<span class="kt-nav__link-text">ACH Charges Received</span>
						</a>
					</li> --}}
					{{-- <li class="kt-nav__item kt-demo-icon">
						<a href="{{ route('re-payment-dates') }}" class="kt-nav__link kt-demo-icon__preview">
							<i class="kt-nav__link-icon flaticon2-layers-1"></i>
							<span class="kt-nav__link-text">Re Payment Date</span>
						</a>
					</li> --}}
					@if(Route::currentRouteName() == 'reserve-funds' || Route::currentRouteName() == 'add-reserved-funds' || Route::currentRouteName() == 'edit-reserve-funds')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('reserved-funds',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('reserve-funds') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-cc-mastercard"></i>
    							<span class="kt-nav__link-text">Reserved Funds</span>
    						</a>
    					</li>
    				@endif
					{{-- @if(Route::currentRouteName() == 'district' || Route::currentRouteName() == 'add-district' || Route::currentRouteName() == 'edit-district')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
						<a href="{{ route('district') }}" class="kt-nav__link kt-demo-icon__preview">
							<i class="kt-nav__link-icon la la-globe"></i>
							<span class="kt-nav__link-text">District</span>
						</a>
					</li>
					@if(Route::currentRouteName() == 'district-area' || Route::currentRouteName() == 'add-district-area' || Route::currentRouteName() == 'edit-district-area')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
						<a href="{{ route('district-area') }}" class="kt-nav__link kt-demo-icon__preview">
							<i class="kt-nav__link-icon la la-dot-circle-o"></i>
							<span class="kt-nav__link-text">District Area</span>
						</a>
					</li>
					@if(Route::currentRouteName() == 'expense-type' || Route::currentRouteName() == 'add-expense-type' || Route::currentRouteName() == 'edit-expense-type')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
						<a href="{{ route('expense-type') }}" class="kt-nav__link kt-demo-icon__preview">
							<i class="kt-nav__link-icon la  la-arrow-circle-o-down"></i>
							<span class="kt-nav__link-text">Expense Type</span>
						</a>
					</li>--}}
					@if(Route::currentRouteName() == 'sahyognidhi-manpower')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('sahyognidhi-manpower',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('sahyognidhi-manpower') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon fa fa-users"></i>
    							<span class="kt-nav__link-text">Sahyognidhi Bill</span>
    						</a>
    					</li> 
    				@endif

					@if(Route::currentRouteName() == 'registration-fees' || Route::currentRouteName() == 'add-registration-fees' || Route::currentRouteName() == 'edit-registration-fees' || Route::currentRouteName() == 'registration-fees-details')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('registration-fees',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('registration-fees') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-registered"></i>
    							<span class="kt-nav__link-text">Registration Fees</span>
    						</a>
    					</li>
    				@endif
					@if(Route::currentRouteName() == 'region' || Route::currentRouteName() == 'add-region' || Route::currentRouteName() == 'edit-region')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('region',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('region') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-map-o"></i>
    							<span class="kt-nav__link-text">Add Region</span>
    						</a>
    					</li>
    				@endif

					@if(Route::currentRouteName() == 'division' || Route::currentRouteName() == 'add-division' || Route::currentRouteName() == 'edit-division')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('division',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('division') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-map-o"></i>
    							<span class="kt-nav__link-text">Add Division</span>
    						</a>
    					</li>
    				@endif
					
					@if(Route::currentRouteName() == 'council' || Route::currentRouteName() == 'add-council' || Route::currentRouteName() == 'edit-council')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('council',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('council') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-map-o"></i>
    							<span class="kt-nav__link-text">Add Council</span>
    						</a>
    					</li>
    				@endif
					
					@if(Route::currentRouteName() == 'samaj-zone' || Route::currentRouteName() == 'add-samaj-zone' || Route::currentRouteName() == 'edit-samaj-zone')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('samaj-zone',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('samaj-zone') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-leanpub"></i>
    							<span class="kt-nav__link-text">Add Samaj Zone</span>
    						</a>
    					</li>
    				@endif
					@if(Route::currentRouteName() == 'yuva-mandal-number' || Route::currentRouteName() == 'add-yuva-mandal-number' || Route::currentRouteName() == 'edit-yuva-mandal-number')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('yuva-mandal-number',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('yuva-mandal-number') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon la la-users"></i>
    							<span class="kt-nav__link-text">Add Yuva Mandal</span>
    						</a>
    					</li>
    				@endif
					{{-- @if(Route::currentRouteName() == 'courier-company' || Route::currentRouteName() == 'add-courier-company' || Route::currentRouteName() == 'edit-courier-company')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
						<a href="{{ route('courier-company') }}" class="kt-nav__link kt-demo-icon__preview">
							<i class="kt-nav__link-icon far fa-building"></i>
							<span class="kt-nav__link-text">Courier/Postage Company</span>
						</a>
					</li> --}}
					@if(Route::currentRouteName() == 'disease' || Route::currentRouteName() == 'add-disease' || Route::currentRouteName() == 'edit-disease')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('disease',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('disease') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon fa fa-hospital-o"></i>
    							<span class="kt-nav__link-text">Disease</span>
    						</a>
    					</li>
    				@endif
					@if(Route::currentRouteName() == 'registration-donation' || Route::currentRouteName() == 'add-registration-donation' || Route::currentRouteName() == 'edit-registration-donation')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('registration-donation',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('registration-donation') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon fa fa-money"></i>
    							<span class="kt-nav__link-text">Development Funds</span>
    						</a>
    					</li>
    				@endif
					 @if(Route::currentRouteName() == 'repayment-donation' || Route::currentRouteName() == 'add-repayment-donation' || Route::currentRouteName() == 'edit-repayment-donation')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('repayment-donation',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('repayment-donation') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon fa fa-paypal"></i>
    							<span class="kt-nav__link-text">Repayment Donation</span>
    						</a>
    					</li> 
    				@endif
					@if(Route::currentRouteName() == 'locking-period' || Route::currentRouteName() == 'add-locking-period' || Route::currentRouteName() == 'edit-locking-period')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('locking-period',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('locking-period') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon fa fa-lock"></i>
    							<span class="kt-nav__link-text">Locking Period</span>
    						</a>
    					</li>
    				@endif
					@if(Route::currentRouteName() == 'late-fees-amount' || Route::currentRouteName() == 'add-late-fees-amount' || Route::currentRouteName() == 'edit-late-fees-amount')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('late-fees-amount',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('late-fees-amount') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon fa fa-dollar"></i>
    							<span class="kt-nav__link-text">Late Fees Amount</span>
    						</a>
    					</li>
    				@endif
					@if(Route::currentRouteName() == 'group' || Route::currentRouteName() == 'add-group' || Route::currentRouteName() == 'edit-group')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('group',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('group') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon fa fa-bars"></i>
    							<span class="kt-nav__link-text">Group</span>
    						</a>
    					</li>
    				@endif
					@if(Route::currentRouteName() == 'ledger-account' || Route::currentRouteName() == 'add-ledger-account' || Route::currentRouteName() == 'edit-ledger-account')         
					@php $activeMenu = "kt-nav__item--active" @endphp
					@else
					@php $activeMenu = "" @endphp
					@endif
					@if(in_array('ledger-account',$accessData))
    					<li class="kt-nav__item kt-nav__item {{ $activeMenu }} kt-demo-icon">
    						<a href="{{ route('ledger-account') }}" class="kt-nav__link kt-demo-icon__preview">
    							<i class="kt-nav__link-icon fa fa-adn"></i>
    							<span class="kt-nav__link-text">Ledger Account</span>
    						</a>
    					</li>
    				@endif
				</ul>
			</div>
		</div>
	</div>
</div>
