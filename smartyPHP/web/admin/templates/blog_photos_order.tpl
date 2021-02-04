<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmPhotos" action="{$smarty.server.PHP_SELF}?post_id={$post_id}" method="post">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Photo Manager For {$catDetail->title|stripslashes} [{$Action}]</h1></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="7"></td>
                </tr>
                <tr>
                  <td valign="top"><table border="0" cellpadding="1" cellspacing="2" align="center" class="table-long" width="95%">
                      
                <tr><td align="right" width="60%">
				<select name="photos" style="width:200px;" size="10" class="globalformtxt">
							{foreach name=Options from=$Options item=Opt}
								<option value="{$Opt->photo_id}">{$Opt->title|stripslashes}</option>
							{/foreach}
						</select>
						<input type="hidden" name="display_order"> 
                </td>
				<td align="left">
						<img src="{$Templates_Image}top.jpg" style="cursor:hand" border="0" onClick="JavaScript: UpDown_Click(-1);"><br><br>
						<img src="{$Templates_Image}bottom1.jpg" style="cursor:hand" border="0" onClick="JavaScript: UpDown_Click(1);">
					</td>
				</tr>    </table>
                    <table border="0" cellpadding="1" cellspacing="2" width="95%">
                      
                      <tr>
                        <td align="center"><input type="submit" name="Submit" value="Submit" class="stdButton" onClick="javascript: Button_Click(this);" /> 
				<input type="submit" name="Submit" value="Cancel" class="stdButton"> 					
				<input type="hidden" name="Action" value="{$Action}">
				<input type="hidden" name="buss_id">
				<input type="hidden" name="post_id" value="{$post_id}">
						
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
