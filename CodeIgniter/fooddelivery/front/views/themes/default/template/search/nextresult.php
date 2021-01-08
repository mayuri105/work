<?php foreach ($store_list as $s): ?>
	<div class="item food seo" >
		<div class="discount_wrap" ></div>
		<img src="<?= getuploadpath().'store/'.$s->store_logo.'' ?>" class="merchant-logo" alt="<?= $s->store_name; ?>logo" height="94" width="94">
		<div class="merchant-info">
			<div class="row">
				<a href="<?= site_url('cities/'.url_title($s->city_name).'/'.url_title($s->state).'/'.url_title($type).'/'.url_title($s->unique_alias)) ?>" class="textual-information seo name" >
					<?= ucfirst($s->store_name) ?>
				</a>
				<span class="rating-container ratings aside seo" >

					<span class="rating">
						<div>
							<div class="starrating"  data-storeid = "" data-id="" data-rating="<?= $s->rating_avg; ?>"></div>
						</div>
					</span>
					
				</span>
			</div>

			<div class="row middle">

				<div class="textual-information not-laundry seo full-width-mobile">
					<div class="top-dishes" ><span><?= $s->store_street; ?></span></div>
				</div>
				<br>
				<div class="aside tags buttons" >
					<a href="<?= site_url('cities/'.url_title($s->city_name).'/'.url_title($s->state).'/'.url_title($type).'/'.url_title($s->store_name)) ?>" class="button secondary tag seo" title="Order from <?= $s->store_name; ?>">Order ahead</a>
				</div>
			</div>
			<div class="row footer" ng-include="'result-footer.html'">
				<div class="textual-information not-laundry seo result-footer">
					<span class="atom">$<?= $s->minorder ?> minimum</span>
					<span class="atom"> $<?= $s->delivery_fee ?> delivery fee</span>
				</div>
				
			</div>

			<div class="row middle extra-info">
				<div class="textual-information seo full-width-mobile"></div>
			</div>

			<div class="row footer" >
				<div class="textual-information seo result-footer"></div>
				
			</div>
		</div>
	</div>
	 <?php endforeach ?>