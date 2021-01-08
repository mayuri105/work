<?php echo Modules::run('header/header/account'); ?>
<div class="page-wrapper">
    <div id="page-header-wrapper">
        <div id="page-header">
            <!-- page header contents -->
            <h1>Your account</h1>
        </div>
    </div>
    <div id="main-content-wrapper" >
        <div id="main-content">
           <div  class="page-profile">
                <div class="side-nav" >
                    
                    <div class="account-side-nav">
                        <div class="account-pages">
                            
                            
                            <div class="link "><a href="<?= site_url('account/orders') ?>">Order history</a></div>
                            
                            <div class="link" ><a href="<?= site_url('account/tell-a-friend') ?>">Tell a friend</a></div>
                            
                            <div class="link " ><a href="<?= site_url('account/profile') ?>">Profile</a></div>
                            
                            <div class="link active" ><a href="<?= site_url('account/addresses') ?>">Addresses</a></div>
                          
                            <!-- <div class="link"><a href="<?= site_url('account/cards') ?>">Credit cards</a></div> -->
                            
                            <div class="link"><a href="<?= site_url('account/wallets') ?>">Wallets</a></div>
                            
                        </div>
                    </div>
                  
                </div>
                <!-- page content -->
                <div class="content">
                <div class="heading">
                    <h3>Addresses</h3>
                </div>
                 <div class="list">
                    <?php if($address){ foreach ($address->customer_address as $a ): ?>
                        
                    
                    <div class="rows open-form" id="address_<?= $a->address_id; ?>">
                        <div class="closed-form">
                            <div class="info-container">
                                <div class="name"></div>
                                <div class="details">
                                    <span class="address">
                                        <span class="type-and-address">
                                            
                                        </span>
                                        <?= $a->street_address; ?>
                                    </span>
                                </div>
                                <div class="number-city-state">
                                    <?= ucfirst($a->city); ?>, <?= $a->state; ?> 
                                    <span>|<?= $a->phone_no; ?> 
                                    </span>
                                </div>
                            </div>
                            <span class="icon-trash" onclick="deleteAddress('<?= $a->address_id; ?>')"></span> 
                            <span class="icon-pencil" onclick="toggleeditaddress('<?= $a->address_id; ?>')"></span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?php endforeach; }else{ ?>
                    <div class="no-addresses">You have no saved addresses.</div>
                    <?php } ?>
                </div>   
                <div class="listfrom ng-hide" >
                    
                    <div >
                        <div class="form-container">
                            <div class="error-messages">
                                
                            </div>
                            <form class="address-form" name="addressform">
                                <div class="street-unit-wrapper field-wrapper">
                                    <div class="street-address">
                                    <input  type="hidden" id="address_id" value="">    
                                        <label >Street address *</label>
                                        <input type="text" id="street" class="" name="street">
                                    </div>
                                    <div class="unit">
                                        <label >Apt / suite / company name</label>
                                        <input type="text" id="apt" >
                                    </div>
                                </div>
                                <div class="city-state-zip-phone field-wrapper">
                                    <div class="city">
                                        <label >City*</label>
                                        <input  type="text" id="city" name="city">
                                    </div>
                                    <div class="state">
                                        <label >State*</label>
                                        <select  id="state" name="state">
                                            <option value="">Select a state</option>
                                            <?php foreach ($states as $s ): ?>
                                                  <option value="<?= $s->code ?>"><?= $s->name ?></option>  
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="zip">
                                        <label >Zip code*</label>
                                        <input type="text" id="zip" maxlength="6" name="zip">
                                    </div>
                                    <div class="phone">
                                        <label >Phone number*</label>
                                        <input  type="tel" id="phone" maxlength="14" name="phone" >
                                    </div>
                                </div>
                                <div class="add-wrapper field-wrapper">
                                    <button type="button" id="addaddress" class="button primary">
                                        <span class="contents">
                                            <span>Add address</span>
                                        </span>
                                        <span class="spinner"></span>
                                    </button>
                                    <div class="cancel" onclick="toggleForm()"><a>Cancel</a></div>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>

                
                <div class="add-edit-address"  onclick="toggleAddAddressForm();">
                    <span class="icon-plus"></span>Add address</div>
            </div>
            </div>
        </div>
    </div>
</div>


