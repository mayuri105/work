<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmSiteConfig" action="{$A_Action}" method="post" enctype="multipart/form-data">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Site Config</h1></td>
                      </tr>
                    </table></td>
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
                  <td valign="top"><table border="0" align="center" cellpadding="5" cellspacing="2" class="table-long" width="100%">
                      <tr>
                        <td align="right" valign="top" class="odd">Site Title</td>
                        <td class="odd"><textarea name="site_title" rows="3" cols="50" class="textarea">{$site_title}</textarea>
                          <br>
                          Maximum 100 characters </td>
                      </tr>
					  
                      <tr>
                        <td align="right" valign="top" class="odd">Site Keyword</td>
                        <td class="odd"><textarea name="site_keyword" rows="4" cols="50" class="textarea">{$site_keyword}</textarea>
                          <br>
                          <font class="boadytextblack">Maximum 1000 characters </font><br>
                          <b>Site Keywords</b> - A list of terms and phrases search engines use to find and rank your site.<br />
                          Your keywords should accurately describe your services, features, products, and location. </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top" class="odd">Site Description</td>
                        <td class="odd"><textarea name="site_description" rows="4" cols="50" class="textarea">{$site_description}</textarea>
                          <br>
                          <font class="boadytextblack">Maximum 400 characters </font><br>
                          <b>Site Description</b> - This text appears in the listing for your site in search engine results <br />
                          (e.g., a brief description of the services and products you offer, as well as your location). <br />
                          Begin this description with your service title, <br />
                          and then include other keywords and/or phrases 
                          describing your services. </td>
                      </tr>
					  <tr>
                        <td align="right" valign="top" class="odd">Copyright Text</td>
                        <td class="odd"><input name="copyright_text" class="textbox" value="{$copyright_text}">
                      </tr>
					  <tr>
                        <td align="right" valign="top" class="odd">Footer Text</td>
                        <td class="odd"><input name="footer_text" class="textbox" value="{$footer_text}">
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="Submit" value="Update" class="stdButton" onclick="javascript: return Form_Submit(document.frmSiteConfig);">
                          <input type="submit" name="Submit" value="Cancel" class="stdButton"></td>
                      </tr>
                    </table></td>
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
