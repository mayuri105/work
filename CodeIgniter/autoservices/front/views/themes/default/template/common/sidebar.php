 <aside class="main-sidebar">
   
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <?php  $userp=$this->session->userdata('user_group_id');?>
      <ul class="sidebar-menu">
        
        <li >
          <a href="<?= site_url('home') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
           
          </a>
         
        </li>
        
         <li >
          <a href="<?= site_url('cares') ?>">
            <i class="fa fa-files-o"></i> <span>JMD Cares</span>
           
          </a>
         
        </li>
         <li >
          <a href="<?= site_url('plus') ?>">
            <i class="fa fa-plus"></i> <span>JMD PMS </span>
           
          </a>
         
        </li>
         <li >
          <a href="<?= site_url('mfree') ?>">
            <i class="fa fa-folder"></i> <span>M Free</span>
           
          </a>
         
        </li>
         <li class="treeview">
          <a href="<?= site_url('membership') ?>">
            <i class="fa fa-envelope"></i> <span>Membership</span>
           
          </a>
         
        </li>
         <li >
          <a href="<?= site_url('vfm') ?>">
            <i class="fa fa-book"></i> <span>JMD VFM</span>
           
          </a>
         
        </li>
         <li >
          <a href="<?= site_url('wtf') ?>">
            <i class="fa fa-eye"></i> <span>JMD’s W T Protection</span>
           
          </a>
         
        </li>
        <li >
          <a href="<?= site_url('amc') ?>">
            <i class="fa fa-plus"></i> <span>JMD AMC </span>
           
          </a>
         
        </li>
         <li >
          
            <a><i class="fa fa-snowflake-o"></i> <span>Other</span></a>
           
         
         <ul>
           <li><i class="fa fa-map"></i><a href="<?= site_url('location') ?>">
           <span>Location</span>
           
          </a></li>
            <?php if($userp == 2){ ?>
          <li><a href="<?= site_url('users') ?>">
           <i class="fa fa-user"></i><span>Users</span>
           
          </a></li>
           <li><a href="<?= site_url('users_groups') ?>">
           <i class="fa fa-user"></i><span>Users Groups</span>
           
          </a></li>
          <?php } ?>
         </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
