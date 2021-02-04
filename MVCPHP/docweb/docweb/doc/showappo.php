<?php
error_reporting(0);
include("config/dbconnect.php");
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
	<style type="text/css">
	.noclick{
	-webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
	
	}
	</style>
<body>

    <?php include("includes/header.php"); ?>
    
    <section class="complete-content content-footer-space">
    
    <!--Mid Content Start-->
    
    
     <div class="about-intro-wrap pull-left">
     
     <div class="bread-crumb-wrap ibc-wrap-5">
    	<div class="container">
    <!--Title / Beadcrumb-->
         	<div class="inner-page-title-wrap col-xs-12 col-md-12 col-sm-12">
            	<div class="bread-heading"><h1> Today Booked Appointment</h1></div>
                <div class="bread-crumb pull-right">
                <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="showappo.php">Booked Appointment</a></li>
               
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
            	
               
             

                    
                    <!--Contact form-->
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad wow fadeInLeft" data-wow-delay="0.5s" data-wow-offset="100">
                     
							<form class="contact2-page-form col-lg-8 col-sm-12 col-md-8 col-xs-12 no-pad contact-v2" id="BookedAppoForm" name="BookedAppoForm" method="post" action="booked_appo.php" style="height:600px;">
                            
                           <?php
	
	
	
	echo "Today Date:". $event_date=date("Y-m-d");
	 echo "<br/>";
	 echo "<br/>";
	
    			$taken_time_slots = array();
    		 $booking_qry = "SELECT `atime` FROM `tbl_appointment` WHERE `adate` = '$event_date' AND doctor = '".$_SESSION['Login_docid']."'";
    			$booking_rs = mysql_query($booking_qry);
    			while($booking_row = mysql_fetch_array($booking_rs))
    			{
    				$taken_time_slots[] = $booking_row['atime'];
    			}
    			
    			$timeslots_qry = "SELECT * FROM `tbl_ap_time_slots`";
    			$timeslots_rs = mysql_query($timeslots_qry);
    			while($timeslots_row = mysql_fetch_array($timeslots_rs))
    			{
    				$event_time_slot_id = $timeslots_row['ap_time_slot_id'];
    				$calendar .= "<input name='chk' type='checkbox' value='" . $event_time_slot_id . "'";
    				if(in_array($event_time_slot_id, $taken_time_slots))
    				{
    					$calendar .= "checked='checked' ";
						$calendar .= "disabled='disabled' ";
						
    					$status = "<span style='color:#CC0000;'>Taken</span>";
    				}
    				else
    				{
    					$status = "Available";
    				}
    				$calendar .= "/>" . $timeslots_row['ap_time_slots'] . " - $status<br>";
    			}
    			
    		echo $calendar;
     

?> 	

                            </form>
                    	
                        
                       </div>
                        
                        
                        <!--Contact Sidebar-->
                    <!--<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    
                    
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
                        
                    </div>--><!--Contact Sidebar end-->
                    
                    
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
    <script src="../js/location.js"></script> 
     
</body>

<!-- Mirrored from imedica.sharkslab.com/HTML/contact-2.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:28:34 GMT -->
</html>