<?php /* Smarty version 2.6.0, created on 2017-02-09 13:42:38
         compiled from video_manage.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'video_manage.tpl', 58, false),array('modifier', 'stripslashes', 'video_manage.tpl', 60, false),)), $this); ?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"></td>
  </tr>
  <tr>
    <td height="30"><table width="100%" cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td align="right">
		  	<a href="<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
?Action=Add" class="stdButton">ADD</a>&nbsp;&nbsp;
			<a href="Javascript: Order_Click()" class="stdButton">Manage Order</a>
		  </td>
        </tr>
        <tr>
          <td height="3"></td>
        </tr>
      </table></td>
  </tr>
  <?php if ($this->_tpl_vars['succMessage']): ?>
  <tr>
    <td class="successMsg" align="center">&nbsp;<?php echo $this->_tpl_vars['succMessage']; ?>
</td>
  </tr>
  <tr>
    <td class="successMsg" align="center">&nbsp;</td>
  </tr>
  <?php endif; ?>
  <tr>
    <td valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="left" valign="top"><form name="frmVideo" action="<?php echo $this->_tpl_vars['A_Action']; ?>
" method="post">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Video Manager</h1></td>
                        <td width="176" align="right" class="boadytextwhite">Page Size:
                          <select name="page_size" onChange="JavaScript: document.frmVideo.submit();" id="select" class="drpdwn1" style="width:45px;">
                            
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
                              <th width="4%"></th>
                              <th align="left">Title</th>
							  <th width="15%">Status</th>
                              <th width="5%">Edit</th>
                              <th width="5%">Delete</th>
                            </tr>
                            <?php if (isset($this->_foreach['videoInfo'])) unset($this->_foreach['videoInfo']);
$this->_foreach['videoInfo']['name'] = 'videoInfo';
$this->_foreach['videoInfo']['total'] = count($_from = (array)$this->_tpl_vars['Options']);
$this->_foreach['videoInfo']['show'] = $this->_foreach['videoInfo']['total'] > 0;
if ($this->_foreach['videoInfo']['show']):
$this->_foreach['videoInfo']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['Video']):
        $this->_foreach['videoInfo']['iteration']++;
        $this->_foreach['videoInfo']['first'] = ($this->_foreach['videoInfo']['iteration'] == 1);
        $this->_foreach['videoInfo']['last']  = ($this->_foreach['videoInfo']['iteration'] == $this->_foreach['videoInfo']['total']);
?>
                            <tr class="<?php echo smarty_function_cycle(array('values' => 'odd, '), $this);?>
">
                              <td align="center"><input type="checkbox" name="lists[]" value="<?php echo $this->_tpl_vars['Video']->video_id; ?>
" /></td>
                              <td>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['Video']->video_title)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
</td>
							  <td align="center"> <?php if ($this->_tpl_vars['Video']->status == 1): ?>
                                Publish
                                <?php else: ?> <b>UnPublish</b>
 <?php endif; ?>
                                <?php if ($this->_tpl_vars['Video']->status == 1): ?>
                                (<a href="JavaScript: ToggleStatus_Click('<?php echo $this->_tpl_vars['Video']->video_id; ?>
', '0');" class="actionLink">UnPublish</a>)
                                <?php else: ?>
                                (<a href="JavaScript: ToggleStatus_Click('<?php echo $this->_tpl_vars['Video']->video_id; ?>
', '1');" class="actionLink">Publish</a>)
                                <?php endif; ?> </td>
                              <td align="center"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
icon-edit.gif" class="imgAction" title="Edit" onClick="JavaScript: Edit_Click('<?php echo $this->_tpl_vars['Video']->video_id; ?>
');"></td>
                              <td align="center"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: Delete_Click('<?php echo $this->_tpl_vars['Video']->video_id; ?>
');"></td>
                            </tr>
                            <?php endforeach; unset($_from); else: ?>
                            <tr>
                              <td colspan="5" class="boadytextblack" align="center">No Video Available.</td>
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
                  <td valign="top"><?php if ($this->_foreach['videoInfo']['total'] > 1): ?>
                    <table border="0" cellpadding="1" cellspacing="1" width="98%">
                      <tr>
                        <td class="boadytextblack"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
arrow_ltr.png"> <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], true);" onMouseMove="window.status='Check All';" onMouseOut="window.status='';" class="actionLink">Check All</a> / <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], false);" onMouseMove="window.status='Uncheck All';" onMouseOut="window.status='';" class="actionLink">Uncheck All</a> &nbsp;&nbsp;
                          With selected <img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: DeleteChecked_Click('<?php echo $this->_tpl_vars['cat_parent_id']; ?>
');"> </td>
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
              <input type="hidden" name="Action">
              <input type="hidden" name="video_id">
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