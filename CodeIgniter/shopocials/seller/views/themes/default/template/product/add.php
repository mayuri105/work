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
	<li>Product</li>
	<li>Add Product </li>
</ul>
<div class="block">

	<?php echo Modules::run('messages/message/index'); ?>


	<div class="panel panel-inverse">
		<div class="panel-body">
			<?php
			$attributes = array('class' => 'form-horizontal', 'id' => 'product');

			echo form_open_multipart('products/add', $attributes);  ?>

			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>

				<li class=""><a href="#tab-images" data-toggle="tab">Images</a></li>


			</ul>
			<div class="pb"></div>
			<div class="tab-content">


				<div class="tab-pane active" id="tab-general">
					<div class="col-md-12">
						<br>
						<br>
						<input type="hidden" name="merchant_id"  id="merchant_id" value="<?php echo $this->session->userdata('m_id') ?>" class="form-control">
						<div class="col-md-8">
							<label class="control-label">Name
								<span class="required">*</span></label>
								<input type="text" name="product_name"  id="product_name" value="" class="form-control">
							</div>

							<div class="col-md-4">
								<label class="control-label"> Stock
									<span class="required">*</span>
								</label>
								<select class="form-control" name="stock" >
									<option value="">None</option>
									<option value="In Stock">In Stock</option>
									<option value="Out Of Stock">Out Of Stock</option>


								</select>
							</div>

							<div class="col-md-8">
								<label class="control-label">Product Description	</label>
								<textarea name="small_desc" rows="10" id="small_descsmall_desc" class="form-control"></textarea>
							</div>

							<div class="col-md-4">
								<label class="control-label">Image </label>

								<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
									<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 180px;"></div>
									<div>
										<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
										<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
										<input type="file" name="fileinput2"></span>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label class="control-label">Brand
									<span class="required">*</span>
								</label>
								<select class="form-control" name="brand_id">
									<option value="">None</option>

									<?php foreach ($brands as $t): ?>
										<option value="<?php echo $t->brand_id ?>"><?php echo $t->name ?></option>
									<?php endforeach ?>

								</select>
							</div>


							<div class="col-md-3">
								<label class="control-label">Category
									<span class="required">*</span>
								</label>
								<select class="form-control" name="cat_id" id="cat_id" >
									<option value="">None</option>
									<?php foreach ($categories as $c): ?>
										<option value="<?php echo $c->cat_id ?>"><?php echo $c->category ?></option>
									<?php endforeach ?>

								</select>

							</div>
							<div class="col-md-3">
									<label class="control-label">Category GST Rate(%)</label>
									<input type="text" class="form-control"  id="taxrateper" name="taxrateper" placeholder="Gst Rate">
								
							</div>
							<div class="col-md-3">
								
									<label class="control-label">Category Marketplace GST Rate(%)</label>
									<input type="text" class="form-control"  id="marketrate" name="marketrate" placeholder="Marketplace Gst Rate">
								
							</div>
							<div class="col-md-4">
								<label class="control-label">Price</label>
								<input type="text" id="price" name="price" class="form-control" placeholder="Enter Product Price">
							</div>
							<div class="col-md-4">
									<label class="control-label">Category GST Amount Rs</label>
									<input type="text" class="form-control" placeholder="Gst Amount Rupees" id="total_tax" name="total_tax" >
							</div>
							<div class="col-md-4">
									<label class="control-label">Category Marketplace Amount Rs</label>
									<input type="text" class="form-control" placeholder="Marketplace Amount Rupees" id="market_rate_rs" name="market_rate_rs" >
							</div>
							<div class="col-md-4">
									<label class="control-label">Shipping Fee</label>
									<input type="text" class="form-control" value="<?php echo $shipping_fee; ?>" name="shipping_fee" id= "ship_fee" disabled >
							</div>
							<div class="col-md-4">
									<label class="control-label">Cod Charge</label>
									<input type="text" class="form-control" value="<?php echo $cod_charge;  ?>" name="cod_charge" id="cod_charge" disabled >
							</div>
							<div class="col-md-4">
									<label class="control-label">TCS Fee</label>
									<input type="text" class="form-control" value="<?php echo $tcs_fee;  ?>" name="tcs_fee" id="tcs_fee" disabled >
							</div>
							<div class="col-md-4">
									<label class="control-label">Total Amount Rupees</label>
									<input type="text" class="form-control" placeholder="Total Amount Rupees" id="total_amt" name="total_amt" >
							</div>
							<div class="col-md-4">
									<label class="control-label">Seller Pay</label>
									<input type="text" class="form-control" placeholder="Seller Pay" id="seller_pay" name="seller_pay" >
							</div>
							<div class="col-md-4">
								<label class="control-label">Quantity</label>
								<input type="number" name="qty" min="1"  class="form-control">
							</div>

							<div class="col-md-12">

							<label class="control-label">Display on Home Page</label>
							<br></br>
							<label class="switch switch-primary">
							<input type="checkbox" id="product-status" name="is_popular" value="1"><span></span>
							</label>
							</div>
						</div>

					</div>

					<div class="tab-pane" id="tab-images">

						<div class="col-md-12">
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

								<div id="progress" class="progress">
									<div class="progress-bar progress-bar-success"></div>
								</div>

								<div>
									<div id="img_alg"></div>
									<table role="presentation" id="files" class="table table-striped">
										<tbody class="files">


										</tbody>
									</table>

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

<script type="text/javascript">
$(document).ready(function(){
$('#cat_id').on("change",function (e) {
var cat_id = $('#cat_id').val();
$.ajax({
type: "POST",
dataType:'json',
url: '<?php echo site_url("products/gettaxrate") ?>',
data:{'cat_id':cat_id},
success: function(response) {
	var result = JSON.parse(JSON.stringify(response))
	$('#taxrateper').val(result.taxrate);
}
});
$.ajax({
type: "POST",
dataType:'json',
url: '<?php echo site_url("products/getmarketrate") ?>',
data:{'cat_id':cat_id},
success: function(response) {
	var result = JSON.parse(JSON.stringify(response))
	$('#marketrate').val(result.marketrate1);
}
});
});

$('#price').on('input',function(e)
{
var taxrate = $('#taxrateper').val();
var marketrate1 = $('#marketrate').val();
var price = $('#price').val();
var cod = $('#cod_charge').val();
var ship_fee = $('#ship_fee').val();
var tcs_fee = $('#tcs_fee').val();

var priceper= parseFloat(price) * parseInt(100) / parseInt(118);
var taxrupee = parseInt(taxrate) *  parseFloat(price) / parseInt(100);
var marketrupee = parseInt(marketrate1) *  parseFloat(price) / parseInt(100);
var total_amt = parseInt(price) +  parseFloat(taxrupee) + parseFloat(marketrupee);
var seller_pay = parseFloat(price) - parseFloat(marketrupee) -  parseFloat(taxrupee) - parseFloat(cod) - parseFloat(ship_fee) -parseFloat(tcs_fee);

document.getElementById('total_tax').value=  parseFloat(taxrupee).toFixed(2);
document.getElementById('market_rate_rs').value=  parseFloat(marketrupee).toFixed(2);
document.getElementById('seller_pay').value=  parseFloat(seller_pay).toFixed(2);
document.getElementById('total_amt').value=  parseFloat(total_amt).toFixed(2);


});

})
</script>

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
});
function SomeDeleteRowFunction(btndel) {
if (typeof(btndel) == "object") {
$(btndel).closest("tr").remove();
} else {
return false;
}
}
</script>
</body>
</html>
