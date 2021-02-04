<?php
class Video
{
    function Video()
    {
		// Do nothing
	}
	#====================================================================================================
	#	Function Name	:   ViewAll
	#	Pages			:	admin/video.php
	#----------------------------------------------------------------------------------------------------
    function ViewAll()
    {
		global $db;
		$sql="SELECT count(*) as cnt FROM ".VIDEO_MASTER;
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt");
		$db->free();
		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql = " SELECT * FROM ".VIDEO_MASTER
		." ORDER BY disp_order ASC"
		." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
			
		$db->query($sql);
		return ($db->fetch_object());
	}
	#====================================================================================================
	#	Function Name	:   getVideo
	#	Pages			:	admin/video.php
	#----------------------------------------------------------------------------------------------------
    function getVideo($video_id)
    {
		global $db;

		$sql = " SELECT * FROM ".VIDEO_MASTER
				. " WHERE video_id =  '". $video_id ."'";
		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	
	#====================================================================================================
	#	Function Name	:   Insert
	#	Pages			:	admin/video.php
	#----------------------------------------------------------------------------------------------------
	function Insert($post,$html_link)
	{
		global $db;
		$sql = 	"INSERT INTO ". VIDEO_MASTER
			. " (
				video_title,
				video_desc,
				status,
				html_link
				) "
			.	" VALUES ( "
			. 	" '".	addslashes(trim($post['video_title'])).		"', " 
			. 	" '".	addslashes(trim($post['video_desc'])).		"', " 
			.	" '".	$post['status']  		."', "
			. 	" '".	$html_link.		"' " 
			.	" )"; 
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   Update
	#	Pages			:	admin/video.php
	#----------------------------------------------------------------------------------------------------
	function Update($post,$html_link)
    {
		global $db;
		$sql = " UPDATE ".VIDEO_MASTER
			 . " SET "
			 . " video_title 			=  '". addslashes(trim($post['video_title'])) ."', "
			 . " video_desc 			=  '". addslashes(trim($post['video_desc'])) ."', "
			 . " status 				=  '". $post['status'] ."', "
			 . " html_link				=  '". $html_link	."' "
			 . " WHERE video_id  		=  '". $post['video_id'] ."'";
			
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   Delete
	#	Pages			:	admin/video.php
	#----------------------------------------------------------------------------------------------------
    function Delete($video_id)
    {
		global $db;
		$sql = " DELETE FROM ".VIDEO_MASTER
			 . " WHERE video_id =  '". $video_id ."'";
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   View_Video_All_Order()
	#	Pages			:	admin/video.php
	#----------------------------------------------------------------------------------------------------
	
	function View_Video_All_Order()
	{

		global $db;
		$sql= "SELECT * FROM ".VIDEO_MASTER
	 		 ." ORDER BY disp_order ASC  ";

		$db->query($sql);
		return ($db->fetch_object());

	}	
	#====================================================================================================
	#	Function Name	:   DisplayOrder_Video($video_id, $display_order)
	#	Pages			:	admin/video.php
	#----------------------------------------------------------------------------------------------------
	function DisplayOrder_Video($video_id, $display_order)
	{
		global $db;

		$sql = " UPDATE ". VIDEO_MASTER
			.  " SET disp_order 	= '". $display_order. "' "
			.  " WHERE video_id		= '". $video_id. "' ";

		$db->query($sql);
		return ($db->affected_rows());

	}

	#====================================================================================================
	#	Function Name	:   getVideoByLink
	#	Pages			:	videos_cat.php
	#----------------------------------------------------------------------------------------------------
    function getVideoByLink($video_link)
    {
		global $db;

		$sql = " SELECT * FROM ".VIDEO_MASTER 
			." WHERE html_link =  '". $video_link ."' AND status=1";

		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	#====================================================================================================
	#	Function Name	:   ToggleStatus($video_id, $status)
	#	Pages			:	admin/video.php
	#----------------------------------------------------------------------------------------------------
	function ToggleStatus($video_id, $status)
	{
		global $db;
		$sql = " UPDATE ".VIDEO_MASTER
			 . " SET status ='". $status."'"
			 . " WHERE video_id ='". $video_id. "'";
		
		return ($db->query($sql));
	}
	#====================================================================================================
	#	Function Name	:   getVideoListFront
	#	Pages			:	video_list.php
	#----------------------------------------------------------------------------------------------------
    function getVideoListFront()
    {
		global $db;
		$sql =	"SELECT COUNT(*) AS cnt FROM ".VIDEO_MASTER. " WHERE status = 1 ORDER BY disp_order ASC";
		$db->query($sql);
		$db->next_record();
		
		$_SESSION['total_record']	=	$db->f('cnt');
		$db->free();
		
		# Reset the start record if required
		if($_SESSION['user_page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}
		$sql = " SELECT * FROM ".VIDEO_MASTER. " WHERE status = 1 ORDER BY disp_order ASC"
			  ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['user_page_size'];
		# Show debug info
		$db->query($sql);
	}
}	
?>