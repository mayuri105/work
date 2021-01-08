<!doctype html>

<html lang="en" class="no-js">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

<meta name="description" content="">

<meta name="author" content="">

<meta name="theme-color" content="#3e454c">

<title>Belmont-Setting</title>



<!-- Font awesome -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/font-awesome.min.css">

<!-- Sandstone Bootstrap CSS -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap.min.css">

<!-- Bootstrap Datatables -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/dataTables.bootstrap.min.css">

<!-- Bootstrap social button library -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-social.css">

<!-- Bootstrap select -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-select.css">

<!-- Bootstrap file input -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/fileinput.min.css">

<!-- Awesome Bootstrap checkbox -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/awesome-bootstrap-checkbox.css">

<!-- Admin Stye -->

<link rel="stylesheet" href="<?= site_url('front/views/themes/default') ?>/assets/css/style.css">

<link  rel="stylesheet" media="screen" href="<?= site_url('front/views/themes/default') ?>/assets/css/bootstrap-datetimepicker.min.css" >

<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <style>



.image-preview-input {

    position: relative;

	overflow: hidden;

	margin: 0px;    

    color: #FFF;

    background-color: #333;

    border-color: #ccc;    

}

.image-preview-input input[type=file] {

	position: absolute;

	top: 0;

	right: 0;

	margin: 0;

	padding: 0;

	font-size: 20px;

	cursor: pointer;

	opacity: 0;

	background-color: #333;

	filter: alpha(opacity=0);

}

.image-preview-input-title {

    margin-left:2px;

	 background-color: #333;

}



.image-preview-inputb {

    position: relative;

	overflow: hidden;

	margin: 0px;    

    color: #FFF;

    background-color: #333;

    border-color: #ccc;    

}

.image-preview-inputb input[type=file] {

	position: absolute;

	top: 0;

	right: 0;

	margin: 0;

	padding: 0;

	font-size: 20px;

	cursor: pointer;

	opacity: 0;

	background-color: #333;

	filter: alpha(opacity=0);

}

.image-preview-input-titleb {

    margin-left:2px;

	 background-color: #333;

}

</style>

</head>



<body>

<?php echo Modules::run('header/header/index'); ?>

<div class="ts-main-content"> <?php echo Modules::run('menu/menu/index'); ?>

  <div class="content-wrapper">

    <div class="container-fluid">
<div class="breadcrumb">
        <div class="btn-group btn-breadcrumb"> <a href="<?=  site_url('home/view'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-home"></i> &nbsp;Home</a>
        
         <a  class="btn btn-primary" >   Setting</a>
         
          </div>
      </div>
      <div class="row">

        <div class="col-md-8">

         

          <?php echo Modules::run('messages/message/index'); ?>

          <div class="panel-body">

            <?php 

			$attributes = array('class' => 'form-horizontal', 'id' => 'form-main');

			echo form_open_multipart('home/savethemesetting', $attributes); 

			?>

            <input type="hidden" name="InstituteId"  value="<?php echo $this->session->userdata('InstituteId'); ?>">
			
            <div class="form-group">

            

              <label for="firstname" class="col-sm-2 control-label">Logo Image : </label>

            <div class="col-sm-6">

            <div class="input-group image-preview">

                <input type="text" class="form-control image-preview-filename" value="<?php echo $logo; ?>" name="logoimage" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->

                <span class="input-group-btn">

                    <!-- image-preview-clear button -->

                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">

                        <span class="glyphicon glyphicon-remove"></span> Clear

                    </button>

                    <!-- image-preview-input -->

                    <div class="btn btn-default image-preview-input">

                        <span class="glyphicon glyphicon-folder-open"></span>

                        <span class="image-preview-input-title">Browse</span>

                        <input type="file" accept="image/png, image/jpeg, image/gif" name="logoimage" name="input-file-preview"/> <!-- rename it -->

                    </div>

                </span>

            </div>

             </div>

              </div>

            <div class="form-group">

            

              <label for="firstname" class="col-sm-2 control-label">Back Image : </label>

            <div class="col-sm-6">

            <div class="input-group image-previewb">

                <input type="text" class="form-control image-preview-filenameb" name="backimage" value="<?php echo $backimage; ?>" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
			
                <span class="input-group-btn">

                    <!-- image-preview-clear button -->

                    <button type="button" class="btn btn-default image-preview-clearb" style="display:none;">

                        <span class="glyphicon glyphicon-remove"></span> Clear

                    </button>

                    <!-- image-preview-input -->

                    <div class="btn btn-default image-preview-inputb">

                        <span class="glyphicon glyphicon-folder-open"></span>

                        <span class="image-preview-input-titleb">Browse</span>

                        <input type="file" accept="image/png, image/jpeg, image/gif" name="backimage" name="input-file-previewb"/> <!-- rename it -->

                    </div>

                </span>

            </div>

             </div>

              </div>

            <div class="form-group">

              <div class="col-sm-6 col-sm-offset-2">

              

                <button class="btn btn-primary" type="submit">Change</button>

              </div>

            </div>

            </form>

          </div>

        </div>

      </div>
      <br>
       <br> <br> <br><br>
       <br> <br> <br>
