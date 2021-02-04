<style type="text/css">
.brand-logo img {
    height: 50px;
}
@media (max-width: 991px) {
  .top-header .searchbar {
    display: none;
  }
}
</style>
<head>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<header>
    <div class="mobile-fix-option"></div>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header-contact">
                        <ul>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>Call Us: 123 - 456 - 7890</li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 searchbar">
                        <form class="form-header" style="padding:5px; ">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Search Products......">
                                <div class="input-group-append my-content">
                                    <button class="btn btn-solid"><i class="fa fa-search"></i>Search</button>
                                </div>
                            </div>
                        </form>
                </div>
                <div class="col-lg-3 text-right">
                    <ul class="header-dropdown">
                        <li class="mobile-wishlist"><?php if($this->session->userdata('c_id') != ''): ?><a href="<?php echo site_url('wishlist');?>"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                        <?php else: ?>
                               
                                <?php endif; ?>
                        <li class="onhover-dropdown mobile-account"> <i class="fa fa-user" aria-hidden="true"></i><?php if($this->session->userdata('c_id') != ''): ?><a href="<?php echo site_url('account/profile');?>" >Account</a>
                        <?php else: ?>
                                <a href="<?php echo site_url('account/login');?>" >Login</a>
                                <?php endif; ?>
                            <ul class="onhover-show-div" style="min-width:200px;">
                               
								<li><a href="<?php echo site_url('account/seller_register');?>" data-lng="en">Become a Seller </a></li>
                                
                                 <?php if($this->session->userdata('c_id') != ''): ?>
                                 <li><a href="<?php echo site_url('account/profile');?>" data-lng="en">Profile</a></li>
                                  <li><a href="<?php echo site_url('wishlist');?>" data-lng="en">Wishlist</a></li>
                                <li><a href="<?php echo site_url('account/logout'); ?>" data-lng="es">Logout</a></li>
                                <?php else: ?>
                                <li><a href="<?php echo site_url('account/login');?>" data-lng="en">Become a Customer</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="navbar">
                            <a href="javascript:void(0)" onclick="openNav()">
                                <div class="bar-style"><i class="fa fa-bars sidebar-bar" aria-hidden="true"></i></div>
                            </a>
                            <div id="mySidenav" class="sidenav">
                                <a href="javascript:void(0)" class="sidebar-overlay" onclick="closeNav()"></a>
                                <nav>
                                    <div onclick="closeNav()">
                                        <div class="sidebar-back text-left"><i class="fa fa-angle-left pr-2" aria-hidden="true"></i> Back</div>
                                    </div>
                                    <ul id="sub-menu" class="sm pixelstrap sm-vertical">
                                        <li> <a href="#">clothing</a>
                                            <ul class="mega-menu clothing-menu">
                                                <li>
                                                    <div class="row m-0">
                                                        <div class="col-xl-4">
                                                            <div class="link-section">
                                                                <h5>women's fashion</h5>
                                                                <ul>
                                                                    <li><a href="#">dresses</a></li>
                                                                    <li><a href="#">skirts</a></li>
                                                                    <li><a href="#">westarn wear</a></li>
                                                                    <li><a href="#">ethic wear</a></li>
                                                                    <li><a href="#">sport wear</a></li>
                                                                </ul>
                                                                <h5>men's fashion</h5>
                                                                <ul>
                                                                    <li><a href="#">sports wear</a></li>
                                                                    <li><a href="#">western wear</a></li>
                                                                    <li><a href="#">ethic wear</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="link-section">
                                                                <h5>accessories</h5>
                                                                <ul>
                                                                    <li><a href="#">fashion jewellery</a></li>
                                                                    <li><a href="#">caps and hats</a></li>
                                                                    <li><a href="#">precious jewellery</a></li>
                                                                    <li><a href="#">necklaces</a></li>
                                                                    <li><a href="#">earrings</a></li>
                                                                    <li><a href="#">wrist wear</a></li>
                                                                    <li><a href="#">ties</a></li>
                                                                    <li><a href="#">cufflinks</a></li>
                                                                    <li><a href="#">pockets squares</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <a href="#" class="mega-menu-banner"><img src="<?php echo base_url();?>front/views/themes/default/img/images/mega-menu/fashion.jpg" alt="" class="img-fluid"></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li> <a href="#">bags</a>
                                            <ul>
                                                <li><a href="#">shopper bags</a></li>
                                                <li><a href="#">laptop bags</a></li>
                                                <li><a href="#">clutches</a></li>
                                                <li> <a href="#">purses</a>
                                                    <ul>
                                                        <li><a href="#">purses</a></li>
                                                        <li><a href="#">wallets</a></li>
                                                        <li><a href="#">leathers</a></li>
                                                        <li><a href="#">satchels</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li> <a href="#">footwear</a>
                                            <ul>
                                                <li><a href="#">sport shoes</a></li>
                                                <li><a href="#">formal shoes</a></li>
                                                <li><a href="#">casual shoes</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">watches</a></li>
                                        <li> <a href="#">Accessories</a>
                                            <ul>
                                                <li><a href="#">fashion jewellery</a></li>
                                                <li><a href="#">caps and hats</a></li>
                                                <li><a href="#">precious jewellery</a></li>
                                                <li> <a href="#">more..</a>
                                                    <ul>
                                                        <li><a href="#">necklaces</a></li>
                                                        <li><a href="#">earrings</a></li>
                                                        <li><a href="#">wrist wear</a></li>
                                                        <li> <a href="#">accessories</a>
                                                            <ul>
                                                                <li><a href="#">ties</a></li>
                                                                <li><a href="#">cufflinks</a></li>
                                                                <li><a href="#">pockets squares</a></li>
                                                                <li><a href="#">helmets</a></li>
                                                                <li><a href="#">scarves</a></li>
                                                                <li> <a href="#">more...</a>
                                                                    <ul>
                                                                        <li><a href="#">accessory gift sets</a></li>
                                                                        <li><a href="#">travel accessories</a></li>
                                                                        <li><a href="#">phone cases</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">belts & more</a></li>
                                                        <li><a href="#">wearable</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#">house of design</a></li>
                                        <li> <a href="#">beauty & personal care</a>
                                            <ul>
                                                <li><a href="#">makeup</a></li>
                                                <li><a href="#">skincare</a></li>
                                                <li><a href="#">premium beaty</a></li>
                                                <li> <a href="#">more</a>
                                                    <ul>
                                                        <li><a href="#">fragrances</a></li>
                                                        <li><a href="#">luxury beauty</a></li>
                                                        <li><a href="#">hair care</a></li>
                                                        <li><a href="#">tools & brushes</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#">home & decor</a></li>
                                        <li><a href="#">kitchen</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="brand-logo headerlogo">
                            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>front/views/themes/default/img/images/logos/logo.png" class="img-fluid" alt=""></a>
                        </div>
                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li>
                                        <div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                                    </li>
                                    <li> <a href="#">Home</a>
                                        <ul>
                                            <li><a href="<?php echo site_url('about');?>">About Us</a></li>
                                        </ul>
                                    </li>
                                    <li class="mega"> <a href="#">Women</a>
                                        <ul class="mega-menu full-mega-menu" style="background-color: #007lbc !important;">
                                            <li>
                                                <div class="container">
                                                    <div class="row">

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Women's fashion</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="<?php echo site_url('product');?>">top</a></li>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">bottom</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">shirts</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>women's fashion</h5></div>
                                                                <div class="menu-content menucontent">
                                                                    <ul class="menucontent">
                                                                        <li><a href="#">dresses</a></li>
                                                                        <li><a href="#">skirts</a></li>
                                                                        <li><a href="#">westarn wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sport wear</a></li>
                                                                        <li><a href="#">bottom wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>kids's fashion</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">top</a></li>
                                                                        <li><a href="#">bottom</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Accessories</h5></div>
                                                                <div class="menu-content menucontent">
                                                                    <ul class="menucontent">
                                                                        <li><a href="#">fashion jewellery</a></li>
                                                                        <li><a href="#">caps and hats</a></li>
                                                                        <li><a href="#">precious jewellery</a></li>
                                                                        <li><a href="#">necklaces</a></li>
                                                                        <li><a href="#">earrings</a></li>
                                                                        <li><a href="#">wrist wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>men's accessories</h5></div>
                                                                 <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">ties</a></li>
                                                                        <li><a href="#">cufflinks</a></li>
                                                                        <li><a href="#">pockets squares</a></li>
                                                                        <li><a href="#">helmets</a></li>
                                                                        <li><a href="#">scarves</a></li>
                                                                        <li><a href="#">phone cases</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row banner-padding">
                                                    <div class="col-xl-6">
                                                        <a href="#" class="mega-menu-banner"><img src="<?php echo base_url();?>front/views/themes/default/img/images/mega-menu/1.jpg" class="img-fluid d-none d-xl-block" alt=""></a>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <a href="#" class="mega-menu-banner"><img src="<?php echo base_url();?>front/views/themes/default/img/images/mega-menu/2.jpg" class="img-fluid d-none d-xl-block" alt=""></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="mega"> <a href="#">Men</a>
                                        <ul class="mega-menu full-mega-menu">
                                            <li>
                                                <div class="container">
                                                    <div class="row">

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>mens's fashion</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">top</a></li>
                                                                        <li><a href="#">bottom</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">shirts</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>women's fashion</h5></div>
                                                                <div class="menu-content menucontent">
                                                                    <ul class="menucontent">
                                                                        <li><a href="#">dresses</a></li>
                                                                        <li><a href="#">skirts</a></li>
                                                                        <li><a href="#">westarn wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sport wear</a></li>
                                                                        <li><a href="#">bottom wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>kids's fashion</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">top</a></li>
                                                                        <li><a href="#">bottom</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Accessories</h5></div>
                                                                <div class="menu-content menucontent">
                                                                    <ul class="menucontent">
                                                                        <li><a href="#">fashion jewellery</a></li>
                                                                        <li><a href="#">caps and hats</a></li>
                                                                        <li><a href="#">precious jewellery</a></li>
                                                                        <li><a href="#">necklaces</a></li>
                                                                        <li><a href="#">earrings</a></li>
                                                                        <li><a href="#">wrist wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>men's accessories</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">ties</a></li>
                                                                        <li><a href="#">cufflinks</a></li>
                                                                        <li><a href="#">pockets squares</a></li>
                                                                        <li><a href="#">helmets</a></li>
                                                                        <li><a href="#">scarves</a></li>
                                                                        <li><a href="#">phone cases</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row banner-padding">
                                                    <div class="col-xl-6">
                                                        <a href="#" class="mega-menu-banner"><img src="<?php echo base_url();?>front/views/themes/default/img/images/mega-menu/1.jpg" class="img-fluid d-none d-xl-block" alt=""></a>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <a href="#" class="mega-menu-banner"><img src="<?php echo base_url();?>front/views/themes/default/img/images/mega-menu/2.jpg" class="img-fluid d-none d-xl-block" alt=""></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="mega"> <a href="#">Kids</a>
                                        <ul class="mega-menu full-mega-menu">
                                            <li>
                                                <div class="container">
                                                    <div class="row">

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>mens's fashion</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">top</a></li>
                                                                        <li><a href="#">bottom</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">shirts</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>women's fashion</h5></div>
                                                                <div class="menu-content menucontent">
                                                                    <ul class="menucontent">
                                                                        <li><a href="#">dresses</a></li>
                                                                        <li><a href="#">skirts</a></li>
                                                                        <li><a href="#">westarn wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sport wear</a></li>
                                                                        <li><a href="#">bottom wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>kids's fashion</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">top</a></li>
                                                                        <li><a href="#">bottom</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Accessories</h5></div>
                                                                <div class="menu-content menucontent">
                                                                    <ul class="menucontent">
                                                                        <li><a href="#">fashion jewellery</a></li>
                                                                        <li><a href="#">caps and hats</a></li>
                                                                        <li><a href="#">precious jewellery</a></li>
                                                                        <li><a href="#">necklaces</a></li>
                                                                        <li><a href="#">earrings</a></li>
                                                                        <li><a href="#">wrist wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>men's accessories</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">ties</a></li>
                                                                        <li><a href="#">cufflinks</a></li>
                                                                        <li><a href="#">pockets squares</a></li>
                                                                        <li><a href="#">helmets</a></li>
                                                                        <li><a href="#">scarves</a></li>
                                                                        <li><a href="#">phone cases</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row banner-padding">
                                                    <div class="col-xl-6">
                                                        <a href="#" class="mega-menu-banner"><img src="<?php echo base_url();?>front/views/themes/default/img/images/mega-menu/1.jpg" class="img-fluid d-none d-xl-block" alt=""></a>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <a href="#" class="mega-menu-banner"><img src="<?php echo base_url();?>front/views/themes/default/img/images/mega-menu/2.jpg" class="img-fluid d-none d-xl-block" alt=""></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="mega"> <a href="#">Home & Living</a>
                                        <ul class="mega-menu full-mega-menu">
                                            <li>
                                                <div class="container">
                                                    <div class="row">

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>mens's fashion</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">top</a></li>
                                                                        <li><a href="#">bottom</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">shirts</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>women's fashion</h5></div>
                                                                <div class="menu-content menucontent">
                                                                    <ul class="menucontent">
                                                                        <li><a href="#">dresses</a></li>
                                                                        <li><a href="#">skirts</a></li>
                                                                        <li><a href="#">westarn wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sport wear</a></li>
                                                                        <li><a href="#">bottom wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>kids's fashion</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">top</a></li>
                                                                        <li><a href="#">bottom</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Accessories</h5></div>
                                                                <div class="menu-content menucontent">
                                                                    <ul class="menucontent">
                                                                        <li><a href="#">fashion jewellery</a></li>
                                                                        <li><a href="#">caps and hats</a></li>
                                                                        <li><a href="#">precious jewellery</a></li>
                                                                        <li><a href="#">necklaces</a></li>
                                                                        <li><a href="#">earrings</a></li>
                                                                        <li><a href="#">wrist wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>men's accessories</h5></div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="#">ties</a></li>
                                                                        <li><a href="#">cufflinks</a></li>
                                                                        <li><a href="#">pockets squares</a></li>
                                                                        <li><a href="#">helmets</a></li>
                                                                        <li><a href="#">scarves</a></li>
                                                                        <li><a href="#">phone cases</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row banner-padding">
                                                    <div class="col-xl-6">
                                                        <a href="#" class="mega-menu-banner"><img src="<?php echo base_url();?>front/views/themes/default/img/images/mega-menu/1.jpg" class="img-fluid d-none d-xl-block" alt=""></a>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <a href="#" class="mega-menu-banner"><img src="<?php echo base_url();?>front/views/themes/default/img/images/mega-menu/2.jpg" class="img-fluid d-none d-xl-block" alt=""></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    <li> <a href="<?php echo site_url('contact');?>">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div><img src="<?php echo base_url();?>front/views/themes/default/img/images/icon/search.png" onclick="openSearch()" class="img-fluid" alt=""> <i class="ti-search" onclick="openSearch()"></i></div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div> <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Search a Product">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="onhover-div mobile-cart">
                                        <div><img src="<?php echo base_url();?>front/views/themes/default/img/images/icon/cart.png" class="img-fluid" alt=""> <i class="ti-shopping-cart"></i></div>
                                        <ul class="show-div shopping-cart">
                                            <li>
                                                <div class="media">
                                                    <a href="#"><img alt="" class="mr-3" src="<?php echo base_url();?>assets/images/fashion/product/1.jpg"></a>
                                                    <div class="media-body"> <a href="#"><h4>item name</h4> </a>
                                                        <h4><span>1 x $ 299.00</span></h4></div>
                                                </div>
                                                <div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <a href="#"><img alt="" class="mr-3" src="<?php echo base_url();?>assets/images/fashion/product/2.jpg"></a>
                                                    <div class="media-body"> <a href="#"><h4>item name</h4> </a>
                                                        <h4><span>1 x $ 299.00</span></h4></div>
                                                </div>
                                                <div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div>
                                            </li>
                                            <li>
                                                <div class="total">
                                                    <h5>subtotal : <span>$299.00</span></h5></div>
                                            </li>
                                            <li>
                                                <div class="buttons"><a href="<?php echo base_url();?>myaccount/viewcart" class="view-cart">view cart</a> <a href="#" class="checkout">checkout</a></div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>