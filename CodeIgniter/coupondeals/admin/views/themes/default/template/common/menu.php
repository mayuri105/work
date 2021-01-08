<div class="page-sidebar-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
      <li class="nav-item start active open"> <a href="<?= site_url('home') ?>" class="nav-link nav-toggle"> <i class="icon-home"></i> <span class="title">Dashboard</span> <span class="selected"></span> <span class="arrow open"></span> </a> </li>
      <li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-amazon"></i> <span class="title"> Manage Deals </span> <span class="arrow"></span> </a>
        <ul class="sub-menu">
          <li class="nav-item  "> <a href="<?php echo site_url('categories'); ?>" class="nav-link "> <i class="fa fa-circle"></i><span class="title">Categories</span> </a> </li>
          <li class="nav-item  "> <a href="<?php echo site_url('brands'); ?>" class="nav-link "><i class="fa fa-circle"></i><span class="title">Brands</span> </a> </li>
          <li class="nav-item  "> <a href="<?php echo site_url('deals'); ?>" class="nav-link "> <i class="fa fa-ship"></i><span class="title">Deals</span> </a> </li>
        </ul>
      </li>
      <li class="nav-item"> <a  href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-sticky-note"></i> <span class="title">Manage Blog</span> <span class="arrow"></span>  </a>
       <ul class="sub-menu"> 
       <li class="nav-item  "> <a href="<?php echo site_url('blogcategories'); ?>" class="nav-link "> <i class="fa fa-circle"></i><span class="title">Categories</span> </a> </li>
       <li class="nav-item  "> <a href="<?php echo site_url('blogs'); ?>" class="nav-link ">  <i class="fa fa-sticky-note"></i> <span class="title">Blog</span> </a> </li>
      </ul>
      </li>
     <li class="nav-item start active open"> <a href="<?php echo site_url('coupons'); ?>" class="nav-link nav-toggle"> <i class="fa fa-sticky-note"></i><span class="title">Manage Coupons</span> </a> </li>
      <li class="nav-item "> <a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-tv"></i><span class="title"> Manage Page & Banner </span> <span class="arrow"></span> </a>
        <ul class="sub-menu">
          <li class="nav-item  "> <a href="<?php echo site_url('pages'); ?>" class="nav-link "><i class="fa fa-sticky-note-o"></i><span class="title">Pages</span> </a> </li>
          <li class="nav-item  "> <a href="<?php echo site_url('banners'); ?>" class="nav-link "> <i class="fa fa-sticky-note-o"><span class="title"></i>Banners</span> </a> </li>
        </ul>
      </li>
      <li class="nav-item"> <a href="#;" class="nav-link nav-toggle"> <i class="fa fa-gear"></i> <span class="title">Setting</span> </a> 
      <ul class="sub-menu">
          <li class="nav-item  "> <a href="<?php echo site_url('users/themeoption'); ?>" class="nav-link "> <i class="fa fa-gear"></i><span class="title">Theme Option</span> </a> </li>
         
        </ul></li>
      <li class="nav-item "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-group"></i> <span class="title"> Manage Users </span> <span class="arrow"></span> </a>
        <ul class="sub-menu">
          <li class="nav-item  "> <a href="<?php echo site_url('users'); ?>" class="nav-link "> <i class="fa fa-user"></i><span class="title">Register Users</span> </a> </li>
          <li class="nav-item  "> <a href="<?php echo site_url('users/subcriber'); ?>" class="nav-link "><i class="fa fa-user"></i> <span class="title">Subcribe Users</span> </a> </li>
           <li class="nav-item  "> <a href="<?php echo site_url('users/contactuser'); ?>" class="nav-link "><i class="fa fa-user"></i> <span class="title">Contact Users</span> </a> </li>
        </ul>
      </li>
      <li class="nav-item start active open"> <a href="<?php echo site_url('admin'); ?>" class="nav-link nav-toggle">   <i class="fa fa-user-plus"></i>  <span class="title"> Manage Admin</span> </a> </li>
    </ul>
  </div>
</div>
