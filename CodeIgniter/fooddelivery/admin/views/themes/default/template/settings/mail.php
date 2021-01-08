<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Settings</a></li>
			</ol> 
 
			 <div class="container-fluid">
			 	<?php echo Modules::run('messages/message/index'); ?>
			 	<div class="pb"></div>
				<div class="row">
					
                    <div class="panel panel-inverse">
                    	<div class="panel-body ">
						
	                    <div class="tab-content">
		                    <div class="tab-pane active" id="tab-general">
		                    	
								<div class="panel-editbox" data-widget-controls=""></div>
								<div class="panel-body">
								<table class="table table-striped" id="aftersearch">
									<thead>
										<tr>
											<th>#</th>
											<th>Title</th>
											<th>Added Date</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody id="tbody">
										<?php $i= 1; if(!empty($mailtemplates)): foreach($mailtemplates as $mailtemplate): ?>
										<tr>
											<td><?= $i; ?></td>
											<td><?php echo $mailtemplate->mail_title ?></td>
											<td>
												<?php echo date('d-m-Y',strtotime($mailtemplate->added_date)) ?></td>
											<td class="text-right">
												<?php $id = $mailtemplate->mt_id; ?>
												<a href="<?= site_url('settings/editmailtemplates/'.$id.'') ?> " class="btn btn-primary">Edit</a>
											</td>
										</tr>
										<?php $i++;endforeach; else: ?>
										<tr class="err_msg"><td colspan="5">Mail Templates(s) not available.</td></tr>
										<?php endif; ?>
										
									</tbody>
									
								</table>		
														
								</div>
								


		                    </div>
		                    

						</div>

	                    </div>


                    </div>

				</div>
				
			</div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
</body>
</html>