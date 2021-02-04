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
    <li>Category</li>
    <li>Edit Category </li>
</ul>
<div class="block">
    <div class="panel panel-inverse">
        <div class="panel-body">
         <?php echo Modules::run('messages/message/index'); ?>
         <?php
         $attributes = array('class' => 'form-horizontal', 'id' => 'pages');
         echo form_open_multipart('category/update', $attributes);  ?>
         <input type="hidden" name="cat_id" value="<?php echo $cate->cat_id; ?>" class="form-control">
         <div class="col-md-3">
            <label class="control-label"> Select Category
                <span class="required">*</span>
            </label>
            <select class="form-control" name="parent_category" >
                <?php foreach ($categories as $c): ?>
                    <option value="<?php echo $c->cat_id ?>" <?php echo $c->cat_id == $cate->parent_category ? 'selected' : '' ?>><?php echo $c->category ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-3">
         <label class="control-label">Category name </label>
         <input type="text" name="category" value="<?= $cate->category; ?>" class="form-control">
     </div>
     <div class="col-md-3">
         <label class="control-label">Tax Rate <span>(%)</span> </label>
         <input type="text" name="tax_rate" value="<?= $cate->tax_rate; ?>" class="form-control">
    </div>
	<div class="col-md-3">
            <label class="control-label">Market Commission Rate <span>(%)</span> </label>
            <input type="text" name="market_comm_rate" value="<?= $cate->market_comm_rate; ?>" class="form-control">
        </div>
     <div class="col-md-12">

        <a href="<?= site_url('category') ?>" class="btn btn-default" >Close</a>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
</div>
</div>
</div>
</div>
<?php echo Modules::run('footer/footer/index'); ?>
</div>
</div>
</div>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
</body>
</html>
