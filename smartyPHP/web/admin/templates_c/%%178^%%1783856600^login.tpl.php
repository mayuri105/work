<?php /* Smarty version 2.6.0, created on 2017-02-09 13:42:06
         compiled from login.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['Site_Title']; ?>
 :: Admin Login</title>
<link href="<?php echo $this->_tpl_vars['Templates_CSS']; ?>
style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
validate.js"></script>
<script language="javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
functions.js"></script>
<?php if (isset($this->_sections['FileName'])) unset($this->_sections['FileName']);
$this->_sections['FileName']['name'] = 'FileName';
$this->_sections['FileName']['loop'] = is_array($_loop=$this->_tpl_vars['JavaScript']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['FileName']['show'] = true;
$this->_sections['FileName']['max'] = $this->_sections['FileName']['loop'];
$this->_sections['FileName']['step'] = 1;
$this->_sections['FileName']['start'] = $this->_sections['FileName']['step'] > 0 ? 0 : $this->_sections['FileName']['loop']-1;
if ($this->_sections['FileName']['show']) {
    $this->_sections['FileName']['total'] = $this->_sections['FileName']['loop'];
    if ($this->_sections['FileName']['total'] == 0)
        $this->_sections['FileName']['show'] = false;
} else
    $this->_sections['FileName']['total'] = 0;
if ($this->_sections['FileName']['show']):

            for ($this->_sections['FileName']['index'] = $this->_sections['FileName']['start'], $this->_sections['FileName']['iteration'] = 1;
                 $this->_sections['FileName']['iteration'] <= $this->_sections['FileName']['total'];
                 $this->_sections['FileName']['index'] += $this->_sections['FileName']['step'], $this->_sections['FileName']['iteration']++):
$this->_sections['FileName']['rownum'] = $this->_sections['FileName']['iteration'];
$this->_sections['FileName']['index_prev'] = $this->_sections['FileName']['index'] - $this->_sections['FileName']['step'];
$this->_sections['FileName']['index_next'] = $this->_sections['FileName']['index'] + $this->_sections['FileName']['step'];
$this->_sections['FileName']['first']      = ($this->_sections['FileName']['iteration'] == 1);
$this->_sections['FileName']['last']       = ($this->_sections['FileName']['iteration'] == $this->_sections['FileName']['total']);
?>
<script language="javascript" src="<?php echo $this->_tpl_vars['Templates_JS'];  echo $this->_tpl_vars['JavaScript'][$this->_sections['FileName']['index']]; ?>
"></script>
<?php endfor; endif; ?>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td valign="top" id="header"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['T_Header']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </td>
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
                      <td valign="top"><form name="frmLogin" action="<?php echo $this->_tpl_vars['A_Login']; ?>
"  method="post">
                          <table width="100%" class="table-long" border="0" align="center" cellpadding="1" cellspacing="0"><?php if ($this->_tpl_vars['Error_Message']): ?>	<tr><td align="center" class="redmsg"><?php echo $this->_tpl_vars['Error_Message']; ?>
</td></tr><?php endif; ?>     
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