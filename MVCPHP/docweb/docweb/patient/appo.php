<?php
error_reporting(0);
 ?>
 <?php
include('classes/registation.cls.php');	
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
            	<div class="bread-heading"><h1>Book Appointment</h1></div>
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
            
            <div class="col-xs-12 col-lg-12  col-sm-12 col-md-12 pull-left contact2-wrap">
            	
               
             
 <?php
 include("config/dbconnect.php");
include("classes/appiontment.cls.php");
 if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){
	$apcls=new appo($_REQUEST["apid"]);
	$data=$apcls->getappoinfo();
	$act="Edit";
}else{
	$act="Add";
}
?>
                    
                    <!--Contact form-->
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad wow fadeInLeft" data-wow-delay="0.5s" data-wow-offset="100">
                     
						
                    	<form class="contact2-page-form col-lg-8 col-sm-12 col-md-8 col-xs-12 no-pad contact-v2" id="BookAppoForm" name="RegisterForm" method="post" action="add_appo.php" enctype="multipart/form-data" onSubmit="return Bookappo();">
                        <input type="hidden" name="act" value="<?php echo $act; ?>" />
						<input type="hidden" name="apid" value="<?php echo $_REQUEST["apid"]; ?>" >
                        <input type="hidden" name="patid" value="<?php echo $_SESSION["Login_patid"]; ?>" >
                        
                        <div class="form-title-text no-pad"></div>
                        	
                            
                        	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                             <p>
                           
                            <select name="lblApType" id="lblApType"  placeholder="Appointment Type*" style="width:340px; height:45px;">
                            <option value="select">Select Appointment Type</option>
                            <option value="Telephonic"  <?php if(isset($data["type"]) && $data["type"]=="Telephonic"){ echo "selected='selected'";  }?>>Telephonic</option>
                            <option value="Wallking" <?php if(isset($data["type"]) && $data["type"]=="Wallking"){ echo "selected='selected'";  }?>>Wallking</option>
                              
                            </select> <span  class="contact2" style="color:#FF6699;" id="apotype_err"></span>
                            </p>
                            <p>
                        	<input type="text" class="contact2-textbox" placeholder="First Name*" name="txtFirstName" id="txtFirstName" value="<?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){ echo $data["fname"];  } ?>" />
                           <span style="color:#FF6699;" id="apfname_err"></span></p>
                            <p>
                        	<input type="text" class="contact2-textbox" placeholder="Last Name*" name="txtLastName" id="txtLastName" value="<?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){ echo $data["lname"];  } ?>"/>
                           <span style="color:#FF6699;" id="aplname_err"></span></p>
                           <p>
                           <input type="text" class="contact2-textbox" placeholder="Email*" name="txtEmail" id="txtEmail" value="<?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){ echo $data["email"];  } ?>"/>
                           <span style="color:#FF6699;" id="apemail_err"></span></p>
                           <p>
                            	<textarea class="contact2-textarea" placeholder="Address" name="txtAddress" id="txtAddress"><?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){ echo $data["address"];  } ?></textarea>
                           <span style="color:#FF6699;" id="apaddress_err"></span></p>
                           <p>
                           <input type="text" placeholder="Contact No*" class="contact2-textbox" name="txtContactno" id="txtContactno" value="<?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){ echo $data["contactno"];  } ?>">
                           <span style="color:#FF6699;" id="apcno_err"></span></p>
                            <p>
                           <p>
                           <select name="lblCountry" class="form-control countries" id="selectCountry">
                           <option value="select">Select Country</option>
				<?php
 				$country=new registerClass;
				$get_country=$country->country_list();
				foreach($get_country as $getallCountry)
				{
				?>
				<option value="<?=$getallCountry['id'];?>"<?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){if($getallCountry['id']==$data['country']){?>selected="selected" <?php }} ?> ><?=$getallCountry['name'];?></option>
                <?php
				} ?>
				  </select>
                             <span style="color:#FF6699;" id="apcon_err"></span></p>
                             <p>
                             <select name="lblState" class="form-control states" id="selectState">
                             <option value="select">Select State</option>
              <?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit") { 
                
				$state=new registerClass;
				$get_state=$state->state_list($data['country']);
				foreach($get_state as $getallState)
				{
				?>
				   <option value="<?=$getallState['id'];?>"<?php if($getallState['id']==$data['state']){ ?> selected="selected" <?php } ?> ><?= $getallState['name'];?></option>
                <?php }} else { ?>
				 <option value="">Please First Select Country</option>
                 <?php } ?> 
				  </select>
                           <span style="color:#FF6699;" id="apstate_err"></span></p>
                             <p>
                             <select name="lblCity" class="form-control cities" id="selectCity">
                             <option value="select">Select City</option>
				<?php 
				if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit") { 
				$city=new registerClass;
				$get_city=$city->city_list($data['state']);
				foreach($get_city as $getallCity)
				{
				?>
				  <option value="<?=$getallCity['id'];?>"<?php if($getallCity['id']==$data['city']){ ?> selected="selected" <?php } ?> ><?= $getallCity['name'];?></option>
              
			    <?php
				 }} else {?>
				 <option value="">Please First Select State</option>
				 <?php } ?>
				  </select>
                             <span style="color:#FF6699;" id="apcity_err"></span></p>
                             <p>
                           	<input type="radio" name="gender"  id="gender" value="male"<?php if(isset($data["gender"]) && $data["gender"]=="male"){ echo "checked='checked'";  }?>>Male<input type="radio" name="gender" id="gender1" value="female" <?php if(isset($data["gender"]) && $data["gender"]=="female"){ echo "checked='checked'";  }?>>Female
                             <span style="color:#FF6699;" id="apgender_err"></span></p>
                             <p>
                            <input type="text" class="contact2-textbox" placeholder="Age*" name="txtAge" id="txtAge" value="<?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){ echo $data["age"];  } ?>"/>
                             <span style="color:#FF6699;" id="apage_err"></span></p>
                             
                             <p>
                            <select name="lblDiseases" id="lblDiseases" placeholder="Diseases*" style="width:340px; height:45px;">
                            <option value="select">Select Diseases</option>
								<?php $diseases=new registerClass();
								$alltypediseases=$diseases->displaydiseases();
								foreach($alltypediseases as $alldiseases)
									{ ?>
								<option value="<?=$alldiseases['diseases_name'];?>"><?=$alldiseases['diseases_name'];?></option>
								<?php } ?>
							</select>
                            <span style="color:#FF6699;" id="apdises_err"></span></p>
                            <p>
                            <select name="lblSpeciality" id="lblSpeciality"  placeholder="Speciality*" style="width:340px; height:45px;">
                           <option value="select">Select Speciality </option>
                           
				<?php 
				 
				 $speciality = new registerClass;
			  	$alltypespeciality = $speciality->displayspecility();
			  
			  	foreach($alltypespeciality as $allspeciality)
			  	{
			  	?>
			     
				    <option value="<?=$allspeciality['id'];?>" <?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){  if($allspeciality['id']==$data['speciality']) {  ?> selected="selected" <?php } }?>><?=$allspeciality['speciality_name'];?></option>
   
			  <?php
				  }
				  ?>
                           
							</select>
                            <span style="color:#FF6699;" id="apspe_err"></span></p>
                             <p>
                           
                           
                            <input type="text" placeholder="Multi Speciality*" class="contact2-textbox" name="txtMultiSpec" id="txtMultiSpec" value="<?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){ echo $data["maultispeciality"];  } ?>">
                            <span style="color:#FF6699;" id="apmultispe_err"></span></p>
                            <p>
                            <select name="Doctor" id="Doctor"  placeholder="Doctor*" style="width:340px; height:45px;" >
                            <option value="select">Select Doctor</option>
                            
                            <?php 
				 
				 $doctor = new registerClass;
			  	$alltypedoctor = $doctor->displaydoctor();
			  
			  	foreach($alltypedoctor as $alldoctor)
			  	{
			  	?>
			     
				    <option value="<?=$alldoctor['docid'];?>" <?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){  if($alldoctor['docid']==$data['doctor']) {  ?> selected="selected" <?php } }?>><?=$alldoctor['name'];?></option>
   
			  <?php
				  }
				  ?>
                          
							</select>
                            <span style="color:#FF6699;" id="apdoc_err"></span></p>
                             <p>
                           <input type="text" class="contact2-textbox" placeholder="Date*" name="txtDate" id="date" value="<?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){ echo $data["adate"];  } ?>"  onchange="chg_time()" />
                           <span style="color:#FF6699;" id="apdate_err"></span></p>
                           <p>
                            <select name="lblTime"  placeholder="Time*" id="atime"  $disable style="width:340px; height:45px;">
                              <option value="select">Select Time</option>
				<?php
 				$time=new registerClass;
				$get_time=$time->time_list();
				foreach($get_time as $getallTime)
				{
				?>
				<option value="<?=$getallTime['ap_time_slot_id'];?>"<?php if(isset($_REQUEST["action"]) && $_REQUEST["action"]=="Edit"){if($getallTime['ap_time_slot_id']==$data['atime']){?> selected="selected" <?php }} ?> ><?=$getallCountry['ap_time_slots'];?></option>
                <?php
				} ?>
                            </select>
                            <span style="color:#FF6699;" id="aptime_err"></span></p>
                           
                          
                            
                           
                            <section class="color-7" id="btn-click">
                <p  data-loading-text="Loading..." ><input type="submit" name="btnBookAppo" value="Book"></p>
                
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
     <script type="text/javascript" src="../js/validation.js"></script>
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   
    <script>
