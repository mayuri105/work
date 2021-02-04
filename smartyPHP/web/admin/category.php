<?php
#====================================================================================================
#	Include required files
#----------------------------------------------------------------------------------------------------
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

if($_GET['Action'] == 'View')
	define('POPUP_WIN', 	true);

include_once("../includes/common.php");
include($physical_path['DB_Access']. 'Category.php');

#=======================================================================================================================================
# Define the action
#---------------------------------------------------------------------------------------------------------------------------------------
$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ShowAll');
$_SESSION['start_record'] = isset($_GET['start']) ? $_GET['start'] : 0;
# Initialize object
$category = new Category();

#=======================================================================================================================================
#								RESPONSE PROCESSING CODE
#---------------------------------------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------------------------
#	Add page
#-----------------------------------------------------------------------------------------------------------------------------
if($Action == 'Add' && $_POST['Submit'] == 'Save')
{
	$html_link = getUniqueCategoryLink(CATEGORY_MASTER,'cat_title', 'cat_id', 'html_link', trim($_POST['cat_title']), 'add');
	
	$ret = $category->Insert($_POST,$_SESSION['Admin_Name'],$html_link);
	header('location: category.php?add=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Update Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Edit' && $_POST['Submit'] == 'Save')
{
	$html_link = getUniqueCategoryLink(CATEGORY_MASTER,'cat_title', 'cat_id', 'html_link', trim($_POST['cat_title']), 'edit', $_POST['cat_id']);	
	$ret = $category->Update($_POST,$html_link);
	header('location: category.php?edit=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Delete Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Delete' && $_POST['cat_id'])
{
	$ret = $category->Delete($_POST['cat_id']);

	header('location: category.php?delete=true');
	exit();
}
#=======================================================================================================================================
#	Delete Selected Action
#---------------------------------------------------------------------------------------------------------------------------------------
elseif($Action=='DeleteSelected')
{
	foreach($_POST['lists'] as $key=>$val)
	{
		$category->Delete($val);
	}
	header('location: category.php?delete=true');
	exit();
}

#-----------------------------------------------------------------------------------------------------------------------------
#	Cancel
#-----------------------------------------------------------------------------------------------------------------------------
elseif($_POST['Submit'] == "Cancel")
{
	header('location: category.php');
	exit();
}

#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------


#	Show page list

if($Action == '' || $Action == 'ShowAll')
{
	if($_GET['add']==true)
		$succMessage = "Category content has been added successfully!!";
	elseif($_GET['edit']==true)
		$succMessage = "Category content has been updated successfully!!";
	elseif($_GET['delete']==true)
		$succMessage = "Category has been deleted successfully!!";

	$tpl->assign(array("T_Body"			=>	'category_manage'. $config['tplEx'],
						"JavaScript"	=>  array("category.js"),
						"succMessage"	=>	$succMessage,
						"Action"		=>	$Action,
						"Options"		=>	$category->ViewAll(),
						"PageSize_List"	 =>	fillArrayCombo($lang['PageSize_List'], $_SESSION['page_size']),						
						));
	if($_SESSION['total_record'] > $_SESSION['page_size'])
	{
		$tpl->assign(array('Page_Link' =>	showPagination($_SESSION['total_record'])
						));
	}
}

#	Add/Edit Page

elseif($Action == 'Add')
{
	$tpl->assign(array("T_Body"			=>	'category_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("category.js"),
						"Action"		=>	$Action,
						));
}
elseif($Action == 'Edit')
{
	$tpl->assign(array("T_Body"			=>	'category_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("category.js"),
						"Action"		=>	$Action,
						));
	$rsPage = $category->getCategory($_POST['cat_id']);
	
	$tpl->assign(array(	"cat_id"				=>	$rsPage->cat_id,
						"cat_title"				=>	$rsPage->cat_title,						
						));
	
}
$tpl->display('default_layout'. $config['tplEx']);
?>