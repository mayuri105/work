<table width="100%" cellpadding="0" cellspacing="0" border="0" id="tbl-header">
  <!--<tr>
    <td width="100%" align="center" style="padding-top:25px;"><img src="{$Templates_Image}logo.png" class="logo" alt=""/></td>
  </tr>-->
  <tr>
    <td width="73%" style="padding-left:20px;">
		<!--<img src="{$Templates_Image}logo.png" class="logo" alt="" />-->
		<div class="author-discription"><h1>Alphabet <span>Success</span></h1></div>
	</td>
    <td width="27%" valign="top"><table width="73%" cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td valign="top"><table width="182" cellpadding="0" cellspacing="0" border="0" align="right" class="tbl-toprightpaanel">
              {if $Admin_Name}
			  <tr>
                <td width="16"></td>
                <td width="75" align="center" valign="top"><a href="siteconfig.php" class="lnk-setting">Setting</a></td>
                <td width="74" align="center" valign="top"><a href="logout.php" class="lnk-logout">Logout</a></td>
              </tr>{/if}
            </table></td>
        </tr>
        <tr>
          <td height="19">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="welcometxt">{if $Admin_Name}Welcome, <strong>{$Admin_Name}</strong> {/if}</td>
        </tr>
      </table></td>
  </tr>
</table>
