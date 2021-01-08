<div class="info_sec first">
     <h2 class="add_titl">
        Your Other Bids
    </h2>
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
                <div class="col-md-2 col-sm-2 col-xs-2" id="last-bid-<?php echo $id ?>">
                    <?php echo $c->amt ?>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2" id="amount-<?php echo $id ?>">
                    <?php echo $c->amt + $c->bid_difference ?>    
                </div>
                
                <div class="col-md-2">
                     <button type="button" onclick= "submitfrm('<?php echo $i; ?>')" data-id="<?php echo $i ?>" class="placebid btn btn-primary"> <i class="fa fa-gavel"></i> Bid</button>
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
<script type="text/javascript">
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

</script>