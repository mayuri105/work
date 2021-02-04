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
            <li>Banners</li>
            <li>All Banners </li>
          </ul>
          <div class="block">
            <div class="well">
              <div class="row">
                <div class="col-sm-12">
                  <a  href="<?php echo site_url('banners/addbanner'); ?>"  class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Banner</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-vcenter table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th style="width: 150px;" class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                 <?php $i= 1; if(!empty($banners)): foreach($banners as $banner): ?>
                 <tr>
                  <td><?php echo $i ?></td>
                  <td ><?php if ($banner->banner_image): ?>
                  <img  height ="35px"  width="50px" src="<?php echo getuploadpath().'banners/'.$banner->banner_image; ?>" ><?php endif ?></td>
                  <td><a class="btn btn-primary btn-xs inactive"  href="<?php echo site_url('banners/bannerstatus/'.$banner->banner_id.'') ?>">
                    <?php if ( $banner->IsActive==1): echo "Active" ;?>
                      <?php else: echo "Inactive "; ?>
                      <?php endif ?>
                    </a></td>
                    <td class="text-center">
                      <div class="btn-group btn-group-xs">
                        <a href="<?php echo site_url('banners/edit/'.$banner->banner_id.'') ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                        <a data-toggle="tooltip" title="Delete" class="btn btn-danger delete"  href="<?php echo site_url('banners/bannerdelete/'.$banner->banner_id.'') ?>" > <i class="fa fa-times"></i></a></td>
                      </tr>
                      <?php $i++;endforeach; else: ?>
                      <tr class="err_msg"><td colspan="4">Banner(s) not available.</td></tr>
                    <?php endif; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td colspan="4"></td>
                      <td >
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
          <?php echo Modules::run('footer/footer/index'); ?>
        </div>
      </div>
    </div>
    <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
    <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
    <script src="<?= site_url('views/themes/default') ?>/assets/css/sweet-alert/sweet-alert.min.js" type="text/javascript"></script>
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

} else {

}
});
      });
    </script>
    <script type="text/javascript">
      $('.inactive').click(function(e){
        e.preventDefault();
        url = $(this).attr('href');
        swal({
          title: "Are you sure?",
            text: "Change Status ",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, Change it!",
          cancelButtonText: "No",

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

          } else {

          }
        });
      });
    </script>
  </body>
  </html>