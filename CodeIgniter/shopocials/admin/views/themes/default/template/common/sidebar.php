<div id="sidebar">
                    
<div id="sidebar-scroll">
  
    <div class="sidebar-content">
       
        <a href="<?php echo site_url('home'); ?>" class="sidebar-brand">
            <i class="fa fa-shopping-cart"></i><span class="sidebar-nav-mini-hide"><strong>Shopocial</strong></span>
        </a>
       
        <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
            <div class="sidebar-user-avatar">
                <a href="#">
                    <img src="<?= site_url('views/themes/default') ?>/assets/img/placeholders/avatars/avatar2.jpg" alt="avatar">
                </a>
            </div>
            <div class="sidebar-user-name"><?php echo ucwords($this->session->userdata('username'))?></div>
           
        </div>
                          

                            
                           
        <ul class="sidebar-nav">
             <li>
                <a href="<?php echo site_url('home'); ?>" ></i><i class="gi gi-shopping_cart sidebar-nav-icon"></i>Dashboard</a>
                </li>
               
                     <li>
                <a href="<?php echo site_url('category'); ?>" ></i><i class="gi gi-shopping_cart sidebar-nav-icon"></i>Category</a>
                </li>
               <li>
                <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-notes_2 sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Content</span></a>
                <ul>
                   <!--  <li>
                        <a href="<?php echo site_url('packages'); ?>"><i class="gi gi-show_thumbnails"></i> <span>Packages</span></a>
                    </li> -->
                    <li>
                        <a href="<?php echo site_url('page'); ?>"><i class="gi gi-show_big_thumbnails"></i><span>Pages</span></a>
                    </li>
                    
                   
                </ul>
            </li>
            
            <li>
                <a href="<?php echo site_url('store/manage'); ?>" ><i class="fa fa-info fa-fw fa-fwsidebar-nav-icon"></i>Seller Management</a>
                
            </li>
             
             <li>
                <a href="<?php echo site_url('notification'); ?>"><i class="fa fa-bell-o fa-fw sidebar-nav-icon"></i>Customer Notification</a>
                
            </li>
           
           <li>
                <a href="<?php echo site_url('users_groups'); ?>"><i class="fa fa-user fa-fw sidebar-nav-icon"></i>Users Group</a>
                
            </li>
           
           <li>
                <a href="<?php echo site_url('users'); ?>"><i class="fa fa-user fa-fw sidebar-nav-icon"></i>Users</a>
                
            </li>
           
        </ul>
        
       
                            
                           
    </div>
   
</div>

</div>