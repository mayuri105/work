<nav id="mp-menu" class="mp-menu alternate-menu">
      <div class="mp-level">
        <h2>Menu</h2>
        <ul>
          <li><a href="<?=site_url('blog');?>">Home</a></li>
           <?php foreach ($blog_cat as $c): ?>
          <li><a href="<?=site_url($c->blog_cat_slug);?>"><?= $c->blog_cat_name ?></a></li>
          <?php endforeach ?>
           <?php if (is_login()): ?>
           <li class="has-sub"> <a href="#"><?php echo ucfirst($this->session->userdata('username')); ?></a>
            <div class="mp-level">
              <h2>My Coupons(10)</h2>
              <a class="mp-back" href="#">back</a>
             
            </div>
          </li>
           <?php endif ?>
            <?php if (is_login()): ?>
          <li><a href="<?php echo site_url('login/logout') ?>">logout</a></li>
          <?php else: ?>
          <li><a href="<?php echo site_url('login/moblogin') ?>">Login</a></li>
            <?php endif ?>
        </ul>
      </div>
    </nav>