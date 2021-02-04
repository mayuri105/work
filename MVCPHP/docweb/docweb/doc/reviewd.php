<!DOCTYPE HTML>
<!--[if gt IE 8]> <html class="ie9" lang="en"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
    
<!-- Mirrored from imedica.sharkslab.com/HTML/departments.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:27:56 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">  

</script>
    <title>iMedica</title>

    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
    <!-- <link href="css/jquery-ui-1.10.3.custom.css" rel="stylesheet" /> -->
    <link href="../css/animate.css" rel="stylesheet" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/blue.css" id="style-switch" />

    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="../rs-plugin/css/settings.css" media="screen" />

    <!--[if IE 9]>
      <link rel="stylesheet" type="text/css" href="css/ie9.css" />
    <![endif]-->    

    <link rel="icon" type="image/png" href="../images/fevicon.png">
    <link rel="stylesheet" type="text/css" href="../css/inline.min.css" /></head>

<body>

   

    <?php include("includes/header.php"); ?>

    <section class="complete-content content-footer-space">

    <!--Mid Content Start-->
    
    
     <div class="about-intro-wrap pull-left">
     
     <div class="bread-crumb-wrap ibc-wrap-6">
    	<div class="container">
    <!--Title / Beadcrumb-->
         	<div class="inner-page-title-wrap col-xs-12 col-md-12 col-sm-12">
            	<div class="bread-heading"><h1>Patient Information</h1></div>
                <div class="bread-crumb pull-right">
                <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="patientinfo.php">Patient Information</a></li>
                </ul>
                </div>
            </div>
         </div>
     </div>
     
         <div class="container">
         	
            
        
        
  
  
          <div class="row">
            
            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 dept-tabs-wrap wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="200">
              
      
              <!-- tabs left -->
             
                
                <div class="detail-section" id="detail">
                <h3>Review List</h3>
                <table class="table table-bordered table-striped table-responsive" style="width:600px;">
                   
                  <!-- Begin Comments JavaScript Code --><!-- Begin Comments JavaScript Code --><script type="text/javascript" async>function ajaxpath_5592362b506f8(url){return window.location.href == '' ? url : url.replace('&s=','&s=' + escape(window.location.href));}(function(){document.write('<div id="fcs_div_5592362b506f8"></div>');fcs_5592362b506f8=document.createElement('script');fcs_5592362b506f8.type="text/javascript";fcs_5592362b506f8.src=ajaxpath_5592362b506f8((document.location.protocol=="https:"?"https:":"http:")+"//www.freecommentscript.com/GetComments2.php?p=5592362b506f8&s=&Size=10#!5592362b506f8");setTimeout("document.getElementById('fcs_div_5592362b506f8').appendChild(fcs_5592362b506f8)",1);})();</script><!-- End Comments JavaScript Code --><!-- End Comments JavaScript Code -->
                 </table>
                    
                    
                 </div>
                 
                 
                
            
        
  
  			
                
                
            	
            </div> 
	  

        
         </div>
     </div>
    
     
     </section>
    
    <!--Mid Content End-->

    

    <?php include("includes/footer.php"); ?>
    


    <!--JS Inclution-->
    
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap-new/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="../rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="../js/jquery.scrollUp.min.js"></script>
    <script type="text/javascript" src="../js/jquery.sticky.min.js"></script>
    <script type="text/javascript" src="../js/wow.min.js"></script>
    <script type="text/javascript" src="../js/jquery.flexisel.min.js"></script>
    <script type="text/javascript" src="../js/jquery.imedica.min.js"></script>
    <script type="text/javascript" src="../js/custom-imedicajs.min.js"></script>
    <script type="text/javascript" src="../js/imedica-js/view.appoinment.js"></script>

    <link rel="stylesheet" href="code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
   <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
   <script>
   	function detail(id){
	//alert(id);
	
	//var patientId =document.getElementById("patientId").value;
	  // alert(patientId);
        $.ajax({
		
            url: "ajaxpatdetail.php",
            type: "POST",
            data: "patientId="+id,
            success: function (response) {
                console.log(response);
                $("#detail").html(response);
				
            },
        });
	}
   </script>
	
</body>

<!-- Mirrored from imedica.sharkslab.com/HTML/departments.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:28:10 GMT -->
</html>