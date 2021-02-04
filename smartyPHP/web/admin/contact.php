<?php
#====================================================================================================
#	Include required files
#----------------------------------------------------------------------------------------------------
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

include_once("../includes/common.php");
include($physical_path['DB_Access']. 'Contact.php');

#=======================================================================================================================================
# Define the action
#---------------------------------------------------------------------------------------------------------------------------------------
$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ShowAll');
$pid = isset($_GET['contact_id']) ? $_GET['contact_id'] : (isset($_POST['contact_id']) ? $_POST['contact_id'] : $_POST['contact_id']);

# Initialize object
$contact = new Contact();
#=======================================================================================================================================
#								RESPONSE PROCESSING CODE
#---------------------------------------------------------------------------------------------------------------------------------------
if($_GET['download']=='yes')
{
	$exportData = $contact->getAllContact();
	
	for($i=0; $i<count($exportData); $i++)
	{
		$data[$i]=array("Sr. No."		=>	$i+1,
						"Name"	   		=>	stripslashes($exportData[$i]->name), 
						"Telephone"		=>	$exportData[$i]->phone_number,		
						"Email"		=>	$exportData[$i]->email,
						"Query"			=>	stripslashes($exportData[$i]->comments),
						"Contact On"	=>	$exportData[$i]->contact_on,
				);
	}
	function cleanData(&$str) 
	{ 
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
	}
	$filename = "Contacts.xls";
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: application/vnd.ms-excel");
	$flag = false;
	
	foreach($data as $row)
	{
		if(!$flag)
		{
			echo implode("\t", array_keys($row)) . "\n";
			$flag = true;
		}
		array_walk($row, 'cleanData');
		echo implode("\t", array_values($row)) . "\n";
	}
	exit;
}

if($Action == 'Delete' && $_POST['contact_id'])
{
	$ret = $contact->Delete($_POST['contact_id']);

	header('location: contact.php?delete=true');
	exit();
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Change Status
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'ChangeStatus' && $_POST['contact_id'])
{
	$ret = $contact->ToggleDealtStatus($_POST['contact_id'],$_POST['status']);
	
	header('location: contact.php?&deal=true');
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
		$ret = $contact->Delete($val);
	}
	header('location: contact.php?&delete=true');
	exit();
}

#=======================================================================================================================================
#											RESPONSE CREATING CODE
#---------------------------------------------------------------------------------------------------------------------------------------
#	Show contact list

if(!in_array($Action, array('Add', 'Edit', 'Sort', 'View')))
{
	if($_GET['delete']==true)
		$succMessage = "Contact has been deleted successfully.";
	elseif($_GET['deal']==true)
		$succMessage	=	"Contact Dealt Status has been updated successfully !";
		
	if($_POST['Search'] == 'Search')
	{	
		$_SESSION['search_contact_date'] = trim($_POST['search_contact_date']);
	}
	else if($_POST['ShowAll'] == 'Show All')
	{	
		unset($_SESSION['search_contact_date']);
	}
	
	$tpl->assign(array("T_Body"			=>	'contact_manage'. $config['tplEx'],
						"JavaScript"	=>  array("contact.js","calendarDateInput.js"),
						"succMessage"	=>	$succMessage,
						"Action"		=>	$Action,
						"Options"		=>	$contact->ViewAll(),
						"totRec"		=>	count($contact->ViewAll()),
						"PageSize_List"	=>	fillArrayCombo($lang['PageSize_List'], $_SESSION['page_size']),
						));
	if($_SESSION['total_record'] > $_SESSION['page_size'])
	{
		$tpl->assign(array('Page_Link' =>	showPagination($_SESSION['total_record'])
						));
	}	
}
$tpl->display('default_layout'. $config['tplEx']);
?>