<script>
    function setblank(){
        $('.listfrom #address_id').val('');
        $('.listfrom #street').val('');
        $('.listfrom #apt').val('');
        $('.listfrom #city').val('');
        $('.listfrom #zip').val('');
        $('.listfrom #state').val('');
        $('.listfrom #phone').val('');
        $('.listfrom #addaddress').html('<span class="contents"><span>Add address</span></span><span class="spinner"></span>');
       
    }
    function toggleAddAddressForm(){
        setblank()
        $('.listfrom').removeClass('ng-hide');
        $('.add-edit-address,.no-addresses').toggle();
    }
    function toggleForm(){
        $('.listfrom').addClass('ng-hide');
         setblank();
    }
    function toggleeditForm(address_id){
        $('.listfrom').addClass('ng-hide');
        $('.add-edit-address,.no-addresses').toggle();
        $('#address_'+address_id+'').removeClass('ng-hide');
        setblank();
    }
    function deleteAddress(address_id){
           
            var url = "<?php echo site_url('account/deleteaddress') ?>/"+address_id+"";
            var $tr = $(this).closest('tr');
            alertify.confirm("Are you sure you want to Delete this Address ?", function (result) {
                if (result) {
                    $.ajax({
                        url : url,
                        type: "GET",
                        success:function(data){
                           
                            alertify.success('Deleted');

                            $('#address_'+address_id+'').remove();
                        }
                    });
       
                } else {
                  
                }
            });

    }
    function toggleeditaddress(address_id){
        var check = $( ".listfrom" ).hasClass( "ng-hide" );
        if(!check){
            return false;
        }        
        $('.listfrom').removeClass('ng-hide');

        $('.add-edit-address,.no-addresses').toggle();
        $('#address_'+address_id+'').addClass('ng-hide');   
        var data = {
            address_id : address_id
        }
        $.ajax({
            url:"<?php echo site_url('account/getaddress'); ?>",
            type:"POST",
            dataType:"json",
            data:data,
            success:function(data){
                $('.listfrom #address_id').val(data.address_id);
                $('.listfrom #street').val(data.street_address);
                $('.listfrom #apt').val(data.apt_name);
                $('.listfrom #city').val(data.city);
                $('.listfrom #zip').val(data.zip);
                $('.listfrom #state').val(data.state);
                $('.listfrom #phone').val(data.phone_no);
                $('.listfrom #addaddress').html('<span class="contents"><span>Save address</span></span><span class="spinner"></span>');
                var edit = "toggleeditForm("+data.address_id+");";
                $(".listfrom .cancel").attr("onclick", edit);
            }   


        });

    }
    $('#addaddress').click(function(){
        address_id = $('#address_id').val();
          var data = {
            address_id :$('#address_id').val(),
            street :$('#street').val(),
            apt :$('#apt').val(),
            city :$('#city').val(),
            state :$('#state').val(),
            zip :$('#zip').val(),
            phone :$('#phone').val(),
        };
        
        $.ajax({
        url : "<?php echo site_url('account/addaddress') ?>",
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
                    if (address_id) {
                        $("#address_"+address_id+"").remove();
                        $('.list').append('<div class="rows open-form" id="address_'+address_id+'"><div class="closed-form"><div class="info-container"><div class="name"></div><div class="details"><span class="address"><span class="type-and-address"></span>'+data[0].street_address+' </span></div><div class="number-city-state">'+data[0].city+', '+data[0].state+' <span ng-show="address.phone">|'+data[0].phone_no+'</span></div></div><span class="icon-trash" onclick="deleteAddress('+data.address_id+')"></span><span class="icon-pencil" onclick="toggleeditaddress('+data.address_id+')"></span></div></div>');
                    
                    }else{
                       $('.list').append('<div class="rows open-form" id="address_'+data.address_id+'"><div class="closed-form"><div class="info-container"><div class="name"></div><div class="details"><span class="address"><span class="type-and-address"></span>'+data[0].street_address+' </span></div><div class="number-city-state">'+data[0].city+', '+data[0].state+' <span ng-show="address.phone">|'+data[0].phone_no+'</span></div></div><span class="icon-trash" onclick="deleteAddress('+data.address_id+')"></span><span class="icon-pencil" onclick="toggleeditaddress('+data.address_id+')"></span></div></div>');
                    
                    }
                   
                     $('.listfrom').addClass('ng-hide');
                    $('.add-edit-address,.no-addresses').show();
                }
            },3000);  
        }
        });
    });

    
    
</script>

<?php echo Modules::run('footer/footer/account'); ?>