<?php echo Modules::run('footer/footer/index'); ?>
    
      </div>

  </div>
  
</div>



<!-- Loading Scripts --> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.min.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/bootstrap-select.min.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/bootstrap.min.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/jquery.dataTables.min.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/dataTables.bootstrap.min.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/Chart.min.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/fileinput.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/chartData.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/main.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/bootstrap-datetimepicker.js"></script> 

<script src="<?= site_url('front/views/themes/default') ?>/assets/js/bootstrap-datetimepicker.fr.js"></script> 

<script type="text/javascript">

   

	$(document).on('click', '#close-preview', function(){ 

    $('.image-preview').popover('hide');

    // Hover befor close the preview

    $('.image-preview').hover(

        function () {

           $('.image-preview').popover('show');

        }, 

         function () {

           $('.image-preview').popover('hide');

        }

    );    

});



$(function() {

    // Create the close button

    var closebtn = $('<button/>', {

        type:"button",

        text: 'x',

        id: 'close-preview',

        style: 'font-size: initial;',

    });

    closebtn.attr("class","close pull-right");

    // Set the popover default content

    $('.image-preview').popover({

        trigger:'manual',

        html:true,

        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,

        content: "There's no image",

        placement:'bottom'

    });

    // Clear event

    $('.image-preview-clear').click(function(){

        $('.image-preview').attr("data-content","").popover('hide');

        $('.image-preview-filename').val("");

        $('.image-preview-clear').hide();

        $('.image-preview-input input:file').val("");

        $(".image-preview-input-title").text("Browse"); 

    }); 

    // Create the preview image

    $(".image-preview-input input:file").change(function (){     

        var img = $('<img/>', {

            id: 'dynamic',

            width:250,

            height:200

        });      

        var file = this.files[0];

        var reader = new FileReader();

        // Set preview image into the popover data-content

        reader.onload = function (e) {

            $(".image-preview-input-title").text("Change");

            $(".image-preview-clear").show();

            $(".image-preview-filename").val(file.name);            

            img.attr('src', e.target.result);

            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");

        }        

        reader.readAsDataURL(file);

    });  

});



	$(document).on('click', '#close-previewb', function(){ 

    $('.image-previewb').popover('hide');

    // Hover befor close the preview

    $('.image-previewb').hover(

        function () {

           $('.image-previewb').popover('show');

        }, 

         function () {

           $('.image-previewb').popover('hide');

        }

    );    

});



$(function() {

    // Create the close button

    var closebtn = $('<button/>', {

        type:"button",

        text: 'x',

        id: 'close-previewb',

        style: 'font-size: initial;',

    });

    closebtn.attr("class","close pull-right");

    // Set the popover default content

    $('.image-previewb').popover({

        trigger:'manual',

        html:true,

        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,

        content: "There's no image",

        placement:'bottom'

    });

    // Clear event

    $('.image-preview-clearb').click(function(){

        $('.image-previewb').attr("data-content","").popover('hide');

        $('.image-preview-filenameb').val("");

        $('.image-preview-clearb').hide();

        $('.image-preview-inputb input:file').val("");

        $(".image-preview-input-titleb").text("Browse"); 

    }); 

    // Create the preview image

    $(".image-preview-inputb input:file").change(function (){     

        var img = $('<img/>', {

            id: 'dynamic',

            width:250,

            height:200

        });      

        var file = this.files[0];

        var reader = new FileReader();

        // Set preview image into the popover data-content

        reader.onload = function (e) {

            $(".image-preview-input-titleb").text("Change");

            $(".image-preview-clearb").show();

            $(".image-preview-filenameb").val(file.name);            

            img.attr('src', e.target.result);

            $(".image-previewb").attr("data-content",$(img)[0].outerHTML).popover("show");

        }        

        reader.readAsDataURL(file);

    });  

});

$('#form-main')[0].reset();

</script>

</body>

</html>

