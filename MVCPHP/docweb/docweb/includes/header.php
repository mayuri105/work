

<header>
            
            <div class="header-bg">
            
            <div id="search-overlay">
            <div class="container">
        						<div id="close">X</div>
        	
        						<input id="hidden-search" type="text" placeholder="Start Typing..." autofocus autocomplete="off"  /> <!--hidden input the user types into-->
        						<input id="display-search" type="text" placeholder="Start Typing..." autofocus autocomplete="off" /> <!--mirrored input that shows the actual input value-->
        					</div></div>
               
                	
                    <!--Topbar-->
                    <div class="topbar-info no-pad">                    
                        <div class="container">                     
                            <div class="social-wrap-head col-md-2 no-pad">
                                <ul>
                                <li><a href="#"><i class="icon-facebook head-social-icon" id="face-head" data-original-title="" title=""></i></a></li>
                                <li><a href="#"><i class="icon-social-twitter head-social-icon" id="tweet-head" data-original-title="" title=""></i></a></li>
                                <li><a href="#"><i class="icon-google-plus head-social-icon" id="gplus-head" data-original-title="" title=""></i></a></li>
                                <li><a href="#"><i class="icon-linkedin head-social-icon" id="link-head" data-original-title="" title=""></i></a></li>
                                <li><a href="#"><i class="icon-rss head-social-icon" id="rss-head" data-original-title="" title=""></i></a></li>
                                </ul>
                            </div>                            
                            <div class="top-info-contact pull-right col-md-6">
                           
      <!--  <a class="button" href="#" >SignIn</a> |   <a class="buttonsignup" href="signup.php" >SignUp</a>-->
        
        
        
    <div id="search" class="fa fa-search search-head"></div>
                            </div>                      
                        </div>
                    </div><!--Topbar-info-close-->
                    
                    
                    
                    
                    
                    <div id="headerstic">
                    
                    <div class=" top-bar container">
                    
                    
                    
                    	<div class="row">
                        <div class="popup">
        	<a href="#" class="close">CLOSE</a>
            <form method="post" action="login.php"  onsubmit="return validateLogin();">
            	<P> <input name="LoginType" type="radio" id="type" value="1"  checked="checked" />Doctor &nbsp; &nbsp;<input name="LoginType" id="type1" type="radio" value="2" />Patient </P><span style="color:#FF6699;" id="type_err"></span>
            	<P><span class="title">Username</span> <input name="txtUsername" type="text" id="txtUsername" /></P><span style="color:#FF6699;" id="uname_err"></span>
                <P><span class="title">Password</span> <input name="txtPassword" type="password" id="txtPassword" /></P><span style="color:#FF6699;" id="pass_err"></span>
                <P><input name="btnLogin" type="submit" value="SignIn" /></P>
            </form>
        </div>
                            <nav class="navbar navbar-default" role="navigation">
                              <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                          
                          <button type="button" class="navbar-toggle icon-list-ul" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                          </button>
                          <button type="button" class="navbar-toggle icon-rocket" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                            <span class="sr-only">Toggle navigation</span>
                          </button>

                          <a href="index.php"><div class="logo"></div></a>
                        </div>
                            
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="index.php"><i class="icon-home"></i>Home</a>
								<!--<ul class="dropdown-menu">
                                    <li><a href="home-page-1.html">Home Page 1</a></li>
									<li><a href="home-page-2.html">Home Page 2</a></li>
									<li><a href="home-page-3.html">Home Page 3</a></li>
									<li><a href="home-page-4.html">Home Page 4</a></li>
									<li><a href="home-page-5.html">Home Page 5</a></li>
									<li><a href="home-page-6.html">Home Page 6</a></li>
									<li><a href="home-page-7.html">Home Page 7</a></li>
									<li><a href="home-page-8.html">Home Page 8</a></li>
                                </ul>-->
							</li>

                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i>Features<b class="icon-angle-down"></b></a>
                                <ul class="dropdown-menu">
                                	<li class="dropdown"><a href="#">Page Elements</a>
										<ul class="dropdown-menu">
		                                    <li><a href="page-elements-1.html">Page Elements 1</a></li>
		                                    <li><a href="page-elements-2.html">Page Elements 2</a></li>
		                                    <li><a href="page-elements-3.html">Page Elements 3</a></li>
		                                </ul>
		                            </li>
                                    <li><a href="typography.html">Typography</a></li>
                                    <li><a href="columns.html">Columns</a></li>
                                    <li><a href="pricing-tables.html">Pricing Tables</a></li>
									<li><a href="pricing-plans.html">Pricing Plans</a></li>
                                    <li><a href="flip-box.html">Flip Box</a></li>
									<li><a href="call-to-action.html">Call To Action</a></li>
                                </ul>
                            </li>
                            
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file"></i>Pages<b class="icon-angle-down"></b></a>
                                <ul class="dropdown-menu">
                                	<li class="dropdown"><a href="#">About Us</a>
										<ul class="dropdown-menu">
		                                    <li><a href="about-us-1.html">About Us 1</a></li>
                                    		<li><a href="about-us-2.html">About Us 2</a></li>
		                                </ul>
		                            </li>
		                            <li class="dropdown"><a href="#">Services</a>
										<ul class="dropdown-menu">
		                                    <li><a href="services-1.html">Services 1</a></li>
                                    		<li><a href="services-2.html">Services 2</a></li>
		                                </ul>
		                            </li>
                                    <li><a href="departments.html">Departments</a></li>
                                    <li class="dropdown"><a href="#">Meet Our Doctors</a>
										<ul class="dropdown-menu">
		                                    <li><a href="meet-our-doctors-1.html">Meet Our Doctors 1</a></li>
                                    		<li><a href="meet-our-doctors-2.html">Meet Our Doctors 2</a></li>
		                                </ul>
		                            </li>
                                    <li><a href="testimonials.html">Testimonials</a></li>
                                    <li><a href="faq.html">FAQs</a></li>
								</ul>
                            </li>
                            
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-camera"></i>Gallery<b class="icon-angle-down"></b></a>
                                <ul class="dropdown-menu">
                                	<li class="dropdown left-dropdown"><a href="#">Gallery Carousel</a>
										<ul class="dropdown-menu">
		                                    <li><a href="gallery-1-column-carousel.html">1 Column Carousel</a></li>
											<li><a href="gallery-2-columns-carousel.html">2 Columns Carousel</a></li>
											<li><a href="gallery-3-columns-carousel.html">3 Columns Carousel</a></li>
											<li><a href="gallery-4-columns-carousel.html">4 Columns Carousel</a></li>
		                                </ul>
		                            </li>
		                            <li class="dropdown left-dropdown"><a href="#">Gallery Full Width</a>
										<ul class="dropdown-menu">
		                                    <li><a href="gallery-1-column.html">Gallery 1 Column</a></li>
		                                    <li><a href="gallery-2-columns.html">Gallery 2 Columns</a></li>
											<li><a href="gallery-3-columns.html">Gallery 3 Columns</a></li>
											<li><a href="gallery-4-columns.html">Gallery 4 Columns</a></li>
		                                </ul>
		                            </li>
		                            <li class="dropdown left-dropdown"><a href="#">Gallery Left Sidebar</a>
										<ul class="dropdown-menu">
		                                    <li><a href="gallery-1-column-left-sidebar.html">Gallery 1 Column</a></li>
											<li><a href="gallery-2-columns-left-sidebar.html">Gallery 2 Columns</a></li>
											<li><a href="gallery-3-columns-left-sidebar.html">Gallery 3 Columns</a></li>
		                                </ul>
		                            </li>
		                            <li class="dropdown left-dropdown"><a href="#">Gallery Right Sidebar</a>
										<ul class="dropdown-menu">
											<li><a href="gallery-1-column-right-sidebar.html">Gallery 1 Column</a></li>
											<li><a href="gallery-2-columns-right-sidebar.html">Gallery 2 Columns</a></li>
											<li><a href="gallery-3-columns-right-sidebar.html">Gallery 3 Columns</a></li>
		                                </ul>
		                            </li>
                                </ul>
                            </li>
                            
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i>Blog<b class="icon-angle-down"></b></a>
                                <ul class="dropdown-menu">
                                	<li class="dropdown left-dropdown"><a href="#">Blog Masonry</a>
										<ul class="dropdown-menu">
											<li><a href="blog-masonry-full-width.html">Full Width</a></li>
		                                    <li><a href="blog-masonry-left-sidebar.html">Left Sidebar</a></li>
		                                    <li><a href="blog-masonry-right-sidebar.html">Right Sidebar</a></li> 
		                                </ul>
		                            </li>
		                            <li class="dropdown left-dropdown"><a href="#">Blog Medium Image</a>
										<ul class="dropdown-menu">
											<li><a href="blog-medium-full-width.html">Full Width</a></li>
											<li><a href="blog-medium-left-sidebar.html">Left Sidebar</a></li>
											<li><a href="blog-medium-right-sidebar.html">Right Sidebar</a></li>
		                                </ul>
		                            </li>
									<li class="dropdown left-dropdown"><a href="#">Blog Large Image</a>
										<ul class="dropdown-menu">
											<li><a href="blog-full-width.html">Blog Full Width</a></li>
											<li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
											<li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
		                                </ul>
		                            </li>					
									<li><a href="blog-with-slider.html">Blog With Slider</a></li>
									<li class="dropdown left-dropdown"><a href="#">Blog Single Post</a>
										<ul class="dropdown-menu">
											<li><a href="blog-image-post.html">Image Post</a></li>
											<li><a href="blog-gallery-post.html">Gallery Post</a></li>
											<li><a href="blog-video-post.html">Video Post</a></li>
											<li><a href="blog-full-width-post.html">Full Width Post</a></li>
		                                </ul>
		                            </li>	
                                  </ul>
                            </li>
                            
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-envelope"></i>Contact Us<b class="icon-angle-down"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="contact-1.html">Contact Version 1</a></li>
                                    <li><a href="contact-2.html">Contact Version 2</a></li>
                                    <li><a href="contact-3.html">Contact Version 3</a></li>
                                </ul>
                            </li>
                            <li class="active"><a class="button" href="#" >SignIn</a></li>
                           	<li class="active"> <a class="buttonsignup" href="signup.php" >SignUp</a></li>
                        </ul>
                         
                    </div><!-- /.navbar-collapse -->
                                
                                
                                <div class="hide-mid collapse navbar-collapse option-drop" id="bs-example-navbar-collapse-2">
                                  
                                  
                                  <ul class="nav navbar-nav navbar-right other-op">
                                    <li><i class="icon-phone2"></i>+91 9028556688</li>
                                    <li><i class="icon-mail"></i><a href="#" class="mail-menu">demo@companyname.com</a></li>
                                    
                                    <li><i class="icon-globe"></i>
                                        <a href="#" class="mail-menu"><i class="icon-facebook"></i></a>
                                        <a href="#" class="mail-menu"><i class="icon-google-plus"></i></a>
                                        <a href="#" class="mail-menu"><i class="icon-linkedin"></i></a>
                                        <a href="#" class="mail-menu"><i class="icon-social-twitter"></i></a>
                                    </li>
                                    <li><i class="icon-search"></i>
                                    <div class="search-wrap"><input type="text" id="search-text" class="search-txt" name="search-text">
                                    <button id="searchbt" name="searchbt" class="icon-search search-bt"></button></div>
                                    </li>
                                    
                                  </ul>
                                </div><!-- /.navbar-collapse -->
                                
                                <div class="hide-mid collapse navbar-collapse cart-drop" id="bs-example-navbar-collapse-3">

                                  
                                  
                                  <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#"><i class="icon-cart"></i>0 item(s) - $0.00</a></li>
                                    <li><a href="#"><i class="icon-user"></i>My Account</a></li>
                                  </ul>
                                </div><!-- /.navbar-collapse -->
                                
                                
                                
                              </div><!-- /.container-fluid -->
                            </nav>
                    	</div>    
                    </div><!--Topbar End-->
                	</div>
                    
                    
                    
                    
                    
                    
                    
              </div>
            </header>
            
      
				<script src="js/validation.js" language="javascript" type="text/javascript"></script>