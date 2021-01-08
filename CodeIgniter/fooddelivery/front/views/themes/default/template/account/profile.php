<?php echo Modules::run('header/header/account'); ?>
	  


<div class="page-wrapper">
	<div id="page-header-wrapper">
		<div id="page-header">
			<!-- page header contents -->
			<h1>Your account</h1>
		</div>
	</div>
	<div id="main-content-wrapper" >
		<div id="main-content">
		   <div  class="page-profile">
				<div class="side-nav" >
					
					<div class="account-side-nav">
						<div class="account-pages">
							
							
							<div class="link "><a href="<?= site_url('account/orders') ?>">Order history</a></div>
							
							<div class="link" ><a href="<?= site_url('account/tell-a-friend') ?>">Tell a friend</a></div>
							
							<div class="link active" ><a href="<?= site_url('account/profile') ?>">Profile</a></div>
							
							<div class="link" ><a href="<?= site_url('account/addresses') ?>">Addresses</a></div>
						  
							<!-- <div class="link"><a href="<?= site_url('account/cards') ?>">Credit cards</a></div> -->
						   	<div class="link"><a href="<?= site_url('account/wallets') ?>">Wallets</a></div>
						</div>
					</div>
				  
				</div>
				<!-- page content -->
				<div class="content">
					<div class="form-container">


						<div class="heading">
							<h3>Profile</h3></div>
							<form class="profile-form">
							<!-- ngIf: !isValid -->
							<div  class="error-messages" style="display:none">
								<div class="message"></div>
							</div>
							<div class="first-last-name">
								<div class="first-name-wrapper">
									<label>First name*</label>
									<span class="first-name">
										<input  type="text" value="<?= $customer->customer_detail->first_name; ?>" id="firstname" >
									</span>
								</div>
								<div class="last-name-wrapper">
									<label>Last name*</label>
									<span class="last-name">
										<input  type="text"  id="lastname" value="<?= $customer->customer_detail->last_name; ?>">
									 </span>
								</div>
							</div>
							<div class="email-wrapper">
								<label >Email*</label>
								<div class="email">
									<input  type="email" id="email" value="<?= $customer->customer_detail->email; ?>" >
								</div>
							</div>
							<div class="new-confirm-password">
								<div class="new-password-wrapper">
									<label >New password</label>
									<div class="new-password">
										<input type="password" id="password" >
									</div>
								</div>
								<div class="confirm-password-wrapper">
									<label >Confirm new password</label>
									<div class="new-password">
										<input type="password"  id="confirmpassword">
									</div>
								</div>
							</div>
							<div class="save-profile">
								<button type="button" id="saveprofile" class="button primary">
									
									<span  class="contents">
										<span id="txt">Save profile</span>
										<span class="icon-checkmark ng-hide"></span>
									</span>
									<span class="spinner">
									</span>
								</button>
							</div>
						</form>
					</div>
					<!-- ngRepeat: integration in accounts.linked -->
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(window).scroll(function () {
		if ($(window).scrollTop() > 300) {
			$('.sticky-search').addClass('visible');
		}
		else
		{
			$('.sticky-search').removeClass('visible');
		}
	});
</script>
<script type="text/javascript">
	$('#saveprofile').click(function(){
			var data = {
	        	firstname :$('#firstname').val(),
	        	lastname :$('#lastname').val(),
	        	email :$('#email').val(),
	        	password :$('#password').val(),
	        	confirmpassword :$('#confirmpassword').val(),
	    	};
	        
	        $.ajax({
	        url : "<?php echo site_url('account/saveprofile') ?>",
	        type: "POST",
	        dataType: "json",
	        data: data,
	        beforeSend: function() {
	           
	                $('.button >.spinner').css("opacity", "1");
	                $('.button >.spinner').css("display", "block");
	                $('.button >.contents').css("display", "none");
	            
	        },
	        success:function(data){
	            setTimeout(function(){
	                if(data.response ==0 ){
	                    $('.button >.spinner').css("opacity", "0");
	                    $('.button >.spinner').css("display", "none");
	                    $('.button >.contents').css("display", "block");
	                    $('.error-messages ').show();
	                    $('.error-messages ').html(data.error);
	                }else{
	                   $('.button .spinner').css("opacity","0");
	                    $('.button .spinner').css("display","none");
	                    $('.button .contents').css("display","block");
	                    $('.button .contents .icon-checkmark').removeClass("ng-hide");
	                    $('.button .contents .icon-checkmark').css("display", "block");
	                    $('.error-messages ').hide();
	                    
	                }
	            },3000);  
	        }
	    });
	});
	

</script>
<?php echo Modules::run('footer/footer/account'); ?>