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
          <li>Home</li>
          <li>Category</li>
        </ul>
        <?php echo Modules::run('messages/message/index'); ?>
        <div class="block">
          <div class="well">
            <div class="row">
              <div class="col-sm-12">
                <a  href="<?php echo site_url('category/add'); ?>"  class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Category</a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-vcenter table-striped">
              <thead>
               <tr>
                <th>#</th>
                <th>Parent Category</th>
                <th>Category</th>

                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="tbody">
             <?php $i= 1; if(!empty($categories)): foreach($categories as $cat): ?>
             <tr>
              <td><?= $i; ?></td>
              <td>
             <?php if(!empty($cat->parent_category )):
          $CI =& get_instance();
          $CI->load->model('cat_model');
          $result = $CI->cat_model->get($cat->parent_category);?>
             <?php echo $result->category;?>
               <?php endif; ?>
              </td>
              <td><?php echo $cat->category ?></td>
              <td class="text-center">
                <div class="btn-group btn-group-xs">
                  <a href="<?php echo site_url('category/edit/'.$cat->cat_id.'') ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                  <a data-toggle="tooltip" title="Delete" class="btn btn-danger delete"  href="<?php echo site_url('category/catdelete/'.$cat->cat_id.'') ?>" > <i class="fa fa-times"></i></a></td>
                </tr>
              </tr>
              <?php $i++;endforeach; else: ?>
              <tr class="err_msg"><td colspan="5">categorie(s) not available.</td></tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
           <tr>
            <td>
            </td>
            <td colspan="5" >
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

          } else {

          }
        });
  });
</script>
</body>
</html>