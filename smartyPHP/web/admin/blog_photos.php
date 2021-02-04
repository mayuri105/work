<?php
#====================================================================================================
#	Include required files
#----------------------------------------------------------------------------------------------------
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

include_once("../includes/common.php");
include_once("../libs/resize-class.php");
include($physical_path['DB_Access']. 'Blog.php');
#=======================================================================================================================================
# Define the action
#---------------------------------------------------------------------------------------------------------------------------------------
$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ShowAll');
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : (isset($_POST['post_id']) ? $_POST['post_id'] : $_GET['post_id']);

# Initialize object
$blog = new Blog();
$get_title = $blog->getBlog($post_id);

$tpl->assign(array("catDetail"		=>	$blog->getBlog($post_id),
					"img_path"		=>	$virtual_path['Blog'],
 				));
			//print_r ($_POST);die;
#=======================================================================================================================================
#								RESPONSE PROCESSING CODE
#---------------------------------------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------------------------
#	Add page
#-----------------------------------------------------------------------------------------------------------------------------
if($Action == 'Add' && $_POST['Submit'] == 'Save')
{
	
	if(!empty($_FILES['photo']['name']))
	{
		$fname = fileUpload($_FILES['photo'],BLOG);
		
		list($width, $height, $type, $attr) = getimagesize($physical_path['Blog'].$fname);

		if(($width < 584) && ($height < 433))
		{
			$thumb->image($physical_path['Blog'].$fname);
			$thumb->size_fix($width,$height);     // medium_thumb_
			$filename = $thumb->get1();
		}
		else
		{
			$thumb->image($physical_path['Blog'].$fname);
			$thumb->size_fix(584,433);     // medium_thumb_
			$filename = $thumb->get1();
		}
		
		//$thumb->image($physical_path['Blog'].$fname);
		//$thumb->size_fix(131,84);     // small_thumb_
		//$filename = $thumb->get2();
		$resizeObj = new resize($physical_path['Blog'].$fname);
		$resizeObj -> resizeImage(131, 84, 'crop');
		$resizeObj -> saveImage($physical_path['Blog'].'small_thumb_'.$fname, 100);
	}
	else
	{
		$fname	=	'';
	}
	$ret = $blog->InsertPhoto($_POST,$fname);
	header('location: blog_photos.php?add=true&post_id='.$post_id);
	exit();
}

#-----------------------------------------------------------------------------------------------------------------------------
#	Delete Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Delete' && $_POST['photo_id'])
{
	$ret = $blog->DeletePhoto($_POST['photo_id']);

	header('location: blog_photos.php?delete=true&post_id='.$post_id);
	exit();
}
#=======================================================================================================================================
#	Delete Selected Action
#---------------------------------------------------------------------------------------------------------------------------------------
elseif($Action=='DeleteSelected')
{
	foreach($_POST['lists'] as $key=>$val)
	{
		$blog->DeletePhoto($val);
	}
	header('location: blog_photos.php?delete=true&post_id='.$post_id);
	exit();
}
elseif($_POST['Action'] == 'Order' && $_POST['display_order'])
{
	$display_order = split(":", $_POST['display_order']);
	//print_r ($display_order);die;
	for($i=0; $i<count($display_order); $i++)
	{
		$blog->DisplayOrder_Photo($display_order[$i], $i);
	}
	header("location: blog_photos.php?order=true&post_id=".$post_id);
	exit;
}

#-----------------------------------------------------------------------------------------------------------------------------
#	Cancel
#-----------------------------------------------------------------------------------------------------------------------------
elseif($_POST['Submit'] == "Cancel")
{
	header('location: blog_photos.php?post_id='.$post_id);
	exit();
}

#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------


#	Show page list

if($Action == '' || $Action == 'ShowAll')
{
	if($_GET['add']==true)
		$succMessage = "Photo has been added successfully.";
	elseif($_GET['edit']==true)
		$succMessage = "Photo has been updated successfully.";
	elseif($_GET['delete']==true)
		$succMessage = "Photo has been deleted successfully.";
	elseif($_GET['order']==true)
		$succMessage = "Photos have been ordered successfully.";

	$actionLink = 'blog_photos.php';
	if($post_id)
	{
		$actionLink .= '?post_id='.$post_id;
	}
	
	$tpl->assign(array("T_Body"			=>	'blog_photos_manage'. $config['tplEx'],
						"JavaScript"	=>  array("blog_photos.js"),
						"succMessage"	=>	$succMessage,
						"A_Action"		=>  $actionLink,
						"Action"		=>	$Action,
						"post_id"	=>	$post_id,
						"img_path"		=>	$virtual_path["Blog"],
						"Options"		=>	$blog->ViewAllPhotos($post_id),
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
	$tpl->assign(array("T_Body"			=>	'blog_photos_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("blog_photos.js","multifile.js"),
						"Action"		=>	$Action,
						"post_id"	=>	$post_id,
						"title"			=>	$get_title->blog_title,
						));
}
elseif($Action == 'Edit')
{
	$tpl->assign(array("T_Body"			=>	'blog_photos_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("blog_photos.js","multifile.js"),
						"Action"		=>	$Action,
						));

	$rsPage = $blog->getBlogPhoto($_POST['photo_id']);
	$tpl->assign(array(	"photo_id"	=>	$rsPage->photo_id,
						"post_id" =>	$rsPage->post_id,
						"photo"		=>	$rsPage->photo,
					));

}
if($Action == 'Order')
{
	$tpl->assign(array("T_Body"			=>	'blog_photos_order'. $config['tplEx'],
						"JavaScript"	=>  array("blog_photos.js"),
						"Options"		=>  $blog->View_Photo_All_Order($_POST['post_id']),
						"Action"		=>  'Order',
						"post_id"	=>	$_POST['post_id'],
						));
}
$tpl->display('default_layout'. $config['tplEx']);
?>