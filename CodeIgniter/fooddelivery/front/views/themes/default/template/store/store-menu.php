<section class="quick-navigation" >
    <nav class="menu-navigation-wrapper">
    <div class="search-wrapper">
        <div class="search">
            <form  name="searchbar" id="search-from"  class="ng-valid-maxlength ng-dirty ng-valid-minlength ng-invalid ng-invalid-required ng-hide">
                <input id="search-filter" required=""  maxlength="30" name="query" type="text" placeholder="e.g. milk, water"  class="ng-valid-maxlength ng-touched ng-dirty ng-valid-minlength ng-invalid ng-invalid-required"> 
                <span  class="spinner ng-hide"></span>
            </form>
            <span class="icon-search" onclick="togglesearchform()"></span>
        </div>
    </div>
    <div class="path-navigation-wrapper">
        <span class="quick-search ng-hide">
            <span class="text">Quick search</span> 
            <span class="icon-quick-search-arrow"></span>
        </span>
        
        <div class="path-navigation" >
            <div class="breadcrums" >
                <span class="node-view " >
                    <span class="node" onclick="getCategory()">Categories</span> 
                    <span class="icon-breadcrumb-arrow"></span>
                </span>
                <span class="node-view " onclick="getSubcategory('<?= $category_parent->cat_id; ?>');" >
                    <span class="node"  ><?= $category_parent->category ?></span> 
                    <span class="icon-breadcrumb-arrow"></span>
                </span>
                <span class="node-view " >
                    <span class="node" ><?= $category_data->category ?></span> 
                    <span class="icon-breadcrumb-arrow"></span>
                </span>
            </div>
            <div class="dropdown ng-hide" onclick="toggleDropdown()" >
                <div class="dropdown-button">
                    <strong>Browsing:</strong> 
                    <span class="currentnode"><?= $category_data->category ?></span> 
                    <span class="dropdown-icon icon-down-arrow-thick"></span>
                </div>
                <ul id="showdropdown" class="ng-hide">
                    <li><a class="">Categories</a></li>
                     <li><a class="" onclick="getSubcategory('<?= $category_parent->cat_id; ?>');"><?= $category_parent->category ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
    <div class="search-results menu-section-content ng-hide" id="searchresult" >
        <div class="messages">
            <div class="messages ng-hide" >Search results for <strong>""</strong></div>
            <div class="messages ng-hide" >Please enter at least 3 characters</div>
            <div class="messages ng-hide" >There are no search results for <strong>""</strong></div>
        </div>
        <div class="clearfix"></div>
        <div class="menu-section"  id="searchItems" >
            
        </div> 
    </div>
</section>
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
<div class="menu-section">
    <header>
        <h3  class="current-category"><?= $category_data->category ?></h3>
    </header>
            <div class="menu-section-content">
                <?php $i= 0; if(!empty($product)){
                foreach ($product as $pt): 
                $dicountPrice = $this->index->DiscountOnPrdoduct($pt->product_id);
                ?>    
                    <div  class="menu-item-wrapper single-column-menu-item odd">
                        <div class="menu-item grocery-product"  onclick="openmodel('<?= $pt->product_id; ?>');">
                            <div  class="name"><?= $pt->product_name; ?></div>
                            <?php if ($pt->price != $dicountPrice): ?>
                            <del>$<span class="amount"><?= $pt->price; ?></span></del>
                            <?php endif ?>
                            <div class="price">$<?= $dicountPrice ?></div>
                        </div>
                    </div>
                    
                    <?php $i++; endforeach;
                    }else{   ?>
                        <div  class="menu-item-wrapper single-column-menu-item odd">
                            <div class="menu-item">
                                <p>No Products Found</p>    
                            </div>
                        </div>
                    <?php } ?>
            </div>
</div>
  
