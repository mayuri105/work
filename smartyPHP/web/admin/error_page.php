<?php
#====================================================================================================
#	Include required files
#----------------------------------------------------------------------------------------------------
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

if($_GET['Action'] == 'View')
	define('POPUP_WIN', 	true);

include_once("../includes/common.php");
include($physical_path['DB_Access']. 'ErrorPage.php');
#=======================================================================================================================================
# Define the action
#---------------------------------------------------------------------------------------------------------------------------------------
$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ShowAll');
$_SESSION['start_record'] = isset($_GET['start']) ? $_GET['start'] : 0;
# Initialize object
$errorPage = new ErrorPage();

#=======================================================================================================================================
#								RESPONSE PROCESSING CODE
#---------------------------------------------------------------------------------------------------------------------------------------

#-----------------------------------------------------------------------------------------------------------------------------
#	Update Content
#-----------------------------------------------------------------------------------------------------------------------------
if($_POST['Submit'] == 'Save')
{
	$ret = $errorPage->Update($_POST);
	header('location: error_page.php?edit=true');
	exit();
}


#-----------------------------------------------------------------------------------------------------------------------------
#	Cancel
#-----------------------------------------------------------------------------------------------------------------------------
elseif($_POST['Submit'] == "Cancel")
{
	header('location: error_page.php');
	exit();
}

#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------


#	Show page list

if($Action == '' || $Action == 'ShowAll')
{
	
	if($_GET['edit']==true)
		$succMessage = "Error Page content has been updated successfully!!";
	

	
	$tpl->assign(array("T_Body"			=>	'error_page'. $config['tplEx'],
						//"JavaScript"		=>  array("ErrorPage.js"),
						"succMessage"	=>	$succMessage,
						"Action"		=>	$Action,
						));
	
	$rsPage = $errorPage->getErrorPage('1');

	$tpl->assign(array(	"error_page_id"		=>	$rsPage->error_page_id,
						"error_page_content"=>	stripslashes($rsPage->error_page_content),
						));					
					
}

$tpl->display('default_layout'. $config['tplEx']);
?>
