<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmBlog" action="{$smarty.server.PHP_SELF}" method="post">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Blog Comments Manager [{$Action}]</h1></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="7"></td>
                </tr>
                <tr>
                  <td valign="top"><table border="0" cellpadding="1" cellspacing="2" class="table-long" width="100%">
                      <tr>
					<td class="odd" width="15%" valign="top">Name:</td>
					<td class="odd">
						<input type="text" value="{$comment_by}" name="comment_by" size="40" class="textbox">
					</td>
				</tr>
				<tr>
					<td class="odd" valign="top">Email:</td>
					<td class="odd">
						<input type="text" value="{$comment_email}" name="comment_email" size="40" class="textbox">
					</td>
				</tr>
				<tr>
					<td class="odd" valign="top">Date:</td>
					<td class="odd">
						<script>DateInput('post_date', true, 'YYYY-MM-DD','{$post_date}')</script>
					</td>
				</tr>
				<tr>
					<td class="odd" valign="top">Comment :</td>
					<td class="odd">
						<textarea name="comment" cols="70" rows="4" class="textarea">{$comment}</textarea>
					</td>
				</tr>
				<tr>
					<td class="odd" valign="top">Approve?:</td>
					<td class="odd">
						<input type="checkbox" name="status" {$status} value="1">
					</td>
				</tr>
                    </table>
                    <table border="0" cellpadding="1" cellspacing="2" width="95%">
                      <tr>
                        <td class="divider" colspan="4"></td>
                      </tr>
                      <tr>
                        <td align="left" width="10%">&nbsp;</td><td align="left">
						<input type="submit" name="Submit" value="Save" class="stdButton" onClick="javascript: return Validate_Form(document.frmBlog);">
						<input type="submit" name="Submit" value="Cancel" class="stdButton">
						<input type="hidden" name="id" value="{$id}">
						<input type="hidden" name="type" value="{$type}" />
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
