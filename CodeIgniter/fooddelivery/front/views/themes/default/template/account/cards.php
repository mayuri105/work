<?php echo Modules::run('header/header/account'); ?>
	  


<div class="page-wrapper">
    <div id="page-header-wrapper">
        <div id="page-header">
            <h1>Your account</h1>
        </div>
    </div>
    <div id="main-content-wrapper" >
        <div id="main-content">
           <div  class="page-profile">
                <div class="side-nav" >
                    
                    <div class="account-side-nav">
                        <div class="account-pages">
                            
                            
                            <div class="link"><a href="<?= site_url('account/orders') ?>">Order history</a></div>
                            
                            <div class="link"><a href="<?= site_url('account/tell-a-friend') ?>">Tell a friend</a></div>
                            
                            <div class="link"><a href="<?= site_url('account/profile') ?>">Profile</a></div>
                            
                            <div class="link"><a href="<?= site_url('account/addresses') ?>">Addresses</a></div>
                          
                            <!-- <div class="link active"><a href="<?= site_url('account/cards') ?>">Credit cards</a></div> -->
                            <div class="link"><a href="<?= site_url('account/wallets') ?>">Wallets</a></div>
                        </div>
                    </div>
                  
                </div>
                <!-- page content -->
                <div class="content">
                    <div class="heading">
                        <h3>Credit cards</h3>
                    </div>
                    <div class="list">
                        <?php if($cards){ 
                         foreach ($cards->customer_card_details as $card): ?>
                            
                        
                        <div class="rows" id="card_<?= $card->cc_id  ?>">
                            <div class="info-container">
                                <div class="exp-date">

                                </div>
                                <div class="details">
                                   <span class="name">
                                        <?php $cardno = $this->encrypt->decode($card->credit_card_no)  ?>
                                        <?= FormatCreditCard($cardno); ?>
                                    </span>
                                    <span class="dcom-card-type">
                                        <span class="<?= cardType($cardno); ?>" ></span>
                                    </span>
                                </div>
                               
                            </div>
                            <span class="icon-trash"  onclick="deleteCard('<?= $card->cc_id  ?>')"></span> 
                            <span class="icon-pencil" onclick="toggleeditCard('<?= $card->cc_id  ?>')"></span>
                            
                        </div>
                        <?php  endforeach; }else{ ?>
                            <div class="no-cards">You have no saved cards.</div>
                        <?php } ?>
                    </div>
                    <div class="add-card" onclick="toggleAddcardForm()" >
                        <span class="icon-plus"></span>
                        Add new credit card
                    </div>
                    <!-- page content -->

                    <div class="form-container ng-hide" >
                        <div class="error-messages">
                        </div>
                        <form class="card-form listfrom">
                            <input type="hidden" id="cc_id">
                            <div>
                                <span class="dcom-card-type">
                                    <span class="visa" ></span>
                                    <span class="mastercard  " ></span>
                                    <span class="amex" ></span>
                                    <span class="discover">
                                    </span> 
                                    <span class="secure"></span>
                                </span>
                            </div>
                            <div class="cc-number">
                                <label>Credit card number</label>
                                <input class="inspectletIgnore" id="cc-card-number" type="text" maxlength="20" title="Please enter your credit card number with no hyphens">
                            </div>
                            <div class="date">
                                <div class="wrapper">
                                    <span class="exp-month">
                                        <label >Exp. month</label>
                                        <select id="cc-exp-month" >
                                            <option value="">none</option>
                                             <?php for ($i=1; $i<=12; $i++) { ?>
                                            <option value="<?= $i ?>" ><?= $i ?>
                                           </option>
                                        <?php } ?>
                                        </select>
                                    </span> 
                                    <span class="exp-year">
                                        <label>Exp. year</label>
                                        <select id="cc-exp-year" >
                                            <option value="">none</option>
                                             <?php 
                                                $firstYear = (int)date('Y');
                                                $lastYear = $firstYear + 20;
                                                for($i=$firstYear;$i<=$lastYear;$i++)
                                                {
                                                    echo '<option value='.$i.' >'.$i.'</option>';
                                                } ?>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="cvv-and-billingzip">
                                <div class="wrapper">
                                    <span class="cvv">
                                        <label >CVV</label>
                                        <input class="inspectletIgnore " type="text" id="cc-cvv"  maxlength="4"></span>
                                        
                                        <span class="billing-zip">
                                            <label >Billing zip</label>
                                            <input type="text" id="cc-billing-zip"  maxlength="5" >
                                        </span>
                                   
                                </div>
                            </div>
                            <button type="button"  id="addcard" class="button primary">
                                <span  class="contents">
                                    <span>Add credit card</span>
                                </span>
                                <span class="spinner"></span>
                            </button>
                            <div class="cancel" onclick="toggleForm()"><a>Cancel</a></div>
                        </form>
                    </div>

                </div>
             </div>
        </div>
    </div>
</div>

