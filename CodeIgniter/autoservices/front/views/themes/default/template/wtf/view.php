

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| View PMS</title>
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/AdminLTE.min.css">
 <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-datepicker3.css"/>

  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/skins/_all-skins.min.css">
<script type="text/javascript">
  /*--This JavaScript method for Print command--*/
    function PrintDoc() {
        var toPrint = document.getElementById('printarea');
        var popupWin = window.open();
        popupWin.document.open();
        popupWin.document.write('<html><head><title>::Preview:JMD PMS:</title></head><body onload="window.print()">')
        popupWin.document.write(toPrint.innerHTML);
        popupWin.document.write('</html>');
        popupWin.document.close();
    }
  /*--This JavaScript method for Print Preview command--*/
    function PrintPreview() {
        var toPrint = document.getElementById('printarea');
        var popupWin = window.open();
        popupWin.document.open();
        popupWin.document.write('<html><title>::Preview:JMD PMS:</title>');
        popupWin.document.write(toPrint.innerHTML);
        popupWin.document.write('</html>');
        popupWin.document.close();
    }
  </script>
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
</head>
 <table align="center">
            <td>
                <input type="button" value="Print" class="btn" onclick="PrintDoc()"/>
            </td>
           
            </table>
<body style="margin:30px; width: 100%">
<div class="wrapper"  id="printarea">
  <!-- Main content -->
  <style>
  @media print {
     col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
  float: left!important;
}
.col-sm-12 {
  width: 100%;
}
.col-sm-11 {
  width: 91.66666666666666%;
}
.col-sm-10 {
  width: 83.33333333333334%;
}
.col-sm-9 {
  width: 75%;
}
.col-sm-8 {
  width: 66.66666666666666%;
}
.col-sm-7 {
  width: 58.333333333333336%;
}
.col-sm-6 {
  width: 50%;
}
.col-sm-5 {
  width: 41.66666666666667%;
}
.col-sm-4 {
  width: 33.33333333333333%;
}
.col-sm-3 {
  width: 25%;
}
.col-sm-2 {
  width: 16.666666666666664%;
}
.col-sm-1 {
  width: 8.333333333333332%;
}
  @page { margin: 0;}
  body { margin: 1.6cm; }
   }

</style>
  <section class="content">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="page-header" style="border-bottom:none;padding-bottom:0px">
           <center style=" 
     padding:  20px;
      margin: 20px;"><h3> JMD Wear & Tear Protection Plan</h3> </center>
          
        </div>
      </div>
      
    </div>
   
    <div class="row" style="
     margin: 20px;
         margin-top: -20px;">
        <small class="pull-left"><b>Date: <?php $var = $cares->certificate_date;
echo date("d-m-Y", strtotime($var) );  ?></b></small>
<small style="right:60px; position: absolute;"><b>JMD W T PROTECTION<br>
Certificate No:<?= $cares->certificate_no ?></b></small><br>
<center><h5><strong>We take this opportunity to thank you for being part of this plan as per Terms & Conditions

provided & agreed as per following details
:</h5></center>
      <div class="row invoice-col">
        <div class="col-sm-12">  
     
      <div class="col-sm-2">
         <label>Name: </label>
         </div>
         <div class="col-sm-10">
    <?= $cares->name ?>
       
     </div>
      </div>
        <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Email:</label>
          </div>
         <div class="col-sm-10">
         <?= $cares->email ?>
      </div>
      </div>
      <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Contact Detail:</label>
          </div>
         <div class="col-sm-10">
         <?= $cares->address ?>
      </div>
      </div>
      <div class="col-sm-12">
       <div class="col-sm-2">
         <label>Mobile No:</label>
         </div>
         <div class="col-sm-10">
        <?= $cares->mob_no ?>
      </div>
      </div>
      <div class="col-sm-12">
      
      <div class="col-sm-2">
         <label> GSTIN No: </label>
         </div>
         <div class="col-sm-10">
<?= $cares->gstin_no ?>    
     </div>
       </div>
      <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Registration No.<br> of Car under the scheme:</label>
         </div>
         <div class="col-sm-10">
        <?= $cares->reg_no ?>
      </div>
      </div>
        
        <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Date of registration:</label>
         </div>
         <div class="col-sm-10">
         <?= $cares->registration_date ?>
      </div>
      </div>
      <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Make / Model / Variant:</label>
         </div>
         <div class="col-sm-10">
        <?= $cares->model ?>
      </div>
      </div>
       
     <div class="col-sm-12">
      <?php   $from= date_create($cares->benifit_fromdate);
$to= date_create($cares->benifit_todate);
$diff=date_diff($to,$from);
//print_r($diff);
//echo $diff->format('%y');
?>
       <p><b>Date for & Odometer Reading as<br>
At Commencement of this Plan:</b> - <?php echo $cares->benifit_fromdate?> & 45000  <b>Kilometers</b></p>
<p>Plan Validity-Period of <?= $diff->y; ?>  Year OR Usage
Of <?= $cares->km ?> Kilometers, whichever occurs first.i.e.<br>Till <?php echo $cares->benifit_todate?> Or Total Odometer
Reading Reaching 60000, whichever is
earlier</p>
 </div>
        <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Amount:</label>
         </div>
         <div class="col-sm-10">
       <?= $cares->amount ?> &nbsp; &nbsp;SGST(<?= $gst ?>%):&nbsp;<?= $cares->sgst ?> &nbsp; &nbsp;CGST(<?= $gst ?>%):&nbsp;<?= $cares->cgst ?><br>
       <b>Total Amount Rupees:</b><?= $cares->total_amt ?>
      </div>
      </div>
      <div class="col-sm-12">
         <p><b>Plan Validity </b>Period of  <?= $diff->y; ?> <b> Years and usage</b> <?= $cares->km ?> <b> Kilometers, whichever occurs first.</b ></p>
         </div>
         <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Mode of payment:</label>
         </div>
         <div class="col-sm-10">
       <?= $cares->payment_mode ?> <span>Cash / Cheque / Other - Subject to realization of payment.</span></div>
      </div>
        <div class="col-sm-12">
        <p style="position: absolute;
    right: 80px;"> <strong>For JMD Auto India Pvt. Ltd.</strong><br><br><br><br>
<strong>Authorized Representative</strong></p><br><br><br>
</div>
 <div class="col-sm-12">
        <b><p style="margin-left:25px";>
            Workshops<br>
<li>Plot 296 B, Behind Asian Paints, Sonapur Lane, Off. LBS Marg, Bhandup-W, Mumbai</li>
400078
<li>Plot 73 AB, Gini Silk Mills Compound, Ganesh Nagar, Charkop, Kandivali-W, Mumbai

400067</li>

<li>D-221/19, MIDC, TTC Industrial Area, Near London Pilsner, Nerul, Navi Mumbai 400705</li>

<li>Breakdown & Helpline No. 9821304304</li>
Enclosed – Copy of Terms, Conditions & detailsof this Scheme as agreed.</li><p></b>
    </div>

   </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
