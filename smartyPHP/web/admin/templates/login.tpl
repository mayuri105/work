<html>
<head>
<title>{$Site_Title} :: Admin Login</title>
<link href="{$Templates_CSS}style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="{$Templates_JS}validate.js"></script>
<script language="javascript" src="{$Templates_JS}functions.js"></script>
{section name=FileName loop=$JavaScript}
<script language="javascript" src="{$Templates_JS}{$JavaScript[FileName]}"></script>
{/section}
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td valign="top" id="header">{include file="$T_Header"} </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" ><table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
              <tr>
                <td align="left" valign="top"><table cellpadding="0" cellspacing="0" border="0" class="full-col" align="center" width="30%"><tr><td height="10">&nbsp;</td></tr>
                    <tr>
                      <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                          <tr>
                            <td  align="left" valign="top"><h1>MEMBER LOGIN</h1></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td valign="top"><form name="frmLogin" action="{$A_Login}"  method="post">
                          <table width="100%" class="table-long" border="0" align="center" cellpadding="1" cellspacing="0">{if $Error_Message}	<tr><td align="center" class="redmsg">{$Error_Message}</td></tr>{/if}     
                            <tr>
                              <td class="odd">USERNAME:</td>
                            </tr>
                            <tr>
                              <td class="odd"><input type="text" name="username" class="textbox"  size="18" maxlength="25" tabindex="1">
                              </td>
                            </tr>
                            <tr>
                              <td class="odd"> PASSWORD:</td>
                            </tr>
                            <tr>
                              <td class="odd"><input  type="password" name="password" class="textbox" maxlength="15" size="18" tabindex="2"></td>
                            </tr>
                            <tr>
                              <td align="center"><input  type="submit" name="Submit" value="Login" class="stdButton" onClick="javascript: return Form_Submit(document.frmLogin);" tabindex="3"></td>
                            </tr>
                          </table>
                          <input type="hidden" name="Action" value="Login">
                        </form></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="7"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
