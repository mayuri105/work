<div class="contend-hm-in">
	{section loop=$Loop_Blog name=rec}
		<div class="contend-hm-in-row">
			<h1>{$title[rec]}</h1>
			<div class="contain-left-hm-in">
				<p>{$short_desc[rec]}</p> 
				<div class="clear"></div>
				<a href="{$Site_Root}blog/{$html_link[rec]}.html" class="redmore">Readmore</a> 
			</div>
			<div class="plugin-comunty">
				<p>{$post_date[rec]|date_format}<br /> Opinion <br />{$comment_count[rec]} Comments</p>
				<div class="clear"></div>
				<!--
				<a href="#" target="_blank"><img src="{$Templates_Image}twitter-in.png" alt="" /></a>
				<a href="#" target="_blank"><img src="{$Templates_Image}linkedin-in.png" alt="" /></a>
				<a href="#" target="_blank"><img src="{$Templates_Image}y-tube.png" alt="" /></a>
				<a href="#" target="_blank"><img src="{$Templates_Image}f-book.png" alt="" /></a>
				<a href="#" target="_blank"><img src="{$Templates_Image}gplus-in.png" alt="" /></a>-->
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_16x16_style">
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_linkedin"></a>
					<a class="addthis_button_twitter"></a>
					<a class="addthis_button_google_plusone_share"></a>
				</div> 
				<!-- AddThis Button END -->				
			</div>
		</div>
	{/section}  
</div> 
 
