<?php
define('IN_SITE', 	true);
include_once("includes/common.php");
include_once($physical_path['DB_Access']. 'Page.php');
$page = new Page();
$rsPage = $page->getPage(isset($_GET['pid']) ? $_GET['pid'] : (isset($_POST['pid']) ? $_POST['pid'] : 1));
	
$tpl->assign(array(	"T_Body"		=>	'page'. $config['tplEx'],
					"JavaScript"	=>  array(""),
					"selected"      => $filename['url'], 
					"page_id"		=>	$rsPage->page_id,
					"page_title"	=>	stripslashes($rsPage->page_title),
					"page_content"	=>	stripslashes($rsPage->page_content),
					"Site_Title"		=>	($rsPage->meta_title!=''?$rsPage->meta_title:$config[WC_SITE_TITLE]),
					"Meta_Keyword"		=>	($rsPage->meta_keyword!=''?$rsPage->meta_keyword:$config[WC_SITE_KEYWORD]),
					"Meta_Description"	=>	($rsPage->meta_description!=''?$rsPage->meta_description:$config[site_description]),
					"image"				=>	$rsPage->image,
					"img_path"		=>	$virtual_path['Page'],
			));
			
$tpl->display('default_layout'. $config['tplEx']);
?>
