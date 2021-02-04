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

                        <input type="hidden" name="u_id" value="<?php echo ucfirst($this->session->userdata('u_id')); ?>">

                        <div class="col-md-5">
                          <label class="control-label">FirstName</label>

                          <input type="text" class="form-control" name="first_name" value="<?= $this->session->userdata('first_name') ?>">
                        </div>
                        <div class="col-md-5">
                          <label class="control-label">LastName</label>

                          <input type="text" class="form-control" name="last_name" value="<?= $this->session->userdata('last_name') ?>">
                        </div>


                        <div class="col-md-6">
                          <label class="control-label">Email</label>

                          <input type="text" value="<?= $this->session->userdata('email') ?>"  size="35" name="email" class="form-control">
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

                        <input type="hidden" name="u_id" value="<?php echo ucfirst($this->session->userdata('u_id')); ?>">
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
      </div>
      <?php echo Modules::run('footer/footer/index'); ?>
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