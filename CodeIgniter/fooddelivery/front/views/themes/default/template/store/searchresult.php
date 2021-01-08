<div class="menu-section-content">
	<div class="menu-section-content-inner-wrapper">
	   <?php $j= 0;  foreach ($store_info->searchresult as $pp): ?>
		 <div class="type-item <?= $j%2==0 ? 'even' : 'odd'  ?>" >
			<div class="menu-item-wrapper index-<?=$j ?>" >
				<div class="">
					<div class=" menu-item has-description" onclick="openmodel('<?= $pp->product_id; ?>');" >
						
						<div class=""></div>
						<div  class=" name" ><?= $pp->product_name; ?></div>
						<div class=" price ">$<?= $pp->price ?></div>
						<div class="description" ><?= $pp->small_desc; ?></div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" pprice="<?= $pp->price ?>" pname="<?= $pp->product_name; ?>" pid="<?= $pp->product_id; ?>">
		 <?php $j++; endforeach ?>
	</div>
</div>