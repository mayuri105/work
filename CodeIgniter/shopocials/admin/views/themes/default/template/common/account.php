<!DOCTYPE html>
 <html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">

        <title>Make brand Merchant Account</title>

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
              <div class="panel panel-default"> <?php echo Modules::run('messages/message/index'); ?>
                <div class="panel-body">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab" aria-expanded="false">Detail</a></li>
                    <li ><a href="#profile" data-toggle="tab" aria-expanded="true"> Security</a></li>
                  </ul>
                  <br>
                  <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="home">
                      <div class="row">
                        <div class="col-md-10">
                          <div class="panel panel-default">
                            <div class="panel-heading">Account Information</div>
                            <div class="panel-body">
                            <form action="<?php echo site_url('login/update_account') ?>" method="post" id="form-login">
                              
                              <input type="hidden" name="m_id" value="<?php echo ucfirst($this->session->userdata('m_id')); ?>">
                              
                              <div class="col-md-5">
                                <label class="control-label">FirstName</label>
                                
                                  <input type="text" class="form-control" name="firstname" value="<?= $this->session->userdata('firstname') ?>">
                                </div>
                                <div class="col-md-5">
                                <label class="control-label">LastName</label>
                                
                                  <input type="text" class="form-control" name="lastname" value="<?= $this->session->userdata('lastname') ?>">
                                </div>
                              
                              
                                <div class="col-md-6">
                                <label class="control-label">Email</label>
                              
                                  <input type="text" value="<?= $this->session->userdata('username') ?>"  size="35" name="username" class="form-control">
                                </div>
                              
                                <div class="col-md-10 ">
                                  
                                  <button class="btn btn-primary" type="submit">Save changes</button>
                                </div>
                                 </form>
                              </div>
                              
                            </div>
                          </div>
                         
                        </div>
                      </div>
                   
                    <div class="tab-pane fade " id="profile">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="panel panel-default">
                            <div class="panel-heading"> Change Password </div>
                            <div class="panel-body">
                            <form action="<?php echo site_url('login/changepassword') ?>" method="post" id="form-login">
                              
                              <input type="hidden" name="m_id" value="<?php echo ucfirst($this->session->userdata('m_id')); ?>">
                              <input type="hidden" name="username" value="<?php echo ucfirst($this->session->userdata('username')); ?>">
                             
                                <div class="col-md-4">
                                <label for="oldpassword" class="control-label">Old Password </label>
                             
                                  <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Old Password">
                                </div>
                             <div class="col-md-4">
                                <label for="newpassword" class="control-label">New Password</label>
                                
                                  <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="New Password">
                                </div>
                              <div class="col-md-4">
                                <label for="confpassword" class="control-label">Confirm Password </label>
                              
                                  <input type="password" name="confpassword" id="confpassword" class="form-control" placeholder="Confirm Password">
                                </div>
                             <div class="col-md-10">
                                  <button class="btn btn-default" type="reset" id="cancel2">Cancel</button>
                                  <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
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
        <script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
        <script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
    </body>
</html>