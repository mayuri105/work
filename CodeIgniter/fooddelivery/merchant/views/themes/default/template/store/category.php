
<div class="row" data-widget-group="group-demo">
	<?php foreach ($category as $c): ?>
		
	<div class="pb"></div>
	<div class="col-md-12">
		<div class="pb"></div>
		<div class="panel panel-default" data-widget='{"id" : "<?= $c->cat_id ?>"}'>
			<div class="panel-heading">
				<div class="pb"></div>
				<div class="panel-ctrls button-icon">
					<a href="#" class="pull-right ml mb-xs  btn btn-danger" onclick="deleteCategory('<?= $c->cat_id ?>','<?= $store_id; ?>')" ><i class="fa fa-trash"></i></a>
					<a href="#" class="pull-right ml mb-xs  btn btn-primary" onclick="editCategory('<?= $c->cat_id ?>')" ><i class="fa fa-edit"></i></a>
				</div>
				<h2><?= $c->category ?></h2>
					
			</div>
				<?php if ($store_data->store_info->store_type=='2' || $store_data->store_info->store_type =='3'): ?>
					
				
				<?php  $subcat = $this->store->getSubCategory($c->cat_id); ?>
				
				<div class="panel-body">
					<div class="row column pb" data-widget-group="group-demo">

						<?php foreach ($subcat as $sc): ?>
						<div class="col-md-12 pb">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="pb"></div>
									<div class="panel-ctrls button-icon">
										<a href="#" class="pull-right ml mb-xs  btn btn-danger" onclick="deleteCategory('<?= $sc->cat_id ?>','<?= $store_id; ?>')" ><i class="fa fa-trash"></i></a>
										<a href="#" class="pull-right ml mb-xs  btn btn-primary" onclick="editCategory('<?= $sc->cat_id ?>')" ><i class="fa fa-edit"></i></a>
									</div>
									<h2><?= $sc->category ?></h2>
								</div>
								<div class="panel-body">

									<?php 
										$prod = $this->store->getProducts($sc->cat_id);
									?>
									<ul class="list-group sortable-list"  id="list-<?= $sc->cat_id?>" data-id ="<?= $sc->cat_id?>" >
										<?php foreach ($prod as $p): ?>
										<li class="list-group-item sortable-item"  draggable="true" ondragstart="drag(event)" id="<?= $p->product_id ?>"><?= $p->product_name; ?>
											<a href="#" class="pull-right ml mb-xs  btn btn-danger" onclick="deleteProduct('<?= $p->product_id ?>','<?= $store_id; ?>')" ><i class="fa fa-trash"></i></a>
											<a href="<?= site_url('store/editproduct/'.$p->product_id.'') ?>"  target="new" class="pull-right  ml mb-xs btn btn-primary"  ><i class="fa fa-edit"></i></a>
											<br/>
										</li>	
										<?php endforeach ?>
									</ul>
									<a href="#" class="btn btn-primary pull-right" onclick="addproduct('<?= $sc->cat_id ?>')">Add Product</a>
								
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						
					</div>
				</div>
				<button type="button"  onclick="addsubcategory('<?= $c->cat_id ?>')" class="btn btn-primary pull-right">Add Sub-Category</button>
				<?php else: ?>	
				<?php 
					$products = $this->store->getProducts($c->cat_id);
				?>
				<?php if ($products): ?>
				<div class="panel-body">
					<ul class="list-group" id="list-<?= $c->cat_id?>">
						<?php foreach ($products as $p): ?>
						<li class="list-group-item"><?= $p->product_name; ?>
							<a href="#" class="pull-right ml mb-xs  btn btn-danger" onclick="deleteProduct('<?= $p->product_id ?>','<?= $store_id; ?>')" ><i class="fa fa-trash"></i></a>
							<a href="<?= site_url('store/editproduct/'.$p->product_id.'') ?>" target="new" class="pull-right  ml mb-xs btn btn-primary"  onclick="editProduct('<?= $p->product_id ?>')" ><i class="fa fa-edit"></i></a>
							<br/>
						</li>	
						<?php endforeach ?>
					</ul>
					
				</div>
				<?php endif ?>
				<a href="#" class="btn btn-primary pull-right" onclick="addproduct('<?= $c->cat_id ?>')">Add Product</a>
				<?php endif; ?>
		</div>
		
	</div>
	<?php endforeach ?>	
	<button type="button" data-toggle="modal" href="#catgorymodal" class="btn btn-primary pull-right">Add Category</button>
</div>
<script type="text/javascript">
$.wijets.make();
</script>