<?php
class Menu
{
	function Menu()
	{
	}
	
	function ViewAll($parent_id)
	{
		global $db;

		$sql="SELECT count(*) as cnt FROM ".MENU_MASTER. " WHERE parent_id = '".$parent_id."' ";
		$db->query($sql);
		$db->next_record();
		$_SESSION['total_record'] = $db->f("cnt");
		$db->free();

		# Reset the start record if required
		if($_SESSION['page_size'] >= $_SESSION['total_record'])
		{
			$_SESSION['start_record'] = 0;
		}
		$sql= " SELECT * FROM ".MENU_MASTER." WHERE parent_id = '".$parent_id."' ORDER BY disp_order ASC"
			." LIMIT ". $_SESSION['start_record']. ", ". $_SESSION['page_size'];
		$db->query($sql);
		//return ($db->fetch_object());
	}
	
	function Insert($post)
	{
		global $db;
		$sql = "INSERT INTO ".MENU_MASTER." "
		      ." (parent_id,menu_title,menu_url,status) "
			  ." VALUES ( "
			  ." '".$post['parent_id']."',"
			  ." '".addslashes($post['menu_title'])."',"
			  ." '".$post['menu_url']."',"
			  ." '".$post['status']."'"
			  ." )";
		$db->query($sql);
		$insertid=$db->sql_inserted_id();	
		$db->free();

		$sql= " SELECT * FROM ".MENU_MASTER." WHERE menu_id = '".$post['parent_id']."' "; 
		$db->query($sql);
		$db->next_record();
		if($post['parent_id'] == 0)
			$path = 0;
		else
			$path = $db->f('path')."/".$post['parent_id'];

		$sql="UPDATE ".MENU_MASTER." SET path = '".$path."' WHERE menu_id = '".$insertid."'";
		$db->query($sql);
		return($insertid);
	}  
	
	function getMenu($menu_id)
	{
		global $db;
		$sql= " SELECT * FROM ".MENU_MASTER." WHERE menu_id = '".$menu_id."'"; 
		$db->query($sql);
		return($db->fetch_object(MYSQL_FETCH_SINGLE));
	}
	
	function Update($post)
	{
		global $db;
		$sql="UPDATE ".MENU_MASTER
			." SET menu_title		='".addslashes($post['menu_title'])."', "
			." menu_url				='".$post['menu_url']."', "
			." status				='".$post['status']."' "
			." WHERE menu_id		=".$post['menu_id'];
		return($db->query($sql));
	}

	function ChkSubCat($menu_id)
	{
		global $db,$db1;
		$sql= " SELECT * FROM ".MENU_MASTER." WHERE parent_id = '".$menu_id."'"; 
		$db->query($sql);
		$subcnt=$db->num_rows();
		if($subcnt==0)
		{
			return nosubmenu;
		}
	}
	
	function Delete($menu_id)
	{
		global $db;
		$sql = "DELETE FROM ".MENU_MASTER." WHERE menu_id = '" . $menu_id . "'";
		return($db->query($sql));
	}
	
	function View_Menu_All_Order($parent_id)
	{
		global $db;
		$sql= "SELECT * FROM ".MENU_MASTER." WHERE parent_id = '".$parent_id."' ORDER BY disp_order ASC";
		$db->query($sql);
		return ($db->fetch_object());
	}	

	function DisplayOrder_Menu($menu_id, $display_order)
	{
		global $db;
		$sql = "UPDATE ". MENU_MASTER." SET disp_order = '". $display_order. "' WHERE menu_id = '". $menu_id. "'";
		$db->query($sql);
		return ($db->affected_rows());
	}
	
	function ViewAll_Menus()
	{
		global $db;
		$sql= "SELECT * FROM ".MENU_MASTER." ORDER BY disp_order ASC";
		$db->query($sql);
		return ($db->fetch_object());
	}
	
	function Get_Menu($menu_id)
	{
		global $db1;
		$i = 0;
		$arry = array();
		$sql = "SELECT * FROM ".MENU_MASTER." WHERE parent_id ='" . $menu_id . "' AND status = '1' ORDER BY disp_order";
		$db1->query($sql);
		while ($i < $db1->num_rows())
		{
			$db1->next_record();
			$arry[$i]['menu_id']	= $db1->f('menu_id');
			$arry[$i]['parent_id']	= $db1->f('parent_id');
			$arry[$i]['menu_title']	= $db1->f('menu_title');
			$i++;
		} 
	 	return $arry;
	}
	
