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
        <li><a href="<?php echo site_url('home'); ?>">Home<a></li>
          <li><a href="<?php echo site_url('customers'); ?>">Customers</a></li>
        </ul>
        <?php echo Modules::run('messages/message/index'); ?>
        <div class="block">
          <div class="well">
            <div class="row">
              <div class="col-sm-12">

              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-vcenter table-striped">
              <thead>
               <tr>
                 <th> No</th>
                 <th> Name </th>
                 <th>Phone</th>
                 <th>Register Date </th>
                 <th>Last Login </th>
                 <th>Status</th>
                 <th style="width: 150px;" class="text-center">
                 Action</th>
               </tr>
             </thead>
             <tbody id="tbody">
              <?php $i= 1; if(!empty($customers)): foreach($customers as $or): ?>
              <td><?php echo $i ?></td>
              <td><?php echo $or->first_name." ".$or->last_name ?></td>
              <td><?php echo $or->phone ?></td>
              <td><?php echo $or->created_on ?></td>
              <td><?php echo $or->last_login ?></td>
              <td><a class="btn btn-primary btn-xs inactive"  href="<?php echo site_url('customers/customerstatus/'.$or->c_id.'') ?>">
                <?php if ( $or->enabled==1): echo "Active" ;?>
                  <?php else: echo "Block "; ?>
                  <?php endif ?>
                </a></td>
                <td class="text-center">
                  <div class="btn-group ">
                    <a data-toggle="tooltip" title="Delete" class="btn btn-danger delete"  href="<?php echo site_url('customers/customerdelete/'.$or->c_id.'') ?>" > <i class="fa fa-times"></i></a></td>
                  </tr>
                  <?php $i++;endforeach; else: ?>
                  <tr class="err_msg"><td colspan="5">Customer(s) not available.</td></tr>
                <?php endif; ?>
              </tbody>
              <tfoot>
               <tr>
                <td>
                </td>
                <td colspan="6" >
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