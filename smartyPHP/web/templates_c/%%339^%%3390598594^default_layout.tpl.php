<?php /* Smarty version 2.6.0, created on 2017-02-09 15:44:30
         compiled from default_layout.tpl */ ?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alphabet Success ::  Home</title>

<!--Css
============================================================-->
<link href="<?php echo $this->_tpl_vars['Templates_CSS']; ?>
reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['Templates_CSS']; ?>
style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['Templates_CSS']; ?>
developer.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['Templates_CSS']; ?>
media-query.css" rel="stylesheet" type="text/css" />

<!--Google-Fonts
============================================================-->
<link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans' rel='stylesheet' type='text/css'>
<!--font-family: 'Quattrocento Sans', sans-serif;-->
<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,700,800,600' rel='stylesheet' type='text/css'>
<!--font-family: 'Raleway', sans-serif;-->
<link href="<?php echo $this->_tpl_vars['Templates_CSS']; ?>
bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->_tpl_vars['Templates_Image']; ?>
favicon.ico" rel="shortcut icon" type="image/x-icon" />

<!-- Js-menu
====================================================== -->
<!--<script type="text/javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
bootstrap.min.js"></script>-->
<script src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
jquery.js"></script>
<script src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
bootstrap-dropdown.js"></script>
<script src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
bootstrap-collapse.js"></script> 
<script src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
validate.js"></script>
<?php echo '
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5292dd9860dfa741"></script>
'; ?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="<?php echo $this->_tpl_vars['Templates_JS']; ?>
respond.min.js"></script>
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
<body>
<div class="main-page">
	<header>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['T_Header']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</header>
    <div class="clear"></div>
    <div class="page-container">
    	<div class="author-section">
        	<div class="author-img-main">
            	<div class="authur-img"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
author.jpg" alt="" /></div>
                <div class="img-shade"><img src="<?php echo $this->_tpl_vars['Templates_Image']; ?>
shade-btm-img.png" alt="" /></div>
                <div class="author-name">Tim Fargo - Author</div>
            </div>
            <div class="author-discription">
            	<h1>Alphabet <span>Success</span></h1>
                <div class="clear"></div>
                <p><strong>Alphabet Success</strong>  - Keeping it Simple. The essence of a journey Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,</p>
                <div class="clear"></div>
                <div class="comunity-col">
                	<h3>Follow me</h3>
                	<a href="#" class="fb" target="_blank"></a>
                    <a href="#" class="gplus" target="_blank"></a>
                    <a href="#" class="twitt" target="_blank"></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
            <div class="contain-hm-main">
            	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['T_Body']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
				<?php if ($this->_tpl_vars['isIndex'] == 1): ?>
					<div class="contend-hm-in-side-r">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['T_Right']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				<?php else: ?>
					<div class="side-right"><img src="<?php echo $this->_tpl_vars['img_path'];  echo $this->_tpl_vars['image']; ?>
" alt="" /></div>
				<?php endif; ?>
            </div>
    </div>
</div>
</body>
</html>