 
<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title ?></title>
    <?php echo Modules::run( 'header/header/css' ) ?>
    <meta itemprop="title" content="<?php echo $meta_titles ?> ">
    <meta itemprop="description" content="<?php echo $meta_descriptions ?>">
    <meta itemprop="keywords" content="<?php echo $meta_keywords ?>">

</head>

<body>
<?php echo Modules::run( 'header/header/index' ); ?>
<header class="bread_crumb">
        <div class="pag_titl_sec">
            <h1 class="pag_titl"> Bidding Detail</h1>
            <h4 class="sub_titl">Bidding Detail </h4>
        </div>
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Home </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"> Bidding Detail </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
                    <div class="prop_addinfo" id="other_info">
                                <h2 class="add_titl">
                                    Bid Detail
                                </h2>
                                <div id="bid_detail"></div>
 								
</div>
                            </div>
                            </div>
                
                <?php echo Modules::run( 'footer/footer/index' ); ?>
</body>
<script type="text/javascript">
$(document).ready(function () {
function loadbidData(){
    data = {
        ajax :'1'
    }
    $.ajax({
          type: "get",
          url: '<?php echo site_url("bid_detail/getlivebid") ?>',
          data:data,
          success: function( response ) {
                $('#bid_detail').html(response)
            }
        });

}
setInterval(function(){ 
   loadbidData(); 
   //checkBidTimeOver(); 

   
        $('#mainSpinner').hide();
    }, 1000

);
 

});
</script>
</html>