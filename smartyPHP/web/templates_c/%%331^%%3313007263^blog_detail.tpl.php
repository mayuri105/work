<?php /* Smarty version 2.6.0, created on 2017-02-09 15:44:30
         compiled from blog_detail.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'blog_detail.tpl', 13, false),array('modifier', 'nl2br', 'blog_detail.tpl', 22, false),)), $this); ?>
<div class="contend-leftall">
	<h1><?php echo $this->_tpl_vars['title']; ?>
</h1>
	<p><?php echo $this->_tpl_vars['content']; ?>
</p>
	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style addthis_16x16_style">
		<a class="addthis_button_facebook"></a>
		<a class="addthis_button_linkedin"></a>
		<a class="addthis_button_twitter"></a>
		<a class="addthis_button_google_plusone_share"></a>
	</div> 
	<!-- AddThis Button END -->	
	<br>
	<p>Posted Date : <?php echo ((is_array($_tmp=$this->_tpl_vars['post_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</p>
	<div class="leave-comments-title">
		<span class="leave-comment">Leave a Comment</span>
		<h2 style="border-bottom: 1px solid;margin-bottom: 10px;margin-top: 10px;"><?php echo $this->_tpl_vars['comment_count']; ?>
 Comment(s)</h2>
	</div> 
	<?php if (count($_from = (array)$this->_tpl_vars['comment_list'])):
    foreach ($_from as $this->_tpl_vars['comments']):
?>
		<div class="blog-main-block">
			<span class="rfloat mail_published"><?php echo ((is_array($_tmp=$this->_tpl_vars['comments']->comment_date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
			<p><span class="orangetxt"><strong><?php echo $this->_tpl_vars['comments']->comment_by; ?>
</strong></span> said:</p>
			<p><?php echo ((is_array($_tmp=$this->_tpl_vars['comments']->comment)) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>
			<!--<p><a href="#" class="lnk">Reply</a></p>-->
		</div>
	<?php endforeach; unset($_from); endif; ?>
	<div style="margin-top: 20px;">
	 <h2 class="m-r-bott12">Leave your reply</h2>
	  <?php if ($this->_tpl_vars['comment_posted'] != ''): ?><div align="center" class="successMsg"><?php echo $this->_tpl_vars['comment_posted']; ?>
</div><?php endif; ?>
		<?php if ($this->_tpl_vars['comment_error'] != ''): ?><div align="center" class="redmsg"><?php echo $this->_tpl_vars['comment_error']; ?>
</div><?php endif; ?>
		<?php if ($this->_tpl_vars['message'] != ''): ?><div align="center" class="redmsg"><?php echo $this->_tpl_vars['message']; ?>
</div><?php endif; ?>
		<br />
		
		<?php if ($this->_tpl_vars['comment_posted'] == ''): ?>
		  <form class="contact_frm" method="post" name="blogComment" action="<?php echo $GLOBALS['HTTP_SERVER_VARS']['REQUEST_URI']; ?>
">
			<div class="contact_frmrow">
			  <label>Your Name</label>
			  <input type="text" name="comment_by" class="txtfrmreply" value="<?php echo $GLOBALS['HTTP_POST_VARS']['comment_by']; ?>
" />
			</div>
			<div class="contact_frmrow">
			  <label>Email Address</label>
			  <input type="text" name="comment_email" class="txtfrmreply" value="<?php echo $GLOBALS['HTTP_POST_VARS']['comment_email']; ?>
" /><br />&nbsp;&nbsp; 
			</div>
			<div class="contact_frmrow">
			  <label style="vertical-align:top">Comments</label>
			  <textarea name="comment" class="txtfrmreply" cols="45" rows="5"><?php echo $GLOBALS['HTTP_POST_VARS']['comment']; ?>
</textarea>
			</div>
			<div class="contact_frmrow">
			<label>Captcha</label>
			<input type="text" name="captcha">
		  </div>
		  <div class="contact_frmrow"> 
			<img src="<?php echo $this->_tpl_vars['Site_Root']; ?>
php_captcha.php" id="captcha" alt="captcha" style="padding:10px 10px 10px 0;"/>
			<a class="crntlnk" href="javascript: void(0);" onclick="document.getElementById('captcha').src='<?php echo $this->_tpl_vars['Site_Root']; ?>
php_captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();" id="change-image">Not readable? Change text.</a>
		  </div>
			<div class="contact_frmrow"> 
			  <input type="submit" name="submit" class="smbt-btn" value="Submit" onclick="Javascript: return Validate_Form(document.blogComment);"/>
			</div>
			<input type="hidden" name="post_id" value="<?php echo $this->_tpl_vars['post_id']; ?>
"/>
					<input type="hidden" name="Action" value="Comment"/> 
		  </form> 
		<?php endif; ?>
	</div>

</div>