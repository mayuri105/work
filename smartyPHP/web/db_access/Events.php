<?php
class Events
{
    function Events()
    {
		// Do nothing
	}
	#====================================================================================================
	#	Function Name	:   ViewAll
	#	Pages			:	admin/events.php
	#----------------------------------------------------------------------------------------------------
    function ViewAll()
    {
		global $db;
		$sql = " SELECT count(*) as cnt FROM ".EVENTS_MASTER." AS NM";
		
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt");
		$db->free();
		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql = " SELECT * FROM ".EVENTS_MASTER." AS NM"
			 . " ORDER BY event_id DESC"
			 ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
			
		$db->query($sql);
		return ($db->fetch_object());
	}
	#====================================================================================================
	#	Function Name	:   getEvent
	#	Pages			:	admin/events.php
	#----------------------------------------------------------------------------------------------------
    function getEvent($event_id)
    {
		global $db;

		$sql = " SELECT * FROM ".EVENTS_MASTER
			 . " WHERE event_id =  '". $event_id ."'";

		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}

	#====================================================================================================
	#	Function Name	:   Insert
	#	Pages			:	admin/events.php
	#----------------------------------------------------------------------------------------------------
	function Insert($post,$html_link)
	{
		global $db;
		$sql = 	"INSERT INTO ". EVENTS_MASTER
			. " (
				event_title,
				event_description,
				event_start_date, 
				event_end_date,
				status,
				html_link
				) "
			.	" VALUES ( "
			. 	" '".	addslashes($post['event_title']).	"', " 
			. 	" '".	addslashes($post['event_description']).	"', "
			. 	" '".	date('Y-m-d',strtotime($post['event_start_date'])).		"', "
			. 	" '".	date('Y-m-d',strtotime($post['event_end_date'])).		"', "  
			. 	" '".	$post['status'].		"', "  
			. 	" '".	$html_link.				"'" 
			.	" )"; 
		$db->query($sql);
		return $db->sql_inserted_id();
	}
	#====================================================================================================
	#	Function Name	:   Update
	#	Pages			:	admin/events.php
	#----------------------------------------------------------------------------------------------------
	function Update($post,$html_link)
    {
		global $db;
		$sql = " UPDATE ".EVENTS_MASTER
			 . " SET "
			 . " event_title 			=  '". addslashes($post['event_title']) ."', "
			 . " event_description 		=  '". addslashes($post['event_description']) ."', "
			 . " event_start_date 		=  '". date('Y-m-d',strtotime($post['event_start_date'])) ."', "
			 . " event_end_date 		=  '". date('Y-m-d',strtotime($post['event_end_date'])) ."', "
			 . " html_link 				=  '". $html_link."', "
			 . " status 				=  '". $post['status'] ."' "
			 . " WHERE event_id  		=  '". $post['event_id'] ."'";
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   Delete
	#	Pages			:	admin/events.php
	#----------------------------------------------------------------------------------------------------
    function Delete($event_id)
    {
		global $db;
		$sql = "SELECT html_link FROM ".EVENTS_MASTER . " WHERE event_id =  '". $event_id ."'";
		$db->query($sql);
		$db->next_record();
		DeleteLinkInHtaccess($db->f('html_link'),'events.php?event_id='.$event_id);
		$sql = "DELETE FROM ".EVENTS_MASTER. " WHERE event_id =  '". $event_id ."'";
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   ToggleStatus($event_id, $status)
	#	Pages			:	admin/events.php
	#----------------------------------------------------------------------------------------------------
	function ToggleStatus($event_id, $status)
	{
		global $db;
		$sql = "UPDATE ".EVENTS_MASTER. " SET status ='". $status."' WHERE event_id ='". $event_id. "'";
		return ($db->query($sql));
	}
	
	function getEventByLink($html_link)
	{
		global $db;
		$sql = "SELECT * FROM ".EVENTS_MASTER." AS NM WHERE NM.html_link = '".$html_link."' AND NM.status=1 ORDER BY event_id DESC";
		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	
	function GetAllEventsFront()
    {
		global $db;
		$sql = "SELECT * FROM ".EVENTS_MASTER." WHERE status = '1' ORDER BY news_date DESC";
		$db->query($sql);
		return ($db->fetch_object());
	}
}
?>