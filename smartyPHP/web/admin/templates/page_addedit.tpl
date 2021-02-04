<script language="javascript" src="{$Site_Root_Front}ckeditor/ckeditor.js"></script>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmPage" action="{$A_Action}" method="post" enctype="multipart/form-data">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Page Manager [{$Action}]</h1></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="7"></td>
                </tr>
                <tr>
                  <td valign="top"><table border="0" cellpadding="1" cellspacing="2" class="table-long" width="100%">

                      <tr>
                        <td width="15%" class="odd" valign="top">Page Title:&nbsp;<span class="redmsg">*</span></td>
                        <td class="odd"> <input type="text" value="{$page_title}" name="page_title" size="40" maxlength="120" class="textbox">
                        </td>
                      </tr>
					  <tr>
                        <td colspan="2" class="odd"><input type="checkbox" name="edit_seo" onchange="javascript: showHideSEO(this.checked);">&nbsp;Edit SEO settings for this page</td>
                      </tr>
                      <tr id="meta1" style="visibility:hidden;display:none;">
                        <td class="odd" valign="top">Meta Title:&nbsp;</td>
                        <td class="odd"><input type="text" value="{$meta_title}" name="meta_title" size="40" maxlength="120" class="textbox">
                        </td>
                      </tr>
                      <tr id="meta2" style="visibility:hidden;display:none;">
                        <td class="odd" valign="top" colspan="2"><table width="100%" cellpadding="0" cellspacing="0" border="0" class="table-long">
                            <tr>
                              <td class="odd" valign="top" width="15%">Meta Keyword:&nbsp;</td>
                              <td class="odd" width="35%" valign="top"><textarea name="meta_keyword" rows="5" cols="40" class="textarea">{$meta_keyword}</textarea>
                              </td>
                              <td class="odd" valign="top" width="15%">Canonical Tag:&nbsp;</td>
                              <td class="odd" width="35%" valign="top"><textarea name="canonical_tag" rows="5" cols="40" class="textarea">{$canonical_tag}</textarea>
                                <label>(ex. &lt;link rel="canonical" href="http://www.example.com/product.php?item=swedish-fish"/&gt;)</label>
                              </td>
                            </tr>
                            <tr>
                              <td class="odd" valign="top">Meta Description:&nbsp;</td>
                              <td class="odd" valign="top"><textarea name="meta_description" rows="5" cols="40" class="textarea">{$meta_description}</textarea>
                              </td>
                              <td class="odd" valign="top">303 Redirect: </td>
                              <td class="odd" valign="top"><textarea name="redirect" cols="40" rows="5" class="textarea">{$redirect}</textarea>
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td class="odd" valign="top">Page Content :</td>
                        <td class="odd"><textarea name="page_content" id="editor1">{$page_content}</textarea>
						
						<script type="text/javascript">
								var editor = CKEDITOR.replace('editor1',
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
                        <td class="odd" valign="top">Image: </td>
                        <td class="odd"><input type="file" name="image">
						{if $image}
						<br />
						<img src="{$img_path}{$image}" width="300" height="auto" />
						<input type="hidden" name="hidden_image" value="{$image}" />
						{/if}
                        </td>
                      </tr>                      
                      <tr>
                        <td class="odd" valign="top">Status:</td>
                        <td class="odd"><input type="checkbox" name="status" {if $Action=='Add'} checked="checked" {else} {$checked} {/if} value="1">
                        </td>
                      </tr>
                    </table>
                    <table border="0" cellpadding="1" cellspacing="2" width="95%">
                      <tr>
                        <td class="divider" colspan="4"></td>
                      </tr>
                      <tr>
                        <td align="left" width="10%">&nbsp;</td>
                        <td align="left"><input type="submit" name="Submit" value="Save" class="stdButton" onclick="Javascript: return Form_Submit(document.frmPage)">
                          <input type="submit" name="Submit" value="Cancel" class="stdButton">
                          <input type="hidden" name="page_id" value="{$page_id}">
                          <input type="hidden" name="Action" value="{$Action}">
                          <input type="hidden" name="page_link" value="{$page_link}">
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
