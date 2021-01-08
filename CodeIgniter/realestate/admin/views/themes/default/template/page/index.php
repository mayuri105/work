<?php echo Modules::run('header/header/index'); ?>
<?php echo Modules::run('sidebar/sidebar/index'); ?>
<div class="static-content-wrapper">
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
				<li><a href="<?php site_url('index'); ?>">Home</a></li>
				<li class="active"><a href="">Page</a></li>
			</ol> 
			<div class="container-fluid">
				<div class="pb-sm">
					<a href="<?php echo site_url('page/add') ?>" class="btn btn-primary pull-left">Add New Page</a>
					<div class="col-md-5 pull-right">
						<div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
				            <div class="input-group">
				            	<input type="text" id="page_search" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
				            		<button class="btn" type="button"><i class="ti ti-search"></i></button>
				            	</span>
							</div>
			        	</div>
			    	</div>
				</div>
				<div class="mt-xl"></div> 
				<?php echo Modules::run('messages/message/index'); ?>
				<div class="mt-xl"></div> 
				<div class="panel panel-inverse">
					
						<div class="panel-body ">
							<table class="table table-striped" id="aftersearch">
								<thead>
									<tr>
										<th>#</th>
										<th>Title</th>
										<th class="text-right">Action</th>
										
									</tr>
								</thead>
								<tbody id="tbody">
									<?php $i= 1; if(!empty($pages)): foreach($pages as $page): ?>
									<tr>
										<td><?= $i; ?></td>
										<td><?php echo $page->title ?></td>
										<td class="text-right">
											<?php $id = $page->p_id; ?>
											<a href="<?php echo site_url('page/edit/'.$page->p_id.''); ?>" class=" btn btn-primary">Edit</a>

											<a herf ="" data-href ="<?php echo site_url('page/delete/'.$id.'') ?>" class="del btn btn-danger"  >Delete</a>
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">Page(s) not available.</td></tr>
									<?php endif; ?>
									<?php //echo $this->ajax_pagination->create_links(); ?>
								</tbody>
								<tfoot>
									<tr>
										<td>
										</td>
										
										<td colspan="4" >
											<ul class="pagination">
												<?php echo $pagination_helper->create_links(); ?>
											</ul>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
				</div>	
        	</div>
        </div>
        <!-- #page-content -->
    </div>
               
<?php echo Modules::run('footer/footer/index'); ?>
<script src="<?= site_url('views/themes/default') ?>/assets/ckeditor/ckeditor.js"></script>

<script type="text/javascript">

	$(document).ready(function(){
		$('.del').click(function(event){
			var url = $(this).data("href")

        	var $tr = $(this).closest('tr');
			alertify.confirm("Are you sure you want to Delete this Page ?", function (result) {
			    if (result) {
					$.ajax({
						url : url,
						type: "GET",
						success:function(data){
							alertify.success('Deleted');
							 $tr.find('td').fadeOut(1000,function(){ 
	                            $tr.remove();                    
	                        }); 
						}
					});
       
			    } else {
			       
			    }
			});
		});
		$('#setperpage').change(function(){
			var data = {
				p_value : $(this).val()
			};
			$.ajax({
				url : "<?php echo site_url('page/setperpage') ?>",
				type: "POST",
				data:data,
				success:function(data){
					window.location.reload();
				}
			});
		});

		$('#page_search').keyup(function() {
		s = $('#page_search').val();
		setTimeout(function() { 
		        if($('#page_search').val() == s){ // Check the value searched is the latest one or not. This will help in making the ajax call work when client stops writing.
		            $.ajax({
		                type: "POST",
		                url: "<?php echo site_url('page/search') ?>",
		                data: 'search=' + s,
		                cache: false,
		                beforeSend: function() {
		                   // loading image
		                },
		                success: function(data) {
		                	//console.log(data);
		                    // Your response will come here
		                    $('#tbody').html(data);
		                }
		            })
		        }
		    }, 1000); // 1 sec delay to check.
		});
		
	});

	

</script>
</body>
</html>

