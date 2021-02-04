 <?php
	//error_reporting(0);
	?>
<!DOCTYPE HTML>
<!--[if gt IE 8]> <html class="ie9" lang="en"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
    
<!-- Mirrored from imedica.sharkslab.com/HTML/contact-2.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:28:34 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    

    <title>iMedica</title>

    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
    <link href="../css/jquery-ui-1.10.3.custom.css" rel="stylesheet" />
    <link href="../css/animate.css" rel="stylesheet" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/blue.css" id="style-switch" />
<link href="../css/popup.css" rel="stylesheet" />
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="../rs-plugin/css/settings.css" media="screen" />

    <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="css/ie9.css" />
    <![endif]-->    
    
    <link rel="icon" type="image/png" href="../images/fevicon.png">
    <link rel="stylesheet" type="text/css" href="../css/inline.min.css" /></head>

<body>

    <?php
	
 
	
	include("includes/header.php");
	 ?>
    
    <section class="complete-content content-footer-space">
    
    <!--Mid Content Start-->
    
    
     <div class="about-intro-wrap pull-left">
     
     <div class="bread-crumb-wrap ibc-wrap-5">
    	<div class="container">
    <!--Title / Beadcrumb-->
         	<div class="inner-page-title-wrap col-xs-12 col-md-12 col-sm-12">
            	<div class="bread-heading"><h1>Show Appointment</h1></div>
                <div class="bread-crumb pull-right">
                <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="appo.php">Book Appointment</a></li>
                <li><a href="showappo.php">Show Book Appointment</a></li>
                </ul>
                </div>
            </div>
         </div>
     </div>
     
     <!--map-->
            	
     
         <div class="container">
         	

            
            <!--About-us top-content-->

        	<div class="row">
            
            
           <div class="col-md-12 no-pad col-xs-12 col-sm-12 pull-left">
<?php 
include("config/dbconnect.php");
include("classes/appiontment.cls.php");
$apcls=new appo();
$appodata=$apcls->getappoData();

if(isset($_REQUEST["Delete"])){

	  if(isset($_REQUEST["chkappo"])){
	
			$del=$apcls->deleteappo($_REQUEST["chkappo"]);
			
				echo "<script>alert('Appintment Delete')</script>";
		echo "<script>window.location='showappo.php'</script>";
			
			
	  }
}


?>
            <div class="table-elements" >
				<form name="showappo" id="showappo" method="post"  >
				<input type="hidden" name="act" id="act"  />
               
                <table class="table table-bordered table-striped table-responsive">
                 <?php if($appodata){ ?>
                  <thead>
                    <tr>
                   
                      
                       <th>Appointment Type</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>email</th>
                      <th>date</th>
                        <th>time</th>
                        <th>Status</th>
                        
                    </tr>
                  </thead>
                  <tbody>
                  <?php
			
						for($j=0;$j<count($appodata);$j++){ ?>
                    <tr>
                    
                      <td><?php echo $appodata[$j]["type"];?></td>
                      <td><?php echo $appodata[$j]["fname"];?></td>
                      <td><?php echo $appodata[$j]["lname"];?></td>
                      <td><?php echo $appodata[$j]["email"];?></td>
                      <td><?php echo $appodata[$j]["adate"];?></td>
                      <td><?php echo $appodata[$j]["ap_time_slots"];?></td>
                      <td><a href="status.php?status=<?php echo $appodata[$j]['apid'];?>" onClick="return confirm('Really you Confirm (<?php echo $appodata[$j]['apid'];?>)');"><?php if($appodata[$j]["status"]== 0){ echo "pandding"; }?></a>
					  <?php if($appodata[$j]["status"]== 1)
						{
						?>
                       			 Confirm <?php
						}?></td>
                      
                    </tr>
                    
                    <?php	}
				
				}else{ ?>
				<tr >
						<td colspan="5"><?php echo "There are no records availabe.";?></td>
					</tr>
				<?php 				 
				} ?>
                
                  </tbody>
                </table>
 </form>
               
                  
            
            </div>

            </div>
                    
                    
                    
                    
                    
                </div>
            
            
            </div>
            
         
         
         
        
        </div>
         
         </div>
         

    <!--Mid Content End-->
    
    
        <!--Footer Start-->
    
    </section>

    
    <?php include("includes/footer.php"); ?>
    
    
    <!--JS Inclution-->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.min.js"></script>  
    <script type="text/javascript" src="../bootstrap-new/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="../rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="../js/jquery.scrollUp.min.js"></script>
    <script type="text/javascript" src="../js/jquery.sticky.min.js"></script>
    <script type="text/javascript" src="../js/wow.min.js"></script>
    <script type="text/javascript" src="../js/jquery.flexisel.min.js"></script>
    <script type="text/javascript" src="../js/jquery.imedica.min.js"></script>
    <script type="text/javascript" src="../js/custom-imedicajs.min.js"></script>
     <script type="text/javascript" src="../js/popup.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
    
        
</body>

<!-- Mirrored from imedica.sharkslab.com/HTML/contact-2.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:28:34 GMT -->
</html>