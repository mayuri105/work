<html lang="en">
<head>
<meta charset="utf-8" />
<title>Savetakatak| Pages</title>
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
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<link href="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
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
          <li> <span>Add Category</span> </li>
        </ul>
      </div>
       <?php echo Modules::run('messages/message/index'); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
              <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Add  Category</span> </div>
            </div>
            <div class="portlet-body">
              <?php 
            $attributes = array('class' => 'form-horizontal', 'id' => 'categories');
            echo form_open_multipart('blogcategories/add', $attributes);  ?>
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3">Name <span class="required"> * </span> </label>
                    <div class="col-md-4">
                      <input type="text" class="form-control" name="blog_cat_name" id="blog_cat_name">
                    </div>
                  </div>
                  </div>
                <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                      <button type="submit" class="btn green">Submit</button>
                      <button type="reset" class="btn default">Cancel</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo Modules::run('footer/footer/index'); ?> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/scripts/app.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/pages/scripts/form-validation.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/pages/scripts/components-editors.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
</body>
</html>