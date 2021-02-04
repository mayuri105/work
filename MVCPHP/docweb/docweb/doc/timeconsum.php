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

/*echo $sql="SELECT tbl_appointment. * , tbl_ap_time_slots.ap_time_slots
FROM tbl_appointment, tbl_ap_time_slots
WHERE tbl_appointment.`atime` = tbl_ap_time_slots.ap_time_slot_id
order by tbl_appointment.apid desc
";
$result=mysql_query($sql);
 while($row = mysql_fetch_array($result)){
 
$time=explode(':',$row['ap_time_slots']);
//echo $time[0][1];
 $marks = array("first" => array
				(
					"hour"=>$time[0],
				   
				),
				"second" => array
                (
               		 "hour"=>$time[0],
                )
			  );
echo "<pre>";

echo  $marks['second']['hour']-$marks['first']['hour'];
echo "======================";
print_r($marks);


$shop = array(array($time[0],$time[1])
         
             ); 
*//*echo $shop[0][0];
echo "<br>".$shop[0][1];
 echo"<br>";
 echo"<pre>";
 */
 //print_r($shop);
 
 
 //echo $time=$row['ap_time_slots'];
 // $diff=$time[0]-$time[1];
  
 
//echo $row['ap_time_slots'];
//}



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
                      <th>date</th>
                        <th>time</th>
                         <th>Consuming Time</th>
                        <th>Doctor Name</th>
                       
                    </tr>
                  </thead>
                  <tbody>
                  <?php
			
						for($j=0;$j<count($appodata);$j++){ ?>
                    <tr>
                   
                      <td><?php echo $appodata[$j]["type"];?></td>
                      <td><?php echo $appodata[$j]["fname"];?></td>
                      <td><?php echo $appodata[$j]["lname"];?></td>
                      <td><?php echo $appodata[$j]["adate"];?></td>
                      <td><?php echo $appodata[$j]["ap_time_slots"];?></td>
                       <td></td>
                       
                      <td><?php echo $appodata[$j]["name"];?></td>
                     
                    </tr>
                    
                    <?php	}
				
				}
				else{ ?>
				<tr >
						<td colspan="5"><?php echo "There are no records availabe.";?></td>
					</tr>
				<?php 				 
				} 
				
				?>
                
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
    <script type="text/javascript">
            $("#map-canvas-2").gMap({
            
            styles:[{stylers:[
        {
            featureType: 'water', // set the water color
            elementType: 'geometry.fill', // apply the color only to the fill
            stylers: [
                { color: '#adc9b8' }
            ]
        },{
            featureType: 'landscape.natural', // set the natural landscape
            elementType: 'all',
            stylers: [
                { hue: '#809f80' },
                { lightness: -35 }
            ]
        }
        ,{
            featureType: 'poi', // set the point of interest
            elementType: 'geometry',
            stylers: [
                { hue: '#f9e0b7' },
                { lightness: 30 }
            ]
        },{
            featureType: 'road', // set the road
            elementType: 'geometry',
            stylers: [
                { hue: '#d5c18c' },
                { lightness: 14 }
            ]
        },{
            featureType: 'road.local', // set the local road
            elementType: 'all',
            stylers: [
                { hue: '#ffd7a6' },
                { saturation: 100 },
                { lightness: -12 }
            ]
        }
    ]}],
            controls: false,
            scrollwheel: false,
            maptype: 'ROADMAP',
            markers: [
                {
                    latitude: 40.753317,
                    longitude: -73.968905,
                    icon: {
                        image: "images/location2.png",
                        iconsize: [50, 50],
                        iconanchor: [50,50]
                    }
                },

            ],
            icon: {
                image: "images/location2.png", 
                iconsize: [50, 50],
                iconanchor: [50, 50]
            },
            latitude: 40.753317,
            longitude: -73.968905,
            
            zoom: 12,
            mapTypeId: 'Styled'
            
            
        });

        </script> 
        
</body>

<!-- Mirrored from imedica.sharkslab.com/HTML/contact-2.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 30 May 2015 11:28:34 GMT -->
</html>