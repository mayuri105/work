 <?php
	error_reporting(0);
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
            	<div class="bread-heading"><h1>Show Weekly Report</h1></div>
                <div class="bread-crumb pull-right">
                <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="showwreport.php">Weekly Report</a></li>
                <li><a href="showmreport.php">Monthly Report</a></li>
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
            <div class="table-elements" >
            <table class="table table-bordered table-striped table-responsive">
           <thead>
                    <tr>
                   
                       <th>Name</th>
                       <th>address</th>
                        <th>Appointment Type</th>
                       <th>Appointment Date</th>
                       <th>Appointment Time</th>
                       
                      <th>Diseases</th>
                     
                      
                        
                    </tr>
                  </thead>
<?php 
 include("config/dbconnect.php");
if(isset($_POST['show'])){
$report=$_REQUEST['lblWeekly'];
$diseases=$_REQUEST['lblDiseases'];
$sdate=$_REQUEST['txtDateStart'];
$edate=$_REQUEST['txtDateEnd'];
$smonth=$_REQUEST['txtMonthStart'];
$emonth=$_REQUEST['txtMonthEnd'];

if($report=="Weekly")
{
	  $sql="SELECT *
	FROM `tbl_appointment`
	WHERE adate
	BETWEEN '$sdate' 
	AND '$edate' AND diseases = '$diseases'";
	$result=mysql_query($sql);

			while($row=mysql_fetch_array($result))
			{
	
			?>
           
                 <?php if($row){ ?>
                  
                  <tbody>
                  
                    <tr>
                    
                        <td><?php echo $row["fname"];?>&nbsp;<?php echo $row["lname"];?></td>
                        <td><?php echo $row["address"];?></td>
                        <td><?php echo $row["type"];?></td>
                        <td><?php echo $row["adate"];?></td>
                        <td><?php $query="select * from tbl_ap_time_slots where ap_time_slot_id='".$row["atime"]."'"; $result=mysql_query($query); 
                        $row1=mysql_fetch_assoc($result);
                        echo $row1["ap_time_slots"];?></td>
                        <td><?php echo $row["diseases"];?></td>
                    </tr>
                    
                    <?php	
					}
					
				else { 
				?>
                            <tr >
                            <td colspan="5"><?php echo "There are no records availabe.";?></td>
                            </tr>
				<?php 				 
					} 
			}
	}
else
{

$sql2="SELECT *
FROM tbl_appointment
WHERE month( adate )
BETWEEN '$smonth' 
AND '$emonth' AND diseases = '$diseases'";


$result2=mysql_query($sql2);

while($row2=mysql_fetch_array($result2))
{
				?>
              
				 <tr>
                    
                      <td><?php echo $row2["fname"];?>&nbsp;<?php echo $row2["lname"];?></td>
                        <td><?php echo $row2["address"];?></td>
                          <td><?php echo $row2["type"];?></td>
                      <td><?php echo $row2["adate"];?></td>
                      <td><?php $query="select * from tbl_ap_time_slots where ap_time_slot_id='".$row2["atime"]."'"; $result=mysql_query($query); 
						$row1=mysql_fetch_assoc($result);
						echo $row1["ap_time_slots"];?></td>
                      
                       <td><?php echo $row2["diseases"];?></td>
                      
                      
                    </tr>
				<?php 
				
				
	} 
}
}
				
				?>
                
                  </tbody>
                </table>

               
                  
            
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