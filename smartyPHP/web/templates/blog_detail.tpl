<div class="contend-leftall">
	<h1>{$title}</h1>
	<p>{$content}</p>
	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style addthis_16x16_style">
		<a class="addthis_button_facebook"></a>
		<a class="addthis_button_linkedin"></a>
		<a class="addthis_button_twitter"></a>
		<a class="addthis_button_google_plusone_share"></a>
	</div> 
	<!-- AddThis Button END -->	
	<br>
	<p>Posted Date : {$post_date|date_format}</p>
	<div class="leave-comments-title">
		<span class="leave-comment">Leave a Comment</span>
		<h2 style="border-bottom: 1px solid;margin-bottom: 10px;margin-top: 10px;">{$comment_count} Comment(s)</h2>
	</div> 
	{foreach from=$comment_list item=comments}
		<div class="blog-main-block">
			<span class="rfloat mail_published">{$comments->comment_date|date_format}</span>
			<p><span class="orangetxt"><strong>{$comments->comment_by}</strong></span> said:</p>
			<p>{$comments->comment|nl2br}</p>
			<!--<p><a href="#" class="lnk">Reply</a></p>-->
		</div>
	{/foreach}
	<div style="margin-top: 20px;">
	 <h2 class="m-r-bott12">Leave your reply</h2>
	  {if $comment_posted != ''}<div align="center" class="successMsg">{$comment_posted}</div>{/if}
		{if $comment_error != ''}<div align="center" class="redmsg">{$comment_error}</div>{/if}
		{if $message != ''}<div align="center" class="redmsg">{$message}</div>{/if}
		<br />
		
		{if $comment_posted == ''}
		  <form class="contact_frm" method="post" name="blogComment" action="{$smarty.server.REQUEST_URI}">
			<div class="contact_frmrow">
			  <label>Your Name</label>
			  <input type="text" name="comment_by" class="txtfrmreply" value="{$smarty.post.comment_by}" />
			</div>
			<div class="contact_frmrow">
			  <label>Email Address</label>
			  <input type="text" name="comment_email" class="txtfrmreply" value="{$smarty.post.comment_email}" /><br />&nbsp;&nbsp; 
			</div>
			<div class="contact_frmrow">
			  <label style="vertical-align:top">Comments</label>
			  <textarea name="comment" class="txtfrmreply" cols="45" rows="5">{$smarty.post.comment}</textarea>
			</div>
			<div class="contact_frmrow">
			<label>Captcha</label>
			<input type="text" name="captcha">
		  </div>
		  <div class="contact_frmrow"> 
			<img src="{$Site_Root}php_captcha.php" id="captcha" alt="captcha" style="padding:10px 10px 10px 0;"/>
			<a class="crntlnk" href="javascript: void(0);" onclick="document.getElementById('captcha').src='{$Site_Root}php_captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();" id="change-image">Not readable? Change text.</a>
		  </div>
			<div class="contact_frmrow"> 
			  <input type="submit" name="submit" class="smbt-btn" value="Submit" onclick="Javascript: return Validate_Form(document.blogComment);"/>
			</div>
			<input type="hidden" name="post_id" value="{$post_id}"/>
					<input type="hidden" name="Action" value="Comment"/> 
		  </form> 
		{/if}
	</div>

</div>
