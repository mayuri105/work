<?php
#====================================================================================================
#	Include required files
#----------------------------------------------------------------------------------------------------
define('IN_SITE', 	true);
include_once("includes/common.php");
include($physical_path['DB_Access']. 'ErrorPage.php');

# Initialize object
$errorPage = new ErrorPage();

	$rsPage = $errorPage->getErrorPage('1');

	$tpl->assign(array(	"T_Body"			=>	'404'. $config['tplEx'],
						"error_page_id"		=>	$rsPage->error_page_id,
						"error_page_content"=>	stripslashes($rsPage->error_page_content),
						"error_page"		=>	1,
						));					
					

$tpl->display('default_layout'. $config['tplEx']);
?>
