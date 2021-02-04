<?php
class Page
{
    function Page()
    {
		// Do nothing
	}
	#====================================================================================================
	#	Function Name	:   ViewAll
	#	Pages			:	admin/page.php
	#----------------------------------------------------------------------------------------------------
    function ViewAll()
    {
		global $db;
		$sql =	"SELECT COUNT(*) AS cnt FROM ".PAGE_MASTER." ";
		$where	=	'';
		if($_SESSION['search_page_title'] !='')
		{
			$where	.=	" WHERE page_title LIKE '%".$_SESSION['search_page_title']."%' " ; 
		}
		$sql	.= $where;
		$db->query($sql);
		$db->next_record();
		
		$_SESSION['total_record']	=	$db->f('cnt');
		$db->free();
		
		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}
		$sql = " SELECT * FROM ".PAGE_MASTER. $where ." ORDER BY page_id"
			  ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
		# Show debug info
		$db->query($sql);
		return ($db->fetch_object());
	}
	#====================================================================================================
	#	Function Name	:   getPage
	#	Pages			:	admin/page.php
	#----------------------------------------------------------------------------------------------------
    function getPage($page_id)
    {
		global $db;

		$sql = " SELECT * FROM ".PAGE_MASTER
			 . " WHERE page_id =  '". $page_id ."'";

		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	function getPageByLink($page_link)
    {
		global $db;
		$sql = "SELECT * FROM ".PAGE_MASTER. " WHERE page_link = '". $page_link ."'";
		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	#====================================================================================================
	#	Function Name	:   Insert
	#	Pages			:	admin/page.php
	#----------------------------------------------------------------------------------------------------
	function Insert($post,$page_link,$image)
	{
		global $db;
		$sql = 	"INSERT INTO ". PAGE_MASTER
			. " (
				page_title,
				page_content, 
				page_link,
				meta_title,
				meta_keyword,
				meta_description,
				canonical_tag,
				status,
				redirect,
				image
				) "
			.	" VALUES ( "
			. 	" '".	$post['page_title'].		"', "
			. 	" '".	addslashes($post['page_content']).		"', " 
			. 	" '".	$page_link.			"', " 
			. 	" '".	addslashes(trim($post['meta_title'])).		"', " 
			. 	" '".	addslashes(trim($post['meta_keyword'])).		"', " 
			. 	" '".	addslashes(trim($post['meta_description'])).		"', " 
			. 	" '".	addslashes($post['canonical_tag']).		"', " 
			.	" '".	$post['status']  		."', "
			.	" '".	addslashes($post['redirect']) 		."', "
			.	" '".	$image 		."' "
			.	" )"; 
		$db->query($sql);
		return $db->sql_inserted_id();
	}


	#====================================================================================================
	#	Function Name	:   Update
	#	Pages			:	admin/page.php
	#----------------------------------------------------------------------------------------------------
	function Update($post,$page_link,$image)
    {
		global $db;
		$sql = " UPDATE ".PAGE_MASTER
			 . " SET "
			 . " page_title 			=  '". addslashes($post['page_title']) ."', "
			 . " page_content 			=  '". addslashes($post['page_content']) ."', "
			 . " page_link 				=  '". $page_link."', "
			 . " meta_title 			=  '". addslashes(trim($post['meta_title'])) ."', "
			 . " meta_keyword 			=  '". addslashes(trim($post['meta_keyword'])) ."', "
			 . " meta_description 		=  '". addslashes(trim($post['meta_description'])) ."', "
			 . " canonical_tag 			=  '". addslashes($post['canonical_tag']) ."', "
			 . " status 				=  '". $post['status'] ."', "
			 . " redirect 				=  '". addslashes($post['redirect']) ."', "
			 . " image 					=  '". $image ."' "
			 . " WHERE page_id  		=  '". $post['page_id'] ."'";
		$db->query($sql);
	}

	#====================================================================================================
	#	Function Name	:   Delete
	#	Pages			:	admin/page.php
	#----------------------------------------------------------------------------------------------------
    function Delete($page_id)
    {
		global $db,$db1,$physical_path;
		$sql = " SELECT * FROM ".PAGE_MASTER
			 . " WHERE page_id =  '". $page_id ."'";
		$db->query($sql);
		$db->next_record();
		$file_name = $db->f('page_title');
		$file_link = $db->f('page_link');
		
		$image = $db->f('image');
		@unlink($physical_path['Page'].$image); 
				
		DeleteLinkInHtaccess($file_link,'page.php?pid='.$page_id);
		
		$sql = " DELETE FROM ".PAGE_MASTER
			 . " WHERE page_id =  '". $page_id ."'";
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   ToggleStatus($page_id, $status)
	#	Pages			:	admin/page.php
	#----------------------------------------------------------------------------------------------------
	function ToggleStatus($page_id, $status)
	{
		global $db;
		$sql = " UPDATE ".PAGE_MASTER
			 . " SET status ='". $status."'"
			 . " WHERE page_id ='". $page_id. "'";
		
		return ($db->query($sql));
	}
	
	function getParentIdByURL($url)
	{
		global $db;
		$sql= "SELECT menu_id, path FROM ".FRONT_MENU_MASTER." WHERE menu_url = '" . $url . "'";

		$db->query($sql);

		if($db->num_rows() > 0)
		{
			$db->next_record();
			$mid = $db->f('menu_id');
			$menuid = explode('/',$db->f('path'));
			$db->free();
			if(count($menuid) == 1)
			{
				return $mid;
			}
			else
			{
				return $menuid[count($menuid)-1];
			}
		}
		else
		{
			return -1;
		}
	}
}
?>
