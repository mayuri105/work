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
    <link href="css/jquery-ui-1.10.3.custom.css" rel="stylesheet" />
    <link href="css/animate.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/blue.css" id="style-switch" />
<link href="css/popup.css" rel="stylesheet" />
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="../rs-plugin/css/settings.css" media="screen" />

    <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="css/ie9.css" />
    <![endif]-->    
    
    <link rel="icon" type="image/png" href="../images/fevicon.png">
    <link rel="stylesheet" type="text/css" href="../css/inline.min.css" /></head>
<link rel="stylesheet" href="css/smoothness/jquery-ui.css">
<body>

    <?php include("includes/header.php"); ?>
    
    <section class="complete-content content-footer-space">
    
    <!--Mid Content Start-->
    
    
     <div class="about-intro-wrap pull-left">
     
     <div class="bread-crumb-wrap ibc-wrap-5">
    	<div class="container">
    <!--Title / Beadcrumb-->
         	<div class="inner-page-title-wrap col-xs-12 col-md-12 col-sm-12">
            	<div class="bread-heading"><h1>Sign Up</h1></div>
                <div class="bread-crumb pull-right">
                <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="signup.php">Sign Up</a></li>
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
                     <div>
                     <label><input type="radio" name="colorRadio" value="red" id="Doctor" checked = checked> Doctor</label>

       				 <label><input type="radio" name="colorRadio" value="green" id="Patient"> Patient</label>
        			</div>
						<div id="DoctorRegister">
                    	<form class="contact2-page-form col-lg-8 col-sm-12 col-md-8 col-xs-12 no-pad contact-v2" id="DoctorRegisterForm" name="RegisterForm" method="post" action="doctorsignup.php" enctype="multipart/form-data" onSubmit="return DoctorRegister();">
                        
                        
                        
                        <div class="form-title-text no-pad"></div>
                        	
                            
                           
                        	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <p>
                        		<input type="text" class="contact2-textbox" placeholder="Name*" name="txtName" id="txtName" />

                           <span style="color:#FF6699;" id="name_err"></span></p>
                            
                           <p>
                            	<input type="text" placeholder="Username*" name="txtDocUsername" id="txtDocUsername" class="contact2-textbox"><span id="result2"></span>
                           <span style="color:#FF6699;" id="username_err"></span></p>
                           <p>
                           		 <input type="password" placeholder="Password*" class="contact2-textbox" name="txtPassword" id="txtPassword">
                           <span style="color:#FF6699;" id="password_err"></span></p>
                           <p>
                           
                            <p>
                          <input type="radio" name="gender" id="dgender" value="male">Male<input type="radio" name="gender" id="dgender1" value="female">Female <br>
                           <span style="color:#FF6699;" id="docgender_err"></span></p>
                            <p>
                           
                            <input type="text" class="contact2-textbox" placeholder="Clinic Name*" name="txtClinicName" id="txtClinicName" />
                           <span style="color:#FF6699;" id="clinicname_err"></span></p>
                           <p>
                           <select name="lblCountry"  id="selectCountry" style="width:340px; height:45px;">
                           <option value="select">Select Country</option>
                           
                          
				<?php
 				$country=new registerClass();
				$get_country=$country->country_list();
				foreach($get_country as $getallCountry)
				{
				?>
                 
				<option value="<?=$getallCountry['id'];?>"><?=$getallCountry['name'];?></option>
                <?php
				} ?>
				  </select>
                             <span style="color:#FF6699;" id="con_err"></span></p>
                             <p>
                             <select name="lblState"  id="selectState" style="width:340px; height:45px;">
							 <option value="select">Select State</option>
							 <?php
 				$state=new registerClass;
				$get_state=$state->state_list();
				foreach($get_state as $getallState)
				{
				?>
                 
				<option value="<?=$getallState['id'];?>"><?=$getallState['name'];?></option>
                <?php
				} ?>
							</select>
                            <span style="color:#FF6699;" id="state_err"></span></p>
                             <p>
                             <select name="lblCity"  id="selectcity" style="width:340px; height:45px;">
                             
                             <option value="select">Select City</option>
				<?php 
				
				$city=new registerClass;
				$get_city=$city->city_list();
				foreach($get_city as $getallCity)
				{
				?>
				  <option value="<?=$getallCity['id'];?>" ><?= $getallCity['name'];?></option>
              
			    <?php
				 } ?>
				  </select>
                             <span style="color:#FF6699;" id="city_err"></span></p>
                             <p>
                           	<textarea class="contact2-textarea" placeholder="street*" name="txtAddress" id="txtAddress"></textarea>
                             <span style="color:#FF6699;" id="address_err"></span></p>
                             <p>
                            <input type="text" class="contact2-textbox" placeholder="Email*" name="txtEmail" id="txtEmail"/>
                            <span style="color:#FF6699;" id="email_err"></span></p>
                             <p>
                            <select name="lblSpeciality" id="lblSpeciality" placeholder="Speciality*" style="width:340px; height:45px;">
                            <option value="select">Select Speciality </option>
                           <?php $speciality=new registerClass();
									$alltypespeciality=$speciality->displayspecility();
									foreach($alltypespeciality as $allspeciality)
										{ ?>
									<option value="<?=$allspeciality['id'];?>"><?=$allspeciality['speciality_name'];?></option>
									<?php } ?>
							</select>
                            <span style="color:#FF6699;" id="spe_err"></span></p>
                             <p>
                          
                           
                            <input type="text" placeholder="Contact No*" class="contact2-textbox" name="txtContactno" id="txtContactno">
                            <span style="color:#FF6699;" id="cno_err"></span></p>
                             <p>
                           <input type="text" class="contact2-textbox" placeholder="Emergency Contact No*" name="txtEmergencyNo" id="txtEmergencyNo" /> <span style="color:#FF6699;" id="ecno_err"></span></p>
                           
                          <p>Biodata:<input type="file" name="biodata"/></p>
                            
                           
                            <section class="color-7" id="btn-click">
                <p  data-loading-text="Loading..." ><input type="submit" name="btnDocSignup" value="SignUp" id="check"></p>
                
                </section>
                          </div>
                            
                            
                        </form>
                        
                        </div>
                        <div id="PatientRegister">
                    	<form class="contact2-page-form col-lg-8 col-sm-12 col-md-8 col-xs-12 no-pad contact-v2" id="PatientRegisterForm" name="RegisterForm" method="post" action="patientsignup.php" enctype="multipart/form-data" onSubmit="return PatientRegister();">
                        
                        
                        <div class="form-title-text no-pad"></div>
                        	
                            
                        
                        	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <p>
                        	<input type="text" class="contact2-textbox" placeholder="Name*" name="txtName" id="txtpName" />
                           <span style="color:#FF6699;" id="patname_err"></span></p>
                           <p>
                            <input type="text" class="contact2-textbox" placeholder="Username*" name="txtUsername" id="txtpUsername"/><span id="result3"></span>
                           <span style="color:#FF6699;" id="pusername_err"></span></p>
                           <p>
                            <input type="password" placeholder="Password*" class="contact2-textbox" name="txtPassword" id="txtpPassword">
                           <span style="color:#FF6699;" id="ppassword_err"></span></p>
                           <p>
                            <input type="text" class="contact2-textbox" placeholder="Birth Date*" name="txtBdate" id="txtBdate" />
                           <span style="color:#FF6699;" id="pbdate_err"></span></p>
                           <p>
                           Gender:<input type="radio" name="gender" id="pgender" value="male">Male<input type="radio" name="gender" id="pgender1" value="female">Female <br>
                           <span style="color:#FF6699;" id="pgender_err"></span></p>
                            <p>
                            <select name="lblMstatus" id="plblMstatus"  placeholder="Material Status*" style="width:340px; height:45px;">
                            <option value="select">Material Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                              
                            </select>
                             <span style="color:#FF6699;" id="patmstatus_err"></span></p>
                          <p>
                           <select name="lblCountry"  id="selectCountry" style="width:340px; height:45px;">
                           <option value="select">Select Country</option>
                           
                          
				<?php
 				$country=new registerClass();
				$get_country=$country->country_list();
				foreach($get_country as $getallCountry)
				{
				?>
                 
				<option value="<?=$getallCountry['id'];?>"><?=$getallCountry['name'];?></option>
                <?php
				} ?>
				  </select>
                             <span style="color:#FF6699;" id="pcon_err"></span></p>
                             <p>
                             <select name="lblState"  id="selectState" style="width:340px; height:45px;">
							 <option value="select">Select State</option>
							 <?php
 				$state=new registerClass;
				$get_state=$state->state_list();
				foreach($get_state as $getallState)
				{
				?>
                 
				<option value="<?=$getallState['id'];?>"><?=$getallState['name'];?></option>
                <?php
				} ?>
							</select>
                            <span style="color:#FF6699;" id="pstate_err"></span></p>
                             <p>
                             <select name="lblCity"  id="selectcity" style="width:340px; height:45px;">
                             
                             <option value="select">Select City</option>
				<?php 
				
				$city=new registerClass;
				$get_city=$city->city_list();
				foreach($get_city as $getallCity)
				{
				?>
				  <option value="<?=$getallCity['id'];?>" ><?= $getallCity['name'];?></option>
              
			    <?php
				 } ?>
				  </select>
                             <span style="color:#FF6699;" id="pcity_err"></span></p>
                             <p>
                           	<textarea class="contact2-textarea" placeholder="street" name="txtAddress" id="ptxtAddress"></textarea>
                             <span style="color:#FF6699;" id="paddress_err"></span></p>
                             <p>
                            <input type="text" class="contact2-textbox" placeholder="Email*" name="txtEmail" id="ptxtEmail"/>
                            <span style="color:#FF6699;" id="pemail_err"></span></p>
                             <p>
                            <select name="lblDiseases" id="plblDiseases" placeholder="Diseases*" style="width:340px; height:45px;">
                            <option value="select">Select Diseases</option>
								<?php $diseases=new registerClass();
								$alltypediseases=$diseases->displaydiseases();
								foreach($alltypediseases as $alldiseases)
									{ ?>
								<option value="<?=$alldiseases['id'];?>"><?=$alldiseases['diseases_name'];?></option>
								<?php } ?>
							</select>
                            <span style="color:#FF6699;" id="pdiseases_err"></span></p>
                             <p>
                           
                           
                            <input type="text" placeholder="Contact No*" class="contact2-textbox" name="txtContactno" id="ptxtContactno">
                            <span style="color:#FF6699;" id="pcno_err"></span></p>
                            
                            
                           
                          
                            
                           
                            <section class="color-7" id="btn-click">
                <p data-loading-text="Loading..."><input type="submit" name="btnPatSignup" value="Sign Up"></p>
                
                </section>
                          </div>
                            
                            
                        </form>
                        </div>
                        
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
   
    <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>  
    <script type="text/javascript" src="bootstrap-new/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="js/jquery.scrollUp.min.js"></script>
    <script type="text/javascript" src="js/jquery.sticky.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/jquery.flexisel.min.js"></script>
    <script type="text/javascript" src="js/jquery.imedica.min.js"></script>
    <script type="text/javascript" src="js/custom-imedicajs.min.js"></script>
     <script type="text/javascript" src="js/popup.js"></script>
    <script type="text/javascript" src="js/validation.js"></script>
     <script type="text/javascript" src="js/jquery.min.js"></script>
     <script type="text/javascript">
 $(document).ready(function(){
 //alert('hi');
 $("#PatientRegister").hide();

   $("#Doctor").click(function(){
       $("#DoctorRegister").show();
$("#PatientRegister").hide();

   });
   $("#Patient").click(function(){
       $("#DoctorRegister").hide();
$("#PatientRegister").show();


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
	//alert('hi...');
    	var stateId = $(this).find('option:selected').val();
		 //alert(stateId);
        $.ajax({
            url: "ajaxcity.php",
            type: "POST",
            data: "state_id="+stateId,
            success: function (response) {
                console.log(response);
                $("#selectcity").html(response);
            },
        });
    }); 

	
});

</script>

   <script src="js/jquery-ui.js"></script> 
   
      <script>
  $(function() {
    $( "#txtBdate" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"yy-mm-dd"
  });
  });
 
  </script>


  <script type="text/javascript">
  
 $("#txtDocUsername").keyup(function(){ 
 //alert("hi...");
var username_value = $(this).val();
if(username_value!='')
{
  $.ajax({
        type:"post",
        url:"check_user.php",
        data:{username:username_value},
        cache: false,
        success:function(data){
		$('#result2').html(data);
        }
        });
}
});

$("#txtpUsername").keyup(function(){ 
//alert("hi...");
var username_value = $(this).val();
if(username_value!='')
{
  $.ajax({
        type:"post",
        url:"check_patuser.php",
        data:{username:username_value},
        cache: false,
        success:function(data){
		$('#result3').html(data);
        }
        });
}
});

</script>
      
</body>

<!-- Mirrored from imedica.sharkslab.com/HTML/contact-2.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:28:34 GMT -->
</html>