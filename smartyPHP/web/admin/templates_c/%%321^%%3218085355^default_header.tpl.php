<?php /* Smarty version 2.6.0, created on 2017-02-09 13:42:54
         compiled from default_header.tpl */ ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" id="tbl-header">
  <!--<tr>
    <td width="100%" align="center" style="padding-top:25px;"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
logo.png" class="logo" alt=""/></td>
  </tr>-->
  <tr>
    <td width="73%" style="padding-left:20px;">
		<!--<img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
logo.png" class="logo" alt="" />-->
		<div class="author-discription"><h1>Alphabet <span>Success</span></h1></div>
	</td>
    <td width="27%" valign="top"><table width="73%" cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td valign="top"><table width="182" cellpadding="0" cellspacing="0" border="0" align="right" class="tbl-toprightpaanel">
              <?php if ($this->_tpl_vars['Admin_Name']): ?>
			  <tr>
                <td width="16"></td>
                <td width="75" align="center" valign="top"><a href="siteconfig.php" class="lnk-setting">Setting</a></td>
                <td width="74" align="center" valign="top"><a href="logout.php" class="lnk-logout">Logout</a></td>
              </tr><?php endif; ?>
            </table></td>
        </tr>
        <tr>
          <td height="19">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="welcometxt"><?php if ($this->_tpl_vars['Admin_Name']): ?>Welcome, <strong><?php echo $this->_tpl_vars['Admin_Name']; ?>
</strong> <?php endif; ?></td>
        </tr>
      </table></td>
  </tr>
</table>