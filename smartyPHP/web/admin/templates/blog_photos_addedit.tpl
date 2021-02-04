<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmPhotos" action="{$smarty.server.PHP_SELF}?post_id={$post_id}" method="post" enctype="multipart/form-data">
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
                  <td valign="top"><table border="0" cellpadding="1" cellspacing="2" class="table-long" width="100%">
                      <tr>
                        <td width="15%" class="odd" valign="top">Title:&nbsp;<span class="redmsg">*</span></td>
                        <td class="odd"><input type="text" value="{$title}" name="title" size="40" class="textbox">
                        </td>
                      </tr>
					  <!--tr>
                        <td width="15%" class="odd" valign="top">Description:</td>
                        <td class="odd"><textarea name="description" class="textarea" cols="40" rows="5">{$description}</textarea>
                        </td>
                      </tr-->
					  <tr>
                        <td width="15%" class="odd" valign="top">Photo<br />
						<i>Width : 584px<br />Height : 433px</i>
						</td>
                        <td class="odd"><input type="file" name="photo" />
                        </td>
                      </tr>
                    </table>
                    <table border="0" cellpadding="1" cellspacing="2" width="95%">
                      <tr>
                        <td class="divider" colspan="4"></td>
                      </tr>
                      <tr>
                        <td align="left" width="10%">&nbsp;</td>
                        <td align="left"><input type="submit" name="Submit" value="Save" class="stdButton" onClick="javascript: return Validate_Form(document.frmPhotos);">
                          <input type="submit" name="Submit" value="Cancel" class="stdButton">
                          <input type="hidden" name="post_id" value="{$post_id}">
						  <input type="hidden" name="photo_id" value="{$photo_id}">
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
