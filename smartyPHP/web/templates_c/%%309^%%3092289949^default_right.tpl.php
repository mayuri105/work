<?php /* Smarty version 2.6.0, created on 2017-02-09 13:41:01
         compiled from default_right.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign', 'default_right.tpl', 20, false),array('modifier', 'explode', 'default_right.tpl', 20, false),array('modifier', 'date_format', 'default_right.tpl', 21, false),)), $this); ?>
<a href="<?php echo $this->_tpl_vars['Site_Root']; ?>
about-us.html" class="about-me"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
about-icon.png" alt="" /> About me</a>
<a href="#" class="blog-archive"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
calendar.png" alt="" /> Blog Archive</a>
<div class="clear"></div>
<ul class="archive-ul">
	<!--<li><a href="#" class="sel">2013 (23)</a>
		<ul>
			<li>
			<a href="#" class="sel-in">September (1) </a>
			<div class="clear"></div>
			<p>The 10th Anniversary of myFinancial Freedom Looms...</p>
			</li>
		</ul>
	</li>
	<li><a href="#">August (3)</a></li>
	<li><a href="#">July (19)</a></li>-->
	<?php if (isset($this->_foreach['blogYear'])) unset($this->_foreach['blogYear']);
$this->_foreach['blogYear']['name'] = 'blogYear';
$this->_foreach['blogYear']['total'] = count($_from = (array)$this->_tpl_vars['blogYear']);
$this->_foreach['blogYear']['show'] = $this->_foreach['blogYear']['total'] > 0;
if ($this->_foreach['blogYear']['show']):
$this->_foreach['blogYear']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['aYear']):
        $this->_foreach['blogYear']['iteration']++;
        $this->_foreach['blogYear']['first'] = ($this->_foreach['blogYear']['iteration'] == 1);
        $this->_foreach['blogYear']['last']  = ($this->_foreach['blogYear']['iteration'] == $this->_foreach['blogYear']['total']);
?>
		<li><a href="<?php echo $this->_tpl_vars['Site_Root']; ?>
blog/<?php echo $this->_tpl_vars['aYear']->YEAR; ?>
" class="sel-in"><?php echo $this->_tpl_vars['aYear']->YEAR; ?>
 (<?php echo $this->_tpl_vars['aYear']->TOTAL; ?>
)</a></li>
			<ul>
				<?php if (isset($this->_foreach['blogMonth'])) unset($this->_foreach['blogMonth']);
$this->_foreach['blogMonth']['name'] = 'blogMonth';
$this->_foreach['blogMonth']['total'] = count($_from = (array)$this->_tpl_vars['blogMonth']);
$this->_foreach['blogMonth']['show'] = $this->_foreach['blogMonth']['total'] > 0;
if ($this->_foreach['blogMonth']['show']):
$this->_foreach['blogMonth']['iteration'] = 0;
    foreach ($_from as $this->_tpl_vars['aMonth']):
        $this->_foreach['blogMonth']['iteration']++;
        $this->_foreach['blogMonth']['first'] = ($this->_foreach['blogMonth']['iteration'] == 1);
        $this->_foreach['blogMonth']['last']  = ($this->_foreach['blogMonth']['iteration'] == $this->_foreach['blogMonth']['total']);
?>
					<?php echo smarty_function_assign(array('var' => 'dateNub','value' => ((is_array($_tmp="-")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['aMonth']->post_date) : explode($_tmp, $this->_tpl_vars['aMonth']->post_date))), $this);?>

					<?php echo smarty_function_assign(array('var' => 'dateExplode','value' => ((is_array($_tmp=$this->_tpl_vars['aMonth']->post_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%B,%e,%Y') : smarty_modifier_date_format($_tmp, '%B,%e,%Y'))), $this);?>

					<?php echo smarty_function_assign(array('var' => 'MonthEx','value' => ((is_array($_tmp=",")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['dateExplode']) : explode($_tmp, $this->_tpl_vars['dateExplode']))), $this);?>
 
					<?php if ($this->_tpl_vars['aYear']->YEAR == $this->_tpl_vars['MonthEx'][2]): ?> 
						<li><a href="<?php echo $this->_tpl_vars['Site_Root']; ?>
blog/<?php echo $this->_tpl_vars['aYear']->YEAR; ?>
/<?php echo $this->_tpl_vars['dateNub'][1]; ?>
"><?php echo $this->_tpl_vars['MonthEx'][0]; ?>
 (<?php echo $this->_tpl_vars['aMonth']->TOTAL; ?>
)</a> </li>	
					<?php endif; ?>	
				<?php endforeach; unset($_from); endif; ?>	
			</ul>
	<?php endforeach; unset($_from); endif; ?>
</ul>
