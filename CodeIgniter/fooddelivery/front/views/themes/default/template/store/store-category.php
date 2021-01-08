<section class="quick-navigation">
<nav  class="start">
    <div class="search-wrapper">
        <!-- SEARCH BAR-->
        <div class="search">
            <form  name="searchbar"  class="ng-pristine ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength">
                <input id="search-filter" required=""  maxlength="30" name="query" type="text" placeholder="e.g. milk, water" class="ng-pristine ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength ng-touched"> <span  class="spinner ng-hide"></span>
            </form>
            <span class="icon-search"></span>
        </div>
    </div>
    <div class="path-navigation-wrapper"><span class="quick-search" ><span class="text">Quick search</span> <span class="icon-quick-search-arrow"></span></span>
        
        <div class="path-navigation ng-hide" >
            
            <div class="breadcrums">
                <span class="node-view" ><span class="node" >Categories</span> <span class="icon-breadcrumb-arrow"></span></span>
            </div>
           	
            <div class="dropdown ng-hide">
                <div class="dropdown-button"><strong>Browsing:</strong> <span class="currentnode">Categories</span> <span class="dropdown-icon icon-down-arrow-thick"></span></div>
                <ul class="ng-hide">
                    <li><a >Categories</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="search-results menu-section-content ng-hide" >
    <div class="messages">
        <div class="ng-hide">Search result for <strong>""</strong></div>
        <div class="ng-hide">Please enter at least 3 characters</div>
        <div class="ng-hide">There are no search result for <strong>""</strong></div>
    </div>
    
    <div class="clearfix"></div>
</div>
</section>
<div>
<?php if ($store_info->store_data->notice): ?>
	<div dcom-notices="notices">
        <div class="notices">
            <div class="header">
                <h3> Notices</h3>
            </div>
            <div class="body">
                <div class="notice">
                    <i class="glyphicon glyphicon-info-sign"></i>

                    <div class="text">
                    	<?= $store_info->store_data->notice; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>
<div class="menu-section">
<header>
	<h3 class="current-category">Categories</h3></header>
<div class="menu-section-content" id="category-load">
	<?php foreach ($store_info->category as $sc): ?>
    <div>
        <div  class="menu-item menu-category border" onclick="getSubcategory('<?= $sc->cat_id; ?>');"><span><?= ucfirst($sc->category); ?></h3></span>
        <span class="icon-arrow"></span>
        </div>
    </div>
    <?php endforeach ?>
</div>
</div>