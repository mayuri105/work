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
                            <li>Users Group</li>
                            <li>Add Users Group</li>
                            
                        </ul>
                        
                       
                        <?php echo Modules::run('messages/message/index'); ?>
                <div class="block">
				<div class="panel panel-inverse">
                    <div class="panel-body">
						<form name="adduser" action="<?php echo site_url('users_groups/add') ?>" method="post">
							<div class="row">
								<div class="col-md-3">
									<label class="control-label"> Name</label>
									
										<input type="text" name="name" class="form-control">
									</div>
								<div class="col-md-3">
									<label class="control-label">Access Rights</label>
									
										<p><select class="form-control" id="access"  multiple="multiple" name="permission[]">	
											<?php foreach ($rights as $r): ?>
												<option value="<?= $r ?>"><?= $r ?></option>
											<?php endforeach ?>
										</select></p>
									</div>
								<div class="col-md-3">
									<label class="control-label">Modify Rights</label>
									
										<p><select class="form-control" id="modify"  multiple="multiple" name="modify[]">	
											<?php foreach ($rights as $r): ?>
												<option value="<?= $r ?>"><?= $r ?></option>
											<?php endforeach ?>
										</select></p>
									</div>
                                      <div class="col-md-3"></div> 
								<div class="col-md-12">
								<a href="<?= site_url('users_groups') ?>" class="btn btn-default" >Close</a>
								<button type="submit" class="btn btn-primary">Save changes</button>
							
                            </div>
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
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/jqueryui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>                        
<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>


<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
	$(function() {
	$('#access,#modify').multiselect({
		includeSelectAllOption: true
	});

	});
</script>
    </body>
</html>

