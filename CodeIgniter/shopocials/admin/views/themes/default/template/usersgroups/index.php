<!DOCTYPE html>
 <html class="no-js" lang="en">
    <?php echo Modules::run('header/header/head'); ?>
<body>
        
<div id="page-wrapper">
            
  <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
    <?php echo Modules::run('sidebar/sidebar/index'); ?>
    <div id="main-container">
    <?php echo Modules::run('header/header/index'); ?>
<div id="page-content">
				<ul class="breadcrumb breadcrumb-top">
				  <li>User groups</li>    
       </ul>
				<?php echo Modules::run('messages/message/index'); ?>
<div class="block">
	<div class="well">
<div class="row">
              <div class="col-sm-12">
              <a  href="<?php echo site_url('users_groups/addgroups'); ?>"  class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add Groups</a>
                </div>
       </div>
  </div>
<div class="table-responsive">
     <table class="table table-vcenter table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Title</th>
                                       
										<th class="text-center">Action</th>
										
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($users_groups)): foreach($users_groups as $ug): ?>

									<tr>
										<td><?= $i; ?></td>
										<td><?php echo $ug->name ?></td>
										        <td class="text-center">
                                                <div class="btn-group btn-group-xs">
                                                    <a href="<?php echo site_url('users_groups/edit/'.$ug->group_id.'') ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>

                        <a data-toggle="tooltip" title="Delete" class="btn btn-danger delete"  href="<?php echo site_url('users_groups/usergrpdelete/'.$ug->group_id.'') ?>" > <i class="fa fa-times"></i></a></td>
                                                </tr>
									
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">Groups(s) not available.</td></tr>
									<?php endif; ?>
										</tbody>
								
							</table>
						 </div>      
							 
				 </div>
  </div>
 <?php echo Modules::run('footer/footer/index'); ?>
  </div>
 </div>
 </div>
        
 <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/css/sweet-alert/sweet-alert.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
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