<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| Edit JMD AMC </title>
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/AdminLTE.min.css">
 <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-datepicker3.css"/>

  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/skins/_all-skins.min.css">

  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
.error {
  
  
  color:#F00;
  
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <?php echo Modules::run('header/header/index'); ?>
  <?php echo Modules::run('menu/menu/index'); ?>
  <div class="content-wrapper">
   
    <section class="content-header">
      
      <ol class="breadcrumb">
        <li><a href="<?= site_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit JMD AMC </li>
      </ol>
    </section>

   
    <section class="content">

     <div class="row">
      
        <div class="col-xs-12">
         <br>
          <br>
           <br>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit JMD AMC </h3>
            </div>
            
          <?php 

            $attributes = array('id' => 'plus');

            echo form_open_multipart('amc/update', $attributes);  ?>
              <div class="box-body">
              <?php echo Modules::run('messages/message/index'); ?>
               
               <input type="hidden" value="<?= $plus->amc_id ?>" name="amc_id">
                
                  
                 <div class="col-xs-6">
                <div class="form-group">
                  <label>Beneficiary Name</label>
                  <input type="text" class="form-control" placeholder="Beneficiary Name" name="customer" value="<?= $plus->customer ?>">
                </div>
                </div>
                <div class="col-xs-6">
                <div class="form-group">
                  <label> Beneficiary Mobile No</label>
                  <input type="text" class="form-control" placeholder="Beneficiary Mobile No" name="mob_no" value="<?= $plus->mob_no ?>">
                </div>
                </div>
                 <div class="col-xs-12">
                <div class="form-group">
                  <label> Beneficiary Address</label>
                  <textarea class="form-control" placeholder="Beneficiary Address" name="address"><?= $plus->address ?></textarea>
                </div>
                </div>
                 <div class="col-xs-12">
                <div class="col-xs-4">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="Email" name="email" value="<?= $plus->email ?>">
                </div>
                </div>
                <div class="col-xs-4">
                <div class="form-group">
                  <label>Registration No. of Car under the scheme</label>
                  <input type="text" class="form-control" placeholder="Registration No" name="reg_no" value="<?= $plus->reg_no ?>">
                </div>
                </div>
                
                 <div class="col-xs-4">
                <div class="form-group">
                  <label>Make / Model / Variant</label>
                   <input type="text" class="form-control" value="<?= $plus->make ?>" placeholder="Make / Model / Variant" name="make">
                </div>
                </div>
                 </div>
                
                <div class="col-xs-12">
                  <div class="col-xs-4">
                    <div class="form-group">
                    <label>Plan valid from</label>
                  <input type="text" class="form-control"  value="<?= $plus->validity_from_date ?>" placeholder="Certificate From Date" name="validity_from_date"> 
              </div> 
               </div> 
              <div class="col-xs-4"> 
               <div class="form-group">
               <label>Plan valid to</label>
              <input type="text" class="form-control" value="<?= $plus->validity_to_date ?>"  placeholder=" Certificate To  Date" name="validity_to_date">
              </div>
              </div>
              <div class="col-xs-4"> 
               <div class="form-group">
               <label>Kilometer</label>
              <input type="text" class="form-control" value="<?= $plus->km ?>"  placeholder=" Kilometer" name="km">
              </div>
              </div>
              </div>
                  <div class="col-xs-12">
                      <div class="col-xs-3">
                <div class="form-group">
                  <label>Amount</label>
                  <input type="text" class="form-control" placeholder="Amount" id="amount" name="amount"  readonly="readonly"  value="<?= $plus->amount ?>">
                </div>
                </div>
                <div class="col-xs-3">
                    <input type="hidden" class="form-control"  id="gst" name="gst" value="<?php echo $gst;?>">
                <div class="form-group">
                  <label>SGST(<?php echo $gst;?>%)</label>
                  <input type="text" class="form-control" placeholder="SGST(%)" id="tax1per"   readonly="readonly" name="sgst" value="<?= $plus->sgst ?>" >
                </div>
                </div>
                <div class="col-xs-3">
                <div class="form-group">
                  <label>CGST(<?php echo $gst;?>%)</label>
                  <input type="text" class="form-control" placeholder="CGST(%)" name="cgst"  readonly="readonly" id="tax2per" value="<?= $plus->cgst ?>"  >
                </div>
                </div>
                <div class="col-xs-3">
                <div class="form-group">
                  <label>Total Amount Rupees</label>
                  <input type="text" class="form-control" placeholder="Total Amount Rupees" name="total_amt" id="total_amt" value="<?= $plus->total_amt ?>">
                </div>
                </div>
                <div class="col-xs-6">
                <div class="form-group">
                  <label>Date of Registration</label>
                  <input type="text" class="form-control" placeholder="Date of Registration" name="registration_date"  value="<?= $plus->registration_date ?>">
                </div>
                </div>
               <div class="col-xs-6">
                <div class="form-group">
                  <label>Customer GSTIN NO</label>
                  <input type="text" class="form-control" placeholder="Customer GSTIN NO" name="gstin_no" value="<?= $plus->gstin_no ?>">
                </div>
                </div>
              </div>
            

              <div class="box-footer">
               <a href="<?= site_url('amc') ?>" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

          </div>
          </div>
      

    </section>
  
  </div>
  

 <?php echo Modules::run('footer/footer/index'); ?>

 
      
  
</div>

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.min.js"></script>

<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script type="text/javascript" src="<?= site_url('front/views/themes/default') ?>/assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/fastclick/lib/fastclick.js"></script>

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/adminlte.min.js"></script>
<script>
    $(document).ready(function(){
        var date_input=$('input[name="registration_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="validity_to_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
 
  $(document).ready(function(){
        var date_input=$('input[name="validity_from_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
   $(document).ready(function(){
   $('#total_amt').on('input',function(e){
    var am = $('#total_amt').val();
    var amnt= parseFloat(am) * parseInt(100) / parseInt(118) ;
      var gs = $('#gst').val();
       
    //alert(am);
    var tas = parseInt(gs) *  parseFloat(amnt) / parseInt(100);
     //alert(tas);
    var tac = parseInt(gs) *  parseFloat(amnt) / parseInt(100);
    //var total= parseFloat(am) * parseInt(100) / parseInt(118) ;
    //var total = parseFloat(amnt) + parseFloat(tas) + parseFloat(tac);
   document.getElementById('amount').value=  parseFloat(amnt).toFixed(2);
   document.getElementById('tax2per').value=  parseFloat(tac).toFixed(2);;
   document.getElementById('tax1per').value= parseFloat(tas).toFixed(2);;
    //$('#total_amt').html("total");
     //alert(total);
});
   })
</script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $("#plus").validate(
      {
        rules: 
        {
          
          registration_date: 
          {
            required: true
            
          },
           customer: 
          {
            required: true
            
          },
          address: 
          {
            required: true
            
          },
           mob_no: 
          {
            required: true
            
          },
           email: 
          {
            required: true
            
          },
           reg_no: 
          {
            required: true
            
          },
           make: 
          {
            required: true
            
          },
           model: 
          {
            required: true
            
          },
           validity_from_date: 
          {
            required: true
            
          },
           validity_to_date: 
          {
            required: true
            
          }
          ,
           amount: 
          {
            required: true
            
          },
          sgst: 
          {
            required: true
          }
          ,
          cgst: 
          {
            required:true
          },
          total_amt: 
          {
            required: true
            
          },
          km: 
          {
            required: true
            
          }
        },
        messages: 
        {
          
          registration_date: 
          {
            required: "Please enter certificate date."
          }
          ,
          customer: 
          {
            required: "Please enter beneficiary name."
          }
          ,
          address: 
          {
            required: "Please enter beneficiary address ."
          }
          ,
          mob_no: 
          {
            required: "Please enter beneficiary mobile no."
          }
          ,
          email: 
          {
            required: "Please enter email."
          }
          ,
          reg_no: 
          {
            required: "Please enter registration no."
          }
          ,
          make: 
          {
            required: "Please enter Make / Model / Variant."
          }
          ,
          validity_from_date: 
          {
            required: "Please enter certificate from date ."
          }
          ,
          validity_to_date: 
          {
            required: "Please enter certificate to date."
          }
          ,
          amount: 
          {
            required: "Please enter  ammount."
          }
          ,
          sgst: 
          {
            required: "Please enter SGST."
          }
          ,
          cgst: 
          {
            required: "Please enter CGST."
          }
          ,
          total_amt: 
          {
            required: "Please enter  total ammount."
          }
          ,
          km: 
          {
            required: "Please enter  total KM."
          }
        }
      });   
    
    
</script>
</body>
</html>
