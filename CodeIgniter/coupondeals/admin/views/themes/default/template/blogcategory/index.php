<html lang="en">
<head>
<meta charset="utf-8" />
<title>Savetakatak| Categories</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/sweet-alert/sweet-alert.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?= site_url('views/themes/default') ?>/assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" />
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
<?php echo Modules::run('header/header/index'); ?>
<div class="page-container"> <?php echo Modules::run('menu/menu/index'); ?>
  <div class="page-content-wrapper">
 
    <div class="page-content">
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <i class="icon-home"></i> <a href="<?= site_url('home') ?>">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <span>Categories</span> </li>
        </ul>
      </div>
       <?php echo Modules::run('messages/message/index'); ?>
      <div class="col-md-6">
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption"> <a href="<?= site_url('blogcategories/addblogcat') ?>" class="btn blue"> ADD <i class="fa fa-plus"></i> </a> </div>
            <div class="tools"></div>
            
          </div>
          <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
              <thead>
                <tr>
                  <th class="min-tablet">Name</th>
                  <th class="desktop">Created Date</th>
                  <th class="min-tablet">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php if ($blogcategories): ?>
                  <?php foreach ($blogcategories as $ct): ?>
                <tr>
                 <td><?php echo $ct->blog_cat_name ?> </td>
                  <td><?php echo $ct->added_date ?> </td>
                  <td><a href="<?php echo site_url('blogcategories/edit/'.$ct->blog_cat_id.'') ?>"><i class="fa fa-pencil-square-o"></i><a class="delete"  href="<?php echo site_url('blogcategories/delete/'.$ct->blog_cat_id.'') ?>" > <i class="fa fa-trash"></i></a></td>
                </tr>
                  <?php endforeach ?>
                  <?php else: ?>
                  <tr>
                    <td colspan="3">No Category found</td>
                  </tr>
                  <?php endif ?>
                
                
              </tbody>
              <tfoot>
                  <tr>
                    
                    <td colspan="3">
                      <ul class="pagination">
                        <?php echo $pagination_helper->create_links(); ?>
                      </ul>
                    </td>
                  </tr>
                </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Model -->


<?php echo Modules::run('footer/footer/index'); ?> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/scripts/datatable.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/scripts/app.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/pages/scripts/ui-extended-modals.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/sweet-alert/sweet-alert.min.js" type="text/javascript"></script> 
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
  closeOnConfirm: false,  
   closeOnCancel: false 
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




      swal("Deleted!", "Your imaginary file has been deleted.", "success");   
    
    } else {     
    
      swal("Cancelled", "Your imaginary file is safe :)", "error");   
    
    } 
  });

});
  

</script>
</body>
</html>