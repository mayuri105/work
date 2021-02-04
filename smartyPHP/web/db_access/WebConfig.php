<?php
////////first define all constants related to table
define('WC_SITE_TITLE',				'site_title');
define('WC_SITE_KEYWORD',			'site_keyword');
define('WC_SITE_DESCRIPTION',		'site_description');
define('WC_TPLEX',					'tplEx');
define('WC_PAGESIZE',				'page_size');
define('WC_USER_PAGESIZE',			'user_page_size');
define('WC_FILTER',					'filter');
define('WC_CONTACT_US',				'Contact Us');
define('WC_COPYRIGHT_TEXT',			'copyright_text');
define('WC_FOOTER_TEXT',			'footer_text');

class WebConfig
{
   	#=========
	#	Function Name	:   WebConfig
	#---------
    function WebConfig()
    {
		global $db;
		global $config;
		$sql  = "SELECT * "
				. " FROM " . WEBSITE_CONFIG;
		$db->query($sql);
	    while($db->next_record())
	    {
	        $config[$db->f('config_name')] = stripslashes($db->f('config_value'));
	    }
		$sql  = "SELECT * "
				. " FROM " . EMAIL_CONFIG;
		$db->query($sql);
	    while($db->next_record())
	    {
			$config[$db->f('email_title')] = stripslashes($db->f('email_adress'));
	    }

		global $config;
		$_SESSION['Debug']	=	isset($_GET['debug'])?$_GET['debug']:$_SESSION['Debug'];
		define('DEBUG', $_SESSION['Debug']);
		# Set page size under cookie
		#-----------------------------------------------------------------------------
		$_SESSION['page_size']		=	isset($_POST['page_size'])?$_POST['page_size']:(isset($_SESSION['page_size'])?$_SESSION['page_size']:$config[WC_PAGESIZE]);
		$_SESSION['user_page_size']		=	isset($_POST['user_page_size'])?$_POST['user_page_size']:(isset($_SESSION['user_page_size'])?$_SESSION['user_page_size']:$config[WC_USER_PAGESIZE]);
		$_SESSION['filter']		=	isset($_POST['filter'])?$_POST['filter']:(isset($_SESSION['filter'])?$_SESSION['filter']:$config[WC_FILTER]);
		# Set starting record
		#-----------------------------------------------------------------------------
		if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['PHP_SELF']) !== false)
		{
			$_SESSION['start_record']	=	$_POST['goto_page'] ? (((int)$_POST['goto_page']-1) * $_POST['page_size']) : (isset($_GET['start']) ? (int)$_GET['start'] : ($_SESSION['start_record']?$_SESSION['start_record']:0));
		}
		else
		{
			$_SESSION['start_record'] = isset($_GET['start']) ? (int)$_GET['start'] : ($_SESSION['start_record']?$_SESSION['start_record']:0);
		}

	}
	#=========
	#	Function Name		:	Get
	#---------
	function Get($config_name)
	{
		global $config;
		return $config[$config_name];
	}
	#=========
	#	Function Name		:	Set
	#---------
	function Set($config_name, $config_value)
	{
		global $config;
		$config[$config_name] = $config_value;
        return $this->_Update($config_name, $config_value);
	}
	#=========
	#	Function Name	:   Update
	#---------
	function _Update($config_name, $config_value)
	{
		global $db;
		$sql = " UPDATE ".WEBSITE_CONFIG
			 . " SET  config_value	= '". addslashes($config_value). "' "
			 . " WHERE config_name 	= '". $config_name. "' ";
		$db->query($sql);
		return ($db->affected_rows());
	}


	function Update_Email_Config(	$email_id,		$email_title,	$email_adress)
	{
		global $db;
		$sql = " UPDATE ".EMAIL_CONFIG
				.	" SET "
			 . " email_title		= '". $email_title. "' , "
			 . " email_adress		= '". $email_adress. "'  "
			 . " WHERE email_id 	= '". $email_id . "' ";
		$db->query($sql);
		return ($db->affected_rows());
	}

    function getEmailAddress()
	{
		global $db;
		$sql	=	"SELECT * "
					.	" FROM " . EMAIL_CONFIG
					.	" WHERE 1 "
					.	(empty($this->email_id)	? "" : " AND email_id IN (". $this->email_id. ")")
					.	(empty($this->page_size) ? "" : " LIMIT " . $this->start_record . ", ". $this->page_size);
		$rs = $db->query($sql);
	}
	
    function ViewAll()
	{
		global $db;
		$sql	=	"SELECT * "
					.	" FROM " . EMAIL_CONFIG
					.	" WHERE 1 "
					.	(empty($this->email_id)	? "" : " AND email_id IN (". $this->email_id. ")")
					.	(empty($this->page_size) ? "" : " LIMIT " . $this->start_record . ", ". $this->page_size);
		$rs = $db->query($sql);
		return ($db->fetch_object());
	}
}
?>