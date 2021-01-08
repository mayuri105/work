<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JMD| AMC</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/plugins/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/skins/_all-skins.min.css">
  <link href="<?= site_url('front/views/themes/default') ?>/assets/css/sweet-alert/sweet-alert.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-datepicker3.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php echo Modules::run('header/header/index'); ?>
  <?php echo Modules::run('menu/menu/index'); ?>
  <div class="content-wrapper">
   
    <section class="content-header">
      
      <ol class="breadcrumb">
        <li><a href="<?=  site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">JMD AMC</li>
      </ol>
    </section>

    <br>
      <br>
    <section class="content">

     <div class="box-body table-responsive no-padding">
     <?php echo Modules::run('messages/message/index'); ?>
      <div class="box-header with-border">
              <h3 class="box-title">Add User</h3>
            </div>
           <a href="<?= site_url('users/adduser') ?>" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add User</a>
            <thead>
              <table class="table table-hover">
							
									<tr>
										<th>#</th>
										<th>Username</th>
										<th>Status</th>
										<th>Group</th>
										<th>Date Added</th>
                                       
										<th class="text-center">Action</th>
										
									</tr>
								</thead>
								 <tbody>
									<?php $i= 1; if(!empty($users)): foreach($users as $user): ?>

									<tr>
										<td><?= $i; ?></td>
										
										<td><?php echo $user->username ?></td>
										<td><?php echo $user->status ? 'Active' :'InActive' ?></td>
										<td><?php echo $user->name ?></td>
										<td><?php echo date('d-m-y',strtotime($user->created_on)); ?></td>
										        <td class="text-center">
                                                <div class="btn-group btn-group-xs">
                                                    <a href="<?php echo site_url('users/edituser/'.$user->u_id.'') ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>

                        <a data-toggle="tooltip" title="Delete" class="btn btn-danger delete"  href="<?php echo site_url('users/userdelete/'.$user->u_id.'') ?>" > <i class="fa fa-times"></i></a></td>
                                                </tr>
									
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">User(s) not available.</td></tr>
									<?php endif; ?>
									
								  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4"><ul class="pagination">
                          <?php echo $pagination_helper->create_links(); ?>
                        </ul></td>
                    </tr>
                  </tfoot>
              </table>
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
<script src="<?= site_url('front/views/themes/default') ?>/assets/css/sweet-alert/sweet-alert.min.js" type="text/javascript"></script> 
<script type="text/javascript">

$('.delete').click(function(e){
  e.preventDefault();
  url = $(this).attr('href');
  
  swal({   
  title: "Are you sure?",   
  text: "Delete it",  
  type: "warning",  
  showCancelButton: true, 
  confirmButtonColor: "#DD6B55", 
  confirmButtonText: "Yes, delete it!",   
  cancelButtonText: "No",   
  //closeOnConfirm: false,  
   //closeOnCancel: false 
  }, function(isConfirm){   
    if (isConfirm) {     
      $.ajax({
        url : url,
        method : "GET",
        dataType:"json",
        success:function(response){
          console.log(response);
          window.location.href='';
        }
      })

      //swal("Deleted!", "Your imaginary file has been deleted.", "success");   
    
    } else {     
    
      //swal("Cancelled", "Your imaginary file is safe :)", "error");   
    
    } 
  });

});
</script>

</body>
</html>