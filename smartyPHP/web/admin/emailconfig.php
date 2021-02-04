<?php

#=========
#	Include required files
#---------
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

include_once("../includes/common.php");
include_once(getDBAccess("WebConfig.php"));

#============================================
#								RESPONSE PROCESSING CODE
#--------------------------------------------
#----------------------------------
#	Update Config information
#----------------------------------
$email = new WebConfig();

if($_POST['Submit'] == "Update")
{
	$cnt = 0;
	 while($cnt <= count($_POST['email_id']))
	{	
			$retVal1 = $email->Update_Email_Config($_POST['email_id'][$cnt], 	$_POST['email_title'][$cnt], 	$_POST['email_adress'][$cnt]);		 
			$cnt++;
	}
	header('location: emailconfig.php?update=true');
	exit();
}
#----------------------------------
#	Cancel
#----------------------------------
else if($_POST['Submit'] == "Cancel")
{
	header('location: index.php');
	exit();
}

#============================================
#											RESPONSE CREATING CODE
#--------------------------------------------
if($_GET['update']==true)
{
	$succMessage = "Email configuration has been updated successfully!!";
}

$tpl->assign(array( "T_Body"			=>	'emailconfig'. $config['tplEx'],
					"JavaScript"	    =>  array("emailconfig.js"),
					"A_Action"		    =>	"emailconfig.php",
					"succMessage"	    =>	$succMessage));
 
$tpl->assign(array( //WC_EMAIL_ID			=>	$config[WC_EMAIL_ID],
					"ToolData"				=>	$email->ViewAll(),
					));
					
$tpl->display('default_layout'. $config['tplEx']);
?>