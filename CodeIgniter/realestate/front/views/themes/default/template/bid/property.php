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
 <!-- Header bradcrumb -->
 <?php foreach ( $property as $pro ): ?>
    <header class="bread_crumb">
        <div class="pag_titl_sec">
            <h1 class="pag_titl"> Bidding Page</h1>
            <h4 class="sub_titl"><?php echo $pro->property_title ?> </h4>
        </div>
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Home </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"> Property Details </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </header>

    <div class="spacer-60"></div>
    <div class="container">
        <div class="row">
            <!-- Proerty Details Section -->
            <section id="prop_detal" class="col-md-8">
                <div class="row">
                    <div class="panel panel-default">
                        <!-- Proerty Slider Images -->

                            
                        
                        <div class="panel-image">
                        <?php if (!empty($pro->images)): ?>   
                            <ul id="prop_slid">
                                <?php foreach ( $pro->images as $img ): ?>
                                <li>
                                    <img class="img-responsive" src="<?php echo getuploadpath().'property/'.$img->image_name; ?>" alt="">
                                </li>
                                <?php endforeach ?>
                            </ul>
                            <!-- Proerty Slider Thumbnails -->
                            <div class="col-md-12 rel_img">
                                <ul id="slid_nav">

                                     <?php $i =0; foreach ( $pro->images as $img ): ?>
                                    <li>
                                        <a data-slide-index="<?php echo $i; ?>" href=""><img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$img->image_name; ?>" alt="">
                                        </a>
                                    </li>
                                    <?php $i++; endforeach ?>
                                </ul>
                            </div>
                            <div class="clearfix"></div>

                        <?php else: ?>
                        <div class="col-md-12 rel_img">
                            <img class="img-responsive img-hover" src="<?php echo getuploadpath().'property/'.$pro->feature_image; ?>" alt="">
                        </div>
                        <?php endif ?>
                        </div>
                       
                        <div class="panel-body">
                            <div class="prop_feat">


                                <p class="area"><i class="fa fa-home"></i> <?php echo $pro->built_up_area ?> Sq.ft</p>
                                <p class="bedrom"><i class="fa fa-bed"></i> <?php echo $pro->beds ?> Bedrooms</p>
                                <p class="bedrom"><i class="fa fa-tint"></i><?php echo $pro->bathrums ?> Bath rooms</p>
                                 <p class="category-type"><i class="fa fa-building"></i> <?php echo ucfirst($pro->category) ?></p>
                            </div>

                            <h3 class="sec_titl">
                               <?php echo $pro->property_title ?>
                            </h3>

                            <div class="col_labls larg_labl">

                                <p class="or_labl">For <?php echo ucfirst( $pro->property_action ) ?></p>
                                <p class="blu_labl">Rs.<?php echo  convertNumber($pro->cost) ?></p>

                            </div>

                            <p class="sec_desc">
                                <?php echo $pro->property_content ?>
                            </p>
                            <!-- Proerty Additional Info -->
                            <div class="prop_addinfo" id="other_info">
                                <h2 class="add_titl">
                                    Your Other Bids
                                </h2>

                                <div class="info_sec first">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-2 col-xs-2 ">
                                            Images    
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            Property
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            Base Price
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            Last Bid
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            Amount    
                                        </div>
                                        
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            Action
                                        </div>  
                                    </div>
                                     <hr>
                                    <?php if ($customerOtherBids): ?>
                                    <?php $i = 1; foreach ($customerOtherBids as $c): ?>
                                        
                                        <div class="row">
                                        <?php $id = $i; 

                                        $attributes1 = array('class' => 'form-horizontal', 'id' =>$id,'name'=>$id );
                                        echo form_open('bid/bidsubmit', $attributes1);  ?>
                                        <input type="hidden" value="<?php echo $c->property_id ?>" name="property_id">

                                            <div class="col-md-2 col-sm-2 col-xs-2">
                                                <img src="<?php echo getuploadpath().'property/'.$c->feature_image; ?>" class="img-responsive">    
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2">
                                                <?php echo $c->property_title ?>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2">
                                                <?php echo $c->cost ?>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2" id="last-bid-<?php echo $i ?>">
                                                <?php echo $c->amount ?>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2" id="amount-<?php echo $i ?>">
                                                <?php echo $c->amount + $c->bid_difference ?>    
                                            </div>
                                            
                                            <div class="col-md-2">
                                                 <button type="button" onclick= "submitfrm(<?php echo $i; ?>)" data-id="<?php echo $i ?>" class="placebid btn btn-primary"><i class="fa fa-gavel"></i> Bid</button>
                                            </div>  
                                        </div>


                                        <hr>
                                        </form>
                                      <?php $i++; endforeach ?>    
                                    <?php else: ?>
                                        <div class="row">
                                            <hr>
                                            <div class="col-md-12 text-center">
                                                No bid found 

                                            </div>
                                        </div>
                                    <?php endif ?>
                                    
                                </div>
                            </div>
                            
                            <div class="spacer-30"></div>
                            
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="spacer-30"></div>
        </section>

            <!-- Sidebar Section -->
            <section id="sidebar" class="col-md-4">
                <!-- Search Form -->
                <div class="row">
                    <div id="loadmembid"></div>
                </div>
                
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="srch_frm">
                            <h3>Bidding Details</h3>
                            <?php 
                                $attributes = array('class' => 'form-horizontal', 'id' => 'frmbid','name'=>'sentMessage' );
                                echo form_open('bid/bidsubmit', $attributes);  ?>
                                <input type="hidden" name="property_id" id="property_id" value="<?php echo $pro->property_id ?>">
                                <div class="control-group form-group">
                                <div class="controls">
                                <table>
                                    <tr>
                                        <td style="padding-right: 10px;"><label>Base Price </label>
                                        <input type="text" class="form-control" disabled="disabled" id="" value="<?php echo convertNumber($pro->cost) ?>" name="" placeholder="Base Price">
                                       </td>
                                    
                                       <td>
                                    
                                        <?php if ($pro->bid): ?>
                                   
                                        <label>Last Bid</label>
                                        <input type="text" class="form-control" disabled="disabled" id="last_bid"  value="<?php echo $pro->bid->amount ?>" name="" placeholder="Last Bid">
                                      
                                     
                                        <?php $amount = $pro->bid_difference + $pro->bid->amount  ?>
                                        <?php else: ?>
                                            
                                        <label>Last Bid</label>
                                        <input type="text" class="form-control" id="last_bid" disabled="disabled"  value="<?php echo $pro->cost ?>" name="" placeholder="Last Bid">
                                        </td>
                                    </tr>
                                   
                                            <?php $amount = $pro->cost + $pro->bid_difference ?>
                                            <?php endif ?>
                                
                                    <tr>
                                        <td style="padding-right: 10px;">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" name="amount" placeholder="Amount">
                                        </td>

                                                  <p class="help-block"></p>
                                        <td style="padding-top: 20px;">
                                <!-- For success/fail messages -->
                                            <button type="submit" id="placebid"  class="btn btn-primary"><i class="fa fa-gavel"></i> Place Bid</button>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="spacer-30"></div>

                

            </section>

            <div class="spacer-60"></div>

        </div>
    </div>

 <?php endforeach ?>
