<html lang="en">
<head>
<meta charset="utf-8" />
<title>Savetakatak| News</title>
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
          <li> <i class="icon-home"></i> <a href="#">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <span>News</span> </li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption"> <a href="<?= site_url('news/addnews') ?>" class="btn blue"> ADD News <i class="fa fa-plus"></i> </a> </div>
            <div class="tools"></div>
          </div>
          <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_4">
              <thead>
                <tr>
                  <th class="all">Title</th>
                  <th class="min-phone-l">Create Date</th>
                  <th class="none">Short Descripttion</th>
                  <th class="none">Long Description</th>
                  <th class="desktop">Status</th>
                  <th class="desktop">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Buy One Get One Free </td>
                  <td>2011/04/25</td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td><button type="button" class="btn btn-success">Active</button></td>
                  <td><i class="fa fa-pencil-square-o"></i> <i class="fa fa-trash"></i></td>
                </tr>
                <tr>
                  <td>Buy One Get One Free </td>
                  <td>2011/04/25</td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td><button type="button" class="btn btn-success">Active</button></td>
                  <td><i class="fa fa-pencil-square-o"></i> <i class="fa fa-trash"></i></td>
                </tr>
                <tr>
                  <td>Buy One Get One Free </td>
                  <td>2011/04/25</td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td><button type="button" class="btn btn-success">Active</button></td>
                  <td><i class="fa fa-pencil-square-o"></i> <i class="fa fa-trash"></i></td>
                </tr>
                <tr>
                  <td>Buy One Get One Free </td>
                  <td>2011/04/25</td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td><button type="button" class="btn btn-success">Active</button></td>
                  <td><i class="fa fa-pencil-square-o"></i> <i class="fa fa-trash"></i></td>
                </tr>
                <tr>
                  <td>Buy One Get One Free </td>
                  <td>2011/04/25</td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </td>
                  <td><button type="button" class="btn btn-success">Active</button></td>
                  <td><i class="fa fa-pencil-square-o"></i> <i class="fa fa-trash"></i></td>
                </tr>
              </tbody>
            </table>
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
<script src="<?= site_url('views/themes/default') ?>/assets/global/scripts/datatable.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/global/scripts/app.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script> 
<script src="<?= site_url('views/themes/default') ?>/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
</body>
</html>