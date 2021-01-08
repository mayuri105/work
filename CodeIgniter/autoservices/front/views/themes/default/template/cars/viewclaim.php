<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| View Claim </title>
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/AdminLTE.min.css">
 <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-datepicker3.css"/>

  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/skins/_all-skins.min.css">

  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
  @media print {
  @page { margin: 0;border: 2px solid; }
  body { margin: 1.6cm; }
   }
</style>
</head>

<body onload="window.print();"  style="margin:30px">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="page-header">
          <center><h3> JMD CARES CLAIM PLAN</h3> </center>
          <small class="pull-left">Date:  <?php $var = $claim->claim_date;
echo date("d-m-Y", strtotime($var) );  ?></small>
<small class="pull-right">&nbsp;&nbsp;&nbsp;</small><br>
<center><h6>Confirmation Certificate<br>
We take this opportunity to thank you for being part of this scheme as per following details:</h6></center>
        </div>
      </div>
      
    </div>
   
    <div class="row invoice-info">
      <div class="col-sm-6 invoice-col">
       <p><b>Customer Name: </b><?= $claim->customer ?></p>
        <br>
         <p><b>Claim Date:</b> <?= $claim->claim_date ?></p> <br>
         <p><b>certificate Date</b> <?= $claim->certi_date ?></p> <br>
         <p><b>Location:</b> <?= $claim->location ?></p> <br>
          <p><b>Invoice No:</b> <?= $claim->invoiceno ?></p> <br>
          <p><b>Vehicle No:</b> <?= $claim->vehicleno ?></p> 
         
          
      </div>
   
      
      <div class="col-sm-6 invoice-col">
        
         <p><b>Insurance Laibility:</b> <?= $claim->insurancelaibility ?></p> <br>
         <p><b>Customer Laibility:</b><?= $claim->customerlaibility ?></p> <br>
         <p><b>Total Amount Rupees(Profit):</b><?= $claim->totalamt  ?></p> <br>
    
     
      </div>
      
    </div>
   
    
     <br>
     <br>
      <p text-align:right style="margin-left:25px";>Help Desk / Contact Details for availing under the Scheme<br>
Insurance Claim Executive. Digambar Sutar - 9867551818<br>
JMD Auto India Pvt. Ltd<br>

Workshop<br>
Bhandup- 022 25665800<br>
Kandiwali- 022 29676400<br>
Nerul- 022 27635900</p>
<strong class="pull_left" style="margin-left:25px";>For JMD Auto India Pvt. Ltd.</strong><br>
<strong class="pull_left" style="margin-left:25px";>Authorized Representative</strong>
   
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
