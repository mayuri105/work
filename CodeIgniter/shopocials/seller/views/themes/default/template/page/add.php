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
                        <li>Pages</li>
                        <li>Add Page</li>
                    </ul>
                    <div class="block">
                        <div class="panel panel-inverse">
                            <div class="panel-body">
                                <?php echo Modules::run('messages/message/index'); ?>
                                <div class="col-md-12">
                                   <?php
                                   $attributes = array('class' => 'form-horizontal', 'id' => 'pages');
                                   echo form_open_multipart('pages/addpage', $attributes);  ?>
                                   <div class="col-md-8">
                                     <label class="control-label">Title</label>
                                     <input type="text" name="title" value="<?= set_value('title') ?>" class="form-control">
                                 </div>
                                 <div class="col-md-8">
                                     <label class="control-label">Meta Keywords</label>
                                     <textarea type="text" name="meta_keywords" class="form-control"><?= set_value('meta_keywords') ?></textarea>
                                 </div>
                                 <div class="col-md-8">
                                     <label class="control-label">Meta Description</label>
                                     <textarea type="text" name="meta_description" class="form-control"><?= set_value('meta_description') ?></textarea>
                                 </div>
                                 <div class="col-md-8">
                                     <label class="control-label">Content</label>
                                     <textarea id="textarea-ckeditor" name="content" class="ckeditor"><?= set_value('content') ?></textarea>
                                 </div>
                                 <div class="col-md-8">
                                   <label class="control-label">Page image</label>
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
                               <input type="checkbox" name="show_on_footer" value="1">
                               <label class="control-label">Shopw on footer
                               </label>
                           </div>
                           <div class="col-md-12">
                             <a href="<?= site_url('pages') ?>" class="btn btn-default" >Close</a>
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
    <script src="<?= site_url('views/themes/default') ?>/assets/js/helpers/ckeditor/ckeditor.js"></script>
    </body>
    </html>