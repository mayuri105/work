<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Email Configurations</h1></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="30">&nbsp;</td>
                </tr>
				{if $succMessage}
				  <tr>
					<td class="successMsg" align="center">&nbsp;{$succMessage}</td>
				  </tr>
				  <tr>
					<td align="center">&nbsp;</td>
				  </tr>
				  {/if}
                <tr>
                  <td valign="top"><form name="frmSiteConfig" action="{$A_Action}" method="post"><table border="0" cellpadding="1" cellspacing="2" width="100%" class="table-long">
                
                {foreach from=$ToolData item=Tool}
                <tr class="odd">
                  <td colspan="2" valign="top" width="20%" class="boadytextblack"><b>{$Tool->email_title}</b></td>
                </tr>
                <tr>
                  <td  class="odd" valign="top" width="20%">Email Title :</td>
                  <td class="odd"><strong>{$Tool->email_title}</strong>
                    <input type="hidden" name="email_id[]" size="50" maxlength="120" value="{$Tool->email_id}">
                    <input type="hidden" name="email_title[]" size="50" maxlength="120" value="{$Tool->email_title}" class="textbox">
                    <br>
                  </td>
                </tr>
                <tr>
                  <td valign="top" class="odd" width="20%">Email Address :</td>
                  <td class="odd"><input type="text" name="email_adress[]" size="50" maxlength="120" value="{$Tool->email_adress}" class="textbox">
                    <br>
                  </td>
                </tr>
                {/foreach}
                
                <tr>
                  <td>&nbsp;</td><td align="left"><input type="submit" name="Submit" value="Update" class="stdButton" >
                    <input type="submit" name="Submit" value="Cancel" class="stdButton">
                  </td>
                </tr>
              </table>
			  </form></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
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
