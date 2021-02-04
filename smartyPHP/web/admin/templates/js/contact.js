//====================================================================================================
//	Function Name	:	ToggleStatus_Click(contactId,state)
//----------------------------------------------------------------------------------------------------

function ToggleStatus_Click(contactId,state)
{
	with(document.frmContact)
	 {
		 contact_id.value	= contactId;
		 status.value 	= state;
		 Action.value	= 'ChangeStatus';
		 submit();
	 }
}
//====================================================================================================
//	Function Name	:	Delete_Click()
//----------------------------------------------------------------------------------------------------
function Delete_Click(contactId)
{
	with(document.frmContact)
	{
		if(confirm('Are You Sure You Want to Delete?'))
		{
			contact_id.value 	= contactId;
			Action.value		= 'Delete';
			submit();
		}
	}
}
//====================================================================================================
//	Function Name	:	DeleteChecked_Click()
//----------------------------------------------------------------------------------------------------
function DeleteChecked_Click()
{
	with(document.frmContact)
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
			alert('Please, Select the Record You Want to Delete.');
			return false;
		}
		if(confirm('Are You Sure You Want to Delete Selected Contact(s)?'))
		{
			Action.value 	= 'DeleteSelected';
			submit();
		}
	}
}