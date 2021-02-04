<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"></td>
  </tr>
  {if $succMessage}
  <tr>
    <td class="successMsg" align="center">&nbsp;{$succMessage}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  {/if}
  <tr>
    <td height="30"><table width="100%" cellpadding="0" cellspacing="0" border="0" align="right">
        
		
        <tr>
          <td align="right"><a href="{$smarty.server.PHP_SELF}?post_id={$post_id}&Action=Add" class="stdButton">ADD</a>&nbsp;
		  <a href="Javascript: Order_Click('{$post_id}')" class="stdButton">Manage Order</a>&nbsp;<a href="blog.php" class="stdButton">Back</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmPhotos" action="{$smarty.server.PHP_SELF}?post_id={$post_id}" method="post" >
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Photo Manager For {$catDetail->title|stripslashes}</h1></td>
                        <td width="176" align="right" class="boadytextwhite">Page Size:
                          <select name="page_size" onChange="JavaScript: document.frmPhotos.submit();" id="select" class="drpdwn1" style="width:45px;">
                            
                       {$PageSize_List}
						
                          </select>
                        </td>
                        <td width="13">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="box-container">
                      <tr>
                        <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="table-long" width="100%">
                            <tr>
                              <th width="5%"></th>
                              <th align="left">Title</th>
							  <th width="10%">Photo</th>
                              <th width="5%">Delete</th>
                            </tr>
                            {foreach name=photoInfo from=$Options item=rec}
                            <tr class="{cycle values='odd, '}">
                              <td align="center"><input type="checkbox" name="lists[]" value="{$rec->photo_id}" /></td>
                              <td>&nbsp;{$rec->title|stripslashes}</td>
							  <td align="center"><img src="{$img_path}{$rec->photo}" height="200"  width="200"/></td>
                              <td align="center"><img src="{$Templates_Image}icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: Delete_Click('{$rec->photo_id}');"></td>
                            </tr>
                            {foreachelse}
                            <tr>
                              <td colspan="5" class="boadytextblack" align="center">No photos available.</td>
                            </tr>
                            {/foreach}
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td valign="top">{if $smarty.foreach.photoInfo.total > 1}
                    <table border="0" cellpadding="1" cellspacing="1" width="95%">
                      <tr>
                        <td class="boadytextblack"><img src="{$Templates_Image}arrow_ltr.png"> <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], true);" onMouseMove="window.status='Check All';" onMouseOut="window.status='';" class="actionLink">Check All</a> / <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], false);" onMouseMove="window.status='Uncheck All';" onMouseOut="window.status='';" class="actionLink">Uncheck All</a> &nbsp;&nbsp;
                          With selected <img src="{$Templates_Image}icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: DeleteChecked_Click('{$cat_parent_id}');"> </td>
                      </tr>
                    </table>
                    {/if}
                    {if $Page_Link}
                    <table border="0" cellpadding="2" cellspacing="2" width="97%">
                      <tr>
                        <td align="right"> {$Page_Link} </td>
                      </tr>
                    </table>
                    {/if}</td>
                </tr>
              </table>
              <input type="hidden" name="Action" />
              <input type="hidden" name="photo_id" />
			  <input type="hidden" name="post_id" value="{$post_id}" />
              <input type="hidden" name="status" />
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
