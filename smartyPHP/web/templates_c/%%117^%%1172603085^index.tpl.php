<?php /* Smarty version 2.6.0, created on 2017-02-09 13:41:01
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 11, false),)), $this); ?>
<div class="contend-hm-in">
	<?php if (isset($this->_sections['rec'])) unset($this->_sections['rec']);
$this->_sections['rec']['loop'] = is_array($_loop=$this->_tpl_vars['Loop_Blog']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rec']['name'] = 'rec';
$this->_sections['rec']['show'] = true;
$this->_sections['rec']['max'] = $this->_sections['rec']['loop'];
$this->_sections['rec']['step'] = 1;
$this->_sections['rec']['start'] = $this->_sections['rec']['step'] > 0 ? 0 : $this->_sections['rec']['loop']-1;
if ($this->_sections['rec']['show']) {
    $this->_sections['rec']['total'] = $this->_sections['rec']['loop'];
    if ($this->_sections['rec']['total'] == 0)
        $this->_sections['rec']['show'] = false;
} else
    $this->_sections['rec']['total'] = 0;
if ($this->_sections['rec']['show']):

            for ($this->_sections['rec']['index'] = $this->_sections['rec']['start'], $this->_sections['rec']['iteration'] = 1;
                 $this->_sections['rec']['iteration'] <= $this->_sections['rec']['total'];
                 $this->_sections['rec']['index'] += $this->_sections['rec']['step'], $this->_sections['rec']['iteration']++):
$this->_sections['rec']['rownum'] = $this->_sections['rec']['iteration'];
$this->_sections['rec']['index_prev'] = $this->_sections['rec']['index'] - $this->_sections['rec']['step'];
$this->_sections['rec']['index_next'] = $this->_sections['rec']['index'] + $this->_sections['rec']['step'];
$this->_sections['rec']['first']      = ($this->_sections['rec']['iteration'] == 1);
$this->_sections['rec']['last']       = ($this->_sections['rec']['iteration'] == $this->_sections['rec']['total']);
?>
		<div class="contend-hm-in-row">
			<h1><?php echo $this->_tpl_vars['title'][$this->_sections['rec']['index']]; ?>
</h1>
			<div class="contain-left-hm-in">
				<p><?php echo $this->_tpl_vars['short_desc'][$this->_sections['rec']['index']]; ?>
</p> 
				<div class="clear"></div>
				<a href="<?php echo $this->_tpl_vars['Site_Root']; ?>
blog/<?php echo $this->_tpl_vars['html_link'][$this->_sections['rec']['index']]; ?>
.html" class="redmore">Readmore</a> 
			</div>
			<div class="plugin-comunty">
				<p><?php echo ((is_array($_tmp=$this->_tpl_vars['post_date'][$this->_sections['rec']['index']])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<br /> Opinion <br /><?php echo $this->_tpl_vars['comment_count'][$this->_sections['rec']['index']]; ?>
 Comments</p>
				<div class="clear"></div>
				<!--
				<a href="#" target="_blank"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
twitter-in.png" alt="" /></a>
				<a href="#" target="_blank"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
linkedin-in.png" alt="" /></a>
				<a href="#" target="_blank"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
y-tube.png" alt="" /></a>
				<a href="#" target="_blank"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
f-book.png" alt="" /></a>
				<a href="#" target="_blank"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
gplus-in.png" alt="" /></a>-->
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_16x16_style">
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_linkedin"></a>
					<a class="addthis_button_twitter"></a>
					<a class="addthis_button_google_plusone_share"></a>
				</div> 
				<!-- AddThis Button END -->				
			</div>
		</div>
	<?php endfor; endif; ?>  
</div> 
 