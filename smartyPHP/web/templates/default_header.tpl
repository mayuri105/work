<div class="navigation">
	 <div class="navbar navbar-inverse" style="position: static;">
	 <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </a>
		  <a class="brand" href="#">Menu</a>
		  <div class="nav-collapse collapse navbar-inverse-collapse">
			<ul class="nav"> 
				<li><a href="{$Site_Root}index.html" {if $selected == 'index.html' or $selected == ""} class="selected" {/if}>Home</a></li>
				<li><a href="{$Site_Root}about-us.html" {if $selected == 'about-us.html'} class="selected" {/if}>About</a></li>
				<li><a href="{$Site_Root}videos.html" {if $selected == 'videos.html'} class="selected" {/if}>Videos</a></li>
				<li><a href="{$Site_Root}events.html" {if $selected == 'events.html'} class="selected" {/if}>Events</a></li>
				<li><a href="{$Site_Root}services.html" {if $selected == 'services.html'} class="selected" {/if}>Services</a></li>
				<li><a href="{$Site_Root}contact.html" {if $selected == 'contact.html'} class="selected" {/if}>Contact</a></li>
			</ul>
		  </div>
  </div>
</div>

