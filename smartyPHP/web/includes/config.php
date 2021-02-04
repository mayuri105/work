<?php
/* this file is used for database connection */
$config['tplEx'] = '.tpl';  // file extension

#====================================================================================================
#	Database		
#----------------------------------------------------------------------------------------------------
switch($config['Server_Name'])
{
	case "LINUX-SERVER":
	case "LOCALHOST":
	    $config['DB_Type']      = 'mysql';
	    $config['DB_Host']      = 'localhost';
	    $config['DB_Name']      = 'alphabet_success';
	    $config['DB_User']      = 'root';
	    $config['DB_Passwd']    = 'neal';
        break;

	case "NEALINFOTECH.NET":
	case "WWW.NEALINFOTECH.NET":
	    $config['DB_Type']      = 'mysql';
	    $config['DB_Host']      = 'localhost';
	    $config['DB_Name']      = 'alphabet_success_db';
	    $config['DB_User']      = 'alphab_suc_dbu';
	    $config['DB_Passwd']    = '#6cIds6(S~_6';
        break;
	
	default:
	    $config['DB_Type']      = 'mysql';
	    $config['DB_Host']      = 'localhost';
	    $config['DB_Name']      = 'alphabet_success';
	    $config['DB_User']      = 'root';
	    $config['DB_Passwd']    = 'neal';
        break;
}
?>
