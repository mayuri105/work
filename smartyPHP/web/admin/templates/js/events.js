//====================================================================================================
//	Function Name	:	Validate_Form
//----------------------------------------------------------------------------------------------------
function Form_Submit(frm)
{
	with(frm)
    {	
		
		if(!IsEmpty(event_title, 'Please Enter Event Title.'))
		{
			event_title.value = '';
			event_title.focus();
			return false;
		}
		return true;
	}
}

function Edit_Click(eventId)
{
	with(document.frmEvents)
	{
		event_id.value	= eventId;
		Action.value	= 'Edit';
		submit();
	}
}

function Delete_Click(eventId)
{
	with(document.frmEvents)
	{
		if(confirm('Are you sure you wants to delete event?'))
		{
			event_id.value 	= eventId;
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
	with(document.frmEvents)
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
			
		if(confirm('Are you sure you want to delete selected event(s)?'))
		{
			Action.value = 'DeleteSelected';
			submit();
		}
	}
}
//====================================================================================================
//	Function Name	:	ToggleStatus_Click(menuId,state)
//----------------------------------------------------------------------------------------------------
function ToggleStatus_Click(eventId,state)
{
	 with(document.frmEvents)
	 {
		 event_id.value	= eventId;
		 status.value 	= state;
		 Action.value	= 'ChangeStatus';
		 submit();
	 }
}