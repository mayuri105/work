<?php echo Modules::run('header/header/index'); ?>
<link type="text/css" href="<?= site_url('views/themes/default') ?>/assets/plugins/form-select2/select2.css" rel="stylesheet"> 
<?php echo Modules::run('sidebar/sidebar/merchant')  ?>

<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="<?= site_url('index'); ?>">Home</a></li>
				<li ><a href="<?= site_url('adsorder'); ?>">Ads Order</a></li>
				<li class="active"><a href="">Place Order</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<h2 >Ads Order </h2>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					
					<div class="panel-body">
						<?php echo $this->session->msg; ?>
						<pre>
						<?php print_r($this->session->userdata()) ?>
					</div>

						
				</div>
			</div>
		</div>
		<!-- #page-content -->
	</div>
<?php echo Modules::run('footer/footer/index'); ?>

</body>
</html>