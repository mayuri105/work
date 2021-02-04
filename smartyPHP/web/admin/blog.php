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
$_SESSION['start_record'] = isset($_GET['start']) ? $_GET['start'] : 0;
# Initialize object
$blog = new Blog();
$category = new Category();

#=============================================================================================================================
#								RESPONSE PROCESSING CODE
#-----------------------------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------------------------
#	Add page
#-----------------------------------------------------------------------------------------------------------------------------
if($Action == 'Add' && $_POST['Submit'] == 'Save')
{
	if(!empty($_FILES['blog_img']['name']))
	{
		$fname = fileUpload($_FILES['blog_img'],BLOG);
		$thumb->image($physical_path['Blog'].$fname);
		$thumb->size_fix(120,82);     // thumb_
		$filename = $thumb->get();
	}
	else
	{
		$fname	=	'';
	}
	
	$html_link = getUniqueCategoryLink(BLOG_POST,'title', 'post_id', 'html_link', addslashes(trim($_POST['title'])), 'add');
	
	$ret = $blog->Insert($_POST,$_SESSION['Admin_Name'],$html_link,$fname);
	header('location: blog.php?add=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Update Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Edit' && $_POST['Submit'] == 'Save')
{
	if(!empty($_FILES['blog_img']['name']))
	{
		@unlink($physical_path['Blog'].$_POST['hidden_blog_img']);
		@unlink($physical_path['Blog'].'thumb_'.$_POST['hidden_blog_img']);
		
		$fname = fileUpload($_FILES['blog_img'],BLOG);
		$thumb->image($physical_path['Blog'].$fname);
		$thumb->size_fix(120,82);     // thumb_
		$filename = $thumb->get();
	}
	else
	{
		$fname	=	$_POST['hidden_blog_img'];
	}
	
	$html_link = getUniqueCategoryLink(BLOG_POST,'title', 'post_id', 'html_link', addslashes(trim($_POST['title'])), 'edit', $_POST['post_id']);
	$ret = $blog->Update($_POST,$html_link,$fname);

	header('location: blog.php?edit=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Delete Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Delete' && $_POST['post_id'])
{
	$ret = $blog->Delete($_POST['post_id']);

	header('location: blog.php?delete=true');
	exit();
}
#=======================================================================================================================================
#	Delete Selected Action
#---------------------------------------------------------------------------------------------------------------------------------------
elseif($Action=='DeleteSelected')
{
	foreach($_POST['lists'] as $key=>$val)
	{
		$blog->Delete($val);
	}
	header('location: blog.php?delete=true');
	exit();
}

#=======================================================================================================================================
#	Change Status Action
#---------------------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'ChangeStatus')
{	
	$val=$blog->ToggleStatusBlog($_POST['post_id'],$_POST['status']);
	header("location: blog.php?edit=true");	
	exit();
}

#-----------------------------------------------------------------------------------------------------------------------------
#	Cancel
#-----------------------------------------------------------------------------------------------------------------------------
elseif($_POST['Submit'] == "Cancel")
{
	header('location: blog.php');
	exit();
}

#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------


#	Show page list

if($Action == '' || $Action == 'ShowAll')
{
	if($_GET['add']==true)
		$succMessage = "Blog content has been added successfully!!";
	elseif($_GET['edit']==true)
		$succMessage = "Blog content has been updated successfully!!";
	elseif($_GET['delete']==true)
		$succMessage = "Blog has been deleted successfully!!";

	$tpl->assign(array("T_Body"			=>	'blog_manage'. $config['tplEx'],
						"JavaScript"	=>  array("blog.js"),
						"succMessage"	=>	$succMessage,
						"Action"		=>	$Action,
						"Options"		=>	$blog->ViewAll(),
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
	$tpl->assign(array("T_Body"			=>	'blog_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("blog.js","calendarDateInput.js"),
						"post_date"		=>	date('Y-m-d'),
						"Action"		=>	$Action,
						));
						
	$category_list = $category->GetCategoryList();
	$category_list = fillDbCombo($category_list,'cat_id','cat_title','');

	$tpl->assign(array("Category_List"			=>	$category_list,
						));

	
}
elseif($Action == 'Edit')
{
	$tpl->assign(array("T_Body"			=>	'blog_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("blog.js","calendarDateInput.js"),
						"Action"		=>	$Action,
						"img_path"		=>	$virtual_path['Blog'],
						));

	$rsPage = $blog->getBlog($_POST['post_id']);

	$category_list = $category->GetCategoryList();
	$category_list = fillDbCombo($category_list,'cat_id','cat_title',$rsPage->cat_id);

	$tpl->assign(array("Category_List"			=>	$category_list,
						));
	
	$tpl->assign(array(	"post_id"				=>	$rsPage->post_id,
						"post_by"				=>	$rsPage->post_by,
						"title"					=>	stripslashes($rsPage->title),
						"status"				=>	($rsPage->status == 1 ? 'checked' : ''),
						"comment_status"		=>	($rsPage->comment_status == 1 ? 'checked' : ''),
						"comment_count"			=>	$rsPage->comment_count,
						"short_desc"			=>	stripslashes($rsPage->short_desc),
						"content"				=>	stripslashes($rsPage->content),
						"blog_img"				=>	$rsPage->blog_img,
						"post_date"				=>	$rsPage->post_date,
						));
						
	
	
}
$tpl->display('default_layout'. $config['tplEx']);
?>