<script language="javascript" src="{$Site_Root_Front}ckeditor/ckeditor.js"></script>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmBlog" action="{$smarty.server.PHP_SELF}" method="post" enctype="multipart/form-data">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table  cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Blog Manager [{$Action}]</h1></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="7"></td>
                </tr>
                <tr>
                  <td valign="top"><table border="0" cellpadding="1" cellspacing="2" class="table-long" width="100%">
                      <tr>
					<td width="15%" class="odd" valign="top">Blog Title:&nbsp;<span class="redmsg">*</span></td>
					<td class="odd">
					<input type="text" value="{$title}" name="title" size="40" class="textbox">
                    				</td>
				</tr>
                
				<!--<tr>
					<td class="odd">Category</td>
					<td class="odd">
					<select name="cat_id" class="textbox">
							{$Category_List}
						</select></td>
				 </tr>-->
				<tr>
					<td class="odd" valign="top">Short Description:</td>
					<td class="odd">
						<textarea name="short_desc"  cols="70" rows="4" class="textarea">{$short_desc}</textarea>
					</td>
				</tr>

				<tr>
					<td class="odd" valign="top">Content :</td>
					<td class="odd">
						<textarea name="content" id="editor1"  cols="70" rows="4" >{$content}</textarea>
						<script type="text/javascript">
									var editor = CKEDITOR.replace( 'editor1',
						{ldelim}
							filebrowserBrowseUrl : Site_Root_Front+'ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl : Site_Root_Front+'ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowseUrl : Site_Root_Front+'ckfinder/ckfinder.html?Type=Flash',
							filebrowserUploadUrl  : Site_Root_Front+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl  : Site_Root_Front+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl  : Site_Root_Front+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
						{rdelim});
						
						</script>
					</td>
				</tr>
				<tr>
                        <td class="odd" valign="top">Image :</td>
                        <td class="odd"><input type="file" name="blog_img" />
						{if $blog_img !=''}
							<br /><img src="{$img_path}thumb_{$blog_img}" />
							<input type="hidden" name="hidden_blog_img" value="{$blog_img}" />
						{/if}
                        </td>
			  </tr>	
				<tr>
					<td class="odd" valign="middle">Date:</td>
					<td class="odd">
						<script>DateInput('post_date', true, 'YYYY-MM-DD','{$post_date}')</script>
					</td>
				</tr>
				<tr>
					<td class="odd" valign="top">Publish ?:</td>
					<td class="odd">
						<input type="checkbox" name="status" {$status} value="1">
					</td>
				</tr>
				<tr>
					<td class="odd" valign="top">Comment Status:</td>
					<td class="odd">
						<input type="checkbox" name="comment_status" {$comment_status} value="1">
					</td>
				</tr>      
                    </table>
                    <table border="0" cellpadding="1" cellspacing="2" width="95%">
                      <tr>
                        <td class="divider" colspan="4"></td>
                      </tr>
                      <tr>
                        <td align="left" width="10%">&nbsp;</td><td align="left"><input type="submit" name="Submit" value="Save" class="stdButton" onClick="javascript: return Validate_Form(document.frmBlog);">
						<input type="submit" name="Submit" value="Cancel" class="stdButton">
						<input type="hidden" name="post_id" value="{$post_id}">
						<input type="hidden" name="Action" value="{$Action}">
                        </td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td height="7"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form></td>
        </tr>
      </table></td>
  </tr>
</table>
