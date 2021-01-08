    
                <footer role="contentinfo">
                    <div class="clearfix">
                        <ul class="list-unstyled list-inline pull-left">
                            <li>
                                <h6 style="margin: 0;">&copy; <?php echo date("Y") ?> <?= ucfirst($site_name) ?></h6>
                            </li>
                        </ul>
                        <ul class="list-unstyled list-inline pull-right">
                            <li>
                                <h6 style="margin: 0;"> Developed by <a href="http://www.krafty.in?utm_source=Labhchar&utm_medium=Footer" target="_blanck">KRAFTY</a>
                                </h6>
                            </li>
                        </ul>
                       
                        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!-- 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    -->
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/jquery-1.10.2.min.js"></script>
   
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/jqueryui-1.10.3.min.js"></script>
   
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/bootstrap.min.js"></script>
    <!-- Load Bootstrap -->
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/enquire.min.js"></script>
    <!-- Load Enquire -->
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/velocityjs/velocity.min.js"></script>
    <!-- Load Velocity for Animated Content -->
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/velocityjs/velocity.ui.min.js"></script>
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/application.js"></script>
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/alertifyjs/alertify.min.js"></script>
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/form-validation/jquery.validate.js"></script><!-- Validate Plugin -->
    <script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script><!-- Validate Plugin -->

    <script type="text/javascript">
    //override defaults
    alertify.defaults.glossary.title = '<?php echo ucfirst($site_name); ?>';
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    </script>
    <script type="text/javascript">
    $('#input-date-added,#input-date-end,#input-date-start,.date').datepicker({
         dateFormat: 'dd-mm-yy'
      });
    $('.timepicker').timepicker({
      });
    </script>