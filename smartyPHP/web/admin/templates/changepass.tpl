<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmChangePass" action="{$A_Action}" method="post">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Change Password</h1></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="30">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top"><table border="0" align="center" cellpadding="5" cellspacing="2" class="table-long" width="50%">
                      
				{if $succMsg}<tr><td colspan="2" class="successMsg" align="center">{$succMsg}</td></tr>{/if}
				{if $Error_Message}<tr><td colspan="2" class="successMsg" align="center">{$Error_Message}</td></tr>{/if}
                <tr>
                  <th colspan="2" align="center" class="headTitle"><strong>Manage Password</strong></th>
                </tr>
                <tr>
                  <td class="odd">Old Password</td>
                  <td class="odd"><input type="password" name="old_password" class="textbox">
                    <input type="hidden" name="old_pass_value" value="{$old_pass}">
                  </td>
                </tr>
                <tr>
                  <td class="odd">New Password</td>
                  <td class="odd"><input type="password" name="new_password1" class="textbox"></td>
                </tr>
                <tr>
                  <td class="odd">Retype Password</td>
                  <td class="odd"><input type="password" name="new_password2" class="textbox"></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><input type="submit" name="Sumbit" value="Change" class="stdButton" onClick="javascript: return Form_Submit(document.frmChangePass);">
                    &nbsp;&nbsp; </td>
                </tr>
              </table>
              <input type="hidden" name="Action" value="{$Action}">
              <input type="hidden" name="admin_id" value="{$Admin_Id}">
              </table>
            </form></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="7"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