	function GetChildMenu($menu_id=0, $line = '')
	{
		$menus = $this->Get_Menu($menu_id);
		$cnt = count($menus);
		if($cnt)
		{
			$checked = '';
			for($i = 0; $i < $cnt; $i++)
			{		
				if(in_array($menus[$i]['menu_id'],$this->menulistArray))
				{
					$checked = 'checked="checked"';
				}
				else
				{
					$checked = '';
				}
				$str1 .= '<tr class="{cycle values=/"list_A, list_B/"}">
							  <td>' . $line .'&nbsp;'.$menus[$i]['menu_title'].'</td>
							  <td><input class="stdCheckBox" type="checkbox" name="menupermission" '.$checked.' value="'.$menus[$i]['menu_id'].'#'.$menus[$i]['parent_id'].'" onclick="javascript: checkUncheckSubMenu(this.value)"></td>
						 </tr>';
				$str1 .= $this->GetChildMenu($menus[$i]['menu_id'],$line.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;');
			}
		}
		return($str1); 
	}
	
	function MenuPermission($post)
	{
		global $db;
		$list = str_replace(':',',',$post['selected_values']);
		$list = substr_replace($list,'',-1);
		$sql="UPDATE ".AUTH_USER." SET user_permission = '".$list."' WHERE user_auth_id = '" . $post['user_auth_id'] . "'";
		return($db->query($sql));
	}
	
	function getMenuPermission($user_auth_id)
	{
		global $db;
		$sql= "SELECT user_permission FROM ".AUTH_USER." WHERE user_auth_id = '" . $user_auth_id . "'";
		$db->query($sql);
		$db->next_record();
		return ($db->f('user_permission'));
	}
	
	#====================================================================================================
	#	Function Name	:   ToggleStatusPage($menu_id, $menu_show)
	#----------------------------------------------------------------------------------------------------
    function ToggleStatusMenu($menu_id, $menu_show)
	{
		global $db;
		$sql = " UPDATE ".MENU_MASTER. " SET status ='". $menu_show."' WHERE menu_id ='". $menu_id. "'";
		return ($db->query($sql));
	}
	#====================================================================================================
	#	Function Name	:   Update
	#	Pages			:	admin/menu.php
	#----------------------------------------------------------------------------------------------------
	function UpdateOrder($position,$item,$i)
    {
		global $db;
		$sql=	" UPDATE menu_master SET "
			 . " parent_id  	=  '". $item ."', "
			 . " disp_order 	=  '". $i ."' "
			 . " WHERE menu_id  =  '". $position."'";
		$db->query($sql);
		return $sql;
	}
	function GetSubMenu($menu_id)
	{
		$arry = array();
		
		$sql = "select * from menu_master where parent_id = ".$menu_id." ORDER BY disp_order ASC ";
		$result = mysql_query($sql);
		$i = 0;
		while($row = mysql_fetch_object($result))
		{
			$arry[$i]['parent_id'] 	= $row->parent_id;
			$arry[$i]['menu_id'] 	= $row->menu_id;
			$arry[$i]['menu_title'] = $row->menu_title;
			$i++;
		} 
		return $arry;
	}
	
	
	function GetFrontMenu($menu_id=0)
	{
		$mstr 	= '';
		$menu 	= $this->GetSubMenu($menu_id);
		$cnt 	= count($menu);
		if($cnt > 0)
		{
			if($menu_id == 0)
			{
				$id = "class = 'sortable' ";
			}
			else
			{
				$id = "";
			}
			
			$mstr .= "<ol ".$id.">";
			for($i = 0; $i < $cnt; $i++)
			{	
				$mstr .= '<li id="list_'.$menu[$i]['menu_id'].'">
					<div>
						<span>'.$menu[$i]['menu_title'].'</span>'
						.'<span style="float:right;"><img src="'.$virtual_path['Site_Root'].'templates/images/icon-edit.gif" class="imgAction" title="Edit" onClick="JavaScript: Edit_Click('.$menu[$i]['menu_id'].');">&nbsp;<img src="'.$virtual_path['Site_Root'].'templates/images/icon-delete.gif" class="imgAction" title="Edit" onClick="JavaScript: Delete_Click('.$menu[$i]['menu_id'].');"></span>
					</div>';
				$mstr .= $this->GetFrontMenu($menu[$i]['menu_id'])."</li>";
			}
			$mstr .= "</ol>";
		}
		return($mstr);
	}
	function GetMenuTree($menu_id=0 , $line = '', $cnt1='', $Selected ='') 
	{
		$category = $this->GetSubMenu($menu_id);
		$cnt = count($category);
		

		if($cnt)
		{
			for ($i = 0; $i < $cnt; $i++)
			{		
				$sel='';
				if($category[$i]['menu_id']==$Selected)
				{
					$sel='selected="selected"';
				}
				$str1 .= '<option value="' . $category[$i]['menu_id'] . '" ' . $sel . '>' . $line . ' '. $category[$i]['menu_title'] . '</option>';
				$str1 .= $this->GetMenuTree($category[$i]['menu_id'],$line.'&nbsp;&nbsp;&nbsp;', $cnt1,$Selected);
			}
		}
		return($str1); 
	}
	
	function getMenuLinkPath($menu_id,$i=0)
	{
		global $db,$db1;
		$sql = " SELECT * FROM ".MENU_MASTER
			 . " WHERE menu_id = '".$menu_id."'";
		$db->query($sql);
		$rscnt = $db->num_rows();
		if($rscnt > 0)
		{
			$db->next_record();
			$navigation = $this->getMenuLinkPath($db->f('parent_id'),$i+1);
			if($i != 0)
			{
				$sql1 = " SELECT * FROM ".MENU_MASTER
					 . " WHERE menu_id = '".$menu_id."'";
				$db1->query($sql1);
				$db1->next_record();
				$navigation .= ' / <a href="menu.php?parent_id='.$menu_id.'" class="actionLink">'.$db1->f('menu_title').'</a>';
			}
			else
			{
				$sql1 = " SELECT * FROM ".MENU_MASTER
					 . " WHERE menu_id = '".$menu_id."'";
				$db1->query($sql1);
				$db1->next_record();
				$navigation .= ' / '.$db1->f('menu_title').'';
			}
		}
		else
		{
			if($i != 0)
				$navigation = '<a href="menu.php?parent_id=0" class="actionLink">Root</a>';
		}
		return $navigation;
	}
}
?>