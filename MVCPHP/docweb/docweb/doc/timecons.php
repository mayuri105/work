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
            	<div class="bread-heading"><h1>Show Camp</h1></div>
                <div class="bread-crumb pull-right">
                <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="addcamp.php">Add Camp</a></li>
                <li><a href="showcamp.php">Show Camp</a></li>
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
include("classes/camp.cls.php");
$apcls=new camp($_REQUEST["id"]);
$data=$apcls->getCampData();

if(isset($_REQUEST["Delete"])){

	  if(isset($_REQUEST["chkOut"])){
	
			$del=$apcls->deleteCamp($_REQUEST["chkOut"]);
			
				echo "<script>alert('Camp Delete')</script>";
		echo "<script>window.location='showcamp.php'</script>";
			
			
	  }
}


?>
            <div class="table-elements" >
				<form name="showOutlet" id="showOutlet" method="post"  >
				<input type="hidden" name="act" id="act"  />
               
                <table class="table table-bordered table-striped table-responsive">
                 <?php if($data){ ?>
                  <thead>
                    <tr>
                   
                      <th><input type="checkbox" name="chkAll" id="chkAll" class="input_checkbox" /></th>
                       <th>Subject</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                       <th>Time</th>
                      
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
			
						for($j=0;$j<count($data);$j++){ ?>
                    <tr>
                    <td><input type="checkbox" name="chkOut" value="<?php echo $data[$j]["id"]; ?>" ></td>
                      <td><?php echo $data[$j]["subject"];?></td>
                      <td><?php echo $data[$j]["start_date"];?></td>
                      <td><?php echo $data[$j]["end_date"];?></td>
                      <td><?php echo $data[$j]["ctime"];?></td>
                      
                      <td><a  href="addcamp.php?action=Edit&id=<?php echo $data[$j]["id"]; ?>" >Edit</a></td>
                    </tr>
                    
                    <?php	}
				
				}else{ ?>
				<tr >
						<td colspan="5"><?php echo "There are no records availabe.";?></td>
					</tr>
				<?php 				 
				} ?>
                <tr>
                <td><input type="submit" name="Delete" id="delbut" value="Delete"   /></td>
                </tr>
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