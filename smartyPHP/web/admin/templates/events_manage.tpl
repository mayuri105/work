<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"></td>
  </tr>
  {if $succMessage}
  <tr>
    <td class="successMsg" align="center">&nbsp;{$succMessage}</td>
  </tr>
  <tr>
    <td class="successMsg" align="center">&nbsp;</td>
  </tr>
  {/if}
  <tr>
    <td height="30">
      <table width="100%" cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td align="right"><a href="{$smarty.server.PHP_SELF}?Action=Add" class="stdButton">ADD</a></td>
        </tr>
        <tr>
          <td height="3"></td>
        </tr>
      </table>
      </td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmEvents" action="{$smarty.server.PHP_SELF}" method="post">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Events Manager</h1></td>
                        <td width="176" align="right" class="boadytextwhite">Page Size:
                          <select name="page_size" onChange="JavaScript: document.frmEvents.submit();" id="select" class="drpdwn1" style="width:45px;">
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
                              <th width="4%"></th>
                              <th width="25%" align="left">Title</th>
                             <th width="10%">Status</th>
                              <th width="5%">Edit</th>
							  <th width="5%">Delete</th>
                            </tr>
                            {foreach name=eventsInfo from=$Options item=Events}
                            <tr class="{cycle values='odd, '}">
                              <td align="center"><input type="checkbox" name="lists[]" value="{$Events->event_id}" /></td>
                              <td>&nbsp;{$Events->event_title|stripslashes}</td>
                              <td align="center"> {if $Events->status==1}
                                Publish
                                {else} <b>UnPublish</b> {/if}
                                {if $Events->status==1}
                                (<a href="JavaScript: ToggleStatus_Click('{$Events->event_id}', '0');" class="actionLink">UnPublish</a>)
                                {else}
                                (<a href="JavaScript: ToggleStatus_Click('{$Events->event_id}', '1');" class="actionLink">Publish</a>)
                                {/if} </td>
                              <td align="center">
							  <img src="{$Templates_Image}icon-edit.gif" class="imgAction" title="Edit" onClick="JavaScript: Edit_Click('{$Events->event_id}');"></td>
                              <td align="center">
							  <img src="{$Templates_Image}icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: Delete_Click('{$Events->event_id}');">
							  </td>
                            </tr>
                            {foreachelse}
                            <tr>
                              <td colspan="5" class="boadytextblack" align="center">No Events Available.</td>
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
                  <td valign="top">
				  {if $smarty.foreach.eventsInfo.total > 1}
                    <table border="0" cellpadding="1" cellspacing="1" width="100%">
                      <tr>
                        <td class="boadytextblack">
							<img src="{$Templates_Image}arrow_ltr.png">
							<a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], true);" onMouseMove="window.status='Check All';" onMouseOut="window.status='';" class="actionLink">Check All</a> / <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], false);" onMouseMove="window.status='Uncheck All';" onMouseOut="window.status='';" class="actionLink">Uncheck All</a> &nbsp;&nbsp;
                          With selected <img src="{$Templates_Image}icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: DeleteChecked_Click();">
						  </td>
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
              <input type="hidden" name="Action">
              <input type="hidden" name="event_id">
              <input type="hidden" name="status">
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
