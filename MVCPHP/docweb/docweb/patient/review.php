
  
    <link href="../css/animate.css" rel="stylesheet" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/blue.css" id="style-switch" />

    <!-- REVOLUTION BANNER CSS SETTINGS -->
   

    <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="css/ie9.css" />
    <![endif]-->    
    
    <link rel="icon" type="image/png" href="../images/fevicon.png">
    <link rel="stylesheet" type="text/css" href="../css/inline.min.css" /></head>
<?php
include("config/dbconnect.php");
?>

<div class="side-bar-contact">
                        	<div class="form-title-text wow fadeInRight" data-wow-delay="0.5s" data-wow-offset="100">Review List</div>
                            <?php
							$res = mysql_query("select * from tbl_patreview  order by id asc");
							while($data = mysql_fetch_array($res))
       							 {
        						?> 
                            <ul class="contact-page-list wow fadeInRight" data-wow-delay="0.5s" data-wow-offset="100">
                            <li>
                                <i class="icon-globe contact-side-icon iside-icon-contact"></i>
                            <span class="contact-side-txt">
							<strong><?php echo $data['subject'];?></strong><br>
                            <?php echo $data['comment'];?>
                            </span>
                            </li>
                            
                            
                            
                            </ul>
                            <?php } ?>
                            

                            
                        </div>
                    