<?php
#====================================================================================================
#	Start Session and define site access valid
#----------------------------------------------------------------------------------------------------
if ( !defined('IN_SITE') )
{
	die("Hacking attempt");
}
session_start();
#====================================================================================================
#	addslashes to vars if magic_quotes_gpc is off
#	this is a security precaution to prevent someone
#	trying to break out of a SQL statement.
#----------------------------------------------------------------------------------------------------
error_reporting(E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
#====================================================================================================
#	Define some basic configuration arrays. This also prevents
#	malicious rewriting of language and otherarray values via
#	URI params
#----------------------------------------------------------------------------------------------------
$physical_path	= array();
$virtual_path	= array();
$config 		= array();
$filename 		= array();

#====================================================================================================
#	Define Site state and set site root
#----------------------------------------------------------------------------------------------------
// Set the server name
$config['Server_Name'] = strtoupper($_SERVER['SERVER_NAME']);
// Set the installation directory
switch($config['Server_Name'])
{
	case "LINUX-SERVER":
	case "LOCALHOST":
		define("INSTALL_DIR", "/neal/alphabet_success/");
		$physical_path['Site_Root']			=	$_SERVER['DOCUMENT_ROOT']. INSTALL_DIR;
        break;

	case "NEALINFOTECH.NET":
	case "WWW.NEALINFOTECH.NET":
		define("INSTALL_DIR", "/alphabet_success/");
		$physical_path['Site_Root']			=	$_SERVER['DOCUMENT_ROOT']. INSTALL_DIR;
    	break;
	
	default:
		define("INSTALL_DIR", "/");
		$physical_path['Site_Root']			=	$_SERVER['DOCUMENT_ROOT']. INSTALL_DIR;
    	break;

}

// Define site root
$virtual_path['Site_Root']			=	'http://'. $_SERVER['HTTP_HOST']. INSTALL_DIR;
#====================================================================================================
#	Including required configuration
#----------------------------------------------------------------------------------------------------
$physical_path['Site_Include']		=	$physical_path['Site_Root']. 'includes/';

include($physical_path['Site_Include']. 'config.php');
include($physical_path['Site_Include']. 'constants.php');
include($physical_path['Site_Include']. 'functions.php');
#====================================================================================================
#	Including all required library
#----------------------------------------------------------------------------------------------------
$physical_path['Libs']				=	$physical_path['Site_Root']. 'libs/';
$virtual_path['Libs']				=	$virtual_path['Site_Root']. 'libs/';

include($physical_path['Libs']. 'mysql.php');
include($physical_path['Libs']. 'htmlMimeMail.php');
include($physical_path['Libs']. 'thumbnail.php');
include($physical_path['Libs']. 'Smarty.class.php');

#====================================================================================================
#	Define Database Access root
#----------------------------------------------------------------------------------------------------
$physical_path['DB_Access']			=	$physical_path['Site_Root']. 'db_access/';
include($physical_path['DB_Access']. 'WebConfig.php');
include($physical_path['DB_Access']. 'User.php');
#====================================================================================================
#	Define Email Template root
#----------------------------------------------------------------------------------------------------
$physical_path['EmailTemplate']			=	$physical_path['Site_Root']. 'email_templates/';
$virtual_path['EmailTemplate']			=	$virtual_path['Site_Root']. 'email_templates/';

#====================================================================================================
#	Define Uploading files path
#----------------------------------------------------------------------------------------------------
$physical_path['Upload']		=	$physical_path['Site_Root']. 'upload/';
$virtual_path['Upload']			=	$virtual_path['Site_Root']. 'upload/';

$physical_path['Blog']			=	$physical_path['Upload']. 'Blog/';
$virtual_path['Blog']			=	$virtual_path['Upload']. 'Blog/';

$physical_path['Page']			=	$physical_path['Upload']. 'Page/';
$virtual_path['Page']			=	$virtual_path['Upload']. 'Page/';

#====================================================================================================
#	Define the user root file path
#----------------------------------------------------------------------------------------------------
if(defined("IN_USER"))
{
	#====================================================================================================
	#	for Front end only
	#----------------------------------------------------------------------------------------------------
	$physical_path['User_Root']			=	$physical_path['Site_Root'];
	$virtual_path['User_Root']			=	$virtual_path['Site_Root'];
}
elseif(defined("IN_ADMIN"))
{
	#====================================================================================================
	#	for Admin login only
	#----------------------------------------------------------------------------------------------------
	$physical_path['User_Root']			=	$physical_path['Site_Root']. 'admin/';
	$virtual_path['User_Root']			=	$virtual_path['Site_Root']. 'admin/';
	
	$virtual_path['Site_Root_Front']	=	$virtual_path['Site_Root'];
	$virtual_path['Site_Root']			=	$virtual_path['User_Root'];
}
#====================================================================================================
#	Define Template root with CSS, JS and Images path
#----------------------------------------------------------------------------------------------------
$physical_path['Templates_Root']		=	$physical_path['User_Root']. 'templates/';
$virtual_path['Templates_Root']			=	$virtual_path['User_Root'].  'templates/';

$virtual_path['Templates_CSS']			=	$virtual_path['Templates_Root']. 'css/';
$virtual_path['Templates_JS']			=	$virtual_path['Templates_Root']. 'js/';
$virtual_path['Templates_Image']		=	$virtual_path['Templates_Root']. 'images/';

#====================================================================================================
#  $_SERVER['SCRIPT_FILENAME'] 
#----------------------------------------------------------------------------------------------------

//$filename = $_SERVER['SCRIPT_FILENAME']; 
$filename['url'] = end(explode("/",$_SERVER['REQUEST_URI']));
  

#====================================================================================================
#	Initial the required object
#====================================================================================================

#----------------------------------------------------------------------------------------------------
# 	Make the mail object
#----------------------------------------------------------------------------------------------------
global $mail,$mail1,$mail2;
$mail = '';
$mail = new htmlMimeMail();
#----------------------------------------------------------------------------------------------------
# Make the database connection
#----------------------------------------------------------------------------------------------------
global $db,$db1,$db2;
$db = '';
$db = new DB_Sql($config['DB_Host'], $config['DB_Name'], $config['DB_User'], $config['DB_Passwd'], false);
$db1 = '';
$db1 = new DB_Sql($config['DB_Host'], $config['DB_Name'], $config['DB_User'], $config['DB_Passwd'], false);
$db2 = '';
$db2 = new DB_Sql($config['DB_Host'], $config['DB_Name'], $config['DB_User'], $config['DB_Passwd'], false);
if(!$db->link_id())
{
  die("Could not connect to the database");
}
#----------------------------------------------------------------------------------------------------
#	Read site configuration
#----------------------------------------------------------------------------------------------------
global $webConf;
$webConf = '';
$webConf = new WebConfig();
#----------------------------------------------------------------------------------------------------
#	Thumbnail
#----------------------------------------------------------------------------------------------------
global $thumb;
$thumb = '';
$thumb = new thumbnail();

#----------------------------------------------------------------------------------------------------
# Initiate User and start session
#----------------------------------------------------------------------------------------------------
# Set page size under cookie
#----------------------------------------------------------------------------------------------------
$_SESSION['page_size']			=	isset($_POST['page_size'])?$_POST['page_size']:(isset($_SESSION['page_size'])?$_SESSION['page_size']:$config[WC_PAGESIZE]);
$_SESSION['user_page_size']		=	isset($_POST['user_page_size'])?$_POST['user_page_size']:(isset($_SESSION['page_size'])?$_SESSION['user_page_size']:$config[WC_USER_PAGESIZE]);	

#----------------------------------------------------------------------------------------------------
# Initiate the smarty object
#----------------------------------------------------------------------------------------------------
$tpl = new Smarty;

$tpl->compile_check = true;
$tpl->debugging 	= false;

# Define template directory and compile directory
$tpl->template_dir 	= $physical_path['Templates_Root'];
$tpl->compile_dir 	= $physical_path['User_Root']. 'templates_c/';

if(defined("POPUP_WINDOW"))
{
	#====================================================================================================
	#	Define Popup Window layout
	#====================================================================================================
	$tpl->assign(array(	"T_Body"	=>	'popupwin_layout'. $config['tplEx'],
						));
}
elseif(defined("IN_ADMIN"))
{
	#====================================================================================================
	#	Define Admin layout and include related files
	#====================================================================================================
	include_once($physical_path['DB_Access']. 'Admins.php');
	global $admin;
	$admins = new Admins();
	
	$tpl->assign(array(	"T_Header"			=>	'default_header'. $config['tplEx'],
						"T_Menu"			=>	'default_menu'. $config['tplEx'],	
						"T_Footer"			=>	'default_footer'. $config['tplEx'],
						"Site_Root_Front"	=>	$virtual_path['Site_Root_Front'],
						"MenuTree"			=>	Admin_GetMenuTree(0,'','')
						));
}
else
{
	#====================================================================================================
	#	Define front side layout and include related files
	#====================================================================================================
	global $user;
	
	$user = new User();
	
	if(defined("HOME_PAGE"))
	{
		//if some special homepage is there
	}
	elseif(defined("IN_USER") && $user->User_Id)
	{
		// with login
		$tpl->assign(array(	"T_Header"		=>	'default_header'. $config['tplEx'],
							"T_Footer"		=>	'default_footer'. $config['tplEx'],
							"T_Right"		=>	'default_right'. $config['tplEx'],
							"T_Left"		=>	'default_left'. $config['tplEx'],
							));
	}
	else
	{
		// without logins
		$tpl->assign(array(	"T_Header"		=>	'default_header'. $config['tplEx'],
							"T_Footer"		=>	'default_footer'. $config['tplEx'],
							"T_Menu"		=>	'default_menu'. $config['tplEx'],
							"T_Left"		=>	'default_left'. $config['tplEx'],
							"T_Right"		=>	'default_right'. $config['tplEx'],
							));
	}
}

# Assign default values
$tpl->assign(array(			
				    "Templates_CSS"			=> 	$virtual_path['Site_Root'].'templates/css/',
					"Templates_JS"			=> 	$virtual_path['Site_Root'].'templates/js/',
					"Templates_Image"		=> 	$virtual_path['Site_Root'].'templates/images/',
					"Site_Root"				=> 	$virtual_path['Site_Root'],
					"Site_Root_Front"		=> 	$virtual_path['Site_Root_Front'],
                    "Site_Title"			=>	$config[WC_SITE_TITLE],
					"Meta_Keyword"			=>	$config[WC_SITE_KEYWORD],
		 			"Meta_Description"		=>	$config[site_description],
					"copyright_text"		=>	$config[WC_COPYRIGHT_TEXT],
					"footer_text"			=>	$config[WC_FOOTER_TEXT],
"Admin_Name"			=>	$_SESSION['Admin_Name'],
"Admin_Id"			=>	$_SESSION['Admin_Id'],
					));
?>
