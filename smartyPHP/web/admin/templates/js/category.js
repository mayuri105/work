function Validate_Form(frm)
{
	with(frm)
    {	
		if(!IsEmpty(cat_title, 'Please, Enter Title.'))
		{
			return false;
		}
		return true;
	}
}

//====================================================================================================
//	Function Name	:	Edit_Click()
//----------------------------------------------------------------------------------------------------
function Edit_Click(catId)
{
	with(document.frmCategory)
	{
		cat_id.value	= catId;
		Action.value		= 'Edit';
		submit();
	}
}
//====================================================================================================
//	Function Name	:	Delete_Click()
//----------------------------------------------------------------------------------------------------
function Delete_Click(catId)
{
	with(document.frmCategory)
	{
		if(confirm('Are You Sure You Want to Delete?'))
		{
			cat_id.value 	= catId;
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
	with(document.frmCategory)
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
		if(confirm('Are You Sure You Want to Delete Selected Category?'))
		{
			Action.value 	= 'DeleteSelected';
			submit();
		}
	}
}
