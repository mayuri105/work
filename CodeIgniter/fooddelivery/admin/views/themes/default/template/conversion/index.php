<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
	<div class="static-content">
		<div class="page-content">
			<ol class="breadcrumb">
				<li class=""><a href="<?= site_url() ?>">Home</a></li>
				<li class=""><a href="">Dashboard</a></li>
				<li class="active"><a href="<?= site_url('conversion') ?>">Conversion</a></li>
			</ol>  
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-3">
						<button class="btn btn-primary" data-toggle="modal" href="#myModal">Add New Conversion</button>
						<div class="pb"></div>
							
						<div class="list-group inbox-menu list-group-alternate" id="checklist">

								<?php $lastuser =0; foreach ($users as $us): ?>
								<?php if ($this->session->u_id != $us['u_id'] ):
									if ($lastuser != $us['u_id'] ) {
									$msg = $this->conversion->unReadmsgCount($us['u_id'],'user');
								?>

								<a href="#" class="list-group-item " onclick="setuseridtype('<?= $us['u_id'] ?>','user',this)"><?= $us['username']; ?><?= $msg ? '<span class="badge badge-primary">'.$msg.'</span>' :'' ?></a>
								<?php }
								 endif ?>
								<?php $lastuser = $us['u_id']; ?>
								<?php endforeach ?>
								<?php foreach ($merchant as $ms): 
									$msg = $this->conversion->unReadmsgCountMer($ms['m_id'],'merchant');
								?>
								<a href="#" class="list-group-item " onclick="setuseridtype('<?= $ms['m_id'] ?>','merchant',this)"><?= $ms['business_name']; ?><?= $msg ? '<span class="badge badge-primary">'.$msg.'</span>' :'' ?></a>
								<?php endforeach ?>
						</div>
					</div>
					<!-- col-sm-3 -->

					<div class="col-sm-9">

						<div class="panel panel-inbox">
							<div class="panel-body " >
								<form action="<?php echo site_url('conversion/sendconversion') ?>" role="form" id="sendmessage" class="form-horizontal p-md" method="post">
									
								<div class="scroll-content">	
								   <input type="hidden" name="user_id" value="" id="user_id">
									<input type="hidden" name="user_type" value="" id="user_type">
									<div id="conversion" >
									</div>
									<div class="pb"></div>	
									<div class="form-group">
										<div class="col-sm-10">
											<textarea name="message" id="message" class="form-control"></textarea> 
										</div>
										<div class="col-sm-1 ">
											<input type="button" id="sendbtn" value="Send" class="btn btn-primary">
										</div>
									</div>
								</div>	
								</form>
							</div>
						</div>

					</div>
					<!-- col-sm-8 -->
				</div>

			</div>
		</div>
		<!-- #page-content -->
	</div>
	

<?php echo Modules::run('footer/footer/index'); ?>
<script type="text/javascript">

function setuseridtype (user_id,user_type,elem) {
	var a = document.getElementsByTagName('a');
    for (i = 0; i < a.length; i++) {
        a[i].classList.remove('active')
    }
    elem.classList.add('active');
	$('#user_id').val(user_id);
	$('#user_type').val(user_type);
	data = {
		user_id: user_id,
		user_type:user_type
	}
	 $.ajax({
	  type: "POST",
	  url: '<?php echo site_url("conversion/loadchat") ?>',
	  data: data,
	  success: function( response ) {
		if(response){
			$('#conversion').html(response);
			$('#myModal').modal('hide');
		}
	  }
	});   
}

$('#sendbtn').click(function(){
	var form = $('#sendmessage');
	$.ajax({
		  type: "POST",
		  url: form.attr( 'action' ),
		  data: form.serialize(),
		  success: function( response ) {
			if(response){
				$('#conversion').html(response);
				$('#message').val('');
			}
		  }
		});
});

function loadMsgOnAct() {
	$('#checklist .list-group-item:first').click();
}
loadMsgOnAct();
</script>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Select User</h2>
				</div>
				
				<div class="modal-body row">
					 <input class="form-control" name="search_user" placeholder="Search User here" id="search_user">
						<div class="col-sm-12 list-group"  id="search_user_list">
								<?php foreach ($allusers as $us): ?>
								<?php if ($this->session->u_id != $us->u_id): ?>
								<a href="#" class="list-group-item " onclick="setuseridtype('<?= $us->u_id ?>','user',this)"><?= $us->username; ?></a>
								<?php endif ?>
								<?php endforeach ?>
								<?php foreach ($allmerchant as $ms): ?>
								<a href="#" class="list-group-item " onclick="setuseridtype('<?= $ms->m_id ?>','merchant',this)"><?= $ms->business_name; ?></a>
								<?php endforeach ?>
						</div>
				</div>
			  <script type="text/javascript">
            $('#search_user').keyup(function(){
            s = $('#search_user').val();
            setTimeout(function() { 
                    if($('#search_user').val() == s){ // Check the value searched is the latest one or not. This will help in making the ajax call work when client stops writing.
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('conversion/search') ?>",
                            data: 'search='+ s,
                            cache: false,
                            success: function(data) {
                                $('#search_user_list').html(data);
                            }
                        })
                    }
                }, 1000); // 1 sec delay to check.
            });
        

        </script>	
				
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

</body>
</html>