<!-- card validation -->
<script type="text/javascript">
    function getCreditCardType(accountNumber)
    {
      var result = "unknown";

      if (/^5[1-5]/.test(accountNumber))
      {
        result = "mastercard";
      }

      //then check for Visa
      else if (/^4/.test(accountNumber))
      {
        result = "visa";
      }

      //then check for AmEx
      else if (/^3[47]/.test(accountNumber))
      {
        result = "amex";
      }
      else if(/^6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65/.test(accountNumber)){
        result = "discover";
      }
      return result;
    }
    
    function handleEvent(event)
    {

      var value   = event.target.value,    
          type    = getCreditCardType(value);

      switch (type)
      {
        case "mastercard":
            $('.dcom-card-type .visa,.dcom-card-type .discover,.dcom-card-type .amex').addClass('card-inactive');
            break;
        case "visa":
            $('.dcom-card-type .mastercard,.dcom-card-type .discover,.dcom-card-type .amex').addClass('card-inactive');
            break;
        case "amex":
           $('.dcom-card-type .mastercard,.dcom-card-type .discover,.dcom-card-type .visa').addClass('card-inactive');
            break;
        case "discover":
           $('.dcom-card-type .mastercard,.dcom-card-type .amex,.dcom-card-type .visa').addClass('card-inactive');
            break;   
        default:
       }
    }
    document.addEventListener("DOMContentLoaded", function(){
      var textbox = document.getElementById("cc-card-number");
      textbox.addEventListener("keyup", handleEvent, false);
      textbox.addEventListener("blur", handleEvent, false);
    }, false);

</script>

<!-- end card validation -->
<script type="text/javascript">

$('#addcard').click(function(){
        var data = {
            cc_id :$('#cc_id').val(),
            cardnumber :$('#cc-card-number').val(),
            expmonth :$('#cc-exp-month').val(),
            expyear :$('#cc-exp-year').val(),
            cvv :$('#cc-cvv').val(),
            billingzip :$('#billing-zip').val(),
        };
        
        $.ajax({
        url : "<?php echo site_url('account/addcard') ?>",
        type: "POST",
        dataType: "json",
        data: data,
        beforeSend: function() {
                $('.button >.spinner').css("opacity", "1");
                $('.button >.spinner').css("display", "block");
                $('.button >.contents').css("display", "none");
        },
        success:function(data){
            setTimeout(function(){
                if(data.response ==0 ){
                    $('.button >.spinner').css("opacity", "0");
                    $('.button >.spinner').css("display", "none");
                    $('.button >.contents').css("display", "block");
                    $('.error-messages ').show();
                    $('.error-messages ').html(data.error);
                }else{
                    $('.button .spinner').css("opacity","0");
                    $('.button .spinner').css("display","none");
                    $('.button .contents').css("display","block");
                    $('.button .contents .icon-checkmark').removeClass("ng-hide");
                    $('.button .contents .icon-checkmark').css("display", "block");
                    $('.error-messages ').hide();

                    $('.list').append('<div class="rows" id="card_'+data.cc_id+'"><div class="info-container"><div class="details"><span class="name">'+data.credit_card_no+'</span><span class="dcom-card-type"><span class="'+data.cardtype+'" ></span></span></div></div><span class="icon-trash"  onclick="deleteCard('+data.cc_id+')"></span><span class="icon-pencil" onclick="toggleeditCard('+data.cc_id+')"></span></div>');
                     $('.form-container').addClass('ng-hide');
                    $('.add-card,.no-card').show();
                }
            },3000);  
        }
        });
    });

function toggleeditCard(cc_id){
        var check = $( ".form-container" ).hasClass( "ng-hide" );
            if(!check){
                return false;
            }        
        $('.form-container').removeClass('ng-hide');

        $('.add-card,.no-card').toggle();
        $('#card_'+cc_id+'').addClass('ng-hide');   
        var data = {
            cc_id : cc_id
        }
        $.ajax({
            url:"<?php echo site_url('account/getcard'); ?>",
            type:"POST",
            dataType:"json",
            data:data,
            success:function(data){
                var month = pad(data.exp_month);
                $('.form-container #cc_id').val(data.cc_id);
                $('.form-container #cc-card-number').val(data.credit_card_no);
                $('.form-container #cc-exp-month').val(month);
                $('.form-container #cc-exp-year').val(data.exp_year);
                $('.form-container #cc-cvv').val(data.cvv);
                $('.form-container #cc-billing-zip').val(data.billing_zip);
               
                $('.form-container #addcard').html('<span class="contents"><span>Save Card</span></span><span class="spinner"></span>');
                var edit = "toggleeditForm("+data.cc_id+");";
                $(".form-container .cancel").attr("onclick", edit);
            }   


        });
}
function pad(str) {
  str = str.toString();
  return str.length < 2 ? pad("0" + str) : str;
}
function setblank(){
    $('.form-container #card_id').val('');
    $('.form-container #cc-card-number').val('');
    $('.form-container #cc-exp-month').val('');
    $('.form-container #cc-exp-year').val('');
    $('.form-container #cc-cvv').val('');
    $('.form-container #billing-zip').val('');
    $('.form-container #addcard').html('<span class="contents"><span>Add Card</span></span><span class="spinner"></span>');
   
}
function toggleAddcardForm(){
    $('.form-container').removeClass('ng-hide');
    $('.add-card,.no-card').toggle();
}  
function toggleForm(){
    $('.form-container').addClass('ng-hide');
    $('.add-card,.no-card').toggle();
    setblank();
}
function toggleeditForm(cc_id){
        $('.form-container').addClass('ng-hide');
        $('.add-card,.no-card').toggle();
        $('#card_'+cc_id+'').removeClass('ng-hide');
        setblank();
}
function deleteCard(cc_id){
           
            var url = "<?php echo site_url('account/deletecard') ?>/"+cc_id+"";
            var $tr = $(this).closest('tr');
            alertify.confirm("Are you sure you want to Delete this Card ?", function (result) {
                if (result) {
                    $.ajax({
                        url : url,
                        type: "GET",
                        success:function(data){
                            alertify.success('Deleted');
                            $('#card_'+cc_id+'').remove();
                        }
                    });
       
                } else {
                  
                }
            });

    }        
</script>
<?php echo Modules::run('footer/footer/account'); ?>