function chg_time(){
//alert('hi');
var ctime=document.getElementById('date').value;
if (window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
//alert(xmlhttp.responseText);
document.getElementById('atime').innerHTML=xmlhttp.responseText;
}
}
 //alert(ctime);
 
xmlhttp.open("GET","chgtime.php?ctime="+ctime,true);
xmlhttp.send();
}
</script> 
<script src="../js/jquery-1.9.1.js"></script>
   <script src="../js/jquery-ui.js"></script> 
   
      <script>
  $(function() {
    $( "#date" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"yy-mm-dd"
  });
  });
 
  </script>
  <script type="text/javascript">
$(document).ready(function(){
	
	$('#selectCountry').on("change",function () {
    	var countryId = $(this).find('option:selected').val();
        //alert(countryId);
		$.ajax({
            url: "ajaxstate.php",
            type: "POST",
            data: "country_id="+countryId,
            success: function (response) {
                console.log(response);
                $("#selectState").html(response);
            },
        });
    }); 
	

	$('#selectState').on("change",function () {
    	var stateId = $(this).find('option:selected').val();
        $.ajax({
            url: "ajaxcity.php",
            type: "POST",
            data: "state_id="+stateId,
            success: function (response) {
                console.log(response);
                $("#selectCity").html(response);
            },
        });
    }); 
	
	
	
});

</script>
</body>

<!-- Mirrored from imedica.sharkslab.com/HTML/contact-2.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:28:34 GMT -->
</html>