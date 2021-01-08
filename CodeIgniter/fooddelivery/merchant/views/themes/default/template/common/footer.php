    
                <footer role="contentinfo" id="footer">
                    <div class="clearfix">
                        <ul class="list-unstyled list-inline pull-left">
                            <li>
                                <h6 style="margin: 0;">&copy; <?php echo date("Y") ?> <?= ucfirst($site_name) ?></h6>
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
    <script type="text/javascript">
    //override defaults
    alertify.defaults.glossary.title = '<?php echo ucfirst($site_name); ?>';
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    </script>
    <script type="text/javascript">
    $('#input-date-added,#input-date-end,#input-date-start,.date-pic,#datepicker').datepicker({});
    </script>
    <script type="text/javascript">
        $('#readAllOrder').click(function(){
            var s = '1';
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('orders/updateRead') ?>",
                data: 'is_ajax='+ s,
                cache: false,
                success: function(data) {
                    $('#countorder').html('0');

                }
            })
        });
         var s = '1';
         var url = '<?php echo site_url(); ?>';
         setInterval(function() { 
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('orders/getrecentorders') ?>",
                data: 'is_ajax='+ s,
                dataType:"json",
                cache: false,
                success: function(data) {
                    $('#order_list').html('');
                    if (data.length) {
                        var li = '';
                        $('#countorder').html(data.length);
                        for (var i = 0; i < data.length; i++) {
                            li += '<li class="media notification-message" ><a href="'+url+'orders/view/'+data[i].o_id+'"><div class="media-body"><h4 class="notification-heading"><strong>You have ordered on '+ data[i].store_name+'</strong></h4></div></a></li>';
                        };
                        $('#order_list').append(li);
                         jQuery("<audio>").attr({
                            "hidden":true,
                            "autostart":false,
                            "loop":false,
                            "src":"<?= site_url('views/themes/default') ?>/assets/audio/ding.mp3"
                        }).appendTo("#footer");
                        jQuery("audio")[0].play();
                    }else{
                        var li = '';
                        li ='<li class="media notification-message" ><a href=""><h4 class="notification-heading"><strong>No new orders</strong></h4></a></li>'
                        $('#order_list').append(li);
                    }
                    
                }
            })
        },30000); // 1 sec delay to check.
    </script>