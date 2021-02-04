<?php
class User
{

	var $User_Id	=	'';
    var $User_Name	=	'';
    var $User_Perm	=	'';
   	function User()
    {

		if(isset($_SESSION['User_Id']))
	    {
		#print user;
			$this->User_Id       =   $_SESSION['User_Id'];
	        $this->User_Name     =   $_SESSION['User_Name'];
	        $this->User_Perm     =   $_SESSION['User_Perm'];
			$this->User_Email    =   $_SESSION['User_Email'];
			if(DEBUG)
            {
            	print '<br>User Id :  '. 	$this->User_Id;
	        	print '<br>User Name: '.	$this->User_Name;
	        	print '<br>User Perm: '. 	$this->User_Perm;
            }

	        switch($this->User_Perm)
	        {
	            case USER:
				#	print defined("IN_SITE")."=".defined("HOME_PAGE")."=".defined("NOLOGIN")."=".defined("POPUP_WINDOW");
					if(!defined("IN_USER")&&!defined("POPUP_WINDOW")&&!defined("HOME_PAGE")&&!defined("NOLOGIN"))
	                {
						$path_parts = pathinfo($_SERVER['PHP_SELF']);
						$_SESSION['prev_file_path'] = $_SERVER["PHP_SELF"];
				        if($path_parts["basename"] != 'logout.php')
						{
							header('location: '. $virtual_path['Site_Root']. 'logout.php');
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
	            header('location: '. $virtual_path['User_Root']. 'logout.php');
	        elseif($path_parts["basename"] != 'login.php' && defined("IN_USER"))
			{
	            header('location: '. $virtual_path['Site_Root']. "logout.php?ref=".$_SERVER['HTTP_REFERER']);
			}

	        $this->User_Id       =   '';
	        $this->User_Name     =   '';
	        $this->User_Perm     =   '';
	    }
		
		
	}
	
	function IsValidLogin($username, $password)
	{
		global $db,$db1,$db2;
	    $sql =  "SELECT * FROM ". MEMBER_MASTER
            . 	" WHERE user_login_id    = '". $username . "' ";
					
		$db->query($sql);
	    if($db->num_rows() > 0)
	    {
	        $db->next_record();
			if($db->f('user_passwd') == md5($password))
			{
				$_SESSION['User_Id']		=	$db->f('user_auth_id');
				$_SESSION['User_Login_Id']	=	$db->f('user_login_id');
				$_SESSION['User_Perm']		=	$db->f('user_type');

				if($db->f('table_name')=='playing_adult_details' || $db->f('table_name')=='parent_details')
				{
					$sql1 =  "SELECT do_u_coach_for_club FROM ". $db->f('table_name')." WHERE user_auth_id  = '". $db->f('user_auth_id') . "' LIMIT 0,1";
					$db1->query($sql1);
					$db1->next_record();
					$_SESSION['Is_Coach']	=		$db1->f('do_u_coach_for_club');
				}		
				return 0;
			 }
			 else
			 {
				return 2;
			 }
		}
		else
		{
			// username not-exist
			return 2;
		}
	}
	
	#====================================================================================================
	#	Function Name	:   getMemberDetail($username)
	#	Purpose			:	Get Member Detail having username.
	#	Pages			:	account.php
	#----------------------------------------------------------------------------------------------------
    function getMemberDetail($username)
    {
		global $db;
		$sql = " SELECT * FROM ".MEMBER_MASTER . " WHERE member_username =  '". $username ."' ";
		
		$db->query($sql);
		return ($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	
	function Destroy()
	{
		session_unregister($_SESSION['User_Id']);
	    session_unregister($_SESSION['User_Names']);
		session_unregister($_SESSION['User_Perm']);
		@session_unset();
	    @session_destroy();
		$_SESSION['prev_file_path'] = $_SERVER['SCRIPT_NAME'];
        return true;
	}
}
?>