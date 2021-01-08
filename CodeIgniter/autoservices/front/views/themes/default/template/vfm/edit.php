<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| Edit VFM</title>
 
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
        <li class="active">Edit  VFM</li>
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
              <h3 class="box-title">Edit VFM</h3>
            </div>
            
          <?php 

            $attributes = array('id' => 'cars');

             echo form_open_multipart('vfm/update', $attributes);  ?>
              <div class="box-body">
              <?php echo Modules::run('messages/message/index'); ?>
               <div class="col-xs-6">
               <input type="hidden" value="<?= $cares->vfm_id ?>" name="vfm_id">
                <div class="form-group">
                  <label>Certificate Date</label>
                   <input type="text" class="form-control" name="certificate_date" placeholder="Certificate Date"  value="<?= $cares->certificate_date ?>">
                </div>
                </div>
                 <div class="col-xs-6">
                <div class="form-group">
                  <label>Certificate No</label>
                  <input type="text" class="form-control" name="certificate_no"  placeholder="Certificate No"  value="<?= $cares->certificate_no ?>">
                </div>
                  </div>
                 <div class="col-xs-6">
                <div class="form-group">
                  <label>Customer Name</label>
                  <input type="text" class="form-control" placeholder="Customer Name" name="name"  value="<?= $cares->name ?>">
                </div>
                </div>
                <div class="col-xs-6">
                <div class="form-group">
                  <label>Mobile No</label>
                  <input type="text" class="form-control" placeholder="Mobile No" name="mob_no"  value="<?= $cares->mob_no ?>">
                </div>
                </div>
                 <div class="col-xs-12">
                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" placeholder="Address" name="address"> <?= $cares->address ?></textarea>
                </div>
                </div>
                <div class="col-xs-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="Email" name="email"  value="<?= $cares->email ?>">
                </div>
                </div>
                <div class="col-xs-6">
                <div class="form-group">
                  <label>Registration No. of Car under the scheme</label>
                  <input type="text" class="form-control" placeholder="Registration No" name="reg_no"  value="<?= $cares->reg_no ?>">
                </div>
                </div>
                <div class="col-xs-6">
                <div class="form-group">
                  <label>Registration Date</label>
                   <input type="text" class="form-control"  placeholder="Registration Date" name="registration_date"  value="<?= $cares->registration_date ?>">
                </div>
                </div>
                 <div class="col-xs-6">
                <div class="form-group">
                  <label>Make / Model / Variant</label>
                   <input type="text" class="form-control" placeholder="Make / Model / Variant" name="model"  value="<?= $cares->model ?>">
                </div>
                </div>
                
                <div class="col-xs-6">

                <label>Period of Benifit Availability</label>
                 
                
                
                 <div class="form-group">
                  <div class="col-xs-6">
                  <input type="text" class="form-control"  placeholder="From Date" name="benifit_fromdate" value="<?= $cares->benifit_fromdate ?>"> 
              </div> 
              <div class="col-xs-6"> <input type="text" class="form-control"  placeholder="To  Date" name="benifit_todate"  value="<?= $cares->benifit_todate ?>"></div>
              </div>
                 
                </div>
              
                
                <div class="col-xs-6">
                <div class="form-group">
                  <label>Amount</label>
                  <input type="text" class="form-control" placeholder="Amount" id="amount"   readonly="readonly" name="amount"  value="<?= $cares->amount ?>">
                </div>
                </div>
                  <div class="col-xs-12">
                <div class="col-xs-3">
                     <input type="hidden" class="form-control"  id="gst" name="gst" value="<?php echo $gst;?>">
                <div class="form-group">
                  <label>SGST(<?php echo $gst;?>%)</label>
                  <input type="text" class="form-control" placeholder="SGST(%)" id="tax1per"  readonly="readonly" name="sgst"  value="<?= $cares->sgst ?>">
                </div>
                </div>
                <div class="col-xs-3">
                <div class="form-group">
                  <label>CGST(<?php echo $gst;?>%)</label>
                  <input type="text" class="form-control" placeholder="CGST(%)" name="cgst" id="tax2per"  readonly="readonly"  value="<?= $cares->cgst ?>">
                </div>
                </div>
                <div class="col-xs-3">
                <div class="form-group">
                  <label>Total Amount Rupees</label>
                  <input type="text" class="form-control" placeholder="Total Amount Rupees" name="total_amt" id="total_amt" value="<?= $cares->total_amt ?>">
                </div>
                </div>
                <div class="col-xs-3">
                <div class="form-group">
                  <label>Mode of payment</label>
                  <input type="text" class="form-control" placeholder="Mode of payment" name="payment_mode"  value="<?= $cares->payment_mode ?>">
                </div>
                </div>

                 </div>
                <div class="col-xs-6">
                <div class="form-group">
                  <label>Terms and Condition</label>
                  <input type="file"  id="fileinput" name="fileinput"> <?= $cares->terms ?>
                </div>
               
                </div>
                <div class="col-xs-6">
                <div class="form-group">
                  <label>Customer GSTIN NO</label>
                  <input type="text" class="form-control" placeholder="Customer GSTIN NO" value="<?= $cares->gstin_no ?>" name="gstin_no">
                </div>
                </div>
              </div>
            

              <div class="box-footer">
                 <a href="<?= site_url('vfm') ?>" class="btn btn-primary">Cancel</a>
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
        var date_input=$('input[name="certificate_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="registration_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="benifit_fromdate"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="benifit_todate"]'); //our date input has the name "date"
       
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
  $("#cars").validate(
      {
        rules: 
        {
          certificate_date: 
          {
            required: true
    
          },
          certificate_no: 
          {
            required: true
            
          },
           name: 
          {
            required: true
            
          },
           mob_no: 
          {
            required: true
            
          },
           address: 
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
           registration_date: 
          {
            required: true
            
          },
           model: 
          {
            required: true
            
          },
           benifit_fromdate: 
          {
            required: true
            
          },
           benifit_todate: 
          {
            required: true
            
          },
          amount: 
          {
            required: true
            
          },
          sgst: 
          {
            required: true
            
          },
           cgst: 
          {
            required: true
            
          },
          total_amt: 
          {
            required: true
            
          },
          payment_mode: 
          {
            required: true
            
          }
        },
        messages: 
        {
          certificate_date: 
          {
            required: "Please enter certificate date."
          },
          certificate_no: 
          {
            required: "Please enter certificate No."
          }
          ,
          name: 
          {
            required: "Please enter customer name."
          }
          ,
          mob_no: 
          {
            required: "Please enter customer mobile no."
          }
          ,
          address: 
          {
            required: "Please enter  address."
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
          registration_date: 
          {
            required: "Please enter registration date."
          }
          ,
          model: 
          {
            required: "Please enter Make / Model / Variant."
          }
          ,
          benifit_fromdate: 
          {
            required: "Please enter benifit from date."
          }
          ,
          benifit_todate: 
          {
            required: "Please enter benifit to date."
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
          payment_mode: 
          {
            required: "Please enter  payment mode."
          }
        }
      });   
    
    
</script>
</body>
</html>
