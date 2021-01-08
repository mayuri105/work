<?php echo Modules::run('header/header/account'); ?>
    <?php $upload_path =  base_url().'upload/cuisine/'; 
        $type = $this->session->userdata('type');
       
    ?>

	<div class="page-wrapper" >
    <div style="background-image: url('<?= $upload_path.$cuisine_data->banner_image ?>');" id="page-header-wrapper" class="header-seo group-bg-f" >
        
        <div class="site-breadcrumb-wrapper" >
            <div class="" >
                <ul id="site-breadcrumb" class="container">
                    <li class="crumb">
                        <a itemprop="" href="<?= site_url(); ?>"><span itemprop="title">Home</span></a>
                    </li>
                    <li class="crumb" >
                        <span class="gt">&gt;</span>
                        <a href="<?= site_url('food'); ?>" ><span itemprop="title">Food</span></a>
                    </li>
                    <li class="crumb">
                        <span class="gt">&gt;</span>
                        <a href="<?= strtolower(site_url('food/'.url_title($cuisine_data->cusine_type))); ?>" itemprop="url" ><span itemprop="title"><?= ucfirst($cuisine_data->cusine_type); ?></span></a>
                    </li>
                </ul>
                <div class="clear-breadcrumbs">
                </div>
            </div>
        </div>
        <div id="page-header">
            <h1><?= ucfirst($cuisine_data->cusine_type); ?> for Delivery and Takeout</h1>
            <div >
                <div class="search-field seo" dcom-viewport-spy="mainSearchForm" id="mainSearchForm" >
                    <div id="text-wrapper" >
                        <span class="split-text">Enter your address to get started</span>
                    </div>
                    <div dcom-address-search="" data-placeholder="Street Address, City, State" data-search-input-id="address-search" data-pickup-toggle="true" class="search-form ng-pristine ng-untouched ng-valid" data-cta-text="Search" data-no-address-submit="noAddressSubmit" data-tab-index-address-search="1" data-tab-index-search-button="2">
                        <div class="address-search">
                            <form class="ng-pristine ng-valid">
                                <div class="delivery-pickup">

                                        <span class="delivery-select <?= $pickordelivery =='delivery' ? 'active' : 'inactive' ?>">Delivery
                                        </span> 
                                        <input type="checkbox"  name="pickordelivery" class="optionpicordel"  <?= $pickordelivery =='pickup' ? 'checked' : '' ?>  > 
                                        <span class="pickup-select <?= $pickordelivery =='pickup' ? 'active' : 'inactive' ?>">Pickup</span>
                                    </div>
                                <span class="laundry-toggle-message ng-hide" >Schedule pickup and delivery</span>
                                <div class="dropdown-arrow-wrapper" ></div>
                                <div dcom-location-based-search="" class="location-based-search-wrapper ng-pristine ng-untouched ng-valid left-toggle" >
                                    <div class="location-button-wrapper" >
                                        <span class="icon-location-arrow" ></span>
                                        <span class="spinner ng-hide"></span>
                                    </div>
                                </div>
                                <div class="ng-pristine ng-untouched ng-valid" dcom-address-search-autocomplete="" data-placeholder="Street Address, City, State" search-input-id="address-search" search-label="" has-dropdown="hasDropdown" suppress-automatic-search="suppressAutomaticSearch" no-address-submit="noAddressSubmit" tab-index="1">
                                    <label for="address-search" class="search-label ng-hide"></label>
                                    <input value="" class="ng-pristine ng-untouched ng-valid" id="address-search" placeholder="Street Address, City, State" autocomplete="off" tabindex="1" type="search">
                                    <div class="address-required-message" >
                                        <span>Please enter your address</span>
                                    </div>
                                </div>
                                <button type="submit" class="address-search-submit button primary" tabindex="2">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-content">
        <div class="dcom-loader ng-hide"></div>
        <div class="seo-tags-pages" >
            <div class="cities">
                <div>
                    <section>
                        <div class="intro center">
                            <h2>Merchants Delivering <?= ucfirst($cuisine_data->cusine_type); ?></h2>
                            <p>Got marinara sauce running through your veins? Get your pizza fix delivered when you order up a yummy slice of Italy online with delivery.com. Just enter your address and start browsing neighborhood pizzerias for that perfect pie. Mangia! Mangia!</p>
                        </div>
                    </section>
                    
                    <section>
                        <div class="center">
                            <h3>Cities</h3>
                            <div class="list">
                                <?php if(!empty($food_city)) {
                                    foreach ($food_city as $fc): ?>
                                
                                <div class="column" >
                                    <div class="element" >
                                        <a href="<?= strtolower(site_url('cities/'.url_title($fc->city_name).'/'.url_title($fc->state).'/'.url_title($type))); ?>"><?= $fc->city_name.','.$fc->state ?></a><span>(<?= $fc->count ?>)</span>
                                    </div>
                                </div>

                                <?php endforeach; }else{ ?>    
                                    <div class="column" >
                                    <div class="element" >
                                        <p>No City Found For <?= ucfirst($cuisine_data->cusine_type); ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div dcom-sticky-search="" data-current-group="" data-spy-on="mainSearchForm" class="sticky-search hidden" >
        <div class="search-directive-wrapper" >
            <div class="help-text">
                Enter your address<span class="desktop-only">&nbsp;to get started</span><span class="icon-quick-search-arrow"></span>
            </div>
            <div dcom-address-search="" checkbox-id="sticky-checkbox" is-sticky="true" data-placeholder="Street Address, City, State" data-search-input-id="sticky-address-search" data-pickup-toggle="true" data-cta-text="Search" class="search-form sticky-search-form ng-pristine ng-untouched ng-valid" data-no-address-submit="noAddressSubmit">
                <div class="address-search">
                    <form class="ng-pristine ng-valid">
                        <div class="delivery-pickup" >
                            <span class="delivery-select" >Delivery</span>
                            <input id="sticky-checkbox" class="pickup-toggle pickup-toggle-round" type="checkbox">
                            <label id="label-sticky-checkbox" for="sticky-checkbox"></label>
                            <span class="pickup-select inactive" >Pickup</span>
                        </div>
                        <span class="laundry-toggle-message ng-hide" >Schedule pickup and delivery</span>
                        <div class="dropdown-arrow-wrapper" >
                        </div>
                        <div dcom-location-based-search="" class="location-based-search-wrapper ng-pristine ng-untouched ng-valid left-toggle" >
                            <div class="location-button-wrapper" >
                                <span class="icon-location-arrow" ></span>
                                <span class="spinner ng-hide"></span>
                            </div>
                        </div>
                        <div class="ng-pristine ng-untouched ng-valid" dcom-address-search-autocomplete="" data-placeholder="Street Address, City, State" search-input-id="sticky-address-search" search-label="" has-dropdown="hasDropdown" suppress-automatic-search="suppressAutomaticSearch" no-address-submit="noAddressSubmit" tab-index="">
                            <label for="sticky-address-search" class="search-label ng-hide"></label>
                            <input class="ng-pristine ng-untouched ng-valid" id="sticky-address-search" placeholder="Street Address, City, State" autocomplete="off" tabindex="" type="search">
                            <div class="address-required-message" >
                                <span>Please enter your address</span>
                            </div>
                        </div>
                        <button type="submit" class="address-search-submit button primary" tabindex="">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            $('.sticky-search').addClass('visible');
        }
        else
        {
            $('.sticky-search').removeClass('visible');
        }
    });
</script>

<?php echo Modules::run('footer/footer/account'); ?>