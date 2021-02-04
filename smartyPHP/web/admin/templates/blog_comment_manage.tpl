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
    <td align="center"><a href="{$smarty.server.PHP_SELF}?type=all" class="actionLink">List All</a> | <a href="{$smarty.server.PHP_SELF}?type=approved" class="actionLink">List Approved</a> | <a href="{$smarty.server.PHP_SELF}?type=unapproved" class="actionLink">List UnApproved ({$Count_Unapproved})</a> </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmBlogComments" action="{$smarty.server.PHP_SELF}?type={$type}" method="post" >
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Blog Comments Manager</h1></td>
                        <td width="176" align="right" class="boadytextwhite">Page Size:
                          <select name="page_size" onChange="JavaScript: document.frmBlogComments.submit();" id="select" class="drpdwn1" style="width:45px;">
                            
                            
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
                        <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="table-long1" width="100%">
                            <tr>
                              <th >&nbsp;</th>
                            </tr>
                            {foreach name=blogComment from=$Options item=rec}
                            <tr class="{cycle values='odd, '}">
                              <td><table width="100%" cellpadding="0" cellspacing="0" border="0" >
                                  <tr>
                                    <td width="3%"><input type="checkbox" name="lists[]" value="{$rec->id}" /></td>
                                    <td width="15%" class="boadytextblack"><strong>By : </strong>{$rec->comment_by}</td>
                                    <td class="boadytextblack"><strong>Email : </strong>{$rec->comment_email}</td>
                                    <td align="right" class="boadytextblack">{$rec->comment_date}</td>
                                    <td align="center" width="15%" class="boadytextblack"> {if $rec->status==1}Approve / <a href="JavaScript: ToggleStatus_Click('{$rec->id}', '0');" class="actionLink">UnApprove</a> {else}UnApprove / <a href="JavaScript: ToggleStatus_Click('{$rec->id}', '1');" class="actionLink">Approve </a> {/if} </td>
                                    <td align="right" width="5%"><a href="#" class="actionLink" onClick="JavaScript: Edit_Click('{$rec->id}');"><img src="{$Templates_Image}icon-edit.gif" class="imgAction" title="Edit" border="0"></a> </td>
                                    <td align="right" width="5%"><a href="#" class="actionLink" onClick="JavaScript: Delete_Click('{$rec->id}');"><img src="{$Templates_Image}icon-delete.gif" class="imgAction" title="Delete" border="0"></a> </td>
                                  </tr>
                                  <tr>
                                    <td width="3%">&nbsp;</td>
                                    <td class="boadytextblack" colspan="6">{$rec->comment}</td>
                                  </tr>
                                  <tr>
                                    <td width="3%">&nbsp;</td>
                                    <td class="boadytextblack" colspan="6"><strong>Posted in : </strong>{$rec->title}</td>
                                  </tr>
                                </table></td>
                            </tr>
                            {foreachelse}
                            <tr>
                              <td colspan="5" class="boadytextblack" align="center">No Comment available.</td>
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
                  <td valign="top">{if $smarty.foreach.blogComment.total > 1}
                    <table border="0" cellpadding="1" cellspacing="1" width="97%">
                      <tr>
                        <td class="boadytextblack"><img src="{$Templates_Image}arrow_ltr.png"> <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], true);" onMouseMove="window.status='Check All';" onMouseOut="window.status='';" class="actionLink">Check All</a> / <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], false);" onMouseMove="window.status='Uncheck All';" onMouseOut="window.status='';" class="actionLink">Uncheck All</a> &nbsp;&nbsp;
                          With selected <img src="{$Templates_Image}icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: DeleteChecked_Click();"> </td>
                      </tr>
                    </table>
                    {/if}
                    {if $Page_Link}
                    <table border="0" cellpadding="2" cellspacing="2" width="95%">
                      <tr>
                        <td align="right"> {$Page_Link} </td>
                      </tr>
                    </table>
                    {/if}</td>
                </tr>
              </table>
              <input type="hidden" name="Action" />
    <input type="hidden" name="id" />
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
