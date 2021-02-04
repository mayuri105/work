<?php

#====================================================================================================
#	File Name		:	siteconfig.php
#----------------------------------------------------------------------------------------------------
#	Include required files
#----------------------------------------------------------------------------------------------------

define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

include_once("../includes/common.php");
#=======================================================================================================================================
#								RESPONSE PROCESSING CODE
#---------------------------------------------------------------------------------------------------------------------------------------

#-----------------------------------------------------------------------------------------------------------------------------

#	Update Config information

#-----------------------------------------------------------------------------------------------------------------------------

if($_POST['Submit'] == "Update")

{
	$webConf->Set(WC_SITE_TITLE, 			$_POST[WC_SITE_TITLE]);
	$webConf->Set(WC_SITE_KEYWORD, 			$_POST[WC_SITE_KEYWORD]);
	$webConf->Set(WC_SITE_DESCRIPTION, 		$_POST[WC_SITE_DESCRIPTION]);
	$webConf->Set(WC_CONTACT_DETAIL, 		$_POST[WC_CONTACT_DETAIL]);
	$webConf->Set(WC_COPYRIGHT_TEXT, 		$_POST[WC_COPYRIGHT_TEXT]);
	$webConf->Set(WC_FOOTER_TEXT, 			$_POST[WC_FOOTER_TEXT]);

	header('location: siteconfig.php?update=true');
	exit();

}

#-----------------------------------------------------------------------------------------------------------------------------
#	Cancel
#-----------------------------------------------------------------------------------------------------------------------------
else if($_POST['Submit'] == "Cancel")
{
	header('location: index.php');
	exit();
}
#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------
if($_GET['update']==true)
{
	$succMessage = "Site configuration has been updated successfully!!";
}

$tpl->assign(array("T_Body"			=>	'siteconfig'. $config['tplEx'],
					"JavaScript"	=>  array("siteconfig.js"),
					"A_Action"		=>	"siteconfig.php",
					"succMessage"	=>	$succMessage,
					));


$tpl->assign(array( WC_SITE_TITLE 		=> 	$config[WC_SITE_TITLE],
					WC_SITE_KEYWORD 	=> 	$config[WC_SITE_KEYWORD],
					WC_SITE_DESCRIPTION => 	$config[WC_SITE_DESCRIPTION],
					WC_CONTACT_DETAIL 	=> 	$config[WC_CONTACT_DETAIL],
					WC_COPYRIGHT_TEXT 	=> 	$config[WC_COPYRIGHT_TEXT],
					WC_FOOTER_TEXT 		=> 	$config[WC_FOOTER_TEXT],
					
			));

$tpl->display('default_layout'. $config['tplEx']);

?>