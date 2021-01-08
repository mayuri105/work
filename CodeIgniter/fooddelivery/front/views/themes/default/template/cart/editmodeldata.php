<div class="item-option-display new-styleguide">
   
    <header class="active-item-header"></header>
    <form name"addtocartfrm" id="addtocartfrm" action="<?= site_url('cart/updateCart') ?>" method="post">
    <input type="hidden" value="<?= $products->products->product_id ?>" name="product_id">
    <input type="hidden" value="<?= $products->products->product_name ?>" name="product_name">
    <input type="hidden" value="<?= $products->DiscountPrice ?>" name="price">
    <input type="hidden" value="<?= $product_cart->rowid;?>" name="rowid">
    <input type="hidden" value="<?= $products->products->store_id ?>" name="store_id">
    <div class="item-option-content" style="min-height: 240px; max-height: calc(100vh - 160px);">
        <!-- ngIf: itemImage(item) -->
        <div class="item-info">
            <h2 class="info-title">
                <div class="name">
                	<?= $products->products->product_name ?>
                </div>
                    <div class="price"> 
                        <?php if ($products->products->price != $products->DiscountPrice): ?>
                            <del>$<span class="amount"><?= $products->products->price; ?></span></del>
                        <?php endif ?>
                        $<?= $products->DiscountPrice ?></div>
            </h2>
            
        </div>
    
        <div class="item-options">
            <?php foreach ($products->product_option as $po) { ?>
            <div  class="option-group" >
                <header class="option-group-header required" >

                    <h3 ><?= $po->option_name ?></h3>
                    <div class="instructions">
                    	<?php if ($po->required){ ?>
                    	<span>
                    		<span class="required">(Required - Choose <?= $po->multiple ? 'Multiple' : '1'; ?>) </span>
                   		</span>
                   		<?php }else{ ?>
                        <span>
                            <span class="required">(Optional - Choose <?= $po->multiple ? 'Multiple' : '1'; ?>) </span>
                        </span>
                        <?php } ?>
                    </div>
                    
               
                <div  class="options">
                    <div>

                    	<?php 
                        $this->load->model('cart_model');
                        $options = $this->cart_model->getOption($po->option_id);

                        foreach ($options as $opt) { 
                            
                         if ($po->multiple) { ?>
                        
                            <div class="checkbox">
                                <label>
                                    <?php if ($product_cart->productOpt['product_option']): ?>
                                    <input type="checkbox" name="option[]" value="<?= $opt->po_id ?>" <?= $po->required ? 'required' : '' ?> <?= in_array($opt->po_id, $product_cart->productOpt['product_option']) ? 'checked' :'' ?> ><?= $opt->option_value ?>

                                    <?php else: ?>
                                     <input type="checkbox" name="option[]" value="<?= $opt->po_id ?>" <?= $po->required ? 'required' : '' ?>><?= $opt->option_value ?>
                                    <?php endif; ?>
                                </label>
                            <div class="price ">$<?= $opt->price; ?></span></div>
                            
                            </div>
                           
                            <?php }else{  ?>
                            
                            <div class="radio">
                              <label>
                                 <?php if ($product_cart->productOpt['product_option']): ?>
                                <input type="radio" name="option[]" value="<?= $opt->po_id ?>" <?= $po->required ? 'required' : '' ?> <?= in_array($opt->po_id, $product_cart->productOpt['product_option']) ? 'checked' :'' ?> ><?= $opt->option_value ?>
                                <?php else: ?>
                                <input type="radio" name="option[]" value="<?= $opt->po_id ?>" <?= $po->required ? 'required' : '' ?>  ><?= $opt->option_value ?>
                                 <?php endif; ?>
                                </label>
                              <div class="price ">$<?= $opt->price; ?></span></div>
                             </div>
                            
                            <?php } ?>
                        
                        <?php } ?>
                    </div>

                </div>
                 </header>
            </div>

            <?php } ?>
        </div>
        <div class="item-form">
           
            <div class="form-field special-instructions">
                <textarea id="special-instr" name="special_instruction" placeholder="Special instructions (optional)"  class="ng-pristine ng-untouched ng-valid ng-valid-maxlength"><?= $product_cart->productOpt['special_instruction'] ?></textarea>
            </div>
            <div class="form-field footer-notes ng-hide"></div>
        </div>
        
    </div>
    <div class="action fixed-cta">
        <div  class="form-field item-quantity">
            <span class="qty-spinner ng-pristine ng-untouched ng-valid">
                 <a onclick="stepDown()" class="spinner-control step-down">–</a>
                <span class="spinner-input-wrapper">
                    <input id="item-quantity" name="qty" type="number" step="1" value="1" class="qty-not-zero">
                </span> 
                <a onclick="stepUp()" class="spinner-control step-up">+</a>
               
            </span>
        </div>
         
      <button type="button" tooltip="Your cart is missing required items" id="addtocart"  class="button primary ">
        <span  class="contents">
            <span class="cta">Add to cart</span>
            
        </span>
        <span class="spinner"></span>
        </button >
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
                $('#cartWrapper').html(response);
                $('.item-option-modal,.modal-backdrop').css({"display":"none","z-index":"0"});
                $('.item-option-modal,.modal-backdrop').removeClass('in');
                 var el = document.querySelector('.odometer');
                 var  totalamount = $(response).find('.grandtotal').text();
                 var pointValue = '<?= $pointsvalue; ?>';
                od = new Odometer({
                  el: el,
                  format: '',
                  theme: 'digital'
                });
                od.update(parseInt(totalamount*pointValue))
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