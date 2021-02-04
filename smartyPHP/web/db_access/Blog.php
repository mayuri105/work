<?php
class Blog
{
    function Blog()
    {
		// Do nothing
	}
	#====================================================================================================
	#	Function Name	:   ViewAll
	#	Pages			:	admin/blog.php
	#----------------------------------------------------------------------------------------------------
    function ViewAll()
    {
		global $db;
		$sql="SELECT count(*) as cnt FROM ".BLOG_POST;
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt") ;
		$db->free();

		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql = " SELECT * FROM ".BLOG_POST." "
			  ." ORDER BY post_date DESC "
			  ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
		$db->query($sql);
		return ($db->fetch_object());
	}
	
	#====================================================================================================
	#	Function Name	:   getBlog
	#	Pages			:	admin/blog.php
	#----------------------------------------------------------------------------------------------------
    function getBlog($post_id)
    {
		global $db;
		$sql = " SELECT * FROM ".BLOG_POST
			 . " WHERE post_id =  '". $post_id ."'";
		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	
	#====================================================================================================
	#	Function Name	:   Insert
	#	Pages			:	admin/blog.php
	#----------------------------------------------------------------------------------------------------
	function Insert($post,$post_by,$html_link,$fname)
	{
		global $db;
		$sql = 	"INSERT INTO ". BLOG_POST
			. " (
				post_by, 
				post_date,
				cat_id,
				title,
				content,
				short_desc,
				blog_img,
				status,
				comment_status,
				html_link
				) "
			.	" VALUES ( "
			. 	" '".	$post_by.				"', " 
			. 	" '".	$post['post_date'].			"', " 
			. 	" '".	$post['cat_id'].			"', " 
			. 	" '".	addslashes(trim($post['title'])).			"', " 
			. 	" '".	addslashes($post['content']).		"', " 
			. 	" '".	addslashes($post['short_desc']).	"', " 
			. 	" '".	$fname.	"', " 
			. 	" '".	$post['status'].		"', " 
			. 	" '".	$post['comment_status']. "', " 
			. 	" '".	$html_link. "' " 
			.	" )"; 
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   Update
	#	Pages			:	admin/blog.php
	#----------------------------------------------------------------------------------------------------
	function Update($post,$html_link,$fname)
    {
		global $db;
		$sql = " UPDATE ".BLOG_POST
			 . " SET "
			 . " cat_id 				=  '". $post['cat_id'] ."', "
			 . " post_date 				=  '". $post['post_date'] ."', "
			 . " title 					=  '". addslashes(trim($post['title'])) ."', "
			 . " content 				=  '". addslashes($post['content']) ."', "
			 . " short_desc 			=  '". addslashes($post['short_desc']) ."', "
			 . " blog_img 				=  '". $fname ."', "
			 . " status 				=  '". $post['status'] ."', "
			 . " comment_status 		=  '". $post['comment_status'] ."', "
			 . " html_link 				=  '". $html_link ."' "
			 . " WHERE post_id  		=  '". $post['post_id'] ."'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   Delete
	#	Pages			:	admin/blog.php
	#----------------------------------------------------------------------------------------------------
    function Delete($post_id)
    {
		global $db,$physical_path;
		
		$sql = " SELECT * FROM ".BLOG_POST
			 . " WHERE post_id =  '". $post_id ."'";
		$db->query($sql);
		$db->next_record();
		
		@unlink($physical_path['Blog'].$db->f('blog_img'));
		@unlink($physical_path['Blog'].'thumb_'.$db->f('blog_img'));
		
		$sql = " DELETE FROM ".BLOG_POST
			 . " WHERE post_id =  '". $post_id ."'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   ToggleStatusBlog($post_id, $status)
	#	Pages			:	admin/blog.php
	#----------------------------------------------------------------------------------------------------
	function ToggleStatusBlog($post_id, $status)
	{
		global $db;
		$sql = " UPDATE ".BLOG_POST
			 . " SET status ='". $status."'"
			 . " WHERE post_id ='". $post_id. "'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:  BlogPost($cat_link='')
	#	Pages			:	blog.php
	#----------------------------------------------------------------------------------------------------
    function BlogPost($year,$month)
    {
		global $db;
		$sql="SELECT * FROM ".BLOG_POST." AS BP WHERE BP.status = '1'"; 
		$sql1 = '';
		
		if($year !='')
		{
			$sql1 .=  ' AND YEAR(BP.post_date) ='.$year;
		}
		if($month !='') 
		{	 
			$sql1 .= ' AND MONTH(BP.post_date) ='.$month;
		}
		//$sql = "SELECT COUNT(*) AS cnt FROM ".BLOG_COMMENTS." WHERE post_id = '".$post_id."' AND status = '1'";  
		//$sql="SELECT count(BC.post_id) BP.* as cnt FROM ".BLOG_POST." AS BP JOIN ".BLOG_COMMENTS." AS BC ON BP.post_id = BC.post_id ";		
		$db->query($sql.$sql1); 
		//return ($db->fetch_object());
	}
	#====================================================================================================
	#	Function Name	:   getCommentsCount($post_id)
	# 	Pages			:	blog.php
	#----------------------------------------------------------------------------------------------------
    function getCommentsCount($post_id)
    {
		global $db1;
		$sql = " SELECT COUNT(*) as cnt FROM ".BLOG_COMMENTS. " WHERE post_id =  '". $post_id ."' AND status = '1'";
		$db1->query($sql);
		$db1->next_record();
		return ($db1->f('cnt'));
	}
		
	#====================================================================================================
	#	Function Name	:   Insert_Comment($post)
	#	Pages			:	admin/comments.php
	#----------------------------------------------------------------------------------------------------
	function Insert_Comment($post)
	{
		global $db;
		$sql = " SELECT * FROM ".BLOG_POST." "
			  ." WHERE post_id = '".$post['post_id']."' ";
		$db->query($sql);
		$db->next_record();
		$comment_status = $db->f('comment_status');
		$db->free();
		if($comment_status == 1)
		{
			// insert query
			$sql = "INSERT INTO ".BLOG_COMMENTS." (post_id,comment_by,comment_email,comment_date,comment,status) VALUES ("
					." '".$post['post_id']."',"
					." '".$post['comment_by']."',"
					." '".$post['comment_email']."',"
					." '".date('Y-m-d')."',"
					." '".str_replace("\n", "<br />", $post['comment'])."',"
					." '0' )";
			$db->query($sql);
			
			return 1;
		}
		else
		{
			return 0;
		}
	}
	#====================================================================================================
	#	Function Name	:   ViewAllComments($type)
	#	Pages			:	admin/comments.php
	#----------------------------------------------------------------------------------------------------
	function ViewAllComments($type)
	{
		global $db;
		if($type == 'all')
		{
			$sql_join = "";
		}	
		elseif($type == 'approved')
		{
			$sql_join = "WHERE BC.status = '1'";
		}	
		elseif($type == 'unapproved')
		{
			$sql_join = "WHERE BC.status = '0'";
		}		
	
		$sql="SELECT count(*) as cnt FROM ".BLOG_COMMENTS." AS BC "
			  ." LEFT JOIN ".BLOG_POST." AS BP ON BC.post_id = BP.post_id "
			  . $sql_join;
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt") ;
		$db->free();

		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql = "SELECT BC.*,BP.title FROM ".BLOG_COMMENTS." AS BC "
			  ." LEFT JOIN ".BLOG_POST." AS BP ON BC.post_id = BP.post_id "
			  . $sql_join
			  ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
		$db->query($sql);
		return ($db->fetch_object());
		
	}
	
	#====================================================================================================
	#	Function Name	:   DeleteComment($id)
	#	Pages			:	admin/comments.php
	#----------------------------------------------------------------------------------------------------
	function DeleteComment($id)
	{
		global $db;
		$sql = " DELETE FROM ".BLOG_COMMENTS
			 . " WHERE id =  '". $id ."'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   ToggleStatusComment($id, $status)
	#	Pages			:	admin/comments.php
	#----------------------------------------------------------------------------------------------------
	function ToggleStatusComment($id, $status)
	{
		global $db;
		$sql = " UPDATE ".BLOG_COMMENTS
			 . " SET status ='". $status."'"
			 . " WHERE id ='". $id. "'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   getBlogComments($id)
	#	Pages			:	admin/comments.php
	#----------------------------------------------------------------------------------------------------
    function getBlogComments($id)
    {
		global $db;
		$sql = " SELECT * FROM ".BLOG_COMMENTS
			 . " WHERE id =  '". $id ."'";
		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	
	#====================================================================================================
	#	Function Name	:   UpdateComment($post)
	#	Pages			:	admin/comments.php
	#----------------------------------------------------------------------------------------------------
	function UpdateComment($post)
	{
		global $db;
		$sql = "UPDATE ".BLOG_COMMENTS
			 ." SET comment_by 		= '".$post['comment_by']."', "
			 ." comment_email 		= '".$post['comment_email']."', "
			 ." comment_date 		= '".$post['post_date']."', "
			 ." comment 			= '".$post['comment']."', "
			 ." status 				= '".$post['status'] ."' "
			 ." WHERE id 			= '".$post['id'] ."'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   CountUnApprovedComments()
	#	Pages			:	admin/comments.php
	#----------------------------------------------------------------------------------------------------
	function CountUnApprovedComments()
	{
		global $db;
		$sql = "SELECT COUNT(*) AS CNT FROM ".BLOG_COMMENTS
			 . " WHERE status =  '0'";
		$db->query($sql);
		$db->next_record();
		return ($db->f('CNT'));
	}
	
	#====================================================================================================
	#	Function Name	:   CountUnApprovedComments()
	#	Pages			:	admin/blog_right_menu.php
	#----------------------------------------------------------------------------------------------------
	function GetArchieveList()
	{
		global $db;
		$sql = "SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(post_id) as posts FROM ".BLOG_POST 
		 		." WHERE status = 1 "
				." GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";
		//echo $sql;die;
		$db->query($sql);
		
	}
	#====================================================================================================
	#	Function Name	:   GetLatestPost
	#	Pages			:	blog_right_menu.php
	#----------------------------------------------------------------------------------------------------
    function GetLatestPost()
    {
		global $db;
		$sql = " SELECT * FROM ".BLOG_POST
			 . " WHERE status = '1' ORDER BY post_id DESC LIMIT 0,5 ";
		$db->query($sql);
		
	}
	#====================================================================================================
	#	Function Name	:   getBlogByLink
	#	Pages			:	blogs.php
	#----------------------------------------------------------------------------------------------------
    function getBlogByLink($blog_link)
    {
		global $db;

		$sql = " SELECT * FROM ".BLOG_POST
			 . " WHERE html_link =  '". $blog_link ."'";

		$db->query($sql);
		
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	#====================================================================================================
	#	Function Name	:   List_Comments_On_Post($post_id)
	#	Pages			:	view_blog_post.php
	#----------------------------------------------------------------------------------------------------
	function List_Comments_On_Post($post_id)
	{
		global $db;
		$sql = "SELECT * FROM ".BLOG_COMMENTS
				." WHERE post_id = '".$post_id."' AND status = '1' ORDER BY id DESC";
		$db->query($sql);
		return ($db->fetch_object());
		
	}
	#====================================================================================================
	#	Function Name	:   CountUnApprovedComments()
	#	Pages			:	admin/blog_archieve.php
	#----------------------------------------------------------------------------------------------------

	function ListOfPost_Month($month)
	{
		global $db;
		$months = explode("-",$month);
		$month = $months[0];
		$year = $months[1];
		$this_month = date('Y-m-d',mktime(0,0,0,$month,1,$year));
		$next_month = date('Y-m-d',mktime(0,0,0,$month+1,1,$year));

		$sql="SELECT count(*) as cnt FROM ".BLOG_POST
			  ." WHERE status = '1' AND post_date BETWEEN  '".$this_month."' AND '".$next_month."'"
			  ." ORDER BY post_id DESC ";
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt") ;
		$db->free();

		# Reset the start record if required
		if($_SESSION['user_page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql = " SELECT * FROM ".BLOG_POST." "
			  ." WHERE status = '1' AND post_date BETWEEN  '".$this_month."' AND '".$next_month."'"
			  ." ORDER BY post_id DESC "
			  ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['user_page_size'];
		$db->query($sql);
	
	}

#====================================================================================================
	#	Function Name	:   CategoryPostCnt($cat_id)
	#	Pages			:	blog_right_menu.php
	#----------------------------------------------------------------------------------------------------
	function CategoryPostCnt($cat_id)
	{
		global $db1;
		$sql = "SELECT COUNT(*) AS cnt FROM ".BLOG_POST
				." WHERE cat_id = '".$cat_id."' AND status = '1' ";
		$db1->query($sql);
		$db1->next_record();
		return ($db1->f('cnt'));
		
	}
	
	function CountComments($post_id)
	{
		if($post_id){
			global $db1;
			$sql = "SELECT COUNT(*) AS cnt FROM ".BLOG_COMMENTS." WHERE post_id = '".$post_id."' AND status = '1'";
			$db1->query($sql);
			$db1->next_record();
			return ($db1->f('cnt')); 
		}else{
			return '0';
		}	
	}
	
	function ListOfPost_Category($ids)
	{
		global $db;

		$sql="SELECT count(*) as cnt FROM ".BLOG_POST
			  ." WHERE status = '1' AND cat_id = '".$ids."' "
			  ." ORDER BY post_id DESC ";
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt") ;
		$db->free();

		# Reset the start record if required
		if($_SESSION['user_page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql = " SELECT * FROM ".BLOG_POST." "
			  ." WHERE status = '1' AND cat_id = '".$ids."' "
			  ." ORDER BY post_id DESC "
			  ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['user_page_size'];
		$db->query($sql);
	
	}
	
	function blog_archive($groupBy)
	{
		global $db; 
		//$sql= "SELECT * FROM ".BLOG_POST." WHERE post_id='".$post_id."' ORDER BY disp_order ASC";
		$sql= "SELECT 
					YEAR(post_date) AS YEAR, 
					MONTH(post_date) AS MONTH,
					COUNT(*) AS TOTAL,post_date,title 
				FROM ".BLOG_POST." 
				GROUP BY ".$groupBy." ORDER BY post_date DESC";
		$db->query($sql);
		return ($db->fetch_object());
	}	
	
	function InsertPhoto($post,$fname)
	{
		global $db;
		$sql = 	"INSERT INTO ". BLOG_PHOTOS_MASTER. " (post_id,title,description,photo) "
			.	" VALUES ( "
			. 	" '".	$post['post_id'].	"', " 
			. 	" '".	addslashes($post['title']).	"', "	
			. 	" '".	addslashes($post['description']).	"', "	
			. 	" '".	$fname.			"' " 	
			.	" )"; 
		$db->query($sql);
	}
	
	function DeletePhoto($photo_id)
	{
		global $db1,$physical_path;
		$sql = " SELECT * FROM ".BLOG_PHOTOS_MASTER." WHERE photo_id='".$photo_id."'";
		$db1->query($sql);
		$db1->next_record();
		
		@unlink($physical_path['Blog'].$db1->f('photo'));
		@unlink($physical_path['Blog'].'medium_thumb_'.$db1->f('photo'));
		@unlink($physical_path['Blog'].'small_thumb_'.$db1->f('photo'));
		
		$sql = " DELETE FROM ".BLOG_PHOTOS_MASTER." WHERE photo_id='".$photo_id."'";
		$db1->query($sql);
	}
	
	function DisplayOrder_Photo($photo_id, $display_order)
	{
		global $db;
		$sql = "UPDATE ". BLOG_PHOTOS_MASTER." SET disp_order = '". $display_order. "' WHERE photo_id = '". $photo_id. "'";
		$db->query($sql);
		return ($db->affected_rows());
	}
	
	function ViewAllPhotos($post_id)
    {
		global $db;
		$sql="SELECT count(*) as cnt FROM ".BLOG_PHOTOS_MASTER." WHERE post_id='".$post_id."'";
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt");
		$db->free();

		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql = " SELECT * FROM ".BLOG_PHOTOS_MASTER." WHERE post_id='".$post_id."'"
			  ." ORDER BY disp_order ASC "
			  ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
		$db->query($sql);
		return ($db->fetch_object());
	}
	
	function getGalleryPhoto($photo_id)
    {
		global $db;
		$sql = " SELECT * FROM ".BLOG_PHOTOS_MASTER. " WHERE photo_id = '". $photo_id ."'";
		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	
	function View_Photo_All_Order($post_id)
	{
		global $db;
		$sql= "SELECT * FROM ".BLOG_PHOTOS_MASTER." WHERE post_id='".$post_id."' ORDER BY disp_order ASC";
		$db->query($sql);
		return ($db->fetch_object());
	} 
	
	function GetGalleryPhotosFront($post_id)
    {
		global $db;
		$sql = "SELECT * FROM ".BLOG_PHOTOS_MASTER. " WHERE post_id = '".$post_id."' ORDER BY disp_order ASC";
		$db->query($sql);
	}
	
	
}
?>
