
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
    <link rel="stylesheet" type="text/css" href="../css/inline.min.css" />
    <link rel="stylesheet" href="../css/smoothness/jquery-ui.css">

    </head>

<body>

    <?php include("includes/header.php"); ?>
    
    <section class="complete-content content-footer-space">
    
    <!--Mid Content Start-->
    
    
     <div class="about-intro-wrap pull-left">
     
     <div class="bread-crumb-wrap ibc-wrap-5">
    	<div class="container">
    <!--Title / Beadcrumb-->
         	<div class="inner-page-title-wrap col-xs-12 col-md-12 col-sm-12">
            	<div class="bread-heading"><h1>Customaization</h1></div>
                <div class="bread-crumb pull-right">
                <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="custom.php">Customaization</a></li>
                <li><a href="showreport.php">Show  ffffReport</a></li>
                </ul>
                </div>
            </div>
         </div>
     </div>
     
     <!--map-->
            	
     
         <div class="container">
         	

            
            <!--About-us top-content-->

        	<div class="row">
            
            <div class="col-xs-12 col-lg-12  col-sm-12 col-md-12 pull-left contact2-wrap">
            	
               
             <?php
			 include('classes/registation.cls.php');	
			 $spec=$_SESSION['speciality']; 
			 
		 $sql="SELECT tbl_doctor. * , tbl_speciality.speciality_name
FROM tbl_doctor, tbl_speciality
WHERE tbl_doctor.`speciality` = tbl_speciality.id
AND speciality='".$_SESSION['speciality']."'";
$res=mysql_query($sql);
$row=mysql_fetch_array($res)
			 ?>
 
                    
                    <!--Contact form-->
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad wow fadeInLeft" data-wow-delay="0.5s" data-wow-offset="100">
                     
						
                    	<form class="contact2-page-form col-lg-8 col-sm-12 col-md-8 col-xs-12 no-pad contact-v2" id="OutletForm" name="OutletForm" method="post" action="showwreport.php" enctype="multipart/form-data" onSubmit="return custom();">
                       
						
                       <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                       <p>Doctor Name:<input type="text" class="contact2-textbox" name="txtDocName" id="txtSubject"   value="<?php echo  $_SESSION["username"];  ?>" readonly></p>
                
                       <p>Speciality:<input type="text" class="contact2-textbox" name="txtSpe" id="txtSpe"  value="<?php  echo  $row["speciality_name"];  ?>" readonly></p>
                       <p>Report:
                            <select name="lblWeekly" id="lblWeekly" style="width:340px; height:45px;">
                            <option value="select">Select Report</option>
                            <option value="Weekly"  onClick="displaydate()">Weekly</option>
                            <option value="Monthly"  onClick="displaymonth()">Monthly</option>
                            
								
							</select>
                            </p>
                             <p><span style="color:#FF6699;" id="report_err"></span></p>
                            <p id="displaydate"></p>
                <p>Diseases:
                            <select name="lblDiseases" id="lblDiseases" style="width:340px; height:45px;">
                            <option value="select">Select Diseases</option>
								<?php $diseases=new registerClass();
								$alltypediseases=$diseases->displaydiseases();
								foreach($alltypediseases as $alldiseases)
									{ ?>
								<option value="<?php echo $alldiseases['diseases_name'];?>"><?php echo $alldiseases['diseases_name'];?></option>
								<?php } ?>
							</select>
                            </p>
                           
              <p><span style="color:#FF6699;" id="dise_err"></span></p>
                           
<section class="color-7" id="btn-click">
                <p  data-loading-text="Loading..." ><input type="submit" name="show" value="show Report"></p>
                
                </section>
				 </div>			
                         
                            
                        </form>
                       
                       
                       
                        
                        <!--Contact Sidebar-->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    
                    
                    	<div class="side-bar-contact">
                        	<div class="form-title-text wow fadeInRight" data-wow-delay="0.5s" data-wow-offset="100">Contact</div>
                            <ul class="contact-page-list wow fadeInRight" data-wow-delay="0.5s" data-wow-offset="100">
                            <li>
                                <i class="icon-globe contact-side-icon iside-icon-contact"></i>
                            <span class="contact-side-txt">iMedica Clinic, 123 Fifth Avenue,<br />New York, NY 10160, USA</span>
                            </li>
                            <li>
                                <i class="icon-phone2 contact-side-icon"></i>
                            <span class="contact-side-txt">Phone: <span class="iside-bar-cfont">+123 455 755
                            </span></span>
                            </li>
                            <li>
                                <i class="icon-file contact-side-icon"></i>
                                <span class="contact-side-txt">Fax: <span class="iside-bar-cfont">+123 555 755
                                </span></span>
                            </li>
                            <li>
                                <i class="icon-mail contact-side-icon"></i>
                                <span class="contact-side-txt">Email: <a href="mailto:contact@imedica.com">contact@imedica.com</a></span>
                            </li>
                            </ul>
                            
                            <div class="form-title-text wow fadeInRight" data-wow-delay="0.5s" data-wow-offset="120">Social Media</div>

                            <ul class="contact-page-social-list-bottom contact-page-social-list wow fadeInRight" data-wow-delay="0.5s" data-wow-offset="120">
                            
                            <li><a href="#">
                            <div class="contact-side-social-wrap"> 
                            <i class="icon-facebook contact-side-social-icon"></i></div></a>
                            </li>

                           <li> <a href="#">
                            <div class="contact-side-social-wrap"> <i class="icon-google-plus contact-side-social-icon"></i></div>
                            </a></li>

                            <li><a href="#">
                            <div class="contact-side-social-wrap"> <i class="icon-linkedin contact-side-social-icon"></i></div>
                            </a></li>
                            </ul>
                        </div>
                        
                    </div><!--Contact Sidebar end-->
                    
                    
                    </div><!--Contact Form end-->
                    
                    
                    
                    
                    
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
    
      <script src="../js/jquery-1.9.1.js"></script>
   <script src="../js/jquery-ui.js"></script> 
    <script type="text/javascript" src="../js/validation.js"></script>
   
      <script>
  $(function() {
    $( "#txtSdate" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd-mm-yy"
  });
  });
  $(function() {
    $( "#txtEdate" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd-mm-yy"
  });
  });
  </script>
  <script>
   	function displaydate(){
	
        $.ajax({
            url: "ajaxdisplaydate.php",
            type: "POST",
            
            success: function (response) {
                console.log(response);
                $("#displaydate").html(response);
            },
        });
	}
   </script>
    <script>
   	function displaymonth(){
	
        $.ajax({
            url: "ajaxdisplaymonth.php",
            type: "POST",
            
            success: function (response) {
                console.log(response);
                $("#displaydate").html(response);
            },
        });
	}
   </script>
</body>

<!-- Mirrored from imedica.sharkslab.com/HTML/contact-2.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:28:34 GMT -->
</html>