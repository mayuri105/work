<?php
#====================================================================================================
#	Include required files
#----------------------------------------------------------------------------------------------------
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

if($_GET['Action'] == 'View')
	define('POPUP_WIN', 	true);

include_once("../includes/common.php");
include($physical_path['DB_Access']. 'Page.php');

#=======================================================================================================================================
# Define the action
#---------------------------------------------------------------------------------------------------------------------------------------
$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ShowAll');
$pid = isset($_GET['page_id']) ? $_GET['page_id'] : (isset($_POST['page_id']) ? $_POST['page_id'] : $_POST['page_id']);
$_SESSION['start_record'] = isset($_GET['start']) ? $_GET['start'] : 0;
# Initialize object
$page = new Page();

#=======================================================================================================================================
#								RESPONSE PROCESSING CODE
#---------------------------------------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------------------------
#	Add page
#-----------------------------------------------------------------------------------------------------------------------------
if($Action == 'Add' && ($_POST['Submit'] == 'Save' || $_POST['Submit'] == 'Preview'))
{
	$html_link = getUniqueCategoryLink(PAGE_MASTER,'page_title', 'page_id', 'page_link', trim($_POST['page_title']), 'add');
	
	$image = fileUpload($_FILES['image'],PAGE); 
	
	/*if(in_array("0",$flag))
	{
		header('location: page.php?Action=Add');
		exit();
	}
	else
	{*/
		$ret = $page->Insert($_POST,$html_link,$image);
		WriteLinkInHtaccess($html_link,"page.php?pid=".$ret);
		header('location: page.php?add=true');
	//}
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Update Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Edit' && $_POST['Submit'] == 'Save')
{
	if(!empty($_FILES['image']['name']))
	{
		@unlink($physical_path['Page'].$_POST['hidden_image']);  
		$image = fileUpload($_FILES['image'],PAGE);
	}	
	else
	{
		$image = $_POST['hidden_image'];
	}	
	$html_link = getUniqueCategoryLink(PAGE_MASTER,'page_title', 'page_id', 'page_link', trim($_POST['page_title']), 'edit', $_POST['page_id']);	

	$file_link = $_POST['page_link'];
	DeleteLinkInHtaccess($file_link,'page.php?pid='.$_POST['page_id']);
	
	$ret = $page->Update($_POST,$html_link,$image);
	WriteLinkInHtaccess($html_link,"page.php?pid=".$_POST['page_id']);
	
	header('location: page.php?edit=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Delete Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Delete' && $_POST['page_id'])
{
	$ret = $page->Delete($_POST['page_id']);

	header('location: page.php?delete=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Delete Selected Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'DeleteSelected')
{
//print_r ($_POST['city']);
	foreach($_POST['lists'] as $key=>$val)
	{
			$ret = $page->Delete($val);
	}
	header('location: page.php?&delete=true');
	exit();
}
#=======================================================================================================================================
#	Change Status Action
#---------------------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'ChangeStatus')
{	
	$val=$page->ToggleStatus($_POST['page_id'],$_POST['status']);
	header("location: page.php?edit=true");	
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Cancel
#-----------------------------------------------------------------------------------------------------------------------------
elseif($_POST['Submit'] == "Cancel")
{
	header('location: page.php');
	exit();
}

#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------


#	Show page list
if(!in_array($Action, array('Add', 'Edit', 'Sort', 'View')))
{
	if($_GET['add']==true)
		$succMessage = "You have successfully created a new page.";
	elseif($_GET['edit']==true)
		$succMessage = "You have successfully updated a page.";
	elseif($_GET['delete']==true)
		$succMessage = "You have successfully deleted a page.";
	elseif($_GET['preview']==true)
		$succMessage = "Page Preview has been updated successfully.";	

	if($_POST['Search'] == 'Search')
	{	
		$_SESSION['search_page_title'] = trim($_POST['search_page_title']);
	}
	else if($_POST['ShowAll'] == 'Show All')
	{	
		unset($_SESSION['search_page_title']);
	}
	
	$tpl->assign(array("T_Body"			=>	'page_manage'. $config['tplEx'],
						"JavaScript"	=>  array("page.js"),
						"succMessage"	=>	$succMessage,
						"Action"		=>	$Action,
						"Options"		=>	$page->ViewAll(),
						"search_page_title"	=>	$_SESSION['search_page_title'],
						"img_path"		=>	$virtual_path['Page'],
						"PageSize_List"	=>	fillArrayCombo($lang['PageSize_List'], $_SESSION['page_size']),
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
	$tpl->assign(array("T_Body"			=>	'page_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("page.js"),
						"Action"		=>	$Action,
						));
}
elseif($Action == 'Edit')
{
	$tpl->assign(array("T_Body"			=>	'page_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("page.js"),
						"Action"		=>	$Action,
						"img_path"		=>	$virtual_path['Page'],
						));

	$rsPage = $page->getPage($pid);

	$tpl->assign(array(	"page_id"				=>	$rsPage->page_id,
						"page_title"			=>	$rsPage->page_title,
						"page_content"			=>	stripslashes($rsPage->page_content),
						"meta_title"			=>	stripslashes($rsPage->meta_title),
						"meta_keyword"			=>	stripslashes($rsPage->meta_keyword),
						"meta_description"		=>	stripslashes($rsPage->meta_description),
						"canonical_tag"			=>	stripslashes($rsPage->canonical_tag),
						"redirect"				=>	stripslashes($rsPage->redirect),
						"checked"				=>	($rsPage->status==1)?"checked":'',
						"page_link"				=>	$rsPage->page_link,
						"image"				=>	$rsPage->image,
						"img_path"		=>	$virtual_path['Page'],
						));
}
$tpl->display('default_layout'. $config['tplEx']);
?>
