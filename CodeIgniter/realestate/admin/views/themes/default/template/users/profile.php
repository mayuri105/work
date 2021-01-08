<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Edit Profile</a></li>
				
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
				
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					<div class="panel-heading"></div>
						<div class="panel-body no-padding">
									
								<?php 
								$attributes = array('class' => 'form-horizontal', 'id' => 'validate-form');
								echo form_open('users/updateprofile', $attributes);  ?>	
								<div class="modal-body"	>
									<div class="form-group">
										<label class="col-sm-4 control-label">User Name</label>
										<div class="col-sm-8">
											<input type="text" name="user_name" id="user_name" value="<?= $users->username; ?>" class="form-control">
										</div>
									</div>
									<input type="hidden" name="u_id" id="u_id" value="<?= $users->u_id; ?> " class="form-control">
									<div class=""></div> 
									<div class="form-group">
										<label class="col-sm-4 control-label">First Name</label>
										<div class="col-sm-8">
											<input type="text" name="first_name"  id="first_name" value="<?= $users->first_name; ?>" class="form-control">
										</div>
									</div>
									<div class=""></div> 
									<div class="form-group">
										<label class="col-sm-4 control-label">Last Name</label>
										<div class="col-sm-8">
											<input type="text" name="last_name" id="last_name"  value="<?= $users->last_name; ?>"  value=""class="form-control">
										</div>
									</div>
									<div class=""></div> 
									<div class="form-group">
										<label class="col-sm-4 control-label">Email</label>
										<div class="col-sm-8">
											<input type="text" name="email" id="email" value="<?= $users->email; ?>"  class="form-control">
										</div>
									</div>
									<div class=""></div> 
									<div class="form-group">
										<label class="col-sm-4 control-label">Current Password</label>
										<div class="col-sm-8">
											<input type="password" name="curpassword"  value="" class="form-control">
										</div>
									</div>
									<div class=""></div> 
									<div class="form-group">
										<label class="col-sm-4 control-label">New Password</label>
										<div class="col-sm-8">
											<input type="password" name="newpassword"  value="" class="form-control">
										</div>
									</div>
									<div class=""></div> 
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Update changes</button>
								</div>
								
								</form>
						</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>

</body>
</html>
