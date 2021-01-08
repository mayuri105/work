<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| Edit W T Protection Claims</title>
 
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
        <li class="active">Edit W T Protection Claims</li>
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
              <h3 class="box-title">Edit W T Protection Claims</h3>
            </div>
            
          <?php 

            $attributes = array('id' => 'caresclaims');

            echo form_open_multipart('wtf/updateclaims', $attributes);  ?>
              <div class="box-body">
              <?php echo Modules::run('messages/message/index'); ?>
               <div class="col-xs-6">
               <input type="hidden" name="wtp_claim_id" value="<?php echo $claims->wtp_claim_id ?>">
                <input type="hidden" name="wtp_id" value="<?php echo $claims->wtp_id ?>">
                 <?php
                $CI =& get_instance();
$CI->load->model('wtf_model');
$result = $CI->wtf_model->getclaimbycaresid($claims->wtp_id);
$profitvalue = $result->profitvalue;
                ?>
                 <input type="hidden" id="cares_amount" name="cares_amount" value="<?php echo $profitvalue ?>">
                <div class="form-group">
                  <label>Certificate Date</label>
                   <input type="text" class="form-control" name="certi_date" readonly="readonly" placeholder="Certificate Date" value="<?php echo $claims->certi_date ?>" >
                </div>
                </div>
                 <div class="col-xs-6">
                <div class="form-group">
                  <label>Claim Date</label>
                  <input type="text" class="form-control" name="claim_date"  value="<?php echo $claims->claim_date ?>" placeholder="Claim Date">
                </div>
                  </div>
                 <div class="col-xs-6">
                <div class="form-group">
                  <label>Customer Name</label>
                  <input type="text" class="form-control" placeholder="Customer Name" value="<?php echo $claims->customer ?>" name="customer" readonly="readonly" >
                </div>
                </div>
                <div class="col-xs-6">
                <div class="form-group">
                  <label>Invoice No</label>
                  <input type="text" class="form-control" placeholder="Invoice No" value="<?php echo $claims->invoiceno ?>" name="invoiceno">
                </div>
                </div>
                 <div class="col-xs-6">
                <div class="form-group">
                  <label>Location</label>
                  <select class="form-control" name="location">
                   <option value="">Select</option>
                   <?php foreach ($location as $c): ?>
                                                    <option value="<?php echo $c->name ?>" <?php echo $c->name == $claims->location ? 'selected' : '' ?>><?php echo $c->name ?></option>
                                                <?php endforeach ?>
                  </select>
                </div>
                </div>
                <div class="col-xs-12">
                <div class="col-xs-3">
                <div class="form-group">
                  <label>Vehicle No</label>
                  <input type="text" class="form-control" placeholder="Vehicle No" value="<?php echo $claims->vehicleno ?>"  name="vehicleno">
                </div>
                </div>
                <div class="col-xs-3">
                <div class="form-group">
                  <label>Insurance Laibility</label>
                  <input type="text" class="form-control" placeholder="Insurance Laibility" value="<?php echo $claims->insurancelaibility ?>"  id="insurancelaibility" name="insurancelaibility">
                </div>
                </div>
                <div class="col-xs-3">
                <div class="form-group">
                  <label>Customer Laibility</label>
                   <input type="text" class="form-control" id="customerlaibility" value="<?php echo $claims->customerlaibility ?>"    readonly="readonly"  placeholder="Customer Laibility" name="customerlaibility">
                </div>
                </div>
                 <div class="col-xs-3">
                <div class="form-group">
                  <label>Total Amount</label>
                   <input type="text" class="form-control" id="totalamt" value="<?php echo $claims->totalamt ?>"   readonly="readonly" placeholder="Total Amount" name="totalamt">
                </div>
                </div>
                </div>
                
                
              </div>
            

              <div class="box-footer">
                <a href="<?= site_url('wtf') ?>" class="btn btn-primary">Cancel</a>
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
        var date_input=$('input[name="certi_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="claim_date"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
 
   $(document).ready(function(){
    
   $('#customerlaibility').on('input',function(e){
    var am = $('#cares_amount').val();
    //alert(am);
    var cs = $('#customerlaibility').val();
     
    
    var total = parseInt(am) - parseInt(cs);
   document.getElementById('totalamt').value= total;
    
});
   })
</script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $("#caresclaims").validate(
      {
        rules: 
        {
          certi_date: 
          {
            required: true
    
          },
          claim_date: 
          {
            required: true
            
          },
           customer: 
          {
            required: true
            
          },
           location: 
          {
            required: true
            
          },
           invoiceno: 
          {
            required: true
            
          },
          vehicleno: 
          {
            required: true
            
          },
           insurancelaibility: 
          {
            required: true
            
          },
           customerlaibility: 
          {
            required: true
            
          },
           totalamt: 
          {
            required: true
            
          }
        },
        messages: 
        {
          certi_date: 
          {
            required: "Please enter certificate date."
          },
          claim_date: 
          {
            required: "Please enter claim date."
          }
          ,
          customer: 
          {
            required: "Please enter customer name."
          }
          ,
          location: 
          {
            required: "Please enter location."
          }
          ,
          invoiceno: 
          {
            required: "Please enter invoice no."
          }
          ,
          vehicleno: 
          {
            required: "Please enter vehicleno."
          }
          ,
          insurancelaibility: 
          {
            required: "Please enter insurancel aibility."
          }
          ,
          customerlaibility: 
          {
            required: "Please enter customer laibility ."
          }
          ,
          totalamt: 
          {
            required: "Please enter total amount."
          }
         
        }
      });   
    
    
</script>
</body>
</html>
