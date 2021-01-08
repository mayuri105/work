<div>
   <form action="<?= site_url('orders/addtocartOrder'); ?>" method="post" id="addtocartfrm" name="addtocart">
    <input type="hidden" value="<?= $products->products->product_id ?>" name="product_id">
    <input type="hidden" value="<?= $products->products->product_name ?>" name="product_name">
    <input type="hidden" value="<?= $products->products->price;?>" name="price">

    <div class="model-body">
    <div class="col-sm-12">
        <h2>
            <?= $products->products->product_name ?>
            $<?= $products->products->price ?>
        </h2>

       
            <?php foreach ($products->product_option as $po) { ?>
                <div id="hiddentext">
                    <h3><?= $po->option_name ?></h3>
                        <?php if ($po->required){ ?>
                            <span>
                                <span class="required">(Required - Choose <?= $po->multiple ? 'Multiple' : '1'; ?>) </span>
                            </span>
                            <?php }else{ ?>
                            <span>
                                <span class="required">(Optional - Choose <?= $po->multiple ? 'Multiple' : '1'; ?>) </span>
                            </span>
                        <?php } ?>
                        <?php 
                        $this->load->model('order_model');
                        $options = $this->order_model->getoption($po->option_id);

                        foreach ($options as $opt){ 
                         if ($po->multiple) { ?>
                                <div class="form-group">
                                    <label><input type="checkbox" name="option[]" value="<?= $opt->po_id ?>" ><?= $opt->option_value ?>
                                    $<?= $opt->price; ?>
                                    </label>
                                </div>

                            <?php }else{  ?>
                            <div class="form-group">
                                <label><input type="radio" name="option[]" value="<?= $opt->po_id ?>"><?= $opt->option_value ?>
                                $<?= $opt->price; ?>
                                </label>
                             </div>   
                            <?php } ?>
                        <?php } ?>
                 </div>   
            <?php } ?>
            
       <textarea id="special-instr" name="special_instruction" placeholder="Special instructions (optional)"  class="form-control"></textarea>
       <div class="pb"></div>
        
         <span class="">
            <a onclick="stepDown()" class="spinner-control step-down">–</a>
                <input id="item-quantity" name="qty" type="number"  step="1" value="1" class="qty-not-zero">
            <a onclick="stepUp()" class="spinner-control step-up">+</a>
        </span>
    </div>
    </div>
    <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a type="" id="addtocart" class="btn btn-primary">Add</a>

    </div>
    </form>
</div>
<script type="text/javascript">

    $('#addtocart').click(function(){
        
        var form = $('#addtocartfrm');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if(response){
                $('#cart').html(response)
                $('#total').html(response)
                 
            }
          }
        });
    });
    
function stepDown(){
    var currnt = $('#item-quantity').val();
    var newvalue = parseInt(currnt)-1;
    if(newvalue!=0){
        $('#item-quantity').val(newvalue);
    }
    return false;
}
function stepUp(){
    var currnt = $('#item-quantity').val();
    var newvalue = parseInt(currnt)+1;
    $('#item-quantity').val(newvalue);
    return false;
}
</script>
