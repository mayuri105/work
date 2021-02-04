<form name="frmContact" action="{$A_Action}" method="post">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30"></td>
    </tr>
    <tr>
      <td valign="top"><table cellpadding="5" cellspacing="" border="0" width="25%" align="center" class="table-long">
          <tr>
            <td width="40%" align="right" valign="middle" class="boadytextblack"><strong>Date</strong>&nbsp;</td>
            <td align="left"> {if $smarty.session.search_contact_date !=''}
              <script>DateInput('search_contact_date', true, 'YYYY-MM-DD', '{$smarty.session.search_contact_date}')</script>
              {else}
              <script>DateInput('search_contact_date', true, 'YYYY-MM-DD')</script>
              {/if}</td>
          </tr>
          <tr>
            <td align="center" colspan="2" class="boadytextwhite"><input type="submit" name="Search" value="Search" class="stdButton">
              &nbsp;
              <input type="submit" name="ShowAll" value="Show All" class="stdButton">
            </td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    {if $succMessage}
    <tr>
      <td class="successMsg" align="center">&nbsp;{$succMessage}</td>
    </tr>
    {/if}
    <tr>
      <td height="40" valign="middle" align="right"><a href="{if $totRec == 0}#{else}{$smarty.server.PHP_SELF}?download=yes{/if}" {if $totRec == 0} onclick="javascript: alert('There is No Record');"{/if} class="stdButton">DOWNLOAD</a>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td align="left" valign="top"><table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Contact Manager</h1></td>
                        <td width="176" align="right" class="boadytextwhite">Page Size:
                          <select name="page_size" onChange="JavaScript: document.frmContact.submit();" id="select" class="drpdwn1" style="width:45px;">
                            
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
                              <th width="15%" align="left">Name</th>
                              <th width="15%">Telephone</th>
                              <th width="15%">Email</th>
                              <th align="left">Query</th>
                              <th width="10%" align="center">Contact On</th>
                              <th width="5%">Delete</th>
                            </tr>
                            {foreach name=contactInfo from=$Options item=Contact}
                            <tr class="{cycle values='odd, '}">
                              <td align="center" valign="top"><input type="checkbox" name="lists[]" value="{$Contact->contact_id}" /></td>
                              <td valign="top">{$Contact->name|stripslashes}</td>
                              <td align="center" valign="top">{$Contact->phone_number}</td>
                              <td align="center" valign="top">{$Contact->email}</td>
                              <td valign="top">{$Contact->comments|stripslashes|nl2br}</td>
                              <td valign="top" align="center">{$Contact->contact_on|date_format:"%d %b %Y <br />
                                %H:%M:%S"}</td>
                              <td align="center" valign="top"><img src="{$Templates_Image}icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: Delete_Click('{$Contact->contact_id}');"></td>
                            </tr>
                            {foreachelse}
                            <tr>
                              <td colspan="6" class="boadytextblack" align="center">No Contacts Available.</td>
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
                  <td valign="top">{if $smarty.foreach.contactInfo.total > 1}
                    <table border="0" cellpadding="1" cellspacing="1" width="98%">
                      <tr>
                        <td class="boadytextblack"><img src="{$Templates_Image}arrow_ltr.png"> <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], true);" onMouseMove="window.status='Check All';" onMouseOut="window.status='';" class="actionLink">Check All</a> / <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], false);" onMouseMove="window.status='Uncheck All';" onMouseOut="window.status='';" class="actionLink">Uncheck All</a> &nbsp;&nbsp;
                          With selected <img src="{$Templates_Image}icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: DeleteChecked_Click('{$cat_parent_id}');"> </td>
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
              <input type="hidden" name="contact_id">
              <input type="hidden" name="status">
            </td>
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
</form>
