<?php /* Smarty version 2.6.0, created on 2017-02-09 13:42:33
         compiled from blog_manage.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'blog_manage.tpl', 48, false),array('modifier', 'stripslashes', 'blog_manage.tpl', 50, false),)), $this); ?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
	<td height="30">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" align="right">
			<tr>
				<td align="right"><a href="<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
?Action=Add" class="stdButton">ADD</a></td>
			</tr>
			<tr><td height="3"></td></tr>
		</table>
	</td>
	</tr>
	<?php if ($this->_tpl_vars['succMessage']): ?><tr><td class="successMsg" align="center">&nbsp;<?php echo $this->_tpl_vars['succMessage']; ?>
</td></tr>
					<tr><td>&nbsp;</td></tr><?php endif; ?>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top">
		  <form name="frmBlog" action="<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
" method="post" ><table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
              <tr>
                <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                    <tr>
                      <td  align="left" valign="top"><h1>Blog Manager</h1></td>
					  <td width="176" align="right" class="boadytextwhite">Page Size:
					  <select name="page_size" onChange="JavaScript: document.frmBlog.submit();" id="select" class="drpdwn1" style="width:45px;">
                       <?php echo $this->_tpl_vars['PageSize_List']; ?>

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
                            <th width="45%" align="left">Title</th>
							<!--<th width="10%">Manage</th>-->
							<th width="10%">Status</th>
                            <th width="5%">Edit</th>
                            <th width="5%">Delete</th>
                          </tr>
                         <?php if (isset($this->_foreach['blogInfo'])) unset($this->_foreach['blogInfo']);
$this->_foreach['blogInfo']['name'] = 'blogInfo';
$this->_foreach['blogInfo']['total'] = count($_from = (array)$this->_tpl_vars['Options']);
$this->_foreach['blogInfo']['show'] = $this->_foreach['blogInfo']['total'] > 0;
if ($this->_foreach['blogInfo']['show']):
$this->_foreach['blogInfo']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['rec']):
        $this->_foreach['blogInfo']['iteration']++;
        $this->_foreach['blogInfo']['first'] = ($this->_foreach['blogInfo']['iteration'] == 1);
        $this->_foreach['blogInfo']['last']  = ($this->_foreach['blogInfo']['iteration'] == $this->_foreach['blogInfo']['total']);
?>
                          <tr class="<?php echo smarty_function_cycle(array('values' => 'odd, '), $this);?>
">
                            <td align="center"><input type="checkbox" name="lists[]" value="<?php echo $this->_tpl_vars['rec']->post_id; ?>
" /></td>
                            <td>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['rec']->title)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
</td>
							<!--<td align="center"><a href="blog_photos.php?post_id=<?php echo $this->_tpl_vars['rec']->post_id; ?>
" class="actionlink">Photos</a></td>-->
							<td align="center"> <?php if ($this->_tpl_vars['rec']->status == 1): ?>
                    Publish
                    <?php else: ?> <b>UnPublish</b> <?php endif; ?>
                    <?php if ($this->_tpl_vars['rec']->status == 1): ?>
                    (<a href="JavaScript: ToggleStatus_Click('<?php echo $this->_tpl_vars['rec']->post_id; ?>
', '0');" class="actionLink">UnPublish</a>)
                    <?php else: ?>
                    (<a href="JavaScript: ToggleStatus_Click('<?php echo $this->_tpl_vars['rec']->post_id; ?>
', '1');" class="actionLink">Publish</a>)
                    <?php endif; ?> </td>
                            <td align="center"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
icon-edit.gif" class="imgAction" title="Edit" onClick="JavaScript: Edit_Click('<?php echo $this->_tpl_vars['rec']->post_id; ?>
');"></td>
                            <td align="center"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: Delete_Click('<?php echo $this->_tpl_vars['rec']->post_id; ?>
');"></td>
                          </tr>
                          <?php endforeach; unset($_from); else: ?>
                          <tr>
                            <td colspan="5" class="boadytextblack" align="center">No Blog Post Available.</td>
                          </tr>
                          <?php endif; ?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td valign="top"><?php if ($this->_foreach['blogInfo']['total'] > 1): ?>
                  <table border="0" cellpadding="1" cellspacing="1" width="95%">
				<tr>
					<td class="boadytextblack">
						<img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
arrow_ltr.png"> 
						<a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], true);" onMouseMove="window.status='Check All';" onMouseOut="window.status='';" class="actionLink">Check All</a> / 
						<a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], false);" onMouseMove="window.status='Uncheck All';" onMouseOut="window.status='';" class="actionLink">Uncheck All</a>  &nbsp;&nbsp;
						With selected
						
						<img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: DeleteChecked_Click('<?php echo $this->_tpl_vars['cat_parent_id']; ?>
');">
					</td>
				</tr>
			</table>
                  <?php endif; ?>
				  <?php if ($this->_tpl_vars['Page_Link']): ?>
              <table border="0" cellpadding="2" cellspacing="2" width="95%">
                <tr>
                  <td align="right"> <?php echo $this->_tpl_vars['Page_Link']; ?>
 </td>
                </tr>
              </table>
              <?php endif; ?></td>
              </tr>
            </table>
			
             <input type="hidden" name="Action" />
   			 <input type="hidden" name="post_id" />
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