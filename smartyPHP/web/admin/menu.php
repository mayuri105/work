<?php
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);

include_once("../includes/common.php");
include($physical_path['DB_Access']. 'Menu.php');
$Action = isset($_GET['Action']) ? $_GET['Action'] : (isset($_POST['Action']) ? $_POST['Action'] : 'ViewAll');
$parent_id = isset($_GET['parent_id']) ? $_GET['parent_id'] : (isset($_POST['parent_id']) ? $_POST['parent_id'] : '0');
$menu_id = isset($_GET['menu_id']) ? $_GET['menu_id'] : (isset($_POST['menu_id']) ? $_POST['menu_id'] : '0');

$menu = new Menu();
$_SESSION['start_record'] = isset($_GET['start']) ? $_GET['start'] : 0;

if($_GET['Action']=='Order')
{
	$i=0;
	foreach($_GET['list'] as $position => $item)
	{
		$sql[] = $menu->UpdateOrder($position,$item,$i);
		$i++;
	}
	die;
}

if($Action == 'Add' && $_POST['Submit'] == 'Submit')
{
	
	$menu->Insert($_POST);
	header("location: menu.php?parent_id=".$parent_id."&add=true");
}
elseif($Action == 'Edit' && $_POST['Submit'] == 'Submit')
{
	$menu->Update($_POST);
	header("location: menu.php?parent_id=".$parent_id."&edit=true");
}
elseif($Action=='Delete' && $_GET['menu_id'])
{
	$val = $menu->ChkSubCat($menu_id);
	if($val=='nosubmenu')
	{ 
		$val = $menu->Delete($menu_id)?'true':'false';
		header("location: menu.php?parent_id=".$parent_id."&del=true");
		exit();
	}
	else
	{
		header("location: menu.php?parent_id=".$parent_id."&del1=true");	
		exit();
	}
}
#----------------------------------------------------------------------------------------------------
# Delete selected categories
#----------------------------------------------------------------------------------------------------
elseif($Action=='DeleteSelected')
{
	$list = explode(":",substr_replace($_POST['selected_values'],'',-1));
	$i=0;
	foreach($list as $key=>$val)
	{
		$val1 = $menu->ChkSubCat($val);
		if($val1=='nosubmenu')
		{ 
			$val = $menu->Delete($val)?'true':'false';
			$nosubmenu[$i]=$val;
		}
		else
		{
			$menu1[$i]=$val;
		}
		$i++;
	}
	if(count($nosubmenu) != 0)
	{
		header("location: menu.php?parent_id=".$parent_id."&del=true");
		exit;
	}
	if(count($menu1) != 0)
	{
		$expprodid = implode(',',$menu1);
	}
	if($expprodid != '')
	{
		header("location: menu.php?parent_id=".$parent_id."&del1=true");
		exit;
	}
}
elseif($_POST['Submit'] == 'Cancel')
{
	header("location: menu.php?parent_id=".$parent_id);
}
elseif($Action == 'Order' && $_POST['display_order'])
{
	$display_order = split(":", $_POST['display_order']);
	for($i=0; $i<count($display_order); $i++)
	{
		$menu->DisplayOrder_Menu($display_order[$i], $i);
	}
	header("location: menu.php?parent_id=".$parent_id);
	exit;
}
#-----------------------------------------------------------------------------------------------------------------------------
#	Change Page Status
#-----------------------------------------------------------------------------------------------------------------------------
elseif($Action == 'ChangeStatus')
{
	$menu->ToggleStatusMenu($_POST['menu_id'],$_POST['status']);
	header("location: menu.php?parent_id=".$parent_id);
	exit();
}
#=====================================================================================
#=====================================================================================
#=====================================================================================
if($Action == 'ViewAll' || $Action == '')
{
	if ($_GET['add']=='true')
		$msg="Menu added successfully";
	elseif ($_GET['del']=='true')
		$msg="Menu deleted successfully";
	elseif ($_GET['del1']=='true')
		$msg="This menu may contain sub menu so its can't be deleted.";
	elseif ($_GET['edit']=='true')
		$msg="Menu updated successfully";
	
	$navigationLink = getMenuLinkPath($parent_id);
	
	$Menu_Tree = $menu->GetFrontMenu(0);

	$tpl->assign(array("T_Body"				=>	'menu_manage'. $config['tplEx'],
						"JavaScript"		=>  array("menu.js","jquery-1.js","jquery-ui-1.js","jquery.js"),
						"navigationLink"	=>	$navigationLink,
						"succMessage"		=>	$msg,
						"Action"			=>	$Action,
						"parent_id"			=>	$parent_id,
						"Options"			=>	$menu->ViewAll($parent_id),
						"Menu_Tree"			=>	$Menu_Tree,
						"PageSize_List"	 	=>	fillArrayCombo($lang['PageSize_List'], $_SESSION['page_size']),						
						));
	if($_SESSION['total_record'] > $_SESSION['page_size'])
	{
		$tpl->assign(array('Page_Link' =>	showPagination($_SESSION['total_record'])
						));
	}
}
elseif($Action == 'Add')
{
	$tpl->assign(array("T_Body"			=>	'menu_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("menu.js"),
						"Action"		=>	$Action,
						"menu_tree"		=>	$menu->GetMenuTree(0,'','','0'),
						"ActionPermission"	=>	$lang['pagePermission'],
						));
}
elseif($Action == 'Edit')
{
	$tpl->assign(array("T_Body"			=>	'menu_addedit'. $config['tplEx'],
						"JavaScript"	=>  array("menu.js"),
						"Action"		=>	$Action,
						"parent_id"		=>	$parent_id,
						"Cnt"			=>	count($lang['Action_Permission']),
						"ActionPermission"	=>	$lang['pagePermission'],
						));
						
	$ret = $menu->getMenu($menu_id);
	$tpl->assign(array(	"menu_id"		=>	$ret->menu_id,
						"parent_id"		=>	$ret->parent_id,
						"menu_title"	=>	$ret->menu_title,
						"menu_url"		=>	$ret->menu_url,
						"pagePermission" =>	explode(',',$ret->pagePermission),
						"checked"		=>	($ret->status==1)?"checked":'',
						"checked_quick"	=>	($ret->display_in_quick_links==1)?"checked":'',
						"menu_tree"		=>	$menu->GetMenuTree(0,'','',$ret->parent_id),
						));
}
if($Action=='Order')
{
	$tpl->assign(array("T_Body"			=>	'menu_order'. $config['tplEx'],
						"JavaScript"	=>  array("menu.js"),
						"Options"		=>  $menu->View_Menu_All_Order($_POST['parent_id']),
						"Action"		=>  'Order',
						"parent_id"		=>	$parent_id,
						));
}

$tpl->display('default_layout'. $config['tplEx']);
?>