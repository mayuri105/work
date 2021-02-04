<?php
class Admins
{

	var $Admin_Id	=	'';
    var $Admin_Name	=	'';
    var $Admin_Perm	=	'';
    function Admins()
    {
		if(isset($_SESSION['Admin_Id']))
	    {
			$this->Admin_Id       =   $_SESSION['Admin_Id'];
	        $this->Admin_Name     =   $_SESSION['Admin_Name'];
	        $this->Admin_Perm     =   $_SESSION['Admin_Perm'];
			$this->Admin_Email    =   $_SESSION['Admin_Email'];
			$this->adminPerm     =   $_SESSION['adminPerm'];

		   switch($this->Admin_Perm)
	        {
	            case ADMIN:
	            case SUBADMIN:
					# Check for proper authorization
					if(!defined("IN_ADMIN"))
	                {
						$path_parts = pathinfo($_SERVER['PHP_SELF']);
				        if($path_parts["basename"] != 'logout.php')
						{
							header('location: '. $virtual_path['User_Root']. 'logout.php');
							exit;
						}
	                }
		            break;
	        }
	    }
	    else
	    {
			$path_parts = pathinfo($_SERVER['PHP_SELF']);

	        if($path_parts["basename"] != 'login.php' && defined("IN_ADMIN"))
	            header('location: '. $virtual_path['Admin_Root']. 'logout.php');

	        else if($path_parts["basename"] != 'login.php' && defined("IN_USER"))
	            header('location: '. $virtual_path['Admin_Root']. 'logout.php');
				
			else if($path_parts["basename"] != 'login.php' && defined("IN_FANCHISE"))
	            header('location: '. $virtual_path['Franchise_Root']. 'logout.php');

	        $this->Admin_Id       =   '';
	        $this->Admin_Name     =   '';
	        $this->Admin_Perm     =   '';
	        $this->Admin_Id       =   '';
	    }
		
		
	}

/// Site Admin validation....
	function IsValidAdminLogin($username, $password, $status)
	{
		global $db;
	    $sql =  "SELECT * FROM ". AUTH_USER
            . 	" WHERE user_auth_id  = '". md5($username) . "'"
			.	" AND user_status = '". $status ."' and user_type != 'Doctor'";
		$db->query($sql);
	    if($db->num_rows() > 0)
	    {
	        $db->next_record();
	        if($db->f('user_passwd') == md5($password))
            {
	            $_SESSION['Admin_Id']	=	$db->f('user_auth_id');
	            $_SESSION['Admin_Name']	=	$db->f('user_login_id');
	            $_SESSION['Admin_Perm']	=	$db->f('user_type');
				$_SESSION['adminPerm']	=	$db->f('role_id');
				$_SESSION['Admin_Permission']	=	$db->f('user_permission');
				return true;
            }
	        return false;
	    }
	    return false;
	}
	function IsValidUserAdminLogin($password)
	{
		global $db;
	    $sql =  "SELECT * FROM ". AUTH_USER
            . 	" WHERE user_type = 'Admin'";
		$db->query($sql);
	    if($db->num_rows() > 0)
	    {
	        $db->next_record();
	        if($db->f('member_password') == $password)
            {
	            $_SESSION['UserDetailPerm']	=	1;
				return true;
            }
	        return false;
	    }
	    return false;
	}

///////////////////////////////
// Admin Password Change
///////////////////////////////
	function UpdatePassAdmin($user_auth_id,$old_password,$user_password)
	{
		global $db;
		$sql =  "SELECT user_passwd "
			.   " FROM ". AUTH_USER
			. 	" WHERE user_auth_id  = '". $user_auth_id. "'";

		$db->query($sql);
		$db->next_record();
		if($db->f('user_passwd') == md5($old_password))
		{
			$sql = 	"UPDATE ". AUTH_USER
				.	" SET "
				.	" user_passwd	          = '". md5($user_password). "',"
				.	" user_passwd1	          = '". $user_password. "'"
				.	" WHERE user_auth_id 	  = '". $user_auth_id. "'";

			$db->query($sql);
			return true;
		}
		return false;
	}
///////////////////////////////
/// Franchise Admin validation....
///////////////////////////////
	function IsValidFranchiseLogin($username, $password, $status)
	{
		global $db;
	    $sql =  "SELECT * FROM ". AUTH_USER
            . 	" WHERE user_auth_id  = '". md5($username) . "'"
			.	" AND user_status = '". $status ."' and user_type = 'Doctor'";
		$db->query($sql);
	    if($db->num_rows() > 0)
	    {
	        $db->next_record();
	        if($db->f('user_passwd') == md5($password))
            {
	            $_SESSION['Admin_Id']	=	$db->f('user_auth_id');
	            $_SESSION['Admin_Name']	=	$db->f('user_login_id');
	            $_SESSION['Admin_Perm']	=	$db->f('user_type');
				return true;
            }
	        return false;
	    }
	    return false;
	}

///////////////////////////////
// Admin  Details
////////////////////////////////
	function AdminDetail($userid)
	{
		global $db;
		$sql = " SELECT * FROM ".AUTH_USER." WHERE user_auth_id  = '".$userid."'";
		$rs = $db->query($sql);
		return ($db->next_record());
	}
///////////////////////////////
// LOGOUT
////////////////////////////////
	
	function DestroyAdmin()
	{
		//session_unregister($_SESSION['Admin_Id']);
	    //session_unregister($_SESSION['Admin_Name']);
	    //session_unregister($_SESSION['Admin_Perm']);
		//session_unregister($_SESSION['adminPerm']);
	    @session_unset();
	    @session_destroy();
        return true;
	}
}
?>