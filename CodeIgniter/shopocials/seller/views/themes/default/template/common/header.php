<header class="navbar navbar-inverse">

<ul class="nav navbar-nav-custom">

    <li>
        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
            <i class="fa fa-bars fa-fw"></i>
        </a>
    </li>
</ul>
<ul class="nav navbar-nav-custom pull-right">
    <li>
        <a class="btn btn-sm btn-primary">View Store</a>
    </li>
    <li></li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?= site_url('views/themes/default') ?>/assets/img/placeholders/avatars/avatar2.jpg" alt="avatar"> <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
            <li class="dropdown-header text-center">Account</li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo site_url('login/account'); ?>">
                    <i class="fa fa-user fa-fw pull-right"></i>
                    Profile
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo site_url('login/logout'); ?>"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
            </li>
        </ul>
    </li>
</ul>
</header>