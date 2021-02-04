//====================================================================================================
//	Function Name	:	Form_Submit(frm)
//----------------------------------------------------------------------------------------------------
function Form_Submit(frm)
{
	with(frm)
	{
		if(!IsEmpty(page_title, 'Please enter Page Title.'))
		{
			page_title.focus();
			return false;
		}
		return true;
	}
}
//====================================================================================================
//	Function Name	:	Edit_Click()
//----------------------------------------------------------------------------------------------------
function Edit_Click(pageId)
{
	with(document.frmPage)
	{
		page_id.value		= pageId;
		Action.value	= 'Edit';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	Preview_Click()
//----------------------------------------------------------------------------------------------------
function Preview_Click(pageId)
{
	with(document.frmPage)
	{
		page_id.value	= pageId;	
		Action.value = 'Preview';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	Add_Click()
//----------------------------------------------------------------------------------------------------

function Add_Click()
{
	with(document.frmPage)
	{
		
		Action.value	= 'Add';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	ToggleStatus_Click(pageId,state)
//----------------------------------------------------------------------------------------------------

function ToggleStatus_Click(pageId,state)
{
	 with(document.frmPage)
	 {
		 page_id.value	= pageId;
		 status.value 	= state;
		 Action.value	= 'ChangeStatus';
		 submit();
	 }
}
//====================================================================================================
//	Function Name	:	Delete_Click()
//----------------------------------------------------------------------------------------------------
function Delete_Click(pageId)
{
	with(document.frmPage)
	{
		if(confirm('Are you sure you wants to delete Page?'))
		{
			page_id.value 		= pageId;
			Action.value	= 'Delete';
			submit();
		}
	}
}
//====================================================================================================
//	Function Name	:	DeleteChecked_Click()
//----------------------------------------------------------------------------------------------------
function DeleteChecked_Click()
{
	with(document.frmPage)
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
			
		if(confirm('Are you sure you want to delete selected Page(s)?'))
		{
			Action.value 	= 'DeleteSelected';
			submit();
		}
	}
}