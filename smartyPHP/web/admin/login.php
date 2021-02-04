<?php
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);



include_once("../includes/common.php");

if($_POST['Submit'] == 'Login')
{
	if($admins->IsValidAdminLogin($_POST['username'], $_POST['password'],'1'))
	{

		header("location: index.php");
		exit(0);

	}

	$db->free();

	$Error_Message = "Invalid Username / Password!!!";

}

#if($user->User_Id != '')	header("location: ./index.php");
if($admins->Admin_Id != '')	header("location: ./index.php");


$tpl->assign(array(	"T_Body"		=>	'login'. $config['tplEx'],

					"JavaScript"	=>  array("login.js"),

					"A_Login"		=>	"login.php",

					"Error_Message"	=>	$Error_Message));



$tpl->display('login'. $config['tplEx']);



?>