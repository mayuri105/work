<?php
ob_start();
session_start();
error_reporting(0);
   $HOST 	 = 'localhost';    // Your Database Server Hostname
	$USER   = 'root';		// Your Database Username
	$PASS   = '';			// Your Database User Password
	$DB     = 'doc';	// Your Database Name
	
	$SITE_PATH='http://localhost/mayuri/docweb/admin/';
	$IMG_PATH='http://localhost/mayuri/docweb/';
	
	   try
		{
			 $con = mysql_connect($HOST,$USER,$PASS) or die("Could not connect database");
             $db=mysql_select_db($DB, $con) or die("Could not select database");
		}
		catch (Exception $e)
		{
			echo "Caught exception: " . $e->getMessage() . "\n";
			exit;
		}
		
?>