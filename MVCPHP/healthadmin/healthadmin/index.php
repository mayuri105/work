<?php
if(isset($_COOKIE['username']))
{
	header('location:dashboard.php');
}
?>
<!DOCTYPE html>

<html lang="en" class="no-js">
	
<head>
		<title>Admin</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">	
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/main-responsive.css">
		<!--[if IE 7]>
	
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
			<script type="text/javascript" language="javascript" src="inc/right_click_disable.js"></script>
			<script type="text/javascript" language="javascript">
			
			function login()
			{
				//alert('call');
				if(document.getElementById('username').value=='')
				{
					document.getElementById('username').focus();
					document.getElementById('error').innerHTML='<font color="red">Please Enter Username...!!!!!</font>';
					return false;
				}
				
				if(document.getElementById('password').value=='')
				{
					document.getElementById('password').focus();
					document.getElementById('error').innerHTML='<font color="red">Please Enter Password...!!!!!</font>';
					return false;
				}
				else
				{
					var username=document.getElementById('username').value;
					var pass=document.getElementById('password').value;
					var cookie=document.getElementById('remember').checked;
					
					var con=jQuery.noConflict();
					con.ajax({
							 
							 type:"POST",
							 url:"check_login.php",
							 data:"name="+username+"&password="+pass+"&cookie="+cookie,
							 success:function(msg)
							 {
								 //alert(msg);
								if(msg=='yes')
								 {
									 window.location='dashboard.php';
								 }
								 else
								 {						
								  document.getElementById('error').innerHTML='<font color="red">Wrong Username Or Password...!!!!!</font>';
					
								 }
								 
							 }
							 
							 });
				}
			}
			
			</script>

		
		
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login example2" onkeypress="return disableCtrlKeyCombination(event);" onkeydown="return disableCtrlKeyCombination(event);">
		<div class="main-login col-sm-4 col-sm-offset-4">
			<div class="logo">Admin Login</div>
			<!-- start: LOGIN BOX -->
			<div class="box-login">
				<h3>Sign in to your account</h3>
		
				<form class="form-login" action="" method="POST" id="login-form">
					<div class="errorHandler alert alert-danger">
						<i class="fa fa-remove-sign"></i><span id="error">Please enter your name and password to log in.</span>	
					</div>
					
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off">
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" id="password" name="password" placeholder="Password" autocomplete="off">
								<i class="fa fa-lock"></i>
							 </span>
						</div>
						<div class="form-actions">
							<label for="remember" class="checkbox-inline">
								<input type="checkbox" class="grey remember" id="remember" name="remember">
								Keep me signed in
							</label>

							<a href="javascript:void(0);" class="btn btn-bricky pull-right" onKeyDown="var e=(event)?event.keyCode:window.event.keyCode;if(e=='13'){}" onClick="javascript:login();">Login <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					
					</fieldset>
				</form>
			</div>
			<!-- end: LOGIN BOX -->
	
		
			<!-- start: COPYRIGHT -->
			<div class="copyright">
				2014 &copy; Chorus Admin.
			</div>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->

	</body>
	<!-- end: BODY -->


</html>