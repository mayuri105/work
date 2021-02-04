<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmMenu" action="{$smarty.server.PHP_SELF}" method="post" enctype="multipart/form-data">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Menu Manager [{$Action}]</h1></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="7"></td>
                </tr>
                <tr>
                  <td valign="top"><table border="0" cellpadding="1" cellspacing="2" class="table-long" width="100%">
                      <tr>
                        <td width="15%" class="odd" valign="top">Menu Title:&nbsp;<span class="redmsg">*</span></td>
                        <td class="odd"><input type="text" name="menu_title" value="{$menu_title}" class="textbox" />
                        </td>
                      </tr>
					  <tr>
                        <td class="odd" valign="top">Menu URL:&nbsp;</td>
                        <td class="odd"> 
                          <input type="text" value="{$menu_url}" name="menu_url" size="40" maxlength="120" class="textbox">
                           </td>
                      </tr>
					  <tr>
                        <td class="odd" valign="top">Parent:&nbsp;</td>
                        <td class="odd"> 
                          <select name="parent_id">
						  <option value="0">Root</option>
						  {$menu_tree}
						  </select>
                           </td>
                      </tr>
                      <tr>
                        <td class="odd" valign="top">Status:&nbsp;</td>
                        <td class="odd">
						<input type="checkbox" name="status" value="1" {if $Action=='Add'} checked="checked" {else} {$checked} {/if}>
						
                        </td>
                      </tr>
                      
                      
                      
                    </table>
                    <table border="0" cellpadding="1" cellspacing="2" width="95%">
                      <tr>
                        <td class="divider" colspan="4"></td>
                      </tr>
                      <tr>
                        <td align="left" width="10%">&nbsp;</td>
                        <td align="left"><input type="submit" name="Submit" value="Submit" class="stdButton" onclick="javascript: return Validate_Form(document.frmMenu);">
                    <input type="reset" name="Reset" value="Reset" class="stdButton">
                    <input type="submit" name="Submit" value="Cancel" class="stdButton">
					
                    <input type="hidden" name="menu_id" value="{$menu_id}">
                    
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
