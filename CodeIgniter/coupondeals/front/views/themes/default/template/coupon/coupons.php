<!DOCTYPE html>

<html>
<head>
<title>Save TakaTak</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/js/sharetastic.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/font.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/font-awesome.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/normalize.css"/>

<!--css plugin-->

<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/flexslider.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/jquery.nouislider.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/jquery.popupcommon.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/style.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/res-menu.css"/>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/responsive.css"/>
<link href="<?=site_url('front/views/themes/default');?>/asset/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=site_url('front/views/themes/default');?>/asset/css/custom.css" rel="stylesheet">
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/font-awesome-4.0.3/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<style>
  .abhi{
	  width:100%;
	   background-color:#fff;
	    height:80px;
		 text-align:center;
  }
  .romi{display: inline-block;
                                        
    margin: 12px;

    padding: 8px 0px 10px;
    font-size: 25px;
    font-weight: bold;
    border: 2px dashed #ff9900;
    background: #fff1db;
    color: #000000;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    width: 86%;
    letter-spacing: 2px;}
	.coupon-type-text{   display: inline-block;
    font-size: 12px;
    letter-spacing: 1.2px;
    margin-bottom: 8px;
    text-transform: uppercase;}
  </style>
<style>
.active
{
 color:#FFBE19;
    
}
</style>
</head>

<body >
<div class="container-page">
  <div class="mp-pusher" id="mp-pusher"> <?php echo Modules::run('header/header/index'); ?> <?php echo Modules::run('menu/menu/index'); ?>
    <div class="top-area">
      <div class="grid_frame">
        <div class="container_grid clearfix">
          <div class="grid_12">
            <h2 class="page-title">Coupons</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="grid_frame page-content">
      <div class="container_grid">
        <div class="layout-2cols clearfix">
          <div class="grid_8 content">
            <div class="mod-coupons-code">
              <?php if ($allcoupons): ?>
              <div class="wrap-list">
               <?php foreach ($allcoupons as $cr): ?>
                <div class="coupons-code-item full flex">
                  <div class="brand-logo thumb-left">
                    <div class="wrap-logo">
                      <div class="center-img"> <span class="ver_hold"></span> <a href="#" class="ver_container"><img src="<?= site_url('upload/brandsimages/'.$cr->img_name.'') ?>" alt=""></a> </div>
                    </div>
                  </div>
                  <div class="right-content flex-body">
                    <p class="rs save-price"><a href="#"><?php echo $cr->title ?></a></p>
                    <p class="rs coupon-desc"><?php echo $cr->coupon_desc ?></p><br><br><br><br><br>
                    <div class="bottom-action">
                     <?php 
				$timestamp = strtotime($cr->added_date);
				$post_date =$timestamp;
				$now = time();
				?>
                 <?php 
					$dateTime=$cr->expired_date;
					$formattedDate = date("d", strtotime($dateTime) );	
					$formattedDate2 = date("M d, Y", strtotime($dateTime) );	?>
                      <div class="left-vote"> <span class="lbl-work">Valid till: <?php echo $formattedDate2; ?></span>&nbsp;&nbsp;&nbsp; <span> Shared about &nbsp;<?php echo timespan($post_date, $now) . ' ago';?> </span> </div>
                      <a class="btn btn-blue btn-view-coupon" href="<?php echo $cr->coupon_link ?>" data-toggle="modal" data-target="#myModal<?php echo $cr->coupon_id ?>" onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;" class="btn btn-big">VIEW <span>COUPON</span> CODE</a> </div>
                  </div>
                  <div class="modal fade" id="myModal<?php echo $cr->coupon_id ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"></button>
          <div class="row">
          
          <div class="col-md-2"><img src="<?= site_url('upload/brandsimages/'.$cr->img_name.'') ?>" style="height: 50px; width: 85px;     margin-top: -6px;" >
          </div>
          <div class="col-md-10"> <p ><?php echo $cr->title ?></p>
          </div></div>
         
        </div>
        <div class="modal-body" style="background-color:#f1efef;">
        
                                      
                                       <div class="row">
                                       <div class="col-md-1">
                                       </div>
                                        <div class="col-md-10">
                                          <p class="coupon-type-text">Copy this code and use at checkout</p>
                                        <div class="abhi" >
                                        <span class="romi"><?php echo $cr->coupon_code ?></span>
                                        </div>
                                        
                                       </div>
                                        <div class="col-md-1">
                                       </div>
                                    </div></div>
        
        <div class="modal-footer">
        <a class="btn btn-default-red-inverse" href="<?=site_url('home');?>" style="color:#0f99b1;">Back to home</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
                  <!--<div class="modal fade" id="myModal<?php echo $cr->coupon_id ?>" role="dialog">
                    <div class="modal-dialog"> 
                      
                     
                      <div class="modal-content">
                        <h4 style="text-align:center;">Coupon Code</h4>
                        <div class="container">
                          <div class="row">
                            <div class="col-md-1"> </div>
                            <div class="col-md-4">
                              <form method="post" enctype="multipart/form-data" target="_blank">
                                <div class="form-group">
                                  <label for="usr">Code:</label>
                                  <input type="text" class="form-control" id="code" name="code" value="<?php echo $cr->coupon_code ?>" required />
                                </div>
                               
                              
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <a class="btn btn-default-red-inverse" href="<?=site_url('home');?>" >Back to home</a>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>-->
                </div>
                 <?php endforeach ?>
               
                
              </div>
              
               
               <?php else: ?>
          <div class="mod-coupons-code">
          <h4>No Coupons Found</h4>
          </div>
          <?php endif ?>
               <ul class="pagination">
                        <?php echo $pagination_helper->create_links(); ?>
                      </ul>
              <!--<div class="pagination"> <a class="page-nav" href="#"><i class="icon iPrev"></i></a> <a class="page-num active" href="#">1</a> <a class="page-num" href="#">2</a> <a class="page-num" href="#">3</a> <a class="page-num" href="#">4</a> <a class="page-num" href="#">5</a> <a class="page-nav" href="#"><i class="icon iNext"></i></a> </div>-->
            </div>
            <!--end: .mod-coupons-code --> 
          </div>
         <?php echo Modules::run('coupon/coupon/couponsidebar'); ?> </div>
        </div>
      </div>
    </div>
    <?php echo Modules::run('footer/footer/index'); ?> </div>
</div>
<link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/js/sharetastic.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<script src="<?=site_url('front/views/themes/default');?>/asset/js/sharetastic.js"></script> 
<script src="<?=site_url('front/views/themes/default');?>/asset/js/bootstrap.min.js"></script> 

<script>
      $('.sharetastic').sharetastic();
    </script> 
<script type="text/javascript">
function showMessage(n,t){var i="<div class='notification'>"+t+"<\/div>  ";$(".notification").remove();$("body").append(i);setTimeout(function(){$(".notification").fadeOut(2e3,function(){$(this).remove()})},8e3)}

</script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery-1.10.2.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery.flexslider-min.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery.nouislider.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery.popupcommon.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/html5lightbox.js"></script> 

<!--//js for responsive menu--> 

<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/modernizr.custom.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/classie.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/mlpushmenu.js"></script> 
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/script.js"></script> 
<script>

  </script>
</body>
</html>