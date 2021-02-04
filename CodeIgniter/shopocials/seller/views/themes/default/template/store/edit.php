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
    <li>Store</li>
    <li> View Store Information </li>
</ul>
<div class="block">
<?php echo Modules::run('messages/message/index'); ?>
<div class="panel panel-inverse">
<div class="panel-body">

<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>

</ul>
<div class="pb"></div>
	    <div class="tab-content">
	    	<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'store');
	echo form_open_multipart('store/updatestore', $attributes);  ?>
        <div class="tab-pane active" id="tab-general">
        <div class="col-md-12">

				 <input class="form-control" type="hidden" name="shop_id" id="" value="<?= $shop->shop_id; ?>">

				 <input type="hidden" name="merchant_id"  id="merchant_id" value="<?php echo $this->session->userdata('m_id') ?>" class="form-control">
				<div class="col-md-3">
				<label class="control-label">Name
					</label>
					<input type="text" name="shop_name"  id="shop_name" value="<?php echo $shop->shop_name ?>" class="form-control">
				</div>
				<div class="col-md-3">
				<label class="control-label">Contact No
					</label>
					<input type="text" name="shop_phone"  id="shop_phone" value="<?php echo $shop->shop_phone ?>" class="form-control">
				</div>



		<div class="col-md-6">
						<label class="control-label">Tagline
							</label>
							<input type="text" name="tagline"  id="tagline" value="<?php echo $shop->tagline ?>" class="form-control">
						</div>

				<div class="col-md-12">
				<label class="control-label">About 	</label>
					<textarea name="about_shop" rows="10" id="about_shop" class="form-control"><?php echo $shop->about_shop ?></textarea>
				</div>

		</div>



			<div class="col-md-6">
								<label class="control-label">Header Logo </label>
								<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
									<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
										<?php if ($shop->shop_logo): ?>
								<img src="<?php echo getuploadpath().'shop/'.$shop->shop_logo; ?>">
							<?php endif ?>
									</div>
									<div>
										<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
										<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
										<input type="file" name="fileinput"></span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<label class="control-label">fotter Logo </label>
								<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
									<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;">
										<?php if ($shop->footer_logo): ?>
								<img src="<?php echo getuploadpath().'shop/'.$shop->footer_logo; ?>">
							<?php endif ?>
									</div>
									<div>
										<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
										<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
										<input type="file" name="fileinput2"></span>
									</div>
								</div>
							</div>

		</div>
         <div class="col-md-12">

			<a href="<?= site_url('products') ?>" class="btn btn-default pull-left" >Close</a>
			<button type="submit" class="btn btn-primary pull-left">Save changes</button>
		</div>
    </div>
</form>
</div>
</div>
</div>
</div>
<?php echo Modules::run('footer/footer/index'); ?>
</div>
</div>
</div>
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/jquery.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/vendor/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= site_url('views/themes/default') ?>/assets/js/jqueryui-1.10.3.min.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/plugins.js"></script>
<script src="<?= site_url('views/themes/default') ?>/assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo site_url( 'views/themes/default' ) ?>/assets/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/fileupload/js/jquery.fileupload.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/fileupload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/fileupload/js/jquery.fileupload-process.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/fileupload/js/jquery.fileupload-validate.js"></script>
<script src="<?php echo site_url( 'views/themes/default' ) ?>/assets/fileupload/js/jquery.fileupload-image.js"></script>
<script type="text/javascript">
$(function () {
'use strict';
var url = '<?php echo site_url("products/upload_attachment") ?>',
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
$('.delete').click(function(e){
e.preventDefault();
var $tr = $(this).closest('tr');
$tr.find('td').fadeOut(1000,function(){
$tr.remove();
});
})
</script>
</body>
</html>
