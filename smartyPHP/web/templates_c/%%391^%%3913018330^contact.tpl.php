<?php /* Smarty version 2.6.0, created on 2017-02-09 13:46:06
         compiled from contact.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'contact.tpl', 17, false),)), $this); ?>
		<?php if ($this->_tpl_vars['errorMsg'] != ''): ?>
		<p class="redmsg"><?php echo $this->_tpl_vars['errorMsg']; ?>
<br />
			<br />
		</p>
		<?php elseif ($this->_tpl_vars['succmessage'] != ''): ?>
		<p class="successMsg"><?php echo $this->_tpl_vars['succmessage']; ?>
<br />
			<br />
		</p>
		<?php endif; ?>
<div class="contend-leftall">
	<h1>Contact</h1>
	<p>Alphabet Success- Keeping it Simple. The essence of a journey Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, </p>
	<div class="clear"></div>
	<form id="form1" name="frmContact" method="post" action="" class="quickcontact">
		<div class="inputbox1">
		   <label>Name</label>
		   <input type="text" name="name" placeholder="Name" value="<?php echo ((is_array($_tmp=$GLOBALS['HTTP_POST_VARS']['name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
" />
		</div>
		<div class="inputbox1">
		   <label>E-mail</label>
		   <input type="text" name="email"  placeholder="E-mail" value="<?php echo ((is_array($_tmp=$GLOBALS['HTTP_POST_VARS']['email'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
"/>
		</div>
		<div class="inputbox1">
		   <label>Phone number</label> 
		   <input name="phone_number" type="text" placeholder="Phone number" value="<?php echo ((is_array($_tmp=$GLOBALS['HTTP_POST_VARS']['phone_number'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
"/>
		</div>
		 <div class="inputbox1">
		   <label>Comments</label>
		   <textarea name="comments" id="textarea"><?php echo ((is_array($_tmp=$GLOBALS['HTTP_POST_VARS']['comments'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
</textarea>
		</div>
		<div class="inputbox1">
			<label>Captcha</label>
			<input name="captcha" type="text"/>
		</div>
		<div class="inputbox1">
			<label>&nbsp;</label><img src="<?php echo $this->_tpl_vars['Site_Root']; ?>
php_captcha.php" id="captcha" alt="captcha" style="float:left;margin-right:10px;"/>
			<a href="javascript: void(0);" onclick="document.getElementById('captcha').src='php_captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();" id="change-image" >Not readable? Change text.</a>
		</div>		
		<div  class="inputbox1" style="margin-top:20px; text-align:center"> 
			<input type="submit" value="Submit" name="submit" class="smbt-btn" onclick="javascript: return ValidateContact(document.frmContact);" />
		</div>
	</form>  
</div>