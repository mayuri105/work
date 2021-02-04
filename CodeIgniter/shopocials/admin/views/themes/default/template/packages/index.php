<!DOCTYPE html>
 <html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">

        <title>Make brand Merchant Home</title>

        <meta name="description" content="Make brand Merchant Home">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        
        <link rel="shortcut icon" href="<?= site_url('views/themes/default') ?>/assets/img/favicon.png">
        <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="<?= site_url('views/themes/default') ?>/assets/img/icon180.png" sizes="180x180">
      

       
        <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/bootstrap.min.css">

       
        <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/plugins.css">

        
        <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/main.css">

         <link href="<?= site_url('views/themes/default') ?>/assets/css/sweet-alert/sweet-alert.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?= site_url('views/themes/default') ?>/assets/css/themes/amethyst.css">
        
        <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/modernizr.min.js"></script>
    </head>
    <body>
        
        <div id="page-wrapper">
            
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
                
              
                
                <?php echo Modules::run('sidebar/sidebar/index'); ?>
                
                <div id="main-container">
                   
                   <?php echo Modules::run('header/header/index'); ?>
                   

                   
                    
                      
                        
				
				
				
				<div id="page-content">
				<ul class="breadcrumb breadcrumb-top">
				  <li>Home</li>
                            <li>Pages</li>
                           
                        </ul>
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="block">
				<div class="well">
                                              <div class="row">
                                        <div class="col-sm-12">
                                        <a  href="<?php echo site_url('packages/add'); ?>"  class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Package</a>
                                          </div>
                                          </div>
                                          </div>      
							 <div class="table-responsive">
                                <table class="table table-vcenter table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Title</th>
                                       
										<th class="text-center">Action</th>
										
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($packages)): foreach($packages as $page): ?>
									<tr>
										<td><?= $i; ?></td>
										<td><?php echo $page->package_name ?></td>
										        <td class="text-center">
                                                <div class="btn-group btn-group-xs">
                                                    <a href="<?php echo site_url('packages/edit/'.$page->package_id.'') ?>" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>

                        <a data-toggle="tooltip" title="Delete" class="btn btn-danger delete"  href="<?php echo site_url('packages/packagedelete/'.$page->package_id.'') ?>" > <i class="fa fa-times"></i></a></td>
                                                </tr>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">Package(s) not available.</td></tr>
									<?php endif; ?>
									<?php //echo $this->ajax_pagination->create_links(); ?>
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
        
        

        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
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

      //swal("Deleted!", "Your imaginary file has been deleted.", "success");   
    
    } else {     
    
      //swal("Cancelled", "Your imaginary file is safe :)", "error");   
    
    } 
  });

});
  

</script> 

    </body>
</html>