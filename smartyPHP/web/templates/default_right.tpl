<a href="{$Site_Root}about-us.html" class="about-me"><img src="{$Templates_Image}about-icon.png" alt="" /> About me</a>
<a href="#" class="blog-archive"><img src="{$Templates_Image}calendar.png" alt="" /> Blog Archive</a>
<div class="clear"></div>
<ul class="archive-ul">
	<!--<li><a href="#" class="sel">2013 (23)</a>
		<ul>
			<li>
			<a href="#" class="sel-in">September (1) </a>
			<div class="clear"></div>
			<p>The 10th Anniversary of myFinancial Freedom Looms...</p>
			</li>
		</ul>
	</li>
	<li><a href="#">August (3)</a></li>
	<li><a href="#">July (19)</a></li>-->
	{foreach name=blogYear from=$blogYear item=aYear}
		<li><a href="{$Site_Root}blog/{$aYear->YEAR}" class="sel-in">{$aYear->YEAR} ({$aYear->TOTAL})</a></li>
			<ul>
				{foreach name=blogMonth from=$blogMonth item=aMonth}
					{assign var="dateNub" value="-"|explode:$aMonth->post_date}
					{assign var="dateExplode" value=$aMonth->post_date|date_format:'%B,%e,%Y'}
					{assign var="MonthEx" value=","|explode:$dateExplode} 
					{if $aYear->YEAR == $MonthEx[2]} 
						<li><a href="{$Site_Root}blog/{$aYear->YEAR}/{$dateNub[1]}">{$MonthEx[0]} ({$aMonth->TOTAL})</a> </li>	
					{/if}	
				{/foreach}	
			</ul>
	{/foreach}
</ul>

