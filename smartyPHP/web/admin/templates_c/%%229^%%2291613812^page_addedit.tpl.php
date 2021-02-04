<?php /* Smarty version 2.6.0, created on 2017-02-09 13:42:43
         compiled from page_addedit.tpl */ ?>
<script language="javascript" src="<?php echo $this->_tpl_vars['Site_Root_Front']; ?>
ckeditor/ckeditor.js"></script>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmPage" action="<?php echo $this->_tpl_vars['A_Action']; ?>
" method="post" enctype="multipart/form-data">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Page Manager [<?php echo $this->_tpl_vars['Action']; ?>
]</h1></td>
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
                        <td class="odd"> <input type="text" value="<?php echo $this->_tpl_vars['page_title']; ?>
" name="page_title" size="40" maxlength="120" class="textbox">
                        </td>
                      </tr>
					  <tr>
                        <td colspan="2" class="odd"><input type="checkbox" name="edit_seo" onchange="javascript: showHideSEO(this.checked);">&nbsp;Edit SEO settings for this page</td>
                      </tr>
                      <tr id="meta1" style="visibility:hidden;display:none;">
                        <td class="odd" valign="top">Meta Title:&nbsp;</td>
                        <td class="odd"><input type="text" value="<?php echo $this->_tpl_vars['meta_title']; ?>
" name="meta_title" size="40" maxlength="120" class="textbox">
                        </td>
                      </tr>
                      <tr id="meta2" style="visibility:hidden;display:none;">
                        <td class="odd" valign="top" colspan="2"><table width="100%" cellpadding="0" cellspacing="0" border="0" class="table-long">
                            <tr>
                              <td class="odd" valign="top" width="15%">Meta Keyword:&nbsp;</td>
                              <td class="odd" width="35%" valign="top"><textarea name="meta_keyword" rows="5" cols="40" class="textarea"><?php echo $this->_tpl_vars['meta_keyword']; ?>
</textarea>
                              </td>
                              <td class="odd" valign="top" width="15%">Canonical Tag:&nbsp;</td>
                              <td class="odd" width="35%" valign="top"><textarea name="canonical_tag" rows="5" cols="40" class="textarea"><?php echo $this->_tpl_vars['canonical_tag']; ?>
</textarea>
                                <label>(ex. &lt;link rel="canonical" href="http://www.example.com/product.php?item=swedish-fish"/&gt;)</label>
                              </td>
                            </tr>
                            <tr>
                              <td class="odd" valign="top">Meta Description:&nbsp;</td>
                              <td class="odd" valign="top"><textarea name="meta_description" rows="5" cols="40" class="textarea"><?php echo $this->_tpl_vars['meta_description']; ?>
</textarea>
                              </td>
                              <td class="odd" valign="top">303 Redirect: </td>
                              <td class="odd" valign="top"><textarea name="redirect" cols="40" rows="5" class="textarea"><?php echo $this->_tpl_vars['redirect']; ?>
</textarea>
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td class="odd" valign="top">Page Content :</td>
                        <td class="odd"><textarea name="page_content" id="editor1"><?php echo $this->_tpl_vars['page_content']; ?>
</textarea>
						
						<script type="text/javascript">
								var editor = CKEDITOR.replace('editor1',
								{
									filebrowserBrowseUrl : Site_Root_Front+'ckfinder/ckfinder.html',
									filebrowserImageBrowseUrl : Site_Root_Front+'ckfinder/ckfinder.html?Type=Images',
									filebrowserFlashBrowseUrl : Site_Root_Front+'ckfinder/ckfinder.html?Type=Flash',
									filebrowserUploadUrl  : Site_Root_Front+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
									filebrowserImageUploadUrl  : Site_Root_Front+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
									filebrowserFlashUploadUrl  : Site_Root_Front+'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
								});
						  </script>
                        </td>
                      </tr>
					  <tr>
                        <td class="odd" valign="top">Image: </td>
                        <td class="odd"><input type="file" name="image">
						<?php if ($this->_tpl_vars['image']): ?>
						<br />
						<img src="<?php echo $this->_tpl_vars['img_path'];  echo $this->_tpl_vars['image']; ?>
" width="300" height="auto" />
						<input type="hidden" name="hidden_image" value="<?php echo $this->_tpl_vars['image']; ?>
" />
						<?php endif; ?>
                        </td>
                      </tr>                      
                      <tr>
                        <td class="odd" valign="top">Status:</td>
                        <td class="odd"><input type="checkbox" name="status" <?php if ($this->_tpl_vars['Action'] == 'Add'): ?> checked="checked" <?php else: ?> <?php echo $this->_tpl_vars['checked']; ?>
 <?php endif; ?> value="1">
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
                          <input type="hidden" name="page_id" value="<?php echo $this->_tpl_vars['page_id']; ?>
">
                          <input type="hidden" name="Action" value="<?php echo $this->_tpl_vars['Action']; ?>
">
                          <input type="hidden" name="page_link" value="<?php echo $this->_tpl_vars['page_link']; ?>
">
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