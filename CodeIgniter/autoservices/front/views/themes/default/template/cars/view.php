  <!DOCTYPE html>
  <html>
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| View Cares</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet"  href="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/css/bootstrap.min.css" media="all" >

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
        popupWin.document.write('<html><head><title>::Preview:JMD Cares:</title></head><body onload="window.print()">')
        popupWin.document.write(toPrint.innerHTML);
        popupWin.document.write('</html>');
        popupWin.document.close();
    }
  /*--This JavaScript method for Print Preview command--*/
    function PrintPreview() {
        var toPrint = document.getElementById('printarea');
        var popupWin = window.open();
        popupWin.document.open();
        popupWin.document.write('<html>html><title>::Preview:JMD Cares:</title>');
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
  <body style="margin:30px; width: 100%;font-size: 24px">
  <div class="wrapper"  id="printarea">
  <!-- Main content -->
  <style>

  @media print {
.col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
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

  @page { margin: 0; }
  body { margin: 0.6cm; }
   }
  </style>
  <section class="content">

    <!-- title row -->
    <div class="row" style="padding-top: 110px">
      <div class="col-xs-12">
        <div class="page-header" style="border-bottom:none;padding-bottom:0px;margin-bottom: 20px;">
           
          <div >  
         <center style="  border-top: 2px solid black;
  border-right: 2px solid black;

  border-left: 2px solid black;
    box-sizing: border-box;
     padding:  20px;
      margin: 20px;"><h3> JMD CARES PLAN</h3></center>
        
  </div>
        </div>
      </div>
      
    </div>
   
    <div class="row" style=" border: 2px solid black;
    box-sizing: border-box;
     margin: 20px;
         margin-top: -20px;">
          <small class="pull-left">Date: <?php $var = $cares->certificate_date;
  echo date("d-m-Y", strtotime($var) );  ?></small>
  <small style="position: absolute;
    right: 100px;">JMD Cares Certificate No :<?= $cares->certificate_no ?></small><br>
  <center><h4>Confirmation Certificate<br>
  We take this opportunity to thank you for being part of this scheme as per following details:</h4></center>
      <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Name:</label>
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
         <label>GSTIN No:</label>
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
      <div class="col-sm-2">
         <label>Period of Benifit Availability:</label>
         </div>
         <div class="col-sm-10">
       <span> From</span>  <?= $cares->benifit_fromdate ?> <span>To</span> <?= $cares->benifit_todate ?>
      </div>
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
      <div class="col-sm-2">
         <label>Mode of payment:</label>
         </div>
         <div class="col-sm-10">
       <?= $cares->payment_mode ?> <span>Cash / Cheque / Other - Subject to realization of payment.</span></div>
      </div>
        
       
        <p style="padding: 10px"><b>N.B. - T & C Apply.</b></p><br>
        <p style="position: absolute;
    right: 100px;"><strong  style="margin-left:25px";>For JMD Auto India Pvt. Ltd.</strong><br><br><br><br><br><br>
  <strong  style="margin-left:25px";>Authorized Representative.</strong></p><br><br>     
       
  <p style="margin-left:25px";>Help Desk / Contact Details for availing under the Scheme<br>
  Insurance Claim Executive. Digambar Sutar - 9867551818<br>
  JMD Auto India Pvt. Ltd<br>

  Workshop<br>
  Bhandup- 022 25665800<br>
  Kandiwali- 022 29676400<br>
  Nerul- 022 27635900</p><br>
  <p>GSTN number : 27AABCJ4887A1ZL</p>

    </div>
     </div>
   
     
             
             </section>
  <!-- /.content -->
  </div>
  <!-- ./wrapper -->
  </body>
  </html>
