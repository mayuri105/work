<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">

<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
<div class="static-content">
<div class="page-content">
    <ol class="breadcrumb">
        <li><a href="<?php site_url('index'); ?>">Home</a></li>
        <li class="active"><a href="<?= site_url('customer') ?>">Customer</a></li>
        <li class="active"><a href="">Edit Customer</a></li>

    </ol>
    <div class="container-fluid">

        <div class="mt-xl"></div>
        <?php echo Modules::run('messages/message/index'); ?>
            <div class="mt-xl"></div>
            <h2>Edit Customer</h2>



            <div class="panel panel-inverse">

                <div class="panel-body">

                    <?php 
						$attributes = array('class' => 'form-horizontal', 'id' => 'form-customer');

						echo form_open_multipart('customer/update', $attributes);  ?>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                            <li class=""><a href="#tab-address" data-toggle="tab">Address</a></li>
                            <li class=""><a href="#tab-package" data-toggle="tab">Package Detail</a></li>
                            <li class=""><a href="#tab-iplog" data-toggle="tab">Ip log</a></li>

                        </ul>
                        <div class="pb"></div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-general">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-customer">
                                        <div class="pb"></div>
                                        <input type="hidden" name="c_id" value="<?= $customer->customer_detail->c_id ?>">

                                        <div class="form-group required ">
                                            <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="firstname" id="firstname" required value="<?= $customer->customer_detail->first_name ?>" placeholder="First Name" id="input-firstname" class="form-control">

                                            </div>
                                        </div>
                                        <div class="form-group required ">
                                            <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="lastname" id="firstname" required value="<?= $customer->customer_detail->last_name ?>" placeholder="Last Name" id="input-lastname" class="form-control">

                                            </div>
                                        </div>
                                        <div class="form-group required ">
                                            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="email" id="email" required value="<?= $customer->customer_detail->email ?>" placeholder="E-Mail" id="input-email" class="form-control">

                                            </div>
                                        </div>
                                        <div class="form-group required ">
                                            <label class="col-sm-2 control-label" for="input-phone">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="phone" value="<?= $customer->customer_detail->phone ?>" placeholder="Phone" id="input-email" class="form-control">

                                            </div>
                                        </div>
                                        <div class="form-group required ">
                                            <label class="col-sm-2 control-label" for="input-password">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" value="<?= $this->encrypt->decode($customer->customer_detail->password) ?>" placeholder="Password" id="input-password" class="form-control" autocomplete="off">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-newsletter">Newsletter</label>
                                            <div class="col-sm-10">
                                                <select name="newsletter" id="input-newsletter" class="form-control">
                                                    <option value="1" <?=$customer->customer_detail->newsletter ? 'selected':'' ?>>Enabled</option>
                                                    <option value="0" <?=$customer->customer_detail->newsletter ? '':'selected' ?>>Disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-status">Status</label>
                                            <div class="col-sm-10">
                                                <select name="enabled" id="input-enabled" class="form-control">
                                                    <option value="1" <?=$customer->customer_detail->enabled ? 'selected':'' ?>>Enabled</option>
                                                    <option value="0" <?=$customer->customer_detail->enabled ? '':'selected' ?>>Disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Profile image</label>
                                            <div class="col-sm-10">
                                                <div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
                                                        <?php if ($customer->customer_detail->profile_picture): ?>
                                                            <img src="<?php echo getuploadpath().'customer/'.$customer->customer_detail->profile_picture.''?>">
                                                            <?php endif ?>
                                                    </div>
                                                    <div>
                                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                        <input type="file" name="fileinput">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                   
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-address">
                               <div class="form-group">
	                                <label class="col-sm-2 control-label" for="input-status">Address</label>
	                                <div class="col-sm-10">
	                                 	<input type="text" name="address" id="address" value="<?php echo $customer->customer_detail->address ?>"  id="input-firstname" class="form-control">
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label class="col-sm-2 control-label" for="input-status">City</label>
	                                <div class="col-sm-10">
	                                 	<input type="text" name="city" id="city" value="<?php echo $customer->customer_detail->city ?>"  id="input-firstname" class="form-control">
	                                </div>
	                            </div>
	                             <div class="form-group">
	                                <label class="col-sm-2 control-label" for="input-status">State</label>
	                                <div class="col-sm-10">
	                                 	<input type="text" name="state" id="state" value="<?php echo $customer->customer_detail->state ?>" id="input-firstname" class="form-control">
	                                </div>
	                            </div>
                            </div>
                            <div class="tab-pane" id="tab-iplog">
                                <table class="table table-striped">

                                    <thead>
                                        <th>Last Login Date</th>
                                        <th>Ip</th>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <?= date('d-m-Y g:i:a',strtotime( $customer->customer_detail->last_login)) ?>
                                            </td>
                                            <td>
                                                <?= $customer->customer_detail->ip ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            

                            <div class="tab-pane" id="tab-package">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                      
                                        <th>Package Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php if ($package): ?>
                                    <?php foreach ($package as $p): ?>
                                    <tr>
                                        <td><a href="<?php echo site_url('package/edit/'.$p->package_id.'') ?>"><?php echo $p->package_name ?></a></td>
                                        <td><?php echo date('d-m-Y',strtotime($p->package_start_date)) ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($p->package_end_date)) ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                    <?php else: ?>
                                    <tr>
                                        <td>No Package brought </td>
                                    </tr>
                                    <?php endif ?>
                                </tbody>
                                
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= site_url('customer') ?>" class="btn btn-default">Close</a>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>

                </div>
            </div>
    </div>
</div>
<!-- #page-content -->
</div>

<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<!-- Validate Plugin -->

<script type="text/javascript">
    $('#form-customer').validate({
        errorClass: "help-block",
        validClass: "help-block",
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').addClass("has-error");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass("has-error");
        },

    });
</script>
</body>

</html>			