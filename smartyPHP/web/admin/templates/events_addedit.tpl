<script language="javascript" src="{$Site_Root_Front}ckeditor/ckeditor.js"></script>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmEvents" action="{$A_Action}" method="post" enctype="multipart/form-data">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Events Manager [{$Action}]</h1></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="7"></td>
                </tr>
                <tr>
                  <td valign="top"><table border="0" cellpadding="1" cellspacing="2" class="table-long" width="100%">
                     <tr>
                        <td width="15%" class="odd" valign="top">Event Title:&nbsp;<span class="redmsg">*</span></td>
                        <td class="odd"><input name="event_title" type="text" class="textbox" value="{$event_title}">
						
                        </td>
                      </tr>
				      <tr>
                        <td class="odd" valign="top">Event Description :</td>
                        <td class="odd"><textarea id="editor1" name="event_description">{$event_description}</textarea>
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
						<td class="odd" valign="middle">Event Start Date :</td>
						<td class="odd">
						<script>DateInput('event_start_date', true, 'YYYY-MM-DD','{$event_start_date}')</script>
						</td>
					</tr>
					<tr>
						<td class="odd" valign="middle">Event End Date :</td>
						<td class="odd">
						<script>DateInput('event_end_date', true, 'YYYY-MM-DD','{$event_end_date}')</script>
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
                        <td align="left">
                          <input type="submit" name="Submit" value="Save" class="stdButton" onclick="Javascript: return Form_Submit(document.frmEvents)">
                          <input type="submit" name="Submit" value="Cancel" class="stdButton">
                          <input type="hidden" name="event_id" value="{$event_id}">
                          <input type="hidden" name="Action" value="{$Action}">
						  <input type="hidden" name="html_link" value="{$html_link}">
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
