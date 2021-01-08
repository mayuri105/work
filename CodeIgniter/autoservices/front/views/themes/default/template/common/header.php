<header class="main-header">
   
    <a href="<?= site_url('home') ?>" class="logo">
     
      <span class="logo-lg"><b>JMD</b></span>
    </a>
   
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
       
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= site_url('front/views/themes/default') ?>/assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ucfirst($this->session->userdata('first_name')); ?></span>
            </a>
            <ul class="dropdown-menu">
            
             
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= site_url('users/editprofile') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= site_url('login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>

            </ul>
          </li>
           <li>
            <a href="<?= site_url('login/logout') ?>" ><i class="fa  fa-sign-out"></i></a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>