<script language="javascript" src="{$Site_Root_Front}ckeditor/ckeditor.js"></script>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top">
			<form name="frmErrorPage" action="{$smarty.server.PHP_SELF}" method="post" enctype="multipart/form-data">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Error Page Manager </h1></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="7"></td>
                </tr>
				{if $succMessage}<tr><td class="successMsg" align="center">&nbsp;{$succMessage}</td></tr>
					<tr><td class="successMsg" align="center">&nbsp;</td></tr>{/if}
                <tr>
                  <td valign="top"><table border="0" cellpadding="1" cellspacing="2" class="table-long" width="100%">
 			
                      <tr>
                        <td class="odd" valign="top">Error Page Content:&nbsp;<span class="redmsg">*</span></td>
                        <td class="odd"><textarea id="editor1" name="error_page_content">{$error_page_content}</textarea>
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
                        
			
                      
                    </table>
                    <table border="0" cellpadding="1" cellspacing="2" width="95%">
                      <tr>
                        <td class="divider" colspan="4"></td>
                      </tr>
                      <tr>
                        <td align="left" width="10%">&nbsp;</td>
                        <td align="left">
                          <input type="submit" name="Submit" value="Save" class="stdButton" onClick="javascript: return Validate_Form(document.frmErrorPage);">
                          <input type="submit" name="Submit" value="Cancel" class="stdButton" >
                          <input type="hidden" name="error_page_id" value="{$error_page_id}">
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

