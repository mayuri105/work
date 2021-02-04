//====================================================================================================
//	Function Name	:	Validate_Form(frm)
//----------------------------------------------------------------------------------------------------
function Validate_Form(frm)
{
	with(frm)
    {
		if(!IsEmpty(menu_title, 'Please Enter Menu Title.'))
		{
			menu_title.value = '';
			return false;
		}
		if(!IsEmpty(menu_url, 'Please Enter Menu URL.'))
		{
			menu_url.value = '';
			return false;
		}
		return true;
	}
}

//====================================================================================================
//	Function Name	:	Edit_Click(prodId)
//----------------------------------------------------------------------------------------------------

function Edit_Click(menuId)
{
	window.location=''+site_root+'menu.php?Action=Edit&menu_id='+menuId;	
	/*with(document.frmMenu)
	{
		menu_id.value	= prodId;
		Action.value	= 'Edit';
		submit();
	}*/
}
//====================================================================================================
//	Function Name	:	Delete_Click()
//----------------------------------------------------------------------------------------------------
function Delete_Click(menuId)
{
	window.location=''+site_root+'menu.php?Action=Delete&menu_id='+menuId	
	/*with(document.frmMenu)
	{
		if(confirm('Are you sure you want to delete record?'))
		{
			menu_id.value 	= menuId;
			Action.value	= 'Delete';
			submit();
		}
	}*/
}

//====================================================================================================
//	Function Name	:	DeleteChecked_Click()
//----------------------------------------------------------------------------------------------------
function DeleteChecked_Click()
{
	with(document.frmMenu)
	{
		var flg=false;
		var c_value = "";
		for (var i=0; i < document.all['menus[]'].length; i++)
		{
			if (document.all['menus[]'][i].checked)
			{
				c_value = c_value + document.all['menus[]'][i].value + ":";
				flg = true;
			}
		}
		if(!flg)
		{
			alert('Please, Select the Record You Want to Delete.');
			return false;
		}
		if(confirm('Are You Sure You Want to Delete Selected Menu(s)?'))
		{
			Action.value 	= 'DeleteSelected';
			selected_values.value = c_value;
			submit();
		}
	}
}

function Order_Click(menuId)
{
	with(document.frmMenu)
	{
		parent_id.value = menuId;
		Action.value 	= 'Order';
		submit();
	}
}

function Button_Click(btn)
{
	with(document.frmMenu)
	{
		Submit.value = btn.value;
		for(i=0; i<menu.length; i++)
			display_order.value += menu[i].value + ':';
		submit();
	}
}

function UpDown_Click(direction)
{
	var list = document.frmMenu.menu;
	var tmpVal;
	var tmpText;

	if(list.selectedIndex==-1)
	{
		alert("Select the menu you want to move.");
		return;
	}

	if(!list.length) return;
	
	if(direction==1)
	{
		if(list.selectedIndex == list.length-1) return;
	}
	else
		if(list.selectedIndex == 0) return;

	tmpVal 	= list.options[list.selectedIndex+direction].value;
	tmpText	= list.options[list.selectedIndex+direction].text;

	list.options[list.selectedIndex+direction].value	= list.options[list.selectedIndex].value;
	list.options[list.selectedIndex+direction].text		= list.options[list.selectedIndex].text;

	list.options[list.selectedIndex].value 	= tmpVal;
	list.options[list.selectedIndex].text 	= tmpText;

	list.selectedIndex += direction;
}

function Submit_Form(frm)
{
	with(frm)
	{
		var c_value = "";
		var strToSplit;
		var menuVal;
		for(var i=0; i < menupermission.length; i++)
		{
			if(menupermission[i].checked)
			{
				strToSplit = menupermission[i].value;
				menuVal = strToSplit.split('#');
				c_value = c_value + menuVal[0] + ":";
			}
		}
		selected_values.value = c_value;
		return true;
	}
}

//====================================================================================================
//	Function Name	:	ToggleStatus_Click(menuId,state)
//----------------------------------------------------------------------------------------------------
function ToggleStatus_Click(menuId,state)
{
	 with(document.frmMenu)
	 {
		 menu_id.value	= menuId;
		 status.value 	= state;
		 Action.value	= 'ChangeStatus';
		 submit();
	 }
}

//====================================================================================================
//	Function Name	:	checkUncheckSubMenu(menuId)
//----------------------------------------------------------------------------------------------------
function checkUncheckSubMenu(menuId)
{
	with(document.frmMenuPermission)
	{
		var idSplit, parentId, childIdToSplit, childIdToSplit1, childId, childId1;
		var flag 	= false;
		var flag1 	= false;
		idSplit = menuId.split('#');
		parentId = idSplit[0];
		
		if(idSplit[1] != 0)
		{
			for(var i=0; i < menupermission.length; i++)
			{
				childIdToSplit = menupermission[i].value;
				childId = childIdToSplit.split('#');
				if(parentId == childId[0])
				{
					if(menupermission[i].checked)
					{
						flag1 = true;
					}
					else
					{
						flag1 = false;
					}
				}
				if(flag1 == true)///////
				{///////////////////////
					for(var j=0; j < menupermission.length; j++)
					{
						childIdToSplit1 = menupermission[j].value;
						childId1 = childIdToSplit1.split('#');
						if(idSplit[1] == childId1[0])
						{
							menupermission[j].checked = flag1;
							break;
						}
					}
				}///////////////////////
			}
		}
		else
		{
			for(var i=0; i < menupermission.length; i++)
			{
				childIdToSplit = menupermission[i].value;
				childId = childIdToSplit.split('#');
				if(childId[0] == parentId)
				{
					if(menupermission[i].checked)
					{
						flag = true;
					}
					else
					{
						flag = false;
					}
				}
				if(childId[1] == parentId)
				{
					menupermission[i].checked = flag;
				}
			}
		}
	}
}

function checkIntExtUrl(value)
{
	if(value == 1)
	{
		document.getElementById('menu_url_internal').style.visibility 	= 'visible';
		document.getElementById('menu_url_internal').style.display 		= 'block';
		document.getElementById('menu_url_external').style.visibility 	= 'hidden';
		document.getElementById('menu_url_external').style.display 		= 'none';
	}
	else if(value == 2)
	{
		document.getElementById('menu_url_external').style.visibility 	= 'visible';
		document.getElementById('menu_url_external').style.display 		= 'block';
		document.getElementById('menu_url_internal').style.visibility 	= 'hidden';
		document.getElementById('menu_url_internal').style.display 		= 'none';
	}
}