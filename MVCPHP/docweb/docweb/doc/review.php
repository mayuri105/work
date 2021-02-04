<?php 
include("config/dbconnect.php");
if(isset($_REQUEST['post'])){
$comid=$_REQUEST['com_id'];
$userid=$_REQUEST['user_id'];
$utype=$_REQUEST['usertype'];

$com=$_REQUEST['msg'];
$sql="insert into tbl_reply(com_id,user_id,usertype,msg)values('$comid','$userid','$utype','$com')";
$res=mysql_query($sql) or die(mysql_error());
}
?>


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
	 <link href="../css/popup.css" rel="stylesheet" />
      <script type="text/javascript" src="../js/jquery.min.js"></script>
<body>

   

    <?php include("includes/header.php"); ?>

    <section class="complete-content content-footer-space">

    <!--Mid Content Start-->
    
    
     <div class="about-intro-wrap pull-left">
     
     <div class="bread-crumb-wrap ibc-wrap-6">
    	<div class="container">
    <!--Title / Beadcrumb-->
         	<div class="inner-page-title-wrap col-xs-12 col-md-12 col-sm-12">
            	<div class="bread-heading"><h1>Review</h1></div>
                <div class="bread-crumb pull-right">
                <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="patientinfo.php">Review</a></li>
                </ul>
                </div>
            </div>
         </div>
     </div>
     
         <div class="container">
         <?php 
		 include("config/dbconnect.php");

		 
		 ?>	
          
          <div class="row">
            
            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 dept-tabs-wrap wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="200">
              
      
              <!-- tabs left -->
             
                
                <div class="detail-section" id="detail">
                <h3>Review List</h3>
                
                <?php
							$res = mysql_query("select * from tbl_patreview  order by id asc");
							while($data = mysql_fetch_array($res))
       							 {
        						?> 
                <table class="table table-bordered table-striped table-responsive" style="width:600px;">
                   <tr><td><?php echo $data['subject'];?></td>
                   <tr><td><?php echo $data['comment'];?></td></tr>
                   <tr><td id="comment_logs<?php echo $data['id'];?>"></td></tr>
                  <tr><td><a id="btnreply<?php echo $data['id'];?>" >reply</a>
                  <div id="rform<?php echo $data['id'];?>" style="display:none;">
                  <form name="replyform" method="post">
                  <input type="hidden" name="com_id" id="com_id<?php echo $data['id'];?>" value="<?php echo $data['id'];?>">
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['Login_docid'];?>">
                  <input type="hidden" name="usertype" value="<?php  echo $_SESSION['usertype']; ?>">
<p>Comment:<textarea name="msg"  placeholder="Comment*" id="msg"></textarea></p>
<p align="center"><input type="submit" name="post" value="post"></p>
 </form>
                
</div>
                  
                  </td></tr>
                 </table>
                 <script type="text/javascript">
 $(document).ready(function(e){
   //alert("hi..");

        var comid=document.getElementById("com_id<?php echo $data['id'];?>").value;
        
        alert(comid);
				
        $.ajaxSetup({type:"POST",
		  
                url:"review_logs.php",
               data: {
					comid: "<?php echo $data['id'];?>"
				},
					success:function(response){
					
					//alert(response);
												},
				
			});
				
			alert(comid);						
        setInterval(function() {$('#comment_logs<?php echo $data['id'];?>').load('review_logs.php');}, 1000);
        });
		
		
   </script>

                   <script>
$(document).ready(function(){
    $("#btnreply<?php echo $data['id'];?>").click(function(){
        $("#rform<?php echo $data['id'];?>").toggle();
    });
});
</script>
                      <?php } ?>
                    
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   
	
</body>

<!-- Mirrored from imedica.sharkslab.com/HTML/departments.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:28:10 GMT -->
</html>