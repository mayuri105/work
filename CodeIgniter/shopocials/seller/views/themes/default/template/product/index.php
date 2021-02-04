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
                    <li>Product</li>
                    <li>All Products </li>
                </ul>
                <div class="block">
                    <?php echo Modules::run('messages/message/index'); ?>
                    <div class="well">
                        <form action="<?=  site_url('products'); ?>" method="get" name="filter">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-name"> Name</label>
                                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder=" Name" id="input-name" class="form-control" autocomplete="off">
                                </div>
                                 <a  href="<?=  site_url('products/addproduct'); ?>" class="btn btn-primary "><i class="fa fa-plus"></i> Add Product</a>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-name"> Status</label>
                                     <select class="form-control" name="stock" >
                                            <option value="">None</option>
                                <option value="In Stock" <?= $stock =='In Stock' ? 'selected' : '' ?>>In Stock</option>
                                <option value="Out Of Stock" <?= $stock =='Out Of Stock' ? 'selected' : '' ?>>Out Of Stock</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-name"> Added Date</label>
                                      <input type="text" id="example-datepicker3" name="date_added" class="form-control input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
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
                                   <th>No</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                     <th>Status</th>
                                    <th>Addded Date</th>
                                    <th style="width: 150px;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i= 1; if(!empty($products)): foreach($products as $product): ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $product->product_name ?></td>
                                    <td><?php echo $product->stock  ?></td>
                                    <td><a class="btn btn-primary btn-xs inactive"  href="<?php echo site_url('products/productstatus/'.$product->product_id.'') ?>">
                <?php if ( $product->IsActive==1): echo "Active" ;?>
                <?php else: echo "Inactive "; ?>
                <?php endif ?>
                </a></td>
                                    <td><?php echo $product->added_on ?></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-xs">
                                            <a href="<?php echo site_url('products/edit/'.$product->product_id.'') ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                <a data-toggle="tooltip" title="Delete" class="btn btn-danger delete"  href="<?php echo site_url('products/productdelete/'.$product->product_id.'') ?>" > <i class="fa fa-times"></i></a></td>
                                        </div>
                                    </td>
                                </tr>
                               <?php $i++;endforeach; else: ?>
                            <tr class="err_msg"><td colspan="5">Product(s) not available.</td></tr>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td colspan="6"></td>
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