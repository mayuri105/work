<?php
if(isset($_COOKIE['username']))
{
	header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Admin</title>
    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->

    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="../inc/right_click_disable.js"></script>
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

<body>

    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>            </button>
            <a class="navbar-brand" href="index.php"><span>JobPortal</span></a>

          <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="#"><i class="glyphicon glyphicon-globe"></i> Visit Site</a></li>
            </ul>
        </div>
    </div>
    <!-- topbar ends -->

<div class="ch-container">
    
  <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Admin Login</h2>
        </div>
        <!--/span-->
    </div>    

<div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                <span id="error">Please login with your Username and Password.</span>
            </div>
			<span id="error"></span>
            <form class="form-horizontal" action="" method="POST" id="login-form" >
                <fieldset>
                    <div class="input-group input-group-lg">
					    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend">
                        <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <a href="javascript:void(0);" class="btn btn-primary" onKeyDown="var e=(event)?event.keyCode:window.event.keyCode;if(e=='13'){}" onClick="return login();">LOG IN</a>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div>
     


   <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="#" target="_blank">Admin</a> 2012 - <?php echo date('Y') ?></p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="http://usman.it/free-responsive-admin-template">Admin</a></p>
    </footer>


</div><!--/.fluid-container-->


</body>
</html>
