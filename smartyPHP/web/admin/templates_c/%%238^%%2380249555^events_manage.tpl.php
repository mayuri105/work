<?php /* Smarty version 2.6.0, created on 2017-02-09 13:42:39
         compiled from events_manage.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'events_manage.tpl', 55, false),array('modifier', 'stripslashes', 'events_manage.tpl', 57, false),)), $this); ?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"></td>
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
    <td height="30">
      <table width="100%" cellpadding="0" cellspacing="0" border="0" align="right">
        <tr>
          <td align="right"><a href="<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
?Action=Add" class="stdButton">ADD</a></td>
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
          <td align="left" valign="top"><form name="frmEvents" action="<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
" method="post">
              <table cellpadding="0" cellspacing="0" border="0" class="full-col" align="right" width="100%">
                <tr>
                  <td valign="top"><table cellpadding="0" cellspacing="0" border="0" class="tbl-title" width="100%">
                      <tr>
                        <td  align="left" valign="top"><h1>Events Manager</h1></td>
                        <td width="176" align="right" class="boadytextwhite">Page Size:
                          <select name="page_size" onChange="JavaScript: document.frmEvents.submit();" id="select" class="drpdwn1" style="width:45px;">
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
                              <th width="25%" align="left">Title</th>
                             <th width="10%">Status</th>
                              <th width="5%">Edit</th>
							  <th width="5%">Delete</th>
                            </tr>
                            <?php if (isset($this->_foreach['eventsInfo'])) unset($this->_foreach['eventsInfo']);
$this->_foreach['eventsInfo']['name'] = 'eventsInfo';
$this->_foreach['eventsInfo']['total'] = count($_from = (array)$this->_tpl_vars['Options']);
$this->_foreach['eventsInfo']['show'] = $this->_foreach['eventsInfo']['total'] > 0;
if ($this->_foreach['eventsInfo']['show']):
$this->_foreach['eventsInfo']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['Events']):
        $this->_foreach['eventsInfo']['iteration']++;
        $this->_foreach['eventsInfo']['first'] = ($this->_foreach['eventsInfo']['iteration'] == 1);
        $this->_foreach['eventsInfo']['last']  = ($this->_foreach['eventsInfo']['iteration'] == $this->_foreach['eventsInfo']['total']);
?>
                            <tr class="<?php echo smarty_function_cycle(array('values' => 'odd, '), $this);?>
">
                              <td align="center"><input type="checkbox" name="lists[]" value="<?php echo $this->_tpl_vars['Events']->event_id; ?>
" /></td>
                              <td>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['Events']->event_title)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
</td>
                              <td align="center"> <?php if ($this->_tpl_vars['Events']->status == 1): ?>
                                Publish
                                <?php else: ?> <b>UnPublish</b> <?php endif; ?>
                                <?php if ($this->_tpl_vars['Events']->status == 1): ?>
                                (<a href="JavaScript: ToggleStatus_Click('<?php echo $this->_tpl_vars['Events']->event_id; ?>
', '0');" class="actionLink">UnPublish</a>)
                                <?php else: ?>
                                (<a href="JavaScript: ToggleStatus_Click('<?php echo $this->_tpl_vars['Events']->event_id; ?>
', '1');" class="actionLink">Publish</a>)
                                <?php endif; ?> </td>
                              <td align="center">
							  <img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
icon-edit.gif" class="imgAction" title="Edit" onClick="JavaScript: Edit_Click('<?php echo $this->_tpl_vars['Events']->event_id; ?>
');"></td>
                              <td align="center">
							  <img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: Delete_Click('<?php echo $this->_tpl_vars['Events']->event_id; ?>
');">
							  </td>
                            </tr>
                            <?php endforeach; unset($_from); else: ?>
                            <tr>
                              <td colspan="5" class="boadytextblack" align="center">No Events Available.</td>
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
                  <td valign="top">
				  <?php if ($this->_foreach['eventsInfo']['total'] > 1): ?>
                    <table border="0" cellpadding="1" cellspacing="1" width="100%">
                      <tr>
                        <td class="boadytextblack">
							<img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
arrow_ltr.png">
							<a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], true);" onMouseMove="window.status='Check All';" onMouseOut="window.status='';" class="actionLink">Check All</a> / <a href="JavaScript: CheckUncheck_Click(document.all['lists[]'], false);" onMouseMove="window.status='Uncheck All';" onMouseOut="window.status='';" class="actionLink">Uncheck All</a> &nbsp;&nbsp;
                          With selected <img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: DeleteChecked_Click();">
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