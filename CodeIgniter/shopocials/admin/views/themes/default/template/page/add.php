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

                               echo form_open_multipart('page/addpage', $attributes);  ?>
                               
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
                        
                        <div class="col-md-12">
                           
                         <a href="<?= site_url('pages') ?>" class="btn btn-default" >Close</a>
                         
                         <button type="submit" class="btn btn-primary">Save changes</button>
                     </div>
                     
                 </form></div></div></div></div></div>
                 <?php echo Modules::run('footer/footer/index'); ?>
             </div> </div></div>
             
             
             
             <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
             <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
             <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
             <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/jqueryui-1.10.3.min.js"></script>
             <script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
             <script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
             <script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
             
             <script src="<?= site_url('views/themes/default') ?>/assets/js/helpers/ckeditor/ckeditor.js"></script>
             <script src="<?= site_url('views/themes/default') ?>/assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script>

      $("#pages").validate(
      {
        rules: 
        {
          
          title: 
          {
            required: true,
            
            
          },
           meta_keywords: 
          {
            required: true,
           
            
          }
          ,
           meta_description: 
          {
            required: true,
           
            
          }
          ,
           content: 
          {
            required: true,
           
            
          }
        },
        messages: 
        {
          
          title: 
          {
            required: "Please enter title."
            
          },
           meta_keywords: 
          {
            required: "Please enter meta keyword."
          }
          ,
           meta_description: 
          {
            required: "Please enter meta description."
          },
           content: 
          {
            required: "Please enter content."
          } 
          
        }
      }); 
       
</script> 
 </body>
 </html>