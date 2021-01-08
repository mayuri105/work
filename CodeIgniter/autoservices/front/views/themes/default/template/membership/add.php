<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| Add Membership</title>
 
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
        <li class="active">Add Membership</li>
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
              <h3 class="box-title">Add Membership</h3>
            </div>
            
          <?php 

            $attributes = array('id' => 'membership');

            echo form_open_multipart('membership/addmembership', $attributes);  ?>
              <div class="box-body">
              <?php echo Modules::run('messages/message/index'); ?>
               <div class="col-xs-12">
               <div class="col-xs-4">
                <div class="form-group">
                  <label>Card No</label>
                   <input type="text" class="form-control" name="card_no" placeholder="Card No">
                </div>
                </div>
                 
                 <div class="col-xs-4">
                <div class="form-group">
                  <label>Customer Name</label>
                  <input type="text" class="form-control" placeholder="Customer Name" name="customer">
                </div>
                </div>
                <div class="col-xs-4">
                <div class="form-group">
                  <label>Mobile No</label>
                  <input type="text" class="form-control" placeholder="Mobile No" name="mob_no">
                </div>
                </div>
                </div>
                 <div class="col-xs-12">
                <div class="form-group">
                  <label>  Address</label>
                  <textarea class="form-control" placeholder="Address" name="address"></textarea>
                </div>
                </div>
                <div class="col-xs-12">
                <div class="col-xs-4">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="Email" name="email">
                </div>
                </div>
                <div class="col-xs-4">
                <div class="form-group">
                  <label>Birth Date</label>
                  <input type="text" class="form-control" name="birthdate"  placeholder="Birth Date">
                </div>
                  </div>
                <div class="col-xs-4">
                <div class="form-group">
                  <label>Registration No. of Car under the scheme</label>
                  <input type="text" class="form-control" placeholder="Registration No" name="reg_no">
                </div>
                </div>
                 </div>
                <div class="col-xs-6">
                <label>Validity Period</label>
                 <div class="form-group">
                  <div class="col-xs-6">
                  <strong>From:</strong><input type="text" class="form-control"  placeholder="Validity From Date" name="fromdate"> 
              </div> 
              <div class="col-xs-6"> 
              <strong>To:</strong><input type="text" class="form-control"  placeholder=" Validity To  Date" name="todate">
              </div>
              </div>
            </div>
               <div class="col-xs-6">
                <div class="form-group">
                  <label>Customer GSTIN NO</label>
                  <input type="text" class="form-control" placeholder="Customer GSTIN NO" name="gstin_no">
                </div>
                </div>
              </div>
            

              <div class="box-footer">
               <a href="<?= site_url('membership') ?>" class="btn btn-primary">Cancel</a>
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
        var date_input=$('input[name="birthdate"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="fromdate"]'); //our date input has the name "date"
       
        date_input.datepicker({
            format: 'dd-mm-yyyy',
           
            todayHighlight: true,
            autoclose: true,
        })
    })
  $(document).ready(function(){
        var date_input=$('input[name="todate"]'); //our date input has the name "date"
       
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
   
</script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?= site_url('front/views/themes/default') ?>/assets/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $("#membership").validate(
      {
        rules: 
        {
          card_no: 
          {
            required: true
    
          },
          birthdate: 
          {
            required: true
            
          },
           customer: 
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
           
          fromdate: 
          {
            required: true
            
          },
           todate: 
          {
            required: true
            
          }
        },
        messages: 
        {
          card_no: 
          {
            required: "Please enter card no."
          },
          birthdate: 
          {
            required: "Please enter birth date."
          }
          ,
          customer: 
          {
            required: "Please enter customer."
          }
          ,
          mob_no: 
          {
            required: "Please enter mobile no."
          }
          ,
          address: 
          {
            required: "Please enter address."
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
         
          fromdate: 
          {
            required: "Please enter validity from date ."
          }
          ,
          todate: 
          {
            required: "Please enter validity to date."
          }
          
        }
      });   
    
    
</script>
</body>
</html>
