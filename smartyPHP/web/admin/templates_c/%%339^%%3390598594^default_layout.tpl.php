<?php /* Smarty version 2.6.0, created on 2017-02-09 13:42:54
         compiled from default_layout.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['Site_Title']; ?>
 :: Admin Login</title>
<meta name="keywords" content="<?php echo $this->_tpl_vars['Meta_Keyword']; ?>
"/>
<meta name="description" content="<?php echo $this->_tpl_vars['Meta_Description']; ?>
"/>
	
	<link href="<?php echo $this->_tpl_vars['Templates_CSS']; ?>
style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['Templates_CSS']; ?>
ddsmoothmenu.css" />
	<script language="javascript" type="text/javascript">
		var img_path = '<?php echo $this->_tpl_vars['Templates_Image']; ?>
';
		var site_root = '<?php echo $this->_tpl_vars['Site_Root']; ?>
';
		var current_page = '<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
';
		var Site_Root_Front = '<?php echo $this->_tpl_vars['Site_Root_Front']; ?>
';
	</script>
	
	<script language="javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
validate.js"></script>
	<script language="javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
functions.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
jquery.min.js"></script>
	<script language="javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
ddsmoothmenu.js"></script>
	
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
	
<script type="text/javascript">
	ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
</script>

<!--<script type="text/javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
jquery-ui-1.7.1.custom.min.js"></script>

<script type="text/javascript">
  // When the document is ready set up our sortable with it's inherant function(s)
  $(document).ready(function() {
    $("#test-list").sortable({
      handle : '.handle',
      update : function () {
		  var order = $('#test-list').sortable('serialize');
		 url	=	"<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
?"+order+"&Action=Order";
		
  		$("#info").load(url);
      }
    });
});
</script>-->

<!--<script language="javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
jquery-1.7.1.min.js"></script>
<script language="javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
interface-1.2.js"></script>
<script language="javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
inestedsortable.js"></script>
-->
<!--<script type="text/javascript">
jQuery( function($) {

$('#test-list').NestedSortable(
	{
		accept: 'page-item1',
		noNestingClass: "no-nesting",
		opacity: 0.8,
		helperclass: 'helper',
		onChange: function(serialized) {
		alert(serialized[0].hash);
		url	=	"<?php echo $GLOBALS['HTTP_SERVER_VARS']['PHP_SELF']; ?>
?"+serialized[0].hash+"&Action=Order";
		
  		$("#info").load(url);
			/*$('#info')
			.html("This can be passed as parameter to a GET or POST request: <br/>" + serialized[0].hash);*/
		},
		autoScroll: true,
		handle: '.sort-handle'
	}
);
	
});
</script>-->
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr style="background-color:#2250A5;">
    <td valign="top" id="header"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['T_Header']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
	</tr>
  <?php if ($this->_tpl_vars['Admin_Id']): ?>
  <tr>
    <td class="menubg" valign="top">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['T_Menu']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
  </tr>
  <?php endif; ?>
  <tr>
    <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['T_Body']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
  </tr>
</table>
</body>
</html>