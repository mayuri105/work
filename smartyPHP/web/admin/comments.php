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
include($physical_path['DB_Access']. 'Blog.php');

#=======================================================================================================================================
# Define the action
#---------------------------------------------------------------------------------------------------------------------------------------
$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ShowAll');
$type = isset($_GET['type']) ? $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : 'all');
$_SESSION['start_record'] = isset($_GET['start']) ? $_GET['start'] : 0;
# Initialize object
$blog = new Blog();
$category = new Category();

#=======================================================================================================================================
#								RESPONSE PROCESSING CODE
#---------------------------------------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------------------------
#	Add page
#-----------------------------------------------------------------------------------------------------------------------------
if($Action == 'Add' && $_POST['Submit'] == 'Save')
{
	$ret = $blog->Insert($_POST,$_SESSION['Admin_Name']);
	header('location: blog.php?add=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Update Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Edit' && $_POST['Submit'] == 'Save')
{
	$ret = $blog->UpdateComment($_POST);
	header("location: comments.php?type=".$type."&edit=true");
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Delete Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Delete' && $_POST['id'])
{
	$ret = $blog->DeleteComment($_POST['id']);

	header("location: comments.php?type=".$type."&delete=true");
	exit();
}
#=======================================================================================================================================
#	Delete Selected Action
#---------------------------------------------------------------------------------------------------------------------------------------
elseif($Action=='DeleteSelected')
{
	foreach($_POST['lists'] as $key=>$val)
	{

		$blog->DeleteComment($val);
	}
	header("location: comments.php?type=".$type."&delete=true");
	exit();
}

#=======================================================================================================================================
#	Change Status Action
#---------------------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'ChangeStatus')
{	
	$val=$blog->ToggleStatusComment($_POST['id'],$_POST['status']);
	header("location: comments.php?type=".$type."&edit=true");
	exit();
}

#-----------------------------------------------------------------------------------------------------------------------------
#	Cancel
#-----------------------------------------------------------------------------------------------------------------------------
elseif($_POST['Submit'] == "Cancel")
{
	header("location: comments.php?type=".$type);
	exit();
}

#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------


#	Show page list

if($Action == '' || $Action == 'ShowAll')
{
	if($_GET['edit']==true)
		$succMessage = "Comment content has been updated successfully!!";
	elseif($_GET['delete']==true)
		$succMessage = "Comment has been deleted successfully!!";

	$tpl->assign(array("T_Body"			=>	'blog_comment_manage'. $config['tplEx'],
						"JavaScript"	=>  array("blog_comment.js"),
						"succMessage"	=>	$succMessage,
						"type"			=>	$type,
						"Action"		=>	$Action,
						"Count_Unapproved" =>	$blog->CountUnApprovedComments(),
						"Options"		=>	$blog->ViewAllComments($type),
						"PageSize_List"	 =>	fillArrayCombo($lang['PageSize_List'], $_SESSION['page_size']),						
						));
	if($_SESSION['total_record'] > $_SESSION['page_size'])
	{
		$tpl->assign(array('Page_Link' =>	showPagination($_SESSION['total_record'])
						));
	}
}

#	Add/Edit Page
elseif($Action == 'Edit')
{
	$tpl->assign(array("T_Body"			=>	'blog_comment_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("blog_comment.js","calendarDateInput.js"),
						"Action"		=>	$Action,
						"type"			=>	$type,
						));

	$rsPage = $blog->getBlogComments($_POST['id']);

	$tpl->assign(array(	"id"					=>	$rsPage->id,
						"comment_by"			=>	$rsPage->comment_by,
						"comment_email"			=>	$rsPage->comment_email,
						"comment"				=>	$rsPage->comment,
						"status"				=>	($rsPage->status == 1 ? 'checked' : ''),
						"post_date"				=>	$rsPage->comment_date,
						));

}

$tpl->display('default_layout'. $config['tplEx']);
?>