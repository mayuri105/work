

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
<body style="margin:30px; width: 100%;font-size: 18px">
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
           <center style="   
     padding:  20px;
      margin: 20px;font-size: 20px">
<h4>
 Workshops<br>
<p>Plot 296 B, Behind Asian Paints, Sonapur Lane, Off. LBS Marg, Bhandup-W, Mumbai</p>
400078
<p>Plot 73 AB, Gini Silk Mills Compound, Ganesh Nagar, Charkop, Kandivali-W, Mumbai

400067</p>

<p>D-221/19, MIDC, TTC Industrial Area, Near London Pilsner, Nerul, Navi Mumbai 400705</p>

<p>Breakdown & Helpline No. 9821304304</p>
AMC PLAN</h4></center>
       </center>
          
        </div>
      </div>
      
    </div>
   
    <div class="row invoice-info" style=" 
        margin: 20px;
         margin-top: -20px;">
        
<center><h5><strong>Confirmation Certificate</strong><br>We take this opportunity to thank you for being part of this scheme as per Terms &
Conditions provided & agreed  as per following details
:</h5></center>

      <div class="col-sm-12">  
     
      <div class="col-sm-2">
         <label>Name of the Beneficiary: </label>
         </div>
         <div class="col-sm-10">
     <?= $membership->customer ?>
       
     </div>
      </div>
      <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Contact Details of Beneficiary address: </label>
         </div>
         <div class="col-sm-10">
   <?= $membership->address ?>
       
     </div>
      </div>
      <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Email: </label>
         </div>
         <div class="col-sm-10">
     <?= $membership->email ?>
       
     </div>
      </div>
      <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Mobile No: </label>
         </div>
         <div class="col-sm-10">
     <?= $membership->mob_no ?>
       
     </div>
      </div>
      <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Registration No. of Car : </label>
         </div>
         <div class="col-sm-10">
     <?= $membership->reg_no ?>
       
     </div>
      </div>
       <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Date of Registration: </label>
         </div>
         <div class="col-sm-10">
    <?php echo date("d-m-Y", strtotime($membership->added_date)); ?>
       
     </div>
      </div>
      <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Card No.: </label>
         </div>
         <div class="col-sm-10">
   <?= $membership->card_no ?>
       
     </div>
      </div>
       <div class="col-sm-12">
      <div class="col-sm-2">
         <label>Valid From :</label>
         </div>
         <div class="col-sm-10">
 <?= $membership->fromdate ?> <b>To </b> <?= $membership->todate ?>
        

       <p style="position: absolute;
    right: 80px;"> <strong>For JMD Auto India Pvt. Ltd.</strong><br><br>
<strong>Authorized Representative</strong></p><br><br><br>
    
       
    
    </div>
       </div>
       
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
