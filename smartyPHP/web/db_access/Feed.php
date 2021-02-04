<?php
class Feed
{
    function Feed()
    {
		// Do nothing
	}
	#====================================================================================================
	#	Function Name	:   ViewAll
	#----------------------------------------------------------------------------------------------------
    function ViewAll()
    {
		global $db;
		$sql="SELECT count(*) as cnt FROM ".FEED_MASTER."  ";
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt");
		$db->free();
		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql = " SELECT * FROM ".FEED_MASTER." ORDER BY feed_date DESC"
			 ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
			
		$db->query($sql);
		return ($db->fetch_object());
	}
	#====================================================================================================
	#	Function Name	:   getPage
	#----------------------------------------------------------------------------------------------------
    function getFeed($feed_id)
    {
		global $db;

		$sql = " SELECT * FROM ".FEED_MASTER
			 . " WHERE feed_id =  '". $feed_id ."'";

		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	#====================================================================================================
	#	Function Name	:   Insert
	#----------------------------------------------------------------------------------------------------
	function Insert($post,$feed_type)
	{
		global $db;
		$sql = 	"INSERT INTO feed_content_master (feed_url, feed_date, feed_type, no_of_posts) "
			.	" VALUES ( "
			. 	" '".	addslashes($post['feed_url']).		"', " 
			. 	" '".	date('Y-m-d').		"', " 
			. 	" '".	$feed_type.		"', "
			. 	" '".	$post['no_of_posts'].		"' "  
			.	" )"; 
		$db->query($sql);
		return $db->sql_inserted_id();
	}
	
	function parseRSS($url,$title,$date,$feed_id)
	{
		global $db;
		$sql = 	"INSERT INTO blog_post (post_by, post_date, title, content, status, comment_status, comment_count, html_link) "
		.	" VALUES ( "
		
		. 	" '".	addslashes($title).		"', " 
		. 	" '".	addslashes($url).		"', " 
		. 	" '".	$date.		"', " 
		. 	" '".	date('Y-m-d').		"' " 
		.	" )"; 
		$db->query($sql);
		return $db->sql_inserted_id();
	}
	function parseAtom($post_by, $post_date, $title, $content, $comment_count, $html_link)
	{
		global $db1;
			
		$sql = 	"INSERT INTO blog_post (post_by, post_date, title, content, status, comment_status, comment_count, html_link) "
		.	" VALUES ( "
			. 	" '".	addslashes($post_by).		"', " 
			. 	" '".	$post_date.					"', " 
			. 	" '".	addslashes(trim($title)).	"', " 
			. 	" '".	addslashes($content).		"', " 
			. 	" '1', " 
			. 	" '1', " 
			. 	" '".	$comment_count.			"', " 
			. 	" '".	$html_link. 		"' " 
			.	" )"; 
		//echo $sql;die;
		$db1->query($sql);
		return $db1->sql_inserted_id();
	}
	function insertComments($post_id,$comment_by,$comment_email,$comment_date,$comment)
	{
		global $db1;
			
		$sql = 	"INSERT INTO blog_comments (post_id, comment_by, comment_email,comment_date,comment,status) "
		.	" VALUES ( "
		. 	" '".	addslashes($post_id).		"', " 
		. 	" '".	addslashes($comment_by).		"', " 
		. 	" '".	$comment_email.		"', " 
		. 	" '".	$comment_date.		"', " 
		. 	" '".	addslashes($comment).		"', " 
		. 	" '1' " 
		.	" )"; 
		//echo $sql;die;
		$db1->query($sql);
		
	}
	#====================================================================================================
	#	Function Name	:   Update
	#----------------------------------------------------------------------------------------------------
	function Update($post)
    {
		global $db;
		$sql = " UPDATE ".FEED_MASTER
			 . " SET "
			 . " feed_title 			=  '". $post['feed_title'] ."', "
			 . " short_description		=  '". $post['short_description']	."', "	
			 . " feed_content 			=  '". $post['feed_content'] ."' "
			 . " WHERE feed_id  		=  '". $post['feed_id'] ."'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   Delete($feed_id)
	#----------------------------------------------------------------------------------------------------
    function Delete($feed_id)
    {
		global $db;
		$sql = " DELETE FROM ".FEED_CONTENT_MASTER
			 . " WHERE feed_id =  '". $feed_id ."'";
		$db->query($sql);
		$sql = " DELETE FROM ".FEED_MASTER
			 . " WHERE feed_id =  '". $feed_id ."'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   UpdateFeedStatus($feed_id)
	#----------------------------------------------------------------------------------------------------
	function UpdateFeedStatus($feed_id)
	{
		global $db;
		$sql = " UPDATE ".FEED_MASTER. " SET status	= '0' WHERE feed_id	= '". $feed_id ."'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   getAllFeeds()
	#----------------------------------------------------------------------------------------------------
	function getAllFeeds()
	{
		global $db;
		//$sql = "SELECT * FROM ".FEED_CONTENT_MASTER." AS FCM LEFT JOIN ".FEED_MASTER." AS FM ON FCM.feed_id = FM.feed_id ORDER BY FCM.feed_content_date DESC";
		$sql="SELECT count(*) as cnt FROM ".FEED_CONTENT_MASTER."  ";
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt");
		$db->free();
		
		# Reset the start record if required
		if($_SESSION['user_page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}
		$sql = " SELECT * FROM ".FEED_CONTENT_MASTER." ORDER BY feed_content_date DESC"
			 ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['user_page_size'];
		$db->query($sql);
		return ($db->fetch_object());
	}
	
	#====================================================================================================
	#	Function Name	:   getUnUpdatedFeedURL()
	#----------------------------------------------------------------------------------------------------
	function getUnUpdatedFeedURL()
	{
		global $db;
		$sql = "SELECT COUNT(*) as cnt FROM " . FEED_MASTER . " WHERE status = '1'";
		$db->query($sql);
		$db->next_record();
		$cnt = $db->f('cnt');
		$db->free();
		if($cnt == 0)
		{
			$sql = "UPDATE ". FEED_MASTER . " SET status = '1'";
			$db->query($sql);
			$db->free();
		}
		
		$sql = "SELECT * FROM " . FEED_MASTER . " WHERE status = '1' ORDER BY feed_id LIMIT 1";
		$db->query($sql);
		$feeds = $db->fetch_object(MYSQL_FETCH_SINGLE);
		return ($feeds);
	}
	
	#====================================================================================================
	#	Function Name	:   removeFeedsContent($feed_id)
	#----------------------------------------------------------------------------------------------------
	function removeFeedsContent($feed_id)
	{
		global $db;
		$sql = "DELETE FROM " . FEED_CONTENT_MASTER . " WHERE feed_id = '".$feed_id."'";
		$db->query($sql);
	}
	
	function Update_Feed_Date($feed_id)
	{
		global $db;
		$sql = 	"UPDATE feed_content_master SET feed_date = '".date('Y-m-d')."', status = '1' WHERE feed_id = '".$feed_id."'";
		$db->query($sql);
	}
}
?>