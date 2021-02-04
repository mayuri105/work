//====================================================================================================
//	Function Name	:	Form_Submit(frm)
//----------------------------------------------------------------------------------------------------
function Form_Submit(frm)
{
	with(frm)
	{
		if(!IsEmpty(banner_title, 'Please enter Title.'))
		{
			banner_title.value = '';
			banner_title.focus();
			return false;
		}
		/*if(banner_link.value!='')
		{
			if(!IsUrl(banner_link, 'Please enter Link like ("http://abc.com").'))
			{
				banner_link.focus();
				return false;
			}
		}*/
		if(Action.value == 'Add')
		{
			if(!checkImageType(banner_image, 'Please Select an image to upload banner.'))
			{
				return false;
			}
		}
		if(Action.value == 'Edit')
		{
			if(banner_image.value != '')
			{
				if(!checkImageType(banner_image, 'Please Select an image to upload banner.'))
				{
					return false;
				}
			}
		}
		
		return true;
		
	}
}
//====================================================================================================
//	Function Name	:	Edit_Click()
//----------------------------------------------------------------------------------------------------
function Edit_Click(pageId)
{
	with(frms)
	{
		banner_id.value		= pageId;
		Action.value	= 'Edit';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	Delete_Click()
//----------------------------------------------------------------------------------------------------
function Delete_Click(pageId)
{
	with(frms)
	{
		if(confirm('Are you sure you wants to delete?'))
		{
			banner_id.value 		= pageId;
			Action.value	= 'Delete';
			submit();
		}
	}
}

//====================================================================================================
//	Function Name	:	ToggleStatus_Click(pageId,state)
//----------------------------------------------------------------------------------------------------

function ToggleStatus_Click(pageId,state)
{
	 with(frms)
	 {
		 banner_id.value	= pageId;
		 status.value 	= state;
		 Action.value	= 'ChangeStatus';
		 submit();
	 }
}
//====================================================================================================
//	Function Name	:	DeleteChecked_Click()
//----------------------------------------------------------------------------------------------------
function DeleteChecked_Click()
{
	with(frms)
	{
		var flg=false;

		if(document.all['lists[]'].length)
		{
			for(i=0; i < document.all['lists[]'].length; i++)
			{
				if(document.all['lists[]'][i].checked)
					flg = true;
			}
		}
		else
		{
			if(document.all['lists[]'].checked)
				flg = true;
		}

		if(!flg)
		{
			alert('Please select the record you want to delete.');
			return false;
		}
			
		if(confirm('Are you sure you want to delete selected Banner(s)?'))
		{
			Action.value 	= 'DeleteSelected';
			submit();
		}
	}
}

function Button_Click(btn)
{
	with(frms)
	{
		Submit.value = btn.value;
		for(i=0; i<menu.length; i++)
			display_order.value += menu[i].value + ':';
		submit();
	}
}

function UpDown_Click(direction)
{
	var list = frms.menu;
	var tmpVal;
	var tmpText;

	if(list.selectedIndex==-1)
	{
		alert("Select the banner you want to move.");
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
