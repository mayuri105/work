<?php
#====================================================================================================
#	Include required files
#----------------------------------------------------------------------------------------------------
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);


include_once("../includes/common.php");
include($physical_path['DB_Access']. 'Events.php');

#=======================================================================================================================================
# Define the action
#---------------------------------------------------------------------------------------------------------------------------------------
$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ShowAll');
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : (isset($_POST['event_id']) ? $_POST['event_id'] : $_GET['event_id']);

# Initialize object
$events = new Events();

#=======================================================================================================================================
#								RESPONSE PROCESSING CODE
#---------------------------------------------------------------------------------------------------------------------------------------
#-----------------------------------------------------------------------------------------------------------------------------
#	Add event
#-----------------------------------------------------------------------------------------------------------------------------
if($Action == 'Add' && $_POST['Submit'] == 'Save')
{
	$html_link = getUniqueCategoryLink(EVENTS_MASTER,'event_title', 'event_id', 'html_link', trim($_POST['event_title']), 'add');
	$ret = $events->Insert($_POST, $html_link);
	WriteLinkInHtaccess($html_link,"events.php?event_id=".$ret);
	header('location: events.php?add=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Update Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Edit' && $_POST['Submit'] == 'Save')
{
	$html_link = getUniqueCategoryLink(EVENTS_MASTER,'event_title', 'event_id', 'html_link', trim($_POST['event_title']), 'edit',$_POST['event_id']);
	DeleteLinkInHtaccess($_POST['html_link'],'events.php?event_id='.$_POST['event_id']);
	$ret = $events->Update($_POST,$html_link);
	WriteLinkInHtaccess($html_link,"events.php?event_id=".$_POST['event_id']);
	header('location: events.php?edit=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Delete Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'Delete' && $_POST['event_id'])
{
	$ret = $events->Delete($_POST['event_id']);
	header('location: events.php?delete=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Delete Selected Content
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'DeleteSelected')
{
	foreach($_POST['lists'] as $key=>$val)
	{
		$ret = $events->Delete($val);
	}
	header('location: events.php?&delete=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Change Status
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'ChangeStatus' && $_POST['event_id'])
{
	$ret = $events->ToggleStatus($_POST['event_id'],$_POST['status']);
	
	header('location: events.php?&edit=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Cancel
#-----------------------------------------------------------------------------------------------------------------------------
elseif($_POST['Submit'] == "Cancel")
{
	header('location: events.php');
	exit();
}

#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------


#	Show page list

if($Action == '' || $Action == 'ShowAll')
{
	if($_GET['add']==true)
		$succMessage = "Event has been added successfully!!";
	elseif($_GET['save']==true)
		$succMessage = "Event has been updated successfully!!";
	elseif($_GET['delete']==true)
		$succMessage = "Event has been deleted successfully!!";

	$tpl->assign(array("T_Body"			=>	'events_manage'. $config['tplEx'],
						"JavaScript"	=>  array("events.js"),
						"succMessage"	=>	$succMessage,
						"Action"		=>	$Action,
						"Options"		=>	$events->ViewAll(),
						"PageSize_List"	 =>	fillArrayCombo($lang['PageSize_List'], $_SESSION['page_size']),						
						));
	if($_SESSION['total_record'] > $_SESSION['page_size'])
	{
		$tpl->assign(array('Page_Link' =>	showPagination($_SESSION['total_record'])
						));
	}
}
# Add/Edit Event
elseif($Action == 'Add')
{
	$tpl->assign(array("T_Body"			=>	'events_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("events.js","calendarDateInput.js"),
						"event_start_date"		=>	formatDate(date('Y-m-d'),'Y-M-d'),
						"event_end_date"		=>	formatDate(date('Y-m-d'),'Y-M-d'),
						"Action"		=>	$Action,
						));
	
}
elseif($Action == 'Edit')
{
	$tpl->assign(array("T_Body"			=>	'events_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("events.js","calendarDateInput.js"),
						"Action"		=>	$Action,
						));
	$rsEvent = $events->getEvent($_POST['event_id']);
	$tpl->assign(array(	"event_id"		=>	$rsEvent->event_id,
						"event_title"	=>	stripslashes($rsEvent->event_title),
						"html_link"		=>	stripslashes($rsEvent->html_link),
						"event_description"	=>	stripslashes($rsEvent->event_description),
						"event_start_date"	=>	formatDate($rsEvent->event_start_date,'Y-M-d'),
						"event_end_date"	=>	formatDate($rsEvent->event_end_date,'Y-M-d'),
						"checked"		=>	($rsEvent->status==1)?'checked':'',
						));
}
$tpl->display('default_layout'. $config['tplEx']);
?>