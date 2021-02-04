		{if $errorMsg!=''}
		<p class="redmsg">{$errorMsg}<br />
			<br />
		</p>
		{elseif $succmessage!=''}
		<p class="successMsg">{$succmessage}<br />
			<br />
		</p>
		{/if}
<div class="contend-leftall">
	<h1>Contact</h1>
	<p>Alphabet Success- Keeping it Simple. The essence of a journey Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, </p>
	<div class="clear"></div>
	<form id="form1" name="frmContact" method="post" action="" class="quickcontact">
		<div class="inputbox1">
		   <label>Name</label>
		   <input type="text" name="name" placeholder="Name" value="{$smarty.post.name|stripslashes}" />
		</div>
		<div class="inputbox1">
		   <label>E-mail</label>
		   <input type="text" name="email"  placeholder="E-mail" value="{$smarty.post.email|stripslashes}"/>
		</div>
		<div class="inputbox1">
		   <label>Phone number</label> 
		   <input name="phone_number" type="text" placeholder="Phone number" value="{$smarty.post.phone_number|stripslashes}"/>
		</div>
		 <div class="inputbox1">
		   <label>Comments</label>
		   <textarea name="comments" id="textarea">{$smarty.post.comments|stripslashes}</textarea>
		</div>
		<div class="inputbox1">
			<label>Captcha</label>
			<input name="captcha" type="text"/>
		</div>
		<div class="inputbox1">
			<label>&nbsp;</label><img src="{$Site_Root}php_captcha.php" id="captcha" alt="captcha" style="float:left;margin-right:10px;"/>
			<a href="javascript: void(0);" onclick="document.getElementById('captcha').src='php_captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();" id="change-image" >Not readable? Change text.</a>
		</div>		
		<div  class="inputbox1" style="margin-top:20px; text-align:center"> 
			<input type="submit" value="Submit" name="submit" class="smbt-btn" onclick="javascript: return ValidateContact(document.frmContact);" />
		</div>
	</form>  
</div>
