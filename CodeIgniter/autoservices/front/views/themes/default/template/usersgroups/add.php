<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| Add User Group</title>
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/AdminLTE.min.css">
 <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-datepicker3.css"/>

  
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css">
  
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
        <li class="active">Add User Group </li>
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
              <h3 class="box-title">Add User Group </h3>
            </div>
             <?php 

            $attributes = array('id' => 'plus');

            echo form_open_multipart('users_groups/add', $attributes);  ?>
						
							 <div class="box-body">
              <?php echo Modules::run('messages/message/index'); ?>
								<div class="col-md-8">
									<label class="control-label"> Name</label>
									
										<input type="text" name="name" value=""class="form-control">
									</div>
								<div class="col-md-8">
									<label class="control-label">Access Rights</label>
									
										<select class="form-control" id="access"  multiple="multiple" name="permission[]">	
											<?php foreach ($rights as $r): ?>
												<option value="<?= $r ?>"><?= $r ?></option>
											<?php endforeach ?>
										</select>
									</div>
								<div class="col-md-8">
									<label class="control-label">Modify Rights</label>
									
										<select class="form-control" id="modify"  multiple="multiple" name="modify[]">	
											<?php foreach ($rights as $r): ?>
												<option value="<?= $r ?>"><?= $r ?></option>
											<?php endforeach ?>
										</select>
									</div>
								<div class="col-md-8">
							<div class="modal-footer">
								<a href="<?= site_url('users_groups') ?>" class="btn btn-default" >Close</a>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
                            </div>
                            	</div>
						</form>
									
					
						</div>

</div>

</div>

</div>

<?php echo Modules::run('footer/footer/index'); ?>



</div>

</div>
</div>

 </div>

          </div>
          </div>
      

    </section>
  
  </div>
  

 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.min.js"></script>

<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script type="text/javascript" src="<?= site_url('front/views/themes/default') ?>/assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?= site_url('front/views/themes/default') ?>/assets/plugins/fastclick/lib/fastclick.js"></script>

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/adminlte.min.js"></script>

<!-- The Canvas to Blob plugin is included for image resizing functionality -->



 <script type="text/javascript" src="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
	$(function() {
	$('#access,#modify').multiselect({
		includeSelectAllOption: true
	});
	});
</script>
</body>
</html>

