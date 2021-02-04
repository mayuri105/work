<!DOCTYPE html>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
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
                            <li>Orders</li>

                        </ul>

                        <div class="block">
                              <?php echo Modules::run('messages/message/index'); ?>

                            <div class="well">
                                <form action="<?=  site_url('orders'); ?>" method="get" name="filter">
                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label" for="input-name"> Order No</label>
                                            <input type="text" name="order_no"  value="<?php echo $order_no; ?>"  id="input-name" class="form-control" autocomplete="off">

                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label" for="input-name"> Status</label>
                                             <select class="form-control" name="order_status" >
                                              <option value="">None</option>
                                                    <?php foreach ($order_statusd as $c): ?>
                                                    <option value="<?php echo $c->order_status_id ?>" <?php echo $c->order_status_id == $order_status ? 'selected' : '' ?>><?php echo $c->status_name ?></option>
                                                   <?php endforeach ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label" for="input-name"> Added Date</label>
                                              <input type="text" id="example-datepicker3" name="created_on" value="<?php echo $created_on; ?>"  class="form-control input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">

                                        </div>
                                        </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label" for="input-name"> Payment</label>

                                                <select class="form-control" name="payment_status" >
                                                    <option value="">None</option>
                                                     <option value="COD" <?= $payment_status =='COD' ? 'selected' : '' ?>>COD</option>
                                                     <option value="Bank Transfer" <?= $payment_status =='Bank Transfer' ? 'selected' : '' ?>>Bank Transfer</option>

                                        <option value="Credit Card" <?= $payment_status =='Credit Card' ? 'selected' : '' ?>>Credit Card</option>

                                                </select>
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

                                            <th>Order No</th>
                                            <th>Customer</th>
                                             <th>Product</th>
                                            <th>Status</th>

                                             <th>Payment</th>
                                            <th style="width: 150px;" class="text-center">
                                            Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i= 1; if(!empty($orders)): foreach($orders as $or): ?>
                                        <tr>
                                        <td><?php echo $i ?></td>
                                        <input type="hidden" class="form-control" readonly name="o_id" id="o_id<?php echo $i ?>" value="<?php echo  $or->o_id ?>"></td>
                                        <td><?php echo $or->order_no ?>
                                        <td><?php echo $or->first_name." ".$or->last_name ?></td>
                                          <td><?php echo $or->product_name ?></td>
                                            <td><select class="form-control" name="order_statusr" id="order_statusr<?php echo $i ?>" >
                                              <option value="">None</option>
                                                    <?php foreach ($order_statusd as $c): ?>
                                                    <option value="<?php echo $c->order_status_id ?>" <?php echo $c->order_status_id == $or->order_status ? 'selected' : '' ?>><?php echo $c->status_name ?></option>
                                                   <?php endforeach ?>
                                                </select></td>
                                              <td><?php echo $or->payment_status ?></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-xs">
                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                                </div>
                                            </td>
                                             <script type="text/javascript">
$(document).ready(function(){

    $('#order_statusr<?php echo $i ?>').on("change",function () {
 var o_id = $("#o_id<?php echo $i ?>").val();
 var order_status = $("#order_statusr<?php echo $i ?>").val();

// alert(o_id);
 //alert(order_status);

 $.ajax({
        type: "POST",
        url: "<?php echo site_url('orders/updateorderData');?>",
        dataType:'json',
        data: {'o_id':o_id,'order_status':order_status},
        success:function(response){
          console.log(response);
          window.location.href='';
        }
    });
  });
});

    </script>
                                       <?php $i++;endforeach; else: ?>
                                    <tr class="err_msg"><td colspan="7">Order(s) not available.</td></tr>
                                    <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td colspan="5"></td>
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





       
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>

    </body>
</html>

