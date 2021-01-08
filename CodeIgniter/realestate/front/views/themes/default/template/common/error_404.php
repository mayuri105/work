<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title ?></title>
   	<?php echo Modules::run('header/header/css') ?>
    <meta itemprop="title" content="<?php echo $meta_titles ?> ">
    <meta itemprop="description" content="<?php echo $meta_descriptions ?>">
	<meta itemprop="keywords" content="<?php echo $meta_keywords ?>">
	
</head>
<body>
<?php echo Modules::run('header/header/index'); ?>
  <header class="bread_crumb">
        <div class="pag_titl_sec">
            <h1 class="pag_titl"> 404 page </h1>
            <h4 class="sub_titl"> Echo Park occupy mustache gastropub </h4>
        </div>
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="./index.php"> Home </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"> 404 page </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="lnk_pag"><a href="./index.php"> Go Back to Home </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="spacer-60"></div>
    <div class="container">
        <!-- 404 Section -->
        <section id="wrng_pg">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h2 class="lrg_titl"> 404 </h2>
                    <h3 class="sub_titl"> OOPS, YOU’VE ENCOUNTERED AN ERROR </h3>
                    <p class="desc"> It appears the page you were looking for doesn’t exist. Sorry about that </p>
                    <div class="btns">
                        <a href="./index.php" class="orn_btn"> Back to Home </a>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </section>
        <div class="spacer-60"></div>
    </div></body>

<?php echo Modules::run('footer/footer/index'); ?>

</body>

</html>