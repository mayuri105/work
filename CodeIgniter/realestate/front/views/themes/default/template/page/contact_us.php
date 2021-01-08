 <!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title ?></title>
    <?php echo Modules::run('header/header/css') ?>
    <meta itemprop="name" content="<?php echo $meta_descriptions ?>">
    <meta itemprop="description" content="<?php echo $meta_keywords ?>">
    <meta itemprop="title" content="<?php echo $meta_titles ?>">
</head>
<body>
<?php echo Modules::run('header/header/index'); ?>
    <!-- Header Stat Banner -->
    <header class="bread_crumb">
        <div class="pag_titl_sec">
            <h1 class="pag_titl"> Contact Us </h1>
            <h4 class="sub_titl"></h4>
        </div>
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Home </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"> Contact Us </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="lnk_pag"><a href="<?php echo site_url() ?>"> Go Back to Home </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="spacer-60"></div>
    <div class="container">
        <div class="row">
            <!-- Contact Section -->
            <section id="contact_sec" class="col-md-8">
                <!-- Contact form -->
                <div class="row">
                    <div class="titl_sec">
                        <div class="col-lg-12">

                            <h3 class="main_titl text-left">
                                Send us email
                            </h3>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="cont_frm">
                                  <?php 
                                    $attributes = array( 'id' => 'contactfrm');
                                    echo form_open('page/contactsubmit', $attributes);  ?>
                                        <div class="control-group form-group col-md-6 first">
                                            <div class="controls">
                                                <input type="text" class="form-control" id="name" required  name="name" placeholder="Your Name">
                                                <div class="in_ico">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="controls">
                                                <input type="email" class="form-control" id="email" required name="email" placeholder="Email Address">
                                                <div class="in_ico">
                                                    <i class="fa fa-envelope-o"></i>
                                                </div>
                                                <p class="help-block"></p>
                                            </div>

                                            <div class="controls">
                                                <input type="text" class="form-control" id="phone" required name="phone" placeholder="Your Phone">
                                                <div class="in_ico">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <p class="help-block"></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="control-group form-group col-md-6">
                                            <div class="controls">
                                                <textarea rows="10" cols="100" class="form-control" id="message" required  maxlength="999" style="resize:none" name="message" placeholder="Message"></textarea>
                                                <div class="in_ico">
                                                    <i class="fa fa-paper-plane-o"></i>
                                                </div>
                                            </div>
                                            <button type="button" class="contactfrm btn btn-primary">Send Message</button>
                                        </div>
                                <div class="clearfix"></div>
                                <div id="success"></div>
                                <!-- For success/fail messages -->
                            </form>
                        
                        </div>
                    </div>
                </div>
                <!-- /.row -->


            </section>

            <!-- Sidebar Section -->
            <section id="sidebar" class="col-md-4">
                <!-- Contact Information -->
                <div class="row">
                    <div class="titl_sec">
                        <div class="col-lg-12">

                            <h3 class="main_titl text-left">
                                 <?php echo $company_name ?>
                            </h3>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="cont_info">
                        <div class="info_sec first">
                            <div class="icon_box">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <p class="infos">  <?php echo $address ?></p>
                        </div>

                        <div class="info_sec">
                            <div class="icon_box">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <p class="infos"><a href="mailto:<?php echo $email_address ?>?Subject=Contact%20from%20labhchar-%20enquiry"> <?php echo $email_address ?> </a>
                            </p>
                        </div>

                        <div class="info_sec">
                            <div class="icon_box">
                                <i class="fa fa-phone"></i>
                            </div>
                            <p class="infos"> <a href="tel:<?php echo $phone ?>"> <?php echo $phone ?> </a> </p>
                        </div>

                        <div class="info_sec">
                            <div class="icon_box">
                                <i class="fa fa-facebook"></i>
                            </div>
                            <p class="infos"><?php echo $facebook ?></p>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </section>

            <div class="spacer-60"></div>

        </div>
    </div>

    <div class="spacer-60"></div>

<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">
   $('.contactfrm').click(function(e){
        e.preventDefault()
        var form = $('#contactfrm');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
                //window.location.reload();
                $('#name').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#message').val('');
            };
            showMessage(response.Type,response.Message);
          }
        });
    });
     
</script>
</body>

</html>