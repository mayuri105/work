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
                            <li>Users </li>
                            <li>Add Users </li>
                            
                        </ul>
                        
                <div class="block">
                <div class="panel panel-inverse">
                    <div class="panel-body">
									<form  action="<?php echo site_url('users/add') ?>" method="post">
										
											<div class="col-md-8">
												<label class=" control-label">User Name</label>
												
													<input type="text" name="user_name"  minlength="5"   maxlength="15"  required id="user_name" value="<?= set_value('user_name') ?>" class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">First Name</label>
												
													<input type="text" name="first_name" required id="first_name" value="<?= set_value('first_name') ?>" class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">Last Name</label>
												
													<input type="text" name="last_name" value="<?= set_value('last_name') ?>"  value=""class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">Email</label>
												
													<input type="email" name="email" value="<?= set_value('email') ?>" required id="email" class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">Password</label>
												
													<input type="password" id="password" minlength="5"  name="password" required value="<?= set_value('password') ?>" class="form-control">
												</div>
											<div class="col-md-8">
												<label class="control-label">Select Group</label>
												
													<select class="form-control" name="user_group_id">
													<option value="0">None</option>
														<?php foreach ($usersgroups as $g ): ?>
															<option value="<?= $g->group_id ?>"><?= $g->name ?></option>
														<?php endforeach ?>
														
													</select>
												</div>
											<div class="col-md-8">
												<label class="control-label">Status</label>
												
													<select class="form-control" name="status" required>
														<option value="1">Active</option>
														<option value="0">InActive</option>
													</select>
												</div>
											<div class="col-md-8">

										<div class="modal-footer">
											<a href="<?= site_url('users') ?>" class="btn btn-default" >Close</a>
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
           
        </div>
  </div>
        	
        
        <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
       
        <script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
    </body>
</html>
