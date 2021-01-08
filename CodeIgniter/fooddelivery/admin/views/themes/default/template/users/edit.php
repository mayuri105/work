<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="<?= site_url('users') ?>">Users</a></li>
				<li class="active"><a href="">Edit User</a></li>
				
			</ol> 
			<div class="container-fluid">
				
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<h2>Edit User</h2>
				<div class="panel panel-inverse">

					
						<div class="panel-body no-padding">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
								<li><a href="#tab-activity"  data-toggle="tab">Recent Activity</a></li>
								<li><a href="#tab-log"  data-toggle="tab">Ip Log</a></li>

							</ul>
							<div class="tab-content">

								<div class="tab-pane active" id="tab-general">
									<form action="<?= site_url('users/update') ?>" class="form-horizontal" name="form-update" id="form-update" name="form-update" method="post">
										<input type="hidden" name="u_id"  value="<?= $users->u_id; ?>"class="form-control">
										<div class="panel-body">
											<div class="form-group">
													<label class="col-sm-4 control-label">User Name</label>
													<div class="col-sm-8">
														<input type="text" name="user_name" minlength="5"   maxlength="15"  required id="user_name"  value="<?= $users->username ?>"class="form-control">
													</div>
											</div>
									
											<div class="form-group">
												<label class="col-sm-4 control-label">First Name</label>
												<div class="col-sm-8">
													<input type="text" name="first_name" id="first_name" required value="<?= $users->first_name ?>" class="form-control">
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-4 control-label">Last Name</label>
												<div class="col-sm-8">
													<input type="text" name="last_name" value="<?= $users->last_name ?>"  value=""class="form-control">
												</div>
											</div>
										
											<div class="form-group">
												<label class="col-sm-4 control-label">Email</label>
												<div class="col-sm-8">
													<input type="text" name="email" id="email" required value="<?= $users->email ?>"  class="form-control">
												</div>
											</div>
										
											<div class="form-group">
												<label class="col-sm-4 control-label">Current Password</label>
												<div class="col-sm-8">
													<input type="password" name="curpassword" minlength="5"   value="" class="form-control">
												</div>
											</div>
										
											<div class="form-group">
												<label class="col-sm-4 control-label">New Password</label>
												<div class="col-sm-8">
													<input type="password" name="newpassword"  minlength="5"  value="" class="form-control">
												</div>
											</div>
											
											
											<div class="form-group">
												<label class="col-sm-4 control-label">Select Group</label>
												<div class="col-sm-8">
													<select class="form-control" name="user_group_id" required id="user_group_id">
														<?php foreach ($usersgroups as $g ): ?>
															<option value="<?= $g->group_id ?>" <?= $users->user_group_id == $g->group_id ? 'selected' :'' ?>><?= $g->name ?></option>
														<?php endforeach ?>
														
													</select>
												</div>
											</div>
											
											
											<div class="form-group">
												<label class="col-sm-4 control-label">Enabled</label>
												<div class="col-sm-8">
													<select class="form-control" name="status">
														<option value="1"  <?= $users->status == 1 ? 'selected' :'' ?>>True</option>
														<option value="0"  <?= $users->status == 0 ? 'selected' :'' ?>> False</option>
													</select>
												</div>
											</div>

										</div>
										<div class="modal-footer">
												<a href="<?= site_url('users') ?>" class="btn btn-default" >Close</a>
												<button type="submit" class="btn btn-primary">Save changes</button>
											</div>
									</form>
								</div>
								<div class="tab-pane " id="tab-activity">
									<div class="panel-body">
										<div class="scroll-content" tabindex="0" style="right: -17px;">
	                                        <ul class="mini-timeline">
	                                        	<?php if (!$userActivity): ?>
	                                        	<li class="mini-timeline-lime">
	                                                <div class="timeline-icon"></div>
	                                                <div class="timeline-body">
	                                                   No activity found
	                                                </div>
	                                            </li>	
	                                        	<?php else:?>
	                                        	<?php foreach ($userActivity as $ua): ?>
	                                        	<li class="mini-timeline-lime">
	                                                <div class="timeline-icon"></div>
	                                                <div class="timeline-body">
	                                                    <div class="timeline-content">
	                                                      
	                                                        <?= ucfirst($ua->act_key) ?> by
	                                                          <a href="#" class="name">
	                                                        	<?= $ua->first_name.' '.$ua->last_name ?> </a> 
	                                                        <span class="time"><?= date('d-m-y g:i:a',strtotime($ua->date_added)) ?></span>

	                                                    </div>
	                                                </div>
	                                            </li>
	                                            <?php endforeach;  endif;?>
	                                        </ul>
	                                    </div>

									</div>
								</div>
								<div class="tab-pane " id="tab-log">
									<div class="panel-body">
										<div class="form-group">
													<label class="col-sm-4 control-label">Last Login</label>
													<div class="col-sm-8">

														<?= $users->last_login =='0000-00-00 00:00:00' ? 'No Active Login' : date('d-m-y',strtotime($users->last_login )); ?>
													</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Ip address</label>
												<div class="col-sm-8">
													<?= $users->ip ? $users->ip :'No ip'  ?>
												</div>
											</div>
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
<script type="text/javascript">
	$('#form-update').validate({
		errorClass: "help-block",
		validClass: "help-block",
		highlight: function(element, errorClass,validClass) {
		  $(element).closest('.form-group').addClass("has-error");
		},
		unhighlight: function(element, errorClass,validClass) {
		   $(element).closest('.form-group').removeClass("has-error");
		},
		
	});
</script>
</body>
</html>