<?php echo Modules::run( 'footer/footer/index' ); ?>
<script src="<?php echo site_url( 'front/views/themes/default' ); ?>/assets/scripts/jquery.bxslider.min.js"></script>

<div id="bid-over-msg" class="modal fade" data-controls-modal="bid-over-msg" aria-hidden="true"
   data-backdrop="static" data-keyboard="false" href="#">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="log_form text-center">
                    <h2 > Bid Time is over </h2>
                    <p>Please See here bid result </p><a href="<?php echo site_url('bid/bidover-property/'.$pro->property_slug) ?>"><?php echo ucfirst($pro->property_title) ?></a></a>
                </div>
            </div>
        </div>
    </div>
</div>






<script>
$('#mainSpinner').hide();
    /* Product Slider Codes */
    $(document).ready(function () {
        'use strict';
        $('#prop_slid').bxSlider({
            pagerCustom: '#slid_nav'
        });
        
    });

$('#placebid').click(function(e){
       e.preventDefault()
        var form = $('#frmbid');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
               $('#amount').val(response.amount);
               $('#last_bid').val(response.last_bid);
                loadotherbidData();
            };
            showMessage(response.Type,response.Message);
          }
        });
});

function submitfrm(id){
       //var id = $(this).data('id')
      
        var form = $('#'+id);
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
                $('#amount-'+id).html(response.amount);
                $('#last-bid-'+id).html(response.last_bid);
                //loadotherbidData();
            };
            showMessage(response.Type,response.Message);
          }
        });
}

function loadotherbidData(){
    data = {
        ajax :'1'
    }
    $.ajax({
          type: "get",
          url: '<?php echo site_url("bid/getCustomerBids") ?>',
          data:data,
          success: function( response ) {
                $('#other_info').html(response)
            }
        });

}
setInterval(function(){ 
   loadotherbidData(); 
   //checkBidTimeOver(); 

    getlastbid()
        $('#mainSpinner').hide();
    }, 4000

);

 


 
function checkBidTimeOver(){
    data = {
        ajax :'1'
    }
    $.ajax({
      type: "get",
      url: '<?php echo site_url("bid/checkBidtimeov") ?>',
      data:data,
      dataType:"json",
      success: function( response ) {
        if(response.response==0){
            $('#bid-over-msg').modal({backdrop: 'static', keyboard: false})
             var audio = new Audio('<?php echo site_url("front/views/themes/default"); ?>/assets/audio/buzz.mp3');
            $('#bid-over-msg').modal('show');

        }
      }
    });
}
function getlastbid(){
    data = {
        property_id : $('#property_id').val()
    }
    $.ajax({
      type: "get",
      url: '<?php echo site_url("bid/getlastbid") ?>',
      data:data,
      dataType:"json",
      success: function( response ) {
            var audio = new Audio('<?php echo site_url("front/views/themes/default"); ?>/assets/audio/ding.mp3');
            var oldamount = $('#amount').val();
            

            if (oldamount < response.amount) {
                audio.play();
            };    
            $('#amount').val(response.amount);

            $('#last_bid').val(response.last_bid);

      }
    });
}

function getLoadLastBid(){
     
     data = {
        property_id : $('#property_id').val()
    }
    $.ajax({
      type: "get",
      url: '<?php echo site_url("bid/getLatestMembers") ?>',
      data:data,
      success: function( response ) {
        $('#loadmembid').html(response);
        //setTimeout(getLoadLastBid, 3000);  
        $('#mainSpinner').hide();    
      }
    });
}
//getLoadLastBid(); 
setInterval(getLoadLastBid,3000);

$(document).on('ajaxSend', function(){
    $("#mainSpinner").hide();
   
}).on('ajaxComplete', function(){
    $("#mainSpinner").hide();
    
});
</script>
<script type="text/javascript">
$('#bodyDiv, #scrollbox3').enscroll({
    showOnHover: true,
    verticalTrackClass: 'track3',
    verticalHandleClass: 'handle3'
});
</script>
</body>

</html>
