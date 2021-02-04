<?php
class Category
{
    function Category()
    {
		// Do nothing
	}
	#====================================================================================================
	#	Function Name	:   ViewAll
	#----------------------------------------------------------------------------------------------------
    function ViewAll()
    {
		global $db;
		$sql="SELECT count(*) as cnt FROM ".CATEGORY_MASTER;
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt") ;
		$db->free();

		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql = " SELECT * FROM ".CATEGORY_MASTER." "
			  ." ORDER BY cat_id DESC "
			  ." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
		$db->query($sql);
		return ($db->fetch_object());
	}
	#====================================================================================================
	#	Function Name	:   getPage
	#----------------------------------------------------------------------------------------------------
    function getCategory($cat_id)
    {
		global $db;
		$sql = " SELECT * FROM ".CATEGORY_MASTER
			 . " WHERE cat_id =  '". $cat_id ."'";
		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	#====================================================================================================
	#	Function Name	:   GetCategoryList
	#----------------------------------------------------------------------------------------------------
	function GetCategoryList()
    {
		global $db;
		$sql = " SELECT * FROM ".CATEGORY_MASTER." "
			  ." ORDER BY cat_id ASC ";
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   Insert
	#----------------------------------------------------------------------------------------------------
	function Insert($post,$post_by,$html_link)
	{
		global $db;
		$sql = 	"INSERT INTO ". CATEGORY_MASTER. " (cat_title,html_link) "
			.	" VALUES ( "
			. 	" '".	$post['cat_title'].				"', " 	
			. 	" '".	$html_link.				"' " 			
			.	" )"; 
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   Update
	#----------------------------------------------------------------------------------------------------
	function Update($post,$html_link)
    {
		global $db;
		$sql = " UPDATE ".CATEGORY_MASTER
			 . " SET "
			 . " cat_title 			=  '". $post['cat_title'] ."', "
			 . " html_link 			=  '". $html_link ."' "
			 . " WHERE cat_id  		=  '". $post['cat_id'] ."'";
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   Delete
	#----------------------------------------------------------------------------------------------------
    function Delete($cat_id)
    {
		global $db;
		$sql = " DELETE FROM ".CATEGORY_MASTER
			 . " WHERE cat_id =  '". $cat_id ."'";
		$db->query($sql);
	}

}
?>