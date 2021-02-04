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
          <li> Stores</li>

        </ul>

        <div class="block">
          <?php echo Modules::run('messages/message/index'); ?>

          <div class="well">
            <form action="<?=  site_url('store/manage'); ?>" method="get" name="filter">
              <div class="row">

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label" for="input-name"> Business Name</label>
                    <input type="text" name="name"  value="<?php echo $name; ?>"  id="input-name" class="form-control" autocomplete="off">

                  </div>

                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label" for="input-name"> 
                    seller</label>
                    <input type="text" name="merchant"  value="<?php echo $merchant; ?>"  id="input-name" class="form-control" autocomplete="off">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label" for="input-name"> Added Date</label>
                    <input type="date"  name="created_on" value="<?php echo $date_added; ?>"  class="form-control">  

                  </div>
                  <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
                </div>




              </div>
            </form>
          </div>
          <div class="table-responsive">

            <table class="table table-vcenter table-striped">
              <thead>
                <tr>
                 <th> No</th>

                 <th>Business Name</th>
                 <th>Sellers</th>
                 <th>Phone</th>
                 <th>Join Date</th> 
                 <th>Status</th> 
                 <th class="text-center">Action</th>                                           
               </tr>
             </thead>
             <tbody>
              <?php $i= 1; if(!empty($stores)): foreach($stores as $or): ?>
              <tr>
                <td><?php echo $i ?></td>

                <td><?php echo $or->shop_name ?></td>
                <td><?php echo $or->firstname." ".$or->lastname ?></td>
                <td><?php echo $or->shop_phone ?></td>

                <td><?php echo $or->created_on ?></td>
                <td>
                      <a data-toggle="tooltip" title="status" class="btn btn-primary status"  href="<?php echo site_url('store/status/'.$or->shop_id.'') ?>" ><?php if ( $or->status==1): echo "Active" ;?>
                        <?php else: echo "Inactive "; ?>
                        <?php endif ?>
                          
                        </a>
                   </td>
                <td class="text-center">
                  <div class="btn-group btn-group-xs">
                    <a href="<?php echo site_url('store/edit/'.$or->shop_id.'') ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>

                    <a data-toggle="tooltip" title="Delete" class="btn btn-danger delete"  href="<?php echo site_url('store/storedelete/'.$or->shop_id.'') ?>" > <i class="fa fa-times"></i></a></td>

                  </tr>

                  <?php $i++;endforeach; else: ?>
                  <tr class="err_msg"><td colspan="7">Store(s) not available.</td></tr>
                <?php endif; ?> 
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td colspan="7"></td>
                  <td>
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

<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
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
<script type="text/javascript">

  $('.status').click(function(e){
    e.preventDefault();
    url = $(this).attr('href');

    swal({   
      title: "Are you sure?",   
      text: "change it",  
      type: "warning",  
      showCancelButton: true, 
      confirmButtonColor: "#DD6B55", 
      confirmButtonText: "Yes, change it!",   
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