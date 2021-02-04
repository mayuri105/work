<?php
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

include_once("../includes/common.php");
include_once($physical_path['DB_Access']. "Admins.php");

define("DEBUG", false);

$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : A_VIEW_ALL);
if($_GET['start'])
	$startrecord = $_GET['start'];
else
	$startrecord = 0;
$userinfo = new Admins();


#====================================================================================================
#	Change Password into database
#----------------------------------------------------------------------------------------------------
if($Action == 'ChangePass' && $_POST['Sumbit']=='Change')
{
	if($userinfo->UpdatePassAdmin($admins->Admin_Id,$_POST['old_password'],$_POST['new_password1']))
	{
		header('location: changepass.php?update=true');
		exit();
	}
	else
	{
		header('location: changepass.php?update=false');
		exit();
	}
}
#====================================================================================================
#	List all reports
#----------------------------------------------------------------------------------------------------
if($Action == A_VIEW_ALL)
{
	if($_GET['update'] == 'true')
		$succMsg='<br>Password has been changed successfully.<br>';
	else if($_GET['update'] == 'false')
		$errMsg='<br>Please check your old password.<br>';

	$result=$userinfo->AdminDetail($admins->Admin_Id);
	$tpl->assign(array("T_Body"					=>	'changepass'. $config['tplEx'],
						"JavaScript"			=>  array("changepass.js"),
						"A_Action"				=>	"changepass.php",
						"Action"				=>	'ChangePass',
						"succMsg"				=>	$succMsg,
						"old_pass"				=>	$db->f('user_passwd'),
						"Admin_Id"				=>	$db->f('user_id'),
						"Error_Message"	        =>	$errMsg,
					));
}
$tpl->display('default_layout'. $config['tplEx']);
?>