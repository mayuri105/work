

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| View Mfree</title>
 
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

  @page { margin: 0;}
  body { margin: 1.6cm; }
   }

</style>
  <section class="content" >
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="page-header" style="border-bottom:none;padding-bottom:0px">
           <center style=" border-top: 2px solid black;
border-right: 2px solid black;

border-left: 2px solid black;
    box-sizing: border-box;
     padding:  20px;
      margin: 20px;"><h3> JMD Auto India ( P ) Limited
Plot No 296-B, Sonapur Lane, LBS Marg
Bhandup (W) Mumbai - 400 078. Tel- 25665800</h3> </center>
          
        </div>
      </div>
      
    </div>
   
    <div class="row invoice-info" style=" border: 2px solid black;
    box-sizing: border-box;
     margin: 20px;
         margin-top: -20px;">
        <small class="pull-left"><b>Date: <?php $var = $mfree->issue_date;
echo date("d-m-Y", strtotime($var) );  ?></b></small>
<small style="right:100px; position: absolute;"><b>Inv No. :<?= $mfree->card_no ?></b></small><br>
<center><h4><strong>Confirmation Certificate</strong><br>We take this opportunity to thank you for being part of this scheme as per Terms &
Conditions provided & agreed  as per following details
:</h4></center>
      <div class="col-sm-12">
      
      
      <div class="col-sm-2">
         <label>Name :  </label>
         </div>
         <div class="col-sm-10">
    <?= $mfree->customer ?>
       
     </div>
      </div>
      <div class="col-sm-12 ">
       
      <div class="col-sm-2">
         <label>Contact Details Address: </label>
         </div>
         <div class="col-sm-10">
      <?= $mfree->address ?>
       
     </div>
      </div>
      <div class="col-sm-12 ">
      
      <div class="col-sm-2">
         <label>Email: </label>
         </div>
         <div class="col-sm-10">
     <?= $mfree->email ?>
       
     </div>
      </div>
      <div class="col-sm-12 ">
      
      <div class="col-sm-2">
         <label>Mobile No: </label>
         </div>
         <div class="col-sm-10">
      <?= $mfree->mob_no ?>
       
     </div>
      </div>
      
     
      <div class="col-sm-12">
       <div class="col-sm-2">
         <label>GSTIN No:</label>
         </div>
         <div class="col-sm-10">
        <?= $mfree->gstin_no ?>
      </div>
      </div>
      <div class="col-sm-12 ">
      
      <div class="col-sm-2">
         <label>Registration No. of Car : </label>
         </div>
         <div class="col-sm-10">
      <?= $mfree->reg_no ?>
       
     </div>
      </div>
       
   <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Amount:</label>
         </div>
         <div class="col-sm-10">
       <?= $mfree->amount ?> &nbsp; &nbsp;SGST(<?= $gst ?>%):&nbsp;<?= $mfree->sgst ?> &nbsp; &nbsp;CGST(<?= $gst ?>%):&nbsp;<?= $mfree->cgst ?><br>
       <b>Total Amount Rupees:</b><?= $mfree->total_amt ?>
      </div>
      </div>
       <?php   $from= date_create($mfree->validity_from_date);
$to= date_create($mfree->validity_to_date);
$diff=date_diff($to,$from);
//print_r($diff);
//echo $diff->format('%y');
?>
       <div class="col-sm-12 ">
      
      <div class="col-sm-2">
         <label> Validity Period : </label>
         </div>
         <div class="col-sm-10">
    <?php echo $mfree->validity_from_date ?> to  <?php echo $mfree->validity_to_date ?> ( <?= $diff->y; ?> <b> Years  or </b> <?= $mfree->km ?> <b> Kilometers, .
       
     </div>
      </div>
      <?php   $from= date_create($mfree->validity_from_date);
$to= date_create($mfree->validity_to_date);
$diff=date_diff($to,$from);
//print_r($diff);
//echo $diff->format('%y');
?>
       
        
        <p>

    E. & O.E. For JMD Auto India ( P ) Ltd<br>
Parts once Sold will not be Exchanged/taken back<br>
All disputes Subject to Jurisdiction of Mumbai Courts Only. 
</p>
<span style="position: absolute;
    right: 80px;">
<strong>For JMD Auto India Pvt. Ltd.</strong><br><br><br><br>
<strong>Authorized Representative</strong></span></p><br><br><br><br><br><br>
<p>
<b>Customer Signature </b>
<span style="position: absolute;
    right: 80px;">
<strong>Authorised signatory</strong></span></p>
      <p><b>GSTN number : 27AABCJ4887A1ZL<span style="position: absolute;
    right: 80px;"><b>TIN:</b> 27710021140V </span></p>  
     <p><b>PAN NO::</b>AABCJ4887A <span style="position: absolute;
    right: 80px;"><b>CST No:</b> 27710021140C </span></p>  
    </div>
   
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
