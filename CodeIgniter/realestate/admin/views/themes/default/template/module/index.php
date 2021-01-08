<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Modules Setup</a></li>
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					<div class="panel-heading"></div>
						<div class="panel-body no-padding">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Modules Name</th>
										<th class="text-right">Change</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<tr>
										<td>1</td>
										<td>Theme Option</td>
										
										<td class="text-right">
											<a data-toggle="modal" href="<?= site_url('module/themeoption') ?>" class="btn btn-primary">Edit</a>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Seo </td>
										
										<td class="text-right">
											<a data-toggle="modal" href="<?= site_url('module/seo') ?>" class="btn btn-primary">Edit</a>
										</td>
									</tr>
									<tr>
										<td>3</td>
										<td>Sms Api </td>
										
										<td class="text-right">
											<a data-toggle="modal" href="<?= site_url('module/smsapi') ?>"  class="btn btn-primary">Edit
											</a>
										</td>
									</tr>
									<tr>
										<td>4</td>
										<td>Social Media Detail</td>
										
										<td class="text-right">
											<a data-toggle="modal" href="<?= site_url('module/socialmedia') ?>"  class="btn btn-primary">Edit
											</a>
										</td>
									</tr>
									<tr>
										<td>5</td>
										<td>Mail Option</td>
										
										<td class="text-right">
											<a data-toggle="modal" href="<?= site_url('module/mailoption') ?>"  class="btn btn-primary">Edit
											</a>
										</td>
									</tr>
									<tr>
										<td>6</td>
										<td>Other Option</td>
										
										<td class="text-right">
											<a data-toggle="modal" href="<?= site_url('module/otheroptions') ?>"  class="btn btn-primary">Edit
											</a>
										</td>
									</tr>

									
								</tbody>
								
							</table>
						</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>


</body>
</html>

