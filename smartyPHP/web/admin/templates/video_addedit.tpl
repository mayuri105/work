<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmVideo" action="{$A_Action}" method="post" enctype="multipart/form-data">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Video Manager [{$Action}]</h1></td>
                      </tr>
                    </table>
</td>
                </tr>
                <tr>
                  <td height="7"></td>
                </tr>
                <tr>
                  <td valign="top"><table border="0" cellpadding="1" cellspacing="2" class="table-long" width="100%">
                      <tr>
                        <td width="15%" class="odd" valign="top">Title:&nbsp;<span class="redmsg">*</span></td>
                        <td class="odd"><input type="text" value="{$video_title}" name="video_title" size="40" maxlength="120" class="textbox">
                        </td>
                      </tr>
                      <tr>
                        <td class="odd" valign="top">Content:&nbsp;<span class="redmsg">*</span></td>
                        <td class="odd"><textarea name="video_desc" rows="5" cols="40" class="textarea">{$video_desc}</textarea>
                        </td>
                      </tr>
					  <tr>
                        <td class="odd" valign="top">Status:</td>
                        <td class="odd"><input type="checkbox" name="status" {$checked} value="1">
                        </td>
                      </tr>
                    </table>
                    <table border="0" cellpadding="1" cellspacing="2" width="98%">
                      <tr>
                        <td class="divider" colspan="4"></td>
                      </tr>
                      <tr>
                        <td align="left" width="15%">&nbsp;</td>
                        <td align="left">
                          <input type="submit" name="Submit" value="Save" class="stdButton" onclick="Javascript: return Form_Submit(document.frmVideo)">
                         
                          <input type="submit" name="Submit" value="Cancel" class="stdButton">
                          <input type="hidden" name="video_id" value="{$video_id}">
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
