<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td height="30"><table width="100%" cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td align="right" width="86%"><a href="{$smarty.server.PHP_SELF}?Action=Add&parent_id={$parent_id}" class="stdButton">ADD</a></td>
          <!--<td align="right">
		  	<a href="Javascript: Order_Click('{$parent_id}')" class="stdButton">Manage Order</a>
		</td>-->
        </tr>
        <tr>
          <td height="3"></td>
        </tr>
      </table></td>
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
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><!--<form name="frmMenu" action="{$smarty.server.PHP_SELF}" method="post">-->
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Menu Manager</h1></td>
                        <td width="176" align="right" class="boadytextwhite">Page Size:
                          <select name="page_size" onChange="JavaScript: document.frmMenu.submit();" id="select" class="drpdwn1" style="width:45px;">
                            
                       {$PageSize_List}
						
                          </select>
                        </td>
                        <td width="13">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                {if $navigationLink != ''}
                <tr>
                  <td height="40" class="boadytextblack">&nbsp;{$navigationLink}</td>
                </tr>
                {/if}
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="box-container">
                      <tr>
                        <td valign="top" id="sitemap"><table cellpadding="0" cellspacing="0" border="0" class="table-long" width="100%">
                            <tr>
							  <th width="4%">&nbsp;</th>
                              <th width="5%">&nbsp;</th>
                              <th width="35%">Menu Title</th>
                              <!--<th width="30%">Menu URL</th>
                              <th width="10%">Status</th>
                              <th width="10%">Edit</th>
                              <th width="10%">Delete</th>-->
                            </tr>
                          </table>{$Menu_Tree}
		<input name="serialize" id="serialize" value="Serialize" type="submit">
		<pre>
<div id="result"></div>
</pre></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td valign="top">{if $smarty.foreach.Menus.total > 1}
                    <table border="0" cellpadding="1" cellspacing="1" width="100%">
                      <tr>
                        <td class="boadytextblack"><img src="{$Templates_Image}arrow_ltr.png"> <a href="JavaScript: CheckUncheck_Click(document.all['menus[]'], true);" onMouseMove="window.status='Check All';" onMouseOut="window.status='';" class="actionLink">Check All</a> / <a href="JavaScript: CheckUncheck_Click(document.all['menus[]'], false);" onMouseMove="window.status='Uncheck All';" onMouseOut="window.status='';" class="actionLink">Uncheck All</a> &nbsp;&nbsp;
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
              <!--<input type="hidden" name="Action">
              <input type="hidden" name="menu_id">
              <input type="hidden" name="parent_id">
              <input type="hidden" name="status">
              <input type="hidden" name="selected_values">-->
            <!--</form>--></td>
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
<!--<script language="javascript" src="{$Templates_JS}sort.js"></script>-->
<script>
// JavaScript Document
$(document).ready(function(){ldelim}

		$('ol.sortable').nestedSortable({ldelim}
			disableNesting: 'no-nest',
			forcePlaceholderSize: true,
			handle: 'div',
			helper:	'clone',
			items: 'li',
			maxLevels: 5,
			opacity: .6,
			placeholder: 'placeholder',
			revert: 250,
			tabSize: 25,
			tolerance: 'pointer',
			toleranceElement: '> div'
		{rdelim});

		$('#serialize').click(function(){ldelim}
			serialized = $('ol.sortable').nestedSortable('serialize');
			
			$.ajax({ldelim}
			  type: 'GET',
			  url: current_page,
			  data: serialized,
			  success: function() {ldelim}
				url	=	""+current_page+"?"+serialized+"&Action=Order";

				$("#result").load(url);
				
			{rdelim}
			
			{rdelim});
		{rdelim})


		

	{rdelim});

	function dump(arr,level) {ldelim}
		var dumped_text = "";
		if(!level) level = 0;

		//The padding given at the beginning of the line.
		var level_padding = "";
		for(var j=0;j<level+1;j++) level_padding += "    ";

		if(typeof(arr) == 'object') {ldelim} //Array/Hashes/Objects
			for(var item in arr) {ldelim}
				var value = arr[item];

				if(typeof(value) == 'object') {ldelim} //If it is an array,
					dumped_text += level_padding + "'" + item + "' ...\n";
					dumped_text += dump(value,level+1);
				{rdelim} else {ldelim}
					dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
				{rdelim}
			{rdelim}
		{rdelim} else {ldelim} //Strings/Chars/Numbers etc.
			dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
		{rdelim}
		return dumped_text;
	{rdelim}
</script>