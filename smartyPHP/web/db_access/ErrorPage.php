<?php
class ErrorPage
{
    function ErrorPage()
    {
		// Do nothing
	}
	
	#====================================================================================================
	#	Function Name	:   getErrorPage
	#	Pages			:	admin/error_page.php
	#----------------------------------------------------------------------------------------------------
    function getErrorPage($error_page_id)
    {
		global $db;

		$sql = " SELECT * FROM ".ERROR_PAGE
			 . " WHERE error_page_id =  '". $error_page_id ."'";

		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	#====================================================================================================
	#	Function Name	:   Update
	#	Pages			:	admin/error_page.php
	#----------------------------------------------------------------------------------------------------
	function Update($post)
    {
		global $db;
		$sql = " UPDATE ".ERROR_PAGE
			 . " SET "
			 . " error_page_content 	=  '". addslashes($post['error_page_content'])	."' "
			 . " WHERE error_page_id  	=  '". $post['error_page_id'] ."'";
			
		$db->query($sql);
	}
	

	
}	
?>
