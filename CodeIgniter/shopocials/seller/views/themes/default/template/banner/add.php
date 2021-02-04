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
                            <li>Add Banner </li>
                        <div class="block">
                            <div class="panel panel-inverse">
                                <div class="panel-body">
                                 <?php echo Modules::run('messages/message/index'); ?>
                                 <?php
                                 $attributes = array('class' => 'form-horizontal', 'id' => 'banners');
                                 echo form_open_multipart('banners/add', $attributes);  ?>
                                 <div class="col-md-8">
                                   <label class="control-label">Banner image</label>
                                   <div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
                                     <div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;"></div>
                                     <div>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                        <input type="file" name="fileinput"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                               <label class="control-label">Link
                                  <span class="required">*</span></label>
                                  <input type="text" name="link"  id="link" value="" class="form-control">
                              </div>
                              <div class="col-md-12">
                                 <br>
                                 <a href="<?= site_url('banners') ?>" class="btn btn-default" >Close</a>
                                 <button type="submit" class="btn btn-primary">Save changes</button>
                             </div>
                         </form>
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
