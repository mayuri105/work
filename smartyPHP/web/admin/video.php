<?php
#====================================================================================================
#	Include required files
#----------------------------------------------------------------------------------------------------
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

if($_GET['Action'] == 'View')
	define('POPUP_WIN', 	true);

include_once("../includes/common.php");
include($physical_path['DB_Access']. 'Video.php');

#=======================================================================================================================================
# Define the action
#---------------------------------------------------------------------------------------------------------------------------------------
$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ShowAll');
$pid = isset($_GET['video_id']) ? $_GET['video_id'] : (isset($_POST['video_id']) ? $_POST['video_id'] : $_POST['video_id']);
$_SESSION['start_record'] = isset($_GET['start']) ? $_GET['start'] : 0;
# Initialize object
$video = new Video();
global $virtual_path,$physical_path;

#=======================================================================================================================================
#								RESPONSE PROCESSING CODE
#---------------------------------------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------------------------
#	Add video
#-----------------------------------------------------------------------------------------------------------------------------
if($Action == 'Add' && ($_POST['Submit'] == 'Save' || $_POST['Submit'] == 'Preview'))
{
	$html_link = getUniqueCategoryLink(VIDEO_MASTER,'video_title', 'video_id', 'html_link', trim($_POST['video_title']), 'add');
	
	$ret = $video->Insert($_POST,$html_link);
	header('location: video.php?add=true');
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Update Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Edit' && $_POST['Submit'] == 'Save')
{
	$html_link = getUniqueCategoryLink(VIDEO_MASTER,'video_title', 'video_id', 'html_link', trim($_POST['video_title']), 'edit', $_POST['video_id']);
	
	$ret = $video->Update($_POST,$html_link);
	header('location: video.php?edit=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Delete Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Delete' && $_POST['video_id'])
{
	$ret = $video->Delete($_POST['video_id']);

	header('location: video.php?delete=true');
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
			$ret = $video->Delete($val);
	}
	header('location: video.php?&delete=true');
	exit();
}
#=======================================================================================================================================
#	Change Status Action
#---------------------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'ChangeStatus')
{	
	$val=$video->ToggleStatus($_POST['video_id'],$_POST['status']);
	header("location: video.php?edit=true");	
	exit();
}
elseif($Action == 'Order' && $_POST['Submit'] == 'Submit')
{
	$display_order = split(":", $_POST['display_order']);
	for($i=0; $i<count($display_order); $i++)
	{
		$video->DisplayOrder_Video($display_order[$i], $i);
	}
	header("location: video.php?order=true");
	exit;
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Cancel
#-----------------------------------------------------------------------------------------------------------------------------
elseif($_POST['Submit'] == "Cancel")
{
	header('location: video.php');
	exit();
}

#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------


#	Show video list
if(!in_array($Action, array('Add', 'Edit', 'Sort', 'View')))
{
	if($_GET['add']==true)
		$succMessage = "You have successfully created a Video.";
	elseif($_GET['edit']==true)
		$succMessage = "You have successfully updated a Video.";
	elseif($_GET['delete']==true)
		$succMessage = "You have successfully deleted a Video.";
	elseif($_GET['order']==true)
		$succMessage = "Video has been ordered successfully.";	

	
	$tpl->assign(array("T_Body"			=>	'video_manage'. $config['tplEx'],
						"JavaScript"	=>  array("video.js"),
						"succMessage"	=>	$succMessage,
						"Action"		=>	$Action,
						"Options"		=>	$video->ViewAll(),
						"Site_Root_Front"	=>	$virtual_path['Site_Root_Front'],
						"PageSize_List"	=>	fillArrayCombo($lang['PageSize_List'], $_SESSION['page_size']),
						));
	if($_SESSION['total_record'] > $_SESSION['page_size'])
	{
		$tpl->assign(array('Page_Link' =>	showPagination($_SESSION['total_record'])
						));
	}	
}

#	Add/Edit Video

elseif($Action == 'Add')
{
	
	
	$tpl->assign(array("T_Body"			=>	'video_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("video.js"),
						"Action"		=>	$Action,
						));
	
}
elseif($Action == 'Edit')
{
	
	$tpl->assign(array("T_Body"			=>	'video_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("video.js"),
						"Action"		=>	$Action,
						));

	$rsVideo = $video->getVideo($pid);

	$tpl->assign(array(	"video_id"				=>	$rsVideo->video_id,
						"name"					=>	stripslashes($rsVideo->name),
						"video_title"			=>	stripslashes($rsVideo->video_title),
						"video_desc"			=>	stripslashes($rsVideo->video_desc),
						"checked"				=>	($rsVideo->status==1)?"checked":'',
			));
	

}
if($Action=='Order')
{
	$tpl->assign(array("T_Body"			=>	'video_order'. $config['tplEx'],
						"JavaScript"	=>  array("video.js"),
						"Options"		=>  $video->View_Video_All_Order(),
						"Action"		=>  'Order',
						));
}

$tpl->display('default_layout'. $config['tplEx']);
?>
