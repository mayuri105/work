<?php
class Contact
{
    function Contact()
    {
		// Do nothing
	}
	#====================================================================================================
	#	Function Name	:   ViewAll
	#	Pages			:	admin/contact.php
	#----------------------------------------------------------------------------------------------------
    function ViewAll()
    {
		global $db;
		$sql="SELECT count(*) as cnt FROM ".CONTACT_MASTER;
		$where = '';		
		if($_SESSION['search_contact_date']!='')
		{
			
			$where	.=	" WHERE DATE(contact_on) = '".$_SESSION['search_contact_date']."' ";
		}	
		
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt");
		$db->free();
		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}

		$sql	= "SELECT * FROM ".CONTACT_MASTER;
		$sql .=	$where;		
		$sql .=	" ORDER BY name ASC"
			." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
			
		$db->query($sql);
		return ($db->fetch_object());
	}
	#====================================================================================================
	#	Function Name	:   getContact
	#	Pages			:	admin/contact.php
	#----------------------------------------------------------------------------------------------------
    function getContact($contact_id)
    {
		global $db;
		$sql = " SELECT * FROM ".CONTACT_MASTER. " WHERE contact_id =  '". $contact_id ."'";
		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	#====================================================================================================
	#	Function Name	:   ToggleDealtStatus
	#	Last Modified	:	
	#----------------------------------------------------------------------------------------------------
	function ToggleDealtStatus($contact_id,$status)
    {
		global $db;
		$sql = " UPDATE ".CONTACT_MASTER
			 . " SET "
			 . " is_dealt			= '". $status ."' "
		 	 . " WHERE contact_id	= '". $contact_id  ."'";
			//echo $sql;die;
		$db->query($sql);
	}
	#====================================================================================================
	#	Function Name	:   InsertContact
	#	Pages			:	contact_us.php
	#----------------------------------------------------------------------------------------------------

	function InsertContact($post)
	{
		global $db;
		$sql = "INSERT INTO ".CONTACT_MASTER
			." (
				name, 
				email, 
				phone_number, 
				company,
				comments,
				contact_on
				) 
				VALUES 
				('"
				.addslashes($post['name'])."','"
				.$post['email']."','"
				.$post['phone_number']."','"
				.addslashes($post['company'])."','"
				.addslashes($post['comments'])."',"
				."now()"
				.")";
		$db->query($sql);
	}

	#====================================================================================================
	#	Function Name	:   Delete
	#	Pages			:	admin/contact.php
	#----------------------------------------------------------------------------------------------------
    function Delete($contact_id)
    {
		global $db;
		$sql = "DELETE FROM ".CONTACT_MASTER." WHERE contact_id =  '". $contact_id ."'";
		$db->query($sql);
	}
	
	#====================================================================================================
	#	Function Name	:   getAllContact
	#	Pages			:	admin/contact.php
	#----------------------------------------------------------------------------------------------------
    function getAllContact()
    {
		global $db;
		$sql = " SELECT * FROM ".CONTACT_MASTER." ORDER BY name ASC";
		$db->query($sql);
		return ($db->fetch_object());
	}
}	
?>
