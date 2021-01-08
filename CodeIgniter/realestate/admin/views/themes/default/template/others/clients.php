<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/form-select2/select2.css">


<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/css/jquery.fileupload-ui.css" type="text/css" />
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/css/jquery.fileupload.css" type="text/css" />
<link rel="stylesheet" href="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/css/style.css" type="text/css" />



<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('others') ?>">Others</a></li>
				<li class="active"><a href="">Add Client Images</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Add Client Images</h2>
				<div class="panel panel-inverse">
					<div class="panel-body">
						<ul class="nav nav-tabs">
					      	
					       	<li class=""><a href="#tab-images" data-toggle="tab">Images</a></li>
						</ul>
						<?php 
							$attributes = array('class' => 'form-horizontal', 'id' => 'others');

							echo form_open_multipart('others/saveClientImage', $attributes);  ?>		
					   
					   	    <div class="tab-content">
					   	    	
								<div class="tab-pane active" id="tab-images">
									<div id="images" class="span9">
					                    <span class="btn btn-success fileinput-button">
					                        <i class="fa fa-file-movie-o"></i>
					                        <span>Select file</span>
					                        <input id="fileupload" type="file" multiple name="attachment[]" class="form-control" />
					                    </span>
					                    <div style="display: none;">
					                        <span class="btn btn-primary start pull-right">
					                            <i class="icon-upload-alt"></i>
					                            <span>Start Upload</span>
					                        </span>
					                    </div>   
					                    <br><br>
					                    <!-- The global progress bar -->
					                    <div id="progress" class="progress">
					                        <div class="progress-bar progress-bar-success"></div>
					                    </div>
					                    <!-- The container for the uploaded files -->
					                    <div  >
					                        <div id="img_alg"></div>
					                        <table role="presentation" id="files" class="table table-striped">
					                        	<tbody class="files">
					                        		<?php foreach ($client_images as $proImage): ?>
					                        		<tr>
					                        			<td>
									                        			
					                        			<img src="<?php echo getuploadpath().'clients/'.$proImage->image_name ?>" width="100" height="100">
					                        			
					                        			<input type="hidden" name="attachment[]" value="<?php echo $proImage->image_name ?>">
					                        			<button class="btn pull-right btn-danger delete"><i class="fa fa-minus"></i>
					                        				<span>Delete</span>
					                        			</button>
					                        			</td>
					                        		</tr>
					                        		<?php endforeach ?>

					                        	</tbody>
					                        </table>
					                    
					                    </div>
					                    <!-- END files -->
					                 </div>
					                 <!-- END .images -->
								</div>
								
								<div class="modal-footer">
									<a href="<?php echo site_url('others') ?>" class="btn btn-default">Close</a>
									<button type="submit" class="btn btn-primary">Save Changes</button>
								</div>
								
						    </div>
						

					</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>


<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/form-select2/select2.js"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload-image.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload-process.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload-validate.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/plugins/fileupload/js/jquery.fileupload-image.js"></script>

<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script type="text/javascript">
jQuery.validator.addMethod("greaterThan", 
	function(value, element, params) {

	    if (!/Invalid|NaN/.test(new Date(value))) {
	        return new Date(value) < new Date($(params).val());
	    }

	    return isNaN(value) && isNaN($(params).val()) 
	        || (Number(value) > Number($(params).val())); 
	},'Must be greater than {0}.');	
	$('#others').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		rules:{
	        start_date: { greaterThan: "#end_date" }
	    }
		
	});



$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?php echo site_url("others/upload_attachment") ?>',
        uploadButton = $('.start')
        .on('click', function () {
            var $this = $(this),
                data = $this.data();
            $this
                .off('click')
                .text('Abort')
                .on('click', function () {
                    $this.remove();
                    data.abort();
                });
            data.submit().always(function () {
                $this.remove();
            });
        });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<tbody/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<tr/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
            	var link = file.name;
                var html = '';
                var link = file.name;
                $(data.context.children()[index]).wrap(link).append('<input type="hidden" name="attachment[]" value="'+file.name+'" /><button class="btn pull-right btn-danger delete"><i class="fa fa-minus"></i><span>Delete</span></button>');
                // var link = $('<a>')
                //     .attr('target', '_blank')
                //     .prop('href', file.url);
                // $(data.context.children()[index]).wrap(link);

            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

// $(document).delegate('.delete','click',function(){
//     $(this).find('tr').remove();
// });

$('.delete').click(function(e){
	e.preventDefault();
	var $tr = $(this).closest('tr');
	$tr.find('td').fadeOut(1000,function(){ 
	$tr.remove();                    
	}); 	
})		
$('#amenities').select2({})
</script>

</body>
</html>
