<!DOCTYPE html>
<html class="no-js" lang="en">
<?php echo Modules::run('header/header/head'); ?>
<body>
    <div id="page-wrapper">
        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
            <?php echo Modules::run('sidebar/sidebar/index'); ?>
            <div id="main-container">
             <?php echo Modules::run('header/header/index'); ?>
             <div id="page-content">
                <ul class="breadcrumb breadcrumb-top">
                    <li>Pages</li>
                    <li>Add Page</li>
                </ul>
                <div class="block">
                    <?php echo Modules::run('messages/message/index'); ?>
                    <div class="table-responsive">
                        <table class="table table-vcenter table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Title</th>
                                 <th class="text-right">Action</th>
                             </tr>
                         </thead>
                         <tbody id="tbody">
                          <?php $i= 1; if(!empty($mailtemplates)): foreach($mailtemplates as $mailtemplate): ?>
                          <tr>
                             <td><?= $i; ?></td>
                             <td><?php echo $mailtemplate->mail_title ?></td>
                             <td class="text-right">
                                <?php $id = $mailtemplate->mt_id; ?>
                                <a href="<?= site_url('notification/editmailtemplates/'.$id.'') ?> " class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        <?php $i++;endforeach; else: ?>
                        <tr class="err_msg"><td colspan="5">Mail Templates(s) not available.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php echo Modules::run('footer/footer/index'); ?>
</div>
</div>
</div>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
</body>
</html>